<?php
/*
Plugin Name: WooCommerce Shipping Methods On Product Pages
Plugin URI: 
Description: WooCommerce Shipping Methods On Product Pages allows you to show enabled shipping methods on your single product pages
Version: 1.0.1
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
			$smpp_currency = get_option( 'woocommerce_currency' );
			$shipping_methods = WC()->shipping->load_shipping_methods();
			//var_dump($shipping_methods);
			echo '<div class="smpp-wrapper">';
			echo __('Shipping Options:', 'woocommerce-smpp');
			echo '<ul>';
			foreach ( $shipping_methods as $smpp ) {
				if ( 'yes' === $smpp->enabled ) :

					// Flate Rate Shipping
					if ( 'flat_rate' === $smpp->id ) :
						if ( $smpp->cost_per_order != '' ) :
							$sm_method_string = $smpp->method_title . ': ' . money_format('%(#10n', $smpp->cost_per_order ) . $smpp_currency;
						endif;
					endif;

					// Free Shipping
					if ( 'free_shipping' === $smpp->id ) :
						$sm_method_string = $smpp->method_title . ': '. __( 'Orders above ', 'smpp' ) . money_format('%(#10n', $smpp->min_amount ) . $smpp_currency;
					endif;

					// International Delivery

					// Local Delivery
					if ( 'local_delivery' === $smpp->id ) :
						// Fixed per cart total
						if ( 'fixed' === $smpp->type ) :
							$sm_method_string = $smpp->method_title . ': ' . __( 'Per order', 'smpp' ) . money_format('%(#10n', $smpp->fee ) . $smpp_currency;
						elseif ( 'percent' === $smpp->type ) :
							// % of cart total
							$sm_method_string = $smpp->method_title . ': ' . $smpp->fee . __( '% of cart total', 'smpp' );
						elseif ( 'product' === $smpp->type ) :
							// Fixed per product
							$sm_method_string = $smpp->method_title . ': ' . money_format('%(#10n', $smpp->fee ) . ' ' . $smpp_currency . __( ' Per product', 'smpp' );
						endif;
					endif;

					// Local Pickup

					echo '<li><span class="smpp-title">' . esc_attr( $sm_method_string ) . '</li>';
					$sm_method_string = '';
				endif;
			}
			echo '</ul></div>';
		}
	} // END class Woo_SMPP

	// Instantiate the class
	$woo_smpp = new Woo_SMPP();

endif; // If WC is active