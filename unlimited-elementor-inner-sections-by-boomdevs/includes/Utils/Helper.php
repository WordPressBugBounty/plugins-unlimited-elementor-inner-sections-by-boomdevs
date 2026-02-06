<?php
namespace PrimeElementorAddons\Utils;

use PrimeElementorAddons\Config\WidgetList;
use PrimeElementorAddons\Admin\WidgetSettings;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Helper Utilities
 *
 * Provides reusable helper methods for Prime Elementor Addons, including
 * sanitization, content formatting, data preparation, and common
 * utility logic shared across widgets, admin screens, and AJAX handlers.
 *
 * @package PrimeElementorAddons
 * @since 1.0.0
 */

class Helper {

    /**
     * Sanitize content for Elementor widgets.
     * Allows default wp_kses_post tags plus extra tags like <span>.
     *
     * @param string $content The HTML content.
     * @param array $extra_tags Optional extra tags to allow.
     * @return string Sanitized content.
     */
    public static function sanitize_content( $content, $extra_tags = [] ) {
        // Get default allowed post tags
        $allowed_tags = wp_kses_allowed_html('post');

        // Merge extra tags
        if ( ! empty($extra_tags) && is_array($extra_tags) ) {
            $allowed_tags = array_merge($allowed_tags, $extra_tags);
        }

        return wp_kses($content, $allowed_tags);
    }

    /**
     * Default extra tags for Elementor widgets.
     * For example, <span> with common attributes.
     *
     * @return array
     */
    public static function default_extra_tags() {
        return [
            'span' => [
                'class' => true,
                'style' => true,
                'id'    => true,
                'data-*'=> true, // allow data attributes
            ],
        ];
    }

    /**
     * Sanitize content using default extra tags (like <span>).
     *
     * @param string $content
     * @return string
     */
    public static function sanitize_widget_content( $content ) {
        return self::sanitize_content( $content, self::default_extra_tags() );
    }

    /**
     * Optional helper: Sanitize only specific tags.
     *
     * @param string $content
     * @param array $tags
     * @return string
     */
    public static function sanitize_custom_tags( $content, $tags ) {
        return self::sanitize_content( $content, $tags );
    }

    public static function pea_get_image_url($image_id = null) {
        if (!$image_id) {
            // fallback default image from your plugin
            return PEA_PLUGIN_URL . 'assets/images/preset-bg.jpg';
        }
        return wp_get_attachment_url($image_id);
    }


    /**
     * Remove Top Parent Element Tag from given content.
     *
     * @param string $content
     * @return string
     */
    public static function remove_top_tag($content){
        if (empty($content)) {
            return '';
        }
        $content = (string) $content;
        return preg_replace('/^<[^>]+>(.*?)<\/[^>]+>$/is', '$1', $content);
    }

    /**
     * Sanitize and allow only safe SVG elements and attributes.
     *
     * @param string $svg  Raw SVG code.
     * @return string      Sanitized SVG code.
     */

    public static function sanitize_svg($svg) {
        $allowed_svg_tags = [
            'svg' => [
                'style' => true,
                'xmlns' => true,
                'xmlns:xlink' => true,
                'viewbox' => true,
                'width' => true,
                'height' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'version' => true,
                'id' => true,
                'class' => true,
                'opacity' => true,
            ],
            'g' => [
                'transform' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'path' => [
                'd' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'transform' => true,
                'opacity' => true,
                'fill-rule' => true,
                'clip-rule' => true,
            ],
            'circle' => [
                'cx' => true,
                'cy' => true,
                'r' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'rect' => [
                'x' => true,
                'y' => true,
                'width' => true,
                'height' => true,
                'rx' => true,
                'ry' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'polygon' => [
                'points' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'polyline' => [
                'points' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'line' => [
                'x1' => true,
                'y1' => true,
                'x2' => true,
                'y2' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'ellipse' => [
                'cx' => true,
                'cy' => true,
                'rx' => true,
                'ry' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'opacity' => true,
            ],
            'defs' => [],
            'use' => ['xlink:href' => true],
            'title' => [],
            'desc' => [],
            'clipPath' => ['id' => true],
            'linearGradient' => [
                'id' => true,
                'x1' => true,
                'y1' => true,
                'x2' => true,
                'y2' => true,
                'gradientUnits' => true,
            ],
            'stop' => [
                'offset' => true,
                'stop-color' => true,
                'stop-opacity' => true,
            ],
        ];

        return wp_kses($svg, $allowed_svg_tags);
    }


    /**
     * To get all author id and name.
     *
     * @return array
     */
    public static function get_authors(){
        // Get authors
        $authors = [];
        $users = get_users([
            'role__in' => ['author', 'editor', 'administrator'], // you can change roles
        ]);

        foreach ($users as $user) {
            $authors[$user->ID] = $user->display_name;
        }

        return $authors;
    }

    /**
     * Get All author related to a specific post type.
     *
     * @return array
     */
    public static function get_authors_by_post_type( $post_type ) {

        global $wpdb;

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- Get author IDs from posts of the given post type
        $author_ids = $wpdb->get_col( $wpdb->prepare(
            "SELECT DISTINCT post_author 
            FROM $wpdb->posts 
            WHERE post_type = %s 
            AND post_status = 'publish'",
            $post_type
        ));

        if ( empty( $author_ids ) ) {
            return [];
        }

        // Fetch user info
        $authors = [];
        foreach ( $author_ids as $author_id ) {
            $user = get_user_by( 'id', $author_id );
            if ( $user ) {
                $authors[ $user->ID ] = $user->display_name;
            }
        }

        return $authors;
    }

    /**
     * Get category taxonomy terms for a specific post type.
     *
     * @param string $post_type
     * @return array
     */
    public static function get_post_type_category_terms( $post_type ) {

        $options = [];

        // Get all taxonomies linked to the post type
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );

        foreach ( $taxonomies as $taxonomy ) {

            // Skip non-hierarchical (object tags, etc.)
            if ( ! $taxonomy->hierarchical ) {
                continue;
            }

            // Get all terms from this category-like taxonomy
            $terms = get_terms([
                'taxonomy'   => $taxonomy->name,
                'hide_empty' => false,
                'number'     => 100,
                'orderby'    => 'count',
                'order'      => 'DESC',
            ]);

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $options[ $term->term_id ] = $term->name;
                }
            }
        }

        return $options;
    }

    /**
     * Generate a clean excerpt with strict word trim.
     *
     * @param int        $length    Number of words.
     * @param WP_Post|null $post_obj Optional post object.
     *
     * @return string|null
     */
    public static function get_excerpt( $length = 0, $post_obj = null ) {

        if ( ! $length ) {
            return null;
        }

        $post_obj = $post_obj instanceof \WP_Post ? $post_obj : get_post();
        if ( ! $post_obj ) {
            return null;
        }

        // 1. Use manual excerpt ONLY if it exists
        if ( ! empty( $post_obj->post_excerpt ) ) {
            $source = $post_obj->post_excerpt;
        } else {
            $source = $post_obj->post_content;
        }

        // 2. Clean content
        $source = preg_replace( '/(&nbsp;|\xA0)/u', ' ', $source );
        $source = wp_strip_all_tags( strip_shortcodes( $source ) );
        $source = trim( preg_replace( '/\s+/', ' ', $source ) );

        // 3. Trim words
        return wp_trim_words( $source, absint( $length ), '&hellip;' );
    }

    

    public static function get_completed_widgets()
    {
        // 1. Get the master list of all widgets (slug => data)
        $allWidgets = WidgetList::instance()->get_widgets();

        // 2. Get the saved active blocks (array of slugs that are enabled)
        $activeBlocks = WidgetSettings::get_active_widgets();

        // 3. Build the final array in the required shape
        $output = [];

        foreach ($allWidgets as $slug => $widgetData) {

            // Default fields that are always present
            $item = [
                'slug' => $slug,
                'title' => $widgetData['title'] ?? ucwords(str_replace('-', ' ', $slug)),
                'package' => $widgetData['package'] ?? 'free',
                'category' => $widgetData['category'] ?? 'content',
                'badge' => $widgetData['badge'] ?? 'free',
                'status' => (!empty($activeBlocks[$slug])) ? '1' : '0',
                'icon' => $widgetData['icon'] ?? PEA_PLUGIN_URL . "assets/icons/{$slug}.svg",
                'doc' => $widgetData['doc'] ?? 'https://wpmessiah.com/',
                'demo' => $widgetData['demo'] ?? 'https://wpmessiah.com/',
                'complete' => $widgetData['complete'] ?? 'true',
                'child' => $widgetData['child'] ?? 'false',
            ];

            // Optional: you can add extra safety checks here if some keys are missing
            $output[] = $item;
        }

        return $output;
    }

    public static function get_widgets_info()
    {
        return WidgetSettings::get_active_widgets();
    }

    

    public static function system_requirements()
    {
        return [
            [
                'label' => __('PHP Version', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'value' => phpversion(),
                'status' => version_compare(phpversion(), '7.4', '>=') ? 'good' : 'error',
            ],
            [
                'label' => __('WordPress Version', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'value' => get_bloginfo('version'),
                'status' => version_compare(get_bloginfo('version'), '5.8', '>=') ? 'good' : 'warning',
            ],
            [
                'label' => __('Server SSL', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'value' => is_ssl() ? __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs') : __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'status' => is_ssl() ? 'good' : 'error',
            ],
            [
                'label' => __('WP Debug', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'value' => (defined('WP_DEBUG') && WP_DEBUG ? __('Enabled', 'unlimited-elementor-inner-sections-by-boomdevs') : __('Disabled', 'unlimited-elementor-inner-sections-by-boomdevs')),
                'status' => (defined('WP_DEBUG') && WP_DEBUG) ? 'warning' : 'good',
            ],
            [
                'label' => __('Memory Limit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'value' => ini_get('memory_limit'),
                'status' => (intval(ini_get('memory_limit')) >= 256) ? 'good' : 'warning',
            ],
            // [
            //     'label' => __('Max Execution Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //     'value' => ini_get('max_execution_time') . 's',
            //     'status' => (ini_get('max_execution_time') >= 30) ? 'good' : 'warning',
            // ],
            // [
            //     'label' => __('Prime Elementor Addons Version', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //     'value' => PEA_VERSION,
            //     'status' => version_compare(PEA_VERSION, '1.0.0', '>=') ? 'good' : 'warning',
            // ],
            // [
            //     'label' => __('Upload max filesize', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //     'value' => ini_get('upload_max_filesize'),
            //     'status' => (intval(ini_get('upload_max_filesize')) >= 256) ? 'good' : 'warning',
            // ],
            // [
            //     'label' => __('Post max size', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //     'value' => ini_get('post_max_size'),
            //     'status' => (intval(ini_get('post_max_size')) >= 256) ? 'good' : 'warning',
            // ],
            // [
            //     'label' => __('Max input vars', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //     'value' => ini_get('max_input_vars'),
            //     'status' => (intval(ini_get('max_input_vars')) >= 1000) ? 'good' : 'warning',
            // ],
        ];
    }

    public static function pea_get_plugin_status( $plugin_file ) {

        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_file ) ) {
            return 'not_installed';
        }

        if ( is_plugin_active( $plugin_file ) ) {
            return 'active';
        }

        return 'inactive';
    }

    public static function pea_recursive_sanitize_array( $data ) {
        foreach ( $data as $key => $value ) {

            if ( is_array( $value ) ) {
                $data[ sanitize_key( $key ) ] = pea_recursive_sanitize_array( $value );
            } else {
                $data[ sanitize_key( $key ) ] = rest_sanitize_boolean( $value );
            }

            if ( sanitize_key( $key ) !== $key ) {
                unset( $data[ $key ] );
            }
        }

        return $data;
    }

    public static function is_plugin_exists($basename){
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }

}
