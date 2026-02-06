<?php

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\GradientTextControl;
use PrimeElementorAddons\Utils\TextStrokeControl;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class AdvancedVideo extends \Elementor\Widget_Base {

    public function get_name() {
        return 'pea_advanced_video';
    }

    public function get_title() {
        return esc_html__('Advanced Video', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_icon() {
        return 'pea_advanced_video_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }

    public function get_keywords() {
        return ['video', 'youtube', 'vimeo', 'player', 'embed'];
    }

    public function get_style_depends() {
        return ['prime-elementor-addons--advanced-video'];
    }

    public function get_script_depends() {
        return ['prime-elementor-addons--advanced-video'];
    }

    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // Video Source Section
        $this->start_controls_section(
            'video_section',
            [
                'label' => __('Video', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_source',
            [
                'label' => __('Source', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube' => __('YouTube', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'vimeo' => __('Vimeo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'dailymotion' => __('Dailymotion', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'hosted' => __('Self Hosted', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        // YouTube URL
        $this->add_control(
            'youtube_url',
            [
                'label' => __('YouTube URL', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://www.youtube.com/watch?v=VIDEO_ID',
                'default' => 'https://www.youtube.com/watch?v=8U0K_wMcUPg',
                'label_block' => true,
                'condition' => [
                    'video_source' => 'youtube',
                ],
            ]
        );

        // Vimeo URL
        $this->add_control(
            'vimeo_url',
            [
                'label' => __('Vimeo URL', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://vimeo.com/VIDEO_ID',
                'default' => 'https://vimeo.com/226053498',
                'label_block' => true,
                'condition' => [
                    'video_source' => 'vimeo',
                ],
            ]
        );

        // Dailymotion URL
        $this->add_control(
            'dailymotion_url',
            [
                'label' => __('Dailymotion URL', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://www.dailymotion.com/video/VIDEO_ID',
                'default' => 'https://www.dailymotion.com/video/x9qcr0c',
                'label_block' => true,
                'condition' => [
                    'video_source' => 'dailymotion',
                ],
            ]
        );

        // Self Hosted Video
        $this->add_control(
            'hosted_video',
            [
                'label' => __('Choose Video', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'video',
                'condition' => [
                    'video_source' => 'hosted',
                ],
            ]
        );

        // External URL for self-hosted
        $this->add_control(
            'external_url',
            [
                'label' => __('External URL', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'https://example.com/video.mp4',
                'label_block' => true,
                'condition' => [
                    'video_source' => 'hosted',
                ],
            ]
        );

        $this->end_controls_section();

        // Video Options Section
        $this->start_controls_section(
            'video_options_section',
            [
                'label' => __('Video Options', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => 'no',
                'description'  => __( 'Note:- Autoplay work when overlay is off', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'mute',
            [
                'label' => __('Mute', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'default' => 'no',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => __('Player Controls', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'modest_branding',
            [
                'label' => __('Modest Branding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'description' => __('Hide YouTube logo', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'condition' => [
                    'video_source' => 'youtube',
                ],
            ]
        );

        $this->end_controls_section();

        // Image Overlay Section
        $this->start_controls_section(
            'image_overlay_section',
            [
                'label' => __('Image Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'show_image_overlay',
            [
                'label' => __('Show Image Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'overlay_background_image',
                'types'     => [ 'classic' ],
                // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                'exclude'        => [ 'color' ],
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                        'label'     => __( 'Background Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    ],
                    'image' => [
                        'default' => [
                            'url' => PEA_PLUGIN_URL . 'assets/images/advanced-video-overlay.jpg',
                        ],
                    ],
                    'size' => [
                        'default' => 'cover',
                    ],
                    'position' => [
                        'default' => 'center center',
                    ],
                ],
                'selector'  => '{{WRAPPER}} .pea-advanced-video-overlay',
                'condition' => [
                    'show_image_overlay' => 'yes',
                ],
                'render_type'  => 'template',
            ]
        );

        $this->add_control(
            'show_play_icon',
            [
                'label' => __('Show Play Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'show_image_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'play_icon',
            [
                'label' => __('Play Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_image_overlay' => 'yes',
                    'show_play_icon' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Aspect Ratio Section
        $this->start_controls_section(
            'aspect_ratio_section',
            [
                'label' => __('Aspect Ratio', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'aspect_ratio',
            [
                'label' => __('Aspect Ratio', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '169' => '16:9',
                    '219' => '21:9',
                    '43' => '4:3',
                    '32' => '3:2',
                    '916' => '9:16',
                    '11' => '1:1',
                ],
                'default' => '169',
            ]
        );

        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================

        // Video Styling Section
        $this->start_controls_section(
            'video_style',
            [
                'label' => __('Video', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'video_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px','em', 'rem','vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-video-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'video_tabs' );
                $this->start_controls_tab(
                    'video_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'video_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-advanced-video-wrapper',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'video_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'video_border_hover_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-video-wrapper:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'video_border_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'video_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 16,
                        'right' => 16,
                        'bottom' => 16,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-video-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        

        $this->end_controls_section();

        // Play Icon Styling Controls
        $this->start_controls_section(
            'play_icon_style',
            [
                'label' => __('Play Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image_overlay' => 'yes',
                    'show_play_icon' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'play_icon_size',
            [
                'label' => __('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-advanced-video-play-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-advanced-video-play-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

            $this->start_controls_tabs( 'play_icon_tabs' );
                $this->start_controls_tab(
                    'play_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'play_icon_color',
                        [
                            'label' => __('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-video-play-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-advanced-video-play-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'play_icon_bg_color',
                        [
                            'label' => __('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-video-play-icon' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'play_icon_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-advanced-video-play-icon',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 1,
                                        'right' => 1,
                                        'bottom' => 1,
                                        'left' => 1,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#FFFFFF',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'play_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );  

                    $this->add_control(
                        'play_icon_hover_color',
                        [
                            'label' => __('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-video-play-icon:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-advanced-video-play-icon:hover svg' => 'fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'play_icon_bg_hover_color',
                        [
                            'label' => __('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-video-play-icon:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'play_icon_border_hover_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-video-play-icon:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();

            $this->add_responsive_control(
                'play_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 50,
                        'right' => 50,
                        'bottom' => 50,
                        'left' => 50,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-video-play-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'play_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 20,
                        'right' => 20,
                        'bottom' => 20,
                        'left' => 20,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-video-play-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Overlay Styling Section
        $this->start_controls_section(
            'overlay_style',
            [
                'label' => __('Overlay', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image_overlay' => 'yes',
                ],
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'overlay_background_color',
                    'types' => ['classic', 'gradient'],
                    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                    'exclude' => [ 'image' ],
                    'fields_options' => [
                        'background' => [
                            'default' => 'classic',
                        ],
                        'color' => [
                            'default' => 'transparent',
                        ],
                    ],
                    'selector' => '{{WRAPPER}} .pea-advanced-video-overlay::before',
                ]
            );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $video_source = $settings['video_source'];
        
        $wrapper_class = 'pea-widget-wrapper pea-advanced-video-wrapper';
        $wrapper_class .= ' aspect-ratio-' . $settings['aspect_ratio'];
        
        ?>
        <div class="<?php echo esc_attr($wrapper_class); ?>" data-video-source="<?php echo esc_attr($video_source); ?>">
            <?php
            if ($settings['show_image_overlay'] === 'yes') {
                $this->render_image_overlay($settings);
            }
            
            switch ($video_source) {
                case 'youtube':
                    $this->render_youtube_video($settings);
                    break;
                case 'vimeo':
                    $this->render_vimeo_video($settings);
                    break;
                case 'dailymotion':
                    $this->render_dailymotion_video($settings);
                    break;
                case 'hosted':
                    $this->render_hosted_video($settings);
                    break;
            }
            ?>
        </div>
        <?php
    }

    private function render_image_overlay($settings) {
        $overlay_class = 'pea-advanced-video-overlay';
        ?>
        <div class="<?php echo esc_attr($overlay_class); ?>" >
            <?php if ($settings['show_play_icon'] === 'yes') : ?>
                <div class="pea-advanced-video-play-icon">
                    <?php \Elementor\Icons_Manager::render_icon($settings['play_icon'], ['aria-hidden' => 'true']); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    private function render_youtube_video($settings) {
        $video_url = $settings['youtube_url'];
        $video_id = $this->get_youtube_id($video_url);
        
        if (empty($video_id)) {
            echo '<p>' . esc_html__('Invalid YouTube URL', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        $params = [
            'mute' => $settings['mute'] === 'yes' ? 1 : 0,
            'loop' => $settings['loop'] === 'yes' ? 1 : 0,
            'controls' => $settings['controls'] === 'yes' ? 1 : 0,
            'modestbranding' => $settings['modest_branding'] === 'yes' ? 1 : 0,
            'rel' => 0,
        ];
        if($settings['show_image_overlay'] !== 'yes'){
            $params['autoplay'] = ( $settings['autoplay'] === 'yes' ? 1 : 0);
        }

        if ($settings['loop'] === 'yes') {
            $params['playlist'] = $video_id;
        }

        $embed_url = add_query_arg($params, "https://www.youtube.com/embed/{$video_id}");
        
        $this->render_iframe($embed_url, 'YouTube video player');
    }

    private function render_vimeo_video($settings) {
        $video_url = $settings['vimeo_url'];
        $video_id = $this->get_vimeo_id($video_url);
        
        if (empty($video_id)) {
            echo '<p>' . esc_html__('Invalid Vimeo URL', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        $params = [
            'muted' => $settings['mute'] === 'yes' ? 1 : 0,
            'loop' => $settings['loop'] === 'yes' ? 1 : 0,
            'controls' => $settings['controls'] === 'yes' ? 1 : 0,
        ];
        if($settings['show_image_overlay'] !== 'yes'){
            $params['autoplay'] = ( $settings['autoplay'] === 'yes' ? 1 : 0);
        }

        $embed_url = add_query_arg($params, "https://player.vimeo.com/video/{$video_id}");
        
        $this->render_iframe($embed_url, 'Vimeo video player');
    }

    private function render_dailymotion_video($settings) {
        $video_url = $settings['dailymotion_url'];
        $video_id = $this->get_dailymotion_id($video_url);
        
        if (empty($video_id)) {
            echo '<p>' . esc_html__('Invalid Dailymotion URL', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        $params = [
            'mute' => $settings['mute'] === 'yes' ? 1 : 0,
            'loop' => $settings['loop'] === 'yes' ? 1 : 0,
            'controls' => $settings['controls'] === 'yes' ? 1 : 0,
        ];
        if($settings['show_image_overlay'] !== 'yes'){
            $params['autoplay'] = ( $settings['autoplay'] === 'yes' ? 1 : 0);
        }

        $embed_url = add_query_arg($params, "https://www.dailymotion.com/embed/video/{$video_id}");
        
        $this->render_iframe($embed_url, 'Dailymotion video player');
    }

    private function render_hosted_video($settings) {
        $video_url = '';
        
        if (!empty($settings['external_url'])) {
            $video_url = $settings['external_url'];
        } elseif (!empty($settings['hosted_video']['url'])) {
            $video_url = $settings['hosted_video']['url'];
        }

        if (empty($video_url)) {
            echo '<p>' . esc_html__('Please select a video or enter a URL', 'unlimited-elementor-inner-sections-by-boomdevs') . '</p>';
            return;
        }

        ?>
        <video 
            class="pea-advanced-video-player"
            <?php 
                if($settings['show_image_overlay'] !== 'yes'){
                    echo $settings['autoplay'] === 'yes' ? 'autoplay' : '';
                }
            ?>
            <?php echo $settings['mute'] === 'yes' ? 'muted' : ''; ?>
            <?php echo $settings['loop'] === 'yes' ? 'loop' : ''; ?>
            <?php echo $settings['controls'] === 'yes' ? 'controls' : ''; ?>
            playsinline
        >
            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
            <?php echo esc_html__('Your browser does not support the video tag.', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>
        </video>
        <?php
    }

    private function render_iframe($src, $title) {
        ?>
        <iframe 
            class="pea-advanced-video-iframe" 
            src="<?php echo esc_url($src); ?>"
            title="<?php echo esc_attr($title); ?>"
            frameborder="0" 
            allow="autoplay; accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen
        ></iframe>
        <?php
    }

    // Helper functions to extract video IDs
    private function get_youtube_id($url) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return isset($match[1]) ? $match[1] : '';
    }

    private function get_vimeo_id($url) {
        preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/', $url, $match);
        return isset($match[3]) ? $match[3] : '';
    }

    private function get_dailymotion_id($url) {
        preg_match('/dailymotion\.com\/(?:video|hub)\/([^_]+)/', $url, $match);
        return isset($match[1]) ? $match[1] : '';
    }
}
