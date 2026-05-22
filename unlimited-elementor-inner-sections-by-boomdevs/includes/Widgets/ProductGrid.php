<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use WP_Query;

if (!defined('ABSPATH')) {
    exit;
}

class ProductGrid extends Widget_Base
{
    public function get_name()
    {
        return 'pea_product_grid';
    }

    public function get_title()
    {
        return esc_html__('Product Grid', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon()
    {
        return 'pea_post_grid_icon';
    }

    public function get_categories()
    {
        return ['prime-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['product', 'grid', 'woocommerce', 'shop'];
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--product-grid'];
    }

    public function get_script_depends()
    {
        return ['prime-elementor-addons--product-grid'];
    }

    protected function register_controls()
    {
        // ==================== General ====================
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'preset',
            [
                'label' => esc_html__('Preset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'preset-1',
                'options' => [
                    'preset-1' => esc_html__('Preset 1', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-2' => esc_html__('Preset 2', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-3' => esc_html__('Preset 3', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-4' => esc_html__('Preset 4', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-5' => esc_html__('Preset 5', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-6' => esc_html__('Preset 6', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'open_product_new_tab',
            [
                'label' => esc_html__('Open Product Link in New Tab', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__('Show Category', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_description',
            [
                'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label' => esc_html__('Show Price', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_reviews',
            [
                'label' => esc_html__('Show Rating', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_quick_view',
            [
                'label' => esc_html__('Show Quick View', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'grid_columns',
            [
                'label' => esc_html__('Grid Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'desktop_default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => 'One',
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four',
                    '5' => 'Five',
                    '6' => 'Six',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-widget' => '--pea-grid-columns: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'row_gap',
            [
                'label' => esc_html__('Row Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-widget' => '--pea-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_control(
            'column_gap',
            [
                'label' => esc_html__('Column Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-widget' => '--pea-column-gap: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
            ]
        );

        // $this->add_control(
        //     'image_fit',
        //     [
        //         'label' => esc_html__('Image Fit', 'unlimited-elementor-inner-sections-by-boomdevs'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'cover',
        //         'options' => [
        //             'fill' => esc_html__('Fill', 'unlimited-elementor-inner-sections-by-boomdevs'),
        //             'contain' => esc_html__('Contain', 'unlimited-elementor-inner-sections-by-boomdevs'),
        //             'cover' => esc_html__('Cover', 'unlimited-elementor-inner-sections-by-boomdevs'),
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .pea-product-grid-thumb img' => 'object-fit: {{VALUE}};',
        //         ],
        //         'render_type' => 'ui',
        //         'description' => 'Not applicable for preset 5',
        //         'separator' => 'before',
        //     ]
        // );

        $this->end_controls_section();

        // ==================== Products Query ====================
        $this->start_controls_section(
            'section_products',
            [
                'label' => esc_html__('Products Query', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Products Limit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 100,
            ]
        );

        $this->add_control(
            'products_filter',
            [
                'label' => esc_html__('Product Source', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['all'],
                'options' => [
                    'all' => esc_html__('All Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'featured' => esc_html__('Featured Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'sale' => esc_html__('On Sale Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'best-selling' => esc_html__('Best Selling Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'top-rated' => esc_html__('Top Rated Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'exclude_product_ids',
            [
                'label' => esc_html__('Exclude Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_product_options(), // ✅ add this
            ]
        );

        $this->add_control(
            'product_categories',
            [
                'label' => esc_html__('Filter by Categories', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_category_options(),
                'description' => esc_html__('Leave empty to show all categories.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'title' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'menu_order' => esc_html__('Menu Order', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'rand' => esc_html__('Random', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__('DESCENDING', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'ASC' => esc_html__('ASCENDING', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->end_controls_section();

        // ==================== Badge ====================
        $this->start_controls_section(
            'section_badge',
            [
                'label' => esc_html__('Badge', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => 'New',
            ]
        );

        $this->add_control(
            'badge_product_ids',
            [
                'label' => esc_html__('Badge Products', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_product_options(), // ✅ THIS is the fix
            ]
        );

        $this->end_controls_section();

        // ==================== CTA Button ====================
        $this->start_controls_section(
            'section_cta_button',
            [
                'label' => esc_html__('CTA Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_cta_button',
            [
                'label' => esc_html__('Show CTA Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label' => esc_html__('Custom CTA Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Leave empty for default text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cta_added_text',
            [
                'label' => esc_html__('Custom CTA Added to Cart Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Added', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // ==================== Layout ====================
        $this->start_controls_section(
            'section_card_layout_style',
            [
                'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_background_heading',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs('card_background_style_tabs');

        $this->start_controls_tab(
            'card_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'card_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-item:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'card_spacing_heading',
            [
                'label' => esc_html__('Card Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_heading',
            [
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('card_border_style_tabs');

        $this->start_controls_tab(
            'card_border_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'card_border_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'card_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'card_box_shadow_heading',
            [
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('card_box_shadow_style_tabs');

        $this->start_controls_tab(
            'card_box_shadow_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'card_box_shadow_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-item:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        //------------- Content ----------------
        $this->start_controls_section(
            'section_card_content_style',
            [
                'label' => esc_html__('Content', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'typography_heading',
            [
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-title, {{WRAPPER}} .pea-product-grid-title a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__('Price', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-price',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'reviews_typography',
                'label' => esc_html__('Reviews', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-rating',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__('Category', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-categories, {{WRAPPER}} .pea-product-grid-categories a',
            ]
        );

        $this->add_control(
            'title_color_heading',
            [
                'label' => esc_html__('Title Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('title_color_style_tabs');

        $this->start_controls_tab('title_color_normal_tab', ['label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-title, {{WRAPPER}} .pea-product-grid-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('title_color_hover_tab', ['label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-title, {{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'regular_price_color_heading',
            [
                'label' => esc_html__('Regular Price Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('regular_price_color_style_tabs');

        $this->start_controls_tab('regular_price_color_normal_tab', ['label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'regular_price_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-price > .woocommerce-Price-amount, {{WRAPPER}} .pea-product-grid-price del, {{WRAPPER}} .pea-product-grid-price del .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('regular_price_color_hover_tab', ['label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'regular_price_hover_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-price > .woocommerce-Price-amount, {{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-price del, {{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-price del .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'sale_price_color_heading',
            [
                'label' => esc_html__('Sale Price Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('sale_price_color_style_tabs');

        $this->start_controls_tab('sale_price_color_normal_tab', ['label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'sale_price_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-price ins, {{WRAPPER}} .pea-product-grid-price ins .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('sale_price_color_hover_tab', ['label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'sale_price_hover_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-price ins, {{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-price ins .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'reviews_color_heading',
            [
                'label' => esc_html__('Reviews Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('reviews_color_style_tabs');

        $this->start_controls_tab('reviews_color_normal_tab', ['label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'reviews_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-rating' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-product-grid-rating-stars-base' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('reviews_color_hover_tab', ['label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'reviews_hover_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-rating' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-rating-stars-base' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'category_color_heading',
            [
                'label' => esc_html__('Category Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('category_color_style_tabs');

        $this->start_controls_tab('category_color_normal_tab', ['label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'category_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-categories, {{WRAPPER}} .pea-product-grid-categories a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('category_color_hover_tab', ['label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs')]);

        $this->add_control(
            'category_hover_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-categories, {{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-categories a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'content_background_heading',
            [
                'label' => esc_html__('Content Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('content_background_style_tabs');

        $this->start_controls_tab(
            'content_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-content',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_border_heading',
            [
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('content_border_style_tabs');

        $this->start_controls_tab(
            'content_border_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_border_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'content_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-content:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        //------------- Badge ----------------
        $this->start_controls_section(
            'section_card_badge_style',
            [
                'label' => esc_html__('Badge', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_typography_heading',
            [
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => esc_html__('Badge Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-badge',
            ]
        );

        $this->add_control(
            'badge_text_color_heading',
            [
                'label' => esc_html__('Badge Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('badge_text_color_style_tabs');

        $this->start_controls_tab(
            'badge_text_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'badge_text_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'badge_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'badge_background_heading',
            [
                'label' => esc_html__('Badge Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('badge_background_style_tabs');

        $this->start_controls_tab(
            'badge_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'badge_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-badge',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'badge_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'badge_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-item:hover .pea-product-grid-badge',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        //------------- CTA Button ----------------
        $this->start_controls_section(
            'section_card_cta_style',
            [
                'label' => esc_html__('CTA Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cta_typography_heading',
            [
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-cart-button, {{WRAPPER}} .pea-product-grid-view-button',
            ]
        );

        $this->add_control(
            'cta_background_heading',
            [
                'label' => esc_html__('CTA Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('cta_background_style_tabs');

        $this->start_controls_tab(
            'cta_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cta_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-cart-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'cta_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cta_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-cart-button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'cta_added_background_heading',
            [
                'label' => esc_html__('CTA Added Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cta_added_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-cart-button.added',
            ]
        );

        $this->add_control(
            'cta_text_color_heading',
            [
                'label' => esc_html__('CTA Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('cta_text_color_style_tabs');

        $this->start_controls_tab(
            'cta_text_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'cta_text_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-cart-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'cta_text_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'cta_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-cart-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'cart_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-cart-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cart_button_border_heading',
            [
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('cart_button_border_style_tabs');

        $this->start_controls_tab(
            'cart_button_border_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cart_button_border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-product-grid-cart-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'cart_button_border_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'cart_button_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-cart-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        //------------- View Product Button ----------------
        $this->start_controls_section(
            'section_card_view_product_style',
            [
                'label' => esc_html__('View Product Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'view_product_heading',
            [
                'label' => esc_html__('View Product Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('view_product_style_tabs');

        $this->start_controls_tab(
            'view_product_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'view_product_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-view-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_product_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'view_product_hover_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-view-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'view_product_background_heading',
            [
                'label' => esc_html__('View Product Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('view_product_background_style_tabs');

        $this->start_controls_tab(
            'view_product_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'view_product_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-view-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_product_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'view_product_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-product-grid-view-button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        //------------- Quick View ----------------
        $this->start_controls_section(
            'section_card_quick_view_style',
            [
                'label' => esc_html__('Quick View', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quick_view_heading',
            [
                'label' => esc_html__('Quick View Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('quick_view_style_tabs');

        $this->start_controls_tab(
            'quick_view_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'quick_view_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-quick-view' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'quick_view_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'quick_view_hover_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-quick-view:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'quick_view_background_heading',
            [
                'label' => esc_html__('Quick View Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('quick_view_background_style_tabs');

        $this->start_controls_tab(
            'quick_view_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'quick_view_background_color',
            [
                'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea-product-grid-quick-view' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'quick_view_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
        'quick_view_hover_background_color',
        [
            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .pea-product-grid-quick-view:hover' => 'background-color: {{VALUE}};',
            ],
        ]
    );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        if (!class_exists('WooCommerce')) {
            echo '<p class="pea-product-grid-message">' . esc_html__('WooCommerce is required to use this widget.', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        $settings = $this->get_settings_for_display();
        $query = new WP_Query($this->get_query_args($settings));
        $preset = $this->get_active_preset($settings);

        if (!$query->have_posts()) {
            echo '<p class="pea-product-grid-message">' . esc_html__('No products found.', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        echo '<div class="pea-product-grid-widget pea-' . esc_attr($preset) . '">';
        echo '<ul class="pea-product-grid-list">';

        while ($query->have_posts()) {
            $query->the_post();

            $product = wc_get_product(get_the_ID());
            if (!$product) {
                continue;
            }

            echo $this->render_product_card($product, $settings); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

        echo '</ul>';
        echo '</div>';

        wp_reset_postdata();
    }

    // ==================== Preset Helpers ====================
    private function get_active_preset($settings)
    {
        $preset = sanitize_key((string) ($settings['preset'] ?? 'preset-1'));

        if (in_array($preset, ['preset-1', 'preset-2', 'preset-3', 'preset-4', 'preset-5', 'preset-6'], true)) {
            return $preset;
        }

        return 'preset-1';
    }

    private function get_category_options()
    {
        $options = [];
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
        ]);

        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->term_id] = $category->name;
            }
        }

        return $options;
    }

    // ==================== Query Helpers ====================
    private function get_query_args($settings)
    {
        $products_limit = max(1, absint($settings['posts_per_page'] ?? 6));
        $orderby = sanitize_key((string) ($settings['orderby'] ?? 'date'));
        $order = strtoupper((string) ($settings['order'] ?? 'DESC')) === 'ASC' ? 'ASC' : 'DESC';
        $products_filter = $settings['products_filter'] ?? ['all'];
        $exclude_product_ids = $this->parse_ids($settings['exclude_product_ids'] ?? '');

        // Normalize to array
        if (!is_array($products_filter)) {
            $products_filter = [$products_filter];
        }

        // If 'all' is selected, ignore other filters
        if (in_array('all', $products_filter)) {
            $products_filter = ['all'];
        }

        if (!in_array($orderby, ['date', 'title', 'menu_order', 'rand'], true)) {
            $orderby = 'date';
        }

        $query_args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $products_limit,
            'orderby'        => $orderby,
            'order'          => $order,
        ];

        // EXCLUDE EARLY (cleaner mental flow)
        if (!empty($exclude_product_ids)) {
            $query_args['post__not_in'] = $exclude_product_ids;
        }

        $product_categories = $settings['product_categories'] ?? [];
        if (!empty($product_categories)) {
            if (!isset($query_args['tax_query'])) {
                $query_args['tax_query'] = [];
            }
            $query_args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $product_categories,
            ];
        }

        // Handle filters
        if (!in_array('all', $products_filter)) {
            $tax_queries = [];

            foreach ($products_filter as $filter) {
                switch ($filter) {
                    case 'featured':
                        $tax_queries[] = [
                            'taxonomy' => 'product_visibility',
                            'field' => 'name',
                            'terms' => ['featured'],
                        ];
                        break;

                    case 'sale':
                        $sale_product_ids = wc_get_product_ids_on_sale();
                        $existing_in = $query_args['post__in'] ?? [];
                        $query_args['post__in'] = !empty($existing_in) 
                            ? array_intersect($existing_in, $sale_product_ids) 
                            : $sale_product_ids;
                        
                        if (empty($query_args['post__in'])) {
                            $query_args['post__in'] = [0];
                        }
                        break;

                    case 'best-selling':
                        $query_args['meta_key'] = 'total_sales';
                        $query_args['orderby'] = 'meta_value_num';
                        $query_args['order'] = 'DESC';
                        break;

                    case 'top-rated':
                        $query_args['meta_key'] = '_wc_average_rating';
                        $query_args['orderby'] = 'meta_value_num';
                        $query_args['order'] = 'DESC';
                        break;
                }
            }

            if (!empty($tax_queries)) {
                $tax_queries['relation'] = 'AND';
                if (!isset($query_args['tax_query'])) {
                    $query_args['tax_query'] = [];
                }

                $query_args['tax_query'] = array_merge(
                    $query_args['tax_query'],
                    $tax_queries
                );
            }
        }

        return $query_args;
    }

    private function parse_ids($value)
    {
        if (is_array($value)) {
            $ids = array_map('absint', $value);
            $ids = array_filter($ids, function ($id) {
                return $id > 0;
            });

            return array_values(array_unique($ids));
        }

        if (!is_string($value) || trim($value) === '') {
            return [];
        }

        $ids = array_map('absint', array_map('trim', explode(',', $value)));
        $ids = array_filter($ids, function ($id) {
            return $id > 0;
        });

        return array_values(array_unique($ids));
    }

    private function get_product_options()
    {
        $products = get_posts([
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 200, // LIMIT SAFE
            'orderby'        => 'title',
            'order'          => 'ASC',
            'fields'         => 'ids', // lighter query
        ]);

        $options = [];

        foreach ($products as $product_id) {
            $options[$product_id] = get_the_title($product_id) . ' (#' . $product_id . ')';
        }

        return $options;
    }

    // ==================== Markup Helpers ====================
    private function render_product_card($product, $settings)
    {
        $product_id = $product->get_id();
        $product_link = get_permalink($product_id);
        $product_title = get_the_title($product_id);
        $product_link_attrs = $this->get_product_link_attrs($settings);
        $product_image = $this->get_product_image($product_id, $product_title);

        $html = '<li class="pea-product-grid-item">';

        if ($this->should_render_badge($product, $settings)) {
            $html .= '<span class="pea-product-grid-badge">';
            $html .= esc_html(trim((string) $settings['badge_text']));
            $html .= '</span>';
        }

        $html .= '<a class="pea-product-grid-thumb" href="' . esc_url($product_link) . '"' . $product_link_attrs . '>';
        $html .= $product_image;

        if (($settings['show_quick_view'] ?? '') === 'yes') {
            $html .= '<button class="pea-product-grid-quick-view" type="button" data-product-id="' . esc_attr((string) $product_id) . '" aria-label="' . esc_attr__('Quick View', 'unlimited-elementor-inner-sections-by-boomdevs') . '">';
            $html .= esc_html__('Quick View', 'unlimited-elementor-inner-sections-by-boomdevs');
            $html .= '</button>';
        }

        $html .= '</a>';

        $html .= '<div class="pea-product-grid-content">';

        $html .= '<div class="pea-product-grid-main">';

        $preset = $this->get_active_preset($settings);

        if (($settings['show_category'] ?? 'yes') === 'yes') {
            if ($preset === 'preset-4') {
                $html .= $this->render_product_categories($product_id);
            }
        }

        if (($settings['show_title'] ?? 'yes') === 'yes') {
            $html .= '<h3 class="pea-product-grid-title"><a href="' . esc_url($product_link) . '"' . $product_link_attrs . '>' . esc_html($product_title) . '</a></h3>';
        }

        if (($settings['show_description'] ?? '') === 'yes') {
            $html .= '<div class="pea-product-grid-description">' . wp_kses_post(get_the_excerpt($product_id)) . '</div>';
        }

        $price_html = $product->get_price_html();

        if (in_array($preset, ['preset-1', 'preset-6'], true)) {

            $html .= '<div class="pea-product-grid-price-rating-row">';

            if (($settings['show_price'] ?? 'yes') === 'yes' && $price_html !== '') {
                $html .= '<div class="pea-product-grid-price">' . wp_kses_post($price_html) . '</div>';
            }

            if ($preset === 'preset-1' && $this->should_render_reviews($settings)) {
                $html .= $this->render_product_rating($product, $settings);
            }

            $html .= '</div>';

        } else {

            if (($settings['show_price'] ?? 'yes') === 'yes' && $price_html !== '') {
                $html .= '<div class="pea-product-grid-price">' . wp_kses_post($price_html) . '</div>';
            }

            if ($this->should_render_reviews($settings)) {
                $html .= $this->render_product_rating($product, $settings);
            }
        }

        $html .= '</div>';

        if ($preset === 'preset-3') {
            $html .= '<div class="pea-product-grid-actions">';
            $html .= $this->render_view_product_button($product_link, $settings);
            if (($settings['show_cta_button'] ?? 'yes') === 'yes') {
                $html .= $this->render_add_to_cart_button($product, $settings);
            }
            $html .= '</div>';
        } else {
            if (($settings['show_cta_button'] ?? 'yes') === 'yes') {
                $html .= $this->render_add_to_cart_button($product, $settings);
            }
        }

        $html .= '</div>';
        $html .= '</li>';

        return $html;
    }

    private function render_product_categories($product_id)
    {
        $category_list = wc_get_product_category_list($product_id);

        if ($category_list === '') {
            return '';
        }

        return '<div class="pea-product-grid-categories">' . wp_kses_post($category_list) . '</div>';
    }

    private function get_product_link_attrs($settings)
    {
        if (($settings['open_product_new_tab'] ?? '') !== 'yes') {
            return '';
        }

        return ' target="_blank" rel="noopener noreferrer"';
    }

    private function should_render_badge($product, $settings)
    {
        $badge_text = trim((string) ($settings['badge_text'] ?? ''));

        if ($badge_text === '') {
            return false;
        }

        $badge_product_ids = array_map(
            'absint',
            (array) ($settings['badge_product_ids'] ?? [])
        );

        $badge_product_ids = array_map('intval', $badge_product_ids);

        return in_array((int) $product->get_id(), $badge_product_ids, true);
    }

    private function should_render_reviews($settings)
    {
        return ($settings['show_reviews'] ?? 'yes') === 'yes';
    }

    private function get_product_image($product_id, $product_title)
    {
        $product_image = get_the_post_thumbnail(
            $product_id,
            'woocommerce_thumbnail',
            [
                'class' => 'pea-product-grid-image',
                'alt' => $product_title,
            ]
        );

        if ($product_image !== '') {
            return $product_image;
        }

        return wc_placeholder_img('woocommerce_thumbnail', ['class' => 'pea-product-grid-image']);
    }

    private function render_product_rating($product, $settings)
    {
        $preset = $this->get_active_preset($settings);

        $average_rating = (float) $product->get_average_rating();
        $rating_count = (int) $product->get_rating_count();
        $rating_value = number_format($average_rating, 1);
        $rating_width = max(0, min(100, ($average_rating / 5) * 100));

        $html = '<div class="pea-product-grid-rating">';

        if ($preset !== 'preset-1') {
            $html .= '<span class="pea-product-grid-rating-value">' . esc_html($rating_value) . '</span>';
        }

        $html .= '<span class="pea-product-grid-rating-stars" aria-hidden="true">';
        $html .= '<span class="pea-product-grid-rating-stars-base">★★★★★</span>';
        $html .= '<span class="pea-product-grid-rating-stars-fill" style="width:' . esc_attr((string) $rating_width) . '%;">★★★★★</span>';
        $html .= '</span>';

        if ($preset !== 'preset-1') {
            $html .= '<span class="pea-product-grid-rating-count">(' . esc_html((string) $rating_count) . ')</span>';
        }

        $html .= '</div>';

        return $html;
    }

    private function render_add_to_cart_button($product, $settings)
    {
        $button_classes = [
            'button',
            'pea-product-grid-cart-button',
            'product_type_' . $product->get_type(),
        ];

        if ($product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock()) {
            $button_classes[] = 'add_to_cart_button';
            $button_classes[] = 'ajax_add_to_cart';
        }

        $button_text = $this->get_product_button_text($product, $settings);

        $attributes = [
            'href' => $this->get_product_button_url($product),
            'data-quantity' => '1',
            'class' => implode(' ', array_map('sanitize_html_class', $button_classes)),
            'data-product_id' => (string) $product->get_id(),
            'data-product_sku' => (string) $product->get_sku(),
            'data-pea-default-text' => $button_text,
            'data-pea-processing-text' => esc_html__('Processing', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'data-pea-added-text' => esc_html(trim((string) ($settings['cta_added_text'] ?? '')) ?: esc_html__('Added', 'unlimited-elementor-inner-sections-by-boomdevs')),
            'aria-label' => wp_strip_all_tags($product->add_to_cart_description()),
            'rel' => 'nofollow',
        ];

        return sprintf(
            '<a %1$s>%2$s</a>',
            wc_implode_html_attributes($attributes),
            esc_html($button_text)
        );
    }

    private function render_view_product_button($product_link, $settings)
    {
        return sprintf(
            '<a class="button pea-product-grid-view-button" href="%1$s"%2$s>%3$s</a>',
            esc_url($product_link),
            $this->get_product_link_attrs($settings),
            esc_html__('View Product', 'unlimited-elementor-inner-sections-by-boomdevs')
        );
    }

    private function get_product_button_url($product)
    {
        return $product->add_to_cart_url();
    }

    private function get_product_button_text($product, $settings)
    {
        $custom_cta_text = trim((string) ($settings['cta_text'] ?? ''));

        if ($custom_cta_text !== '' && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) {
            return $custom_cta_text;
        }

        return $product->add_to_cart_text();
    }
}
