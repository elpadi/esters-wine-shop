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

global $esters_gift_box_shipping;

class GiftBoxShipping {

	protected $message = '';
	protected $hasGiftBoxes = false;
	protected $hasOtherItems = false;

	public function __construct() {
		$this->checkForGiftBoxes();
		add_action('woocommerce_before_cart', [$this, 'addNotice'], -10);
	}

	public function addNotice() {
		$this->createNoticeMessage();
		if ($this->message) wc_add_notice($this->message);
	}

	protected function checkForGiftBoxes() {
		$wc = WC();
		$c = $wc->cart ? $wc->cart->get_cart() : [];
		foreach ($c as $k => $v) {
			if ($this->hasGiftBoxes || has_term('gift-boxes', 'product_cat', $v['product_id'])) {
				$this->hasGiftBoxes = true;
			}
			if ($this->hasOtherItems || !has_term('gift-boxes', 'product_cat', $v['product_id'])) {
				$this->hasOtherItems = true;
			}
		}
	}

	protected function createNoticeMessage() {
		if ($this->hasGiftBoxes && !$this->hasOtherItems) {
			$this->message = 'Each gift box must be shipped separately.';
		}
		if ($this->hasGiftBoxes && $this->hasOtherItems) {
			$this->message = 'Gift boxes (and therefore other items in this order) must be shipped separately. Buying the rest of the items in a separate order might save on the shipping cost.';
		}
	}

	/**
	 * Fixes the issue with gift boxes, and only gift boxes, having to be shipped separately.
	 *
	 * This function must be run at the end of the FedEx method constructor.
	 */
	public function updateFedExPackingMethod(&$f) {
		if ($f->packing_method == 'box_packing' && $this->hasGiftBoxes) {
			$f->instance_settings['packing_method'] = 'per_item';
			$f->packing_method = 'per_item';
		}
	}

}

add_action('wp_loaded', function() {
	global $esters_gift_box_shipping;
	$esters_gift_box_shipping = new GiftBoxShipping();
});

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

add_filter('option_woocommerce_fedex_settings', function($settings) {
	if (WP_DEBUG) {
		var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $settings);
		exit(0);
	}
	return $settings;
}, 10, 2);

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

