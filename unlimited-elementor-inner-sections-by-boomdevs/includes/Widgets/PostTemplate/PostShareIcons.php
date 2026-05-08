<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostShareIcons extends Widget_Base {
	
	public function get_name() {
		return 'pea_post_share_icons';
	}

	public function get_title() {
		return esc_html__( 'Post Share Icons', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_share_icons_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'post', 'share icons', 'post social icons', 'social icons' ];
	}
    
    public function get_style_depends() {
        return ['prime-elementor-addons--post-share-icons'];
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

		// Repeater
		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'post_share_icon_item_tabs' );
			$repeater->start_controls_tab(
				'post_share_icon_item_content',
				[
					'label' => esc_html__( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);

				// Social Media Type
				$repeater->add_control(
					'social_media_type',
					[
						'label'   => esc_html__('Social Media Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
						'type'    => Controls_Manager::SELECT,
						'default' => 'facebook',
						'options' => [
							'facebook'   => esc_html__('FaceBook', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'x-twitter'  => esc_html__('X Twitter', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'envelope'   => esc_html__('Envelope', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'linkedin'   => esc_html__('LinkedIn', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'pinterest'  => esc_html__('Pintrest', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'telegram'   => esc_html__('Telegram', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'whatsapp'   => esc_html__('Whatsapp', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'reddit'     => esc_html__('Reddit', 'unlimited-elementor-inner-sections-by-boomdevs'),
							// 'print'      => esc_html__('Print', 'unlimited-elementor-inner-sections-by-boomdevs'),
						],
					]
				);

				// Display Style
				$repeater->add_control(
					'display_style',
					[
						'label'   => esc_html__('Display Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
						'type'    => Controls_Manager::SELECT,
						'default' => 'icon',
						'options' => [
							'icon' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'text' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'both' => esc_html__('Both', 'unlimited-elementor-inner-sections-by-boomdevs'),
						],
					]
				);

				// Icon Control (Show only when needed)
				$repeater->add_control(
					'social_icon_item_icon',
					[
						'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
						'type'  => Controls_Manager::ICONS,
						'condition' => [
							'display_style' => ['icon', 'both'],
						],
					]
				);

			$repeater->end_controls_tab();
			$repeater->start_controls_tab(
				'post_share_icon_item_style',
				[
					'label' => esc_html__( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);
				// Enable Custom Styles Toggle
				$repeater->add_control(
					'post_share_icon_custom_styles',
					[
						'label' => esc_html__( 'Custom Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);

				// === ICON STYLES ===
				$repeater->add_control(
					'icon_styles_heading',
					[
						'label' => esc_html__( 'Icon Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Icon Color
				$repeater->add_control(
					'post_share_icon_color_this',
					[
						'label'  => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon svg' => 'fill: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Icon Hover Color
				$repeater->add_control(
					'post_share_icon_hover_color_this',
					[
						'label'  => esc_html__( 'Icon Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}:hover .pea-post-share-icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} {{CURRENT_ITEM}}:hover .pea-post-share-icon svg' => 'fill: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Icon Background Color
				$repeater->add_control(
					'post_share_icon_bg_color_this',
					[
						'label'  => esc_html__( 'Icon Bg Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Icon Background Hover Color
				$repeater->add_control(
					'post_share_icon_bg_hover_color_this',
					[
						'label'  => esc_html__( 'Icon Bg Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}:hover .pea-post-share-icon' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// === WRAPPER/CONTAINER STYLES ===
				$repeater->add_control(
					'wrapper_styles_heading',
					[
						'label' => esc_html__( 'Wrapper Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Wrapper Background
				$repeater->add_control(
					'post_share_wrapper_bg_this',
					[
						'label'  => esc_html__( 'Wrapper Bg Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon-link' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Wrapper Hover Background
				$repeater->add_control(
					'post_share_wrapper_hover_bg_this',
					[
						'label'  => esc_html__( 'Wrapper Bg Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}:hover .pea-post-share-icon-link' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Wrapper Border Hover Color
				$repeater->add_control(
					'post_share_wrapper_border_color_this',
					[
						'label'  => esc_html__( 'Wrapper Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon-link' => 'border-color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// Wrapper Border Hover Color
				$repeater->add_control(
					'post_share_wrapper_border_hover_color_this',
					[
						'label'  => esc_html__( 'Wrapper Border Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon-link:hover' => 'border-color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes'
						]
					]
				);

				// === TEXT STYLES (for display_style 'text' or 'both') ===
				$repeater->add_control(
					'text_styles_heading',
					[
						'label' => esc_html__( 'Text Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
						'condition' => [
							'post_share_icon_custom_styles' => 'yes',
						]
					]
				);

				// Text Color
				$repeater->add_control(
					'post_share_text_color_this',
					[
						'label'  => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} .pea-post-share-icon-title' => 'color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes',
						]
					]
				);

				// Text Hover Color
				$repeater->add_control(
					'post_share_text_hover_color_this',
					[
						'label'  => esc_html__( 'Text Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}:hover .pea-post-share-icon-title' => 'color: {{VALUE}}',
						],
						'condition' => [
							'post_share_icon_custom_styles' => 'yes',
						]
					]
				);

			$repeater->end_controls_tab();
		$repeater->end_controls_tabs(); 

		$this->add_control(
			'post_share_icons',
			[
				'label' => esc_html__('Post Share Icons', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type'  => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_media_type' => 'facebook',
						'display_style'     => 'icon',
						'social_icon_item_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						],
					],
					[
						'social_media_type' => 'x-twitter',
						'display_style'     => 'icon',
						'social_icon_item_icon' => [
							'value' => 'fab fa-x-twitter',
							'library' => 'fa-brands'
						],
					],
					[
						'social_media_type' => 'linkedin',
						'display_style'     => 'icon',
						'social_icon_item_icon' => [
							'value' => 'fab fa-linkedin',
							'library' => 'fa-brands'
						],
					],
					[
						'social_media_type' => 'whatsapp',
						'display_style'     => 'icon',
						'social_icon_item_icon' => [
							'value' => 'fab fa-whatsapp',
							'library' => 'fa-brands'
						],
					],
				],
				'title_field' => '{{{ social_media_type }}}',
			]
		);

		$this->add_control(
			'post_share_icon_layout', 
			[
				'label' => __('Layout Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
				'options' => [
					'row'     => esc_html__( 'Horizontal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'column'       => esc_html__( 'Vertical', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-share-icons' => 'flex-direction: {{VALUE}};',
				],
				'default' => ['row'],
			]
		);

		$this->add_responsive_control(
            'post_share_icon_row_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-share-icons' => 'justify-content: {{VALUE}}',
				],
				'condition' => [
					'post_share_icon_layout' => 'row',
				]
            ]
        );

		$this->add_responsive_control(
            'post_share_icon_column_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'label_block' => false,
                'options' => [
					'start'    => [
						'title' => __( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => __( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-right',
					],
                ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-share-icons' => 'align-items: {{VALUE}}',
				],
				'condition' => [
					'post_share_icon_layout' => 'column',
				]
            ]
        );

		$this->end_controls_section(); // End Controls Section
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Icon Wrapper Styling Controls
		$this->start_controls_section(
			'post_share_icon_wrapper_styling',
			[
				'label' => esc_html__('Icon Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
			$this->add_responsive_control(
				'post_share_icon_wrapper_gap',
				[
					'label'           => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type'            => Controls_Manager::SLIDER,
					'size_units'      => [ 'px', '%' ],
					'range'           => [
						'px' => [
							'min' => 0,
							'max' => 120,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'devices'         => [ 'desktop', 'tablet', 'mobile' ],
					'default' => [
						'size' => '',
						'unit' => 'px',
					],
					'tablet_default'  => [
						'size' => '',
						'unit' => 'px',
					],
					'mobile_default'  => [
						'size' => '',
						'unit' => 'px',
					],
					'selectors'       => [
						'{{WRAPPER}} .pea-single-post-share-icons' => 'gap: {{SIZE}}{{UNIT}};'
					],
				]
			);
		
			$this->start_controls_tabs( 'post_share_icon_wrapper_tabs' );
				$this->start_controls_tab(
					'post_share_icon_wrapper_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'post_share_icon_wrapper_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-post-share-icon-link',
						]
					);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'     => 'post_share_icon_wrapper_border_type',
							'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'selector' => '{{WRAPPER}} .pea-post-share-icon-link',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid', // default border style: solid, dashed, dotted, etc.
                                ],
                                'width' => [
                                    'default' => [
                                        'top'    => 1,
                                        'right'  => 1,
                                        'bottom' => 1,
                                        'left'   => 1,
                                        'isLinked' => true, // optional: links all sides
                                    ],
                                ],
                                'color' => [
                                    'default' => '#E1E3E8', // default border color
                                ],
                            ],

						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'post_share_icon_wrapper_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'post_share_icon_wrapper_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-post-share-icon-link:hover',
						]
					);
			
					$this->add_control(
						'post_share_icon_wrapper_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-post-share-icon-link:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_control(
				'post_share_icon_wrapper_hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'post_share_icon_wrapper_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 50,
                        'right' => 50,
                        'bottom' => 50,
                        'left' => 50,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-share-icon-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

			$this->add_responsive_control(
				'post_share_icon_wrapper_padding',
				[
					'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-post-share-icon-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_share_icon_wrapper_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-post-share-icon-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
        
        // Icon Styling Controls
        $this->start_controls_section(
            'post_share_icon_styling',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'post_share_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-share-icon i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-post-share-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'post_share_icon_gap',
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
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-share-icon-link' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'post_share_icon_tabs' );
				$this->start_controls_tab(
					'post_share_icon_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					$this->add_responsive_control(
						'post_share_icon_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::SLIDER,
							'size_units' => ['deg'],
							'range' => [
								'px' => [
									'min' => -360,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => 0,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-post-share-icon' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'post_share_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-post-share-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-post-share-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'post_share_icon_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-post-share-icon',
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'post_share_icon_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-post-share-icon',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'post_share_icon_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					$this->add_responsive_control(
						'post_share_icon_hover_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::SLIDER,
							'size_units' => ['deg'],
							'range' => [
								'px' => [
									'min' => -360,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => 40,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-post-share-icon-item:hover .pea-post-share-icon' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'post_share_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-post-share-icon-item:hover .pea-post-share-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-post-share-icon-item:hover .pea-post-share-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_social_icon_or_img' => 'icon',
							],
						]
					);
				
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'post_share_icon_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-post-share-icon-item:hover .pea-post-share-icon',
						]
					);
			
					$this->add_control(
						'post_share_icon_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-post-share-icon-item:hover .pea-post-share-icon' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'post_share_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'post_share_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 50,
                        'right' => 50,
                        'bottom' => 50,
                        'left' => 50,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-share-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_share_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 16,
                        'right' => 16,
                        'bottom' => 16,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-share-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_share_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-share-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Social Icon title Styling Controls
        $this->start_controls_section(
            'post_share_icon_title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'post_share_icon_title_typography',
                    'selector' => '{{WRAPPER}} .pea-post-share-icon-title',
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
                                'size' => 18,
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

            $this->start_controls_tabs( 'post_share_icon_title_tabs' );
                $this->start_controls_tab(
                    'post_share_icon_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'post_share_icon_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-share-icon-title' => 'color: {{VALUE}};',
							],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'post_share_icon_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						
                    ]
                );

                    $this->add_control(
                        'post_share_icon_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-share-icon-link:hover .pea-post-share-icon-title' => 'color: {{VALUE}};',
							],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control( 'post_share_icon_title_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

            $this->add_responsive_control(
                'post_share_icon_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-share-icon-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
					
                ]
            );
        
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || ( get_post_type() == 'pea-site-builder' ) ) {
			$post_id = get_the_ID();
        	$post_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('demo_post_id');
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
		

        echo '<div class="pea-single-post-share-icons-wrapper">';
			$this->social_icons($post_id, $settings);
        echo '</div>';

	}

	function social_icons($post_id , $args) {

		if ( empty( $args['post_share_icons'] ) ) {
			return;
		}

		$post_link  = esc_url( get_the_permalink($post_id) );
		$post_title = get_the_title($post_id);

		// Share URLs
		$facebook_url = add_query_arg(['url' => $post_link], 'https://www.facebook.com/share.php');

		$twitter_url = add_query_arg([
			'url'  => $post_link,
			'text' => rawurlencode( wp_strip_all_tags( $post_title ) ),
		], 'https://twitter.com/share');

		$email_url = add_query_arg([
			'subject' => wp_strip_all_tags( $post_title ),
			'body'    => $post_link,
		], 'mailto:');

		$linkedin_url = add_query_arg([
			'url' => $post_link,
		], 'https://www.linkedin.com/sharing/share-offsite/?url=');

		$pinterest_url = 'javascript:pinIt();';

		$reddit_url = add_query_arg([
			'url' => $post_link,
		], 'https://www.reddit.com/submit');

		$telegram_url = add_query_arg([
			'url' => $post_link,
		], 'https://t.me/share/url');

		$whatsapp_url = add_query_arg([
			'text' => $post_link,
		], 'https://api.whatsapp.com/send');

		?>
		<script>
			function pinIt() {
				var e = document.createElement('script');
				e.setAttribute('type','text/javascript');
				e.setAttribute('charset','UTF-8');
				e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
				document.body.appendChild(e);
			}
		</script>
		<div class="pea-single-post-share-icons cf"> 

			<?php foreach ( $args['post_share_icons'] as $item ) :

				$type = $item['social_media_type'];
				$style = $item['display_style'];
				$icon  = $item['social_icon_item_icon'];

				// Map URLs
				switch ( $type ) {
					case 'facebook':  $url = $facebook_url; break;
					case 'x-twitter': $url = $twitter_url; break;
					case 'envelope':  $url = $email_url; break;
					case 'linkedin':  $url = $linkedin_url; break;
					case 'pinterest': $url = $pinterest_url; break;
					case 'telegram':  $url = $telegram_url; break;
					case 'whatsapp':  $url = $whatsapp_url; break;
					case 'reddit':    $url = $reddit_url; break;
					default: $url = '#';
				}
			?>

			<div class="pea-post-share-icon-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> ">

				<a class="pea-post-share-icon-link <?php echo esc_attr($type); ?>" href="<?php echo esc_url($url); ?>" >
					<?php if ( $style === 'icon' || $style === 'both' ) : ?>
						<span class="pea-post-share-icon">
							<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php endif; ?>

					<?php if ( $style === 'text' || $style === 'both' ) : ?>
						<span class="pea-post-share-icon-title">
							<?php echo esc_html( ucfirst(str_replace('-', ' ', $type)) ); ?>
						</span>
					<?php endif; ?>
				</a>

			</div>

			<?php endforeach; ?>

		</div>
		<?php
	}
	
}