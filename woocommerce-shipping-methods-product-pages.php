<?php
/*
Plugin Name: WooCommerce Shipping Methods On Product Pages
Plugin URI: 
Description: WooCommerce Shipping Methods On Product Pages allows you to show enabled shipping methods on your single product pages
Version: 1.0
Author: Bradley Davis
Author URI: http://bradley-davis.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: woocommerce-smpp

@author		 Bradley Davis
@category    Admin
@package	 WooCommerce Shipping Methods On Prodct Pages
@since		 1.0

WooCommerce Shipping Methods On Product Pages. A Plugin that works with the WooCommerce plugin for WordPress.
Copyright (C) 2014 Bradley Davis - bd@bradley-davis.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.
*/
if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

/**
 * Check if WooCommerce is active
 * @since 1.0
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
	class Woo_SMPP {
		/**
		 * The Constructor!
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'woocommerce_single_product_summary', array( &$this, 'woo_smpp_output' ), 11 );
		}

		function woo_smpp_output() {
			setlocale(LC_MONETARY, 'en_US');
			$shipping_methods = WC()->shipping->load_shipping_methods();
			//var_dump($shipping_methods);
			echo '<div class="smpp-wrapper">';
			echo __('Shipping Options:', 'woocommerce-smpp');
			echo '<ul>';
			foreach ( $shipping_methods as $sm ) {
				if ( $sm->enabled === 'yes') :
					echo '<li><span class="smpp-title">' . esc_attr( $sm->method_title ) . '</span>' . money_format('%(#10n', esc_attr( $sm->fee ) ) . '</li>';
				endif;
			}
			echo '</ul></div>';
		}
	} // END class Woo_SMPP

	// Instantiate the class
	$woo_smpp = new Woo_SMPP();

endif; // If WC is active