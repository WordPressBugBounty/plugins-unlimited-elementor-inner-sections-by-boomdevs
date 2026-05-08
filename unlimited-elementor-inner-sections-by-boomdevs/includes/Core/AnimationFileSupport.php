<?php

namespace PrimeElementorAddons\Core;

use PrimeElementorAddons\Traits\Singleton;

if (!defined('ABSPATH')) {
	exit;
}


class AnimationFileSupport {
    use Singleton;

    private $wpFilesystem;

    public function __construct() {
        add_filter('mime_types', [$this, 'allow_rive_mime_types'], PHP_INT_MAX);
        add_filter('upload_mimes', [$this, 'allow_rive_upload_mime'], PHP_INT_MAX, 2);
        add_action('wp_ajax_pea_upload_animation_file', [$this, 'upload_animation_file']);
        add_filter('wp_handle_upload_overrides', [$this, 'allow_animation_upload_overrides'], PHP_INT_MAX, 2);
        add_filter('wp_handle_upload', [$this, 'normalize_animation_uploaded_type'], PHP_INT_MAX);
        add_filter('wp_check_filetype_and_ext', [$this, 'fix_rive_filetype'], PHP_INT_MAX, 5);
        add_filter('site_option_upload_filetypes', [$this, 'allow_rive_multisite_filetypes'], PHP_INT_MAX);
        add_filter('elementor/files/allow_unfiltered_upload', [$this, 'allow_elementor_unfiltered_upload'], PHP_INT_MAX);
        add_action('wp_ajax_pea_rive_wasm', [$this, 'serve_rive_wasm']);
        add_action('wp_ajax_nopriv_pea_rive_wasm', [$this, 'serve_rive_wasm']);
    }

    /**
     * Ensure extension-to-mime map includes Rive/Lottie types for media uploader pre-checks.
     *
     * @param array $mimes Core extension-to-mime map.
     * @return array
     */
    public function allow_rive_mime_types($mimes){
        if (!is_array($mimes)) {
            return $mimes;
        }

        $mimes['riv'] = 'application/octet-stream';
        $mimes['json'] = 'application/json';

        return $mimes;
    }

    /**
     * Allow Rive files in Media Library upload.
     *
     * @param array $mimes Allowed mimes.
     * @return array
     */
    public function allow_rive_upload_mime($mimes, $_user = null){
        if (!is_array($mimes)) {
            return $mimes;
        }

        $mimes['riv'] = 'application/octet-stream';
        $mimes['json'] = 'application/json';
        return $mimes;
    }

    /**
     * Upload rive and lottie animation source file and create attachment.
     *
     * @return void
     */
    public function upload_animation_file()
    {
        if (!check_ajax_referer('pea_editor_only_nonce', 'pea_editor_nonce_check', false)) {
            wp_send_json_error(['message' => 'Invalid nonce'], 403);
            return;
        }

        if (!current_user_can('upload_files')) {
            wp_send_json_error(['message' => esc_html__('Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs')], 403);
            return;
        }

        if (empty($_FILES['animation_file']['name'])) {
            wp_send_json_error(['message' => esc_html__('No file received.', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
            return;
        }

        $filename = sanitize_file_name((string) $_FILES['animation_file']['name']);
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($extension, ['json', 'riv'], true)) {
            wp_send_json_error(['message' => esc_html__('Invalid file type.', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
            return;
        }

        if (!function_exists('wp_handle_upload')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        $overrides = [
            'test_form' => false,
            'test_type' => false,
            'mimes' => [
                $extension => ('json' === $extension) ? 'application/json' : 'application/octet-stream',
            ],
        ];

        $uploaded = wp_handle_upload($_FILES['animation_file'], $overrides);

        if (isset($uploaded['error'])) {
            wp_send_json_error(['message' => sanitize_text_field((string) $uploaded['error'])], 400);
            return;
        }

        $attachment_mime = isset($uploaded['type']) ? (string) $uploaded['type'] : '';
        if ('json' === $extension) {
            $attachment_mime = 'application/json';
        } elseif ('riv' === $extension) {
            $attachment_mime = 'application/octet-stream';
        }

        $attachment_id = wp_insert_attachment(
            [
                'post_mime_type' => $attachment_mime,
                'post_title' => sanitize_text_field(pathinfo($filename, PATHINFO_FILENAME)),
                'post_content' => '',
                'post_status' => 'inherit',
            ],
            $uploaded['file']
        );

        if (is_wp_error($attachment_id) || !$attachment_id) {
            wp_send_json_error(['message' => esc_html__('Upload completed but attachment creation failed.', 'unlimited-elementor-inner-sections-by-boomdevs')], 500);
            return;
        }

        wp_send_json_success(
            [
                'id' => (int) $attachment_id,
                'url' => esc_url_raw((string) $uploaded['url']),
            ]
        );
    }

    /**
     * Apply strict upload overrides only for animation source files.
     *
     * @param array $overrides Upload overrides.
     * @param array $file Uploaded file array.
     * @return array
     */
    public function allow_animation_upload_overrides($overrides, $file){
        if (!current_user_can('upload_files')) {
            return $overrides;
        }

        $filename = isset($file['name']) ? (string) $file['name'] : '';
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if ('json' !== $extension && 'riv' !== $extension) {
            return $overrides;
        }

        if (!isset($overrides['mimes']) || !is_array($overrides['mimes'])) {
            $overrides['mimes'] = [];
        }

        $overrides['mimes']['json'] = 'application/json';
        $overrides['mimes']['riv'] = 'application/octet-stream';
        $overrides['test_type'] = false;

        return $overrides;
    }

    /**
     * Normalize uploaded MIME for animation files in WP media upload flow.
     *
     * @param array $upload Uploaded file result.
     * @return array
     */
    public function normalize_animation_uploaded_type($upload){
        if (!is_array($upload) || empty($upload['file'])) {
            return $upload;
        }

        $extension = strtolower(pathinfo((string) $upload['file'], PATHINFO_EXTENSION));
        if ('json' === $extension) {
            $upload['type'] = 'application/json';
        } elseif ('riv' === $extension) {
            $upload['type'] = 'application/octet-stream';
        }

        return $upload;
    }

    /**
     * Normalize Rive filetype detection across environments.
     *
     * @param array       $types         Values for extension, mime, and corrected filename.
     * @param string      $file          Full path to file.
     * @param string      $filename      The name of the file.
     * @param string[]    $mimes         Key is the file extension with value as the mime type.
     * @param string|bool $real_mime     The actual mime type or false if unavailable.
     * @return array
     */
    public function fix_rive_filetype($types, $file, $filename, $mimes, $real_mime){
        $extension = strtolower(pathinfo((string) $filename, PATHINFO_EXTENSION));

        if ('riv' !== $extension && 'json' !== $extension) {
            return $types;
        }

        if ('json' === $extension) {
            $types['ext'] = 'json';
            $types['type'] = 'application/json';
            $types['proper_filename'] = $filename;
            return $types;
        }

        $types['ext'] = 'riv';
        $types['type'] = in_array($real_mime, ['application/json', 'text/plain'], true)
            ? 'application/json'
            : 'application/octet-stream';
        $types['proper_filename'] = $filename;

        return $types;
    }

    /**
     * Ensure Rive/Lottie extensions stay allowed in multisite upload filetype settings.
     *
     * @param string $filetypes Space separated extension list.
     * @return string
     */
    public function allow_rive_multisite_filetypes($filetypes){
        $filetypes = is_string($filetypes) ? trim($filetypes) : '';
        $types = '' === $filetypes ? [] : preg_split('/\s+/', $filetypes);

        if (!in_array('riv', $types, true)) {
            $types[] = 'riv';
        }

        if (!in_array('json', $types, true)) {
            $types[] = 'json';
        }

        return implode(' ', $types);
    }

    /**
     * Allow Elementor unfiltered upload gate for users who can upload files.
     *
     * @param bool $enabled Elementor unfiltered upload status.
     * @return bool
     */
    public function allow_elementor_unfiltered_upload($enabled){
        return current_user_can('upload_files') || (bool) $enabled;
    }

    /**
     * Serve local Rive wasm with a strict MIME type.
     *
     * @return void
     */
    public function serve_rive_wasm(){
        $wasm_path = PEA_PLUGIN_PATH . 'assets/js/vendor/rive.wasm';
        if (!file_exists($wasm_path) || !is_readable($wasm_path)) {
            status_header(404);
            exit;
        }

        if (function_exists('nocache_headers')) {
            nocache_headers();
        }

        $size = filesize($wasm_path);
        header('Content-Type: application/wasm');
        if (false !== $size) {
            header('Content-Length: ' . (string) $size);
        }
        readfile($wasm_path);
        exit;
    }
    
}
