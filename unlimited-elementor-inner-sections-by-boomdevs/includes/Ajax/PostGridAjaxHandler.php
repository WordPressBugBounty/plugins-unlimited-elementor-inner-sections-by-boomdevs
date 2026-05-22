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
        $isArchive = isset($_POST['isArchive']) ? $_POST['isArchive'] : 1;
        
        // Create instance to access trait methods
        $handler = new self();
        // Build query
        if($isArchive === 'true'){
            $args = $handler->build_archive_query_args($query_settings, $paged);
        } else {
            $args = $handler->build_query_args($query_settings, $paged);
        }
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

    public static function get_author_by_post_type() {
        if (!check_ajax_referer('pea_editor_only_nonce', 'pea_editor_nonce_check', false)) {
            wp_send_json_error(['message' => 'Invalid nonce'], 403);
            return;
        }

        if (!current_user_can('edit_posts')) {
            wp_send_json_error(['message' => esc_html__('Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs')], 403);
        }

        $allowed_post_types = get_post_types(['public' => true]);
        $post_type = isset($_POST['post_type'])
            ? sanitize_key(wp_unslash($_POST['post_type']))
            : '';
        if (!in_array($post_type, $allowed_post_types, true)) {
            wp_send_json_error(['message' => esc_html__('Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
        }

        if (empty($post_type)) {
            wp_send_json_error(['message' => esc_html__('Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
        }

        global $wpdb;

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- Get author IDs from posts of the given post type
        $author_ids = $wpdb->get_col($wpdb->prepare(
            "SELECT DISTINCT post_author 
            FROM $wpdb->posts 
            WHERE post_type = %s 
            AND post_status = 'publish'",
            $post_type
        ));

        if (empty($author_ids)) {
            return [];
        }

        // Fetch user info
        $authors = [];
        foreach ($author_ids as $author_id) {
            $user = get_user_by('id', $author_id);
            if ($user) {
                $authors[$user->ID] = $user->display_name;
            }
        }

        wp_send_json_success($authors);
    }

    public static function get_category_by_post_type() {
        if (!check_ajax_referer('pea_editor_only_nonce', 'pea_editor_nonce_check', false)) {
            wp_send_json_error(['message' => 'Invalid nonce'], 403);
            return;
        }

        if (!current_user_can('edit_posts')) {
            wp_send_json_error(['message' => esc_html__('Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs')], 403);
        }

        $allowed_post_types = get_post_types(['public' => true]);
        $post_type = isset($_POST['post_type'])
            ? sanitize_key(wp_unslash($_POST['post_type']))
            : '';
        if (!in_array($post_type, $allowed_post_types, true)) {
            wp_send_json_error(['message' => esc_html__('Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
        }

        if (empty($post_type)) {
            wp_send_json_error(['message' => esc_html__('Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
        }

        $options = [];

        // Get all taxonomies linked to the post type
        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $taxonomy) {

            // Skip non-hierarchical (object tags, etc.)
            if (!$taxonomy->hierarchical) {
                continue;
            }

            // Get all terms from this category-like taxonomy
            $terms = get_terms([
                'taxonomy' => $taxonomy->name,
                'hide_empty' => false,
                'number' => 100,
                'orderby' => 'count',
                'order' => 'DESC',
            ]);

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $options[$term->term_id] = $term->name;
                }
            }
        }

        wp_send_json_success($options);
    }

    public static function get_tag_by_post_type() {
        if (!check_ajax_referer('pea_editor_only_nonce', 'pea_editor_nonce_check', false)) {
            wp_send_json_error(['message' => 'Invalid nonce'], 403);
            return;
        }

        if (!current_user_can('edit_posts')) {
            wp_send_json_error(['message' => esc_html__('Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs')], 403);
        }

        $allowed_post_types = get_post_types(['public' => true]);
        $post_type = isset($_POST['post_type'])
            ? sanitize_key(wp_unslash($_POST['post_type']))
            : '';
        if (!in_array($post_type, $allowed_post_types, true)) {
            wp_send_json_error(['message' => esc_html__('Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
        }

        if (empty($post_type)) {
            wp_send_json_error(['message' => esc_html__('Invalid post type', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
        }
        $options = [];

        // Get all taxonomies linked to the post type
        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $taxonomy) {

            // Skip hierarchical (object category, etc.)
            if ($taxonomy->hierarchical) {
                continue;
            }

            // Get all terms from this tag-like taxonomy
            $terms = get_terms([
                'taxonomy' => $taxonomy->name,
                'hide_empty' => false,
                'number' => 100,
                'orderby' => 'count',
                'order' => 'DESC',
            ]);

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $options[$term->term_id] = $term->name;
                }
            }
        }

        wp_send_json_success($options);
    }

    public static function get_terms_by_taxonomy() {
        if (!check_ajax_referer('pea_editor_only_nonce', 'pea_editor_nonce_check', false)) {
            wp_send_json_error(['message' => 'Invalid nonce'], 403);
            return;
        }

        if (!current_user_can('edit_posts')) {
            wp_send_json_error(['message' => esc_html__('Unauthorized', 'unlimited-elementor-inner-sections-by-boomdevs')], 403);
            return;
        }

        $taxonomy = isset($_POST['taxonomy'])
            ? sanitize_key(wp_unslash($_POST['taxonomy']))
            : '';

        if ($taxonomy === '' || !taxonomy_exists($taxonomy)) {
            wp_send_json_error(['message' => esc_html__('Invalid taxonomy', 'unlimited-elementor-inner-sections-by-boomdevs')], 400);
            return;
        }

        $terms = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
            'number' => 0,
        ]);

        if (is_wp_error($terms)) {
            wp_send_json_error(['message' => esc_html__('Unable to load terms', 'unlimited-elementor-inner-sections-by-boomdevs')], 500);
            return;
        }

        $options = [];

        foreach ($terms as $term) {
            $options[$term->term_id] = sprintf(
                '%s',
                $term->name,
            );
        }

        wp_send_json_success($options);
    }
}
