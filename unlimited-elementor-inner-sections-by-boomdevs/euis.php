<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpmessiah.com/
 * @since             1.0.0
 * @package           Euis
 *
 * @wordpress-plugin
 * Plugin Name:       Prime Elementor Addons – Lightweight Elementor Widgets for Faster Pages
 * Plugin URI:        https://wpmessiah.com/product-category/wordpress/wordpress-plugins/
 * Description:       Lightweight Elementor Addons plugin with essential Elementor widgets: Accordion, Tabs, CTA, Pricing Table, Testimonials, Post Grid, forms & more.
 * Version:           1.1.0
 * Author:            WP Messiah
 * Author URI:        https://wpmessiah.com/
 * Elementor tested up to: 3.25.4
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       unlimited-elementor-inner-sections-by-boomdevs
 * Domain Path:       /languages 
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PEA_UEIS_BACKEND_URL', 'https://wpmessiah.com/wp-json/notification-api/v1/get');
define('PEA_PLUGIN_FILE', __FILE__);

// Check if autoloader exists before requiring
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    // Show admin notice if vendor folder is missing
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Prime Elementor Addons: vendor folder is missing. Please reinstall the plugin.</p></div>';
    });
    return;
}

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function pea_ueis_init_appsero_tracker() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
      require_once __DIR__ . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( '7d1e2808-f512-4e91-b06f-95ad6e5653e5', 'Prime Elementor Addons', __FILE__ );

    // Active insights
    $client->insights()->init();

}

pea_ueis_init_appsero_tracker();

function prime_elementor_addons(){
    PrimeElementorAddons\Plugin::instance();
}

prime_elementor_addons();