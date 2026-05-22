<?php

namespace PrimeElementorAddons;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use PrimeElementorAddons\Ueis\UnlimitedElementorInnerSections;
use PrimeElementorAddons\Admin\WidgetSettings;
use PrimeElementorAddons\Config\WidgetList;
use PrimeElementorAddons\Utils\Helper;
use PrimeElementorAddons\Extensions\ExtensionsManager;
use PrimeElementorAddons\Core\AnimationFileSupport;
use PrimeElementorAddons\Core\SupportSvg;
use PrimeElementorAddons\Core\TaxImageSupport;
final class Plugin
{

    /**
     * Plugin version
     *
     * @var string
     */
    const VERSION = '1.3.3';

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
    public function __construct()
    {
        $this->define_constants();
        add_action('plugins_loaded', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'run_ueis'], 5);
        add_action('plugins_loaded', [$this, 'init_site_builder'], 10);
        add_action('plugins_loaded', [$this, 'init_prime_elementor_addons'], 10);
        add_action('plugins_loaded', [$this, 'extensions_manager'], 0);

        // Initialize Admin
        $this->init_admin();
        add_action('current_screen', [$this, 'remove_admin_notices']);
        register_activation_hook(PEA_PLUGIN_FILE, [$this, 'set_activation_redirect']);
        add_action('admin_init', [$this, 'handle_activation_redirect']);
    }

    /**
     * Instance
     * Ensures only one instance of the class is loaded or can be loaded.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Define constants
     */
    private function define_constants()
    {
        if (!defined('PEA_VERSION')) {
            $plugin_data = get_file_data(
                PEA_PLUGIN_FILE,
                ['Version' => 'Version']
            );
            define('PEA_VERSION', $plugin_data['Version']);
        }
        if (!defined('PEA_SLUG')) {
            define('PEA_SLUG', self::SLUG);
        }
        if (!defined('PEA_PREFIX')) {
            define('PEA_PREFIX', self::PREFIX);
        }
        if (!defined('PEA_TEXT_DOMAIN')) {
            define('PEA_TEXT_DOMAIN', self::TEXT_DOMAIN);
        }
        if (!defined('PEA_PLUGIN_PATH')) {
            define('PEA_PLUGIN_PATH', plugin_dir_path(PEA_PLUGIN_FILE));
        }
        if (!defined('PEA_PLUGIN_URL')) {
            define('PEA_PLUGIN_URL', plugin_dir_url(PEA_PLUGIN_FILE));
        }
        if (!defined('PEA_CONTROLS_URL')) {
            define('PEA_CONTROLS_URL', PEA_PLUGIN_URL . 'includes/Controls/');
        }
        if (!defined('PEA_PLUGIN_BASENAME')) {
            define('PEA_PLUGIN_BASENAME', plugin_basename(PEA_PLUGIN_FILE));
        }
        if (!defined('PEA_UPGRADE_PRO_URL')) {
            define('PEA_UPGRADE_PRO_URL', 'https://primeelementoraddons.com/pricing');
        }
        if (!defined('PEA_IS_PRO_ACTIVE')) {
            define('PEA_IS_PRO_ACTIVE', class_exists('PrimeElementorAddonsPro\Plugin') ? true : false);
        }
    }

    /**
     * Load Textdomain
     */
    public function i18n()
    {
        load_plugin_textdomain('unlimited-elementor-inner-sections-by-boomdevs', false, dirname(plugin_basename(PEA_PLUGIN_FILE)) . '/languages');
    }

    public function run_ueis()
    {

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

    public function init_site_builder()
    {
        \PrimeElementorAddons\SiteBuilder\SiteBuilder::get_instance();
    }

    /**
     * Initialize the plugin
     */
    public function init_prime_elementor_addons()
    {

        // Add Plugin actions
        add_action('wp_enqueue_scripts', [$this, 'ensure_elementor_frontend_dependencies'], 100);
        add_action('wp_enqueue_scripts', [$this, 'stabilize_elementor_modules_namespace'], 101);
        add_filter('script_loader_tag', [$this, 'normalize_elementor_script_tag'], 9999, 3);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        
        add_action('elementor/controls/register', [$this, 'register_custom_controls']);
        add_action('elementor/elements/categories_registered', [$this, 'register_prime_elementor_addons_category']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_widget_styles'], 998);
        add_action('elementor/frontend/after_register_scripts', [$this, 'enqueue_widget_scripts'], 999);
        add_action('wp_enqueue_scripts', [$this, 'localize_widget_scripts'], 999);
        add_action('rest_api_init', ['\PrimeElementorAddons\RestApi\AdvancedSearchRoute', 'register_routes']);

        add_action('elementor/documents/register_controls', array( $this, 'select_testing_content'), 10);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_scripts'], 10);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_style']);
        add_filter('elementor/editor/localize_settings', [$this, 'promote_pro_elements']);

        add_action('wp_ajax_get_author_by_post_type', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'get_author_by_post_type']);
        add_action('wp_ajax_get_category_by_post_type', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'get_category_by_post_type']);
        add_action('wp_ajax_get_tag_by_post_type', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'get_tag_by_post_type']);
        add_action('wp_ajax_pea_get_terms_by_taxonomy', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'get_terms_by_taxonomy']);
        add_action('wp_ajax_pea_load_posts', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'handle_load_posts']);
        add_action('wp_ajax_nopriv_pea_load_posts', ['\PrimeElementorAddons\Ajax\PostGridAjaxHandler', 'handle_load_posts']);
        
		$this->rive_and_lottie_support();
		$this->svg_support();
		$this->taxonomy_image_support();
        
        add_action('wp_ajax_pea_product_quick_view', [$this, 'product_quick_view']);
        add_action('wp_ajax_nopriv_pea_product_quick_view', [$this, 'product_quick_view']);
        
        // ─────────────────────────────────────────────────────────────────────────────
          // 3. AJAX: SEARCH TEMPLATES
          // Called by the editor when the user types in the Choose Template search box.
          // Returns up to 20 matching Elementor templates as JSON.
          // ─────────────────────────────────────────────────────────────────────────────
          add_action(
              'wp_ajax_pea_search_templates',
              [ '\PrimeElementorAddonsPro\Widgets\Template', 'ajax_search_templates' ]
          );

         
          // ─────────────────────────────────────────────────────────────────────────────
          // When a template is rendered inside the Template Widget, Elementor needs
          // to know to enqueue the inner widgets' assets too.
          // ─────────────────────────────────────────────────────────────────────────────
          add_action( 'elementor/frontend/widget/before_render', function ( $element ) {
              if ( 'pea_template' !== $element->get_name() ) return;
           
              $template_id = (int) $element->get_settings( 'template_id' );
              if ( ! $template_id ) return;
           
              // Tell Elementor this template's content is being displayed
              // so it registers the necessary scripts/styles for its inner widgets.
              \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
          } );
    }

    public function extensions_manager()
    {
        ExtensionsManager::get_instance();
    }

    /**
     * Ensure Elementor frontend script keeps required runtime dependencies.
     *
     * Some optimization layers can strip/alter deps and break `elementorModules.frontend.tools`.
     *
     * @return void
     */
    public function ensure_elementor_frontend_dependencies()
    {
        $scripts = wp_scripts();
        if (
            !$scripts instanceof \WP_Scripts ||
            empty($scripts->registered['elementor-frontend']) ||
            empty($scripts->registered['elementor-frontend-modules'])
        ) {
            return;
        }

        $frontend = $scripts->registered['elementor-frontend'];
        if (!in_array('elementor-frontend-modules', $frontend->deps, true)) {
            $frontend->deps[] = 'elementor-frontend-modules';
        }
    }

    /**
     * Preserve frontend namespace if common-modules overwrites window.elementorModules.
     *
     * @return void
     */
    public function stabilize_elementor_modules_namespace()
    {
        if (!wp_script_is('elementor-common-modules', 'registered')) {
            return;
        }

        wp_add_inline_script(
            'elementor-common-modules',
            'window.__peaElementorFrontendNs=window.elementorModules&&window.elementorModules.frontend?window.elementorModules.frontend:window.__peaElementorFrontendNs;',
            'before'
        );

        wp_add_inline_script(
            'elementor-common-modules',
            'if(window.__peaElementorFrontendNs&&(!window.elementorModules||!window.elementorModules.frontend||!window.elementorModules.frontend.tools)){window.elementorModules=window.elementorModules||{};window.elementorModules.frontend=window.__peaElementorFrontendNs;}',
            'after'
        );
    }

    /**
     * Keep critical Elementor frontend scripts non-async to preserve execution order.
     *
     * @param string $tag Script tag.
     * @param string $handle Script handle.
     * @param string $unused_src Script URL.
     * @return string
     */
    public function normalize_elementor_script_tag($tag, $handle, $unused_src)
    {
        unset($unused_src);

        $handles = [
            'elementor-frontend-modules',
            'elementor-frontend',
        ];

        if (!in_array($handle, $handles, true)) {
            return $tag;
        }

        $tag = preg_replace('/\s+async(\s|>)/i', '$1', $tag);
        $tag = preg_replace('/\s+defer(\s|>)/i', '$1', $tag);

        return $tag;
    }

    /**
     * Initialize Admin
     */
    private function init_admin()
    {
        // Only initialize in admin area
        if (is_admin()) {
            \PrimeElementorAddons\Admin\Admin::get_instance();
        }
    }


    public function remove_admin_notices($screen)
    {
        if (empty($screen->id)) {
            return;
        }

        if ($screen->id === 'toplevel_page_prime-elementor-addons') {
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

            /*
             * Re-add ONLY our notice(s)
             */
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin'], 10);
        }
    }

    /**
     * Redirect to Prime Elementor Addons admin page after plugin activation
     */

    public function set_activation_redirect()
    {
        add_option('prime_elementor_addons_do_activation_redirect', true);
    }

    public function handle_activation_redirect()
    {
        if (get_option('prime_elementor_addons_do_activation_redirect', false)) {
            delete_option('prime_elementor_addons_do_activation_redirect');
            wp_safe_redirect(admin_url('admin.php?page=prime-elementor-addons'));
            exit;
        }
    }

    /**
     * Display missing Elementor notice (hook callback)
     */
    public function admin_notice_missing_main_plugin()
    {
        echo $this->get_missing_elementor_notice(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Display minimum Elementor version notice (hook callback)
     */
    public function admin_notice_minimum_elementor_version()
    {
        echo $this->get_elementor_version_notice(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Display minimum PHP version notice (hook callback)
     */
    public function admin_notice_minimum_php_version()
    {
        echo $this->get_php_version_notice(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Get missing Elementor notice HTML
     * 
     * @return string Notice HTML
     */
    private function get_missing_elementor_notice()
    {

        if (!current_user_can('activate_plugins')) {
            return;
        }

        $elementor = 'elementor/elementor.php';

        if (Helper::is_plugin_exists($elementor)) {

            if (is_plugin_active($elementor)) {
                return;
            }

            // Activate Elementor
            $action_url = wp_nonce_url(
                admin_url('plugins.php?action=activate&plugin=' . $elementor),
                'activate-plugin_' . $elementor
            );

            /* translators: 1: Plugin name, 2: Required plugin */
            $message = sprintf(
                esc_html__('%1$sPrime Elementor Addons%2$s requires %1$sElementor%2$s to be active.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                '<strong>',
                '</strong>'
            );

            $button_text = esc_html__('Activate Elementor', 'unlimited-elementor-inner-sections-by-boomdevs');

        } else {

            // Install Elementor
            $action_url = wp_nonce_url(
                self_admin_url('update.php?action=install-plugin&plugin=elementor'),
                'install-plugin_elementor'
            );

            /* translators: 1: Plugin name, 2: Required plugin */
            $message = sprintf(
                esc_html__('%1$sPrime Elementor Addons%2$s requires %1$sElementor%2$s to be installed and activated.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                '<strong>',
                '</strong>'
            );

            $button_text = esc_html__('Install Elementor', 'unlimited-elementor-inner-sections-by-boomdevs');
        }

        /* translators: 1: Notice Message, 2: Url to install/activate elementor, 3: Button Text */
        printf(
            '<div class="notice notice-error" style="position:relative;z-index:999999;"><p>%1$s</p><p><a href="%2$s" class="button-primary">%3$s</a></p></div>',
            wp_kses_post($message),
            esc_url($action_url),
            esc_html($button_text)
        );
    }

    /**
     * Get minimum Elementor version notice HTML
     * 
     * @return string Notice HTML
     */
    private function get_elementor_version_notice()
    {
        /* translators: 1: Plugin name Prime Elementor Addons, 2: Required plugin Elementor, 3: Required plugin version */
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            '<strong>' . esc_html__('Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'unlimited-elementor-inner-sections-by-boomdevs') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        return sprintf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post($message)
        );
    }

    /**
     * Get minimum PHP version notice HTML
     * 
     * @return string Notice HTML
     */
    private function get_php_version_notice()
    {
        /* translators: 1: Plugin name, 2: PHP, 3: Required PHP minimum version */
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            '<strong>' . esc_html__('Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs') . '</strong>',
            '<strong>' . esc_html__('PHP', 'unlimited-elementor-inner-sections-by-boomdevs') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        return sprintf(
            '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
            wp_kses_post($message)
        );
    }

    /**
     * Register Widgets
     */
    public function register_widgets($widgets_manager)
    {
        $widgets = WidgetSettings::get_active_widgets();
        ksort($widgets);

        $allwidgets = \PrimeElementorAddons\Config\WidgetList::get_instance()->get_widgets();

        foreach ($widgets as $widgetkey => $widget) {

            // ✅ Skip if widget slug does not exist anymore
            if (!isset($allwidgets[$widgetkey])) {
                continue;
            }

            $widgetType = $allwidgets[$widgetkey]['package'];

            if ($widget == true && $widgetType == 'free') {

                $class_name = $allwidgets[$widgetkey]['class'];
                $class = '\PrimeElementorAddons\Widgets\\' . $class_name;

                if (class_exists($class)) {
                    $widgets_manager->register(new $class());
                }

            } elseif ($widget == true && $widgetType == 'pro' && PEA_IS_PRO_ACTIVE == true && defined('PEA_PRO_LICENSE_ACTIVE') && PEA_PRO_LICENSE_ACTIVE == true) {

                $class_name = $allwidgets[$widgetkey]['class'];
                $class = '\PrimeElementorAddonsPro\Widgets\\' . $class_name;

                if (class_exists($class)) {
                    $widgets_manager->register(new $class());
                }
            }
        }
    }
    
    public function register_custom_controls($controls_manager)
    {
        $controls_manager->register(new \PrimeElementorAddons\Controls\SortableMultiSelectControl());
        if ( ! \Elementor\Plugin::$instance->controls_manager->get_control_groups( \PrimeElementorAddons\Controls\GradientControl::get_type() ) ) {
            \Elementor\Plugin::$instance->controls_manager->add_group_control(
                \PrimeElementorAddons\Controls\GradientControl::get_type(),
                new \PrimeElementorAddons\Controls\GradientControl()
            );
        }
    }

    /**
     * Register Widget Categories
     */
    public function register_prime_elementor_addons_category($elements_manager)
    {
        $categories['prime-elementor-addons'] = [
            'title' => esc_html__('Prime Elementor Addons', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'icon' => 'fa fa-plug',
        ];

        $el_categories = $elements_manager->get_categories();
        $categories = array_merge(
            array_slice($el_categories, 0, 1),
            $categories,
            array_slice($el_categories, 1)
        );

        $set_categories = function ($categories) {
            $this->categories = $categories;
        };

        $set_categories->call($elements_manager, $categories);
    }

    /**
     * Enqueue Widget Styles
     */
    public function enqueue_widget_styles()
    {
        // Register prismcss as a shared dependency for Code Snippet .
        wp_register_style(
            'prismjs',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css',
            [],
            '1.29.0'
        );
        wp_register_style(
            'prismjs-line-numbers',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css',
            ['prismjs'],
            '1.29.0'
        );
        wp_register_style(
            'prismjs-line-highlight',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-highlight/prism-line-highlight.min.css',
            ['prismjs'],
            '1.29.0'
        );
        
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
            'post-category',
            'product-grid',
            'advanced-video',
            'breadcrumb',
            'rive-animation',
            'lottie-animation',
            'progress-bar',
            'advanced-accordion',
            'icon-box',
            'advanced-tabs',
            'advanced-menu',
            'breadcrumb',
            'advanced-google-maps',
            'table-of-contents',
            'advanced-paragraph',
            'advanced-search',
            'animated-heading',
            'business-hours',
            'advanced-slider',
            'marquee-carousel',
            'news-ticker',
            'back-to-top',
            'post-share-icons',
            'post-navigation',
            'post-meta',
            'post-author',
            'post-comment',
            'template',
            'pdf-viewer',

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
        wp_register_style(
            'prime-elementor-addons-swiper',
            PEA_PLUGIN_URL . 'assets/css/swiper-bundle.min.css',
            [],
            PEA_VERSION
        );

        // Code Snippet
        wp_register_style(
            'prime-elementor-addons--code-snippet',
            PEA_PLUGIN_URL . 'assets/css/widgets/code-snippet.css',
            ['prismjs', 'prismjs-line-numbers', 'prismjs-line-highlight'],
            PEA_VERSION
        );
    }

    /**
     * Enqueue Widget Scripts
     */
    public function enqueue_widget_scripts()
    {
        $widgets = [
            'image-gallery',
            'counter',
            'count-down',
            'post-grid',
            'product-grid',
            'advanced-search',
            'advanced-video',
            'rive-animation',
            'lottie-animation',
            'progress-bar',
            'advanced-accordion',
            'advanced-tabs',
            'advanced-menu',
            'table-of-contents',
            'post-category',
            'animated-heading',
            'business-hours',
            'advanced-slider',
            'marquee-carousel',
            'news-ticker',
            'back-to-top',
            'template',
            'pdf-viewer',
            "code-snippet",
            // add all your widgets here
        ];

        // Register PDF.js library (3.11.174) as shared dependency for pdf-viewer widget
        wp_register_script(
            'pdfjs-lib',
            PEA_PLUGIN_URL . 'assets/lib/pdf/pdf.min.js',
            [],
            '3.11.174',
            true
        );

        // Register prismjs as a shared dependency for code snippet widget.
        wp_register_script(
            'prismjs',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js',
            [],
            '1.29.0',
            true
        );
        wp_register_script(
            'prismjs-autoloader',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js',
            ['prismjs'],
            '1.29.0',
            true
        );
        wp_register_script(
            'prismjs-line-numbers',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js',
            ['prismjs'],
            '1.29.0',
            true
        );
        wp_register_script(
            'prismjs-line-highlight',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-highlight/prism-line-highlight.min.js',
            ['prismjs'],
            '1.29.0',
            true
        );

        $rive_runtime_local_path = PEA_PLUGIN_PATH . 'assets/js/vendor/rive.min.js';
        $rive_runtime_wasm_path = PEA_PLUGIN_PATH . 'assets/js/vendor/rive.wasm';
        $rive_runtime_fallback_wasm_path = PEA_PLUGIN_PATH . 'assets/js/vendor/rive_fallback.wasm';
        $rive_runtime_local_url = PEA_PLUGIN_URL . 'assets/js/vendor/rive.min.js';
        $rive_runtime_version = '2.35.0';
        $rive_runtime_registered = false;
        $lottie_runtime_local_path = PEA_PLUGIN_PATH . 'assets/js/vendor/lottie.min.js';
        $lottie_runtime_local_url = PEA_PLUGIN_URL . 'assets/js/vendor/lottie.min.js';
        $lottie_runtime_version = '5.12.2';
        $lottie_runtime_registered = false;

        if (
            file_exists($rive_runtime_local_path) &&
            file_exists($rive_runtime_wasm_path) &&
            file_exists($rive_runtime_fallback_wasm_path)
        ) {
            wp_register_script(
                'prime-elementor-addons-rive-runtime',
                $rive_runtime_local_url,
                [],
                $rive_runtime_version,
                true
            );
            $rive_runtime_registered = true;
        }

        if (file_exists($lottie_runtime_local_path)) {
            wp_register_script(
                'prime-elementor-addons-lottie-runtime',
                $lottie_runtime_local_url,
                [],
                $lottie_runtime_version,
                true
            );
            $lottie_runtime_registered = true;
        }

        foreach ($widgets as $widget) {
            $dependencies = ['jquery', 'elementor-frontend'];
            if ('product-grid' === $widget && wp_script_is('wc-add-to-cart', 'registered')) {
                $dependencies[] = 'wc-add-to-cart';
            }
            if ('rive-animation' === $widget && $rive_runtime_registered) {
                $dependencies[] = 'prime-elementor-addons-rive-runtime';
            }
            if ('lottie-animation' === $widget && $lottie_runtime_registered) {
                $dependencies[] = 'prime-elementor-addons-lottie-runtime';
            }
            if ($widget === 'code-snippet') {
                $dependencies = ['jquery', 'prismjs', 'prismjs-line-numbers', 'prismjs-line-highlight'];
            }
            if ($widget === 'pdf-viewer') {
                $dependencies[] = 'pdfjs-lib';
            }

            wp_register_script(
                "prime-elementor-addons--{$widget}",
                PEA_PLUGIN_URL . "assets/js/widgets/{$widget}.js",
                $dependencies,
                PEA_VERSION,
                true
            );
        }

        if (wp_script_is('prime-elementor-addons--rive-animation', 'registered')) {
            wp_localize_script(
                'prime-elementor-addons--rive-animation',
                'PeaRiveRuntime',
                [
                    'wasmUrl' => admin_url('admin-ajax.php?action=pea_rive_wasm'),
                ]
            );
        }
        wp_register_script(
            'prime-elementor-addons-jquery-smartmenus',
            PEA_PLUGIN_URL . 'assets/js/jquery.smartmenus.js',
            ['jquery'],
            PEA_VERSION,
            true
        );
        wp_register_script(
            'prime-elementor-addons-swiper',
            PEA_PLUGIN_URL . 'assets/js/swiper-bundle.min.js',
            ['jquery'],
            PEA_VERSION,
            true
        );

        wp_localize_script(
            'prime-elementor-addons--template',
            'peaTemplateData',
            [
                'adminUrl' => admin_url(),
                'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'pea_template_nonce' ),
            ]
        );

        // Code Snippet
        wp_register_script(
            'prime-elementor-addons--code-snippet',
            PEA_PLUGIN_URL . 'assets/js/widgets/code-snippet.js',
            ['jquery', 'prismjs', 'prismjs-line-numbers', 'prismjs-line-highlight', 'prismjs-autoloader'],
            PEA_VERSION,
            true
        );

        wp_localize_script('prime-elementor-addons--code-snippet', 'primeCsConfig', [
            'pluginUrl'     => PEA_PLUGIN_URL,
            'prismCDN'      => 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/',
            'prismLangPath' => 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/',
        ]);
    }

    // method for widget script localization
    public function localize_widget_scripts() {
        wp_localize_script('prime-elementor-addons--post-grid', 'PeaAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('prime_elementor_addons_nonce')
        ]);

        wp_localize_script('prime-elementor-addons--product-grid', 'PeaProductGrid', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('pea_product_grid_nonce'),
            'i18n' => [
                'loading' => esc_html__('Loading...', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'adding' => esc_html__('Processing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'added' => esc_html__('Added', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'error' => esc_html__('Error', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ],
        ]);
    }

    public function product_quick_view()
    {
        if (!check_ajax_referer('pea_product_grid_nonce', 'nonce', false)) {
            wp_send_json_error(['message' => esc_html__('Invalid request.', 'unlimited-elementor-inner-sections-by-boomdevs')]);
        }

        $product_id = absint($_POST['product_id'] ?? 0);
        $product = function_exists('wc_get_product') ? wc_get_product($product_id) : false;

        if (!$product) {
            wp_send_json_error(['message' => esc_html__('Product not found.', 'unlimited-elementor-inner-sections-by-boomdevs')]);
        }

        $categories = wc_get_product_category_list($product_id);
        $average_rating = (float) $product->get_average_rating();
        $rating_count = (int) $product->get_rating_count();
        $rating_width = max(0, min(100, ($average_rating / 5) * 100));
        $description = $product->get_short_description();
        $button_classes = [
            'button',
            'pea-product-grid-cart-button',
            'pea-quick-view-modal__add-to-cart',
            'product_type_' . $product->get_type(),
        ];

        if ($product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock()) {
            $button_classes[] = 'add_to_cart_button';
            $button_classes[] = 'ajax_add_to_cart';
        }

        ob_start();
        ?>
        <div class="pea-quick-view-modal__image">
            <?php echo wp_kses_post($product->get_image('woocommerce_single')); ?>
        </div>
        <div class="pea-quick-view-modal__info">
            <?php if ($categories !== '') : ?>
                <div class="pea-quick-view-modal__category"><?php echo wp_kses_post($categories); ?></div>
            <?php endif; ?>
            <h3 class="pea-quick-view-modal__title"><?php echo esc_html($product->get_name()); ?></h3>
            <?php if ($description !== '') : ?>
                <div class="pea-quick-view-modal__description"><?php echo wp_kses_post(wpautop($description)); ?></div>
            <?php endif; ?>
            <div class="pea-quick-view-modal__price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
            <div class="pea-quick-view-modal__rating">
                <span class="pea-quick-view-modal__rating-stars" aria-hidden="true">
                    <span class="pea-quick-view-modal__rating-stars-base">★★★★★</span>
                    <span class="pea-quick-view-modal__rating-stars-fill" style="width: <?php echo esc_attr((string) $rating_width); ?>%;">★★★★★</span>
                </span>
                <span class="pea-quick-view-modal__rating-count"><?php echo esc_html(sprintf(_n('%s review', '%s reviews', $rating_count, 'unlimited-elementor-inner-sections-by-boomdevs'), number_format_i18n($rating_count))); ?></span>
            </div>
            <div class="pea-quick-view-modal__actions">
                <a
                    href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                    class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $button_classes))); ?>"
                    data-quantity="1"
                    data-product_id="<?php echo esc_attr((string) $product_id); ?>"
                    data-product_sku="<?php echo esc_attr((string) $product->get_sku()); ?>"
                    data-pea-default-text="<?php echo esc_attr($product->add_to_cart_text()); ?>"
                    data-pea-processing-text="<?php echo esc_attr__('Processing', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>"
                    data-pea-added-text="<?php echo esc_attr__('Added', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>"
                    aria-label="<?php echo esc_attr(wp_strip_all_tags($product->add_to_cart_description())); ?>"
                    rel="nofollow"
                ><?php echo esc_html($product->add_to_cart_text()); ?></a>
                <?php echo wp_kses_post(sprintf('<a class="pea-quick-view-modal__view-product" href="%1$s">%2$s</a>', esc_url(get_permalink($product_id)), esc_html__('View Product', 'unlimited-elementor-inner-sections-by-boomdevs'))); ?>
            </div>
        </div>
        <?php

        wp_send_json_success(['html' => ob_get_clean()]);
    }

	function select_testing_content($element) {
        $post_type = get_post_type();
        if ($post_type == 'pea-site-builder') {
            $element->start_controls_section(
                'pea_demo_post_section',
                [
                    'label' => __('Demo Post Section', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );

            $element->add_control(
                'pea_demo_post_id', 
                [
                    'label' => __('Choose Post for Demo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'options' => Helper::demo_post_title_select(),
                ]
            );

            $element->end_controls_section();
 
            $element->start_controls_section(
                'pea_demo_archive_post_section',
                [
                    'label' => __('Demo Archive Section', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );

            $element->add_control(
                'pea_demo_archive_select', 
                [
                    'label' => __('Choose Archive Type for Demo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'options' => [
                        'category' => esc_html__( 'Category', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'tag' => esc_html__( 'Tag', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'author'  => esc_html__( 'Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'date'  => esc_html__( 'Date', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'search'  => esc_html__( 'Search Result', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                ]
            );

            $element->add_control(
                'pea_demo_cat_archive_select', 
                [
                    'label' => __('Choose Category for Archive Post Demo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'options' => Helper::get_categories( $demo = 1 ),
                    'condition' =>[
                        'pea_demo_archive_select' => 'category', 
                    ],
                ]
            );

            $element->add_control(
                'pea_demo_tag_archive_select', 
                [
                    'label' => __('Choose Tag for Archive Post Demo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'options' => Helper::get_tags( $demo = 1 ),
                    'condition' =>[
                        'pea_demo_archive_select' => 'tag', 
                    ],
                ]
            );

            $element->add_control(
                'pea_demo_author_archive_select', 
                [
                    'label' => __('Choose Author for Archive Post Demo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'options' => Helper::get_all_authors( $demo = 0 ),
                    'condition' =>[
                        'pea_demo_archive_select' => 'author', 
                    ],
                ]
            );

            $element->add_control(
                'pea_demo_date_year_archive_select', 
                [
                    'label' => __('Choose Category for Archive Post Demo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label_block' => true,
                    'multiple' => false,
                    'options' => Helper::get_post_years(),
                    'condition' =>[
                        'pea_demo_archive_select' => 'date', 
                    ],
                ]
            );

            $element->add_control(
                'pea_demo_search_result_archive_select', [
                    'label' => __( 'Demo Search', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Hello' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' =>[
                        'pea_demo_archive_select' => 'search', 
                    ],
                ]
            );

            $element->end_controls_section();
        }
    }

    /**
     * Enqueue Editor Scripts
     */
    public function enqueue_editor_scripts()
    {
        wp_enqueue_script(
            'prime-elementor-addons-editor',
            PEA_PLUGIN_URL . 'assets/js/editor/editor.js',
            [
                'jquery',
                'elementor-editor'
            ],
            PEA_VERSION,
            true
        );

        wp_enqueue_script(
            'prime-elementor-addons-editor-advanced-accordion',
            PEA_PLUGIN_URL . 'assets/js/editor/advanced-accordion.js',
            [
                'nested-elements',
                'elementor-editor',
                'elementor-common',
                'wp-element',
                'jquery',
            ],
            PEA_VERSION,
            true
        );

        wp_enqueue_script(
            'prime-elementor-addons-editor-advanced-tabs',
            PEA_PLUGIN_URL . 'assets/js/editor/advanced-tabs.js',
            [
                'nested-elements',
                'elementor-editor',
                'elementor-common',
                'wp-element',
                'jquery',
            ],
            PEA_VERSION,
            true
        );

        wp_enqueue_script(
            'prime-elementor-addons-editor-advanced-slider',
            PEA_PLUGIN_URL . 'assets/js/editor/advanced-slider.js',
            [
                'nested-elements',
                'elementor-editor',
                'elementor-common',
                'wp-element',
                'jquery',
            ],
            PEA_VERSION,
            true
        );

        wp_enqueue_script(
            'prime-elementor-addons-editor-marquee-carousel',
            PEA_PLUGIN_URL . 'assets/js/editor/marquee-carousel.js',
            [
                'nested-elements',
                'elementor-editor',
                'elementor-common',
                'wp-element',
                'jquery',
            ],
            PEA_VERSION,
            true
        );

        wp_enqueue_script(
            'prime-elementor-addons-editor-news-ticker',
            PEA_PLUGIN_URL . 'assets/js/editor/news-ticker.js',
            [
                'nested-elements',
                'elementor-editor',
                'elementor-common',
                'wp-element',
                'jquery',
            ],
            PEA_VERSION,
            true
        );

        wp_enqueue_script(
            'prime-elementor-addons-pro-widget-editor',
            PEA_PLUGIN_URL . 'assets/js/editor/pro-widget-notice.js',
            [
                'jquery',
                'elementor-editor',
                'elementor-common',
            ],
            PEA_VERSION,
            true
        );
			
        wp_enqueue_script('demo-testing', PEA_PLUGIN_URL .'assets/js/editor/demo-testing.js', array('jquery'), '1.0', true);

        wp_localize_script('prime-elementor-addons-editor', 'peaEditor', [
            'pluginUrl' => PEA_PLUGIN_URL,
            'pea_editor_nonce' => wp_create_nonce('pea_editor_only_nonce'),
        ]);
    }

    /**
     * Enqueue Editor Styles
     */
    public function enqueue_editor_style()
    {
        wp_enqueue_style(
            'prime-elementor-addons-editor',
            PEA_PLUGIN_URL . 'assets/css/editor.css',
            [],
            PEA_VERSION
        );
    }

    public function promote_pro_elements($config)
    {

        if (PEA_IS_PRO_ACTIVE) {
            return $config;
        }

        $promotion_widgets = [];

        if (isset($config['promotionWidgets'])) {
            $promotion_widgets = $config['promotionWidgets'];
        }

        $combine_array = array_merge($promotion_widgets, [
            [
                'name' => 'pea_advanced_mega_menu',
                'title' => __('Advanced Mega Menu', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_advanced_mega_menu_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_advanced_offcanvas',
                'title' => __('Advanced Off-Canvas', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_advanced_off_canvas_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_advanced_countdown',
                'title' => __('Advanced Countdown', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_count_down_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_content_table',
                'title' => __('Content Table', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_content_table_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_horizontal_timeline',
                'title' => __('Horizontal Timeline', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_horizontal_timeline_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_post_ticker',
                'title' => __('Post Ticker', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_post_ticker_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_stacked_card',
                'title' => __('Stacked Card', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_stacked_card_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_multicolumn_pricing_table',
                'title' => __('Multicolumn Pricing Table', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_multicolumn_pricing_table_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_advanced_model_popup',
                'title' => __('Advanced Model Popup', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_advanced_model_popup_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_advanced_multichart',
                'title' => __('Advanced Multichart', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_advanced_multichart_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_circle_menu',
                'title' => __('Circle Menu', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_circle_menu_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_pie_chart',
                'title' => __('Pie Chart', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_pie_chart_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_image_hotspot',
                'title' => __('Image Hotspot', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_image_hotspot_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_post_timeline',
                'title' => __('Post Timeline', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_post_timeline_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_woo_product_carousel',
                'title' => __('Woo Product Carousel', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_marquee_carousel_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_advanced_switcher',
                'title' => __('Advanced Switcher', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_advanced_switcher_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_image_comparison',
                'title' => __('Image Comparison', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_image_comparison_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_image_accordion',
                'title' => __('Image Accordion', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_advanced_accordion_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_page_progress_bar',
                'title' => __('Page Progress Bar', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_page_progress_bar_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_post_carousel',
                'title' => __('Post Carousel', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_post_carousel_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_woo_mini_cart',
                'title' => __('Advanced Mini Cart', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_woo_mini_cart_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_vertical_timeline',
                'title' => __('Vertical Timeline', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_post_timeline_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_price_menu',
                'title' => __('Price Menu', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_price_menu_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_price_list',
                'title' => __('Price List', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_price_list_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
            [
                'name' => 'pea_media_carousel',
                'title' => __('Media Carousel', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'icon' => 'pea_marquee_carousel_icon',
                'categories' => '["prime-elementor-addons"]',
            ],
        ]);

        $config['promotionWidgets'] = $combine_array;

        return $config;
    }

    public function rive_and_lottie_support(){
		AnimationFileSupport::get_instance();
    }

    public function svg_support(){
		SupportSvg::get_instance();
    }



    public function taxonomy_image_support(){
		TaxImageSupport::get_instance();
    }
}