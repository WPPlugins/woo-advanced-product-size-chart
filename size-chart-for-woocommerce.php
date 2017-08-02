<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.multidots.com/
 * @since             1.0.0
 * @package           woo_advanced_product_size_chart
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Advanced Product Size Chart 
 * Plugin URI:        http://www.multidots.com/
 * Description:       Add product size charts with default template or custom size chart to any of your WooCommerce products.
 * Version:           1.4
 * Author:            Multidots
 * Author URI:        http://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       size-chart-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if (!defined('SIZE_CHART_PLUGIN_BASENAME')) {
   define('SIZE_CHART_PLUGIN_BASENAME', plugin_basename(__FILE__));
}

//Define Plugin Text Domain
define('SIZE_CHART_PLUGIN_TEXT_DOMAIN', 'size-chart-for-woocommerce');

//Plugin Slug
define('SIZE_CHART_PLUGIN_SLUG', 'size-chart-for-woocommerce');

//Plugin Name
define('SIZE_CHART_PLUGIN_NAME', 'Woocommerce Advanced Product Size Chart');

//Plugin Version
define('SIZE_CHART_PLUGIN_VERSION', '1.4');


// Define Plugin URL Define
if (!defined('SIZE_CHART_PLUGIN_URL')) {
    define('SIZE_CHART_PLUGIN_URL', plugin_dir_url(__FILE__));
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-size-chart-for-woocommerce-activator.php
 */
function activate_size_chart_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-size-chart-for-woocommerce-activator.php';
	$active_plugin = new Size_Chart_For_Woocommerce_Activator();
	Size_Chart_For_Woocommerce_Activator::activate($active_plugin);
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-size-chart-for-woocommerce-deactivator.php
 */
function deactivate_size_chart_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-size-chart-for-woocommerce-deactivator.php';
	Size_Chart_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_size_chart_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_size_chart_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-size-chart-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_size_chart_for_woocommerce() {

	$plugin = new Size_Chart_For_Woocommerce();
	$plugin->run();

}
run_size_chart_for_woocommerce();
