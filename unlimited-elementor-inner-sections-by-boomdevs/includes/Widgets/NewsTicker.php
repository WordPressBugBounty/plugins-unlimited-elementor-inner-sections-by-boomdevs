<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Modules\NestedElements\Base\Widget_Nested_Base;
use Elementor\Modules\NestedElements\Controls\Control_Nested_Repeater;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}

class NewsTicker extends Widget_Nested_Base
{

    public $num_of_items = 0;

    public function get_name()
    {
        return 'pea_news_ticker';
    }

    public function get_title()
    {
        return esc_html__('News Ticker', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_categories()
    {
        return array('prime-elementor-addons');
    }

    public function get_icon()
    {
        return 'pea_post_ticker_icon';
    }

    public function get_keywords()
    {
        return array('News', 'Ticker', 'Breaking', 'Scroll', 'Marquee', 'Infinite', 'Loop', 'Nested');
    }

    public function show_in_panel()
    {
        return Plugin::$instance->experiments->is_feature_active('nested-elements')
            && Plugin::$instance->experiments->is_feature_active('container');
    }

    public function has_widget_inner_wrapper(): bool
    {
        return !Plugin::$instance->experiments->is_feature_active('e_optimized_markup');
    }

    public function get_style_depends(): array
    {
        return [
            'prime-elementor-addons-swiper',
            'prime-elementor-addons--news-ticker',
        ];
    }

    public function get_script_depends(): array
    {
        return [
            'prime-elementor-addons-swiper',
            'prime-elementor-addons--news-ticker',
        ];
    }


    // Nested helpers


    protected function get_default_children_elements()
    {
        $make_item = function ($num) {
            return [
                'elType' => 'container',
                'id' => \Elementor\Utils::generate_random_string(),
                'settings' => [
                    '_title' => sprintf(__('Ticker Item #%d', 'unlimited-elementor-inner-sections-by-boomdevs'), $num),
                    'background_background' => 'classic',
                    'background_color' => 'transparent',
                ],
                'elements' => [],
            ];
        };

        return [
            $make_item(1),
            $make_item(2),
            $make_item(3),
            $make_item(4),
        ];
    }

    protected function get_default_repeater_title_setting_key()
    {
        return 'item_title';
    }

    protected function get_default_children_title()
    {
        return esc_html__('Ticker Item %d', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    protected function get_default_children_placeholder_selector()
    {
        return '.pea-ticker-swiper-wrapper';
    }

    protected function get_default_children_container_placeholder_selector()
    {
        return '.pea-ticker-item';
    }


    // Controls
    protected function register_controls()
    {

        // CONTENT TAB

        // Items repeater
        $this->start_controls_section(
            'ticker_items_section',
            [
                'label' => esc_html__('Ticker Items', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Ticker Item', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'placeholder' => esc_html__('Ticker Item Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'dynamic' => ['active' => true],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ticker_items',
            [
                'label' => esc_html__('Items', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Control_Nested_Repeater::CONTROL_TYPE,
                'fields' => $repeater->get_controls(),
                'default' => array_map(
                    fn($i) => ['item_title' => sprintf(__('Ticker Item %d', 'unlimited-elementor-inner-sections-by-boomdevs'), $i)],
                    range(1, 4)
                ),
                'frontend_available' => true,
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Label settings
        $this->start_controls_section(
            'ticker_label_section',
            [
                'label' => esc_html__('Label', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'label_text',
            [
                'label' => esc_html__('Label Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Breaking News', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'placeholder' => esc_html__('Breaking News', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'dynamic' => ['active' => true],
                'condition' => ['show_label' => 'yes'],
            ]
        );

        $this->add_control(
            'label_icon',
            [
                'label' => esc_html__('Label Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bolt',
                    'library' => 'fa-solid',
                ],
                'condition' => ['show_label' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // Time settings
        $this->start_controls_section(
            'ticker_timer_section',
            [
                'label' => esc_html__('Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'show_timer',
            [
                'label' => esc_html__('Show Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'timer_label',
            [
                'label' => esc_html__('Time Label', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TIME:', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => ['show_timer' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // Controls settings
        $this->start_controls_section(
            'ticker_controls_section',
            [
                'label' => esc_html__('Navigation Controls', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'show_controls',
            [
                'label' => esc_html__('Show Controls', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_prev_next',
            [
                'label' => esc_html__('Show Prev/Next', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['show_controls' => 'yes'],
            ]
        );

        $this->add_control(
            'show_pause',
            [
                'label' => esc_html__('Show Pause/Play', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['show_controls' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // General settings
        $this->start_controls_section(
            'ticker_general_settings',
            [
                'label' => esc_html__('General Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'ticker_mode',
            [
                'label' => esc_html__('Ticker Mode', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'marquee',
                'options' => [
                    'marquee' => esc_html__('Marquee', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'slide' => esc_html__('Slide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'description' => esc_html__('Marquee scrolls continuously; Slide transitions one item at a time.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__('Items Visible', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => ['step' => 0.1, 'min' => 1, 'max' => 6],
                ],
                'default' => ['unit' => '', 'size' => 2],
                'condition' => ['ticker_mode' => 'marquee'],
            ]
        );

        $this->add_responsive_control(
            'slides_gap',
            [
                'label' => esc_html__('Gap (px)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 200],
                ],
                'default' => ['unit' => 'px', 'size' => 40],
            ]
        );

        $this->add_control(
            'ticker_speed',
            [
                'label' => esc_html__('Scroll Speed', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 500, 'max' => 30000, 'step' => 100],
                ],
                'default' => ['unit' => 'px', 'size' => 8000],
                'description' => esc_html__('Duration (ms) for one full loop. Lower = faster.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => ['ticker_mode' => 'marquee'],
            ]
        );

        $this->add_control(
            'slide_duration',
            [
                'label' => esc_html__('Slide Duration (ms)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 500, 'max' => 10000, 'step' => 100],
                ],
                'default' => ['unit' => 'px', 'size' => 3000],
                'condition' => ['ticker_mode' => 'slide'],
            ]
        );

        $this->add_control(
            'ticker_direction',
            [
                'label' => esc_html__('Direction', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left (RTL)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'right' => esc_html__('Right (LTR)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // STYLE TAB

        // Wrapper style
        $this->start_controls_section(
            'ticker_wrapper_style',
            [
                'label' => esc_html__('Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ticker_height',
            [
                'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => ['min' => 40, 'max' => 300],
                    'vh' => ['min' => 5, 'max' => 30],
                ],
                'default' => ['unit' => 'px', 'size' => 70],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-ticker-label' => 'min-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-ticker-controls' => 'min-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-ticker-swiper-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_bg_color',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_border',
                'selector' => '{{WRAPPER}} .pea-ticker-wrapper',
            ]
        );

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .pea-ticker-wrapper',
            ]
        );

        $this->end_controls_section();

        // Label style
        $this->start_controls_section(
            'ticker_label_style',
            [
                'label' => esc_html__('Label', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_label' => 'yes'],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'label_bg',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-ticker-label',
                'default' => 'gradient',
            ]
        );

        $this->add_control(
            'label_text_color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-label' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-ticker-label-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-ticker-label-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-ticker-label-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pea-ticker-label-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .pea-ticker-label-text',
            ]
        );

        $this->add_responsive_control(
            'label_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 10,
                    'right' => 0,
                    'bottom' => 10,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_min_width',
            [
                'label' => esc_html__('Min Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 50, 'max' => 400],
                ],
                'default' => ['unit' => 'px', 'size' => 180],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-label' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_icon_size',
            [
                'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => ['min' => 8, 'max' => 60],
                ],
                'default' => ['unit' => 'px', 'size' => 18],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-label-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 30],
                ],
                'default' => ['unit' => 'px', 'size' => 8],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-label' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Time style
        $this->start_controls_section(
            'ticker_timer_style',
            [
                'label' => esc_html__('Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_timer' => 'yes'],
            ]
        );

        $this->add_control(
            'timer_label_color',
            [
                'label' => esc_html__('Label Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-timer-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'timer_value_color',
            [
                'label' => esc_html__('Value Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-timer-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'timer_typography',
                'selector' => '{{WRAPPER}} .pea-ticker-timer-label, {{WRAPPER}} .pea-ticker-timer-value',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'timer_bg',
                'label' => esc_html__('Timer Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-ticker-timer',
            ]
        );

        $this->add_responsive_control(
            'time_min_width',
            [
                'label' => esc_html__('Min Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 50, 'max' => 400],
                ],
                'default' => ['unit' => 'px', 'size' => 180],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-timer' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'timer_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 4,
                    'right' => 12,
                    'bottom' => 4,
                    'left' => 12,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-timer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Controls style
        $this->start_controls_section(
            'ticker_controls_style',
            [
                'label' => esc_html__('Navigation Controls', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_controls' => 'yes'],
            ]
        );

        $this->start_controls_tabs('ticker_controls_style_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'ticker_controls_style_tab_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'controls_color',
            [
                'label' => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#c0186c',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-btn svg path' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .pea-ticker-btn.pea-ticker-pause-play svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'controls_bg_color',
            [
                'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        // Hover Tab
        $this->start_controls_tab(
            'ticker_controls_style_tab_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'controls_hover_color',
            [
                'label' => esc_html__('Icon Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8b0050',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-btn:hover svg path' => 'stroke: {{VALUE}};',
                    '{{WRAPPER}} .pea-ticker-btn.pea-ticker-pause-play:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'controls_hover_bg_color',
            [
                'label' => esc_html__('Background Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f8f8f8',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs();
   

        $this->add_responsive_control(
            'controls_icon_size',
            [
                'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => ['min' => 8, 'max' => 40],
                ],
                'default' => ['unit' => 'px', 'size' => 14],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'controls_gap',
            [
                'label' => esc_html__('Buttons Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 30],
                ],
                'default' => ['unit' => 'px', 'size' => 6],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-controls-btns' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'controls_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-controls' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content area style
        $this->start_controls_section(
            'ticker_content_style',
            [
                'label' => esc_html__('Content Area', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_bg_color',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_separator',
            [
                'label' => esc_html__('Show Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'separator_text',
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => '|',
                'condition' => ['item_separator' => 'yes'],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => esc_html__('Separator Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .pea-ticker-separator' => 'color: {{VALUE}};',
                ],
                'condition' => ['item_separator' => 'yes'],
            ]
        );

        $this->end_controls_section();
    }


    // Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->num_of_items = count($settings['ticker_items'] ?? []);

        $widget_id = $this->get_id();
        $items = $settings['ticker_items'];

        $mode = $settings['ticker_mode'] ?? 'marquee';
        $show_label = $settings['show_label'] === 'yes';
        $show_timer = $settings['show_timer'] === 'yes';
        $show_controls = $settings['show_controls'] === 'yes';
        $show_prev_next = $settings['show_prev_next'] === 'yes';
        $show_pause = $settings['show_pause'] === 'yes';
        $direction = $settings['ticker_direction'] ?? 'left';
        $pause = $settings['pause_on_hover'] === 'yes';
        $show_sep = $settings['item_separator'] === 'yes';
        $sep_text = esc_html($settings['separator_text'] ?? '|');

        // Desktop
        $spv_desktop = $settings['slides_per_view']['size'] ?? 2;
        $gap_desktop = $settings['slides_gap']['size'] ?? 40;

        // Tablet
        $spv_tablet = $settings['slides_per_view_tablet']['size'] ?? 1.5;
        $gap_tablet = $settings['slides_gap_tablet']['size'] ?? 30;

        // Mobile
        $spv_mobile = $settings['slides_per_view_mobile']['size'] ?? 1;
        $gap_mobile = $settings['slides_gap_mobile']['size'] ?? 20;

        $speed = $settings['ticker_speed']['size'] ?? 8000;
        $slide_duration = $settings['slide_duration']['size'] ?? 3000;
        $timer_start = intval($settings['timer_start_seconds'] ?? 240);
        $timer_mode = $settings['timer_mode'] ?? 'countdown';

        $is_marquee = $mode === 'marquee';

        $swiper_settings = [
            'slidesPerView' => $is_marquee ? $spv_desktop : 1,
            'spaceBetween' => $gap_desktop,
            'loop' => true,
            'allowTouchMove' => true,
            'speed' => $is_marquee ? $speed : 600,
            'freeMode' => $is_marquee,
            'autoplay' => [
                'delay' => $is_marquee ? 0 : $slide_duration,
                'disableOnInteraction' => false,
                'reverseDirection' => $direction === 'right',
                'pauseOnMouseEnter' => $pause,
            ],
            'breakpoints' => [
                0 => ['slidesPerView' => $is_marquee ? $spv_mobile : 1, 'spaceBetween' => $gap_mobile],
                768 => ['slidesPerView' => $is_marquee ? $spv_tablet : 1, 'spaceBetween' => $gap_tablet],
                1025 => ['slidesPerView' => $is_marquee ? $spv_desktop : 1, 'spaceBetween' => $gap_desktop],
            ],
        ];

        $data_settings = wp_json_encode($swiper_settings);

        $wrapper_classes = 'pea-ticker-wrapper pea-news-ticker pea-swiper-' . esc_attr($widget_id);

        $data_attrs = sprintf(
            'data-swiper-settings=\'%s\' data-ticker-mode="%s" data-pause-on-hover="%s" data-timer-start="%d" data-timer-mode="%s"',
            esc_attr($data_settings),
            esc_attr($mode),
            $pause ? 'yes' : 'no',
            $timer_start,
            esc_attr($timer_mode)
        );
        ?>
        <div class="<?php echo esc_attr($wrapper_classes); ?>" <?php echo $data_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
            <?php if ($show_timer): ?>
                <div class="pea-ticker-timer">
                    <span class="pea-ticker-timer-label">
                        <?php echo esc_html($settings['timer_label']); ?>
                    </span>
                    <span class="pea-ticker-timer-value">
                        <?php echo esc_html(current_time('g:i A')); ?>
                    </span>
                </div>
            <?php endif; ?>
            <?php if ($show_label): ?>
                <div class="pea-ticker-label">
                    <?php if (!empty($settings['label_icon']['value'])): ?>
                        <span class="pea-ticker-label-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['label_icon'], ['aria-hidden' => 'true']); ?>
                        </span>
                    <?php endif; ?>
                    <div class="pea-ticker-label-inner">
                        <span class="pea-ticker-label-text"><?php echo esc_html($settings['label_text']); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="pea-ticker-content">
                <div class="pea-ticker-swiper swiper">
                    <div class="swiper-wrapper pea-ticker-swiper-wrapper" aria-live="off">
                        <?php foreach ($items as $index => $item):
                            $key = $this->get_repeater_setting_key('ticker_item', 'ticker_items', $index);
                            $item_class = 'pea-ticker-child-wrap swiper-slide pea-ticker-item elementor-repeater-item-' . esc_attr($item['_id']);
                            $this->add_render_attribute($key, [
                                'class' => $item_class,
                                'slide-index' => $index + 1,
                                'role' => 'listitem',
                            ]);
                            ?>
                            <div <?php $this->print_render_attribute_string($key); ?>>
                                <?php $this->print_child($index); ?>
                                <?php if ($show_sep && $index < count($items) - 1): ?>
                                    <span class="pea-ticker-separator"
                                        aria-hidden="true"><?php echo $sep_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php if ($show_controls): ?>
                <div class="pea-ticker-controls">
                    <div class="pea-ticker-controls-btns">
                        <?php if ($show_prev_next): ?>
                            <button class="pea-ticker-btn pea-ticker-prev"
                                aria-label="<?php esc_attr_e('Previous', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M15.75 19.5L8.25 12L15.75 4.5" stroke="#0B0C0E" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        <?php endif; ?>
                        <?php if ($show_pause): ?>
                            <button class="pea-ticker-btn pea-ticker-pause-play"
                                aria-label="<?php esc_attr_e('Pause', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>"
                                data-playing="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.75 5.25C6.75 4.83579 7.08579 4.5 7.5 4.5H9C9.41421 4.5 9.75 4.83579 9.75 5.25V18.75C9.75 19.1642 9.41421 19.5 9 19.5H7.5C7.30109 19.5 7.11032 19.421 6.96967 19.2803C6.82902 19.1397 6.75 18.9489 6.75 18.75L6.75 5.25ZM14.25 5.25C14.25 4.83579 14.5858 4.5 15 4.5H16.5C16.6989 4.5 16.8897 4.57902 17.0303 4.71967C17.171 4.86032 17.25 5.05109 17.25 5.25V18.75C17.25 19.1642 16.9142 19.5 16.5 19.5H15C14.5858 19.5 14.25 19.1642 14.25 18.75V5.25Z"
                                        fill="#0F172A" />
                                </svg>
                            </button>
                        <?php endif; ?>
                        <?php if ($show_prev_next): ?>
                            <button class="pea-ticker-btn pea-ticker-next"
                                aria-label="<?php esc_attr_e('Next', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M8.25 4.5L15.75 12L8.25 19.5" stroke="#0B0C0E" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <?php
    }


    // Editor JS template
    protected function content_template_single_repeater_item()
    {
        ?>
        <# const elementUid=view.getIDInt().toString().substr(0,3), numOfItems=view.collection.length + 1, itemCount=numOfItems,
            itemKey='new-ticker-' + elementUid + itemCount; var
            itemClass='pea-ticker-child-wrap swiper-slide pea-ticker-item elementor-repeater-item-' + data._id;
            view.addRenderAttribute( itemKey, { 'class' : itemClass, 'slide-index' : itemCount, 'role' : 'listitem' } ); #>
            <div {{{ view.getRenderAttributeString( itemKey ) }}}>
            </div>
            <?php
    }

    protected function content_template()
    {
        ?>
            <# if ( settings['ticker_items'] ) { var widgetId=view.getID(); var mode=settings.ticker_mode || 'marquee' ; var
                isMarquee=mode==='marquee' ; var showLabel=settings.show_label==='yes' ; var
                showTimer=settings.show_timer==='yes' ; var showControls=settings.show_controls==='yes' ; var
                showPrevNext=settings.show_prev_next==='yes' ; var showPause=settings.show_pause==='yes' ; var
                showSep=settings.item_separator==='yes' ; var sepText=settings.separator_text || '|' ; var
                spvDesktop=settings.slides_per_view?.size || 2; var spvTablet=settings.slides_per_view_tablet?.size || 1.5; var
                spvMobile=settings.slides_per_view_mobile?.size || 1; var gapDesktop=settings.slides_gap?.size || 40; var
                gapTablet=settings.slides_gap_tablet?.size || 30; var gapMobile=settings.slides_gap_mobile?.size || 20; var
                speed=settings.ticker_speed?.size || 8000; var slideDuration=settings.slide_duration?.size || 3000; var
                isRight=settings.ticker_direction==='right' ; var pauseHover=settings.pause_on_hover==='yes' ; var
                timerStart=parseInt(settings.timer_start_seconds) || 240; var timerMode=settings.timer_mode || 'countdown' ; var
                mins=Math.floor(timerStart / 60); var secs=timerStart % 60; var timerDisplay=mins + ':' + ('0' +
                secs).slice(-2); var swiperSettings={ slidesPerView : isMarquee ? spvDesktop : 1, spaceBetween : gapDesktop,
                loop : true, freeMode : isMarquee, allowTouchMove: true, speed : isMarquee ? speed : 600, autoplay : { delay:
                isMarquee ? 0 : slideDuration, disableOnInteraction: false, reverseDirection: isRight, pauseOnMouseEnter:
                pauseHover }, breakpoints : { 0 : { slidesPerView: isMarquee ? spvMobile : 1, spaceBetween: gapMobile }, 768 : {
                slidesPerView: isMarquee ? spvTablet : 1, spaceBetween: gapTablet }, 1025: { slidesPerView: isMarquee ?
                spvDesktop : 1, spaceBetween: gapDesktop } } }; const elementUid=view.getIDInt().toString().substr(0,3); var
                wrapperClass='pea-ticker-wrapper pea-news-ticker pea-swiper-' + widgetId; #>

                <div class="{{ wrapperClass }}" data-swiper-settings="{{ JSON.stringify(swiperSettings) }}"
                    data-ticker-mode="{{ mode }}" data-pause-on-hover="{{ pauseHover ? 'yes' : 'no' }}"
                    data-timer-start="{{ timerStart }}" data-timer-mode="{{ timerMode }}">
                    <# if ( showTimer ) { #>
                        <div class="pea-ticker-timer">
                            <span class="pea-ticker-timer-label">{{ settings.timer_label }}</span>
                            <span class="pea-ticker-timer-value">{{ timerDisplay }}</span>
                        </div>
                        <# } #>
                            <# if ( showLabel ) { #>
                                <div class="pea-ticker-label">
                                    <# if ( settings.label_icon && settings.label_icon.value ) { #>
                                        <span class="pea-ticker-label-icon">
                                            <# var iconHTML = elementor.helpers.renderIcon( view, settings.label_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
                                            if ( iconHTML && iconHTML.rendered ) { #>
                                                {{{ iconHTML.value }}}
                                            <# } else { #>
                                                <i class="{{ settings.label_icon.value }}" aria-hidden="true"></i>
                                            <# } #>
                                        </span>
                                    <# } #>
                                    <div class="pea-ticker-label-inner">
                                        <span class="pea-ticker-label-text">{{ settings.label_text }}</span>
                                    </div>
                                </div>
                                <# } #>

                                    <div class="pea-ticker-content">
                                        <div class="pea-ticker-swiper swiper">
                                            <div class="swiper-wrapper pea-ticker-swiper-wrapper" aria-live="off">
                                                <# _.each( settings['ticker_items'], function( item, index ) { var
                                                    slideUid=elementUid + (index + 1); var itemKey='ticker-item-' + slideUid;
                                                    var
                                                    itemClass='pea-ticker-child-wrap swiper-slide pea-ticker-item elementor-repeater-item-'
                                                    + item._id; view.addRenderAttribute( itemKey, { 'class' :
                                                    itemClass, 'slide-index' : index + 1, 'role' : 'listitem' } ); #>
                                                    <div {{{ view.getRenderAttributeString( itemKey ) }}}></div>
                                                    <# } ); #>
                                            </div>
                                        </div>
                                    </div>

                                    <# if ( showControls ) { #>
                                        <div class="pea-ticker-controls">
                                            <div class="pea-ticker-controls-btns">
                                                <# if ( showPrevNext ) { #>
                                                    <button class="pea-ticker-btn pea-ticker-prev" aria-label="Previous">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path d="M15.75 19.5L8.25 12L15.75 4.5" stroke="#0B0C0E"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                    <# } #>
                                                        <# if ( showPause ) { #>
                                                            <button class="pea-ticker-btn pea-ticker-pause-play"
                                                                aria-label="Pause" data-playing="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M6.75 5.25C6.75 4.83579 7.08579 4.5 7.5 4.5H9C9.41421 4.5 9.75 4.83579 9.75 5.25V18.75C9.75 19.1642 9.41421 19.5 9 19.5H7.5C7.30109 19.5 7.11032 19.421 6.96967 19.2803C6.82902 19.1397 6.75 18.9489 6.75 18.75L6.75 5.25ZM14.25 5.25C14.25 4.83579 14.5858 4.5 15 4.5H16.5C16.6989 4.5 16.8897 4.57902 17.0303 4.71967C17.171 4.86032 17.25 5.05109 17.25 5.25V18.75C17.25 19.1642 16.9142 19.5 16.5 19.5H15C14.5858 19.5 14.25 19.1642 14.25 18.75V5.25Z"
                                                                        fill="#0F172A" />
                                                                </svg>
                                                            </button>
                                                            <# } #>
                                                                <# if ( showPrevNext ) { #>
                                                                    <button class="pea-ticker-btn pea-ticker-next"
                                                                        aria-label="Next">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M8.25 4.5L15.75 12L8.25 19.5"
                                                                                stroke="#0B0C0E" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                    <# } #>
                                            </div>
                                        </div>
                                        <# } #>

                </div>
                <# } #>
                    <?php
    }


    // Initial config
    protected function get_initial_config(): array
    {
        return array_merge(
            parent::get_initial_config(),
            [
                'support_improved_repeaters' => true,
                'target_container' => ['.pea-ticker-swiper-wrapper'],
                'node' => 'div',
                'is_interlaced' => true,
                'support_paste_all' => true,
                'container_settings' => [
                    'accepts' => ['container', 'widget', 'section'],
                ],
            ]
        );
    }
}