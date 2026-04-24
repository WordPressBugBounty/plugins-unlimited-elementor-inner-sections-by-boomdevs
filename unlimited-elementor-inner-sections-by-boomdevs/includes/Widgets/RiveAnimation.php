<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class RiveAnimation extends Widget_Base {

    public function get_name() {
        return 'pea_rive_animation';
    }

    public function get_title() {
        return esc_html__( 'Rive Animation', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_rive_animation_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return [ 'rive', 'animation', 'canvas', 'interactive' ];
    }

    public function get_style_depends() {
        return [ 'prime-elementor-addons--rive-animation' ];
    }

    public function get_script_depends() {
        return [ 'prime-elementor-addons--rive-animation' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'rive_animation_section',
            [
                'label' => esc_html__( 'Rive', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'rive_file',
            [
                'label' => esc_html__( 'Choose Rive Animation File', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::MEDIA,
                'media_types' => [ 'application' ],
                'description' => esc_html__( 'Choose a .riv file from Media Library', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'rive_file_url',
            [
                'type' => Controls_Manager::HIDDEN,
                'default' => '',
            ]
        );

        $this->add_control(
            'rive_file_upload_ui',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw'  => '<div class="pea-rive-file-upload-anchor">'
                    . '<div class="pea-rive-url-upload">'
                    . '<div class="pea-rive-upload-actions">'
                    . '<button type="button" class="elementor-button elementor-button-default pea-rive-upload-btn">' . esc_html__( 'Upload File', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</button>'
                    . '<button type="button" class="elementor-button elementor-button-default pea-rive-change-file">' . esc_html__( 'Change File', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</button>'
                    . '</div>'
                    . '<input type="file" class="pea-rive-upload-input" accept=".riv,application/octet-stream" style="display:none;" />'
                    . '</div>'
                    . '</div>',
                'content_classes' => 'pea-rive-file-upload-ui',
            ]
        );

        $this->add_control(
            'rive_source_divider',
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
                'description' => 'Loop toggle works only if the animation file supports it',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'rive_layout_section',
            [
                'label' => esc_html__( 'Rive', 'unlimited-elementor-inner-sections-by-boomdevs' ),
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
                'prefix_class' => 'pea-rive-align-',
                'frontend_available' => true,
                'description' => 'Alignment works when width is less than 100% or container',
            ]
        );

        $this->add_control(
            'animation_fit',
            [
                'label' => esc_html__( 'Animation Fit', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'contain',
                'options' => [
                    'contain' => esc_html__( 'Contain', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'cover' => esc_html__( 'Cover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'fill' => esc_html__( 'Fill', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ],
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
                    '{{WRAPPER}} .pea-rive-animation-inner.pea-rive-has-source' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .pea-rive-animation-inner.pea-rive-has-source' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rive_opacity_heading',
            [
                'label' => esc_html__( 'Opacity', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'rive_opacity_tabs' );

        $this->start_controls_tab(
            'rive_opacity_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'rive_opacity_normal',
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
                    '{{WRAPPER}} .pea-rive-animation-canvas' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'rive_opacity_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );

        $this->add_control(
            'rive_opacity_hover',
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
                    '{{WRAPPER}} .pea-rive-animation-inner:hover .pea-rive-animation-canvas' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    private function is_valid_rive_url( $url ) {
        if ( empty( $url ) || ! is_string( $url ) ) {
            return false;
        }

        $path = wp_parse_url( trim( $url ), PHP_URL_PATH );

        if ( ! is_string( $path ) || '' === $path ) {
            return false;
        }

        return (bool) preg_match( '/\.riv$/i', $path );
    }

    private function get_render_config( $settings ) {
        $raw_source_from_upload = '';
        if ( isset( $settings['rive_file_url'] ) ) {
            if ( is_array( $settings['rive_file_url'] ) ) {
                $raw_source_from_upload = isset( $settings['rive_file_url']['url'] ) ? trim( (string) $settings['rive_file_url']['url'] ) : '';
            } else {
                $raw_source_from_upload = trim( (string) $settings['rive_file_url'] );
            }
        }
        $raw_source_from_media = isset( $settings['rive_file']['url'] ) ? trim( (string) $settings['rive_file']['url'] ) : '';
        $raw_source = '' !== $raw_source_from_upload ? $raw_source_from_upload : $raw_source_from_media;
        $has_invalid_source = '' !== $raw_source && ! $this->is_valid_rive_url( $raw_source );

        $fit = isset( $settings['animation_fit'] ) ? sanitize_key( (string) $settings['animation_fit'] ) : 'contain';
        if ( ! in_array( $fit, [ 'contain', 'cover', 'fill' ], true ) ) {
            $fit = 'contain';
        }

        return [
            'source'             => $has_invalid_source || '' === $raw_source ? '' : esc_url_raw( $raw_source ),
            'has_invalid_source' => $has_invalid_source,
            'autoplay'           => ( isset( $settings['autoplay'] ) && 'yes' === $settings['autoplay'] ) ? 'true' : 'false',
            'loop'               => ( isset( $settings['loop'] ) && 'yes' === $settings['loop'] ) ? 'true' : 'false',
            'fit'                => $fit,
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
        $show_placeholder_actions = ! $has_source && $is_editor_context;

        // Do not render an empty container on frontend when no file is selected.
        if ( ! $has_source && ! $config['has_invalid_source'] && ! $show_placeholder_actions ) {
            return;
        }

        $this->add_render_attribute( 'rive_inner', 'class', 'pea-rive-animation-inner' );
        $this->add_render_attribute( 'rive_inner', 'class', $has_source ? 'pea-rive-has-source' : 'pea-rive-no-source' );
        $this->add_render_attribute( 'rive_inner', 'data-autoplay', $config['autoplay'] );
        $this->add_render_attribute( 'rive_inner', 'data-loop', $config['loop'] );
        $this->add_render_attribute( 'rive_inner', 'data-fit', $config['fit'] );

        if ( $has_source ) {
            $this->add_render_attribute( 'rive_inner', 'data-rive-src', $config['source'] );
        }

        $canvas_label = ! empty( $settings['rive_file']['alt'] )
            ? sanitize_text_field( $settings['rive_file']['alt'] )
            : esc_html__( 'Rive animation canvas', 'unlimited-elementor-inner-sections-by-boomdevs' );
        ?>
        <div class="pea-rive-animation-wrapper">
            <div <?php echo $this->get_render_attribute_string( 'rive_inner' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
                <canvas class="pea-rive-animation-canvas" aria-label="<?php echo esc_attr( $canvas_label ); ?>"></canvas>

                <?php if ( $show_placeholder_actions ) : ?>
                    <div class="pea-rive-animation-placeholder">
                        <h4><?php echo esc_html__( 'Rive Animation', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></h4>
                        <p><?php echo esc_html__( 'Upload or choose a .riv animation file from your library', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></p>
                        <div class="pea-rive-animation-placeholder-actions">
                            <button type="button" class="pea-rive-placeholder-action" data-action="upload"><?php echo esc_html__( 'Upload', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></button>
                            <button type="button" class="pea-rive-placeholder-action is-secondary" data-action="library"><?php echo esc_html__( 'Choose from Media Library', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></button>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $config['has_invalid_source'] ) : ?>
                    <div class="pea-rive-animation-status pea-rive-animation-error">
                        <?php echo esc_html__( 'Invalid file type. Please choose a .riv file.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
