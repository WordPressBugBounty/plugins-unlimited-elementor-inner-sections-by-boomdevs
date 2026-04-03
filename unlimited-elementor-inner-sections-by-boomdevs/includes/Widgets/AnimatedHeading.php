<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class AnimatedHeading extends Widget_Base
{

    public function get_name()
    {
        return 'animated-heading';
    }

    public function get_title()
    {
        return esc_html__('Animated Heading', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_categories()
    {
        return array('prime-elementor-addons');
    }

    public function get_icon()
    {
        return 'pea_animated_heading_icon';
    }

    public function get_keywords()
    {
        return array('animated', 'heading');
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--animated-heading'];
    }

    public function get_script_depends()
    {
        return ['prime-elementor-addons--animated-heading'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'animated_heading_content_section',
            [
                'label' => esc_html__('Genarel', 'unlimited-elementor-inner-sections-by-boomdevs')
            ]
        );

        $this->add_control(
            'animated_heading_animation_type',
            [
                'label' => esc_html__('Animation Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'Typing',
                'options' => [
                    'Typing' => 'Typing',
                    'Swirl' => 'Swirl',
                    'FlipWave' => 'FlipWave',
                ]
            ],
        );

        $this->add_control(
            'pea_animated_heading_alinment',
            [
                'label' => __('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .pea-animated-heading-text' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_animated_heading_html_tag',
            [
                'label' => esc_html__('Html Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1' => 'h1',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5',
                    'h6' => 'h6',
                    'p' => 'p',
                    'span' => 'span',
                ]
            ],
        );

        $this->add_control(
            'animated_heading_prefix-text',
            [
                'label' => esc_html__('Prefix Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => 'We create',
            ],
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'animated_heading_item_text',
            [
                'label' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'animated_heading_item',
            [
                'label' => esc_html__('Text Items', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ animated_heading_item_text }}}',
                'default' => [
                    [
                        'animated_heading_item_text' => 'WordPress Plugins',
                    ],
                    [
                        'animated_heading_item_text' => 'WordPress Themes',
                    ],
                    [
                        'animated_heading_item_text' => 'WooCommerce Extensions',
                    ],
                    [
                        'animated_heading_item_text' => 'Custom Web Solutions',
                    ],
                ],
            ]
        );


        $this->add_control(
            'pea_animated_heading_cursor_switch',
            [
                'label' => esc_html__('Cursor Switch', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('ON', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('OFF', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'animated_heading_animation_type' => 'Typing'
                ]
            ]
        );

        $this->add_control(
            'pea_animated_heading_cursor',
            [
                'label' => esc_html__('Cursor', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => '|',
                'condition' => [
                    'pea_animated_heading_cursor_switch' => 'yes',
                    'animated_heading_animation_type' => 'Typing'
                ]
            ]
        );

        $this->add_control(
            'animated_heading_suffix-text',
            [
                'label' => esc_html__('Suffix Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
            ],
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_animated_heading_animated_text_style_section',
            [
                'label' => esc_html__('Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pea_animated_heading_animated_text_tabs');

        $this->start_controls_tab(
            'pea_animated_heading_animated_text_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );


        $this->add_control(
            'pea_animated_heading_text_color',
            [
                'label' => esc_html__('Normal Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea-animated-normal-text' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'pea_animated_heading_animated_text_color',
            [
                'label' => esc_html__('Animated Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#92003b',
                'selectors' => [
                    '{{WRAPPER}} .pea-animated-heading-animated-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_animated_heading_animated_text_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_animated_heading_text_hover_color',
            [
                'label' => esc_html__('Normal Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .pea-animated-normal-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pea_animated_heading_animated_text_hover_color',
            [
                'label' => esc_html__('Animated Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-animated-heading-animated-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_animated_heading_text_typography-prefix-hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_animated_heading_text_typography',
                'label' => esc_html__('Normal Text Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-animated-normal-text',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_animated_heading_animated_text_typography',
                'label' => esc_html__('Animated Text Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-animated-heading-animated-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $animationType = $settings['animated_heading_animation_type'];
        $htmlTag = $settings['pea_animated_heading_html_tag'];
        $prefixText = $settings['animated_heading_prefix-text'];
        $suffixText = $settings['animated_heading_suffix-text'];
        $items = $settings['animated_heading_item'];
        $cursor = $settings['pea_animated_heading_cursor'];
        $alignment = isset($settings['pea_animated_heading_alinment']) ? $settings['pea_animated_heading_alinment'] : 'left';
?>

        <div class="pea-animated-heading-wrapper" data-animation="<?php echo esc_attr($animationType); ?>"
            style=" text-align:<?php echo esc_attr($alignment); ?>;">

            <<?php echo esc_attr($htmlTag); ?> class="pea-animated-heading-text">

                <span class="pea-animated-heading-prefix-text pea-animated-normal-text ">
                    <?php echo esc_html($prefixText); ?>
                </span>

                <span class="pea-animated-heading-animated-text">
                    <?php
                    if (!empty($items)) {
                        foreach ($items as $index => $item) {
                            echo '<span class="pea-animated-heading-animation-item" 
                            data-index="' . esc_attr($index) . '">'
                                . esc_html($item['animated_heading_item_text']) .
                                '</span>';
                        }
                    }
                    ?>

                    <?php if ($animationType === 'Typing' && !empty($settings['pea_animated_heading_cursor_switch']) && $settings['pea_animated_heading_cursor_switch'] === 'yes'): ?>
                        <span class="pea-animated-heading-cursor">
                            <?php echo esc_html($cursor); ?>
                        </span>
                    <?php endif; ?>
                </span>

                <span class="pea-animated-heading-suffix-text pea-animated-normal-text">
                    <?php echo esc_html($suffixText); ?>
                </span>

            </<?php echo esc_attr($htmlTag); ?>>
        </div>
<?php
    }
}
