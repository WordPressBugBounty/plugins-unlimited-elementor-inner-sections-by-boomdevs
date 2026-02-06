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
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class FeatureList extends Widget_Base {
    
    public function get_name() {
        return 'pea_feature_list';
    }
    
    public function get_title() {
        return esc_html__('Featured List', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_feature_list_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--feature-list'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Presets Section
        $this->start_controls_section(
            'features',
            [
                'label' => esc_html__('Feature', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'preset_styles',
                [
                    'label' => esc_html__('Preset Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
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

            $repeater = new \Elementor\Repeater();
            $repeater->start_controls_tabs( 'feature_list_item_tabs' );
                $repeater->start_controls_tab(
                    'feature_list_item_content_tab',
                    [
                        'label' => __( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $repeater->add_control(
                        'feature_list_item_media_type',
                        [
                            'label'       => esc_html__( 'Media Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'        => Controls_Manager::SELECT,
                            'options'     => [
                                'icon' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'image' => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' )
                            ],
                            'default'     => 'icon',
                            'label_block' => false,
                        ]
                    );

                    $repeater->add_control(
                        'feature_list_item_icon',
                        [
                            'label' => esc_html__( 'Select Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'fa-solid',
                            ],
                            'label_block' => false,
                            'skin' => 'inline',
                            'condition' => [
                                'feature_list_item_media_type' => 'icon'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'feature_list_item_image',
                        [
                            'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'skin' => 'inline',
                            'dynamic' => [
                                'active' => true,
                            ],
                            'condition' => [
                                'feature_list_item_media_type' => 'image'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'feature_list_item_title', [
                            'label' => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => esc_html__( 'List Title' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'separator' => 'before',
                            'label_block' => true,
                        ]
                    );

                    // $repeater->add_control(
                    //     'feature_list_item_title_url',
                    //     [
                    //         'label' => esc_html__( 'Title Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    //         'type' => \Elementor\Controls_Manager::URL,
                    //         'dynamic' => [
                    //             'active' => true,
                    //         ],
                    //         'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    //         'default' => [
                    //             'url' => '',
                    //             'is_external' => true,
                    //             'nofollow' => true,
                    //             'custom_attributes' => '',
                    //         ],
                    //         'label_block' => true,
                    //     ]
                    // );

                    $repeater->add_control(
                        'feature_list_item_desc',
                        [
                            'label' => esc_html__( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => esc_html__( 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'placeholder' => esc_html__( 'Type your description here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'rows' => 10,
                        ]
                    );
                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'feature_list_item_style_tab',
                    [
                        'label' => __( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $repeater->add_control(
                        'feature_list_custom_styles',
                        [
                            'label' => esc_html__( 'Custom Styles', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SWITCHER,
                        ]
                    );
                    $repeater->add_control(
                        'feature_list_icon_color_this',
                        [
                            'label'  => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-feature-list-icon i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-feature-list-icon svg' => 'fill: {{VALUE}}',
                            ],
                            'condition' => [
                                'feature_list_custom_styles' => 'yes'
                            ]
                        ]
                    );
                
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'feature_list_icon_bg_color_this',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Icon Bg Color ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .pea-feature-list-icon-inner',
                            'condition' => [
                                'feature_list_custom_styles' => 'yes'
                            ]
                        ]
                    );
                    $repeater->add_control(
                        'feature_list_icon_border_color_this',
                        [
                            'label'  => esc_html__( 'Icon Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-feature-list-icon-inner' => 'border-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'feature_list_custom_styles' => 'yes'
                            ]
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'feature_list_icon_box_shadow_this',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pea-feature-list-icon-inner',
                        ]
                    );
                $repeater->end_controls_tab();
            $repeater->end_controls_tabs();

            $this->add_control(
                'feature_list',
                [
                    'label' => esc_html__( 'Feature List', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'feature_list_item_title' => esc_html__( 'Fast Loading Speed', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_desc' => esc_html__( 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'fas fa-server',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'User-Friendly Design', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_desc' => esc_html__( 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'fas fa-swatchbook',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'Customizable Templates', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_desc' => esc_html__( 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'fas fa-layer-group',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'Responsive Layout', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_desc' => esc_html__( 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'fas fa-expand-arrows-alt',
                                'library' => 'fa-solid'
                            ],
                        ],
                        [
                            'feature_list_item_title' => esc_html__( 'Secure Data Protection', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_desc' => esc_html__( 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'feature_list_item_icon' => [
                                'value' => 'fas fa-shield-alt',
                                'library' => 'fa-solid'
                            ],
                        ],
                    ],
                    'title_field' => '{{{ feature_list_item_title }}}',
                ]
            );
        
            $this->add_control(
                'feature_item_title_tag',
                [
                    'label' => esc_html__('Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
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
                ]
            );
        
            $this->add_control(
                'feature_item_icon_shape',
                [
                    'label' => esc_html__('Icon Shape', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'pea--none' => 'None',
                        'pea--circle' => 'Circle',
                        'pea--rhombus' => 'Rhombus',
                    ],
                    'default' => 'pea--circle',
                ]
            );
            
            $this->add_control(
                'feature_item_icon_position',
                [
                    'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'pea-icon-position-left' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'pea-icon-position-center' => [
                            'title' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'pea-icon-position-right' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'pea-icon-position-left',
                    'render_type'  => 'template',
                ]
            );  

            $this->add_control(
                'feature_item_vertical_align',
                [
                    'label' => esc_html__( 'Vertical Align', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => false,
                    'default' => 'center',
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__( 'Top', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Middle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => esc_html__( 'Bottom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-v-align-bottom',
                        ]
                    ],
                    'render_type' => 'template',
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-item' => 'align-items: {{VALUE}}',
                    ],
                    'condition' => [
                        'feature_item_icon_position!' => 'pea-icon-position-center', 
                    ]
                ]
            );

            $this->add_control(
                'feature_list_horizontal_alignment',
                [
                    'label' => esc_html__( 'Horizotal Align', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start'    => [
                            'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'render_type' => 'template',
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-title' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .pea-feature-list-text' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'feature_item_icon_position' => 'pea-icon-position-center', 
                    ]
                ]
            );

            // $this->add_control(
            //     'feature_list_line',
            //     [
            //         'label' => esc_html__( 'Show Line', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            //         'type' => Controls_Manager::SWITCHER,
            //         'render_type' => 'template',
            //         'separator' => 'before',
            //         'default' => 'no',
            //         'condition' => [
            //             'feature_item_icon_position' => ['pea-icon-position-left', 'pea-icon-position-right']
            //         ]
            //     ]
            // );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================            

        // Feature List Layout Controls
		$this->start_controls_section(
			'feature_layout',
			[
				'label' => esc_html__( 'Layout', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
            
            $this->add_responsive_control(
                'feature_list_direction',
                [
                    'label' => esc_html__('List Direction', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'column' => [
                            'title' => esc_html__('Bottom', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'row' => [
                            'title' => esc_html__('Between', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'label_block' => true,
                    'default' => 'column',
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-items' => 'flex-direction: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'feature_list_wrap',
                [
                    'label' => esc_html__('List Wrap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'nowrap' => [
                            'title' => esc_html__('No Wrap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-nowrap',
                        ],
                        'wrap' => [
                            'title' => esc_html__('Wrap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-wrap',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-items' => 'flex-wrap: {{VALUE}};',
                    ],
                    'label_block' => true,
                    'default' => 'nowrap',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'feature_list_gap',
                [
                    'label' => esc_html__('List Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-feature-list-items' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
		$this->end_controls_section();          

        // Feature List Box Styling Controls
		$this->start_controls_section(
			'feature_list_box_styling',
			[
				'label' => esc_html__( 'Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'feature_list_box_tabs' );

                $this->start_controls_tab(
                    'feature_list_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'feature_list_box_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-feature-list-item',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'feature_list_box_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-feature-list-item',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'feature_list_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'feature_list_box_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-feature-list-item:hover',
                        ]
                    );

                    $this->add_control(
                    	'feature_list_box_hover_border_color',
                    	[
                    		'label' => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    		'type' => \Elementor\Controls_Manager::COLOR,
                    		'default' => '',
                    		'selectors' => [
                    			'{{WRAPPER}} .pea-feature-list-item:hover' => 'border-color: {{VALUE}}'
                    		],
                    	]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'feature_list_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'feature_list_box_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 6,
                        'bottom' => 6,
                        'left' => 6,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'feature_list_box_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 32,
                        'right' => 32,
                        'bottom' => 32,
                        'left' => 32,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_list_box_margin',
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
                        '{{WRAPPER}} .pea-feature-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'feature_list_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-feature-list-item',
                ]
            );
		$this->end_controls_section();
		// $this->start_controls_section(
		// 	'feature_list_line_styling',
		// 	[
		// 		'label' => esc_html__( 'Line', 'unlimited-elementor-inner-sections-by-boomdevs' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 		'condition' => [
		// 			'feature_list_line' => 'yes'
		// 		]
		// 	]
		// );

		// $this->add_control(
		// 	'feature_list_line_color',
		// 	[
		// 		'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'default' => '#6A65FF',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .frontis-feature-list-line' => 'border-color: {{VALUE}}'
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'feature_list_line_width',
		// 	[
		// 		'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => ['px'],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 1,
		// 				'max' => 10,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => 'px',
		// 			'size' => 2,
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .frontis-feature-list-line' => 'border-left-width: {{SIZE}}{{UNIT}};',
		// 		],
		// 		'separator' => 'before'
		// 	]
		// );

        // $this->add_control(
        //     'feature_list_line_border_type',
        //     [
        //         'label'       => esc_html__( 'Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         'type'        => Controls_Manager::SELECT,
        //         'default'     => 'solid',
        //         'label_block' => false,
        //         'options'     => [
        //             'solid'  => esc_html__( 'Solid', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //             'dashed' => esc_html__( 'Dashed', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //             'dotted' => esc_html__( 'Dotted', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         ],
        //         'selectors'   => [
        //             '{{WRAPPER}} .frontis-feature-list-line' => 'border-left-style: {{VALUE}};',
        //         ]
        //     ]
        // );

		// $this->end_controls_section();
        
        // Feature List Icon / Image Styling Controls
        $this->start_controls_section(
            'feature_list_icon_image_styling',
            [
                'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'feature_list_icon_size',
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-feature-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-feature-list-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'feature_list_icon_gap',
                [
                    'label' => esc_html__('Icon Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-feature-list-item' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'feature_list_image_width',
                [
                    'label' => esc_html__('Image Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-feature-list-icon-inner .pea-feature-icon-image-wrapper img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'feature_list_image_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-feature-list-icon-inner .pea-feature-icon-image-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'feature_list_image_n_icon_tabs' );

            $this->start_controls_tab(
                'feature_list_image_n_icon_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
            
                $this->add_responsive_control(
                    'feature_list_image_n_icon_wrap_rotate',
                    [
                        'label' => esc_html__('Wrap Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                            'size' => '',
                        ],
                        'selectors'       => [
                            '{{WRAPPER}} .pea-feature-list-icon-inner' => 'transform: rotate({{SIZE}}deg);',
                        ],
                    ]
                );
            
                $this->add_responsive_control(
                    'feature_list_image_n_icon_rotate',
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
                            'size' => '',
                        ],
                        'selectors'       => [
                            '{{WRAPPER}} .pea-feature-list-icon' => 'transform: rotate({{SIZE}}deg);',
                            '{{WRAPPER}} .pea-feature-icon-image-wrapper' => 'transform: rotate({{SIZE}}deg);',
                        ],
                    ]
                );
        
                $this->add_control(
                    'feature_list_image_n_icon_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-feature-list-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea-feature-list-icon svg' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'feature_list_image_n_icon_bg_color',
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
                        'selector'  => '{{WRAPPER}} .pea-feature-list-icon-inner',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'feature_list_image_n_icon_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-feature-list-icon-inner',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'feature_list_image_n_icon_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
            
                $this->add_responsive_control(
                    'feature_list_image_n_icon_hover_wrap_rotate',
                    [
                        'label' => esc_html__('Wrap Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                            'size' => '',
                        ],
                        'selectors'       => [
                            '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-icon-inner' => 'transform: rotate({{SIZE}}deg);',
                        ],
                    ]
                );
            
                $this->add_responsive_control(
                    'feature_list_image_n_icon_hover_rotate',
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
                            'size' => '',
                        ],
                        'selectors'       => [
                            '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-icon' => 'transform: rotate({{SIZE}}deg);',
                            '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-icon-image-wrapper' => 'transform: rotate({{SIZE}}deg);',
                        ],
                    ]
                );
        
                $this->add_control(
                    'feature_list_image_n_icon_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-icon svg' => 'fill: {{VALUE}};',
                        ],
                    ]
                );
            
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'feature_list_image_n_icon_hover_bg_color',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                            'color' => [
                                'default' => '#FFFFFF',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-icon-inner',
                    ]
                );
        
                $this->add_control(
                    'feature_list_image_n_icon_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-icon-inner' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'feature_list_image_n_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'feature_list_image_n_icon_border_radius_custom',
                [
                    'label' => esc_html__('Advanced Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-icon-inner' => 'border-radius: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_list_image_n_icon_border_radius',
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
                        '{{WRAPPER}} .pea-feature-list-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_list_image_n_icon_padding',
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
                        '{{WRAPPER}} .pea-feature-list-icon-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_list_image_n_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-icon-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'feature_list_image_n_icon_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-feature-list-icon-inner',
                ]
            );
        
        $this->end_controls_section();
        
        // Feature List title Styling Controls
        $this->start_controls_section(
            'feature_list_title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_list_title_typography',
                    'selector' => '{{WRAPPER}} .pea-feature-list-title',
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

            $this->start_controls_tabs( 'feature_list_title_tabs' );
                $this->start_controls_tab(
                    'feature_list_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'feature_list_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-feature-list-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'feature_list_title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-feature-list-title',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'feature_list_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'feature_list_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'feature_list_title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-title' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'feature_list_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'feature_list_title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_list_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_list_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Description Styling Controls
        $this->start_controls_section(
            'feature_list_desc_styling',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_list_desc_typography',
                    'selector' => '{{WRAPPER}} .pea-feature-list-text',
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

            $this->start_controls_tabs( 'feature_list_desc_tabs' );
                $this->start_controls_tab(
                    'feature_list_desc_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'feature_list_desc_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .pea-feature-list-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'feature_list_desc_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'feature_list_desc_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#EBF5FF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-feature-list-item:hover .pea-feature-list-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'feature_list_desc_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'feature_list_desc_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_list_desc_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-feature-list-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        // $title = isset($settings['title_text']) ? $settings['title_text'] : '' ;  
        // $title_tag = isset($settings['title_tag']) ? $settings['title_tag'] : '' ;  
        // $description = isset($settings['description_text']) ? $settings['description_text'] : '' ;
        // $info_icon = isset($settings['info_icon']) ? $settings['info_icon'] : '' ; 
        // $button_icon = isset($settings['button_icon']) ? $settings['button_icon'] : '' ; 
        ?>
        <div class="pea-widget-wrapper pea-feature-list-wrapper <?php echo esc_attr($preset_styles); ?>" >
            <div class="<?php echo esc_attr($settings['feature_item_icon_position']); ?> ">
                <ul class="pea-feature-list-items">
                    <?php foreach ( $settings['feature_list'] as $index => $feature ) : ?>
                        <li class="pea-feature-list-item single-item-item-<?php echo esc_attr($index); ?> elementor-repeater-item-<?php echo esc_attr( $feature['_id'] ) ?>">
                            <div class="pea-feature-list-icon-box">
                                <div class="pea-feature-list-icon-inner <?php echo esc_attr($settings['feature_item_icon_shape']); ?>">
                                    <?php if($feature['feature_list_item_media_type'] === 'icon'){ ?>
                                        <div class="pea-feature-list-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $feature['feature_list_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php }else if($feature['feature_list_item_media_type'] === 'image'){ $image_url = $feature['feature_list_item_image']['url']; ?> 
                                        <div class="pea-feature-icon-image-wrapper <?php echo esc_attr($settings['feature_item_icon_shape']); ?>">
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($feature['feature_list_item_title']) ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="pea-feature-list-content">
                                <<?php echo esc_attr($settings['feature_item_title_tag']); ?> class="pea-feature-list-title">
                                    <?php echo esc_html($feature['feature_list_item_title']); ?>
                                </<?php echo esc_attr($settings['feature_item_title_tag']); ?>>
                                <p class="pea-feature-list-text">
                                    <?php echo esc_html($feature['feature_list_item_desc']); ?>
                                </p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php 
    }

    protected function content_template() {
        ?>
        <#
        var preset_styles = settings.preset_styles || '';
        var iconPosition = settings.feature_item_icon_position || '';
        var iconShape = settings.feature_item_icon_shape || '';
        var titleTag = settings.feature_item_title_tag || 'h3';
        #>
        
        <div class="pea-widget-wrapper pea-feature-list-wrapper {{{ preset_styles }}}">
            <div class="{{{ iconPosition }}}">
                <ul class="pea-feature-list-items">
                    <# _.each( settings.feature_list, function( feature, index ) { #>
                        <li class="pea-feature-list-item single-item-item-{{{ index }}} elementor-repeater-item-{{{ feature._id }}}">
                            <div class="pea-feature-list-icon-box">
                                <div class="pea-feature-list-icon-inner {{{ iconShape }}}">
                                    <# if ( feature.feature_list_item_media_type === 'icon' ) { #>
                                        <div class="pea-feature-list-icon">
                                            <# 
                                            var iconHTML = elementor.helpers.renderIcon( view, feature.feature_list_item_icon, { 'aria-hidden': true }, 'i', 'object' );
                                            if ( iconHTML && iconHTML.rendered ) { #>
                                                {{{ iconHTML.value }}}
                                            <# } #>
                                        </div>
                                    <# } else if ( feature.feature_list_item_media_type === 'image' ) { 
                                        var imageUrl = feature.feature_list_item_image.url || '';
                                        var imageTitle = feature.feature_list_item_title || '';
                                    #>
                                        <div class="pea-feature-icon-image-wrapper {{{ iconShape }}}">
                                            <img src="{{{ imageUrl }}}" alt="{{{ imageTitle }}}">
                                        </div>
                                    <# } #>
                                </div>
                            </div>
                            <div class="pea-feature-list-content">
                                <{{{ titleTag }}} class="pea-feature-list-title">
                                    {{{ feature.feature_list_item_title }}}
                                </{{{ titleTag }}}>
                                <p class="pea-feature-list-text">
                                    {{{ feature.feature_list_item_desc }}}
                                </p>
                            </div>
                        </li>
                    <# }); #>
                </ul>
            </div>
        </div>
        <?php
    }



}