<?php

namespace PrimeElementorAddons\Extensions;

use PrimeElementorAddons\Traits\Singleton;
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

class StickySection {
    
    use Singleton;

    public function __construct() {

        // Register controls on sections, columns, and containers
        add_action( 'elementor/element/section/section_advanced/after_section_end',  [ $this, 'register_controls' ], 10, 2 );
        add_action( 'elementor/element/column/section_advanced/after_section_end',   [ $this, 'register_controls' ], 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end',  [ $this, 'register_controls' ], 10, 2 );

        // Inject data attributes into rendered HTML
        add_action( 'elementor/frontend/section/before_render',   [ $this, 'before_render' ] );
        add_action( 'elementor/frontend/column/before_render',    [ $this, 'before_render' ] );
        add_action( 'elementor/frontend/container/before_render', [ $this, 'before_render' ] );

        // Enqueue frontend assets
        //    add_action( 'elementor/editor/after_enqueue_scripts',   [ $this, 'enqueue_editor_assets' ] );
        //    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    /**
     * Register all sticky controls in the Advanced tab.
     */
    public function register_controls( Element_Base $element, array $args ) {

        $element->start_controls_section( 'pea_sticky_section', [
            'label' => esc_html__( 'Sticky Section (PEA)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_ADVANCED,
        ] );

        // ── Enable Sticky ─────────────────────────────────────────
        $element->add_control( 'pea_sticky_enable', [
            'label'        => esc_html__( 'Enable Sticky', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'label_off'    => esc_html__( 'No',  'unlimited-elementor-inner-sections-by-boomdevs' ),
            'return_value' => 'yes',
            'default'      => '',
            'render_type'  => 'none',
            'frontend_available' => true,
        ] );

        // ── Sticky Position ───────────────────────────────────────
        $element->add_control( 'pea_sticky_position', [
            'label'   => esc_html__( 'Sticky Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'top',
            'options' => [
                'top'    => esc_html__( 'Top',    'unlimited-elementor-inner-sections-by-boomdevs' ),
                // 'bottom' => esc_html__( 'Bottom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'column' => esc_html__( 'Column (Follows scroll within parent)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
            'description'        => esc_html__( 'Top: sticks to the top of the viewport. Bottom: sticks to the bottom. Column: sticks within its parent column while scrolling.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        // ── Sticky Offset ─────────────────────────────────────────
        $element->add_control( 'pea_sticky_offset', [
            'label'              => esc_html__( 'Sticky Offset (px)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SLIDER,
            'size_units'         => [ 'px' ],
            'range'              => [ 'px' => [ 'min' => 0, 'max' => 300, 'step' => 1 ] ],
            'default'            => [ 'size' => 0, 'unit' => 'px' ],
            'description'        => esc_html__( 'Gap in pixels between the element and the viewport edge when sticky.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        // ── Sticky Until ─────────────────────────────────────────
        $element->add_control( 'pea_sticky_until', [
            'label'              => esc_html__( 'Sticky Until (CSS ID)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::TEXT,
            'placeholder'        => '#footer',
            'description'        => esc_html__( 'Enter a CSS ID (e.g. #footer). The sticky behaviour stops when this element enters the viewport. Useful to prevent overlapping footers.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'condition'          => [ 'pea_sticky_enable' => 'yes', 'pea_sticky_position' => 'top' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        // ── Entrance Animation ───────────────────────────────────
        $element->add_control( 'pea_sticky_animation', [
            'label'   => esc_html__( 'Entrance Animation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                'none'       => esc_html__( 'None',       'unlimited-elementor-inner-sections-by-boomdevs' ),
                'fade'       => esc_html__( 'Fade In',    'unlimited-elementor-inner-sections-by-boomdevs' ),
                'slide-down' => esc_html__( 'Slide Down', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'slide-up'   => esc_html__( 'Slide Up',   'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
            'description'        => esc_html__( 'Animation that plays when the element becomes sticky.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_animation_duration', [
            'label'              => esc_html__( 'Animation Duration (ms)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SLIDER,
            'range'              => [ 'px' => [ 'min' => 100, 'max' => 2000, 'step' => 50 ] ],
            'default'            => [ 'size' => 400 ],
            'condition'          => [ 'pea_sticky_enable' => 'yes', 'pea_sticky_animation!' => 'none' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        // ── Background Change ────────────────────────────────────
        $element->add_control( 'pea_sticky_bg_heading', [
            'label'     => esc_html__( 'Background Change', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [ 'pea_sticky_enable' => 'yes' ],
        ] );

        $element->add_control( 'pea_sticky_bg_enable', [
            'label'              => esc_html__( 'Change Background when Sticky', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SWITCHER,
            'label_on'           => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'label_off'          => esc_html__( 'No',  'unlimited-elementor-inner-sections-by-boomdevs' ),
            'return_value'       => 'yes',
            'default'            => '',
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_bg_color', [
            'label'              => esc_html__( 'Sticky Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::COLOR,
            'default'            => '#ffffff',
            'condition'          => [ 'pea_sticky_enable' => 'yes', 'pea_sticky_bg_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_transition_duration', [
            'label'              => esc_html__( 'Transition Duration (ms)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SLIDER,
            'range'              => [ 'px' => [ 'min' => 0, 'max' => 1000, 'step' => 50 ] ],
            'default'            => [ 'size' => 300 ],
            'condition'          => [ 'pea_sticky_enable' => 'yes', 'pea_sticky_bg_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_shadow_enable', [
            'label'              => esc_html__( 'Add Box Shadow when Sticky', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SWITCHER,
            'return_value'       => 'yes',
            'default'            => '',
            'condition'          => [ 'pea_sticky_enable' => 'yes', 'pea_sticky_bg_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_shadow_color', [
            'label'              => esc_html__( 'Shadow Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::COLOR,
            'default'            => 'rgba(0,0,0,0.12)',
            'condition'          => [ 'pea_sticky_enable' => 'yes', 'pea_sticky_bg_enable' => 'yes', 'pea_sticky_shadow_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        // ── Device Control ───────────────────────────────────────
        $element->add_control( 'pea_sticky_devices_heading', [
            'label'     => esc_html__( 'Device Control', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [ 'pea_sticky_enable' => 'yes' ],
        ] );

        $element->add_control( 'pea_sticky_on_desktop', [
            'label'              => esc_html__( 'Sticky on Desktop', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SWITCHER,
            'label_on'           => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'label_off'          => esc_html__( 'No',  'unlimited-elementor-inner-sections-by-boomdevs' ),
            'return_value'       => 'yes',
            'default'            => 'yes',
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_on_tablet', [
            'label'              => esc_html__( 'Sticky on Tablet', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SWITCHER,
            'label_on'           => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'label_off'          => esc_html__( 'No',  'unlimited-elementor-inner-sections-by-boomdevs' ),
            'return_value'       => 'yes',
            'default'            => 'yes',
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->add_control( 'pea_sticky_on_mobile', [
            'label'              => esc_html__( 'Sticky on Mobile', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'               => Controls_Manager::SWITCHER,
            'label_on'           => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'label_off'          => esc_html__( 'No',  'unlimited-elementor-inner-sections-by-boomdevs' ),
            'return_value'       => 'yes',
            'default'            => 'yes',
            'condition'          => [ 'pea_sticky_enable' => 'yes' ],
            'render_type'        => 'none',
            'frontend_available' => true,
        ] );

        $element->end_controls_section();
    }

    /**
     * Inject data attributes before an element renders on the frontend.
     * JS reads these to configure sticky behaviour per element.
     */
    public function before_render( Element_Base $element ) {
        $settings = $element->get_settings_for_display();

        if ( empty( $settings['pea_sticky_enable'] ) || 'yes' !== $settings['pea_sticky_enable'] ) {
            return;
        }

        $offset   = isset( $settings['pea_sticky_offset']['size'] ) ? (int) $settings['pea_sticky_offset']['size'] : 0;
        $anim_dur = isset( $settings['pea_sticky_animation_duration']['size'] ) ? (int) $settings['pea_sticky_animation_duration']['size'] : 400;
        $trans    = isset( $settings['pea_sticky_transition_duration']['size'] ) ? (int) $settings['pea_sticky_transition_duration']['size'] : 300;

        $config = [
            'enabled'    => true,
            'position'   => $settings['pea_sticky_position'] ?? 'top',
            'offset'     => $offset,
            'until'      => sanitize_text_field( $settings['pea_sticky_until'] ?? '' ),
            'animation'  => $settings['pea_sticky_animation'] ?? 'none',
            'animDuration' => $anim_dur,
            'bgEnable'   => ( 'yes' === ( $settings['pea_sticky_bg_enable'] ?? '' ) ),
            'bgColor'    => sanitize_hex_color( $settings['pea_sticky_bg_color'] ?? '#ffffff' ) ?: 'rgba(255,255,255,1)',
            'transition' => $trans,
            'shadowEnable' => ( 'yes' === ( $settings['pea_sticky_shadow_enable'] ?? '' ) ),
            'shadowColor'  => $settings['pea_sticky_shadow_color'] ?? 'rgba(0,0,0,0.12)',
            'desktop'    => 'yes' === ( $settings['pea_sticky_on_desktop'] ?? 'yes' ),
            'tablet'     => 'yes' === ( $settings['pea_sticky_on_tablet']  ?? 'yes' ),
            'mobile'     => 'yes' === ( $settings['pea_sticky_on_mobile']  ?? 'yes' ),
        ];

        $element->add_render_attribute( '_wrapper', [
            'data-pea-sticky' => wp_json_encode( $config ),
            'class'           => 'pea-sticky-element',
        ] );
    }

    /**
     * Enqueue frontend JS + CSS.
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'prime-elementor-addons--sticky-section',
            PEA_PLUGIN_URL . 'assets/css/extension/sticky-section.css',
            [],
            PEA_VERSION
        );

        wp_enqueue_script(
            'prime-elementor-addons--sticky-section',
            PEA_PLUGIN_URL . 'assets/js/extension/sticky-section.js',
            [ 'jquery',],
            PEA_VERSION,
            true
        );
    }

    /**
     * Enqueue in editor too so sticky works in preview mode.
     */
    public function enqueue_editor_assets() {
        wp_enqueue_style(
            'prime-elementor-addons--sticky-section',
            PEA_PLUGIN_URL . 'assets/css/extension/sticky-section.css',
            [],
            PEA_VERSION
        );
        wp_enqueue_script(
            'prime-elementor-addons--sticky-section',
            PEA_PLUGIN_URL . 'assets/js/extension/sticky-section.js',
            [ 'jquery',],
            PEA_VERSION,
            true
        );
    }
}