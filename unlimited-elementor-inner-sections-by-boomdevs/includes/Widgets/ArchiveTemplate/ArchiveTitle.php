<?php

namespace PrimeElementorAddons\Widgets\ArchiveTemplate;

use PrimeElementorAddons\Controls\GradientTextControl;
use PrimeElementorAddons\Controls\TextStrokeControl;
use PrimeElementorAddons\Utils\Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ArchiveTitle extends Widget_Base {
	
	public function get_name() {
		return 'pea_archive_title';
	}

	public function get_title() {
		return esc_html__( 'Archive Title', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_title_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return ['archive title', 'archive', 'archive title', 'title' ];
	}

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

        // General Section
		$this->start_controls_section(
			'section_archive_title',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'archive_title_css',
			[
				'label' => esc_html__('Archive Title hidden Css', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'display: flex;flex-wrap: wrap;justify-content: center;align-items: center;',
				'selectors' => [
					'{{WRAPPER}} .pea-team-member-content-wrapper' => '{{VALUE}};',
				],
				'condition' => [
					'content_position_in_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'archive_title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'P' => 'p'
				],
				'default' => 'h1',
			]
		);

		$this->add_control (
			'cat_archive_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Category Before Text Toggle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'cat_archive_title_before_text', [
				'label' => __( 'Category Before Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Category:' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' =>[
					'cat_archive_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_control (
			'tag_archive_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Tag Before Text Toggle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'tag_archive_title_before_text', [
				'label' => __( 'Tag Before Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Tag:' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' =>[
					'tag_archive_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_control (
			'author_archive_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Author Before Text Toggle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'author_archive_title_before_text', [
				'label' => __( 'Author Before Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Author:' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' =>[
					'author_archive_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_control (
			'date_archive_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Date Before Text Toggle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'date_archive_title_before_text', [
				'label' => __( 'Date Before Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Date:' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' =>[
					'date_archive_title_before_text_toggle' => 'yes', 
				],
			]
		);

		$this->add_control (
			'search_result_title_before_text_toggle',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Search Before Text Toggle', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'search_result_title_before_text', [
				'label' => __( 'Search Before Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Search Results for:' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_block' => true,
				'condition' =>[
					'search_result_title_before_text_toggle' => 'yes', 
				],
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
					'{{WRAPPER}} .pea-archive-title' => 'text-align: {{VALUE}}',
				],
				'separator' => 'before'
            ]
        );

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'archive_type_title_section',
			[
				'label' => esc_html__( 'Archive Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'cat_archive_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'tag_archive_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'author_archive_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'date_archive_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'search_result_title_before_text_toggle',
							'operator' => '===',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		GradientTextControl::add_control( $this, [
			'name'     => 'archive_type_title_color',
			'selector' => '{{WRAPPER}} .pea-archive-title span',
		]);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'archive_type_title_typography',
				'selector' => '{{WRAPPER}} .pea-archive-title span',
			]
		);

		$this->add_responsive_control(
			'archive_type_title_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-archive-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Controls Section

		$this->start_controls_section(
			'archive_title_section',
			[
				'label' => esc_html__( 'Archive Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		GradientTextControl::add_control( $this, [
			'name'     => 'archive_title_color',
			'selector' => '{{WRAPPER}} .pea-archive-title .archive-text',
		]);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'archive_title_typography',
				'selector' => '{{WRAPPER}} .pea-archive-title .archive-text',
			]
		);

		$this->add_responsive_control(
			'archive_title_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-archive-title .archive-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$cat_before_text_toggle = $settings['cat_archive_title_before_text_toggle'];
		$tag_before_text_toggle = $settings['tag_archive_title_before_text_toggle'];
		$author_before_text_toggle = $settings['author_archive_title_before_text_toggle'];
		$date_before_text_toggle = $settings['date_archive_title_before_text_toggle'];
		$search_before_text_toggle = $settings['search_result_title_before_text_toggle'];

		$cat_before_text = $settings['cat_archive_title_before_text'];
		$tag_before_text = $settings['tag_archive_title_before_text'];
		$author_before_text = $settings['author_archive_title_before_text'];
		$date_before_text = $settings['date_archive_title_before_text'];
		$search_before_text = $settings['search_result_title_before_text'];
		$archive_title = '';

		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || ( get_post_type() == 'pea-site-builder' ) ) {
			$post_id = get_the_ID();
        	$archive_type 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_archive_select');
			$cat_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_cat_archive_select');
			$tag_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_tag_archive_select');
			$author_archive = Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_author_archive_select');
			$date_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_date_year_archive_select');
			$search_result 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_search_result_archive_select');
			if($archive_type === 'category'){
				$archive_title = $cat_before_text_toggle === 'yes' ? '<span class="before-archive">'.$cat_before_text.'</span>'.'<span class="archive-text">'.$cat_archive.'</span>' : '<span class="archive-text">'.$cat_archive.'</span>';
			} else if($archive_type === 'tag'){
				$archive_title = $tag_before_text_toggle === 'yes' ? '<span class="before-archive">'.$tag_before_text.'</span>'.'<span class="archive-text">'.$tag_archive.'</span>' : '<span class="archive-text">'.$tag_archive.'</span>';
			} else if($archive_type === 'author'){
				$user = get_user_by('id', $author_archive);
				$archive_title = $author_before_text_toggle === 'yes' ? '<span class="before-archive">'.$author_before_text.'</span>'.'<span class="archive-text">'.$user->display_name.'</span>' : '<span class="archive-text">'.$user->display_name.'</span>';
			} else if($archive_type === 'date'){
				$archive_title = $date_before_text_toggle === 'yes' ? '<span class="before-archive">'.$date_before_text.'</span>'.'<span class="archive-text">'.$date_archive.'</span>' : '<span class="archive-text">'.$date_archive.'</span>';
			} else if($archive_type === 'search'){
				$archive_title = $search_before_text_toggle === 'yes' ? '<span class="before-archive">'.$search_before_text.'</span>'.'<span class="archive-text">'.$search_result.'</span>' : '<span class="archive-text">'.$search_result.'</span>';
			}
           
        }else{
			if (is_category()) {
				$category = get_category(get_queried_object_id());
				if ($category) {
					$category_name = $category->name;
					$archive_title = $cat_before_text_toggle === 'yes' ? '<span class="before-archive">'.$cat_before_text.'</span>'.'<span class="archive-text">'.$category_name.'</span>' : '<span class="archive-text">'.$category_name.'</span>';
				}
			} else if (is_tag()) {
				$tag = get_term_by('id', get_queried_object_id(), 'post_tag');
				if ($tag) {
					$tag_name = $tag->name;
					$archive_title = $tag_before_text_toggle === 'yes' ? '<span class="before-archive">'.$tag_before_text.'</span>'.'<span class="archive-text">'.$tag_name.'</span>' : '<span class="archive-text">'.$tag_name.'</span>';
				}
			} else if (is_author()) {
				$user = get_user_by('id', get_queried_object_id());
				if ($user) {
					$display_name = $user->display_name;
					$archive_title = $author_before_text_toggle === 'yes' ? '<span class="before-archive">'.$author_before_text.'</span>'.'<span class="archive-text">'.$display_name.'</span>' : '<span class="archive-text">'.$display_name.'</span>';
				}
			} elseif (is_date()) {
				$date = '';
				if($author_before_text_toggle === 'yes'){
					$date = '<span class="before-archive">'.$author_before_text.'</span>'.'<span class="archive-text">';
				}else{
					$date = '<span class="archive-text">';
				}
				if(!empty(get_query_var('m'))) {
					// Handle query var 'm' for other permalink structures
					$m = get_query_var('m');
					if (!empty($m)) {
						$date .= substr($m, 0, 4);
						if (strlen($m) > 4) {
							$date .= '/'.substr($m, 4, 2);
						}
						if (strlen($m) > 6) {
							$date .= '/'.substr($m, 6, 2);
						}
					}
				} elseif (is_day()) {
					$date .= get_query_var('year');
					$date .= '/'.get_query_var('monthnum');
					$date .= '/'.get_query_var('day');
				} elseif (is_month()) {
					$date .= get_query_var('year');
					$date .= '/'.get_query_var('monthnum');
				} elseif (is_year()) {
					$date .= get_query_var('year');
				}
				$date .= '<span>';
				$archive_title = $date;
			}   else if (is_search()) {
				$search_query = get_search_query(); // Get the search query
				$archive_title = $search_before_text_toggle === 'yes' ? '<span class="before-archive">'.$search_before_text.'</span>'.'<span class="archive-text">'.$search_query.'</span>' : '<span class="archive-text">'.$search_query.'</span>';
			} 
		}

		echo '<'. esc_attr($settings['archive_title_tag']) .' class="pea-archive-title">';
			echo wp_kses_post($archive_title);
		echo '</'. esc_attr($settings['archive_title_tag']) .'>';
	}
	
}