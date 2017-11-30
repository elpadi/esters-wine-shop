<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

//print_r($product->product_type);

$product_type = $product->product_type;

the_field('product_short_description'); 
if ( $price_html = $product->get_price_html() ) : 
	if ($product_type == "subscription") { 
		//if product type is subsciption
		echo '<span class="price">'. $price_html.'/month</span>';
			} else { 
		echo '<span class="price">'. $price_html.'</span>';
		} 
endif; ?>
    <a href="<?php echo the_permalink();?>" class="btn btn-outline">BUY NOW</a>
