<?php
namespace ThemeLib;

use Functional as F;
use WordpressLib\Theme\Frontend;

class Theme extends Frontend {

	public function updateBodyClasses($classes) {
		global $post;

		if (is_page()) {
			if (!is_front_page() && !in_array($post->post_name, [
				'our-menu',
				'private-events',
			])) $classes[] = "page-template";

			if (in_array($post->post_name, ['our-menu','shop-landing'])) $classes[] = 'content-bg-pattern';

			if (in_array($post->post_name, ['terms-and-conditions','privacy-policy','terms-of-use'])) $classes[] = 'legal-page';
		}

		if (function_exists('is_woocommerce') && (is_shop() || is_product_category() || is_product_tag())) {
			$classes[] = 'content-bg-pattern';
			$classes[] = 'product-listing';
		}

		return parent::updateBodyClasses($classes);
	}

	protected function registerVendorScripts() {
		if ($gMapsKey = get_option('api_tokens_gmaps')) {
			wp_register_script('google-maps', "https://maps.googleapis.com/maps/api/js?key=$gMapsKey");
		}
	}

	protected function enqueueFrontScripts($vars) {
		global $post;

		extract($vars);

		$css_deps = ['wp-jquery-ui-dialog'];
		$js_deps = [$registerApp(['jquery-ui-dialog','wp-api'])];
		wp_deregister_script('twentynineteen-touch-navigation');

		$css_paths = ['template'];
		$js_paths = [];

		$dist_url .= '/frontend';
		$dist_dir .= '/frontend';

		if (function_exists('is_woocommerce')) {
			//$js_paths[] = 'shop';
			if (is_product()) {
				$css_paths[] = 'shop/product';
				$js_paths[] = 'shop/product';
			}
			if (is_shop() || is_product_category() || is_product_tag()) {
				$css_paths[] = 'shop/product-listing';
				$js_paths[] = 'shop/product-listing';
			}
			if (is_cart()) {
				$css_paths[] = 'shop/cart';
			}
			if (is_checkout()) {
				$css_paths[] = 'shop/checkout';
			}
			if (is_account_page()) {
				$css_paths[] = 'shop/account';
			}
		}

		if (is_page()) {
			$css_paths[] = "pages/$post->post_name";
			if (!in_array($post->post_name, ['home','our-menu','private-events','shop-landing'])) {
				$js_paths[] = 'page';
			}
			if ($post->post_name == 'about') $js_deps[] = 'google-maps';
			$js_paths[] = "pages/$post->post_name";
		}

		foreach(F\filter(F\map($css_paths, F\partial_left($assetFilename, 'css')), F\partial_left($isValidAsset, $dist_dir)) as $i => $filename) {
			$name = THEME_NAME.'-frontend-'.str_replace('/', '-', basename($filename));
			wp_enqueue_style($name, "$dist_url/$filename", $css_deps, filemtime("$dist_dir/$filename"));
		}

		// add at least the default page JS file, ensuring the global.js code (imported by base/app) is always enqueued.
		$js_names = F\filter(F\map($js_paths, F\partial_left($assetFilename, 'js')), F\partial_left($isValidAsset, $dist_dir));
		if (empty($js_names)) $js_names[] = $assetFilename('js', 'page');

		foreach($js_names as $i => $filename) {
			$name = THEME_NAME.'-'.str_replace('/', '-', $filename);
			wp_enqueue_script($name, "$dist_url/$filename", $js_deps, filemtime("$dist_dir/$filename"));
		}
	}

	protected function enqueueAdminScripts($vars) {
		extract($vars);

		$css_deps = [];
		$css_paths = [];

		$js_deps = [$registerApp()];
		$js_paths = [];

		$dist_url .= '/admin';
		$dist_dir .= '/admin';

		if (strpos($_SERVER['REQUEST_URI'], 'customize.php') !== FALSE) {
			$js_paths[] = 'customizer';
		}

		$js_names = F\filter(F\map($js_paths, F\partial_left($assetFilename, 'js')), F\partial_left($isValidAsset, $dist_dir));
		foreach($js_names as $i => $filename) {
			$name = THEME_NAME.'-'.str_replace('/', '-', $filename);
			wp_enqueue_script($name, "$dist_url/$filename", $js_deps, filemtime("$dist_dir/$filename"));
		}
	}

	protected function enqueueLoginScripts($vars) {
	}

}
