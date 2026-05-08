<?php

namespace PrimeElementorAddons\Widgets\ArchiveTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

class ArchiveDescription extends Widget_Base {

	public function get_name() {
		return 'pea_archive_description';
	}

	public function get_title() {
		return esc_html__( 'Archive Description', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_content_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return ['archive description', 'archive', 'description'];
	}

	protected function register_controls() {

		// =========================
		// Content Section
		// =========================
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		    $this->add_responsive_control(
                'archive_title_align',
                [
                    'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'left',
                    'label_block' => false,
                    'options' => [
                        'start'    => [
                            'title' => __( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-archive-description' => 'text-align: {{VALUE}}',
                    ],
                    'separator' => 'before'
                ]
            );

            // Date Description Mode
            $this->add_control(
                'date_description_mode',
                [
                    'label' => esc_html__( 'Date Archive Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'  => Controls_Manager::SELECT,
                    'options' => [
                        'none'   => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'auto'   => esc_html__( 'Auto Generated', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'custom' => esc_html__( 'Custom Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                    'default' => 'auto',
                ]
            );

            $this->add_control(
                'custom_date_description',
                [
                    'label' => esc_html__( 'Custom Date Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Posts published in this archive.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'condition' => [
                        'date_description_mode' => 'custom',
                    ],
                ]
            );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-archive-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .pea-archive-description',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .pea-archive-description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pea-archive-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get Archive Description
	 */
	private function get_archive_description( $settings ) {
        
		if ( ( (class_exists("\Elementor\Plugin") && Plugin::$instance->editor->is_edit_mode()) || (class_exists("\Elementor\Plugin") && Plugin::$instance->preview->is_preview_mode()) ) && ( get_post_type() == 'pea-site-builder' ) ) {

			$post_id = get_the_ID();

			$archive_type = Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_archive_select');

			if ($archive_type === 'category' || $archive_type === 'tag') {
				return esc_html__( 'This is a demo archive description.', 'unlimited-elementor-inner-sections-by-boomdevs' );
			}

			if ($archive_type === 'author') {
				return esc_html__( 'This is a demo author bio.', 'unlimited-elementor-inner-sections-by-boomdevs' );
			}

			if ($archive_type === 'date') {
				return $this->get_date_description($settings);
			}

			if ($archive_type === 'search') {
				return '';
			}
		}

		if (is_category() || is_tag()) {
			return term_description();
		}

		if (is_author()) {
			$user = get_user_by('id', get_queried_object_id());
			return $user ? get_the_author_meta('description', $user->ID) : '';
		}

		if (is_date()) {
			return $this->get_date_description($settings);
		}

		return '';
	}

	/**
	 * Handle Date Description
	 */
	private function get_date_description($settings) {

		if ($settings['date_description_mode'] === 'none') {
			return '';
		}

		if ($settings['date_description_mode'] === 'custom') {
			return $settings['custom_date_description'];
		}

		// Auto mode
		if (is_day()) {
			return 'Posts published on ' . get_the_date();
		}

		if (is_month()) {
			return 'Posts published in ' . get_the_date('F Y');
		}

		if (is_year()) {
			return 'Posts published in ' . get_the_date('Y');
		}

		return '';
	}

	protected function render() {

		$settings = $this->get_settings();

		$description = $this->get_archive_description($settings);

		if (empty($description)) {
			return;
		}

		echo '<div class="pea-archive-description">';
			echo wp_kses_post($description);
		echo '</div>';
	}
}