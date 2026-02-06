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

class InfoBox extends Widget_Base {
    
    public function get_name() {
        return 'pea_info_box';
    }
    
    public function get_title() {
        return esc_html__('Info Box', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_info_box_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--info-box'];
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
        
        $this->end_controls_section();
        
        // Icon / Image Section
        $this->start_controls_section(
            'icon_image_section',
            [
                'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_responsive_control(
                'media_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    'default' => 'start',
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-media-container' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_control(
                'media_type',
                [
                    'label' => esc_html__('Media Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'icon' => 'Icon',
                        'image' => 'Image',
                    ],
                    'default' => 'icon',
                ]
            );
            
            $this->add_control(
                'media_position',
                [
                    'label' => esc_html__('Media Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'column' => [
                            'title' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'column-reverse' => [
                            'title' => esc_html__('Bottom', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'row' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'row-reverse' => [
                            'title' => esc_html__('Between', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'column',
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-wrapper-inner' => 'flex-direction: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'card_alignment',
                [
                    'label' => esc_html__('Card Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                            'title' => esc_html__('Between', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-space-between-h',
                        ],
                    ],
                    'default' => 'start',
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-wrapper-inner' => 'justify-content:   {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'media_position',
                                'operator' => '===',
                                'value'    => 'row',
                            ],
                            [
                                'name'     => 'media_position',
                                'operator' => '===',
                                'value'    => 'row-reverse',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'vertical_position',
                [
                    'label' => esc_html__('Vertical Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-align-start-v',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-align-center-v',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-align-end-v',
                        ],
                    ],
                    'default' => 'start',
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-media-container' => 'align-items: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'media_position',
                                'operator' => '===',
                                'value'    => 'row',
                            ],
                            [
                                'name'     => 'media_position',
                                'operator' => '===',
                                'value'    => 'row-reverse',
                            ],
                        ],
                    ],
                ]
            );

            $this->add_control(
                'info_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-server',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'media_type' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'info_image',
                [
                    'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                    ],
                    'condition' => [
                        'media_type' => 'image',
                    ],
                ]
            );
        
            $this->add_control(
                'info_image_fit',
                [
                    'label' => esc_html__('Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'none' => 'None',
                        'fill' => 'Fill',
                        'contain' => 'Contain',
                        'cover' => 'Cover',
                        'scale-down' => 'Scale Down',
                    ],
                    'default' => 'fill',
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-wrapper-inner img' => 'object-fit: {{VALUE}};',
                    ],
                    'condition' => [
                        'media_type' => 'image',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Title Section
        $this->start_controls_section(
            'title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_responsive_control(
                'title_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                        '{{WRAPPER}} .pea-info-box-title' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_control(
                'title_tag',
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
                    'default' => 'h2',
                ]
            );

            $this->add_control(
                'title_text',
                [
                    'label' => esc_html__( 'Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Fast Loading Speed',
                    'placeholder' => esc_html__( 'Type info box title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
        $this->end_controls_section();
        
        // Description Section
        $this->start_controls_section(
            'description',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_description',
                [
                    'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_responsive_control(
                'description_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                        '{{WRAPPER}} .pea-info-box-description' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_description' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'description_text',
                [
                    'label' => esc_html__( 'Description Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                    'placeholder' => esc_html__( 'Type info box title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'show_description' => 'yes',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Button Section
        $this->start_controls_section(
            'button',
            [
                'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'show_button',
                [
                    'label' => esc_html__('Show Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_responsive_control(
                'button_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                        '{{WRAPPER}} .pea-info-btn-container' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                    'condition' => [
                        'show_button' => 'yes',
                    ],
                ]
            );
	
            $this->add_control(
                'button_text', [
                    'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Learn More' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
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
                    'type' => \Elementor\Controls_Manager::URL,
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
                    'type' => \Elementor\Controls_Manager::SWITCHER,
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
                    'type' => \Elementor\Controls_Manager::ICONS,
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
                    'type' => \Elementor\Controls_Manager::SELECT,
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
        
        // =====================
        // STYLE TAB
        // =====================            

		$this->start_controls_section(
			'info_box_styling',
			[
				'label' => esc_html__( 'Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'info_box_tabs' );

                $this->start_controls_tab(
                    'info_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'info_box_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-info-box-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'info_box_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-info-box-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'info_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'info_box_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-info-box-wrapper:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'info_box_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-info-box-wrapper:hover',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'info_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'info_box_border_radius',
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
                        '{{WRAPPER}} .pea-info-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'info_box_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 32,
                        'right' => 16,
                        'bottom' => 32,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'info_box_margin',
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
                        '{{WRAPPER}} .pea-info-box-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'info_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-info-box-wrapper',
                ]
            );
		$this->end_controls_section();
        
        // Icon / Image Styling Controls
        $this->start_controls_section(
            'icon_image_styling',
            [
                'label' => esc_html__('Icon / Image ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'info_icon_size',
                [
                    'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'media_type' => 'icon',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'info_image_width',
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
                        '{{WRAPPER}} .pea-info-media-wrapper img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'media_type' => 'image',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'info_image_height',
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
                        '{{WRAPPER}} .pea-info-media-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'media_type' => 'image',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'image_n_icon_tabs' );

            $this->start_controls_tab(
                'image_n_icon_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'image_n_icon_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-icon-wrapper i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea-icon-wrapper svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'media_type' => 'icon',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'image_n_icon_bg_color',
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
                        'selector'  => '{{WRAPPER}} .pea-info-media-wrapper',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'image_n_icon_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-info-media-wrapper',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'image_n_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'image_n_icon_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-icon-wrapper i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-icon-wrapper svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'media_type' => 'icon',
                        ],
                    ]
                );
            
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'image_n_icon_hover_bg_color',
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
                        'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-media-wrapper',
                    ]
                );
        
                $this->add_control(
                    'image_n_icon_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-media-wrapper' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'image_n_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'image_n_icon_border_radius_custom',
                [
                    'label' => esc_html__('Advanced Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-media-wrapper' => 'border-radius: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_n_icon_border_radius',
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
                        '{{WRAPPER}} .pea-info-media-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_n_icon_padding',
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
                        '{{WRAPPER}} .pea-info-media-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_n_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 16,
                        'bottom' => 32,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-media-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'image_n_icon_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-info-media-wrapper',
                ]
            );
        
        $this->end_controls_section();
        
        // title Styling Controls
        $this->start_controls_section(
            'title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .pea-info-box-title',
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

            $this->start_controls_tabs( 'title_tabs' );
                $this->start_controls_tab(
                    'title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-info-box-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-info-box-title',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-box-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-box-title' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Description Styling Controls
        $this->start_controls_section(
            'description_styling',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_description' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .pea-info-box-description',
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

            $this->start_controls_tabs( 'description_tabs' );
                $this->start_controls_tab(
                    'description_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'description_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .pea-info-box-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'description_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'description_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-box-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'description_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'description_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Button Styling Controls
        $this->start_controls_section(
            'button_styling', 
            [
                'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .pea-info-btn-wrapper',
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
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#399CFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-info-btn-wrapper' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-info-btn-wrapper' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_button' => 'yes',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'button_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-info-btn-wrapper',
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
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-btn-wrapper' => 'color: {{VALUE}}',
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
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-btn-wrapper' => 'background-color: {{VALUE}}',
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
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-info-btn-wrapper' => 'border-color: {{VALUE}};',
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
                    'selectors' => [
                        '{{WRAPPER}} .pea-info-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .pea-info-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .pea-info-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'type' => \Elementor\Controls_Manager::HEADING,
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
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#399CFF',
                            'selectors' => [
                                '{{WRAPPER}} .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'button_icon_size',
                        [
                            'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
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
                                '{{WRAPPER}} .pea-btn-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pea-btn-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );  
            
                    $this->add_responsive_control(
                        'button_icon_rotate',
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
                                'size' => -40,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
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
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'button_icon_hover_rotate',
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
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
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
        $title = isset($settings['title_text']) ? $settings['title_text'] : '' ;  
        $title_tag = isset($settings['title_tag']) ? $settings['title_tag'] : '' ;  
        $description = isset($settings['description_text']) ? $settings['description_text'] : '' ;
        $info_icon = isset($settings['info_icon']) ? $settings['info_icon'] : '' ; 
        $button_icon = isset($settings['button_icon']) ? $settings['button_icon'] : '' ; 
        $preset_styles = isset($settings['preset_styles']) ? $settings['preset_styles'] : '' ;
        ?>
        <div class="pea-widget-wrapper pea-info-box-wrapper <?php echo esc_attr($preset_styles); ?>" >
            <div class="pea-info-box-wrapper-inner">
                <div class="pea-info-media-container">
                    <div class="pea-info-media-wrapper">
                        <?php if($settings['media_type'] === 'icon'){ ?>    
                            <div class="pea-icon-wrapper">
                                <?php \Elementor\Icons_Manager::render_icon( $info_icon, [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                        <?php }else{ $image_url = $settings['info_image']['url']; ?> 
                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="pea-info-box-content-wrapper">
                    <<?php echo esc_attr($settings['title_tag']); ?> class="pea-info-box-title " >
                        <?php echo wp_kses_post($title); ?>
                    </<?php echo esc_attr($settings['title_tag']); ?>>
                    <?php if($settings['show_description'] === 'yes'){ ?>
                        <p class="pea-info-box-description " >
                            <?php echo wp_kses_post($description); ?>
                        </p>
                    <?php } ?>
                    <?php if($settings['show_button'] === 'yes'){ 
                        $button_text = $settings['button_text']; 
                        $button_link = $settings['button_link']['url'];
                        $button_target = $settings['button_link']['is_external'] ? ' target=_blank' : '';
                        $button_nofollow = $settings['button_link']['nofollow'] ? ' rel=nofollow' : ''; ?>
                        <div class="pea-info-button">
                            <div class="pea-info-btn-container">
                                <a class="pea-info-btn-wrapper" 
                                    href="<?php echo esc_url($button_link) ?>"
                                    <?php echo esc_attr($button_target); ?>
                                    <?php echo esc_attr($button_nofollow); ?>
                                >
                                    <?php if($settings['show_button_icon'] === 'yes' && $settings['button_icon_position'] === 'left'){ ?>
                                        <div class="pea-btn-icon-wrapper">
                                            <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($button_text)){ ?>
                                        <span >
                                            <?php echo esc_html($button_text); ?>
                                        </span>
                                    <?php } ?>
                                    <?php if($settings['show_button_icon'] === 'yes' && $settings['button_icon_position'] === 'right'){ ?>
                                        <div class="pea-btn-icon-wrapper">
                                            <?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($settings['preset_styles'] === 'preset-6'){ ?>
                        <div class="shape">
                            <svg width="111" height="111" viewBox="0 0 111 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0C19.33 0 35 15.67 35 35V41C35 60.33 50.67 76 70 76H76C95.33 76 111 91.67 111 111V0H0Z" fill="white"></path>
                            </svg>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php 
    }
}