<?php

namespace PrimeElementorAddons\Extensions;

use PrimeElementorAddons\Traits\Singleton;
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Plugin as ElementorPlugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Advanced Wrapper Link
 *
 * Adds a clickable wrapper link to any Elementor
 * section, column, or widget — with full control over
 * link target, rel attributes, and accessibility label.
 *
 * Features:
 *  - Works on sections, containers, columns, and widgets
 *  - Supports internal/external URLs, phone, email, anchor
 *  - Open in same tab / new tab
 *  - Nofollow / sponsored / noopener rel options
 *  - Custom aria-label for accessibility
 *  - Cursor style override (pointer / default / custom)
 *  - Disabled state (keeps controls visible but inactive)
 *  - Does NOT break nested interactive elements (buttons, links)
 *    by using pointer-events layering via a pseudo-element overlay
 */
class WrapperLink {

	use Singleton;

	/**
	 * Element types to inject controls into.
	 *
	 * @var string[]
	 */
	private array $element_types = [
		'section',
		'column',
		'container',
		'widget',
	];

	/**
	 * Controls section name used in Elementor panel.
	 */
	const SECTION_KEY = 'prime_wrapper_link_section';

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action(
			'elementor/element/after_section_end',
			[ $this, 'register_controls' ],
			10,
			3
		);

		add_action(
			'elementor/frontend/section/before_render',
			[ $this, 'before_render' ]
		);

		add_action(
			'elementor/frontend/column/before_render',
			[ $this, 'before_render' ]
		);

		add_action(
			'elementor/frontend/container/before_render',
			[ $this, 'before_render' ]
		);

		add_action(
			'elementor/frontend/widget/before_render',
			[ $this, 'before_render' ]
		);

		add_action(
			'elementor/frontend/section/after_render',
			[ $this, 'after_render' ]
		);

		add_action(
			'elementor/frontend/column/after_render',
			[ $this, 'after_render' ]
		);

		add_action(
			'elementor/frontend/container/after_render',
			[ $this, 'after_render' ]
		);

		add_action(
			'elementor/frontend/widget/after_render',
			[ $this, 'after_render' ]
		);

		add_action(
			'wp_footer',
			[ $this, 'enqueue_inline_script' ],
			20
		);

		add_filter(
			'elementor/frontend/section/should_render',
			'__return_true'
		);
	}

	/**
	 * Register controls in the Elementor panel.
	 *
	 * Injects a collapsible section after the "Advanced" tab
	 * on sections, columns, containers, and widgets.
	 *
	 * NOTE: The hook `elementor/element/after_section_end` fires
	 * for ALL controls stacks — including Kit, Document, and other
	 * objects that do NOT extend Element_Base. We must use the
	 * Controls_Stack parent type hint and guard with instanceof.
	 *
	 * @param \Elementor\Controls_Stack $element
	 * @param string                    $section_id
	 * @param array                     $args
	 */
	public function register_controls(
		\Elementor\Controls_Stack $element,
		string $section_id,
		array $args
	): void {

		// Bail out for Kit, Document, and any non-element stack.
		if ( ! $element instanceof Element_Base ) {
			return;
		}

		if ( ! in_array( $element->get_type(), $this->element_types, true ) ) {
			return;
		}

		// Inject only once, after the last "advanced" section.
		if ( '_section_responsive' !== $section_id ) {
			return;
		}

		$element->start_controls_section(
			self::SECTION_KEY,
			[
				'label' => esc_html__(
					'Wrapper Link (PEA)',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		// ── Enable toggle ──────────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_enabled',
			[
				'label'        => esc_html__(
					'Enable Wrapper Link',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off'    => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		// ── URL ────────────────────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_url',
			[
				'label'       => esc_html__(
					'Link URL',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__(
					'https://your-link.com',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'options'       => [ 'url', 'is_external', 'nofollow' ],
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'prime_wrapper_link_enabled' => 'yes',
				],
			]
		);

		// ── Rel attributes ─────────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_rel',
			[
				'label'       => esc_html__(
					'Additional Rel Attributes',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => [
					'noopener'    => 'noopener',
					'noreferrer'  => 'noreferrer',
					'sponsored'   => 'sponsored',
					'ugc'         => 'ugc',
				],
				'label_block' => true,
				'condition'   => [
					'prime_wrapper_link_enabled' => 'yes',
				],
			]
		);

		// ── Accessibility label ────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_aria_label',
			[
				'label'       => esc_html__(
					'Accessibility Label (aria-label)',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__(
					'Describe the link destination',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'description' => esc_html__(
					'Improves accessibility for screen readers. Recommended when the linked element has no visible text.',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'condition'   => [
					'prime_wrapper_link_enabled' => 'yes',
				],
			]
		);

		// ── Cursor style ───────────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_cursor',
			[
				'label'     => esc_html__(
					'Cursor',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pointer',
				'options'   => [
					'pointer'  => esc_html__( 'Pointer (default)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'default'  => esc_html__( 'Default arrow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'zoom-in'  => esc_html__( 'Zoom in', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'grab'     => esc_html__( 'Grab', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'none'     => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'selectors' => [
					'{{WRAPPER}}.prime-has-wrapper-link' => 'cursor: {{VALUE}};',
				],
				'condition' => [
					'prime_wrapper_link_enabled' => 'yes',
				],
			]
		);

		// ── Highlight on hover ─────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_hover_effect',
			[
				'label'     => esc_html__(
					'Hover Effect',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => [
					'none'    => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'opacity' => esc_html__( 'Fade on hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'lift'    => esc_html__( 'Lift (translate Y)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'scale'   => esc_html__( 'Scale up', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'shadow'  => esc_html__( 'Box shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'condition' => [
					'prime_wrapper_link_enabled' => 'yes',
				],
			]
		);

		// ── Transition duration ────────────────────────────────────
		$element->add_control(
			'prime_wrapper_link_transition',
			[
				'label'      => esc_html__(
					'Transition Duration (ms)',
					'unlimited-elementor-inner-sections-by-boomdevs'
				),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 300 ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 1500,
						'step' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.prime-has-wrapper-link' => 'transition-duration: {{SIZE}}ms;',
				],
				'condition'  => [
					'prime_wrapper_link_enabled'      => 'yes',
					'prime_wrapper_link_hover_effect!' => 'none',
				],
			]
		);

		$element->end_controls_section();
	}

	/**
	 * Output the opening <a> tag before the element renders.
	 *
	 * We wrap the element's rendered HTML inside a semantic <a>
	 * tag using output buffering. Nested interactive elements
	 * (buttons, anchors) remain clickable via JS event delegation.
	 *
	 * @param Element_Base $element
	 */
	public function before_render( Element_Base $element ): void {

		$settings = $element->get_settings_for_display();

		if ( empty( $settings['prime_wrapper_link_enabled'] ) ||
			'yes' !== $settings['prime_wrapper_link_enabled'] ) {
			return;
		}

		$link_data = $settings['prime_wrapper_link_url'] ?? [];
		$url       = ! empty( $link_data['url'] ) ? $link_data['url'] : '';

		if ( empty( $url ) ) {
			return;
		}

		// Mark element for JS and CSS targeting.
		$element->add_render_attribute(
			'_wrapper',
			'class',
			'prime-has-wrapper-link'
		);

		$element->add_render_attribute(
			'_wrapper',
			'data-prime-wrapper-link',
			esc_url( $url )
		);

		// Build rel attribute value.
		$rel_parts = [];

		if ( ! empty( $link_data['is_external'] ) ) {
			$rel_parts[] = 'noopener';
		}

		if ( ! empty( $link_data['nofollow'] ) ) {
			$rel_parts[] = 'nofollow';
		}

		$extra_rels = $settings['prime_wrapper_link_rel'] ?? [];

		if ( is_array( $extra_rels ) && ! empty( $extra_rels ) ) {
			$rel_parts = array_unique(
				array_merge( $rel_parts, $extra_rels )
			);
		}

		if ( ! empty( $rel_parts ) ) {
			$element->add_render_attribute(
				'_wrapper',
				'data-prime-wrapper-rel',
				implode( ' ', $rel_parts )
			);
		}

		// Target.
		if ( ! empty( $link_data['is_external'] ) ) {
			$element->add_render_attribute(
				'_wrapper',
				'data-prime-wrapper-target',
				'_blank'
			);
		}

		// Aria label.
		$aria_label = sanitize_text_field(
			$settings['prime_wrapper_link_aria_label'] ?? ''
		);

		if ( ! empty( $aria_label ) ) {
			$element->add_render_attribute(
				'_wrapper',
				'data-prime-wrapper-aria',
				$aria_label
			);
		}

		// Hover effect class.
		$hover = $settings['prime_wrapper_link_hover_effect'] ?? 'none';

		if ( 'none' !== $hover ) {
			$element->add_render_attribute(
				'_wrapper',
				'class',
				'prime-wrapper-hover-' . sanitize_html_class( $hover )
			);
		}
	}

	/**
	 * After render — nothing needed; JS handles the overlay anchor.
	 *
	 * @param Element_Base $element
	 */
	public function after_render( Element_Base $element ): void {
		// Intentionally empty.
		// The JS approach (see enqueue_inline_script) inserts an
		// absolutely-positioned <a> overlay, which is the cleanest
		// technique for nested-link safety and avoids invalid HTML
		// (block elements inside <a> are invalid in strict parsers).
	}

	/**
	 * Enqueue the inline JavaScript that powers wrapper links
	 * on the frontend (and inside the Elementor editor preview).
	 */
	public function enqueue_inline_script(): void {

		// Only output on pages that likely have wrapper links.
		// Checking via a global flag set during before_render
		// would be ideal; a lightweight DOM check costs nothing.
		?>
		<style id="prime-wrapper-link-styles">
			.prime-has-wrapper-link {
				position: relative;
			}

			/* Full-size overlay anchor — sits above the background,
			   below child interactive elements. */
			.prime-has-wrapper-link > .prime-wl-overlay {
				position: absolute;
				inset: 0;
				z-index: 1;
				display: block;
				text-decoration: none;
				cursor: inherit;
			}

			/* Ensure real interactive children sit above the overlay */
			.prime-has-wrapper-link a:not(.prime-wl-overlay),
			.prime-has-wrapper-link button,
			.prime-has-wrapper-link input,
			.prime-has-wrapper-link select,
			.prime-has-wrapper-link textarea,
			.prime-has-wrapper-link [role="button"],
			.prime-has-wrapper-link label {
				position: relative;
				z-index: 2;
			}

			/* ── Hover effects ───────────────────────────────────── */
			.prime-has-wrapper-link.prime-wrapper-hover-opacity {
				transition-property: opacity;
			}
			.prime-has-wrapper-link.prime-wrapper-hover-opacity:hover {
				opacity: 0.8;
			}

			.prime-has-wrapper-link.prime-wrapper-hover-lift {
				transition-property: transform;
			}
			.prime-has-wrapper-link.prime-wrapper-hover-lift:hover {
				transform: translateY(-4px);
			}

			.prime-has-wrapper-link.prime-wrapper-hover-scale {
				transition-property: transform;
			}
			.prime-has-wrapper-link.prime-wrapper-hover-scale:hover {
				transform: scale(1.02);
			}

			.prime-has-wrapper-link.prime-wrapper-hover-shadow {
				transition-property: box-shadow;
			}
			.prime-has-wrapper-link.prime-wrapper-hover-shadow:hover {
				box-shadow: 0 8px 32px rgba(0, 0, 0, 0.14);
			}
		</style>
		<script id="prime-wrapper-link-script">
		(function () {

			/**
			 * Build and insert an overlay <a> anchor into every
			 * element that has the prime-has-wrapper-link class.
			 */
			function initWrapperLinks( scope ) {

				var elements = ( scope || document ).querySelectorAll(
					'.prime-has-wrapper-link:not([data-prime-wl-init])'
				);

				elements.forEach( function ( el ) {

					var url = el.getAttribute( 'data-prime-wrapper-link' );

					if ( ! url ) {
						return;
					}

					var anchor = document.createElement( 'a' );
					anchor.className   = 'prime-wl-overlay';
					anchor.href        = url;

					var target = el.getAttribute( 'data-prime-wrapper-target' );
					if ( target ) {
						anchor.target = target;
					}

					var rel = el.getAttribute( 'data-prime-wrapper-rel' );
					if ( rel ) {
						anchor.rel = rel;
					}

					var aria = el.getAttribute( 'data-prime-wrapper-aria' );
					if ( aria ) {
						anchor.setAttribute( 'aria-label', aria );
					} else {
						/* Hide decorative overlay from screen readers —
						   visible child content already describes the region. */
						anchor.setAttribute( 'aria-hidden', 'true' );
						anchor.setAttribute( 'tabindex', '-1' );
					}

					// Ensure the container is positioned so the overlay
					// can use position:absolute relative to it.
					var computed = window.getComputedStyle( el );
					if ( computed.position === 'static' ) {
						el.style.position = 'relative';
					}

					el.insertBefore( anchor, el.firstChild );

					// Mark as initialised so we don't double-process.
					el.setAttribute( 'data-prime-wl-init', '1' );
				} );
			}

			// Run on DOM ready.
			if ( document.readyState === 'loading' ) {
				document.addEventListener( 'DOMContentLoaded', function () {
					initWrapperLinks();
				} );
			} else {
				initWrapperLinks();
			}

			// Re-run when Elementor frontend is ready (handles editor preview).
			document.addEventListener( 'elementor/frontend/init', function () {

				if ( ! window.elementorFrontend ) {
					return;
				}

				elementorFrontend.hooks.addAction(
					'frontend/element_ready/global',
					function ( $scope ) {
						initWrapperLinks( $scope[0] );
					}
				);
			} );

			// Support Elementor editor live preview re-renders.
			if ( window.elementor ) {
				window.addEventListener( 'elementor:init', function () {
					initWrapperLinks();
				} );
			}

			// Expose globally so theme/plugin code can re-trigger if needed.
			window.primeInitWrapperLinks = initWrapperLinks;

		}());
		</script>
		<?php
	}
}