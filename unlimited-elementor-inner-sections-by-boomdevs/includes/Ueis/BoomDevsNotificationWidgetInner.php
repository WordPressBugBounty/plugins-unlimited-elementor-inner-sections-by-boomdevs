<?php
namespace PrimeElementorAddons\Ueis;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class BoomDevsNotificationWidgetInner
{
    private $plugin_slug = 'unlimited-elementor-inner-sections-by-boomdevs';
    private $transient_key = 'unlimited-elementor-inner-sections-by-boomdevs';
    private $api_url;
    
    // ✅ Instance property for request-level caching
    private $notification_data = null;
    private $data_fetched = false; // Flag to distinguish null from unfetched

    public function __construct() {
        $this->api_url = PEA_UEIS_BACKEND_URL;
        add_action('admin_notices', [$this, 'render_widget']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('save_post', [$this, 'on_meta_box_update'], 10, 2);
    }

    private function fetch_notification_data() {
        // ✅ Return cached data if already fetched this request
        if ($this->data_fetched) {
            return $this->notification_data;
        }

        // Check transient cache (12-hour cache)
        $cached_data = get_transient($this->transient_key);
        if ($cached_data !== false) {
            $this->notification_data = $cached_data;
            $this->data_fetched = true;
            return $cached_data;
        }

        // Fetch from API
        $api_url = add_query_arg('plugin_slug', $this->plugin_slug, $this->api_url);
        $response = wp_remote_get($api_url, [
            'timeout' => 10,
            'sslverify' => true,
            'redirection' => 0
        ]);

        if (is_wp_error($response)) {
            $error_data = ['error' => $response->get_error_message()];
            $this->notification_data = $error_data;
            $this->data_fetched = true;
            return $error_data;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        // Validate JSON
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            $data = [];
        }

        // Cache for 12 hours
        set_transient($this->transient_key, $data, 12 * HOUR_IN_SECONDS);
        
        // ✅ Store in instance property for this request
        $this->notification_data = $data;
        $this->data_fetched = true;
        
        return $data;
    }

    public function render_widget() {
        $data = $this->fetch_notification_data(); // First call - fetches
        
        if (isset($data['error']) || !is_array($data) || empty($data)) {
            return;
        }
        
        if (!isset($data[0]) || !is_array($data[0])) {
            return;
        }

        $first_title = esc_html($data[0]['title'] ?? 'Notifications');
        $first_content = wp_kses_post($data[0]['content'] ?? '');
        
        $html = '<div class="boomdevs-notification-wrapper notice notice-info is-dismissible boomdevs-notification-widget" data-plugin-slug="' . esc_attr($this->plugin_slug) . '">';
        $html .= '<h3>' . $first_title . '</h3>';
        $html .= $first_content;
        $html .= '</div>';
        
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $html;
    }

    public function enqueue_scripts($hook) {
        $data = $this->fetch_notification_data(); // Second call - returns cached
        
        if (isset($data['error']) || !is_array($data) || empty($data)) {
            return;
        }

        $version = substr(md5(json_encode($data)), 0, 8);

        wp_enqueue_style(
            'boomdevs-inner-notification-css',
            PEA_PLUGIN_URL . 'includes/Ueis/css/boomdevs-notification-widget-elementor.css',
            array(),
            $version
        );

        wp_enqueue_script(
            'boomdevs-inner-notification-js',
            PEA_PLUGIN_URL . 'includes/Ueis/js/boomdevs-notification-widget-elementor.js',
            array('jquery'),
            $version,
            true
        );

        wp_localize_script('boomdevs-inner-notification-js', 'boomdevs_widget_data_inner', [
            'plugin_slug' => $this->plugin_slug,
            'version'     => $version,
        ]);
    }

    public function on_meta_box_update($post_id, $post) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (get_post_type($post_id) !== 'notification') {
            return;
        }

        delete_transient($this->transient_key);
        
        // ✅ Also clear instance cache
        $this->notification_data = null;
        $this->data_fetched = false;
    }
}
