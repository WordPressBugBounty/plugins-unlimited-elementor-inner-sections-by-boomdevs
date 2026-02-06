<?php
namespace PrimeElementorAddons\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Modular Text Stroke Control (Reusable Across Widgets)
 *
 * Uses Elementor popover for better grouping.
 */
class TextStrokeControl {

    /**
     * Returns all the control definitions.
     *
     * @param string $selector The CSS selector for style output.
     * @param string $prefix   Optional prefix for field names.
     */
    public static function get_fields( $selector = '{{WRAPPER}}', $prefix = 'text_stroke', $label = null ) {
        
        return [

            // ─── Stroke Color ────────────────────────────────
            [
                'name' => $prefix . '_color',
                'label' => __( 'Stroke Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $selector => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    $prefix . '_popover_toggle' => 'yes', // show only when popover is open
                ],
            ],

            // ─── Stroke Width ────────────────────────────────
            [
                'name' => $prefix . '_width',
                'label' => __( 'Stroke Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'range'           => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    $selector => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . '_popover_toggle' => 'yes',
                ],
            ],

            // ─── Stroke Style (Optional) ─────────────────────
            [
                'name' => $prefix . '_style',
                'label' => __( 'Stroke Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'dashed' => __( 'Dashed', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'dotted' => __( 'Dotted', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    $selector => '-webkit-text-stroke: {{text_stroke_width.SIZE}}{{text_stroke_width.UNIT}} {{VALUE}} {{text_stroke_color.VALUE}};',
                ],
                'condition' => [
                    $prefix . '_popover_toggle' => 'yes',
                ],
            ],
        ];
    }

    /**
     * Helper method — directly add all sub-controls into a widget.
     */
    public static function add_control( $widget, $args = [] ) {
        $selector = $args['selector'] ?? '{{WRAPPER}}';
        $prefix   = $args['name'] ?? 'text_stroke';
        $label = $args['label'] ?: esc_html__( 'Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs' );
        $fields   = self::get_fields( $selector, $prefix );
        

		$widget->add_control(
			 $prefix . '_popover_toggle',
			[
				'label' => $label,
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $widget->start_popover();
            foreach ( $fields as $field ) {
                $widget->add_control( $field['name'], $field );
            }
        $widget->end_popover();
    }
}