<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class AdvancedSearch extends Widget_Base {

	/*
	|--------------------------------------------------------------------------
	| Widget Setup
	|--------------------------------------------------------------------------
	*/
	public function get_name() {
		return 'pea_advanced_search';
	}

	public function get_title() {
		return esc_html__( 'Advanced Search', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_icon() {
		return 'pea_advanced_search_icon';
	}

	public function get_keywords() {
		return [ 'search', 'advanced', 'form', 'input' ];
	}

	public function get_style_depends() {
		return [ 'prime-elementor-addons--advanced-search' ];
	}

	public function get_script_depends() {
		return [ 'prime-elementor-addons--advanced-search' ];
	}

	protected function register_controls() {
		/*
		|--------------------------------------------------------------------------
		| General
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_general_section',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'search_style_preset',
			[
				'label' => esc_html__( 'Preset', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'preset-1',
				'options' => [
					'preset-1' => esc_html__( 'Preset 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'custom' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$this->add_control(
			'search_appearance_mode',
			[
				'label' => esc_html__( 'Layout Behavior', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'focus-expand' => esc_html__( 'Expand on Focus', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Search Query
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_query_section',
			[
				'label' => esc_html__( 'Search Query', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'show_search_placeholder',
			[
				'label' => esc_html__( 'Show Placeholder', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'search_placeholder',
			[
				'label' => esc_html__( 'Placeholder', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Search...', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' => [
					'show_search_placeholder' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_search_placeholder_icon',
			[
				'label' => esc_html__( 'Show Placeholder Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_search_placeholder' => 'yes',
				],
			]
		);

		$this->add_control(
			'search_placeholder_icon',
			[
				'label' => esc_html__( 'Placeholder Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'search_placeholder_icon_fa4',
				'condition' => [
					'show_search_placeholder' => 'yes',
					'show_search_placeholder_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_search_button',
			[
				'label' => esc_html__( 'Show Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_search_button_text',
			[
				'label' => esc_html__( 'Show Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_search_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'search_button_text',
			[
				'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Search', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' => [
					'show_search_button' => 'yes',
					'show_search_button_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'search_button_icon_type',
			[
				'label' => esc_html__( 'Button Icon Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'icon' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'svg' => esc_html__( 'SVG', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'image' => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'lottie' => esc_html__( 'Lottie Animation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'condition' => [
					'show_search_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'search_button_icon',
			[
				'label' => esc_html__( 'Button Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'search_button_icon_fa4',
				'condition' => [
					'show_search_button' => 'yes',
					'search_button_icon_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'search_button_icon_media',
			[
				'label' => esc_html__( 'Icon Media', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'show_search_button' => 'yes',
					'search_button_icon_type' => [ 'svg', 'image' ],
				],
			]
		);

		$this->add_control(
			'search_button_lottie_file',
			[
				'label' => esc_html__( 'Lottie JSON File', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [ 'application' ],
				'description' => esc_html__( 'Choose a local .json file from Media Library.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
					'show_search_button' => 'yes',
					'search_button_icon_type' => 'lottie',
				],
			]
		);

		$this->add_control(
			'show_search_dropdown',
			[
				'label' => esc_html__( 'Show Dropdown', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'search_results_count',
			[
				'label' => esc_html__( 'Results Count', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
				'max' => 20,
			]
		);

		$this->add_control(
			'search_no_results_text',
			[
				'label' => esc_html__( 'No Results Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'No results found.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'show_view_all_link',
			[
				'label' => esc_html__( 'Show View All Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'search_view_all_text',
			[
				'label' => esc_html__( 'View All Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'View All Results', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' => [
					'show_view_all_link' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Layout
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_layout_style_section',
			[
				'label' => esc_html__( 'Layout', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'search_alignment',
			[
				'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::CHOOSE,
				'prefix_class' => 'pea-advanced-search-align-',
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-left',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-start',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-form' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Input
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_input_style_section',
			[
				'label' => esc_html__( 'Search Field', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_search_input_typography',
				'selector' => '{{WRAPPER}} .pea-advanced-search-input',
			]
		);

		$this->add_control(
			'advanced_search_input_color',
			[
				'label' => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'advanced_search_input_placeholder_color_heading',
			[
				'label' => esc_html__( 'Placeholder Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_input_placeholder_color_tabs' );

		$this->start_controls_tab(
			'advanced_search_input_placeholder_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_input_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_input_placeholder_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_input_placeholder_hover_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input:hover::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'advanced_search_placeholder_icon_color_heading',
			[
				'label' => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_placeholder_icon_color_tabs' );

		$this->start_controls_tab(
			'advanced_search_placeholder_icon_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_placeholder_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-wrapper' => '--pea-advanced-search-preset-placeholder-color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon i::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_placeholder_icon_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_placeholder_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input-wrap:hover .pea-advanced-search-placeholder-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-input-wrap:hover .pea-advanced-search-placeholder-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-input-wrap:hover .pea-advanced-search-placeholder-icon i::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-input-wrap:hover .pea-advanced-search-placeholder-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-input-wrap:hover .pea-advanced-search-placeholder-icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_placeholder_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
					'rem' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pea-advanced-search-placeholder-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advanced_search_input_box_shadow',
				'selector' => '{{WRAPPER}} .pea-advanced-search-input',
			]
		);

		$this->add_control(
			'advanced_search_input_background_heading',
			[
				'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_input_background_tabs' );

		$this->start_controls_tab(
			'advanced_search_input_background_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_input_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-input',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_input_background_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_input_hover_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-input:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_input_width',
			[
				'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input-wrap' => 'width: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_input_height',
			[
				'label' => esc_html__( 'Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					],
					'rem' => [
						'min' => 0,
						'max' => 20,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_input_padding',
			[
				'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_input_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-input',
			]
		);

		$this->add_control(
			'advanced_search_input_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_input_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Button
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_button_style_section',
			[
				'label' => esc_html__( 'Search Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_search_button_typography',
				'selector' => '{{WRAPPER}} .pea-advanced-search-button',
			]
		);

		$this->add_control(
			'advanced_search_button_style_heading',
			[
				'label' => esc_html__( 'Button Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_button_style_tabs' );

		$this->start_controls_tab(
			'advanced_search_button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'advanced_search_button_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-button-icon i::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-button-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-button-icon svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-button-lottie' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_button_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
					'rem' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pea-advanced-search-button-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pea-advanced-search-button-icon img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pea-advanced-search-button-lottie' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advanced_search_button_box_shadow',
				'selector' => '{{WRAPPER}} .pea-advanced-search-button',
			]
		);

		$this->add_control(
			'advanced_search_button_background_heading',
			[
				'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_button_background_tabs' );

		$this->start_controls_tab(
			'advanced_search_button_background_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_button_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_button_background_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_button_hover_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_button_width',
			[
				'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_button_height',
			[
				'label' => esc_html__( 'Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					],
					'rem' => [
						'min' => 0,
						'max' => 20,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_button_padding',
			[
				'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_button_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-button',
			]
		);

		$this->add_control(
			'advanced_search_button_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Dropdown
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_dropdown_style_section',
			[
				'label' => esc_html__( 'Dropdown Area', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'advanced_search_dropdown_scroll',
			[
				'label' => esc_html__( 'Result Scroll', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'advanced_search_dropdown_height',
			[
				'label' => esc_html__( 'Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-response.has-result-scroll' => 'max-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'advanced_search_dropdown_scroll' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advanced_search_dropdown_box_shadow',
				'selector' => '{{WRAPPER}} .pea-advanced-search-response',
			]
		);

		$this->add_control(
			'advanced_search_dropdown_background_heading',
			[
				'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_dropdown_background_tabs' );

		$this->start_controls_tab(
			'advanced_search_dropdown_background_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_dropdown_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-results-pane',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_dropdown_background_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_dropdown_hover_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-results-pane:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_dropdown_padding',
			[
				'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-results-shell' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_dropdown_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-response',
			]
		);

		$this->add_control(
			'advanced_search_dropdown_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-response:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_dropdown_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-response' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Result Items
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_result_items_section',
			[
				'label' => esc_html__( 'Result Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'advanced_search_result_items_background_heading',
			[
				'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_result_items_background_tabs' );

		$this->start_controls_tab(
			'advanced_search_result_items_background_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_result_items_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-content',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_result_items_background_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_result_items_hover_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-content, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-content',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_result_items_padding',
			[
				'label' => esc_html__( 'Item Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_result_items_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-content',
			]
		);

		$this->add_control(
			'advanced_search_result_items_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-content, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_result_items_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------------
		| Result Item Contents
		|--------------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'advanced_search_result_items_style_section',
			[
				'label' => esc_html__( 'Result Item Contents', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'advanced_search_result_item_title_heading',
			[
				'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_search_result_item_title_typography',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-title',
			]
		);

		$this->add_control(
			'advanced_search_result_item_title_color_heading',
			[
				'label' => esc_html__( 'Title Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_result_item_title_color_tabs' );

		$this->start_controls_tab(
			'advanced_search_result_item_title_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_title_color',
			[
				'label' => esc_html__( 'Title Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_result_item_title_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_hover_title_color',
			[
				'label' => esc_html__( 'Title Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-title, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_result_items_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_result_items_title_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-title',
			]
		);

		$this->add_control(
			'advanced_search_result_items_title_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-title, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-title' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_result_items_title_border_radius',
			[
				'label' => esc_html__( 'Title Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'advanced_search_result_item_excerpt_heading',
			[
				'label' => esc_html__( 'Excerpt', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_search_result_item_excerpt_typography',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-excerpt',
			]
		);

		$this->add_control(
			'advanced_search_result_item_excerpt_color_heading',
			[
				'label' => esc_html__( 'Excerpt Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_result_item_excerpt_color_tabs' );

		$this->start_controls_tab(
			'advanced_search_result_item_excerpt_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_excerpt_color',
			[
				'label' => esc_html__( 'Excerpt Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_result_item_excerpt_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_excerpt_hover_color',
			[
				'label' => esc_html__( 'Excerpt Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-excerpt, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'search_date_format',
			[
				'label' => esc_html__( 'Date Format', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'locale',
				'options' => [
					'locale' => esc_html__( 'Locale', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fullmonthyear' => esc_html__( 'Full Month, Year', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'shortmonthyear' => esc_html__( 'Short Month, Year', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'daymonthyear' => esc_html__( 'Day Month Year', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'iso' => esc_html__( 'ISO', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_result_items_excerpt_padding',
			[
				'label' => esc_html__( 'Excerpt Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_result_items_excerpt_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-excerpt',
			]
		);

		$this->add_control(
			'advanced_search_result_items_excerpt_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-excerpt, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-excerpt' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_result_items_excerpt_border_radius',
			[
				'label' => esc_html__( 'Excerpt Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-excerpt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'advanced_search_result_item_meta_heading',
			[
				'label' => esc_html__( 'Meta', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_search_result_item_meta_typography',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-meta',
			]
		);

		$this->add_control(
			'advanced_search_result_item_meta_color_heading',
			[
				'label' => esc_html__( 'Meta Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_result_item_meta_color_tabs' );

		$this->start_controls_tab(
			'advanced_search_result_item_meta_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_meta_color',
			[
				'label' => esc_html__( 'Meta Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_result_item_meta_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_meta_hover_color',
			[
				'label' => esc_html__( 'Meta Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-meta, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'search_meta_separator',
			[
				'label' => esc_html__( 'Meta Separator', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dot',
				'options' => [
					'dot' => esc_html__( 'Dot', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'pipe' => esc_html__( 'Pipe', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'slash' => esc_html__( 'Slash', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'dash' => esc_html__( 'Dash', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'text' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'gap' => esc_html__( 'Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'none' => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$this->add_control(
			'search_meta_separator_text',
			[
				'label' => esc_html__( 'Separator Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' => [
					'search_meta_separator' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'search_meta_separator_gap',
			[
				'label' => esc_html__( 'Separator Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
					'rem' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'size' => 8,
					'unit' => 'px',
				],
				'condition' => [
					'search_meta_separator' => 'gap',
				],
			]
		);

		$this->add_control(
			'advanced_search_result_item_meta_separator_heading',
			[
				'label' => esc_html__( 'Meta Separator Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_result_item_meta_separator_tabs' );

		$this->start_controls_tab(
			'advanced_search_result_item_meta_separator_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_meta_separator_color',
			[
				'label' => esc_html__( 'Separator Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-meta-divider' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-meta-separator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_result_item_meta_separator_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_result_items_meta_separator_hover_color',
			[
				'label' => esc_html__( 'Separator Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-meta-divider, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-meta-divider' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-meta-separator, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-meta-separator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_result_items_meta_alignment',
			[
				'label' => esc_html__( 'Meta Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-start',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-meta' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_result_items_meta_padding',
			[
				'label' => esc_html__( 'Meta Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_result_items_meta_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-result-meta',
			]
		);

		$this->add_control(
			'advanced_search_result_items_meta_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-link:hover .pea-advanced-search-result-meta, {{WRAPPER}} .pea-search-result-item.selected .pea-advanced-search-result-meta' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_result_items_meta_border_radius',
			[
				'label' => esc_html__( 'Meta Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-result-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'advanced_search_view_all_heading',
			[
				'label' => esc_html__( 'View All Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_search_view_all_typography',
				'selector' => '{{WRAPPER}} .pea-advanced-search-view-all',
			]
		);

		$this->add_control(
			'advanced_search_view_all_color_heading',
			[
				'label' => esc_html__( 'View all link text color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_view_all_color_tabs' );

		$this->start_controls_tab(
			'advanced_search_view_all_color_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_view_all_color',
			[
				'label' => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-view-all' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_view_all_color_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'advanced_search_view_all_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-view-all:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'advanced_search_view_all_background_heading',
			[
				'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'advanced_search_view_all_background_tabs' );

		$this->start_controls_tab(
			'advanced_search_view_all_background_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_view_all_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-footer',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'advanced_search_view_all_background_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'advanced_search_view_all_hover_background',
				'selector' => '{{WRAPPER}} .pea-advanced-search-footer:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'advanced_search_view_all_padding',
			[
				'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-view-all' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'advanced_search_view_all_border',
				'selector' => '{{WRAPPER}} .pea-advanced-search-view-all',
			]
		);

		$this->add_control(
			'advanced_search_view_all_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-view-all:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'advanced_search_view_all_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-advanced-search-view-all' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/*
	|--------------------------------------------------------------------------
	| Icon Output
	|--------------------------------------------------------------------------
	*/
	protected function get_button_icon_markup( array $settings ): string {
		$icon_type = $settings['search_button_icon_type'] ?? 'none';

		if ( 'icon' === $icon_type ) {
			if ( empty( $settings['search_button_icon']['value'] ) ) {
				return '';
			}

			ob_start();
			Icons_Manager::render_icon(
				$settings['search_button_icon'],
				[
					'aria-hidden' => 'true',
				]
			);

			return (string) ob_get_clean();
		}

		if ( 'lottie' === $icon_type ) {
			$lottie_url = ! empty( $settings['search_button_lottie_file']['id'] )
				? wp_get_attachment_url( absint( $settings['search_button_lottie_file']['id'] ) )
				: ( $settings['search_button_lottie_file']['url'] ?? '' );

			if ( empty( $lottie_url ) || ! $this->is_valid_lottie_json_url( $lottie_url ) ) {
				return '';
			}

			return sprintf(
				'<span class="pea-advanced-search-button-lottie" data-lottie-src="%1$s" aria-hidden="true"><span class="pea-advanced-search-button-lottie-player"></span></span>',
				esc_url( $lottie_url )
			);
		}

		if ( empty( $settings['search_button_icon_media']['url'] ) ) {
			return '';
		}

		$icon_url = $settings['search_button_icon_media']['url'];

		if ( 'svg' === $icon_type && ! empty( $settings['search_button_icon_media']['id'] ) ) {
			$svg_markup = $this->get_svg_icon_markup( absint( $settings['search_button_icon_media']['id'] ) );

			if ( '' !== $svg_markup ) {
				return $svg_markup;
			}
		}

		return sprintf(
			'<img src="%s" alt="" />',
			esc_url( $icon_url )
		);
	}

	protected function is_valid_lottie_json_url( string $url ): bool {
		if ( '' === $url ) {
			return false;
		}

		$path = wp_parse_url( trim( $url ), PHP_URL_PATH );

		if ( ! is_string( $path ) || '' === $path ) {
			return false;
		}

		return (bool) preg_match( '/\.json$/i', $path );
	}

	protected function get_placeholder_icon_markup( array $settings ): string {
		$placeholder_icon = $settings['search_placeholder_icon'] ?? [];
		$preset = $settings['search_style_preset'] ?? 'preset-1';

		if ( empty( $placeholder_icon['value'] ) && 'preset-1' === $preset ) {
			$placeholder_icon = [
				'value' => 'eicon-search',
				'library' => 'eicons',
			];
		}

		if ( empty( $placeholder_icon['value'] ) ) {
			return '';
		}

		ob_start();
		Icons_Manager::render_icon(
			$placeholder_icon,
			[
				'aria-hidden' => 'true',
			]
		);

		return (string) ob_get_clean();
	}

	protected function get_svg_icon_markup( int $attachment_id ): string {
		$svg_path = get_attached_file( $attachment_id );
		$svg_extension = $svg_path ? strtolower( pathinfo( $svg_path, PATHINFO_EXTENSION ) ) : '';

		if ( empty( $svg_path ) || 'svg' !== $svg_extension || ! file_exists( $svg_path ) ) {
			return '';
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$svg_markup = file_get_contents( $svg_path );

		if ( false === $svg_markup ) {
			return '';
		}

		return (string) wp_kses(
			$svg_markup,
			[
				'svg' => [
					'class' => true,
					'xmlns' => true,
					'width' => true,
					'height' => true,
					'viewbox' => true,
					'viewBox' => true,
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
					'role' => true,
					'aria-hidden' => true,
					'focusable' => true,
				],
				'g' => [
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
					'transform' => true,
				],
				'path' => [
					'd' => true,
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
					'fill-rule' => true,
					'clip-rule' => true,
					'transform' => true,
				],
				'circle' => [
					'cx' => true,
					'cy' => true,
					'r' => true,
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
				],
				'rect' => [
					'x' => true,
					'y' => true,
					'rx' => true,
					'ry' => true,
					'width' => true,
					'height' => true,
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
				],
				'line' => [
					'x1' => true,
					'y1' => true,
					'x2' => true,
					'y2' => true,
					'stroke' => true,
					'stroke-width' => true,
				],
				'polyline' => [
					'points' => true,
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
				],
				'polygon' => [
					'points' => true,
					'fill' => true,
					'stroke' => true,
					'stroke-width' => true,
				],
			]
		);
	}

	/*
	|--------------------------------------------------------------------------
	| Widget Output
	|--------------------------------------------------------------------------
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$results_count = isset( $settings['search_results_count'] ) ? absint( $settings['search_results_count'] ) : 5;
		$search_preset = $settings['search_style_preset'] ?? 'preset-1';
		$appearance_mode = $settings['search_appearance_mode'] ?? 'inline';
		$show_search_placeholder = 'yes' === ( $settings['show_search_placeholder'] ?? '' );
		$show_search_placeholder_icon = 'yes' === ( $settings['show_search_placeholder_icon'] ?? 'yes' );
		$show_search_button = 'yes' === ( $settings['show_search_button'] ?? 'yes' );
		$show_search_dropdown = 'yes' === ( $settings['show_search_dropdown'] ?? 'yes' );
		$button_icon_type = $settings['search_button_icon_type'] ?? 'none';
		$meta_separator = $settings['search_meta_separator'] ?? 'dot';
		$meta_separator_text = $settings['search_meta_separator_text'] ?? esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' );
		$meta_separator_gap = $settings['search_meta_separator_gap']['size'] ?? 8;
		$meta_separator_gap_unit = $settings['search_meta_separator_gap']['unit'] ?? 'px';
		$date_format = $settings['search_date_format'] ?? 'locale';
		$dropdown_classes = [ 'pea-advanced-search-response' ];
		$wrapper_classes = [
			'pea-advanced-search-wrapper',
			'appearance-' . sanitize_html_class( $appearance_mode ),
			'preset-' . sanitize_html_class( $search_preset ),
		];
		if ( 'yes' === ( $settings['advanced_search_dropdown_scroll'] ?? '' ) ) {
			$dropdown_classes[] = 'has-result-scroll';
		}
		$button_has_text = $show_search_button && 'yes' === $settings['show_search_button_text'] && ! empty( $settings['search_button_text'] );
		$button_has_icon = $show_search_button && (
			( 'icon' === $button_icon_type && ! empty( $settings['search_button_icon']['value'] ) ) ||
			( in_array( $button_icon_type, [ 'svg', 'image' ], true ) && ! empty( $settings['search_button_icon_media']['url'] ) ) ||
			( 'lottie' === $button_icon_type && ! empty( $settings['search_button_lottie_file']['url'] ) )
		);
		$button_icon_markup = $button_has_icon ? $this->get_button_icon_markup( $settings ) : '';
		$placeholder = $show_search_placeholder ? $settings['search_placeholder'] : '';

		if ( 'preset-1' === $search_preset && esc_html__( 'Search...', 'unlimited-elementor-inner-sections-by-boomdevs' ) === $placeholder ) {
			$placeholder = '';
		}

		$placeholder_icon_markup = ( $show_search_placeholder && $show_search_placeholder_icon ) ? $this->get_placeholder_icon_markup( $settings ) : '';
		$input_wrap_classes = [ 'pea-advanced-search-input-wrap' ];
		if ( '' !== $placeholder_icon_markup ) {
			$input_wrap_classes[] = 'has-placeholder-icon';
		}
		?>
		<div
			class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>"
			data-results-count="<?php echo esc_attr( max( 1, min( 20, $results_count ) ) ); ?>"
			data-no-results-text="<?php echo esc_attr( $settings['search_no_results_text'] ); ?>"
			data-error-text="<?php echo esc_attr__( 'Something went wrong. Please try again.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>"
			data-search-url="<?php echo esc_url( home_url( '/' ) ); ?>"
			data-search-rest-url="<?php echo esc_url( rest_url( 'prime-elementor-addons/v1/advanced-search' ) ); ?>"
			data-view-all-text="<?php echo esc_attr( $settings['search_view_all_text'] ); ?>"
			data-show-view-all="<?php echo esc_attr( $settings['show_view_all_link'] ); ?>"
			data-show-dropdown="<?php echo esc_attr( $show_search_dropdown ? 'yes' : 'no' ); ?>"
			data-meta-separator="<?php echo esc_attr( $meta_separator ); ?>"
			data-meta-separator-text="<?php echo esc_attr( $meta_separator_text ); ?>"
			data-meta-separator-gap="<?php echo esc_attr( $meta_separator_gap . $meta_separator_gap_unit ); ?>"
			data-date-format="<?php echo esc_attr( $date_format ); ?>"
		>
			<form class="pea-advanced-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="pea-advanced-search-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php echo esc_html__( 'Search', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
				</label>
				<div class="<?php echo esc_attr( implode( ' ', $input_wrap_classes ) ); ?>">
					<?php if ( '' !== $placeholder_icon_markup ) : ?>
						<span class="pea-advanced-search-placeholder-icon" aria-hidden="true">
							<?php echo $placeholder_icon_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
					<?php endif; ?>
					<input
						id="pea-advanced-search-<?php echo esc_attr( $this->get_id() ); ?>"
						class="pea-advanced-search-input"
						type="search"
						name="s"
						<?php if ( ! empty( $placeholder ) ) : ?>
							placeholder="<?php echo esc_attr( $placeholder ); ?>"
						<?php endif; ?>
						value="<?php echo esc_attr( get_search_query() ); ?>"
					/>
					<button
						class="pea-advanced-search-clear"
						type="button"
						aria-label="<?php echo esc_attr__( 'Clear search', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>"
					>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php if ( $show_search_button ) : ?>
					<button
						class="pea-advanced-search-button"
						type="submit"
						aria-label="<?php echo esc_attr__( 'Search', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>"
					>
						<?php if ( $button_has_icon ) : ?>
							<span class="pea-advanced-search-button-icon icon-type-<?php echo esc_attr( $button_icon_type ); ?>">
								<?php echo $button_icon_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</span>
						<?php endif; ?>

						<?php if ( $button_has_text ) : ?>
							<span class="pea-advanced-search-button-text">
								<?php echo esc_html( $settings['search_button_text'] ); ?>
							</span>
						<?php elseif ( ! $button_has_icon ) : ?>
							<span class="screen-reader-text">
								<?php echo esc_html__( 'Search', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
							</span>
						<?php endif; ?>
					</button>
				<?php endif; ?>
			</form>
			<?php if ( $show_search_dropdown ) : ?>
				<div class="<?php echo esc_attr( implode( ' ', $dropdown_classes ) ); ?>" aria-live="polite"></div>
			<?php endif; ?>
		</div>
		<?php
	}
}
