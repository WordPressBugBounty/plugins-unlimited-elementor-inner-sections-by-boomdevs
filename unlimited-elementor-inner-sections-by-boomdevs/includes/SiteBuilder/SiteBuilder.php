<?php

namespace PrimeElementorAddons\SiteBuilder;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

use PrimeElementorAddons\Traits\Singleton;

class SiteBuilder {

	use Singleton;

    private $api;

    private function __construct() {
        
        // Initialize the post type.
        add_action('init', [ $this,'pea_site_builder_cpt']);
        add_action('add_meta_boxes', [ $this,'pea_site_builder_meta_box']);
        add_action('save_post', [ $this,'pea_site_builder_meta_cb_save']);
        add_action('admin_print_styles', [ $this,'pea_site_builde_style']);
        add_action('admin_enqueue_scripts', [ $this,'pea_site_builder_script'], 999);

        //Setup Elementor header and footer builder
        add_filter('template_include', [$this, 'show_full_page'], 9999 );
        add_action('get_header', [$this, 'show_header'] );
        add_action('get_footer', [$this, 'show_footer'] );
        add_action('wp_enqueue_scripts', [ $this,'pea_site_builder_template_style']);
        add_action('pea_full_page_layout', [ $this,'pea_full_page_template'], 10);
        add_action('pea_header_layout', [ $this,'pea_head_template'], 10);
        add_action('pea_footer_layout', [ $this,'pea_foot_template'], 10);
        add_action('wp_ajax_pea_pt_update', [ $this,'pea_pt_input_check']);

        $api = Api::get_instance();

	}

    function pea_site_builder_cpt(){
        $labels = array(
            'name'                       => esc_html__('Site Builder',  'unlimited-elementor-inner-sections-by-boomdevs'),
            'singular_name'              => esc_html__('Builder Template', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'menu_name'                  => esc_html__('Site Builder', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'name_admin_bar'             => esc_html__('Site Builder item', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'parent_item_colon'          => esc_html__( 'Parent Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'all_items'                  => esc_html__( 'Site Builder', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'view_item'                  => esc_html__( 'View Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'add_new_item'               => esc_html__( 'Add New Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'add_new'                    => esc_html__( 'Add New', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'edit_item'                  => esc_html__( 'Edit Template', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'update_item'                => esc_html__( 'Update Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'search_items'               => esc_html__( 'Search Item', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'not_found'                  => esc_html__( 'Not Found', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'not_found_in_trash'         => esc_html__( 'Not found in Trash', 'unlimited-elementor-inner-sections-by-boomdevs' ),
        );
    
        $args = array(
            'label'               => esc_html__( 'Pea Site Builder', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'description'         => esc_html__( 'Site Builder', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'elementor', 'permalink' ),
            'hierarchical'        => false,
            'public'              => true,
            'register_meta_box_cb' => array($this, "pea_site_builder_meta_box"),
            'show_ui'             => true,
            'show_in_menu'        => 'pea-site-builder-slug',
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'has_archive'         => true,
            'menu_icon'           => 'dashicons-editor-kitchensink'
      
        );

        register_post_type('pea-site-builder', $args);
    }

    function pea_site_builder_meta_box() {
        add_meta_box(
            'pea-site-builder-mete-box',
            esc_html__( 'Site Builder Metabox', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            array($this, "pea_site_builder_meta_cb"),
            'pea-site-builder'
        );
    }

    function pea_site_builder_meta_cb( $post ){

        $post_types       = get_post_types();
        $post_types_unset = array(
            'attachment'          => 'attachment',
            'revision'            => 'revision',
            'nav_menu_item'       => 'nav_menu_item',
            'custom_css'          => 'custom_css',
            'customize_changeset' => 'customize_changeset',
            'oembed_cache'        => 'oembed_cache',
            'user_request'        => 'user_request',
            'wp_block'            => 'wp_block',
            'elementor_library'   => 'elementor_library',
            'elespare_builder'    => 'elespare_builder',
            'elementor-hf'        => 'elementor-hf',
            'elementor_font'      => 'elementor_font',
            'elementor_icons'     => 'elementor_icons',
            'wpforms'             => 'wpforms',
            'wpforms_log'         => 'wpforms_log',
            'acf-field-group'     => 'acf-field-group',
            'acf-field'           => 'acf-field',
            'booked_appointments' => 'booked_appointments',
            'wpcf7_contact_form'  => 'wpcf7_contact_form',
            'scheduled-action'    => 'scheduled-action',
            'shop_order'          => 'shop_order',
            'shop_order_refund'   => 'shop_order_refund',
            'shop_coupon'         => 'shop_coupon',
            'pea-site-builder'    => 'pea-site-builder',
            'wp_navigation'       => 'wp_navigation',
            'product_variation'   => 'product_variation',
            'shop_order_placehold'=> 'shop_order_placehold',
            'product'             => 'product',
            'wp_global_styles'    => 'wp_global_styles',
            'wp_template_part'    => 'wp_template_part',
            'wp_template'         => 'wp_template',
            'e-landing-page'      => 'e-landing-page',
        );
        $options = array_diff( $post_types, $post_types_unset );
        
        $template_type    = get_post_meta($post->ID, 'pea_template_type', true);    
        
        $current_template = get_post_meta( $post->ID, 'pea_display_on_template', true );
        
        $post_id      = get_post_meta( $post->ID, 'sinlge_pt_template', true );
        
        $post_type    = get_post_meta( $post->ID, 'post_type_template', true );
        
        if(get_post_meta( $post->ID, 'pea_display_on_template', true ) == ''){
            $current_template =  array('');
        }elseif(in_array( 'all', $current_template , true )){
            $current_template = array('','all');
        }else{

            $current_template = get_post_meta( $post->ID, 'pea_display_on_template', true );
        } 
        wp_nonce_field( 'pea_site_builder_meta_save', 'pea_site_builder_meta_nonce' ); ?>
        <div class = "main_cls">
            <div class="template-type-main">
                <div class="temp-label">
                <label><strong><?php esc_html_e( 'Type of Template', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></strong></label>
                </div>
                    <div class="template-type">
                    <select name="type_of_template" class="form-control selectpicker">
                        <option value="header" <?php selected($template_type, 'header' ); ?>><?php esc_html_e('Header', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></option>
                        <option value="footer" <?php selected($template_type, 'footer' ); ?>><?php esc_html_e('Footer', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></option>
                        <option value="body" <?php selected($template_type, 'body' ); ?>><?php esc_html_e('Full Page', 'unlimited-elementor-inner-sections-by-boomdevs'); ?></option>
                    </select>
                    </div>
                </div>
        
            <div class="display--on">
                <div class="dis-label">
                    <label><strong><?php esc_html_e( 'Display On ', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></strong></label>
                    <i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"></i>
                </div>
                    <div class="custome-dropdown-wrapper">
                        <select name="pea_display_on_template[]" data-placeholder="multiple-select" class="custome-dropdown opt-display-on" multiple="multiple"  >
                                <option value="all"       <?php selected( in_array( 'all', $current_template, true ) ); ?>><?php esc_html_e( 'Entire Site', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                <option value="home"      <?php selected( in_array( 'home', $current_template, true ) ); ?>><?php esc_html_e( 'Home Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                <option value="singlePost"   <?php selected( in_array( 'singlePost', $current_template, true ) ); ?>><?php esc_html_e( 'Single post Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                <option value="blogArchive"   <?php selected( in_array( 'blogArchive', $current_template, true ) ); ?>><?php esc_html_e( 'Archive Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                <option value="search"    <?php selected( in_array( 'search', $current_template, true ) ); ?>><?php esc_html_e( 'Search Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                <option value="notFound" <?php selected( in_array( 'notFound', $current_template, true ) ); ?>><?php esc_html_e( '404 / Not Found Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                <?php if ( class_exists( 'woocommerce' ) ) { ?> 
                                    <option value="mainShop" <?php selected( in_array( 'mainShop', $current_template, true ) ); ?>><?php esc_html_e( 'Shop Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option> 
                                    <option value="woocheckout" <?php selected( in_array( 'woocheckout', $current_template, true ) ); ?>><?php esc_html_e( 'Checkout Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                    <option value="currentProduct" <?php selected( in_array( 'currentProduct', $current_template, true ) ); ?>><?php esc_html_e( 'Single Product Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option>
                                    <option value="wooArchive" <?php selected( in_array( 'wooArchive', $current_template, true ) ); ?>><?php esc_html_e( 'Product Archive Page', 'unlimited-elementor-inner-sections-by-boomdevs' ) ?></option><?php     
                                } ?>
                                <?php foreach($options as $option){ ?>
                                <option value="<?php echo esc_attr( $option ); ?>" <?php selected( in_array( $option, $current_template, true ) ); ?> style = " text-transform: capitalize;">
                                <?php echo esc_html( $option ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
        
            </div>
            <div class="posttype_val">
                <input type="hidden" name="sinlge_pt_template" value="<?php echo esc_attr( $post_id ); ?>">
                <input type="hidden" name="post_type_template" value="<?php echo esc_attr( $post_type ); ?>" class="post-type-template">
            </div>					
            <div class="display-on-post"></div>
        </div>
        <?php
    }

        function pea_site_builder_meta_cb_save( $post_id ){

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

            // Verify nonce first
            if ( ! isset( $_POST['pea_site_builder_meta_nonce'] ) ) {
                return;
            }
        
            if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pea_site_builder_meta_nonce'] ) ), 'pea_site_builder_meta_save' ) ) {
                wp_send_json_error('Nonce verification failed.');
                return;
            }
        
            // Check if it's an autosave or a revision to prevent overwriting unintentionally
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }
        
            if ( wp_is_post_revision( $post_id ) ) {
                return;
            }

            if ( isset( $_POST['pea_display_on_template'] ) ) {
                $array = array_map( 'sanitize_text_field', wp_unslash( $_POST['pea_display_on_template'] ) );
                update_post_meta( $post_id, 'pea_display_on_template',  $array );
            }
            
            if ( isset( $_POST['type_of_template'] ) ) {
                update_post_meta( $post_id, 'pea_template_type',  sanitize_text_field( wp_unslash($_POST[ 'type_of_template' ]) ) );
            }
            
            if ( isset( $_POST['post_type_template'] ) ) {
                update_post_meta( $post_id, 'post_type_template',  sanitize_text_field( wp_unslash($_POST[ 'post_type_template' ]) ) );
            }
            
            if ( isset( $_POST['sinlge_pt_template'] ) ) {
                update_post_meta( $post_id, 'sinlge_pt_template',  sanitize_text_field( wp_unslash($_POST[ 'sinlge_pt_template' ]) ) );
            }
            
        }
        

        function pea_site_builde_style() {
            wp_enqueue_style( 'pea-site-builder-meta-box',  PEA_PLUGIN_URL . "assets/css/site-builder/meta-box.css", array(), PEA_VERSION);
            wp_enqueue_style( 'select2-min-css', PEA_PLUGIN_URL . "assets/css/site-builder/select2.min.css", array(), PEA_VERSION);
        }

        function pea_site_builder_script() {   
            wp_enqueue_script( 'main-js', PEA_PLUGIN_URL . 'assets/js/site-builder/main.js',array( 'jquery', 'suggest' ), 0.1 , true );
        
            $localize = array(
                'url'   => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'pea_pt_check_nonce' ),
                'edit'  => admin_url( 'edit.php?post_type=pea-site-builder' ),
            );
        
            wp_localize_script(
                'main-js',
                'admin',
                $localize
            );
        
            wp_enqueue_script( 'select2-min-js', PEA_PLUGIN_URL . 'assets/js/site-builder/select2.min.js',array( 'jquery'), '4.0.13' , true);
        }

        function show_full_page($template) {
            $full_page_template_id = $this->get_template_id('body');
            if ($full_page_template_id) {
                
                get_header(); ?>
                    <div id="pea-site-builder-full-page" class="pea-site-builder-full-page">
                        <?php 
                        
                            $full_page_template = \Elementor\Plugin::instance()->frontend->get_builder_content( $full_page_template_id, false );
                            if ( ! empty( $full_page_template ) && is_string( $full_page_template ) ) {
                                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    
                                echo $full_page_template; 
                            }else{
                                return $template;
                            }

                        ?>
                    </div>     
                <?php get_footer(); 
            }else{
                return $template;
            }
        }

        private function resolve_template($type) {
            global $post;

            $post_id   = $post->ID ?? null;
            $post_type = $post ? get_post_type($post_id) : null;
            $template_type = $this->template_type();

            // Priority order (MOST IMPORTANT)
            $query =
                $this->present_single($post_id, $post_type, $type) ?:
                $this->total_single($post_id, $post_type, $type) ?:
                $this->show_template($template_type, $type) ?:
                $this->show_all($type);

            if (!$query) {
                return false;
            }

            return $query;
        }

        private function get_template_id($type) {
            $query = $this->resolve_template($type);

            if (!$query) {
                return false;
            }

            $id = false;

            while ($query->have_posts()) {
                $query->the_post();
                $id = get_the_ID();
            }

            wp_reset_postdata();

            // 🚨 Maintenance check HERE
            if (!$this->elementor_maintenance_check($id)) {
                return false;
            }

            return $id;
        }

        function show_header() {
            $head_template_id = $this->get_template_id('header');
            if ( $head_template_id) {
                require PEA_PLUGIN_PATH . 'includes/SiteBuilder/default/header.php';
                $template   = array();
                $template[] = 'header.php';
                remove_all_actions( 'wp_head' );
                ob_start();
                locate_template( $template, true );
                ob_get_clean();
            }
        }
            
        function show_footer() {  
            $foot_template_id = $this->get_template_id('footer');
            if ( $foot_template_id) {
                require PEA_PLUGIN_PATH . 'includes/SiteBuilder/default/footer.php';
                $template   = array();
                $template[] = 'footer.php';
                remove_all_actions( 'wp_footer' );
                ob_start();
                locate_template( $template, true );
                ob_get_clean();
            }
        }
        
        function pea_site_builder_template_style() {

            foreach (['body', 'header', 'footer'] as $type) {

                $id = $this->get_template_id($type);

                if (!$id) continue;

                if (class_exists('\Elementor\Core\Files\CSS\Post')) {
                    $css_file = new \Elementor\Core\Files\CSS\Post($id);
                } elseif (class_exists('\Elementor\Post_CSS_File')) {
                    $css_file = new \Elementor\Post_CSS_File($id);
                }

                $css_file->enqueue();
            }
        }

        function pea_full_page_template() {
            $query = $this->resolve_template('body');

            if (!$query) return;

            $path = PEA_PLUGIN_PATH . 'includes/SiteBuilder/content/full-page-content.php';
            $this->generate($query, $path);
        }
        
        function pea_head_template() {
            $query = $this->resolve_template('header');

            if (!$query) return;

            $path = PEA_PLUGIN_PATH . 'includes/SiteBuilder/content/content-header.php';
            $this->generate($query, $path);
        }
            
        function pea_foot_template() {
            $query = $this->resolve_template('footer');

            if (!$query) return;

            $path = PEA_PLUGIN_PATH . 'includes/SiteBuilder/content/content-footer.php';
            $this->generate($query, $path);
        }
        
        function show_all( $type ) {    
            $args = array(
                'post_type'           => 'pea-site-builder',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array( 
                    array(
                        'key'     => 'pea_template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => 'pea_display_on_template',
                        'compare' => 'LIKE',
                        'value'   => 'all',
                    ),
                ),
            );
        
            $header = new \WP_Query( $args );
        
            if ( $header->have_posts() ) {
                return $header;
            } else {
                return false;
            }
        }
        
        function show_template( $template_type, $type ) {
            if ( empty( $template_type ) ) {
                return false;
            }
            $args   = array(
                'post_type'           => 'pea-site-builder',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array( 
                    array(
                        'key'     => 'pea_template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => 'pea_display_on_template',
                        'compare' => 'LIKE',
                        'value'   => $template_type,
                    ),
                ),
            );
            $header = new \WP_Query( $args );
        
            if ( $header->have_posts() ) {
                return $header;
            } else {
                return false;
            }
        }
        
        function present_single( $id, $post_type, $type ) {
            if ( ! is_singular()  ) {
                return false;
            }
        
            $args = array(
                'post_type'           => 'pea-site-builder',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => -1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array(
                    array(
                        'key'     => 'pea_template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => 'post_type_template',
                        'compare' => 'LIKE',
                        'value'   => $post_type,
                    ),
                ),
            );
            $header = new \WP_Query( $args );
                
            if ( $header->have_posts() ) {
                
                $list_header = $header->posts;
                $current     = array();   
        
                foreach ( $list_header as $key => $post ) {
                    
                    $list_id = get_post_meta( $post->ID, 'sinlge_pt_template', true );
                    if ( ! empty( $list_id ) || 'all' != $list_id ) { 
                        $post_id = explode( ',', $list_id );
                        if ( in_array( $id, $post_id ) ) { 
                            $current[0] = $post;
                        }
                    }
                }
                wp_reset_postdata();
        
                if ( empty( $current ) ) {
        
                    return false;
                } else {
                    $header->posts      = $current;
                    $header->post_count = 1;
                    return $header;
                }
            } else {
                return false;
            }
        }    
            
        function total_single( $post_id, $post_type, $type) {
            if ( ! is_singular() ) {
                return false;
            }
            $args   = array(
                'post_type'           => 'pea-site-builder',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array(
                    array(
                        'key'     => 'pea_template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => 'post_type_template',
                        'compare' => 'LIKE',
                        'value'   => $post_type,
                    ),
                    array(
                        'key'     => 'sinlge_pt_template',
                        'compare' => 'LIKE',
                        'value'   => 'all',
                    ),
                ),
            );
            $header = new \WP_Query( $args );
        
            if ( $header->have_posts() ) {
                return $header;
            } else {
                return false;
            }
        }       
        
        function template_type() {
            $template_type = '';

            if ( class_exists( 'woocommerce' ) ) {
                if( is_front_page() || is_home() ) {
                    $template_type = 'home';
                }elseif ( is_archive() && ! is_shop() && get_post_type() === 'post' ) {
                    $template_type = 'blogArchive';
                }elseif ( is_single() && is_singular('post') ) {
                    $template_type = 'singlePost';
                }elseif ( is_search() ) {
                    $template_type = 'search';
                }elseif ( is_404() ) {
                    $template_type = 'notFound';
                }elseif ( is_shop() ) {
                    $template_type = 'mainShop';
                }elseif ( is_archive() && get_post_type() === 'product' && ! is_shop() ) {
                    $template_type = 'wooArchive';
                }elseif ( is_product() && is_singular('product') ) {
                    $template_type = 'currentProduct';
                }elseif ( is_checkout() ) {
                    $template_type = 'woocheckout';  
                }
            }else{
                if( is_front_page() || is_home() ) {
                    $template_type = 'home';
                }elseif ( is_single() && is_singular('post') ) {
                    $template_type = 'singlePost';
                }elseif ( is_archive() && get_post_type() === 'post' ) {
                    $template_type = 'blogArchive';
                }elseif ( is_search() ) {
                    $template_type = 'search';
                }elseif ( is_404() ) {
                    $template_type = 'notFound';
                }
            }
            return $template_type;
        }
        
        function generate( $content, $path ) {
            if ( $content->have_posts() ) {
                while ( $content->have_posts() ) {
                    $content->the_post();
                    load_template( $path );
                }
                wp_reset_postdata();
            }
        }

        private function elementor_maintenance_check($template_id = null) {
            $mode     = get_option('elementor_maintenance_mode_mode');
            $template = get_option('elementor_maintenance_mode_template_id');

            // If Elementor maintenance mode is active
            if ($mode === 'coming_soon' || $mode === 'maintenance') {

                // If a specific template is passed, check match
                if ($template_id && (int)$template === (int)$template_id) {
                    return false;
                }

                // Otherwise block all custom templates
                return false;
            }

            return true;
        }

        function pea_pt_input_check() {
            if (!current_user_can('manage_options')) {
              return;
            }
            
            if ( isset($_POST) ) {

                // Verify nonce first
                if ( ! isset( $_POST['pea_pt_nonce'] ) ) {
                    return;
                }
            
                if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pea_pt_nonce'] ) ), 'pea_pt_check_nonce' ) ) {
                    wp_send_json_error('Nonce verification failed.');
                    return;
                }

                $post_type = isset( $_POST['post_type1'] ) ? wp_unslash($_POST['post_type1']) : '';
                $post_type =  implode(",",$post_type);
            }
                
            if ( 'all' !== $post_type && 'blogArchive' !== $post_type && 'search' !== $post_type && 'home' !== $post_type && 'notFound' !== $post_type ) : ?>
        
            <input type="hidden" name="sinlge_pt_template" value="all">
            <input type="hidden" name="post_type_template" value="<?php echo esc_attr( $post_type ); ?>" class="post-type-template">
        
            <?php endif; die();
        }          
}