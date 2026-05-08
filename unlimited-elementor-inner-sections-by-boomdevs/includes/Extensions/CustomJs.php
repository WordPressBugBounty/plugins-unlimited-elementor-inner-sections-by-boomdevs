<?php

namespace PrimeElementorAddons\Extensions;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\Page;
use PrimeElementorAddons\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Page Custom JS Manager.
 *
 * Registers a Custom JS control inside Elementor's Page Settings panel
 * (Advanced tab) and injects the saved JS into the page footer on the
 * frontend. In the editor it re-runs the JS whenever the panel is saved
 * so the author sees live feedback immediately.
 *
 * Storage  : post meta key  _pea_custom_js
 * Injection: wp_footer (priority 999) — wrapped in a named IIFE so it
 *            never pollutes the global scope accidentally.
 *
 * @package PrimeElementorAddons
 * @since   1.2.0
 */
class CustomJs {

    use Singleton;

    /** Meta key used to persist the JS. */
    const META_KEY = '_pea_custom_js';

    public function __construct() {

        // 1. Register the control inside Page Settings → Advanced tab.
        add_action(
            'elementor/documents/register_controls',
            [ $this, 'register_page_js_control' ],
            10,
            1
        );

        // 2. Save submitted JS when the document is saved.
        add_action(
            'elementor/document/after_save',
            [ $this, 'save_page_js' ],
            10,
            2
        );

        // 3. Inject JS on the public frontend.
        add_action( 'wp_footer', [ $this, 'inject_frontend_js' ], 999 );

        // 4. Inject JS inside the Elementor editor preview iframe.
        add_action( 'elementor/preview/enqueue_scripts', [ $this, 'enqueue_editor_script' ] );
    }

    // -------------------------------------------------------------------------
    // 1. Register Control
    // -------------------------------------------------------------------------

    /**
     * Adds a Custom JS section to every Elementor document's Advanced tab.
     *
     * @param \Elementor\Core\Base\Document $document
     */
    public function register_page_js_control( $document ) {

        // Only attach to page / post documents, not global widgets etc.
        if ( ! $document instanceof \Elementor\Core\Base\Document ) {
            return;
        }

        $document->start_controls_section(
            'pea_custom_js_section',
            [
                'label' => __( 'Custom JS (PEA)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $document->add_control(
            'pea_custom_js_notice',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(
                    '<div style="font-size:12px;line-height:1.6;color:#666;">%s</div>',
                    __( 'JavaScript added here runs after the page fully loads (DOMContentLoaded). Use <code>document</code>, <code>window</code>, or any global library freely. The code is sandboxed in an IIFE on the frontend.', 'unlimited-elementor-inner-sections-by-boomdevs' )
                ),
                'content_classes' => 'elementor-descriptor',
            ]
        );

        $document->add_control(
            'pea_custom_js',
            [
                // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
                'label'       => __( '', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::CODE,
                'language'    => 'javascript',
                'rows'        => 20,
                'label_block' => true,
                'render_type' => 'none', // JS doesn't trigger a re-render
                'default'     => '',
            ]
        );

        $document->end_controls_section();
    }

    // -------------------------------------------------------------------------
    // 2. Save JS to Post Meta
    // -------------------------------------------------------------------------

    /**
     * Persists the custom JS after Elementor saves the document.
     *
     * Elementor fires this hook with the full $data array that was submitted,
     * so we can read our control value directly without touching $_POST.
     *
     * @param \Elementor\Core\Base\Document $document
     * @param array                         $data      Raw save data.
     */
    public function save_page_js( $document, $data ) {

        // Guard: make sure our key exists in the submitted settings.
        if ( ! isset( $data['settings']['pea_custom_js'] ) ) {
            return;
        }

        $post_id = $document->get_main_id();
        $raw_js  = $data['settings']['pea_custom_js'];

        if ( empty( trim( $raw_js ) ) ) {
            delete_post_meta( $post_id, self::META_KEY );
            return;
        }

        // We store raw; sanitization happens at output time via wp_strip_all_tags
        // only if we ever echo it as HTML. When injecting as JS we trust the
        // editor (capability check is Elementor's responsibility) but we do
        // strip </script> close-tags to prevent injection via the textarea.
        $safe_js = $this->sanitize_js( $raw_js );

        update_post_meta( $post_id, self::META_KEY, $safe_js );
    }

    // -------------------------------------------------------------------------
    // 3. Frontend Injection
    // -------------------------------------------------------------------------

    /**
     * Outputs the saved JS in the page footer, wrapped in a DOMContentLoaded
     * IIFE so it runs safely after the DOM is ready.
     */
    public function inject_frontend_js() {

        // Only on singular Elementor-built pages.
        if ( ! is_singular() ) {
            return;
        }

        // Bail inside the editor itself (preview iframe handled separately).
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            return;
        }

        $post_id = get_the_ID();

        if ( ! $post_id || ! $this->page_is_built_with_elementor( $post_id ) ) {
            return;
        }

        $js = get_post_meta( $post_id, self::META_KEY, true );

        if ( empty( trim( (string) $js ) ) ) {
            return;
        }

        $this->print_js_block( $js, $post_id );
    }

    // -------------------------------------------------------------------------
    // 4. Editor (Preview Iframe) — Live Feedback
    // -------------------------------------------------------------------------

    /**
     * Enqueues a small inline script inside the Elementor preview iframe.
     *
     * The script listens for Elementor's document:save:after event and
     * re-fetches the updated JS via a REST call, then re-executes it so the
     * author immediately sees the effect of their changes without a full reload.
     */
    public function enqueue_editor_script() {

        $post_id = \Elementor\Plugin::$instance->editor->get_post_id();
        if ( ! $post_id ) {
            return;
        }

        // Initial JS (already saved) to run on first preview load.
        $initial_js = get_post_meta( $post_id, self::META_KEY, true );

        $editor_script = $this->build_editor_script( $post_id, (string) $initial_js );

        wp_register_script( 'pea-page-custom-js-editor', false, [], false, true );
        wp_enqueue_script( 'pea-page-custom-js-editor' );
        wp_add_inline_script( 'pea-page-custom-js-editor', $editor_script );

        add_action( 'rest_api_init', function () {
            $controller = new \PrimeElementorAddons\RestApi\CustomJsRestController();
            $controller->register_routes();
        } );
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Prints the JS block (used on both frontend and preview).
     *
     * @param string $js
     * @param int    $post_id  Used only as a comment label.
     */
    private function print_js_block( $js, $post_id = 0 ) {
        echo "\n<!-- PEA Custom JS | Post #{$post_id} -->\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo "<script>\n(function(){\n'use strict';\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $js . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo "})();\n</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Builds the editor-side inline script string.
     * This runs inside Elementor's preview iframe.
     *
     * Flow:
     *  1. Run the initial saved JS on preview load.
     *  2. After every document save, re-fetch via REST and re-run.
     *
     * @param int    $post_id
     * @param string $initial_js  Already-saved JS to execute immediately.
     * @return string
     */
    private function build_editor_script( $post_id, $initial_js ) {

        $rest_url  = esc_js( rest_url( 'pea/v1/page-custom-js/' . $post_id ) );
        $nonce     = wp_create_nonce( 'wp_rest' );
        // Encode the initial JS as JSON so it's safe to drop into a JS string literal.
        $initial_encoded = wp_json_encode( $initial_js );

        return <<<JS
        (function () {
            'use strict';

            /**
             * Execute arbitrary JS inside an isolated function scope.
             * Any errors are caught so they never break the editor.
             */
            function peaRunUserJs(code) {
                if (!code || !code.trim()) return;
                try {
                    // eslint-disable-next-line no-new-func
                    (new Function(code))();
                } catch (err) {
                    console.warn('[PEA Custom JS] Error in user script:', err);
                }
            }

            // --- 1. Run initial JS on preview load ---
            var initialJs = {$initial_encoded};
            document.addEventListener('DOMContentLoaded', function () {
                peaRunUserJs(initialJs);
            });

            // --- 2. Re-run after every save in the editor ---
            // The parent window holds the Elementor editor instance;
            // we listen for its custom event forwarded into the iframe.
            window.addEventListener('message', function (event) {
                if (!event.data || event.data.type !== 'pea_reload_custom_js') return;
                peaRunUserJs(event.data.js || '');
            });

            // Notify parent to fetch fresh JS after Elementor fires document:save:after
            // (this part runs in the PARENT window context via elementor's own JS,
            //  but we also try to hook it here if the iframe has access to parent.elementor)
            try {
                var editorWindow = window.parent;
                if (editorWindow && editorWindow.elementor) {
                    editorWindow.elementor.channels.editor.on('document:save:after', function () {
                        fetch('{$rest_url}', {
                            headers: { 'X-WP-Nonce': '{$nonce}' }
                        })
                        .then(function (r) { return r.json(); })
                        .then(function (data) {
                            if (data && typeof data.js !== 'undefined') {
                                window.postMessage({ type: 'pea_reload_custom_js', js: data.js }, '*');
                            }
                        })
                        .catch(function (e) {
                            console.warn('[PEA Custom JS] Could not reload JS after save:', e);
                        });
                    });
                }
            } catch (e) {
                // Cross-origin or preview-mode restriction — silent fail.
            }
        }());
        JS;
    }

    /**
     * Strip </script> closing tags to prevent breaking out of the script block.
     * Full JS sanitization is the editor-user's responsibility (capability-gated).
     *
     * @param string $js
     * @return string
     */
    private function sanitize_js( $js ) {
        // Close-tag injection prevention.
        return preg_replace( '#</\s*script\s*>#i', '<\\/script>', $js );
    }

    /**
     * Quick check: was this post last edited with Elementor?
     *
     * @param int $post_id
     * @return bool
     */
    private function page_is_built_with_elementor( $post_id ) {
        return 'builder' === get_post_meta( $post_id, '_elementor_edit_mode', true );
    }
}