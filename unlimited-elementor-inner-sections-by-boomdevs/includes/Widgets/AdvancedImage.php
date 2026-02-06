<?php 

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\GradientTextControl;
use PrimeElementorAddons\Utils\TextStrokeControl;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AdvancedImage extends Widget_Base {
    
    public function get_name() {
        return 'pea_advanced_image';
    }
    
    public function get_title() {
        return esc_html__('Advanced Image', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_advanced_image_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--advanced-image'];
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
                'image',
                [
                    'label' => __( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::MEDIA,
                ]
            );
        
            $this->add_control(
                'image_styles',
                [
                    'label' => esc_html__('Preset Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => 'Default',
                        'octogon' => 'Preset 1',
                        'rhombus' => 'Preset 2',
                        'hexagon' => 'Preset 3',
                        'bevel' => 'Preset 4',
                        'photo-collage' => 'Preset 5',
                        'irregular-blob' => 'Preset 6',
                        'flower' => 'Preset 7',
                        'organic-blob' => 'Preset 8',
                        'teardrop' => 'Preset 9',
                        'triangle-blob' => 'Preset 10',
                        'wavy-stripes' => 'Preset 11',
                        'token' => 'Preset 12',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_control(
                'show_overlay',
                [
                    'label' => esc_html__('Show Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
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
                    'default' => 'no',
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
                    'default' => 'h2',
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
	
            $this->add_control(
                'image_title', [
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Fly in the sky' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'title_postition',
                [
                    'label' => esc_html__('Title Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'center' => 'Center',
                        'center-left' => 'Center Left',
                        'center-right' => 'Center Right',
                        'top-left' => 'Top Left',
                        'top-center' => 'Top Center',
                        'top-right' => 'Top Right',
                        'bottom-left' => 'Bottom Left',
                        'bottom-center' => 'Bottom Center',
                        'bottom-right' => 'Bottom Right',
                        'verticaly-center' => 'Verticaly Center',
                    ],
                    'default' => 'center',
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'enable_link',
                [
                    'label' => esc_html__('Enable Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'title_link',
                [
                    'label' => esc_html__( 'Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'condition' => [
                        'enable_link' => 'yes',
                    ],
                ]
            );
        
            $this->add_control(
                'hover_effect',
                [
                    'label' => esc_html__('Hover Effect', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'no-effect' => 'No Effect',
                        'zoom-in' => 'Zoom In',
                        'zoom-out' => 'Zoom Out',
                        'slide-left' => 'Slide Left',
                        'slide-top' => 'Slide Top',
                        'blur' => 'Blur',
                        'overlay' => 'Overlay',
                        'tilt' => 'Tilt',
                        'skew' => 'Skew',
                    ],
                    'default' => 'no-effect',
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Title Styling Controls
        $this->start_controls_section(
            'image_title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'image_title_typography',
                    'selector' => '{{WRAPPER}} .pea-image-title',
                ]
            );

            $this->start_controls_tabs( 'image_title_tabs' );

            $this->start_controls_tab(
                'image_title_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
        
                $this->add_control(
                    'image_title_color',
                    [
                        'label' => esc_html__('Normal Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .pea-image-title' => 'color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'image_title_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'image_title_hover_color',
                    [
                        'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-image-wrapper:hover .pea-image-title' => 'color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'image_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'image_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Image Styling Controls
        $this->start_controls_section(
            'image_styling',
            [
                'label' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'image_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px','em', 'rem','vh', 'vw'],
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
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'image_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px','em', 'rem','vh', 'vw'],
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
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
        
            $this->add_control(
                'image_auto_height_enable',
                [
                    'label' => esc_html__('Auto Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        
            $this->add_control(
                'image_auto_fit_enable',
                [
                    'label' => esc_html__('Auto Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        
            $this->add_control(
                'image_fit_options',
                [
                    'label' => esc_html__('Image Fit Options', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'contain' => 'Contain',
                        'cover' => 'Cover',
                        'fill' => 'Fill',
                    ],
                    'default' => 'cover',
                    'condition' => [
                        'image_auto_fit_enable' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-image' => 'object-fit: {{VALUE}};',
                    ],
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
                        'selector' => '{{WRAPPER}} .pea-image-wrapper',
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
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-advanced-image-wrapper:hover .pea-image-wrapper' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'image_border_hr',
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
                        '{{WRAPPER}} .pea-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

             $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'image_bg_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				    'selector' => '{{WRAPPER}} .pea-image-wrapper',
                ]
            );
        
        $this->end_controls_section();
        
        // Overlay Styling Controls
        $this->start_controls_section(
            'overlay_styling',
            [
                'label' => esc_html__('Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

            $this->start_controls_tabs( 'overlay_tabs' );

            $this->start_controls_tab(
                'overlay_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'overlay_bg_gradient',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-image-overlay .pea-image-wrapper::before',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'overlay_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
            
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'overlay_hover_bg_gradient',
                        'types'          => [ 'classic', 'gradient' ],
                        // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                        'exclude'        => [ 'image' ],
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                'default' => 'classic',
                            ],
                        ],
                        'selector'  => '{{WRAPPER}} .pea-advanced-image-wrapper:hover .pea-image-overlay .pea-image-wrapper::before',
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  
            
            $this->add_responsive_control(
                'overlay_opacity',
                [
                    'label' => esc_html__('Opacity', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0.5,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-image-overlay .pea-image-wrapper::before' => 'opacity: {{SIZE}};',
                    ],
                ]
            );  
        
        $this->end_controls_section();
        
        // Image Mask Styling Controls
        $this->start_controls_section(
            'image_mask_styling',
            [
                'label' => esc_html__('Image Mask', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'image_mask_size',
                [
                    'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'cover' => 'Cover',
                        'contain' => 'Contain',
                        'auto' => 'Auto',
                    ],
                    'default' => 'cover',
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-wrapper' => 'mask-size: {{VALUE}};',
                    ],
                ]
            );
        
            $this->add_control(
                'image_mask_position',
                [
                    'label' => esc_html__('Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'center' => 'Center',
                        'center left' => 'Center Left',
                        'center right' => 'Center Right',
                        'top left' => 'Top Left',
                        'top center' => 'Top Center',
                        'top right' => 'Top Right',
                        'bottom left' => 'Bottom Left',
                        'bottom center' => 'Bottom Center',
                        'bottom right' => 'Bottom Right',
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-wrapper' => 'mask-position: {{VALUE}};',
                    ],
                ]
            );
        
            $this->add_control(
                'image_mask_repeat',
                [
                    'label' => esc_html__('Repeat', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'repeat' => 'Repeat',
                        'no-repeat' => 'No Repeat',
                    ],
                    'default' => 'no-repeat',
                    'selectors' => [
                        '{{WRAPPER}} .pea-image-wrapper' => 'mask-repeat: {{VALUE}};',
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
        
        // Get image data
        $image = $settings['image'];
        $image_url = !empty($image['url']) ? $image['url'] : '';
        if (empty($image_url)) {
            return;
        }
        
        // Get settings
        $image_style = $settings['image_styles'];
        $show_overlay = $settings['show_overlay'];
        $show_title = $settings['show_title'];
        $title_tag = $settings['title_tag'];
        $image_title = $settings['image_title'];
        $title_position = $settings['title_postition'];
        $enable_link = $settings['enable_link'];
        $title_link = $settings['title_link'];
        $hover_effect = $settings['hover_effect'];
        $auto_height = $settings['image_auto_height_enable'];
        $auto_fit = $settings['image_auto_fit_enable'];
        
        if ( in_array( $settings['image_styles'], [ 'photo-collage', 'irregular-blob', 'flower','reverse-triangle-blob', 'triangle-blob',  'organic-blob', 'teardrop', 'wavy-stripes', 'token' ], true ) && $settings['image_styles'] !== 'default' ) {
            echo '
            <style>
                .pea-advanced-image-'.esc_attr( $this->get_id() ).' .pea-image-wrapper {
                    height: auto;
                    border: none;
                    -webkit-mask-image: url('.esc_url(PEA_PLUGIN_URL.'assets/images/'.esc_attr($settings['image_styles'])).'.svg);
                    mask-image: url('.esc_url(PEA_PLUGIN_URL.'assets/images/'.esc_attr($settings['image_styles'])).'.svg);
                    mask-size: cover;
                    mask-position: center;
                    mask-repeat: no-repeat;
                }
            </style>';
        }

        // Build classes
        $wrapper_classes = ['pea-widget-wrapper', 'pea-advanced-image-wrapper'];
        $wrapper_classes[] = 'image-style-' . esc_attr($image_style);
        $wrapper_classes[] = 'hover-effect-' . esc_attr($hover_effect);
        
        if ($auto_height === 'yes') {
            $wrapper_classes[] = 'auto-height';
        }
        
        if ($auto_fit === 'yes') {
            $image_fit = isset($settings['image_fit_options']) ? $settings['image_fit_options'] : 'cover';
            $wrapper_classes[] = 'auto-fit-' . esc_attr($image_fit);
        }
        
        if ($show_title === 'yes') {
            $wrapper_classes[] = 'title-position-' . esc_attr($title_position);
        }
        
        // Start output
        ?>
        <div class="<?php echo esc_attr(implode(' ', $wrapper_classes)); ?> pea-advanced-image-<?php echo esc_attr( $this->get_id() ); ?>">
            
            <?php if ($enable_link === 'yes' && !empty($title_link['url'])) : 
                $target = $title_link['is_external'] ? ' target="_blank"' : '';
                $nofollow = $title_link['nofollow'] ? ' rel="nofollow"' : '';
            ?>
                <a href="<?php echo esc_url($title_link['url']); ?>" <?php echo esc_attr($target . $nofollow); ?> class="pea-image-link">
            <?php endif; ?>
            
            <div class="pea-image-container <?php  if ($show_overlay === 'yes'){ echo esc_attr('pea-image-overlay'); } ?>">
                
                <!-- Image -->
                <div class="pea-image-wrapper">
                    <img src="<?php echo esc_url($image_url); ?>" 
                        alt="<?php echo esc_attr($image_title); ?>" 
                        class="pea-advanced-image">
                </div>
                
                <!-- Title -->
                <?php if ($show_title === 'yes' && !empty($image_title)) : ?>
                    <div class="pea-image-title-wrapper">
                        <<?php echo esc_attr($title_tag); ?> class="pea-image-title">
                            <?php echo esc_html($image_title); ?>
                        </<?php echo esc_attr($title_tag); ?>>
                    </div>
                <?php endif; ?>
                
            </div>
            
            <?php if ($enable_link === 'yes' && !empty($title_link['url'])) : ?>
                </a>
            <?php endif; ?>
            
        </div>
        <?php
    }
}