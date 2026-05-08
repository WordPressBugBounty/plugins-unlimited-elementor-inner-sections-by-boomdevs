<?php

namespace PrimeElementorAddons\Core;

if (!defined('ABSPATH')) {
    exit;
}

use PrimeElementorAddons\Traits\Singleton;

class TaxImageSupport {

    use Singleton;

    /**
     * Constructor: Register hooks for taxonomy image.
     */
    public function __construct()
    {
        // Get all taxonomies with show_ui = true
        $taxonomies = get_taxonomies(['show_ui' => true], 'names');

        // Loop through each taxonomy to add image field
        foreach ($taxonomies as $taxonomy) {
            // Add image field to taxonomy add/edit screens
            add_action("{$taxonomy}_add_form_fields", [$this, 'add_taxonomy_image_field'], 10, 1);
            add_action("{$taxonomy}_edit_form_fields", [$this, 'edit_taxonomy_image_field'], 10, 2);
            add_action("created_{$taxonomy}", [$this, 'save_taxonomy_image'], 10, 2);
            add_action("edited_{$taxonomy}", [$this, 'save_taxonomy_image'], 10, 2);

        }
    }

    /**
     * Add image upload field to taxonomy add screen (only buttons, no input).
     * @param string $taxonomy The taxonomy slug.
     */
    public function add_taxonomy_image_field($taxonomy)
    {
        wp_enqueue_media(); // Enqueue WordPress media uploader scripts
        ?>
        <div class="form-field">
            <label><?php esc_html_e('Taxonomy Image', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></label>
            <div id="taxonomy_image_preview" style="margin-top: 2px;"></div>
            <button class="button upload-taxonomy-image"><?php esc_html_e('Add Image', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></button>
            <button class="button remove-taxonomy-image"
                style="display: none;"><?php esc_html_e('Remove Image', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></button>
            <input type="hidden" name="pea_taxonomy_image" id="pea_taxonomy_image" value="" />
            <p><?php esc_html_e('Upload a featured image to visually represent this category in the Post Category Widget, enhancing both clarity and visual appeal in your Prime Elementor Powered site.', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>
            </p>
        </div>
        <script>
            jQuery(document).ready(function ($) {
                $('.upload-taxonomy-image').click(function (e) {
                    e.preventDefault();
                    var uploader = wp.media({
                        title: 'Select Taxonomy Image',
                        button: { text: 'Select Image' },
                        multiple: false
                    }).on('select', function () {
                        var attachment = uploader.state().get('selection').first().toJSON();
                        $('#pea_taxonomy_image').val(attachment.url);
                        $('#taxonomy_image_preview').html(`<img src="${attachment.url}" style="max-width: 124px; height: auto; object-fit: cover;" />`);
                        $('.remove-taxonomy-image').show();
                    }).open();
                });

                $('.remove-taxonomy-image').click(function (e) {
                    e.preventDefault();
                    $('#pea_taxonomy_image').val('');
                    $('#taxonomy_image_preview').empty();
                    $(this).hide();
                });

                // ===== Reset image when category is added =====
                $(document).ajaxComplete(function (event, xhr, settings) {
                    if (settings.data && settings.data.indexOf("action=add-tag") !== -1) {
                        $('#pea_taxonomy_image').val('');
                        $('#taxonomy_image_preview').empty();
                        $('.remove-taxonomy-image').hide();
                    }
                });

            });
        </script>
        <?php
    }

    /**
     * Add image upload field to taxonomy edit screen (only buttons, no input).
     * @param WP_Term $term The term object.
     * @param string $taxonomy The taxonomy slug.
     */
    public function edit_taxonomy_image_field($term, $taxonomy)
    {
        wp_enqueue_media();
        $image_url = get_term_meta($term->term_id, 'pea_taxonomy_image', true);
        $preview_style = $image_url ? '' : 'display: none;';
        $remove_style = $image_url ? 'display: inline-block;' : 'display: none;';
        ?>
        <tr class="form-field">
            <th><label><?php esc_html_e('Taxonomy Image', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></label></th>
            <td>
                <div id="taxonomy_image_preview" style="margin-top: 2px;<?php echo esc_attr($preview_style); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 150px; height: auto; object-fit: cover;" />
                </div>
                <button class="button upload-taxonomy-image"><?php esc_html_e('Add Image', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></button>
                <button class="button remove-taxonomy-image"
                    style="<?php echo esc_attr($remove_style); ?>"><?php esc_html_e('Remove Image', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></button>
                <input type="hidden" name="pea_taxonomy_image" id="pea_taxonomy_image"
                    value="<?php echo esc_attr($image_url); ?>" />
                <p><?php esc_html_e('Upload a featured image to visually represent this category in the Post Category Block, enhancing both clarity and visual appeal in your Prime Elementor Powered site.', 'unlimited-elementor-inner-sections-by-boomdevs'); ?>
                </p>
            </td>
        </tr>
        <script>
            jQuery(document).ready(function ($) {
                $('.upload-taxonomy-image').click(function (e) {
                    e.preventDefault();
                    var uploader = wp.media({
                        title: 'Select Taxonomy Image',
                        button: { text: 'Select Image' },
                        multiple: false
                    }).on('select', function () {
                        var attachment = uploader.state().get('selection').first().toJSON();
                        $('#pea_taxonomy_image').val(attachment.url);
                        $('#taxonomy_image_preview').html(`<img src="${attachment.url}" style="max-width: 150px; height: auto;" />`).show();
                        $('.remove-taxonomy-image').show();
                    }).open();
                });

                $('.remove-taxonomy-image').click(function (e) {
                    e.preventDefault();
                    $('#pea_taxonomy_image').val('');
                    $('#taxonomy_image_preview').empty().hide();
                    $(this).hide();
                });

            });
        </script>
        <?php
    }

    /**
     * Save taxonomy image meta.
     * @param int $term_id The term ID.
     * @param int $tt_id The term taxonomy ID.
     */
    public function save_taxonomy_image($term_id, $tt_id)
    {
        // Save only pea_taxonomy_image meta, ignore other image meta (e.g., category_image)
        if (isset($_POST['pea_taxonomy_image'])) {
            update_term_meta($term_id, 'pea_taxonomy_image', esc_url_raw($_POST['pea_taxonomy_image']));
        }
    }
}

