<?php
namespace PrimeElementorAddons\Ajax;

use PrimeElementorAddons\Traits\PostGridRenderer;

class PostGridAjaxHandler {
    use PostGridRenderer;
    
    private static function sanitize_recursive( $data ) {
        if ( is_array( $data ) ) {
            return array_map( [ __CLASS__, 'sanitize_recursive' ], $data );
        }

        if ( is_string( $data ) ) {
            return sanitize_text_field( $data );
        }

        return $data; // bool, int, null
    }

    public static function handle_load_posts() {
        if ( ! check_ajax_referer( 'prime_elementor_addons_nonce', 'nonce', false ) ) {
            wp_send_json_error( ['message' => 'Invalid nonce'], 403 );
            return;
        }
        
        $query_settings   = [];
        $display_settings = [];
        $element_settings = [];

        if ( isset( $_POST['query_settings'] ) ) {
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            $query_settings = json_decode( wp_unslash( $_POST['query_settings'] ),
                true
            );
            $query_settings = is_array( $query_settings )
                ? self::sanitize_recursive( $query_settings )
                : [];
        }

        if ( isset( $_POST['display_settings'] ) ) {
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            $display_settings = json_decode( wp_unslash( $_POST['display_settings'] ),
                true
            );
            $display_settings = is_array( $display_settings )
                ? self::sanitize_recursive( $display_settings )
                : [];
        }

        if ( isset( $_POST['element_settings'] ) ) {
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            $element_settings = json_decode( wp_unslash( $_POST['element_settings'] ),
                true
            );
            $element_settings = is_array( $element_settings )
                ? self::sanitize_recursive( $element_settings )
                : [];
        }
        
        $paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1;
        
        // Create instance to access trait methods
        $handler = new self();
        
        // Build query
        $args = $handler->build_query_args($query_settings, $paged);
        $query = new \WP_Query($args);
        
        ob_start();
        if ($query->have_posts()) {
            $merged_settings = array_merge($display_settings, [
                'excerpt_length' => ['size' => $display_settings['excerpt_length']],
            ]);
            
            while ($query->have_posts()) {
                $query->the_post();
                $handler->render_post_card($merged_settings);
            }
        }
        $html = ob_get_clean();
        wp_reset_postdata();
        
        wp_send_json_success([
            'html' => $html,
            'current_page' => $paged,
            'max_pages' => $query->max_num_pages,
        ]);
    }
}
