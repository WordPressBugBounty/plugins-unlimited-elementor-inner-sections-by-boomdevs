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

class CountDown extends Widget_Base {
    
    public function get_name() {
        return 'pea_count_down';
    }
    
    public function get_title() {
        return esc_html__('Countdown', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_count_down_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['count down', 'count', 'down', 'advanced'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--count-down'];
    }

	public function get_script_depends() {
		return ['prime-elementor-addons--count-down'];
	}
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__('General', 'unlimited-elementor-inner-sections-by-boomdevs'),
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

            $this->add_control(
                'count_down_date_n_time',
                [
                    'label' => __( 'Select Date & Time', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DATE_TIME,
                    'default' => '2027-12-31 23:59',
                ]
            );
            
            $this->add_control(
                'show_days',
                [
                    'label' => esc_html__('Show days', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_hours',
                [
                    'label' => esc_html__('Show Hours', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_minutes',
                [
                    'label' => esc_html__('Show Minutes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'show_seconds',
                [
                    'label' => esc_html__('Show Seconds', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();
        
        // Layout setting Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'layout_type',
                [
                    'label' => esc_html__('Layout Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'grid' => 'Grid',
                        'flex' => 'Flex',
                    ],
                    'default' => 'flex',
                    'render_type'  => 'template',
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'display:{{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'column_number',
                [
                    'label' => esc_html__('Column Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'step' => 1,
                            'min' => 1,
                            'max' => 4,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 4,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'grid-template-columns:repeat({{SIZE}}, 1fr);',
                    ],
                    'condition' => [
                        'layout_type' => 'grid',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'item_gap',
                [
                    'label' => esc_html__('Item Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 400,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 104,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->add_control(
                'flex_wrap',
                [
                    'label' => esc_html__('Flex Wrap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'layout_type' => 'flex',
                    ],
                ]
            );

            $this->add_control(
                'flex_wrap_css',
                [
                    'label' => esc_html__('flex_wrap css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'wrap',
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'flex-wrap: {{VALUE}};',
                    ],
                    'condition' => [
                        'flex_wrap' => 'yes',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'flex_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-start-h',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-center-h',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-end-h',
                        ],
                        'space-between' => [
                            'title' => esc_html__('Space Between', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-space-between-h',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                    'condition' => [
                        'layout_type' => 'flex',
                    ],
                ]
            );  
        
        $this->end_controls_section();
        
        // Labels Section
        $this->start_controls_section(
            'labels_section',
            [
                'label' => esc_html__('Labels', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
			$this->add_control(
				'days_text', [
                    'label' => esc_html__( 'Days', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Days', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'hours_text', [
                    'label' => esc_html__( 'Hours', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Hours', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'minutes_text', [
                    'label' => esc_html__( 'Minutes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Minutes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'seconds_text', [
                    'label' => esc_html__( 'Seconds', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Seconds', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_block' => true,
				]
			);

        $this->end_controls_section();
        
        // Separator Section
        $this->start_controls_section(
            'separator_section',
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'showa_separator',
                [
                    'label' => esc_html__('Show Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'count_box_size_with_height_css',
                [
                    'label' => esc_html__('counter title left, right postion css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'none',
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item:before' => 'content: {{VALUE}};',
                    ],
                    'condition' => [
                        'showa_separator!' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'separator_type',
                [
                    'label' => esc_html__('Separator Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'colon'  => 'Colon',
                        'line'   => 'Line',
                        'slash'  => 'Slash',
                        'custom' => 'Custom',
                    ],
                    'default' => 'colon',
                    'selectors_dictionary' => [
                        'colon'  => '" :"',
                        'line'   => '" |"',
                        'slash'  => '" /"',
                    ],
                    'condition' => [
                        'showa_separator' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item:before' => 'content: {{VALUE}};',
                    ],
                ]
            );
			$this->add_control(
                'custom_separator',
                [
                    'label' => esc_html__('Custom Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'condition' => [
                        'showa_separator' => 'yes',
                        'separator_type' => 'custom',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item:before' => 'content: "{{VALUE}}";',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Box Styling Controls
		$this->start_controls_section(
			'count_down_wrapper_styling',
			[
				'label' => esc_html__( 'Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            $this->start_controls_tabs( 'count_down_wrapper_tabs' );
                $this->start_controls_tab(
                    'count_down_wrapper_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                $this->add_control(
                    'count_down_wrapper_bg_type_popover_toggle',
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
                            'name'      => 'count_down_wrapper_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#399cff', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-count-down-wrapper',
                        ]
                    );
                $this->end_popover();
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'count_down_wrapper_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-count-down-wrapper',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'count_down_wrapper_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'count_down_wrapper_hover_bg_type_popover_toggle',
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
                                'name'      => 'count_down_wrapper_hover_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '',
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover',
                            ]
                        );
                    $this->end_popover();
        
                    $this->add_control(
                        'count_down_wrapper_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'count_down_wrapper_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'count_down_wrapper_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 14,
                        'right' => 14,
                        'bottom' => 14,
                        'left' => 14,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'count_down_wrapper_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 24,
                        'right' => 42,
                        'bottom' => 24,
                        'left' => 42,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_down_wrapper_margin',
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
                        '{{WRAPPER}} .pea-count-down-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            //  $this->add_group_control(
            //     Group_Control_Box_Shadow::get_type(),
            //     [
            //         'name'     => 'count_down_wrapper_shadow',
            //         'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			// 	    'selector' => '{{WRAPPER}} .pea-count-down-wrapper',
            //     ]
            // );    

		$this->end_controls_section();
        $this->start_controls_section(
            'count_box_styling',
            [
                'label' => esc_html__('Count Box', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'count_box_size',
                [
                    'label' => esc_html__('Box Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-item' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-count-down-item.item-with-height' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                'count_box_size_with_height_enable',
                [
                    'label' => esc_html__('Box Size With Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'render_type'  => 'template',
                ]
            );

            // $this->add_control(
            //     'count_box_size_with_height_css',
            //     [
            //         'label' => esc_html__('counter title left, right postion css', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::HIDDEN,
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-count-down-item' => 'height: {{count_box_size.SIZE}}{{count_box_size.UNIT}};',
            //         ],
            //         'condition' => [
            //             'count_box_size_with_height' => 'yes',
            //         ],
            //     ]
            // );

            $this->start_controls_tabs( 'count_box_tabs' );

            $this->start_controls_tab(
                'count_box_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'count_box_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-item' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'count_box_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-count-down-item',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'count_box_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'count_box_hover_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-item' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'count_box_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-item' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'count_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'count_box_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_box_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'count_box_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Digit Styling Controls
        $this->start_controls_section(
            'digit_styling',
            [
                'label' => esc_html__('Digit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  
            
            $this->add_responsive_control(
                'digit_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-time' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'digit_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-time' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'digit_hori_alignment',
                [
                    'label' => esc_html__('Horizontal Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-count-down-time' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'digit_verti_alignment',
                [
                    'label' => esc_html__('Vertical Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-count-down-time' => 'align-items: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            ); 
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'digit_typography',
                    'selector' => '{{WRAPPER}} .pea-count-down-time',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '500',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 62,
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
            
            $this->add_control(
                'enable_single_colors',
                [
                    'label' => esc_html__('Enable Single Colors', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->start_controls_tabs( 'digit_style_tabs' );
            $this->start_controls_tab(
                'digit_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'digit_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-time' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'digit_all_color',
                    [
                        'label' => esc_html__('All Digit Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-time' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors!' => 'yes',
                        ],
                    ]
                );  
                $this->add_control(
                    'digit_day_color',
                    [
                        'label' => esc_html__('Day Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-time.days' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'digit_hour_color',
                    [
                        'label' => esc_html__('Hour Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-time.hours' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'digit_minutes_color',
                    [
                        'label' => esc_html__('Minutes Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-time.minutes' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'digit_second_color',
                    [
                        'label' => esc_html__('Second Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-time.seconds' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'digit_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-count-down-time',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'digit_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'digit_hover_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time' => 'background-color: {{VALUE}}',
                        ],
                        'condition' => [
                            'digit_type' => 'icon',
                        ],
                    ]
                );
        
                $this->add_control(
                    'digit_hover_all_color',
                    [
                        'label' => esc_html__('All Digit Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors!' => 'yes',
                        ],
                    ]
                ); 
                $this->add_control(
                    'digit_hover_day_color',
                    [
                        'label' => esc_html__('Day Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time.days' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'digit_hover_hour_color',
                    [
                        'label' => esc_html__('Hour Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time.hours' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'digit_hover_minutes_color',
                    [
                        'label' => esc_html__('Minutes Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time.minutes' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
                $this->add_control(
                    'digit_hover_second_color',
                    [
                        'label' => esc_html__('Seconds Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time.seconds' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_single_colors' => 'yes',
                        ],
                    ]
                );
        
                $this->add_control(
                    'digit_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-time' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'digit_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'digit_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-time' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'digit_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Count Down Label Styling Controls
        $this->start_controls_section(
            'label_styling',
            [
                'label' => esc_html__('Labels', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  
            
            $this->add_responsive_control(
                'label_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-label' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'label_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-label' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'label_hori_alignment',
                [
                    'label' => esc_html__('Horizontal Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-count-down-label' => 'align-items: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'label_verti_alignment',
                [
                    'label' => esc_html__('Vertical Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-count-down-label' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            ); 
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'selector' => '{{WRAPPER}} .pea-count-down-label',
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

            $this->start_controls_tabs( 'label_style_tabs' );
            $this->start_controls_tab(
                'label_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'label_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#B0D7FF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-label' => 'color: {{VALUE}}',
                        ],
                    ]
                );  
                $this->add_control(
                    'label_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-label' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'label_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-count-down-label',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'label_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'label_hover_color',
                    [
                        'label' => esc_html__(' Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-label' => 'color: {{VALUE}}',
                        ],
                    ]
                ); 
        
                $this->add_control(
                    'label_hover_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-label' => 'background-color: {{VALUE}}',
                        ],
                        'condition' => [
                            'label_type' => 'icon',
                        ],
                    ]
                );
        
                $this->add_control(
                    'label_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-count-down-label' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'label_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'label_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'label_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-count-down-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Count Down Separator Styling Controls
        $this->start_controls_section(
            'separator_styling',
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  
            
            $this->add_responsive_control(
                'separator_hori_spacing',
                [
                    'label' => esc_html__('Horizontal Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item::before' => 'right: -{{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'separator_verti_spacing',
                [
                    'label' => esc_html__('Vertical Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item::before' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'separator_typography',
                    'selector' => '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item::before',
                ]
            );

            $this->start_controls_tabs( 'separator_style_tabs' );
            $this->start_controls_tab(
                'separator_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'separator_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-wrapper .pea-count-down-item::before' => 'color: {{VALUE}}',
                        ],
                    ]
                );  
            $this->end_controls_tab();

            $this->start_controls_tab(
                'separator_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'separator_hover_color',
                    [
                        'label' => esc_html__(' Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-count-down-wrapper:hover .pea-count-down-item::before' => 'color: {{VALUE}}',
                        ],
                    ]
                ); 

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
        
        $this->end_controls_section();
    }
    
    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $preset_styles = isset($settings['preset_styles']) ? $settings['preset_styles'] : '' ; 

        $show_days = isset($settings['show_days']) ? $settings['show_days'] : '' ; 
        $show_hours = isset($settings['show_hours']) ? $settings['show_hours'] : '' ; 
        $show_minutes = isset($settings['show_minutes']) ? $settings['show_minutes'] : '' ; 
        $show_seconds = isset($settings['show_seconds']) ? $settings['show_seconds'] : '' ; 
        $item_height_also = isset($settings['count_box_size_with_height_enable']) ? $settings['count_box_size_with_height_enable'] : '' ; 
        $item_height_also = $item_height_also === 'yes' ? 'item-with-height' : '' ; 

        ?>
        <div class="pea-widget-wrapper pea-count-down-wrapper <?php echo esc_attr($preset_styles); ?>" data-target-date="<?php echo esc_attr($settings['count_down_date_n_time']); ?>">
            <?php if($show_days === 'yes'){ ?>
                <div class="pea-count-down-item <?php echo esc_attr($item_height_also); ?>">
                    <span class="pea-count-down-time days">06</span>
                    <span class="pea-count-down-label"><?php echo esc_html($settings['days_text']); ?></span>
                </div>
            <?php } ?>
            <?php if($show_hours === 'yes'){ ?>
                <div class="pea-count-down-item <?php echo esc_attr($item_height_also); ?>">
                    <span class="pea-count-down-time hours">23</span>
                    <span class="pea-count-down-label"><?php echo esc_html($settings['hours_text']); ?></span>
                </div>
            <?php } ?>
            <?php if($show_minutes === 'yes'){ ?>
                <div class="pea-count-down-item <?php echo esc_attr($item_height_also); ?>">
                    <span class="pea-count-down-time minutes">58</span>
                    <span class="pea-count-down-label"><?php echo esc_html($settings['minutes_text']); ?></span>
                </div>
            <?php } ?>
            <?php if($show_seconds === 'yes'){ ?>
                <div class="pea-count-down-item <?php echo esc_attr($item_height_also); ?>">
                    <span class="pea-count-down-time seconds">11</span>
                    <span class="pea-count-down-label"><?php echo esc_html($settings['seconds_text']); ?></span>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}