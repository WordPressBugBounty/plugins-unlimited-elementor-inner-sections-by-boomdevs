<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostNavigation extends Widget_Base {

	public function get_name() {
		return 'pea_post_navigation';
	}

	public function get_title() {
		return esc_html__( 'Post Pagination', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_navigation_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [  'post navigation', 'post pagination', 'post', 'pagination', 'navigation' ];
	}
    
    public function get_style_depends() {
        return ['prime-elementor-addons--post-navigation'];
    }

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

        // General Section
		$this->start_controls_section(
			'section_post_categories',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label'       => esc_html__( 'Pagination Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'both',
				'options'     => [
					'text' 			=> esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'icon' 			=> esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'both' 			=> esc_html__( 'Text & Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$this->add_control(
			'pagination_icons',
			[
				'label'       => esc_html__( 'Pagination Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'placeholder' => esc_html__( 'Choose Icon from Here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'fas fa-angle-double-',
				'options'     => [
					'fas fa-angle-' 			=> esc_html__( 'Angle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-angle-double-' 		=> esc_html__( 'Double Angle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-arrow-' 			=> esc_html__( 'Arrow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-long-arrow-alt-' 	=> esc_html__( 'Long Arrow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-arrow-circle-'		=> esc_html__( 'Circle Arrow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-arrow-alt-circle-' 	=> esc_html__( 'Circle Arrow 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'far fa-arrow-alt-circle-' 	=> esc_html__( 'Circle Arrow 3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-caret-' 			=> esc_html__( 'Caret', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-caret-square-' 		=> esc_html__( 'Square Caret', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'far fa-caret-square-' 		=> esc_html__( 'Square Caret 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-chevron-' 			=> esc_html__( 'Chevron', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-chevron-circle-' 	=> esc_html__( 'Circle Chevron', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fas fa-hand-point-' 		=> esc_html__( 'Hand Point', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'far fa-hand-point-' 		=> esc_html__( 'Hand Point 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$this->add_control(
			'pagination_same_term',
			[
				'label' => esc_html__( 'Same Term', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'description' => __('If checked, the nagination will be based on the same term.', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'space-between',
                'label_block' => true,
                'options' => [
					'space-evenly' => [
						'title' => __( 'Space Evenly', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-justify-space-evenly-h',
					],
					'space-around'    => [
						'title' => __( 'Space Around', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-between' => [
						'title' => __( 'Space Between', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-justify-space-between-h',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-navigation-wrapper .nav-links' => 'justify-content: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================

		// Navigation Wrapper Styling Section
		$this->start_controls_section(
			'post_navigation_wrapper_styling',
			[
				'label' => __( 'Navigation Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
			$this->add_control(
				'post_navigation_wrapper_bg_type_popover_toggle',
				[
					'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::POPOVER_TOGGLE,
					'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'separator' => 'none',
				]
			);
			$this->start_popover();
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'post_navigation_wrapper_bg_color',
						'types'          => [ 'classic', 'gradient' ],
						'fields_options' => [
							'background' => [
								'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
								'default' => 'classic',
							],
							'color' => [
								'default' => '', // ✅ Set your default normal color here
							],
						],
						'selector'  => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation',
					]
				);
			$this->end_popover();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'post_navigation_wrapper_border_type',
					'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation',
				]
			);

			$this->add_responsive_control(
				'post_navigation_wrapper_border_radius',
				[
					'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_navigation_wrapper_padding',
				[
					'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_navigation_wrapper_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'post_navigation_wrapper_box_shadow',
					'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation',
				]
			);

		$this->end_controls_section();

		// Navigation Icon Styling Section
		$this->start_controls_section(
			'post_navigation_icon_styling',
			[
				'label' => __( 'Navigation Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
            
            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'condition' => [
                        'show_icon' => 'yes',
                    ],
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
                ]
            );

			$this->start_controls_tabs( 'post_navigation_icon_tabs' );

			$this->start_controls_tab(
				'post_navigation_icon_normal_style',
				[
					'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);
			
			$this->add_control(
				'post_navigation_icon_color',
				[
					'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before' => 'color: {{VALUE}}',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before' => 'color: {{VALUE}}',
					],
				]
			);
			
			$this->add_control(
				'post_navigation_icon_bg_color',
				[
					'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before' => 'background-color: {{VALUE}}',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'post_navigation_icon_style_hover',
				[
					'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

				]
			);

			$this->add_control(
				'post_navigation_icon_color_hover',
				[
					'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a:hover div:before' => 'color: {{VALUE}}',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a:hover div:before' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'post_navigation_icon_color_bg_hover',
				[
					'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a:hover div:before' => 'background-color: {{VALUE}}',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a:hover div:before' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'post_navigation_icon_border_type',
					'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before, {{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before',
				]
			);

			$this->add_responsive_control(
				'post_navigation_icon_border_radius',
				[
					'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => 6,
						'right' => 6,
						'bottom' => 6,
						'left' => 6,
						'unit' => 'px',
						'isLinked' => true,
					],
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_navigation_icon_padding',
				[
					'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_navigation_icon_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'post_navigation_icon_box_shadow',
					'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a div:before, {{WRAPPER}}  .pea-single-post-navigation-wrapper .post-navigation .nav-next a div:before',
				]
			);

		$this->end_controls_section();

		// Navigation Title Text Styling Section
		$this->start_controls_section(
			'post_navigation_title_text_styling',
			[
				'label' => __( 'Navigation Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);  
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'post_navigation_title_typography',
					'selector' => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a, {{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-next a',
					'fields_options' => [
						'typography' => [
							'default' => 'custom',
						],
						'font_family' => [
							'default' => 'Work Sans',
						],
						'font_weight' => [
							'default' => '500',
						],
						'font_size' => [
							'default' => [
								'unit' => 'px',
								'size' => 16,
							],
						],
						'line_height' => [
							'default' => [
								'unit' => '%',
								'size' => 140,
							],
						],
					],
				]
			);

			$this->start_controls_tabs( 'post_navigation_title_tabs' );

			$this->start_controls_tab(
				'post_navigation_title_normal_style',
				[
					'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);
			
			$this->add_control(
				'post_navigation_title_color',
				[
					'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-next a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'post_navigation_title_style_hover',
				[
					'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

				]
			);

			$this->add_control(
				'post_navigation_title_color_hover',
				[
					'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-next a:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control('post_navigation_title_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

			$this->add_responsive_control(
				'post_navigation_title_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-next a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'post_navigation_title_shadow',
					'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-previous a, {{WRAPPER}} .pea-single-post-navigation-wrapper .post-navigation .nav-next a',
					// 'render_type'  => 'template',
				]
			);

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
		
		$left_icon  = $settings['pagination_icons'].'left';
		$right_icon = $settings['pagination_icons'].'right';
		$paginationType = $settings['pagination_type'];

		$wp_query = new \WP_Query(array('p' => $post_id));
		if($paginationType === 'both'){
			$args = array(
				'prev_text' => '<span class="'.esc_attr($left_icon).'"></span><span></span> %title ',
				'next_text' => ' %title <span class="'.esc_attr($right_icon).'"></span><span></span>',
			);
		} elseif($paginationType === 'text'){	
			$args = array(
				'prev_text' => '<span></span> %title ',
				'next_text' => ' %title <span></span>',	
			);
		} elseif($paginationType === 'icon'){
			$args = array(
				'prev_text' => '<span class="'.esc_attr($left_icon).'"></span>',
				'next_text' => '<span class="'.esc_attr($right_icon).'"></span>',
			);
		}
		
		if($settings['pagination_same_term'] === 'yes'){
			$args['in_same_term'] = true;
		}else{ 
			$args['in_same_term'] = false;
		}
    
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		
		$classes = '';
		if ($next_post && !($prev_post)) {
			$classes = ' only-next ';
		}

		if($post_id !== "") { 
			?><div class="pea-single-post-navigation-wrapper  <?php  echo esc_attr($classes); ?>"><?php 
				// Display the post navigation for the single post
				if ($wp_query->have_posts()) {
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						the_post_navigation( $args );
						wp_link_pages(array(
								'before' => '<div class="pea-single-nav-links">',
								'after' => '</div>',
						));
					}
				}
				// Reset the custom query
				wp_reset_postdata();
			?></div><?php
		}	
	}
}