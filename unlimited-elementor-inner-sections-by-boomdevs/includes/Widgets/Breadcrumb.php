<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;    
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Breadcrumb extends Widget_Base {

    public function get_name() {
        return 'pea_breadcrumb';
    }

    public function get_title() {
        return esc_html__('Breadcrumb', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon() {
        return 'pea_breadcrumb_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return ['breadcrumb', 'advanced breadcrumb', 'yoest', 'page link', 'embed'];
    }

    public function get_style_depends() {
        return ['prime-elementor-addons--breadcrumb'];
    }

    protected function register_controls() {
        
        // --- CONTENT TAB: HOME ---
        $this->start_controls_section(
            'section_home',
            [
                'label' => esc_html__( 'Home', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_home_page',
            [
                'label' => esc_html__( 'Show Home Page', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'home_text',
            [
                'label' => esc_html__( 'Home Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Home', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'condition' => [ 'show_home_page' => 'yes' ],
            ]
        );

        $this->add_control(
            'home_prefix_type',
            [
                'label'   => esc_html__( 'Show Prefix', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-star',
                    ],
                    'text' => [
                        'title' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                ],
                'default'   => 'icon',
                'toggle'    => false,
                'condition' => [ 'show_home_page' => 'yes' ],
            ]
        );

        $this->add_control(
            'home_prefix_text',
            [
                'label' => esc_html__( 'Prefix Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Browsing:', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'condition' => [ 'home_prefix_type' => 'text' ],
            ]
        );

        $this->add_responsive_control('home_prefix_text_gap', [
            'label'      => esc_html__( 'Prefix Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'default' => [ 'size' => 5 ],
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
            'selectors'  => [ '{{WRAPPER}} .pea-breadcrumb-item.home > a' => 'gap: {{SIZE}}{{UNIT}};' ],
            'condition' => [ 'home_prefix_type' => 'text' ],
        ]);

        $this->add_control(
            'show_home_icon',
            [
                'label' => esc_html__( 'Show Home Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [
                    'show_home_page' => 'yes',
                    'home_prefix_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'home_icon',
            [
                'label' => esc_html__( 'Home Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_home_page' => 'yes',
                    'home_prefix_type' => 'icon',
                    'show_home_icon' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        // --- CONTENT TAB: SEPARATOR ---
        $this->start_controls_section(
            'section_separator_content',
            [
                'label' => esc_html__( 'Separator', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'separator_type',
            [
                'label'     => esc_html__( 'Separator Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-star',
                    ],
                    'text' => [
                        'title' => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                ],
                'default'   => 'text',
                'toggle'    => false,
            ]
        );

        $this->add_control(
            'separator_text',
            [
                'label'     => esc_html__( 'Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '/',
                'condition' => [
                    'separator_type' => 'text'
                ],
            ]
        );

        $this->add_control(
            'separator_icon',
            [
                'label'     => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'separator_type' => 'icon'
                ],
            ]
        );

        $this->end_controls_section();

        // --- CONTENT TAB: ITEM ---
        $this->start_controls_section(
            'section_item_content',
            [
                'label' => esc_html__( 'Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_item_icon',
            [
                'label' => esc_html__( 'Show Item Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'item_icon',
            [
                'label' => esc_html__( 'Item Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-file',
                    'library' => 'fa-solid',
                ],
                'condition' => [ 'show_item_icon' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        // ================= STYLE TAB =================

        // STYLE TAB: ITEMS
        $this->start_controls_section(
            'section_style_items',
            [
                'label' => esc_html__( 'Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'items_alignment',
            [
                'label'     => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [ 'title' => 'Left', 'icon' => 'eicon-text-align-left' ],
                    'center'     => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                    'flex-end'   => [ 'title' => 'Right', 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-wrapper' => 'justify-content: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control('gap_main', [
            'label'      => esc_html__( 'Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'default' => [ 'size' => 5 ],
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
            'selectors'  => [ '{{WRAPPER}} .pea-breadcrumb-wrapper' => 'gap: {{SIZE}}{{UNIT}};' ],
        ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'items_typography',
                'selector' => '{{WRAPPER}} .pea-breadcrumb-item, {{WRAPPER}} .pea-breadcrumb-item a',
            ]
        );

        $this->start_controls_tabs( 'tabs_items_style' );

            // NORMAL TAB
            $this->start_controls_tab( 'tab_items_normal', [ 'label' => 'Normal' ] );
                $this->add_control( 'items_color_normal', [
                    'label'     => 'Text Color',
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item, {{WRAPPER}} .pea-breadcrumb-item a' => 'color: {{VALUE}};' ],
                ]);
                $this->add_control( 'items_bg_normal', [
                    'label'     => 'Background Color',
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item' => 'background-color: {{VALUE}};' ],
                ]);

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'items_border',
                        'selector' => '{{WRAPPER}} .pea-breadcrumb-item',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'items_box_shadow',
                        'selector' => '{{WRAPPER}} .pea-breadcrumb-item',
                        'separator' => 'after',
                    ]
                );
            $this->end_controls_tab();

            // HOVER TAB
            $this->start_controls_tab( 'tab_items_hover', [ 'label' => 'Hover' ] );
                $this->add_control( 'items_color_hover', [
                    'label'     => 'Hover Color',
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item:hover, {{WRAPPER}} .pea-breadcrumb-item a:hover' => 'color: {{VALUE}};' ],
                ]);
                $this->add_control( 'items_bg_hover', [
                    'label'     => 'Background Hover',
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item:hover' => 'background-color: {{VALUE}};' ],
                ]);
                $this->add_control( 'items_border_color_hover', [
                    'label'     => 'Border Color Hover',
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item:hover' => 'border-color: {{VALUE}};' ],
                ]);
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'items_box_shadow_hover',
                        'selector' => '{{WRAPPER}} .pea-breadcrumb-item:hover',
                        'separator' => 'after',
                    ]
                );
            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'items_border_radius',
            [
                 'separator' => 'before',
                'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'items_padding',
            [
                'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $this->add_responsive_control(
            'items_margin',
            [
                'label' => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // --- STYLE TAB: CURRENT ITEM ---
        $this->start_controls_section('section_style_current_item', [
            'label' => esc_html__( 'Current Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [ 'name' => 'current_typography', 'selector' => '{{WRAPPER}} .pea-breadcrumb-item.current' ]);
        
        $this->start_controls_tabs( 'tabs_current_item_style' );
            $this->start_controls_tab( 'tab_current_normal', [ 'label' => 'Normal' ] );
                $this->add_control( 'current_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item.current' => 'color: {{VALUE}};' ] ]);
                $this->add_control( 'current_bg_color', [ 'label' => 'Background Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item.current' => 'background-color: {{VALUE}};' ] ]);
            $this->end_controls_tab();
            $this->start_controls_tab( 'tab_current_hover', [ 'label' => 'Hover' ] );
                $this->add_control( 'current_color_hover', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item.current:hover' => 'color: {{VALUE}};' ] ]);
                $this->add_control( 'current_bg_color_hover', [ 'label' => 'Background Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item.current:hover' => 'background-color: {{VALUE}};' ] ]);
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // STYLE TAB: HOME ICON 
        $this->start_controls_section(
            'section_style_home_icon_special',
            [
                'label' => esc_html__( 'Home Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_home_page' => 'yes',
                    'home_prefix_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control('home_icon_special_size', [
            'label' => esc_html__( 'Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [ 'size' => 16 ],
            'selectors' => [
                '{{WRAPPER}} .pea-home-special-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                '{{WRAPPER}} .pea-home-special-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
            ],
        ]);
        $this->add_responsive_control('home_icon_spec_margin', [
            'label' => esc_html__( 'Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [ 'size' => 5 ],
            'selectors' => [
                '{{WRAPPER}} .pea-home-special-icon' => 'margin-right: {{SIZE}}{{UNIT}} !important; display: inline-flex !important;',
            ],
        ]);

        $this->start_controls_tabs( 'tabs_home_icon_style' ); 
            $this->start_controls_tab( 'tab_home_icon_normal', [ 'label' => 'Normal' ] );
                $this->add_control( 'home_icon_color_spec', [
                    'label' => 'Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ 
                        '{{WRAPPER}} .pea-home-special-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pea-home-special-icon svg' => 'fill: {{VALUE}};'
                    ],
                ]);
                $this->add_control( 'home_icon_bg_spec', [ 
                    'label' => 'Background Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-home-special-icon' => 'background-color: {{VALUE}};' ],
                ]);
            $this->end_controls_tab();
            $this->start_controls_tab( 'tab_home_icon_hover', [ 'label' => 'Hover' ] );
                $this->add_control( 'home_icon_color_spec_h', [
                    'label' => 'Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ 
                        '{{WRAPPER}} .pea-breadcrumb-item:hover .pea-home-special-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pea-breadcrumb-item:hover .pea-home-special-icon svg' => 'fill: {{VALUE}};'
                    ],
                ]);
                $this->add_control( 'home_icon_bg_spec_h', [
                    'label' => 'Background Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item:hover .pea-home-special-icon' => 'background-color: {{VALUE}};' ],
                ]);
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // STYLE TAB: SEPARATOR
        $this->start_controls_section(
            'section_style_separator',
            [
                'label' => esc_html__( 'Separator', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('separator_icon_size', [
            'label'      => esc_html__( 'Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'default'    => [ 'size' => 14 ],
            'selectors'  => [
                '{{WRAPPER}} .pea-breadcrumb-separator' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pea-breadcrumb-separator i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pea-breadcrumb-separator svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);
         $this->add_responsive_control('separator_gap', [
            'label'      => esc_html__( 'Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'default'    => [ 'size' => 0 ],
            'selectors'  => [
                '{{WRAPPER}} .pea-breadcrumb-separator' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
            ],
        ]);
         $this->start_controls_tabs( 'tabs_separator_icon_style' );
            $this->start_controls_tab( 'tab_separator_icon_normal', [ 'label' => 'Normal' ] );
                $this->add_control( 'separator_icon_color_normal', [ // Fixed ID
                    'label' => 'Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ 
                        '{{WRAPPER}} .pea-breadcrumb-separator' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pea-breadcrumb-separator svg' => 'fill: {{VALUE}};'
                    ],
                ]);
                $this->add_control( 'separator_icon_bg_normal', [ // Fixed ID
                    'label' => 'Background Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-separator' => 'background-color: {{VALUE}};' ],
                ]);
            $this->end_controls_tab();
            $this->start_controls_tab( 'tab_separator_icon_hover', [ 'label' => 'Hover' ] );
                $this->add_control( 'separator_icon_color_hover', [ // Fixed ID
                    'label' => 'Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ 
                        '{{WRAPPER}} .pea-breadcrumb-separator:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pea-breadcrumb-separator:hover svg' => 'fill: {{VALUE}};'
                    ],
                ]);
                $this->add_control( 'separator_icon_bg_hover', [ // Fixed ID
                    'label' => 'Background Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-separator:hover' => 'background-color: {{VALUE}};' ],
                ]);
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // STYLE TAB: ITEM ICONS 
        $this->start_controls_section(
            'section_style_item_icons',
            [
                'label' => esc_html__( 'Item Icons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [ 'show_item_icon' => 'yes' ],
            ]
        );

        $this->add_responsive_control('item_icon_size', [
            'label'      => esc_html__( 'Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'default'    => [ 'size' => 16 ],
            'selectors'  => [
                '{{WRAPPER}} .pea-item-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                '{{WRAPPER}} .pea-item-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
            ],
        ]);

        $this->add_responsive_control('item_icon_gap_spacing', [
            'label'      => esc_html__( 'Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'default'    => [ 'size' => 5 ],
            'selectors'  => [
                '{{WRAPPER}} .pea-item-icon' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
            ],
        ]);

        $this->start_controls_tabs( 'tabs_item_icon_style_final' ); // Unique ID

            $this->start_controls_tab( 'tab_item_icon_normal_final', [ 'label' => 'Normal' ] );
                $this->add_control( 'item_icon_color_normal_final', [
                    'label' => 'Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ 
                        '{{WRAPPER}} .pea-item-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pea-item-icon svg' => 'fill: {{VALUE}};'
                    ],
                ]);
                $this->add_control( 'item_icon_bg_normal_final', [
                    'label' => 'Background Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-item-icon' => 'background-color: {{VALUE}};' ],
                ]);
            $this->end_controls_tab();

            $this->start_controls_tab( 'tab_item_icon_hover_final', [ 'label' => 'Hover' ] );
                $this->add_control( 'item_icon_color_hover_final', [
                    'label' => 'Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ 
                        '{{WRAPPER}} .pea-breadcrumb-item:hover .pea-item-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .pea-breadcrumb-item:hover .pea-item-icon svg' => 'fill: {{VALUE}};'
                    ],
                ]);
                $this->add_control( 'item_icon_bg_hover_final', [
                    'label' => 'Background Color',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [ '{{WRAPPER}} .pea-breadcrumb-item:hover .pea-item-icon' => 'background-color: {{VALUE}};' ],
                ]);
            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        echo '<nav class="pea-breadcrumb-wrapper" style="display: flex; align-items: center; flex-wrap: wrap;">';

        // --- 1. HOME ITEM ---
        if ( 'yes' === $settings['show_home_page'] ) {
            echo '<span class="pea-breadcrumb-item home">';
            echo '<a href="' . esc_url( home_url( '/' ) ) . '" style="display: inline-flex; align-items: center; text-decoration: none; color: inherit;">';
            if ( 'icon' === $settings['home_prefix_type'] && 'yes' === $settings['show_home_icon'] ) {
                echo '<span class="pea-home-special-icon">'; 
                    Icons_Manager::render_icon( $settings['home_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
            }else if( 'text' === $settings['home_prefix_type'] && !empty($settings['home_prefix_text']) ) {
                echo '<span class="pea-breadcrumb-text-prefix">' . esc_html($settings['home_prefix_text']) . '</span>';
            }
            echo '<span class="pea-breadcrumb-text">' . esc_html($settings['home_text']) . '</span>';
            echo '</a></span>';
        }

        // --- 2. DYNAMIC CONTENT ---
        if ( is_page() || is_single() ) {
            // Separator
            $separator_html = '';
            if ( 'icon' === $settings['separator_type'] ) {
                ob_start();
                Icons_Manager::render_icon( $settings['separator_icon'], [ 'aria-hidden' => 'true' ] );
                $separator_html = ob_get_clean();
            } else {
                $separator_html = esc_html( $settings['separator_text'] );
            }
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo '<span class="pea-breadcrumb-separator">' . $separator_html . '</span>';

            // Current Page Item
            echo '<span class="pea-breadcrumb-item current" style="display: inline-flex; align-items: center;">';
            if ( 'yes' === $settings['show_item_icon'] && ! empty( $settings['item_icon']['value'] ) ) {
                echo '<span class="pea-item-icon">';
                Icons_Manager::render_icon( $settings['item_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
            }
            echo '<span class="pea-breadcrumb-text">' . wp_kses_post(get_the_title()) . '</span>';
            echo '</span>';
        }

        echo '</nav>';
    }
}