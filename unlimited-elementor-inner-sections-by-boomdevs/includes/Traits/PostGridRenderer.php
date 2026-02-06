<?php

namespace PrimeElementorAddons\Traits;

use PrimeElementorAddons\Utils\Helper;

trait PostGridRenderer {

    /**
     * Render single post card
     */
    private function render_post_card($settings) {
        $post_id = get_the_ID();
        $permalink = get_permalink();
        $title = get_the_title();
        $author_id = get_the_author_meta('ID');
        $author_name = get_the_author();
        $author_url = get_author_posts_url($author_id);
        $author_avatar = get_avatar($author_id, 96);
        $post_date = get_the_date('j M Y');
        $image_src = $this->get_post_image($post_id, $settings);
        $hierarchical_terms = $this->get_hierarchical_terms($post_id);
        $non_hierarchical_terms = $this->get_non_hierarchical_terms($post_id);

        // Extract individual settings
        $preset_styles = $settings['preset_styles'] ?? 'default';
        $show_featured_image = $settings['show_featured_image'] ?? 'yes';
        $show_title = $settings['show_title'] ?? 'yes';
        $title_link = $settings['title_link'] ?? 'yes';
        $title_tag = $settings['title_tag'] ?? 'h2';
        $show_author = $settings['show_author'] ?? 'yes';
        $show_author_image = $settings['show_author_image'] ?? 'yes';
        $show_author_prefix = $settings['show_author_prefix'] ?? 'no';
        $author_prefix_text = $settings['author_prefix_text'] ?? 'Posted by';
        $author_link = $settings['author_link'] ?? 'yes';
        $author_position = $settings['author_position'] ?? 'after-image';
        $show_excerpt = $settings['show_excerpt'] ?? 'yes';
        $show_category = $settings['show_category'] ?? 'no';
        $show_tag = $settings['show_tag'] ?? 'no';
        $show_date = $settings['show_date'] ?? 'yes';
        $show_read_more = $settings['show_read_more'] ?? 'no';
        $read_more_text = $settings['read_more_text'] ?? 'Learn More';
        $wrapper_link = $settings['wrapper_link'] ?? 'no';
        $thumbnail_link = $settings['thumbnail_link'] ?? 'yes';
        ?>
        <<?php echo ($wrapper_link === 'yes' ? 'a' : 'div'); ?>
            <?php if ($wrapper_link === 'yes') : ?>
                href="<?php echo esc_url($permalink); ?>"
                aria-label="<?php echo esc_attr('Read more about ' . $title); ?>"
            <?php endif; ?>
            class="pea-post-grid-wrapper pea-post-grid-style-1"
        >
            <?php if($show_featured_image === 'yes'){ ?>
                <div class="pea-post-grid-image-wrapper">
                    <div class="pea-post-grid-image">
                        <?php if ($wrapper_link === 'yes'): ?>
                            <span class="pea-post-grid-image-span">
                                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
                            </span>
                        <?php else: ?>
                            <?php if ($thumbnail_link === 'yes'): ?>
                                <a href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr('Read more about ' . $title); ?>">
                                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
                                </a>
                            <?php else: ?>
                                <span class="pea-post-grid-image-span">
                                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>

            <div class="pea-post-grid-content-wrapper">
                <?php if($author_position === 'after-image'){ ?>
                    <?php if($show_author === 'yes' || $show_date === 'yes'){ ?>
                        <div class="pea-post-grid-author">
                            <?php if($show_author_image === 'yes'){ ?>
                                <div class="pea-post-grid-author-avatar">
                                    <?php if ($wrapper_link === 'yes'): ?>
                                        <?php echo wp_kses_post($author_avatar); ?>
                                    <?php else: ?>
                                        <?php if ($author_link === 'yes'): ?>
                                            <a class="pea-post-grid-author-avatar-url" href="<?php echo esc_url($author_url); ?>" aria-label="<?php echo esc_attr('View all posts by ' . $author_name); ?>">
                                                <?php echo wp_kses_post($author_avatar); ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo wp_kses_post($author_avatar); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                            <div class="pea-post-grid-author-info">
                                <?php if($show_author === 'yes'){ ?>
                                    <div class="pea-post-grid-author-info-name">
                                        <?php if($show_author_prefix === 'yes'){ ?>
                                            <span class="pea-post-grid-author-posted-by"><?php echo esc_html($author_prefix_text); ?></span>
                                        <?php } ?>
                                        <div class="pea-post-grid-author-name">
                                            <?php if ($wrapper_link === 'yes'): ?>
                                                <?php echo esc_html($author_name); ?>
                                            <?php else: ?>
                                                <?php if ($author_link === 'yes'): ?>
                                                    <a class="pea-post-grid-author-name-url" href="<?php echo esc_url($author_url); ?>" aria-label="<?php echo esc_attr('View all posts by ' . $author_name); ?>">
                                                        <?php echo esc_html($author_name); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <?php echo esc_html($author_name); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($show_date === 'yes'){ ?>
                                    <div class="pea-post-grid-date"><?php echo esc_html($post_date); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php if($show_category === 'yes'){ ?>
                    <div class="pea-post-grid-categories">
                        <?php foreach ( $hierarchical_terms as $taxonomy_name => $terms ) : ?>
                            <?php foreach ( $terms as $term ) : ?>
                                <?php if ($wrapper_link === 'yes'): ?>
                                    <span class="pea-post-grid-category-url">
                                        <?php echo esc_html( $term->name ); ?>
                                    </span>
                                <?php else: ?>
                                    <a class="pea-post-grid-category-url" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
                                        <?php echo esc_html( $term->name ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>

                <?php if($show_tag === 'yes'){ ?>
                    <div class="pea-post-grid-tags">
                        <?php foreach ( $non_hierarchical_terms as $taxonomy_name => $terms ) : ?>
                            <?php foreach ( $terms as $term ) : ?>
                                <?php if ($wrapper_link === 'yes'): ?>
                                    <span class="pea-post-grid-tag-url">
                                        <?php echo esc_html( $term->name ); ?>
                                    </span>
                                <?php else: ?>
                                    <a class="pea-post-grid-tag-url" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
                                        <?php echo esc_html( $term->name ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>

                <div class="pea-post-grid-content">
                    <?php if($show_title === 'yes'){ ?>
                        <?php if ($wrapper_link === 'yes'): ?>
                            <span class="pea-post-title-span">
                                <<?php echo esc_attr($title_tag); ?> class="pea-post-title"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                            </span>
                        <?php else: ?>
                            <?php if ($title_link === 'yes'): ?>
                                <a href="<?php echo esc_url($permalink); ?>">
                                    <<?php echo esc_attr($title_tag); ?> class="pea-post-title"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                                </a>
                            <?php else: ?>
                                <span class="pea-post-title-span">
                                    <<?php echo esc_attr($title_tag); ?> class="pea-post-title"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php } ?>

                    <?php if($author_position === 'after-title'){ ?>
                        <?php if($show_author === 'yes' || $show_date === 'yes'){ ?>
                            <div class="pea-post-grid-author">
                                <?php if($show_author_image === 'yes'){ ?>
                                    <div class="pea-post-grid-author-avatar">
                                        <?php if ($wrapper_link === 'yes'): ?>
                                            <?php echo wp_kses_post($author_avatar); ?>
                                        <?php else: ?>
                                            <?php if ($author_link === 'yes'): ?>
                                                <a class="pea-post-grid-author-avatar-url" href="<?php echo esc_url($author_url); ?>" aria-label="<?php echo esc_attr('View all posts by ' . $author_name); ?>">
                                                    <?php echo wp_kses_post($author_avatar); ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo wp_kses_post($author_avatar); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                                <div class="pea-post-grid-author-info">
                                    <?php if($show_author === 'yes'){ ?>
                                        <div class="pea-post-grid-author-info-name">
                                            <?php if($show_author_prefix === 'yes'){ ?>
                                                <span class="pea-post-grid-author-posted-by"><?php echo esc_html($author_prefix_text); ?></span>
                                            <?php } ?>
                                            <div class="pea-post-grid-author-name">
                                                <?php if ($wrapper_link === 'yes'): ?>
                                                    <?php echo esc_html($author_name); ?>
                                                <?php else: ?>
                                                    <?php if ($author_link === 'yes'): ?>
                                                        <a class="pea-post-grid-author-name-url" href="<?php echo esc_url($author_url); ?>" aria-label="<?php echo esc_attr('View all posts by ' . $author_name); ?>">
                                                            <?php echo esc_html($author_name); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <?php echo esc_html($author_name); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($show_date === 'yes'){ ?>
                                        <div class="pea-post-grid-date"><?php echo esc_html($post_date); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <?php if($show_excerpt === 'yes'){ $excerpt = Helper::get_excerpt( $settings['excerpt_length']['size'], get_post() );  ?>
                        <p class="pea-post-desc">
                            <?php echo wp_kses_post($excerpt); ?>
                        </p>
                    <?php } ?>
                </div>

                <?php if($author_position === 'after-desc'){ ?>
                    <?php if($show_author === 'yes' || $show_date === 'yes'){ ?>
                        <div class="pea-post-grid-author">
                            <?php if($show_author_image === 'yes'){ ?>
                                <div class="pea-post-grid-author-avatar">
                                    <?php if ($wrapper_link === 'yes'): ?>
                                        <?php echo wp_kses_post($author_avatar); ?>
                                    <?php else: ?>
                                        <?php if ($author_link === 'yes'): ?>
                                            <a class="pea-post-grid-author-avatar-url" href="<?php echo esc_url($author_url); ?>" aria-label="<?php echo esc_attr('View all posts by ' . $author_name); ?>">
                                                <?php echo wp_kses_post($author_avatar); ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo wp_kses_post($author_avatar); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                            <div class="pea-post-grid-author-info">
                                <?php if($show_author === 'yes'){ ?>
                                    <div class="pea-post-grid-author-info-name">
                                        <?php if($show_author_prefix === 'yes'){ ?>
                                            <span class="pea-post-grid-author-posted-by"><?php echo esc_html($author_prefix_text); ?></span>
                                        <?php } ?>
                                        <div class="pea-post-grid-author-name">
                                            <?php if ($wrapper_link === 'yes'): ?>
                                                <?php echo esc_html($author_name); ?>
                                            <?php else: ?>
                                                <?php if ($author_link === 'yes'): ?>
                                                    <a class="pea-post-grid-author-name-url" href="<?php echo esc_url($author_url); ?>" aria-label="<?php echo esc_attr('View all posts by ' . $author_name); ?>">
                                                        <?php echo esc_html($author_name); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <?php echo esc_html($author_name); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($show_date === 'yes'){ ?>
                                    <div class="pea-post-grid-date"><?php echo esc_html($post_date); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php if($show_read_more === 'yes'){ ?>
                    <?php if ($wrapper_link === 'yes'): ?>
                        <span class="pea-post-grid-read-more-button">
                            <?php if($settings['read_more_media_type'] !== 'none' &&  $settings['read_more_media_position'] === 'left'){ ?>
                                <div class="pea-post-grid-read-more-icon-wrapper">
                                    <?php if($settings['read_more_media_type'] === 'icon'){ ?>
                                        <div class="pea-post-grid-read-more-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_media_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php }else{ $image_url = $settings['read_more_image_url']; ?>
                                        <div class="pea-post-grid-read-more-icon-image"> 
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                        </div> 
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <span class="pea-post-grid-read-more-text">
                                <?php echo esc_html($read_more_text); ?>
                            </span>
                            <?php if($settings['read_more_media_type'] !== 'none' &&  $settings['read_more_media_position'] === 'right'){ ?>
                                <div class="pea-post-grid-read-more-icon-wrapper">
                                    <?php if($settings['read_more_media_type'] === 'icon'){ ?>
                                        <div class="pea-post-grid-read-more-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_media_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php }else{ $image_url = $settings['read_more_image_url']; ?>
                                        <div class="pea-post-grid-read-more-icon-image"> 
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                        </div> 
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo esc_url($permalink); ?>" class="pea-post-grid-read-more-button">
                            <?php if($settings['read_more_media_type'] !== 'none' &&  $settings['read_more_media_position'] === 'left'){ ?>
                                <div class="pea-post-grid-read-more-icon-wrapper">
                                    <?php if($settings['read_more_media_type'] === 'icon'){ ?>
                                        <div class="pea-post-grid-read-more-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_media_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php }else{ $image_url = $settings['read_more_image_url']; ?>
                                        <div class="pea-post-grid-read-more-icon-image"> 
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                        </div> 
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <span class="pea-post-grid-read-more-text">
                                <?php echo esc_html($read_more_text); ?>
                            </span>
                            <?php if($settings['read_more_media_type'] !== 'none' &&  $settings['read_more_media_position'] === 'right'){ ?>
                                <div class="pea-post-grid-read-more-icon-wrapper">
                                    <?php if($settings['read_more_media_type'] === 'icon'){ ?>
                                        <div class="pea-post-grid-read-more-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_media_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php }else{ $image_url = $settings['read_more_image_url']; ?>
                                        <div class="pea-post-grid-read-more-icon-image"> 
                                            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
                                        </div> 
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </a>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </<?php echo ($wrapper_link === 'yes' ? 'a' : 'div'); ?>>
        <?php
    }

    /**
     * Get post image with fallback
     */
    private function get_post_image($post_id, $settings) {
        $thumbnail_id = get_post_thumbnail_id($post_id);
        
        if (!$thumbnail_id) {
            return plugin_dir_url(__FILE__) . 'assets/images/preset-bg.jpg';
        }
        
        // Get thumbnail size from settings
        $thumbnail_size = $settings['thumbnail_size'] ?? 'large';
        // Handle custom size
        if ($thumbnail_size === 'custom') {
            $custom_dimension = $settings['thumbnail_size_custom_dimension'] ?? ['width' => '', 'height' => ''];
            $width = !empty($custom_dimension['width']) ? intval($custom_dimension['width']) : null;
            $height = !empty($custom_dimension['height']) ? intval($custom_dimension['height']) : null;
            
            if ($width && $height) {
                $image_src = wp_get_attachment_image_url($thumbnail_id, [$width, $height]);
            } else {
                $image_src = wp_get_attachment_image_url($thumbnail_id, 'full');
            }
        } else {
            // Use registered image size
            $image_src = wp_get_attachment_image_url($thumbnail_id, $thumbnail_size);
        }
        
        // Fallback to default image
        if (!$image_src) {
            $image_src = plugin_dir_url(__FILE__) . 'assets/images/preset-bg.jpg';
        }
        
        return $image_src;
    }

    /**
     * Get hierarchical terms (categories)
     */
    private function get_hierarchical_terms($post_id) {
        $hierarchical_terms = [];
        $taxonomies = get_object_taxonomies(get_post_type(), 'objects');

        foreach ($taxonomies as $taxonomy) {
            if (!$taxonomy->hierarchical) {
                continue;
            }

            $terms = get_the_terms($post_id, $taxonomy->name);
            if (!empty($terms) && !is_wp_error($terms)) {
                $hierarchical_terms[$taxonomy->name] = $terms;
            }
        }

        return $hierarchical_terms;
    }

    /**
     * Get non-hierarchical terms (tags)
     */
    private function get_non_hierarchical_terms($post_id) {
        $non_hierarchical_terms = [];
        $taxonomies = get_object_taxonomies(get_post_type(), 'objects');

        foreach ($taxonomies as $taxonomy) {
            if ($taxonomy->hierarchical) {
                continue;
            }

            $terms = get_the_terms($post_id, $taxonomy->name);
            if (!empty($terms) && !is_wp_error($terms)) {
                $non_hierarchical_terms[$taxonomy->name] = $terms;
            }
        }

        return $non_hierarchical_terms;
    }

    /**
     * Build WP_Query arguments
     */
    private function build_query_args($query_settings, $paged = 1) {
        
        $args = [
            'post_type' => $query_settings['post_type'],
            'posts_per_page' => $query_settings['posts_per_page'],
            'paged' => $paged,
            'post_status' => 'publish',
            'orderby' => $query_settings['orderby'],
            'order' => $query_settings['order'],
            'no_found_rows' => false, // Need this for pagination
        ];

        // Author filters
        if (!empty($query_settings['author_include'])) {
            $args['author__in'] = $query_settings['author_include'];
        }
        if (!empty($query_settings['author_exclude'])) {
            $args['author__not_in'] = $query_settings['author_exclude'];
        }

        // Category filters
        if (!empty($query_settings['category_include'])) {
            $args['category__in'] = $query_settings['category_include'];
        }
        if (!empty($query_settings['category_exclude'])) {
            $args['category__not_in'] = $query_settings['category_exclude'];
        }

        // Tag filters
        if (!empty($query_settings['tag_include'])) {
            $args['tag__in'] = $query_settings['tag_include'];
        }
        if (!empty($query_settings['tag_exclude'])) {
            $args['tag__not_in'] = $query_settings['tag_exclude'];
        }

        return $args;
    }
}
