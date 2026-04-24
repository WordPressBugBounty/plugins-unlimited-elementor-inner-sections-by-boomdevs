<?php

namespace PrimeElementorAddons\Widgets\ArchiveTemplate;

use PrimeElementorAddons\Utils\Helper;
use PrimeElementorAddons\Traits\PostGridRenderer;
use PrimeElementorAddons\Traits\PostGridControls;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class ArchivePostGrid extends Widget_Base {
    use PostGridRenderer;
    use PostGridControls;

    public function get_name() {
        return 'pea_archive_post_grid';
    }

    public function get_title() {
        return esc_html__( 'Archive & Related Post Grid', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_post_grid_icon';
    }

    public function get_categories() {
        return ['prime-elementor-addons'];
    }

    public function get_keywords() {
        return ['archive', 'post', 'grid', 'archive post grid'];
    }

    public function get_style_depends() {
        return ['prime-elementor-addons--post-grid'];
    }

    public function get_script_depends() {
        return ['prime-elementor-addons--post-grid'];
    }

    // =========================================================================
    // CONTROLS
    // =========================================================================

    protected function register_controls() {
        $this->register_presets_section();
        $this->register_query_section();
        $this->register_post_switcher_section();
        $this->register_read_more_section();
        $this->register_pagination_section();

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

    private function register_query_section() {
        $this->start_controls_section(
            'query_section',
            [
                'label' => esc_html__( 'Archive Query', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'search_query_post_type_list',
            [
                'label'       => esc_html__( 'Include Post Types in Search Result', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => Helper::get_all_post_types(),
                'default'     => ['post'],
                // Only shown on the frontend search archive; ignored for other archive types.
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'       => esc_html__( 'Order By', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'date'     => 'Date',
                    'author'   => 'Author',
                    'title'    => 'Title',
                    'modified' => 'Last Modified',
                ],
                'default'     => 'date',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sort_order',
            [
                'label'       => esc_html__( 'Sort Order', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'DESC' => 'DESC',
                    'ASC'  => 'ASC',
                ],
                'default'     => 'DESC',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'post_per_page',
            [
                'label'      => esc_html__( 'Post Per Page', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range'      => [
                    '' => [ 'min' => 1, 'max' => 100 ],
                ],
                'default'    => [ 'unit' => '', 'size' => 9 ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'related_post_query_section',
            [
                'label' => esc_html__( 'Related Post Query', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'related_by',
                [
                    'label'   => 'Related By',
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'category',
                    'options' => [
                        'category' => 'Category',
                        'tag'      => 'Tag',
                        'both'     => 'Category + Tag',
                        'author'   => 'Author',
                    ],
                ]
            );

            $this->add_control(
                'fallback',
                [
                    'label'   => 'Fallback',
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'recent',
                    'options' => [
                        'recent' => 'Recent Posts',
                        'random' => 'Random Posts',
                        'none'   => 'None',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    // =========================================================================
    // SETTINGS HELPERS  (mirrors PostGrid widget exactly)
    // =========================================================================

    private function get_display_settings( $settings ) {
        return [
            'show_featured_image'              => $settings['show_featured_image'] ?? 'yes',
            'show_default_dummy_featured_image' => $settings['show_default_dummy_featured_image'] ?? 'yes',
            'show_title'                       => $settings['show_title'] ?? 'yes',
            'show_author'                      => $settings['show_author'] ?? 'yes',
            'show_author_image'                => $settings['show_author_image'] ?? 'yes',
            'show_author_prefix'               => $settings['show_author_prefix'] ?? 'no',
            'show_date'                        => $settings['show_date'] ?? 'yes',
            'show_excerpt'                     => $settings['show_excerpt'] ?? 'yes',
            'show_category'                    => $settings['show_category'] ?? 'no',
            'show_tag'                         => $settings['show_tag'] ?? 'no',
            'show_read_more'                   => $settings['show_read_more'] ?? 'no',

            'preset_styles'                    => $settings['preset_styles'] ?? 'default',
            'title_tag'                        => $settings['title_tag'] ?? 'h2',
            'title_link'                       => $settings['title_link'] ?? 'yes',
            'author_prefix_text'               => $settings['author_prefix_text'] ?? 'Posted by',
            'author_position'                  => $settings['author_position'] ?? 'after-image',
            'author_link'                      => $settings['author_link'] ?? 'yes',
            'wrapper_link'                     => $settings['wrapper_link'] ?? 'no',
            'thumbnail_link'                   => $settings['thumbnail_link'] ?? 'yes',
            'post_card_style'                  => $settings['post_card_style'] ?? 'grid',
            'read_more_text'                   => $settings['read_more_text'] ?? 'Learn More',
            'read_more_media_type'             => $settings['read_more_media_type'] ?? 'icon',
            'read_more_media_position'         => $settings['read_more_media_position'] ?? 'right',
            'excerpt_length'                   => $settings['excerpt_length']['size'] ?? 20,
            'thumbnail_size'                   => $settings['thumbnail_size_size'] ?? 'large',
            'thumbnail_size_custom_dimension'  => $settings['thumbnail_size_custom_dimension'] ?? ['width' => '', 'height' => ''],

            'read_more_media_icon'             => $settings['read_more_media_icon'] ?? [],
            'read_more_image_url'              => $settings['read_more_media_image']['url'] ?? '',
        ];
    }

    private function get_related_query_settings( $settings, $post_id = null ) {

        if($post_id === null) {
            $post_id    = get_the_ID();
        }
        $post_type      = get_post_type( $post_id );
        $posts_per_page = $settings['post_per_page']['size'] ?? 9;
        $orderby        = $settings['order_by'] ?? 'date';
        $order          = $settings['sort_order'] ?? 'DESC';
        $related_by     = $settings['related_by'] ?? 'category';

        $args = [
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
            'post__not_in'   => [$post_id],
            'orderby'        => $orderby,
            'order'          => $order,
        ];

        // ===== RELATION LOGIC =====
        if ( $related_by === 'author' ) {

            $args['author'] = get_post_field( 'post_author', $post_id );

        } else {

            $tax_query = ['relation' => 'OR'];

            if ( $related_by === 'category' || $related_by === 'both' ) {
                $cats = wp_get_post_terms( $post_id, 'category', ['fields' => 'ids'] );

                if ( ! empty( $cats ) ) {
                    $tax_query[] = [
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $cats,
                    ];
                }
            }

            if ( $related_by === 'tag' || $related_by === 'both' ) {
                $tags = wp_get_post_terms( $post_id, 'post_tag', ['fields' => 'ids'] );

                if ( ! empty( $tags ) ) {
                    $tax_query[] = [
                        'taxonomy' => 'post_tag',
                        'field'    => 'term_id',
                        'terms'    => $tags,
                    ];
                }
            }

            if ( count( $tax_query ) > 1 ) {
                $args['tax_query'] = $tax_query;
            }
        }

        $args['archive_type'] = 'related';

        return $args;
    }

    // =========================================================================
    // ARCHIVE QUERY DETECTION
    // =========================================================================

    /**
     * Detect the current archive context and return the matching query_settings
     * array that will be stored on the pagination element (for AJAX re-use).
     *
     * The returned array contains an extra key  'archive_type'  so the AJAX
     * handler can reconstruct the same args later.
     *
     * In Elementor editor / preview mode we fall back to a simple "latest posts"
     * query so the widget always shows something in the canvas.
     */
    private function get_archive_query_settings( $settings ) {
        $posts_per_page = $settings['post_per_page']['size'] ?? 9;
        $orderby        = $settings['order_by'] ?? 'date';
        $order          = $settings['sort_order'] ?? 'DESC';

        // ── Editor / Preview fallback ─────────────────────────────────────
        $is_editor = ( (( class_exists( '\Elementor\Plugin' ) && Plugin::$instance->editor->is_edit_mode() ) || ( class_exists( '\Elementor\Plugin' ) && Plugin::$instance->preview->is_preview_mode() ) ) && ( get_post_type() == 'pea-site-builder' ) );

        if ( $is_editor ) {

			$post_id = get_the_ID();

            if ( is_singular( 'post' ) ) {
                return $this->get_related_query_settings( $settings, $post_id );
            }
        	$archive_type 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_archive_select');
			$cat_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_cat_archive_select');
			$tag_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_tag_archive_select');
			$author_archive = Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_author_archive_select');
			$date_archive 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_date_year_archive_select');
			$search_query 	= Plugin::$instance->documents->get($post_id, false)->get_settings('pea_demo_search_result_archive_select');
			switch ($archive_type) {
				case 'category':
                    $category = get_category_by_slug($cat_archive);
                    if ( $category ) {
                        $category_id = $category->term_id;
                    }
                    return [
                        'archive_type'   => 'category',
                        'category__in'   => $category_id,
                        'posts_per_page' => $posts_per_page,
                        'orderby'        => $orderby,
                        'order'          => $order,
						'post_status' => 'publish',
                    ];
				break;
			
				case 'tag':
                    $tag = get_term_by('slug', $tag_archive, 'post_tag');
                    if ($tag) {
                        $tag_id = $tag->term_id;
                    }
                    return [
                        'archive_type'   => 'tag',
                        'tag__in'         => $tag_id,
                        'posts_per_page' => $posts_per_page,
                        'orderby'        => $orderby,
                        'order'          => $order,
                    ];
				break;
			
				case 'author':
					$user = get_user_by('id', $author_archive);
					return [
						'author_id'      => $author_archive,
                        'posts_per_page' => $posts_per_page,
                        'orderby'        => $orderby,
                        'order'          => $order,
						'post_type' => 'post',
						'post_status' => 'publish',
                    ];
				break;
			
				case 'date':
					return [
						'date_query'     => [
                            'year'  => $date_archive,
                        ],
                        'posts_per_page' => $posts_per_page,
                        'orderby'        => $orderby,
                        'order'          => $order,
						'post_type'     => 'post',
						'post_status' => 'publish',
                    ];
				break;
			
				case 'search':
					return [
						's'              => $search_query,
						'post_type'      => $settings['search_query_post_type_list'],
                        'posts_per_page' => $posts_per_page,
                        'orderby'        => $orderby,
                        'order'          => $order,
						'post_status' => 'publish',
                    ];
				break;
			
				default:
				break;
			}
        }

        if ( is_singular( 'post' ) ) {
            return $this->get_related_query_settings( $settings );
        }

        // ── Category archive ─────────────────────────────────────────────
        if ( is_category() ) {
            return [
                'archive_type'   => 'category',
                'category__in'         => get_queried_object_id(),
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Tag archive ───────────────────────────────────────────────────
        if ( is_tag() ) {
            return [
                'archive_type'   => 'tag',
                'tag__in'         => get_queried_object_id(),
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Custom taxonomy archive ───────────────────────────────────────
        if ( is_tax() ) {
            $queried = get_queried_object();
            return [
                'archive_type'   => 'tax',
                'taxonomy'       => $queried->taxonomy,
                'term_id'        => $queried->term_id,
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Author archive ────────────────────────────────────────────────
        if ( is_author() ) {
            return [
                'archive_type'   => 'author',
                'author_id'      => get_queried_object_id(),
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Date archive ──────────────────────────────────────────────────
        if ( is_date() ) {
            $date_query = [];

            if ( is_day() ) {
                $date_query = [
                    'year'  => get_query_var( 'year' ),
                    'month' => get_query_var( 'monthnum' ),
                    'day'   => get_query_var( 'day' ),
                ];
            } elseif ( is_month() ) {
                $date_query = [
                    'year'  => get_query_var( 'year' ),
                    'month' => get_query_var( 'monthnum' ),
                ];
            } elseif ( is_year() ) {
                $date_query = [
                    'year'  => get_query_var( 'year' ),
                ];
            } elseif ( ! empty( get_query_var( 'm' ) ) ) {
                $m = get_query_var( 'm' );
                $date_query['year'] = (int) substr( $m, 0, 4 );
                if ( strlen( $m ) > 4 ) $date_query['month'] = (int) substr( $m, 4, 2 );
                if ( strlen( $m ) > 6 ) $date_query['day']   = (int) substr( $m, 6, 2 );
            }

            return [
                'archive_type'   => 'date',
                'date_query'     => $date_query,
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Search results ────────────────────────────────────────────────
        if ( is_search() ) {
            $post_types = ! empty( $settings['search_query_post_type_list'] )
                ? (array) $settings['search_query_post_type_list']
                : ['post'];

            return [
                'archive_type'   => 'search',
                'search_query'   => get_search_query(),
                'post_type'      => $post_types,
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Post-type archive ─────────────────────────────────────────────
        if ( is_post_type_archive() ) {
            return [
                'archive_type'   => 'post_type',
                'post_type'      => [get_query_var( 'post_type' )],
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'order'          => $order,
            ];
        }

        // ── Generic fallback (home / blog) ────────────────────────────────
        return [
            'archive_type'   => 'home',
            'post_type'      => ['post'],
            'posts_per_page' => $posts_per_page,
            'orderby'        => $orderby,
            'order'          => $order,
        ];
    }

    // =========================================================================
    // PAGINATION  (identical logic to PostGrid widget)
    // =========================================================================


    private function render_pagination( $settings, $query_settings, $display_settings, $current_page, $total_pages ) {
        if ( $current_page >= $total_pages ) {
            return;
        }

        $type      = $settings['type']      ?? 'icon';
        $prev_text = $settings['prev_text'] ?? 'Prev';
        $next_text = $settings['next_text'] ?? 'Next';
        $prev_icon = $settings['prev_icon'] ?? [];
        $next_icon = $settings['next_icon'] ?? [];
        ?>
        <div class="pea_pagination_wrapper">
            <div class="pea_pagination"
                data-current_page="<?php echo esc_attr( $current_page ); ?>"
                data-total_pages="<?php echo esc_attr( $total_pages ); ?>"
                data-query='<?php echo wp_json_encode( $query_settings ); ?>'
                data-display='<?php echo wp_json_encode( $display_settings ); ?>'
                data-archive="1"
            >
                <?php if ( $current_page > 1 ) : ?>
                    <button class="pea_pagination_prev" data-page="<?php echo esc_attr( $current_page - 1 ); ?>" aria-label="Previous Page">
                        <?php $this->render_pagination_btn_content( $type, $prev_icon, $prev_text ); ?>
                    </button>
                <?php else : ?>
                    <button class="pea_pagination_prev disabled" aria-label="Previous Page (Disabled)">
                        <?php $this->render_pagination_btn_content( $type, $prev_icon, $prev_text ); ?>
                    </button>
                <?php endif; ?>

                <div class="pea_pagination_numbers">
                    <?php
                    $range      = 2;
                    $start_page = max( 1, $current_page - $range );
                    $end_page   = min( $total_pages, $current_page + $range );

                    if ( $start_page > 1 ) {
                        echo '<button class="pea_pagination_number" data-page="1">1</button>';
                        if ( $start_page > 2 ) {
                            echo '<span class="pea_pagination_dots">...</span>';
                        }
                    }

                    for ( $i = $start_page; $i <= $end_page; $i++ ) {
                        if ( $i === $current_page ) {
                            echo '<button class="pea_pagination_number active" aria-current="page">' . esc_html( $i ) . '</button>';
                        } else {
                            echo '<button class="pea_pagination_number" data-page="' . esc_attr( $i ) . '">' . esc_html( $i ) . '</button>';
                        }
                    }

                    if ( $end_page < $total_pages ) {
                        if ( $end_page < $total_pages - 1 ) {
                            echo '<span class="pea_pagination_dots">...</span>';
                        }
                        echo '<button class="pea_pagination_number" data-page="' . esc_attr( $total_pages ) . '">' . esc_html( $total_pages ) . '</button>';
                    }
                    ?>
                </div>

                <?php if ( $current_page < $total_pages ) : ?>
                    <button class="pea_pagination_next" data-page="<?php echo esc_attr( $current_page + 1 ); ?>" aria-label="Next Page">
                        <?php $this->render_pagination_btn_content( $type, $next_icon, $next_text ); ?>
                    </button>
                <?php else : ?>
                    <button class="pea_pagination_next disabled" aria-label="Next Page (Disabled)">
                        <?php $this->render_pagination_btn_content( $type, $next_icon, $next_text ); ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /** Small helper – avoids repeating icon/text logic four times */
    private function render_pagination_btn_content( $type, $icon, $text ) {
        if ( $type === 'icon' && ! empty( $icon['value'] ) ) {
            \Elementor\Icons_Manager::render_icon( $icon, ['aria-hidden' => 'true'] );
        } elseif ( $type === 'text' ) {
            echo esc_html( $text );
        }
    }

    // =========================================================================
    // RENDER
    // =========================================================================

    protected function render() {
        $settings        = $this->get_settings_for_display();
        $display_settings = $this->get_display_settings( $settings );

        // Archive-aware query settings (contains archive_type + identifiers)
        $query_settings  = $this->get_archive_query_settings( $settings );

        // Read the current page from WordPress's query var (works with
        // standard WP pagination AND Elementor's AJAX pagination).
        $current_page = max( 1, (int) ( get_query_var( 'paged' ) ?: get_query_var( 'page' ) ?: 1 ) );

        $args  = $this->build_archive_query_args( $query_settings, $current_page );
        $query = new \WP_Query( $args );

        if ( is_singular( 'post' ) && ! $query->have_posts() ) {

            $fallback = $settings['fallback'] ?? 'recent';

            if ( $fallback !== 'none' ) {

                $fallback_args = [
                    'post_type'      => 'post',
                    'posts_per_page' => $query_settings['posts_per_page'],
                    'post__not_in'   => [ get_the_ID() ],
                ];

                if ( $fallback === 'random' ) {
                    $fallback_args['orderby'] = 'rand';
                }

                $query = new \WP_Query( $fallback_args );
            }
        }

        $total_posts    = $query->found_posts;
        $posts_per_page = $query_settings['posts_per_page'];
        $total_pages    = (int) ceil( $total_posts / $posts_per_page );

        $post_card_style  = $display_settings['post_card_style'];
        $preset_styles    = $display_settings['preset_styles'];
        $show_load_more   = $settings['show_load_more']   ?? 'yes';
        $pagination_type  = $settings['pagination_type']  ?? 'load-more-button';
        $load_more_text   = $settings['load_more_text']   ?? 'Load More';
        $load_more_icon   = $settings['load_more_icon']   ?? [];
        ?>
        <div class="pea-widget-wrapper pea-post-grid-container <?php echo esc_attr( $preset_styles ); ?> <?php echo esc_attr( $post_card_style ); ?>-layout">
            <?php
            if ( $query->have_posts() ) :

                // Build the merged settings array that render_post_card() expects
                $merged_settings = array_merge( $display_settings, [
                    'excerpt_length'             => ['size' => $display_settings['excerpt_length']],
                    'read_more_media_icon'        => $settings['read_more_media_icon'] ?? [],
                    'custom_dummy_featured_image' => $settings['custom_dummy_featured_image'] ?? [],
                ] );

                while ( $query->have_posts() ) {
                    $query->the_post();
                    $this->render_post_card( $merged_settings );
                }

                // ── Pagination ────────────────────────────────────────────
                if ( $total_pages > 1 && $show_load_more === 'yes' ) :

                    if ( $pagination_type === 'load-more-button' ) :
                        if ( $current_page < $total_pages ) : ?>
                            <div class="pea_load_more_wrapper">
                                <div class="pea_load_more"
                                    data-current_page="<?php echo esc_attr( $current_page ); ?>"
                                    data-total_pages="<?php echo esc_attr( $total_pages ); ?>"
                                    data-query='<?php echo wp_json_encode( $query_settings ); ?>'
                                    data-display='<?php echo wp_json_encode( $display_settings ); ?>'
                                    data-archive="1"
                                >
                                    <?php echo esc_html( $load_more_text ); ?>
                                    <span class="load_more_button_icon_wrap">
                                        <div class="load_more_button_icon">
                                            <?php if ( ! empty( $load_more_icon['value'] ) ) {
                                                \Elementor\Icons_Manager::render_icon( $load_more_icon, ['aria-hidden' => 'true'] );
                                            } ?>
                                        </div>
                                        <div class="pea_load_more_outter_wrap" style="display:none;">
                                            <span class="pea_load_more_loader"></span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        <?php endif;

                    elseif ( $pagination_type === 'pagination' ) :
                        $this->render_pagination( $settings, $query_settings, $display_settings, $current_page, $total_pages );
                    endif;

                endif;

                wp_reset_postdata();

            else : ?>
                <div class="pea-no-posts-found">
                    <?php echo esc_html__( 'No posts found.', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}