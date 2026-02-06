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

class AdvancedButton extends Widget_Base {

	public function get_name() {
		return 'pea_advanced_button';
	}

	public function get_title() {
		return esc_html__('Advanced Button', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_advanced_button_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--advanced-button'];
    }

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'button_presets',
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
						'preset-8'      => esc_html__( 'Preset 8', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

			$this->add_responsive_control(
				'button_alignment',
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
						'justify' => [
							'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'toggle'    => true,
					'selectors' => [
						'{{WRAPPER}} .pea-advanced-button-wrapper' => 'text-align: {{VALUE}};',
					],
                    'render_type'  => 'template',
				]
			);
				
			$this->add_control(
				'show_button_text',
				[
					'label' => esc_html__('Show Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'button_text', [
					'label' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Primary Button' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
					'condition' => [
						'show_button_text' => 'yes',
					],
				]
			);

			$this->add_control(
				'button_link',
				[
					'label' => esc_html__( 'Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'show_external' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
						'nofollow' => true,
					],
				]
			);

			$this->add_control(
				'choose_button_icon_or_img',
				[
					'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'icon',
					'options' => [
						'none' => [
							'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-ban',
						],
						'icon' => [
							'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-info-circle',
						],
						'image' => [
							'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-image-bold',
						],
					],
					'label_block' => true,
				]
			);

			$this->add_control(
				'button_image_or_icon_position',
				[
					'label'       => esc_html__( 'Icon / image Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'right',
					'options'     => [
						'left'      => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'right'      => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
					'condition' => [
						'choose_button_icon_or_img!' => 'none',
					],
				]
			);

			$this->add_control(
				'button_icon',
				[
					'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
					'condition' => [
						'choose_button_icon_or_img' => 'icon',
					],
				]
			);

			$this->add_control(
				'button_image',
				[
					'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
					],
					'condition' => [
						'choose_button_icon_or_img' => 'image',
					],
				]
			);
		
			$this->add_control(
				'button_image_fit',
				[
					'label' => esc_html__('Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none' => 'None',
						'fill' => 'Fill',
						'contain' => 'Contain',
						'cover' => 'Cover',
						'scale-down' => 'Scale Down',
					],
					'default' => 'fill',
					'selectors' => [
						'{{WRAPPER}} .pea-advanced-button-icon-image img' => 'object-fit: {{VALUE}};',
					],
					'condition' => [
						'choose_button_icon_or_img' => 'image',
					],
				]
			);

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Button Styling Controls
		$this->start_controls_section(
			'button_styling',
			[
				'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
			$this->add_responsive_control(
				'button_width',
				[
					'label'           => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
						'{{WRAPPER}} .pea-advanced-button' => 'width: {{SIZE}}{{UNIT}};'
					],
				]
			);
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .pea-advanced-button',
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
                                'size' => 130,
                            ],
                        ],
                    ],
                ]
            );
		
			$this->start_controls_tabs( 'button_tabs' );
				$this->start_controls_tab(
					'button_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);

					GradientTextControl::add_control( $this, [
						'name'     => 'button_color',
						'selector' => '{{WRAPPER}} .pea-advanced-button .pea-advanced-button-text',
					]);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'button_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-advanced-button',
						]
					);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'     => 'button_border_type',
							'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'selector' => '{{WRAPPER}} .pea-advanced-button',
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);

					GradientTextControl::add_control( $this, [
						'name'     => 'button_hover_color',
						'selector' => '{{WRAPPER}} .pea-advanced-button:hover .pea-advanced-button-text',
					]);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'button_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label' => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-advanced-button:hover',
						]
					);
			
					$this->add_control(
						'button_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-advanced-button:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_control(
				'hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

			$this->add_responsive_control(
				'button_padding',
				[
					'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-advanced-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-advanced-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'button_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-advanced-button',
                ]
            );

		$this->end_controls_section();
        
        // Icon Styling Controls
        $this->start_controls_section(
            'button_icon_n_image_styling',
            [
                'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'choose_button_icon_or_img!' => 'none',
				],
            ]
        );
            
            $this->add_responsive_control(
                'button_image_width',
                [
                    'label' => esc_html__('Image Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-button-icon-wrapper .pea-advanced-button-icon-image' => 'width: {{SIZE}}{{UNIT}};',
                    ],
					'condition' => [
						'choose_button_icon_or_img' => 'image',
					],
                ]
            );  
            
            $this->add_responsive_control(
                'button_image_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-button-icon-wrapper .pea-advanced-button-icon-image' => 'height: {{SIZE}}{{UNIT}};',
                    ],
					'condition' => [
						'choose_button_icon_or_img' => 'image',
					],
                ]
            );  
            
            $this->add_responsive_control(
                'button_icon_size',
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
                        'size' => 18,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-advanced-button-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
					'condition' => [
						'choose_button_icon_or_img' => 'icon',
					],
                ]
            );  
            
            $this->add_responsive_control(
                'button_icon_n_image_gap',
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
                        '{{WRAPPER}} .pea-advanced-button' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'button_icon_n_image_tabs' );
				$this->start_controls_tab(
					'button_icon_n_image_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					$this->add_responsive_control(
						'button_icon_n_image_rotate',
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
								'size' => -40,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-advanced-button-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'button_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-advanced-button-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-advanced-button-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_button_icon_or_img' => 'icon',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'button_icon_n_image_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-advanced-button-icon-wrapper',
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'button_icon_n_image_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-advanced-button-icon-wrapper',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_icon_n_image_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					$this->add_responsive_control(
						'button_icon_n_image_hover_rotate',
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
								'{{WRAPPER}} .pea-advanced-button:hover .pea-advanced-button-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'button_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-advanced-button:hover .pea-advanced-button-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-advanced-button:hover .pea-advanced-button-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_button_icon_or_img' => 'icon',
							],
						]
					);
				
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'button_icon_n_image_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-advanced-button:hover .pea-advanced-button-icon-wrapper',
						]
					);
			
					$this->add_control(
						'button_icon_n_image_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-advanced-button:hover .pea-advanced-button-icon-wrapper' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'button_icon_n_image_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'button_icon_n_image_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-button-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-advanced-button-icon-wrapper .pea-advanced-button-icon-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_icon_n_image_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-button-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_icon_n_image_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-button-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
 

		$button_presets = $settings['button_presets']; 
		$button_alignment = $settings['button_alignment']; 
		$button_link = $settings['button_link']['url'];
		$button_target = $settings['button_link']['is_external'] ? ' target=_blank' : '';
		$button_nofollow = $settings['button_link']['nofollow'] ? ' rel=nofollow' : '';
		$media_type = $settings['choose_button_icon_or_img'];
		// $link_button_icon = $settings['link_button_icon'];
		// $link_button_position = $settings['link_button_position'];
		
		?>

        <div class="pea-widget-wrapper pea-advanced-button-wrapper <?php echo esc_attr($button_presets); ?> <?php echo esc_attr($button_alignment); ?>">
			<a class="pea-advanced-button" 
				href="<?php echo esc_url($button_link) ?>"
				<?php echo esc_attr($button_target); ?>
				<?php echo esc_attr($button_nofollow); ?>
			>
				<?php if($settings['choose_button_icon_or_img'] !== 'none' && $settings['button_image_or_icon_position'] === 'left' ){ ?>
					<div class="pea-advanced-button-icon-wrapper">
						<?php if($media_type === 'icon'){ ?>
							<div class="pea-advanced-button-icon">
								<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</div>
						<?php } elseif($media_type === 'image'){ $image_url = $settings['button_image']['url']; ?> 
						<div class="pea-advanced-button-icon-image">
							<img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($settings['button_text']) ?>">
						</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if($settings['show_button_text'] == 'yes'){ ?>
					<span class="pea-advanced-button-text" ><?php echo esc_html($settings['button_text']); ?></span>
				<?php } ?>
				<?php if($settings['choose_button_icon_or_img'] !== 'none' && $settings['button_image_or_icon_position'] === 'right' ){ ?>
					<div class="pea-advanced-button-icon-wrapper">
						<?php if($media_type === 'icon'){ ?>
							<div class="pea-advanced-button-icon">
								<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</div>
						<?php } elseif($media_type === 'image'){ $image_url = $settings['button_image']['url']; ?> 
						<div class="pea-advanced-button-icon-image">
							<img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
						</div>
						<?php } ?>
					</div>
				<?php } ?>
			</a>
		</div>
		<?php		
	}
}