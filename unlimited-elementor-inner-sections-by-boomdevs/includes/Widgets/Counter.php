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

class Counter extends Widget_Base {
    
    public function get_name() {
        return 'pea_counter';
    }
    
    public function get_title() {
        return esc_html__('Counter', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_counter_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--counter'];
    }

	public function get_script_depends() {
		return ['prime-elementor-addons--counter'];
	}
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Counter Section
        $this->start_controls_section(
            'counter_settings',
            [
                'label' => esc_html__('Counter Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'preset-5' => 'Preset 5',
                        'preset-6' => 'Preset 6',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'counter_alignment',
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
                        ],
                    ],
                    'default' => 'start',
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_control(
                'counter_start_number',
                [
                    'label' => esc_html__('Starting Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'min' => 0,
                            'max' => 100000,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 0,
                    ],
                ]
            );  
            
            $this->add_control(
                'counter_end_number',
                [
                    'label' => esc_html__('End Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'min' => 0,
                            'max' => 100000,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 250,
                    ],
                ]
            );  
            
            $this->add_control(
                'counter_duration',
                [
                    'label' => esc_html__('Duration', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'min' => 0,
                            'max' => 10000,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 2000,
                    ],
                ]
            );
            
            $this->add_control(
                'counter_prefix',
                [
                    'label' => esc_html__('Counter Prefix', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

			$this->add_control(
				'counter_prefix_text', [
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '+' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
					'condition' => [
						'counter_prefix' => 'yes',
					],
				]
			);
            
            $this->add_control(
                'counter_suffix',
                [
                    'label' => esc_html__('Counter Suffix', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

			$this->add_control(
				'counter_suffix_text', [
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'M' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
					'condition' => [
						'counter_suffix' => 'yes',
					],
				]
			);
            
            $this->add_control(
                'counter_number_separator',
                [
                    'label' => esc_html__('Show Thousands Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'counter_separator_type',
                [
                    'label' => esc_html__('Separator Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'comma' => 'Comma',
                        'space' => 'Space',
                    ],
                    'default' => 'comma',
                    'render_type'  => 'template',
                    'condition' => [
                        'counter_number_separator' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Counter Icon setting Section
        $this->start_controls_section(
            'icon_settings',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

			$this->add_control(
				'counter_icon_type',
				[
					'type' => Controls_Manager::CHOOSE,
					'default' => 'image',
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
                'counter_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-users',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'counter_icon_type' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'counter_image',
                [
                    'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => PEA_PLUGIN_URL . 'assets/images/users-group.svg',
                    ],
                    'condition' => [
                        'counter_icon_type' => 'image',
                    ],
                ]
            );
		
			$this->add_control(
				'counter_image_fit',
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
						'{{WRAPPER}} .pea-counter-icon-wrapper img' => 'object-fit: {{VALUE}};',
					],
                    'condition' => [
                        'counter_icon_type' => 'image',
                    ],
				]
			);
        
        $this->end_controls_section();
        
        // Counter title setting Section
        $this->start_controls_section(
            'counter_title_settings',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'counter_title',
                [
                    'label' => esc_html__('Counter Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'counter_title_tag',
                [
                    'label' => esc_html__('Title Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'default' => 'span',
					'condition' => [
						'counter_title' => 'yes',
					],
                ]
            );

			$this->add_control(
				'counter_title_text', [
                    'label' => esc_html__( 'Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Happy Clients', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
					'condition' => [
						'counter_title' => 'yes',
					],
				]
			);
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Box Styling Controls
        $this->start_controls_section(
            'box_styling',
            [
                'label' => esc_html__('Box', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'icon_position',
                [
                    'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'column' => 'Top',
                        'column-reverse' => 'Bottom',
                        'row' => 'Left',
                        'row-reverse' => 'Right',
                    ],
                    'default' => 'row',
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-item' => 'flex-direction: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'box_content_hori_alignment',
                [
                    'label' => esc_html__('Horizontal Align', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-title' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-counter-number-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'box_content_verti_alignment',
                [
                    'label' => esc_html__('Vertical Align', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-item' => 'align-items: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'box_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-counter-item' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'box_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-counter-item' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'box_tabs' );

            $this->start_controls_tab(
                'box_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'box_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#FFFBF5',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-item' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'box_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-counter-item',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'box_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'box_hover_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-item:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'box_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-item:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'box_border_radius',
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
                        '{{WRAPPER}} .pea-counter-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 42,
                        'right' => 32,
                        'bottom' => 42,
                        'left' => 32,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Icon Styling Controls
        $this->start_controls_section(
            'counter_icon_styling',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_icon_type!' => 'none',
                ],
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
                        'size' => 80,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-counter-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-counter-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-counter-icon-wrapper img' => 'width: {{SIZE}}{{UNIT}}; aspect-ratio:1 / 1;',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'icon_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-counter-item' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'icon_style_tabs' );
            $this->start_controls_tab(
                'icon_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'counter_icon_type' => 'icon',
                    ],
                ]
            );
        
                $this->add_control(
                    'icon_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#F89B2E',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-icon-wrapper i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-counter-icon-wrapper svg' => 'fill: {{VALUE}}',
                        ],
                        'condition' => [
                            'counter_icon_type' => 'icon',
                        ],
                    ]
                );  

            $this->end_controls_tab();

            $this->start_controls_tab(
                'icon_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'counter_icon_type' => 'icon',
                    ],

                ]
            );
        
                $this->add_control(
                    'icon_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-item:hover .pea-counter-icon-wrapper i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-counter-item:hover .pea-counter-icon-wrapper svg' => 'fill: {{VALUE}}',
                        ],
                        'condition' => [
                            'counter_icon_type' => 'icon',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'icon_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Counter Number Styling Controls
        $this->start_controls_section(
            'counter_number_styling',
            [
                'label' => esc_html__('Counter Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'show_icon' => 'yes',
                // ],
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_number_typography',
                    'selector' => '{{WRAPPER}} .pea-counter-number-prefix, {{WRAPPER}} .pea-counter-number, {{WRAPPER}} .pea-counter-number-suffix',
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
                                'size' => 48,
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

            $this->start_controls_tabs( 'counter_number_style_tabs' );
            $this->start_controls_tab(
                'counter_number_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'counter_number_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-number-prefix' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-counter-number' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-counter-number-suffix' => 'color: {{VALUE}}',
                        ],
                    ]
                );  

            $this->end_controls_tab();

            $this->start_controls_tab(
                'counter_number_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'counter_number_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-item:hover .pea-counter-number-prefix' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-counter-item:hover .pea-counter-number' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-counter-item:hover .pea-counter-number-suffix' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'counter_number_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'counter_number_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-number-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Counter Title Styling Controls
        $this->start_controls_section(
            'counter_title_styling',
            [
                'label' => esc_html__('Counter Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'show_icon' => 'yes',
                // ],
            ]
        );  
        
            $this->add_control(
                'counter_title_position',
                [
                    'label' => esc_html__('Title Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'column-reverse' => 'Top',
                        'column' => 'Bottom',
                        'row' => 'Right',
                        'row-reverse' => 'Left',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-content-wrapper' => 'flex-direction: {{VALUE}};',
                    ],
                    'default' => 'column-reverse',
                    'render_type'  => 'template',
                ]
            );

            $this->add_control(
                'counter_left_right_position_css',
                [
                    'label' => esc_html__('counter title left, right postion css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-title' => 'align-items: {{VALUE}};',
                    ],
                    'condition' => [
                        'counter_title_position' => ['row', 'row-reverse'],
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'counter_title_typography',
                    'selector' => '{{WRAPPER}} .pea-counter-title',
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

            $this->start_controls_tabs( 'counter_title_style_tabs' );
            $this->start_controls_tab(
                'counter_title_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'counter_title_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-title' => 'color: {{VALUE}}',
                        ],
                    ]
                );  

            $this->end_controls_tab();

            $this->start_controls_tab(
                'counter_title_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'counter_title_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-counter-item:hover .pea-counter-title' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'counter_title_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'counter_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
    }
    
    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $preset_styles = isset($settings['preset_styles']) ? $settings['preset_styles'] : '' ; 
        $start_number = isset($settings['counter_start_number']) ? $settings['counter_start_number']['size'] : '' ; 
        $end_number = isset($settings['counter_end_number']) ? $settings['counter_end_number']['size'] : '' ; 
        $duration = isset($settings['counter_duration']) ? $settings['counter_duration']['size'] : '' ; 
        $number_separator = isset($settings['counter_number_separator']) ? $settings['counter_number_separator'] : '' ; 
        $number_separator_type = isset($settings['counter_separator_type']) ? $settings['counter_separator_type'] : '' ; 

        ?>
        <div class="pea-widget-wrapper pea-counter-wrapper <?php echo esc_attr($preset_styles); ?>" >
            <div class="pea-counter-item">
                <div class="pea-counter-icon-wrapper">
                    <?php if($settings['counter_icon_type'] === 'icon'){ ?>
                        <div class="pea-counter-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    <?php } elseif($settings['counter_icon_type'] === 'image'){ $image_url = $settings['counter_image']['url']; ?> 
                        <img src="<?php echo esc_url($image_url) ?>" decoding="async" loading="lazy">
                    <?php } ?>
                </div>
                <div class="pea-counter-content-wrapper">
                    <div class="pea-counter-number-wrapper">
                        <?php if($settings['counter_prefix'] === 'yes') { ?>
                            <span class="pea-counter-number-prefix"><?php echo esc_html($settings['counter_prefix_text']) ?></span>
                        <?php } ?>
                        <span class="pea-counter-number" counter-start="<?php echo esc_attr($start_number) ?>" counter-end="<?php echo esc_attr($end_number) ?>" counter-duration="<?php echo esc_attr($duration); ?>" separator-switch="<?php echo esc_attr($number_separator === 'yes' ? 'true' : 'false'); ?>" separator-type="<?php echo esc_attr($number_separator_type); ?>" ><?php echo esc_html($start_number) ?></span>
                        <?php if($settings['counter_suffix'] === 'yes') { ?>
                            <span class="pea-counter-number-suffix"><?php echo esc_html($settings['counter_suffix_text']) ?></span>
                        <?php } ?>
                    </div>
                    <?php if($settings['counter_title'] === 'yes') { ?>
                        <<?php echo esc_attr($settings['counter_title_tag']); ?> class="pea-counter-title"><?php echo esc_html($settings['counter_title_text']) ?></<?php echo esc_attr($settings['counter_title_tag']); ?>>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
}