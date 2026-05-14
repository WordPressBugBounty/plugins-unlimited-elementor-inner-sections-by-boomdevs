<?php
namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Prime Elementor Addons — PDF Viewer Widget 
 *
 * Embeds any PDF directly in an Elementor page using PDF.js.
 * No download required — users can scroll, zoom, and go full-screen.
 */
class PdfViewer extends Widget_Base {

    public function get_name()       { return 'pea_pdf_viewer'; }
    public function get_title()      { return esc_html__( 'PDF Viewer', 'unlimited-elementor-inner-sections-by-boomdevs' ); }
    public function get_icon()       { return 'pea_pdf_viewer_icon'; }
    public function get_categories() { return [ 'prime-elementor-addons' ]; }
    public function get_keywords()   { return [ 'pdf', 'viewer', 'document', 'embed', 'file' ]; }

    public function has_widget_inner_wrapper(): bool {
        return ! Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
    }

    public function get_style_depends(): array {
        return [ 'prime-elementor-addons--pdf-viewer' ];
    }

    public function get_script_depends(): array {
        return [
            'pdfjs-lib',
            'prime-elementor-addons--pdf-viewer',
        ];
    }

    protected function register_controls(): void {

        /* =====================================================================
           CONTENT TAB  PDF Source
        ===================================================================== */
        $this->start_controls_section( 'section_source', [
            'label' => esc_html__( 'PDF Source', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'pdf_source_type', [
            'label'   => esc_html__( 'Source Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'media',
            'options' => [
                'media'  => esc_html__( 'Media Library', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'url'    => esc_html__( 'URL / Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
        ] );

        $this->add_control( 'new_pdf_url', [
            'label'       => esc_html__( 'PDF URL', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::URL,
            'placeholder' => 'https://example.com/document.pdf',
            'description' => esc_html__( 'For best results, host the PDF on the same domain as this page.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'default'     => [ 'url' => '', 'is_external' => '', 'nofollow' => '' ],
            'condition'   => [ 'pdf_source_type' => 'url' ],
            'dynamic'     => [ 'active' => true ],
        ] );

        $this->add_control( 'new_pdf_media', [
            'label'       => esc_html__( 'PDF File', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::MEDIA,
            'media_types' => [ 'application/pdf' ],
            'library_type'=> 'application/pdf',
            'condition'   => [ 'pdf_source_type' => 'media' ],
            'dynamic'     => [ 'active' => true ],
        ] );

        $this->end_controls_section();

        /* =====================================================================
           CONTENT TAB  Viewer Settings
        ===================================================================== */

        $this->start_controls_section( 'section_viewer', [
            'label' => esc_html__( 'Viewer Settings', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        // Layout type
        $this->add_control( 'layout_type', [
            'label'   => esc_html__( 'Layout Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'custom'  => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
        ] );

        // Starting page (custom layout)
        $this->add_control( 'start_page', [
            'label'       => esc_html__( 'Starting Page', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'        => Controls_Manager::NUMBER,
            'min'         => 1,
            'step'        => 1,
            'default'     => 1,
            'description' => esc_html__( 'Page number to open first.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'condition'   => [ 'layout_type' => 'custom' ],
        ] );

        // Initial scale
        $this->add_control( 'initial_scale', [
            'label'     => esc_html__( 'Initial Scale', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 3, 'step' => 0.05 ] ],
            'default'   => [ 'size' => 0.5, 'unit' => 'px' ],
          //   'condition' => [ 'layout_type' => 'custom' ],
            'frontend_available' => true,
        ] );

        // Rotation
        $this->add_control( 'rotation', [
            'label'     => esc_html__( 'Rotation (°)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => '0',
            'options'   => [
                '0'   => '0°',
                '90'  => '90°',
                '180' => '180°',
                '270' => '270°',
            ],
            'condition' => [ 'layout_type' => 'custom' ],
            'frontend_available' => true,
        ] );

        // Toolbar controls
        $this->add_control( 'toolbar_heading', [
            'label'     => esc_html__( 'Toolbar Controls', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_control( 'show_toolbar', [
            'label'        => esc_html__( 'Show Toolbar', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'frontend_available' => true,
        ] );

        $this->add_control( 'show_prev_next', [
            'label'        => esc_html__( 'Previous / Next Buttons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [ 'show_toolbar' => 'yes' ],
            'frontend_available' => true,
        ] );

        $this->add_control( 'show_page_number', [
            'label'        => esc_html__( 'Page Number Input', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [ 'show_toolbar' => 'yes' ],
            'frontend_available' => true,
        ] );

        $this->add_control( 'show_zoom', [
            'label'        => esc_html__( 'Zoom Controls', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [ 'show_toolbar' => 'yes' ],
            'frontend_available' => true,
        ] );

        $this->add_control( 'show_fullscreen', [
            'label'        => esc_html__( 'Full Screen Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [ 'show_toolbar' => 'yes' ],
            'frontend_available' => true,
        ] );

        $this->add_control( 'show_download', [
            'label'        => esc_html__( 'Download Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [ 'show_toolbar' => 'yes' ],
            'frontend_available' => true,
        ] );

        $this->add_control( 'show_print', [
            'label'        => esc_html__( 'Print Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'no',
            'condition'    => [ 'show_toolbar' => 'yes' ],
            'frontend_available' => true,
        ] );

        // Custom text
        $this->add_control( 'prev_text', [
            'label'     => esc_html__( 'Prev Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::TEXT,
            'default'   => '‹',
            'separator' => 'before',
        ] );

        $this->add_control( 'next_text', [
            'label'   => esc_html__( 'Next Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '›',
        ] );

        $this->add_control( 'loading_text', [
            'label'   => esc_html__( 'Loading Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Loading PDF…',
        ] );

        $this->add_control( 'error_text', [
            'label'   => esc_html__( 'Error Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Failed to load PDF. Please check the URL.',
        ] );

        $this->add_control( 'no_pdf_text', [
            'label'   => esc_html__( 'No PDF Text (Editor)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Please add a PDF URL or file to preview.',
        ] );

        $this->end_controls_section();

        /* =====================================================================
           CONTENT TAB ▸ FAQ (informational — no extra controls needed)
           The FAQ text shown in the widget description section
        ===================================================================== */
     //    $this->start_controls_section( 'section_faq', [
     //        'label' => esc_html__( 'FAQ / Info', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'tab'   => Controls_Manager::TAB_CONTENT,
     //    ] );

     //    $this->add_control( 'show_faq', [
     //        'label'        => esc_html__( 'Show FAQ Below Viewer', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'         => Controls_Manager::SWITCHER,
     //        'return_value' => 'yes',
     //        'default'      => '',
     //    ] );

     //    $this->add_control( 'faq_notice', [
     //        'type' => Controls_Manager::RAW_HTML,
     //        'raw'  => '<div style="background:#f0f4ff;border-left:3px solid #5865F2;padding:10px 14px;border-radius:4px;font-size:12px;line-height:1.6;color:#444;">
     //                    <strong>FAQ items</strong> are displayed below the PDF viewer when enabled. The text is customizable from this panel.
     //                   </div>',
     //        'condition' => [ 'show_faq' => 'yes' ],
     //    ] );

     //    $this->end_controls_section();

        /* =====================================================================
           STYLE TAB  Container
        ===================================================================== */
        $this->start_controls_section( 'style_container', [
            'label' => esc_html__( 'Container', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'viewer_height', [
            'label'      => esc_html__( 'Viewer Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh','%','rem','em','vw' ],
            'range'      => [
                'px' => [ 'min' => 200, 'max' => 1400, 'step' => 10 ],
                'vh' => [ 'min' => 20,  'max' => 100,  'step' => 1  ],
                '%'  => [ 'min' => 10,  'max' => 100,  'step' => 1  ],
                'rem' => [ 'min' => 5,   'max' => 50,   'step' => 0.5 ],
                'em'  => [ 'min' => 5,   'max' => 50,   'step' => 0.5 ],
                'vw'  => [ 'min' => 5,   'max' => 100,  'step' => 1  ],

            ],
          //   'default'    => [ 'size' => 600, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-canvas-area' => 'height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'container_bg',
            'selector' => '{{WRAPPER}} .pea-pdf-viewer-wrap',
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'container_border',
            'selector' => '{{WRAPPER}} .pea-pdf-viewer-wrap',
        ] );

        $this->add_responsive_control( 'container_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '12', 'right' => '12', 'bottom' => '12', 'left' => '12', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-viewer-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;' ],
        ] );

        // Normal and Hover controls for container background color

          $this->start_controls_tabs( 'container_bg_tabs' );

              // --- Normal Tab ---
              $this->start_controls_tab( 'container_bg_normal_label', [ 
                  'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) 
              ] );

                  $this->add_control( 'container_normal_color', [
                      'label'     => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'      => \Elementor\Controls_Manager::COLOR,
                      'default'   => '#000000',
                      'selectors' => [ '{{WRAPPER}} .pea-pdf-viewer-wrap' => 'color: {{VALUE}};' ],
                  ] );

                  $this->add_control( 'container_normal_bg_color', [
                      'label'     => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'      => \Elementor\Controls_Manager::COLOR,
                      'default'   => '#ffffff',
                      'selectors' => [ '{{WRAPPER}} .pea-pdf-viewer-wrap' => 'background-color: {{VALUE}};' ],
                  ] );

                  // Use Group Control for Border
                  $this->add_group_control(
                      \Elementor\Group_Control_Border::get_type(),
                      [
                          'name'     => 'container_normal_border',
                          'selector' => '{{WRAPPER}} .pea-pdf-viewer-wrap',
                      ]
                  );

                  $this->add_control( 'container_normal_border_radius', [
                      'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                      'size_units' => [ 'px', '%', 'rem', 'em', 'vw', 'vh' ],
                      'selectors'  => [ '{{WRAPPER}} .pea-pdf-viewer-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                  ] );

                  // Use Group Control for Box Shadow
                  $this->add_group_control(
                      \Elementor\Group_Control_Box_Shadow::get_type(),
                      [
                          'name'     => 'container_normal_box_shadow',
                          'selector' => '{{WRAPPER}} .pea-pdf-viewer-wrap',
                      ]
                  );

              $this->end_controls_tab();

              // --- Hover Tab ---
              $this->start_controls_tab( 'container_bg_hover_label', [ 
                  'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ) 
              ] );

                  $this->add_control( 'container_hover_color', [
                      'label'     => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'      => \Elementor\Controls_Manager::COLOR,
                      'selectors' => [ '{{WRAPPER}} .pea-pdf-viewer-wrap:hover' => 'color: {{VALUE}};' ],
                  ] );

                  $this->add_control( 'container_hover_bg_color', [
                      'label'     => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'      => \Elementor\Controls_Manager::COLOR,
                      'selectors' => [ '{{WRAPPER}} .pea-pdf-viewer-wrap:hover' => 'background-color: {{VALUE}};' ],
                  ] );

                  $this->add_control( 'container_hover_border_color', [
                      'label'     => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'      => \Elementor\Controls_Manager::COLOR,
                      'selectors' => [ '{{WRAPPER}} .pea-pdf-viewer-wrap:hover' => 'border-color: {{VALUE}};' ],
                  ] );

                  $this->add_control( 'container_hover_border_radius', [
                      'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                      'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                      'size_units' => [ 'px', '%', 'rem', 'em', 'vw', 'vh' ],
                      'selectors'  => [ '{{WRAPPER}} .pea-pdf-viewer-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
                  ] );

                  $this->add_group_control(
                      \Elementor\Group_Control_Box_Shadow::get_type(),
                      [
                          'name'     => 'container_hover_box_shadow',
                          'selector' => '{{WRAPPER}} .pea-pdf-viewer-wrap:hover',
                      ]
                  );

              $this->end_controls_tab();

          $this->end_controls_tabs();

        // Normal and Hover controls for container background color

        $this->add_responsive_control( 'container_padding', [
            'label'      => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'rem', 'em', '%', 'vw', 'vh' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-viewer-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'container_margin', [
            'label'      => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'rem', 'em', '%', 'vw', 'vh' ],
            'default'    => [ 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-viewer-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        // Canvas background
        $this->add_control( 'canvas_bg_color', [
            'label'     => esc_html__( 'Canvas Area Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f5f5f5',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-canvas-area' => 'background-color: {{VALUE}};' ],
            'separator' => 'before',
        ] );

        $this->end_controls_section();

        /* =====================================================================
           STYLE TAB  Toolbar
        ===================================================================== */
        $this->start_controls_section( 'style_toolbar', [
            'label'     => esc_html__( 'Toolbar', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'show_toolbar' => 'yes' ],
        ] );

        $this->add_control( 'toolbar_position', [
            'label'   => esc_html__( 'Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'top',
            'options' => [
                'top'    => esc_html__( 'Top', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'bottom' => esc_html__( 'Bottom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'both'   => esc_html__( 'Top & Bottom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ],
        ] );

        $this->add_control( 'toolbar_bg_color', [
            'label'     => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1e2327',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-toolbar' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'toolbar_padding', [
            'label'      => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em' ],
            'default'    => [ 'top' => '10', 'right' => '16', 'bottom' => '10', 'left' => '16', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-toolbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'toolbar_border',
            'selector' => '{{WRAPPER}} .pea-pdf-toolbar',
        ] );

        // Toolbar controls normal/hover tabs
        $this->add_control( 'toolbar_controls_heading', [
            'label'     => esc_html__( 'Toolbar Controls', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->start_controls_tabs( 'toolbar_tabs' );

        $this->start_controls_tab( 'toolbar_normal', [ 'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
        $this->add_control( 'toolbar_icon_color', [
            'label'     => esc_html__( 'Icon / Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-toolbar button' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pea-pdf-page-input'     => 'color: {{VALUE}};',
                '{{WRAPPER}} .pea-pdf-page-total'     => 'color: {{VALUE}};',
            ],
        ] );
        $this->add_control( 'toolbar_btn_bg', [
            'label'     => esc_html__( 'Button Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'transparent',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-toolbar button' => 'background-color: {{VALUE}};' ],
        ] );
        $this->end_controls_tab();

        $this->start_controls_tab( 'toolbar_hover', [ 'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
        $this->add_control( 'toolbar_icon_color_hover', [
            'label'     => esc_html__( 'Icon / Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .pea-pdf-toolbar button:hover' => 'color: {{VALUE}};' ],
        ] );
        $this->add_control( 'toolbar_btn_bg_hover', [
            'label'     => esc_html__( 'Button Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.1)',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-toolbar button:hover' => 'background-color: {{VALUE}};' ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'toolbar_typo',
            'selector'  => '{{WRAPPER}} .pea-pdf-toolbar button, {{WRAPPER}} .pea-pdf-page-input, {{WRAPPER}} .pea-pdf-page-total',
            'separator' => 'before',
        ] );

        $this->add_responsive_control( 'toolbar_btn_padding', [
            'label'      => esc_html__( 'Button Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em' ],
            'default'    => [ 'top' => '6', 'right' => '10', 'bottom' => '6', 'left' => '10', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-toolbar button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'toolbar_btn_radius', [
            'label'      => esc_html__( 'Button Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '6', 'right' => '6', 'bottom' => '6', 'left' => '6', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-toolbar button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'toolbar_btn_shadow',
            'selector' => '{{WRAPPER}} .pea-pdf-toolbar button:hover',
        ] );

        $this->add_control( 'toolbar_btn_transition', [
            'label'     => esc_html__( 'Transition (ms)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 1000, 'step' => 50 ] ],
            'default'   => [ 'size' => 200 ],
            'selectors' => [ '{{WRAPPER}} .pea-pdf-toolbar button' => 'transition: all {{SIZE}}ms ease;' ],
        ] );

        $this->end_controls_section();

        /* =====================================================================
           STYLE TAB ▸ Page Navigation Arrows
        ===================================================================== */
        $this->start_controls_section( 'style_arrows', [
            'label'     => esc_html__( 'Navigation Arrows', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'show_prev_next' => 'yes', 'show_toolbar' => 'yes' ],
        ] );

        $this->add_responsive_control( 'arrow_size', [
            'label'     => esc_html__( 'Arrow Font Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 10, 'max' => 60 ] ],
            'default'   => [ 'size' => 22 ],
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-btn-prev'=> 'font-size: {{SIZE}}px;',
                '{{WRAPPER}} .pea-pdf-btn-next' => 'font-size: {{SIZE}}px;',
            ],
        ] );

        $this->add_control( 'arrow_spacing', [
            'label'     => esc_html__( 'Spacing Between Arrows', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'default'   => [ 'size' => 4 ],
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-btn-prev' => 'margin-right: {{SIZE}}px;',
            ],
        ] );

        $this->start_controls_tabs( 'arrow_tabs' );

        $this->start_controls_tab( 'arrow_normal', [ 'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
        $this->add_control( 'arrow_color', [
            'label'     => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-btn-prev' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pea-pdf-btn-next' => 'color: {{VALUE}};',
            ],
        ] );
        $this->add_control( 'arrow_bg', [
            'label'     => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-btn-prev' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .pea-pdf-btn-next' => 'background-color: {{VALUE}};',
            ],
        ] );
        $this->end_controls_tab();

        $this->start_controls_tab( 'arrow_hover', [ 'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
        $this->add_control( 'arrow_color_hover', [
            'label'     => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-btn-prev:hover' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pea-pdf-btn-next:hover' => 'color: {{VALUE}};',
            ],
        ] );
        $this->add_control( 'arrow_bg_hover', [
            'label'     => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.15)',
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-btn-prev:hover' => 'background: {{VALUE}} !important;',
                '{{WRAPPER}} .pea-pdf-btn-next:hover' => 'background: {{VALUE}} !important;',
            ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'arrow_border',
            'selector' => '{{WRAPPER}} .pea-pdf-btn-prev, {{WRAPPER}} .pea-pdf-btn-next',
            'separator' => 'before',
        ] );

        $this->add_responsive_control( 'arrow_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .pea-pdf-btn-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .pea-pdf-btn-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->end_controls_section();

        /* =====================================================================
           STYLE TAB ▸ Page Number Input
        ===================================================================== */
        $this->start_controls_section( 'style_page_input', [
            'label'     => esc_html__( 'Page Number Input', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'show_page_number' => 'yes', 'show_toolbar' => 'yes' ],
        ] );

        $this->start_controls_tabs( 'page_input_tabs' );

        $this->start_controls_tab( 'page_input_normal', [ 'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
        $this->add_control( 'page_input_color', [
            'label'     => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-page-input' => 'color: {{VALUE}};' ],
        ] );
        $this->add_control( 'page_input_bg', [
            'label'     => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.1)',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-page-input' => 'background-color: {{VALUE}};' ],
        ] );
        $this->end_controls_tab();

        $this->start_controls_tab( 'page_input_hover', [ 'label' => esc_html__( 'Hover / Focus', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
        $this->add_control( 'page_input_hover_color', [
            'label'     => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ff3d4f',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-page-input:hover, {{WRAPPER}} .pea-pdf-page-input:focus' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'page_input_bg_hover', [
            'label'     => esc_html__( 'Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.2)',
            'selectors' => [
                '{{WRAPPER}} .pea-pdf-page-input:hover' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .pea-pdf-page-input:focus' => 'background-color: {{VALUE}};',
            ],
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'      => 'page_input_border',
            'selector'  => '{{WRAPPER}} .pea-pdf-page-input',
            'separator' => 'before',
        ] );

         // hover border color
        $this->add_control( 'page_input_border_color_hover', [
            'label'     => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ff3d4f',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-page-input:hover' => 'border-color: {{VALUE}};', '{{WRAPPER}} .pea-pdf-page-input:focus' => 'border-color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'page_input_radius', [
            'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top' => '4', 'right' => '4', 'bottom' => '4', 'left' => '4', 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-page-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'page_input_width', [
            'label'      => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 30, 'max' => 120 ] ],
            'default'    => [ 'size' => 48 ],
            'selectors'  => [ '{{WRAPPER}} .pea-pdf-page-input' => 'width: {{SIZE}}px;' ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /* =====================================================================
           STYLE TAB ▸ Loading & Error States
        ===================================================================== */
        $this->start_controls_section( 'style_states', [
            'label' => esc_html__( 'Loading & Error States', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'state_typo',
            'selector' => '{{WRAPPER}} .pea-pdf-state-msg',
        ] );

        $this->add_control( 'loading_color', [
            'label'     => esc_html__( 'Loading Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#555555',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-loading' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'error_color', [
            'label'     => esc_html__( 'Error Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#e74c3c',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-error' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'spinner_color', [
            'label'     => esc_html__( 'Spinner Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#5865F2',
            'selectors' => [ '{{WRAPPER}} .pea-pdf-spinner' => 'border-top-color: {{VALUE}};' ],
        ] );

        $this->end_controls_section();

        /* =====================================================================
           STYLE TAB ▸ FAQ Section
        ===================================================================== */
     //    $this->start_controls_section( 'style_faq', [
     //        'label'     => esc_html__( 'FAQ Section', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'tab'       => Controls_Manager::TAB_STYLE,
     //        'condition' => [ 'show_faq' => 'yes' ],
     //    ] );

     //    $this->add_group_control( Group_Control_Typography::get_type(), [
     //        'name'     => 'faq_question_typo',
     //        'label'    => esc_html__( 'Question Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'selector' => '{{WRAPPER}} .pea-pdf-faq-q',
     //    ] );

     //    $this->add_control( 'faq_q_color', [
     //        'label'     => esc_html__( 'Question Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::COLOR,
     //        'default'   => '#1a1a2e',
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-q' => 'color: {{VALUE}};' ],
     //    ] );

     //    $this->start_controls_tabs( 'faq_tabs' );

     //    $this->start_controls_tab( 'faq_normal', [ 'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
     //    $this->add_control( 'faq_a_color', [
     //        'label'     => esc_html__( 'Answer Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::COLOR,
     //        'default'   => '#555555',
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-a' => 'color: {{VALUE}};' ],
     //    ] );
     //    $this->add_control( 'faq_bg', [
     //        'label'     => esc_html__( 'Item Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::COLOR,
     //        'default'   => '#f9fafb',
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-item' => 'background-color: {{VALUE}};' ],
     //    ] );
     //    $this->end_controls_tab();

     //    $this->start_controls_tab( 'faq_hover', [ 'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ) ] );
     //    $this->add_control( 'faq_bg_hover', [
     //        'label'     => esc_html__( 'Item Background', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::COLOR,
     //        'default'   => '#eef2ff',
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-item:hover' => 'background-color: {{VALUE}};' ],
     //    ] );
     //    $this->add_control( 'faq_q_color_hover', [
     //        'label'     => esc_html__( 'Question Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::COLOR,
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-item:hover .pea-pdf-faq-q' => 'color: {{VALUE}};' ],
     //    ] );
     //    $this->end_controls_tab();
     //    $this->end_controls_tabs();

     //    $this->add_group_control( Group_Control_Typography::get_type(), [
     //        'name'      => 'faq_answer_typo',
     //        'label'     => esc_html__( 'Answer Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'selector'  => '{{WRAPPER}} .pea-pdf-faq-a',
     //        'separator' => 'before',
     //    ] );

     //    $this->add_group_control( Group_Control_Border::get_type(), [
     //        'name'      => 'faq_border',
     //        'selector'  => '{{WRAPPER}} .pea-pdf-faq-item',
     //        'separator' => 'before',
     //    ] );

     //    $this->add_responsive_control( 'faq_border_radius', [
     //        'label'      => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'       => Controls_Manager::DIMENSIONS,
     //        'size_units' => [ 'px', '%' ],
     //        'default'    => [ 'top' => '8', 'right' => '8', 'bottom' => '8', 'left' => '8', 'unit' => 'px' ],
     //        'selectors'  => [ '{{WRAPPER}} .pea-pdf-faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
     //    ] );

     //    $this->add_responsive_control( 'faq_padding', [
     //        'label'      => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'       => Controls_Manager::DIMENSIONS,
     //        'size_units' => [ 'px', 'em' ],
     //        'default'    => [ 'top' => '18', 'right' => '22', 'bottom' => '18', 'left' => '22', 'unit' => 'px' ],
     //        'selectors'  => [ '{{WRAPPER}} .pea-pdf-faq-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
     //    ] );

     //    $this->add_control( 'faq_item_gap', [
     //        'label'     => esc_html__( 'Gap Between Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::SLIDER,
     //        'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
     //        'default'   => [ 'size' => 16 ],
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-list' => 'gap: {{SIZE}}px;' ],
     //    ] );

     //    $this->add_control( 'faq_transition', [
     //        'label'     => esc_html__( 'Hover Transition (ms)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
     //        'type'      => Controls_Manager::SLIDER,
     //        'range'     => [ 'px' => [ 'min' => 0, 'max' => 800 ] ],
     //        'default'   => [ 'size' => 250 ],
     //        'selectors' => [ '{{WRAPPER}} .pea-pdf-faq-item' => 'transition: all {{SIZE}}ms ease;' ],
     //    ] );

     //    $this->end_controls_section();
    }

    /* =================================================================
       RENDER
    ================================================================= */
    protected function render(): void {
        $s         = $this->get_settings_for_display();
        $widget_id = 'pea-pdf-' . $this->get_id();
 
        // ── Resolve PDF URL ──────────────────────────────────────────
        $pdf_url = '';
        if ( 'media' === ( $s['pdf_source_type'] ?? 'url' ) ) {
            // Media Library: url lives inside the array
            $pdf_url = ! empty( $s['new_pdf_media']['url'] ) ? esc_url( $s['new_pdf_media']['url'] ) : '';
        } else {
            // URL / Link
            $pdf_url = ! empty( $s['new_pdf_url']['url'] ) ? esc_url( $s['new_pdf_url']['url'] ) : '';
        }
 
        // ── Resolve optional custom-layout settings safely ───────────
        // These controls only exist in the panel when layout_type = 'custom',
        // so they may be absent from $s entirely — always use fallback defaults.
        $start_page    = isset( $s['start_page'] )             ? max( 1, (int) $s['start_page'] )             : 1;
        $initial_scale = isset( $s['initial_scale']['size'] )  ? (float) $s['initial_scale']['size']          : 1.0;
        $rotation      = isset( $s['rotation'] )               ? (int) $s['rotation']                         : 0;
 
        // ── Build JS config ──────────────────────────────────────────
        $config = [
            'pdfUrl'         => $pdf_url,
            'startPage'      => $start_page,
            'initialScale'   => $initial_scale,
            'rotation'       => $rotation,
            'showToolbar'    => 'yes' === ( $s['show_toolbar']     ?? 'yes' ),
            'showPrevNext'   => 'yes' === ( $s['show_prev_next']   ?? 'yes' ),
            'showPageNum'    => 'yes' === ( $s['show_page_number'] ?? 'yes' ),
            'showZoom'       => 'yes' === ( $s['show_zoom']        ?? 'yes' ),
            'showFullscreen' => 'yes' === ( $s['show_fullscreen']  ?? 'yes' ),
            'showDownload'   => 'yes' === ( $s['show_download']    ?? 'yes' ),
            'showPrint'      => 'yes' === ( $s['show_print']       ?? 'no'  ),
            'toolbarPos'     => $s['toolbar_position']  ?? 'top',
            'prevText'       => $s['prev_text']         ?? '‹',
            'nextText'       => $s['next_text']         ?? '›',
            'loadingText'    => $s['loading_text']      ?? 'Loading PDF…',
            'errorText'      => $s['error_text']        ?? 'Failed to load PDF. Please check the URL.',
            'noPdfText'      => $s['no_pdf_text']       ?? 'Please add a PDF URL or file to preview.',
        ];
        ?>
 
        <div class="pea-pdf-viewer-wrap"
             id="<?php echo esc_attr( $widget_id ); ?>"
             data-config="<?php echo esc_attr( wp_json_encode( $config ) ); ?>">
 
            <?php if ( empty( $pdf_url ) ) : ?>
 
                <!-- ── Editor placeholder (no PDF selected yet) ── -->
                <div class="pea-pdf-no-file">
                    <div class="pea-pdf-no-file-icon">📄</div>
                    <p class="pea-pdf-state-msg"><?php echo esc_html( $config['noPdfText'] ); ?></p>
                </div>
 
            <?php else : ?>
 
                <!-- ── Toolbar: Top ── -->
                <?php if ( $config['showToolbar'] && in_array( $config['toolbarPos'], [ 'top', 'both' ], true ) ) :
                    $this->render_toolbar( $config );
                endif; ?>
 
                <!-- ── Canvas Area ── -->
                <div class="pea-pdf-canvas-area">
 
                    <!-- Loading state (visible by default until JS hides it) -->
                    <div class="pea-pdf-loading pea-pdf-state-msg" style="display:flex;">
                        <div class="pea-pdf-spinner"></div>
                        <span><?php echo esc_html( $config['loadingText'] ); ?></span>
                    </div>
 
                    <!-- Error state (hidden by default) -->
                    
 
                    <!-- Canvas container (PDF.js renders here; hidden until first page renders) -->
                    <div class="pea-pdf-canvas-container" style="display:none;">
                        <canvas class="pea-pdf-canvas"></canvas>
                    </div>
 
                </div><!-- .pea-pdf-canvas-area -->
 
                <!-- ── Toolbar: Bottom ── -->
                <?php if ( $config['showToolbar'] && in_array( $config['toolbarPos'], [ 'bottom', 'both' ], true ) ) :
                    $this->render_toolbar( $config );
                endif; ?>
 
            <?php endif; ?>
 
        </div><!-- .pea-pdf-viewer-wrap -->
 
        <?php
        // NOTE: The FAQ section has been intentionally removed.
        // The $s['show_faq'] control and $faq_items variable are both commented out
        // in register_controls(), so referencing them here would cause a PHP error.
        // Re-add only when the FAQ section is fully uncommented and registered.
    }
 
    /* =================================================================
       TOOLBAR PARTIAL
    ================================================================= */
    private function render_toolbar( array $config ): void { ?>
        <div class="pea-pdf-toolbar">
 
            <!-- Left: Prev / Page Input / Next -->
            <div class="pea-pdf-toolbar-left">
 
                <?php if ( $config['showPrevNext'] ) : ?>
                    <button class="pea-pdf-btn-prev" title="Previous Page" aria-label="Previous page">
                        <?php echo esc_html( $config['prevText'] ); ?>
                    </button>
                <?php endif; ?>
 
                <?php if ( $config['showPageNum'] ) : ?>
                    <div class="pea-pdf-page-group">
                        <input type="number"
                               class="pea-pdf-page-input"
                               min="1"
                               value="1"
                               aria-label="Page number" />
                        <span class="pea-pdf-page-total">/ <span class="pea-pdf-total-pages">0</span></span>
                    </div>
                <?php endif; ?>
 
                <?php if ( $config['showPrevNext'] ) : ?>
                    <button class="pea-pdf-btn-next" title="Next Page" aria-label="Next page">
                        <?php echo esc_html( $config['nextText'] ); ?>
                    </button>
                <?php endif; ?>
 
            </div><!-- .pea-pdf-toolbar-left -->
 
            <!-- Right: Zoom / Fullscreen / Download / Print -->
            <div class="pea-pdf-toolbar-right">
 
                <?php if ( $config['showZoom'] ) : ?>
                    <button class="pea-pdf-btn-zoom-out" title="Zoom Out" aria-label="Zoom out">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </button>
                    <span class="pea-pdf-zoom-level">100%</span>
                    <button class="pea-pdf-btn-zoom-in" title="Zoom In" aria-label="Zoom in">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </button>
                <?php endif; ?>
 
                <?php if ( $config['showFullscreen'] ) : ?>
                    <button class="pea-pdf-btn-fullscreen" title="Full Screen" aria-label="Full screen">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg>
                    </button>
                <?php endif; ?>
 
                <?php if ( $config['showDownload'] ) : ?>
                    <a class="pea-pdf-btn-download"
                       title="Download PDF"
                       aria-label="Download PDF"
                       href="<?php echo esc_url( $config['pdfUrl'] ); ?>"
                       download
                       target="_blank"
                       rel="noopener noreferrer">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    </a>
                <?php endif; ?>
 
                <?php if ( $config['showPrint'] ) : ?>
                    <button class="pea-pdf-btn-print" title="Print PDF" aria-label="Print PDF">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    </button>
                <?php endif; ?>
 
            </div><!-- .pea-pdf-toolbar-right -->
 
        </div><!-- .pea-pdf-toolbar -->
    <?php }

}