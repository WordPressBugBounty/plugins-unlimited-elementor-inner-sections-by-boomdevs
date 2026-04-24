<?php

namespace PrimeElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Modules\NestedElements\Base\Widget_Nested_Base;
use Elementor\Modules\NestedElements\Controls\Control_Nested_Repeater;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}

class MarqueeCarousel extends Widget_Nested_Base
{

    public $num_of_slide_items = 0;

    public function get_name()
    {
        return 'pea_marquee_carousel';
    }

    public function get_title()
    {
        return esc_html__('Marquee Carousel', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    public function get_categories()
    {
        return array('prime-elementor-addons');
    }

    public function get_icon()
    {
        return 'pea_marquee_carousel_icon';
    }

    public function get_keywords()
    {
        return array('Marquee', 'Carousel', 'Scroll', 'Ticker', 'Infinite', 'Loop', 'Nested');
    }

    public function show_in_panel()
    {
        return Plugin::$instance->experiments->is_feature_active('nested-elements')
            && Plugin::$instance->experiments->is_feature_active('container');
    }

    public function has_widget_inner_wrapper(): bool
    {
        return !Plugin::$instance->experiments->is_feature_active('e_optimized_markup');
    }

    public function get_style_depends(): array
    {
        return [
            'prime-elementor-addons-swiper',
            'prime-elementor-addons--marquee-carousel',
        ];
    }

    public function get_script_depends(): array
    {
        return [
            'prime-elementor-addons-swiper',
            'prime-elementor-addons--marquee-carousel',
        ];
    }

    // -------------------------------------------------------------------------
    // Nested helpers
    // -------------------------------------------------------------------------

    protected function get_default_children_elements()
    {

        $make_slide = function ($num) {
            return [
                'elType' => 'container',
                'id' => \Elementor\Utils::generate_random_string(),
                'settings' => [
                    /* translators: %d: Item number */
                    '_title' => sprintf(__('Marquee Item #%d', 'unlimited-elementor-inner-sections-by-boomdevs'), $num),
                    'background_background' => 'classic',
                    'background_color' => '#ffffff',
                ],
                'elements' => [],
            ];
        };

        return [
            $make_slide(1),
            $make_slide(2),
            $make_slide(3),
            $make_slide(4),
            $make_slide(5),
            $make_slide(6),
        ];
    }

    protected function get_default_repeater_title_setting_key()
    {
        return 'item_title';
    }

    protected function get_default_children_title()
    {
        /* translators: %d: Item number */
        return esc_html__('Marquee Item %d', 'unlimited-elementor-inner-sections-by-boomdevs');
    }

    protected function get_default_children_placeholder_selector()
    {
        return '.pea-marquee-swiper-wrapper';
    }

    protected function get_default_children_container_placeholder_selector()
    {
        return '.pea-marquee-item';
    }

    // -------------------------------------------------------------------------
    // Controls
    // -------------------------------------------------------------------------

    protected function register_controls()
    {

        // ── CONTENT TAB ──────────────────────────────────────────────────────

        // Items repeater
        $this->start_controls_section(
            'marquee_items_section',
            [
                'label' => esc_html__('Marquee Items', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Marquee Item', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'placeholder' => esc_html__('Marquee Item Title', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'dynamic' => ['active' => true],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'marquee_items',
            [
                'label' => esc_html__('Items', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Control_Nested_Repeater::CONTROL_TYPE,
                'fields' => $repeater->get_controls(),
                'default' => array_map(
                    fn($i) => ['item_title' => sprintf(__('Marquee Item %d', 'unlimited-elementor-inner-sections-by-boomdevs'), $i)],
                    range(1, 6)
                ),
                'frontend_available' => true,
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // General settings
        $this->start_controls_section(
            'marquee_general_settings',
            [
                'label' => esc_html__('General Settings', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__('Items Visible', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => ['step' => 0.1, 'min' => 1, 'max' => 10],
                ],
                'default' => ['unit' => '', 'size' => 4],
            ]
        );

        $this->add_responsive_control(
            'slides_gap',
            [
                'label' => esc_html__('Gap (px)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 200],
                ],
                'default' => ['unit' => 'px', 'size' => 20],
            ]
        );

        $this->add_control(
            'marquee_speed',
            [
                'label' => esc_html__('Scroll Speed', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 500, 'max' => 20000, 'step' => 100],
                ],
                'default' => ['unit' => 'px', 'size' => 5000],
                'description' => esc_html__('Duration (ms) for one full loop cycle. Lower = faster.', 'unlimited-elementor-inner-sections-by-boomdevs'),
            ]
        );

        $this->add_control(
            'marquee_direction',
            [
                'label' => esc_html__('Direction', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left (RTL)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                    'right' => esc_html__('Right (LTR)', 'unlimited-elementor-inner-sections-by-boomdevs'),
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_fade_edges',
            [
                'label' => esc_html__('Fade Edges', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'label_off' => esc_html__('No', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'fade_edge_width',
            [
                'label' => esc_html__('Fade Width', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 20, 'max' => 300],
                    '%' => ['min' => 1, 'max' => 50],
                ],
                'default' => ['unit' => 'px', 'size' => 120],
                'condition' => ['show_fade_edges' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-fade-left' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pea-marquee-fade-right' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'marquee_min_height',
            [
                'label' => esc_html__('Min Height', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => ['min' => 50, 'max' => 800],
                    'vh' => ['min' => 5, 'max' => 100],
                ],
                'default' => ['unit' => 'px', 'size' => 200],
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-swiper-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ── STYLE TAB ────────────────────────────────────────────────────────

        // Item style
        $this->start_controls_section(
            'marquee_item_style',
            [
                'label' => esc_html__('Item', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_bg_color',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .pea-marquee-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .pea-marquee-item',
            ]
        );

        // Hover
        $this->add_control(
            'item_hover_heading',
            [
                'label' => esc_html__('Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_hover_bg_color',
            [
                'label' => esc_html__('Background', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-item:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_hover_scale',
            [
                'label' => esc_html__('Scale on Hover', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => ['min' => 0.8, 'max' => 1.5, 'step' => 0.01],
                ],
                'default' => ['unit' => '', 'size' => 1],
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-item:hover' => 'transform: scale({{SIZE}});',
                ],
            ]
        );

        $this->end_controls_section();

        // Fade overlay style
        $this->start_controls_section(
            'marquee_fade_style',
            [
                'label' => esc_html__('Fade Edges', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_fade_edges' => 'yes'],
            ]
        );

        $this->add_control(
            'fade_color',
            [
                'label' => esc_html__('Fade Color', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'description' => esc_html__('Should match the page/section background.', 'unlimited-elementor-inner-sections-by-boomdevs'),
                'selectors' => [
                    '{{WRAPPER}} .pea-marquee-fade-left' => '--pea-fade-color: {{VALUE}};',
                    '{{WRAPPER}} .pea-marquee-fade-right' => '--pea-fade-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // -------------------------------------------------------------------------
    // Render (PHP / frontend)
    // -------------------------------------------------------------------------

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->num_of_slide_items = count($settings['marquee_items'] ?? []);

        $widget_id = $this->get_id();
        $items = $settings['marquee_items'];

        // Desktop
        $spv_desktop = $settings['slides_per_view']['size'] ?? 4;
        $gap_desktop = $settings['slides_gap']['size'] ?? 20;

        // Tablet
        $spv_tablet = $settings['slides_per_view_tablet']['size'] ?? 2;
        $gap_tablet = $settings['slides_gap_tablet']['size'] ?? 15;

        // Mobile
        $spv_mobile = $settings['slides_per_view_mobile']['size'] ?? 1;
        $gap_mobile = $settings['slides_gap_mobile']['size'] ?? 10;

        $speed = $settings['marquee_speed']['size'] ?? 5000;
        $direction = $settings['marquee_direction'] ?? 'left';
        $pause = $settings['pause_on_hover'] === 'yes';
        $fade = $settings['show_fade_edges'] === 'yes';

        $swiper_settings = [
            'slidesPerView' => $spv_desktop,
            'spaceBetween' => $gap_desktop,
            'loop' => true,
            'freeMode' => true,
            'allowTouchMove' => true,
            'speed' => $speed,
            'autoplay' => [
                'delay' => 0,
                'disableOnInteraction' => false,
                'reverseDirection' => $direction === 'right',
                'pauseOnMouseEnter' => $pause,
            ],
            'breakpoints' => [
                0 => ['slidesPerView' => $spv_mobile, 'spaceBetween' => $gap_mobile],
                768 => ['slidesPerView' => $spv_tablet, 'spaceBetween' => $gap_tablet],
                1025 => ['slidesPerView' => $spv_desktop, 'spaceBetween' => $gap_desktop],
            ],
        ];

        $data_settings = wp_json_encode($swiper_settings);

        $wrapper_classes = 'pea-marquee-carousel-wrapper pea-swiper-' . esc_attr($widget_id);
        if ($fade) {
            $wrapper_classes .= ' pea-marquee-has-fade';
        }
        ?>
        <div class="<?php echo esc_attr($wrapper_classes); ?>"
            data-swiper-settings='<?php echo esc_attr($data_settings); ?>'
            data-pause-on-hover="<?php echo $pause ? 'yes' : 'no'; ?>">

            <?php if ($fade): ?>
                <div class="pea-marquee-fade pea-marquee-fade-left"></div>
                <div class="pea-marquee-fade pea-marquee-fade-right"></div>
            <?php endif; ?>

            <div class="pea-marquee-swiper swiper">
                <div class="swiper-wrapper pea-marquee-swiper-wrapper" aria-live="off">
                    <?php foreach ($items as $index => $item):
                        $key = $this->get_repeater_setting_key('marquee_item', 'marquee_items', $index);
                        $this->add_render_attribute($key, [
                            'class' => 'pea-marquee-child-wrap swiper-slide pea-marquee-item elementor-repeater-item-' . esc_attr($item['_id']),
                            'slide-index' => $index + 1,
                            'role' => 'listitem',
                        ]);
                        ?>
                        <div <?php $this->print_render_attribute_string($key); ?>>
                            <?php $this->print_child($index); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }

    // -------------------------------------------------------------------------
    // Editor JS template
    // -------------------------------------------------------------------------

    protected function content_template_single_repeater_item()
    {
        ?>
        <# const elementUid=view.getIDInt().toString().substr(0,3), numOfItems=view.collection.length + 1, itemCount=numOfItems,
            itemKey='new-marquee-' + elementUid + itemCount; var
            itemClass='pea-marquee-child-wrap swiper-slide pea-marquee-item elementor-repeater-item-' + data._id;
            view.addRenderAttribute( itemKey, { 'class' : itemClass, 'slide-index' : itemCount, 'role' : 'listitem' , } ); #>
            <div {{{ view.getRenderAttributeString( itemKey ) }}}>
            </div>
            <?php
    }

    protected function content_template()
    {
        ?>
            <# if ( settings['marquee_items'] ) { var widgetId=view.getID(); var uniqueClass='pea-swiper-' + widgetId; var
                spvDesktop=settings.slides_per_view?.size || 4; var spvTablet=settings.slides_per_view_tablet?.size || 2; var
                spvMobile=settings.slides_per_view_mobile?.size || 1; var gapDesktop=settings.slides_gap?.size || 20; var
                gapTablet=settings.slides_gap_tablet?.size || 15; var gapMobile=settings.slides_gap_mobile?.size || 10; var
                speed=settings.marquee_speed?.size || 5000; var isRight=settings.marquee_direction==='right' ; var
                pauseHover=settings.pause_on_hover==='yes' ; var showFade=settings.show_fade_edges==='yes' ; var
                swiperSettings={ slidesPerView : spvDesktop, spaceBetween : gapDesktop, loop : true, freeMode : true,
                allowTouchMove: true, speed : speed, autoplay : { delay: 0, disableOnInteraction: false, reverseDirection:
                isRight, pauseOnMouseEnter: pauseHover }, breakpoints: { 0 : { slidesPerView: spvMobile, spaceBetween: gapMobile
                }, 768 : { slidesPerView: spvTablet, spaceBetween: gapTablet }, 1025: { slidesPerView: spvDesktop, spaceBetween:
                gapDesktop } } }; const elementUid=view.getIDInt().toString().substr(0,3); var
                wrapperClass='pea-marquee-carousel-wrapper pea-swiper-' + widgetId; if ( showFade ) { wrapperClass
                +=' pea-marquee-has-fade' ; } #>
                <div class="{{ wrapperClass }}" data-swiper-settings="{{ JSON.stringify( swiperSettings ) }}"
                    data-pause-on-hover="{{ pauseHover ? 'yes' : 'no' }}">

                    <# if ( showFade ) { #>
                        <div class="pea-marquee-fade pea-marquee-fade-left"></div>
                        <div class="pea-marquee-fade pea-marquee-fade-right"></div>
                        <# } #>

                            <div class="pea-marquee-swiper swiper">
                                <div class="swiper-wrapper pea-marquee-swiper-wrapper" aria-live="off">
                                    <# _.each( settings['marquee_items'], function( item, index ) { var slideUid=elementUid +
                                        (index + 1); var itemKey='marquee-item-' + slideUid; var
                                        itemClass='pea-marquee-child-wrap swiper-slide pea-marquee-item elementor-repeater-item-'
                                        + item._id; view.addRenderAttribute( itemKey, { 'class' : itemClass, 'slide-index' :
                                        index + 1, 'role' : 'listitem' , } ); #>
                                        <div {{{ view.getRenderAttributeString( itemKey ) }}}></div>
                                        <# } ); #>
                                </div>
                            </div>
                </div>
                <# } #>
                    <?php
    }

    // -------------------------------------------------------------------------
    // Initial config
    // -------------------------------------------------------------------------

    protected function get_initial_config(): array
    {
        return array_merge(
            parent::get_initial_config(),
            [
                'support_improved_repeaters' => true,
                'target_container' => ['.pea-marquee-swiper-wrapper'],
                'node' => 'div',
                'is_interlaced' => true,
                'support_paste_all' => true,
                'container_settings' => [
                    'accepts' => ['container', 'widget', 'section'],
                ],
            ]
        );
    }
}