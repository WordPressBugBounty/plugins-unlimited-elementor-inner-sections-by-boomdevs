<?php 

namespace PrimeElementorAddons\Widgets;

use PrimeElementorAddons\Utils\Helper;
use PrimeElementorAddons\Traits\PostGridControls;
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
    use PostGridControls;
    
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
        return ['post', 'grid', 'post grid', 'list', 'post list'];
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
        
        $this->register_presets_section();
        $this->register_query_section();
        $this->register_post_switcher_section();
        $this->register_read_more_section();
        $this->register_pagination_section();

        // =====================
        // STYLE TAB
        // ===================== 

        $this->register_post_card_style_section();
        $this->register_post_content_style_section();
        $this->register_image_style_section();
        $this->register_title_style_section();
        $this->register_description_style_section();
        $this->register_category_style_section();
        $this->register_tag_style_section();
        $this->register_author_style_section();
        $this->register_date_style_section();
        $this->register_read_more_style_section();
        $this->register_read_more_icon_style_section();
        $this->register_read_more_image_style_section();
        $this->register_load_more_button_style_section();
        $this->register_pagination_style_section();
        $this->register_pagination_numbers_style_section();
    }

        
    // Query Control Section 
    private function register_query_section() {
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
            
            // $this->add_control(
            //     'custom_permalink',
            //     [
            //         'label' => esc_html__('Custom Permalink', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'type' => Controls_Manager::SWITCHER,
            //         'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
            //         'return_value' => 'yes',
            //         'default' => 'no',
            //     ]
            // );
        
        $this->end_controls_section();
    }

    private function get_display_settings($settings) {
        return [
            // Visual toggles
            'show_featured_image' => $settings['show_featured_image'] ?? 'yes',
            'show_default_dummy_featured_image' => $settings['show_default_dummy_featured_image'] ?? 'yes',
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
                        'custom_dummy_featured_image' => $settings['custom_dummy_featured_image'] ?? [],
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