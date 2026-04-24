<?php

namespace PrimeElementorAddons\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use PrimeElementorAddons\Controls\TextStrokeControl;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


class AdvancedParagraph extends Widget_Base
{

    public function get_name()
    {
        return 'pea_advanced_paragraph';
    }

    public function get_title()
    {
        return __('Advanced Paragraph', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_categories()
    {
        return array('prime-elementor-addons');
    }

    public function get_icon()
    {
        return 'pea_advanced_paragraph_icon';
    }

    public function get_keywords()
    {
        return array('advanced', 'paragraph', 'text', 'dropcap');
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--advanced-paragraph'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'advanced_paragraph_content_section',
            [
                'label' => esc_html__('General', 'unlimited-elementor-inner-sections-by-boomdevs')
            ]
        );

        $this->add_control(
            'advanced_paragraph_dropcap',
            [
                'label' => __('Enable Drop Cap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'description' => __('Make the first letter of the paragraph larger.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'advanced_paragraph_colummns_prefix_hr',
            [
                'type' => Controls_Manager::DIVIDER
            ],
        );


        $this->add_control(
            'advanced_paragraph_columns',
            [
                'label' => __('Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'description' => __('Split your paragraph into multiple columns for a modern, magazine-style look.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => ['min' => 1, 'max' => 6],
                ],
                'selectors' => [
                    '{{WRAPPER}} .advanced-paragraph-text-wrapper' => 'column-count: {{SIZE}};',
                ],
            ],
        );

        $this->add_control(
            'advanced_paragraph_colummns_gap',
            [
                'label' => __('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'description' => __('Adjust the spacing between text columns.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 2000],
                    '%' => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 100],
                ],
                'condition' => [
                    'advanced_paragraph_columns[size]!' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .advanced-paragraph-text-wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ],
        );

        $this->add_control(
            'advanced_paragraph_alignment_suffix_hr',
            [
                'type' => Controls_Manager::DIVIDER
            ],
        );


        $this->add_control(
            'advanced_paragraph_tect_alignment',
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
                    '{{WRAPPER}} .advanced-paragraph-text-wrapper p' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'advanced_paragraph_dropcap!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'advanced_paragraph_text',
            [
                'label' => __('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Write your advanced paragraph ...',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'advanced_paragraph_style_section',
            [
                'label' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'advanced_paragraph_text_typography',
                'label' => __('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .advanced-paragraph-text-wrapper p',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'advanced_paragraph_text_shadow',
                'label' => __('Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .advanced-paragraph-text-wrapper p',
            ],
        );

        $this->add_control(
            'advanced_paragraph_tabs_prefix_hr',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->start_controls_tabs('advanced_paragraph_tabs');
        $this->start_controls_tab(
            'advanced_paragraph_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'advanced_paragraph_text_color',
            [
                'label' => __('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .advanced-paragraph-text-wrapper p' => 'color: {{VALUE}};',
                ]
            ]
        );

        TextStrokeControl::add_control($this, [
            'name' => 'advanced_paragraph_text_stroke',
            'label' => esc_html__('Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'selector' => '{{WRAPPER}} .advanced-paragraph-text-wrapper p', // CSS selector for the element
        ]);

        $this->end_controls_tab();
        $this->start_controls_tab(
            'advanced_paragraph_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'advanced_paragraph_text_color_hover',
            [
                'label' => __('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .advanced-paragraph-text-wrapper p:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'advanced_paragraph_text_stroke_color_hover',
            [
                'label' => __('Text Stroke Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .advanced-paragraph-text-wrapper p:hover' => '-webkit-text-stroke-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $text = $settings['advanced_paragraph_text'];
        $dropcap = $settings['advanced_paragraph_dropcap'];
        $dropcap_class = ($dropcap === 'yes') ? 'drop-cap' : '';

?>
        <div class="advanced-paragraph-text-wrapper">
            <p class="<?php echo esc_attr($dropcap_class); ?>"> <?php echo esc_html($text); ?> </p>
        </div>
<?php
    }
}
