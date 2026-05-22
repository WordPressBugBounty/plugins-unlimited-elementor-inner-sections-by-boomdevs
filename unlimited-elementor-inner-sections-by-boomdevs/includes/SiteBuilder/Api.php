<?php

namespace PrimeElementorAddons\SiteBuilder;

if (!defined('ABSPATH')) exit;

use PrimeElementorAddons\Traits\Singleton;

class Api {

    use Singleton;

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {

        register_rest_route('pea/v1', '/template/create', [
            'methods'  => 'POST',
            'callback' => [$this, 'create_template'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]);

        register_rest_route('pea/v1', '/template/list', [
            'methods'  => 'GET',
            'callback' => [$this, 'get_templates'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]);

        register_rest_route('pea/v1', '/template/delete/(?P<id>\d+)', [
            'methods'             => 'DELETE',
            'callback'            => [$this, 'delete_template'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]);
    }

    public function create_template($request) {

        $params = $request->get_json_params();

        $name      = isset($params['name']) ? sanitize_text_field($params['name']) : '';
        $type      = isset($params['type']) ? sanitize_text_field($params['type']) : '';
        $display   = isset($params['display']) ? (array) $params['display'] : [];
        $post_title = !empty($name) ? $name : ucfirst($type) . ' Template';

        $page_template = 'elementor_canvas';
        if ($type === 'header' || $type === 'footer') {
            $page_template = 'elementor_canvas';
        } else {
            $page_template = 'elementor_header_footer';
        }

        if (empty($type)) {
            return new \WP_REST_Response([
                'success' => false,
                'message' => 'Template type is required'
            ], 400);
        }

        // Create Template post
        $post_id = wp_insert_post([
            'post_title'  => $post_title,
            'post_type'   => 'pea-site-builder',
            'post_status' => 'publish',
            'meta_input'  => [
                '_wp_page_template' => $page_template
            ]
        ]);

        if (is_wp_error($post_id)) {
            return new \WP_REST_Response([
                'success' => false,
                'message' => 'Failed to create template'
            ], 500);
        }

        // Save meta
        update_post_meta($post_id, 'pea_template_type', $type);
        update_post_meta($post_id, 'pea_display_on_template', $display);

        // Elementor edit link
        $edit_url = admin_url("post.php?post={$post_id}&action=elementor");

        return new \WP_REST_Response([
            'success' => true,
            'post_id' => $post_id,
            'edit_url' => $edit_url
        ], 200);
    }

    public function get_templates() {

        $query = new \WP_Query([
            'post_type'      => 'pea-site-builder',
            'posts_per_page' => -1,
            'post_status'    => ['publish', 'draft', 'pending', 'future', 'private'],
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $templates = [];

        while ($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();

            $template_type   = get_post_meta($post_id, 'pea_template_type', true);
            $display_on      = get_post_meta($post_id, 'pea_display_on_template', true);

            /**
             * Normalize display condition.
             * It may be stored as array or string.
             */
            if (is_array($display_on)) {
                $display_on = !empty($display_on) ? $display_on[0] : 'all';
            }

            /**
             * Determine logical template type
             */
            $type = $this->map_template_type($template_type, $display_on);

            /**
             * Human readable label
             */
            $label = $this->get_template_label($type);

            /**
             * Elementor edit URL
             */
            $edit_url = add_query_arg(
                [
                    'post'   => $post_id,
                    'action' => 'elementor',
                ],
                admin_url('post.php')
            );

            $templates[] = [
                'id'               => $post_id,
                'title'            => get_the_title(),
                'type'             => $type,              // Used for filtering in React
                'template_type'    => $template_type,     // header|footer|body
                'display_condition'=> $display_on,        // home|search|all etc
                'label'            => $label,             // Human readable type
                'status'            => get_post_status($post_id),
                'edit_url'         => $edit_url,
                // 'preview_url'       => get_permalink($post_id),
                'date'              => get_the_date('c', $post_id),
            ];
        }

        wp_reset_postdata();

        return rest_ensure_response([
            'success' => true,
            'data'    => $templates,
        ]);
    }

    /**
     * Delete Template Callback
     */
    public function delete_template(\WP_REST_Request $request) {
        $template_id = absint($request->get_param('id'));

        if (!$template_id) {
            return new \WP_REST_Response([
                'success' => false,
                'message' => __('Invalid template ID.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ], 400);
        }

        // Verify post exists
        $post = get_post($template_id);

        if (!$post || 'pea-site-builder' !== $post->post_type) {
            return new \WP_REST_Response([
                'success' => false,
                'message' => __('Template not found.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ], 404);
        }

        // Delete permanently
        $deleted = wp_delete_post($template_id, true);

        if (!$deleted) {
            return new \WP_REST_Response([
                'success' => false,
                'message' => __('Unable to delete template.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ], 500);
        }

        return new \WP_REST_Response([
            'success' => true,
            'message' => __('Template deleted successfully.', 'unlimited-elementor-inner-sections-by-boomdevs'),
        ], 200);
    }

    /**
     * Map saved template type to frontend type
     */
    private function map_template_type($template_type, $display_on) {

        if ($template_type === 'header') {
            return 'header';
        }

        if ($template_type === 'footer') {
            return 'footer';
        }

        if ($template_type === 'body') {
            $map = [
                'home'         => 'home',
                'singlePost'   => 'singlePost',
                'blogArchive'  => 'blogArchive',
                'search'       => 'search',
                'notFound'     => 'notFound',
                'all'          => 'body',
            ];

            return $map[$display_on] ?? 'body';
        }

        return 'unknown';
    }

    /**
     * Human readable template label
     */
    private function get_template_label($type) {

        $labels = [
            'header'       => __('Header', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'footer'       => __('Footer', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'home'         => __('Homepage', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'singlePost'   => __('Single Post', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'blogArchive'  => __('Archive', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'search'       => __('Search Result', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'notFound'     => __('404 Page', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'body'         => __('Full Site Template', 'unlimited-elementor-inner-sections-by-boomdevs'),
        ];

        return $labels[$type] ?? __('Template', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
}