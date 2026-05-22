<?php

namespace PrimeElementorAddons\Widgets\PostTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostComment extends Widget_Base {

	public function get_name() {
		return 'pea_post_comment';
	}

	public function get_title() {
		return esc_html__( 'Post Comments', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_comment_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'post-comments', 'post', 'comments' , 'post comment', 'post comments'];
	}
    
    public function get_style_depends() {
        return ['prime-elementor-addons--post-comment'];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'demo_settings_section',
			[
				'label' => __('Demo Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_demo_comments',
			[
				'label' => __('Show Demo Comments', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'description' => __('Editor-only feature. Displays placeholder comments to help with layout styling. No effect on live site.', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'label_off' => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'single_blog_comments_area_settings',
			[
				'label' => __( 'Comment Area Settings ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,   
				
			]
		);
		
		$slug = 'single_blog_comment_area';
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .pea-single-post-comments-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper',
			]
		);

		$this->add_responsive_control(
			$slug.'_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				// 'default' => [
				// 	'top' => 6,
				// 	'right' => 6,
				// 	'bottom' => 6,
				// 	'left' => 6,
				// 	'unit' => 'px',
				// 	'isLinked' => true,
				// ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => $slug.'_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}}  .pea-single-post-comments-wrapper#comments',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'comment_area_title_section',
			[
				'label' => esc_html__( 'Comment Area Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
            'comment_area_title_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'start',
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
					'{{WRAPPER}} .pea-single-post-comments-wrapper .pea-heading-bor-bt' => 'justify-content: {{VALUE}}',
				]
            ]
        );
		$this->add_control(
			'comment_area_title_color',
			[
				'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-heading-bor-bt h5' => 'color: {{VALUE}}',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'comment_area_title_typography',
				'selector' => '{{WRAPPER}} .pea-heading-bor-bt h5',
				// 'fields_options' => [
				// 	'typography' => [
				// 		'default' => 'custom',
				// 	],
				// 	'font_family' => [
				// 		'default' => 'Work Sans',
				// 	],
				// 	'font_weight' => [
				// 		'default' => '500',
				// 	],
				// 	'font_size' => [
				// 		'default' => [
				// 			'unit' => 'px',
				// 			'size' => 16,
				// 		],
				// 	],
				// 	'line_height' => [
				// 		'default' => [
				// 			'unit' => '%',
				// 			'size' => 140,
				// 		],
				// 	],
				// ],
			]
		);

		$this->add_responsive_control(
			'comment_area_title_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-heading-bor-bt h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'comment_area_title_shadow',
				'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-heading-bor-bt h5 ',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_user_comment_styles',
			[
				'label' => esc_html__( 'User Comment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'post_user_comment_box';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'User Comment Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			$slug.'_user_name_color',
			[
				'label'     => __( 'User Name Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .pea-single-post-comments-wrapper b.fn a' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_date_color',
			[
				'label'     => __( 'Date Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .comment-metadata a' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .pea-single-post-comments-wrapper .comment-metadata span' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_review_text_color',
			[
				'label'     => __( 'Comment Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}   .pea-single-post-comments-wrapper .comment-content ' => 'color: {{VALUE}};', 
					'{{WRAPPER}}   .pea-single-post-comments-wrapper .comment-author.vcard .says' => 'color: {{VALUE}};', 
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $slug.'_review_text_typography',
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper .comment-content p, .pea-single-post-comments-wrapper .comment-author.vcard .says, {{WRAPPER}} .pea-single-post-comments-wrapper .comment-metadata a , {{WRAPPER}} .pea-single-post-comments-wrapper .comment-metadata span, {{WRAPPER}}  .pea-single-post-comments-wrapper b.fn a',
				// 'fields_options' => [
				// 	'typography' => [
				// 		'default' => 'custom',
				// 	],
				// 	'font_family' => [
				// 		'default' => 'Work Sans',
				// 	],
				// 	'font_weight' => [
				// 		'default' => '500',
				// 	],
				// 	'font_size' => [
				// 		'default' => [
				// 			'unit' => 'px',
				// 			'size' => 16,
				// 		],
				// 	],
				// 	'line_height' => [
				// 		'default' => [
				// 			'unit' => '%',
				// 			'size' => 140,
				// 		],
				// 	],
				// ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .comment-body',
			]
		);

		$this->add_responsive_control(
			$slug.'_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				// 'default' => [
				// 	'top' => 6,
				// 	'right' => 6,
				// 	'bottom' => 6,
				// 	'left' => 6,
				// 	'unit' => 'px',
				// 	'isLinked' => true,
				// ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .comment-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .comment-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => $slug.'_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}}  .pea-single-post-comments-wrapper.comments-area .comment-body',
			]
		);
		
		$slug = 'post_user_comment_img';

		$this->add_control(
			$slug.'_heading',
			[
				'label' => esc_html__( 'image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			$slug.'_img_size',
			[
				'label'           => __( 'Image Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px', '%' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 120,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => '',
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .comment-author.vcard img.avatar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper .comment-author.vcard img.avatar',
			]
		);

		$this->add_responsive_control(
			$slug.'_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				// 'default' => [
				// 	'top' => 6,
				// 	'right' => 6,
				// 	'bottom' => 6,
				// 	'left' => 6,
				// 	'unit' => 'px',
				// 	'isLinked' => true,
				// ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .comment-author.vcard img.avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .comment-author.vcard img.avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'User Comment Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
            'post_user_comment_button_align',
            [
                'label' => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'start',
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
					'{{WRAPPER}} .pea-single-post-comments-wrapper .comment-body .reply' => 'text-align: {{VALUE}}',
				]
            ]
        );
		
		$slug = 'post_user_comment_button';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a' => 'background-color: {{VALUE}}',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $slug.'_typography',
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a',
				// 'fields_options' => [
				// 	'typography' => [
				// 		'default' => 'custom',
				// 	],
				// 	'font_family' => [
				// 		'default' => 'Work Sans',
				// 	],
				// 	'font_weight' => [
				// 		'default' => '500',
				// 	],
				// 	'font_size' => [
				// 		'default' => [
				// 			'unit' => 'px',
				// 			'size' => 16,
				// 		],
				// 	],
				// 	'line_height' => [
				// 		'default' => [
				// 			'unit' => '%',
				// 			'size' => 140,
				// 		],
				// 	],
				// ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'post_author_box_border_type',
				'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a',
			]
		);

		$this->add_responsive_control(
			'post_author_box_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				// 'default' => [
				// 	'top' => 6,
				// 	'right' => 6,
				// 	'bottom' => 6,
				// 	'left' => 6,
				// 	'unit' => 'px',
				// 	'isLinked' => true,
				// ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area .reply a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();  // End Controls Section

		$this->start_controls_section(
			'post_comment_form_styles',
			[
				'label' => esc_html__( 'Comment Form', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		
		$slug = 'post_comment_form';
		
		$this->add_control(
			$slug.'_form_title_color',
			[
				'label'     => __( 'Form Title Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .pea-single-post-comments-wrapper #reply-title' => 'color: {{VALUE}};', 
				],
			]
		);
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => $slug.'_form_title_typography',
				'selector' => '{{WRAPPER}}  .pea-single-post-comments-wrapper #reply-title',
					// 'fields_options' => [
					// 	'typography' => [
					// 		'default' => 'custom',
					// 	],
					// 	'font_family' => [
					// 		'default' => 'Work Sans',
					// 	],
					// 	'font_weight' => [
					// 		'default' => '500',
					// 	],
					// 	'font_size' => [
					// 		'default' => [
					// 			'unit' => 'px',
					// 			'size' => 16,
					// 		],
					// 	],
					// 	'line_height' => [
					// 		'default' => [
					// 			'unit' => '%',
					// 			'size' => 140,
					// 		],
					// 	],
					// ],
				]
			);
		
		$this->add_control(
			$slug.'_label_color',
			[
				'label'     => __( 'Label Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper form p' => 'color: {{VALUE}};', 
					// '{{WRAPPER}} .pea-single-post-comments-wrapper .comment-metadata span' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_required_color',
			[
				'label'     => __( 'Required Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					// '{{WRAPPER}} .pea-single-post-comments-wrapper form p ' => 'color: {{VALUE}};', 
					'{{WRAPPER}}   .pea-single-post-comments-wrapper .required' => 'color: {{VALUE}};', 
				],
			]
		);
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => $slug.'_label_typography',
					'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper form p',
					// 'fields_options' => [
					// 	'typography' => [
					// 		'default' => 'custom',
					// 	],
					// 	'font_family' => [
					// 		'default' => 'Work Sans',
					// 	],
					// 	'font_weight' => [
					// 		'default' => '500',
					// 	],
					// 	'font_size' => [
					// 		'default' => [
					// 			'unit' => 'px',
					// 			'size' => 16,
					// 		],
					// 	],
					// 	'line_height' => [
					// 		'default' => [
					// 			'unit' => '%',
					// 			'size' => 140,
					// 		],
					// 	],
					// ],
				]
			);
		
		$this->add_control(
			$slug.'_textarea_color',
			[
				'label'     => __( 'Form Text Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper input[type="text"]' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .pea-single-post-comments-wrapper input[type="email"]' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .pea-single-post-comments-wrapper input[type="url"]' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .pea-single-post-comments-wrapper textarea' => 'color: {{VALUE}};', 
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .pea-single-post-comments-wrapper input[type="text"]' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .pea-single-post-comments-wrapper input[type="email"]' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .pea-single-post-comments-wrapper input[type="url"]' => 'background-color: {{VALUE}};', 
					'{{WRAPPER}}  .pea-single-post-comments-wrapper textarea' => 'background-color: {{VALUE}};', 
				],
			]
		);
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => $slug.'_textarea_typography',
					'selector' => '{{WRAPPER}}  .pea-single-post-comments-wrapper input[type="text"], {{WRAPPER}}  .pea-single-post-comments-wrapper input[type="email"], {{WRAPPER}}  .pea-single-post-comments-wrapper input[type="url"], {{WRAPPER}}  .pea-single-post-comments-wrapper textarea',
					// 'fields_options' => [
					// 	'typography' => [
					// 		'default' => 'custom',
					// 	],
					// 	'font_family' => [
					// 		'default' => 'Work Sans',
					// 	],
					// 	'font_weight' => [
					// 		'default' => '500',
					// 	],
					// 	'font_size' => [
					// 		'default' => [
					// 			'unit' => 'px',
					// 			'size' => 16,
					// 		],
					// 	],
					// 	'line_height' => [
					// 		'default' => [
					// 			'unit' => '%',
					// 			'size' => 140,
					// 		],
					// 	],
					// ],
				]
			);

		$this->add_responsive_control(
			$slug.'_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper input[type="url"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area input[type="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area input[type="url"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper.comments-area textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$slug.'_btn_heading',
			[
				'label' => esc_html__( 'Comment Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$slug = 'post_comment_form_button';
		
		$this->add_control(
			$slug.'_color',
			[
				'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"]' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_hover_color',
			[
				'label'     => __( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"]:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_color',
			[
				'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper  .form-submit input[type="button"]' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pea-single-post-comments-wrapper  .form-submit input[type="submit"]' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			$slug.'_bg_hover_color',
			[
				'label'     => __( 'Background Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper  .form-submit input[type="button"]:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pea-single-post-comments-wrapper  .form-submit input[type="submit"]:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => $slug.'_typography',
					'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"], {{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]',
					// 'fields_options' => [
					// 	'typography' => [
					// 		'default' => 'custom',
					// 	],
					// 	'font_family' => [
					// 		'default' => 'Work Sans',
					// 	],
					// 	'font_weight' => [
					// 		'default' => '500',
					// 	],
					// 	'font_size' => [
					// 		'default' => [
					// 			'unit' => 'px',
					// 			'size' => 16,
					// 		],
					// 	],
					// 	'line_height' => [
					// 		'default' => [
					// 			'unit' => '%',
					// 			'size' => 140,
					// 		],
					// 	],
					// ],
				]
			);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => $slug.'_border_type',
				'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"], {{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]',
			]
		);

		$this->add_responsive_control(
			$slug.'_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				// 'default' => [
				// 	'top' => 6,
				// 	'right' => 6,
				// 	'bottom' => 6,
				// 	'left' => 6,
				// 	'unit' => 'px',
				// 	'isLinked' => true,
				// ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_padding',
			[
				'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_margin',
			[
				'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="button"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-comments-wrapper .form-submit input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 

		$this->end_controls_section();  // End Controls Section
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( $settings['enable_demo_comments'] === 'yes' ) {
			$this->render_demo_comment_template();
			return;
		}

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

		$title = get_the_title($post);
		$comments_number = get_comments_number($post_id);
		// Get comments for the specific post
		$comments = get_comments(array('post_id' => $post_id));
		if (comments_open($post)) :
            if ( post_password_required($post) ) {
				return;
			}
		?>
		<div class="pea-single-post-comments-wrapper comments-area" id="comments">
				<?php
				// You can start editing here -- including this comment!
				if ( $comments_number > 0 ) : ?>
					<div class="pea-heading-bor-bt">
					<h5 class="comments-title">
						<?php
						if ( '1' === $comments_number ) {
							/* translators: %s: post title */
							printf( esc_html__( 'One thought on &ldquo;%s&rdquo;', 'unlimited-elementor-inner-sections-by-boomdevs' ), esc_html($title) );
						} else {
							printf(
								   esc_html(
									  /* translators: 1: number of comments, 2: post title */
									 _nx( 
										  '%1$s thought on &ldquo;%2$s&rdquo;',
										  '%1$s thoughts on &ldquo;%2$s&rdquo;',
										  $comments_number,
										  'comments title',
										  'unlimited-elementor-inner-sections-by-boomdevs'
									   )
								   ),
								   esc_html (number_format_i18n( $comments_number ) ),
								   esc_html($title)
							);
						}
						?>
					</h5>
					</div>
			
					<?php if ( $comments_number > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
						<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></h2>
						<div class="nav-links">
			
							<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
			
						</div><!-- .nav-links -->
					</nav><!-- #comment-nav-above -->
					<?php endif; // Check for comment navigation. ?>
			
					<ol class="comment-list">
						<?php
							wp_list_comments( array(
								'style'      => 'ol',
    							'type'  => 'all',
							), $comments );
						?>
					</ol><!-- .comment-list -->
			
					<?php if ( $comments_number > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
						<h5 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></h5>
						<div class="nav-links">
			
							<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
			
						</div><!-- .nav-links -->
					</nav><!-- #comment-nav-below -->
					<?php
			
				endif; // Check for comment navigation.
				endif; // Check for have_comments().
				
				if ( ! comments_open($post) && get_comments_number($post) && post_type_supports( get_post_type(), 'comments' ) ) : ?>
					<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></p>
				<?php
				endif;
				comment_form( array(), $post);
				?>
		</div><!-- #comments -->
    <?php endif;  
	}



	private function render_demo_comment_template() {
		?>
		<div class="pea-single-post-comments-wrapper comments-area" id="comments">

			<div class="pea-heading-bor-bt">
				<h5 class="comments-title">
					<?php esc_html_e('2 thoughts on “Demo Post Title”', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>
				</h5>
			</div>

			<ol class="comment-list">

				<li class="comment">
					<div class="comment-body">
						<div class="comment-author vcard">
							<img src="https://secure.gravatar.com/avatar/?d=mp" class="avatar" />
							<b class="fn"><a href="#">John Doe</a></b>
							<span class="says">says:</span>
						</div>

						<div class="comment-content">
							<p>This is a demo comment. You can style everything from Elementor.</p>
						</div>

						<div class="reply">
							<a href="#">Reply</a>
						</div>
					</div>
				</li>

				<li class="comment odd alt thread-odd thread-alt depth-1 parent">
					<div class="comment-body">
						<div class="comment-author vcard">
							<img src="https://secure.gravatar.com/avatar/?d=mp" class="avatar" />
							<b class="fn"><a href="#">Jane Smith</a></b>
							<span class="says">says:</span>
						</div>

						<div class="comment-content">
							<p>This is another demo comment for design preview.</p>
						</div>

						<div class="reply">
							<a href="#">Reply</a>
						</div>
					</div>
					<ol class="children">
						<li class="comment odd alt depth-2">
							<article class="comment-body">
								<footer class="comment-meta">
									<div class="comment-author vcard">
										<img alt="" src="https://secure.gravatar.com/avatar/?d=mp" srcset="https://secure.gravatar.com/avatar/?d=mp" class="avatar avatar-32 photo" height="32" width="32" decoding="async">						
										<b class="fn">
											<a href="https://www.google.com" class="url" rel="ugc external nofollow">Testing Name</a>
										</b> 
										<span class="says">says:</span>					
									</div>
									<div class="comment-metadata">
										<a href=""><time datetime="2026-04-21T12:35:32+00:00">April 21, 2026 at 12:35 pm</time></a>
									</div>
								</footer>

								<div class="comment-content">
									<p>This is a nested reply comment to show the structure.</p>
								</div>

								<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#" data-commentid="4" data-postid="364" data-belowelement="div-comment-4" data-respondelement="respond" data-replyto="Reply to Testing Name" aria-label="Reply to Testing Name">Reply</a></div>			
							</article>
						</li>
					</ol>
				</li>

			</ol>

			<div class="comment-respond">
				<h5 id="reply-title"><?php esc_html_e('Leave a Reply', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></h5>
				<form id="commentform" class="comment-form">
					<p class="comment-notes">
						<span id="email-notes">Your email address will not be published.</span> 
						<span class="required-field-message">
							Required fields are marked 
							<span class="required">*</span>
						</span>
					</p>
					<p class="comment-form-comment">
						<label for="comment">Comment <span class="required">*</span></label> 
						<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required=""></textarea>
					</p>
					<p class="comment-form-author">
						<label for="author">Name <span class="required">*</span></label> 
						<input id="author" name="author" type="text" value="" size="30" maxlength="245" autocomplete="name" required="">
					</p>
					<p class="comment-form-email">
						<label for="email">Email <span class="required">*</span></label>
						<input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" required="">
					</p>
					<p class="comment-form-url">
						<label for="url">Website</label> 
						<input id="url" name="url" type="url" value="" size="30" maxlength="200" autocomplete="url">
					</p>
					<p class="comment-form-cookies-consent">
						<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
						<label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label>
					</p>
					<p class="form-submit">
						<input name="submit" type="submit" id="submit" class="submit" value="Post Comment">
						<input type="hidden" name="comment_post_ID" value="364" id="comment_post_ID">
						<input type="hidden" name="comment_parent" id="comment_parent" value="0">
					</p>
				</form>
			</div>

		</div>
		<?php
	}
	
}