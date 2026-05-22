<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Modules\NestedElements\Base\Widget_Nested_Base;
use Elementor\Modules\NestedElements\Controls\Control_Nested_Repeater;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AdvancedSlider extends Widget_Nested_Base {

	public $num_of_slide_items = 0;

	public function get_name() {
		return 'pea_advanced_slider';
	}

	public function get_title() {
		return esc_html__( 'Advanced Slider', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

	public function get_icon() {
		return 'pea_advanced_slider_icon';
	}

	public function get_keywords() {
		return [ 'Slider', 'Nested', 'Advanced Slider', 'Carousel', 'Advanced Carousel' ];
	}

	// TODO: Replace this check with `is_active_feature` on 3.28.0 to support is_active_feature second parameter.
	public function show_in_panel() {
		return Plugin::$instance->experiments->is_feature_active( 'nested-elements' ) && Plugin::$instance->experiments->is_feature_active( 'container' );
	}

	public function has_widget_inner_wrapper(): bool {
		return ! Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

    public function get_style_depends(): array {
        return [
            'prime-elementor-addons-swiper',
            'prime-elementor-addons--advanced-slider'
        ];
    }

    public function get_script_depends(): array {
        return [
            'prime-elementor-addons-swiper',
            'prime-elementor-addons--advanced-slider'
        ];
    }

	protected function get_default_children_elements() {

        // Check if the testimonial widget is registered
        $widget_registered = Plugin::$instance->widgets_manager->get_widget_types( 'pea_testimonial' );

        $make_slide = function( $num ) use ( $widget_registered ) {
            $elements = [];

            if ( $widget_registered ) {
                $elements[] = [
                    'elType'     => 'widget',
                    'id'         => \Elementor\Utils::generate_random_string(),
                    'widgetType' => 'pea_testimonial',
                    'settings'   => [],
                    'elements'   => [],
                ];
            }

            return [
                'elType'   => 'container',
                'id'       => \Elementor\Utils::generate_random_string(),
                'settings' => [
                    /* translators: %d: Slide Item number. */
                    '_title'                => sprintf( __( 'Slide Item #%d', 'unlimited-elementor-inner-sections-by-boomdevs' ), $num ),
                    'background_background' => 'classic',
                    'background_color'      => '#ffffff',
                ],
                'elements' => $elements,
            ];
        };

        return [
            $make_slide(1),
            $make_slide(2),
            $make_slide(3),
            $make_slide(4),
        ];
    }

	protected function get_default_repeater_title_setting_key() {
		return 'slide_title';
	}

	protected function get_default_children_title() {
		/* translators: %d: Slide number. */
		return esc_html__( 'Slide Item %d', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

    protected function get_default_children_placeholder_selector() {
        return '.pea-swiper-wrapper';  // Parent that holds all slide items
    }

    protected function get_default_children_container_placeholder_selector() {
        return '.pea-advanced-slider-item';  // Each Slide item wrapper
    }

	// protected function get_html_wrapper_class() {
	// 	return 'elementor-widget-pea_advanced_slider';
	// }

	protected function register_controls() {

        // =====================
        // CONTENT TAB
        // =====================

        // Slide Item Section
		$this->start_controls_section(
			'slide_items_section',
			[
				'label' => esc_html__( 'Slide Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);
            $repeater = new Repeater();
            $repeater->add_control(
                'slide_title',
                [
                    'label'       => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Slider Item Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'placeholder' => esc_html__( 'Slider Item Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'slider_items',
                [
                    'label'              => esc_html__( 'Slider Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'               => Control_Nested_Repeater::CONTROL_TYPE,
                    'fields'             => $repeater->get_controls(),
                    'default'            => [
                        [
                            'slide_title' => esc_html__( 'Slide Item 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        ],
                        [
                            'slide_title' => esc_html__( 'Slide Item 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        ],
                        [
                            'slide_title' => esc_html__( 'Slide Item 3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        ],
                        [
                            'slide_title' => esc_html__( 'Slide Item 4', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        ],
                    ],
                    'frontend_available' => true,
                    'title_field'        => '{{{ slide_title }}}',
                ]
            );
		$this->end_controls_section();

		$this->start_controls_section(
			'general_settings',
			array(
				'label' => esc_html__( 'General Settings', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			)
		);

			$this->add_control(
				'slider_type',
				[
					'label'       => esc_html__( 'Slider Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'slider',
					'options'     => [
						'slider'    => esc_html__( 'Slider', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'carousel'  => esc_html__( 'Carousel', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

			$this->add_control(
				'slider_effect_type',
				[
					'label'       => esc_html__( 'Slider Effect', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'slide',
					'options'     => [
						'slide'    => esc_html__( 'Slide', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'fade'  => esc_html__( 'Fade', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'coverflow'    => esc_html__( 'CoverFlow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'flip'  => esc_html__( 'Flip', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'creative'    => esc_html__( 'Creative', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
                    'condition' => [
                        'slider_type' => 'slider',
                    ],
				]
			);

			$this->add_control(
				'carousel_effect_type',
				[
					'label'       => esc_html__( 'Carousel Effect', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'slide',
					'options'     => [
						'slide'    => esc_html__( 'Slide', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'coverflow'    => esc_html__( 'CoverFlow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
                    'condition' => [
                        'slider_type' => 'carousel',
                    ],
				]
			);
				
			$this->add_control(
				'show_navigation',
				[
					'label' => esc_html__('Show Navigation', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
				
			$this->add_control(
				'show_pagination',
				[
					'label' => esc_html__('Show Pagination', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'yes',
                    
				]
			);
            
            $this->add_responsive_control(
                'slide_min_height',
                [
                    'label' => esc_html__('Minimum Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 300,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-swiper-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Carousel settings
        $this->start_controls_section(
            'carousel_settings',
            [
                'label' => esc_html__('Carousel Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slider_type' => 'carousel',
                ],
            ]
        );
            $this->add_responsive_control(
                'num_of_columns',
                [
                    'label' => esc_html__('Number of Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'step' => 1,
                            'min' => 1,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 3,
                    ],
                    'tablet_default' => [
                        'unit' => '',
                        'size' => 2,
                    ],
                    'mobile_default' => [
                        'unit' => '',
                        'size' => 1,
                    ],
                ]
            );  
            $this->add_responsive_control(
                'column_gap',
                [
                    'label' => esc_html__('Column Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'step' => 1,
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'tablet_default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'mobile_default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                ]
            );  
		$this->end_controls_section();

		$this->start_controls_section(
			'slider_options',
			[
				'label' => esc_html__( 'Slider Options', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
		);
				
			$this->add_control(
				'enable_loop',
				[
					'label' => esc_html__('Enable Loop', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
                    
				]
			);
				
			$this->add_control(
				'enable_autoplay',
				[
					'label' => esc_html__('Enable Autoplay', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
                    
				]
			);
            
            $this->add_control(
                'autoplay_speed_ms',
                [
                    'label' => esc_html__('Autoplay Speed (ms)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['ms',],
                    'range' => [
                        'ms' => [
                            'min' => 500,
                            'max' => 10000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'ms',
                        'size' => 2000,
                    ],
					'condition' => [
						'enable_autoplay' => 'yes',
					],
                ]
            );
				
			$this->add_control(
				'reverse_direction',
				[
					'label' => esc_html__('Reverse Direction', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
					'condition' => [
						'enable_autoplay' => 'yes',
					],
                    
				]
			);
				
			$this->add_control(
				'pause_on_hover',
				[
					'label' => esc_html__('Pause On Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
					'condition' => [
						'enable_autoplay' => 'yes',
					],
                    
				]
			);
				
			$this->add_control(
				'stop_on_last_slide',
				[
					'label' => esc_html__('Stop On Last Slide', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms'    => [
                            [
                                'name'     => 'enable_autoplay',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                            [
                                'name'     => 'enable_loop',
                                'operator' => '!==',
                                'value'    => 'yes',
                            ],
                        ],
                    ],
                    
				]
			);
				
			$this->add_control(
				'enable_allow_touchmove',
				[
					'label' => esc_html__('Enable Allow Touch Move', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'yes',
                    
				]
			);
				
			$this->add_control(
				'enable_mouse_wheel',
				[
					'label' => esc_html__('Enable Mouse Wheel', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
                    
				]
			);
				
			$this->add_control(
				'enable_keyboard_navigation',
				[
					'label' => esc_html__('Enable Keyboard Navigation', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
                    
				]
			);
            
            $this->add_responsive_control(
                'transition_speed_ms',
                [
                    'label' => esc_html__('Transition Speed (ms)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['ms',],
                    'range' => [
                        'ms' => [
                            'min' => 100,
                            'max' => 3000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'ms',
                        'size' => 500,
                    ],
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'navigation_settings',
			[
				'label' => esc_html__( 'Navigation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'condition' => [
                    'show_navigation' => 'yes',
                ],
            ]
		);
				
			$this->add_control(
				'custom_icon',
				[
					'label' => esc_html__('Custom Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'no',
                    
				]
			);
            
            $this->add_control(
                'hide_default_icons',
                [
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => 'none',
                    'condition' => [
                        'custom_icon' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'display: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'navigation_left_icon_or_image_heading',
                [
                    'label' => esc_html__( 'Left Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
					'condition' => [
						'custom_icon' => 'yes',
					],
                ]
            );

			$this->add_control(
				'navigation_left_icon_or_img_choose',
				[
                    // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
					'label' => esc_html__('', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'icon',
					'options' => [
						'icon' => [
							'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-info-circle',
						],
						'image' => [
							'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-image-bold',
						],
					],
					'label_block' => true,
                    
					'condition' => [
						'custom_icon' => 'yes',
					],
				]
			);

			$this->add_control(
				'navigation_left_icon',
				[
					'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-left',
                        'library' => 'fa-solid',
                    ],
                    
					'condition' => [
						'custom_icon' => 'yes',
						'navigation_left_icon_or_img_choose' => 'icon',
					],
				]
			);

            $this->add_control(
                'navigation_left_image',
                [
                    // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
                    'label' => esc_html__( '', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'skin' => 'inline',
                    'dynamic' => [
                        'active' => true,
                    ],
                    
                    'condition' => [
						'custom_icon' => 'yes',
                        'navigation_left_icon_or_img_choose' => 'image'
                    ]
                ]
            );

            $this->add_control(
                'navigation_right_icon_or_image_heading',
                [
                    'label' => esc_html__( 'Right Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
					'condition' => [
						'custom_icon' => 'yes',
					],
                ]
            );

			$this->add_control(
				'navigation_right_icon_or_img_choose',
				[
                    // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
					'label' => esc_html__('', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'icon',
					'options' => [
						'icon' => [
							'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-info-circle',
						],
						'image' => [
							'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'icon' => 'eicon-image-bold',
						],
					],
					'label_block' => true,
                    
					'condition' => [
						'custom_icon' => 'yes',
					],
				]
			);

			$this->add_control(
				'navigation_right_icon',
				[
					'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
                    
					'condition' => [
						'custom_icon' => 'yes',
						'navigation_right_icon_or_img_choose' => 'icon',
					],
				]
			);

            $this->add_control(
                'navigation_right_image',
                [
                    // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
                    'label' => esc_html__( '', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'skin' => 'inline',
                    'dynamic' => [
                        'active' => true,
                    ],
                    
                    'condition' => [
						'custom_icon' => 'yes',
                        'navigation_right_icon_or_img_choose' => 'image'
                    ]
                ]
            );

			$this->add_control(
				'navigation_position_type',
				[
					'label'       => esc_html__( 'Position Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'outside',
					'options'     => [
						'inside'    => esc_html__( 'Inside', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'outside'  => esc_html__( 'Outside', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

			$this->add_control(
				'navigation_position',
				[
					'label'       => esc_html__( 'Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'center',
					'options'     => [
						'center'    => esc_html__( 'Center Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'top-left'    => esc_html__( 'Top Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'top-center'    => esc_html__( 'Top Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'top-right'    => esc_html__( 'Top Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'bottom-left'    => esc_html__( 'Bottom Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'bottom-center'    => esc_html__( 'Bottom Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'bottom-right'    => esc_html__( 'Bottom Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

			$this->add_control(
				'navigation_arrow_direction',
				[
					'label'       => esc_html__( 'Arrow Direction', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'row',
					'options'     => [
						'row'       => esc_html__( 'Row ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'row-reverse'    => esc_html__( 'Row Reverse', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'column'    => esc_html__( 'Column', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'column-reverse'    => esc_html__( 'Column Reverse', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-navigation-icons-wrapper' => 'flex-direction: {{VALUE}};',
                    ],
				]
			);
            
            $this->add_responsive_control(
                'navigation_top_offset',
                [
                    'label' => esc_html__('Top Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-navigation-icons-wrapper' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'top-left',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'top-center',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'top-right',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'navigation_bottom_offset',
                [
                    'label' => esc_html__('Bottom Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-navigation-icons-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'bottom-left',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'bottom-center',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'bottom-right',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'navigation_left_offset',
                [
                    'label' => esc_html__('Left Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-navigation-icons-wrapper' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms'    => [
                            [
                                'name'     => 'navigation_position',
                                'operator' => '!==',
                                'value'    => 'center',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '!==',
                                'value'    => 'top-right',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '!==',
                                'value'    => 'bottom-right',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'navigation_right_offset',
                [
                    'label' => esc_html__('Right Offset', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-navigation-icons-wrapper' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'top-right',
                            ],
                            [
                                'name'     => 'navigation_position',
                                'operator' => '===',
                                'value'    => 'bottom-right',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'navigation_padding',
                [
                    'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-advanced-slider-wrapper' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    ],
					'condition' => [
						'navigation_position_type' => 'outside',
					],
                ]
            );
            
            $this->add_responsive_control(
                'navigation_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem', 'vh', 'vw'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-navigation-icons-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
					'condition' => [
						'navigation_position!' => 'center',
					],
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination_settings',
			[
				'label' => esc_html__( 'Pagination', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
		);

			$this->add_control(
				'pagination_type',
				[
					'label'       => esc_html__( 'Pagination Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'bullets',
					'options'     => [
						'bullets'    => esc_html__( 'Bullets', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'fraction'  => esc_html__( 'Fraction', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'progressbar'  => esc_html__( 'Progress Bar', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
				]
			);

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================
        
        // Navigation Styling Controls
        $this->start_controls_section(
            'navigation_styling',
            [
                'label' => __( 'Navigation', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_navigation' => 'yes',
                ],
            ]
        );
		
            $this->add_responsive_control(
                'navigation_icon_size',
                [
                    'label'           => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .swiper-button-prev i, {{WRAPPER}} .swiper-button-next i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .swiper-button-prev svg, {{WRAPPER}} .swiper-button-next svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );
		
            $this->add_responsive_control(
                'navigation_icon_width',
                [
                    'label'           => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 46,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
		
            $this->add_responsive_control(
                'navigation_icon_height',
                [
                    'label'           => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 46,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'navigation_tabs' );
                $this->start_controls_tab(
                    'navigation_normal_tab',
                    [
                        'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'navigation_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#333333',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-button-prev:after, {{WRAPPER}} .swiper-button-next:after' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .swiper-button-prev i, {{WRAPPER}} .swiper-button-next i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .swiper-button-prev svg, {{WRAPPER}} .swiper-button-next svg' => 'fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'navigation_bg_color',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#EFEFEF',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'navigation_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next',
                            // 'fields_options' => [
                            //     'border' => [
                            //         'default' => 'solid',
                            //     ],
                            //     'width' => [
                            //         'default' => [
                            //             'top' => 0,
                            //             'right' => 0,
                            //             'bottom' => 1,
                            //             'left' => 0,
                            //         ],
                            //     ],
                            //     'color' => [
                            //         'default' => '#E1E3E8',
                            //     ],
                            // ],
						]
					); 

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'navigation_box_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next',
                        ]
                    );
            
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'navigation_hover_tab',
                    [
                        'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_control(
                        'navigation_hover_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-button-prev:hover:after, {{WRAPPER}} .swiper-button-next:hover:after' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .swiper-button-prev:hover i, {{WRAPPER}} .swiper-button-next:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .swiper-button-prev:hover svg, {{WRAPPER}} .swiper-button-next:hover svg' => 'fill:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'navigation_hover_bg_color',
                        [
                            'label'     => __( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-button-prev:hover, {{WRAPPER}} .swiper-button-next:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'navigation_hover_border_color',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-button-prev:hover, {{WRAPPER}} .swiper-button-next:hover' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'navigation_hover_box_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .swiper-button-prev:hover, {{WRAPPER}} .swiper-button-next:hover',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_control(
                'navigation_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'navigation_border_radius',
                [
                    'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'default' => [
                        'top' => 50,
                        'right' => 50,
                        'bottom' => 50,
                        'left' => 50,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'navigation_margin',
                [
                    'label'      => __( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Pagination Styling Controls
        $this->start_controls_section(
            'pagination_styling',
            [
                'label' => __( 'Pagination', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );
		
            $this->add_responsive_control(
                'pagination_position',
                [
                    'label'           => esc_html__('Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'render_type' => 'ui',
                    'selectors'       => [
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-fraction' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-progressbar' => 'top: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
		
            $this->add_responsive_control(
                'pagination_progressbar_height',
                [
                    'label'           => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}} !important',
                    ],
                   'condition' => [
                        'pagination_type' => 'progressbar',
                    ], 
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'pagination_typography',
                    'label'     => __( 'Typography', 'unlimited-elementor-inner-sections-by-boomdevs' ), 
                    'selector'  => '{{WRAPPER}} .swiper-pagination-fraction, {{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-current, {{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-total ', 
                    'condition' => [
                        'pagination_type' => 'fraction',
                    ],
                ]
            );

            $this->start_controls_tabs( 
                'pagination_bullet_tabs',
                [
                   'condition' => [
                        'pagination_type' => 'bullets',
                    ], 
                ]
            );
                $this->start_controls_tab(
                    'pagination_normal_tab',
                    [
                        'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
		
                    $this->add_responsive_control(
                        'pagination_bullet_width',
                        [
                            'label'           => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type'            => Controls_Manager::SLIDER,
                            'size_units'      => [ 'px', '%', 'em', 'rem' ],
                            'range'           => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 8,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};'
                            ],
                        ]
                    );
		
                    $this->add_responsive_control(
                        'pagination_bullet_height',
                        [
                            'label'           => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type'            => Controls_Manager::SLIDER,
                            'size_units'      => [ 'px', '%', 'em', 'rem' ],
                            'range'           => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 8,
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};'
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#333333',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_border_border',
                        [
                            'label'       => __( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'        => Controls_Manager::SELECT,
                            'options'   => [
                                ''    => 'Default',
                                'none'    => 'None',
                                'solid'    => 'Solid',
                                'double'    => 'Double',
                                'dotted'    => 'Dotted',
                                'dashed'    => 'Dashed',
                                'groove'    => 'Groove',
                            ],
                            'default'     => '',
                            'selectors'  => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'border-style: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_width',
                        [
                            'label'      => __( 'Border Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%','em'],
                            'selectors'  => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_border_color',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_border_hover_color',
                        [
                            'label'     => __( 'Border Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%','em'],
                            'default' => [
                                'top' => 50,
                                'right' => 50,
                                'bottom' => 50,
                                'left' => 50,
                                'unit' => 'px',
                                'isLinked' => true,
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );
            
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'pagination_active_tab',
                    [
                        'label' => __( 'Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
		
                    $this->add_responsive_control(
                        'pagination_active_bullet_width',
                        [
                            'label'           => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type'            => Controls_Manager::SLIDER,
                            'size_units'      => [ 'px', '%', 'em', 'rem' ],
                            'range'           => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};'
                            ],
                        ]
                    );
		
                    $this->add_responsive_control(
                        'pagination_active_bullet_height',
                        [
                            'label'           => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type'            => Controls_Manager::SLIDER,
                            'size_units'      => [ 'px', '%', 'em', 'rem' ],
                            'range'           => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors'       => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};'
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_active_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_active_border_border',
                        [
                            'label'       => __( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'        => Controls_Manager::SELECT,
                            'options'   => [
                                ''    => 'Default',
                                'none'    => 'None',
                                'solid'    => 'Solid',
                                'double'    => 'Double',
                                'dotted'    => 'Dotted',
                                'dashed'    => 'Dashed',
                                'groove'    => 'Groove',
                            ],
                            'default'     => '',
                            'selectors'  => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'border-style: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_active_border_width',
                        [
                            'label'      => __( 'Border Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%','em'],
                            'selectors'  => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_active_border_color',
                        [
                            'label'     => __( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'pagination_active_border_hover_color',
                        [
                            'label'     => __( 'Border Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active:hover' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_active_border_radius',
                        [
                            'label'      => __( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%','em'],
                            'selectors'  => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->start_controls_tabs( 
                'pagination_fraction_tabs',
                [
                   'condition' => [
                        'pagination_type' => 'fraction',
                    ], 
                ]
            );
                $this->start_controls_tab(
                    'pagination_fraction_normal_tab',
                    [
                        'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'pagination_fraction_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '0F0F0F',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-fraction' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'pagination_fraction_hover_tab',
                    [
                        'label' => __( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'pagination_fraction_hover_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-fraction:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->start_controls_tabs( 
                'pagination_progressbar_tabs',
                [
                   'condition' => [
                        'pagination_type' => 'progressbar',
                    ], 
                ]
            );
                $this->start_controls_tab(
                    'pagination_progressbar_normal_tab',
                    [
                        'label' => __( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'pagination_progressbar_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '0F0F0F',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-progressbar' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'pagination_progressbar_active_tab',
                    [
                        'label' => __( 'Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'pagination_progressbar_active_color',
                        [
                            'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_control( 'pagination_hr', [ 'type' => Controls_Manager::DIVIDER, ] );
            
            $this->add_responsive_control(
                'dropdown_margin',
                [
                    'label'      => __( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%','em'],
                    'selectors'  => [
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-fraction' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .swiper-pagination.swiper-pagination-progressbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

	}

	protected function content_template_single_repeater_item() {
        ?>
        <#
        const elementUid = view.getIDInt().toString().substr( 0, 3 ),
            numOfSlides = view.collection.length + 1,
            SlideCount = numOfSlides,
            slideItemKey = 'new-slide-' + elementUid + SlideCount;

        var itemClass = 'pea-slider-child-wrap swiper-slide pea-advanced-slider-item elementor-repeater-item-' + data._id;

        view.addRenderAttribute( slideItemKey, {
            'class': itemClass,
            'slide-index': SlideCount,
            'role': 'group',
        } );
        #>
        <div {{{ view.getRenderAttributeString( slideItemKey ) }}}>
        </div>
        <?php
    }



	protected function render() {
        $settings = $this->get_settings_for_display();
        $this->num_of_slide_items = count( $settings['slider_items'] ?? array() );
        $slide_items = $settings['slider_items'];

        $widget_id = $this->get_id(); // unique per widget instance
        $is_carousel = $settings['slider_type'] === 'carousel';
        $effect = $is_carousel
            ? ($settings['carousel_effect_type'] ?? 'slide')
            : ($settings['slider_effect_type'] ?? 'slide');

        $swiper_settings = [
            'effect' => $effect,
            'loop'   => $settings['enable_loop'] === 'yes',
            'speed'  => $settings['transition_speed_ms']['size'] ?? 500,
            'allowTouchMove' => $settings['enable_allow_touchmove'] === 'yes',
            'mousewheel' => $settings['enable_mouse_wheel'] === 'yes' ? true : false,
            'keyboard' => $settings['enable_keyboard_navigation'] === 'yes' ? [ 'enabled' => true, 'onlyInViewport' => true ] : false,
        ];

        if ( $is_carousel ) {

            // Desktop
            $desktop_columns = $settings['num_of_columns']['size'] ?? 3;
            $desktop_gap     = $settings['column_gap']['size'] ?? 20;

            // Tablet
            $tablet_columns  = $settings['num_of_columns_tablet']['size'] ?? 2;
            $tablet_gap      = $settings['column_gap_tablet']['size'] ?? 15;

            // Mobile
            $mobile_columns  = $settings['num_of_columns_mobile']['size'] ?? 1;
            $mobile_gap      = $settings['column_gap_mobile']['size'] ?? 10;

            $swiper_settings['slidesPerView'] = $desktop_columns;
            $swiper_settings['spaceBetween']  = $desktop_gap;

            $swiper_settings['breakpoints'] = [
                0 => [
                    'slidesPerView' => $mobile_columns,
                    'spaceBetween'  => $mobile_gap,
                ],
                768 => [
                    'slidesPerView' => $tablet_columns,
                    'spaceBetween'  => $tablet_gap,
                ],
                1024 => [
                    'slidesPerView' => $desktop_columns,
                    'spaceBetween'  => $desktop_gap,
                ],
            ];

            $swiper_settings['centeredSlides'] = false;
            // Optional for better carousel UX
            $swiper_settings['watchSlidesProgress'] = true;

            if ( $effect === 'coverflow' ) {
                $swiper_settings['coverflowEffect'] = [
                    'rotate' => 50,
                    'stretch' => 0,
                    'depth' => 100,
                    'modifier' => 1,
                    'slideShadows' => true,
                ];
            }
        }

        if ( $settings['show_navigation'] === 'yes' ) {
            $swiper_settings['navigation'] = [
                'nextEl' => ".pea-swiper-{$widget_id} .swiper-button-next",
                'prevEl' => ".pea-swiper-{$widget_id} .swiper-button-prev",
            ];
            $navigation_position = $settings['navigation_position'];
        }

        if ( $settings['show_pagination'] === 'yes' ) {
            $swiper_settings['pagination'] = [
                'el' => ".pea-swiper-{$widget_id} .swiper-pagination",
                'clickable' => true,
                'type' => $settings['pagination_type'] ?? 'bullets',
            ];
        }

        if ( $settings['enable_autoplay'] === 'yes' ) {
            $swiper_settings['autoplay'] = [
                'delay' => $settings['autoplay_speed_ms']['size'],
                'disableOnInteraction' => false,
                'reverseDirection' => $settings['reverse_direction'] === 'yes',
                'pauseOnMouseEnter' => $settings['pause_on_hover'] === 'yes',
                'stopOnLastSlide' => (
                    $settings['stop_on_last_slide'] === 'yes' &&
                    $settings['enable_loop'] !== 'yes'
                ),
            ];
        }

        $data_settings = wp_json_encode( $swiper_settings );
        
        $this->add_render_attribute(
            array(
                'pea-advanced-slider-wrapper' => array(
                    'class' => array( 'pea-widget-wrapper', 'pea-advanced-slider-wrapper' ),
                ),
                'pea-advanced-slider-container' => array(
                    'class' => 'pea-advanced-slider-container',
                ),
            )
        );
        ?>
        <div class="pea-advanced-slider-wrapper outside center pea-swiper-<?php echo esc_attr($widget_id); ?>"  data-swiper-settings='<?php echo esc_attr($data_settings); ?>'>
            <div class="pea-slides pea-swiper swiper">
                <div class="swiper-wrapper pea-swiper-wrapper" aria-live="polite">
                    <?php
                    foreach ( $slide_items as $index => $slide ) {
                        $slide_count = $index + 1;
                        $slide_item_key = $this->get_repeater_setting_key( 'slide_item', 'slider', $index );
                        $this->add_render_attribute(
                            $slide_item_key,
                            array(
                                'class' => 'pea-slider-child-wrap swiper-slide pea-advanced-slider-item elementor-repeater-item-'.esc_attr( $slide['_id'] ),
                                'slide-index' => $slide_count,
                                'role' => 'group',
                            )
                        );
                        ?>
                        <div <?php $this->print_render_attribute_string( $slide_item_key ); ?>>
                            <?php $this->print_child( $index ); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                <?php if ( $settings['show_navigation'] === 'yes' && $settings['navigation_position_type'] === 'inside'  ) : ?>
                    <div class="pea-navigation-icons-wrapper inside <?php echo esc_attr($navigation_position); ?>">

                        <div class="swiper-button-prev">
                            <?php
                            if ( $settings['custom_icon'] === 'yes' ) {

                                if ( $settings['navigation_left_icon_or_img_choose'] === 'icon' ) {
                                    \Elementor\Icons_Manager::render_icon(
                                        $settings['navigation_left_icon'],
                                        [ 'aria-hidden' => 'true' ]
                                    );
                                } elseif ( ! empty( $settings['navigation_left_image']['url'] ) ) {
                                    echo '<img src="' . esc_url( $settings['navigation_left_image']['url'] ) . '" alt="">';
                                }

                            }
                            ?>
                        </div>

                        <div class="swiper-button-next">
                            <?php
                            if ( $settings['custom_icon'] === 'yes' ) {

                                if ( $settings['navigation_right_icon_or_img_choose'] === 'icon' ) {
                                    \Elementor\Icons_Manager::render_icon(
                                        $settings['navigation_right_icon'],
                                        [ 'aria-hidden' => 'true' ]
                                    );
                                } elseif ( ! empty( $settings['navigation_right_image']['url'] ) ) {
                                    echo '<img src="' . esc_url( $settings['navigation_right_image']['url'] ) . '" alt="">';
                                }

                            }
                            ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>

            <?php if ( $settings['show_pagination'] === 'yes' ) : ?>
                <div class="swiper-pagination" aria-label="Slider pagination" role="region">
                </div>
            <?php endif; ?>
            
            <?php if ( $settings['show_navigation'] === 'yes' && $settings['navigation_position_type'] === 'outside'  ) : ?>
                <div class="pea-navigation-icons-wrapper outside <?php echo esc_attr($navigation_position); ?>">

                    <div class="swiper-button-prev">
                        <?php
                        if ( $settings['custom_icon'] === 'yes' ) {

                            if ( $settings['navigation_left_icon_or_img_choose'] === 'icon' ) {
                                \Elementor\Icons_Manager::render_icon(
                                    $settings['navigation_left_icon'],
                                    [ 'aria-hidden' => 'true' ]
                                );
                            } elseif ( ! empty( $settings['navigation_left_image']['url'] ) ) {
                                echo '<img src="' . esc_url( $settings['navigation_left_image']['url'] ) . '" alt="">';
                            }
                        }
                        ?>
                    </div>

                    <div class="swiper-button-next">
                        <?php
                        if ( $settings['custom_icon'] === 'yes' ) {

                            if ( $settings['navigation_right_icon_or_img_choose'] === 'icon' ) {
                                \Elementor\Icons_Manager::render_icon(
                                    $settings['navigation_right_icon'],
                                    [ 'aria-hidden' => 'true' ]
                                );
                            } elseif ( ! empty( $settings['navigation_right_image']['url'] ) ) {
                                echo '<img src="' . esc_url( $settings['navigation_right_image']['url'] ) . '" alt="">';
                            }

                        }
                        ?>
                    </div>

                </div>
            <?php endif; ?>

        </div>
        <?php
    }

	protected function get_initial_config(): array {
		return array_merge(
			parent::get_initial_config(),
			array(
                'support_improved_repeaters' => true,
                'target_container'           => array( '.pea-swiper-wrapper' ),
                'node'                       => 'div',
                'is_interlaced'              => true,
                'support_paste_all'          => true, // ADD THIS
                'container_settings'         => array(
                    'accepts' => array( 'container', 'widget', 'section' ), // ADD THIS
                ),
			)
		);
	}

	protected function content_template() {
        ?>   
        <# if ( settings['slider_items'] ) {     
            var widgetId = view.getID();
            var uniqueClass = 'pea-swiper-' + widgetId;
            var isCarousel = settings.slider_type === 'carousel';

            var effect = isCarousel
                ? (settings.carousel_effect_type || 'slide')
                : (settings.slider_effect_type || 'slide');

            var swiperSettings = {
                effect: effect,
                loop: settings.enable_loop === 'yes',
                speed: settings.transition_speed_ms.size || 500,
                allowTouchMove: settings.enable_allow_touchmove === 'yes',
                mousewheel: settings.enable_mouse_wheel === 'yes',
                keyboard: settings.enable_keyboard_navigation === 'yes'
            };

            if ( isCarousel ) {

                if ( effect === 'coverflow' ) {
                    swiperSettings.coverflowEffect = {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: true
                    };
                }

                var desktopColumns = settings.num_of_columns?.size || 3;
                var tabletColumns  = settings.num_of_columns_tablet?.size || 2;
                var mobileColumns  = settings.num_of_columns_mobile?.size || 1;

                var desktopGap = settings.column_gap?.size || 20;
                var tabletGap  = settings.column_gap_tablet?.size || 15;
                var mobileGap  = settings.column_gap_mobile?.size || 10;

                swiperSettings.breakpoints = {
                    0: {
                        slidesPerView: mobileColumns,
                        spaceBetween: mobileGap
                    },
                    768: {
                        slidesPerView: tabletColumns,
                        spaceBetween: tabletGap
                    },
                    1024: {
                        slidesPerView: desktopColumns,
                        spaceBetween: desktopGap
                    }
                };
            }

            if ( settings.show_navigation === 'yes' ) {
                swiperSettings.navigation = {
                    nextEl: '.' + uniqueClass + ' .swiper-button-next',
                    prevEl: '.' + uniqueClass + ' .swiper-button-prev'
                };
            }

            if ( settings.show_pagination === 'yes' ) {
                swiperSettings.pagination = {
                    el: '.' + uniqueClass + ' .swiper-pagination',
                    clickable: true,
                    type: settings.pagination_type || 'bullets'
                };
            }

            if ( settings.enable_autoplay === 'yes' ) {
                swiperSettings.autoplay = {
                    delay: settings.autoplay_speed_ms.size,
                    disableOnInteraction: false,
                    reverseDirection: settings.reverse_direction === 'yes',
                    pauseOnMouseEnter: settings.pause_on_hover === 'yes',
                    stopOnLastSlide: settings.stop_on_last_slide === 'yes' && settings.enable_loop !== 'yes' ,
                };
            }

            const elementUid = view.getIDInt().toString().substr( 0, 3 ),
                advancedSliderWrapper = 'slider-wrapper-' + elementUid,
                advancedSliderContainer = 'slider-container-' + elementUid,
                outsideWrapperClasses = ['pea-widget-wrapper','pea-advanced-slider-wrapper'],
                MidWrapperClasses = ['pea-advanced-slider-container'];

            view.addRenderAttribute( advancedSliderWrapper, {
                'class': outsideWrapperClasses,                             
            } );

            view.addRenderAttribute( advancedSliderContainer, {
                'class': MidWrapperClasses,
            } );

            #>
            <div class=" pea-advanced-slider-wrapper outside center pea-swiper-{{{ widgetId }}}" data-swiper-settings="{{ JSON.stringify( swiperSettings ) }}">
                <div class="pea-slides pea-swiper swiper">
                    <div class="swiper-wrapper pea-swiper-wrapper" aria-live="polite">
                        <# _.each( settings['slider_items'], function( slide, index ) {
                            const SlideCount = index + 1;
                            const slideUid = elementUid + SlideCount;
                            const slideItemKey = 'slide-item-' + slideUid;
                                
                            // Clear previous attributes for this key
                            var itemClass = 'pea-slider-child-wrap swiper-slide  pea-advanced-slider-item elementor-repeater-item-' + slide._id;

                            view.addRenderAttribute( slideItemKey, {
                                'class': itemClass,
                                'slide-index': SlideCount,
                                'role': 'group',
                            } ); #>

                            <div {{{ view.getRenderAttributeString( slideItemKey ) }}}>
                                
                            </div>
                        <# } ); #>
                    </div>
                    <# if ( settings.show_navigation === 'yes' && settings.navigation_position_type === 'inside' ) { #>
                        <div class="pea-navigation-icons-wrapper inside {{settings.navigation_position}}">
                            <div class="swiper-button-prev">
                                <# if ( settings.custom_icon === 'yes' ) { #>

                                    <# if ( settings.navigation_left_icon_or_img_choose === 'icon' ) { #>
                                        {{{ elementor.helpers.renderIcon( view, settings.navigation_left_icon, { 'aria-hidden': true } ) }}}
                                    <# } else if ( settings.navigation_left_image.url ) { #>
                                        <img src="{{ settings.navigation_left_image.url }}" alt="">
                                    <# } #>

                                <# } #>
                            </div>

                            <div class="swiper-button-next">
                                <# if ( settings.custom_icon === 'yes' ) { #>

                                    <# if ( settings.navigation_right_icon_or_img_choose === 'icon' ) { #>
                                        {{{ elementor.helpers.renderIcon( view, settings.navigation_right_icon, { 'aria-hidden': true } ) }}}
                                    <# } else if ( settings.navigation_right_image.url ) { #>
                                        <img src="{{ settings.navigation_right_image.url }}" alt="">
                                    <# } #>

                                <# } #>
                            </div>
                        </div>
                    <# } #>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <# if ( settings.show_pagination === 'yes' ) { #>
                    <div class="swiper-pagination" aria-label="Slider pagination" role="region">
                    </div>
                <# } #>
                <# if ( settings.show_navigation === 'yes' && settings.navigation_position_type === 'outside' ) { #>
                    <div class="pea-navigation-icons-wrapper outside {{settings.navigation_position}}">
                        <div class="swiper-button-prev">
                            <# if ( settings.custom_icon === 'yes' ) { #>

                                <# if ( settings.navigation_left_icon_or_img_choose === 'icon' ) { #>
                                    {{{ elementor.helpers.renderIcon( view, settings.navigation_left_icon, { 'aria-hidden': true } ) }}}
                                <# } else if ( settings.navigation_left_image.url ) { #>
                                    <img src="{{ settings.navigation_left_image.url }}" alt="">
                                <# } #>

                            <# } #>
                        </div>

                        <div class="swiper-button-next">
                            <# if ( settings.custom_icon === 'yes' ) { #>

                                <# if ( settings.navigation_right_icon_or_img_choose === 'icon' ) { #>
                                    {{{ elementor.helpers.renderIcon( view, settings.navigation_right_icon, { 'aria-hidden': true } ) }}}
                                <# } else if ( settings.navigation_right_image.url ) { #>
                                    <img src="{{ settings.navigation_right_image.url }}" alt="">
                                <# } #>

                            <# } #>
                        </div>
                    </div>
                <# } #>
            </div>
        <# } #>
        <?php
    }
}