<?php 

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\GradientTextControl;
use PrimeElementorAddons\Utils\TextStrokeControl;
use PrimeElementorAddons\Utils\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use PrimeElementorAddons\Traits\PostGridRenderer;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class PostGrid extends Widget_Base {
    use PostGridRenderer;
    
    public function get_name() {
        return 'pea_post_grid';
    }
    
    public function get_title() {
        return esc_html__('Post Grid', 'unlimited-elementor-inner-sections-by-boomdevs');
    }
    
    public function get_icon() {
        return 'pea_post_grid_icon';
    }
    
    public function get_categories() {
        return ['prime-elementor-addons'];
    }
    
    public function get_keywords() {
        return ['heading', 'title', 'text', 'advanced', 'gradient', 'stroke'];
    }
    
    public function get_style_depends() {
        return ['prime-elementor-addons--post-grid'];
    }

	public function get_script_depends() {
		return ['prime-elementor-addons--post-grid'];
	}
    
    protected function register_controls() {
        
        // =====================
        // CONTENT TAB
        // =====================
        
        // General Section
        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__('Presets', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'preset_styles',
                [
                    'label' => esc_html__('Preset Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => 'Preset 1',
                        'preset-2' => 'Preset 2',
                        'preset-3' => 'Preset 3',
                        'preset-4' => 'Preset 4',
                        'preset-5' => 'Preset 5',
                        'preset-6' => 'Preset 6',
                    ],
                    'default' => 'default',
                    'render_type'  => 'template',
                ]
            );

            $this->add_control(
                'element_visibility',
                [
                    'label' => esc_html__( 'Element Visibility', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            
            $this->add_control(
                'show_featured_image',
                [
                    'label' => esc_html__('Show Featured Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_title',
                [
                    'label' => esc_html__('Show Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_author',
                [
                    'label' => esc_html__('Show Author', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_author_image',
                [
                    'label' => esc_html__('Show Author Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_author' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_author_prefix',
                [
                    'label' => esc_html__('Show Author Prefix', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'show_author' => 'yes',
                    ],
                ]
            );
	
            $this->add_control(
                'author_prefix_text', [
                    'label' => esc_html__( 'Author Prefix', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Posted by' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'show_author' => 'yes',
                        'show_author_prefix' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_date',
                [
                    'label' => esc_html__('Show Date', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        
            $this->add_control(
                'author_position',
                [
                    'label' => esc_html__('Author & Date Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'after-image' => 'After Image',
                        'after-title' => 'After Title',
                        'after-desc' => 'After Description',
                    ],
                    'default' => 'after-image',
                    'label_block' => true,
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'show_author',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                            [
                                'name'     => 'show_date',
                                'operator' => '===',
                                'value'    => 'yes',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_control(
                'show_excerpt',
                [
                    'label' => esc_html__('Show Excerpt', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__('Show Category', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'show_tag',
                [
                    'label' => esc_html__('Show Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ] 
            );
            
            $this->add_control(
                'show_read_more',
                [
                    'label' => esc_html__('Show Read More Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'show_load_more',
                [
                    'label' => esc_html__('Show Load More Button', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'wrapper_link',
                [
                    'label' => esc_html__('Wrapper Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'description' => esc_html__('Makes the entire card linkable. Inner links are disabled automatically.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ]
            );
        
        $this->end_controls_section();
        
        // Query Section
        $this->start_controls_section(
            'query_section',
            [
                'label' => esc_html__('Query', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'post_type',
                [
                    'label' => esc_html__('Post Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'post' => 'Posts',
                        'page' => 'Pages',
                    ],
                    'default' => 'post',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'author',
                [
                    'label' => esc_html__( 'Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            $this->start_controls_tabs( 'author_query_tabs' );
                $this->start_controls_tab(
                    'author_include',
                    [
                        'label' => esc_html__( 'Include', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'author_include_ids',
                        [
                            'label'       => __( 'Include Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type'        => Controls_Manager::SELECT2,
                            'multiple'    => true,
                            'label_block' => true,
                            'options'     => [], // keep empty
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'author_exclude',
                    [
                        'label' => esc_html__( 'Exclude', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'author_exclude_ids',
                        [
                            'label' => esc_html__( 'Exclude Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SELECT2,
                            'multiple'    => true,
                            'label_block' => true,
                            'options'     => [], // keep empty
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'category',
                [
                    'label' => esc_html__( 'Category', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            $this->start_controls_tabs( 'category_query_tabs' );
                $this->start_controls_tab(
                    'category_include',
                    [
                        'label' => esc_html__( 'Include', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'category_include_ids',
                        [
                            'label' => esc_html__( 'Include Categories', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SELECT2,
                            'label_block' => true,
                            'multiple' => true,
                            'options'     => [], // keep empty
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'category_exclude',
                    [
                        'label' => esc_html__( 'Exclude', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'category_exclude_ids',
                        [
                            'label' => esc_html__( 'Exclude Categories', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SELECT2,
                            'label_block' => true,
                            'multiple' => true,
                            'options'     => [], // keep empty
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'tag',
                [
                    'label' => esc_html__( 'Tag', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            $this->start_controls_tabs( 'tag_query_tabs' );
                $this->start_controls_tab(
                    'tag_include',
                    [
                        'label' => esc_html__( 'Include', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'tag_include_ids',
                        [
                            'label' => esc_html__( 'Include Tags', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SELECT2,
                            'label_block' => true,
                            'multiple' => true,
                            'options'     => [], // keep empty
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'tag_exclude',
                    [
                        'label' => esc_html__( 'Exclude', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_control(
                        'tag_exclude_ids',
                        [
                            'label' => esc_html__( 'Exclude Tags', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'type' => Controls_Manager::SELECT2,
                            'label_block' => true,
                            'multiple' => true,
                            'options'     => [], // keep empty
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
            $this->add_control(
                'order_by',
                [
                    'label' => esc_html__('Order By', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'date' => 'Date',
                        'author' => 'Author',
                        'title' => 'Title',
                        'modified' => 'Last Modified',
                    ],
                    'default' => 'date',
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'sort_order',
                [
                    'label' => esc_html__('Sort Order', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'DESC' => 'DESC',
                        'ASC' => 'ASC',
                    ],
                    'default' => 'DESC',
                    'label_block' => true,
                ]
            );
            
            $this->add_responsive_control(
                'post_per_page',
                [
                    'label' => esc_html__('Post Per Page', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 9,
                    ],
                ]
            );  
            
            $this->add_control(
                'custom_permalink',
                [
                    'label' => esc_html__('Custom Permalink', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        
        $this->end_controls_section();
        
        // Post Switcher Section
        $this->start_controls_section(
            'post_switcher_section',
            [
                'label' => esc_html__('Post Switcher', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'post_card_style',
                [
                    'label' => esc_html__('Post Card Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'grid' => 'Grid',
                        'list' => 'List',
                    ],
                    'default' => 'grid',
                    'label_block' => true,
                ]
            );
            
            $this->add_responsive_control(
                'grid_column',
                [
                    'label' => esc_html__('Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'step' => 1,
                            'min' => 1,
                            'max' => 6,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 3,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-container.grid-layout' => 'grid-template-columns: repeat({{SIZE}},1fr)!important;',
                        '{{WRAPPER}} .pea-post-grid-container.grid-layout .pea_load_more_wrapper' => 'grid-column: span {{SIZE}};',
                        '{{WRAPPER}} .pea-post-grid-container.grid-layout .pea_pagination_wrapper' => 'grid-column: span {{SIZE}};',
                    ],
                    'condition' => [
                        'post_card_style' => 'grid',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'grid_row_gap',
                [
                    'label' => esc_html__('Row Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-container.grid-layout' => 'row-gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_card_style' => 'grid',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'grid_column_gap',
                [
                    'label' => esc_html__('Column Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-container.grid-layout' => 'column-gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_card_style' => 'grid',
                    ],
                ]
            );  
            
            $this->add_responsive_control(
                'list_column',
                [
                    'label' => esc_html__('Columns', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [
                        '' => [
                            'step' => 1,
                            'min' => 1,
                            'max' => 3,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 1,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-container.list-layout' => 'grid-template-columns: repeat({{SIZE}},1fr)!important;',
                        '{{WRAPPER}} .pea-post-grid-container.list-layout .pea_load_more_wrapper' => 'grid-column: span {{SIZE}}',
                        '{{WRAPPER}} .pea-post-grid-container.list-layout .pea_pagination_wrapper' => 'grid-column: span {{SIZE}}'
                    ],
                    'condition' => [
                        'post_card_style' => 'list',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'list_gap',
                [
                    'label' => esc_html__('list Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-container.list-layout' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_card_style' => 'list',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'list_image_spacing',
                [
                    'label' => esc_html__('Image Spacing', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-container.list-layout .pea-post-grid-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_card_style' => 'list',
                    ],
                ]
            ); 
        
        $this->end_controls_section();
        
        // Read More Section
        $this->start_controls_section(
            'read_more',
            [
                'label' => esc_html__('Read More', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'read_more_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-content-wrapper' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                ]
            );
	
            $this->add_control(
                'read_more_text', [
                    'label' => esc_html__( 'Button Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Learn More' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                ]
            );
                
            $this->add_control(
                'read_more_media_type',
                [
                    'label' => esc_html__('Media Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'none' => 'None',
                        'icon' => 'Icon',
                        'image' => 'Image',
                    ],
                    'default' => 'icon',
                ]
            );

            $this->add_control(
                'read_more_media_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-arrow-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'read_more_media_type' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'read_more_media_image',
                [
                    'label'   => esc_html__( 'Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \PrimeElementorAddons\Utils\Helper::pea_get_image_url(),
                    ],
                    'condition' => [
                        'read_more_media_type' => 'image',
                    ],
                ]
            );
        
            $this->add_control(
                'read_more_media_position',
                [
                    'label' => esc_html__('Position', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'right' => 'Right',
                        'left' => 'Left',
                    ],
                    'default' => 'right',
                ]
            );
        
        $this->end_controls_section();
        
        // Pagination Section
        $this->start_controls_section(
            'pagination',
            [
                'label' => esc_html__('Pagination', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_load_more' => 'yes',
                ],
            ]
        );
        
            $this->add_control(
                'pagination_type',
                [
                    'label' => esc_html__('Pagination Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'none' => 'None',
                        'load-more-button' => 'Load More Button',
                        'pagination' => 'Pagination',
                    ],
                    'default' => 'load-more-button',
                ]
            );
        
            $this->add_control(
                'type',
                [
                    'label' => esc_html__('Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'icon' => 'Icon',
                        'text' => 'Text',
                        // 'icon_text' => 'Icon + Text',
                    ],
                    'default' => 'icon',
                    'condition' => [
                        'pagination_type' => 'pagination',
                    ],
                ]
            );
	
            $this->add_control(
                'load_more_text', [
                    'label' => esc_html__( 'Load More Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Load More' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'pagination_type' => 'load-more-button',
                    ],
                ]
            );

            $this->add_control(
                'load_more_icon',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-right',
                        'library' => 'fa-solid',
                    ],
                    'label_block' => true,
                    'skin' => 'inline',
                    'condition' => [
                        'pagination_type' => 'load-more-button'
                    ]
                ]
            );
	
            $this->add_control(
                'prev_text', [
                    'label' => esc_html__( 'Prev Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Prev' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'pagination_type' => 'pagination', 
                        'type' => ['text']
                    ]
                ]
            );
	
            $this->add_control(
                'next_text', [
                    'label' => esc_html__( 'Next Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Next' , 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_block' => true,
                    'condition' => [
                        'pagination_type' => 'pagination', 
                        'type' => ['text']
                    ]
                ]
            );

            $this->add_control(
                'prev_icon',
                [
                    'label' => esc_html__( 'Prev Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-left',
                        'library' => 'fa-solid',
                    ],
                    'label_block' => true,
                    'condition' => [
                        'pagination_type' => 'pagination', 
                        'type' => ['icon']
                    ]
                ]
            );

            $this->add_control(
                'next_icon',
                [
                    'label' => esc_html__( 'Next Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-right',
                        'library' => 'fa-solid',
                    ],
                    'label_block' => true,
                    'condition' => [
                        'pagination_type' => 'pagination', 
                        'type' => ['icon']
                    ]
                ]
            );
        
        $this->end_controls_section();
        
        // =====================
        // STYLE TAB
        // =====================            

		$this->start_controls_section(
			'post_grid_styling',
			[
				'label' => esc_html__( 'Post Card', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'post_grid_tabs' );

                $this->start_controls_tab(
                    'post_grid_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'post_grid_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-post-grid-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'post_grid_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'post_grid_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'post_grid_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'post_grid_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-post-grid-wrapper:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'post_grid_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'post_grid_hover_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper:hover',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'post_grid_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'post_grid_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'post_grid_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_grid_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();            

		$this->start_controls_section(
			'post_content_styling',
			[
				'label' => esc_html__( 'Post Content', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->start_controls_tabs( 'post_content_tabs' );

                $this->start_controls_tab(
                    'post_content_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'post_content_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-post-grid-content-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'post_content_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-content-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'post_content_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-content-wrapper',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'post_content_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'post_content_hover_bg_color',
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
                            'selector'  => '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-content-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'post_content_hover_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-content-wrapper',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'post_content_hover_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-content-wrapper',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'post_content_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'post_content_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->add_responsive_control(
                'post_content_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_content_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();
        
        // Thumbnail Styling Controls
        $this->start_controls_section(
            'thumbnail_styling',
            [
                'label' => esc_html__('Image', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
            $this->add_control(
                'thumbnail_link',
                [
                    'label' => esc_html__('Thumbnail Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'name'      => 'thumbnail_size',
				    'default'   => 'large'
                ]
            );
            
            $this->add_responsive_control(
                'thumbnail_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px','em', 'rem','vh', 'vw'],
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
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-image img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'thumbnail_height',
                [
                    'label' => esc_html__('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px','em', 'rem','vh', 'vw'],
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
                        '{{WRAPPER}} .pea-post-grid-image img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'thumbnail_tabs' );

            $this->start_controls_tab(
                'thumbnail_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'thumbnail_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea-post-grid-image img',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'thumbnail_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                ]
            );
        
                $this->add_control(
                    'thumbnail_border_hover_color',
                    [
                        'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-image img' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );

            $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'thumbnail_border_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'thumbnail_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // $this->add_responsive_control(
            //     'thumbnail_margin',
            //     [
            //         'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::DIMENSIONS,
            //         'size_units' => [ 'px', '%', 'em' ],
            //         'selectors' => [
            //             '{{WRAPPER}} .pea-post-grid-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            //         ],
            //     ]
            // );
        
        $this->end_controls_section();
        
        // title Styling Controls
        $this->start_controls_section(
            'title_styling',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'title_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-title' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_control(
                'title_link',
                [
                    'label' => esc_html__('Title Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
                
            $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__('Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
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
                    'default' => 'h2',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .pea-post-title',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
                        ],
                        'font_weight' => [
                            'default' => '600',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 24,
                            ],
                        ],
                        'line_height' => [
                            'default' => [
                                'unit' => '%',
                                'size' => 130,
                            ],
                        ],
                    ],
                ]
            );

            $this->start_controls_tabs( 'title_tabs' );
                $this->start_controls_tab(
                    'title_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'title_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'title_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );

                    $this->add_control(
                        'title_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-title' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'title_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 24,
                        'right' => 0,
                        'bottom' => 16,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Description Styling Controls
        $this->start_controls_section(
            'description_styling',
            [
                'label' => esc_html__('Description', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'description_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-desc' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'excerpt_length',
                [
                    'label' => esc_html__('Excerpt Length', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [''],
                    'range' => [    
                        '' => [
                            'step' => 1,
                            'min' => 1,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => '',
                        'size' => 10,
                    ],
                ]
            );
                
            // $this->add_control(
            //     'description_tag',
            //     [
            //         'label' => esc_html__('Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::SELECT,
            //         'options' => [
            //             'h1' => 'H1',
            //             'h2' => 'H2',
            //             'h3' => 'H3',
            //             'h4' => 'H4',
            //             'h5' => 'H5',
            //             'h6' => 'H6',
            //             'div' => 'div',
            //             'span' => 'span',
            //             'p' => 'p',
            //         ],
            //         'default' => 'h2',
            //     ]
            // );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .pea-post-desc',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 18,
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

            $this->start_controls_tabs( 'description_tabs' );
                $this->start_controls_tab(
                    'description_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'description_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#555E72',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'description_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                    $this->add_control(
                        'description_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'description_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'description_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            ); 
        
        $this->end_controls_section();
        
        // Category Styling Controls
        $this->start_controls_section(
            'category_styling', 
            [
                'label' => esc_html__('Category', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );  
            
            $this->add_responsive_control(
                'category_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-categories' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_responsive_control(
                'category_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-categories' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'selector' => '{{WRAPPER}} .pea-post-grid-category-url',
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

            $this->start_controls_tabs( 'category_tabs' );
                $this->start_controls_tab(
                    'category_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'category_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-category-url' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'category_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#dddddd9e',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-category-url' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'category_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-category-url',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'category_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'category_hover_color',
                        [
                            'label' => esc_html__('Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-category-url' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'category_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-category-url' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'category_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-category-url' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'category_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'category_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 6,
                        'bottom' => 6,
                        'left' => 6,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-category-url' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'category_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 14,
                        'bottom' => 6,
                        'left' => 14,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-category-url' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'category_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 24,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Tag Styling Controls
        $this->start_controls_section(
            'tag_styling', 
            [
                'label' => esc_html__('Tag', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_tag' => 'yes',
                ],
            ]
        );  
            
            $this->add_responsive_control(
                'tag_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-tags' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tag_typography',
                    'selector' => '{{WRAPPER}} .pea-post-grid-tag-url',
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

            $this->start_controls_tabs( 'tag_tabs' );
                $this->start_controls_tab(
                    'tag_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'tag_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-tag-url' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'tag_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#dddddd9e',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-tag-url' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'tag_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-tag-url',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tag_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'tag_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-tag-url' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'tag_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-tag-url' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'tag_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-tag-url' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'tag_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'tag_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 6,
                        'bottom' => 6,
                        'left' => 6,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-tag-url' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tag_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 14,
                        'bottom' => 6,
                        'left' => 14,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-tag-url' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tag_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 24,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-tags' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        
        // Author Styling Controls
        $this->start_controls_section(
            'author_styling_section',
            [
                'label' => esc_html__('Author', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_author' => 'yes',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'author_alignment',
                [
                    'label' => esc_html__('Alignment', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__('Left', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'icon' => 'eicon-text-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-author' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'start',
                    'render_type'  => 'template',
                ]
            );
            
            $this->add_control(
                'author_link',
                [
                    'label' => esc_html__('Author Link', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_responsive_control(
                'author_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-author' => 'gap: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-post-grid-author-info' => 'gap: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-post-grid-author-info-name' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );   

            $this->add_responsive_control(
                'author_box_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 32,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'author_image_heading',
                [
                    'label' => esc_html__( 'Author Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            
            $this->add_responsive_control(
                'author_image_width',
                [
                    'label' => esc_html__('Author Image Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-author-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->start_controls_tabs( 'author_image_tabs' );
                $this->start_controls_tab(
                    'author_image_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'author_image_image_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-author-avatar',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'author_image_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'author_image_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-author-avatar' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_responsive_control(
                'author_image_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 50,
                        'right' => 50,
                        'bottom' => 50,
                        'left' => 50,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-author-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'author_image_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'author_heading',
                [
                    'label' => esc_html__( 'Author', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'author_typography',
                    'selector' => '{{WRAPPER}} .pea-post-grid-author-posted-by, {{WRAPPER}} .pea-post-grid-author-name, {{WRAPPER}} .pea-post-grid-author-name a',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
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

            $this->start_controls_tabs( 'author_tabs' );
                $this->start_controls_tab(
                    'author_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'author_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0D173B',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-author-posted-by' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-post-grid-author-name' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-post-grid-author-name a' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'author_prefix_color',
                        [
                            'label' => esc_html__('Prefix Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#0D173B',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-author-info-name .pea-post-grid-author-posted-by' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'author_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'author_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-author-posted-by' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-author-name' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-author-name a' => 'color: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'author_prefix_hover_color',
                        [
                            'label' => esc_html__('Prefix Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-author-info-name .pea-post-grid-author-posted-by' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        // Date Styling Controls
        $this->start_controls_section(
            'date_styling',
            [
                'label' => esc_html__('Date ', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'date_typography',
                    'selector' => '{{WRAPPER}} .pea-post-grid-date',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
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
            $this->start_controls_tabs( 'date_tabs' );
                $this->start_controls_tab(
                    'date_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'date_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-date' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'date_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'date_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-date' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
        $this->end_controls_section();
        
        // Read More Styling Controls
        $this->start_controls_section(
            'read_more_styling', 
            [
                'label' => esc_html__('Read More', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );  
            
            $this->add_responsive_control(
                'read_more_width',
                [
                    'label' => esc_html__('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => '',
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-read-more-button' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'read_more_media_gap',
                [
                    'label' => esc_html__('Gap', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 250,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-read-more-button' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'read_more_typography',
                    'selector' => '{{WRAPPER}} .pea-post-grid-read-more-text',
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
                    ],
                ]
            );

            $this->start_controls_tabs( 'read_more_tabs' );
                $this->start_controls_tab(
                    'read_more_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'read_more_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-read-more-text' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'read_more_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#DDDDDD9E',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-read-more-button' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'read_more_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-read-more-button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'read_more_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-read-more-button',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'read_more_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
            
                    $this->add_control(
                        'read_more_hover_color',
                        [
                            'label' => esc_html__(' Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-text' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
            
                    $this->add_control(
                        'read_more_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-button' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );
                
                    $this->add_control(
                        'read_more_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-button' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'read_more_hover_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-button',
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

            $this->add_control(
                'read_more_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'read_more_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 6,
                        'right' => 6,
                        'bottom' => 6,
                        'left' => 6,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-read-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'read_more_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 12,
                        'right' => 24,
                        'bottom' => 12,
                        'left' => 24,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-read-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'read_more_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 15,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-read-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
        
        // Read More Icon Styling Controls
        $this->start_controls_section(
            'read_more_icon_styling', 
            [
                'label' => esc_html__('Read More Icon', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_read_more' => 'yes',
                    'read_more_media_type' => 'icon',
                ],
            ]
        );
            
            $this->add_responsive_control(
                'read_more_icon_size',
                [
                    'label' => esc_html__('Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 250,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-read-more-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea-post-grid-read-more-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );   

            $this->start_controls_tabs( 'read_more_icon_tabs' );
                $this->start_controls_tab(
                    'read_more_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'read_more_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '#15171C',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-read-more-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-post-grid-read-more-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'read_more_icon_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-read-more-icon-wrapper' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'read_more_icon_border',
                            'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                            'selector' => '{{WRAPPER}} .pea-post-grid-read-more-icon-wrapper',
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_icon_border_radius',
                        [
                            'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-read-more-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
            
                    $this->add_responsive_control(
                        'read_more_icon_rotate',
                        [
                            'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
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
                                '{{WRAPPER}} .pea-post-grid-read-more-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'read_more_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                
                    $this->add_control(
                        'read_more_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'read_more_icon_hover_bg_color',
                        [
                            'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-icon-wrapper' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'read_more_icon_hover_border_color',
                        [
                            'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-icon-wrapper' => 'border-color: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_responsive_control(
                        'read_more_icon_hover_rotate',
                        [
                            'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
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
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-icon-wrapper' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 
			$this->add_control(
				'read_more_icon_hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'read_more_icon_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea-post-grid-read-more-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // Read More Image Styling Controls
		$this->start_controls_section(
			'read_more_image_styling',
			[
				'label' => esc_html__('Read More Button Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
                'condition' => [
                    'show_read_more' => 'yes',
                    'read_more_media_type' => 'image',
                ],
			]
		);
            
            $this->add_responsive_control(
                'read_more_image_width',
                [
                    'label' => esc_html__('Image Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 250,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-read-more-icon-image' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
            
            $this->add_responsive_control(
                'read_more_image_height',
                [
                    'label' => esc_html__('Image Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em', 'rem'],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 0,
                            'max' => 250,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .pea-post-grid-read-more-icon-image' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'read_more_image_tabs' );
                $this->start_controls_tab(
                    'read_more_image_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_responsive_control(
                        'read_more_image_rotate',
                        [
                            'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
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
                                '{{WRAPPER}} .pea-post-grid-read-more-icon-image' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'read_more_image_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
                    $this->add_responsive_control(
                        'read_more_image_hover_rotate',
                        [
                            'label' => esc_html__('Rotation', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
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
                                '{{WRAPPER}} .pea-post-grid-wrapper:hover .pea-post-grid-read-more-icon-image' => 'transform: rotate({{SIZE}}deg);',
                            ],
                        ]
                    );
                $this->end_controls_tab(); 
            $this->end_controls_tabs(); 

        $this->end_controls_section();
        
        // Load More Button Styling Controls
		$this->start_controls_section(
			'load_more_button_styling',
			[
				'label' => esc_html__('Load More Button', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab'   => Controls_Manager::TAB_STYLE, 
			]
		);
        
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'load_more_button_typography',
                    'selector' => '{{WRAPPER}} .pea_load_more',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Plus Jakarta Sans',
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
                                'size' => 130,
                            ],
                        ],
                    ],
                ]
            );
		
			$this->start_controls_tabs( 'load_more_button_tabs' );
				$this->start_controls_tab(
					'load_more_button_normal_style',
					[
						'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					]
				);
			
					$this->add_control(
						'load_more_button_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea_load_more' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'load_more_button_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea_load_more' => 'background-color: {{VALUE}};',
							],
						]
					);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'     => 'load_more_button_border_type',
							'label'    => esc_html__('Border Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'selector' => '{{WRAPPER}} .pea_load_more',
						]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'load_more_button_hover_style',
					[
						'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

					]
				);
			
					$this->add_control(
						'load_more_button_hover_color',
						[
							'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea_load_more:hover ' => 'color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'load_more_button_hover_bg_color',
						[
							'label' => esc_html__('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea_load_more:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
			
					$this->add_control(
						'load_more_button_hover_border_color',
						[
							'label' => esc_html__('border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{WRAPPER}} .pea_load_more:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs(); 

			$this->add_control(
				'load_more_button_hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

            $this->add_responsive_control(
                'load_more_button_border_radius',
                [
                    'label'     => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_load_more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'load_more_button_padding',
                [
                    'label'     => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 16,
                        'right' => 24,
                        'bottom' => 16,
                        'left' => 24,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_load_more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'load_more_button_margin',
                [
                    'label'     => esc_html__('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_load_more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'load_more_button_icon_heading',
                [
                    'label' => esc_html__( 'Icon', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            
            $this->add_responsive_control(
                'load_more_button_icon_size',
                [
                    'label' => esc_html__('Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
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
                        'size' => 25,
                    ],
                    'selectors'       => [
                        '{{WRAPPER}} .load_more_button_icon_wrap .load_more_button_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .load_more_button_icon_wrap .load_more_button_icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 

            $this->start_controls_tabs( 'load_more_button_icon_tabs' );
                $this->start_controls_tab(
                    'load_more_button_icon_normal_style',
                    [
                        'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ]
                );
            
                    $this->add_control(
                        'load_more_button_icon_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .load_more_button_icon_wrap .load_more_button_icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .load_more_button_icon_wrap .load_more_button_icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
            
                    $this->add_control(
                        'load_more_button_loader_icon_color',
                        [
                            'label' => esc_html__('Loader Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .load_more_button_icon_wrap .pea_load_more_outter_wrap i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .load_more_button_icon_wrap .pea_load_more_outter_wrap svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'load_more_button_icon_hover_style',
                    [
                        'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),

                    ]
                );
                
                    $this->add_control(
                        'load_more_button_icon_hover_color',
                        [
                            'label' => esc_html__('Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea_load_more:hover .load_more_button_icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea_load_more:hover .load_more_button_icon svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );
                
                    $this->add_control(
                        'load_more_button_loader_icon_hover_color',
                        [
                            'label' => esc_html__('Loader Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pea_load_more:hover .pea_load_more_outter_wrap i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pea_load_more:hover .pea_load_more_outter_wrap svg' => 'fill: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab(); 
            $this->end_controls_tabs();  

            $this->add_control(
                'load_more_button_icon_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'load_more_button_icon_margin',
                [
                    'label'     => esc_html__('Icon Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .load_more_button_icon_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
		$this->start_controls_section(
			'pagination_styling',
			[
				'label' => esc_html__( 'Pagination Icon / Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'pagination_type' => 'pagination',
				],
			]
		);

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'pagination_text_typography',
                    'selector' => '{{WRAPPER}} .pea_pagination_prev, {{WRAPPER}} .pea_pagination_next',
                    'condition' => [
                        'type' => 'text',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pagination_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],				
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_prev i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_prev svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_next i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_next svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );  

            $this->add_responsive_control(
                'pagination_prev_next_gap',
                [
                    'label' => esc_html__( 'gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],				
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pagination_text_width',
                [
                    'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 200,
                        ],
                    ],				
                    'default' => [
                        'unit' => 'px',
                        'size' => 44,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_prev ' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_next ' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'pagination_style_tabs' );

            $this->start_controls_tab(
                'pagination_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_control(
                    'pagination_color',
                    [
                        'label'  => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#555E72',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_prev' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_next' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_prev i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea_pagination_prev svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pea_pagination_next i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea_pagination_next svg' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'pagination_bg_color',
                    [
                        'label'  => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#fff',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_prev' => 'background-color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_next' => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'pagination_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea_pagination_prev, {{WRAPPER}} .pea_pagination_next',
                        'fields_options' => [
                            'border' => [
                                'default' => 'solid',
                            ],
                            'width' => [
                                'default' => [
                                    'top' => 1,
                                    'right' => 1,
                                    'bottom' => 1,
                                    'left' => 1,
                                ],
                            ],
                            'color' => [
                                'default' => '#E1E3E8',
                            ],
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'pagination_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_control(
                    'pagination_hover_color',
                    [
                        'label'  => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_prev:hover' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_next:hover' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_prev:hover i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea_pagination_prev:hover svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pea_pagination_next:hover i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pea_pagination_next:hover svg' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'pagination_hover_bg_color',
                    [
                        'label'  => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#15171C',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_prev:hover' => 'background-color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_next:hover' => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_control(
                    'pagination_hover_border_color',
                    [
                        'label'  => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#15171C',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_prev:hover' => 'border-color: {{VALUE}}',
                            '{{WRAPPER}} .pea_pagination_next:hover' => 'border-color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'pagination_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'top' => 6,
                        'right' => 6,
                        'bottom' => 6,
                        'left' => 6,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pagination_margin',
                [
                    'label' => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'pagination_padding',
                [
                    'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .pea_pagination_next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
		$this->start_controls_section(
			'pagination_numbers_styling',
			[
				'label' => esc_html__( 'Pagination Numbers', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'pagination_type' => 'pagination',
				],
			]
		);

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'pagination_number_typography',
                    'selector' => '{{WRAPPER}} .pea_pagination_number',
                    'fields_options' => [
                        'typography' => [
                            'default' => 'custom',
                        ],
                        'font_family' => [
                            'default' => 'Work Sans',
                        ],
                        'font_weight' => [
                            'default' => '400',
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => 18,
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

            $this->add_responsive_control(
                'pagination_numbers_width',
                [
                    'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 200,
                        ],
                    ],				
                    'default' => [
                        'unit' => 'px',
                        'size' => 44,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_number' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pagination_numbers_gap',
                [
                    'label' => esc_html__( 'Gap', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],				
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_numbers' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs( 'pagination_numbers_style_tabs' );

            $this->start_controls_tab(
                'pagination_numbers_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_control(
                    'pagination_numbers_color',
                    [
                        'label'  => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#15171C',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'pagination_numbers_bg_color',
                    [
                        'label'  => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#00000000',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number' => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'pagination_numbers_border',
                        'label'    => esc_html__( 'Border Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'selector' => '{{WRAPPER}} .pea_pagination_number',
                        'fields_options' => [
                            'border' => [
                                'default' => 'solid',
                            ],
                            'width' => [
                                'default' => [
                                    'top' => 1,
                                    'right' => 1,
                                    'bottom' => 1,
                                    'left' => 1,
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
                'pagination_numbers_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_control(
                    'pagination_numbers_hover_color',
                    [
                        'label'  => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'pagination_numbers_hover_bg_color',
                    [
                        'label'  => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number:hover' => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_control(
                    'pagination_numbers_hover_border_color',
                    [
                        'label'  => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number:hover' => 'border-color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'pagination_numbers_active_style',
                [
                    'label' => esc_html__( 'Active', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                ]
            );

                $this->add_control(
                    'pagination_numbers_active_color',
                    [
                        'label'  => esc_html__( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#FFFFFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number.active' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'pagination_numbers_active_bg_color',
                    [
                        'label'  => esc_html__( 'Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number.active' => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_control(
                    'pagination_numbers_active_border_color',
                    [
                        'label'  => esc_html__( 'Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#399CFF',
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number.active' => 'border-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_control(
                    'pagination_numbers_active_hover_color',
                    [
                        'label'  => esc_html__( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number.active:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'pagination_numbers_active_hover_bg_color',
                    [
                        'label'  => esc_html__( 'Hover Background Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number.active:hover' => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_control(
                    'pagination_numbers_active_hover_border_color',
                    [
                        'label'  => esc_html__( 'Hover Border Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pea_pagination_number.active:hover' => 'border-color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'pagination_numbers_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'top' => 6,
                        'right' => 6,
                        'bottom' => 6,
                        'left' => 6,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pagination_number_margin',
                [
                    'label' => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'pagination_number_padding',
                [
                    'label' => esc_html__( 'Padding', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'top' => 9,
                        'right' => 9,
                        'bottom' => 9,
                        'left' => 9,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pea_pagination_number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
    }

    private function get_display_settings($settings) {
        return [
            // Visual toggles
            'show_featured_image' => $settings['show_featured_image'] ?? 'yes',
            'show_title' => $settings['show_title'] ?? 'yes',
            'show_author' => $settings['show_author'] ?? 'yes',
            'show_author_image' => $settings['show_author_image'] ?? 'yes',
            'show_author_prefix' => $settings['show_author_prefix'] ?? 'no',
            'show_date' => $settings['show_date'] ?? 'yes',
            'show_excerpt' => $settings['show_excerpt'] ?? 'yes',
            'show_category' => $settings['show_category'] ?? 'no',
            'show_tag' => $settings['show_tag'] ?? 'no',
            'show_read_more' => $settings['show_read_more'] ?? 'no',
            
            // Design settings
            'preset_styles' => $settings['preset_styles'] ?? 'default',
            'title_tag' => $settings['title_tag'] ?? 'h2',
            'title_link' => $settings['title_link'] ?? 'yes',
            'author_prefix_text' => $settings['author_prefix_text'] ?? 'Posted by',
            'author_position' => $settings['author_position'] ?? 'after-image',
            'author_link' => $settings['author_link'] ?? 'yes',
            'wrapper_link' => $settings['wrapper_link'] ?? 'no',
            'thumbnail_link' => $settings['thumbnail_link'] ?? 'yes',
            'post_card_style' => $settings['post_card_style'] ?? 'grid',
            'read_more_text' => $settings['read_more_text'] ?? 'Learn More',
            'read_more_media_type' => $settings['read_more_media_type'] ?? 'icon',
            'read_more_media_position' => $settings['read_more_media_position'] ?? 'right',
            'excerpt_length' => $settings['excerpt_length']['size'] ?? 20,
            'thumbnail_size' => $settings['thumbnail_size_size'] ?? 'large',
            'thumbnail_size_custom_dimension' => $settings['thumbnail_size_custom_dimension'] ?? ['width' => '', 'height' => ''],

            // Icons/Media (only IDs, not full arrays)
            'read_more_media_icon' => $settings['read_more_media_icon'] ?? [],
            'read_more_image_url' => $settings['read_more_media_image']['url'] ?? '',
        ];
    }

    private function get_query_settings($settings) {
        return [
            'post_type' => $settings['post_type'] ?? 'post',
            'posts_per_page' => $settings['post_per_page']['size'] ?? 9,
            'orderby' => $settings['order_by'] ?? 'date',
            'order' => $settings['sort_order'] ?? 'DESC',
            'category_include' => $settings['category_include_ids'] ?? [],
            'category_exclude' => $settings['category_exclude_ids'] ?? [],
            'tag_include' => $settings['tag_include_ids'] ?? [],
            'tag_exclude' => $settings['tag_exclude_ids'] ?? [],
            'author_include' => $settings['author_include_ids'] ?? [],
            'author_exclude' => $settings['author_exclude_ids'] ?? [],
        ];
    }
    
    /**
     * Generate pagination HTML (reusable for initial render and AJAX)
     */
    private function render_pagination($settings, $query_settings, $display_settings, $current_page, $total_pages) {
        if ($current_page >= $total_pages) {
            return '';
        }
        
        $type = isset($settings['type']) ? $settings['type'] : 'icon';
        $prev_text = isset($settings['prev_text']) ? $settings['prev_text'] : 'Prev';
        $next_text = isset($settings['next_text']) ? $settings['next_text'] : 'Next';
        $prev_icon = isset($settings['prev_icon']) ? $settings['prev_icon'] : [];
        $next_icon = isset($settings['next_icon']) ? $settings['next_icon'] : [];
        
        ?>
        <div class="pea_pagination_wrapper">
            <div class="pea_pagination" 
                data-current_page="<?php echo esc_attr($current_page); ?>" 
                data-total_pages="<?php echo esc_attr($total_pages); ?>"
                data-query='<?php echo wp_json_encode($query_settings); ?>'
                data-display='<?php echo wp_json_encode($display_settings); ?>'
            >
                
                <?php 
                // Previous Button
                if($current_page > 1) { ?>
                    <button class="pea_pagination_prev" 
                            data-page="<?php echo esc_attr($current_page - 1); ?>" 
                            aria-label="Previous Page">
                        <?php 
                            if($type === 'icon' && !empty($prev_icon['value'])) {
                                \Elementor\Icons_Manager::render_icon($prev_icon, ['aria-hidden' => 'true']);
                            } elseif($type === 'text') {
                                echo esc_html($prev_text);
                            }
                        ?>
                    </button>
                <?php } else { ?>
                    <button class="pea_pagination_prev disabled" aria-label="Previous Page (Disabled)">
                        <?php 
                            if($type === 'icon' && !empty($prev_icon['value'])) {
                                \Elementor\Icons_Manager::render_icon($prev_icon, ['aria-hidden' => 'true']);
                            } elseif($type === 'text') {
                                echo esc_html($prev_text);
                            }
                        ?>
                    </button>
                <?php } ?>
                
                <div class="pea_pagination_numbers"> 
                    <?php 
                    // Page Numbers with smart ellipsis
                    $range = 2;
                    $start_page = max(1, $current_page - $range);
                    $end_page = min($total_pages, $current_page + $range);
                    
                    // Show first page if not in range
                    if($start_page > 1) { ?>
                        <button class="pea_pagination_number" data-page="1">1</button>
                        <?php if($start_page > 2) { ?>
                            <span class="pea_pagination_dots">...</span>
                        <?php }
                    }
                    
                    // Show page numbers in range
                    for($i = $start_page; $i <= $end_page; $i++) { 
                        if($i == $current_page) { ?>
                            <button class="pea_pagination_number active" aria-current="page"><?php echo esc_html($i); ?></button>
                        <?php } else { ?>
                            <button class="pea_pagination_number" data-page="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></button>
                        <?php }
                    }
                    
                    // Show last page if not in range
                    if($end_page < $total_pages) { 
                        if($end_page < $total_pages - 1) { ?>
                            <span class="pea_pagination_dots">...</span>
                        <?php } ?>
                        <button class="pea_pagination_number" data-page="<?php echo esc_attr($total_pages); ?>"><?php echo esc_html($total_pages); ?></button>
                    <?php } ?>
                </div>
                
                <?php 
                // Next Button
                if($current_page < $total_pages) { ?>
                    <button class="pea_pagination_next" 
                            data-page="<?php echo esc_attr($current_page + 1); ?>" 
                            aria-label="Next Page">
                        <?php 
                        if($type === 'icon' && !empty($next_icon['value'])) {
                            \Elementor\Icons_Manager::render_icon($next_icon, ['aria-hidden' => 'true']);
                        } elseif($type === 'text') {
                            echo esc_html($next_text);
                        }
                        ?>
                    </button>
                <?php } else { ?>
                    <button class="pea_pagination_next disabled" aria-label="Next Page (Disabled)">
                        <?php 
                        if($type === 'icon' && !empty($next_icon['value'])) {
                            \Elementor\Icons_Manager::render_icon($next_icon, ['aria-hidden' => 'true']);
                        } elseif($type === 'text') {
                            echo esc_html($next_text);
                        }
                        ?>
                    </button>
                <?php } ?>
                
            </div>
        </div>
        <?php
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $display_settings = $this->get_display_settings($settings);
        $query_settings = $this->get_query_settings($settings);
        // Initial query (page 1)
        $args = $this->build_query_args($query_settings, 1);
        $query = new \WP_Query($args);
        
        $total_posts = $query->found_posts;
        $posts_per_page = $query_settings['posts_per_page'];
        $total_pages = ceil($total_posts / $posts_per_page);
        $current_page = 1;

        $post_card_style = $display_settings['post_card_style'];
        $preset_styles = $display_settings['preset_styles'];
        $show_load_more = $settings['show_load_more'] ?? 'yes';
        $pagination_type = $settings['pagination_type'] ?? 'load-more-button';
        $load_more_text = $settings['load_more_text'] ?? 'Load More';
        $load_more_icon = $settings['load_more_icon'] ?? [];
        ?>
        <div class="pea-widget-wrapper pea-post-grid-container  <?php echo esc_attr($preset_styles); ?> <?php echo esc_attr($post_card_style); ?>-layout" >
            <?php 
                // Check if posts exist
                if ($query->have_posts()) {
                    // Merge settings for render_post_card
                    $merged_settings = array_merge($display_settings, [
                        'excerpt_length' => ['size' => $display_settings['excerpt_length']],
                        'read_more_media_icon' => $settings['read_more_media_icon'] ?? [],
                    ]);

                    while ($query->have_posts()) {
                        $query->the_post();
                        $this->render_post_card($merged_settings);
                    }
                        // Pagination Section
                        if($total_pages > 1) { 
                            
                            if($pagination_type === 'load-more-button' && $show_load_more === 'yes') { 
                                // Only show if there are more posts to load
                                if($current_page < $total_pages) { ?>
                                    <div class="pea_load_more_wrapper">
                                        <div class="pea_load_more" 
                                            data-current_page="<?php echo esc_attr($current_page); ?>" 
                                            data-total_pages="<?php echo esc_attr($total_pages); ?>"
                                            data-query='<?php echo wp_json_encode($query_settings); ?>'
                                            data-display='<?php echo wp_json_encode($display_settings); ?>'
                                        >
                                            <?php echo esc_html($load_more_text); ?>
                                            <span class="load_more_button_icon_wrap">
                                                <div class="load_more_button_icon">
                                                    <?php if(!empty($load_more_icon['value'])) {
                                                        \Elementor\Icons_Manager::render_icon($load_more_icon, ['aria-hidden' => 'true']);
                                                    } ?>
                                                </div>
                                                <div class="pea_load_more_outter_wrap" style="display: none;">
                                                    <span class="pea_load_more_loader"></span>
                                                </div>
										    </span>
                                        </div>
                                    </div>
                                <?php }
                                
                            } else if($pagination_type === 'pagination' && $show_load_more === 'yes') { 
                                $this->render_pagination($settings, $query_settings, $display_settings, $current_page, $total_pages);
                            }
                        }

                    wp_reset_postdata();
                } else {
                    echo '<p>' . esc_html__( 'No posts found.', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</p>';
                } 
            ?>
        </div>
        <?php 
    }

}