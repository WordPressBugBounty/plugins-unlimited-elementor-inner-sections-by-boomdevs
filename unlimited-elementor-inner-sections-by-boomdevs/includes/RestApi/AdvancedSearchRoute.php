<?php

namespace PrimeElementorAddons\RestApi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AdvancedSearchRoute {

	public static function register_routes() {
		register_rest_route(
			'prime-elementor-addons/v1',
			'/advanced-search',
			[
				'methods' => \WP_REST_Server::READABLE,
				'callback' => [ __CLASS__, 'handle_search' ],
				'permission_callback' => '__return_true',
				'args' => [
					'search' => [
						'type' => 'string',
						'required' => false,
						'sanitize_callback' => 'sanitize_text_field',
					],
					'per_page' => [
						'type' => 'integer',
						'required' => false,
						'default' => 5,
						'sanitize_callback' => 'absint',
					],
				],
			]
		);
	}

	public static function handle_search( \WP_REST_Request $request ) {
		$search_term = trim( (string) $request->get_param( 'search' ) );
		$posts_per_page = max( 1, min( 20, absint( $request->get_param( 'per_page' ) ) ) );

		if ( '' === $search_term ) {
			return rest_ensure_response(
				[
					'items' => [],
				]
			);
		}

		$query = new \WP_Query(
			[
				'post_type' => 'any',
				'post_status' => 'publish',
				's' => $search_term,
				'posts_per_page' => $posts_per_page,
				'ignore_sticky_posts' => true,
			]
		);

		$items = [];

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$items[] = [
					'title' => wp_strip_all_tags( get_the_title() ),
					'url' => esc_url_raw( get_permalink() ),
					'excerpt' => wp_strip_all_tags( get_the_excerpt() ),
					'post_type' => get_post_type(),
					'date' => get_the_date( 'c' ),
				];
			}
		}

		wp_reset_postdata();

		return rest_ensure_response(
			[
				'items' => $items,
			]
		);
	}
}
