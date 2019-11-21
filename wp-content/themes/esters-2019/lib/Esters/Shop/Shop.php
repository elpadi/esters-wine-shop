<?php
namespace ThemeLib\Esters\Shop;

class Shop {

	public static function generateCartCountHTML() { 
		return sprintf('<span id="theme-header__cart__num" class="round">%d</span>', function_exists('WC') ? WC()->cart->get_cart_contents_count() : 0);
	}

}
