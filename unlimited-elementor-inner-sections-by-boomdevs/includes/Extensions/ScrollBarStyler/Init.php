<?php
/**
 * Scrollbar Styler Extension — bootstrapper.
 *
 * @package PrimeElementorAddons\Extensions\ScrollBarStyler
 * @since   1.0.0
 */

namespace PrimeElementorAddons\Extensions\ScrollBarStyler;

use PrimeElementorAddons\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Init {

    use Singleton;

    /**
     * Constructor — registers all hooks.
     *
     * @since  1.0.0
     * @access private
     */
    private function __construct() {
        add_action( 'elementor/kit/register_tabs',              [ $this, 'register_extension_tab' ],  1, 40 );

        // ── Frontend ────────────────────────────────────────────────────────
        // CSS: enqueue on wp_enqueue_scripts (priority 998 keeps it late).
        // JS:  enqueue on wp_footer so the DOM is ready and OverlayScrollbars
        //      can immediately find document.documentElement.
        add_action( 'wp_enqueue_scripts',  [ $this, 'extension_style'  ], 998 );
        add_action( 'wp_footer',           [ $this, 'extension_script' ], 5   );

        // ── Editor ──────────────────────────────────────────────────────────
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_assets' ], 10 );
    }

    // -------------------------------------------------------------------------
    //  Tab registration
    // -------------------------------------------------------------------------

    public function register_extension_tab( \Elementor\Core\Kits\Documents\Kit $kit ): void {
        $kit->register_tab( 'pea-page-scrollbar-styler-tab', ScrollbarStylerTab::class );
    }

    // -------------------------------------------------------------------------
    //  Frontend assets
    // -------------------------------------------------------------------------

    /**
     * Enqueue only the OverlayScrollbars CSS on the frontend.
     * The scrollbar theme CSS is generated inline by extension_script().
     *
     * @since 1.0.0
     */
    public function extension_style(): void {
        wp_enqueue_style(
            'pea-overlayscrollbars',
            PEA_PLUGIN_URL . 'assets/css/overlayscrollbars.min.css',
            [],
            '2.15.1'
        );
    }

    /**
     * Enqueue the OverlayScrollbars JS library and our frontend init script,
     * then pass the kit settings as an inline JSON object.
     *
     * IMPORTANT: This runs on wp_footer (not after_register_scripts) so
     * document.documentElement is fully available when OverlayScrollbars
     * initialises.
     *
     * @since 1.0.0
     */
    public function extension_script(): void {
        // 1. OverlayScrollbars UMD bundle (provides window.OverlayScrollbars).
        wp_enqueue_script(
            'pea-overlayscrollbars-js',
            PEA_PLUGIN_URL . 'assets/js/overlayscrollbars.min.js',
            [],
            '2.15.1',
            true   // footer
        );

        // 2. Our frontend initialisation script (depends on the library above).
        wp_enqueue_script(
            'pea-scrollbar-frontend',
            PEA_PLUGIN_URL . 'assets/js/extension/scrollbar-init.js',
            [ 'pea-overlayscrollbars-js' ],
            PEA_VERSION,
            true   // footer
        );

        // 3. Pass live settings to the frontend script.
        $settings = $this->get_kit_settings();

        wp_localize_script(
            'pea-scrollbar-frontend',
            'PrimeScrollbarSettings',
            [
                // Raw control values – the frontend reads these directly.
                'hide'          => $this->setting( $settings, 'prime_scrollbar_hide',          'no'      ),
                'applyTo'       => $this->setting( $settings, 'prime_scrollbar_apply_to',       'global'  ),
                'autoHide'      => $this->setting( $settings, 'prime_scrollbar_auto_hide',      'scroll'  ),
                'autoHideDelay' => (int) $this->setting( $settings, 'prime_scrollbar_auto_hide_delay', 800 ),
                'wheelSpeed'    => (float) ( $settings['prime_scrollbar_wheel_speed']['size'] ?? 1 ),
                'position'      => $this->setting( $settings, 'prime_scrollbar_position',       'right'   ),
                'smooth'        => $this->setting( $settings, 'prime_scrollbar_smooth_scroll',  'yes'     ),
                // Style values
                'width'         => $this->slider_value( $settings, 'prime_scrollbar_width',         '10px'    ),
                'trackColor'    => $this->color_value(  $settings, 'prime_scrollbar_track_color',    '#f1f1f1' ),
                'trackHover'    => $this->color_value(  $settings, 'prime_scrollbar_track_hover_color', '#e5e5e5' ),
                'trackRadius'   => $this->slider_value( $settings, 'prime_scrollbar_track_radius',   '0px'     ),
                'thumbColor'    => $this->color_value(  $settings, 'prime_scrollbar_thumb_color',    '#aaaaaa' ),
                'thumbHover'    => $this->color_value(  $settings, 'prime_scrollbar_thumb_hover_color', '#666666' ),
                'thumbRadius'   => $this->slider_value( $settings, 'prime_scrollbar_thumb_radius',   '10px'    ),
            ]
        );
    }

    // -------------------------------------------------------------------------
    //  Editor assets
    // -------------------------------------------------------------------------

    /**
     * Enqueue the live-preview JS and the OverlayScrollbars library inside the
     * Elementor editor panel.
     *
     * @since 1.0.0
     */
    public function enqueue_editor_assets(): void {
        // OverlayScrollbars JS (needed by the live-preview inside the iframe).
        wp_enqueue_script(
            'pea-overlayscrollbars-js',
            PEA_PLUGIN_URL . 'assets/js/overlayscrollbars.min.js',
            [],
            '2.15.1',
            true
        );
        wp_enqueue_style(
            'pea-overlayscrollbars',
            PEA_PLUGIN_URL . 'assets/css/overlayscrollbars.min.css',
            [],
            '2.15.1'
        );

        // Live-preview controller (runs in the editor panel, injects CSS/JS
        // into the preview iframe).
        wp_enqueue_script(
            'prime-scrollbar-editor',
            PEA_PLUGIN_URL . 'assets/js/editor/scrollbar-styler.js',
            [ 'elementor-editor', 'pea-overlayscrollbars-js' ],
            PEA_VERSION,
            true
        );

        // Map friendly names → Elementor control keys so the JS never has to
        // hard-code them.
        wp_localize_script(
            'prime-scrollbar-editor',
            'PrimeScrollbarConfig',
            [
                'keys' => [
                    'width'         => 'prime_scrollbar_width',
                    'trackColor'    => 'prime_scrollbar_track_color',
                    'trackHover'    => 'prime_scrollbar_track_hover_color',
                    'trackRadius'   => 'prime_scrollbar_track_radius',
                    'thumbColor'    => 'prime_scrollbar_thumb_color',
                    'thumbHover'    => 'prime_scrollbar_thumb_hover_color',
                    'thumbRadius'   => 'prime_scrollbar_thumb_radius',
                    'applyTo'       => 'prime_scrollbar_apply_to',
                    'smooth'        => 'prime_scrollbar_smooth_scroll',
                    'hide'          => 'prime_scrollbar_hide',
                    'autoHide'      => 'prime_scrollbar_auto_hide',
                    'autoHideDelay' => 'prime_scrollbar_auto_hide_delay',
                    'wheelSpeed'    => 'prime_scrollbar_wheel_speed',
                    'position'      => 'prime_scrollbar_position',
                ],
            ]
        );
    }

    // -------------------------------------------------------------------------
    //  Kit settings helpers
    // -------------------------------------------------------------------------

    /**
     * Return the active kit's settings, respecting Elementor preview mode.
     *
     * @since  1.0.0
     * @return array
     */
    public function get_kit_settings(): array {
        $kit_settings = [];

        if ( \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $kit = \Elementor\Plugin::$instance->documents->get_doc_for_frontend(
                \Elementor\Plugin::$instance->kits_manager->get_active_id()
            );
        } else {
            $kit = \Elementor\Plugin::$instance->documents->get(
                \Elementor\Plugin::$instance->kits_manager->get_active_id(),
                true
            );
        }

        if ( isset( $kit ) && is_object( $kit ) ) {
            $kit_settings = $kit->get_settings();
        }

        return $kit_settings;
    }

    // -------------------------------------------------------------------------
    //  Private value helpers
    // -------------------------------------------------------------------------

    /**
     * Generic scalar setting (string, switcher value, select value …).
     *
     * @param array  $settings
     * @param string $key
     * @param mixed  $fallback
     * @return mixed
     */
    private function setting( array $settings, string $key, $fallback = '' ) {
        return $settings[ $key ] ?? $fallback;
    }

    /**
     * Return a slider value as "size + unit" string, e.g. "10px".
     *
     * @param array  $settings
     * @param string $key
     * @param string $fallback
     * @return string
     */
    private function slider_value( array $settings, string $key, string $fallback = '' ): string {
        if (
            ! empty( $settings[ $key ]['size'] ) &&
            ! empty( $settings[ $key ]['unit'] )
        ) {
            return $settings[ $key ]['size'] . $settings[ $key ]['unit'];
        }
        return $fallback;
    }

    /**
     * Return a color value or a fallback.
     *
     * @param array  $settings
     * @param string $key
     * @param string $fallback
     * @return string
     */
    private function color_value( array $settings, string $key, string $fallback = '' ): string {
        return ! empty( $settings[ $key ] ) ? $settings[ $key ] : $fallback;
    }
}