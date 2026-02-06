<?php
/**
 * Admin Page Class for Prime Elementor Addons
 *
 * @package PrimeElementorAddons
 */

namespace PrimeElementorAddons\Admin;

use PrimeElementorAddons\Config\WidgetList;
use PrimeElementorAddons\Utils\Helper;
use PrimeElementorAddons\Admin\WidgetSettings;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Admin {
    
    /**
     * Page slug
     *
     * @var string
     */
    private $page_slug = 'prime-elementor-addons';
    
    /**
     * Instance
     *
     * @var Admin
     */
    private static $_instance = null;
    
    /**
     * Get Instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Constructor
     */
    public function __construct() {
        // Only load in admin
        if ( ! is_admin() ) {
            return;
        }
        $this->initial_activated_widgets();
        add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'rest_api_init', [ $this, 'register_settings' ] );
        add_action( 'wp_ajax_pea_save_widgets', [ $this, 'pea_save_widgets' ] );
        add_action( 'wp_ajax_pea_get_plugin_changelog', [ $this, 'get_plugin_changelog' ] );
        add_filter( 'wp_redirect', function ( $location ) {
            if (
                isset( $_GET['from_pea'], $_GET['pea_nonce'] ) &&
                wp_verify_nonce(
                    sanitize_text_field( wp_unslash( $_GET['pea_nonce'] ) ),
                    'pea_redirect'
                ) &&
                current_user_can( 'activate_plugins' )
            ) {
                return admin_url( 'admin.php?page=prime-elementor-addons' );
            }

            return $location;
        } );

    }
    
    /**
     * Add admin menu page
     */
    public function add_admin_menu() {
        $hook = add_menu_page(
            __( 'Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            __( 'Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'manage_options',
            $this->page_slug,
            [ $this, 'render_admin_page' ],
            'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4Ij4KICA8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjkuMC4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogMi4xLjAgQnVpbGQgMTkyKSAgLS0+CiAgPGRlZnM+CiAgICA8c3R5bGU+CiAgICAgIC5zdDAgewogICAgICAgIGZpbGw6ICM5MjAwM2E7CiAgICAgIH0KCiAgICAgIC5zdDEgewogICAgICAgIGZpbGw6ICNmNjdiZTU7CiAgICAgIH0KICAgIDwvc3R5bGU+CiAgPC9kZWZzPgogIDxwb2x5Z29uIGNsYXNzPSJzdDAiIHBvaW50cz0iNTIuMDEgNTkuOSA1Mi4wMSAxMTYuMDUgMjguMDMgMTAxLjYgMjguMDMgNTkuOSA1Mi4wMSA1OS45Ii8+CiAgPHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSI1Mi4wMSAxMS45NSA1Mi4wMSAzNS45MiAyOC4wMiA1OS45IDI4LjAyIDM1Ljk0IDUyLjAxIDExLjk1Ii8+CiAgPHBvbHlnb24gY2xhc3M9InN0MCIgcG9pbnRzPSI3NS45OSAxMS45NSA5OS45OCAzNS45MiA1Mi4wMSAzNS45MiA3NS45OSAxMS45NSIvPgogIDxwb2x5Z29uIGNsYXNzPSJzdDEiIHBvaW50cz0iOTkuOTggMzUuOTQgOTkuOTggNjkuODQgODUuOTMgODMuODkgNTIuMDEgODMuODkgNzUuOTkgNTkuOSA3NS45OSAxMS45NSA5OS45OCAzNS45NCIvPgo8L3N2Zz4=',
            30
        );

        
        add_action( "load-$hook", [ $this, 'prime_elementor_addons_admin_hooks' ] );
    }

    function prime_elementor_addons_admin_hooks() {
        add_filter( 'update_footer', [ $this, 'prime_elementor_addons_footer_version' ], 11 );
        add_filter( 'admin_footer_text', [ $this, 'prime_elementor_addons_admin_footer' ] );
    }

    function prime_elementor_addons_admin_footer( $footer_text ) {
        
        $svg_path = PEA_PLUGIN_PATH . 'assets/images/love-favorite.svg';

        $svg = '';
        if ( file_exists( $svg_path ) ) {
            $svg = file_get_contents( $svg_path );
        }

        ob_start();
        ?>
        <div class="prime-elementor-addons-admin-footer">
            <span class="footer-line"></span>
            <span class="footer-content">
                Made with
                <span class="footer-svg">
                    <?php echo Helper::sanitize_svg($svg); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                </span>
                by
                <img
                    src="<?php echo esc_url( PEA_PLUGIN_URL . 'assets/images/wp-messiah-logo.png' ); ?>"
                    class="footer-logo"
                    alt="Your Company"
                />
            </span>
            <span class="footer-line"></span>
        </div>
        <?php

        return ob_get_clean();
    }

    function prime_elementor_addons_footer_version( $footer_text ) {
        return ''; // Return empty string to hide version
    }

    
    /**
     * Render admin page (React mount point)
     */
    public function render_admin_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        
        echo '<div id="prime-elementor-addons-admin"></div>';
    }
    
    /**
     * Enqueue admin assets
     *
     * @param string $hook_suffix The current admin page.
     */
    public function enqueue_assets( $hook_suffix ) {
        // Only load on our admin page
        if ( 'toplevel_page_' . $this->page_slug !== $hook_suffix ) {
            return;
        }

        
		$widgets = WidgetList::instance()->get_widgets();
		$localizeArray = array(
			'widgets' => $widgets,
			'defaultWidgets' => WidgetList::instance()->get_default_widgets(),
            'completedWidgets' => Helper::get_completed_widgets(),
			'widgetsInfo' => Helper::get_widgets_info(),
			'nonce' => wp_create_nonce('pea_settings_nonce'),
			'adminUrl' => admin_url(),
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'restUrl' => get_rest_url(),
			'pluginUrl' => PEA_PLUGIN_URL,
			'version' => PEA_VERSION,
			'pro_url' => PEA_UPGRADE_PRO_URL,
			'isProActive' => PEA_IS_PRO_ACTIVE ? 'true' : 'false',
			'logo' => PEA_PLUGIN_URL . 'assets/images/logo.svg',
            'home_url' => home_url(),
            'siteName' => get_bloginfo('name'),
            'siteTagline' => get_bloginfo('description'),
            'siteLogo' => get_theme_mod('custom_logo'),
            'system_requirements' => Helper::system_requirements(),
            'plugins' => [
                'aiAltText' => Helper::pea_get_plugin_status(
                    'ai-image-alt-text-generator-for-wp/boomdevs-ai-image-alt-text-generator.php'
                ),
                'wpAiCopilot' => Helper::pea_get_plugin_status(
                    'ai-co-pilot-for-wp/wp-ai-co-pilot.php'
                ),
            ],
            'activateNonces' => [
                'aiAltText' => wp_create_nonce(
                    'activate-plugin_ai-image-alt-text-generator-for-wp/boomdevs-ai-image-alt-text-generator.php'
                ),
                'wpAiCopilot' => wp_create_nonce(
                    'activate-plugin_ai-co-pilot-for-wp/wp-ai-co-pilot.php'
                ),
            ],
            'redirectNonce' => wp_create_nonce( 'pea_redirect' ),
		);
        
        $asset_file = PEA_PLUGIN_PATH . 'build/dashboard.asset.php';
        
        if ( ! file_exists( $asset_file ) ) {
            return;
        }
        
        $asset = include $asset_file;
        
        // Enqueue JavaScript
        wp_enqueue_script(
            'prime-elementor-addons-dashboard',
            PEA_PLUGIN_URL . 'build/dashboard.js',
            $asset['dependencies'],
            $asset['version'],
            true
        );
        
        // Enqueue CSS
        if ( file_exists( PEA_PLUGIN_PATH . 'build/dashboard.css' ) ) {
            wp_enqueue_style(
                'prime-elementor-addons-dashboard',
                PEA_PLUGIN_URL . 'build/dashboard.css',
                array( 'wp-components' ),
                $asset['version']
            );
        }
        
        // Pass data to JavaScript
        wp_localize_script(
            'prime-elementor-addons-dashboard',
            'PrimeElementorAddonsAdmin',
            $localizeArray
        );
    }
    
    /**
     * Register settings for REST API
     */
    public function register_settings() {
        $default = array(
            'enable_feature' => true,
            'api_key'        => '',
            'widget_options' => array(),
        );
        
        $schema = array(
            'type'       => 'object',
            'properties' => array(
                'enable_feature' => array(
                    'type' => 'boolean',
                ),
                'api_key' => array(
                    'type' => 'string',
                ),
                'widget_options' => array(
                    'type' => 'object',
                ),
            ),
        );
        
        register_setting(
            'options',
            'prime_elementor_addons_settings',
            array(
                'type'              => 'object',
                'default'           => $default,
                'show_in_rest'      => array(
                    'schema' => $schema,
                ),
                'sanitize_callback' => array( $this, 'sanitize_settings' ),
            )
        );
    }
    
    /**
     * Sanitize settings
     *
     * @param array $input Settings input.
     * @return array Sanitized settings.
     */
    public function sanitize_settings( $input ) {
        $sanitized = array();
        
        if ( isset( $input['enable_feature'] ) ) {
            $sanitized['enable_feature'] = (bool) $input['enable_feature'];
        }
        
        if ( isset( $input['api_key'] ) ) {
            $sanitized['api_key'] = sanitize_text_field( $input['api_key'] );
        }
        
        if ( isset( $input['widget_options'] ) && is_array( $input['widget_options'] ) ) {
            $sanitized['widget_options'] = $input['widget_options'];
        }
        
        return $sanitized;
    }

    public function initial_activated_widgets() {
        $widgets = WidgetList::instance()->get_widgets();
        
        if ( empty( $widgets ) || ! is_array( $widgets ) ) {
            return; // No widgets to activate
        }
        
        $already_activated_widgets = WidgetSettings::get_active_widgets();
        
        if ( ! empty( $already_activated_widgets ) ) {
            return; // Already configured, don't override
        }
        
        $initial_active_widgets = [];
        foreach ( $widgets as $key => $widget ) {
            $initial_active_widgets[ $key ] = true;
        }
        
        // ✅ Use WidgetSettings to update (auto-clears cache)
        WidgetSettings::update_active_widgets( $initial_active_widgets );
    }
    

	// Save Widget State On/Off
	public function pea_save_widgets()
	{
		if (!check_ajax_referer('pea_settings_nonce', 'security', false)) {
			wp_send_json_error(['message' => 'Invalid nonce'], 400);
			return;
		}

		if (!current_user_can('manage_options')) {
			wp_send_json_error(['message' => 'Insufficient permissions'], 403);
			return;
		}

		$widgets = [];

        if ( isset( $_POST['widgets'] ) ) {
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            $decoded = json_decode( wp_unslash( $_POST['widgets'] ), true );
            if ( is_array( $decoded ) ) {
                $widgets = Helper::pea_recursive_sanitize_array( $decoded );
            }
        }

        $widgets = is_array( $widgets ) ? $widgets : [];
        
		$activeWidgets = WidgetSettings::get_active_widgets();

		if (!is_array($widgets)) {
			wp_send_json_error(['message' => 'Invalid widget data'], 400);
			return;
		}

		if ($activeWidgets) {
			foreach ($widgets as $key => $value) {
				if ($value === true) {
					$activeWidgets[$key] = true;
				} else {
					$activeWidgets[$key] = false;
				}
			}

			$widgets = $activeWidgets;
		}

		$updated = WidgetSettings::update_active_widgets($widgets);

		if ($updated) {
			wp_send_json_success(['message' => 'Widgets updated successfully']);
		} else {
			wp_send_json_error(['message' => 'Failed to update Widgets']);
		}
	}

    
	public function get_plugin_changelog()
	{
		// $this->check_permission();

		$plugin_slug = isset($_POST['plugin_slug']) ? sanitize_text_field($_POST['plugin_slug']) : 'unlimited-elementor-inner-sections-by-boomdevs';

		if (empty($plugin_slug)) {
			wp_send_json_error(['message' => 'Plugin slug is required']);
		}

		$cache_key = 'pea_changelog_' . $plugin_slug;
		$cached = get_transient($cache_key);

		if ($cached !== false) {
			wp_send_json_success([
				'changelog' => $cached,
				'source' => 'cache',
				'version' => get_option('pea_plugin_version', 'N/A'),
				'last_updated' => get_option('pea_last_updated', 'N/A'),
			]);
		}

		$response = wp_remote_get("https://api.wordpress.org/plugins/info/1.0/{$plugin_slug}.json", [
			'timeout' => 15,
		]);

		if (is_wp_error($response)) {
			wp_send_json_error(['message' => 'Failed to fetch: ' . $response->get_error_message()]);
		}

		$body = wp_remote_retrieve_body($response);
		$data = json_decode($body, true);

		if (!$data || empty($data['sections']['changelog'])) {
			wp_send_json_error(['message' => 'Changelog not found.']);
		}

		$changelog = $this->format_changelog($data['sections']['changelog']);

		// Save extra info
		update_option('pea_plugin_version', $data['version'] ?? 'N/A');
		update_option('pea_last_updated', $data['last_updated'] ?? 'N/A');

		// Cache for 12 hours
		set_transient($cache_key, $changelog, 12 * HOUR_IN_SECONDS);

		wp_send_json_success([
			'changelog' => $changelog,
			'source' => 'api',
			'version' => $data['version'] ?? 'N/A',
			'last_updated' => $data['last_updated'] ?? 'N/A',
		]);
	}

	private function format_changelog($changelog)
	{
		$changelog = preg_replace_callback(
			'/<h[3-4][^>]*>([^<]+)<\/h[3-4]>/i',
			function ($m) {
				return '<div class="changelog-version"><strong>' . trim(strip_tags($m[1])) . '</strong></div>';
			},
			$changelog
		);

		$changelog = preg_replace('/<ul>/', '<ul class="changelog-list">', $changelog);
		$changelog = preg_replace('/<p[^>]*>\s*<\/p>|<br\s*\/?>/i', '', $changelog);

		return '<div class="plugin-changelog">' . trim($changelog) . '</div>';
	}
}
