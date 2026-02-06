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

class PricingTable extends Widget_Base {
    
    public function get_name() {
        return 'pea_pricing_table';
    }
    
    public function get_title() {
        return esc_html__('Pricing Table', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'eicon-price-table';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--pricing-table'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Testimonial Info Section
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
                        'preset-5' => 'Preset 5',
                        'preset-6' => 'Preset 6',
                        'preset-7' => 'Preset 7',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_control(
                'display_top_section',
                [
                    'label' => esc_html__('Display Top Section', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'top_text', [
                    'label' => esc_html__( 'Top Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Best Deal' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'display_top_section' => 'yes',
                    ],
                ]
            );

			$this->add_control(
				'pricing_icon_type',
				[
                    'type' => Controls_Manager::CHOOSE,
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
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
					'default' => 'none',
					'label_block' => true,
				]
			);

            $this->add_control(
                'pricing_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-bookmark',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'pricing_icon_type' => 'icon',
                    ],
                ]
            );
            $this->add_control(
                'pricing_title', [
                    'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Basic Plan' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'show_pricing_subtitle',
                [
                    'label' => esc_html__('Show Sub Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'pricing_subtitle',
                [
                    'label' => esc_html__( 'Sub Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Everything you need to get start building your website.',
                    'placeholder' => esc_html__( 'Type Pricing sub title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_pricing_subtitle' => 'yes',
                    ],
                ]
            );

            // $this->add_control(
            //     'testimonial_preset_5_css',
            //     [
            //         'label' => esc_html__('css for preset 5', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::HIDDEN,
            //         'default' => 'space-between',
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-testimonial-author-container' => 'justify-content: {{VALUE}};',
            //         ],
            //         'condition' => [
            //             'preset_styles' => 'preset-5',
            //         ],
            //     ]
            // );
        
        $this->end_controls_section();
        
        // Price Section
        $this->start_controls_section(
            'price_section',
            [
                'label' => esc_html__('Price', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'price', [
                    'label' => esc_html__( 'Price', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '9.99' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'show_sale_price',
                [
                    'label' => esc_html__('Sale Price', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'sale_price', [
                    'label' => esc_html__( 'Sale Price', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '45.00' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_sale_price' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'currency', [
                    'label' => esc_html__( 'Currency', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '$' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
        
            $this->add_control(
                'currency_position',
                [
                    'label' => esc_html__('Currency Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'left' => 'Left',
                        'right' => 'Right',
                    ],
                    'default' => 'left',
                    'render_type'  => 'template',
                ]
            );
            $this->add_control(
                'separator', [
                    'label' => esc_html__( 'Separator', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '/' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'period', [
                    'label' => esc_html__( 'Period', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'month' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'show_price_text',
                [
                    'label' => esc_html__('Price Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'price_text', [
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'What Value Add For Your Business' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_price_text' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Features Section
        $this->start_controls_section(
            'features_section',
            [
                'label' => esc_html__('Features', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_features',
                [
                    'label' => esc_html__('Show Features', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            // $this->add_control(
            //     'show_features_icon',
            //     [
            //         'label' => esc_html__('Show Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::SWITCHER,
            //         'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'return_value' => 'yes',
            //         'default' => 'yes',
            //     ]
            // );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'feature_list_item_title', [
                    'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => esc_html__( 'Feature Item 1' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    // 'separator' => 'before',
                    'label_block' => true,
                ]
            );

			$repeater->add_control(
				'feature_list_item_media_type',
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
						// 'image' => [
						// 	'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
						// 	'icon' => 'eicon-image-bold',
						// ],
					],
					'label_block' => true,
				]
			);

            $repeater->add_control(
                'feature_list_item_icon',
                [
                    'label' => esc_html__( 'Select Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'far fa-check-circle',
                        'library' => 'fa-solid',
                    ],
                    'label_block' => true,
                    'condition' => [
                        'feature_list_item_media_type' => 'icon'
                    ]
                ]
            );

            $repeater->add_control(
                'feature_list_item_icon_color',
                [
                    'label' => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.pea-pricing-feature-item .pea-pricing-feature-icon-inner i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}}.pea-pricing-feature-item .pea-pricing-feature-icon-inner svg' => 'fill: {{VALUE}};',
                    ]
                ]
            );

            $repeater->add_control(
                'feature_list_item_title_color',
                [
                    'label' => esc_html__('Title Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}.pea-pricing-feature-item .pea-pricing-feature-text' => 'color: {{VALUE}};',
                    ]
                ]
            );

            // $repeater->add_control(
            //     'feature_list_item_image',
            //     [
            //         'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            //         'type' => Controls_Manager::MEDIA,
            //         'skin' => 'inline',
            //         'dynamic' => [
            //             'active' => true,
            //         ],
            //         'condition' => [
            //             'feature_list_item_media_type' => 'image'
            //         ]
            //     ]
            // );

            $this->add_control(
                'feature_list',
                [
                    'label' => esc_html__( 'Feature List', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'feature_list_item_title' => esc_html__( 'Customization options', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'far fa-check-circle',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'Essential template library', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'far fa-check-circle',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'Handcrafted theme styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'far fa-check-circle',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'Unmatched performance', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'far fa-check-circle',
                                'library' => 'fa-solid'
                            ],
                        ],
                    ],
                    'title_field' => '{{{ feature_list_item_title }}}',
                    'condition' => [
                        'show_features' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_feature_text',
                [
                    'label' => esc_html__('Text Switcher', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'feature_text', [
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Billed every year Popular amongst entrepeneurs $497 per year' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_feature_text' => 'yes',
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
                'button_position',
                [
                    'label' => esc_html__('Button Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'after-price' => 'After Price',
                        'after-feature' => 'After Feature',
                    ],
                    'default' => 'after-feature',
                    'condition' => [
                        'show_button' => 'yes',
                    ],
                ]
            );
	
            $this->add_control(
                'button_text', [
                    'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Select Plan' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
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
                    'default' => 'yes',
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
            $this->add_responsive_control(
                'button_icon_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-button' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_button_icon' => 'yes',
                        'show_button' => 'yes',
                    ],
                ]
            );  
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================            

		$this->start_controls_section(
			'top_section_styling_section',
			[
				'label' => esc_html__( 'Top Section', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'display_top_section' => 'yes',
                ],
			]
		);
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'top_section_typography',
                    'selector' => '{{WRAPPER}} .pea-pricing-top-wrapper',
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
            
            $this->add_control(
                'top_section_background_custom_css_toggle',
                [
                    'label' => esc_html__('Background Custom Css Enable', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'top_section_background_custom_css',
                [
                    'label' => esc_html__( 'Background Custom Css', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'linear-gradient(141.79deg, #FF38FC 0%, #8091FF 50%, #1868BE 100%)',
                    'placeholder' => esc_html__( 'e.g. linear-gradient(90deg, #f00, #00f)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-table-wrapper' => 'background-color: transparent;  background-image: {{VALUE}};',
                    ],
                    'condition' => [
                        'top_section_background_custom_css_toggle' => 'yes',
                    ],
                ]
            );

            $this->start_controls_tabs( 'top_section_tabs' );

                $this->start_controls_tab(
                    'top_section_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'top_section_text_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-top-wrapper' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'top_section_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#399CFF', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-pricing-table-wrapper',
                            'condition' => [
                                'top_section_background_custom_css_toggle' => 'no',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'top_section_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-pricing-table-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'top_section_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'top_section_hover_text_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-top-wrapper' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'top_section_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-pricing-table-wrapper:hover',
                        ]
                    );
            
                    $this->add_control(
                        'top_section_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'top_section_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'top_section_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 28,
                        'right' => 28,
                        'bottom' => 28,
                        'left' => 28,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-table-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'top_section_title_padding',
                [
                    'label'     => esc_html__('Title Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 20,
                        'right' => 0,
                        'bottom' => 20,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-top-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'top_section_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 5,
                        'right' => 5,
                        'bottom' => 5,
                        'left' => 5,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-table-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();            

		$this->start_controls_section(
			'pricing_container_styling_section',
			[
				'label' => esc_html__( 'Container', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'pricing_container_tabs' );

                $this->start_controls_tab(
                    'pricing_container_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'pricing_container_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#fff', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-pricing-main-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'pricing_container_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-pricing-main-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'pricing_container_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'pricing_container_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-pricing-main-wrapper:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'pricing_container_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-pricing-main-wrapper:hover',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'pricing_container_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'pricing_container_border_radius',
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
                        '{{WRAPPER}} .pea-pricing-main-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'pricing_container_padding',
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
                        '{{WRAPPER}} .pea-pricing-main-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_container_margin',
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
                        '{{WRAPPER}} .pea-pricing-main-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'pricing_container_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-pricing-main-wrapper',
                ]
            );
		$this->end_controls_section();       

		$this->start_controls_section(
			'price_box_styling_section',
			[
				'label' => esc_html__( 'Price Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'price_box_tabs' );

                $this->start_controls_tab(
                    'price_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'price_box_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-pricing-header',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'price_box_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-pricing-header',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 0,
                                        'right' => 0,
                                        'bottom' => 1,
                                        'left' => 0,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#E1E3E8',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'price_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'price_box_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-header',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'price_box_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-header',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'price_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'price_box_border_radius',
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
                        '{{WRAPPER}} .pea-pricing-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'price_box_padding',
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
                        '{{WRAPPER}} .pea-pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();
        
        // Pricing Icon Styling Controls
        $this->start_controls_section(
            'pricing_icon_styling',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_icon_type' => 'icon',
                ],
            ]
        );  
            
            $this->add_control(
                'icon_position',
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
                'icon_position_top',
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
                        'size' => 5,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-ribbon-icon' => 'position:absolute; top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'icon_position' => 'yes',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'icon_position_left',
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
                        'size' => 90,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-ribbon-icon' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'icon_position' => 'yes',
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
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-ribbon-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-pricing-ribbon-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-ribbon-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
                            '{{WRAPPER}} .pea-pricing-ribbon-icon i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-pricing-ribbon-icon svg' => 'fill: {{VALUE}}',
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
                            '{{WRAPPER}} .pea-pricing-ribbon-icon' => 'background: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'icon_border',
                        'label'    => esc_html__( 'Border', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-pricing-ribbon-icon',
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
                            '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-ribbon-icon i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-ribbon-icon svg' => 'fill: {{VALUE}}',
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
                            '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-ribbon-icon' => 'border-top-color: {{VALUE}}',
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
                            '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-ribbon-icon' => 'border-color: {{VALUE}}',
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
                        '{{WRAPPER}} .pea-pricing-ribbon-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .pea-pricing-ribbon-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        //Pricing Title Styling Controls
        $this->start_controls_section(
            'pricing_title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'pricing_title_alignment',
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
                        '{{WRAPPER}} .pea-pricing-title-wrapper' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-pricing-title' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template'
                ]
            );
        
            $this->add_control(
                'pricing_title_tag',
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
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'pricing_title_typography',
                    'selector' => '{{WRAPPER}} .pea-pricing-title',
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

            $this->start_controls_tabs( 'pricing_title_tabs' );
                $this->start_controls_tab(
                    'pricing_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'pricing_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171c',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'pricing_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'pricing_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'pricing_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'pricing_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-pricing-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'pricing_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 10,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        //Pricing Sub Title Styling Controls
        $this->start_controls_section(
            'pricing_subtitle_styling',
            [
                'label' => esc_html__('Sub Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'pricing_subtitle_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-subtitle' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_control(
                'pricing_subtitle_tag',
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
                    'default' => 'span',
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'pricing_subtitle_typography',
                    'selector' => '{{WRAPPER}} .pea-pricing-subtitle',
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
                                'size' => 130,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'pricing_subtitle_tabs' );
                $this->start_controls_tab(
                    'pricing_subtitle_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'pricing_subtitle_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#6A758E',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-subtitle' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'pricing_subtitle_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'pricing_subtitle_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-subtitle' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'pricing_subtitle_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'pricing_subtitle_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-pricing-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'pricing_subtitle_margin',
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
                        '{{WRAPPER}} .pea-pricing-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        //Pricing Styling Controls
        $this->start_controls_section(
            'pricing_styling',
            [
                'label' => esc_html__('Price', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'pricing_alignment',
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
                        '{{WRAPPER}} .pea-pricing-price-wrapper' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-pricing-price-wrapper .pea-pricing-after-text-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'start',
                    // 'render_type'  => 'template',
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'label' => __( 'Price Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector' => '{{WRAPPER}} .pea-pricing-normal-price',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 92,
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
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'sale_price_typography',
                    'label' => __( 'Sale Price Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector' => '{{WRAPPER}} .pea-pricing-sale-price',
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
                                'size' => 40,
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
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'currency_typography',
                    'label' => __( 'Currency Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector' => '{{WRAPPER}} .price-currency',
                    // 'fields_options' => [
                    //     'typography' => [
                    //         'default' => 'custom',
                    //     ],
                    //     'font_family' => [
                    //         'default' => 'Plus Jakarta Sans',
                    //     ],
                    //     'font_weight' => [
                    //         'default' => '400',
                    //     ],
                    //     'font_size' => [
                    //         'default' => [
                    //             'unit' => 'px',
                    //             'size' => 92,
                    //         ],
                    //     ],
                    //     'line_height' => [
                    //         'default' => [
                    //             'unit' => '%',
                    //             'size' => 130,
                    //         ],
                    //     ],
                    // ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'period_typography',
                    'label' => __( 'Period Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector' => '{{WRAPPER}} .price-period',
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

            $this->start_controls_tabs( 'pricing_tabs' );
                $this->start_controls_tab(
                    'pricing_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'price_color',
                        [
                            'label' => esc_html__('Price Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0D173B',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-normal-price' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-normal-price .price-currency span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'sale_price_color',
                        [
                            'label' => esc_html__('Sale Price Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0D173B',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-sale-price' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-sale-price .price-currency span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'currency_color',
                        [
                            'label' => esc_html__('Currency Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0D173B',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-price-inner-wrapper .pea-pricing-normal-price .price-currency span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-price-inner-wrapper .pea-pricing-sale-price .price-currency span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'period_color',
                        [
                            'label' => esc_html__('Period Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .price-period' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'pricing_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'price_hover_color',
                        [
                            'label' => esc_html__('Price Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-normal-price' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-normal-price .price-currency span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'sale_price_hover_color',
                        [
                            'label' => esc_html__('Sale Price Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-sale-price' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-sale-price .price-currency span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'currency_hover_color',
                        [
                            'label' => esc_html__('Currency Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-price-inner-wrapper .pea-pricing-normal-price .price-currency span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-price-inner-wrapper .pea-pricing-sale-price .price-currency span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'period_hover_color',
                        [
                            'label' => esc_html__('Period Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-price-inner-wrapper .price-period' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'pricing_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'pricing_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 32,
                        'right' => 0,
                        'bottom' => 32,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-price-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Price After Text Styling Controls
        $this->start_controls_section(
            'price_after_text_styling_section',
            [
                'label' => esc_html__('Price After Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'price_after_text_typography',
                    'selector' => '{{WRAPPER}} .pea-pricing-after-text',
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
                                'size' => 14,
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

            $this->start_controls_tabs( 'price_after_text_tabs' );
                $this->start_controls_tab(
                    'price_after_text_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'price_after_text_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#6A758E',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-after-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'price_after_text_bg_type',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background Type ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#ffffff', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-pricing-after-text',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'price_after_text_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-pricing-after-text',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'price_after_text_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'price_after_text_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-after-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'price_after_text_hover_bg_type',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background Type ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-after-text',
                        ]
                    );
            
                    $this->add_control(
                        'price_after_text_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-after-text' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'price_after_text_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_responsive_control(
                'price_after_text_border_radius',
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
                        '{{WRAPPER}} .pea-pricing-after-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_after_text_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 5,
                        'right' => 10,
                        'bottom' => 5,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-after-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Feature Styling Controls
        $this->start_controls_section(
            'feature_item_styling',
            [
                'label' => esc_html__('Feature', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'feature_alignment',
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
                        '{{WRAPPER}} .pea-pricing-feature-item' => 'justify-content: {{VALUE}};',
                        '{{WRAPPER}} .pea-pricing-feature-after-text-wrapper' => 'justify-content: {{VALUE}};',
                        '{{WRAPPER}} .pea-pricing-feature-after-text' => 'justify-content: {{VALUE}};',
                        '{{WRAPPER}} .pea-pricing-feature-after-text' => 'text-align: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_text_alignment',
                    'selector' => '{{WRAPPER}} .pea-pricing-feature-text',
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
            
            $this->add_responsive_control(
                'feature_item_size',
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
                        '{{WRAPPER}} .pea-pricing-feature-item .pea-pricing-feature-icon i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-pricing-feature-item .pea-pricing-feature-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'feature_item_gap',
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
                        '{{WRAPPER}} .pea-pricing-feature-item' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'feature_item_tabs' );
				$this->start_controls_tab(
					'feature_item_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
			
					$this->add_control(
						'feature_item_icon_color',
						[
							'label' => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '#15171C',
							'selectors' => [
								'{{WRAPPER}} .pea-pricing-feature-item .pea-pricing-feature-icon-inner i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-pricing-feature-item .pea-pricing-feature-icon-inner svg' => 'fill: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'feature_item_title_color',
						[
							'label' => esc_html__('Title Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '#555E72',
							'selectors' => [
								'{{WRAPPER}} .pea-pricing-feature-item .pea-pricing-feature-text' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'feature_item_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-pricing-feature-item',
                            // 'fields_options' => [
                            //     'border' => [
                            //         'default' => 'solid',
                            //     ],
                            //     'width' => [
                            //         'default' => [
                            //             'top' => 0,
                            //             'right' => 0,
                            //             'bottom' => 1,
                            //             'left' => 0,
                            //         ],
                            //     ],
                            //     'color' => [
                            //         'default' => '#E1E3E8',
                            //     ],
                            // ],
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'feature_item_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
			
					$this->add_control(
						'feature_item_hover_icon_color',
						[
							'label' => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-feature-icon-inner i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-feature-icon-inner svg' => 'fill: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'feature_item_hover_title_color',
						[
							'label' => esc_html__('Title Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-feature-text' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'feature_item_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-pricing-table-wrapper:hover .pea-pricing-feature-item' => 'color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'feature_item_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'feature_item_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-pricing-feature-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_item_box_border_radius',
                [
                    'label'     => esc_html__('Box Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
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

                        '{{WRAPPER}} .pea-pricing-feature-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',

                        '{{WRAPPER}} .pea-pricing-feature-item:last-child' => 'border-bottom-left-radius: {{LEFT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'hide_all_item_border_except_last',
                [
                    'label' => esc_html__( 'Hide Border Bottom (Except Last)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-feature-item:not(:last-child)' => 'border-bottom-style: none;',
                    ],
                ]
            );
            
            $this->add_control(
                'hide_last_item_border_enable',
                [
                    'label' => esc_html__('Hide Last Item Border Bottom Enable', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'hide_last_item_border',
                [
                    'label' => esc_html__('Hide Last Item Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'none',
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-feature-item:last-child' => 'border-bottom-style: {{VALUE}};',
                    ],
                    'condition' => [
                        'hide_last_item_border_enable' => 'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_item_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 10,
                        'right' => 0,
                        'bottom' => 10,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-feature-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_item_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-feature-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_item_box_padding',
                [
                    'label'     => esc_html__('Box Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 40,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-features-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // $this->add_responsive_control(
            //     'feature_item_margin',
            //     [
            //         'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-pricing-feature-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );
        $this->end_controls_section();
        
        // Feature After Text Styling Controls
        $this->start_controls_section(
            'feature_after_text_styling_section',
            [
                'label' => esc_html__('Feature After Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_feature_text' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'feature_after_text_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-feature-after-text' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_after_text_typography',
                    'selector' => '{{WRAPPER}} .pea-pricing-feature-after-text',
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

            $this->start_controls_tabs( 'feature_after_text_tabs' );
                $this->start_controls_tab(
                    'feature_after_text_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'feature_after_text_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-feature-after-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'feature_after_text_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'feature_after_text_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-pricing-feature-after-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            // $this->add_control(
            //     'feature_after_text_hr',
            //     [
            //         'type' => Controls_Manager::DIVIDER,
            //     ]
            // );

            $this->add_responsive_control(
                'feature_after_text_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-feature-after-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Button Styling Controls
        $this->start_controls_section(
            'button_styling', 
            [
                'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );  
            
            $this->add_responsive_control(
                'button_alignment',
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
                        '{{WRAPPER}} .pea-pricing-button-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template'
                ]
            );
            
            $this->add_responsive_control(
                'button_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-pricing-button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .pea-button-text',
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
                                'size' => 18,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 100,
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
            
                    $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-button' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'button_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'default' => 'gradient',
                                ],
                                // Gradient-specific defaults
                                'color' => [
                                    'default' => '#FF38FC', // First gradient color
                                ],
                                'color_b' => [
                                    'default' => '#8091FF', // Second gradient color
                                ],
                                'gradient_angle' => [
                                    'default' => [
                                        'unit' => 'deg',
                                        'size' => 178, // Gradient angle (for linear)
                                    ],
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-pricing-button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'button_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-pricing-button',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'button_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => esc_html__(' Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-button:hover .pea-pricing-button' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'button_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-button:hover .pea-pricing-button' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'button_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-button:hover .pea-pricing-button' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'button_hr',
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
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 20,
                        'right' => 20,
                        'bottom' => 20,
                        'left' => 20,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 40,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-pricing-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'button_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'button_icon_title',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->start_controls_tabs( 'button_icon_tabs' );
                $this->start_controls_tab(
                    'button_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'button_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-button .pea-pricing-button-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-button .pea-pricing-button-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'button_icon_size',
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
                                '{{WRAPPER}} .pea-pricing-button .pea-pricing-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pea-pricing-button .pea-pricing-button-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );  
            
                    $this->add_responsive_control(
                        'button_icon_rotate',
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
                                '{{WRAPPER}} .pea-pricing-button .pea-pricing-button-icon' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'button_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'button_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-pricing-button:hover .pea-pricing-button-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-pricing-button:hover .pea-pricing-button-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'button_icon_hover_rotate',
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
                                '{{WRAPPER}} .pea-pricing-button:hover .pea-pricing-button-icon' => 'transform: rotate({{SIZE}}deg);',
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
        $preset_styles  = isset($settings['preset_styles']) ? $settings['preset_styles'] : '' ;

        $top_section        = isset($settings['display_top_section'])   ? $settings['display_top_section'] : '' ;  
        $top_text           = isset($settings['top_text'])              ? $settings['top_text'] : '' ;  
        $title              = isset($settings['pricing_title'])         ? $settings['pricing_title'] : '' ;  
        $title_tag          = isset($settings['pricing_title_tag'])     ? $settings['pricing_title_tag'] : '' ;  
        $show_subtitle      = isset($settings['show_pricing_subtitle']) ? $settings['show_pricing_subtitle'] : '' ;
        $subtitle           = isset($settings['pricing_subtitle'])      ? $settings['pricing_subtitle'] : '' ;
        $subtitle_tag       = isset($settings['pricing_subtitle_tag'])  ? $settings['pricing_subtitle_tag'] : '' ;
        $price              = isset($settings['price'])                 ? $settings['price'] : '' ;  
        $show_sale_price    = isset($settings['show_sale_price'])       ? $settings['show_sale_price'] : '' ;
        $sale_price         = isset($settings['sale_price'])            ? $settings['sale_price'] : '' ;  
        $currency           = isset($settings['currency'])              ? $settings['currency'] : '' ;  
        $currency_position  = isset($settings['currency_position'])     ? $settings['currency_position'] : '' ;
        $separator          = isset($settings['separator'])             ? $settings['separator'] : '' ;  
        $period             = isset($settings['period'])                ? $settings['period'] : '' ;  
        $show_price_text    = isset($settings['show_price_text'])       ? $settings['show_price_text'] : '' ;
        $price_text         = isset($settings['price_text'])            ? $settings['price_text'] : '' ;  
        $show_feature_text  = isset($settings['show_feature_text'])     ? $settings['show_feature_text'] : '' ;
        $feature_text       = isset($settings['feature_text'])          ? $settings['feature_text'] : '' ;  
        $show_button        = isset($settings['show_button'])           ? $settings['show_button'] : '' ;  
        $button_text        = isset($settings['button_text'])           ? $settings['button_text'] : '' ;  
        $button_link        = isset($settings['button_link']['url']) ? $settings['button_link']['url'] : '' ;  
        $button_target      = isset($settings['button_link']['is_external']) ? ' target=_blank' : '';
        $button_nofollow    = isset($settings['button_link']['nofollow']) ? ' rel=nofollow' : '';
        $show_button_icon   = isset($settings['show_button_icon'])      ? $settings['show_button_icon'] : '' ;  
        $button_icon        = isset($settings['button_icon'])           ? $settings['button_icon'] : '' ;  
        $button_icon_position   = isset($settings['button_icon_position'])  ? $settings['button_icon_position'] : '' ;  
        ?>
        <div class="pea-widget-wrapper pea-pricing-table-wrapper pea-feature-dbd5d017 <?php echo esc_attr($top_section === 'yes' ? 'pea-pricing-top-section' : ''); ?>  ">
            <?php if($top_section === 'yes'){ ?>
                <?php if(!empty($top_text)){ ?>
                    <div class="pea-pricing-inner-wrapper">
                        <div class="pea-pricing-top-wrapper">
                            <span class="pea-pricing-top-text"><?php echo esc_html($top_text); ?></span>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="pea-pricing-main-wrapper">
                <div class="pea-pricing-header">
                    <?php if($settings['pricing_icon_type'] === 'icon'){ ?>
                        <div class="pea-pricing-ribbon-icon-wrapper">
                            <div class="pea-pricing-ribbon-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['pricing_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(!empty($title) || !empty($subtitle)){ ?>
                        <div class="pea-pricing-title-wrapper">
                            <?php if(!empty($title)){ ?>
                                <<?php echo esc_attr($title_tag); ?> class="pea-pricing-title"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                            <?php } ?>
                            <?php if(!empty($subtitle)){ ?>
                                <<?php echo esc_attr($subtitle_tag); ?> class="pea-pricing-subtitle"><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="pea-pricing-price-wrapper">
                        <div class="pea-pricing-price-inner-wrapper">
                            <span class="pea-pricing-normal-price <?php echo esc_attr($show_sale_price === 'yes' ? 'line-through' : ''); ?>">
                                <?php if($currency_position === 'left'){ ?>
                                    <span class="price-currency">
                                        <span><?php echo esc_html($currency); ?></span>
                                    </span>
                                <?php } ?>
                                <span><?php echo esc_html($price); ?></span>
                                <?php if($currency_position === 'right'){ ?>
                                    <span class="price-currency">
                                        <span><?php echo esc_html($currency); ?></span>
                                    </span>
                                <?php } ?>
                                <?php if($show_sale_price !== 'yes'){ ?>
                                    <span class="price-period">
                                        <span><?php echo esc_html($separator); ?></span>
                                        <span><?php echo esc_html($period); ?></span>
                                    </span>
                                <?php } ?>
                            </span>
                        <?php if($show_sale_price === 'yes'){ ?>
                            <span class="pea-pricing-sale-price">
                                <?php if($currency_position === 'left'){ ?>
                                    <span class="price-currency">
                                        <span><?php echo esc_html($currency); ?></span>
                                    </span>
                                <?php } ?>
                                <span><?php echo esc_html($sale_price); ?></span>
                                <?php if($currency_position === 'right'){ ?>
                                    <span class="price-currency">
                                        <span><?php echo esc_html($currency); ?></span>
                                    </span>
                                <?php } ?>
                                <span class="price-period">
                                    <span><?php echo esc_html($separator); ?></span>
                                    <span><?php echo esc_html($period); ?></span>
                                </span>
                            </span>
                        <?php } ?>
                        </div>
                        <?php if($show_price_text === 'yes'){ ?>
                            <div class="pea-pricing-after-text-wrapper">
                                <span class="pea-pricing-after-text">
                                    <?php echo esc_html($price_text); ?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if($show_button === 'yes' && $settings['button_position'] === 'after-price' ){ ?>
                        <div class="pea-pricing-button-wrapper-main">
                            <div class="pea-pricing-button-wrapper">
                                <a class="pea-pricing-button" 
                                    href="<?php echo esc_url($button_link) ?>"
                                    <?php echo esc_attr($button_target); ?>
                                    <?php echo esc_attr($button_nofollow); ?>
                                >
                                    <?php if($show_button_icon === 'yes' && $button_icon_position === 'left'){ ?>
                                        <div class="pea-pricing-button-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php } ?>
                                    <span class="pea-button-text"><?php echo esc_html($button_text); ?></span>
                                    <?php if($show_button_icon === 'yes' && $button_icon_position === 'right'){ ?>
                                        <div class="pea-pricing-button-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="pea-pricing-content">
                    <div class="pea-pricing-features-wrapper">
                        <?php if($settings['show_features'] === 'yes'){ ?>
                            <ul class="pea-pricing-features-list">
                                <?php foreach ( $settings['feature_list'] as $index => $feature ) : ?>
                                <li class="pea-pricing-feature-item single-item-item-<?php echo esc_attr($index); ?> elementor-repeater-item-<?php echo esc_attr( $feature['_id'] ) ?>">
                                    <div class="pea-pricing-feature-icon">
                                        <?php if($feature['feature_list_item_media_type'] === 'icon'){ ?>
                                            <span class="pea-pricing-feature-icon-inner">
                                                <?php \Elementor\Icons_Manager::render_icon( $feature['feature_list_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <span class="pea-pricing-feature-text"><?php echo esc_html($feature['feature_list_item_title']); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php } ?>
                    </div>
                    <?php if($show_feature_text === 'yes'){ ?>
                        <div class="pea-pricing-feature-after-text-wrapper">
                            <span class="pea-pricing-feature-after-text">
                                <?php echo esc_html($feature_text); ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
                <?php if($show_button === 'yes' && $settings['button_position'] === 'after-feature' ){ ?>
                    <div class="pea-pricing-button-wrapper-main">
                        <div class="pea-pricing-button-wrapper">
                            <a class="pea-pricing-button" 
                                href="<?php echo esc_url($button_link) ?>"
                                <?php echo esc_attr($button_target); ?>
                                <?php echo esc_attr($button_nofollow); ?>
                            >
                                <?php if($show_button_icon === 'yes' && $button_icon_position === 'left'){ ?>
                                    <div class="pea-pricing-button-icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                <?php } ?>
                                <span class="pea-button-text"><?php echo esc_html($button_text); ?></span>
                                <?php if($show_button_icon === 'yes' && $button_icon_position === 'right'){ ?>
                                    <div class="pea-pricing-button-icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php 
    }
}