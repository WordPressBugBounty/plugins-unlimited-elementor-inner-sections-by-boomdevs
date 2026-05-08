<?php 

namespace PrimeElementorAddons\Widgets;
use PrimeElementorAddons\Utils\Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class SiteLogo extends Widget_Base {

    public function get_name() {
        return 'pea_site_logo';
    }

    public function get_title() {
        return __( 'Site Logo', 'unlimited-elementor-inner-sections-by-boomdevs' );
    }

    public function get_icon() {
        return 'pea_site_logo_icon';
    }

    public function get_categories() {
        return [ 'prime-elementor-addons' ];
    }

    public function get_keywords() {
        return [ 'site logo',  'logo'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Logo', 'unlimited-elementor-inner-sections-by-boomdevs' ),                    
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label'   => __( 'Select Logo Type', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'   => 'Default Logo',
                    'custom' => 'Custom Logo',
                ],
            ]
        );

        $this->add_control(
            'custom_logo',
            [
                'label'     => __( 'Logo Custom', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Helper::pea_get_image_url(),
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'        => 'custom_thumbnail',
                'default'     => '150x150',
                'label'       => esc_html__( 'Logo Size', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'description' => esc_html__( 'Custom Logo size when selected image.', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'condition'   => [
                    'logo_type' => 'custom',
                ],
            ]
        );

        // Button to Add/Replace Site Logo in WordPress Customizer
        $this->add_control(
            'logo_manage_button',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(
                    '<div style="border-radius: 3px; text-align: center;"><a href="%s" target="_blank" class="elementor-button elementor-button-default" style="text-decoration: none;border:none;">%s</a></div>',
                    esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ),
                    has_custom_logo() 
                        ? esc_html__( 'Replace Site Logo', 'unlimited-elementor-inner-sections-by-boomdevs' )
                        : esc_html__( 'Add Site Logo', 'unlimited-elementor-inner-sections-by-boomdevs' )
                ),
                'condition' => [
                    'logo_type' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'start',
                'options'   => [
                    'start'   => [
                        'icon'  => 'eicon-h-align-left',
                        'title' => 'Left',
                    ],
                    'center' => [
                        'icon'  => 'eicon-h-align-center',
                        'title' => 'Center',
                    ],
                    'end'  => [
                        'icon'  => 'eicon-h-align-right',
                        'title' => 'Right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-site-logo-wrapper a' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Logo Image', 'unlimited-elementor-inner-sections-by-boomdevs' ),                    
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'site_logo_width',
            [
                'label' => esc_html__( 'Width', 'unlimited-elementor-inner-sections-by-boomdevs' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem','vw', 'custom' ],
				'range' => [
					'px'  => ['min' => 0, 'max' => 1000],
					'em'  => ['min' => 0, 'max' => 100],
					'rem' => ['min' => 0, 'max' => 100],
					'vw'  => ['min' => 0, 'max' => 200],
				],
				'tablet_default'  => ['size' => '', 'unit' => 'px'],
				'mobile_default'  => ['size' => '', 'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} .pea-site-logo' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'site_logo_height',
			[
				'label' => esc_html__( 'Height', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
				'range' => [
					'px'  => ['min' => 0, 'max' => 1000],
					'em'  => ['min' => 0, 'max' => 100],
					'rem' => ['min' => 0, 'max' => 100],
					'vh'  => ['min' => 0, 'max' => 200],
				],
				'tablet_default'  => ['size' => '', 'unit' => 'px'],
				'mobile_default'  => ['size' => '', 'unit' => 'px'],
				'selectors' => [
					'{{WRAPPER}} .pea-site-logo' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			 'site_logo_object_fit',
			[
				'label' => esc_html__( 'Object Fit', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'site_logo_height[size]!' => '',
				],
				'options' => [
					'' => esc_html__( 'Default', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'fill' => esc_html__( 'Fill', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'cover' => esc_html__( 'Cover', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'contain' => esc_html__( 'Contain', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'scale-down' => esc_html__( 'Scale Down', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pea-site-logo' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'site_logo_object_position',
			[
				'label' => esc_html__( 'Object Position', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'center center' => esc_html__( 'Center Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'center left' => esc_html__( 'Center Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'center right' => esc_html__( 'Center Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'top center' => esc_html__( 'Top Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'top left' => esc_html__( 'Top Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'top right' => esc_html__( 'Top Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'bottom center' => esc_html__( 'Bottom Center', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'bottom left' => esc_html__( 'Bottom Left', 'unlimited-elementor-inner-sections-by-boomdevs' ),
					'bottom right' => esc_html__( 'Bottom Right', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				],
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .pea-site-logo' => 'object-position: {{VALUE}};',
				],
				'condition' => [
					'site_logo_height[size]!' => '',
					'site_logo_object_fit' => [ 'cover', 'contain', 'scale-down' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'site_logo_border_type',
				'label'    => 'Border Type',
				'selector' => '{{WRAPPER}}  .pea-site-logo',
			]
		);

        $this->add_control(
            'site_logo_border_hover_color',
            [
                'label' => esc_html__('Border Hover Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .pea-site-logo:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'site_logo_border_type_border!' => ['', 'none'],
                ],
            ]
        );

		$this->add_responsive_control(
			'site_logo_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .pea-site-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $logo_type = $settings['logo_type'];
    
        ?>
        <div class="pea-widget-wrapper pea-site-logo-wrapper">
            <?php
            if ( 'default' === $logo_type ) {
                if ( has_custom_logo() ) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image($custom_logo_id, 'full', false, [
                        'class' => 'custom-logo pea-site-logo',
                        'alt'   => get_bloginfo('name'),
                    ]);
                    echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . $logo . '</a>';
                } else {
                    echo '<p>';
                    esc_html_e( 'Please Go to the ', 'unlimited-elementor-inner-sections-by-boomdevs' );
                    ?>
                    <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" style="display:flex;" title="<?php esc_attr_e( 'Customize', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>">
                        <?php esc_html_e( 'Customizer', 'unlimited-elementor-inner-sections-by-boomdevs' ); ?>
                    </a>
                    <?php
                    esc_html_e( ' and add the Site Logo.', 'unlimited-elementor-inner-sections-by-boomdevs' );
                    echo '</p>';
                }
            } else {
                $image_id = $settings['custom_logo']['id'];
                $image_url = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'custom_thumbnail', $settings );
    
                if ( empty( $image_url ) ) {
                    $image_url = Helper::pea_get_image_url();
                }
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex;" rel="home">
                    <img src="<?php echo esc_url( $image_url ); ?>" loading="lazy" decoding="async"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                        class="custom-logo pea-site-logo">
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    }
}