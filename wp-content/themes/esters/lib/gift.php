<?php
/*
* Add checkbox to the checkout page
*/
add_action('woocommerce_before_order_notes', 'gift_checkbox');
 
function gift_checkbox( $checkout ) {
	echo '<div class="custom_checkbox"><h3>'.__('Is this a gift?').'</h3>';
	woocommerce_form_field( 'custom_checkbox', array(
		'type'          => 'checkbox',
		'class'         => array('checkbox_field', 'giftcheckbox'),
		'label'         => __('Yes'),
		'required'      => false,
	), $checkout->get_value( 'custom_checkbox' ));
	echo '</div>';
}

function _get_gift_fields() {
	return [
		'name' => ['Recipient Name', 'text'],
		'email' => ['Recipient Email', 'email'],
		'address' => ['Recipient Address', 'text'],
		'city' => ['City', 'text'],
		'state' => ['State', 'text'],
		'zip' => ['Zip', 'text'],
		'note' => ['Gift Note', 'textarea'],
	];
}

function _legacy_gift_fieldname($fieldname) {
	$map = [
		'recipient_name' => 'recipient',
		'recipient_note' => 'Gift Note',
	];
	return isset($map[$fieldname]) ? $map[$fieldname] : $fieldname;
}

function _has_gift($id) {
	// is legacy
	if (get_post_meta($id, _legacy_gift_fieldname('recipient_note'), TRUE)) return TRUE;
	// is modern
	$order = wc_get_order($id);
	if ($order->meta_exists('recipient_note')) return TRUE;
	// is not a gift
	return TRUE;
	return FALSE;
}

add_action( 'woocommerce_after_order_notes', 'gift_form_fields' );
function gift_form_fields( $checkout ) {
	echo '<div style="display:none;" class="gift_recipient_wrapper" id="gift_recipient"><h3>' . __('Gift Recipient Info') . '</h3>';
	foreach (_get_gift_fields() as $name => $def) {
		$fieldname = "recipient_$name";
		woocommerce_form_field( $fieldname, array(
			'type'          => $def[1],
			'class'         => array('my-field-class form-row-wide'),
			'label'         => false,
			'placeholder'   => __($def[0]),
		), $checkout->get_value( $fieldname ));
	}
	echo '</div>';
}

add_action( 'woocommerce_checkout_update_order_meta', 'save_gift_fields' );
function save_gift_fields( $order_id ) {
	$order = wc_get_order($order_id);
	foreach (_get_gift_fields() as $name => $def) {
		$fieldname = "recipient_$name";
		$sanitizer = function_exists("sanitize_{$def[1]}_field") ? "sanitize_{$def[1]}_field" : 'sanitize_text_field';
    if (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) {
			$order->update_meta_data($fieldname, call_user_func($sanitizer, $_POST[$fieldname]));
		}
	}
	$order->save();
}

add_action('add_meta_boxes_shop_order', function($post) {
	if (_has_gift($post->ID)) add_meta_box(
		'gift_recipient_info',
		__('Gift Recipient'),
		'gift_recipient_info_metabox',
		NULL,
		'side'
	);
});
function gift_recipient_info_metabox($post) {
	$order = wc_get_order($post->ID);
	foreach (_get_gift_fields() as $name => $def) {
		$fieldname = "recipient_$name";
		$value = $order->meta_exists($fieldname) ? $order->get_meta($fieldname) : get_post_meta($post->ID, _legacy_gift_fieldname($fieldname), TRUE);
		printf('<p><strong>%s</strong>:<br>%s</p>', __($def[0]), nl2br($value));
	}
}

