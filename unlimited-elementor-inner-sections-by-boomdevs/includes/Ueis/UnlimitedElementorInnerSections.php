<?php

namespace PrimeElementorAddons\Ueis;

use PrimeElementorAddons\Ueis\BoomDevsNotificationWidgetInner;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Unlimited Elementor Inner Sections
 *
 * Backward compatibility layer for the original UEIS plugin.
 *
 * @since 1.0.0
 */
class UnlimitedElementorInnerSections {

	/**
	 * Plugin slug / handle.
	 *
	 * @var string
	 */
	protected string $plugin_name = 'unlimited-elementor-inner-sections-by-boomdevs';

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	protected string $version;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->version = defined( 'PEA_VERSION' ) ? PEA_VERSION : '1.0.9';

		$this->load_dependencies();

		// Enqueue Elementor editor script
		add_action(
			'elementor/editor/after_enqueue_scripts',
			[ $this, 'enqueue_editor_script' ]
		);
	}

	/**
	 * Load required dependencies.
	 *
	 * @since 1.0.0
	 */
	private function load_dependencies(): void {
		new BoomDevsNotificationWidgetInner();
	}

	/**
	 * Enqueue nested section editor script.
	 *
	 * Uses filemtime() as version when available so browsers always pick up
	 * the latest minified bundle during development without a manual cache
	 * bust. Falls back to the plugin version in production-like environments
	 * where the file is unreadable.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_editor_script(): void {
		$script_path = plugin_dir_path( __FILE__ ) . 'js/elementor-editor.min.js';
		$script_url  = plugin_dir_url( __FILE__ ) . 'js/elementor-editor.min.js';

		$version = file_exists( $script_path )
			? (string) filemtime( $script_path )
			: $this->version;

		wp_enqueue_script(
			$this->plugin_name . '-elementor-editor',
			$script_url,
			[ 'elementor-editor' ],
			$version,
			true
		);
	}
}
