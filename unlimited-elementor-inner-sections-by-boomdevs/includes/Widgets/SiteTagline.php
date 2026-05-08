<?php 

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class SiteTagline extends Widget_Base {

    public function get_name() {
        return 'pea_site_tagline';
    }

    public function get_title() {
        return __( 'Site Tagline', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_site_tagline_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return [ 'site tagline', 'tagline'];
    }

    protected function register_controls() {
        
        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );
        
        $this->add_control(
            'site_tagline_before',
            [
                'label'   => __( 'Before Tagline Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => '1',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'site_tagline_after',
            [
                'label'   => __( 'After Tagline Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => '1',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'site_tagline_text_align',
            [
                'label'              => __( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'left'    => [
                        'title' => __( 'Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .pea-site-tagline' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Button to Add/Edit Site Tagline in WordPress Customizer
        $this->add_control(
            'site_tagline_manage_button',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(
                    '<div style="text-align: center;"><a href="%s" target="_blank" class="elementor-button elementor-button-default" style="text-decoration: none;border:none;">%s</a></div>',
                    esc_url( admin_url( 'customize.php?autofocus[control]=blogdescription' ) ),
                    get_bloginfo( 'description' ) 
                        ? esc_html__( 'Edit Site Tagline', 'unlimited-elementor-inner-sections-by-boomdevs' )
                        : esc_html__( 'Add Site Tagline', 'unlimited-elementor-inner-sections-by-boomdevs' )
                ),
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Site Tagline', 'unlimited-elementor-inner-sections-by-boomdevs' ),                    
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'site_tagline_typography',
                'selector' => '{{WRAPPER}} .pea-site-tagline',
            ]
        );
        $this->add_control(
            'site_tagline_color',
            [
                'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-site-tagline' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'site_tagline_hover_color',
            [
                'label'     => __( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-site-tagline a:hover'=> 'color: {{VALUE}};',
                ],
				'condition' => [
					'site_tagline_link_disable' => 'yes'
				],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'site_tagline_text_shadow',
                'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'selector' => '{{WRAPPER}} .pea-site-tagline',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name'     => 'site_tagline_text_stroke',
                'label'    => esc_html__( 'Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'selector' => '{{WRAPPER}} .pea-site-tagline',
			]
		);
		$this->add_responsive_control(
			'site_tagline_margin',
			[
				'label' => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .pea-site-tagline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $before = $settings['site_tagline_before'];
        $after = $settings['site_tagline_after'];
        ?>
        <div class="pea-widget-wrapper pea-site-tagline-wrapper">
            <p class="pea-site-tagline">
                <?php
                if ( '' !== $before || '' !== get_bloginfo( 'description' ) || '' !== $after ) {
                    echo wp_kses_post( $before ).' ';
                    echo wp_kses_post(  get_bloginfo( 'description' ) );  
                    echo ' ' . wp_kses_post( $after );
                } else {
                    esc_html_e( 'Please Go to the ', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    <a href='<?php echo esc_url( admin_url( 'customize.php' ) ); ?>' target="_blank" title='<?php esc_attr_e('Customize','unlimited-elementor-inner-sections-by-boomdevs'); ?>'>
                        <?php esc_html_e( 'Customizer', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    </a>
                    <?php esc_html_e( 'and add the Tagline.', 'unlimited-elementor-inner-sections-by-boomdevs' );
                }
                ?>
            </p>
        </div>
        <?php
    }
}