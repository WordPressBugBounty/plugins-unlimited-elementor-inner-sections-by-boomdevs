<?php 

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\GradientTextControl;
use PrimeElementorAddons\Utils\TextStrokeControl;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class ImageGallery extends Widget_Base {
    
    public function get_name() {
        return 'pea_image_gallery';
    }
    
    public function get_title() {
        return esc_html__('Image Gallery', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_image_gallery_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--image-gallery'];
    }

	public function get_script_depends() {
		return ['prime-elementor-addons--image-gallery'];
	}
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
        $this->start_controls_section(
            'gallery_layout',
            [
                'label' => esc_html__('Gallery Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'gallery_preset',
                [
                    'label' => esc_html__('Preset Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'description' => esc_html__('When do Select this control change the design of widget and reload, save the widget values', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => 'Default',
                        'preset-1' => 'Preset 1',
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
                'layouts',
                [
                    'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'grid-layout' => 'Grid Layout',
                        'masonry-layout' => 'Mesonry Layout',
                    ],
                    'default' => 'grid-layout',
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_control(
                'image_styles',
                [
                    'label' => esc_html__('Image Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'none' => 'None',
                        'black_n_white' => 'Black & White',
                        'color_overlay' => 'Color Overlay',
                    ],
                    'default' => 'none',
                    'render_type'  => 'template',
                ]
            );
        
            $this->add_control(
                'overlay_style',
                [
                    'label' => esc_html__('Overlay Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'overlay-from-top' => 'From Top',
                        'overlay-from-bottom' => 'From Bottom',
                        'overlay-from-left' => 'From Left',
                        'overlay-from-right' => 'From Right',
                        'overlay-zoom-out' => 'Zoom Out',
                    ],
                    'default' => 'overlay-from-top',
                    'render_type'  => 'template',
                    'condition' => [
                        'image_styles' => 'color_overlay',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_columns',
                [
                    'label' => esc_html__('Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [ // You can keep 'px' key or use 'custom' — it's just a structure holder
                            'min' => 1,
                            'max' => 12,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 3, // no 'unit'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-wrapper .pea-image-gallery-items' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'grid_height',
                [
                    'label' => esc_html__('Grid Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 300,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-gallery-wrapper .pea-image-gallery-items' => 'grid-auto-rows: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'image_gap',
                [
                    'label' => esc_html__('Image Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 300,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-gallery-wrapper .pea-image-gallery-items' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
        $this->end_controls_section();
        
        
        $this->start_controls_section(
            'image_gallery_section',
            [
                'label' => esc_html__( 'Image Gallery Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'gallery_image',
                [
                    'label'   => esc_html__( 'Gallery Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                    ],
                ]
            );

            $repeater->add_control(
                'gallery_image_name',
                [
                    'label'       => esc_html__( 'Image Name', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Image 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'placeholder' => esc_html__( 'Enter image name', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

            $repeater->add_responsive_control(
                'gallery_image_column_span',
                [
                    'label' => esc_html__('Column Span — only for Masonry', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'unset' => esc_html__('1 Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'span 2' => esc_html__('2 Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'span 3' => esc_html__('3 Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ],
                    'default' => 'unset',
                    'selectors' => [
                        '{{WRAPPER}} .masonry {{CURRENT_ITEM}}' => 'grid-column: {{VALUE}};',
                    ],
                ]
            );

            $repeater->add_responsive_control(
                'gallery_image_row_span',
                [
                    'label' => esc_html__('Column Span — only for Masonry', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'unset' => esc_html__('1 Rows', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'span 2' => esc_html__('2 Rows', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'span 3' => esc_html__('3 Rows', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'span 4' => esc_html__('4 Rows', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ],
                    'default' => 'unset',
                    'selectors' => [
                        '{{WRAPPER}} .masonry {{CURRENT_ITEM}}' => 'grid-row: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'gallery_items',
                [
                    'label'       => esc_html__( 'Gallery Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'gallery_image_name'   => 'Image 1',
                            'gallery_image' => [
                                'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                            ],
                        ],
                        [
                            'gallery_image_name'   => 'Image 2',
                            'gallery_image' => [
                                'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                            ],
                        ],
                        [
                            'gallery_image_name'   => 'Image 3',
                            'gallery_image' => [
                                'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                            ],
                        ],
                    ],
                    'title_field' => '{{ gallery_image_name }}',
                ]
            );

        $this->end_controls_section();

        // Lightbox Icon Section
        $this->start_controls_section(
            'lightbox_icon_section',
            [
                'label' => esc_html__('Lightbox Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'lightbox_icon_enable',
                [
                    'label' => esc_html__('Enable Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'lightbox_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-plus',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'lightbox_icon_enable' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        // Lightbox Icon Section
        $this->start_controls_section(
            'gallery_button_section',
            [
                'label' => esc_html__('Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'gallery_button_enable',
                [
                    'label' => esc_html__('Enable Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'gallery_button_text',
                [
                    'label'       => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => esc_html__( 'See More', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'placeholder' => esc_html__( 'Enter image name', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'gallery_button_enable' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'gallery_button_link',
                [
                    'label' => esc_html__( 'Button Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'condition' => [
                        'gallery_button_enable' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Image Styling Controls
        $this->start_controls_section(
            'image_styling',
            [
                'label' => esc_html__('Image Setting', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'image_alignment',
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
                    'selectors_dictionary' => [
                        'start'   => 'left: 0;',
                        'center'  => 'left: 50%;transform: translateX(-50%);',
                        'end'     => 'right: 0;left: unset;',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-image' => '{{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'image_width',
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
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-gallery-image' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'image_height',
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
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-gallery-image' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
            $this->add_control(
                'image_object_fit_cover',
                [
                    'label' => esc_html__('Object Fit Cover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->start_controls_tabs( 'image_tabs' );

            $this->start_controls_tab(
                'image_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'image_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-image-gallery-item',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'image_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'image_border_hover_color',
                    [
                        'label' => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-image-gallery-item:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'image_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'image_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Lightbox Styling Controls
        $this->start_controls_section(
            'overlay_styling',
            [
                'label' => esc_html__('Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'image_styles' => 'color_overlay',
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'overlay_color',
                    'types'          => [ 'classic', 'gradient' ],
                    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                    'exclude'        => [ 'image' ],
                    'fields_options' => [
                        'background' => [
                            'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'default' => 'classic',
                        ],
                    ],
                    'selector'  => '{{WRAPPER}} .pea-image-overlay',
                ]
            );
        
        $this->end_controls_section();
        
        // Lightbox Styling Controls
        $this->start_controls_section(
            'lightbox_styling',
            [
                'label' => esc_html__('Lightbox', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lightbox_icon_enable' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'lightbox_icon_size',
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-lightbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-lightbox-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->add_responsive_control(
                'lightbox_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-lightbox-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'lightbox_tabs' );

            $this->start_controls_tab(
                'lightbox_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'lightbox_icon_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-lightbox-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea-lightbox-icon svg' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'lightbox_icon_bg_color',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-lightbox-icon-wrapper',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'lightbox_icon_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-lightbox-icon-wrapper',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'lightbox_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'lightbox_icon_hover_color',
                    [
                        'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-lightbox-icon-wrapper:hover i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea-lightbox-icon-wrapper:hover svg' => 'fill: {{VALUE}};',
                        ],
                    ]
                );
            
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'lightbox_icon_hover_bg_color',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-lightbox-icon-wrapper:hover',
                    ]
                );
        
                $this->add_control(
                    'lightbox_icon_hover_border_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-lightbox-icon-wrapper:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'lightbox_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'lightbox_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-lightbox-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        
        $this->end_controls_section();

		// Button Styling Controls
		$this->start_controls_section(
			'image_gallery_button_styling',
			[
				'label' => __('Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,  
                'condition' => [
                    'gallery_button_enable' => 'yes',
                ],
			]
		);
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'image_gallery_button_typography',
                    'selector' => '{{WRAPPER}} .pea-image-gallery-btn',
                ]
            );
		
            $this->start_controls_tabs( 'image_gallery_button_tabs' );

            $this->start_controls_tab(
                'image_gallery_button_normal_style',
                [
                    'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
            
            $this->add_control(
                'image_gallery_button_color',
                [
                    'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'image_gallery_button_bg_color',
                [
                    'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'image_gallery_button_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-image-gallery-btn',
                    ]
                );
            
            $this->end_controls_tab();

            $this->start_controls_tab(
                'image_gallery_button_hover_style',
                [
                    'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );

            $this->add_control(
                'image_gallery_button_hover_color',
                [
                    'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'image_gallery_button_hover_bg_color',
                [
                    'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'image_gallery_button_hover_border_color',
                [
                    'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();
            $this->end_controls_tabs(); 

            $this->add_control(
                'image_gallery_button_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'image_gallery_button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_gallery_button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_gallery_button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-gallery-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'image_gallery_button_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-image-gallery-btn',
                ]
            );
		$this->end_controls_section();
    }
    
    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['gallery_items'] ) ) {
            return;
        }
        $layoutClass = $settings['layouts'] === 'masonry-layout' ? 'masonry' : 'grid';
        $image_style = $settings['image_styles'] == 'none' ? '' : $settings['image_styles'];
        $overlay_position = '';
        if($image_style == 'color_overlay'){
            $overlay_position = $settings['overlay_style'];
        } ?>
        <div class="pea-widget-wrapper pea-image-gallery-wrapper <?php echo esc_attr($layoutClass); ?>">
            <div class="pea-image-gallery-items <?php echo esc_attr($image_style); ?>  <?php echo esc_attr($overlay_position); ?>">
                <?php foreach ( $settings['gallery_items'] as $item ) : 
                    if ( empty( $item['gallery_image']['url'] ) ) continue;
                ?>
                    <a href="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" class="pea-image-gallery-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?> " >
                        <img class="pea-image-gallery-image" src="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['gallery_image_name'] ); ?>" />
                        <?php if ( $image_style === 'color_overlay' ) :  ?>
                            <span class="pea-image-overlay"></span>
                        <?php endif; ?>
                        <?php if ( $settings['lightbox_icon_enable'] === 'yes' ) : ?>
                            <div class="pea-lightbox-icon-wrapper">
                                <div class="pea-lightbox-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['lightbox_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if ( $settings['gallery_button_enable'] === 'yes' && !empty($settings['gallery_button_text']) ) : ?>
                <div class="pea-image-gallery-btn-wrapper">
                    <a href="<?php echo esc_url( $settings['gallery_button_link']['url'] ); ?>" 
                    class="pea-image-gallery-btn">
                        <?php echo esc_html( $settings['gallery_button_text'] ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php }
}