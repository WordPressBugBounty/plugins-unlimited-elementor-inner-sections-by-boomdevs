<?php

namespace PrimeElementorAddons\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;


if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed 

class AdvancedGoogleMaps extends Widget_Base
{

    public function get_name()
    {
        return 'pea_advanced_google_maps';
    }

    public function get_title()
    {
        return __('Advanced Google Map', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_categories()
    {
        return array('prime-elementor-addons');
    }

    public function get_icon()
    {
        return 'pea_google_map_icon';
    }

    public function get_keywords()
    {
        return array('google', 'map', 'location', 'address', 'google map');
    }

    public function get_style_depends()
    {
        return ['prime-elementor-addons--advanced-google-maps'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'google_maps_content_section',
            [
                'label' => esc_html__('General', 'unlimited-elementor-inner-sections-by-boomdevs')
            ]
        );

        $this->add_control(
            'address_input',
            [
                'label' => __('Address', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Boomdevs', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'placeholder' => __('Enter your Address', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'map_width',
            [
                'label' => __('Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 100, 'max' => 2000],
                    '%' => ['min' => 10, 'max' => 100],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'tablet_default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'mobile_default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'map_height',
            [
                'label' => __('Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 100, 'max' => 2000],
                    '%' => ['min' => 10, 'max' => 100],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'map_zoom',
            [
                'label' => __('Zoom Level', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20
                ],
                'range' => [
                    'px' => ['min' => 1, 'max' => 20],
                ],
            ]
        );


        $this->add_control(
            'map_type',
            [
                'label' => __('Map Type', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'm',
                'options' => [
                    'm' => 'Roadmap',
                    'k' => 'Satellite',
                    'h' => 'Hybrid',
                    'p' => 'Terrain',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'google_maps_style_section',
            [
                'label' => esc_html__('Style', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );



        $this->start_controls_tabs('google_map_tabs');
        $this->start_controls_tab(
            'google_map_normal_tab',
            [
                'label' => esc_html__('Normal', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'google_map_background_color',
            [
                'label' => __('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .pea-google-map-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'google_map_box_shadow',
                'label' => __('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-google-map-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'google_map_border',
                'label' => __('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-google-map-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'google_map_hover_tab',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'google_map_background_color_hover',
            [
                'label' => __('Background Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .pea-google-map-wrapper:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'google_map_box_shadow_hover',
                'label' => __('Box Shadow', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-google-map-wrapper:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'google_map_border_hover',
                'label' => __('Border', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selector' => '{{WRAPPER}} .pea-google-map-wrapper:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'pea_google_map_border_prefix_hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'google_map_border_radius',
            [
                'label' => __('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper, {{WRAPPER}} .pea-map-mask' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'google_map_margin',
            [
                'label' => __('Margin', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'google_map_padding',
            [
                'label' => __('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-google-map-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $googleMapLocation = $settings['address_input'];
        $googleMapMapType = $settings['map_type'];
        $mapZoom = $settings['map_zoom']['size'];
        $unique_class = $this->get_id();
?>
        <div class="pea-google-map-wrapper">
            <div class="pea-map-mask-wrapper" id="<?php echo esc_html($unique_class); ?>" style="overflow: hidden;">
                <iframe
                    class="pea-map-mask"
                    src="https://maps.google.com/maps?q=<?php echo esc_html($googleMapLocation); ?>&t=<?php echo esc_html($googleMapMapType); ?>&z=<?php echo esc_html($mapZoom); ?>&output=embed&iwloc=near"
                    allowFullScreen="" aria-hidden="false" tabIndex="0" title="<?php echo esc_html($googleMapLocation); ?>">
                </iframe>
            </div>
        </div>
<?php
    }
}
