<?php
/**
 * Scrollbar Styler — Site Settings tab definition.
 *
 * File name MUST match the class name exactly (PSR-4 rule):
 *   Class:  Scrollbar_Styler_Settings
 *   File:   Scrollbar_Styler_Settings.php   ← note: not class-scrollbar-styler-settings.php
 *
 * Composer maps:
 *   PrimeElementorAddons\  →  src/
 * So this file lives at:
 *   src/Extensions/ScrollBarStyler/Scrollbar_Styler_Settings.php
 *
 * @package PrimeElementorAddons\Extensions\ScrollBarStyler
 * @since   1.0.0
 */

namespace PrimeElementorAddons\Extensions\ScrollBarStyler;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ScrollbarStylerTab extends Tab_Base {

    // -------------------------------------------------------------------------
    //  Tab metadata (required by Tab_Base)
    // -------------------------------------------------------------------------

    public function get_id(): string {
        return 'pea-page-scrollbar-styler-tab';
    }

    public function get_title(): string {
        return esc_html__( 'Page ScrollBar Styler (PEA)', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon(): string {
        return 'pea_page_scrollbar_icon';
    }

    public function get_custom_help_url(): string {
        return 'https://your-docs-url.com/scrollbar-styler/';
    }

    public function get_help_url(): string {
        return $this->get_custom_help_url();
    }

    public function get_group(): string {
        return 'theme-style';
    }

    // -------------------------------------------------------------------------
    //  Controls registration
    // -------------------------------------------------------------------------

    protected function register_tab_controls(): void {
        $this->start_controls_section(
            'pea_page_scrollbar_settings',
            [
                'tab'   => $this->get_id(),
                'label' => esc_html__( 'Page ScrollBar Settings', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

            $this->add_control(
                'prime_scrollbar_hide',
                [
                    'label'        => esc_html__( 'Hide Scrollbar Visually', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off'    => esc_html__( 'No',  'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'description'  => esc_html__( 'Hide the scrollbar but keep the page scrollable. It also hide the native browser scrollbar', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

            // $this->add_control(
            //     'prime_scrollbar_apply_to',
            //     [
            //         'label'   => esc_html__( 'Apply To', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            //         'type'    => Controls_Manager::SELECT,
            //         'options' => [
            //             'global' => esc_html__( 'Whole Page (html, body)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            //             'body'   => esc_html__( 'Body Only',                'unlimited-elementor-inner-sections-by-boomdevs' ),
            //         ],
            //         'default' => 'global',
            //         'condition' => [
            //             'prime_scrollbar_hide!' => 'yes',
            //         ]
            //     ]
            // );

            $this->add_control(
                'prime_scrollbar_auto_hide',
                [
                    'label'   => __('Auto Hide', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'never',
                    'options' => [
                        'never' => __('Never', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'scroll' => __('While Scrolling', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'leave' => __('Mouse Leave', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'move' => __('Mouse Move', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ],
                    'condition' => [
                        'prime_scrollbar_hide!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'prime_scrollbar_auto_hide_delay',
                [
                    'label' => __('Auto Hide Delay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'  => Controls_Manager::NUMBER,
                    'default' => 800,
                    'min' => 0,
                    'max' => 5000,
                    'condition' => [
                        'prime_scrollbar_hide!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'prime_scrollbar_wheel_speed',
                [
                    'label' => __('Wheel Speed', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0.1,
                            'max' => 5,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'size' => 1,
                    ],
                ]
            );

            $this->add_control(
                'prime_scrollbar_position',
                [
                    'label' => __('Scrollbar Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'  => Controls_Manager::CHOOSE,
                    'default' => 'right',
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon'  => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'prime_scrollbar_hide!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'prime_scrollbar_smooth_scroll',
                [
                    'label'        => esc_html__( 'Smooth Scroll (CSS)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On',  'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off'    => esc_html__( 'Off', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'description'  => esc_html__( 'Adds scroll-behavior: smooth to html. Disable if another plugin handles smooth scroll.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'pea_page_scrollbar_styling',
            [
                'tab'   => $this->get_id(),
                'label' => esc_html__( 'Page ScrollBar Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );
            $this->register_track_controls();
            $this->register_thumb_controls();

        $this->end_controls_section();
    }

    // -------------------------------------------------------------------------
    //  Control groups
    // -------------------------------------------------------------------------

    private function register_track_controls(): void {
        $this->add_control(
            'prime_scrollbar_track_heading',
            [
                'label' => esc_html__( 'Track', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'prime_scrollbar_width',
            [
                'label'      => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 2, 'max' => 32, 'step' => 1 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 10 ],
            ]
        );

        $this->add_control(
            'prime_scrollbar_track_radius',
            [
                'label'      => esc_html__( 'Track Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 20, 'step' => 1 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 0 ],
            ]
        );

        $this->add_control(
            'prime_scrollbar_track_color',
            [
                'label'   => esc_html__( 'Track Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
            ]
        );

        $this->add_control(
            'prime_scrollbar_track_hover_color',
            [
                'label'   => esc_html__( 'Track Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '#f1f1f1',
            ]
        );
    }

    private function register_thumb_controls(): void {
        $this->add_control(
            'prime_scrollbar_thumb_heading',
            [
                'label'     => esc_html__( 'Thumb', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'prime_scrollbar_thumb_tabs' );
            $this->start_controls_tab(
                'prime_scrollbar_thumb_tab_normal',
                [ 'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) ]
            );
                $this->add_control(
                    'prime_scrollbar_thumb_color',
                    [
                        'label'   => esc_html__( 'Thumb Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'    => Controls_Manager::COLOR,
                        'default' => '#aaaaaa',
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'prime_scrollbar_thumb_tab_hover',
                [ 'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ) ]
            );
                $this->add_control(
                    'prime_scrollbar_thumb_hover_color',
                    [
                        'label'   => esc_html__( 'Thumb Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type'    => Controls_Manager::COLOR,
                        'default' => '#666666',
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'prime_scrollbar_thumb_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 50, 'step' => 1 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 10 ],
            ]
        );
    }
}