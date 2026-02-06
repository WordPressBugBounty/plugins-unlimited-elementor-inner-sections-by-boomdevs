<?php 

namespace PrimeElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class ContactForm7 extends Widget_Base {
    
    public function get_name() {
        return 'pea_contact_form_7';
    }
    
    public function get_title() {
        return esc_html__('Contact Form 7', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_contact_form_7_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['contact', 'form', 'contact form 7', 'cf7', 'email'];
    }
    
    // public function get_style_depends() {
    //     return ['prime-elementor-addons--contact-form-7'];
    // }
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Form Selection Section
        $this->start_controls_section(
            'form_selection_section',
            [
                'label' => esc_html__('Form Selection', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            // Contact Form 7 Selection
            if ( class_exists( 'WPCF7_ContactForm' ) ) {

                // Get all CF7 forms
                $cf7_forms = array();
                
                if (function_exists('wpcf7')) {
                    $cf7_form_list = get_posts(array(
                        'post_type' => 'wpcf7_contact_form',
                        'numberposts' => -1
                    ));
                    
                    if (!empty($cf7_form_list)) {
                        $cf7_forms[0] = esc_html__('Select a Form', 'unlimited-elementor-inner-sections-by-boomdevs');
                        foreach ($cf7_form_list as $form) {
                            $cf7_forms[$form->ID] = $form->post_title;
                        }
                    } else {
                        $cf7_forms[0] = esc_html__('No forms found', 'unlimited-elementor-inner-sections-by-boomdevs');
                    }
                } else {
                    $cf7_forms[0] = esc_html__('Contact Form 7 not installed', 'unlimited-elementor-inner-sections-by-boomdevs');
                }
                
                $this->add_control(
                    'contact_form_id',
                    [
                        'label' => esc_html__('Select Form', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::SELECT,
                        'options' => $cf7_forms,
                        'default' => '0',
                    ]
                );

                $this->add_control(
                    'label_width_css',
                    [
                        'label' => esc_html__('label width css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::HIDDEN,
                        'default' => '100%',
                        'selectors' => [
                            '{{WRAPPER}} .pea-cf7-wrapper .wpcf7 label' => 'width: {{VALUE}};display:inline-block;',
                        ],
                        'condition'   => [
                            'contact_form_id!' => '0',
                        ],
                    ]
                );

                $this->add_control(
                    'custom_title',
                    [
                        'label'        => __('Custom Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'label_off'    => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'return_value' => 'yes',
                        'default' => 'yes',
                        'condition'   => [
                            'contact_form_id!' => '0',
                        ],
                    ]
                );
        
                $this->add_control(
                    'custom_form_title_tag',
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
                        'default' => 'h3',
                        'condition'   => [
                            'contact_form_id!' => '0',
                            'custom_title' => 'yes',
                        ],
                    ]
                );

                $this->add_control(
                    'custom_form_title',
                    [
                        'label'       => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => 'We’d love to help',
                        'condition'   => [
                            'contact_form_id!' => '0',
                            'custom_title' => 'yes',
                        ],
                    ]
                );

                $this->add_control(
                    'custom_description',
                    [
                        'label'        => __('Custom Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'label_off'    => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'return_value' => 'yes',
                        'default' => 'yes',
                        'condition'   => [
                            'contact_form_id!' => '0',
                        ],
                    ]
                );

                $this->add_control(
                    'custom_form_description',
                    [
                        'label'     => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => 'Interactive design tools and its many customization to customize anything functional dreams.',
                        'condition' => [
                            'contact_form_id!' => '0',
                            'custom_description' => 'yes',
                        ],
                    ]
                );
            } else {
                $this->add_control(
                    'form_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        /* translators: %s: URL to install or activate Contact Form 7 */
                        'raw' => sprintf( __( 'Contact Form 7 is not installed/activated. Please <a href="%s" target="_blank">install/activate Contact Form 7</a> first.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            admin_url( 'plugin-install.php?s=contact+form+7&tab=search&type=term' )
                        ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    ]
                );
            }
        
        $this->end_controls_section();
        
        // Form Settings Section
        $this->start_controls_section(
            'form_settings_section',
            [
                'label' => esc_html__('Form Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            // $this->add_control(
            //     'show_labels',
            //     [
            //         'label' => esc_html__('Show Labels', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::SWITCHER,
            //         'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'return_value' => 'yes',
            //         'default' => 'yes',
            //     ]
            // );
            
            $this->add_control(
                'show_placeholder',
                [
                    'label' => esc_html__('Show Placeholder', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'selectors_dictionary' => [
                        'yes' => 'inherit', // Show placeholder when ON
                        '' => 'transparent', // Hide placeholder when OFF
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper input::placeholder' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper input::-moz-placeholder' => 'color: {{VALUE}} !important; opacity: 1 !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper input::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper textarea::placeholder' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper textarea::-moz-placeholder' => 'color: {{VALUE}} !important; opacity: 1 !important;',
                        '{{WRAPPER}} .pea-cf7-wrapper textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            
            $this->add_control(
                'show_error_messages',
                [
                    'label' => esc_html__('Show Error Messages', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'default' => 'yes',
                    'selectors_dictionary' => [
                        '' => 'display: none !important;',
                        'yes' => 'display: block;'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-not-valid-tip' => '{{VALUE}}',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-response-output.wpcf7-validation-errors' => '{{VALUE}}',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'form_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        $this->start_controls_section(
            'title_n_description_styling',
            [
                'label'     => __('Title & Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'custom_title',
                            'operator' => '===',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'custom_description',
                            'operator' => '===',
                            'value'    => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_alignment',
            [
                'label'   => __('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-widget-title'       => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .pea-cf7-widget-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label'     => __('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'custom_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'form_title_text_color',
            [
                'label'     => __('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#15171C',
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-widget-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'form_title_text_hover_color',
            [
                'label'     => __('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#15171C',
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-wrapper:hover .pea-cf7-widget-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_title' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'form_title_typography',
                'label'     => __('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector'  => '{{WRAPPER}} .pea-cf7-widget-title',
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
                'condition' => [
                    'custom_title' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_title_margin',
            [
                'label'              => __('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-widget-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'custom_title' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_title_padding',
            [
                'label'      => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pea-cf7-widget-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'custom_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label'     => __('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'custom_description' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'description_text_color',
            [
                'label'     => __('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0D173BB2',
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-widget-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_description' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'description_text_hover_color',
            [
                'label'     => __('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0D173BB2',
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-wrapper:hover .pea-cf7-widget-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_description' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'heading_description_typography',
                'label'     => __('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector'  => '{{WRAPPER}} .pea-cf7-widget-description',
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
                'condition' => [
                    'custom_description' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_description_margin',
            [
                'label'              => __('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => ['px', 'em', '%'],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 32,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                'selectors' => [
                    '{{WRAPPER}} .pea-cf7-widget-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'custom_description' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_description_padding',
            [
                'label'      => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pea-cf7-widget-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'custom_description' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        
        // Form Container Style
        $this->start_controls_section(
            'form_container_style_section',
            [
                'label' => esc_html__('Form Container', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->start_controls_tabs('form_container_tabs');
            
                $this->start_controls_tab(
                    'form_container_normal_tab',
                    [
                        'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'form_container_background',
                            'types' => ['classic', 'gradient'],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude' => ['image'],
                            'selector' => '{{WRAPPER}} .pea-cf7-wrapper',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#F7F7F7',
                                ],
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'form_container_border',
                            'selector' => '{{WRAPPER}} .pea-cf7-wrapper',
                        ]
                    );
                
                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'form_container_hover_tab',
                    [
                        'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'form_container_hover_background',
                            'types' => ['classic', 'gradient'],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude' => ['image'],
                            'selector' => '{{WRAPPER}} .pea-cf7-wrapper:hover',
                        ]
                    );
                
                    $this->add_control(
                        'form_container_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cf7-wrapper:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                
                $this->end_controls_tab();
                
            $this->end_controls_tabs();
            
            $this->add_control(
                'form_container_divider',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            
            $this->add_responsive_control(
                'form_container_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 24,
                        'right' => 24,
                        'bottom' => 24,
                        'left' => 24,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'form_container_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 32,
                        'right' => 32,
                        'bottom' => 32,
                        'left' => 32,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'form_container_margin',
                [
                    'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'form_container_box_shadow',
                    'selector' => '{{WRAPPER}} .pea-cf7-wrapper',
                ]
            );
        
        $this->end_controls_section();
        
        // Label Style
        $this->start_controls_section(
            'label_style_section',
            [
                'label' => esc_html__('Label', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'selector' => '{{WRAPPER}} .pea-cf7-wrapper label',
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
            
            $this->start_controls_tabs('label_tabs');
            
                $this->start_controls_tab(
                    'label_normal_tab',
                    [
                        'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );
                
                    $this->add_control(
                        'label_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cf7-wrapper label' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                
                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'label_hover_tab',
                    [
                        'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );
                
                    $this->add_control(
                        'label_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-cf7-wrapper label:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                
                $this->end_controls_tab();
                
            $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        // Input & Textarea Style
        $this->start_controls_section(
            'input_style_section',
            [
                'label' => esc_html__('Input & Textarea', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'input_typography',
                    'selector' => '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .pea-cf7-wrapper textarea, {{WRAPPER}} .pea-cf7-wrapper select',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 18,
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'text_indent',
                [
                    'label' => esc_html__('Text Indent', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 60,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'text-indent: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form textarea' => 'text-indent: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form select' => 'text-indent: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'input_width',
                [
                    'label' => esc_html__('Input Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 50,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form textarea' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form select' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'input_height',
                [
                    'label' => esc_html__('Input Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 50,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form textarea' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form select' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'textarea_width',
                [
                    'label' => esc_html__('Textarea Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 50,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form textarea' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'textarea_height',
                [
                    'label' => esc_html__('Textarea Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 50,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form textarea' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'input_spacing',
                [
                    'label' => esc_html__('Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-cf7-wrapper label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->start_controls_tabs('input_tabs');
            
                $this->start_controls_tab(
                    'input_normal_tab',
                    [
                        'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );
                
                    $this->add_control(
                        'input_text_color',
                        [
                            'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#606266',
                            'selectors' => [
                                '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cf7-wrapper textarea' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cf7-wrapper select' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    
                    $this->add_control(
                        'input_placeholder_color',
                        [
                            'label' => esc_html__('Placeholder Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#6A758E',
                            'selectors' => [
                                '{{WRAPPER}} .pea-cf7-wrapper input::placeholder' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cf7-wrapper textarea::placeholder' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_placeholder' => 'yes',
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'input_background',
                            'types' => ['classic', 'gradient'],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude' => ['image'],
                            'selector' => '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .pea-cf7-wrapper textarea, {{WRAPPER}} .pea-cf7-wrapper select',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#fff',
                                ],
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'input_border',
                            'selector' => '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .pea-cf7-wrapper textarea, {{WRAPPER}} .pea-cf7-wrapper select',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 1,
                                        'right' => 1,
                                        'bottom' => 1,
                                        'left' => 1,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#dadbdd',
                                ],
                            ],
                        ]
                    );
            
                    $this->add_responsive_control(
                        'input_border_radius',
                        [
                            'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'top' => 12,
                                'right' => 12,
                                'bottom' => 12,
                                'left' => 12,
                                'unit' => 'px',
                                'isLinked' => true,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pea-cf7-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pea-cf7-wrapper select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                
                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'input_focus_tab',
                    [
                        'label' => esc_html__('Focus', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );
                
                    $this->add_control(
                        'input_focus_text_color',
                        [
                            'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cf7-wrapper textarea:focus' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-cf7-wrapper select:focus' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'input_focus_background',
                            'types' => ['classic', 'gradient'],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude' => ['image'],
                            'selector' => '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .pea-cf7-wrapper textarea:focus, {{WRAPPER}} .pea-cf7-wrapper select:focus',
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'input_focus_border',
                            'selector' => '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .pea-cf7-wrapper textarea:focus, {{WRAPPER}} .pea-cf7-wrapper select:focus',
                        ]
                    );
            
                    $this->add_responsive_control(
                        'input_focus_border_radius',
                        [
                            'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'top' => '',
                                'right' => '',
                                'bottom' => '',
                                'left' => '',
                                'unit' => 'px',
                                'isLinked' => true,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pea-cf7-wrapper textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pea-cf7-wrapper select:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                
                $this->end_controls_tab();
                
            $this->end_controls_tabs();
            
            $this->add_control(
                'input_divider',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            
            $this->add_responsive_control(
                'input_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em'],
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'input_margin',
                [
                    'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em'],
                    'default' => [
                        'top' => 10,
                        'right' => 0,
                        'bottom' => 20,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file])' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-cf7-wrapper select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'input_box_shadow',
                    'selector' => '{{WRAPPER}} input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .pea-cf7-wrapper textarea, {{WRAPPER}} .pea-cf7-wrapper select',
                ]
            );
        
        $this->end_controls_section();

        // Submit Button Styling Controls
        $this->start_controls_section(
            'submit_button_styling_section',
            [
                'label' => esc_html__('Submit Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'submit_button_width',
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
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'submit_button_alignment',
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
                        '{{WRAPPER}} .pea-cf7-wrapper .wpcf7-form p:has(.wpcf7-submit)' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'submit_button_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]',
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
                                'size' => 16,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs('submit_button_tabs');

                $this->start_controls_tab(
                    'submit_button_normal',
                    [
                        'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );

                    $this->add_control(
                        'submit_button_color',
                        [
                            'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type="submit"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'submit_button_background',
                            'types' => ['classic', 'gradient'],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude' => ['image'],
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#15171C',
                                ],
                            ],
                            'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'submit_button_border',
                            'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'none',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'submit_button_shadow',
                            'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'submit_button_hover',
                    [
                        'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ]
                );

                    $this->add_control(
                        'submit_button_hover_color',
                        [
                            'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFFFFF',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'submit_button_hover_background',
                            'types' => ['classic', 'gradient'],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude' => ['image'],
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#399cff',
                                ],
                            ],
                            'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'submit_button_hover_border',
                            'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'submit_button_hover_shadow',
                            'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"]:hover',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'submit_button_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'submit_button_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 15,
                        'right' => 30,
                        'bottom' => 15,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'submit_button_margin',
                [
                    'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'submit_button_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => 12,
                        'right' => 12,
                        'bottom' => 12,
                        'left' => 12,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Error Messages Styling
        $this->start_controls_section(
            'error_message_styling_section',
            [
                'label' => esc_html__('Error Messages', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'error_message_color',
                [
                    'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-not-valid-tip' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7-validation-errors' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.failed .wpcf7-response-output' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.aborted .wpcf7-response-output' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'error_message_background',
                [
                    'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-validation-errors' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.failed .wpcf7-response-output' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.aborted .wpcf7-response-output' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'error_message_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-not-valid-tip, {{WRAPPER}} .wpcf7-validation-errors, {{WRAPPER}} .wpcf7 form.failed .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.aborted .wpcf7-response-output',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'error_message_border',
                    'selector' => '{{WRAPPER}} .wpcf7-validation-errors, {{WRAPPER}} .wpcf7 form.failed .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.aborted .wpcf7-response-output',
                ]
            );

            $this->add_responsive_control(
                'error_message_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-validation-errors' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.failed .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.aborted .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'error_message_margin',
                [
                    'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-not-valid-tip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7-validation-errors' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.failed .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.aborted .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Invalid Messages Styling
        $this->start_controls_section(
            'invalid_message_styling_section',
            [
                'label' => esc_html__('Invalid Messages', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'invalid_message_color',
                [
                    'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'invalid_message_background',
                [
                    'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'invalid_message_typography',
                    'selector' => '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'invalid_message_border',
                    'selector' => '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output',
                ]
            );

            $this->add_responsive_control(
                'invalid_message_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-out' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'invalid_message_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'invalid_message_margin',
                [
                    'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Success Message Styling
        $this->start_controls_section(
            'success_message_styling_section',
            [
                'label' => esc_html__('Success Message', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'success_message_color',
                [
                    'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-mail-sent-ok' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'success_message_background',
                [
                    'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-mail-sent-ok' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'success_message_typography',
                    'selector' => '{{WRAPPER}} .wpcf7-mail-sent-ok, {{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'success_message_border',
                    'selector' => '{{WRAPPER}} .wpcf7-mail-sent-ok, {{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output',
                ]
            );

            $this->add_responsive_control(
                'success_message_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-mail-sent-ok' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'success_message_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-mail-sent-ok' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'success_message_margin',
                [
                    'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-mail-sent-ok' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    /**
     * Get available Contact Form 7 forms
     */
    private function get_contact_forms() {
        $forms = [];
        
        if (class_exists('WPCF7_ContactForm')) {
            $cf7_forms = get_posts([
                'post_type' => 'wpcf7_contact_form',
                'numberposts' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ]);

            if (!empty($cf7_forms)) {
                foreach ($cf7_forms as $form) {
                    $forms[$form->ID] = $form->post_title;
                }
            }
        }

        return $forms;
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (!class_exists('WPCF7_ContactForm')) {
            echo '<div class="pea-cf7-notice">' . esc_html__('Please install and activate Contact Form 7 plugin.', 'unlimited-elementor-inner-sections-by-boomdevs') . '</div>';
            return;
        }

        $form_id = isset($settings['contact_form_id']) ? $settings['contact_form_id'] : '';
        $custom_title = isset($settings['custom_title']) ? $settings['custom_title'] : '';
        $title = isset($settings['custom_form_title']) ? $settings['custom_form_title'] : '';
        $title_tag = isset($settings['custom_form_title_tag']) ? $settings['custom_form_title_tag'] : '';
        $custom_description = isset($settings['custom_description']) ? $settings['custom_description'] : '';
        $description = isset($settings['custom_form_description']) ? $settings['custom_form_description'] : '';

        if (empty($form_id)) {
            echo '<div class="pea-cf7-notice">' . esc_html__('Please select a contact form.', 'unlimited-elementor-inner-sections-by-boomdevs') . '</div>';
            return;
        }

        ?>
        <div class="pea-widget-wrapper pea-cf7-wrapper">
            <?php if ($custom_title === 'yes' || $custom_description === 'yes') { ?>
                <div class="pea-cf7-content">
                    <?php if ($title !=  '' && $custom_title ===  'yes') { ?>
                        <<?php echo esc_attr($title_tag); ?> class="pea-cf7-widget-title">
                            <?php echo esc_html($title); ?>
                        </<?php echo esc_attr($title_tag); ?>>
                    <?php } ?>
                    <?php if ($description !=  '' && $custom_description ===  'yes') { ?>
                        <p class="pea-cf7-widget-description">
                            <?php echo wp_kses_post($description); ?>
                        </p>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '"]'); ?>
        </div>
        <?php
    }
}