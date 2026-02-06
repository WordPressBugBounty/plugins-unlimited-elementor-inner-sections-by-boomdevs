<?php

namespace PrimeElementorAddons\Config;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Widget List Configuration
 *
 * Manages the list of available widgets, their configuration,
 * and registration status.
 *
 * @package PrimeElementorAddons
 * @since 1.0.0
 */

class WidgetList
{
    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private $widgets = [];

    public function __construct()
    {
        $this->init_widgets();
    }


    private function init_widgets()
    {
        $this->widgets = [
            'accordion' => [
                'slug' => 'accordion',
                'title' => 'Advanced Accordion',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/accordion.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedAccordion',
                'child' => 'false',
            ],
            'advanced-heading' => [
                'slug' => 'advanced-heading',
                'title' => 'Advanced Heading',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-heading.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedHeading',
                'child' => 'false',
            ],
            'advanced-button' => [
                'slug' => 'advanced-button',
                'title' => 'Advanced Button',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-button.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedButton',
                'child' => 'false',
            ],
            'advanced-image' => [
                'slug' => 'advanced-image',
                'title' => 'Advanced Image',
                'package' => 'free',
                'category' => 'media',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-image.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedImage',
                'child' => 'false',
            ],
            'advanced-navigation' => [
                'slug' => 'advanced-navigation',
                'title' => 'Advanced Navigation',
                'package' => 'free',
                'category' => 'navigation',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-navigation.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedMenu',
                'child' => 'false',
            ],
            'advanced-video' => [
                'slug' => 'advanced-video',
                'title' => 'Advanced Video',
                'package' => 'free',
                'category' => 'media',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-video.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedVideo',
                'child' => 'false',
            ],
            'call-to-action' => [
                'slug' => 'call-to-action',
                'title' => 'Call to Action',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/call-to-action.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'CallToAction',
                'child' => 'false',
            ],
            'countdown' => [
                'slug' => 'countdown',
                'title' => 'Countdown',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/countdown.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'CountDown',
                'child' => 'false',
            ],
            'counter-number' => [
                'slug' => 'counter-number',
                'title' => 'Counter Number',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/counter-number.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'Counter',
                'child' => 'false',
            ],
            'contact-form-7' => [
                'slug' => 'contact-form-7',
                'title' => 'Contact Form 7',
                'package' => 'free',
                'category' => 'form',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/form.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ContactForm7',
                'child' => 'false',
            ],
            'dual-button' => [
                'slug' => 'dual-button',
                'title' => 'Dual Button',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-button.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'DualButton',
                'child' => 'false',
            ],
            'features-list' => [
                'slug' => 'features-list',
                'title' => 'Features List',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/features-list.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'FeatureList',
                'child' => 'false',
            ],
            'flip-box' => [
                'slug' => 'flip-box',
                'title' => 'Flip Box',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/flip-box.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'FlipBox',
                'child' => 'false',
            ],
            'fluent-form' => [
                'slug' => 'fluent-form',
                'title' => 'Fluent Form',
                'package' => 'free',
                'category' => 'form',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/form.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'FluentForm',
                'child' => 'false',
            ],
            'image-gallery' => [
                'slug' => 'image-gallery',
                'title' => 'Image Gallery',
                'package' => 'free',
                'category' => 'media',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/image-gallery.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ImageGallery',
                'child' => 'false',
            ],
            'info-box' => [
                'slug' => 'info-box',
                'title' => 'Info Box',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/info-box.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'InfoBox',
                'child' => 'false',
            ],
            'icon-box' => [
                'slug' => 'icon-box',
                'title' => 'Icon Box',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/icon-box.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'IconBox',
                'child' => 'false',
            ],
            'post-grid' => [
                'slug' => 'post-grid',
                'title' => 'Post Grid',
                'package' => 'free',
                'category' => 'post',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/post-grid.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'PostGrid',
                'child' => 'false',
            ],
            'pricing-table' => [
                'slug' => 'pricing-table',
                'title' => 'Pricing Table',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/pricing-table.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'PricingTable',
                'child' => 'false',
            ],
            'progressbar' => [
                'slug' => 'progressbar',
                'title' => 'Progressbar',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/progressbar.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ProgressBar',
                'child' => 'false',
            ],
            'social-icons' => [
                'slug' => 'social-icons',
                'title' => 'Social Icons',
                'package' => 'free',
                'category' => 'social',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/social-icons.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'SocialIcons',
                'child' => 'false',
            ],
            'team-member' => [
                'slug' => 'team-member',
                'title' => 'Team Member',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/team-member.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'TeamMember',
                'child' => 'false',
            ],
            'testimonial' => [
                'slug' => 'testimonial',
                'title' => 'Testimonial',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/testimonial.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'Testimonial',
                'child' => 'false',
            ],
            'tabs' => [
                'slug' => 'tabs',
                'title' => 'Advanced Tabs',
                'package' => 'free',
                'category' => 'content',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/advanced-tabs.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'AdvancedTabs',
                'child' => 'false',
            ],
        ];
        $this->widgets = apply_filters('prime_elementor_addons_widgets_list', $this->widgets);
    }

    public function get_widgets()
    {
        return $this->widgets;
    }

    public function get_widget($slug)
    {
        return isset($this->widgets[$slug]) ? $this->widgets[$slug] : null;
    }

    public function get_default_widgets()
    {
        //now return init widgets
        return $this->widgets;
    }
}