<?php
// Remove Woo Styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

//add woo support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function wc_subscriptions_custom_price_string( $pricestring ) {
	//echo "$pricestring";
    $newprice = str_replace( 'on the 15th of each month', '', $pricestring );
    return $newprice;
}
add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string' );
add_filter( 'woocommerce_subscription_price_string', 'wc_subscriptions_custom_price_string' );

// removes Order Notes Title - Additional Information
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
//remove Order Notes Field
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );
function remove_order_notes( $fields ) {
 unset($fields['order']['order_comments']);
 return $fields;
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 / 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
 */
add_filter('woocommerce_output_related_products_args', function( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
});

// Remove unwanted WooCommerce content
add_action('init', function() {
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
});

add_action('esters_store_wrapper_outer_class', function($classes) {
	if (is_product_category() || is_product_tag()) $classes[] = 'products-wrapper';
	return $classes;
});
add_action('esters_store_wrapper_inner_class', function($classes) {
	if (is_product_category() || is_product_tag()) $classes[] = 'product-bg';
	return $classes;
});
add_action('woocommerce_before_shop_loop_item', function() {
	echo '<div class="product-meta">';
}, 20);
add_action('woocommerce_after_shop_loop_item', function() {
	echo '</div>';
}, -10);
// hide coupon fields in shopping cart
add_filter('woocommerce_coupons_enabled', function($isEnabled) {
	if (is_cart()) return false;
	return $isEnabled;
});

function esters_shipping_no_address_message() {
	print('Shipping costs will be calculated once you have provided your address.');
}

function product_loop_width_class_fix($classes) {
	foreach (['first','last'] as $class) {
		$key = array_search($class, $classes, true);
		if ($key !== false) unset($classes[$key]);
	}
	return $classes;
}
add_filter('post_class', function($classes) {
	if (is_woocommerce()) {
		$classes = product_loop_width_class_fix(array_unique($classes));
		$classes = array_merge($classes, ['col-xs-12','col-sm-6','col-md-4','product-single']);
		if (is_product()) $classes[] = 'single-product';
	}
	return $classes;
}, 100);

add_action('woocommerce_shop_loop_item_title', function() {
	printf('<h3>%s</h3>', get_the_title());
});
		
add_action('esters_product_listing_header', function() {
	if (is_product_category('wines')) get_template_part('templates/product-filter');
	if (is_product_category('gift-boxes')) get_template_part('templates/gifts-header');
});

add_action('woocommerce_after_single_product_summary', function() {
	global $product;
	if (!$product || $product->get_type() !== 'subscription') return;
	printf('<div class="fine-print">%s</div>', get_field('subscription_info', 'options'));
});

add_filter('woocommerce_empty_price_html', function($html, $product) {
	return sprintf('<a href="%s" class="btn btn-outline">%s</a>', $product->add_to_cart_url(), strtoupper(__('Buy now')));
}, 10, 2);

add_filter('woocommerce_get_price_html', function($html, $product) {
	if ($product->get_type() === 'subscription') return $html . ' / ' . __('month');
	return $html;
}, 10, 2);

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5b772b6970d02',
	'title' => 'Shop Landing',
	'fields' => array(
		array(
			'key' => 'field_5b772b743e8ff',
			'label' => 'Wine Clubs',
			'name' => 'wine_clubs',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5b772cb455aa6',
					'label' => 'Wine Clubs Title',
					'name' => 'wine_clubs_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5b772b9f3e900',
					'label' => 'Wine Clubs Copy',
					'name' => 'wine_clubs_copy',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
		),
		array(
			'key' => 'field_5b772bec3e901',
			'label' => 'Shop Online',
			'name' => 'shop_online',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5b772ccf55aa7',
					'label' => 'Shop Online Title',
					'name' => 'shop_online_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5b772bec3e902',
					'label' => 'Shop Online Copy',
					'name' => 'shop_online_copy',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page',
				'operator' => '==',
				'value' => '859',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

endif;
