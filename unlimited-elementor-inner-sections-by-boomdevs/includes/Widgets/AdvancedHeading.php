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

class AdvancedHeading extends Widget_Base {
    
    public function get_name() {
        return 'pea_advanced_heading';
    }
    
    public function get_title() {
        return esc_html__('Advanced Heading', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_advanced_heading_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--advanced-heading'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
        $this->start_controls_section(
            'content_general',
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
                        'default' => 'Default',
                        'preset-1' => 'Preset 1',
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
                'element_visible_title',
                [
                    'label' => esc_html__( 'Element Visibility', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            
            $this->add_control(
                'show_subheading',
                [
                    'label' => esc_html__('Show Sub Heading', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'show_separator',
                [
                    'label' => esc_html__('Show Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'show_icon',
                [
                    'label' => esc_html__('Show icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
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
                        'justify' => [
                            'title' => esc_html__('Justified', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-advanced-subheading' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-advanced-heading-separator-wrapper' => 'justify-content: {{VALUE}};',
                        '{{WRAPPER}} .pea-advanced-heading-icon-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
        
        $this->end_controls_section();
        
        // Heading Section
        $this->start_controls_section(
            'heading',
            [
                'label' => esc_html__('Heading', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'heading_tag',
                [
                    'label' => esc_html__('Heading Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                ]
            );

            $this->add_control(
                'heading_text',
                [
                    'label' => esc_html__( 'Heading Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Advanced Heading', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'placeholder' => esc_html__( 'Type your Heading here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    
                ]
            );
        
        $this->end_controls_section();
        
        // Sub Heading Section
        $this->start_controls_section(
            'subheading',
            [
                'label' => esc_html__('Sub Heading', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_subheading' => 'yes',
                ],
            ]
        );
        
            $this->add_control(
                'subheading_tag',
                [
                    'label' => esc_html__('Sub Heading Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'default' => 'p',
                ]
            );

            $this->add_control(
                'subheading_text',
                [
                    'label' => esc_html__( 'Sub Heading Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Advanced Sub Heading', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'placeholder' => esc_html__( 'Type your Sub Heading here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
        $this->end_controls_section();
        
        // Separator Section
        $this->start_controls_section(
            'separator',
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_separator' => 'yes',
                ],
            ]
        );
        
            $this->add_control(
                'separator_position',
                [
                    'label' => esc_html__('Separator Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'top' => 'Top',
                        'bottom' => 'Bottom',
                    ],
                    'default' => 'top',
                ]
            );
        
            $this->add_control(
                'separator_style',
                [
                    'label' => esc_html__('Separator Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'solid' => 'Solid',
                        'dashed' => 'Dashed',
                        'dotted' => 'Dotted',
                        'double' => 'Double',
                        'none' => 'Zigzag',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading-separator' => 'border-top-style:{{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
        
        $this->end_controls_section();
        
        // Icon Section
        $this->start_controls_section(
            'heading_icon_section',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );
            
            $this->add_control(
                'enable_svg_code',
                [
                    'label' => esc_html__('Enable Svg Code Insert', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'svg_code_area',
                [
                    'label' => esc_html__( 'SVG Code', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::CODE,
                    'language' => 'html', 
                    'rows' => 10,
                    'default' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="62" viewBox="0 0 62 62" fill="none">
                    <path opacity="0.5" d="M28.8874 39.6853L17.8057 28.6035C15.5938 26.3917 12.0458 26.2736 9.69168 28.3333L7.10682 30.6449C7.06308 30.6779 6.97559 30.8991 6.97559 31.5183C6.97559 44.7868 17.7319 55.5433 31.0006 55.5433C39.3176 55.5433 46.6473 51.3172 50.9599 44.8953L50.6566 44.592L45.9227 40.298C43.2371 37.8811 39.2378 37.6403 36.2819 39.7178L35.5116 40.259C33.4573 41.7028 30.6627 41.4608 28.8874 39.6853Z" fill="#4CAF50"/>
                    <path d="M38.7499 28.4173C41.6035 28.4173 43.9166 26.1042 43.9166 23.2507C43.9166 20.3972 41.6035 18.084 38.7499 18.084C35.8964 18.084 33.5833 20.3972 33.5833 23.2507C33.5833 26.1042 35.8964 28.4173 38.7499 28.4173Z" fill="#4CAF50"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.22925 30.9994C3.22925 15.6619 15.6627 3.22852 31.0001 3.22852C46.3376 3.22852 58.7709 15.6619 58.7709 30.9994C58.7709 46.3369 46.3376 58.7702 31.0001 58.7702C15.6627 58.7702 3.22925 46.3369 3.22925 30.9994ZM54.1969 25.2381C54.7373 27.2396 55.0256 29.3447 55.0256 31.5171C55.0256 44.7856 44.2691 55.5421 31.0006 55.5421C17.732 55.5421 6.9756 44.7856 6.9756 31.5171C6.9756 29.361 7.25961 27.2711 7.79229 25.2831C10.3543 14.8461 19.773 7.10352 31.0001 7.10352C42.211 7.10352 51.6187 14.8239 54.1969 25.2381Z" fill="#4CAF50"/>
                    </svg>',
                    'placeholder' => esc_html__( 'Paste your SVG code here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'is_editable' => true,
                    'condition' => [
                        'enable_svg_code' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'heading_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-star',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'enable_svg_code!' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Heading Styling Controls
        $this->start_controls_section(
            'heading_styling',
            [
                'label' => esc_html__('Heading', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .pea-advanced-heading',
                ]
            );

            $this->start_controls_tabs( 'heading_tabs' );

            $this->start_controls_tab(
                'heading_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                GradientTextControl::add_control( $this, [
                    'name'     => 'heading_text_gradient',
                    'selector' => '{{WRAPPER}} .pea-advanced-heading',
                ]);

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'heading_bg_gradient',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-advanced-heading',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'heading_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-advanced-heading',
                    ]
                );

                TextStrokeControl::add_control( $this, [
                    'name' => 'heading_text_stroke', 
                    'label' => esc_html__('Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'selector' => '{{WRAPPER}} .pea-advanced-heading', // CSS selector for the element
                ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'heading_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );

                GradientTextControl::add_control( $this, [
                    'name'     => 'heading_hover_text_gradient',
                    'selector' => '{{WRAPPER}} .pea-advanced-heading:hover',
                ]);
            
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'heading_hover_bg_gradient',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-advanced-heading:hover',
                    ]
                );
        
                $this->add_control(
                    'heading_border_hover_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'heading_stroke_hover_color',
                    [
                        'label' => esc_html__('Stroke Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading:hover' => '-webkit-text-stroke-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'heading_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
        
            $this->add_control(
                'enable_heading_text_img',
                [
                    'label' => esc_html__('Enable Text Background Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'heading_text_bg_image',
                [
                    'label' => __( 'Select Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => PEA_PLUGIN_URL . 'assets/images/for-image-mask-text.jpg',
                    ],
                    'condition' => [
                        'enable_heading_text_img' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'     => 'heading_text_shadow',
                    'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector'  => '{{WRAPPER}} .pea-advanced-heading',
                    'render_type'  => 'template',
                ]
            );

            $this->add_responsive_control(
                'heading_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'heading_bg_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-advanced-heading',
                ]
            );
        
        $this->end_controls_section();
        
        // Heading Active Styling Controls
        $this->start_controls_section(
            'heading_active_line',
            [
                'label' => esc_html__('Heading Active Line', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'heading_active_line_enable',
                [
                    'label' => esc_html__('Enable Heading Active Line', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        
            $this->add_control(
                'heading_active_line_before_color',
                [
                    'label' => esc_html__('Before Line Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#399CFF',
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:before' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'heading_active_line_hover_before_color',
                [
                    'label' => esc_html__('Hover Before Line Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#399CFF',
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:hover:before' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'heading_active_line_before_width',
                [
                    'label' => esc_html__('Line Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 30,
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'heading_active_line_before_height',
                [
                    'label' => esc_html__('Line Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'heading_active_line_after_color',
                [
                    'label' => esc_html__('After Line Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#B0D7FF',
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:after' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'heading_active_line_hover_after_color',
                [
                    'label' => esc_html__('Hover After Line Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#399CFF',
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:hover:after' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'heading_active_line_after_width',
                [
                    'label' => esc_html__('Line Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 100,
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:after' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'heading_active_line_after_height',
                [
                    'label' => esc_html__('Line Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 2,
                    ],
                    'condition' => [
                        'heading_active_line_enable' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading.active-line:after' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Sub Heading Styling Controls
        $this->start_controls_section(
            'subheading_styling',
            [
                'label' => esc_html__('Sub Heading', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_subheading' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'subheading_typography',
                    'selector' => '{{WRAPPER}} .pea-advanced-subheading',
                ]
            );

            $this->start_controls_tabs( 'subheading_tabs' );

            $this->start_controls_tab(
                'subheading_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                GradientTextControl::add_control( $this, [
                    'name'     => 'subheading_text_gradient',
                    'selector' => '{{WRAPPER}} .pea-advanced-subheading',
                ]);

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'subheading_bg_gradient',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-advanced-subheading',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'subheading_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-advanced-subheading',
                    ]
                );

                TextStrokeControl::add_control( $this, [
                    'name' => 'subheading_text_stroke', 
                    'label' => esc_html__('Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'selector' => '{{WRAPPER}} .pea-advanced-subheading', // CSS selector for the element
                ]);

            $this->end_controls_tab();

            $this->start_controls_tab(
                'subheading_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );

                GradientTextControl::add_control( $this, [
                    'name'     => 'subheading_hover_text_gradient',
                    'selector' => '{{WRAPPER}} .pea-advanced-subheading:hover',
                ]);
            
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'subheading_hover_bg_gradient',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-advanced-subheading:hover',
                    ]
                );
        
                $this->add_control(
                    'subheading_border_hover_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-subheading:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
        
                $this->add_control(
                    'subheading_stroke_hover_color',
                    [
                        'label' => esc_html__('Stroke Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-subheading:hover' => '-webkit-text-stroke-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'subheading_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'     => 'subheading_text_shadow',
                    'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector'  => '{{WRAPPER}} .pea-advanced-subheading',
                ]
            );

            $this->add_responsive_control(
                'subheading_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-subheading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'subheading_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-subheading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'subheading_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'subheading_bg_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-advanced-subheading',
                ]
            );

        
        $this->end_controls_section();
        
        // Separator Styling Controls
        $this->start_controls_section(
            'separator_styling', 
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_separator' => 'yes',
                ],
            ]
        );  

            $this->start_controls_tabs( 'separator_tabs' );

            $this->start_controls_tab(
                'separator_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'separator_color',
                    [
                        'label' => esc_html__('Normal Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-separator' => 'border-top-color: {{VALUE}}',
                            '{{WRAPPER}} .pea-advanced-heading-separator .pea-advanced-heading-separator-zigzag-svg' => 'stroke: {{VALUE}} !important;',
                        ],
                        'condition' => [
                            'show_separator' => 'yes',
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
                        'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-separator:hover' => 'border-top-color: {{VALUE}}',
                        ],
                        'condition' => [
                            'show_separator' => 'yes',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();
            
            $this->add_responsive_control(
                'separator_width',
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
                        'unit' => 'px',
                        'size' => 338,
                    ],
                    'condition' => [
                        'show_separator' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading-separator' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'separator_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'condition' => [
                        'show_separator' => 'yes',
                        'separator_style!' => 'none',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'separator_spacing',
                [
                    'label' => esc_html__('Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'condition' => [
                        'show_separator' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading-separator-wrapper:has(+ .pea-advanced-heading)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-advanced-heading + .pea-advanced-heading-separator-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-advanced-heading + .pea-advanced-subheading + .pea-advanced-heading-separator-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

        
        $this->end_controls_section();
        
        // Icon Styling Controls
        $this->start_controls_section(
            'heading_icon_styling',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes',
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
                        'size' => 30,
                    ],
                    'condition' => [
                        'show_icon' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-advanced-heading-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'icon_bg_size',
                [
                    'label' => esc_html__('Background Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 50,
                    ],
                    'condition' => [
                        'show_icon' => 'yes',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-heading-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'icon_style_tabs' );
            $this->start_controls_tab(
                'icon_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'icon_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-icon i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-advanced-heading-icon svg' => 'fill: {{VALUE}}',
                        ],
                        'condition' => [
                            'show_icon' => 'yes',
                        ],
                    ]
                );
        
                $this->add_control(
                    'icon_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-icon' => 'background: {{VALUE}}',
                        ],
                        'condition' => [
                            'show_icon' => 'yes',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'icon_border',
                        'label'    => esc_html__( 'Border', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-advanced-heading-icon',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'icon_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'icon_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-icon:hover i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-advanced-heading-icon:hover svg' => 'fill: {{VALUE}}',
                        ],
                        'condition' => [
                            'show_icon' => 'yes',
                        ],
                    ]
                );
        
                $this->add_control(
                    'icon_hover_bg_color',
                    [
                        'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-icon:hover' => 'background-color: {{VALUE}}',
                        ],
                        'condition' => [
                            'show_icon' => 'yes',
                        ],
                    ]
                );
        
                $this->add_control(
                    'icon_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-heading-icon:hover' => 'border-color: {{VALUE}}',
                        ],
                        'condition' => [
                            'show_icon' => 'yes',
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
                'icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $heading = Helper::remove_top_tag($settings['heading_text']);
        $subheading = Helper::remove_top_tag($settings['subheading_text']);
        $allowed_tags = wp_kses_allowed_html('post');
        $allowed_tags['ol'] = array();
        $allowed_tags['ul'] = array();
		$heading_icon = $settings['heading_icon'];
        if ( 'yes' === $settings['enable_heading_text_img'] && ! empty( $settings['heading_text_bg_image']['url'] ) ) {
            $this->add_render_attribute('heading', 'style', "
                background-image: url('{$settings['heading_text_bg_image']['url']}');
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-size: cover;
                background-position: center;
            " );
        }

        $this->add_render_attribute('wrapper', 'class', 'pea-widget-wrapper pea-advanced-heading-wrapper');
        
        // Build heading classes
        $heading_classes = ['pea-advanced-heading'];
        if($settings['heading_active_line_enable'] === 'yes'){
            $heading_classes[] = 'active-line';
        }
        $this->add_render_attribute('heading', 'class', $heading_classes); ?>

        <div <?php echo $this->get_render_attribute_string('wrapper'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
            <?php if ($settings['show_icon'] === 'yes') : ?>
                <div class="pea-advanced-heading-icon-wrapper">
                    <div class="pea-advanced-heading-icon">
                        <?php if($settings['enable_svg_code'] === 'no') : ?>
                            <?php \Elementor\Icons_Manager::render_icon( $heading_icon, [ 'aria-hidden' => 'true' ] ); ?>  
                        <?php elseif($settings['enable_svg_code'] === 'yes') : $svg_by_code = Helper::sanitize_svg($settings['svg_code_area']); ?>
                            <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php echo $svg_by_code; ?> 
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($settings['show_separator'] === 'yes') : ?>
                <?php if ($settings['separator_position'] === 'top') : ?>
                    <div class="pea-advanced-heading-separator-wrapper">
                        <div class="pea-advanced-heading-separator" >
                            <?php if ($settings['separator_style'] === 'none') : ?>
                                <div class="pea-advanced-heading-separator-zigzag">
                                    <svg class="pea-advanced-heading-separator-zigzag-svg" width="322" height="7" viewBox="0 0 322 7" fill="none" xmlns="http://www.w3.org/2000/svg" style="stroke: #399CFF;">
                                        <path d="M0.349609 5.71094L5.34961 0.710938L10.3496 5.71094L15.3496 0.710938L20.3496 5.71094L25.3496 0.710938L30.3496 5.71094L35.3496 0.710938L40.3496 5.71094L45.3496 0.710938L50.3496 5.71094L55.3496 0.710938L60.3496 5.71094L65.3496 0.710938L70.3496 5.71094L75.3496 0.710938L80.3496 5.71094L85.3496 0.710938L90.3496 5.71094L95.3496 0.710938L100.35 5.71094L105.35 0.710938L110.35 5.71094L115.35 0.710938L120.35 5.71094L125.35 0.710938L130.35 5.71094L135.35 0.710938L140.35 5.71094L145.35 0.710938L150.35 5.71094L155.35 0.710938L160.35 5.71094L165.35 0.710938L170.35 5.71094L175.35 0.710938L180.35 5.71094L185.35 0.710938L190.35 5.71094L195.35 0.710938L200.35 5.71094L205.35 0.710938L210.35 5.71094L215.35 0.710938L220.35 5.71094L225.35 0.710938L230.35 5.71094L235.35 0.710938L240.35 5.71094L245.35 0.710938L250.35 5.71094L255.35 0.710938L260.35 5.71094L265.35 0.710938L270.35 5.71094L275.35 0.710938L280.35 5.71094L285.35 0.710938L290.35 5.71094L295.35 0.710938L300.35 5.71094L305.35 0.710938L310.35 5.71094L315.35 0.710938L320.35 5.71094" strokewidth="2" stroke-miterlimit="10"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <<?php echo esc_attr($settings['heading_tag']) ?> <?php echo $this->get_render_attribute_string('heading'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
                <?php echo wp_kses($settings['heading_text'], $allowed_tags); ?>
            </<?php echo esc_attr($settings['heading_tag']) ?>>

            <?php if ($settings['show_subheading'] === 'yes') : ?>
                <<?php echo esc_attr($settings['subheading_tag']) ?> class="pea-advanced-subheading">
                    <?php echo wp_kses($settings['subheading_text'], $allowed_tags); ?>
                </<?php echo esc_attr($settings['subheading_tag']) ?>>
            <?php endif; ?>
            
            <?php if ($settings['show_separator'] === 'yes') : ?>
                <?php if ($settings['separator_position'] === 'bottom') : ?>
                    <div class="pea-advanced-heading-separator-wrapper">
                        <div class="pea-advanced-heading-separator" >
                            <?php if ($settings['separator_style'] === 'none') : ?>
                                <div class="pea-advanced-heading-separator-zigzag">
                                    <svg class="pea-advanced-heading-separator-zigzag-svg" width="322" height="7" viewBox="0 0 322 7" fill="none" xmlns="http://www.w3.org/2000/svg" style="stroke: #399CFF;">
                                        <path d="M0.349609 5.71094L5.34961 0.710938L10.3496 5.71094L15.3496 0.710938L20.3496 5.71094L25.3496 0.710938L30.3496 5.71094L35.3496 0.710938L40.3496 5.71094L45.3496 0.710938L50.3496 5.71094L55.3496 0.710938L60.3496 5.71094L65.3496 0.710938L70.3496 5.71094L75.3496 0.710938L80.3496 5.71094L85.3496 0.710938L90.3496 5.71094L95.3496 0.710938L100.35 5.71094L105.35 0.710938L110.35 5.71094L115.35 0.710938L120.35 5.71094L125.35 0.710938L130.35 5.71094L135.35 0.710938L140.35 5.71094L145.35 0.710938L150.35 5.71094L155.35 0.710938L160.35 5.71094L165.35 0.710938L170.35 5.71094L175.35 0.710938L180.35 5.71094L185.35 0.710938L190.35 5.71094L195.35 0.710938L200.35 5.71094L205.35 0.710938L210.35 5.71094L215.35 0.710938L220.35 5.71094L225.35 0.710938L230.35 5.71094L235.35 0.710938L240.35 5.71094L245.35 0.710938L250.35 5.71094L255.35 0.710938L260.35 5.71094L265.35 0.710938L270.35 5.71094L275.35 0.710938L280.35 5.71094L285.35 0.710938L290.35 5.71094L295.35 0.710938L300.35 5.71094L305.35 0.710938L310.35 5.71094L315.35 0.710938L320.35 5.71094" strokewidth="2" stroke-miterlimit="10"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    }
}