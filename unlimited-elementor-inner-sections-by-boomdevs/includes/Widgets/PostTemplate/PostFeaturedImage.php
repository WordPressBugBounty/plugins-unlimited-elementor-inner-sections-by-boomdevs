<?php 

namespace PrimeElementorAddons\Widgets\PostTemplate;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostFeaturedImage extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'pea_post_featured_image';
	}

	public function get_title() {
		return esc_html__( 'Post Featured Image', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_icon() {
		return 'pea_post_featured_image_icon';
	}

	public function get_categories() {
		return [ 'prime-elementor-addons' ];
	}

	public function get_keywords() {
		return ['post image', 'featured image', 'post featured image', 'post', 'image', 'post image' ];
	}


	protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================

        // General Section
		$this->start_controls_section(
			'section_post_image',
			[
				'label' => esc_html__( 'General', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            
		$this->add_control(
			'enable_post_link',
			[
				'label' => esc_html__('Enable Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'open_in_new_tab',
			[
				'label' => esc_html__('Open In New Tab', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'enable_post_link' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'image_from_post_content',
			[
				'label' => esc_html__('Image From Post Content', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'description' => esc_html__('Use the first image from post content when no featured image is available.', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'post_featured_image_size',
				'default'   => 'large'
			]
		);

		$this->add_responsive_control(
            'post_image_align',
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
					'{{WRAPPER}} .pea-single-post-image-wrapper' => 'justify-content: {{VALUE}}',
				],
				'separator' => 'after'
            ]
        );

		$this->end_controls_section();

        
        // =====================
        // STYLE TAB
        // =====================

		$this->start_controls_section(
			'image_section_style',
			[
				'label' => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$slug = 'post_featured_image';

		$this->add_responsive_control(
			$slug.'_width',
			[
				'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%','vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-image-wrapper img' => 'width: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_max_width',
			[
				'label' => esc_html__( 'Max Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%','vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-image-wrapper img' => 'max-width: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			$slug.'_height',
			[
				'label' => esc_html__( 'Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','vh' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1500,
					],
					'vh' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pea-single-post-image-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'post_image_border',
				'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-image-wrapper img',
			]
		);
        
		$this->add_control(
			'post_image_border_hover_color',
			[
				'label' => esc_html__('Border Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-image-wrapper img:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'post_image_border_border!' => ['', 'none'],					
				],
			]
		);

		$this->add_responsive_control(
			'post_image_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pea-single-post-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'post_image_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'selector' => '{{WRAPPER}} .pea-single-post-image-wrapper img',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$enable_link = $settings['enable_post_link'];
		$open_new_tab = $settings['open_in_new_tab'];
		$image_from_content = $settings['image_from_post_content'];
		if ( ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) ||  ( class_exists( "\Elementor\Plugin" ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) || ( get_post_type() == 'pea-site-builder' ) ) {
			$post_id = get_the_ID();
        	$post_id = \Elementor\Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_post_id');
            $post = get_post( $post_id );
        }else{
            $post_id = get_the_ID();
            $post = get_post($post_id);
		}

    	if ( ! $post ) return;

		$link = get_permalink($post_id);
		$size = $settings['post_featured_image_size_size'];

		$image_html = '';

		// Featured image
		if ( has_post_thumbnail( $post_id ) ) {
			$image_html = get_the_post_thumbnail(
				$post_id,
				$size,
				[ 'class' => 'pea-single-post-image img-fluid' ]
			);
		} elseif ( $image_from_content === 'yes' ) {

			// Get first image from post content
			$content = $post->post_content;

			preg_match( '/<img[^>]+src="([^">]+)"/', $content, $matches );

			if ( ! empty( $matches[1] ) ) {
				$image_html = '<img src="' . esc_url( $matches[1] ) . '" class="pea-single-post-image img-fluid" />';
			}
		}
		if ( $enable_link === 'yes' && ! empty( $image_html ) ) {
			$target = ( $open_new_tab === 'yes' ) ? ' target="_blank"' : '';
			$image_html = '<a href="' . esc_url( $link ) . '"' . $target . '>' . $image_html . '</a>';
		}
		
       	echo '<div class="pea-single-post-image-wrapper" style="display:flex;">';
			if ( ! empty( $image_html ) ) {
				echo $image_html;
			}
		echo '</div>';

	}
}