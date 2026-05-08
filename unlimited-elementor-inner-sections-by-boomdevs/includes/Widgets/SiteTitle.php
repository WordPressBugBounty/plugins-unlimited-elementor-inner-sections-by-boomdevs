<?php 

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class SiteTitle extends Widget_Base {

    public function get_name() {
        return 'pea_site_title';
    }

    public function get_title() {
        return __( 'Site Title', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_site_title_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return [ 'site title', 'title' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Style', 'unlimited-elementor-inner-sections-by-boomdevs' ),
            ]
        );
        
            $this->add_control(
                'site_title_before',
                [
                    'label'   => __( 'Before Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'rows'    => '1',
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'site_title_after',
                [
                    'label'   => __( 'After Title Text', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'rows'    => '1',
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_responsive_control(
                'site_title_text_align',
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
                        '{{WRAPPER}} .pea-site-title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'site_title_html_tag',
                [
                    'label'       => esc_html__( 'Html Tag', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => 'h1',
                    'options'     => [
                        'h1' => esc_html__( 'H1', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'h2' => esc_html__( 'H2', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'h3' => esc_html__( 'H3', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'h4' => esc_html__( 'H4', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'h5' => esc_html__( 'H5', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'h6' => esc_html__( 'H6', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'div' => esc_html__( 'Div', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'span' => esc_html__( 'span', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                        'p' => esc_html__( 'p', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    ],
                ]
            );
            $this->add_control(
                'site_title_link_disable',
                [
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__( 'Link', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_on' => esc_html__( 'Enable', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'label_off' => esc_html__( 'Disable', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            // Button to Add/Edit Site Title in WordPress Customizer
            $this->add_control(
                'site_title_manage_button',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        '<div style="text-align: center;"><a href="%s" target="_blank" class="elementor-button elementor-button-default" style="text-decoration: none;border:none;">%s</a></div>',
                        esc_url( admin_url( 'customize.php?autofocus[control]=blogname' ) ),
                        get_bloginfo( 'name' ) 
                            ? esc_html__( 'Edit Site Title', 'unlimited-elementor-inner-sections-by-boomdevs' )
                            : esc_html__( 'Add Site Title', 'unlimited-elementor-inner-sections-by-boomdevs' )
                    ),
                ]
            );
            
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Site Title', 'unlimited-elementor-inner-sections-by-boomdevs' ),                    
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'site_title_typography',
                'selector' => '{{WRAPPER}} .pea-site-title',
            ]
        );
        $this->add_control(
            'site_title_color',
            [
                'label'     => __( 'Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-site-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'site_title_hover_color',
            [
                'label'     => __( 'Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-site-title a:hover'=> 'color: {{VALUE}};',
                ],
				'condition' => [
					'site_title_link_disable' => 'yes'
				],
            ]
        );
        $this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'site_title_text_shadow',
                'label'    => esc_html__( 'Text Shadow', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'selector' => '{{WRAPPER}} .pea-site-title',
            ]
        );
        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'     => 'site_title_text_stroke',
                'label'    => esc_html__( 'Text Stroke', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'selector' => '{{WRAPPER}} .pea-site-title',
			]
		);

		$this->add_responsive_control(
			'site_title_margin',
			[
				'label' => esc_html__( 'Margin', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .pea-site-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    protected function render() {

        $settings   = $this->get_settings_for_display();
        $before     = $settings['site_title_before'];
        $after      = $settings['site_title_after'];
        $tag        = $settings['site_title_html_tag'];
        $link       = $settings['site_title_link_disable']; ?>
        <div class="pea-widget-wrapper pea-site-title-wrapper">
            <?php
                if ( '' !== $before || '' !== get_bloginfo( 'name' ) || '' !== $after ) {
                    echo '<'. esc_html($tag).' class="pea-site-title">';
                        if ($link == 'yes'){
                            echo '<a href="'. esc_url( home_url( '/' ) ).'">';
                        }
                        if ( '' !== $before ) {
                            echo wp_kses_post( $before ).' ';
                        }
                        echo wp_kses_post( get_bloginfo( 'name' ) ); 
                        if ( '' !== $after ) {
                            echo ' ' . wp_kses_post( $after );
                        }
                        if ($link == 'yes'){
                            echo '</a>';
                        }
                    echo '</<'. esc_html($tag).'>';
                } else {
                    echo '<p>';
                    esc_html_e( 'Please Go to the ', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    <a href='<?php echo esc_url( admin_url( 'customize.php' ) ); ?>' target="_blank" title='<?php esc_attr_e('Customize','unlimited-elementor-inner-sections-by-boomdevs'); ?>'>
                        <?php esc_html_e( 'Customizer', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    </a>
                    <?php esc_html_e( 'and add the Site Title.', 'unlimited-elementor-inner-sections-by-boomdevs' );
                    echo '</p>';
                }
            ?>
        </div>
        <?php
    }
}