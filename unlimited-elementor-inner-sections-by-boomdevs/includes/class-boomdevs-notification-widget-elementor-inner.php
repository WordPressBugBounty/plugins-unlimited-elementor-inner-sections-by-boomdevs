<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class BoomDevs_Notification_Widget_inner
{
    private $plugin_slug = 'unlimited-elementor-inner-sections-by-boomdevs';
    private $transient_key = 'unlimited-elementor-inner-sections-by-boomdevs';
    private $api_url;

    public function __construct() {
        $this->api_url = INNER_BACKEND_URL;
        add_action('admin_notices', [$this, 'render_widget']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('save_post', [$this, 'on_meta_box_update'], 10, 2);
    }

    private function fetch_notification_data() {
        $cached_data = get_transient($this->transient_key);
        if ($cached_data !== false) return $cached_data;

        $api_url = add_query_arg('plugin_slug', $this->plugin_slug, $this->api_url);
        $response = wp_remote_get($api_url, ['timeout' => 10, 'sslverify' => true]);

        if (is_wp_error($response)) return ['error' => $response->get_error_message()];
        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (empty($data)) {
            set_transient($this->transient_key, [], 12 * HOUR_IN_SECONDS);
        } else {
            set_transient($this->transient_key, $data, 12 * HOUR_IN_SECONDS);
        }
        
        return $data;
    }

    public function render_widget() {
        $data = $this->fetch_notification_data();
        if (isset($data['error']) || !is_array($data) || empty($data)) return;

        $first_title = esc_html($data[0]['title'] ?? 'Notifications');
       
        
        $html = '';
        $html .='<div class="boomdevs-notification-wrapper notice notice-info is-dismissible boomdevs-notification-widget" data-plugin-slug="' . esc_attr($this->plugin_slug) . '">';
            // $html .='<div class="notice notice-info is-dismissible boomdevs-notification-widget">';
                $html .='<h3>' . $first_title . '</h3>';
                $html .= $data[0]['content'];
               
        $html .='</div>';
        
        echo $html;

    }

  public function enqueue_scripts() {
    // Notification data 
    $data = $this->fetch_notification_data();

    // Notification content hash version 
    $version = substr(md5(json_encode($data)), 0, 8);

    // CSS enqueue
    wp_enqueue_style(
        'boomdevs-inner-notification-css',
        plugin_dir_url(dirname(__FILE__)) . 'admin/css/boomdevs-notification-widget-elementor.css',
        array(),
        $version
    );

    // JS enqueue
    wp_enqueue_script(
        'boomdevs-inner-notification-js',
        plugin_dir_url(dirname(__FILE__)) . 'admin/js/boomdevs-notification-widget-elementor.js',
        array('jquery'),
        $version,
        true
    );

    // Localize data to pass plugin_slug & version to JS
    wp_localize_script('boomdevs-inner-notification-js', 'boomdevs_widget_data_inner', [
        'plugin_slug' => 'unlimited-elementor-inner-sections-by-boomdevs',
        'version'     => $version,
    ]);
}


    public function on_meta_box_update($post_id, $post) {
        if (get_post_type($post_id) !== 'notification') return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        delete_transient($this->transient_key);
    }
    
}
new BoomDevs_Notification_Widget_inner;
