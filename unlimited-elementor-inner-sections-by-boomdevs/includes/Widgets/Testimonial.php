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

class Testimonial extends Widget_Base {
    
    public function get_name() {
        return 'pea_testimonial';
    }
    
    public function get_title() {
        return esc_html__('Testimonial', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_testimonial_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--testimonial'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Testimonial Info Section
        $this->start_controls_section(
            'testimonial_info_section',
            [
                'label' => esc_html__('Testimonial Info', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                'show_rating',
                [
                    'label' => esc_html__('Show Rating', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_title',
                [
                    'label' => esc_html__('Show Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_desc',
                [
                    'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_author_image',
                [
                    'label' => esc_html__('Show Author Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_author',
                [
                    'label' => esc_html__('Show Author', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_designation',
                [
                    'label' => esc_html__('Show Designation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_quote',
                [
                    'label' => esc_html__('Show Quote Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        ]
                    ],
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-title' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-testimonial-desc' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-testimonial-author-container' => 'justify-content: {{VALUE}};',
                        '{{WRAPPER}} .pea-testimonial-wrapper-main.preset-5 .pea-testimonial-author-container' => 'justify-content: space-between;',
                    ],
                    'render_type'  => 'template',
                ]
            );
	
        
            $this->add_control(
                'title_tag',
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
                    'default' => 'h3',
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'title', [
                    'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Simply the best' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'description',
                [
                    'label' => esc_html__( 'Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Eget aliquet orci diam tortor a vestibul nibh erat venenatis nisi ullamcorper ut nec vitae ultricies sit sitolm auctor lectus metus urna nisl.',
                    'placeholder' => esc_html__( 'Type Testimonial title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_desc' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Author Info Section
        $this->start_controls_section(
            'author_info_section',
            [
                'label' => esc_html__('Author Info', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'author_image',
                [
                    'label'   => esc_html__( 'Author Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => PEA_PLUGIN_URL.'assets/images/author.png',
                    ],
                    'condition' => [
                        'show_author_image' => 'yes',
                    ],
                ]
            );
	
            $this->add_control(
                'author_name', [
                    'label' => esc_html__( 'Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'John Doe' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_author' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'author_designation',
                [
                    'label' => esc_html__( 'Designation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'CEO, Company Name',
                    'placeholder' => esc_html__( 'Type Author Designation here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_designation' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Rating Icon Section
        $this->start_controls_section(
            'rating_icon_section',
            [
                'label' => esc_html__('Rating Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_rating' => 'yes',
                ],
            ]
        );

			$this->add_control(
				'rating_icon_type',
				[
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
                'rating_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'rating_icon_type' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'rating_image',
                [
                    'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                    ],
                    'condition' => [
                        'rating_icon_type' => 'image',
                    ],
                ]
            );
            $this->add_control(
                'rating_icon_number',
                [
                    'label' => esc_html__('Rating Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'condition' => [
                        'rating_icon_type!' => 'none',
                    ],
                ]
            ); 
        
        $this->end_controls_section();
        
        // Quote Icon Section
        $this->start_controls_section(
            'quote_icon_section',
            [
                'label' => esc_html__('Quote Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_quote' => 'yes',
                ],
            ]
        );

			$this->add_control(
				'quote_icon_type',
				[
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
                'quote_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-quote-left',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'quote_icon_type' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'quote_image',
                [
                    'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                    ],
                    'condition' => [
                        'quote_icon_type' => 'image',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================            

		$this->start_controls_section(
			'testimonial_box_styling_section',
			[
				'label' => esc_html__( 'Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'testimonial_box_tabs' );

                $this->start_controls_tab(
                    'testimonial_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'testimonial_box_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#fefaf3', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-testimonial-wrapper-main',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'testimonial_box_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-testimonial-wrapper-main',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'testimonial_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'testimonial_box_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-testimonial-wrapper-main:hover',
                        ]
                    );

                    $this->add_control(
                        'testimonial_box_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-testimonial-wrapper-main:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'testimonial_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'testimonial_box_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-wrapper-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'testimonial_box_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 30,
                        'right' => 30,
                        'bottom' => 30,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-wrapper-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'testimonial_box_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-testimonial-wrapper-main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'testimonial_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-testimonial-wrapper-main',
                ]
            );
		$this->end_controls_section();
        
        // Rating Icon Styling Controls
        $this->start_controls_section(
            'rating_icon_styling_section',
            [
                'label' => esc_html__('Rating Icon ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_rating' => 'yes',
                ],
            ]
        );
            $this->add_responsive_control(
                'rating_alignment',
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
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-rating' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            $this->add_responsive_control(
                'rating_icon_gap',
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
                        'size' => 8,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-rating' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'rating_icon_size',
                [
                    'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 17,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-rating-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-testimonial-rating-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-testimonial-rating-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            $this->start_controls_tabs( 'rating_icon_tabs' );
                $this->start_controls_tab(
                    'rating_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'condition' => [
                            'rating_icon_type' => 'icon',
                        ], 
                    ]
                );
                    $this->add_control(
                        'rating_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFa400',
                            'selectors' => [
                                '{{WRAPPER}} .pea-testimonial-rating-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-testimonial-rating-icon svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'rating_icon_type' => 'icon',
                            ], 
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'rating_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'condition' => [
                            'rating_icon_type' => 'icon',
                        ], 

                    ]
                );
            
                    $this->add_control(
                        'rating_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-testimonial-rating-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-testimonial-rating-icon svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'rating_icon_type' => 'icon',
                            ], 
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'rating_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'condition' => [
                        'rating_icon_type' => 'icon',
                    ], 
                ]
            );

            $this->add_responsive_control(
                'rating_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Testimonial title Styling Controls
        $this->start_controls_section(
            'testimonial_title_styling_section',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_title_typography',
                    'selector' => '{{WRAPPER}} .pea-testimonial-title',
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
                                'size' => 24,
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

            $this->start_controls_tabs( 'testimonial_title_tabs' );
                $this->start_controls_tab(
                    'testimonial_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'testimonial_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-testimonial-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'testimonial_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'testimonial_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-testimonial-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'testimonial_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_responsive_control(
                'testimonial_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 14,
                        'right' => 0,
                        'bottom' => 14,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Testimonial Description Styling Controls
        $this->start_controls_section(
            'testimonial_description_styling_section',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_desc' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_description_typography',
                    'selector' => '{{WRAPPER}} .pea-testimonial-desc',
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

            $this->start_controls_tabs( 'testimonial_description_tabs' );
                $this->start_controls_tab(
                    'testimonial_description_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'testimonial_description_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .pea-testimonial-desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'testimonial_description_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'testimonial_description_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-testimonial-desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'testimonial_description_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'testimonial_description_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Testimonial Author Image Styling Controls
        $this->start_controls_section(
            'testimonial_author_image_styling_section',
            [
                'label' => esc_html__('Author Image ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_author_image' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'testimonial_author_image_width',
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
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );   
        
            $this->add_control(
                'testimonial_author_image_fit',
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
                        '{{WRAPPER}} .pea-testimonial-image img' => 'object-fit: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'testimonial_author_image_border_radius',
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
                        '{{WRAPPER}} .pea-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'testimonial_author_image_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 14,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-testimonial-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                'testimonial_author_image_position',
                [
                    'label' => esc_html__('Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_responsive_control(
                'testimonial_author_image_top',
                [
                    'label' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-image img' => 'position:absolute; top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testimonial_author_image_position' => 'yes',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'testimonial_author_image_left',
                [
                    'label' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-image img' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testimonial_author_image_position' => 'yes',
                    ],
                ]
            );  
        
        $this->end_controls_section();
        
        // Testimonial Author Name Styling Controls
        $this->start_controls_section(
            'testimonial_author_styling_section',
            [
                'label' => esc_html__('Author Name', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_author' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_author_typography',
                    'selector' => '{{WRAPPER}} .pea-user-name',
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

            $this->start_controls_tabs( 'testimonial_author_tabs' );
                $this->start_controls_tab(
                    'testimonial_author_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'testimonial_author_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0D173B',
                            'selectors' => [
                                '{{WRAPPER}} .pea-user-name' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'testimonial_author_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'testimonial_author_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-user-name' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'testimonial_author_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'testimonial_author_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-user-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Testimonial Author Designation Styling Controls
        $this->start_controls_section(
            'testimonial_author_designation_styling_section',
            [
                'label' => esc_html__('Designation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_designation' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_author_designation_typography',
                    'selector' => '{{WRAPPER}} .pea-user-designation',
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

            $this->start_controls_tabs( 'testimonial_author_designation_tabs' );
                $this->start_controls_tab(
                    'testimonial_author_designation_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'testimonial_author_designation_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .pea-user-designation' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'testimonial_author_designation_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'testimonial_author_designation_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-user-designation' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'testimonial_author_designation_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'testimonial_author_designation_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-user-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Testimonial Quote Icon Styling Controls
        $this->start_controls_section(
            'testimonial_quote_icon_styling_section',
            [
                'label' => esc_html__('Quote Icon ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quote' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'testimonial_quote_icon_size',
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
                        'size' => 45,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-quote-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-testimonial-quote-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-testimonial-quote-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'testimonial_quote_icon_tabs' );
                $this->start_controls_tab(
                    'testimonial_quote_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'testimonial_quote_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#399CFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-testimonial-quote-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-testimonial-quote-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'testimonial_quote_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'testimonial_quote_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'testimonial_quote_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'testimonial_quote_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-testimonial-quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                'testimonial_quote_icon_position',
                [
                    'label' => esc_html__('Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_responsive_control(
                'testimonial_quote_icon_top',
                [
                    'label' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-quote-icon' => 'position:absolute; top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testimonial_quote_icon_position' => 'yes',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'testimonial_quote_icon_left',
                [
                    'label' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-testimonial-quote-icon' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'testimonial_quote_icon_position' => 'yes',
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

        $title = isset($settings['title']) ? $settings['title'] : '' ;  
        $title_tag = isset($settings['title_tag']) ? $settings['title_tag'] : '' ;  
        $description = isset($settings['description']) ? $settings['description'] : '' ;
        $author_image = isset($settings['author_image']) ? $settings['author_image'] : '' ;  
        $author_name = isset($settings['author_name']) ? $settings['author_name'] : '' ;  
        $author_designation = isset($settings['author_designation']) ? $settings['author_designation'] : '' ;
        $rating_number = isset($settings['rating_icon_number']) ? $settings['rating_icon_number'] : '' ;  
        ?>
        <div class="pea-widget-wrapper pea-testimonial-wrapper-main pea-testimonial-wrapper-main-left <?php echo esc_attr($preset_styles); ?>" >
            <div class="pea-testimonial-wrapper">
                <div class="pea-testimonial-inner-wrapper">
                    <div class="pea-testimonial-container">
                        <?php if(($settings['show_author_image'] === 'yes' || $settings['show_author'] === 'yes' ) && $preset_styles == 'preset-4') { ?>
                            <div class="pea-testimonial-author-container left">
                                <div class="pea-testimonial-author-inner-container">
                                    <?php if($settings['show_author_image'] === 'yes') { ?>
                                        <div class="pea-testimonial-author-image-container">
                                            <div class="pea-testimonial-image">
                                                <img src="<?php echo esc_url($author_image['url']) ?>" alt="<?php echo esc_attr($title) ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="pea-testimonial-userinfo-container">
                                    <?php if($settings['show_author'] === 'yes') { ?>
                                        <div class="pea-user-name">
                                            <?php echo esc_html($author_name); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if($settings['show_designation'] === 'yes') { ?>
                                        <span class="pea-user-designation">
                                            <?php echo esc_html($author_designation); ?>
                                        </span>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?> 
                        <?php if($settings['show_rating'] === 'yes' && $rating_number !== '' && $preset_styles !== 'preset-5') { ?>
                            <div class="pea-testimonial-rating">
                                <?php foreach (range(0, $rating_number['size']) as $i) { if($i == 0){ continue; } ?>
                                    <div class="pea-testimonial-rating-icon">
                                        <?php if($settings['rating_icon_type'] === 'icon'){ ?>
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        <?php }elseif($settings['rating_icon_type'] === 'image'){ $image_url = $settings['rating_image']['url']; ?> 
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if($settings['show_title'] === 'yes') { ?>
                            <div class="pea-testimonial-title-container" >
                                <<?php echo esc_attr($title_tag); ?> class="pea-testimonial-title"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                            </div>
                        <?php } ?>
                        <?php if($settings['show_desc'] === 'yes') { ?>
                            <div class="pea-testimonial-desc-container">
                                <p class="pea-testimonial-desc">
                                    <?php echo esc_html($description); ?>
                                </p>
                            </div>
                        <?php } ?>
                        <?php if(($settings['show_author_image'] === 'yes' || $settings['show_author'] === 'yes') && $preset_styles !== 'preset-4') { ?>
                            <div class="pea-testimonial-author-container left">
                                <div class="pea-testimonial-author-inner-container">
                                    <?php if($settings['show_author_image'] === 'yes') { ?>
                                        <div class="pea-testimonial-author-image-container">
                                            <div class="pea-testimonial-image">
                                                <img src="<?php echo esc_url($author_image['url']) ?>" alt="<?php echo esc_attr($title) ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="pea-testimonial-userinfo-container">
                                    <?php if($settings['show_author'] === 'yes') { ?>
                                        <div class="pea-user-name">
                                            <?php echo esc_html($author_name); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if($settings['show_designation'] === 'yes') { ?>
                                        <span class="pea-user-designation">
                                            <?php echo esc_html($author_designation); ?>
                                        </span>
                                    <?php } ?>
                                    </div>
                                </div>
                                <?php if($settings['show_rating'] === 'yes' && $rating_number !== '' && $preset_styles === 'preset-5') { ?>
                                    <div class="pea-testimonial-rating">
                                        <?php foreach (range(0, $rating_number['size']) as $i) { if($i == 0){ continue; } ?>
                                            <div class="pea-testimonial-rating-icon">
                                                <?php if($settings['rating_icon_type'] === 'icon'){ ?>
                                                    <?php \Elementor\Icons_Manager::render_icon( $settings['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                <?php }elseif($settings['rating_icon_type'] === 'image'){ $image_url = $settings['rating_image']['url']; ?> 
                                                    <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?> 
                        <?php if($settings['show_quote'] === 'yes') { ?>
                            <div class="pea-testimonial-quote-icon">
                                <?php if($settings['quote_icon_type'] === 'icon'){ ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php }elseif($settings['quote_icon_type'] === 'image'){ $image_url = $settings['quote_image']['url']; ?> 
                                    <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }
}