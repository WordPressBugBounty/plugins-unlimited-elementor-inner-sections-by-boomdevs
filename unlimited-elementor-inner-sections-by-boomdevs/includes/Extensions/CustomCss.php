<?php

namespace PrimeElementorAddons\Extensions;

use Elementor\Controls_Manager;
use PrimeElementorAddons\Traits\Singleton;

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Global Custom CSS Manager.
 *
 * Registers a Custom CSS control for all Elementor elements
 * and scopes user CSS to the element wrapper before injecting
 * it into the generated stylesheet.
 *
 * @package PrimeElementorAddons
 * @since 1.1.0
 */

class CustomCss {

    use Singleton;

    public function __construct() {

        // Add control to all elements
        add_action(
            'elementor/element/after_section_end',
            [ $this, 'register_custom_css_control' ],
            10,
            2
        );

        // Frontend widget custom CSS injection
        add_action(
            'elementor/element/parse_css',
            [ $this, 'add_element_css' ],
            10,
            2
        );

        // Page-level CSS injection (Page Settings → Advanced → Custom CSS PEA)
        add_action(
            'elementor/css-file/post/parse',
            [ $this, 'add_page_settings_css' ],
            10,
            1
        );

        add_action( 
            'elementor/editor/after_enqueue_scripts', 
            [$this, 'custom_css_script'], 
            5
        );
    }

    /**
     * CSS Processor (Same as your per-widget method)
     */
    private function process_css( $raw_css, $unique_selector ) {

        $css = trim( $raw_css );
        if ( empty( $css ) ) {
            return '';
        }

        // Replace "selector" keyword
        $css = str_replace( 'selector', $unique_selector, $css );

        // Scope all remaining selectors
        $scoped = preg_replace_callback(
            '/([^{]+)\{([^}]*)\}/s',
            function( $matches ) use ( $unique_selector ) {

                $selectors    = trim( $matches[1] );
                $declarations = $matches[2];

                // Skip @ rules (media, keyframes, etc.)
                if ( strpos( $selectors, '@' ) === 0 ) {
                    return $matches[0];
                }

                // Already scoped — leave as-is
                if ( strpos( $selectors, $unique_selector ) !== false ) {
                    return $selectors . '{' . $declarations . '}';
                }

                $all_scoped = [];

                foreach ( explode( ',', $selectors ) as $sel ) {
                    $sel = trim( $sel );
                    if ( empty( $sel ) ) {
                        continue;
                    }

                    // If selector starts with . or # it might be ON the element itself
                    // Generate BOTH: combined (same element) + descendant (child)
                    if ( preg_match( '/^[.#]/', $sel ) ) {
                        $all_scoped[] = $unique_selector . $sel;       // same element: .wrapper.my-class
                        $all_scoped[] = $unique_selector . ' ' . $sel; // child:        .wrapper .my-class
                    } else {
                        // Tag selectors, pseudo-classes etc. — descendant only
                        $all_scoped[] = $unique_selector . ' ' . $sel;
                    }
                }

                return implode( ', ', $all_scoped ) . '{' . $declarations . '}';
            },
            $css
        );

        return $scoped ?? $css;
    }

    /**
     * Add control globally
     */
    public function register_custom_css_control( $element, $section_id ) {

        // Inject after Advanced tab ends
        if ( 'section_custom_css_pro' !== $section_id ) {
            return;
        }

        $element->start_controls_section(
            'pea_custom_css_section',
            [
                'label' => __( 'Custom CSS (PEA)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'pea_custom_css',
            [
                // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
                'label'       => __( '', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::CODE,
                'language'    => 'css',
                'rows'        => 20,
                'label_block' => true,
                'render_type' => 'ui',
            ]
        );

        $element->end_controls_section();
    }

    /**
     * Frontend CSS injection
     */
    public function add_element_css( $post_css, $element ) {

        if ( $post_css instanceof \Elementor\Core\DynamicTags\Dynamic_CSS ) {
            return;
        }

        $document = \Elementor\Plugin::$instance->documents->get(
            $post_css->get_post_id()
        );

        $settings = $element->get_settings();

        if ( empty( $settings['pea_custom_css'] ) ) {
            return;
        }

        $unique_selector = $post_css->get_element_unique_selector( $element );

        $css = $this->process_css(
            $settings['pea_custom_css'],
            $unique_selector
        );

        $post_css->get_stylesheet()->add_raw_css( $css );
    }

    /**
     * Inject PEA Custom CSS from Page Settings into the post stylesheet.
     *
     * Fires when Elementor builds/rebuilds the post-level CSS file.
     *
     * @param \Elementor\Core\Files\CSS\Post $post_css
     */
    public function add_page_settings_css( $post_css ) {

        $document = \Elementor\Plugin::$instance->documents->get( $post_css->get_post_id() );

        if ( ! $document ) {
            return;
        }

        $settings = $document->get_settings();

        if ( empty( $settings['pea_custom_css'] ) ) {
            return;
        }

        // Page wrapper selector
        $unique_selector = '.elementor-page-' . $post_css->get_post_id();

        $css = $this->process_css(
            $settings['pea_custom_css'],
            $unique_selector
        );

        $post_css->get_stylesheet()->add_raw_css( $css );
    }

    
    public function custom_css_script() {        
        // TODO have to give support of templately when templately on custom-css.js dont work correctly
        wp_enqueue_script(
            'prime-elementor-addons-custom-css-editor',
            PEA_PLUGIN_URL . 'assets/js/editor/custom-css.js',
            [
                'jquery',
                'elementor-editor',
            ],
            PEA_VERSION,
            true
        );

    }
}
