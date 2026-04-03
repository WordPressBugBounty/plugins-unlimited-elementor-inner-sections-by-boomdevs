<?php

namespace PrimeElementorAddons\Utils;

use Elementor\Controls_Manager;

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

class WidgetCustomCss {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {

        // Add control to all elements
        add_action(
            'elementor/element/after_section_end',
            [ $this, 'register_custom_css_control' ],
            10,
            2
        );

        // Frontend CSS injection
        add_action(
            'elementor/element/parse_css',
            [ $this, 'add_element_css' ],
            10,
            2
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

                $selectors    = $matches[1];
                $declarations = $matches[2];

                // Already scoped
                if ( strpos( $selectors, $unique_selector ) !== false ) {
                    return $selectors . '{' . $declarations . '}';
                }

                $scoped_selectors = array_map(
                    function( $sel ) use ( $unique_selector ) {
                        $sel = trim( $sel );
                        return $unique_selector . ' ' . $sel;
                    },
                    explode( ',', $selectors )
                );

                return implode( ', ', $scoped_selectors ) . '{' . $declarations . '}';
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

        $settings = $element->get_settings_for_display();

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
}
