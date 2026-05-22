<?php

namespace PrimeElementorAddons\Config;

use PrimeElementorAddons\Traits\Singleton;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Extension List Configuration
 *
 * Manages the list of available extensions, their configuration,
 * and registration status.
 *
 * @package PrimeElementorAddons
 * @since 1.3.1
 */

class ExtensionList {

    use Singleton;

    private $extensions = [];

    public function __construct()
    {
        $this->init_extensions();
    }


    private function init_extensions()
    {
        $this->extensions = [
            'sticky-section' => [
                'slug' => 'sticky-section',
                'title' => 'Sticky Section',
                'description' => 'Make sections stick to the top or bottom on scroll.',
                'package' => 'free',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/sticky-section.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'StickySection',
            ],
            'parallax-effect' => [
                'slug' => 'parallax-effect',
                'title' => 'Parallax Effect',
                'description' => 'Add parallax scrolling effects to sections and backgrounds.',
                'package' => 'pro',
                'badge' => 'pro',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/parallax-effect.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ParallaxEffect',
            ],
            'particle-effect' => [
                'slug' => 'particle-effect',
                'title' => 'Particle Effect',
                'description' => 'Add interactive particle animations to your sections.',
                'package' => 'pro',
                'badge' => 'pro',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/particle-effect.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ParticleEffect',
            ],
            'page-scrollbar' => [
                'slug' => 'page-scrollbar',
                'title' => 'Page Scrollbar Styler',
                'description' => 'Customize the appearance of the page scrollbar.',
                'package' => 'free',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/page-scrollbar.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ScrollBarStyler\Init',
            ],
            'custom-css' => [
                'slug' => 'custom-css',
                'title' => 'Custom Css',
                'description' => 'Write custom CSS with live preview to fully control your design.',
                'package' => 'free',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/custom-css.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'CustomCss',
            ],
            'custom-js' => [
                'slug' => 'custom-js',
                'title' => 'Custom Js',
                'description' => 'Add custom JavaScript to enhance functionality.',
                'package' => 'free',
                'badge' => 'freemium',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/custom-js.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'CustomJs',
            ],
            'conditional-content' => [
                'slug' => 'conditional-content',
                'title' => 'Conditional Content',
                'description' => 'Show or hide content based on conditions.',
                'package' => 'pro',
                'badge' => 'pro',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/conditional-content.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'ConditionalContent',
            ],
            'duplicator' => [
                'slug' => 'duplicator',
                'title' => 'Duplicator',
                'description' => 'Clone any post, page or template in one click.',
                'package' => 'free',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/duplicator.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'Duplicator',
            ],
            'wrapper-link' => [
                'slug' => 'wrapper-link',
                'title' => 'Wrapper Link',
                'description' => 'Make widgets, columns, or sections clickable with a custom link.',
                'package' => 'free',
                'badge' => 'free',
                'status' => 'true',
                'icon' => PEA_PLUGIN_URL . 'assets/icons/extensions/wrapper-link.svg',
                'doc' => 'https://wpmessiah.com/',
                'demo' => 'https://wpmessiah.com/',
                'complete' => 'true',
                'class' => 'WrapperLink',
            ],
        ];
        $this->extensions = apply_filters('prime_elementor_addons_extensions_list', $this->extensions);
    }

    public function get_extensions()
    {
        return $this->extensions;
    }

    public function get_extension($slug)
    {
        return isset($this->extensions[$slug]) ? $this->extensions[$slug] : null;
    }

    public function get_default_extensions()
    {
        //now return init extensions
        return $this->extensions;
    }
}
