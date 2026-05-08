<?php

namespace PrimeElementorAddons\RestApi;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * REST endpoint that serves the saved custom JS for a given post.
 * Used by the Elementor editor preview to reload JS after every save
 * without a full page refresh.
 *
 * Route : GET /wp-json/pea/v1/page-custom-js/{post_id}
 * Auth  : Logged-in users who can edit the post (editor_callback).
 *
 * @package PrimeElementorAddons
 * @since   1.2.0
 */
class CustomJsRestController extends \WP_REST_Controller {

    protected $namespace = 'pea/v1';
    protected $rest_base = 'page-custom-js';

    public function register_routes() {

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_item' ],
                    'permission_callback' => [ $this, 'get_item_permissions_check' ],
                    'args'                => [
                        'id' => [
                            'description'       => __( 'Post ID', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'              => 'integer',
                            'required'          => true,
                            'sanitize_callback' => 'absint',
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Only users who can edit the specific post may read the JS.
     */
    public function get_item_permissions_check( $request ) {
        $post_id = $request->get_param( 'id' );
        return current_user_can( 'edit_post', $post_id );
    }

    /**
     * Returns the raw saved JS for the requested post.
     */
    public function get_item( $request ) {
        $post_id = $request->get_param( 'id' );
        $js      = get_post_meta( $post_id, \PrimeElementorAddons\Extensions\CustomJs::META_KEY, true );

        return rest_ensure_response(
            [
                'post_id' => $post_id,
                'js'      => $js ?: '',
            ]
        );
    }
}