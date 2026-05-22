<?php

namespace PrimeElementorAddons\Extensions;

use PrimeElementorAddons\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Duplicator {

	use Singleton;

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action(
			'admin_action_prime_duplicate_post',
			[ $this, 'duplicate_post' ]
		);

		add_filter(
			'post_row_actions',
			[ $this, 'add_duplicate_link' ],
			10,
			2
		);

		add_filter(
			'page_row_actions',
			[ $this, 'add_duplicate_link' ],
			10,
			2
		);

        add_action( 'admin_notices', function() {

            if ( empty( $_GET['prime_duplicated'] ) ) {
                return;
            }

            ?>

            <div class="notice notice-success is-dismissible">
                <p>
                    <?php esc_html_e(
                        'Post duplicated successfully.',
                        'unlimited-elementor-inner-sections-by-boomdevs'
                    ); ?>
                </p>
            </div>

            <?php
        });
	}

	/**
	 * Add duplicate link to row actions
	 */
	public function add_duplicate_link( $actions, $post ) {

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return $actions;
		}

		$post_type_object = get_post_type_object( $post->post_type );

		if ( ! $post_type_object ) {
			return $actions;
		}

		$create_cap = ! empty( $post_type_object->cap->create_posts )
			? $post_type_object->cap->create_posts
			: $post_type_object->cap->edit_posts;

		if ( ! current_user_can( $create_cap ) ) {
			return $actions;
		}

		$url = wp_nonce_url(
			admin_url(
				'admin.php?action=prime_duplicate_post&post=' . $post->ID
			),
			'prime_duplicate_post_' . $post->ID
		);

		$actions['prime_duplicate'] = sprintf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			esc_url( $url ),
			esc_attr__(
				'Duplicate this item',
				'unlimited-elementor-inner-sections-by-boomdevs'
			),
			esc_html__(
				'Duplicate (PEA)',
				'unlimited-elementor-inner-sections-by-boomdevs'
			)
		);

		return $actions;
	}

	/**
	 * Duplicate post
	 */
	public function duplicate_post() {

		if (
			empty( $_GET['post'] ) ||
			empty( $_GET['_wpnonce'] )
		) {
			wp_die(
				esc_html__(
					'Invalid request.',
					'unlimited-elementor-inner-sections-by-boomdevs'
				)
			);
		}

		$post_id = absint( $_GET['post'] );

		check_admin_referer(
			'prime_duplicate_post_' . $post_id
		);

		$post = get_post( $post_id );

		if ( ! $post ) {
			wp_die(
				esc_html__(
					'Post not found.',
					'unlimited-elementor-inner-sections-by-boomdevs'
				)
			);
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			wp_die(
				esc_html__(
					'Permission denied.',
					'unlimited-elementor-inner-sections-by-boomdevs'
				)
			);
		}

		$current_user = wp_get_current_user();

		/**
		 * Create duplicate post
		 */
		$new_post_args = [
			'post_author'    => $current_user->ID,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title . ' (Copy)',
			'post_type'      => $post->post_type,
			'post_parent'    => $post->post_parent,
			'menu_order'     => $post->menu_order,
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_password'  => $post->post_password,
			'to_ping'        => $post->to_ping,
		];

		$new_post_id = wp_insert_post( $new_post_args );

		if ( is_wp_error( $new_post_id ) ) {

			wp_die(
				esc_html__(
					'Failed to duplicate post.',
					'unlimited-elementor-inner-sections-by-boomdevs'
				)
			);
		}

		/**
		 * Copy taxonomies
		 */
		$taxonomies = get_object_taxonomies(
			$post->post_type
		);

		if ( ! empty( $taxonomies ) ) {

			foreach ( $taxonomies as $taxonomy ) {

				$terms = wp_get_object_terms(
					$post_id,
					$taxonomy,
					[
						'fields' => 'ids',
					]
				);

				wp_set_object_terms(
					$new_post_id,
					$terms,
					$taxonomy
				);
			}
		}

		/**
		 * Copy post meta
		 */
		$this->duplicate_post_meta(
			$post_id,
			$new_post_id
		);

		/**
		 * Redirect to editor
		 */
        $post_type = get_post_type( $new_post_id );

        wp_safe_redirect(
            add_query_arg(
                [
                    'post_type'        => $post_type,
                    'prime_duplicated' => 1,
                ],
                admin_url( 'edit.php' )
            )
        );

        exit;
	}

	/**
	 * Duplicate post meta
	 */
	private function duplicate_post_meta(
		$old_post_id,
		$new_post_id
	) {

		global $wpdb;

		$excluded_meta_keys = [
			'_edit_lock',
			'_edit_last',
			'_wp_old_slug',
			'_elementor_css',
			'_oembed_cache',
		];

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
		$meta_data = $wpdb->get_results(
			$wpdb->prepare(
				"
				SELECT meta_key, meta_value
				FROM {$wpdb->postmeta}
				WHERE post_id = %d
				",
				$old_post_id
			)
		);

		if ( empty( $meta_data ) ) {
			return;
		}

		$query_values = [];
		$query_prepare = [];

		foreach ( $meta_data as $meta ) {

			if (
				in_array(
					$meta->meta_key,
					$excluded_meta_keys,
					true
				)
			) {
				continue;
			}

			$query_values[] = '( %d, %s, %s )';

			$query_prepare[] = $new_post_id;
			$query_prepare[] = $meta->meta_key;
			$query_prepare[] = $meta->meta_value;
		}

		if ( empty( $query_values ) ) {
			return;
		}

		$sql = "
			INSERT INTO {$wpdb->postmeta}
			(post_id, meta_key, meta_value)
			VALUES
		";

		$sql .= implode( ',', $query_values );

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$wpdb->query(
			$wpdb->prepare(
				$sql,
				$query_prepare
			)
		);
	}
}