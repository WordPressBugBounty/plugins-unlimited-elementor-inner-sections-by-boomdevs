<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Modules\NestedElements\Base\Widget_Nested_Base;
use Elementor\Modules\NestedElements\Controls\Control_Nested_Repeater;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AdvancedAccordion extends Widget_Nested_Base {

	public $num_of_accordion_items = 0;

	public function get_name() {
		return 'pea_advanced_accordion';
	}

	public function get_title() {
		return esc_html__( 'Advanced Accordion', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

    public function get_categories() {
        return array( 'prime-elementor-addons' );
    }

	public function get_icon() {
		return 'pea_advanced_accordion_icon';
	}

	public function get_keywords() {
		return array(  'Accordion', 'Nested', 'Media', 'Gallery', 'Image' );
	}

	// TODO: Replace this check with `is_active_feature` on 3.28.0 to support is_active_feature second parameter.
	public function show_in_panel() {
		return Plugin::$instance->experiments->is_feature_active( 'nested-elements' ) && Plugin::$instance->experiments->is_feature_active( 'container' );
	}

	public function has_widget_inner_wrapper(): bool {
		return ! Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

    public function get_style_depends(): array {
        return ['prime-elementor-addons--advanced-accordion'];
    }

    public function get_script_depends(): array {
        return ['prime-elementor-addons--advanced-accordion'];
    }

	protected function get_default_children_elements() {
		return array(
			array(
				'elType'   => 'container',
				'settings' => array(
					'_title' => __( 'Accordion Item #1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				),
			),
			array(
				'elType'   => 'container',
				'settings' => array(
					'_title' => __( 'Accordion Item #2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				),
			),
			array(
				'elType'   => 'container',
				'settings' => array(
					'_title' => __( 'Accordion Item #3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				),
			),
		);
	}

	protected function get_default_repeater_title_setting_key() {
		return 'accordion_title';
	}

	protected function get_default_children_title() {
		/* translators: %d: Accordion number. */
		return esc_html__( 'Accordion Item %d', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

    protected function get_default_children_placeholder_selector() {
        return '.pea-advanced-accordion-inner-wrapper';  // Parent that holds all accordion items
    }

    protected function get_default_children_container_placeholder_selector() {
        return '.pea-advanced-accordion-item';  // Each accordion item wrapper
    }

	// protected function get_html_wrapper_class() {
	// 	return 'elementor-widget-pea_advanced_accordion';
	// }

	protected function register_controls() {

        // =====================
        // CONTENT TAB
        // =====================

        // Accordion Item Section
		$this->start_controls_section(
			'accordion_items_section',
			array(
				'label' => esc_html__( 'Accordion Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			)
		);
		$repeater = new Repeater();
            $repeater->start_controls_tabs( 'accordion_item_tabs' );
                $repeater->start_controls_tab(
                    'accordion_item_content_tab',
                    [
                        'label' => __( 'Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
				
                    $repeater->add_control(
                        'default_open',
                        [
                            'label' => esc_html__('Default Open', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'render_type' => 'none',
                        ]
                    );

                    $repeater->add_control(
                        'accordion_title',
                        array(
                            'label'       => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'        => Controls_Manager::TEXT,
                            'default'     => esc_html__( 'Accordion Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'placeholder' => esc_html__( 'Accordion Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'dynamic'     => array(
                                'active' => true,
                            ),
                            'render_type' => 'none',
                            'label_block' => true,
                        )
                    );

                    $repeater->add_control( 'accordion_item_title_prefix_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

                    $repeater->add_control(
                        'accordion_item_title_prefix_heading',
                        [
                            'label' => esc_html__( 'Title Prefix', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $repeater->add_control(
                        'accordion_item_title_prefix_choose_icon_or_img',
                        [
                            'label' => esc_html__('Choose Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::CHOOSE,
                            'default' => 'none',
                            'options' => [
                                'none' => [
                                	'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
                                	'icon' => 'eicon-ban',
                                ],
                                'icon' => [
                                    'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                                    'icon' => 'eicon-info-circle',
                                ],
                                'image' => [
                                    'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                                    'icon' => 'eicon-image-bold',
                                ],
                            ],
                            'render_type' => 'none',
                            'label_block' => true,
                        ]
                    );

                    $repeater->add_control(
                        'accordion_item_title_prefix_item_icon',
                        [
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-image',
                                'library' => 'fa-solid',
                            ],
                            'render_type' => 'none',
                            'condition' => [
                                'accordion_item_title_prefix_choose_icon_or_img' => 'icon',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'accordion_item_title_prefix_image',
                        [
                            'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'skin' => 'inline',
                            'dynamic' => [
                                'active' => true,
                            ],
                            'render_type' => 'none',
                            'condition' => [
                                'accordion_item_title_prefix_choose_icon_or_img' => 'image',
                            ],
                        ]
                    );

                    $repeater->add_control( 'accordion_item_title_suffix_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

                    $repeater->add_control(
                        'accordion_item_title_suffix_heading',
                        [
                            'label' => esc_html__( 'Title Suffix', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );

                    $repeater->add_control(
                        'accordion_item_title_suffix_choose_icon_or_img',
                        [
                            'label' => esc_html__('Choose Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::CHOOSE,
                            'default' => 'none',
                            'options' => [
                                'none' => [
                                	'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
                                	'icon' => 'eicon-ban',
                                ],
                                'icon' => [
                                    'title' => esc_html__('Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                                    'icon' => 'eicon-info-circle',
                                ],
                                'image' => [
                                    'title' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                                    'icon' => 'eicon-image-bold',
                                ],
                            ],
                            'render_type' => 'none',
                            'label_block' => true,
                        ]
                    );

                    $repeater->add_control(
                        'accordion_item_title_suffix_item_icon',
                        [
                            'type' => Controls_Manager::ICONS,
                            'default' => [
                                'value' => 'fas fa-quote-left',
                                'library' => 'fa-solid',
                            ],
                            'render_type' => 'none',
                            'condition' => [
                                'accordion_item_title_suffix_choose_icon_or_img' => 'icon',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'accordion_item_title_suffix_image',
                        [
                            'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'skin' => 'inline',
                            'dynamic' => [
                                'active' => true,
                            ],
                            'render_type' => 'none',
                            'condition' => [
                                'accordion_item_title_suffix_choose_icon_or_img' => 'image',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'styles_tab',
                    [
                        'label' => __( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $repeater->add_control(
                        'accordion_this_item_prefix_icon_color',
                        [
                            'label' => esc_html__('Prfix Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-accordion-title-prefix i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-accordion-title-prefix svg' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $repeater->add_control(
                        'accordion_this_item_prefix_hover_icon_color',
                        [
                            'label' => esc_html__('Prfix Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.pea-advanced-accordion-item:hover .pea-accordion-title-prefix i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}}.pea-advanced-accordion-item:hover .pea-accordion-title-prefix svg' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $repeater->add_control(
                        'accordion_this_item_suffix_icon_color',
                        [
                            'label' => esc_html__('Suffix Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-accordion-title-suffix i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-accordion-title-suffix svg' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $repeater->add_control(
                        'accordion_this_item_suffix_hover_icon_color',
                        [
                            'label' => esc_html__('Suffix Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.pea-advanced-accordion-item:hover .pea-accordion-title-suffix i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}}.pea-advanced-accordion-item:hover .pea-accordion-title-suffix svg' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_responsive_control(
                        'accordion_this_item_margin',
                        [
                            'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $repeater->add_responsive_control(
                        'accordion_this_item_padding',
                        [
                            'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'default' => [
                                'top' => 20,
                                'right' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'unit' => 'px',
                                'isLinked' => true,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .pea-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $repeater->end_controls_tab();
            $repeater->end_controls_tabs();

		$this->add_control(
			'accordion_items',
			array(
				'label'              => esc_html__( 'Accordion Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'               => Control_Nested_Repeater::CONTROL_TYPE,
				'fields'             => $repeater->get_controls(),
				'default'            => array(
					array(
                        'default_open' => 'yes',
						'accordion_title' => esc_html__( 'Accordion Item 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					),
					array(
                        'default_open' => 'no',
						'accordion_title' => esc_html__( 'Accordion Item 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					),
					array(
                        'default_open' => 'no',
						'accordion_title' => esc_html__( 'Accordion Item 3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					),
				),
				'title_field'        => '{{{ accordion_title }}}',
			)
		);

        $this->add_control( 'accordion_item_hr', [ 'type' => Controls_Manager::DIVIDER, ] );
        
        $this->add_control(
            'accordion_item_title_tag',
            [
                'label' => esc_html__('Accordion Items Title Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'p' => 'p',
                ],
                'default' => 'h1',
                'render_type' => 'none',
            ]
        );
		
        $this->add_responsive_control(
            'accordions_gap',
            [
                'label'           => esc_html__('Accordion Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type'            => Controls_Manager::SLIDER,
                'size_units'      => [ 'px', '%', 'em', 'rem' ],
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
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors'       => [
                    '{{WRAPPER}} .pea-advanced-accordion-inner-wrapper' => 'gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'accordion_items_icon_section',
			array(
				'label' => esc_html__( 'Accordion Items Icons', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			)
		);
				
			$this->add_control(
				'show_accordion_icon',
				[
					'label' => esc_html__('Show icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'return_value' => 'yes',
					'default' => 'yes',
                    'render_type' => 'none',
				]
			);

			$this->add_control(
				'accordion_image_or_icon_position',
				[
					'label'       => esc_html__( 'Icon / image Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'row',
					'options'     => [
						'row'      => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'row-reverse'      => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					],
                    'selectors' => [
                        '{{WRAPPER}} .pea-accordion-item-title-wrapper' => 'flex-direction: {{VALUE}};',
                    ],
					'condition' => [
						'show_accordion_icon' => 'yes',
					],
				]
			);

            $this->add_control( 'open_icon_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

            $this->add_control(
                'open_icon_or_image_heading',
                [
                    'label' => esc_html__( 'Open Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
					'condition' => [
						'show_accordion_icon' => 'yes',
					],
                ]
            );

			$this->add_control(
				'accordion_open_choose_icon_or_img',
				[
					'label' => esc_html__('Choose Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'icon',
					'options' => [
						// 'none' => [
						// 	'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
						// 	'icon' => 'eicon-ban',
						// ],
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
                    'render_type' => 'none',
					'condition' => [
						'show_accordion_icon' => 'yes',
					],
				]
			);

			$this->add_control(
				'accordion_open_item_icon',
				[
					'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'fa-solid',
                    ],
                    'render_type' => 'none',
					'condition' => [
						'show_accordion_icon' => 'yes',
						'accordion_open_choose_icon_or_img' => 'icon',
					],
				]
			);

            $this->add_control(
                'accordion_open_image',
                [
                    'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'skin' => 'inline',
                    'dynamic' => [
                        'active' => true,
                    ],
                    'render_type' => 'none',
                    'condition' => [
						'show_accordion_icon' => 'yes',
                        'accordion_open_choose_icon_or_img' => 'image'
                    ]
                ]
            );

            $this->add_control( 'close_icon_hr', [ 'type' => Controls_Manager::DIVIDER, 'condition' => [ 'show_accordion_icon' => 'yes']]);

            $this->add_control(
                'close_icon_or_image_heading',
                [
                    'label' => esc_html__( 'Close Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
					'condition' => [
						'show_accordion_icon' => 'yes',
					],
                ]
            );

			$this->add_control(
				'accordion_close_choose_icon_or_img',
				[
					'label' => esc_html__('Choose Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'icon',
					'options' => [
						// 'none' => [
						// 	'title' => esc_html__('None', 'unlimited-elementor-inner-sections-by-boomdevs'),
						// 	'icon' => 'eicon-ban',
						// ],
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
                    'render_type' => 'none',
					'condition' => [
						'show_accordion_icon' => 'yes',
					],
				]
			);

			$this->add_control(
				'accordion_close_item_icon',
				[
					'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-down',
                        'library' => 'fa-solid',
                    ],
                    'render_type' => 'none',
					'condition' => [
						'show_accordion_icon' => 'yes',
						'accordion_close_choose_icon_or_img' => 'icon',
					],
				]
			);

            $this->add_control(
                'accordion_close_image',
                [
                    'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'skin' => 'inline',
                    'dynamic' => [
                        'active' => true,
                    ],
                    'render_type' => 'none',
                    'condition' => [
						'show_accordion_icon' => 'yes',
                        'accordion_close_choose_icon_or_img' => 'image'
                    ]
                ]
            );

		$this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================

        // Accordion Item Icon Styling Controls
        $this->start_controls_section(
            'accordion_item_icon_n_image_styling',
            [
                'label' => esc_html__('Item Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_accordion_icon' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'accordion_item_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
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
                        'size' => 22,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-accordion-tab-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-accordion-tab-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-accordion-expanded-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-accordion-expanded-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'accordion_item_icon_n_image_tabs' );
				$this->start_controls_tab(
					'accordion_item_icon_n_image_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
			
					$this->add_control(
						'accordion_item_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '#000',
							'selectors' => [
								'{{WRAPPER}} .pea-accordion-tab-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-accordion-tab-icon svg' => 'fill: {{VALUE}};',
								'{{WRAPPER}} .pea-accordion-expanded-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-accordion-expanded-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'accordion_item_icon_n_image_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
			
					$this->add_control(
						'accordion_item_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '#fff',
							'selectors' => [
								'{{WRAPPER}} .pea-advanced-accordion-item:hover .pea-accordion-tab-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-advanced-accordion-item:hover .pea-accordion-tab-icon svg' => 'fill: {{VALUE}};',
								'{{WRAPPER}} .pea-advanced-accordion-item:hover .pea-accordion-expanded-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-advanced-accordion-item:hover .pea-accordion-expanded-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();
        $this->end_controls_section();
        
        // Accordion Item Title Styling Controls
        $this->start_controls_section(
            'accordion_item_title_styling', 
            [
                'label' => esc_html__('Item Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  
            
            $this->add_responsive_control(
                'accordion_item_title_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-start-h',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-center-h',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-end-h',
                        ],
                        'space-between' => [
                            'title' => esc_html__('Space Between', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-justify-space-between-h',
                        ],
                    ],
                    'default' => 'space-between',
                    'selectors' => [
                        '{{WRAPPER}} .pea-accordion-item-title-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                    'render_type'  => 'ui',
                ]
            );  
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'accordion_item_title_typography',
                    'selector' => '{{WRAPPER}} .pea-accordion-title',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '700',
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

            $this->start_controls_tabs( 'accordion_item_title_tabs' );
                $this->start_controls_tab(
                    'accordion_item_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'accordion_item_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#000',
                            'selectors' => [
                                '{{WRAPPER}} .pea-accordion-title' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'accordion_item_title_bg_type_popover_toggle',
                        [
                            'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'none',
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Background::get_type(),
                            [
                                'name'      => 'accordion_item_title_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                                'exclude'        => [ 'image' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '#ebf5ff', // ✅ Set your default normal color here
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-accordion-item-title-wrapper',
                            ]
                        );
                    $this->end_popover();

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'accordion_item_title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-accordion-item-title-wrapper',
                        ]
                    );

                     $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'accordion_item_title_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    	    'selector' => '{{WRAPPER}} .pea-advanced-accordion-item',
                        ]
                    ); 

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'accordion_item_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'accordion_item_title_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-accordion-item:hover .pea-accordion-title' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'accordion_item_title_hover_bg_type_popover_toggle',
                        [
                            'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'none',
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Background::get_type(),
                            [
                                'name'      => 'accordion_item_title_hover_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                                'exclude'        => [ 'image' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '#399cff', // ✅ Set your default normal color here
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}}  .pea-advanced-accordion-item:hover .pea-accordion-item-title-wrapper',
                            ]
                        );
                    $this->end_popover();
                
                    $this->add_control(
                        'accordion_item_title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-advanced-accordion-item:hover .pea-accordion-item-title-wrapper' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                     $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'accordion_item_title_hover_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    	    'selector' => '{{WRAPPER}} .pea-advanced-accordion-item:hover',
                        ]
                    ); 

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control( 'accordion_item_title_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

            $this->add_responsive_control(
                'accordion_item_title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 16,
                        'right' => 16,
                        'bottom' => 16,
                        'left' => 16,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-accordion-item-title-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'accordion_item_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 24,
                        'right' => 24,
                        'bottom' => 24,
                        'left' => 24,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-accordion-item-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		
            $this->add_responsive_control(
                'accordion_item_title_spacing',
                [
                    'label'           => esc_html__('Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
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
                    'default' => [
                        'size' => 20,
                        'unit' => 'px',
                    ],
                    'separator' => 'before',
                    'selectors'       => [
                        '{{WRAPPER}} .pea-accordion-title-inner' => 'gap: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_control(
                'accordion_item_title_prefix_heading',
                [
                    'label' => esc_html__( 'Title Prefix', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
    
            $this->add_responsive_control(
                'accordion_item_title_prefix_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
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
                        'size' => 22,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-accordion-title-prefix' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-accordion-title-prefix i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_control(
                'accordion_item_title_suffix_heading',
                [
                    'label' => esc_html__( 'Title Suffix', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
    
            $this->add_responsive_control(
                'accordion_item_title_suffix_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
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
                        'size' => 22,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-accordion-title-suffix' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-accordion-title-suffix i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            // $this->add_responsive_control(
            //     'accordion_item_title_margin',
            //     [
            //         'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-cta-btn-two-wrapper .pea-cta-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );
        $this->end_controls_section();

        
        
        // Accordion Item Content Styling Controls
		$this->start_controls_section(
			'accordion_item_content_styling',
			[
				'label' => esc_html__( 'Item Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
            $this->start_controls_tabs( 'accordion_item_content_tabs' );
                $this->start_controls_tab(
                    'accordion_item_content_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'accordion_item_content_bg_type_popover_toggle',
                        [
                            'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'none',
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Background::get_type(),
                            [
                                'name'      => 'accordion_item_content_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                                'exclude'        => [ 'image' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '', // ✅ Set your default normal color here
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-advanced-accordion-item',
                            ]
                        );
                    $this->end_popover();
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'accordion_item_content_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-advanced-accordion-item',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'accordion_item_content_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-advanced-accordion-item',
                        ]
                    ); 

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'accordion_item_content_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );      
                    $this->add_control(
                        'accordion_item_content_hover_bg_type_popover_toggle',
                        [
                            'label' => esc_html__( 'Background Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                            'label_off' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'label_on' => esc_html__( 'Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'separator' => 'none',
                        ]
                    );
                    $this->start_popover();
                        $this->add_group_control(
                            Group_Control_Background::get_type(),
                            [
                                'name'      => 'accordion_item_content_hover_bg_color',
                                'types'          => [ 'classic', 'gradient' ],
                                // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                                'exclude'        => [ 'image' ],
                                'fields_options' => [
                                    'background' => [
                                        'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                        'default' => 'classic',
                                    ],
                                    'color' => [
                                        'default' => '',
                                    ],
                                ],
                                'selector'  => '{{WRAPPER}} .pea-advanced-accordion-item:hover',
                            ]
                        );
                    $this->end_popover();

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'accordion_item_content_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}}  .pea-advanced-accordion-item:hover',
                        ]
                    );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'accordion_item_content_hover_shadow',
                        'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-advanced-accordion-item:hover',
                    ]
                ); 

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control( 'accordion_item_content_hr', [ 'type' => Controls_Manager::DIVIDER, ] );

            $this->add_responsive_control(
                'accordion_item_content_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 14,
                        'right' => 14,
                        'bottom' => 14,
                        'left' => 14,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-advanced-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            // $this->add_responsive_control(
            //     'accordion_item_content_padding',
            //     [
            //         'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-advanced-accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );

            // $this->add_responsive_control(
            //     'accordion_item_content_margin',
            //     [
            //         'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-advanced-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );   

		$this->end_controls_section();

	}

	protected function content_template_single_repeater_item() {
        ?>
        <#
        const elementUid = view.getIDInt().toString().substr( 0, 3 ),
            numOfAccordions = view.collection.length + 1,
            accordionCount = numOfAccordions,
            accordionItemKey = 'new-accordion-' + elementUid + accordionCount,
            accordionContentKey = 'new-accordion-content-' + elementUid + accordionCount;

        // Clear previous attributes for this key
        view._renderAttributes = view._renderAttributes || {};
        delete view._renderAttributes[accordionItemKey];

        var itemClass = 'pea-advanced-accordion-item elementor-repeater-item-' + data._id;

        view.addRenderAttribute( accordionItemKey, {
            'class': itemClass,
            'accordion-index': accordionCount,
            'role': 'group',
        } );
        
        view.addRenderAttribute( accordionContentKey, {
            'class': 'pea-accordion-content',
        } );
        #>
        <div {{{ view.getRenderAttributeString( accordionItemKey ) }}}>
            <div class="pea-accordion-item-title-wrapper">
                <div class="pea-accordion-title-inner">
                    <h4 class="pea-accordion-title">{{ data.accordion_title }}</h4>
                </div>
                <div class="pea-accordion-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                        <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path>
                    </svg>
                </div>
                <div class="pea-accordion-expanded-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"></path>
                    </svg>
                </div>
            </div>
            <div class="pea-accordion-content-wrapper" style="max-height: 0px;">
                <div {{{ view.getRenderAttributeString( accordionContentKey ) }}}></div>
            </div>
        </div>
        <?php
    }



	protected function render() {
        $settings = $this->get_settings_for_display();
        $this->num_of_accordion_items = count( $settings['accordion_items'] ?? array() );
        $accordions = $settings['accordion_items'];
        
        $this->add_render_attribute(
            array(
                'pea-advanced-accordion-wrapper' => array(
                    'class' => array( 'pea-widget-wrapper', 'pea-advanced-accordion-wrapper' ),
                ),
                'pea-advanced-accordion-container' => array(
                    'class' => 'pea-advanced-accordion-container',
                ),
                'pea-advanced-accordion-inner-wrapper' => array(
                    'class' => 'pea-advanced-accordion-inner-wrapper',
                ),
            )
        );
        ?>
        <div <?php $this->print_render_attribute_string( 'pea-advanced-accordion-wrapper' ); ?>>
            <div <?php $this->print_render_attribute_string( 'pea-advanced-accordion-container' ); ?>>
                <div <?php $this->print_render_attribute_string( 'pea-advanced-accordion-inner-wrapper' ); ?>>
                    <?php
                    foreach ( $accordions as $index => $accordion ) {
                        $accordion_count = $index + 1;
                        $accordion_item_key = $this->get_repeater_setting_key( 'accordion_item', 'accordion', $index );
                        $is_active = $accordion['default_open'] === 'yes' ? 'active' : '';
                        $this->add_render_attribute(
                            $accordion_item_key,
                            array(
                                'class' => 'pea-advanced-accordion-item elementor-repeater-item-'.esc_attr( $accordion['_id'] ),
                                'accordion-index' => $accordion_count,
                                'role' => 'group',
                            )
                        );
                        ?>
                        <div <?php $this->print_render_attribute_string( $accordion_item_key ); ?>>
                            <div class="pea-accordion-item-title-wrapper <?php echo esc_attr($is_active); ?>">
                                <div class="pea-accordion-title-inner">
                                    <?php if($accordion['accordion_item_title_prefix_choose_icon_or_img'] !== 'none'){ ?>
                                        <div class="pea-accordion-title-prefix">
                                            <?php if($accordion['accordion_item_title_prefix_choose_icon_or_img'] === 'icon'){ ?>
                                                <?php \Elementor\Icons_Manager::render_icon( $accordion['accordion_item_title_prefix_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            <?php }else if($accordion['accordion_item_title_prefix_choose_icon_or_img'] === 'image'){ $image_url = $accordion['accordion_item_title_prefix_image']['url']; ?> 
                                                <img src="<?php echo esc_url($image_url) ?>">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <<?php echo esc_attr($settings['accordion_item_title_tag']); ?> class="pea-accordion-title"><?php echo esc_html($accordion['accordion_title']); ?></<?php echo esc_attr($settings['accordion_item_title_tag']); ?>>
                                    <?php if($accordion['accordion_item_title_suffix_choose_icon_or_img'] !== 'none'){ ?>
                                        <div class="pea-accordion-title-suffix">
                                            <?php if($accordion['accordion_item_title_suffix_choose_icon_or_img'] === 'icon'){ ?>
                                                <?php \Elementor\Icons_Manager::render_icon( $accordion['accordion_item_title_suffix_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            <?php }else if($accordion['accordion_item_title_suffix_choose_icon_or_img'] === 'image'){ $image_url = $accordion['accordion_item_title_suffix_image']['url']; ?> 
                                                <img src="<?php echo esc_url($image_url) ?>">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if($settings['show_accordion_icon'] === 'yes'){ ?>
                                    <div class="pea-accordion-tab-icon">
                                        <?php if($settings['accordion_open_choose_icon_or_img'] === 'icon'){ ?>
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_open_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        <?php }else if($settings['accordion_open_choose_icon_or_img'] === 'image'){ $image_url = $settings['accordion_open_image']['url']; ?> 
                                            <img src="<?php echo esc_url($image_url) ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="pea-accordion-expanded-icon">
                                        <?php if($settings['accordion_close_choose_icon_or_img'] === 'icon'){ ?>
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_close_item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        <?php }else if($settings['accordion_close_choose_icon_or_img'] === 'image'){ $image_url = $settings['accordion_close_image']['url']; ?> 
                                            <img src="<?php echo esc_url($image_url) ?>">
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="pea-accordion-content-wrapper <?php echo esc_attr($is_active); ?>" >
                                <div class="pea-accordion-content">
                                    <?php $this->print_child( $index ); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

	protected function get_initial_config(): array {
		return array_merge(
			parent::get_initial_config(),
			array(
                'support_improved_repeaters' => true,
                'target_container'           => array( '.pea-advanced-accordion-inner-wrapper' ),
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
        <# if ( settings['accordion_items'] ) {     
            const elementUid = view.getIDInt().toString().substr( 0, 3 ),
                advancedAccordionWrapper = 'accordion-wrapper-' + elementUid,
                advancedAccordionContainer = 'accordion-container-' + elementUid,
                advancedAccordionInner = 'accordion-inner-' + elementUid,
                outsideWrapperClasses = ['pea-widget-wrapper','pea-advanced-accordion-wrapper'],
                MidWrapperClasses = ['pea-advanced-accordion-container'];

            view.addRenderAttribute( advancedAccordionWrapper, {
                'class': outsideWrapperClasses,                             
            } );

            view.addRenderAttribute( advancedAccordionContainer, {
                'class': MidWrapperClasses,
            } );

            view.addRenderAttribute( advancedAccordionInner, {
                'class': 'pea-advanced-accordion-inner-wrapper',
            } );

            #>
            <div {{{ view.getRenderAttributeString( advancedAccordionWrapper ) }}}>
                <div {{{ view.getRenderAttributeString( advancedAccordionContainer ) }}}>
                    <div {{{ view.getRenderAttributeString( advancedAccordionInner ) }}}>
                        <# _.each( settings['accordion_items'], function( accordion, index ) {
                            const accordionCount = index + 1,
                                accordionUid = elementUid + accordionCount,
                                accordionItemKey = 'accordion-item-' + accordionUid,
                                accordionContentKey = 'accordion-content-' + accordionUid;
                                
                            // Clear previous attributes for this key
                            view._renderAttributes = view._renderAttributes || {};
                            delete view._renderAttributes[accordionItemKey];
                            var itemClass = 'pea-advanced-accordion-item elementor-repeater-item-' + accordion._id;

                            view.addRenderAttribute( accordionItemKey, {
                                'class': itemClass,
                                'accordion-index': accordionCount,
                                'role': 'group',
                            } );
                            
                            view.addRenderAttribute( accordionContentKey, {
                                'class': 'pea-accordion-content',
                            } ); #>

                            <div {{{ view.getRenderAttributeString( accordionItemKey ) }}}>
                                <div class="pea-accordion-item-title-wrapper">
                                    <div class="pea-accordion-title-inner">
                                        <# if ( accordion.accordion_item_title_prefix_choose_icon_or_img !== 'none' ) { #>
                                            <div class="pea-accordion-title-prefix">
                                                <# if ( accordion.accordion_item_title_prefix_choose_icon_or_img === 'icon' ) { #>
                                                    <# var prefixeIconHTML = elementor.helpers.renderIcon( view, accordion.accordion_item_title_prefix_item_icon, { 'aria-hidden': true }, 'i', 'object' );
                                                        if ( prefixeIconHTML && prefixeIconHTML.rendered ) { #>
                                                            {{{ prefixeIconHTML.value }}}
                                                        <# } 
                                                    #>
                                                <# } else if ( accordion.accordion_item_title_prefix_choose_icon_or_img === 'image' ) { 
                                                    var prefixImageUrl = accordion.accordion_item_title_prefix_image.url || ''; #>
                                                    <img src="{{{ prefixImageUrl }}}">
                                                <# } #>
                                            </div>
                                        <# } #>
                                        <{{ settings.accordion_item_title_tag }} 
                                            class="pea-accordion-title">
                                            {{{ accordion.accordion_title }}}
                                        </{{ settings.accordion_item_title_tag }}>
                                        <# if ( accordion.accordion_item_title_suffix_choose_icon_or_img !== 'none' ) { #>
                                            <div class="pea-accordion-title-suffix">
                                                <# if ( accordion.accordion_item_title_suffix_choose_icon_or_img === 'icon' ) { #>
                                                    <# var suffixeIconHTML = elementor.helpers.renderIcon( view, accordion.accordion_item_title_suffix_item_icon, { 'aria-hidden': true }, 'i', 'object' );
                                                        if ( suffixeIconHTML && suffixeIconHTML.rendered ) { #>
                                                            {{{ suffixeIconHTML.value }}}
                                                        <# } 
                                                    #>
                                                <# } else if ( accordion.accordion_item_title_suffix_choose_icon_or_img === 'image' ) { 
                                                    var suffixImageUrl = accordion.accordion_item_title_suffix_image.url || ''; #>
                                                    <img src="{{{ suffixImageUrl }}}">
                                                <# } #>
                                            </div>
                                        <# } #>
                                    </div>
                                    
                                    <# if ( settings.show_accordion_icon === 'yes' ) { #>
                                        <div class="pea-accordion-tab-icon">
                                            <# if ( settings.accordion_open_choose_icon_or_img === 'icon' ) { #>
                                                <# var iconHTML = elementor.helpers.renderIcon( view, settings.accordion_open_item_icon, { 'aria-hidden': true }, 'i', 'object' );
                                                    if ( iconHTML && iconHTML.rendered ) { #>
                                                        {{{ iconHTML.value }}}
                                                    <# } 
                                                #>
                                            <# } else if ( settings.accordion_open_choose_icon_or_img === 'image' ) { 
                                                var imageUrl = settings.accordion_open_image.url || ''; #>
                                                <img src="{{{ imageUrl }}}">
                                            <# } #>
                                        </div>
                                        <div class="pea-accordion-expanded-icon">
                                            <# if ( settings.accordion_close_choose_icon_or_img === 'icon' ) { #>
                                                <# var iconHTML = elementor.helpers.renderIcon( view, settings.accordion_close_item_icon, { 'aria-hidden': true }, 'i', 'object' );
                                                    if ( iconHTML && iconHTML.rendered ) { #>
                                                        {{{ iconHTML.value }}}
                                                    <# } 
                                                #>
                                            <# } else if ( settings.accordion_close_choose_icon_or_img === 'image' ) { 
                                                var imageUrl = settings.accordion_close_image.url || ''; #>
                                                <img src="{{{ imageUrl }}}">
                                            <# } #>
                                        </div>
                                    <# } #>
                                </div>
                                <div class="pea-accordion-content-wrapper">
                                    <div {{{ view.getRenderAttributeString( accordionContentKey ) }}}></div>
                                </div>
                            </div>
                        <# } ); #>
                    </div>      
                </div>                  
            </div>  
        <# } #>
        <?php
    }

}
