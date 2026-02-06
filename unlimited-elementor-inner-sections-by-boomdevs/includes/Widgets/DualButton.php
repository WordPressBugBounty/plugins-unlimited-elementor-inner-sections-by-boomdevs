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

class DualButton extends Widget_Base {

	public function get_name() {
		return 'pea_dual_button';
	}

	public function get_title() {
		return esc_html__('Dual Button', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'eicon-dual-button';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--dual-button'];
    }

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
		$this->start_controls_section(
			'preset_section',
			[
				'label' => esc_html__( 'Presets', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'button_presets',
				[
					'label'       => esc_html__( 'Presets Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
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
					],
					'toggle'    => true,
					'selectors' => [
						'{{WRAPPER}} .pea-dual-button-wrapper' => 'justify-content: {{VALUE}};',
						'{{WRAPPER}} .pea-dual-button-one-wrapper' => 'text-align: {{VALUE}};',
						'{{WRAPPER}} .pea-dual-button-two-wrapper' => 'text-align: {{VALUE}};',
					],
                    'render_type'  => 'template',
				]
			);

		$this->end_controls_section();
        
        // Button One Controls
		$this->start_controls_section(
			'button_one_section',
			[
				'label' => esc_html__('Button One', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_CONTENT, 
			]
		);

			$this->add_control(
				'button_one_text', [
					'label' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Button One' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'button_one_link',
				[
					'label' => esc_html__( 'Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::URL,
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
				'choose_button_one_icon_or_img',
				[
					'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'none',
					'options' => [
						'none' => [
							'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-ban',
						],
						'icon' => [
							'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-info-circle',
						],
						// 'image' => [
						// 	'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
						// 	'icon' => 'eicon-image-bold',
						// ],
					],
					'label_block' => true,
				]
			);

			$this->add_control(
				'button_one_image_or_icon_position',
				[
					'label'       => esc_html__( 'Icon / image Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'left',
					'options'     => [
						'left'      => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'right'      => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
					'condition' => [
						'choose_button_one_icon_or_img!' => 'none',
					],
				]
			);

			$this->add_control(
				'button_one_icon',
				[
					'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-left',
                        'library' => 'fa-solid',
                    ],
					'condition' => [
						'choose_button_one_icon_or_img' => 'icon',
					],
				]
			);

			// $this->add_control(
			// 	'button_one_image',
			// 	[
			// 		'label'   => esc_html__( 'Gallery Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			// 		'type'    => Controls_Manager::MEDIA,
			// 		'default' => [
			// 			'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
			// 		],
			// 		'condition' => [
			// 			'choose_button_one_icon_or_img' => 'image',
			// 		],
			// 	]
			// );
		
			// $this->add_control(
			// 	'button_one_image_fit',
			// 	[
			// 		'label' => esc_html__('Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
			// 		'type' => \Elementor\Controls_Manager::SELECT,
			// 		'options' => [
			// 			'none' => 'None',
			// 			'fill' => 'Fill',
			// 			'contain' => 'Contain',
			// 			'cover' => 'Cover',
			// 			'scale-down' => 'Scale Down',
			// 		],
			// 		'default' => 'fill',
			// 		'selectors' => [
			// 			'{{WRAPPER}} .pea-advanced-button-icon-image img' => 'object-fit: {{VALUE}};',
			// 		],
			// 		'condition' => [
			// 			'choose_button_one_icon_or_img' => 'image',
			// 		],
			// 	]
			// );

		$this->end_controls_section();
        
        // Connector Controls
		$this->start_controls_section(
			'connector_section',
			[
				'label' => esc_html__('Connector', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_CONTENT, 
			]
		);
				
			$this->add_control(
				'show_connector_text',
				[
					'label' => esc_html__('Show Connector', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'connector_text', [
					'label' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Or' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
					'condition' => [
						'show_connector_text' => 'yes',
					],
				]
			);

		$this->end_controls_section();
        
        // Button Two Controls
		$this->start_controls_section(
			'button_two_section',
			[
				'label' => esc_html__('Button Two', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_CONTENT, 
			]
		);

			$this->add_control(
				'button_two_text', [
					'label' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Button Two' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'button_two_link',
				[
					'label' => esc_html__( 'Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::URL,
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
				'choose_button_two_icon_or_img',
				[
					'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'none',
					'options' => [
						'none' => [
							'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-ban',
						],
						'icon' => [
							'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-info-circle',
						],
						// 'image' => [
						// 	'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
						// 	'icon' => 'eicon-image-bold',
						// ],
					],
					'label_block' => true,
				]
			);

			$this->add_control(
				'button_two_image_or_icon_position',
				[
					'label'       => esc_html__( 'Icon / image Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'right',
					'options'     => [
						'left'      => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'right'      => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
					'condition' => [
						'choose_button_two_icon_or_img!' => 'none',
					],
				]
			);

			$this->add_control(
				'button_two_icon',
				[
					'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
					'condition' => [
						'choose_button_two_icon_or_img' => 'icon',
					],
				]
			);

			// $this->add_control(
			// 	'button_two_image',
			// 	[
			// 		'label'   => esc_html__( 'Gallery Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			// 		'type'    => Controls_Manager::MEDIA,
			// 		'default' => [
			// 			'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
			// 		],
			// 		'condition' => [
			// 			'choose_button_two_icon_or_img' => 'image',
			// 		],
			// 	]
			// );
		
			// $this->add_control(
			// 	'button_two_image_fit',
			// 	[
			// 		'label' => esc_html__('Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
			// 		'type' => \Elementor\Controls_Manager::SELECT,
			// 		'options' => [
			// 			'none' => 'None',
			// 			'fill' => 'Fill',
			// 			'contain' => 'Contain',
			// 			'cover' => 'Cover',
			// 			'scale-down' => 'Scale Down',
			// 		],
			// 		'default' => 'fill',
			// 		'selectors' => [
			// 			'{{WRAPPER}} .pea-advanced-button-icon-image img' => 'object-fit: {{VALUE}};',
			// 		],
			// 		'condition' => [
			// 			'choose_button_two_icon_or_img' => 'image',
			// 		],
			// 	]
			// );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Button Styling Controls
		$this->start_controls_section(
			'buttons_styling',
			[
				'label' => esc_html__('Buttons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
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
						'size' => 100,
						'unit' => '%',
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
						'{{WRAPPER}} .pea-dual-button-wrapper .pea-advanced-button' => 'width: {{SIZE}}{{UNIT}};'
					],
				]
			);

			$this->add_control(
				'button_direction',
				[
					'label'       => esc_html__( 'Direction', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'row',
					'options'     => [
						'row'      => esc_html__( 'Vertical', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'column'      => esc_html__( 'Horizontal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
					'selectors' => [
						'{{WRAPPER}} .pea-dual-button-wrapper' => 'flex-direction: {{VALUE}};',
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
		
			$this->add_responsive_control(
				'button_gap',
				[
					'label'           => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type'            => Controls_Manager::SLIDER,
					'size_units'      => [ 'px', '%', 'em', 'rem' ],
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
						'{{WRAPPER}} .pea-dual-button-wrapper' => 'gap: {{SIZE}}{{UNIT}};'
					],
				]
			);


		$this->end_controls_section();
        
        // Button One Styling Controls
		$this->start_controls_section(
			'button_one_styling',
			[
				'label' => esc_html__('Button One', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
			$this->start_controls_tabs( 'button_one_tabs' );
				$this->start_controls_tab(
					'button_one_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
			
					$this->add_control(
						'button_one_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-text' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_one_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one' => 'background-color: {{VALUE}};',
							],
						]
					);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'     => 'button_one_border_type',
							'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'selector' => '{{WRAPPER}} .pea-dual-button-one',
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_one_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
			
					$this->add_control(
						'button_one_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one:hover  .pea-advanced-button-text' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_one_hover_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_one_hover_border_color',
						[
							'label' => esc_html__('border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_control(
				'button_one_hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'button_one_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 50,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 50,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
        
        // Button One Icon Styling Controls
        $this->start_controls_section(
            'button_one_icon_styling',
            [
                'label' => esc_html__('Button One Icon ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'choose_button_one_icon_or_img!' => 'none',
				],
            ]
        );
            
            $this->add_responsive_control(
                'button_one_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                        'size' => 16,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'button_one_icon_gap',
                [
                    'label' => esc_html__('spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} .pea-dual-button-one ' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'button_one_icon_tabs' );
				$this->start_controls_tab(
					'button_one_icon_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					$this->add_responsive_control(
						'button_one_icon_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::SLIDER,
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
								'{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'button_one_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_button_one_icon_or_img' => 'icon',
							],
						]
					);
			
					$this->add_control(
						'button_one_icon_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'button_one_icon_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_one_icon_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					$this->add_responsive_control(
						'button_one_icon_hover_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::SLIDER,
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
								'{{WRAPPER}}  .pea-dual-button-one:hover .pea-advanced-button-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'button_one_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one:hover .pea-advanced-button-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-dual-button-one:hover .pea-advanced-button-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_button_one_icon_or_img' => 'icon',
							],
						]
					);
			
					$this->add_control(
						'button_one_icon_hover_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one:hover .pea-advanced-button-icon-wrapper' => 'background-color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_one_icon_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-one:hover .pea-advanced-button-icon-wrapper' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'button_one_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'button_one_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_one_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_one_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-one .pea-advanced-button-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Connector Styling Controls
        $this->start_controls_section(
            'connector_styling',
            [
                'label' => esc_html__('Connector', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_connector_text' => 'yes',
				],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'connector_typography',
                    'selector' => '{{WRAPPER}} .pea-dual-button-connector-text',
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

            $this->start_controls_tabs( 'connector_tabs' );
				$this->start_controls_tab(
					'connector_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
			
					$this->add_control(
						'connector_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-connector-text' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'connector_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-connector-text' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'connector_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-dual-button-connector-text',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'connector_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
			
					$this->add_control(
						'connector_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-connector-text:hover' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'connector_hover_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-connector-text:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'connector_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-connector-text:hover' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'connector_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'connector_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-connector-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'connector_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-connector-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'connector_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-connector-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Button Two Styling Controls
		$this->start_controls_section(
			'button_two_styling',
			[
				'label' => esc_html__('Button Two', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
		
			$this->start_controls_tabs( 'button_two_tabs' );
				$this->start_controls_tab(
					'button_two_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
			
					$this->add_control(
						'button_two_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-text' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_two_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two' => 'background-color: {{VALUE}};',
							],
						]
					);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'     => 'button_two_border_type',
							'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'selector' => '{{WRAPPER}} .pea-dual-button-two',
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_two_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
			
					$this->add_control(
						'button_two_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two:hover  .pea-advanced-button-text' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_two_hover_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_two_hover_border_color',
						[
							'label' => esc_html__('border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_control(
				'button_two_hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'button_two_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 50,
                        'bottom' => 50,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
        
        // Button Two Icon Styling Controls
        $this->start_controls_section(
            'button_two_icon_styling',
            [
                'label' => esc_html__('Button Two Icon ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'choose_button_two_icon_or_img!' => 'none',
				],
            ]
        );
            
            $this->add_responsive_control(
                'button_two_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                        'size' => 16,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'button_two_icon_gap',
                [
                    'label' => esc_html__('spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                        '{{WRAPPER}} .pea-dual-button-two ' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'button_two_icon_tabs' );
				$this->start_controls_tab(
					'button_two_icon_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					$this->add_responsive_control(
						'button_two_icon_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::SLIDER,
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
								'{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'button_two_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_button_two_icon_or_img' => 'icon',
							],
						]
					);
			
					$this->add_control(
						'button_two_icon_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'button_two_icon_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_two_icon_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					$this->add_responsive_control(
						'button_two_icon_hover_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::SLIDER,
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
								'{{WRAPPER}}  .pea-dual-button-two:hover .pea-advanced-button-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'button_two_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two:hover .pea-advanced-button-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-dual-button-two:hover .pea-advanced-button-icon svg' => 'fill: {{VALUE}};',
							],
							'condition' => [
								'choose_button_two_icon_or_img' => 'icon',
							],
						]
					);
			
					$this->add_control(
						'button_two_icon_hover_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two:hover .pea-advanced-button-icon-wrapper' => 'background-color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'button_two_icon_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-dual-button-two:hover .pea-advanced-button-icon-wrapper' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'button_two_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'button_two_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_two_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_two_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-dual-button-two .pea-advanced-button-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
 

		$button_presets = $settings['button_presets']; 
		// Button One
		$button_one_text = $settings['button_one_text'];
		$button_one_link = $settings['button_one_link']['url'];
		$button_one_target = $settings['button_one_link']['is_external'] ? ' target=_blank' : '';
		$button_one_nofollow = $settings['button_one_link']['nofollow'] ? ' rel=nofollow' : '';
		$button_one_media_type = $settings['choose_button_one_icon_or_img'];
		$button_one_media_position = $settings['button_one_image_or_icon_position'];
		$button_one_icon = $settings['button_one_icon'];
		// Button Two
		$button_two_text = $settings['button_two_text'];
		$button_two_link = $settings['button_two_link']['url'];
		$button_two_target = $settings['button_two_link']['is_external'] ? ' target=_blank' : '';
		$button_two_nofollow = $settings['button_two_link']['nofollow'] ? ' rel=nofollow' : '';
		$button_two_media_type = $settings['choose_button_two_icon_or_img'];
		$button_two_media_position = $settings['button_two_image_or_icon_position'];
		$button_two_icon = $settings['button_two_icon'];
		// Connector 
		$connector_on = $settings['show_connector_text'];
		$connector_text = $settings['connector_text'];
		?>
		<div class="pea-widget-wrapper pea-dual-button-wrapper <?php echo esc_attr($button_presets); ?>">
			<div class="pea-dual-button-one-wrapper">
				<a class="pea-advanced-button pea-dual-button-one" 
					href="<?php echo esc_url($button_one_link) ?>"
					<?php echo esc_attr($button_one_target); ?>
					<?php echo esc_attr($button_one_nofollow); ?>
				>
					<?php if($button_one_media_type !== 'none' && $button_one_media_position === 'left' ){ ?>
						<div class="pea-advanced-button-icon-wrapper">
							<?php if($button_one_media_type === 'icon'){ ?>
								<div class="pea-advanced-button-icon">
									<?php \Elementor\Icons_Manager::render_icon( $button_one_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<span class="pea-advanced-button-text"><?php echo esc_html($button_one_text); ?></span>
					<?php if($button_one_media_type !== 'none' && $button_one_media_position === 'right' ){ ?>
						<div class="pea-advanced-button-icon-wrapper">
							<?php if($button_one_media_type === 'icon'){ ?>
								<div class="pea-advanced-button-icon">
									<?php \Elementor\Icons_Manager::render_icon( $button_one_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</a>
			</div><?php if($connector_on === 'yes'){ ?>
				<div class="pea-dual-button-connector">
					<span class="pea-dual-button-connector-text"><?php echo esc_html($connector_text); ?></span>
				</div>
			<?php } ?>
			<div class="pea-dual-button-two-wrapper">
				<a class="pea-advanced-button pea-dual-button-two"
					href="<?php echo esc_url($button_two_link) ?>"
					<?php echo esc_attr($button_two_target); ?>
					<?php echo esc_attr($button_two_nofollow); ?>
				>
					<?php if($button_two_media_type !== 'none' && $button_two_media_position === 'left' ){ ?>
						<div class="pea-advanced-button-icon-wrapper">
							<?php if($button_two_media_type === 'icon'){ ?>
								<div class="pea-advanced-button-icon">
									<?php \Elementor\Icons_Manager::render_icon( $button_two_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<span class="pea-advanced-button-text"><?php echo esc_html($button_two_text); ?></span>
					<?php if($button_two_media_type !== 'none' && $button_two_media_position === 'right' ){ ?>
						<div class="pea-advanced-button-icon-wrapper">
							<?php if($button_two_media_type === 'icon'){ ?>
								<div class="pea-advanced-button-icon">
									<?php \Elementor\Icons_Manager::render_icon( $button_two_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</a>
			</div>
		</div>
		<?php		
	}
}