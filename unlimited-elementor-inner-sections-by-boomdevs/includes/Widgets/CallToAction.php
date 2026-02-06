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

class CallToAction extends Widget_Base {
	
	public function get_name() {
		return 'pea_cta';
	}

	public function get_title() {
		return esc_html__('Call to action', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_cta_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--call-to-action'];
    }

	protected function register_controls() { 
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Presets Section
        $this->start_controls_section(
            'presets',
            [
                'label' => esc_html__('Presets', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'preset_styles',
                [
                    'label' => esc_html__('Preset Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => 'Preset 1',
                        'preset-2' => 'Preset 2',
                        'preset-3' => 'Preset 3',
                        'preset-4' => 'Preset 4',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'cta_background',
                    'types'     => [ 'classic' ],
                    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                    'exclude'        => [ 'color' ],
                    'fields_options' => [
                        'background' => [
						    'default' => 'classic',
                            'label'     => __( 'Background Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        ],
                        'image' => [
                            'default' => [
                                'url' => PEA_PLUGIN_URL . 'assets/images/call-to-action/cta-1-bg.jpg',
                            ],
                        ],
                        'size' => [
                            'default' => 'cover',
                        ],
                        'position' => [
                            'default' => 'center center',
                        ],
                    ],
                    'selector'  => '{{WRAPPER}} .pea-call-to-action-wrapper',
                ]
            );
        
        $this->end_controls_section();
        
        // Title Section
        $this->start_controls_section(
            'cta_title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_cta_title',
                [
                    'label' => esc_html__('Show Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_responsive_control(
                'cta_title_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-heading' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_cta_title' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'cta_title_tag',
                [
                    'label' => esc_html__('Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'p' => 'p',
                    ],
                    'default' => 'h2',
                    'condition' => [
                        'show_cta_title' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'cta_title_text',
                [
                    'label' => esc_html__( 'Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'We are help you to grow up',
                    'placeholder' => esc_html__( 'Type info box title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_cta_title' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Description Section
        $this->start_controls_section(
            'cta_description',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_cta_description',
                [
                    'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_responsive_control(
                'cta_description_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-description' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_cta_description' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'cta_description_text',
                [
                    'label' => esc_html__( 'Description Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Lorem ipsum dolor sit amet consectetur. Ac aliquam mauris nulla non senectus mauris bibendum. Libero risus ultrices feugiat blandit quis justo vitae facilisi.',
                    'placeholder' => esc_html__( 'Type call to action description here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_cta_description' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Button One Section
        $this->start_controls_section(
            'button',
            [
                'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_responsive_control(
                'buttons_alignment',
                [
                    'label' => esc_html__('Buttons Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-buttons-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'render_type'  => 'template',
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'show_button',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                            [
                                'name'     => 'show_button_two',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_control(
                'show_button',
                [
                    'label' => esc_html__('Show Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
	
            $this->add_control(
                'button_text', [
                    'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Get Start' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_button' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'button_link',
                [
                    'label' => esc_html__( 'Button Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'show_external' => true,
                    'condition' => [
                        'show_button' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_button_icon',
                [
                    'label' => esc_html__('Show Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'show_button' => 'yes',
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
                        'show_button_icon' => 'yes',
                        'show_button' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'button_icon_position',
                [
                    'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'right' => 'Right',
                        'left' => 'Left',
                    ],
                    'default' => 'right',
                    'condition' => [
                        'show_button_icon' => 'yes',
                        'show_button' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Button two Section
        $this->start_controls_section(
            'button_two',
            [
                'label' => esc_html__('Button Two', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_button_two',
                [
                    'label' => esc_html__('Show Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
	
            $this->add_control(
                'button_two_text', [
                    'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Learn More' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_button_two' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'button_two_link',
                [
                    'label' => esc_html__( 'Button Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'show_external' => true,
                    'condition' => [
                        'show_button_two' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_button_two_icon',
                [
                    'label' => esc_html__('Show Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'show_button_two' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'button_two_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'show_button_two_icon' => 'yes',
                        'show_button_two' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'button_two_icon_position',
                [
                    'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'right' => 'Right',
                        'left' => 'Left',
                    ],
                    'default' => 'right',
                    'condition' => [
                        'show_button_two_icon' => 'yes',
                        'show_button_two' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================   
        
        // Call to Action Container Styling Controls
		$this->start_controls_section(
			'cta_box_settings',
			[
				'label' => __( 'Container', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'cta_box_overlay_background',
				'label'     => __( 'Background Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'types'          => [ 'classic', 'gradient' ],
                // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '',
					],
				],
				'selector'  => '{{WRAPPER}} .pea-call-to-action-wrapper::before',
			]
		);

		$this->add_responsive_control(
			'cta_box_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .pea-call-to-action-wrapper::before' => 'opacity: {{SIZE}};',
				]
			]
		);
					
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'cta_box_border_type',
                'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-call-to-action-wrapper',
            ]
        );

		$this->add_responsive_control(
			'cta_box_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 24,
                    'right' => 24,
                    'bottom' => 24,
                    'left' => 24,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .pea-call-to-action-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-call-to-action-wrapper::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					// '{{WRAPPER}} .pea-cta-content-wrapper-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_padding',
			[
				'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-call-to-action-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-call-to-action-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'cta_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'selector' => '{{WRAPPER}} .pea-call-to-action-wrapper',
            ]
        );

		$this->end_controls_section();
        
        // title Styling Controls
        $this->start_controls_section(
            'cta_title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cta_title_typography',
                    'selector' => '{{WRAPPER}} .pea-cta-heading',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '700',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 42,
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

            $this->start_controls_tabs( 'cta_title_tabs' );
                $this->start_controls_tab(
                    'cta_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'cta_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-heading' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'cta_title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-cta-heading',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'cta_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'cta_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-cta-heading' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'cta_title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-cta-heading' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'cta_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'cta_title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 24,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'cta_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Call to action Description Styling Controls
        $this->start_controls_section(
            'cta_desc_styling',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_cta_description' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cta_desc_typography',
                    'selector' => '{{WRAPPER}} .pea-cta-description',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
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

            $this->start_controls_tabs( 'cta_desc_tabs' );
                $this->start_controls_tab(
                    'cta_desc_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'cta_desc_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'cta_desc_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'cta_desc_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-cta-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'cta_desc_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'cta_desc_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_desc_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 150,
                        'bottom' => 0,
                        'left' => 150,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Button One Styling Controls
        $this->start_controls_section(
            'cta_button_styling', 
            [
                'label' => esc_html__('Button One', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cta_button_typography',
                    'selector' => '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-button span',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '600',
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

            $this->start_controls_tabs( 'cta_button_tabs' );
                $this->start_controls_tab(
                    'cta_button_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'cta_button_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-button span' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'cta_button_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'cta_button_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 1,
                                        'right' => 1,
                                        'bottom' => 1,
                                        'left' => 1,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#FFFFFF',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'cta_button_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'cta_button_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-button:hover span' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'cta_button_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'transparent',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper:hover' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'cta_button_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper:hover' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'cta_button_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'cta_button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'cta_button_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'cta_button_icon_title',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->start_controls_tabs( 'cta_button_icon_tabs' );
                $this->start_controls_tab(
                    'cta_button_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'cta_button_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'cta_button_icon_size',
                        [
                            'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['%', 'px', 'em', 'rem'],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 0,
                                    'max' => 250,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-btn-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-btn-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );  
            
                    $this->add_responsive_control(
                        'cta_button_icon_rotate',
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
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'cta_button_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'cta_button_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper:hover .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper:hover .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'cta_button_icon_hover_rotate',
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
                                '{{WRAPPER}} .pea-cta-btn-one-wrapper .pea-cta-btn-wrapper:hover .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
        $this->end_controls_section();
        
        // Button Two Styling Controls
        $this->start_controls_section(
            'cta_button_two_styling', 
            [
                'label' => esc_html__('Button Two', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button_two' => 'yes',
                ],
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cta_button_two_typography',
                    'selector' => '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-button span',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '600',
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

            $this->start_controls_tabs( 'cta_button_two_tabs' );
                $this->start_controls_tab(
                    'cta_button_two_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'cta_button_two_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-button span' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button_two' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'cta_button_two_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'transparent',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button_two' => 'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'cta_button_two_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 1,
                                        'right' => 1,
                                        'bottom' => 1,
                                        'left' => 1,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#FFFFFF',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'cta_button_two_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'cta_button_two_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-button:hover span' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button_two' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'cta_button_two_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper:hover' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button_two' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'cta_button_two_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper:hover' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'cta_button_two_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'cta_button_two_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_button_two_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cta_button_two_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'cta_button_two_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'cta_button_two_icon_title',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->start_controls_tabs( 'cta_button_two_icon_tabs' );
                $this->start_controls_tab(
                    'cta_button_two_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'cta_button_two_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'cta_button_two_icon_size',
                        [
                            'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['%', 'px', 'em', 'rem'],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 0,
                                    'max' => 250,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-btn-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-btn-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );  
            
                    $this->add_responsive_control(
                        'cta_button_two_icon_rotate',
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
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'cta_button_two_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'cta_button_two_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper:hover .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper:hover .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'cta_button_two_icon_hover_rotate',
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
                                '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper:hover .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $preset_styles = isset($settings['preset_styles']) ? $settings['preset_styles'] : '' ;
        $show_title = isset($settings['show_cta_title']) ? $settings['show_cta_title'] : '' ;  
        $show_desc = isset($settings['show_cta_desc']) ? $settings['show_cta_desc'] : '' ;  
        $show_button = isset($settings['show_button']) ? $settings['show_button'] : '' ;  
        $show_button_two = isset($settings['show_button_two']) ? $settings['show_button_two'] : '' ;  
        $title = isset($settings['cta_title_text']) ? $settings['cta_title_text'] : '' ;  
        $title_tag = isset($settings['cta_title_tag']) ? $settings['cta_title_tag'] : '' ;  
        $description = isset($settings['cta_description_text']) ? $settings['cta_description_text'] : '' ;
        $button_text = isset($settings['button_text']) ? $settings['button_text'] : '' ;  
        $button_link = isset($settings['button_link']['url']) ? $settings['button_link']['url'] : '' ;
        $button_target = isset($settings['button_link']['is_external']) && $settings['button_link']['is_external'] === 'on' ? ' target=_blank' : '';
        $button_nofollow = isset($settings['button_link']['nofollow']) && $settings['button_link']['is_external'] === 'on' ? ' rel=nofollow' : '';
        $button_icon = isset($settings['button_icon']) ? $settings['button_icon'] : '' ;  
        $button_two_text = isset($settings['button_two_text']) ? $settings['button_two_text'] : '' ;  
        $button_two_link = isset($settings['button_two_link']['url']) ? $settings['button_two_link']['url'] : '' ;
        $button_two_target = isset($settings['button_two_link']['is_external']) && $settings['button_two_link']['is_external'] === 'on' ? ' target=_blank' : '';
        $button_two_nofollow = isset($settings['button_two_link']['nofollow']) && $settings['button_two_link']['is_external'] === 'on' ? ' rel=nofollow' : '';
        $button_two_icon = isset($settings['button_two_icon']) ? $settings['button_two_icon'] : '' ;  
        ?>
        <div class="pea-widget-wrapper pea-call-to-action-wrapper <?php echo esc_attr($preset_styles); ?>" >
            <div class="pea-cta-content-wrapper-inner">
                <div class="pea-cta-content-wrapper">
                    <?php if($settings['show_cta_title'] === 'yes'){ ?>
                        <<?php echo esc_attr($title_tag); ?> placeholder="CTA Title" class="pea-cta-heading">
                           <?php echo esc_html($title); ?>
                        </<?php echo esc_attr($title_tag); ?>>
                    <?php } ?>
                    <?php if($settings['show_cta_description'] === 'yes'){ ?>
                        <p placeholder="CTA Description" class="pea-cta-description">
                            <?php echo esc_html($description); ?> 
                        </p>
                    <?php } ?>
                    <div class="pea-cta-buttons-wrapper">
                        <?php if($show_button === 'yes'){ ?>
                            <div class="pea-cta-btn-one-wrapper">
                                <a class="pea-cta-button" 
                                    href="<?php echo esc_url($button_link) ?>"
                                    <?php echo esc_attr($button_target); ?>
                                    <?php echo esc_attr($button_nofollow); ?>
                                >
                                    <div class="pea-cta-btn-wrapper">
                                        <?php if($settings['show_button_icon'] === 'yes' && $settings['button_icon_position'] === 'left'){ ?>
                                            <div class="pea-btn-icon-wrapper">
                                                <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if(!empty($button_text)){ ?>
                                                <span placeholder="CTA Button">
                                                    <?php echo esc_html($button_text); ?>
                                                </span>
                                        <?php } ?>
                                        <?php if($settings['show_button_icon'] === 'yes' && $settings['button_icon_position'] === 'right'){ ?>
                                            <div class="pea-btn-icon-wrapper">
                                                <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                        <?php if($show_button_two === 'yes'){ ?>
                            <div class="pea-cta-btn-two-wrapper">
                                <a class="pea-cta-button" 
                                    href="<?php echo esc_url($button_two_link) ?>"
                                    <?php echo esc_attr($button_two_target); ?>
                                    <?php echo esc_attr($button_two_nofollow); ?>
                                >
                                    <div class="pea-cta-btn-wrapper">
                                        <?php if($settings['show_button_two_icon'] === 'yes' && $settings['button_two_icon_position'] === 'left'){ ?>
                                            <div class="pea-btn-icon-wrapper">
                                                <?php \Elementor\Icons_Manager::render_icon( $button_two_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if(!empty($button_two_text)){ ?>
                                                <span placeholder="CTA Button">
                                                    <?php echo esc_html($button_two_text); ?>
                                                </span>
                                        <?php } ?>
                                        <?php if($settings['show_button_two_icon'] === 'yes' && $settings['button_two_icon_position'] === 'right'){ ?>
                                            <div class="pea-btn-icon-wrapper">
                                                <?php \Elementor\Icons_Manager::render_icon( $button_two_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
	}
}