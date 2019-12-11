<?php
namespace ThemeLib\Esters\Shop;

class Shop {

	public function __construct() {
		add_action('woocommerce_after_single_product_summary', [$this, 'addProductDisclaimer'], -10);
		add_action('woocommerce_after_order_notes', [$this, 'addGiftSection']);
		add_action('woocommerce_checkout_update_order_meta', [$this, 'saveGiftData']);
		add_action('add_meta_boxes_shop_order', [$this, 'giftMetaBox']);
	}

	public static function getGiftFields() {
		return (!is_admin() && ($cart = WC()->cart) && $cart->needs_shipping()) ? [
			'email' => ['Recipient Email', 'email'],
			'phone' => ['Phone', 'text'],
			'note' => ['Gift Note', 'textarea'],
		] : [
			'name' => ['Recipient Name', 'text'],
			'email' => ['Recipient Email', 'email'],
			'address' => ['Recipient Address', 'text'],
			'city' => ['City', 'text'],
			'state' => ['State', 'text'],
			'zip' => ['Zip', 'text'],
			'phone' => ['Phone', 'text'],
			'note' => ['Gift Note', 'textarea'],
		];
	}

	public static function isGift($id) {
		$order = wc_get_order($id);
		return ($order->get_meta('is_order_gift') === 'true') ||
			// legacy check, checkbox value was not saved so check for name value
			!empty($order->get_meta('recipient_name'));
	}

	public function giftMetaBox($post) {
		if (static::isGift($post->ID)) add_meta_box(
			'gift_recipient_info',
			__('Gift Recipient'),
			[$this, 'giftMetaBoxContent'],
			NULL,
			'side'
		);
	}

	public function giftMetaBoxContent($post) {
		$order = wc_get_order($post->ID);
		foreach (static::getGiftFields() as $name => $def) {
			$fieldname = "recipient_$name";
			printf('<p><strong>%s</strong>:<br>%s</p>', __($def[0]), nl2br($order->get_meta($fieldname)));
		}
	}

	public function saveGiftData($order_id) {
		if (isset($_POST['is_order_gift']) && $_POST['is_order_gift'] === 'true') {
			$order = wc_get_order($order_id);
			$order->update_meta_data('is_order_gift', 'true');
			foreach (static::getGiftFields() as $name => $def) {
				$fieldname = "recipient_$name";
				$sanitizer = function_exists("sanitize_{$def[1]}_field") ? "sanitize_{$def[1]}_field" : 'sanitize_text_field';
				if (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) {
					$order->update_meta_data($fieldname, call_user_func($sanitizer, $_POST[$fieldname]));
				}
			}
			$order->save();
		}
	}

	public function addGiftSection($checkout) {
		include(locate_template('template-parts/shop/checkout-gift.php'));
	}


	public function addProductDisclaimer() {
		global $product;
		if (class_exists('WC_Product_Subscription') && ($product instanceof \WC_Product_Subscription)) {
			get_template_part('template-parts/shop/subscription-disclaimer');
		}
		get_template_part('template-parts/shop/product-disclaimer');
	}

	public static function generateCartCountHTML() { 
		return sprintf('<span id="theme-header__cart__num" class="round">%d</span>', function_exists('WC') ? WC()->cart->get_cart_contents_count() : 0);
	}

}
