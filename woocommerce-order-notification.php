<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/Charl12-gb/WooCommerce-Order-Notification/
 * @since             1.0.0
 * @package           Woocommerce_Order_Notification
 *
 * @wordpress-plugin
 * Plugin Name:       woocommerce-order-notification
 * Plugin URI:        https://woocommerce-order-notification.com
 * Description:       Sends an email notification to the site administrator when an order is placed.
 * Version:           1.0.0
 * Author:            Charles GBOYOU
 * Author URI:        https://https://github.com/Charl12-gb/WooCommerce-Order-Notification//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-order-notification
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOCOMMERCE_ORDER_NOTIFICATION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-order-notification-activator.php
 */
function activate_woocommerce_order_notification() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-notification-activator.php';
	Woocommerce_Order_Notification_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-order-notification-deactivator.php
 */
function deactivate_woocommerce_order_notification() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-notification-deactivator.php';
	Woocommerce_Order_Notification_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_order_notification' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_order_notification' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-notification.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_order_notification() {

	$plugin = new Woocommerce_Order_Notification();
	$plugin->run();

}
run_woocommerce_order_notification();
