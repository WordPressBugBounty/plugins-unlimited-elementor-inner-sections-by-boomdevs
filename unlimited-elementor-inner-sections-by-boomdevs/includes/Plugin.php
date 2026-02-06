<?php 

namespace PrimeElementorAddons;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

use PrimeElementorAddons\Ueis\UnlimitedElementorInnerSections;
use PrimeElementorAddons\Admin\WidgetSettings;
use PrimeElementorAddons\Utils\Helper;

final class Plugin {
    
	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const VERSION = '1.1.0';

	/**
	 * Plugin slug
	 *
	 * @var string
	 */
	const SLUG = 'unlimited-elementor-inner-sections-by-boomdevs';

	/**
	 * Plugin prefix
	 *
	 * @var string
	 */
	const PREFIX = 'pea_';

	/**
	 * Plugin text domain
	 *
	 * @var string
	 */
	const TEXT_DOMAIN = 'unlimited-elementor-inner-sections-by-boomdevs';
    
    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
    
    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.4';
    
    /**
     * Instance
     */
    private static $_instance = null;
    
    /**
     * Constructor
     */
    public function __construct() {
		$this->define_constants();
        add_action('plugins_loaded', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'run_ueis'], 5 );
        add_action('plugins_loaded', [$this, 'init_prime_elementor_addons'], 10);

        // Initialize Admin
        $this->init_admin();
        add_action( 'current_screen', [ $this, 'remove_admin_notices' ]);
		register_activation_hook(PEA_PLUGIN_FILE, [$this, 'set_activation_redirect']);
		add_action('admin_init', [$this, 'handle_activation_redirect']);
    }
    
    /**
     * Instance
     * Ensures only one instance of the class is loaded or can be loaded.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

	/**
	 * Define constants
	 */
	private function define_constants() {
        if ( ! defined( 'PEA_VERSION' ) ) {
            $plugin_data = get_file_data(
                PEA_PLUGIN_FILE,
                [ 'Version' => 'Version' ]
            );
            define( 'PEA_VERSION', $plugin_data['Version'] );
        }
        if ( ! defined( 'PEA_SLUG' ) ) {
            define( 'PEA_SLUG', self::SLUG );
        }
        if ( ! defined( 'PEA_PREFIX' ) ) {
            define( 'PEA_PREFIX', self::PREFIX );
        }
        if ( ! defined( 'PEA_TEXT_DOMAIN' ) ) {
            define( 'PEA_TEXT_DOMAIN', self::TEXT_DOMAIN );
        }
        if ( ! defined( 'PEA_PLUGIN_PATH' ) ) {
            define( 'PEA_PLUGIN_PATH', plugin_dir_path( PEA_PLUGIN_FILE ) );
        }
        if ( ! defined( 'PEA_PLUGIN_URL' ) ) {
            define( 'PEA_PLUGIN_URL', plugin_dir_url( PEA_PLUGIN_FILE ) );
        }
        if ( ! defined( 'PEA_PLUGIN_BASENAME' ) ) {
            define( 'PEA_PLUGIN_BASENAME', plugin_basename( PEA_PLUGIN_FILE ) );
        }
        if ( ! defined( 'PEA_UPGRADE_PRO_URL' ) ) {
            define( 'PEA_UPGRADE_PRO_URL', 'https://wpmessiah.com/prime-elementor-addons/pricing');
        }
        if ( ! defined( 'PEA_IS_PRO_ACTIVE' ) ) {
            define( 'PEA_IS_PRO_ACTIVE', class_exists('PrimeElementorAddons\Pro\Plugin') ? true : false);
        }
	}
    
    /**
     * Load Textdomain
     */
    public function i18n() {
        load_plugin_textdomain('unlimited-elementor-inner-sections-by-boomdevs', false, dirname(plugin_basename(PEA_PLUGIN_FILE)) . '/languages');
    }

    public function run_ueis() {
            
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }
        
        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }
        
        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Backward compatible with Unlimited elementor inner sections by boomdevs 
        $UEIS = new UnlimitedElementorInnerSections();

    }
    
    /**
     * Initialize the plugin
     */
    public function init_prime_elementor_addons() {
        
        // Add Plugin actions
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'register_prime_elementor_addons_category']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_widget_styles'], 999);
        add_action('elementor/frontend/after_register_scripts', [$this, 'enqueue_widget_scripts'], 999);
        add_action('wp_enqueue_scripts', [$this, 'localize_widget_scripts'], 999);

        add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_style']);
        add_action('wp_ajax_get_author_by_post_type', [$this, 'get_author_by_post_type'] );
        add_action('wp_ajax_get_category_by_post_type', [$this, 'get_category_by_post_type'] );
        add_action('wp_ajax_get_tag_by_post_type', [$this, 'get_tag_by_post_type'] );
        add_action('wp_ajax_pea_load_posts', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'handle_load_posts']);
        add_action('wp_ajax_nopriv_pea_load_posts', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'handle_load_posts']);
    }

    /**
     * Initialize Admin
     */
    private function init_admin() {
        // Only initialize in admin area
        if ( is_admin() ) {
            \PrimeElementorAddons\Admin\Admin::instance();
        }
    }

    
    public function remove_admin_notices( $screen ) {
        if ( empty( $screen->id ) ) {
            return;
        }

        if ( $screen->id === 'toplevel_page_prime-elementor-addons' ) {
            remove_all_actions( 'admin_notices' );
            remove_all_actions( 'all_admin_notices' );

            /*
            * Re-add ONLY our notice(s)
            */
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin'], 10);
        }
    }

    /**
     * Redirect to Prime Elementor Addons admin page after plugin activation
     */

    public function set_activation_redirect() {
        add_option( 'prime_elementor_addons_do_activation_redirect', true );
    }

    public function handle_activation_redirect() {
        if ( get_option( 'prime_elementor_addons_do_activation_redirect', false ) ) {
            delete_option( 'prime_elementor_addons_do_activation_redirect' );
            wp_safe_redirect( admin_url( 'admin.php?page=prime-elementor-addons' ) );
            exit;
        }
    }
    
    /**
     * Display missing Elementor notice (hook callback)
     */
    public function admin_notice_missing_main_plugin() {
        echo $this->get_missing_elementor_notice(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Display minimum Elementor version notice (hook callback)
     */
    public function admin_notice_minimum_elementor_version() {
        echo $this->get_elementor_version_notice(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Display minimum PHP version notice (hook callback)
     */
    public function admin_notice_minimum_php_version() {
        echo $this->get_php_version_notice(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Get missing Elementor notice HTML
     * 
     * @return string Notice HTML
     */
    private function get_missing_elementor_notice() {

        if ( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }

        $elementor = 'elementor/elementor.php';

        if ( Helper::is_plugin_exists( $elementor ) ) {

            if ( is_plugin_active( $elementor ) ) {
                return;
            }

            // Activate Elementor
            $action_url = wp_nonce_url(
                admin_url( 'plugins.php?action=activate&plugin=' . $elementor ),
                'activate-plugin_' . $elementor
            );

            /* translators: 1: Plugin name, 2: Required plugin */
            $message = sprintf( esc_html__( '%1$sPrime Elementor Addons%2$s requires %1$sElementor%2$s to be active.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                '<strong>',
                '</strong>'
            );

            $button_text = esc_html__( 'Activate Elementor', 'unlimited-elementor-inner-sections-by-boomdevs' );

        } else {

            // Install Elementor
            $action_url = wp_nonce_url(
                self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ),
                'install-plugin_elementor'
            );

            /* translators: 1: Plugin name, 2: Required plugin */
            $message = sprintf( esc_html__( '%1$sPrime Elementor Addons%2$s requires %1$sElementor%2$s to be installed and activated.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                '<strong>',
                '</strong>'
            );

            $button_text = esc_html__( 'Install Elementor', 'unlimited-elementor-inner-sections-by-boomdevs' );
        }

        /* translators: 1: Notice Message, 2: Url to install/activate elementor, 3: Button Text */
        printf('<div class="notice notice-error" style="position:relative;z-index:999999;"><p>%1$s</p><p><a href="%2$s" class="button-primary">%3$s</a></p></div>',
            wp_kses_post( $message ),
            esc_url( $action_url ),
            esc_html( $button_text )
        );
    }

    /**
     * Get minimum Elementor version notice HTML
     * 
     * @return string Notice HTML
     */
    private function get_elementor_version_notice() {
        /* translators: 1: Plugin name Prime Elementor Addons, 2: Required plugin Elementor, 3: Required plugin version */
        $message = sprintf( esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            '<strong>' . esc_html__( 'Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        return sprintf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post( $message )
        );
    }

    /**
     * Get minimum PHP version notice HTML
     * 
     * @return string Notice HTML
     */
    private function get_php_version_notice() {
        /* translators: 1: Plugin name, 2: PHP, 3: Required PHP minimum version */
        $message = sprintf( esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            '<strong>' . esc_html__( 'Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        return sprintf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post( $message )
        );
    }
    
    /**
     * Register Widgets
     */
    public function register_widgets($widgets_manager) {        

        $widgets = WidgetSettings::get_active_widgets();
        $allwidgets = \PrimeElementorAddons\Config\WidgetList::instance()->get_widgets();

        foreach ( $widgets as $widgetkey => $widget ) {
            if($widget == true ) {
                $class_name = $allwidgets[$widgetkey]['class'];
                $class = '\PrimeElementorAddons\Widgets\\'. $class_name;
                $widgets_manager->register(new $class());
            }
            
        }
    }
    
    /**
     * Register Widget Categories
     */
    public function register_prime_elementor_addons_category($elements_manager) {
        $categories['prime-elementor-addons'] = [
            'title' => esc_html__( 'Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'icon'  => 'fa fa-plug',
        ];

        $el_categories = $elements_manager->get_categories();
        $categories    = array_merge(
            array_slice( $el_categories, 0,  1),
            $categories,
            array_slice( $el_categories,  1)
        );

        $set_categories = function( $categories ) {
            $this->categories = $categories;
        };

        $set_categories->call( $elements_manager, $categories );
    }
    
    /**
     * Enqueue Widget Styles
     */
    public function enqueue_widget_styles() {
        $widgets = [
            'advanced-button',
            'advanced-heading',
            'advanced-image',
            'dual-button',
            'flip-box',
            'image-gallery',
            'info-box',
            'feature-list',
            'testimonial',
            'counter',
            'social-icons',
            'call-to-action',
            'pricing-table',
            'team-member',
            'count-down',
            'contact-form-7',
            'post-grid',
            'advanced-video',
            'progress-bar',
            'advanced-accordion',
            'icon-box',
            'advanced-tabs',
            'advanced-menu',
            // add all your widgets here
        ];

        foreach ($widgets as $widget) {
            wp_register_style(
                "prime-elementor-addons--{$widget}",
                PEA_PLUGIN_URL . "assets/css/widgets/{$widget}.css",
                [],
                PEA_VERSION
            );
        }
        wp_register_style(
            'prime-elementor-addons-sm-core-css',
            PEA_PLUGIN_URL . 'assets/css/sm-core-css.css',
            [],
            PEA_VERSION
        );
        wp_register_style(
            'prime-elementor-addons-sm-clean-css',
            PEA_PLUGIN_URL . 'assets/css/sm-clean.css',
            [],
            PEA_VERSION
        );
        wp_register_style(
            'prime-elementor-font-awesome-5',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css',
            [],
            PEA_VERSION
        );
    }
    
    /**
     * Enqueue Widget Scripts
     */
    public function enqueue_widget_scripts() {
        $widgets = [
            'image-gallery',
            'counter',
            'count-down',
            'post-grid',
            'advanced-video',
            'progress-bar',
            'advanced-accordion',
            'advanced-tabs',
            'advanced-menu',
            // add all your widgets here
        ];

        foreach ($widgets as $widget) {
            wp_register_script(
                "prime-elementor-addons--{$widget}", 
                PEA_PLUGIN_URL . "assets/js/widgets/{$widget}.js" , 
                ['jquery'], 
                PEA_VERSION, 
                true
            );
        }
        wp_register_script(
            'prime-elementor-addons-jquery-smartmenus',
            PEA_PLUGIN_URL . 'assets/js/jquery.smartmenus.js',
            ['jquery'],
            PEA_VERSION,
            true
        );
    }

    // method for widget script localization
    public function localize_widget_scripts() {
        if ( wp_script_is( 'prime-elementor-addons--post-grid', 'enqueued' ) ) {
            wp_localize_script('prime-elementor-addons--post-grid', 'PeaAjax', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('prime_elementor_addons_nonce')
            ]);
        }
    }

    
    /**
     * Enqueue Editor Scripts
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script(
            'prime-elementor-addons-editor',
            PEA_PLUGIN_URL . 'assets/js/editor/editor.js',
            ['jquery', 'elementor-editor'],
            PEA_VERSION,
            true
        );

		wp_enqueue_script(
			'prime-elementor-addons-editor-advanced-accordion',
			PEA_PLUGIN_URL . 'assets/js/editor/advanced-accordion.js',
			array(
				'nested-elements',
				'elementor-editor',
				'elementor-common',
				'wp-element',
				'jquery',
			),
			PEA_VERSION,
			true
		);

		wp_enqueue_script(
			'prime-elementor-addons-editor-advanced-tabs',
			PEA_PLUGIN_URL . 'assets/js/editor/advanced-tabs.js',
			array(
				'nested-elements',
				'elementor-editor',
				'elementor-common',
				'wp-element',
				'jquery',
			),
			PEA_VERSION,
			true
		);

        wp_localize_script('prime-elementor-addons-editor', 'peaEditor', [
            'pluginUrl' => PEA_PLUGIN_URL,
            'pea_editor_nonce' => wp_create_nonce('pea_editor_only_nonce'),
        ]);
    }
    
    /**
     * Enqueue Editor Styles
     */
    public function enqueue_editor_style() {
        wp_enqueue_style(
            'prime-elementor-addons-editor',
            PEA_PLUGIN_URL . 'assets/css/editor.css',
            [],
            PEA_VERSION
        );
    }

    public function get_author_by_post_type() {
        if ( ! check_ajax_referer( 'pea_editor_only_nonce', 'pea_editor_nonce_check', false ) ) {
            wp_send_json_error( ['message' => 'Invalid nonce'], 403 );
            return;
        }

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 403 );
        }

        $allowed_post_types = get_post_types( ['public' => true] );
        $post_type = isset( $_POST['post_type'] )
            ? sanitize_key( wp_unslash( $_POST['post_type'] ) )
            : '';
        if ( ! in_array( $post_type, $allowed_post_types, true ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 400 );
        }

        if ( empty( $post_type ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 400 );
        }

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

        wp_send_json_success( $authors );
    }

    public function get_category_by_post_type() {
        if ( ! check_ajax_referer( 'pea_editor_only_nonce', 'pea_editor_nonce_check', false ) ) {
            wp_send_json_error( ['message' => 'Invalid nonce'], 403 );
            return;
        }

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 403 );
        }

        $allowed_post_types = get_post_types( ['public' => true] );
        $post_type = isset( $_POST['post_type'] )
            ? sanitize_key( wp_unslash( $_POST['post_type'] ) )
            : '';
        if ( ! in_array( $post_type, $allowed_post_types, true ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 400 );
        }

        if ( empty( $post_type ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 400 );
        }

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

        wp_send_json_success( $options );
    }

    public function get_tag_by_post_type() {
        if ( ! check_ajax_referer( 'pea_editor_only_nonce', 'pea_editor_nonce_check', false ) ) {
            wp_send_json_error( ['message' => 'Invalid nonce'], 403 );
            return;
        }

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 403 );
        }

        $allowed_post_types = get_post_types( ['public' => true] );
        $post_type = isset( $_POST['post_type'] )
            ? sanitize_key( wp_unslash( $_POST['post_type'] ) )
            : '';
        if ( ! in_array( $post_type, $allowed_post_types, true ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 400 );
        }

        if ( empty( $post_type ) ) {
            wp_send_json_error( [ 'message' => esc_html__( 'Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs' ) ], 400 );
        }
        $options = [];

        // Get all taxonomies linked to the post type
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );

        foreach ( $taxonomies as $taxonomy ) {

            // Skip hierarchical (object category, etc.)
            if ( $taxonomy->hierarchical ) {
                continue;
            }

            // Get all terms from this tag-like taxonomy
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

        wp_send_json_success( $options );
    }
}