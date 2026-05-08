<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

class Template extends Widget_Base {

    public function get_name() { 
        return 'pea_template'; 
    }
    public function get_title() { 
        return esc_html__( 'Template', 'unlimited-elementor-inner-sections-by-boomdevs' ); 
    }
    public function get_categories() { 
        return [ 'prime-elementor-addons' ]; 
    }
    public function get_icon(){ 
        return 'pea_template_icon'; 
    }

    public function has_widget_inner_wrapper(): bool {
        return ! Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
    }

     public function get_style_depends(): array {
        return [ 'prime-elementor-addons--template' ];
    }
 
    public function get_script_depends(): array {
        return [ 'prime-elementor-addons--template' ];
    }

    public function get_keywords() {
        return [ 'template', 'widget', 'template widget', 'sidebar', 'sidebar widget', 'sidebar template' ];
    }

    protected function register_controls() {
 
        $this->start_controls_section( 'section_template', [
            'label' => esc_html__( 'Template', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
 
            // ── Choose Template ──────────────────────────────────────
            // Uses a SELECT2 control populated via AJAX so the user can
            // search through all saved Elementor templates.
            $this->add_control( 'template_id', [
                'label'        => esc_html__( 'Choose Template', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'         => Controls_Manager::SELECT2,
                'label_block'  => true,
                'default'      => '',
                'options'      => $this->get_all_templates(),
                'description'  => esc_html__( 'Select a saved Elementor template to display.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ] );

    
            // ── Edit Template button ─
            // Appears only when a template is selected.
            // The href is set dynamically by JS to the Elementor editor URL
            // for the selected template post ID.
            $this->add_control( 'edit_template_notice', [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => $this->get_edit_button_html(),
                'content_classes' => 'pea-edit-template-wrap',
                'condition'       => [ 'template_id!' => '' ],
            ] );
 
        $this->end_controls_section();
    }
 
    /**
     * Returns all Elementor templates (post_type elementor_library)
     * as an ID => title associative array for the SELECT2 control.
     */
    private function get_all_templates(): array {
        $templates = [];
 
        $query = new \WP_Query( [
            'post_type'      => 'elementor_library',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ] );
 
        if ( $query->have_posts() ) {
            foreach ( $query->posts as $post ) {
                $templates[ $post->ID ] = $post->post_title;
            }
        }
 
        return $templates;
    }
 
    /**
     * Returns the HTML for the "Edit Template" button.
     * JS replaces the href dynamically when template_id changes.
     */
    private function get_edit_button_html(): string {
        return sprintf(
            '<a href="#" class="pea-edit-template-btn elementor-button elementor-button-default elementor-button-sm" target="_blank" data-template-id="">
                <i class="eicon-edit" aria-hidden="true"></i> %s
             </a>',
            esc_html__( 'Edit Template', 'unlimited-elementor-inner-sections-by-boomdevs' )
        );
    }
 
    protected function render() {
        $settings    = $this->get_settings_for_display();
        $template_id = ! empty( $settings['template_id'] ) ? (int) $settings['template_id'] : 0;

        if ( ! $template_id ) {
            // Editor placeholder
            if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                echo '<div class="pea-template-placeholder">';
                echo '<span class="pea-template-placeholder__icon"><i class="eicon-library-open"></i></span>';
                echo '<p>' . esc_html__( 'Choose a template from the panel to display it here.', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</p>';
                echo '</div>';
            }
            return;
        }

        // Verify post exists and is an Elementor template
        $post = get_post( $template_id );
        if ( ! $post || 'elementor_library' !== $post->post_type ) {
            echo '<p class="pea-template-error">' . esc_html__( 'Template not found.', 'unlimited-elementor-inner-sections-by-boomdevs' ) . '</p>';
            return;
        }

        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            if ( ! wp_style_is( 'elementor-frontend', 'registered' ) ) {
                wp_register_style( 'elementor-frontend', false );
            }
        }

    
        if ( ! wp_style_is( 'elementor-frontend', 'registered' ) ) {
            \Elementor\Plugin::$instance->frontend->enqueue_styles();
        }

        // Render the full Elementor template content
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id, true );
    }
 
    /**
     * AJAX endpoint: search templates by keyword.
     * Registered in the main plugin bootstrap — call:
     *   add_action( 'wp_ajax_pea_search_templates', [ TemplateWidget::class, 'ajax_search_templates' ] );
     */
    public static function ajax_search_templates() {
        check_ajax_referer( 'pea_template_nonce', 'nonce' );
 
        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json_error( [ 'message' => 'Unauthorized' ], 403 );
        }
 
        $search = sanitize_text_field( wp_unslash( $_GET['q'] ?? '' ) );
 
        $args = [
            'post_type'      => 'elementor_library',
            'posts_per_page' => 20,
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ];
 
        if ( $search ) {
            $args['s'] = $search;
        }
 
        $query   = new \WP_Query( $args );
        $results = [];
 
        if ( $query->have_posts() ) {
            foreach ( $query->posts as $post ) {
                $type = get_post_meta( $post->ID, '_elementor_template_type', true );
                $results[] = [
                    'id'   => $post->ID,
                    'text' => $post->post_title . ( $type ? ' (' . ucfirst( $type ) . ')' : '' ),
                    'edit_url' => admin_url( 'post.php?post=' . $post->ID . '&action=elementor' ),
                ];
            }
        }
 
        wp_send_json_success( [
            'results' => $results,
            'more'    => false,
        ] );
    }
}