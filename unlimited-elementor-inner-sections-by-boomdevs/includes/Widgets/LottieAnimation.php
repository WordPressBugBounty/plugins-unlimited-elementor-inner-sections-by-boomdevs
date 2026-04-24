<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class LottieAnimation extends Widget_Base {

    public function get_name() {
        return 'pea_lottie_animation';
    }

    public function get_title() {
        return esc_html__( 'Lottie Animation', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_lottie_animation_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return [ 'lottie', 'animation', 'json' ];
    }

    public function get_style_depends() {
        return [ 'prime-elementor-addons--lottie-animation' ];
    }

    public function get_script_depends() {
        return [ 'prime-elementor-addons--lottie-animation' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'lottie_animation_section',
            [
                'label' => esc_html__( 'Lottie', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs( 'lottie_source_tabs' );

        $this->start_controls_tab(
            'lottie_source_file_tab',
            [
                'label' => esc_html__( 'JSON File', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'lottie_file',
            [
                'label'       => esc_html__( 'Choose Lottie JSON File', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::MEDIA,
                'media_types' => [ 'application' ],
                'description' => esc_html__( 'Choose a .json file from Media Library', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'lottie_file_url',
            [
                'type' => Controls_Manager::HIDDEN,
                'default' => '',
            ]
        );

        $this->add_control(
            'lottie_file_upload_ui',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw'  => '<div class="pea-lottie-file-upload-anchor">'
                    . '<div class="pea-lottie-url-upload">'
                    . '<div class="pea-lottie-upload-actions">'
                    . '<button type="button" class="elementor-button elementor-button-default pea-lottie-json-upload-btn">' . esc_html__( 'Upload File', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</button>'
                    . '<button type="button" class="elementor-button elementor-button-default pea-lottie-json-remove-btn">' . esc_html__( 'Change File', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</button>'
                    . '</div>'
                    . '<input type="file" class="pea-lottie-json-upload-input" accept=".json,application/json" style="display:none;" />'
                    . '</div>'
                    . '</div>',
                'content_classes' => 'pea-lottie-file-upload-ui',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'lottie_source_url_tab',
            [
                'label' => esc_html__( 'JSON URL', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'lottie_json_url',
            [
                'label' => esc_html__( 'Lottie JSON URL', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => 'https://example.com/animation.json',
                'description' => esc_html__( 'Optional. Use a direct .json URL', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'lottie_source_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Loop Animation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'reverse',
            [
                'label' => esc_html__( 'Reverse', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__( 'Speed', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'x' ],
                'range' => [
                    'x' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'x',
                    'size' => 1,
                ],
                'description' => 'Control animation playback speed.Normal speed = 1, double speed = 2, half speed = 0.5',
            ]
        );

        $this->add_control(
            'on_hover',
            [
                'label' => esc_html__( 'On Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'pause' => esc_html__( 'Pause', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'play' => esc_html__( 'Play', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'reverse' => esc_html__( 'Reverse', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ],
                'description' => 'Choose what happens when user hovers over the animation',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'lottie_layout_section',
            [
                'label' => esc_html__( 'Lottie', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'animation_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'prefix_class' => 'pea-lottie-align-',
                'frontend_available' => true,
                'description' => 'Alignment works when width is less than 100% or container',
            ]
        );

        $this->add_responsive_control(
            'animation_width',
            [
                'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 2000,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-lottie-animation-inner.pea-lottie-has-source' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'animation_height',
            [
                'label' => esc_html__( 'Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 2000,
                    ],
                    'vh' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-lottie-animation-inner.pea-lottie-has-source' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'lottie_opacity_heading',
            [
                'label' => esc_html__( 'Opacity', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'lottie_opacity_tabs' );

        $this->start_controls_tab(
            'lottie_opacity_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'lottie_opacity_normal',
            [
                'label' => esc_html__( 'Opacity', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'x' ],
                'range' => [
                    'x' => [
                        'min' => 0.1,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'x',
                    'size' => 1,
                ],
                'show_label' => false,
                'selectors' => [
                    '{{WRAPPER}} .pea-lottie-animation-player' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'lottie_opacity_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'lottie_opacity_hover',
            [
                'label' => esc_html__( 'Opacity', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'x' ],
                'range' => [
                    'x' => [
                        'min' => 0.1,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'x',
                    'size' => 1,
                ],
                'show_label' => false,
                'selectors' => [
                    '{{WRAPPER}} .pea-lottie-animation-inner:hover .pea-lottie-animation-player' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    private function is_valid_lottie_url( $url ) {
        if ( empty( $url ) || ! is_string( $url ) ) {
            return false;
        }

        $path = wp_parse_url( trim( $url ), PHP_URL_PATH );
        if ( ! is_string( $path ) || '' === $path ) {
            return false;
        }

        return (bool) preg_match( '/\.json$/i', $path );
    }

    private function get_url_value( $settings, $key ) {
        if ( ! isset( $settings[ $key ] ) ) {
            return '';
        }

        if ( is_array( $settings[ $key ] ) ) {
            return isset( $settings[ $key ]['url'] ) ? trim( (string) $settings[ $key ]['url'] ) : '';
        }

        return trim( (string) $settings[ $key ] );
    }

    private function get_render_config( $settings ) {
        $raw_source_from_media = isset( $settings['lottie_file']['url'] ) ? trim( (string) $settings['lottie_file']['url'] ) : '';
        $raw_source_from_file = $this->get_url_value( $settings, 'lottie_file_url' );
        $raw_source_from_url = $this->get_url_value( $settings, 'lottie_json_url' );
        $preferred_file_source = '' !== $raw_source_from_file ? $raw_source_from_file : $raw_source_from_media;
        $source_tab = isset( $settings['lottie_source_tabs'] ) ? sanitize_key( (string) $settings['lottie_source_tabs'] ) : '';
        if ( 'lottie_source_url_tab' === $source_tab ) {
            $raw_source = $raw_source_from_url;
        } elseif ( 'lottie_source_file_tab' === $source_tab ) {
            $raw_source = $preferred_file_source;
        } else {
            $raw_source = '' !== $preferred_file_source ? $preferred_file_source : $raw_source_from_url;
        }
        $has_invalid_source = '' !== $raw_source && ! $this->is_valid_lottie_url( $raw_source );

        $speed = isset( $settings['speed']['size'] ) ? (float) $settings['speed']['size'] : 1;
        $speed = max( 0.1, min( 5, $speed ) );

        $hover_action = isset( $settings['on_hover'] ) ? sanitize_key( (string) $settings['on_hover'] ) : '';
        if ( ! in_array( $hover_action, [ '', 'pause', 'play', 'reverse' ], true ) ) {
            $hover_action = '';
        }

        return [
            'source'             => $has_invalid_source || '' === $raw_source ? '' : esc_url_raw( $raw_source ),
            'has_invalid_source' => $has_invalid_source,
            'autoplay'           => ( isset( $settings['autoplay'] ) && 'yes' === $settings['autoplay'] ) ? 'true' : 'false',
            'loop'               => ( isset( $settings['loop'] ) && 'yes' === $settings['loop'] ) ? 'true' : 'false',
            'reverse'            => ( isset( $settings['reverse'] ) && 'yes' === $settings['reverse'] ) ? 'true' : 'false',
            'speed'              => (string) $speed,
            'hover_action'       => $hover_action,
        ];
    }

    private function is_editor_context() {
        $is_editor = \Elementor\Plugin::$instance->editor->is_edit_mode();

        if ( ! $is_editor && isset( \Elementor\Plugin::$instance->preview ) && \Elementor\Plugin::$instance->preview ) {
            $is_editor = \Elementor\Plugin::$instance->preview->is_preview_mode();
        }

        return (bool) $is_editor;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $config   = $this->get_render_config( $settings );

        $has_source = '' !== $config['source'];
        $is_editor_context = $this->is_editor_context();

        if ( ! $has_source && ! $config['has_invalid_source'] && ! $is_editor_context ) {
            return;
        }

        $this->add_render_attribute( 'lottie_inner', 'class', 'pea-lottie-animation-inner' );
        $this->add_render_attribute( 'lottie_inner', 'class', $has_source ? 'pea-lottie-has-source' : 'pea-lottie-no-source' );
        $this->add_render_attribute( 'lottie_inner', 'data-autoplay', $config['autoplay'] );
        $this->add_render_attribute( 'lottie_inner', 'data-loop', $config['loop'] );
        $this->add_render_attribute( 'lottie_inner', 'data-reverse', $config['reverse'] );
        $this->add_render_attribute( 'lottie_inner', 'data-speed', $config['speed'] );
        $this->add_render_attribute( 'lottie_inner', 'data-hover-action', $config['hover_action'] );

        if ( $has_source ) {
            $this->add_render_attribute( 'lottie_inner', 'data-lottie-src', $config['source'] );
        }

        $player_label = esc_html__( 'Lottie animation player', 'unlimited-elementor-inner-sections-by-boomdevs' );
        ?>
        <div class="pea-lottie-animation-wrapper">
            <div <?php echo $this->get_render_attribute_string( 'lottie_inner' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
                <div class="pea-lottie-animation-player" aria-label="<?php echo esc_attr( $player_label ); ?>"></div>

                <?php if ( ! $has_source && $is_editor_context ) : ?>
                    <div class="pea-lottie-animation-placeholder">
                        <h4><?php echo esc_html__( 'Lottie Animation', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></h4>
                        <p><?php echo esc_html__( 'Upload or choose a Json animation file from your library.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></p>
                        <div class="pea-lottie-animation-placeholder-actions">
                            <button type="button" class="pea-lottie-placeholder-action" data-action="upload"><?php echo esc_html__( 'Upload', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></button>
                            <button type="button" class="pea-lottie-placeholder-action is-secondary" data-action="library"><?php echo esc_html__( 'Choose from media Library', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></button>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $config['has_invalid_source'] ) : ?>
                    <div class="pea-lottie-animation-status pea-lottie-animation-error">
                        <?php echo esc_html__( 'Invalid source. Please use a direct .json file URL.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
