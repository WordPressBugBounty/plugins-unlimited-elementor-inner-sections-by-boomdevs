<?php 

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\GradientTextControl;
use PrimeElementorAddons\Utils\TextStrokeControl;
use PrimeElementorAddons\Utils\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class SocialIcons extends Widget_Base {

	public function get_name() {
		return 'pea_social_icons';
	}

	public function get_title() {
		return esc_html__('Social Icons', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_social_icons_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--social-icons'];
    }

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
		$this->start_controls_section(
			'social_icon_section',
			[
				'label' => esc_html__( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'social_icon_presets',
				[
					'label'       => esc_html__( 'Presets Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'default',
					'options'     => [
						'default'      => esc_html__( 'Preset 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'preset-2'      => esc_html__( 'Preset 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'preset-3'      => esc_html__( 'Preset 3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'preset-4'      => esc_html__( 'Preset 4', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'preset-5'      => esc_html__( 'Preset 5', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'preset-6'      => esc_html__( 'Preset 6', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'preset-7'      => esc_html__( 'Preset 7', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

			$this->add_responsive_control(
				'alignment',
				[
					'label'     => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'start' => [
							'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-center',
						],
						'end' => [
							'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'default'     => 'center',
					'toggle'    => true,
					'selectors' => [
						'{{WRAPPER}} .pea-socials' => 'justify-content: {{VALUE}};',
					],
                    'render_type'  => 'template',
				]
			);

            $repeater = new \Elementor\Repeater();
            $repeater->start_controls_tabs( 'social_icon_item_tabs' );
                $repeater->start_controls_tab(
                    'social_icon_item_desc_tab',
                    [
                        'label' => __( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $repeater->add_control(
                        'social_icon_item_icon',
                        [
                            'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'fa-solid',
                            ],
                            'label_block' => true,
                            'skin' => 'inline',
                        ]
                    );

                    $repeater->add_control(
                        'social_icon_item_title', [
                            'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXT,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => esc_html__( 'List Title' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'separator' => 'before',
                            'label_block' => true,
                        ]
                    );

                    $repeater->add_control(
                        'social_icon_item_title_url',
                        [
                            'label' => esc_html__( 'Link / Url', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::URL,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'default' => [
                                'url' => '',
                                'is_external' => true,
                                'nofollow' => true,
                                'custom_attributes' => '',
                            ],
                            'label_block' => true,
                        ]
                    );
                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'styles_tab',
                    [
                        'label' => __( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $repeater->add_control(
                        'social_icon_custom_styles',
                        [
                            'label' => esc_html__( 'Custom Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SWITCHER,
                        ]
                    );
                    $repeater->add_control(
                        'social_icon_icon_color_this',
                        [
                            'label'  => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-social-icon-link .pea-social-icon-wrapper .pea-social-icon i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-social-icon-link .pea-social-icon-wrapper .pea-social-icon svg' => 'fill: {{VALUE}}',
                            ],
                            'condition' => [
                                'social_icon_custom_styles' => 'yes'
                            ]
                        ]
                    );
                    $repeater->add_control(
                        'social_icon_icon_bg_color_this',
                        [
                            'label'  => esc_html__( 'Icon Bg Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-social-icon' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-social-icon-link' => 'border-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'social_icon_custom_styles' => 'yes'
                            ]
                        ]
                    );
                
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'social_icon_icon_bg_type_this',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .pea-social-icon-link',
                            'condition' => [
                                'social_icon_custom_styles' => 'yes'
                            ]
                        ]
                    );
                    // $repeater->add_control(
                    //     'social_icon_icon_border_color_this',
                    //     [
                    //         'label'  => esc_html__( 'Icon Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    //         'type' => Controls_Manager::COLOR,
                    //         'default' => '',
                    //         'selectors' => [
                    //             '{{WRAPPER}} {{CURRENT_ITEM}} .pea-social-icon-link' => 'border-color: {{VALUE}}',
                    //         ],
                    //         'condition' => [
                    //             'social_icon_custom_styles' => 'yes'
                    //         ]
                    //     ]
                    // );
                $repeater->end_controls_tab();
            $repeater->end_controls_tabs();

            $this->add_control(
                'social_icons',
                [
                    'label' => esc_html__( 'Social Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'social_icon_item_title' => esc_html__( 'Facebook', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-facebook-f',
                                'library' => 'fa-brands'
                            ],
                            'social_icon_custom_styles' => 'yes', 
                            'social_icon_icon_color_this' => '#1877F2'

                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Linkedin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-linkedin-in',
                                'library' => 'fa-brands'
                            ],
                            'social_icon_custom_styles' => 'yes', 
                            'social_icon_icon_color_this' => '#0077B5'
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Youtube', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-youtube',
                                'library' => 'fa-brands'
                            ],
                            'social_icon_custom_styles' => 'yes', 
                            'social_icon_icon_color_this' => '#E53935'
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Telegram', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-telegram-plane',
                                'library' => 'fa-brands'
                            ],
                            'social_icon_custom_styles' => 'yes', 
                            'social_icon_icon_color_this' => '#039BE5'
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Spotify', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-spotify',
                                'library' => 'fa-brands'
                            ],
                            'social_icon_custom_styles' => 'yes', 
                            'social_icon_icon_color_this' => '#1DB954'
                        ],
                        [
                            'social_icon_item_title' => esc_html__( 'Whatsapp', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'social_icon_item_icon' => [
                                'value' => 'fab fa-whatsapp',
                                'library' => 'fa-brands'
                            ],
                            'social_icon_custom_styles' => 'yes', 
                            'social_icon_icon_color_this' => '#25D366'
                        ],
                    ],
                    'title_field' => '{{{ social_icon_item_title }}}',
                ]
            );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Icon Wrapper Styling Controls
		$this->start_controls_section(
			'social_icon_wrapper_styling',
			[
				'label' => esc_html__('Icon Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
			$this->add_responsive_control(
				'social_icon_wrapper_gap',
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
						'{{WRAPPER}} .pea-socials' => 'gap: {{SIZE}}{{UNIT}};'
					],
				]
			);
        
            // $this->add_group_control(
            //     \Elementor\Group_Control_Typography::get_type(),
            //     [
            //         'name' => 'social_icon_wrapper_typography',
            //         'selector' => '{{WRAPPER}} .pea-advanced-button',
            //         'fields_options' => [
            //             'typography' => [
            //                 'default' => 'custom',
            //             ],
            //             'font_family' => [
            //                 'default' => 'Work Sans',
            //             ],
            //             'font_weight' => [
            //                 'default' => '500',
            //             ],
            //             'font_size' => [
            //                 'default' => [
            //                     'unit' => 'px',
            //                     'size' => 18,
            //                 ],
            //             ],
            //             'line_height' => [
            //                 'default' => [
            //                     'unit' => '%',
            //                     'size' => 130,
            //                 ],
            //             ],
            //         ],
            //     ]
            // );
		
			$this->start_controls_tabs( 'social_icon_wrapper_tabs' );
				$this->start_controls_tab(
					'social_icon_wrapper_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'social_icon_wrapper_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-social-icon-link',
						]
					);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'     => 'social_icon_wrapper_border_type',
							'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'selector' => '{{WRAPPER}} .pea-social-icon-link',
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
					'social_icon_wrapper_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'social_icon_wrapper_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-social-icon-link:hover',
						]
					);
			
					$this->add_control(
						'social_icon_wrapper_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-social-icon-link:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_control(
				'social_icon_wrapper_hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'social_icon_wrapper_border_radius',
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
                        '{{WRAPPER}} .pea-social-icon-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

			$this->add_responsive_control(
				'social_icon_wrapper_padding',
				[
					'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-social-icon-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'social_icon_wrapper_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-social-icon-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
        
        // Icon Styling Controls
        $this->start_controls_section(
            'social_icon_styling',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'social_icon_size',
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
                        '{{WRAPPER}} .pea-social-icon-wrapper .pea-social-icon i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-social-icon-wrapper .pea-social-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'social_icon_gap',
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
                        '{{WRAPPER}} .pea-social-icon-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'social_icon_tabs' );
				$this->start_controls_tab(
					'social_icon_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					// $this->add_responsive_control(
					// 	'social_icon_rotate',
					// 	[
					// 		'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
					// 		'type' => Controls_Manager::SLIDER,
					// 		'size_units' => ['deg'],
					// 		'range' => [
					// 			'px' => [
					// 				'min' => -360,
					// 				'max' => 360,
					// 				'step' => 1,
					// 			],
					// 		],
					// 		'default' => [
					// 			'unit' => 'deg',
					// 			'size' => -40,
					// 		],
					// 		'selectors'       => [
					// 			'{{WRAPPER}} .pea-social-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
					// 		],
					// 	]
					// );
			
					$this->add_control(
						'social_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-social-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-social-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'social_icon_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-social-icon',
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'social_icon_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-social-icon',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'social_icon_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					// $this->add_responsive_control(
					// 	'social_icon_hover_rotate',
					// 	[
					// 		'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
					// 		'type' => Controls_Manager::SLIDER,
					// 		'size_units' => ['deg'],
					// 		'range' => [
					// 			'px' => [
					// 				'min' => -360,
					// 				'max' => 360,
					// 				'step' => 1,
					// 			],
					// 		],
					// 		'default' => [
					// 			'unit' => 'deg',
					// 			'size' => 0,
					// 		],
					// 		'selectors'       => [
					// 			'{{WRAPPER}} .pea-social-list-item:hover .pea-social-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
					// 		],
					// 	]
					// );
			
					$this->add_control(
						'social_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-social-list-item:hover .pea-social-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-social-list-item:hover .pea-social-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_social_icon_or_img' => 'icon',
							],
						]
					);
				
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'social_icon_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-social-list-item:hover .pea-social-icon',
						]
					);
			
					$this->add_control(
						'social_icon_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-social-list-item:hover .pea-social-icon' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'social_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'social_icon_border_radius',
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
                        '{{WRAPPER}} .pea-social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_icon_padding',
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
                        '{{WRAPPER}} .pea-social-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Social Icon title Styling Controls
        $this->start_controls_section(
            'social_icon_title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
			$this->add_control(
				'social_icon_title_show',
				[
					'label' => esc_html__( 'Title Switcher', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'social_icon_title_typography',
                    'selector' => '{{WRAPPER}} .pea-social-icon-title',
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
					'condition' => [
						'social_icon_title_show' => 'yes'
					]
                ]
            );

            $this->start_controls_tabs( 'social_icon_title_tabs' );
                $this->start_controls_tab(
                    'social_icon_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'condition' => [
							'social_icon_title_show' => 'yes'
						]
                    ]
                );
            
                    $this->add_control(
                        'social_icon_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-social-icon-title' => 'color: {{VALUE}};',
							],
							'condition' => [
								'social_icon_title_show' => 'yes'
							]
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'social_icon_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'condition' => [
							'social_icon_title_show' => 'yes'
						]
                    ]
                );

                    $this->add_control(
                        'social_icon_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-social-icon-link:hover .pea-social-icon-title' => 'color: {{VALUE}};',
							],
							'condition' => [
								'social_icon_title_show' => 'yes'
							]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'social_icon_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
					'condition' => [
						'social_icon_title_show' => 'yes'
					]
                ]
            );

            $this->add_responsive_control(
                'social_icon_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-social-icon-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
					'condition' => [
						'social_icon_title_show' => 'yes'
					]
                ]
            );
        
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
 

		$social_icon_presets = $settings['social_icon_presets']; 
		// $button_alignment = $settings['button_alignment']; 
		// $button_link = $settings['button_link']['url'];
		// $button_target = $settings['button_link']['is_external'] ? ' target=_blank' : '';
		// $button_nofollow = $settings['button_link']['nofollow'] ? ' rel=nofollow' : '';
		// $media_type = $settings['choose_social_icon_or_img'];
		// $link_button_icon = $settings['link_button_icon'];
		// $link_button_position = $settings['link_button_position'];
		
		?>
        <div class="pea-widget-wrapper pea-social-icons-wrapper <?php echo esc_attr($social_icon_presets); ?>">
			<div class="pea-social-links-wrapper">
                <ul class="pea-socials" aria-label="Social Icons">
                    <?php foreach ( $settings['social_icons'] as $index => $icon ) : 
                        $icon_link = $icon['social_icon_item_title_url']['url'];
                        $icon_target = $icon['social_icon_item_title_url']['is_external'] ? ' target=_blank' : '';
                        $icon_nofollow = $icon['social_icon_item_title_url']['nofollow'] ? ' rel=nofollow' : ''; ?>
                        <li class="pea-social-list-item single-social-icon-item-<?php echo esc_attr($index); ?> elementor-repeater-item-<?php echo esc_attr( $icon['_id'] ) ?>">
                            <a class="pea-social-icon-link" 
                                href="<?php echo esc_url($icon_link); ?>"
                                <?php echo esc_attr($icon_target); ?>
                                <?php echo esc_attr($icon_nofollow); ?>
                                aria-label="Social Icon"
                            >
                                <div class="pea-social-icon-wrapper">
                                    <div class="pea-social-icon" aria-hidden="true">
                                        <?php \Elementor\Icons_Manager::render_icon( $icon['social_icon_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                    <?php if($settings['social_icon_title_show'] === 'yes'){ ?>
                                        <span class="pea-social-icon-title" aria-hidden="true"><?php echo esc_html($icon['social_icon_item_title']); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
		</div>
		<?php		
	}
}