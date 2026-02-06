<?php
namespace PrimeElementorAddons\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Modular Gradient Text Control (Reusable Across Widgets)
 *
 * Works like a group control but built from normal controls.
 */
class GradientTextControl {

    /**
     * Returns all the control definitions.
     *
     * @param string $selector  The CSS selector for style output.
     * @param string $prefix    Optional prefix for field names.
     * @param string $label     Optional label for field label.
     */
    public static function get_fields( $selector = '{{WRAPPER}}', $prefix = 'gradient_text', $label = null ) {
        $label = $label ?: esc_html__( 'Gradient Text', 'unlimited-elementor-inner-sections-by-boomdevs' );

        return [

            // ─── Type ───────────────────────────────────────────
            [
                'name' => $prefix . '_type',
                'label' => $label,
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'classic' => [
                        'title' => __( 'Classic', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-paint-brush',
                    ],
                    'gradient' => [
                        'title' => __( 'Gradient', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-barcode',
                    ],
                ],
                'default' => 'classic',
            ],
            // ─── Custom Gradient Switcher ─────────────────────────
            [
                'name' => $prefix . '_custom_gradient_toggle',
                'label' => __( 'Custom Gradient?', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_off' => __( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    $prefix . '_type' => 'gradient',
                ],
            ],

            // ─── Custom Gradient CSS Code ─────────────────────────
            [
                'name' => $prefix . '_custom_gradient',
                'label' => __( 'Custom Gradient CSS', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => 'e.g. linear-gradient(90deg, #f00, #00f)',
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle' => 'yes',
                ],
                'selectors' => [
                    $selector => '-webkit-background-clip: text !important; -webkit-text-fill-color: transparent; background: {{VALUE}};',
                ],
            ],

            // ─── Classic Color ──────────────────────────────────
            [
                'name' => $prefix . '_color',
                'label' => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $selector => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $prefix . '_type' => 'classic',
                ],
            ],

            // ─── Gradient Colors ─────────────────────────────────
            [
                'name' => $prefix . '_color_start',
                'label' => __( 'First Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                ],
            ],
            [
                'name' => $prefix . '_color_start_loc',
                'label' => __( 'Start Location', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [ 'size' => 0, 'unit' => '%' ],
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                ],
            ],
            [
                'name' => $prefix . '_color_end',
                'label' => __( 'Second Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0000ff',
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                ],
            ],
            [
                'name' => $prefix . '_color_end_loc',
                'label' => __( 'End Location', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [ 'size' => 100, 'unit' => '%' ],
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                ],
            ],

            // ─── Gradient Style ─────────────────────────────────
            [
                'name' => $prefix . '_gradient_type',
                'label' => __( 'Gradient Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'linear' => __( 'Linear', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'radial' => __( 'Radial', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ],
                'default' => 'linear',
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                ],
            ],
            [
                'name' => $prefix . '_angle',
                'label' => __( 'Angle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'default' => [ 'size' => 180, 'unit' => 'deg' ],
                'range' => [ 'deg' => [ 'step' => 10 ] ],
                'selectors' => [
                    $selector => 'background: linear-gradient({{SIZE}}{{UNIT}}, {{' . $prefix . '_color_start.VALUE}} {{' . $prefix . '_color_start_loc.SIZE}}{{' . $prefix . '_color_start_loc.UNIT}}, {{' . $prefix . '_color_end.VALUE}} {{' . $prefix . '_color_end_loc.SIZE}}{{' . $prefix . '_color_end_loc.UNIT}});
                                   -webkit-background-clip: text;
                                   -webkit-text-fill-color: transparent;',
                ],
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                    $prefix . '_gradient_type' => 'linear',
                ],
            ],
            [
                'name' => $prefix . '_position',
                'label' => __( 'Radial Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'center center' => __( 'Center Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'top left' => __( 'Top Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'top right' => __( 'Top Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'bottom left' => __( 'Bottom Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'bottom right' => __( 'Bottom Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    $selector => 'background: radial-gradient(at {{VALUE}}, {{' . $prefix . '_color_start.VALUE}} {{' . $prefix . '_color_start_loc.SIZE}}{{' . $prefix . '_color_start_loc.UNIT}}, {{' . $prefix . '_color_end.VALUE}} {{' . $prefix . '_color_end_loc.SIZE}}{{' . $prefix . '_color_end_loc.UNIT}});
                                   -webkit-background-clip: text;
                                   -webkit-text-fill-color: transparent;',
                ],
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                    $prefix . '_gradient_type' => 'radial',
                ],
            ],
            [
                'name' => $prefix . '_hr',
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    $prefix . '_type' => 'gradient',
                    $prefix . '_custom_gradient_toggle!' => 'yes',
                ],
            ]
        ];
    }

    /**
     * Helper method — directly add all sub-controls into a widget.
     */
    public static function add_control( $widget, $args = [] ) {
        $selector = $args['selector'] ?? '{{WRAPPER}}';
        $prefix   = $args['name'] ?? 'gradient_text';
        $fields   = self::get_fields( $selector, $prefix );

        foreach ( $fields as $field ) {
            $widget->add_control( $field['name'], $field );
        }
    }
}