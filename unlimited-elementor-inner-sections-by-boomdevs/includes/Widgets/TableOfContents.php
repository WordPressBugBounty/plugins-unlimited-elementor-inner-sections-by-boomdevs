<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class TableOfContents extends Widget_Base
{

    public function get_name()
    {
        return 'pea_table_of_contents';
    }

    public function get_title()
    {
        return esc_html__('Table of Contents', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon()
    {
        return 'pea_table_of_contents_icon';
    }

    public function get_categories()
    {
        return ['prime-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['toc', 'table of contents', 'anchor', 'navigation'];
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--table-of-contents'];
    }

    public function get_script_depends()
    {
        return ['prime-elementor-addons--table-of-contents'];
    }

    private function get_normalized_toggle_icon($icon, $type = 'expand')
    {
        $default_icon = 'collapse' === $type ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
        $legacy_icons = [
            'eicon-chevron-down',
            'eicon-chevron-up',
            'eicon-caret-down',
            'eicon-caret-up',
            'eicon-arrow-down',
            'eicon-arrow-up',
        ];

        if (empty($icon['value']) || in_array($icon['value'], $legacy_icons, true)) {
            return [
                'value' => $default_icon,
                'library' => 'fa-solid',
            ];
        }

        return $icon;
    }

    private function get_minimized_breakpoints($minimized_on)
    {
        $allowed_breakpoints = ['mobile', 'tablet', 'desktop'];

        if (!is_array($minimized_on)) {
            $minimized_on = !empty($minimized_on) ? [$minimized_on] : [];
        }

        return array_values(array_intersect($allowed_breakpoints, $minimized_on));
    }

    protected function register_controls()
    {
        // =========================
        // CONTENT: Title
        // =========================
        $this->start_controls_section(
            'pea_toc_title_section',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Table of Contents', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'placeholder' => esc_html__('Enter widget title', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'title_separator',
            [
                'label' => esc_html__('Title Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'toc_html_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'DIV',
                ],
            ]
        );

        $this->end_controls_section();

        // =========================
        // CONTENT: Selectors
        // =========================
        $this->start_controls_section(
            'pea_toc_selectors_section',
            [
                'label' => esc_html__('Selectors', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'html_tags',
            [
                'label' => esc_html__('Anchors By Tags', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['h1', 'h2', 'h3', 'h4'],
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'description' => esc_html__('Automatically detect the selected heading tags from the page content.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_selectors',
            [
                'label' => esc_html__('Exclude CSS Selectors', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('.no-toc, .sidebar h2', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'description' => esc_html__('CSS selectors, in a comma-separated list', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'no_headings_message',
            [
                'label' => esc_html__('No Heading Message', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('No headings found.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'placeholder' => esc_html__('Enter empty state message', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // =========================
        // CONTENT: Additional Options
        // =========================
        $this->start_controls_section(
            'pea_toc_additional_section',
            [
                'label' => esc_html__('Additional Options', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'smooth_scroll',
            [
                'label' => esc_html__('Smooth Scroll', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pea_toc_word_wrap',
            [
                'label' => esc_html__('Word Wrap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__title, {{WRAPPER}} .pea-table-of-contents__link' => 'overflow-wrap: anywhere; word-break: break-word;',
                ],
            ]
        );

        $this->add_control(
            'hierarchical_view',
            [
                'label' => esc_html__('Hierarchical View', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'collapsible_toc',
            [
                'label' => esc_html__('Expandible/Collapsible TOC', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'expand_icon',
            [
                'label' => esc_html__('Expand Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-down',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'collapse_icon',
            [
                'label' => esc_html__('Collapse Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-up',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'minimized_on',
            [
                'label' => esc_html__('Minimized On', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => [
                    'mobile' => __('Mobile Portrait (< 767px)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'tablet' => __('Tablet Portrait (< 1024px)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'desktop' => __('Desktop (or smaller)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'collapse_subitems',
            [
                'label' => esc_html__('Collapse Subitems', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'hierarchical_view' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'marker_view',
            [
                'label' => esc_html__('Marker View', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'disc',
                'options' => [
                    'disc' => esc_html__('Disc', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'circle' => esc_html__('Circle', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'square' => esc_html__('Square', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'icons' => esc_html__('Icons', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'decimal' => esc_html__('Number', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'none' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'marker_icon',
            [
                'label' => esc_html__('Icon Marker', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'marker_view' => 'icons',
                ],
            ]
        );

        $this->add_control(
            'table_position',
            [
                'label' => esc_html__('Table Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'sticky' => esc_html__('Sticky', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'fixed' => esc_html__('Fixed', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'slideout' => esc_html__('Slideout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'sticky_position',
            [
                'label' => esc_html__('Sticky Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'bottom' => esc_html__('Bottom', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'both' => esc_html__('Both', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'condition' => [
                    'table_position' => 'sticky',
                ],
            ]
        );

        $this->add_control(
            'sticky_top_offset',
            [
                'label' => esc_html__('Top Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 0,
                'condition' => [
                    'table_position' => 'sticky',
                    'sticky_position!' => 'bottom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--sticky' => '--pea-toc-sticky-top-offset: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'sticky_bottom_offset',
            [
                'label' => esc_html__('Bottom Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 0,
                'condition' => [
                    'table_position' => 'sticky',
                    'sticky_position!' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--sticky' => '--pea-toc-sticky-bottom-offset: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'fixed_position_toggle',
            [
                'label' => esc_html__('Fixed Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__('Default', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_on' => esc_html__('Custom', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'table_position' => 'fixed',
                ],
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'fixed_offsets',
            [
                'label' => esc_html__('Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'condition' => [
                    'table_position' => 'fixed',
                    'fixed_position_toggle' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--fixed' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'fixed_width',
            [
                'label' => esc_html__('Fixed Table Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 120,
                        'max' => 800,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 320,
                    'unit' => 'px',
                ],
                'condition' => [
                    'table_position' => 'fixed',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--fixed' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slideout_side',
            [
                'label' => esc_html__('Slideout Side', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'left' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'condition' => [
                    'table_position' => 'slideout',
                ],
            ]
        );

        $this->add_responsive_control(
            'slideout_width',
            [
                'label' => esc_html__('Slideout Table Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 180,
                        'max' => 600,
                    ],
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 320,
                    'unit' => 'px',
                ],
                'condition' => [
                    'table_position' => 'slideout',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--slideout' => '--pea-toc-slideout-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_scroll_mode',
            [
                'label' => esc_html__('Scroll Mode', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Off', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'table_position' => ['sticky', 'fixed', 'slideout'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--sticky .pea-table-of-contents__body, {{WRAPPER}} .pea-table-of-contents--fixed .pea-table-of-contents__body, {{WRAPPER}} .pea-table-of-contents--slideout .pea-table-of-contents__body' => 'overflow-y: scroll;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_scroll_height',
            [
                'label' => esc_html__('Content Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 80,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 420,
                    'unit' => 'px',
                ],
                'condition' => [
                    'table_position' => ['sticky', 'fixed', 'slideout'],
                    'content_scroll_mode' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--sticky .pea-table-of-contents__body, {{WRAPPER}} .pea-table-of-contents--fixed .pea-table-of-contents__body, {{WRAPPER}} .pea-table-of-contents--slideout .pea-table-of-contents__body' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fixed_z_index',
            [
                'label' => esc_html__('Fixed Z-Index', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'min' => 1,
                'condition' => [
                    'table_position' => ['fixed', 'slideout'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--fixed, {{WRAPPER}} .pea-table-of-contents--slideout' => 'z-index: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // =========================
        // STYLE: Layout
        // =========================
        $this->start_controls_section(
            'pea_toc_layout_style_section',
            [
                'label' => esc_html__('Layout', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pea_toc_background_heading',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_wrapper_style_tabs');

        $this->start_controls_tab(
            'pea_toc_wrapper_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_toc_wrapper_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-table-of-contents__content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_wrapper_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_toc_wrapper_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-table-of-contents__content:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'pea_toc_box_shadow_heading',
            [
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_box_shadow_tabs');

        $this->start_controls_tab(
            'pea_toc_box_shadow_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_toc_wrapper_box_shadow',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-table-of-contents__content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_box_shadow_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_toc_wrapper_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-table-of-contents__content:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_toc_wrapper_border',
                'label' => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-table-of-contents__content',
            ]
        );

        $this->add_control(
            'pea_toc_wrapper_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__content:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pea_toc_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pea_toc_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // =========================
        // STYLE: Title
        // =========================
        $this->start_controls_section(
            'pea_toc_title_style_section',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_toc_title_typography',
                'label' => esc_html__('Title Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-table-of-contents__title',
            ]
        );

        $this->add_control(
            'pea_toc_title_background_heading',
            [
                'label' => esc_html__('Title Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_title_style_tabs');

        $this->start_controls_tab(
            'pea_toc_title_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_toc_title_background',
                'label' => esc_html__('Title Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-table-of-contents__header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_title_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_toc_title_background_hover',
                'label' => esc_html__('Title Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-table-of-contents__header:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pea_toc_title_padding',
            [
                'label' => esc_html__('Title Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_title_color_heading',
            [
                'label' => esc_html__('Title Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_title_color_tabs');

        $this->start_controls_tab(
            'pea_toc_title_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_toc_title_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_title_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_toc_title_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__header:hover .pea-table-of-contents__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'pea_toc_title_separator_color_heading',
            [
                'label' => esc_html__('Title Separator Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'title!' => '',
                    'title_separator' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('pea_toc_title_separator_color_tabs');

        $this->start_controls_tab(
            'pea_toc_title_separator_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'title!' => '',
                    'title_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_title_separator_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title!' => '',
                    'title_separator' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--has-title-separator .pea-table-of-contents__header' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .pea-table-of-contents--has-title-separator .pea-table-of-contents__title' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_title_separator_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'title!' => '',
                    'title_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_title_separator_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title!' => '',
                    'title_separator' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--has-title-separator .pea-table-of-contents__header:hover' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .pea-table-of-contents--has-title-separator .pea-table-of-contents__header:hover .pea-table-of-contents__title' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pea_toc_title_separator_width',
            [
                'label' => esc_html__('Title Separator Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'condition' => [
                    'title!' => '',
                    'title_separator' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents--has-title-separator .pea-table-of-contents__header' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-table-of-contents--has-title-separator .pea-table-of-contents__title' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_toggle_icon_color_heading',
            [
                'label' => esc_html__('Collapse/Expand Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('pea_toc_toggle_icon_color_tabs');

        $this->start_controls_tab(
            'pea_toc_toggle_icon_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_toggle_icon_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111',
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__toggle' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_toggle_icon_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_toggle_icon_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111',
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__toggle:hover, {{WRAPPER}} .pea-table-of-contents__toggle:focus-visible' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title!' => '',
                    'collapsible_toc' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // =========================
        // STYLE: Table Contents
        // =========================
        $this->start_controls_section(
            'pea_toc_contents_style_section',
            [
                'label' => esc_html__('Table Contents', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_toc_content_typography',
                'label' => esc_html__('Content Text Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-table-of-contents__link',
            ]
        );

        $this->add_control(
            'pea_toc_content_background_heading',
            [
                'label' => esc_html__('Content Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_content_background_tabs');

        $this->start_controls_tab(
            'pea_toc_content_background_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_toc_content_background',
                'label' => esc_html__('Content Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-table-of-contents__body',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_content_background_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_toc_content_background_hover',
                'label' => esc_html__('Content Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-table-of-contents__body:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pea_toc_content_padding',
            [
                'label' => esc_html__('Content Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_toc_content_text_color_heading',
            [
                'label' => esc_html__('Content Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_content_text_style_tabs');

        $this->start_controls_tab(
            'pea_toc_content_text_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_toc_content_text_color',
            [
                'label' => esc_html__('Content Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_content_text_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_toc_content_text_color_hover',
            [
                'label' => esc_html__('Content Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__link:hover, {{WRAPPER}} .pea-table-of-contents__link.is-active:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'pea_toc_marker_color_heading',
            [
                'label' => esc_html__('Marker Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pea_toc_marker_color_tabs');

        $this->start_controls_tab(
            'pea_toc_marker_color_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_toc_marker_color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__item::marker' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-table-of-contents__item-row::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-table-of-contents__marker-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_toc_marker_color_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_toc_marker_color_hover',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__item:hover::marker' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-table-of-contents__item-row:hover::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-table-of-contents__item-row:hover .pea-table-of-contents__marker-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'pea_toc_content_active_text_color',
            [
                'label' => esc_html__('Content Active Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-table-of-contents__link.is-active' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title_html_tag = $this->get_toc_html_tag($settings['toc_html_tag'] ?? 'div');
        $html_tags = $this->get_html_tags($settings['html_tags'] ?? []);
        $exclude_selectors = $this->get_css_selectors($settings['exclude_selectors'] ?? '');
        $title_id = !empty($settings['title']) ? 'pea-toc-title-' . $this->get_id() : '';
        $smooth_scroll = !empty($settings['smooth_scroll']) && 'yes' === $settings['smooth_scroll'] ? 'yes' : 'no';
        $marker_view = $this->get_marker_view($settings['marker_view'] ?? 'disc');
        $list_tag = $this->get_list_tag($marker_view);
        $marker_icon = !empty($settings['marker_icon']['value'])
            ? $settings['marker_icon']
            : [
                'value' => 'fas fa-chevron-right',
                'library' => 'fa-solid',
            ];
        $table_position = $this->get_table_position($settings['table_position'] ?? 'default');
        $sticky_position = $this->get_sticky_position($settings['sticky_position'] ?? 'top');
        $sticky_top_offset = isset($settings['sticky_top_offset']) ? max(0, (int) $settings['sticky_top_offset']) : 20;
        $sticky_bottom_offset = isset($settings['sticky_bottom_offset']) ? max(0, (int) $settings['sticky_bottom_offset']) : 20;
        $slideout_side = $this->get_slideout_side($settings['slideout_side'] ?? 'right');
        $title_separator = !empty($settings['title_separator']) && 'yes' === $settings['title_separator'];
        $collapsible_toc = !empty($settings['collapsible_toc']) && 'yes' === $settings['collapsible_toc'];
        $minimized_on = $this->get_minimized_breakpoints($settings['minimized_on'] ?? []);
        $hierarchical_view = !empty($settings['hierarchical_view']) && 'yes' === $settings['hierarchical_view'];
        $collapse_subitems = !empty($settings['collapse_subitems']) && 'yes' === $settings['collapse_subitems'];
        $no_headings_message = !empty($settings['no_headings_message'])
            ? $settings['no_headings_message']
            : esc_html__('No headings found.', 'unlimited-elementor-inner-sections-by-boomdevs');
        $expand_icon = !empty($settings['expand_icon']['value'])
            ? $this->get_normalized_toggle_icon($settings['expand_icon'], 'expand')
            : $this->get_normalized_toggle_icon([], 'expand');
        $collapse_icon = !empty($settings['collapse_icon']['value'])
            ? $this->get_normalized_toggle_icon($settings['collapse_icon'], 'collapse')
            : $this->get_normalized_toggle_icon([], 'collapse');

        if (empty($settings['title']) && empty($html_tags)) {
            return;
        }
?>
        <nav
            class="pea-table-of-contents pea-table-of-contents--is-loading pea-table-of-contents--<?php echo esc_attr($table_position); ?><?php echo 'slideout' === $table_position ? ' pea-table-of-contents--slideout-' . esc_attr($slideout_side) : ''; ?><?php echo $title_separator ? ' pea-table-of-contents--has-title-separator' : ''; ?><?php echo $collapsible_toc ? ' pea-table-of-contents--is-collapsible' : ''; ?><?php echo $hierarchical_view ? ' pea-table-of-contents--hierarchical' : ''; ?>"
            <?php if ($title_id) : ?>
                aria-labelledby="<?php echo esc_attr($title_id); ?>"
            <?php else : ?>
                aria-label="<?php echo esc_attr__('Table of Contents', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>"
            <?php endif; ?>
            data-html-tags="<?php echo esc_attr(wp_json_encode($html_tags)); ?>"
            data-exclude-selectors="<?php echo esc_attr(wp_json_encode($exclude_selectors)); ?>"
            data-smooth-scroll="<?php echo esc_attr($smooth_scroll); ?>"
            data-marker-view="<?php echo esc_attr($marker_view); ?>"
            data-sticky-position="<?php echo esc_attr($sticky_position); ?>"
            data-sticky-top-offset="<?php echo esc_attr($sticky_top_offset); ?>"
            data-sticky-bottom-offset="<?php echo esc_attr($sticky_bottom_offset); ?>"
            data-minimized-on="<?php echo esc_attr(wp_json_encode($minimized_on)); ?>"
            data-hierarchical-view="<?php echo esc_attr($hierarchical_view ? 'yes' : 'no'); ?>"
            data-collapse-subitems="<?php echo esc_attr($collapse_subitems ? 'yes' : 'no'); ?>"
            data-no-headings-message="<?php echo esc_attr($no_headings_message); ?>"
            data-collapsible-toc="<?php echo esc_attr($collapsible_toc ? 'yes' : 'no'); ?>">
            <?php if ('slideout' === $table_position) : ?>
                <button type="button" class="pea-table-of-contents__slideout-handle" aria-label="<?php echo esc_attr($settings['title'] ?: esc_html__('Open table of contents', 'unlimited-elementor-inner-sections-by-boomdevs')); ?>">
                    <span class="pea-table-of-contents__slideout-markers" aria-hidden="true"></span>
                    <span class="pea-table-of-contents__screen-reader-text"><?php echo esc_html($settings['title'] ?: esc_html__('Contents', 'unlimited-elementor-inner-sections-by-boomdevs')); ?></span>
                </button>
            <?php endif; ?>

            <div class="pea-table-of-contents__content">
                <?php if (!empty($settings['title'])) : ?>
                    <div class="pea-table-of-contents__header">
                        <<?php echo esc_html($title_html_tag); ?> id="<?php echo esc_attr($title_id); ?>" class="pea-table-of-contents__title"><?php echo esc_html($settings['title']); ?></<?php echo esc_html($title_html_tag); ?>>
                        <?php if ($collapsible_toc) : ?>
                            <button type="button" class="pea-table-of-contents__toggle" aria-expanded="true" aria-label="<?php echo esc_attr__('Toggle table of contents', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>">
                                <span class="pea-table-of-contents__toggle-icon pea-table-of-contents__toggle-icon--collapse" aria-hidden="true">
                                    <?php Icons_Manager::render_icon($collapse_icon, ['aria-hidden' => 'true']); ?>
                                </span>
                                <span class="pea-table-of-contents__toggle-icon pea-table-of-contents__toggle-icon--expand" aria-hidden="true">
                                    <?php Icons_Manager::render_icon($expand_icon, ['aria-hidden' => 'true']); ?>
                                </span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="pea-table-of-contents__body">
                    <div class="pea-table-of-contents__loading" aria-hidden="true">
                        <span class="pea-table-of-contents__loading-dot"></span>
                        <span class="pea-table-of-contents__loading-dot"></span>
                        <span class="pea-table-of-contents__loading-dot"></span>
                    </div>

                    <div class="pea-table-of-contents__empty" aria-live="polite"></div>
                    <?php if ('icons' === $marker_view) : ?>
                        <span class="pea-table-of-contents__marker-template" aria-hidden="true">
                            <?php Icons_Manager::render_icon($marker_icon, ['aria-hidden' => 'true']); ?>
                        </span>
                    <?php endif; ?>

                    <<?php echo esc_html($list_tag); ?> class="pea-table-of-contents__list pea-table-of-contents__list--<?php echo esc_attr($marker_view); ?>"></<?php echo esc_html($list_tag); ?>>
                </div>
            </div>
        </nav>
<?php
    }

    private function get_toc_html_tag($toc_html_tag)
    {
        // =========================
        // TOC TITLE TAG WHITELIST
        // =========================
        $allowed_tags = ['h2', 'h3', 'h4', 'h5', 'h6', 'div'];

        if (!in_array($toc_html_tag, $allowed_tags, true)) {
            return 'h4';
        }

        return $toc_html_tag;
    }

    private function get_html_tags($html_tags)
    {
        $allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        $html_tags = array_map('strtolower', (array) $html_tags);
        $html_tags = array_intersect($html_tags, $allowed_tags);

        if (empty($html_tags)) {
            return ['h2', 'h3'];
        }

        return array_values(array_unique($html_tags));
    }

    private function get_css_selectors($selectors)
    {
        $selectors = array_map('trim', explode(',', (string) $selectors));
        $selectors = array_filter($selectors);

        return array_values(array_unique($selectors));
    }

    private function get_marker_view($marker_view)
    {
        // =========================
        // MARKER VIEW WHITELIST
        // =========================
        $allowed_views = ['disc', 'circle', 'square', 'icons', 'decimal', 'none'];

        if (!in_array($marker_view, $allowed_views, true)) {
            return 'disc';
        }

        return $marker_view;
    }

    private function get_list_tag($marker_view)
    {
        return 'decimal' === $marker_view ? 'ol' : 'ul';
    }

    private function get_table_position($table_position)
    {
        $allowed_positions = ['default', 'sticky', 'fixed', 'slideout'];

        if (!in_array($table_position, $allowed_positions, true)) {
            return 'default';
        }

        return $table_position;
    }

    private function get_slideout_side($slideout_side)
    {
        $allowed_sides = ['left', 'right'];

        if (!in_array($slideout_side, $allowed_sides, true)) {
            return 'right';
        }

        return $slideout_side;
    }

    private function get_sticky_position($sticky_position)
    {
        $allowed_positions = ['top', 'bottom', 'both'];

        if (!in_array($sticky_position, $allowed_positions, true)) {
            return 'top';
        }

        return $sticky_position;
    }
}
