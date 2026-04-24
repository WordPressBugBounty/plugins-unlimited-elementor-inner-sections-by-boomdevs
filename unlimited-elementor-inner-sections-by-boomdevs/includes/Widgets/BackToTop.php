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

class BackToTop extends Widget_Base
{

    public function get_name()
    {
        return 'pea_back_to_top';
    }

    public function get_title()
    {
        return esc_html__('Back To Top', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon()
    {
        return 'pea_back_to_top_icon';
    }

    public function get_categories()
    {
        return ['prime-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['back', 'to', 'top', 'scroll', 'button', 'up', 'arrow'];
    }

    public function get_script_depends()
    {
        return ['prime-elementor-addons--back-to-top'];
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--back-to-top'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'pea_back_to_top_presets_section',
            [
                'label' => esc_html__('Presets', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_back_to_top_presets',
            [
                'type' => 'select',
                'label' => esc_html__('Preset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'options' => [
                    'default' => esc_html__('Default', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-1' => esc_html__('Preset 1', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-2' => esc_html__('Preset 2', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-3' => esc_html__('Preset 3', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-4' => esc_html__('Preset 4', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'preset-5' => esc_html__('Preset 5', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'pea_back_to_top_position',
            [
                'type' => 'select',
                'label' => esc_html__('Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'options' => [
                    'top-left' => esc_html__('Top Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    // 'top-center' => esc_html__('Top Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'top-right' => esc_html__('Top Right', 'unlimited-elementor-inner-sections-by-boomdevs'),

                    // 'center-left' => esc_html__('Center Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    // 'center-right' => esc_html__('Center Right', 'unlimited-elementor-inner-sections-by-boomdevs'),

                    'bottom-left' => esc_html__('Bottom Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    // 'bottom-center' => esc_html__('Bottom Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'bottom-right' => esc_html__('Bottom Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'default' => 'bottom-right',
            ]
        );

        $this->add_control(
            'pea_back_to_top_entrance_animation',
            [
                'type' => 'select',
                'label' => esc_html__('Entrance Animation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'options' => [
                    'fade' => esc_html__('Fade', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'slide-up' => esc_html__('Slide Up', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'zoom-in' => esc_html__('Zoom In', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'bounce-in' => esc_html__('Bounce In', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'default' => 'fade',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_back_to_top_content_section',
            [
                'label' => esc_html__('Content', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_back_to_top_content_type',
            [
                'type' => 'select',
                'label' => esc_html__('Content Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'options' => [
                    'text' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'icon' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'icon-text' => esc_html__('Icon & Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'pea_back_to_top_icon_type',
            [
                'label' => esc_html__('Icon Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'image' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'default' => 'icon',
                'condition' => [
                    'pea_back_to_top_content_type' => ['icon', 'icon-text'],
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_icon',
            [
                'label' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-up',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'pea_back_to_top_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_image',
            [
                'label' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::MEDIA,
                // 'default' => [
                //     'url' => Utils::get_placeholder_image_src(),
                // ],
                'condition' => [
                    'pea_back_to_top_icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_text',
            [
                'label' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Go Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'pea_back_to_top_content_type' => ['text', 'icon-text'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_back_to_top_button_style_section',
            [
                'label' => esc_html__('Back To Top button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pea_back_to_top_button_content_type',
            [
                'label' => esc_html__('Content Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'row',
                'options' => [
                    'column' => esc_html__('Column', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'row' => esc_html__('Row', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper' => 'display:flex; flex-direction: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'row' => 'row',
                    'column' => 'column',
                ],
            ]
        );
        $this->start_controls_tabs('pea_back_to_top_button_style_tabs');

        $this->start_controls_tab(
            'pea_back_to_top_button_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_back_to_top_button_background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_back_to_top_button_border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_back_to_top_button_box_shadow',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_back_to_top_button_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_back_to_top_button_background_hover',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover',
            ]
        );

        $this->add_control(
            'pea_back_to_top_button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_back_to_top_button_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_back_to_top_button_style_active_tab',
            [
                'label' => esc_html__('Active', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_back_to_top_button_background_active',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper.active',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_back_to_top_button_border_active',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper.active',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_back_to_top_button_box_shadow_active',
                'label' => esc_html__('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper.active',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_back_to_top_button_style_hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_back_to_top_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'condition' => [
                    'pea_back_to_top_presets' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_button_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'condition' => [
                    'pea_back_to_top_presets' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_button_hover_zoom',
            [
                'label' => esc_html__('Hover Zoom Effect', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 1,
                        'max' => 1.5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '',
                    'size' => 1,
                ],

                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover' => 'transform: scale({{SIZE}});',
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_button_active_scale',
            [
                'label' => esc_html__('Click Scale Effect', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 0.5,
                        'max' => 1,
                        'step' => 0.05,
                    ],
                ],
                'default' => [
                    'unit' => '',
                    'size' => 0.95,
                ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper.active' => 'transform: scale({{SIZE}});',
                ],
            ]
        );

        // $this->add_control(
        //     'pea_back_to_top_button_margin',
        //     [
        //         'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', '%', 'em'],
        //         'selectors' => [
        //             '{{WRAPPER}} .pea_back_to_top_button_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );


        $this->end_controls_section();

        $this->start_controls_section(
            'pea_back_to_top_Text_style_section',
            [
                'label' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pea_back_to_top_content_type' => ['text', 'icon-text'],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_back_to_top_text_typography',
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper span',
            ]
        );

        $this->start_controls_tabs(
            'pea_back_to_top_text_style_tabs'
        );

        $this->start_controls_tab(
            'pea_back_to_top_text_style_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        GradientTextControl::add_control($this, [
            'name'     => 'pea_back_to_top_text_color',
            'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper span',
        ]);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pea_back_to_top_text_shadow',
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_back_to_top_text_style_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        GradientTextControl::add_control($this, [
            'name'     => 'pea_back_to_top_text_color_hover',
            'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover span',
        ]);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pea_back_to_top_text_shadow_hover',
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_back_to_top_text_style_active',
            [
                'label' => esc_html__('Active', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        GradientTextControl::add_control($this, [
            'name'     => 'pea_back_to_top_text_color_active',
            'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper.active span',
        ]);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pea_back_to_top_text_shadow_active',
                'selector' => '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper.active span',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_back_to_top_icon_style_section',
            [
                'label' => esc_html__('Icon/Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pea_back_to_top_content_type' => ['icon', 'icon-text'],
                ]
            ]
        );

        $this->add_control(
            'pea_back_to_top_icon_size',
            [
                'label' => esc_html__('Icon/Image Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                // 'default' => [
                //     'unit' => 'px',
                //     'size' => 20,
                // ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper .pea_back_to_top_image_wrapper' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pea_back_to_top_icon_spacing',
            [
                'label' => esc_html__('Icon/Image Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                // 'default' => [
                //     'unit' => 'px',
                //     'size' => 10,
                // ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pea_back_to_top_icon_position',
            [
                'label' => esc_html__('Icon/Image Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                // 'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'right' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper' => 'flex-direction: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left' => 'row',
                    'right' => 'row-reverse',
                ],
            ]
        );

        $this->start_controls_tabs(
            'pea_back_to_top_icon_style_tabs'
        );

        $this->start_controls_tab(
            'pea_back_to_top_icon_style_normal',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_back_to_top_icon_color',
            [
                'label' => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                // 'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_back_to_top_icon_style_hover',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_back_to_top_icon_color_hover',
            [
                'label' => esc_html__('Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                // 'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #backToTop .pea_back_to_top_content_wropper:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $content_type = $settings['pea_back_to_top_content_type'];
        $icon_type   = $settings['pea_back_to_top_icon_type'];
        $text        = $settings['pea_back_to_top_text'];
        $icon        = $settings['pea_back_to_top_icon'];
        $image       = $settings['pea_back_to_top_image'];
        $position    = ! empty($settings['pea_back_to_top_position']) ? $settings['pea_back_to_top_position'] : 'bottom-right';
        $preset      = ! empty($settings['pea_back_to_top_presets']) ? $settings['pea_back_to_top_presets'] : 'preset-1';
        $animation   = ! empty($settings['pea_back_to_top_entrance_animation']) ? $settings['pea_back_to_top_entrance_animation'] : 'fade';
        $position_class = 'pea_back_to_top_position_' . str_replace('_', '-', $position);
        $preset_class = 'pea_back_to_top_preset_' . str_replace('_', '-', $preset);
        $animation_class = 'pea_back_to_top_entrance_' . $animation;
?>

        <div class="pea_back_to_top_button_wrapper">
            <div id="backToTop" class="pea_back_to_top_button <?php echo esc_attr($position_class . ' ' . $preset_class . ' ' . $animation_class); ?>">
                <div class="pea_back_to_top_content_wropper">

                    <?php if ($content_type === 'text') : ?>

                        <span><?php echo esc_html($text); ?></span>

                    <?php elseif ($content_type === 'icon') : ?>

                        <?php if ($icon_type === 'icon') : ?>
                            <?php \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?>
                        <?php elseif ($icon_type === 'image' && !empty($image['url'])) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="back to top">
                        <?php endif; ?>

                    <?php elseif ($content_type === 'icon-text') : ?>

                        <?php if ($icon_type === 'icon') : ?>
                            <?php \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?>
                        <?php elseif ($icon_type === 'image' && !empty($image['url'])) : ?>
                            <div class="pea_back_to_top_image_wrapper">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="back to top">
                            </div>
                        <?php endif; ?>

                        <span><?php echo esc_html($text); ?></span>

                    <?php endif; ?>

                </div>
            </div>
        </div>

<?php
    }
}
