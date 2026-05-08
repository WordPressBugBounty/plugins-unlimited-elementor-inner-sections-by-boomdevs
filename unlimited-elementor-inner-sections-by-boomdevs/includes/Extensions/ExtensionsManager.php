<?php

namespace PrimeElementorAddons\Extensions;

use PrimeElementorAddons\Traits\Singleton;
use PrimeElementorAddons\Config\ExtensionList;
use PrimeElementorAddons\Admin\ExtensionSettings;

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

class ExtensionsManager {

    use Singleton;

    public function __construct() {
        $this->init_extensions();
    }

    private function init_extensions() {
        $all_extensions    = ExtensionList::get_instance()->get_extensions();
        $active_extensions = ExtensionSettings::get_active_extensions();

        foreach ($all_extensions as $slug => $extension) {

            // Skip if not toggled on
            if (!isset($active_extensions[$slug]) || $active_extensions[$slug] !== true) {
                continue;
            }

            // Skip PRO extensions if pro not active
            if ($extension['package'] === 'pro' && !PEA_IS_PRO_ACTIVE) {
                continue;
            }

            $class = '\PrimeElementorAddons\Extensions\\' . $extension['class'];

            if ($extension['package'] === 'pro' && PEA_IS_PRO_ACTIVE) {
                $class = '\PrimeElementorAddonsPro\Extensions\\' . $extension['class'];
            }

            if (class_exists($class)) {
                $class::get_instance();
            }
        }
    }

    public function get_features() {
        return ExtensionList::get_instance()->get_extensions();
    }
}