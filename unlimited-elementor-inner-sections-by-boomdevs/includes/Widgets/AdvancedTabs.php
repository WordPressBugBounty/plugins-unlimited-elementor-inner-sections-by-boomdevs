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
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AdvancedTabs extends Widget_Nested_Base {

	private $tab_item_settings = [];

	public function get_name() {
		return 'pea_advanced_tabs';
	}

	public function get_title() {
		return esc_html__( 'Advanced Tabs', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	public function get_categories() {
		return array( 'prime-elementor-addons' );
	}

	public function get_icon() {
		return 'pea_advanced_tabs_icon';
	}

	public function get_keywords() {
		return array( 'Tabs', 'Nested', 'Toggle', 'Content' );
	}

	// TODO: Replace this check with `is_active_feature` on 3.28.0 to support is_active_feature second parameter.
	public function show_in_panel() {
		return Plugin::$instance->experiments->is_feature_active( 'nested-elements' ) && Plugin::$instance->experiments->is_feature_active( 'container' );
	}

	public function has_widget_inner_wrapper(): bool {
		return ! Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

	public function get_style_depends(): array {
		return ['prime-elementor-addons--advanced-tabs'];
	}

	public function get_script_depends(): array {
		return ['prime-elementor-addons--advanced-tabs'];
	}

	protected function get_default_children_elements() {
		return array(
			array(
				'elType'   => 'container',
				'settings' => array(
					'_title' => __( 'Tab #1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'content_width' => 'full',
				),
			),
			array(
				'elType'   => 'container',
				'settings' => array(
					'_title' => __( 'Tab #2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'content_width' => 'full',
				),
			),
			array(
				'elType'   => 'container',
				'settings' => array(
					'_title' => __( 'Tab #3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'content_width' => 'full',
				),
			),
		);
	}

	protected function get_default_repeater_title_setting_key() {
		return 'tab_title';
	}

	protected function get_default_children_title() {
        /* translators: %d: Tab number */
		return esc_html__( 'Tab %d', 'unlimited-elementor-inner-sections-by-boomdevs' );
	}

	protected function get_default_children_placeholder_selector() {
		return '.pea-tabs-body-wrap';
	}

	protected function get_default_children_container_placeholder_selector() {
		return '.pea-tabs-item-wrapper';
	}

	protected function register_controls() {

		// =====================
		// CONTENT TAB - Tabs Items
		// =====================

		$this->start_controls_section(
			'tabs_items_section',
			array(
				'label' => esc_html__( 'Tabs Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			)
		);
				
        $this->add_control(
            'show_icon_or_image',
            [
                'label' => esc_html__('Show Icon Or Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'no',
                // 'render_type' => 'none',
            ]
        );
				
        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
                // 'render_type' => 'none',
            ]
        );
				
        $this->add_control(
            'show_description',
            [
                'label' => esc_html__('Show Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'no',
                // 'render_type' => 'none',
            ]
        );
				
        $this->add_control(
            'fill_title_wrapper',
            [
                'label' => esc_html__('Fill Title Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'no',
                // 'render_type' => 'none',
            ]
        );

        $this->add_control(
            'flex_css',
            [
                'label' => esc_html__('flex_wrap css', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HIDDEN,
                'default' => '1',
                'selectors' => [
                    '{{WRAPPER}} .pea-tab' => 'flex: {{VALUE}};',
                ],
                'condition' => [
                    'fill_title_wrapper' => 'yes',
                ],
            ]
        );


		$this->add_control(
			'tabs_orientation',
			[
				'label'       => esc_html__( 'Layout', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'horizontal',
				'options'     => [
					'horizontal' => esc_html__( 'Horizontal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'vertical'   => esc_html__( 'Vertical', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'placeholder' => esc_html__( 'Tab Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'tab_desc',
			array(
				'label'       => esc_html__( 'Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'placeholder' => esc_html__( 'Tab Description', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);

        $repeater->add_control(
            'tab_choose_icon_or_img',
            [
                'label' => esc_html__('Choose Icon / Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'icon',
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
                // 'render_type' => 'none',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_icon',
            [
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-image',
                    'library' => 'fa-solid',
                ],
                // 'render_type' => 'none',
                'condition' => [
                    'tab_choose_icon_or_img' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'tab_image',
            [
                'label' => esc_html__( 'Choose Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'skin' => 'inline',
                'dynamic' => [
                    'active' => true,
                ],
                // 'render_type' => 'none',
                'condition' => [
                    'tab_choose_icon_or_img' => 'image',
                ],
            ]
        );

		$repeater->add_control(
			'element_css_id',
			[
				'label' => esc_html__( 'CSS ID', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'ai' => [
					'active' => false,
				],
				'dynamic' => [
					'active' => true,
				],
				'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'unlimited-elementor-inner-sections-by-boomdevs' ),
			]
		);

		$this->add_control(
			'tabs_items',
			array(
				'label'       => esc_html__( 'Tabs Items', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type'        => Control_Nested_Repeater::CONTROL_TYPE,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title' => esc_html__( 'Tab 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'tab_desc' => esc_html__( 'Tab Description 1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'tab_choose_icon_or_img' => 'icon',
                        'tab_icon' => [
                            'value' => 'fas fa-icons',
                            'library' => 'fa-solid'
                        ],
					),
					array(
						'tab_title' => esc_html__( 'Tab 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'tab_desc' => esc_html__( 'Tab Description 2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'tab_choose_icon_or_img' => 'icon',
                        'tab_icon' => [
                            'value' => 'fas fa-trophy',
                            'library' => 'fa-solid'
                        ],
					),
					array(
						'tab_title' => esc_html__( 'Tab 3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'tab_desc' => esc_html__( 'Tab Description 3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'tab_choose_icon_or_img' => 'icon',
                        'tab_icon' => [
                            'value' => 'fas fa-crown',
                            'library' => 'fa-solid'
                        ],
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->add_control( 'tabs_items_hr', [ 'type' => Controls_Manager::DIVIDER, ] );
        
        $this->add_control(
            'tab_title_tag',
            [
                'label' => esc_html__('Title Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                'default' => 'span',
                // 'render_type' => 'none',
            ]
        );
        
        $this->add_control(
            'tab_desc_tag',
            [
                'label' => esc_html__('Description Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                'default' => 'p',
                // 'render_type' => 'none',
            ]
        );

		$this->add_control(
			'default_active_tab',
			[
				'label' => esc_html__( 'Default Active Tab', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 1,
			]
		);

		$this->add_control(
			'tab_title_alignment',
			[
				'label' => esc_html__( 'Tab Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .pea-tabs-panel' => 'justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'left' => 'flex-start',
					'center' => 'center',
					'right' => 'flex-end',
				],
			]
		);

		$this->end_controls_section();

		// =====================
		// STYLE TAB - Tab Panel
		// =====================         

        // Tab Wrapper Styling Controls
		$this->start_controls_section(
			'tab_wrapper_styling',
			[
				'label' => esc_html__( 'Tabs Wrapper', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
            $this->add_responsive_control(
                'tabs_gap',
                [
                    'label'           => esc_html__('Tabs Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        '{{WRAPPER}} .pea-tabs-panel' => 'gap: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->start_controls_tabs( 'tab_wrapper_tabs' );

                $this->start_controls_tab(
                    'tab_wrapper_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'tab_wrapper_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-tabs-panel',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tab_wrapper_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-tabs-panel',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 0,
                                        'right' => 0,
                                        'bottom' => 1,
                                        'left' => 0,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#eeedf0',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tab_wrapper_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'tab_wrapper_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-tabs-panel:hover',
                        ]
                    );

                    $this->add_control(
                        'tab_wrapper_hover_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-panel' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'tab_wrapper_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tab_wrapper_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'tab_wrapper_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_wrapper_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-panel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();

		$this->start_controls_section(
			'tab_styling',
			[
				'label' => esc_html__( 'Tabs', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            
            $this->add_control(
                'icon_position',
                [
                    'label' => esc_html__('Tab Inner Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'column-reverse' => [
                            'title' => esc_html__('Top', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'row' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-right',
                        ],
                        'column' => [
                            'title' => esc_html__('Bottom', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'row-reverse' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-h-align-left',
                        ],
                    ],
                    'default' => 'row-reverse',
                    'selectors' => [
                        '{{WRAPPER}} .pea-tab' => 'flex-direction: {{VALUE}};',
                    ],
                    'render_type'  => 'template',
                ]
            );

            $this->add_control(
                'tab_content_top_bottom_alignment',
                [
                    'label' => esc_html__( 'Tab Inner Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-tab' => 'align-items: {{VALUE}};',
                    ],
                    'condition' => [
                        'icon_position' => ['column', 'column-reverse'],
                    ],
                ]
            );

            $this->add_control(
                'tab_content_left_right_alignment',
                [
                    'label' => esc_html__( 'Tab Inner Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .pea-tab' => 'justify-content: {{VALUE}};',
                    ],
                    'condition' => [
                        'icon_position' => ['row', 'row-reverse'],
                    ],
                ]
            );
		
            $this->add_responsive_control(
                'tab_min_width',
                [
                    'label'           => esc_html__('Tab Min Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type'            => Controls_Manager::SLIDER,
                    'size_units'      => [ 'px', '%', 'em', 'rem' ],
                    'range'           => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
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
                        '{{WRAPPER}} .pea-advanced-tabs-wrapper .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab' => 'min-width: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
		
            $this->add_responsive_control(
                'tab_inner_gap',
                [
                    'label'           => esc_html__('Tab Gab', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 10,
                        'unit' => 'px',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-tab' => 'gap: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->start_controls_tabs( 'tab_tabs' );
                $this->start_controls_tab(
                    'tab_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'tab_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-tab',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tab_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-tab',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 0,
                                        'right' => 0,
                                        'bottom' => 1,
                                        'left' => 0,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#fff',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tab_hover_style',
                    [
                        'label' => esc_html__( 'Hover / Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'tab_hover_bg_color',
                            'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
                            'exclude'        => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => '#fff', // ✅ Set your default normal color here
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} .pea-tab:hover, {{WRAPPER}} .pea-tab.pea-tabs-active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tab_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-tab:hover, {{WRAPPER}} .pea-tabs-active',
                            'fields_options' => [
                                'border' => [
                                    'default' => 'solid',
                                ],
                                'width' => [
                                    'default' => [
                                        'top' => 0,
                                        'right' => 0,
                                        'bottom' => 1,
                                        'left' => 0,
                                    ],
                                ],
                                'color' => [
                                    'default' => '#3991FF',
                                ],
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'tab_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tab_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_padding',
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
                        '{{WRAPPER}} .pea-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
        
        // Tab Title Styling Controls
        $this->start_controls_section(
            'tab_title_styling',
            [
                'label' => esc_html__('Tab Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'tab_title_typography',
                    'selector' => '{{WRAPPER}} .pea-tab-title',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Onest',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 100,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'tab_title_tabs' );
                $this->start_controls_tab(
                    'tab_title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'tab_title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tab_title_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-title',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tab_title_hover_style',
                    [
                        'label' => esc_html__( 'Hover / Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'tab_title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab.pea-tabs-active .pea-tab-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'tab_title_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-title' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab.pea-tabs-active .pea-tab-title' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'tab_title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tab_title_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_title_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'tab_title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Tab Description Styling Controls
        $this->start_controls_section(
            'tab_desc_styling',
            [
                'label' => esc_html__('Tab Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'tab_desc_typography',
                    'selector' => '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-description',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Onest',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 100,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'tab_desc_tabs' );
                $this->start_controls_tab(
                    'tab_desc_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'tab_desc_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tab_desc_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-description',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tab_desc_hover_style',
                    [
                        'label' => esc_html__( 'Hover / Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'tab_desc_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-description' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tabs-active .pea-tab-description' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'tab_desc_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-description' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tabs-active .pea-tab-description' => 'border-color: {{VALUE}}',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'tab_desc_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tab_desc_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_desc_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'tab_desc_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li .pea-tab-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Tab Icon Styling Controls
        $this->start_controls_section(
            'tab_icon_styling',
            [
                'label' => esc_html__('Tab Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'tab_icon_size',
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
                        'size' => 18,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-tab-icon-image-box .pea-tab-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-tab-icon-image-box .pea-tab-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'tab_icon_tabs' );
				$this->start_controls_tab(
					'tab_icon_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					$this->add_responsive_control(
						'tab_icon_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::SLIDER,
							'size_units' => ['deg'],
							'range' => [
								'px' => [
									'min' => -360,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => 0,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'tab_icon_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'tab_icon_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon',
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'tab_icon_border',
							'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
							'selector' => '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon',
						]
					); 

				$this->end_controls_tab();
				$this->start_controls_tab(
					'tab_icon_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					$this->add_responsive_control(
						'tab_icon_hover_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::SLIDER,
							'size_units' => ['deg'],
							'range' => [
								'px' => [
									'min' => -360,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => 0,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-icon' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);
			
					$this->add_control(
						'tab_icon_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-icon svg' => 'fill: {{VALUE}};',
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab.pea-tabs-active .pea-tab-icon i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab.pea-tabs-active .pea-tab-icon svg' => 'fill: {{VALUE}};',
							],
						]
					);
				
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'tab_icon_hover_bg_color',
							'types'          => [ 'classic', 'gradient' ],
                            // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- Elementor control config, not a WP_Query.
							'exclude'        => [ 'image' ],
							'fields_options' => [
								'background' => [
									'label'     => esc_html__( 'Background ', 'unlimited-elementor-inner-sections-by-boomdevs' ),
									'default' => 'classic',
								],
							],
							'selector'  => '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-icon, {{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab.pea-tabs-active .pea-tab-icon',
						]
					);
			
					$this->add_control(
						'tab_icon_hover_border_color',
						[
							'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-icon' => 'border-color: {{VALUE}}',
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab.pea-tabs-active .pea-tab-icon' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();   

            $this->add_control(
                'tab_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tab_icon_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_icon_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Icon Styling Controls
        $this->start_controls_section(
            'tab_image_styling',
            [
                'label' => esc_html__('Tab Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'tab_image_width',
                [
                    'label' => esc_html__('Image Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon-image' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'tab_image_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                        'size' => 24,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon-image' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'tab_image_tabs' );
				$this->start_controls_tab(
					'tab_image_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
				
					$this->add_responsive_control(
						'tab_image_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::SLIDER,
							'size_units' => ['deg'],
							'range' => [
								'px' => [
									'min' => -360,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => -40,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab .pea-tab-icon-image' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'tab_image_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
				
					$this->add_responsive_control(
						'tab_image_hover_rotate',
						[
							'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::SLIDER,
							'size_units' => ['deg'],
							'range' => [
								'px' => [
									'min' => -360,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => 0,
							],
							'selectors'       => [
								'{{WRAPPER}} .pea-tabs-wrap ul.pea-tabs-panel li.pea-tab:hover .pea-tab-icon-image' => 'transform: rotate({{SIZE}}deg);',
							],
						]
					);

				$this->end_controls_tab(); 
            $this->end_controls_tabs();  
        $this->end_controls_section();       

        // Tab Content Styling Controls
		$this->start_controls_section(
			'tab_content_styling',
			[
				'label' => esc_html__( 'Tabs Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'tab_content_tabs' );

                $this->start_controls_tab(
                    'tab_content_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'tab_content_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-tabs-item-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tab_content_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-tabs-item-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tab_content_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'tab_content_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-tabs-item-wrapper:hover',
                        ]
                    );

                    $this->add_control(
                        'tab_content_hover_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-tabs-item-wrapper' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'tab_content_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tab_content_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-item-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'tab_content_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-item-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_content_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-tabs-item-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tabs = $settings['tabs_items'];
		$widget_id = $this->get_id();
		$orientation = $settings['tabs_orientation'];
		$default_active = $settings['default_active_tab'];

		$this->add_render_attribute(
			'tabs-wrapper-'.$widget_id,
			[
				'class' => ['pea-widget-wrapper','pea-advanced-tabs-wrapper'],
			]
		);

		$this->add_render_attribute(
			'tabs_wrap',
			[
				'class' => ['pea-tabs-wrap', $orientation],
				'id' => 'pea-tabs-' . $widget_id,
				'data-tab-active' => $default_active,
			]
		);
		?>
		<div <?php $this->print_render_attribute_string( 'tabs-wrapper-'.$widget_id ); ?>>
            <div <?php $this->print_render_attribute_string( 'tabs_wrap' ); ?>>
                <ul class="pea-tabs-panel" role="tablist">
                    <?php
                    foreach ( $tabs as $index => $tab ) {
                        $tab_count = $index;
                        $tab_title_id = 'pea-tabs-tab-' . $widget_id . '-' . $tab_count;
                        $tab_content_id = 'pea-tabs-body-' . $widget_id;
                        $is_active = ( $tab_count === (int) $default_active ) ? 'pea-tabs-active' : '';
                        $aria_selected = ( $tab_count === (int) $default_active ) ? 'true' : 'false';
                        $tabindex = ( $tab_count === (int) $default_active ) ? '0' : '-1';

                        $tab_id = ! empty( $tab['element_css_id'] ) ? $tab['element_css_id'] : $tab_title_id;

                        $tab_key = $this->get_repeater_setting_key( 'tab', 'tabs_items', $index );

                        $this->add_render_attribute(
                            $tab_key,
                            [
                                'class' => ['pea-tab', $is_active, $orientation],
                                'role' => 'tab',
                                'id' => $tab_id,
                                'aria-selected' => $aria_selected,
                                'aria-controls' => $tab_content_id,
                                'tabindex' => $tabindex,
                                'data-tab' => $tab_count,
                                'aria-label' => esc_attr( $tab['tab_title'] ),
                            ]
                        );

                        // Store tab settings for content rendering
                        $this->tab_item_settings[] = [
                            'index' => $index,
                            'tab_count' => $tab_count,
                            'tab_id' => $tab_id,
                            'tab_title_id' => $tab_title_id,
                            'item' => $tab,
                        ];
                        ?>
                        <li <?php $this->print_render_attribute_string( $tab_key ); ?>>
                            <?php if($settings['show_description'] === 'yes' && ( $settings['icon_position'] === 'column-reverse' || $settings['icon_position'] === 'row-reverse' )){ ?>
                                <<?php echo esc_attr($settings['tab_desc_tag']); ?> class="pea-tab-description">
                                    <?php echo esc_html( $tab['tab_desc'] ); ?>
                                </<?php echo esc_attr($settings['tab_desc_tag']); ?>>
                            <?php } ?>
                            <?php if($settings['show_title'] === 'yes'){ ?>
                                <<?php echo esc_attr($settings['tab_title_tag']); ?> class="pea-tab-title">
                                    <?php echo esc_html( $tab['tab_title'] ); ?>
                                </<?php echo esc_attr($settings['tab_title_tag']); ?>>
                            <?php } ?>
                            <?php if($settings['show_description'] === 'yes' && ( $settings['icon_position'] === 'column' || $settings['icon_position'] === 'row' )){ ?>
                                <<?php echo esc_attr($settings['tab_desc_tag']); ?> class="pea-tab-description">
                                    <?php echo esc_html( $tab['tab_desc'] ); ?>
                                </<?php echo esc_attr($settings['tab_desc_tag']); ?>>
                            <?php } ?>
                            <?php if($settings['show_icon_or_image'] === 'yes' && $tab['tab_choose_icon_or_img'] !== 'none'){ ?>
                                <div class="pea-tab-icon-image-box">
                                    <?php if($tab['tab_choose_icon_or_img'] === 'icon'){ ?>
                                        <div class="pea-tab-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $tab['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php }else if($tab['tab_choose_icon_or_img'] === 'image'){ $image_url = $tab['tab_image']['url']; ?> 
                                        <div class="pea-tab-icon-image">
                                            <img src="<?php echo esc_url($image_url) ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="pea-tabs-body-wrap" id="pea-tabs-body-<?php echo esc_attr( $widget_id ); ?>">
                    <?php
                        foreach ( $tabs as $index => $tab ) {
                            $this->render_tab_content( $index );
                        }
                    ?>
                </div>
            </div>
        </div>
		<?php
	}

	protected function render_tab_content( $index ) {
		$children = $this->get_children();
		$widget_id = $this->get_id();
		$tab_count = $index;
		$default_active = $this->get_settings_for_display('default_active_tab');
		$display_style = ( $tab_count === (int) $default_active ) ? 'block' : 'none';

		$tab_panel_id = 'pea-tabs-panel' . $tab_count;
		$tab_title_id = 'pea-tabs-tab' . $tab_count;
		$item_wrapper_key = 'tab_item_wrapper_' . $index;

		$this->add_render_attribute(
			$item_wrapper_key,
			[
				'id' => 'pea-tabs-' . $widget_id,
				'class' => ['pea-tabs-item-wrapper', 'pea-tabs-' . $widget_id],
			]
		);

		?>
		<div <?php $this->print_render_attribute_string( $item_wrapper_key ); ?>>
            <?php
                if ( isset( $children[ $index ] ) ) {
                    $children[ $index ]->print_element();
                }
            ?>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<#
		const elementUid = view.getIDInt().toString(),
            wrapper = 'tabs-wrapper-' + elementUid,
			orientation = settings.tabs_orientation,
			defaultActive = settings.default_active_tab;

        view.addRenderAttribute( wrapper, {
            'class': ['pea-widget-wrapper','pea-advanced-tabs-wrapper'],                             
        } );

		view.addRenderAttribute( 'tabs_wrap', {
			'class': ['pea-tabs-wrap', orientation],
			'id': 'pea-tabs-' + elementUid,
			'data-tab-active': defaultActive
		});
		#>
		<div {{{ view.getRenderAttributeString( wrapper ) }}}>
            <div {{{ view.getRenderAttributeString( 'tabs_wrap' ) }}}>
                <# if ( settings.tabs_items ) { #>
                    <ul class="pea-tabs-panel" role="tablist">
                        <# _.each( settings.tabs_items, function( tab, index ) {
                            const tabCount = index + 1,
                                tabTitleId = 'pea-tabs-tab-' + elementUid + '-' + tabCount,
                                tabContentId = 'pea-tabs-body-' + elementUid,
                                isActive = ( tabCount === parseInt(defaultActive) ) ? 'pea-tabs-active' : '',
                                ariaSelected = ( tabCount === parseInt(defaultActive) ) ? 'true' : 'false',
                                tabindex = ( tabCount === parseInt(defaultActive) ) ? '0' : '-1',
                                tabId = tab.element_css_id ? tab.element_css_id : tabTitleId;
                                #>
                            <li class="pea-tab {{ isActive }} elementor-repeater-item-{{ tab._id }}" 
                                role="tab" 
                                id="{{ tabId }}" 
                                aria-selected="{{ ariaSelected }}" 
                                aria-controls="{{ tabContentId }}" 
                                tabindex="{{ tabindex }}" 
                                data-tab="{{ tabCount }}" 
                                aria-label="{{ tab.tab_title }}">
                                <# if ( settings.show_description === 'yes' && (settings.icon_position === 'column-reverse' || settings.icon_position === 'row-reverse') ) { #>
                                    <{{ settings.tab_desc_tag }} class="pea-tab-description">
                                        {{{ tab.tab_desc }}}
                                    </{{ settings.tab_desc_tag }}>
                                <# } #>
                                <# if ( settings.show_title === 'yes' ) { #>
                                    <{{ settings.tab_title_tag }} class="pea-tab-title">
                                        {{{ tab.tab_title }}}
                                    </{{ settings.tab_title_tag }}>
                                <# } #>
                                <# if ( settings.show_description === 'yes' && (settings.icon_position === 'column' || settings.icon_position === 'row') ) { #>
                                    <{{ settings.tab_desc_tag }} class="pea-tab-description">
                                        {{{ tab.tab_desc }}}
                                    </{{ settings.tab_desc_tag }}>
                                <# } #>
                                <# if ( settings.show_icon_or_image === 'yes' && tab.tab_choose_icon_or_img !== 'none' ) { #>
                                    <div class="pea-tab-icon-image-box">
                                        <# if ( tab.tab_choose_icon_or_img === 'icon' ) { 
                                            var iconHTML = elementor.helpers.renderIcon( view, tab.tab_icon, { 'aria-hidden': true }, 'i', 'object' );
                                            if ( iconHTML && iconHTML.rendered ) { #>
                                                <div class="pea-tab-icon">
                                                    {{{ iconHTML.value }}}
                                                </div>
                                            <# }
                                        } else if ( tab.tab_choose_icon_or_img === 'image' ) { 
                                            var imageUrl = tab.tab_image.url || ''; #>
                                            <div class="pea-tab-icon-image">
                                                <img src="{{ imageUrl }}" alt="{{ tab.tab_title }}">
                                            </div>
                                        <# } #>
                                    </div>
                                <# } #>
                                
                            </li>
                        <# }); #>
                    </ul>
                    <div class="pea-tabs-body-wrap" id="pea-tabs-body-{{ elementUid }}">
                        
                        <# _.each( settings.tabs_items, function( tab, index ) {
                            const tabCount = index + 1,
                                tabUid = elementUid + tabCount,
                                tabItemKey = 'tab-item-' + tabUid,
                                tabContentKey = 'tab-content-' + tabUid;
                                
                                var itemClass = 'pea-tabs-item-wrapper elementor-repeater-item-' + tab._id;

                                view.addRenderAttribute( tabItemKey, {
                                    'class': itemClass,
                                    'tab-index': tabCount,
                                    'role': 'group',
                                } );
                                #>
                            <div {{{ view.getRenderAttributeString( tabItemKey ) }}}> </div>
                        <# }); #>
                    </div>
                <# } #>
            </div>
        </div>
		<?php
	}

	protected function content_template_single_repeater_item() {
        ?>
        <#
        const elementUid = view.getIDInt().toString(),
            tabIndex = view.collection.length,
            tabCount = tabIndex,
            itemWrapperKey = 'tab_item_wrapper_' + tabCount;

        view.addRenderAttribute( itemWrapperKey, {
            'class': 'pea-tabs-item-wrapper elementor-repeater-item-' + data._id
        });
        #>
        <div {{{ view.getRenderAttributeString( itemWrapperKey ) }}}></div>
        <?php
    }

	protected function get_initial_config(): array {
		return array_merge(
			parent::get_initial_config(),
			array(
				'support_improved_repeaters' => true,
				'target_container' => array( '.pea-tabs-body-wrap' ),
				'node' => 'div',
                'is_interlaced'              => true,
                'support_paste_all'          => true, // ADD THIS
                'container_settings'         => array(
                    'accepts' => array( 'container', 'widget', 'section' ), // ADD THIS
                ),
			)
		);
	}
}