<?php
/**
 * Plugin Name: Esters Wine Shop
 * Plugin URI: https://esterswineshop.com/
 * Description: Base code for WooCommerce store esterswineshop.com/
 * Version: 1.0.0
 * Author: Carlos Padilla
 * Author URI: https://cpadilla.thejackmag.com
 * Text Domain: esters
 *
 * @package Esters
 */

/*
add_filter('option_woocommerce_fedex_settings', function($settings) {
	if (WP_DEBUG) {
		var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $settings);
		exit(0);
	}
	return $settings;
}, 10, 2);
 */

/*
add_filter('woocommerce_shipping_fedex_instance_settings_values', function($settings, $instance) {
	if (WP_DEBUG) {
		var_dump($settings, $instance);
	}
	return $settings;
}, 10, 2);

add_action('woocommerce_update_options_shipping_fedex', function($value) {
	if (WP_DEBUG) {
		var_dump(__FILE__.":".__LINE__." - ".__METHOD__, 'woocommerce_update_options_shipping_' . $value);
	}
});

 */

/**
 * Fixes the issue with gift boxes, and only gift boxes, having to be shipped separately.
 *
 * This function must be run at the end of the FedEx method constructor.
 */
function esters_update_fedex_shipping(&$f) {
	if ($f->packing_method == 'box_packing') {
		$c = WC()->cart->get_cart();
		$hasGiftBoxes = false;
		$hasOtherItems = false;
		foreach ($c as $k => $v) {
			if (!$hasGiftBoxes && has_term('gift-boxes', 'product_cat', $v['product_id'])) {
				$f->instance_settings['packing_method'] = 'per_item';
				$f->packing_method = 'per_item';
				$hasGiftBoxes = true;
			}
			else {
				$hasOtherItems = true;
			}
		}
		if ($hasGiftBoxes && !$hasOtherItems) {
			wc_add_notice('Each gift box must be shipped separately.');
		}
		if ($hasGiftBoxes && $hasOtherItems) {
			wc_add_notice('Gift boxes (and therefore other items in this order) must be shipped separately. Buying the rest of the items in a separate order might save on the shipping cost.');
		}
	}
}

/*
if (WP_DEBUG) {

	add_filter('woocommerce_shipping_zone_shipping_methods', function($methods, $raw_methods, $allowed_classes, $zone) {
		foreach ($methods as &$m) {
			if (($m instanceof WC_Shipping_Fedex) && $m->packing_method == 'box_packing') {
			}
		}
		return $methods;
	}, 10, 4);

}
 */
