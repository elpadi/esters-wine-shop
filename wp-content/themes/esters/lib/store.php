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

/*
* Add checkbox to the checkout page
*/
add_action('woocommerce_before_order_notes', 'checkbox_custom_checkout_field');
 
function checkbox_custom_checkout_field( $checkout ) {
	echo '<div class="custom_checkbox"><h3>'.__('Is this a gift?').'</h3>';
	 
	woocommerce_form_field( 'custom_checkbox', array(
	'type'          => 'checkbox',
	'class'         => array('checkbox_field', 'giftcheckbox'),
	'label'         => __('Yes'),
	'required'      => false,
	), $checkout->get_value( 'custom_checkbox' ));
	 
	echo '</div>';
}

/*
* Update the order meta with field value
*/
add_action('woocommerce_checkout_update_order_meta', 'checkbox_custom_checkout_order_meta');
 
function checkbox_custom_checkout_order_meta( $order_id ) {
	if ($_POST['custom_checkbox']) update_post_meta( $order_id, 'Is a Gift', esc_attr($_POST['custom_checkbox']));
}

function wc_subscriptions_custom_price_string( $pricestring ) {
	//echo "$pricestring";
    $newprice = str_replace( 'on the 15th of each month', '', $pricestring );
    return $newprice;
}
add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string' );
add_filter( 'woocommerce_subscription_price_string', 'wc_subscriptions_custom_price_string' );

//gift fields 
/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'gift_recipient' );

function gift_recipient( $checkout ) {
	echo '<div style="display:none;" class="gift_recipient_wrapper" id="gift_recipient"><h3>' . __('Gift Recipient Info') . '</h3>';
	woocommerce_form_field( 'recipient', array(
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __('Recipient Name'),
	), $checkout->get_value( 'recipient' ));
	woocommerce_form_field( 'recipient_email', array(
		'type'          => 'email',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __('Recipient Email'),
	), $checkout->get_value( 'recipient_email' ));
	woocommerce_form_field( 'recipient_address', array(
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __('Recipient Address'),
	), $checkout->get_value( 'recipient_address' ));
	woocommerce_form_field( 'recipient_city', array(
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __(' City'),
	), $checkout->get_value( 'recipient_city' ));
	woocommerce_form_field( 'recipient_state', array(
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __(' State'),
	), $checkout->get_value( 'recipient_state' ));
	woocommerce_form_field( 'recipient_zip', array(
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __(' Zip'),
	), $checkout->get_value( 'recipient_zip' ));
	woocommerce_form_field( 'recipient_phone', array(
		'type'          => 'phone',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __(' Phone'),
	), $checkout->get_value( 'recipient_phone' ));
	woocommerce_form_field( 'gift_field', array(
		'type'          => 'textarea',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => false,
		'placeholder'   => __('Gift Note'),
	), $checkout->get_value( 'gift_field' ));
	echo '</div>';
}

/**
 * Process the checkout
 * Need to add proper validation
 *
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
	// Check if set, if its not set add an error.
	if ( ! $_POST['my_field_name'] )
			wc_add_notice( __( 'Please enter something into this new shiny field.' ), 'error' );
}
*/

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['gift_field'] ) ) {
        update_post_meta( $order_id, 'Gift Note', sanitize_text_field( $_POST['gift_field'] ) );
    }
    if ( ! empty( $_POST['recipient'] ) ) {
        update_post_meta( $order_id, 'recipient', sanitize_text_field( $_POST['recipient'] ) );
    }
    if ( ! empty( $_POST['recipient_email'] ) ) {
        update_post_meta( $order_id, 'recipient_email', sanitize_text_field( $_POST['recipient_email'] ) );
    }
    if ( ! empty( $_POST['recipient_address'] ) ) {
        update_post_meta( $order_id, 'recipient_address', sanitize_text_field( $_POST['recipient_address'] ) );
    }
    if ( ! empty( $_POST['recipient_city'] ) ) {
        update_post_meta( $order_id, 'recipient_city', sanitize_text_field( $_POST['recipient_city'] ) );
    }
    if ( ! empty( $_POST['recipient_state'] ) ) {
        update_post_meta( $order_id, 'recipient_state', sanitize_text_field( $_POST['recipient_state'] ) );
    }
     if ( ! empty( $_POST['recipient_zip'] ) ) {
        update_post_meta( $order_id, 'recipient_zip', sanitize_text_field( $_POST['recipient_zip'] ) );
    }
     if ( ! empty( $_POST['recipient_phone'] ) ) {
        update_post_meta( $order_id, 'recipient_phone', sanitize_text_field( $_POST['recipient_phone'] ) );
    }
      if ( ! empty( $_POST['gift_field'] ) ) {
        update_post_meta( $order_id, 'Gift Note', sanitize_text_field( $_POST['gift_field'] ) );
    }
}

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
