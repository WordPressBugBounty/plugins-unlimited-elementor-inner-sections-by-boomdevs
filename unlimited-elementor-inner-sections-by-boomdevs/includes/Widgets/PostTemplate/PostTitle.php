<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use PrimeElementorAddons\Controls\GradientTextControl;
use PrimeElementorAddons\Controls\TextStrokeControl;
use PrimeElementorAddons\Utils\Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class PostTitle extends Widget_Base {
	
	public function get_name() {
		return 'pea_post_title';
	}

	public function get_title() {
		return esc_html__( 'Post Title', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_title_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'post title', 'post', 'title' ];
	}


	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

        // General Section
		$this->start_controls_section(
			'section_post_title',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            
		$this->add_control(
			'enable_post_link',
			[
				'label' => esc_html__('Enable Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'open_in_new_tab',
			[
				'label' => esc_html__('Open In New Tab', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_post_link' => 'yes',
				],
			]
		);

		$this->add_control(
			'post_title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'P' => 'p'
				],
				'default' => 'h1',
			]
		);
            
		$this->add_responsive_control(
			'post_title_limit',
			[
				'label' => esc_html__('Word Limit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'description' => esc_html__('Polish your title by limiting words. Set 0 to show the full text.', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [''],
				'range' => [    
					'' => [
						'step' => 1,
						'min' => 1,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 10,
				],
			]
		);

		$this->add_responsive_control(
            'post_title_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'label_block' => false,
                'options' => [
					'left'    => [
						'title' => __( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-title' => 'text-align: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section(); 
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Post Title Styling Controls
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		GradientTextControl::add_control( $this, [
			'name'     => 'title_color',
			'selector' => '{{WRAPPER}} .pea-single-post-title, {{WRAPPER}} .pea-single-post-title a',
		]);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pea-single-post-title:not( > a), {{WRAPPER}} .pea-single-post-title a',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_shadow',
				'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-title:not( > a), {{WRAPPER}} .pea-single-post-title a',
				'render_type'  => 'template',
			]
		);

		TextStrokeControl::add_control( $this, [
			'name' => 'title_stroke', 
			'label' => esc_html__('Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs'),
			'selector' => '{{WRAPPER}} .pea-single-post-title:not( > a), {{WRAPPER}} .pea-single-post-title a',
		]);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || ( get_post_type() == 'pea-site-builder' ) ) {
			$post_id = get_the_ID();
        	$post_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_post_id');
            $post = get_post( $post_id );
            if ( ! $post ) {
                return;
            }
        }else{
            $post_id = get_the_ID();
            $post = get_post($post_id);
            if ( ! $post ) {
                return;
            }
		}
		
		$title = Helper::get_title( $settings['post_title_limit']['size'], $post_id );
		$link = get_permalink($post_id);
		$target = '';
        echo '<div class="pea-single-post-title-wrapper">';
		echo '<'. esc_attr($settings['post_title_tag']) .' class="pea-single-post-title">';
			if($settings['enable_post_link'] === 'yes') {
				if($settings['open_in_new_tab'] === 'yes') {
					$target = 'target="_blank"';	
				}
				echo '<a href="'.esc_url($link).'" '.esc_attr($target).'">';
			}
				echo esc_html($title);
			if($settings['enable_post_link'] === 'yes') {
				echo '</a>';
			}
		echo '</'. esc_attr($settings['post_title_tag']) .'>';
        echo '</div>';

	}
	
}