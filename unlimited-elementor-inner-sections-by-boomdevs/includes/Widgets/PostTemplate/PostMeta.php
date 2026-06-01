<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostMeta extends Widget_Base {

	public function get_name() {
		return 'pea_post_meta';
	}

	public function get_title() {
		return esc_html__( 'Post Meta', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_meta_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'post-meta', 'post', 'meta' ];
	}
    
    public function get_style_depends() {
        return ['prime-elementor-addons--post-meta'];
    }

	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
		
        // General Section
		$this->start_controls_section(
			'section_post_meta',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_post_meta',
			[
				'label' => esc_html__('Choose Meta', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => 'sortable_multiselect',
				'placeholder' => esc_html__('Select and Reorder Meta type', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'options' => [
					'author'       => esc_html__( 'Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'date'       => esc_html__( 'Date', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'time'       => esc_html__( 'Time', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'comment'       => esc_html__( 'Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'read-time'       => esc_html__( 'Reading Time', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'default' => ['author', 'date', 'time', 'comment', 'read-time'],
				'label_block'        => true,
			]
		);

		$this->add_responsive_control(
            'post_meta_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
					'{{WRAPPER}} .pea-single-post-meta-wrapper .pea-single-post-meta' => 'justify-content: {{VALUE}}',
				],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_author',
			[
				'label' => esc_html__( 'Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'select_post_meta' => 'author'
				],
			]
		);

			$this->add_control(
				'by_author',
				[
					'label' => esc_html__( 'Show "By" Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'avatar_type',
				[
					'label'       => esc_html__( 'Avatar Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'img',
					'options'     => [
						'img'      => esc_html__( 'Image (Gravatar)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon'    => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'none'       => esc_html__( 'None', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

			$this->add_control(
				'author_icon',
				[
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-user-alt',
						'library' => 'fa-solid',
					],
					'condition' => [
						'select_post_meta' => 'author',
						'avatar_type' => 'icon'
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_post_date_n_time',
			[
				'label' => esc_html__( 'Date & Time', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name'     => 'select_post_meta',
							'operator' => 'contains',
							'value'    => 'date',
						],
						[
							'name'     => 'select_post_meta',
							'operator' => 'contains',
							'value'    => 'time',
						],
					],
				],
			]
		);

			$this->add_control(
				'show_date_icon',
				[
					'label' => esc_html__( 'Show Date Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'select_post_meta' => 'date',
					],
				]
			);

			$this->add_control(
				'date_icon',
				[
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-calendar',
						'library' => 'regular',
					],
					'condition' => [
						'select_post_meta' => 'date',
						'show_date_icon' => 'yes'
					],
				]
			);

			$this->add_control(
				'date_format',
				[
					'label'       => esc_html__( 'Date Format', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'default',
					'options'     => [
						'default'       => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'wordpress'       => esc_html__( 'Wordpress', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'custom'       => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
					'condition' => [
						'select_post_meta' => 'date'
					],
				]
			);

			$this->add_control(
				'custom_date_format',
				[
					'label' => __( 'Custom Format', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => 'Y-m-d',
					'default' => 'M j, Y',
					'condition' => [
						'date_format' => 'custom',
						'select_post_meta' => 'date'
					],
				]
			);

        	$this->add_control('date_n_time_hr', ['type' => Controls_Manager::DIVIDER,]);

			$this->add_control(
				'show_time_icon',
				[
					'label' => esc_html__( 'Show Time Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'select_post_meta' => 'time'
					],
				]
			);

			$this->add_control(
				'time_icon',
				[
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-clock',
						'library' => 'regular',
					],
					'condition' => [
						'select_post_meta' => 'time',
						'show_time_icon' => 'yes'
					],
				]
			);

			$this->add_control(
				'time_format',
				[
					'label'       => esc_html__( 'Time Format', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => 'g:i a',
					'options'     => [
						'g:i a'       	=> esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'H:i'       	=> esc_html__( 'Format 2 ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'@ G:i'       	=> esc_html__( 'Format 3 ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'h:i:s A'       => esc_html__( 'Format 4 ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'G:i:s'       	=> esc_html__( 'Format 5 ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'g:i:s a'       => esc_html__( 'Format 6 ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
					'condition' => [
						'select_post_meta' => 'time'
					],
					
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_comments',
			[
				'label' => esc_html__( 'Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'select_post_meta' => 'comment'
				],
			]
		);

			$this->add_control(
				'show_comment_icon',
				[
					'label' => esc_html__( 'Show Comment Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' => [
						'select_post_meta' => 'comment'
					],
				]
			);

			$this->add_control(
				'comment_icon',
				[
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-comments',
						'library' => 'regular',
					],
					'condition' => [
						'select_post_meta' => 'comment',
						'show_comment_icon' => 'yes'
					],
				]
			);
			$this->add_control(
				'no_comments_title',
				[
					'label'     => __( 'No Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::TEXT,
					'placeholder'   => __( 'No Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'default'   => __( 'No Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'condition' => [
						'select_post_meta' => 'comment'
					],
				]
			);
			$this->add_control(
				'one_comment_title',
				[
					'label'     => __( 'One Comment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::TEXT,
					'placeholder'   => __( 'Comment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'default'   => __( 'Comment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'condition' => [
						'select_post_meta' => 'comment'
					],
				]
			);
			$this->add_control(
				'multi_comments_title',
				[
					'label'     => __( 'Multi Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::TEXT,
					'placeholder'   => __( 'Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'default'   => __( 'Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'condition' => [
						'select_post_meta' => 'comment'
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_read_time',
			[
				'label' => esc_html__( 'Reading Time', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'select_post_meta' => 'read-time',
				],
			]
		);

			$this->add_control(
				'show_read_time_icon',
				[
					'label'        => esc_html__( 'Show Read Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'label_off'    => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'read_time_icon',
				[
					'type'  => Controls_Manager::ICONS,
					'default' => [
						'value'   => 'fab fa-readme',
						'library' => 'fa-brand',
					],
					'condition' => [
						'show_read_time_icon' => 'yes',
					],
				]
			);

			$this->add_control(
				'before_read_time',
				[
					'label'       => esc_html__( 'Before Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'About', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'default'     => '',
				]
			);

			$this->add_control(
				'reading_speed',
				[
					'label'       => esc_html__( 'Reading Speed (WPM)', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 200,
					'min'         => 50,
					'max'         => 1000,
					'step'        => 10,
					'description' => esc_html__( 'Average reading speed in words per minute.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);

			$this->add_control(
				'read_time_singular_label',
				[
					'label'       => esc_html__( 'Singular Label', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'Minute Read', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);

			$this->add_control(
				'read_time_plural_label',
				[
					'label'       => esc_html__( 'Plural Label', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => esc_html__( 'Minutes Read', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				]
			);

		$this->end_controls_section();


		// Author Image Styling Section
		$this->start_controls_section(
			'post_meta_author_img_styling',
			[
				'label' => __( 'Author Image ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				'condition' => [
					'select_post_meta' => 'author'
				],
			]
		);

			$this->add_responsive_control(
				'post_meta_author_img_size',
				[
					'label' => esc_html__( 'Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SLIDER,

					'size_units'      => [ 'px', '%' ],
					'default' => [
						'size' => 25,
						'unit' => 'px',
					],
					'range'           => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} a.pea-post-meta-author-pic img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'post_meta_author_img_border_type',
					'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} a.pea-post-meta-author-pic img',
				]
			);

			$this->add_control(
				'post_meta_author_img_border_hover_color',
				[
					'label' => esc_html__( 'Border Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} a.pea-post-meta-author-pic img:hover' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'post_meta_author_img_border_type_border!' => ['', 'none']
					]
				]
			);

			$this->add_responsive_control(
				'post_meta_author_img_border_radius',
				[
					'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 30,
                        'right' => 30,
                        'bottom' => 30,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
					'selectors' => [
						'{{WRAPPER}} a.pea-post-meta-author-pic img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_meta_author_img_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}}  a.pea-post-meta-author-pic img'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_metas_styling',
			[
				'label' => __( 'Metas Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'post_metas_typography',
					'selector' => '{{WRAPPER}} .pea-single-post-meta span',
					'fields_options' => [
						'typography' => [
							'default' => 'custom',
						],
						'font_family' => [
							'default' => 'Work Sans',
						],
						'font_weight' => [
							'default' => '500',
						],
						'font_size' => [
							'default' => [
								'unit' => 'px',
								'size' => 16,
							],
						],
						'line_height' => [
							'default' => [
								'unit' => '%',
								'size' => 140,
							],
						],
					],
				]
			);
			$this->add_control(
				'post_metas_color',
				[
					'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta span a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .pea-single-post-meta span' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'post_metas_color_hover',
				[
					'label' => esc_html__( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta span a:hover' => 'color: {{VALUE}};',
						'{{WRAPPER}} .pea-single-post-meta span:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_metas_icon_spacing',
				[
					'label' => esc_html__( 'Icon Spacing', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SLIDER,
					'size_units'      => [ 'px', 'rem', '%' ],
					'range'           => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
						'rem' => [
							'min' => 1,
							'max' => 50,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'size' => 10,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta span' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'post_metas_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta span i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .pea-single-post-meta span svg' => 'fill: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'post_metas_icon_hover_color',
				[
					'label' => esc_html__( 'Hover Icon Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta span:hover i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .pea-single-post-meta span:hover svg' => 'fill: {{VALUE}};',
					],
				]
			); 

			$this->add_responsive_control(
				'post_meta_spacing',
				[
					'label' => esc_html__( 'Meta Spacing', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::SLIDER,
					'size_units'      => [ 'px', 'rem', '%' ],
					'range'           => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
						'rem' => [
							'min' => 1,
							'max' => 50,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'size' => 20,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_metas_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || ( get_post_type() == 'pea-site-builder' ) ) {
			$post_id = get_the_ID();
        	$post_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_post_id');
            $post = get_post( $post_id );
            if ( ! $post ) {
                return;
            }
        }else{
            $post_id = get_the_ID();
            $post = get_post($post_id);
            if ( ! $post ) {
                return;
            }
		} 
		
		// Get the date archive URL
		$date_url = get_day_link(
			get_the_date('Y', $post_id),
			get_the_date('m', $post_id),
			get_the_date('d', $post_id)
		);
		
		$date_format = $settings['date_format'];
		$time_format = $settings['time_format'];
		$author_by	 = $settings['by_author'] === 'yes' ? 'By' : '';
		$author_id   = $post->post_author;
		$author_name = get_the_author_meta('display_name', $author_id);

		if ( empty( $settings['select_post_meta'] ) || ! is_array( $settings['select_post_meta'] ) ) {
			return;
		}

		?>
		
		<div class="pea-single-post-meta-wrapper">
			<div class="pea-single-post-meta">
			<?php foreach ($settings['select_post_meta'] as $meta) {
					switch ($meta) {
						case 'author':
							?>
							<span class="pea-post-meta-item pea-post-meta-author">
								<?php if ( 'none' !== $settings['avatar_type'] ) : ?>
									<a class="pea-post-meta-author-pic" 
										href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" 
   										aria-label="<?php echo esc_attr( sprintf( __('Posts by %s'), $author_name ) ); ?>">
										<?php if ( 'img' === $settings['avatar_type'] ) : ?>
											<?php echo get_avatar( $author_id, 150 ); ?>
										<?php elseif ( 'icon' === $settings['avatar_type'] ) : ?>
											<span class="pea-post-meta-icon">
												<?php
												\Elementor\Icons_Manager::render_icon(
													$settings['author_icon'],
													[ 'aria-hidden' => 'true' ]
												);
												?>
											</span>
										<?php endif; ?>
									</a>
								<?php endif; ?>
								<a class="pea-post-meta-author-text" 
									href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" 
									aria-label="<?php echo esc_attr( sprintf( __('Posts by %s'), $author_name ) ); ?>">
									<?php echo esc_html($author_by); ?> <?php echo esc_html($author_name); ?>
								</a>
							</span>
							<?php
						break;
		
						case 'date':
							$date_output = '';

							if ($date_format === 'default') {
								$date_output = get_the_date('M j, Y', $post_id);
							} elseif ($date_format === 'wordpress') {
								$date_output = get_the_date('', $post_id);
							} elseif ($date_format === 'custom' && !empty($settings['custom_date_format'])) {
								$date_output = get_the_date($settings['custom_date_format'], $post_id);
							}
							if ( empty( $date_output ) ) {
								break;
							}	
							?>
							<span class="pea-post-meta-item pea-post-meta-date">
								<?php if ( 'yes' === $settings['show_date_icon'] ) {
									\Elementor\Icons_Manager::render_icon(
										$settings['date_icon'],
										[ 'aria-hidden' => 'true' ]
									);
								} ?>
								<a href="<?php echo esc_url($date_url); ?>">
									<?php echo esc_html($date_output); ?>
								</a>
							</span>
							<?php
						break;
		
						case 'time':
							?>
							<span class="pea-post-meta-item pea-post-meta-time">
								<?php if ( 'yes' === $settings['show_time_icon'] ) {
									\Elementor\Icons_Manager::render_icon(
										$settings['time_icon'],
										[ 'aria-hidden' => 'true' ]
									);
								} ?>
								<a href="<?php echo esc_url($date_url); ?>">
            						<?php echo esc_html(get_the_time($time_format, $post_id)); ?>
								</a>
							</span>
							<?php
						break;
		
						case 'comment':
							$comment_count = get_comments_number($post);

							if ( 0 === $comment_count ) {
								$comment_label = $settings['no_comments_title'];
							} elseif ( 1 === $comment_count ) {
								$comment_label = $settings['one_comment_title'];
							} else {
								$comment_label = $settings['multi_comments_title'];
							}
							?>
							<span class="pea-post-meta-item pea-post-meta-comment">
								<?php if ( 'yes' === $settings['show_comment_icon'] ) {
									\Elementor\Icons_Manager::render_icon(
										$settings['comment_icon'],
										[ 'aria-hidden' => 'true' ]
									);
								} ?>
								<a href="<?php echo esc_url( get_permalink( $post_id ) . '#comments' ); ?>">
									<?php echo esc_html( $comment_count . ' ' . $comment_label ); ?>
								</a>
							</span>
							<?php
						break;

						case 'read-time':
							$content = get_post_field( 'post_content', $post_id );

							$content = wp_strip_all_tags( $content );
							$content = strip_shortcodes( $content );
							$word_count = $content ? count( preg_split( '/\s+/', trim($content) ) ) : 0;

							$reading_speed = ! empty( $settings['reading_speed'] )
								? (int) $settings['reading_speed']
								: 200;

							$read_time = max( 1, ceil( $word_count / $reading_speed ) );

							$before_text = ! empty( $settings['before_read_time'] )
								? $settings['before_read_time'] . ' '
								: '';

							$read_time_label = ( $read_time <= 1 )
								? $settings['read_time_singular_label']
								: $settings['read_time_plural_label'];

							?>
							
							<span class="pea-post-meta-item pea-post-meta-read-time">

								<?php if ( 'yes' === $settings['show_read_time_icon'] ) : ?>
									
									<span class="pea-post-meta-icon">
										<?php \Elementor\Icons_Manager::render_icon(
											$settings['read_time_icon'],
											[ 'aria-hidden' => 'true' ]
										); ?>
									</span>

								<?php endif; ?>

								<span class="pea-post-meta-text">
									<?php
									echo esc_html(
										$before_text .
										$read_time . ' ' .
										$read_time_label
									);
									?>
								</span>

							</span>

							<?php

						break;
		
						default:
						break;
					}
				} ?>
			</div>
		</div>			
	<?php }
}