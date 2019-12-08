<?php
namespace ThemeLib\Esters\Shop;

use Functional as F;

/**
 * Enables free shipping by removing products with 'free-shipping' shipping class from shipping calculation.
 *
 * Makes products behave as virtual only if there are other products in the cart, therefore the order will still have a shipping address.
 *
 * If only free products are in the cart, then we enable the Free Shipping method.
 */
class FreeShipping {

	const SHIPPING_METHOD_ID = 'free_shipping';
	const SHIPPING_CLASS = 'free-shipping';

	public function __construct() {
		add_filter('woocommerce_shipping_'.self::SHIPPING_METHOD_ID.'_is_available', [$this, 'isFreeShippingAvailable'], 100, 3);
		add_filter('woocommerce_shipping_methods', [$this, 'filterEnabledMethods'], 100);

		add_filter('woocommerce_product_needs_shipping', [$this, 'productNeedsShipping'], 100, 2);
		/*
		// when free shipping is available, disable other shipping methods

		add_filter('woocommerce_shipping_rate_cost', [$this, 'shippingCostFilter'], 10, 2);

		add_filter('woocommerce_shipping_packages', function($packages) {
			var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $packages);
			exit(0);
		});
		 */
	}

	/**
	 * Enable method only if ALL products have free shipping.
	 */
	public function isFreeShippingAvailable($available, $package, $method=null) {
		return F\every($package['contents'], function($content) { return $this->productHasFreeShipping($content['product_id']); });
	}

	/**
	 * Disable paid methods if free shipping is available.
	 */
	public function filterEnabledMethods($shipping_methods) {
		$allowedMethods = [self::SHIPPING_METHOD_ID, 'local_pickup'];
		$hasNonFreeItems = FALSE;

		if ($cart = WC()->cart) {
			foreach ($cart->get_cart_contents() as $key => $lineItem) {
				$item = $lineItem['data'];
				if (!$item->is_virtual() && $item->get_shipping_class() != 'free-shipping') {
					$hasNonFreeItems = TRUE;
					break;
				}
			}
		}

		if (!$hasNonFreeItems) {
			foreach (array_diff(array_keys($shipping_methods), $allowedMethods) as $id) {
				unset($shipping_methods[$id]);
			}
		}

		return $shipping_methods;
	}

	

	/**
	 * Disable shipping if it has shipping class 'free-shipping' AND cart has non-free shipping items.
	 */
	public function productNeedsShipping($needsShipping, $product) {
		//var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $product->get_id(), $product->get_slug(), $product->get_shipping_class());
		$hasNonFreeItems = FALSE;
		if ($cart = WC()->cart) {
			foreach ($cart->get_cart_contents() as $key => $lineItem) {
				$item = $lineItem['data'];
				if ($item->get_id() == $product->get_id()) continue;
				//var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $item->get_id());
				if (!$item->is_virtual() && $item->get_shipping_class() != 'free-shipping') {
					$hasNonFreeItems = TRUE;
					//var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $item->get_shipping_class());
					break;
				}
			}
		}
		return ($hasNonFreeItems && $product->get_shipping_class() == 'free-shipping') ? FALSE : $needsShipping;
	}

	protected function productHasFreeShipping($id) {
		$product = wc_get_product($id);
		//var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $product->is_virtual(), $product->get_shipping_class());
		return $product->is_virtual() || $product->get_shipping_class() == 'free-shipping';
	}

	public function shippingCostFilter($cost, $rate) {
		if ($rate->get_method_id() == 'fedex' && $this->isFedexRateFree($rate)) return '0.00';
		return $cost;
	}

	/**
	 * If all dimensions and weight have a "1" value, then it is a free shipping item.
	 *
	 * Use the "packages" in the rate meta data:
	 *
	 * array(1) {
	 *   ["Package 1"]=>
	 *   string(26) "1 × 1 × 1 (in) 1lbs × 2"
	 * }
	 */
	protected function isFedexRateFree($rate) {
		$hasFreePackages = FALSE;
		$meta = $rate->get_meta_data();

		if (WP_DEBUG) {
			var_dump(__FILE__.":".__LINE__." - ".__METHOD__, $meta);
		}

		foreach ($meta as $key => $val) {

			if (!preg_match('/^Package [0-9]+$/', $key)) continue;
			else $hasFreePackages = TRUE;

			// if any package is not free, fail
			if (strpos($val, '1 × 1 × 1 (in) 1lbs × ') !== 0) return FALSE;

		}

		return $hasFreePackages;
	}

	/**
	 * Get meta data string for the shipping rate.
	 *
	 * @since 3.4.9
	 * @version 3.4.9
	 *
	 * @param array $params Meta data info to join.
	 *
	 * @return string Rate meta data.
	 */
	private function getFedexRateMetaData( $params ) {
		$meta_data = array();

		if ( ! empty( $params['name'] ) ) {
			$meta_data[] = $params['name'] . ' -';
		}

		if ( $params['length'] && $params['width'] && $params['height'] ) {
			$meta_data[] = sprintf( '%1$s × %2$s × %3$s (in)', $params['length'], $params['width'], $params['height'] );
		}
		if ( $params['weight'] ) {
			$meta_data[] = round( $params['weight'], 2 ) . 'lbs';
		}
		if ( $params['qty'] ) {
			$meta_data[] = '× ' . $params['qty'];
		}

		return implode( ' ', $meta_data );
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

	public function isFreeShippingNotAvailable($available, $package, $method=null) {
		return $this->packageHasFreeShipping($package) == FALSE;
	}

}
