<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;


if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class BusinessHours extends Widget_Base
{
    public function get_name()
    {
        return 'pea_business_hours';
    }

    public function get_title()
    {
        return esc_html__('Business Hours', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon()
    {
        return 'pea_business_hours_icon';
    }

    public function get_categories()
    {
        return array('prime-elementor-addons');
    }

    public function get_keywords()
    {
        return array('business', 'hours', 'opening', 'closing', 'time');
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--business-hours'];
    }

    public function get_script_depends()
    {
        return ['prime-elementor-addons--business-hours'];
    }

    public function get_timezone_options()
    {
        $timezones = \DateTimeZone::listIdentifiers();
        $options = [];
        foreach ($timezones as $tz) {
            $date = new \DateTime('now', new \DateTimeZone($tz));
            $offset = $date->format('P');


            $label = str_replace(['/', '_'], [' - ', ' '], $tz);

            $options[$tz] = $label . " (UTC $offset)";
        }

        asort($options);
        return $options;
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'pea_business_hours-element-visibility-section',
            [
                'label' => esc_html__('Element Visibility', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pea-business-show-status-switcher',
            [
                'label' => esc_html__('Show Status', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'false',
            ],
        );

        $this->add_control(
            'pea-business-monthly-schedule-switcher',
            [
                'label' => esc_html__('Monthly Schedule', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Off', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'false',
            ],
        );

        $this->add_control(
            'pea-business-remaining-time-switcher',
            [
                'label' => esc_html__('Remaining Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Off', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'true',
                'condition' => [
                    'pea-business-show-status-switcher' => 'true',
                ]
            ],

        );

        $this->add_control(
            'pea-business-utc-timezone-switcher',
            [
                'label' => esc_html__('UTC Timezone', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'true',
            ],
        );
        $this->add_control(
            'pea-business-timezone-offset-switcher',
            [
                'label' => esc_html__('Timezone Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'true',
            ],
        );
        $this->add_control(
            'pea-business-show-separator-switcher',
            [
                'label' => esc_html__('Show Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'true',
            ],
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-time-section',
            [
                'label' => esc_html__('Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pea_business_hours-timezone-track',
            [
                'label' => esc_html__('Timezone Track', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'utc' => 'Auto',
                    'local' => 'Manual',
                ],
                'default' => 'utc',
            ]
        );

        $this->add_control(
            'pea_business_hours-select-timezone',
            [
                'label' => esc_html__('Select Timezone', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => $this->get_timezone_options(),
                'default' => 'Asia/Dhaka',
                'condition' => [
                    'pea_business_hours-timezone-track' => 'local',
                ]

            ]
        );

        $this->add_control(
            'pea_business_hours-location-customize-switcher',
            [
                'label' => esc_html__('Customize Location', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('on', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('off', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'pea_business_hours-location-customize-text',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('e.g., Dhaka, Bangladesh', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Dhaka, Bangladesh', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-select-format',
            [
                'label' => esc_html__('Select Format', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hh:mm' => '12-hour (hh:mm AM/PM)',
                    'hh:mm:ss' => '12-hour (hh:mm:ss AM/PM)',
                    'HH:mm' => '24-hour (HH:mm)',
                    'HH:mm:ss' => '24-hour (HH:mm:ss)',
                ],
                'default' => 'hh:mm',
            ]
        );

        $this->add_control(
            'pea_business_hours-formated-time',
            [
                'label' => esc_html__('Formated Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('e.g., 12-hour (hh:mm AM/PM)', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-separator',
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'discription' => esc_html__('Allowed symbols only.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => '|',
                'placeholder' => esc_html__('e.g., |', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'pea-business-show-separator-switcher' => 'true'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-current-schedule',
            [
                'label' => esc_html__('Current Schedule', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'pea-business-show-status-switcher' => 'true',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-current-status',
            [
                'label' => esc_html__('Current Status', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => 'open',
            ]
        );

        $this->add_control(
            'pea_business_hours-start-time',
            [
                'label' => esc_html__('Start Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'time',
                'default' => '09:00',
            ]
        );

        $this->add_control(
            'pea_business_hours-end-time',
            [
                'label' => esc_html__('End Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'time',
                'default' => '17:00',
            ]
        );

        $this->add_control(
            'pea_business_hours-label',
            [
                'label' => esc_html__('Label', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Remaining:',
            ]
        );

        $this->add_control(
            'pea_business_hours-time-format',
            [
                'label' => esc_html__('Time Format', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hour-minutes' => 'hour minutes',
                    'h-m' => 'h m',
                    'minutes' => 'minutes',
                    'hour' => 'hour',
                ],
                'default' => 'hour-minutes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-monthly-schedule',
            [
                'label' => esc_html__('Monthly Schedule', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'pea-business-show-status-switcher' => 'true',
                    'pea-business-monthly-schedule-switcher' => 'true',
                ]
            ]
        );

        $monthly_repeater = new Repeater();

        $monthly_repeater->add_control(
            'pea_schedule_month',
            [
                'label' => esc_html__('Select Month', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'january' => esc_html__('January', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'february' => esc_html__('February', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'march' => esc_html__('March', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'april' => esc_html__('April', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'may' => esc_html__('May', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'june' => esc_html__('June', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'july' => esc_html__('July', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'august' => esc_html__('August', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'september' => esc_html__('September', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'october' => esc_html__('October', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'november' => esc_html__('November', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'december' => esc_html__('December', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $monthly_repeater->add_control(
            'pea_schedule_start_time',
            [
                'label' => esc_html__('Schedule Start Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'input_type' => 'time',
                'default' => '09:00',
            ]
        );

        $monthly_repeater->add_control(
            'pea_schedule_end_time',
            [
                'label' => esc_html__('Schedule End Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'input_type' => 'time',
                'default' => '17:00',
            ]
        );

        $this->add_control(
            'pea_business_hours-monthly-schedule-repeater',
            [
                'label' => esc_html__('Add Month Schedule', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $monthly_repeater->get_controls(),
                'title_field' => ' Choose date {{{ pea_schedule_month }}}',
                'button_text' => esc_html__('Add Schedule', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-holiday-and-weekend',
            [
                'label' => esc_html__('Holiday & Weekend', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'pea-business-show-status-switcher' => 'true',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-add-weekend',
            [
                'label' => esc_html__('Add Weekend', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => [
                    'sunday' => esc_html__('Sunday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'monday' => esc_html__('Monday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'tuesday' => esc_html__('Tuesday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'wednesday' => esc_html__('Wednesday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'thursday' => esc_html__('Thursday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'friday' => esc_html__('Friday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'saturday' => esc_html__('Saturday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'pea_holiday_date',
            [
                'label' => esc_html__('Holiday Date', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pea_business_holidays',
            [
                'label' => esc_html__('Holidays', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => ' Holiday {{{ pea_holiday_date }}}',
                'button_text' => esc_html__('Add Holiday', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-text-section',
            [
                'label' => esc_html__('Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'pea-business-show-status-switcher' => 'true',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on',
            [
                'label' => esc_html__('Status ON', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Open', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Open', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-status-off',
            [
                'label' => esc_html__('Status OFF', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Closed', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Closed', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-on-notice',
            [
                'label' => esc_html__('ON Notice', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Will start at', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Will start at', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-off-notice',
            [
                'label' => esc_html__('OFF Notice', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Will close at', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Will close at', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-weekend-info',
            [
                'label' => esc_html__('Weekend Info', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Weekend', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Weekend', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-holiday-info',
            [
                'label' => esc_html__('Holiday Info', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Holiday', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => esc_html__('Holiday', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-remaining-time-section',
            [
                'label' => esc_html__('General', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pea-business-general-alignment-style',
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
                'default' => 'start',
            ]
        );

        $this->add_control(
            'pea_business_hours-dsplay-type',
            [
                'label' => esc_html__('Display Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'block' => esc_html__('Block', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'inline' => esc_html__('Inline', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
                'default' => 'block',
            ]
        );

        $this->add_control(
            'pea_business_hours-general-gap',
            [
                'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vh', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-location-style-section',
            [
                'label' => esc_html__('Location', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pea_business_hours-location-style-tabs');
        $this->start_controls_tab(
            'pea_business_hours-location-style-normal-tabs',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_business_hours-location-style-normal-typography',
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-location-name',
            ]
        );


        $this->add_control(
            'pea_business_hours-location-style-normal-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-location-name' => 'color: {{VALUE}};',
                ]
            ]
        );



        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-location-style-hover-tabs',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );


        $this->add_control(
            'pea_business_hours-location-style-hover-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-location-name:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-separator-style-section',
            [
                'label' => esc_html__('Separator', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pea_business_hours-separator-style-tabs');
        $this->start_controls_tab(
            'pea_business_hours-separator-style-normal-tabs',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-separator-normal-style-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-timezone-separator' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-separator-normal-style-size',
            [
                'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vh', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-separator-style-hover-tabs',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-separator-hover-style-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-timezone-separator:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-time-style-section',
            [
                'label' => esc_html__('Time', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pea_business_hours-time-style-tabs');
        $this->start_controls_tab(
            'pea_business_hours-time-style-normal-tabs',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_business_hours-time-style-typography',
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-current-time',
            ]
        );

        $this->add_control(
            'pea_business_hours-time-style-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-current-time' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-time-style-hover-tabs',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-time-style-hover-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-current-time:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-timezone-style-section',
            [
                'label' => esc_html__('Timezone', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pea_business_hours-timezone-style-tabs');
        $this->start_controls_tab(
            'pea_business_hours-timezone-style-normal-tabs',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_business_hours-timezone-style-typography',
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-timezone-offset',
            ]
        );

        $this->add_control(
            'pea_business_hours-timezone-style-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#b1ababff',
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-timezone-offset' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-timezone-style-hover-tabs',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-timezone-style-hover-color',
            [
                'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-timezone-offset:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-timezone-card-style-section',
            [
                'label' => esc_html__('Timezone Card', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('pea_business_hours-timezone-card-style-tabs');
        $this->start_controls_tab(
            'pea_business_hours-timezone-card-style-normal-tabs',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_business_hours-timezone-card-style-background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-wrapper',
                'default' => '#000000',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-timezone-card-style-border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-wrapper',

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-timezone-card-style-hover-tabs',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_business_hours-timezone-card-style-hover-background',
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-wrapper:hover',

            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-timezone-card-style-border-hover',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea_business_hours-wrapper:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_business_hours-timezone-card-hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'pea_business_hours-timezone-card-border-radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 999,
                    'right' => 999,
                    'bottom' => 999,
                    'left' => 999
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-timezone-card-padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]

        );

        $this->add_control(
            'pea_business_hours-timezone-card-margin',
            [
                'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .pea_business_hours-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-status-on-off-style',
            [
                'label' => esc_html__('Status ON/OFF', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pea_business_hours-status-on-off-typography',
                'label' => esc_html__('Typography', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status',
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on-off-padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-status-on-style',
            [
                'label' => esc_html__('Status ON', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'pea_business_hours-status-on-style-tabs'
        );

        $this->start_controls_tab(
            'pea_business_hours-status-on-style-tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on-background-color',
            [
                'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .open ' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on-text-color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .open ' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-status-on-border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .open'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-status-on-style-hover-tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on-background-color-hover',
            [
                'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .open:hover ' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on-text-color-hover',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .open:hover ' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-status-on-border-hover',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .open:hover'
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_business_hours-status-on-border-hr',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->add_control(
            'pea_business_hours-status-on-border-radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .open' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 999,
                    'right' => 999,
                    'bottom' => 999,
                    'left' => 999
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-status-off-style',
            [
                'label' => esc_html__('Status OFF', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'pea_business_hours-status-off-style-tabs'
        );

        $this->start_controls_tab(
            'pea_business_hours-status-off-style-tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-status-off-background-color',
            [
                'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .closed ' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-status-off-text-color',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .closed ' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-status-off-border',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .closed'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-status-off-style-hover-tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-status-of-background-color-hover',
            [
                'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .closed:hover ' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-status-off-text-color-hover',
            [
                'label' => esc_html__('Text Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .closed:hover ' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-status-off-border-hover',
                'label' => esc_html__('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .closed:hover'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_business_hours-status-off-border-hr',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->add_control(
            'pea_business_hours-status-off-border-radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .closed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 999,
                    'right' => 999,
                    'bottom' => 999,
                    'left' => 999
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_business_hours-notice-info-box-style',
            [
                'label' => esc_html__('Notice Info Box', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'pea_business_hours-notice-info-box-style-tabs'
        );
        $this->start_controls_tab(
            'pea_business_hours-notice-info-box-style-normal-tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-info-box-status-on-lebel',
            [
                'label' => esc_html__('Status On normal control', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-on-background',
                'label' => esc_html__('On Status Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-on-border',
                'label' => esc_html__('On Status Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-on-box-shadow',
                'label' => esc_html__('On Status Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper'
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-notice-info-box-style-hover-tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-info-box-status-on-hover-lebel',
            [
                'label' => esc_html__('Status On hover control', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-on-background-hover',
                'label' => esc_html__('On Status Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-on-border-hover',
                'label' => esc_html__('On Status Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-on-box-shadow-hover',
                'label' => esc_html__('On Status Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper:hover'
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_business_hours-notice-info-box-hr',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->start_controls_tabs(
            'pea_business_hours-notice-info-status-on-style-tabs'
        );
        $this->start_controls_tab(
            'pea_business_hours-notice-info-status-on-style-normal-tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-info-box-status-off-lebel',
            [
                'label' => esc_html__('Status Off normal control', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-off-background',
                'label' => esc_html__('On Status Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper-closed'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-off-border',
                'label' => esc_html__('On Status Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper-closed'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-off-box-shadow',
                'label' => esc_html__('On Status Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper-closed'
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'pea_business_hours-notice-info-status-on-style-hover-tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-info-box-status-off-hover-lebel',
            [
                'label' => esc_html__('Status Off hover control', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-off-background-hover',
                'label' => esc_html__('On Status Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper-closed:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-off-border-hover',
                'label' => esc_html__('On Status Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper-closed:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pea_business_hours-notice-info-box-status-off-box-shadow-hover',
                'label' => esc_html__('On Status Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-timezone-status-wrapper-closed:hover'
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_business_hours-notice-info-border-radius-hr',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->add_responsive_control(
            'pea_business_hours-notice-info-border-radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-wrapper , {{WRAPPER}} .pea-timezone-status-wrapper-closed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pea_business_hours-notice-info-margin',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-wrapper , {{WRAPPER}} .pea-timezone-status-wrapper-closed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'pea_business_hours-notice-text-style',
            [
                'label' => esc_html__('Notice Text', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'pea_business_hours-notice-text-style-tabs'
        );
        $this->start_controls_tab(
            'pea_business_hours-notice-text-style-normal-tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-stutus-on-text-color',
            [
                'label' => esc_html__('Status ON Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-wrapper' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-stutus-off-text-color',
            [
                'label' => esc_html__('Status OFF Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-wrapper-closed' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'pea_business_hours-notice-text-style-hover-tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-stutus-on-text-hover-color',
            [
                'label' => esc_html__('Status ON Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-wrapper:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'pea_business_hours-notice-stutus-off-text-hover-color',
            [
                'label' => esc_html__('Status OFF Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-wrapper-closed:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_business_hours-notice-text-margin-style',
            [
                'label' => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
                'selectors' => [
                    '{{WRAPPER}} .pea-timezone-status-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $locationCustomizeText = $settings['pea_business_hours-location-customize-text'];
        $separator = $settings['pea_business_hours-separator'];
        $TimezoneOffset = $settings['pea-business-timezone-offset-switcher'];
        $ShowSeparator = $settings['pea-business-show-separator-switcher'];
        $ShowStatus = $settings['pea-business-show-status-switcher'];
        $endTime = $settings['pea_business_hours-end-time'];
        $statusON = $settings['pea_business_hours-status-on'];
        $statusOFF = $settings['pea_business_hours-status-off'];
        $onNotice = $settings['pea_business_hours-on-notice'];
        $offNotice = $settings['pea_business_hours-off-notice'];
        $remainingTime = $settings['pea-business-remaining-time-switcher'];
        $weekendInfo = $settings['pea_business_hours-add-weekend'];
        $holidayInfo = $settings['pea_business_holidays'];
        $customizeLocation = $settings['pea_business_hours-location-customize-switcher'];
        $monthlySchedule = $settings['pea_business_hours-monthly-schedule-repeater'];
        $selectedTimezone = $settings['pea_business_hours-select-timezone'];

        // Style settings
        $GeneralAlignment = $settings['pea-business-general-alignment-style'];
        $GeneralGap = $settings['pea_business_hours-general-gap']['size'] . $settings['pea_business_hours-general-gap']['unit'];
        $separatorSize = $settings['pea_business_hours-separator-normal-style-size']['size'] . $settings['pea_business_hours-separator-normal-style-size']['unit'];
        $generalDisplayType = $settings['pea_business_hours-dsplay-type']


            ?>
        <?php
        // build wrapper inline style so we don't repeat the attribute and lose earlier rules
        $wrapper_styles = [];
        if ($generalDisplayType === 'block') {
            $wrapper_styles[] = 'flex-direction: column';
            $wrapper_styles[] = 'justify-content: start';
            $wrapper_styles[] = 'align-items: ' . esc_attr($GeneralAlignment);
        }
        $wrapper_styles[] = 'justify-content: ' . esc_attr($GeneralAlignment);
        $wrapper_styles[] = 'gap: ' . esc_attr($GeneralGap);
        $wrapper_style_attr = implode('; ', $wrapper_styles);
        ?>
        <div class="pea-timezone-main-wrapper" style="<?php echo esc_attr($wrapper_style_attr); ?>"
            data-utc-timezone-switcher="<?php echo esc_attr($settings['pea-business-utc-timezone-switcher']); ?>"
            data-timezone-offset-switcher="<?php echo esc_attr($settings['pea-business-timezone-offset-switcher']); ?>"
            data-time-format="<?php echo esc_attr($settings['pea_business_hours-select-format']); ?>"
            data-end-time="<?php echo esc_attr($settings['pea_business_hours-end-time']); ?>"
            data-start-time="<?php echo esc_attr($settings['pea_business_hours-start-time']); ?>"
            data-end-format="<?php echo esc_attr($settings['pea_business_hours-time-format']) ?>"
            data-status-off="<?php echo esc_attr($statusOFF); ?>" data-off-notice="<?php echo esc_attr($offNotice); ?>"
            data-on-notice="<?php echo esc_attr($onNotice); ?>" data-status-on="<?php echo esc_attr($statusON); ?>"
            data-weekend-info="<?php echo esc_attr(wp_json_encode($weekendInfo)); ?>"
            data-holiday-info="<?php echo esc_attr(wp_json_encode($holidayInfo)); ?>"
            data-monthly-schedule="<?php echo esc_attr(wp_json_encode($monthlySchedule)); ?>"
            data-weekend-text="<?php echo esc_attr($settings['pea_business_hours-weekend-info']); ?> "
            data-holiday-text="<?php echo esc_attr($settings['pea_business_hours-holiday-info']); ?> "
            data-remaining-lebel="<?php echo esc_attr($settings['pea_business_hours-label']); ?>"
            data-selected-timezone="<?php echo esc_attr($selectedTimezone) ?>">

            <div class="pea_business_hours-wrapper">
                <?php if ($customizeLocation === 'true') { ?>

                    <span class="pea_business_hours-location-custom-name">
                        <?php echo esc_html($locationCustomizeText); ?>
                    </span>
                <?php } else { ?>
                    <span class="pea_business_hours-location-name"></span>
                <?php } ?>
                <?php if ($ShowSeparator === 'true') {
                    ?>
                    <span class="pea_business_hours-timezone-separator" style="font-size: <?php echo esc_html($separatorSize) ?>;">
                        <?php echo esc_html($separator); ?>
                    </span>
                    <?php
                }
                ?>
                <span class="pea_business_hours-current-time"></span>
                <?php if ($TimezoneOffset === 'true') {
                    ?>
                    <span class="pea_business_hours-timezone-offset"></span>
                    <?php
                } ?>
            </div>


            <?php if ($ShowStatus === 'true') { ?>
                <div class="pea-timezone-status-wrapper">
                    <div class="pea-timezone-status-info-box open">
                        <span class="pea-timezone-status">
                            <?php echo esc_html($statusON); ?>
                        </span>
                    </div>
                    <div class="pea-timezone-status-info">
                        <span class="pea-timezone-info-noted">

                            <span class="pea-timezone-status-off-notice"> <?php echo esc_html($offNotice); ?> </span>

                            <span class="pea-timezone-end-time"> <?php echo esc_html($endTime); ?> </span>

                            <?php if ($remainingTime === 'true') { ?>
                                <span class="pea-timezone-remaining-time"></span>
                            <?php } ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php

    }
}
