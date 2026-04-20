<?php

namespace PrimeElementorAddons\Utils;

use PrimeElementorAddons\Traits\Singleton;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Feature Loader Manager.
 *
 * Registers and initializes addon features
 * with support for free/pro and enable toggles.
 *
 * @package PrimeElementorAddons
 * @since 1.1.0
 */

class FeaturesManager {

    use Singleton;

    private $features = [];

    public function __construct() {

        $this->features = [
            'pea-features' => [
                'title' => 'Features',
                'extensions' => [
                    [
                        'key'    => 'custom-css',
                        'title'  => 'Custom CSS',
                        'class'  => \PrimeElementorAddons\Utils\WidgetCustomCss::class,
                        'is_pro' => false,
                        'enabled'=> true, // future ready for toggle
                    ],
                ]
            ]
        ];

        $this->init_features();
    }

    private function init_features() {

        foreach ($this->features as $group) {

            if (empty($group['extensions'])) {
                continue;
            }

            foreach ($group['extensions'] as $feature) {

                // Skip disabled features
                if (empty($feature['enabled'])) {
                    continue;
                }

                // Skip PRO features if not PRO
                if ($feature['is_pro'] === true && PEA_IS_PRO_ACTIVE === false) {
                    continue;
                }

                if (class_exists($feature['class'])) {
                    $feature['class']::get_instance();
                }
            }
        }
    }

    public function get_features() {
        return $this->features;
    }
}
