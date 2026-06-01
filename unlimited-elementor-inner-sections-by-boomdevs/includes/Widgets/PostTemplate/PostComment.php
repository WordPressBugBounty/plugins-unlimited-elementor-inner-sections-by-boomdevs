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
			'section_comments_general',
			[
				'label' => esc_html__( 'General', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// $this->add_control(
		// 	'enable_demo_comments',
		// 	[
		// 		'label' => __('Show Demo Comments', 'unlimited-elementor-inner-sections-by-boomdevs'),
		// 		'description' => __('Editor-only feature. Displays placeholder comments to help with layout styling. No effect on live site.', 'unlimited-elementor-inner-sections-by-boomdevs'),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'label_on' => __('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
		// 		'label_off' => __('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
		// 		'return_value' => 'yes',
		// 		'default' => 'no',
		// 	]
		// );

		$this->add_control(
			'show_comment_form_title',
			[
				'label' => esc_html__( 'Show Section Title', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_comment_count',
			[
				'label' => esc_html__( 'Show Comment Count', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'show_comment_form_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'comments_text_1',
			[
				'label' => esc_html__( 'One Comment', 'wpr-addons' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Comment',
				'condition' => [
					'show_comment_form_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'comments_text_2',
			[
				'label' => esc_html__( 'Multiple Comments', 'wpr-addons' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Comments',
				'condition' => [
					'show_comment_form_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'comments_avatar',
			[
				'label' => esc_html__( 'Show Avatar', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_comment_form',
			[
				'label' => esc_html__( 'Comment Form', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'comment_form_title',
			[
				'label' => esc_html__( 'Section Title', 'wpr-addons' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Leave a Reply',
			]
		);

		$this->add_control(
			'comment_form_labels',
			[
				'label' => esc_html__( 'Show Labels', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'comment_form_input_placeholders',
			[
				'label' => esc_html__( 'Show Placeholders', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'comment_form_cookie_check',
			[
				'label' => esc_html__( 'Show Wp Cookie Check Field', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'comment_form_website',
			[
				'label' => esc_html__( 'Show Website Field', 'wpr-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'comment_form_submit_text',
			[
				'label' => esc_html__( 'Submit Button Text', 'wpr-addons' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Submit',
				'separator' => 'before',
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

		if (
			( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||
			( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) ||
			( get_post_type() == 'pea-site-builder' )
		) {
			$post_id = get_the_ID();
			$post_id = \Elementor\Plugin::$instance->documents->get( $post_id, false )->get_settings( 'pea_demo_post_id' );
			$post    = get_post( $post_id );
			if ( ! $post ) return;
		} else {
			$post_id = get_the_ID();
			$post    = get_post( $post_id );
			if ( ! $post ) return;
		}

		if ( ! comments_open( $post ) ) return;
		if ( post_password_required( $post ) ) return;

		$title        = get_the_title( $post );
		$actual_count = get_comments_number( $post_id );
		$show_count   = $settings['show_comment_count'] === 'yes';
		$show_title   = $settings['show_comment_form_title'] === 'yes';
		$comments     = get_comments( array( 'post_id' => $post_id ) );
		$label_single = ! empty( $settings['comments_text_1'] ) ? esc_html( $settings['comments_text_1'] ) : 'Comment';
		$label_plural = ! empty( $settings['comments_text_2'] ) ? esc_html( $settings['comments_text_2'] ) : 'Comments';

		?>
		<div class="pea-single-post-comments-wrapper comments-area" id="comments">

			<?php
			// ── Comment area title ─────────────────────────────────────────────────
			if ( $show_title ) :
				if ( $actual_count > 0 ) : ?>
					<div class="pea-heading-bor-bt">
						<h5 class="comments-title">
							<?php
							if ( $show_count ) {
								if ( 1 === (int) $actual_count ) {
									printf( '1 %s on &ldquo;%s&rdquo;', $label_single, esc_html( $title ) );
								} else {
									printf( '%s %s on &ldquo;%s&rdquo;', esc_html( number_format_i18n( $actual_count ) ), $label_plural, esc_html( $title ) );
								}
							} else {
								if ( 1 === (int) $actual_count ) {
									printf( '%s on &ldquo;%s&rdquo;', $label_single, esc_html( $title ) );
								} else {
									printf( '%s on &ldquo;%s&rdquo;', $label_plural, esc_html( $title ) );
								}
							}
							?>
						</h5>
					</div>
				<?php else : ?>
					<div class="pea-heading-bor-bt">
						<h5 class="comments-title">
							<?php esc_html_e( 'No Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
						</h5>
					</div>
				<?php endif;
			endif;

			// ── Pagination above ───────────────────────────────────────────────────
			if ( $actual_count > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></h2>
					<div class="nav-links">
						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
					</div>
				</nav>
			<?php endif;

			// ── Comment list ───────────────────────────────────────────────────────
			if ( $actual_count > 0 ) : ?>
				<ol class="comment-list">
					<?php
					wp_list_comments( array(
						'style'       => 'ol',
						'type'        => 'all',
						'avatar_size' => ( $settings['comments_avatar'] === 'yes' ) ? 60 : 0,
					), $comments );
					?>
				</ol>
			<?php endif;

			// ── Pagination below ───────────────────────────────────────────────────
			if ( $actual_count > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
					<h5 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></h5>
					<div class="nav-links">
						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'unlimited-elementor-inner-sections-by-boomdevs' ) ); ?></div>
					</div>
				</nav>
			<?php endif;

			if ( ! comments_open( $post ) && get_comments_number( $post ) && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?></p>
			<?php endif;

			// ── Comment form fields filter (author / email / url) ──────────────────
			add_filter( 'comment_form_default_fields', function( $fields ) use ( $settings ) {

				$show_labels       = $settings['comment_form_labels'] === 'yes';
				$show_placeholders = $settings['comment_form_input_placeholders'] === 'yes';
				$req               = get_option( 'require_name_email' );

				$author_label = $show_labels
					? '<label for="author">' . esc_html__( 'Name', 'unlimited-elementor-inner-sections-by-boomdevs' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>'
					: '';
				$email_label  = $show_labels
					? '<label for="email">' . esc_html__( 'Email', 'unlimited-elementor-inner-sections-by-boomdevs' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>'
					: '';
				$url_label    = $show_labels
					? '<label for="url">' . esc_html__( 'Website', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</label>'
					: '';

				$author_ph = $show_placeholders ? esc_attr__( 'Your Name',    'unlimited-elementor-inner-sections-by-boomdevs' ) : '';
				$email_ph  = $show_placeholders ? esc_attr__( 'Your Email',   'unlimited-elementor-inner-sections-by-boomdevs' ) : '';
				$url_ph    = $show_placeholders ? esc_attr__( 'Website URL',  'unlimited-elementor-inner-sections-by-boomdevs' ) : '';

				$fields['author'] = '<p class="comment-form-author">'
					. $author_label
					. '<input id="author" name="author" type="text" placeholder="' . $author_ph . '" size="30"' . ( $req ? ' required' : '' ) . ' /></p>';

				$fields['email'] = '<p class="comment-form-email">'
					. $email_label
					. '<input id="email" name="email" type="email" placeholder="' . $email_ph . '" size="30"' . ( $req ? ' required' : '' ) . ' /></p>';

				// Website field
				if ( $settings['comment_form_website'] === 'yes' ) {
					$fields['url'] = '<p class="comment-form-url">'
						. $url_label
						. '<input id="url" name="url" type="url" placeholder="' . $url_ph . '" size="30" /></p>';
				} else {
					unset( $fields['url'] );
				}

				// Cookie / save-info checkbox
				if ( $settings['comment_form_cookie_check'] !== 'yes' ) {
					unset( $fields['cookies'] );
				}

				return $fields;
			} );

			// ── Comment form defaults filter (textarea + title + submit) ───────────
			add_filter( 'comment_form_defaults', function( $defaults ) use ( $settings ) {

				$show_title   = $settings['show_comment_form_title'] === 'yes';
				$show_labels       = $settings['comment_form_labels'] === 'yes';
				$show_placeholders = $settings['comment_form_input_placeholders'] === 'yes';
				$req               = get_option( 'require_name_email' );

				// Comment textarea label
				$comment_label = $show_labels
					? '<label for="comment">' . esc_html__( 'Comment', 'unlimited-elementor-inner-sections-by-boomdevs' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>'
					: '';
				$comment_ph = $show_placeholders ? esc_attr__( 'Write your comment...', 'unlimited-elementor-inner-sections-by-boomdevs' ) : '';

				$defaults['comment_field'] = '<p class="comment-form-comment">'
					. $comment_label
					. '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . $comment_ph . '" required></textarea>'
					. '</p>';

				// Form title
				$defaults['title_reply']    = ! empty( $settings['comment_form_title'] )
					? esc_html( $settings['comment_form_title'] )
					: esc_html__( 'Leave a Reply', 'unlimited-elementor-inner-sections-by-boomdevs' );
				$defaults['title_reply_to'] = esc_html__( 'Leave a Reply to %s', 'unlimited-elementor-inner-sections-by-boomdevs' );

				// Submit button
				$defaults['label_submit'] = ! empty( $settings['comment_form_submit_text'] )
					? esc_html( $settings['comment_form_submit_text'] )
					: esc_html__( 'Submit', 'unlimited-elementor-inner-sections-by-boomdevs' );

				return $defaults;
			} );

			comment_form( [], $post );
			?>

		</div><!-- #comments -->
		<?php
	}

	protected function content_template() {
		?>
		<div class="pea-single-post-comments-wrapper comments-area" id="comments">

			<# if ( settings.show_comment_form_title === 'yes' ) { #>
				<div class="pea-heading-bor-bt">
					<h5 class="comments-title">

						<# if ( settings.show_comment_count === 'yes' ) { #>
							2
						<# } #>

						<# if ( settings.show_comment_count === 'yes' && settings.comments_text_2 ) { #>
							{{ settings.comments_text_2 }}
						<# } else { #>
							Comments
						<# } #>

					</h5>
				</div>
			<# } #>

			<ol class="comment-list">

				<li class="comment">
					<div class="comment-body">
						<footer class="comment-meta">

							<div class="comment-author vcard">

								<# if ( settings.comments_avatar === 'yes' ) { #>
									<img src="https://secure.gravatar.com/avatar/?d=mp" class="avatar" />
								<# } #>

								<b class="fn">
									<a href="#">John Doe</a>
								</b>

								<span class="says">says:</span>

							</div>

							<div class="comment-metadata">
								<a href="#">
									<time datetime="2026-05-26T08:24:23+00:00">
										May 26, 2026 at 8:24 am
									</time>
								</a>
							</div>

						</footer>

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

						<footer class="comment-meta">

							<div class="comment-author vcard">

								<# if ( settings.comments_avatar === 'yes' ) { #>
									<img src="https://secure.gravatar.com/avatar/?d=mp" class="avatar" />
								<# } #>

								<b class="fn">
									<a href="#">Jane Smith</a>
								</b>

								<span class="says">says:</span>

							</div>

							<div class="comment-metadata">
								<a href="#">
									<time datetime="2026-05-26T08:24:23+00:00">
										May 26, 2026 at 8:24 am
									</time>
								</a>
							</div>

						</footer>

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

										<# if ( settings.comments_avatar === 'yes' ) { #>
											<img src="https://secure.gravatar.com/avatar/?d=mp" class="avatar avatar-32 photo" />
										<# } #>

										<b class="fn">
											<a href="#" class="url">Testing Name</a>
										</b>

										<span class="says">says:</span>

									</div>

									<div class="comment-metadata">
										<a href="#">
											<time datetime="2026-04-21T12:35:32+00:00">
												April 21 at 12:35 pm
											</time>
										</a>
									</div>

								</footer>

								<div class="comment-content">
									<p>This is a nested reply comment to show the structure.</p>
								</div>

								<div class="reply">
									<a href="#" class="comment-reply-link">Reply</a>
								</div>

							</article>

						</li>

					</ol>

				</li>

			</ol>

			<div class="comment-respond">

				<# if ( settings.comment_form_title !== '' ) { #>
					<h5 id="reply-title">
						{{ settings.comment_form_title || 'Leave a Reply' }}
					</h5>
				<# } #>

				<form id="commentform" class="comment-form">

					<p class="comment-notes">
						<span id="email-notes">
							Your email address will not be published.
						</span>

						<span class="required-field-message">
							Required fields are marked
							<span class="required">*</span>
						</span>
					</p>

					<p class="comment-form-comment">

						<# if ( settings.comment_form_labels === 'yes' ) { #>
							<label for="comment">
								Comment <span class="required">*</span>
							</label>
						<# } #>

						<textarea
							id="comment"
							name="comment"
							cols="45"
							rows="8"

							<# if ( settings.comment_form_input_placeholders === 'yes' ) { #>
								placeholder="Write your comment..."
							<# } #>

						></textarea>

					</p>

					<p class="comment-form-author">

						<# if ( settings.comment_form_labels === 'yes' ) { #>
							<label for="author">
								Name <span class="required">*</span>
							</label>
						<# } #>

						<input
							id="author"
							name="author"
							type="text"

							<# if ( settings.comment_form_input_placeholders === 'yes' ) { #>
								placeholder="Your Name"
							<# } #>
						>

					</p>

					<p class="comment-form-email">

						<# if ( settings.comment_form_labels === 'yes' ) { #>
							<label for="email">
								Email <span class="required">*</span>
							</label>
						<# } #>

						<input
							id="email"
							name="email"
							type="email"

							<# if ( settings.comment_form_input_placeholders === 'yes' ) { #>
								placeholder="Your Email"
							<# } #>
						>

					</p>

					<# if ( settings.comment_form_website === 'yes' ) { #>

						<p class="comment-form-url">

							<# if ( settings.comment_form_labels === 'yes' ) { #>
								<label for="url">Website</label>
							<# } #>

							<input
								id="url"
								name="url"
								type="url"

								<# if ( settings.comment_form_input_placeholders === 'yes' ) { #>
									placeholder="Website URL"
								<# } #>
							>

						</p>

					<# } #>

					<# if ( settings.comment_form_cookie_check === 'yes' ) { #>

						<p class="comment-form-cookies-consent">

							<input
								id="wp-comment-cookies-consent"
								name="wp-comment-cookies-consent"
								type="checkbox"
								value="yes"
							>

							<label for="wp-comment-cookies-consent">
								Save my name, email, and website in this browser for the next time I comment.
							</label>

						</p>

					<# } #>

					<p class="form-submit">

						<input
							name="submit"
							type="submit"
							id="submit"
							class="submit"
							value="{{ settings.comment_form_submit_text || 'Submit' }}"
						>

					</p>

				</form>

			</div>

		</div>
		<?php
	}
	
}