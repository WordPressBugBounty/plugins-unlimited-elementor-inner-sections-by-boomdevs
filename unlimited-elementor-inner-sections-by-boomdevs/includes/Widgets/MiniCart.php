<?php

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Controls\GradientTextControl;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;


if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class MiniCart extends Widget_Base
{

    public function get_name()
    {
        return 'pea_mini_cart';
    }

    public function get_title()
    {
        return esc_html__('Mini Cart', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon()
    {
        return 'eicon-cart-medium';
    }

    public function get_categories()
    {
        return ['prime-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['mini', 'cart', 'woocommerce', 'product', 'shop'];
    }

    public function get_script_depends()
    {
        return ['prime-elementor-addons--mini-cart'];
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--mini-cart'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'pea_mini_cart_general_section',
            [
                'label' => esc_html__('General', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_panel_height',
            [
                'label' => esc_html__('Height In px', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_items' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_content_panel_align',
            [
                'label' => esc_html__('Content Panel Align', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right' => esc_html__('Right', 'prime-elementor-addons-pro'),
                    'left'  => esc_html__('Left', 'prime-elementor-addons-pro'),
                ],
                'selectors_dictionary' => [
                    'right' => 'right: 0;',
                    'left'  => 'left: 0; ',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_content_wrapper' => '{{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_button_trigger_button_section',
            [
                'label' => esc_html__('Trigger Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_show_badge',
            [
                'label' => esc_html__('Show Badge', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'prime-elementor-addons-pro'),
                'label_off' => esc_html__('Hide', 'prime-elementor-addons-pro'),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_content_type',
            [
                'label' => esc_html__('Content Type', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'prime-elementor-addons-pro'),
                    'text' => esc_html__('Text', 'prime-elementor-addons-pro')
                ]
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_icon',
            [
                'label' => esc_html__('Icon', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-shopping-cart',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'pea_mini_cart_trigger_button_content_type' => ['icon']
                ]
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_text',
            [
                'label' => esc_html__('Text', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Cart', 'prime-elementor-addons-pro'),
                'condition' => [
                    'pea_mini_cart_trigger_button_content_type' => ['text']
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'pea_mini_cart_delete_button_section',
            [
                'label' => esc_html__('Delete Button', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_delete_button_content_type',
            [
                'label' => esc_html__('Content Type', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'prime-elementor-addons-pro'),
                    'text' => esc_html__('Text', 'prime-elementor-addons-pro')
                ]
            ]
        );

        $this->add_control(
            'pea_mini_cart_delete_button_icon',
            [
                'label' => esc_html__('Icon', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'pea_mini_cart_delete_button_content_type' => ['icon']
                ]
            ]
        );

        $this->add_control(
            'pea_mini_cart_delete_button_text',
            [
                'label' => esc_html__('Text', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Remove', 'prime-elementor-addons-pro'),
                'condition' => [
                    'pea_mini_cart_delete_button_content_type' => ['text']
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_product_item_style_section',
            [
                'label' => esc_html__('Product Item', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_product_item_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_product_item_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_product_item_background',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_product_item_box_shadow',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_mini_cart_product_item_border',
                'label' => esc_html__('Border', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_product_item_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_product_item_background_hover',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_item:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_product_item_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_item:hover',
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_item_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_mini_cart_product_item_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_item_margin',
            [
                'label' => esc_html__('Margin', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_item_padding',
            [
                'label' => esc_html__('Padding', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_trigger_button_badge_style_section',
            [
                'label' => esc_html__('Trigger Button Badge', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_mini_cart_trigger_button_badge_typography',
                'label' => esc_html__('Typography', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_badge',
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_size',
            [
                'label' => esc_html__('Size', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_badge' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_trigger_button_badge_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_trigger_button_badge_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_text_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_trigger_button_badge_background',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_trigger_button_badge_box_shadow',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_mini_cart_trigger_button_badge_border',
                'label' => esc_html__('Border', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_badge',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_trigger_button_badge_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_text_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_button_wrapper:hover .pea_mini_cart_badge' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_trigger_button_badge_background_hover',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_button_wrapper:hover .pea_mini_cart_badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_trigger_button_badge_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_button_wrapper:hover .pea_mini_cart_badge',
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_border_hover',
            [
                'label' => esc_html__('Border Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_button_wrapper:hover .pea_mini_cart_badge' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_border_radius',
            [
                'label' => esc_html__('Border Radius', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_padding',
            [
                'label' => esc_html__('Padding', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_position_heading',
            [
                'label' => esc_html__('Badge Position', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_top_bottom_position',
            [
                'label' => esc_html__('Top / Bottom', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_trigger_button_badge_left_right_position',
            [
                'label' => esc_html__('Left / Right', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_badge' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_product_style_section',
            [
                'label' => esc_html__('Product Title', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_mini_cart_product_text_typography',
                'selector' => '{{WRAPPER}} .pea_mini_cart_item_name',
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_product_text_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_product_text_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_text_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_product_text_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_text_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_name:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_product_quantity_style_section',
            [
                'label' => esc_html__('Product Quantity', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_mini_cart_product_quantity_typography',
                'selector' => '{{WRAPPER}} .pea_mini_cart_item_price',
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_product_quantity_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_product_quantity_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_quantity_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_product_quantity_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_quantity_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_price:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_product_price_style_section',
            [
                'label' => esc_html__('Product Price', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_mini_cart_product_price_typography',
                'selector' => '{{WRAPPER}} .pea_mini_cart_item_price .woocommerce-Price-amount',
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_product_price_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_product_price_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_price_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_price .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_product_price_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_product_price_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_price .woocommerce-Price-amount:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart__item_image_style_section',
            [
                'label' => esc_html__('Product Image', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_width',
            [
                'label' => esc_html__('Width', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_height',
            [
                'label' => esc_html__('Height', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart__item_image_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart__item_image_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_bg_color',
            [
                'label' => esc_html__('Background Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_mini_cart__item_image_border',
                'label' => esc_html__('Border', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_item_image',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart__item_image_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_mini_cart__item_image_diviider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_padding',
            [
                'label' => esc_html__('Padding', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart__item_image_margin',
            [
                'label' => esc_html__('Margin', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_footer_text_style_section',
            [
                'label' => esc_html__('Footer Text', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_mini_cart_footer_subtotal_amount_typography',
                'selector' => '{{WRAPPER}} .pea_mini_cart_subtotal',
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_footer_subtotal_amount_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_footer_subtotal_amount_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_footer_subtotal_amount_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_subtotal' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_footer_subtotal_amount_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_footer_subtotal_amount_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_subtotal:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_box_item_delete_button_style_section',
            [
                'label' => esc_html__('Cart Box Delete Button', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // $this->add_control(
        //     'pea_mini_cart_box_delete_button_position',
        //     [
        //         'label' => esc_html__('Icon Position', 'prime-elementor-addons-pro'),
        //         'type' => Controls_Manager::SELECT,
        //         'options' => [
        //             'row-reverse' => esc_html__('Left', 'prime-elementor-addons-pro'),
        //             'row' => esc_html__('Right', 'prime-elementor-addons-pro'),
        //         ],
        //         'default' => 'row',
        //         'selectors' => [
        //             '{{WRAPPER}} .pea-wmc-popup-header' => 'flex-direction: {{VALUE}};',
        //         ],
        //     ]
        // );

        $this->add_control(
            'pea_mini_cart_box_delete_button_size',
            [
                'label' => esc_html__('Button Size', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_icon_size',
            [
                'label' => esc_html__('Icon Size', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove svg , {{WRAPPER}} .pea_mini_cart_item_remove i' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_box_delete_icon_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_box_delete_icon_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_icon_bg_color',
            [
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_icon_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove i , {{WRAPPER}} .pea_mini_cart_item_remove svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_box_delete_icon_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_icon_bg_color_hover',
            [
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    ' {{WRAPPER}} .pea_mini_cart_item_remove:hover ' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_icon_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .pea_mini_cart_item_remove:hover i , {{WRAPPER}}  .pea_mini_cart_item_remove:hover svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_mini_cart_box_delete_icon_button_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pea_mini_cart_box_delete_button_padding',
            [
                'label' => esc_html__('Padding', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_box_delete_button_margin',
            [
                'label' => esc_html__('Margin', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_item_remove' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_footer_view_button_section_style',
            [
                'label' => esc_html__('View Cart Button', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_view_button_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_view_button_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_view_button_background',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_view_cart',
            ]
        );

        $this->add_control(
            'pea_mini_cart_view_button_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_view_cart' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_view_button_box_shadow',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_view_cart',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_mini_cart_view_button_border',
                'label' => esc_html__('Border', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_view_cart',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_view_button_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_view_button_background_hover',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_view_cart:hover',
            ]
        );

        $this->add_control(
            'pea_mini_cart_view_button_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_view_cart:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_view_button_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_view_cart:hover',
            ]
        );

        $this->add_control(
            'pea_mini_cart_view_button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_view_cart:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_mini_cart_view_button_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_mini_cart_view_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_view_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_view_button_margin',
            [
                'label' => esc_html__('Margin', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_view_cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_view_button_padding',
            [
                'label' => esc_html__('Padding', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_view_cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_mini_cart_footer_checkout_button_section_style',
            [
                'label' => esc_html__('Checkout Button', 'prime-elementor-addons-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'pea_mini_cart_checkout_button_style_tabs'
        );

        $this->start_controls_tab(
            'pea_mini_cart_checkout_button_style_normal',
            [
                'label' => esc_html__('Normal', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_checkout_button_background',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_checkout',
            ]
        );

        $this->add_control(
            'pea_mini_cart_checkout_button_color',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_checkout' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_checkout_button_box_shadow',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_checkout',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_mini_cart_checkout_button_border',
                'label' => esc_html__('Border', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_checkout',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_mini_cart_checkout_style_hover',
            [
                'label' => esc_html__('Hover', 'prime-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_mini_cart_checkout_background_hover',
                'label' => esc_html__('Background', 'prime-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea_mini_cart_checkout:hover',
            ]
        );

        $this->add_control(
            'pea_mini_cart_checkout_button_color_hover',
            [
                'label' => esc_html__('Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_checkout:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_mini_cart_checkout_button_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'prime-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .pea_mini_cart_checkout:hover',
            ]
        );

        $this->add_control(
            'pea_mini_cart_checkout_button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_checkout:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_mini_cart_checkout_button_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_mini_cart_checkout_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_checkout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_checkout_button_margin',
            [
                'label' => esc_html__('Margin', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_checkout' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_mini_cart_checkout_button_padding',
            [
                'label' => esc_html__('Padding', 'prime-elementor-addons-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_mini_cart_checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the mini cart content wrapper inner HTML
     *
     * @return string
     */
    public static function get_mini_cart_inner_content_html($delete_button_content_type = 'icon', $delete_button_icon = [], $delete_button_text = '')
    {
        if (! class_exists('WooCommerce')) {
            return '';
        }

        if (null === WC()->cart) {
            wc_load_cart();
        }

        $cart_items = WC()->cart->get_cart();
        $cart_subtotal = WC()->cart->get_cart_subtotal();

        ob_start();

        if (empty($cart_items)) : ?>

            <!-- Empty Cart -->
            <div class="pea_mini_cart_empty">
                <p><?php esc_html_e('Your cart is empty.', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></p>
            </div>

        <?php else : ?>

            <!-- Cart Items -->
            <div class="pea_mini_cart_items">
                <?php foreach ($cart_items as $cart_item_key => $cart_item) :
                    $product   = $cart_item['data'];
                    $quantity  = $cart_item['quantity'];
                    $product_id = $cart_item['product_id'];
                ?>

                    <div class="pea_mini_cart_item">

                        <!-- Product Image -->
                        <div class="pea_mini_cart_item_image">
                            <a href="<?php echo esc_url(get_permalink($product_id)); ?>">
                                <?php echo wp_kses_post($product->get_image('thumbnail')); ?>
                            </a>
                        </div>

                        <!-- Product Info -->
                        <div class="pea_mini_cart_item_info">

                            <!-- Name -->
                            <a class="pea_mini_cart_item_name" href="<?php echo esc_url(get_permalink($product_id)); ?>">
                                <?php echo esc_html($product->get_name()); ?>
                            </a>

                            <!-- Quantity x Price -->
                            <span class="pea_mini_cart_item_price">
                                <?php echo esc_html($quantity); ?>
                                x
                                <?php echo wp_kses_post(wc_price($product->get_price())); ?>
                            </span>
                        </div>

                        <!-- Remove Button -->
                        <a class="pea_mini_cart_item_remove"
                            href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                            data-product_id="<?php echo esc_attr($product_id); ?>"
                            data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>">

                            <?php if ($delete_button_content_type == 'text'): ?>
                                <?php echo esc_html($delete_button_text); ?>
                            <?php elseif ($delete_button_content_type == 'icon' && !empty($delete_button_icon)): ?>
                                <?php \Elementor\Icons_Manager::render_icon($delete_button_icon, ['aria-hidden' => 'true']); ?>
                            <?php else: ?>
                                &times;
                            <?php endif; ?>

                        </a>

                    </div>

                <?php endforeach; ?>
            </div>

            <!-- Subtotal -->
            <div class="pea_mini_cart_subtotal">
                <span><?php esc_html_e('Subtotal:', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></span>
                <span><?php echo wp_kses_post($cart_subtotal); ?></span>
            </div>

            <!-- Buttons -->
            <div class="pea_mini_cart_buttons">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="pea_mini_cart_view_cart">
                    <?php esc_html_e('View Cart', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>
                </a>
                <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="pea_mini_cart_checkout">
                    <?php esc_html_e('Checkout', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>
                </a>
            </div>
        <?php endif;

        return ob_get_clean();
    }

    protected function render()
    {


        if (! class_exists('WooCommerce')) {
            return;
        }

        $settings = $this->get_settings_for_display();

        // trigger button
        $badge = $settings['pea_mini_cart_trigger_button_show_badge'];
        $button_content_type = $settings['pea_mini_cart_trigger_button_content_type'];
        $button_icon = $settings['pea_mini_cart_trigger_button_icon'];
        $button_text = $settings['pea_mini_cart_trigger_button_text'];

        // delete button
        $delete_button_content_type = $settings['pea_mini_cart_delete_button_content_type'];
        $delete_button_icon = $settings['pea_mini_cart_delete_button_icon'];
        $delete_button_text = $settings['pea_mini_cart_delete_button_text'];

        $cart_items = [];
        $cart_count = 0;
        $cart_subtotal = '';
        $cart_url = wc_get_cart_url();
        $checkout_url = wc_get_checkout_url();

        if (function_exists('WC') && WC()->cart) {
            $cart_count = WC()->cart->get_cart_contents_count();
            $cart_subtotal = WC()->cart->get_cart_subtotal();
        } elseif (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $cart_count = 3;
            $cart_subtotal = '$29.99';
        }

        // Get the remove button HTML for JS template
        ob_start();
        if ($delete_button_content_type == 'text') {
            echo esc_html($delete_button_text);
        } elseif ($delete_button_content_type == 'icon') {
            \Elementor\Icons_Manager::render_icon($delete_button_icon, ['aria-hidden' => 'true']);
        }
        $remove_button_html = ob_get_clean();

        ?>

        <div class="pea_mini_cart_main_wrapper">
            <div class="pea_mini_cart_inner_wrapper" data-remove-html="<?php echo esc_attr($remove_button_html); ?>">

                <!-- button -->
                <div class="pea_mini_cart_button_wrapper">
                    <div class="pea_mini_cart_button_icon_wrap">
                        <?php if ($button_content_type == "text"): ?>

                            <span class="pea_mini_cart_button_text">
                                <?php echo esc_html($button_text); ?>
                            </span>

                        <?php elseif ($button_content_type == "icon"): ?>

                            <span class="pea_mini_cart_button_icon">
                                <?php \Elementor\Icons_Manager::render_icon($button_icon, ['aria-hidden' => 'true']); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($badge == "yes"): ?>
                            <span class="pea_mini_cart_badge">
                                <?php echo esc_html($cart_count); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <span class="pea_mini_cart_subtotal_amount"><?php echo wp_kses_post($cart_subtotal); ?></span>
                    </div>
                </div>

                <div class="pea_mini_cart_content_wrapper">
                    <?php echo self::get_mini_cart_inner_content_html($delete_button_content_type, $delete_button_icon, $delete_button_text); ?>
                </div>
            </div>
        </div>

<?php

    }
}
