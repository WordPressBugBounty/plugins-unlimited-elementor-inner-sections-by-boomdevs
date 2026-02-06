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

class ProgressBar extends Widget_Base {
    
    public function get_name() {
        return 'pea_progress_bar';
    }
    
    public function get_title() {
        return esc_html__('Progress Bar', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_progress_bar_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--progress-bar'];
    }

    public function get_script_depends() {
        return ['prime-elementor-addons--progress-bar'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'preset-7' => 'Preset 7',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );

            $this->add_control(
                'layout_type',
                [
                    'label'       => esc_html__( 'Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'horizontal',
                    'label_block' => true,
                    'options'     => [
                        'horizontal' => 'Horizontal',
                        'vertical' => 'Vertical',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'alignment',
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
                        '{{WRAPPER}} .pea-progressbar-item.vertical' => 'align-items: {{VALUE}};',
                    ],
                    'condition' => [
                        'layout_type' => 'vertical',
                    ],
                    'render_type'  => 'template',
                ]
            );

            $this->add_control(
                'text_position',
                [
                    'label'       => esc_html__( 'Text Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'text-outside',
                    'label_block' => true,
                    'options'     => [
                        'text-outside'  => esc_html__( 'Text Outside', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'text-inside' => esc_html__( 'Text Inside', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                    'condition' => [
                        'layout_type' => 'horizontal',
                    ],
                ]
            );

            $this->add_control(
                'progress_number_position',
                [
                    'label'       => esc_html__( 'Progress Number Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'default',
                    'label_block' => true,
                    'options'     => [
                        'default'  => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'with-progressbar' => esc_html__( 'With Progress Bar', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                ]
            );

            $this->add_control(
                'progress_duration',
                [
                    'label' => __('Progress Duration (ms)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['ms'],
                    'range' => [
                        'ms' => [
                            'min' => 500,
                            'max' => 10000,
                            'step' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'ms',
                        'size' => 1500,
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'progress_percentage',
                [
                    'label' => esc_html__('Progress Percentage', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'step' => 1,
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 50,
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'progress_bar_width',
                [
                    'label' => esc_html__('Progress Bar Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-progressbar-item.vertical .pea-progressbar-line-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout_type' => 'vertical',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'progress_bar_height',
                [
                    'label' => esc_html__('Progress Bar Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', 'em', 'rem'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 14,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-progressbar-line-wrapper ' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Title Section
        $this->start_controls_section(
            'title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'title_tag',
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
                ]
            );

            $this->add_control(
                'title_text',
                [
                    'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Progress Bar', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'placeholder' => esc_html__( 'Type your Progressbar title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================          

        // Progress Wrapper Styling Controls
		$this->start_controls_section(
			'progress_wrapper_styling',
			[
				'label' => esc_html__( 'Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'progress_wrapper_tabs' );

                $this->start_controls_tab(
                    'progress_wrapper_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'progress_wrapper_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-progressbar-item',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'progress_wrapper_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-progressbar-item',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'progress_wrapper_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'progress_wrapper_hover_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-progressbar-item:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'progress_wrapper_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-progressbar-item:hover',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_responsive_control(
                'progress_wrapper_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'progress_wrapper_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'progress_wrapper_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'progress_wrapper_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-progressbar-item',
                ]
            );
		$this->end_controls_section();
        
        // Progress Bar Styling Controls
        $this->start_controls_section(
            'progress_bar',
            [
                'label' => esc_html__('Progress Bar', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'progress_bar_zebra_track_color_enable',
                [
                    'label' => esc_html__('Zebra Track Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_responsive_control(
                'progress_bar_zebra_track_width',
                [
                    'label' => esc_html__('Zebra Track Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 3,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-line' => 'background: repeating-linear-gradient(-45deg, {{progress_bar_zebra_track_color.VALUE}}, {{progress_bar_zebra_track_color.VALUE}} {{SIZE}}px, transparent {{SIZE}}px, transparent calc({{SIZE}}px * 2)) ',
                    ],
                    'condition' => [
                        'progress_bar_zebra_track_color_enable' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'progress_bar_zebra_track_color',
                [
                    'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#399CFF',
                    'condition' => [
                        'progress_bar_zebra_track_color_enable' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'progress_bar_color',
                    'types'          => [ 'classic', 'gradient' ],
                    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                    'exclude'        => [ 'image' ],
                    'fields_options' => [
                        'background' => [
                            'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'default' => 'classic',
                        ],
                        'color' => [
                            'default' => '#399CFF', // ✅ Set your default normal color here
                        ],
                    ],
                    'selector'  => '{{WRAPPER}} .pea-progressbar-line',
                    'condition' => [
                        'progress_bar_zebra_track_color_enable!' => 'yes',
                    ],
                ]
            );

            $this->start_controls_tabs( 'progress_bar_tabs' );
                $this->start_controls_tab(
                    'progress_bar_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'progress_bar_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-progressbar-line',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'progress_bar_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'progress_bar_border_hover_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-progressbar-item:hover .pea-progressbar-line' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'progress_bar_border_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'progress_bar_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-line' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Progress Bar Background Styling Controls
        $this->start_controls_section(
            'progress_bar_bg',
            [
                'label' => esc_html__('Progress Bar Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'progress_bar_bg_zebra_track_color_enable',
                [
                    'label' => esc_html__('Zebra Track Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_responsive_control(
                'progress_bar_bg_zebra_track_width',
                [
                    'label' => esc_html__('Zebra Track Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 20,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 3,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-line-wrapper' => 'background: repeating-linear-gradient(-45deg, {{progress_bar_bg_zebra_track_color.VALUE}}, {{progress_bar_bg_zebra_track_color.VALUE}} {{SIZE}}px, transparent {{SIZE}}px, transparent calc({{SIZE}}px * 2)) ',
                    ],
                    'condition' => [
                        'progress_bar_bg_zebra_track_color_enable' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'progress_bar_bg_zebra_track_color',
                [
                    'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ebf5ff',
                    'condition' => [
                        'progress_bar_bg_zebra_track_color_enable' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'progress_bar_bg_color',
                    'types'          => [ 'classic', 'gradient' ],
                    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                    'exclude'        => [ 'image' ],
                    'fields_options' => [
                        'background' => [
                            'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'default' => 'classic',
                        ],
                        'color' => [
                            'default' => '#ebf5ff', // ✅ Set your default normal color here
                        ],
                    ],
                    'selector'  => '{{WRAPPER}} .pea-progressbar-line-wrapper',
                    'condition' => [
                        'progress_bar_bg_zebra_track_color_enable!' => 'yes',
                    ],
                ]
            );

            $this->start_controls_tabs( 'progress_bar_bg_tabs' );
                $this->start_controls_tab(
                    'progress_bar_bg_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'progress_bar_bg_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-progressbar-line-wrapper',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'progress_bar_bg_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'progress_bar_bg_border_hover_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-progressbar-item:hover .pea-progressbar-line-wrapper' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'progress_bar_bg_border_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'progress_bar_bg_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-line-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Progress Number Styling Controls
        $this->start_controls_section(
            'progress_number_styling',
            [
                'label' => esc_html__('Progress Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'progress_number_typography',
                    'selector' => '{{WRAPPER}} .pea-progressbar-number',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
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

            $this->start_controls_tabs( 'progress_number_style_tabs' );
            $this->start_controls_tab(
                'progress_number_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'progress_number_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#000000',
                        'selectors' => [
                            '{{WRAPPER}} .pea-progressbar-number' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'progress_number_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'progress_number_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-progressbar-item:hover .pea-progressbar-number' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'progress_number_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'progress_number_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 20,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Progress Title Styling Controls
        $this->start_controls_section(
            'progress_title_styling',
            [
                'label' => esc_html__('Progress Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'progress_title_typography',
                    'selector' => '{{WRAPPER}} .pea-progressbar-label',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
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

            $this->start_controls_tabs( 'progress_title_style_tabs' );
            $this->start_controls_tab(
                'progress_title_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'progress_title_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#000000',
                        'selectors' => [
                            '{{WRAPPER}} .pea-progressbar-label' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'progress_title_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'progress_title_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-progressbar-item:hover .pea-progressbar-label' => 'color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'progress_title_style_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'progress_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 20,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-progressbar-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $layout_type = isset($settings['layout_type']) ? $settings['layout_type'] : '' ; 
        $text_position = isset($settings['text_position']) ? $settings['text_position'] : '' ; 
        $number_position = isset($settings['progress_number_position']) ? $settings['progress_number_position'] : '' ; 
        $duration = isset($settings['progress_duration']) ? $settings['progress_duration']['size'] : '' ; 
        $progress_percentage = isset($settings['progress_percentage']) ? $settings['progress_percentage']['size'] : '' ; 
        $title_tag = isset($settings['title_tag']) ? $settings['title_tag'] : '' ; 
        $title_text = isset($settings['title_text']) ? $settings['title_text'] : '' ; 
        ?>

        <div class="pea-widget-wrapper pea-progress-bar-wrapper <?php echo esc_attr($preset_styles); ?>" >
            <div class="pea-progressbar-item <?php echo esc_attr($layout_type); ?>" data-progressbar-type="<?php echo esc_attr($layout_type); ?>" data-duration="<?php echo esc_attr($duration); ?>" data-progress="<?php echo esc_attr($progress_percentage); ?>" data-progress-number-position="<?php echo esc_attr($number_position); ?>" >
                <?php if($layout_type === 'horizontal'){ ?>
                    <?php if($text_position === 'text-outside'){ ?>
                        <div class="pea-progressbar-content">
                            <<?php echo esc_attr($title_tag); ?> class="pea-progressbar-label"><?php echo esc_html($title_text); ?></<?php echo esc_attr($title_tag); ?>>
                             <?php if($number_position === 'default'){ ?>
                                <span class="pea-progressbar-number">0%</span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="pea-progressbar-line-wrapper">
                        <div class="pea-progressbar-line">
                             <?php if($number_position === 'with-progressbar'){ ?>
                                <span class="pea-progressbar-number">0%</span>
                            <?php } ?>
                        </div>
                        <?php if($text_position === 'text-inside'){ ?>
                            <div class="pea-progressbar-content">
                                <<?php echo esc_attr($title_tag); ?> class="pea-progressbar-label"><?php echo esc_html($title_text); ?></<?php echo esc_attr($title_tag); ?>>
                                <?php if($number_position === 'default'){ ?>
                                    <span class="pea-progressbar-number">0%</span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <?php if($number_position == 'default'){ ?>
                        <div class="pea-progressbar-content">
                            <span class="pea-progressbar-number">0%</span>
                        </div>
                    <?php } ?>
                    <div class="pea-progressbar-line-wrapper">
                        <div class="pea-progressbar-line">
                            <?php if($number_position == 'with-progressbar'){ ?>
                                <span class="pea-progressbar-number">0%</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pea-progressbar-content">
                        <<?php echo esc_attr($title_tag); ?> class="pea-progressbar-label"><?php echo esc_html($title_text); ?></<?php echo esc_attr($title_tag); ?>>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php
    }
}