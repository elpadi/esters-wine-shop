<?php
namespace ThemeLib\Esters\Shop;

use Functional as F;

class FreeShipping {

	const SHIPPING_METHOD_ID = 'free_shipping';
	const CAT_SLUG = 'free-shipping';

	public function __construct() {
		// disable free shipping, except where needed
		add_filter('woocommerce_shipping_'.self::SHIPPING_METHOD_ID.'_is_available', [$this, 'isFreeShippingAvailable'], 100, 3);

		// when free shipping is available, disable other shipping methods
		add_filter('woocommerce_shipping_methods', [$this, 'disablePaidMethods']);
	}

	public function disablePaidMethods($shipping_methods) {
		$allowedMethods = [self::SHIPPING_METHOD_ID, 'local_pickup'];
		foreach (array_diff(array_keys($shipping_methods), $allowedMethods) as $id) {
			if (WP_DEBUG) {
				//dump(__FILE__.":".__LINE__." - ".__METHOD__, $id);
			}
			add_filter("woocommerce_shipping_{$id}_is_available", [$this, 'isFreeShippingNotAvailable'], 100, 3);
		}
		return $shipping_methods;
	}

	protected function productHasFreeShipping($id) {
		$isSubscription = has_term(self::CAT_SLUG, 'product_cat', $id);
		return $isSubscription;
	}

	protected function packageHasFreeShipping($package) {
		return F\every($package['contents'], function($content) { return $this->productHasFreeShipping($content['product_id']); });
	}

	public function isFreeShippingAvailable($available, $package, $method=null) {
		return $this->packageHasFreeShipping($package);
	}

	public function isFreeShippingNotAvailable($available, $package, $method=null) {
		return $this->packageHasFreeShipping($package) == FALSE;
	}

}
