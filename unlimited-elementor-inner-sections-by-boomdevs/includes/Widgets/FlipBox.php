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

class FlipBox extends Widget_Base {
    
    public function get_name() {
        return 'pea_flip_box';
    }
    
    public function get_title() {
        return esc_html__('Flip Box', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_flip_box_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--flip-box'];
    }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Flip Box Section
        $this->start_controls_section(
            'flip_box_section',
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
                        'preset-5' => 'Preset 5',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_control(
                'mode_for_check',
                [
                    'label' => esc_html__('Mode for check', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'front' => 'Front',
                        'back' => 'Back',
                    ],
                    'default' => 'front',
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_control(
                'animation_effect',
                [
                    'label' => esc_html__('Animation Effect', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'flip-left' => 'Flip Left',
                        'flip-right' => 'Flip Right',
                        'flip-up' => 'Flip Up',
                        'flip-down' => 'Flip Down',
                        'zoom-in' => 'Zoom in',
                        'zoom-out' => 'Zoom out',
                        'fade' => 'Fade',
                        
                    ],
                    'default' => 'flip-left',
                    'render_type'  => 'template',
                ]
            );
        
        $this->end_controls_section();
        
        // Icon / Image Section
        $this->start_controls_section(
            'flip_box_icon_image',
            [
                'label' => esc_html__('Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->start_controls_tabs( 'media_content_tabs' );
                $this->start_controls_tab(
                    'front_media_tab',
                    [
                        'label' => __( 'Front', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_responsive_control(
                        'front_media_alignment',
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
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-front .pea-flip-media-container' => 'justify-content: {{VALUE}};',
                            ],
                            'render_type'  => 'template',
                        ]
                    );
                
                    $this->add_control(
                        'front_media_type',
                        [
                            'label' => esc_html__('Media Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                'none' => 'None',
                                'icon' => 'Icon',
                                'image' => 'Image',
                            ],
                            'default' => 'icon',
                        ]
                    );

                    $this->add_control(
                        'front_media_icon',
                        [
                            'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-bolt',
                                'library' => 'fa-solid',
                            ],
                            'condition' => [
                                'front_media_type' => 'icon',
                            ],
                        ]
                    );

                    $this->add_control(
                        'front_media_image',
                        [
                            'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'    => Controls_Manager::MEDIA,
                            'default' => [
                                'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                            ],
                            'condition' => [
                                'front_media_type' => 'image',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'front_media_image_fit',
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
                                '{{WRAPPER}} .pea-info-box-wrapper-inner img' => 'object-fit: {{VALUE}};',
                            ],
                            'condition' => [
                                'front_media_type' => 'image',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'back_media_tab',
                    [
                        'label' => __( 'Back', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_responsive_control(
                        'back_media_alignment',
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
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-container' => 'justify-content: {{VALUE}};',
                            ],
                            'render_type'  => 'template',
                        ]
                    );
                
                    $this->add_control(
                        'back_media_type',
                        [
                            'label' => esc_html__('Media Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                'none' => 'None',
                                'icon' => 'Icon',
                                'image' => 'Image',
                            ],
                            'default' => 'icon',
                        ]
                    );

                    $this->add_control(
                        'back_media_icon',
                        [
                            'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-swatchbook',
                                'library' => 'fa-solid',
                            ],
                            'condition' => [
                                'back_media_type' => 'icon',
                            ],
                        ]
                    );

                    $this->add_control(
                        'back_media_image',
                        [
                            'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'    => Controls_Manager::MEDIA,
                            'default' => [
                                'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                            ],
                            'condition' => [
                                'back_media_type' => 'image',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'back_media_image_fit',
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
                                '{{WRAPPER}} .pea-info-box-wrapper-inner img' => 'object-fit: {{VALUE}};',
                            ],
                            'condition' => [
                                'back_media_type' => 'image',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        // Title Section
        $this->start_controls_section(
            'flip_box_title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->start_controls_tabs( 'title_content_tabs' );
                $this->start_controls_tab(
                    'front_title_tab',
                    [
                        'label' => __( 'Front', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'front_title_show',
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
                        'front_title_alignment',
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
                                '{{WRAPPER}} .pea-flipbox-front .pea-heading-text' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'center',
                            'render_type'  => 'template',
                            'condition' => [
                                'front_title_show' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'front_title_tag',
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
                                'front_title_show' => 'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'front_title_text',
                        [
                            'label' => esc_html__( 'Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXTAREA,
                            'rows' => 10,
                            'default' => 'Web Design',
                            'placeholder' => esc_html__( 'Flip Heading', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'condition' => [
                                'front_title_show' => 'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'back_title_tab',
                    [
                        'label' => __( 'Back', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'back_title_show',
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
                        'back_title_alignment',
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
                                '{{WRAPPER}} .pea-flipbox-back .pea-heading-text' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'center',
                            'render_type'  => 'template',
                            'condition' => [
                                'back_title_show' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'back_title_tag',
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
                                'back_title_show' => 'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'back_title_text',
                        [
                            'label' => esc_html__( 'Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXTAREA,
                            'rows' => 10,
                            'default' => 'Branding',
                            'placeholder' => esc_html__( 'Type info box title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'condition' => [
                                'back_title_show' => 'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        
        // Description Section
        $this->start_controls_section(
            'flip_box_desc',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->start_controls_tabs( 'desc_content_tabs' );
                $this->start_controls_tab(
                    'front_desc_tab',
                    [
                        'label' => __( 'Front', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'front_desc_show',
                        [
                            'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'return_value' => 'yes',
                            'default' => 'no',
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'front_desc_alignment',
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
                                '{{WRAPPER}} .pea-flipbox-front .pea-description' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'center',
                            'render_type'  => 'template',
                            'condition' => [
                                'front_desc_show' => 'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'front_desc_text',
                        [
                            'label' => esc_html__( 'Description Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXTAREA,
                            'rows' => 10,
                            'default' => 'Corrupti non maiores atque. Repellendus ratione omnis numquam minima ut harum eaque.',
                            'placeholder' => esc_html__( 'Type info box title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'condition' => [
                                'front_desc_show' => 'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'back_desc_tab',
                    [
                        'label' => __( 'Back', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'back_desc_show',
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
                        'back_desc_alignment',
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
                                '{{WRAPPER}} .pea-flipbox-back .pea-description' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'center',
                            'render_type'  => 'template',
                            'condition' => [
                                'back_desc_show' => 'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'back_desc_text',
                        [
                            'label' => esc_html__( 'Description Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXTAREA,
                            'rows' => 10,
                            'default' => 'Corrupti non maiores atque. Repellendus ratione omnis numquam minima ut harum eaque.',
                            'placeholder' => esc_html__( 'Type info box title here', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'condition' => [
                                'back_desc_show' => 'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        
        // Button Section
        $this->start_controls_section(
            'flip_box_button',
            [
                'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->start_controls_tabs( 'button_content_tabs' );
                $this->start_controls_tab(
                    'front_button_tab',
                    [
                        'label' => __( 'Front', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'front_button_show',
                        [
                            'label' => esc_html__('Show Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'return_value' => 'yes',
                            'default' => 'no',
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'front_button_alignment',
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
                                '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-container' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'center',
                            'render_type'  => 'template',
                            'condition' => [
                                'front_button_show' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'front_button_text', [
                            'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Read More' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_block' => true,
                            'condition' => [
                                'front_button_show' => 'yes',
                            ],
                        ]
                    );
                    $this->add_control(
                        'front_button_link',
                        [
                            'label' => esc_html__( 'Button Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::URL,
                            'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'show_external' => true,
                            'condition' => [
                                'front_button_show' => 'yes',
                            ],
                        ]
                    );
                    
                    $this->add_control(
                        'front_button_icon_show',
                        [
                            'label' => esc_html__('Show Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'front_button_show' => 'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'front_button_icon',
                        [
                            'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-arrow-right',
                                'library' => 'fa-solid',
                            ],
                            'condition' => [
                                'front_button_icon_show' => 'yes',
                                'front_button_show' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'front_button_icon_position',
                        [
                            'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                'right' => 'Right',
                                'left' => 'Left',
                            ],
                            'default' => 'right',
                            'condition' => [
                                'front_button_icon_show' => 'yes',
                                'front_button_show' => 'yes',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'back_button_tab',
                    [
                        'label' => __( 'Back', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'back_button_show',
                        [
                            'label' => esc_html__('Show Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'return_value' => 'yes',
                            'default' => 'yes',
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'back_button_alignment',
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
                                '{{WRAPPER}}  .pea-flipbox-back .pea-flip-btn-container' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'center',
                            'render_type'  => 'template',
                            'condition' => [
                                'back_button_show' => 'yes',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'back_button_text', [
                            'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Read More' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_block' => true,
                            'condition' => [
                                'back_button_show' => 'yes',
                            ],
                        ]
                    );
                    $this->add_control(
                        'back_button_link',
                        [
                            'label' => esc_html__( 'Button Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::URL,
                            'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'show_external' => true,
                            'condition' => [
                                'back_button_show' => 'yes',
                            ],
                        ]
                    );
                    
                    $this->add_control(
                        'back_button_icon_show',
                        [
                            'label' => esc_html__('Show Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'back_button_show' => 'yes',
                            ],
                        ]
                    );

                    $this->add_control(
                        'back_button_icon',
                        [
                            'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-arrow-right',
                                'library' => 'fa-solid',
                            ],
                            'condition' => [
                                'back_button_icon_show' => 'yes',
                                'back_button_show' => 'yes',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'back_button_icon_position',
                        [
                            'label' => esc_html__('Icon Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                'right' => 'Right',
                                'left' => 'Left',
                            ],
                            'default' => 'right',
                            'condition' => [
                                'back_button_icon_show' => 'yes',
                                'back_button_show' => 'yes',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================   
		$this->start_controls_section(
			'flip_boxs_styling',
			[
				'label' => esc_html__( 'Boxes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	        
            $this->add_responsive_control(
                'boxes_width',
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
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-flipbox-back' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            $this->add_responsive_control(
                'boxes_height',
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
                        'unit' => 'px',
                        'size' => 366,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front' => 'min-height: {{SIZE}}{{UNIT}}; height: auto;',
                        '{{WRAPPER}} .pea-flipbox-back' => 'min-height: {{SIZE}}{{UNIT}}; height: auto;',
                    ],
                ]
            );     

		$this->end_controls_section();

        // Front Box Styling Controls
		$this->start_controls_section(
			'front_box_styling',
			[
				'label' => esc_html__( 'Front Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            $this->start_controls_tabs( 'front_box_tabs' );
                $this->start_controls_tab(
                    'front_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                $this->add_control(
                    'front_box_bg_type_popover_toggle',
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
                            'name'      => 'front_box_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#FEEBD5', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-flipbox-front',
                        ]
                    );
                $this->end_popover();
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'front_box_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-flipbox-front',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'front_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'front_box_hover_bg_type_popover_toggle',
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
                                'name'      => 'front_box_hover_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front',
                            ]
                        );
                    $this->end_popover();

                
                    $this->add_control(
                        'front_box_hover_border_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'front_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'front_box_border_radius',
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
                        '{{WRAPPER}} .pea-flipbox-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'front_box_padding',
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
                        '{{WRAPPER}} .pea-flipbox-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_box_margin',
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
                        '{{WRAPPER}} .pea-flipbox-front' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'front_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-flipbox-front',
                ]
            );    

		$this->end_controls_section();
        
        // Front Box Icon / Image Styling Controls
        $this->start_controls_section(
            'front_media_styling',
            [
                'label' => esc_html__('Front Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'front_media_type!' => 'none',
                ],
            ]
        );  
            $this->add_responsive_control(
                'front_media_icon_size',
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
                        'size' => 26,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-flipbox-front .pea-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_media_type' => 'icon',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'front_media_image_width',
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-media-wrapper img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_media_type' => 'image',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'front_media_image_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-media-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_media_type' => 'image',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'front_media_tabs' );
                $this->start_controls_tab(
                    'front_media_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'front_media_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FEEBD5',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-front .pea-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipbox-front .pea-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'front_media_type' => 'icon',
                            ],
                        ]
                    );
                    $this->add_control(
                        'front_media_bg_type_popover_toggle',
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
                                'name'      => 'front_media_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '#F89B2E', // ✅ Set your default normal color here
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-flipbox-front .pea-flip-media-wrapper',
                            ]
                        );
                    $this->end_popover();
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'front_media_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-flipbox-front .pea-flip-media-wrapper',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'front_media_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                    $this->add_control(
                        'front_media_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'front_media_type' => 'icon',
                            ],
                        ]
                    );

                    $this->add_control(
                        'front_media_hover_bg_type_popover_toggle',
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
                                'name'      => 'front_media_hover_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-flip-media-wrapper',
                            ]
                        );
                    $this->end_popover();
                    $this->add_control(
                        'front_media_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-flip-media-wrapper' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();   

            $this->add_control(
                'front_media_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            ); 

            $this->add_responsive_control(
                'front_media_border_radius',
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
                        '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-media-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_media_padding',
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
                        '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-media-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_media_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 32,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-media-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'front_media_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-media-wrapper',
                ]
            );
        
        $this->end_controls_section();
        
        // Front Box title Styling Controls
        $this->start_controls_section(
            'front_title_styling',
            [
                'label' => esc_html__('Front Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'front_title_show' => 'yes',
                ],
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'front_title_typography',
                    'selector' => '{{WRAPPER}} .pea-flipbox-front .pea-heading-text',
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
                                'size' => 32,
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

            $this->start_controls_tabs( 'front_title_tabs' );
                $this->start_controls_tab(
                    'front_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'front_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-front .pea-heading-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'front_title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-flipbox-front .pea-heading-text',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'front_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'front_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-heading-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'front_title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-heading-text' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'front_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'front_title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-heading-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-heading-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'front_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-heading-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Front Box Description Styling Controls
        $this->start_controls_section(
            'front_desc_styling',
            [
                'label' => esc_html__('Front Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'front_desc_show' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'front_desc_typography',
                    'selector' => '{{WRAPPER}} .pea-description',
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

            $this->start_controls_tabs( 'front_desc_tabs' );
                $this->start_controls_tab(
                    'front_desc_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'front_desc_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-front .pea-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'front_desc_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'front_desc_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'front_desc_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'front_desc_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_desc_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Front Box Button Styling Controls
        $this->start_controls_section(
            'front_button_styling', 
            [
                'label' => esc_html__('Front Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'front_button_show' => 'yes',
                ],
               
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'front_button_typography',
                    'selector' => '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper',
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

            $this->start_controls_tabs( 'front_button_tabs' );
                $this->start_controls_tab(
                    'front_button_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'front_button_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}}  .pea-flipbox-front .pea-flip-btn-wrapper' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'front_button_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}  .pea-flipbox-front .pea-flip-btn-wrapper' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'front_button_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}}  .pea-flipbox-front .pea-flip-btn-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'front_button_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'front_button_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-btn-wrapper:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'front_button_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-btn-wrapper:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'front_button_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-front .pea-flip-btn-wrapper:hover' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'front_button_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'front_button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 15,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'front_button_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'front_button_icon_title',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            
            $this->add_responsive_control(
                'front_button_icon_size',
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
                        'size' => 13,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper .pea-btn-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper .pea-btn-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'front_button_icon_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'front_button_icon_tabs' );
                $this->start_controls_tab(
                    'front_button_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'front_button_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'front_button_icon_rotate',
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
                                '{{WRAPPER}} .pea-flipbox-front .pea-flip-btn-wrapper .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'front_button_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'front_button_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'front_button_icon_hover_rotate',
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
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-front .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
        $this->end_controls_section();
        
        // Back Box Styling Controls
		$this->start_controls_section(
			'back_box_styling',
			[
				'label' => esc_html__( 'Back Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            $this->start_controls_tabs( 'back_box_tabs' );
                $this->start_controls_tab(
                    'back_box_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                $this->add_control(
                    'back_box_bg_type_popover_toggle',
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
                            'name'      => 'back_box_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#F89B2E', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-flipbox-back',
                        ]
                    );
                $this->end_popover();
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'back_box_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-flipbox-back',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'back_box_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'back_box_hover_bg_type_popover_toggle',
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
                                'name'      => 'back_box_hover_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back',
                            ]
                        );
                    $this->end_popover();
                
                    $this->add_control(
                        'back_box_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'back_box_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'back_box_border_radius',
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
                        '{{WRAPPER}} .pea-flipbox-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'back_box_padding',
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
                        '{{WRAPPER}} .pea-flipbox-back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_box_margin',
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
                        '{{WRAPPER}} .pea-flipbox-back' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'back_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-flipbox-back',
                ]
            );
		$this->end_controls_section();
        
        // Back Box Icon / Image Styling Controls
        $this->start_controls_section(
            'back_media_styling',
            [
                'label' => esc_html__('Back Icon / Image ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'back_media_type!' => 'none',
                ],
            ]
        );
            $this->add_responsive_control(
                'back_media_icon_size',
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
                        'size' => 30,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-flipbox-back .pea-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_media_type' => 'icon',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'back_media_image_width',
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_media_type' => 'image',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'back_media_image_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_media_type' => 'image',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'back_media_tabs' );
                $this->start_controls_tab(
                    'back_media_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'back_media_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#F89B2E',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-back .pea-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipbox-back .pea-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'back_media_type' => 'icon',
                            ],
                        ]
                    );
                    $this->add_control(
                        'back_media_bg_type_popover_toggle',
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
                                'name'      => 'back_media_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '', // ✅ Set your default normal color here
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper',
                            ]
                        );
                    $this->end_popover();
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'back_media_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'back_media_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                    $this->add_control(
                        'back_media_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => [
                                'back_media_type' => 'icon',
                            ],
                        ]
                    );

                    $this->add_control(
                        'back_media_hover_bg_type_popover_toggle',
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
                                'name'      => 'back_media_hover_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-flip-back-media-wrapper',
                            ]
                        );
                    $this->end_popover();
                    $this->add_control(
                        'back_media_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-flip-back-media-wrapper' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();   

            $this->add_control(
                'back_media_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            ); 

            $this->add_responsive_control(
                'back_media_border_radius',
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
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_media_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 23,
                        'right' => 23,
                        'bottom' => 23,
                        'left' => 23,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_media_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 16,
                        'bottom' => 0,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'back_media_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-media-wrapper',
                ]
            );
        
        $this->end_controls_section();
        
        // Back Box title Styling Controls
        $this->start_controls_section(
            'back_title_styling',
            [
                'label' => esc_html__('Back Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'back_title_show' => 'yes',
                ],
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'back_title_typography',
                    'selector' => '{{WRAPPER}} .pea-flipbox-back .pea-heading-text',
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
                                'size' => 32,
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

            $this->start_controls_tabs( 'back_title_tabs' );
                $this->start_controls_tab(
                    'back_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'back_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-back .pea-heading-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'back_title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-flipbox-back .pea-heading-text',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'back_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'back_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-heading-text' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'back_title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-heading-text' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'back_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'back_title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-heading-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-heading-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'back_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-heading-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Back Box Description Styling Controls
        $this->start_controls_section(
            'back_desc_styling',
            [
                'label' => esc_html__('Back Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'back_desc_show' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'back_desc_typography',
                    'selector' => '{{WRAPPER}}  .pea-flipbox-back .pea-description',
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

            $this->start_controls_tabs( 'back_desc_tabs' );
                $this->start_controls_tab(
                    'back_desc_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'back_desc_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}}  .pea-flipbox-back .pea-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'back_desc_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'back_desc_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover  .pea-flipbox-back .pea-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'back_desc_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'back_desc_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}}  .pea-flipbox-back .pea-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_desc_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}}  .pea-flipbox-back .pea-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Back Box Button Styling Controls
        $this->start_controls_section(
            'back_button_styling', 
            [
                'label' => esc_html__('Back Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'back_button_show' => 'yes',
                ],
            ]
        );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'back_button_typography',
                    'selector' => '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper',
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

            $this->start_controls_tabs( 'back_button_tabs' );
                $this->start_controls_tab(
                    'back_button_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'back_button_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'back_button_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'back_button_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'back_button_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'back_button_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-back .pea-flip-back-btn-wrapper:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'back_button_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-back .pea-flip-back-btn-wrapper:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'back_button_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper .pea-flipbox-back .pea-flip-back-btn-wrapper:hover' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'back_button_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'back_button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'back_button_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'back_button_icon_title',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            
            $this->add_responsive_control(
                'back_button_icon_size',
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
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper .pea-btn-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper .pea-btn-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'back_button_icon_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'back_button_icon_tabs' );
                $this->start_controls_tab(
                    'back_button_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'back_button_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'back_button_icon_rotate',
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
                                '{{WRAPPER}} .pea-flipbox-back .pea-flip-back-btn-wrapper .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'back_button_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'back_button_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-btn-icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-btn-icon-wrapper svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'back_button_icon_hover_rotate',
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
                                'size' => -40,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .pea-flipper-wrapper:hover .pea-flipbox-back .pea-btn-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
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
        $animation_effect = isset($settings['animation_effect']) ? $settings['animation_effect'] : '' ;
        // Front Box
        $front_media_type   = isset($settings['front_media_type'])  ? $settings['front_media_type'] : '' ; 
        $front_title_show   = isset($settings['front_title_show'])  ? $settings['front_title_show'] : '' ; 
        $front_desc_show    = isset($settings['front_desc_show'])   ? $settings['front_desc_show'] : '' ;  
        $front_button       = isset($settings['front_button_show']) ? $settings['front_button_show'] : '' ;
        // Back Box
        $back_media_type    = isset($settings['back_media_type'])   ? $settings['back_media_type'] : '' ; 
        $back_title_show    = isset($settings['back_title_show'])   ? $settings['back_title_show'] : '' ; 
        $back_desc_show     = isset($settings['back_desc_show'])    ? $settings['back_desc_show'] : '' ;  
        $back_button        = isset($settings['back_button_show'])  ? $settings['back_button_show'] : '' ;

        $is_editor = '';
        $is_front_active = '';
        $is_back_active = '';
        $show_back_class = '';
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $is_editor = 'pea-editor-mode';
            $is_front_active = $settings['mode_for_check'] == 'front' ? 'pea-active-side' : 'pea-inactive-side';
            $is_back_active = $settings['mode_for_check'] == 'back' ? 'pea-active-side' : 'pea-inactive-side';
        
            // Add class when back is selected
            $show_back_class = $settings['mode_for_check'] === 'back' ? 'pea-show-back' : '';
        }
        
        ?>
            <div class="pea-widget-wrapper pea-flip-box-wrapper pea-flip-box-67659383 <?php echo esc_attr($preset_styles); ?>" >
                <div class="pea-flipper-wrapper <?php echo esc_attr($animation_effect); ?> <?php echo esc_attr($is_editor); ?> <?php echo esc_attr($show_back_class); ?>">
                    <div class="pea-flipbox-front <?php echo esc_attr($is_front_active); ?>">
                        <div class="pea-flipbox-content-wrapper">
                            <?php if($front_media_type !== 'none'){ ?>
                                <div class="pea-flip-media-container">
                                    <div class="pea-flip-media-wrapper">
                                        <?php if($front_media_type === 'icon'){ $front_media_icon = isset($settings['front_media_icon']) ? $settings['front_media_icon'] : '' ;  ?>
                                            <div class="pea-icon-wrapper">
                                                <?php \Elementor\Icons_Manager::render_icon( $front_media_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php }elseif($front_media_type === 'image'){ $image_url = $settings['front_media_image']['url']; ?> 
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($front_title) ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($front_title_show === 'yes' || $front_desc_show === 'yes' || $front_button === 'yes'){ ?>
                                <div class="pea-flip-box-content-wrapper">
                                    <?php if($front_title_show === 'yes'){  
                                        $front_title        = isset($settings['front_title_text']) ? $settings['front_title_text'] : '' ;  
                                        $front_title_tag    = isset($settings['front_title_tag']) ? $settings['front_title_tag'] : '' ;  ?>
                                        <<?php echo esc_attr($front_title_tag); ?> class="pea-heading-text"><?php echo esc_html($front_title); ?></<?php echo esc_attr($front_title_tag); ?>>
                                    <?php } ?>
                                    <?php if($front_desc_show === 'yes'){ 
                                        $front_desc         = isset($settings['front_desc_text']) ? $settings['front_desc_text'] : '' ;?>
                                        <p class="pea-description">
                                            <?php echo esc_html($front_desc); ?>
                                        </p>
                                    <?php } ?>
                                    <?php if($front_button === 'yes'){  
                                        $front_button_text = isset($settings['front_button_text']) ? $settings['front_button_text'] : '' ;
                                        $front_button_icon_show = isset($settings['front_button_icon_show']) ? $settings['front_button_icon_show'] : '' ; ?>
                                        <div class="pea-flip-button">
                                            <div class="pea-flip-btn-container">
                                                <a class="pea-flip-btn-wrapper" href="#">
                                                    <?php if($front_button_icon_show === 'yes' && $settings['front_button_icon_position'] === 'left'){ $front_button_icon = isset($settings['front_button_icon']) ? $settings['front_button_icon'] : '' ; ?>
                                                        <div class="pea-btn-icon-wrapper">
                                                            <?php \Elementor\Icons_Manager::render_icon( $front_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    <?php } ?>
                                                    <span><?php echo esc_html($front_button_text); ?></span>
                                                    <?php if($front_button_icon_show === 'yes' && $settings['front_button_icon_position'] === 'right'){ $front_button_icon = isset($settings['front_button_icon']) ? $settings['front_button_icon'] : '' ; ?>
                                                        <div class="pea-btn-icon-wrapper">
                                                            <?php \Elementor\Icons_Manager::render_icon( $front_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    <?php } ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pea-flipbox-back <?php echo esc_attr($is_back_active); ?>">
                        <div class="pea-flipbox-content-wrapper">
                            <?php if($back_media_type !== 'none'){ ?>
                                <div class="pea-flip-back-media-container">
                                    <div class="pea-flip-back-media-wrapper">
                                        <?php if($back_media_type === 'icon'){ $back_media_icon = isset($settings['back_media_icon']) ? $settings['back_media_icon'] : '' ;  ?>
                                            <div class="pea-icon-wrapper">
                                                <?php \Elementor\Icons_Manager::render_icon( $back_media_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php }elseif($back_media_type === 'image'){ $back_image_url = $settings['back_media_image']['url']; ?> 
                                            <img src="<?php echo esc_url($back_image_url) ?>" alt="<?php echo esc_attr($back_title) ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($back_title_show === 'yes' || $back_desc_show === 'yes' || $back_button === 'yes'){ ?>
                                <div class="pea-flip-back-box-content-wrapper">
                                    <?php if($back_title_show === 'yes'){ 
                                        $back_title         = isset($settings['back_title_text']) ? $settings['back_title_text'] : '' ;  
                                        $back_title_tag     = isset($settings['back_title_tag']) ? $settings['back_title_tag'] : '' ;  ?>
                                        <<?php echo esc_attr($back_title_tag); ?> class="pea-heading-text"><?php echo esc_html($back_title); ?></<?php echo esc_attr($back_title_tag); ?>>
                                    <?php } ?>
                                    <?php if($back_desc_show === 'yes'){ 
                                        $back_desc          = isset($settings['back_desc_text']) ? $settings['back_desc_text'] : '' ;?>
                                        <p class="pea-description">
                                            <?php echo esc_html($back_desc); ?>
                                        </p>
                                    <?php } ?>
                                    <?php if($back_button === 'yes'){  
                                        $back_button_text = isset($settings['back_button_text']) ? $settings['back_button_text'] : '' ;
                                        $back_button_icon_show = isset($settings['back_button_icon_show']) ? $settings['back_button_icon_show'] : '' ; ?>
                                        <div class="pea-flip-back-button">
                                            <div class="pea-flip-back-btn-container">
                                                <a class="pea-flip-back-btn-wrapper" href="#">
                                                    <?php if($back_button_icon_show === 'yes' && $settings['back_button_icon_position'] === 'left'){ $back_button_icon = isset($settings['back_button_icon']) ? $settings['back_button_icon'] : '' ; ?>
                                                        <div class="pea-btn-icon-wrapper">
                                                            <?php \Elementor\Icons_Manager::render_icon( $back_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    <?php } ?>
                                                    <span><?php echo esc_html($back_button_text); ?></span>
                                                    <?php if($back_button_icon_show === 'yes' && $settings['back_button_icon_position'] === 'right'){ $back_button_icon = isset($settings['back_button_icon']) ? $settings['back_button_icon'] : '' ; ?>
                                                        <div class="pea-btn-icon-wrapper">
                                                            <?php \Elementor\Icons_Manager::render_icon( $back_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
                                                        </div>
                                                    <?php } ?>
                                                </a>
                                            </div>
                                        </div>
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