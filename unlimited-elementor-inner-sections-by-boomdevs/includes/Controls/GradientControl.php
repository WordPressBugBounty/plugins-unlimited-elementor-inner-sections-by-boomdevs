<?php
namespace PrimeElementorAddons\Controls;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Prime Elementor Addons Gradient Background Group Control
 *
 * Enhanced UX: Single color OR Gradient toggle with conditional fields,
 * matching Elementor's native background control pattern.
 *
 * @since 1.3.3
 */
class GradientControl extends Group_Control_Base {

    protected static $fields;

    public static function get_type() {
        return 'pea_gradient';
    }

    /**
     * Init fields with improved UX flow.
     */
    public function init_fields() {

        // ── Responsive device args ────────────────────────────────────────────
        $location_device_args = [];
        $angle_device_args    = [];
        $position_device_args = [];

        $active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();
        foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
            $location_device_args[ $breakpoint_name ] = [ 'default' => [ 'unit' => '%' ] ];
            $angle_device_args[ $breakpoint_name ]    = [ 'default' => [ 'unit' => 'deg' ] ];
            $position_device_args[ $breakpoint_name ] = [ 'default' => 'center center' ];
        }

        $fields = [];

        // ── TYPE PICKER: Single vs Gradient ───────────────────────────────────
        $fields['background'] = [
            'label'       => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::CHOOSE,
            'options'     => [
                'single'   => [
                    'title' => esc_html__( 'Single', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'icon'  => 'eicon-paint-brush', // Solid color icon
                ],
                'gradient' => [
                    'title' => esc_html__( 'Gradient', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'icon'  => 'eicon-barcode',      // Gradient icon
                ],
            ],
            'default'     => 'single',
            'render_type' => 'ui',
            'prefix_class'=> 'pea-gradient-type-',
        ];

        // ── SINGLE COLOR (shows when background = single) ─────────────────────
        $fields['color'] = [
            'label'       => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::COLOR,
            'default'     => '',
            'render_type' => 'ui',
            'selectors'   => [
                '{{SELECTOR}}' => 'background-color: {{VALUE}};',
            ],
        ];

        // Color 1 location (for gradient)
        $fields['color_stop'] = [
            'label'       => esc_html_x( 'Location', 'Gradient Control', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ '%', 'custom' ],
            'default'     => [ 'unit' => '%', 'size' => 0 ],
            'device_args' => $location_device_args,
            'responsive'  => true,
            'render_type' => 'ui',
            'condition'   => [
                'background' => 'gradient',
            ],
        ];

        // ── Second Color ──────────────────────────────────────────────────────
        $fields['color_b'] = [
            'label'       => esc_html__( 'Second Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::COLOR,
            'default'     => '',
            'render_type' => 'ui',
            'condition'   => [
                'background' => 'gradient',
            ],
        ];

        $fields['color_b_stop'] = [
            'label'       => esc_html_x( 'Location', 'Gradient Control', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ '%', 'custom' ],
            'default'     => [ 'unit' => '%', 'size' => 100 ],
            'device_args' => $location_device_args,
            'responsive'  => true,
            'render_type' => 'ui',
            'condition'   => [
                'background' => 'gradient',
            ],
        ];

        // ── GRADIENT SECTION (shows only when background = gradient) ─────────

        $fields['gradient_type'] = [
            'label'       => esc_html_x( 'Gradient Type', 'Control', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::SELECT,
            'options'     => [
                'linear' => esc_html__( 'Linear', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'radial'  => esc_html__( 'Radial', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
            'default'     => 'linear',
            'render_type' => 'ui',
            'condition'   => [
                'background' => 'gradient',
            ],
        ];

        // ── Linear Gradient: Angle ────────────────────────────────────────────
        $fields['gradient_angle'] = [
            'label'       => esc_html__( 'Angle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
            'default'     => [ 'unit' => 'deg', 'size' => 180 ],
            'device_args' => $angle_device_args,
            'responsive'  => true,
            'render_type' => 'ui',
            'selectors'   => [
                '{{SELECTOR}}' => 'background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}});',
            ],
            'condition'   => [
                'background'    => 'gradient',
                'gradient_type' => 'linear',
            ],
        ];

        // ── Radial Gradient: Position ─────────────────────────────────────────
        $fields['gradient_position'] = [
            'label'       => esc_html__( 'Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::SELECT,
            'options'     => [
                'center center' => esc_html__( 'Center Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'center left'   => esc_html__( 'Center Left',   'unlimited-elementor-inner-sections-by-boomdevs' ),
                'center right'  => esc_html__( 'Center Right',  'unlimited-elementor-inner-sections-by-boomdevs' ),
                'top center'    => esc_html__( 'Top Center',    'unlimited-elementor-inner-sections-by-boomdevs' ),
                'top left'      => esc_html__( 'Top Left',      'unlimited-elementor-inner-sections-by-boomdevs' ),
                'top right'     => esc_html__( 'Top Right',     'unlimited-elementor-inner-sections-by-boomdevs' ),
                'bottom center' => esc_html__( 'Bottom Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'bottom left'   => esc_html__( 'Bottom Left',   'unlimited-elementor-inner-sections-by-boomdevs' ),
                'bottom right'  => esc_html__( 'Bottom Right',  'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
            'default'     => 'center center',
            'device_args' => $position_device_args,
            'responsive'  => true,
            'render_type' => 'ui',
            'selectors'   => [
                '{{SELECTOR}}' => 'background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}});',
            ],
            'condition'   => [
                'background'    => 'gradient',
                'gradient_type' => 'radial',
            ],
        ];

        return $fields;
    }

    // ── Filtering ─────────────────────────────────────────────────────────────
    protected function filter_fields() {
        $fields = parent::filter_fields();
        $args   = $this->get_args();

        foreach ( $fields as $key => &$field ) {
            if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'] ?? [], true ) ) {
                unset( $fields[ $key ] );
            }
        }
        unset( $field );

        return $fields;
    }

    // ── Default Args ──────────────────────────────────────────────────────────
    protected function get_child_default_args() {
        return [
            'types'    => [ 'single', 'gradient' ],
            'selector' => '{{WRAPPER}}',
        ];
    }

    protected function get_default_options() {
        return [ 'popover' => false ];
    }

    // ── Optional: Helper for gradient type icons ─────────────────────────────
    public static function get_gradient_types() {
        return [
            'single'   => [
                'title' => esc_html__( 'Single', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'icon'  => 'eicon-paint-brush',
            ],
            'gradient' => [
                'title' => esc_html__( 'Gradient', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'icon'  => 'eicon-barcode',
            ],
        ];
    }
}