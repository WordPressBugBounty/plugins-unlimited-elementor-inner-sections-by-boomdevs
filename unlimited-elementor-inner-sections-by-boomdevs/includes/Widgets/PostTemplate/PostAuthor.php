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

class PostAuthor extends Widget_Base {
	
	public function get_name() {
		return 'pea_post_author';
	}

	public function get_title() {
		return esc_html__( 'Post Author', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_author_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'post-title', 'post', 'title', 'post author', 'author' ];
	}
    
    public function get_style_depends() {
        return ['prime-elementor-addons--post-author'];
    }


	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

        // General Section
		$this->start_controls_section(
			'section_post_author',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_author_img',
			[
				'label' => esc_html__( 'Show Author Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'no',
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
			'show_author_description',
			[
				'label' => esc_html__( 'Show Author Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'description' => esc_html__( 'Note: The description will only appear if the author has added a bio in their profile.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'label_off' => esc_html__( 'No', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
            'post_author_align',
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
					'{{WRAPPER}} .pea-single-post-author-box' => 'justify-content: {{VALUE}}; align-items: {{VALUE}};',
				],
            ]
        );

		$this->add_responsive_control(
			'post_author_img_postition',
			[
				'label' => __('Image Position', 'unlimited-elementor-inner-sections-by-boomdevs') , 
				'type' => Controls_Manager::CHOOSE, 
                'default' => 'column',
				'options' => [
					'row' => [
						'title' => __('Left', 'unlimited-elementor-inner-sections-by-boomdevs') , 
						'icon' => 'eicon-h-align-left', 
					], 
					'column' => [
						'title' => __('Top', 'unlimited-elementor-inner-sections-by-boomdevs') , 
						'icon' => 'eicon-v-align-top', 
					], 
					'row-reverse' => [
						'title' => __('Right', 'unlimited-elementor-inner-sections-by-boomdevs') , 
						'icon' => 'eicon-h-align-right',
					], 
				], 
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-author-box' => 'flex-direction: {{VALUE}};',
				],
			]
		);
            
		// $this->add_control(
		// 	'hide_default_icons',
		// 	[
		// 		'type' => \Elementor\Controls_Manager::HIDDEN,
		// 		'default' => 'none',
		// 		'condition' => [
		// 			'post_author_img_postition' => 'row-reverse',
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'display: {{VALUE}};',
		// 		],
		// 	]
		// );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================

		// Author Box Styling Section
		$this->start_controls_section(
			'post_author_box_styling',
			[
				'label' => esc_html__( 'Author Box', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

			$this->add_control(
				'post_author_box_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'post_author_box_border_type',
					'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-author-box',
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
						'{{WRAPPER}} .pea-single-post-author-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_author_box_padding',
				[
					'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->add_responsive_control(
				'post_author_box_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'post_author_box_shadow',
					'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-author-box',
				]
			);

		$this->end_controls_section();

		// Author Image Styling Section
		$this->start_controls_section(
			'post_author_img_styling',
			[
				'label' => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

			$this->add_responsive_control(
				'post_author_img_size',
				[
					'label'           => __( 'Image Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'            => Controls_Manager::SLIDER,
					'size_units'      => [ 'px', '%' ],
					'range'           => [
						'px' => [
							'min' => 0,
							'max' => 200,
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
						'{{WRAPPER}} .pea-single-post-author-box .pea-single-post-author-pic img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'post_author_img_border_type',
					'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-author-box .pea-single-post-author-pic img',
				]
			);

			$this->add_responsive_control(
				'post_author_img_border_radius',
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
						'{{WRAPPER}} .pea-single-post-author-box .pea-single-post-author-pic img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'post_author_img_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box .pea-single-post-author-pic img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'post_author_img_box_shadow',
					'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-author-box .pea-single-post-author-pic img',
				]
			);

		$this->end_controls_section();

		// Author Name Styling Section
		$this->start_controls_section(
			'post_author_name_style',
			[
				'label' => esc_html__( 'Name', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

			$this->add_responsive_control(
				'post_author_name_align',
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
						'{{WRAPPER}} .pea-single-post-author-box .author-title' => 'text-align: {{VALUE}};',
					],
				]
			);
        
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'post_author_name_typography',
					'selector' => '{{WRAPPER}} .pea-single-post-author-box .author-title, {{WRAPPER}} .pea-single-post-author-box .author-title a, {{WRAPPER}} .pea-single-post-author-box .author-description',
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
				'post_author_name_color',
				[
					'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box .author-title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .pea-single-post-author-box .author-title a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .pea-single-post-author-box .author-description' => 'color: {{VALUE}}',
					],
				]
			);
			
			$this->add_control(
				'post_author_name_hover_color',
				[
					'label'     => __( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box .author-title a:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'post_author_name_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box .author-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'post_author_name_shadow',
					'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}}  .pea-single-post-author-box .author-title, {{WRAPPER}}  .pea-single-post-author-box .author-title a',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_author_description_style',
			[
				'label' => esc_html__( 'Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

			$this->add_responsive_control(
				'post_author_description_align',
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
						'{{WRAPPER}} .pea-single-post-author-box .author-description' => 'text-align: {{VALUE}};',
					],
				]
			);
			
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'post_author_description_typography',
					'selector' => '{{WRAPPER}} .pea-single-post-author-box .author-description',
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
				'post_author_description_color',
				[
					'label' => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box .author-description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'post_author_description_margin',
				[
					'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .pea-single-post-author-box .author-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'post_author_description_shadow',
					'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'selector' => '{{WRAPPER}} .pea-single-post-author-box .author-description',
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$show_img = isset($settings['show_author_img']) ? $settings['show_author_img'] : 'yes';
		
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

		$title = $post->post_title;
		$link = get_permalink($post_id);
		$author_id 	 = $post->post_author;
		$author_by	 = $settings['by_author'] === 'yes' ? esc_html('By','unlimited-elementor-inner-sections-by-boomdevs') : '';
		$author_name = get_the_author_meta('display_name', $author_id);
		$author_description = get_the_author_meta('description', $author_id); ?>
		<div class="pea-single-post-author-box">
			<?php if($show_img === 'yes') { ?>
				<a class="pea-single-post-author-pic" href="<?php echo esc_url(get_author_posts_url( $author_id ));?>"><?php echo get_avatar( $author_id , 150); ?></a>
			<?php } ?>
            <div class="author-meta">
                <h4 class="author-title">
					<a href ="<?php echo esc_url(get_author_posts_url( $author_id ));?>"> 
						<?php echo esc_html( $author_by ); ?> <?php echo esc_html($author_name); ?>
					</a>
				</h4>
				<?php if ($settings['show_author_description'] === 'yes' && !empty($author_description)) {
					echo '<p class="author-description">' . esc_html($author_description) . '</p>';
				} ?>
             </div>
        </div>
	<?php }
	
}