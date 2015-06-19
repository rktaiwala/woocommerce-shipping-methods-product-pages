=== WooCommerce Shipping Methods On Product Pages ===
Contributors: Brad Davis
Tags: woocommerce, wocommerce-shipping
Requires at least: 4.0
Tested up to: 4.2.2
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

WooCommerce Shipping Methods On Product Pages allows you to display enabled shipping methods on a product page.

== Description ==
WooCommerce Shipping Methods On Product Pages allows you to display enabled shipping methods on a product page.

** Requires WooCommerce to be installed. **

== Installation ==

= WooCommerce Compatibility =

Tested on 2.3.10

1. Upload WooCommerce Image Hover to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. That's it.

== Frequently Asked Questions ==

= Will this work with my theme? =
Hard to say really, so many themes to test so little time.

= What hook is used to display the shipping methods? =
The hook that is used is woocommerce_single_product_summary, priority 11 on the content-single-product.php. This will output the shipping methods right after the price, if your theme uses the standard hook and priority (10).

== Changelog ==

= 1.0.1 =
* Starting to fill out shipping methods
* Added set currency option from WC Settings

= 1.0 =
* Original commit and released to the world