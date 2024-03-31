<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/Charl12-gb/WooCommerce-Order-Notification/
 * @since      1.0.0
 *
 * @package    Woocommerce_Order_Notification
 * @subpackage Woocommerce_Order_Notification/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Order_Notification
 * @subpackage Woocommerce_Order_Notification/includes
 * @author     Charles GBOYOU <gboyoucharles22@gmail.com>
 */
class Woocommerce_Order_Notification_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-order-notification',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
