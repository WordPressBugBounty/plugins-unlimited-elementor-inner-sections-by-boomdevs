<?php 

namespace PrimeElementorAddons\Widgets; 

use Elementor\Controls_Stack;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow; 
use Elementor\Group_Control_Background; 
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Repeater;
use PrimeElementorAddons\PrimeNavWalker;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AdvancedMenu extends Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'pea_advanced_menu';
    }

    public function get_title() {
        return esc_html__('Advanced Menu', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon() {
        return 'pea_advanced_menu_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }

    public function get_keywords() {
        return [ 'advanced menu', 'nav menus','menus','navigation',];
    }
    
    public function get_style_depends() {
        return [
            'prime-elementor-addons--advanced-menu',
            'prime-elementor-addons-sm-core-css',
            'prime-elementor-addons-sm-clean-css',
            'prime-elementor-font-awesome-5',
        ];
    }

    public function get_script_depends() {
        return [
            'prime-elementor-addons--advanced-menu',
            'prime-elementor-addons-jquery-smartmenus',
        ];
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }

    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

        // Menu Section
        $this->start_controls_section(
            'menu_section',
            [
                'label' => __( 'Menu', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            $menus = $this->get_available_menus();

            if ( ! empty( $menus ) ) {
                $this->add_control(
                    'menu',
                    [
                        'label'       => __( 'Menu', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'        => Controls_Manager::SELECT,
                        'options'     => $menus,
                        'default'     => array_keys( $menus )[0],
                        /* translators: %s: URL to the WordPress Menus admin screen */
                        'description' => sprintf( __( 'To manage nav menus, navigate to <a href="%s" target="_blank">Menus admin</a>.', 'unlimited-elementor-inner-sections-by-boomdevs' ), admin_url( 'nav-menus.php' ) ),
                    ]
                );
            } else {
                $this->add_control(
                    'menu',
                    [
                        'type'            => Controls_Manager::RAW_HTML,
                        /* translators: %s: URL to the WordPress Menus admin screen */
                        'raw'             => sprintf( __( '<strong>It seems no menus are created.</strong><br>Navigate to <a href="%s" target="_blank">Menus admin</a> and create one.', 'unlimited-elementor-inner-sections-by-boomdevs' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    ]
                );
            }

            $this->add_control(
                'menu_type',
                [
                    'label'       => __( 'Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::SELECT,
                    'options'   => [
                        'horizontal'    => 'Horizontal',
                        'vertical'    => 'Vertical',
                    ],
                    'default'     => 'horizontal',
                ]
            );
                
            $this->add_responsive_control(
                'menu_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
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
                    ],
                    'default' => 'space-between',
                    'selectors' => [
                        '{{WRAPPER}} .pea--collapse' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );  

            $this->add_control(
                'open_dropdown_menu_on_click',
                [
                    'label'              => esc_html__( 'Open Dropdown On Click', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'               => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off'    => __( 'Off', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'default'      => 'no', 
                ]
            );

            $this->add_control(
                'show_dropdown_menu_icon',
                [
                    'label'              => esc_html__( 'Show Dropdown Menu icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'               => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off'    => __( 'Off', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'default'      => 'yes', 
                    'condition' => [
                        'open_dropdown_menu_on_click!' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'hide_sub_menu_icon_css',
                [
                    'label' => esc_html__('flex_wrap css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'unset',
                    'selectors' => [
                        '{{WRAPPER}} .pea-sub-arrow-icon.pea-caret-down:before'=> 'content:{{VALUE}};',
                        '{{WRAPPER}} .pea-sub-arrow-icon'=> 'display:none;',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                            'terms' => [
                                    ['name' => 'open_dropdown_menu_on_click', 'operator' => '!==', 'value' => 'yes'],
                                    ['name' => 'show_dropdown_menu_icon', 'operator' => '!==', 'value' => 'yes'],
                                ]
                            ],
                            [
                            'terms' => [
                                    ['name' => 'indicator_icon', 'operator' => '===', 'value' => 'unset']
                                ]
                            ],
                        ]
                    ]
                ]
            );

            $this->add_control(
                'indicator_icon',
                [
                    'label'       => esc_html__( 'Submenu Indicator', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => '"\f078"',
                    'options'     => [
                        'unset'     => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        '"\f0d7"'   => esc_html__( 'Classic ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        '"\f107"'   => esc_html__( 'Angle ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        '"\f103"'   => esc_html__( 'Double Angle ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        '"\f078"'   => esc_html__( 'Chevron ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        '"\f067"'   => esc_html__( 'Plus ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                    'selectors' =>[
                        '{{WRAPPER}} .pea-sub-arrow-icon.pea-caret-down:before'=> 'content:{{VALUE}};' 
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'open_dropdown_menu_on_click',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                            [
                                'name'     => 'show_dropdown_menu_icon',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                        ],
                    ],
                ]
            );
        $this->end_controls_section();

        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __( 'Layout', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
            
            $this->add_control(
                'heading_responsive',
                [
                    'type'      => Controls_Manager::HEADING,
                    'label'     => __( 'Responsive', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'full_width_dropdown',
                [
                    'label' => esc_html__( 'Full Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off' => __( 'Hide', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'prefix_class' => 'pea-mobile-menu-full-width-', // Add this line
                ]
            );

            $this->add_control(
                'toggle_responsive',
                [
                    'label'         => __( 'Breakpoint', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'tablet',
                    'options'       => [
                        'mobile' => __( 'Mobile (767px >)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'tablet' => __( 'Tablet (1023px >)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'none'   => __( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                    'prefix_class' => 'pea-menu-breakpoint-',
                    'render_type' => 'template',
                ]
            );

            $this->add_control(
                'toggle_align',
                [
                    'label'                 => __( 'Toggle Align', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'                  => Controls_Manager::CHOOSE,
                    'default'               => 'center',
                    'options'               => [
                        'left'   => [
                            'title' => __( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon'  => 'eicon-h-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'toggle_responsive!' => 'none',
                    ],
                    'selectors' =>[
                        '{{WRAPPER}} .pea-main-nav'=> 'justify-content:{{VALUE}};' 
                    ],
                ]
            );
        $this->end_controls_section(); 
        
        // =====================
        // STYLE TAB
        // ===================== 
        
        // Menu Wrapper Styling Controls    
		$this->start_controls_section(
			'menu_wrapper_styling',
			[
				'label' => esc_html__( 'Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            $this->start_controls_tabs( 'menu_wrapper_tabs' );
                $this->start_controls_tab(
                    'menu_wrapper_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'menu_wrapper_bg_type_popover_toggle',
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
                                'name'      => 'menu_wrapper_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-main-menu',
                            ]
                        );
                    $this->end_popover();
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'menu_wrapper_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-main-menu',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'menu_wrapper_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'menu_wrapper_hover_bg_type_popover_toggle',
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
                                'name'      => 'menu_wrapper_hover_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .pea-main-menu',
                            ]
                        );
                    $this->end_popover();
                    $this->add_control(
                        'menu_wrapper_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .pea-main-menu' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'menu_wrapper_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'menu_wrapper_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-main-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'menu_wrapper_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-main-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'menu_wrapper_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-main-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            //  $this->add_group_control(
            //     Group_Control_Box_Shadow::get_type(),
            //     [
            //         'name'     => 'menu_wrapper_shadow',
            //         'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			// 	    'selector' => '{{WRAPPER}} .pea-main-menu',
            //     ]
            // );    

		$this->end_controls_section();

        // Navigation / Top Menu Styling Controls
        $this->start_controls_section(
            'navigation_style',
            [
                'label' => __( 'Navigation / Top Menus', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		
            $this->add_responsive_control(
                'menu_gap',
                [
                    'label'           => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 120,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'size' => 10,
                        'unit' => 'px',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-top-nav-link' => 'gap: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'menus_typography',
                    'label'     => __( 'Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ), 
                    'selector'  => '{{WRAPPER}} .pea-main-nav .pea-top-nav-link, {{WRAPPER}} .pea-main-nav .pea-sub-link', 
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
                        'text_decoration' => [
                            'default' => 'none',
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
            $this->start_controls_tabs( 'menus_tabs' );
            $this->start_controls_tab(
                'menus_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_control(
                    'menus_color',
                    [
                        'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .pea-top-nav-link' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'menus_bg_color',
                    [
                        'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .sm-clean .pea-top-nav-link' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'menus_border',
                        'label' => esc_html__( 'Border', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-main-nav .sm-clean .pea-top-nav-link',
                    ]
                );

            $this->end_controls_tab();
            $this->start_controls_tab(
                'menus_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
                $this->add_control(
                    'menus_hover_color',
                    [
                        'label'     => __( ' Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .pea-top-nav-link:hover' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea-main-nav .sm-clean > .menu-item.active > .pea-top-nav-link' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'menus_hover_bg_color',
                    [
                        'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .sm-clean > .pea-top-nav-link:hover' => 'background-color: {{VALUE}}',
                            '{{WRAPPER}} .pea-main-nav .sm-clean > .pea-top-nav-link:hover' => 'background-color: {{VALUE}}',
                            '{{WRAPPER}} .pea-main-nav .sm-clean > .menu-item.active > .pea-top-nav-link' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'menus_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .sm-clean pea-top-nav-link:hover' => 'border-color: {{VALUE}}',
                            '{{WRAPPER}} .pea-main-nav .sm-clean .menu-item.active .pea-top-nav-link' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'menus_active_tab',
                [
                    'label' => esc_html__( 'Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );
                $this->add_control(
                    'menus_active_color',
                    [
                        'label'     => __( ' Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .active .pea-top-nav-link' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'menus_active_bg_color',
                    [
                        'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .sm-clean .menu-item.active .pea-top-nav-link' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'menus_active_border_color',
                    [
                        'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' =>[
                            '{{WRAPPER}} .pea-main-nav .sm-clean .menu-item.active .pea-top-nav-link' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_control(
                'hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
                
            $this->add_responsive_control(
                'menus_border_radius',
                [
                    'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                        'size' => '',
                        'unit' => '',
                    ],
                    'tablet_default' => [
                        'size' => '',
                        'unit' => '',
                    ],
                    'mobile_default' => [
                        'size' => '',
                        'unit' => '',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .pea-main-nav .sm-clean .pea-top-nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menus_padding',
                [
                    'label'      => __( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .pea-main-nav .sm-clean .pea-top-nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menus_margin',
                [
                    'label'      => __( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .pea-main-nav .sm-clean .pea-top-nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'menus_box_shadow',
                    'label'     => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'selector' => '{{WRAPPER}} .pea-main-nav .sm-clean .pea-top-nav-link',
                ]
            );

        $this->end_controls_section(); 
        
        // Dropdown Menu Wrapper Styling Controls    
		$this->start_controls_section(
			'dropdown_menu_wrapper_styling',
			[
				'label' => esc_html__( 'Dropdown Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            
            $this->add_responsive_control(
                'dropdown_menu_wrapper_width',
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
                        '{{WRAPPER}} .sm-clean ul' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->start_controls_tabs( 'dropdown_menu_wrapper_tabs' );
                $this->start_controls_tab(
                    'dropdown_menu_wrapper_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'dropdown_menu_wrapper_bg_type_popover_toggle',
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
                                'name'      => 'dropdown_menu_wrapper_bg_color',
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
                                'selector'  => '{{WRAPPER}} .sm-clean ul.drop-menu',
                            ]
                        );
                    $this->end_popover();
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'dropdown_menu_wrapper_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .sm-clean ul.drop-menu',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'dropdown_menu_wrapper_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'dropdown_menu_wrapper_hover_bg_type_popover_toggle',
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
                                'name'      => 'dropdown_menu_wrapper_hover_bg_color',
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
                                'selector'  => '{{WRAPPER}} .pea-widget-wrapper:hover .sm-clean ul.drop-menu',
                            ]
                        );
                    $this->end_popover();
        
                    $this->add_control(
                        'dropdown_menu_wrapper_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-widget-wrapper:hover .sm-clean ul.drop-menu' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'dropdown_menu_wrapper_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'dropdown_menu_wrapper_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .sm-clean ul.drop-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .sm-clean ul.drop-menu > li:first-child'   => 'border-top-left-radius: calc({{TOP}}{{UNIT}} - 4px); border-top-right-radius: calc({{RIGHT}}{{UNIT}} - 4px);',
                        '{{WRAPPER}} .sm-clean ul.drop-menu > li:last-child'    => 'border-bottom-left-radius: calc({{LEFT}}{{UNIT}} - 4px); border-bottom-right-radius: calc({{BOTTOM}}{{UNIT}} - 4px);',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'dropdown_menu_wrapper_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .sm-clean ul.drop-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dropdown_menu_wrapper_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-top-nav-link + ul.drop-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dropdown_menu_inner_wrapper_margin',
                [
                    'label'     => esc_html__('Inner Wrapper Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-top-nav-link + ul.drop-menu ul.drop-menu ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            //  $this->add_group_control(
            //     Group_Control_Box_Shadow::get_type(),
            //     [
            //         'name'     => 'dropdown_menu_wrapper_shadow',
            //         'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			// 	    'selector' => '{{WRAPPER}} .sm-clean ul.drop-menu',
            //     ]
            // );    

		$this->end_controls_section();
        
        // Dropdown Menu Styling Controls
        $this->start_controls_section(
            'dropdown_menu_styling',
            [
                'label' => __( 'Dropdown Menu', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		
            $this->add_responsive_control(
                'dropdown_menu_icon_size',
                [
                    'label'           => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-sub-link .pea-sub-arrow-icon:before' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'dropdown_menu_typography',
                    'label'     => __( 'Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ), 
                    'selector'  => '{{WRAPPER}} .drop-menu .pea-sub-link', 
                ]
            );

            $this->start_controls_tabs( 'dropdown_menu_tabs' );
                $this->start_controls_tab(
                    'dropdown_menu_normal_tab',
                    [
                        'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'dropdown_menu_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_icon_color',
                        [
                            'label'     => __( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link .pea-sub-arrow-icon:before' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_bg_color',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_border_border',
                        [
                            'label'       => __( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'        => Controls_Manager::SELECT,
                            'options'   => [
                                ''    => 'Default',
                                'none'    => 'None',
                                'solid'    => 'Solid',
                                'double'    => 'Double',
                                'dotted'    => 'Dotted',
                                'dashed'    => 'Dashed',
                                'groove'    => 'Groove',
                            ],
                            'default'     => '',
                            'selectors'  => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link' => 'border-style: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'dropdown_menu_border_width',
                        [
                            'label'      => __( 'Border Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%','em'],
                            'selectors'  => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_border_color',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );
            
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'dropdown_menu_hover_tab',
                    [
                        'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'dropdown_menu_hover_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_hover_icon_color',
                        [
                            'label'     => __( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link:hover .pea-sub-arrow-icon:before' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_hover_bg_color',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_hover_border_color',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .pea-sub-link:hover' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'dropdown_menu_active_tab',
                    [
                        'label' => __( 'Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'dropdown_menu_active_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .menu-item.active > .pea-sub-link' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .drop-menu .pea-sub-link.highlighted' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_active_icon_color',
                        [
                            'label'     => __( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .menu-item.active > .pea-sub-link .pea-sub-arrow-icon:before' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .drop-menu .pea-sub-link.highlighted .pea-sub-arrow-icon:before' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_active_bg_color',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .menu-item.active > .pea-sub-link' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .drop-menu .pea-sub-link.highlighted' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dropdown_menu_active_border_color',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .drop-menu .menu-item.active > .pea-sub-link' => 'border-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .drop-menu .pea-sub-link.highlighted' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_control(
                'dropdown_menu_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'dropdown_border_radius',
                [
                    'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .drop-menu .pea-sub-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dropdown_padding',
                [
                    'label'      => __( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .drop-menu .pea-sub-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'dropdown_margin',
                [
                    'label'      => __( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .drop-menu .pea-sub-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'dropdown_icon_margin',
                [
                    'label'      => __( 'Icon Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .drop-menu .pea-sub-link .pea-sub-arrow-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Responsive Toggle Menu Button Styling Controls
        $this->start_controls_section(
            'section_style_toggle',
            [
                'label' => __( 'Toggle Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'toggle_size',
                [
                    'label'     => __( 'Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'      => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 120,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-main-nav .toggle-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                    ], 
                ]
            );
            $this->start_controls_tabs( 'tabs_toggle_style' );
                $this->start_controls_tab(
                    'tab_toggle_style_normal',
                    [
                        'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'toggle_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-main-nav .toggle-icon' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'toggle_background_color',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-main-nav .toggle-icon' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'toggle_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-main-nav .toggle-icon',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'tab_toggle_style_hover',
                    [
                        'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'toggle_color_hover',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-main-nav .toggle-icon:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'toggle_background_color_hover',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-main-nav .toggle-icon:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'toggle_border_color_hover',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [ 
                                '{{WRAPPER}} .pea-main-nav .toggle-icon:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab(); 
            $this->end_controls_tabs();

            $this->add_control(
                'toggle_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'toggle_border_radius',
                [
                    'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .pea-main-nav .toggle-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea-main-nav .mobile-menu-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'toggle_padding',
                [
                    'label'      => __( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .pea-main-nav .toggle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        // // Mobile Menu Styling Controls
        // $this->start_controls_section(
        //     'style_resposive_menu',
        //     [
        //         'label' => __( 'Mobile Menu', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         'tab'   => Controls_Manager::TAB_STYLE,
        //     ]
        // );
        // $slug = 'responsive_menu';

        // $this->start_controls_tabs( $slug.'_tabs' );
        // $this->start_controls_tab(
        //     $slug.'_normal_style',
        //     [
        //         'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //     ]
        // );
        
        // $this->add_control(
        //     $slug.'_color',
        //     [
        //         'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .open-nav .pea-top-nav-link' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     $slug.'_bg_color',
        //     [
        //         'label' => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .open-nav .menu-item' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->end_controls_tab();

        // $this->start_controls_tab(
        //     $slug.'_style_hover',
        //     [
        //         'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

        //     ]
        // );
        // $this->add_control(
        //     $slug.'_hover_color',
        //     [
        //         'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .open-nav .pea-top-nav-link:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .open-nav .active .pea-top-nav-link' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     $slug.'_bg_hover_color',
        //     [
        //         'label' => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .open-nav .menu-item:hover' => 'background-color: {{VALUE}};',
        //             '{{WRAPPER}} .open-nav .menu-item.active' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->end_controls_tab();
        // $this->end_controls_tabs();
        // $this->end_controls_section();
        
    }

    protected function render() {
        
        $menus = $this->get_available_menus();
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $toggle_responsive = $settings['toggle_responsive']; 
        $dropdown_on_click = ( 'yes' === $settings['open_dropdown_menu_on_click'] ) ? 'yes' : 'no';
        $show_dropdown_icon = $settings['show_dropdown_menu_icon']; 
        $layout_type = $settings['menu_type']; 
        $layout_type = $layout_type === 'vertical' ? 'sm-vertical' : '';

        if ( empty( $menus ) ) {
            $menu_link = admin_url( 'nav-menus.php' );

            echo '<div class="elementor-panel-alert elementor-panel-alert-info">
                    <h6>No menus found. Please create a menu in 
                        <a href="' . esc_url( $menu_link ) . '" target="_blank" rel="noopener"><strong>Appearance → Menus</strong></a>.
                    </h6>
                </div>';
            return;
        }?>

        <div class="pea-widget-wrapper pea-advanced-menu-wrapper " widget-id="<?php echo esc_attr($widget_id); ?>" open-dropdown-on-click="<?php echo esc_attr($dropdown_on_click); ?>" show-dropdown-icon="<?php echo esc_attr($show_dropdown_icon); ?>" >
            <div class="pea-advanced-menu-inner-wrapper"> 
                <nav class="pea-main-nav">
                    <button class="mobile-menu-toggle <?php echo esc_attr($toggle_responsive); ?> " type="button" > 
                        <span class="toggle-icon open fas fa-bars"></span>
                    </button>
                    <div class="pea--collapse <?php echo esc_attr($toggle_responsive); ?> " >
                        <?php wp_nav_menu( [
                                'menu'        => $settings['menu'],
                                'menu_class'  => 'pea-main-menu sm sm-clean mobile-nav '.esc_attr($layout_type),
                                'menu_id'     => 'pea-menu-'.esc_attr($widget_id),
                                'fallback_cb' => 'PrimeNavWalker::fallback',
                                'container'   => '',
                                'walker' => new PrimeNavWalker()
                            ] ); ?>
                    </div>
                </nav>
            </div>   
        </div>         
    <?php  } 
}