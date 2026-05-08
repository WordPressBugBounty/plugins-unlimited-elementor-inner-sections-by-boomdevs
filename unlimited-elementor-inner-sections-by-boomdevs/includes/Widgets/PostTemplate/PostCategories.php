<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostCategories extends Widget_Base {

	public function get_name() {
		return 'pea_post_categories';
	}

	public function get_title() {
		return esc_html__( 'Post Categories', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_categories_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'category', 'categories', 'post categories', 'post' ];
	}

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

		$this->start_controls_section(
			'section_post_categories',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_categories_flex_css',
			[
				'label' => esc_html__('counter title left, right position css', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'display:flex; justify-content:center; align-items:center;',
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-categories-wrapper' => '{{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
            'post_categories_align',
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
					'{{WRAPPER}} .pea-single-post-categories-wrapper' => 'justify-content: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================  

        // Category Styling Controls
        $this->start_controls_section(
            'post_categories_styling', 
            [
                'label' => esc_html__('Category', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'post_categories_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-single-post-categories-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'post_categories_typography',
                    'selector' => '{{WRAPPER}} .pea-single-post-category',
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

            $this->start_controls_tabs( 'post_categories_tabs' );
                $this->start_controls_tab(
                    'post_categories_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'post_categories_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-single-post-category' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'post_categories_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#dddddd9e',
                            'selectors' => [
                                '{{WRAPPER}} .pea-single-post-category' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'post_categories_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-single-post-category',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'post_categories_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'post_categories_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-single-post-category' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'post_categories_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-single-post-category' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'post_categories_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-single-post-category' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'post_categories_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'post_categories_border_radius',
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
                        '{{WRAPPER}} .pea-single-post-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_categories_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 14,
                        'bottom' => 6,
                        'left' => 14,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-single-post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_categories_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-single-post-categories-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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
		$cats = wp_get_object_terms($post_id, 'category');  ?>
		<div class="pea-single-post-categories-wrapper">
			<?php if (!empty($cats) && !is_wp_error($cats)) { ?> 
				<?php foreach ($cats as $cat) {
					$cats_link = get_term_link($cat); 
					$cat_name = $cat->name; 
					echo '<a href="' . esc_url($cats_link) . '" class="pea-single-post-category">'.esc_html($cat_name).'</a>';
				} ?>
			<?php } else{ echo "Categories has not been defined."; } ?>
		</div>
	<?php }
}