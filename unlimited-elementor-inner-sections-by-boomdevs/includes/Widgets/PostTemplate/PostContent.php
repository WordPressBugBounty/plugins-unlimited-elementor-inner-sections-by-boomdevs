<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use PrimeElementorAddons\Controls\TextStrokeControl;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostContent extends Widget_Base {
	
	public function get_name() {
		return 'pea_post_content';
	}

	public function get_title() {
		return esc_html__( 'Post Content', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_content_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'post content','post description', 'post', 'description', 'content' ];
	}

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

		$this->start_controls_section(
			'section_post_description',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_content_drop_cap',
			[
				'label' => __('Drop Cap', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'font-size: 60px; float:left; margin-right:10px;',
				'default' => 'no',
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-content p:first-of-type::first-letter' => '{{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
            'post_description_align',
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
					'{{WRAPPER}} .pea-single-post-content' => 'text-align: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-content h1, 
					{{WRAPPER}} .pea-single-post-content h2, 
					{{WRAPPER}} .pea-single-post-content h3, 
					{{WRAPPER}} .pea-single-post-content h4, 
					{{WRAPPER}} .pea-single-post-content h5, 
					{{WRAPPER}} .pea-single-post-content h6' => 'color: {{VALUE}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .pea-single-post-content h1, 
							{{WRAPPER}} .pea-single-post-content h2, 
							{{WRAPPER}} .pea-single-post-content h3, 
							{{WRAPPER}} .pea-single-post-content h4, 
							{{WRAPPER}} .pea-single-post-content h5, 
							{{WRAPPER}} .pea-single-post-content h6',
			]
		);

		// Spacing
		$this->add_responsive_control(
			'heading_spacing',
			[
				'label' => esc_html__( 'Spacing', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-content h1,
					{{WRAPPER}} .pea-single-post-content h2,
					{{WRAPPER}} .pea-single-post-content h3,
					{{WRAPPER}} .pea-single-post-content h4,
					{{WRAPPER}} .pea-single-post-content h5,
					{{WRAPPER}} .pea-single-post-content h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_paragraph_style',
			[
				'label' => esc_html__( 'Paragraph', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'paragraph_color',
			[
				'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-content p' => 'color: {{VALUE}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'paragraph_typography',
				'selector' => '{{WRAPPER}} .pea-single-post-content p',
			]
		);

		// Line Height & Spacing
		$this->add_responsive_control(
			'paragraph_spacing',
			[
				'label' => esc_html__( 'Spacing', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			[
				'label' => esc_html__( 'Links', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} .pea-single-post-content a',
			]
		);

		$this->start_controls_tabs( 'tabs_link_style' );
			$this->start_controls_tab(
				'tab_link_normal',
				[ 'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) ]
			);

				$this->add_control(
					'link_color',
					[
						'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .pea-single-post-content a' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_link_hover',
				[ 'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ) ]
			);

				$this->add_control(
					'link_hover_color',
					[
						'label' => esc_html__( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .pea-single-post-content a:hover' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'link_spacing',
			[
				'label' => esc_html__( 'Spacing', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-content a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$drop_cap = isset($settings['post_content_drop_cap']) ? $settings['post_content_drop_cap'] : '';
		$drop_cap_class = ($drop_cap === 'yes') ? 'drop-cap' : '';
		
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

		global $post;
		$original_post = $post; // backup

		$post = get_post($post_id); // set correct post
		setup_postdata($post);

		$content = apply_filters('the_content', $post->post_content);

		wp_reset_postdata(); // restore
		$post = $original_post;

        echo '<div class="pea-single-post-content-wrapper ">';
			echo '<article class="pea-single-post-content ' . esc_attr($drop_cap_class) . '">';
				echo $content;
			echo '</article>';
        echo '</div>';

	}
}