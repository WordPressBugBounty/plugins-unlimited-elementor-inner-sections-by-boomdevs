<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class PostCategory extends Widget_Base
{
    public function get_name()
    {
        return 'pea_post_category';
    }

    public function get_title()
    {
        return esc_html__('Post Category', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon()
    {
        return 'pea_post_category_icon';
    }

    public function get_categories()
    {
        return ['prime-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['post', 'category', 'taxonomy', 'terms'];
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--post-category'];
    }

    /* ==================== Controls ==================== */

    protected function register_controls()
    {
        // ==================================================
        // General
        // ==================================================

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
            'show_author',
            [
                'label' => esc_html__('Show Author', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label' => esc_html__('Show Count', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_post_type_name_with_count',
            [
                'label' => esc_html__('Count With Post Type Name', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_count' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_description',
            [
                'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'description_excerpt_length',
            [
                'label' => esc_html__('Description Excerpt Length', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'max' => 200,
                'condition' => [
                    'show_description' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label' => esc_html__('Show Term Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Follow Preset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'yes' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'no' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'image_fallback_url',
            [
                'label' => esc_html__('Fallback Image URL', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => defined('PEA_PLUGIN_URL') ? PEA_PLUGIN_URL . 'assets/images/preset-bg.jpg' : '',
                'label_block' => true,
                'condition' => [
                    'show_image!' => 'no',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
        // Layout Settings
        // ==================================================
        
        $this->start_controls_section(
            'section_layout_settings',
            [
                'label' => esc_html__('Layout Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => esc_html__('Grid', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'list' => [
                        'title' => esc_html__('List', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                ],
                'default' => 'grid',
                'toggle' => false,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'grid_columns',
            [
                'label' => esc_html__('Grid Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['col'],
                'default' => [
                    'unit' => 'col',
                    'size' => 2,
                ],
                'range' => [
                    'col' => [
                        'min' => 1,
                        'max' => 6,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-widget' => '--pea-grid-columns: {{SIZE}};',
                ],
                'render_type' => 'ui',
                'condition' => [
                    'layout' => 'grid',
                ],
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
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-widget' => '--pea-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
                'condition' => [
                    'layout' => 'grid',
                ],
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
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-widget' => '--pea-column-gap: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'list_gap',
            [
                'label' => esc_html__('List Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-widget.pea-layout-list .pea-post-category-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
                'condition' => [
                    'layout' => 'list',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
        // Taxonomy
        // ==================================================

        $this->start_controls_section(
            'section_taxonomy',
            [
                'label' => esc_html__('Taxonomy', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label' => esc_html__('Taxonomy', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'category',
                'options' => $this->get_taxonomy_options(),
            ]
        );

        $this->add_control(
            'term_filter_type',
            [
                'label' => esc_html__('Taxonomy Filter', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'include' => esc_html__('Include Terms', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'exclude' => esc_html__('Exclude Terms', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'include_term_ids',
            [
                'label' => esc_html__('Include Terms', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => [],
                'condition' => [
                    'term_filter_type' => 'include',
                ],
            ]
        );

        $this->add_control(
            'exclude_term_ids',
            [
                'label' => esc_html__('Exclude Terms', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => [],
                'condition' => [
                    'term_filter_type' => 'exclude',
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Terms Limit', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 100,
            ]
        );

        $this->add_control(
            'show_children',
            [
                'label' => esc_html__('Show Child Terms', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'show_empty_taxonomy',
            [
                'label' => esc_html__('Show Empty Taxonomy', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        // ==================================================
            // Sorting Order
        // ==================================================

        $this->start_controls_section(
            'section_sort',
            [
                'label' => esc_html__('Sorting Order', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'name' => esc_html__('Name', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'count' => esc_html__('Count', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'slug' => esc_html__('Slug', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'term_id' => esc_html__('ID', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Sort Order', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'DESC' => esc_html__('Descending', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
        // Read More button
        // ==================================================
        
        $this->start_controls_section(
            'section_read_more_button',
            [
                'label' => esc_html__('Read More Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label' => esc_html__('Show Read More', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label' => esc_html__('Read More Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View All', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_media_type',
            [
                'label' => esc_html__('Read More Media Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'none' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'icon' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'image' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label' => esc_html__('Read More Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'read_more_icon_fa4',
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                    'read_more_media_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'read_more_image',
            [
                'label' => esc_html__('Read More Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'show_read_more' => 'yes',
                    'read_more_media_type' => 'image',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
        // Style Layout
        // ==================================================

        $this->start_controls_section(
            'section_style_layout',
            [
                'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_min_height',
            [
                'label' => esc_html__('Minimum Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_margin',
            [
                'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .pea-post-category-item',
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_box_shadow_heading',
            [
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('post_category_box_shadow_tabs');

        $this->start_controls_tab(
            'post_category_box_shadow_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .pea-post-category-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'post_category_box_shadow_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .pea-post-category-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'background_heading',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('post_category_background_tabs');

        $this->start_controls_tab(
            'post_category_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_category_background_normal',
                'types' => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'post_category_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_category_background_hover',
                'types' => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // ==================================================
            // Header Area
        // ==================================================

        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__('Header Area', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'body_gap',
            [
                'label' => esc_html__('Spacing Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-body' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_first_gap',
            [
                'label' => esc_html__('Link Title Margin-top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-body > *:nth-child(2)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_second_gap',
            [
                'label' => esc_html__('Description Margin-top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-body > *:nth-child(3)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
            // Post count
        // ==================================================

        $this->start_controls_section(
            'section_count',
            [
                'label' => esc_html__('Post Count', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typography',
                'selector' => '{{WRAPPER}} .pea-post-category-count',
            ]
        );

        $this->add_responsive_control(
            'count_label_text_gap',
            [
                'label' => esc_html__('Label Text Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-count' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'count_text_color_tabs',
            [
                'label' => esc_html__('Text color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('post_category_count_text_color_tabs');

        $this->start_controls_tab(
            'post_category_count_text_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'count_text_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-post-category-count-number' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-post-category-count-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'post_category_count_text_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'count_text_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-count-number' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-count-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'count_background_tabs',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('post_category_count_background_tabs');

        $this->start_controls_tab(
            'post_category_count_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'count_background',
                'types' => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-count',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'post_category_count_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'count_background_hover',
                'types' => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-count',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'count_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'count_border',
                'selector' => '{{WRAPPER}} .pea-post-category-count',
            ]
        );

        $this->add_control(
            'count_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-count' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'count_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'count_box_shadow_tabs',
            [
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('post_category_count_box_shadow_tabs');

        $this->start_controls_tab(
            'post_category_count_box_shadow_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'count_box_shadow',
                'selector' => '{{WRAPPER}} .pea-post-category-count',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'post_category_count_box_shadow_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'count_box_shadow_hover',
                'selector' => '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-count',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // ==================================================
            // Link Title
        // ==================================================

        $this->start_controls_section(
            'section_link_title',
            [
                'label' => esc_html__('Link Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'selector' => '{{WRAPPER}} .pea-post-category-link',
            ]
        );

        $this->add_control(
            'link_color_heading',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('link_color_tabs');

        $this->start_controls_tab(
            'link_color_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'link_text_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'link_color_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'link_text_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_description',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .pea-post-category-description',
            ]
        );

        $this->add_control(
            'description_color_heading',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('description_color_tabs');

        $this->start_controls_tab(
            'description_color_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'description_text_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'description_color_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'description_text_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // ==================================================
            // Author
        // ==================================================

        $this->start_controls_section(
            'section_author',
            [
                'label' => esc_html__('Author', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .pea-post-category-author-name',
            ]
        );

        $this->add_responsive_control(
            'author_gap',
            [
                'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-author' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'author_avatar_size',
            [
                'label' => esc_html__('Avatar Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-author-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'author_avatar_border',
                'selector' => '{{WRAPPER}} .pea-post-category-author-avatar',
            ]
        );

        $this->add_control(
            'author_avatar_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-author-avatar' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'author_avatar_border_radius',
            [
                'label' => esc_html__('Avatar Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-author-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'author_color_heading',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('author_color_tabs');

        $this->start_controls_tab(
            'author_color_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'author_text_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-author-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'author_color_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'author_text_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-item:hover .pea-post-category-author-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'author_margin',
            [
                'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
            // Read More
        // ==================================================

        $this->start_controls_section(
            'section_read_more',
            [
                'label' => esc_html__('Read More', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'read_more_typography',
                'selector' => '{{WRAPPER}} .pea-post-category-read-more',
            ]
        );

        $this->add_responsive_control(
            'read_more_width',
            [
                'label' => esc_html__('Button Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_gap',
            [
                'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_color_heading',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('read_more_color_tabs');

        $this->start_controls_tab(
            'read_more_color_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'read_more_text_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_color_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'read_more_text_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'read_more_background_heading',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('read_more_background_tabs');

        $this->start_controls_tab(
            'read_more_background_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_background',
                'types' => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-read-more',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_background_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_background_hover',
                'types' => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-read-more:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'read_more_border',
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .pea-post-category-read-more',
            ]
        );

        $this->add_control(
            'read_more_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_box_shadow_heading',
            [
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('read_more_box_shadow_tabs');

        $this->start_controls_tab(
            'read_more_box_shadow_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'read_more_box_shadow',
                'selector' => '{{WRAPPER}} .pea-post-category-read-more',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_box_shadow_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'read_more_box_shadow_hover',
                'selector' => '{{WRAPPER}} .pea-post-category-read-more:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'read_more_margin',
            [
                'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==================================================
            // Read More Icon
        // ==================================================

        $this->start_controls_section(
            'section_read_more_icon',
            [
                'label' => esc_html__('Read More Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_size',
            [
                'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more-icon'       => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-post-category-read-more-icon svg'   => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-post-category-read-more-image'      => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-post-category-read-more-image img'  => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // ── Color ──────────────────────────────────────────

        $this->add_control(
            'read_more_icon_color_heading',
            [
                'label'     => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('read_more_icon_color_tabs');

        $this->start_controls_tab(
            'read_more_icon_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'read_more_icon_color',
            [
                'label'     => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-post-category-read-more-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_icon_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'read_more_icon_color_hover',
            [
                'label'     => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more:hover .pea-post-category-read-more-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-post-category-read-more:hover .pea-post-category-read-more-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // ── Background ─────────────────────────────────────

        $this->add_control(
            'read_more_icon_background_heading',
            [
                'label'     => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('read_more_icon_background_tabs');

        $this->start_controls_tab(
            'read_more_icon_background_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'read_more_icon_background',
                'types'         => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label'   => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-read-more-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_icon_background_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'read_more_icon_background_hover',
                'types'         => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label'   => esc_html__('Background Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'default' => 'classic',
                    ],
                ],
                'selector' => '{{WRAPPER}} .pea-post-category-read-more:hover .pea-post-category-read-more-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // ── Border ─────────────────────────────────────────

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'read_more_icon_border',
                'separator' => 'before',
                'selector'  => '{{WRAPPER}} .pea-post-category-read-more-icon',
            ]
        );

        $this->add_control(
            'read_more_icon_hover_border_color',
            [
                'label'     => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more:hover .pea-post-category-read-more-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pea-post-category-read-more-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // ── Padding ────────────────────────────────────────

        $this->add_responsive_control(
            'read_more_icon_padding',
            [
                'label'      => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .pea-post-category-read-more-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // ── Rotation ───────────────────────────────────────

        $this->add_control(
            'read_more_icon_rotation_heading',
            [
                'label'     => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('read_more_icon_rotation_tabs');

        $this->start_controls_tab(
            'read_more_icon_rotation_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_rotate_normal',
            [
                'label'      => esc_html__('Rotate (deg)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'default'    => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'range' => [
                    'deg' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_icon_rotation_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_rotate_on_hover',
            [
                'label'      => esc_html__('Rotate (deg)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'default'    => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'range' => [
                    'deg' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-post-category-read-more:hover .pea-post-category-read-more-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /* ==================== Render ==================== */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $taxonomy = $this->get_valid_taxonomy($settings['taxonomy'] ?? '');
        if (!taxonomy_exists($taxonomy)) {
            echo '<p class="pea-post-category-message">' . esc_html__('Selected taxonomy does not exist.', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        $terms = get_terms($this->build_terms_query_args($settings, $taxonomy));
        if (is_wp_error($terms) || empty($terms)) {
            echo '<p class="pea-post-category-message">' . esc_html__('No terms found with current filters', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        $show_children = ($settings['show_children'] ?? '') === 'yes';
        $layout = ($settings['layout'] ?? 'grid') === 'list' ? 'list' : 'grid';
        $preset = $this->get_active_preset($settings);
        $grid_columns = $this->get_grid_columns($settings);

        echo '<div class="pea-post-category-widget pea-layout-' . esc_attr($layout) . ' pea-' . esc_attr($preset) . ' pea-grid-cols-' . esc_attr((string) $grid_columns) . '">';

        if ($layout === 'list' && $show_children) {
            echo $this->render_hierarchy_list($terms, 0, $settings, $taxonomy); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        } else {
            echo '<ul class="pea-post-category-list">';
            foreach ($terms as $term) {
                echo $this->render_term_li($term, $settings, $taxonomy); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
            echo '</ul>';
        }

        echo '</div>';
    }

    /* ==================== Query Helpers ==================== */
    private function get_valid_taxonomy($taxonomy)
    {
        $taxonomy = sanitize_key((string) $taxonomy);
        return $taxonomy !== '' ? $taxonomy : 'category';
    }

    private function get_active_preset($settings)
    {
        $preset = sanitize_key((string) ($settings['preset'] ?? 'preset-1'));

        if (in_array($preset, ['preset-1', 'preset-2', 'preset-3', 'preset-4', 'preset-5', 'preset-6'], true)) {
            return $preset;
        }

        return 'preset-1';
    }

    private function get_grid_columns($settings)
    {
        return max(1, min(6, absint($settings['grid_columns']['size'] ?? 2)));
    }

    private function build_terms_query_args($settings, $taxonomy)
    {
        $limit = max(1, absint($settings['limit'] ?? 6));
        $orderby = !empty($settings['orderby']) ? sanitize_key($settings['orderby']) : 'name';
        $order = strtoupper((string) ($settings['order'] ?? 'ASC')) === 'DESC' ? 'DESC' : 'ASC';
        $hide_empty = ($settings['show_empty_taxonomy'] ?? '') !== 'yes';
        $show_children = ($settings['show_children'] ?? '') === 'yes';
        $term_filter_type = (string) ($settings['term_filter_type'] ?? 'none');

        $args = [
            'taxonomy' => $taxonomy,
            'hide_empty' => $hide_empty,
            'number' => $limit,
            'orderby' => $orderby,
            'order' => $order,
        ];

        if (!$show_children) {
            $args['parent'] = 0;
        }

        if ($term_filter_type === 'include') {
            $include_ids = $this->parse_ids($settings['include_term_ids'] ?? '');
            if (!empty($include_ids)) {
                $args['include'] = $include_ids;
            }
        }

        if ($term_filter_type === 'exclude') {
            $exclude_ids = $this->parse_ids($settings['exclude_term_ids'] ?? '');
            if (!empty($exclude_ids)) {
                $args['exclude'] = $exclude_ids;
            }
        }

        return $args;
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

    /* ==================== Markup Helpers ==================== */
    private function render_hierarchy_list($terms, $parent_id, $settings, $taxonomy)
    {
        $children = array_values(array_filter($terms, function ($term) use ($parent_id) {
            return (int) $term->parent === (int) $parent_id;
        }));

        if (empty($children)) {
            return '';
        }

        $html = '<ul class="pea-post-category-list">';

        foreach ($children as $term) {
            $item_html = $this->render_term_li($term, $settings, $taxonomy);
            if ($item_html === '') {
                continue;
            }

            $child_html = $this->render_hierarchy_list($terms, $term->term_id, $settings, $taxonomy);

            if ($child_html !== '') {
                $item_html = preg_replace('/<\/li>\s*$/', $child_html . '</li>', $item_html, 1);
            }

            $html .= $item_html;
        }

        $html .= '</ul>';

        return $html;
    }

    private function render_term_li($term, $settings, $taxonomy)
    {
        $term_link = get_term_link($term);
        if (is_wp_error($term_link)) {
            return '';
        }

        $preset = $this->get_active_preset($settings);
        $show_title = ($settings['show_title'] ?? '') === 'yes';
        $show_description = ($settings['show_description'] ?? '') === 'yes';
        $show_count = ($settings['show_count'] ?? 'yes') === 'yes';
        $show_post_type_name_with_count = ($settings['show_post_type_name_with_count'] ?? '') === 'yes';
        $excerpt_length = max(1, absint($settings['description_excerpt_length'] ?? 10));
        $show_image = $this->should_show_term_image($settings);
        $show_author = ($settings['show_author'] ?? '') === 'yes';
        $show_read_more = ($settings['show_read_more'] ?? '') === 'yes';
        $read_more_text = array_key_exists('read_more_text', $settings)
            ? trim((string) $settings['read_more_text'])
            : esc_html__('View All', 'unlimited-elementor-inner-sections-by-boomdevs');
        $read_more_media_type = (string) ($settings['read_more_media_type'] ?? 'icon');
        $read_more_icon = $settings['read_more_icon'] ?? [];
        $read_more_image = $settings['read_more_image'] ?? [];
        $image_source = $this->get_term_image_source($term, $settings, $show_image);

        $item_classes = 'pea-post-category-item';
        $item_style = '';

        if (in_array($preset, ['preset-3', 'preset-6'], true) && $image_source !== '') {
            $item_classes .= ' has-bg-image';
            $item_style = ' style="--pea-term-bg-image: url(' . esc_url($image_source) . ');"';
        }

        $html = '<li class="' . esc_attr($item_classes) . '" data-parent-id="' . esc_attr((string) $term->parent) . '"' . $item_style . '>';

        if ($show_image && !in_array($preset, ['preset-2', 'preset-3', 'preset-6'], true) && $image_source !== '') {
            $html .= '<div class="pea-post-category-image-wrapper">';
            $html .= '<img class="pea-post-category-image" src="' . esc_url($image_source) . '" alt="' . esc_attr($term->name) . '">';
            $html .= '</div>';
        }

        $html .= '<div class="pea-post-category-meta">';
        $html .= '<div class="pea-post-category-body">';
        $html .= $this->render_term_heading($term, $term_link, $taxonomy, $show_count, $show_post_type_name_with_count, $preset, $image_source, $show_title);

        if ($show_description && !empty($term->description)) {
            $html .= '<p class="pea-post-category-description">' . esc_html($this->trim_words((string) $term->description, $excerpt_length)) . '</p>';
        }

        $html .= '</div>';

        $has_footer_content = $show_author || $show_read_more;

        if ($has_footer_content) {
            $html .= '<div class="pea-post-category-footer">';
        }

        if ($show_author) {
            $owner = $this->get_term_owner((int) $term->term_id, (string) $term->taxonomy);
            if (!empty($owner)) {
                $html .= '<div class="pea-post-category-author">';
                $html .= '<a href="' . esc_url($owner['url']) . '"><img class="pea-post-category-author-avatar" src="' . esc_url($owner['avatar']) . '" alt="' . esc_attr($owner['name']) . '"></a>';
                $html .= '<a class="pea-post-category-author-name" href="' . esc_url($owner['url']) . '">' . esc_html($owner['name']) . '</a>';
                $html .= '</div>';
            }
        }

        if ($show_read_more) {
            if ($read_more_text !== '') {
                $html .= '<a class="pea-post-category-read-more" href="' . esc_url($term_link) . '">';
                $html .= '<span class="pea-post-category-read-more-text">' . esc_html($read_more_text) . '</span>';

                if ($read_more_media_type === 'icon' && !empty($read_more_icon['value'])) {
                    ob_start();
                    \Elementor\Icons_Manager::render_icon($read_more_icon, ['aria-hidden' => 'true']);
                    $icon_html = ob_get_clean();

                    if (!empty($icon_html)) {
                        $html .= '<span class="pea-post-category-read-more-icon">' . $icon_html . '</span>';
                    }
                }

                if ($read_more_media_type === 'image' && !empty($read_more_image['url'])) {
                    $html .= '<span class="pea-post-category-read-more-image">';
                    $html .= '<img src="' . esc_url($read_more_image['url']) . '" alt="' . esc_attr($read_more_text) . '">';
                    $html .= '</span>';
                }

                $html .= '</a>';
            }
        }

        if ($has_footer_content) {
            $html .= '</div>';
        }

        $html .= '</div>';
        $html .= '</li>';

        return $html;
    }

    private function render_term_heading($term, $term_link, $taxonomy, $show_count, $show_post_type_name_with_count, $preset, $image_source = '', $show_title = true)
    {
        $count_html = '';

        if ($show_count) {
            $count_html = '<span class="pea-post-category-count">' . $this->format_count_html((int) $term->count, $taxonomy, $show_post_type_name_with_count) . '</span>';
        }

        $link_html = $show_title ? '<a class="pea-post-category-link" href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a>' : '';

        if ($preset === 'preset-2') {
            $style_attr = '';
            $heading_classes = 'pea-post-category-heading pea-post-category-heading-highlight';

            if ($image_source !== '') {
                $style_attr = ' style="--pea-term-bg-image: url(' . esc_url($image_source) . ');"';
                $heading_classes .= ' has-bg-image';
            }

            return '<div class="' . esc_attr($heading_classes) . '"' . $style_attr . '>' . $count_html . $link_html . '</div>';
        }

        if ($preset === 'preset-5') {
            return '<div class="pea-post-category-heading pea-post-category-heading-list">' . $link_html . $this->format_count_badge_html((int) $term->count, $taxonomy, $show_post_type_name_with_count) . '</div>';
        }

        if ($preset === 'preset-6') {
            return '<div class="pea-post-category-heading pea-post-category-heading-list">' . $link_html . $count_html . '</div>';
        }

        return $count_html . $link_html;
    }

    private function get_term_author_html($term_id, $taxonomy)
    {
        $owner = $this->get_term_owner($term_id, $taxonomy);

        if (empty($owner)) {
            return '';
        }

        $html = '<div class="pea-post-category-author">';
        $html .= '<a href="' . esc_url($owner['url']) . '"><img class="pea-post-category-author-avatar" src="' . esc_url($owner['avatar']) . '" alt="' . esc_attr($owner['name']) . '"></a>';
        $html .= '<a class="pea-post-category-author-name" href="' . esc_url($owner['url']) . '">' . esc_html($owner['name']) . '</a>';
        $html .= '</div>';

        return $html;
    }
    /* ==================== Data Helpers ==================== */
    private function format_count_html($count, $taxonomy, $show_label)
    {
        $number_html = '<span class="pea-post-category-count-number">' . esc_html((string) $count) . '</span>';

        if (!$show_label) {
            return $number_html;
        }

        $label = $this->get_post_type_label_for_taxonomy($taxonomy, $count);
        if ($label === '') {
            return $number_html;
        }

        return $number_html . '<span class="pea-post-category-count-label"> ' . esc_html($label) . '</span>';
    }

    private function format_count_badge_html($count, $taxonomy, $show_label)
    {
        $count_text = (string) $count;

        if ($show_label) {
            $label = $this->get_post_type_label_for_taxonomy($taxonomy, $count);

            if ($label !== '') {
                $count_text .= ' ' . $label;
            }
        }

        return '<span class="pea-post-category-count pea-post-category-count-plain">(' . esc_html($count_text) . ')</span>';
    }

    private function get_post_type_label_for_taxonomy($taxonomy_slug, $count = 1)
    {
        if ($taxonomy_slug === '') {
            return '';
        }

        $taxonomy = get_taxonomy($taxonomy_slug);
        if (!$taxonomy || empty($taxonomy->object_type)) {
            return '';
        }

        $post_type_slug = $taxonomy->object_type[0];
        $post_type = get_post_type_object($post_type_slug);
        if (!$post_type) {
            return '';
        }

        $is_plural = $count !== 1;

        if (!empty($post_type->labels)) {
            if (!$is_plural && !empty($post_type->labels->singular_name)) {
                return $post_type->labels->singular_name;
            }

            if ($is_plural && !empty($post_type->labels->name)) {
                return $post_type->labels->name;
            }
        }

        $base_name = ucfirst($post_type_slug);
        return $is_plural ? $base_name . 's' : $base_name;
    }

    private function get_term_owner($term_id, $taxonomy)
    {
        static $owner_cache = [];

        $cache_key = $taxonomy . ':' . $term_id;
        if (array_key_exists($cache_key, $owner_cache)) {
            return $owner_cache[$cache_key];
        }

        $posts = get_posts([
            'post_type' => 'any',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => absint($term_id),
                ],
            ],
            'fields' => 'ids',
        ]);

        if (empty($posts)) {
            $admins = get_users([
                'role' => 'administrator',
                'number' => 1,
                'orderby' => 'ID',
            ]);
            $user_id = !empty($admins) ? (int) $admins[0]->ID : 1;
        } else {
            $user_id = (int) get_post_field('post_author', $posts[0]);
        }

        $user = get_userdata($user_id);
        if (!$user) {
            $owner_cache[$cache_key] = null;
            return null;
        }

        $owner_cache[$cache_key] = [
            'id' => $user->ID,
            'name' => $user->display_name,
            'avatar' => get_avatar_url($user->ID, ['size' => 40]),
            'url' => get_author_posts_url($user->ID),
        ];

        return $owner_cache[$cache_key];
    }

    private function trim_words($text, $word_limit)
    {
        if ($text === '') {
            return '';
        }

        $words = preg_split('/\s+/', trim($text));
        if (!is_array($words) || count($words) <= $word_limit) {
            return $text;
        }

        return implode(' ', array_slice($words, 0, $word_limit)) . '...';
    }

    private function get_term_image_source($term, $settings, $show_image)
    {
        if (!$show_image) {
            return '';
        }

        $term_image = get_term_meta($term->term_id, 'pea_taxonomy_image', true);
        $fallback_image = esc_url_raw((string) ($settings['image_fallback_url'] ?? ''));

        return !empty($term_image) ? esc_url_raw((string) $term_image) : $fallback_image;
    }

    private function should_show_term_image($settings)
    {
        $show_image = (string) ($settings['show_image'] ?? 'default');

        if ($show_image === 'yes') {
            return true;
        }

        if ($show_image === 'no') {
            return false;
        }

        return in_array($this->get_active_preset($settings), ['preset-3', 'preset-4'], true);
    }

    private function get_taxonomy_options()
    {
        $options = [];

        $taxonomies = get_taxonomies(
            [
                'public' => true,
                'show_ui' => true,
            ],
            'objects'
        );

        if (!empty($taxonomies)) {
            foreach ($taxonomies as $taxonomy) {
                $options[$taxonomy->name] = $taxonomy->label;
            }
        }

        if (empty($options)) {
            $options['category'] = esc_html__('Category', 'unlimited-elementor-inner-sections-by-boomdevs');
        }

        return $options;
    }
}
