<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}

// Remove Woo Styles
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

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


unset($file, $filepath);

function wc_subscriptions_custom_price_string( $pricestring ) {
	//echo "$pricestring";
    $newprice = str_replace( 'on the 15th of each month', '', $pricestring );
    return $newprice;
}
add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string' );
add_filter( 'woocommerce_subscription_price_string', 'wc_subscriptions_custom_price_string' );



add_action('wp_enqueue_scripts', function() {
	wp_register_script( 'my-ajax-request', get_stylesheet_directory_uri(). '/assets/scripts/query.js', ['jquery'], null, true);
	wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'my-ajax-request' );
});
add_action( 'wp_ajax_filter_action', 'filter_action' );
add_action( 'wp_ajax_nopriv_filter_action', 'filter_action', 20, 1); 

function filter_action(){
	global $post;	
        $wine_type = $_POST['wine_type'];
        $region = $_POST['region'];
        $variety = $_POST['variety'];
	
		
        
	if (empty($_POST['price'])) {
  	 $price = "0";
	} else {
        $price = $_POST["price"];
	   $priceArray = str_replace( "-", " ", $price);
	   $range = explode(" ", $priceArray);
	}
	
	
	//print_r($price);
    $args = array(
			'posts_per_page' => -1,
			//'post_type' => array('product', 'product_variation'),
			'post_type' => array('product'),
            'product_cat' => 'wines',
			'orderby' => 'title',
			'order'   => 'ASC',
		      'tax_query' => array(
           
           array(
                'taxonomy' => 'pa_wine-type',
                'field' => 'id',
                'terms' => $wine_type,
				'operator' => 'AND'
            ),
           array(
                'taxonomy' => 'pa_region',
                'field' => 'id',
                'terms' => $region,
				'operator' => 'AND'
            ),
          array(
                'taxonomy' => 'pa_grape-varietal',
                'field' => 'id',
                'terms' => $variety,
				'operator' => 'AND'
            ),
        ),
		/*
		=   equals
		!=  does not equal
		>   greater than
		>=  greater than or equal to
		<   less than
		<=  less than or equal to
		*/
	'meta_query' => array(
            	array(
                    'key' => '_price',
                    'value' => $range,
                   	 'compare' => 'BETWEEN',
					'type' => 'NUMERIC'
                ),
			 array(
                    'key' => '_virtual',
                    'value' => "no",
                   	'compare' => '='
					
                ),
            )
	);
  
//main args    
$the_query = new WP_Query( $args );
//print_r($the_query);
$query = new WP_Query( $args );
	

    
  if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
    $meta = get_post_meta($query->post->ID); 
	
	
	
	$price = get_post_meta($query->post->ID, '_price', true);
	$sku = get_post_meta($query->post->ID, '_sku', true);
	if (has_post_thumbnail($query->post->ID ) ) { 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'single-post-thumbnail' );
	}
	
get_template_part('woocommerce/content','product');
/*
echo '<li class="col-xs-12 col-sm-6 col-md-4">';
echo '<a href="'.get_permalink().'" class="woocommerce-LoopProduct-link">';
echo  '<img src="'.$image[0].'" alt="'.$query->post->post_title.'" class="attachment-shop_catalog size-shop_catalog wp-post-image" />';
echo '<h3>'.$query->post->post_title.'</h3>';
echo '<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>'.$price.'</span></span>
</a>';
echo '<div class="product_meta hidden"><a href="http://localhost:8888/legator/product/gh8-300-prs-ebony/" class="woocommerce-LoopProduct-link">
<span class="sku_wrapper">SKU: <span class="sku" itemprop="sku">'.$sku.'</span></span>
<span class="posted_in">Category: </span></a><a href="http://localhost:8888/legator/products/ninja/" rel="tag">Ninja</a></div></li>';
*/
		endwhile;
		wp_reset_postdata();
	else :
		get_template_part('woocommerce/loop/no-products-found');
	endif;
die();
	
} 

//search ajax query (***not in use****)

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

function load_search_results() {
    $query = $_POST['query'];
    
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        's' => $query
    );
    $search = new WP_Query( $args );
    
    ob_start();
    
    if ( $search->have_posts() ) : 
    
    ?>

		

		<?php
			while ( $search->have_posts() ) : $search->the_post();

				get_template_part('woocommerce/content','product');

			endwhile;
			

	else :
		get_template_part('woocommerce/loop/no-products-found');
	endif;
	
	$content = ob_get_clean();
	
	echo $content;
	die();
			
}



// shop query
/*
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive('product') ) return;
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'meta_query', array(array(
			'key' => '_virtual',
			'value' => "no",
			'compare' => '='
		)));
	
	}
}
*/

function search_filter($query) {
    if ( !is_admin() && $query->is_main_query() ) {
        if ($query->is_search) {
                
           // print_r("hello");
            
            $query->set('post_type', array('product'));

            $meta_query = array(
                'relation' => 'AND',
                array(
                    'key' => '_visibility',
                    'value' => 'visible',
                    'compare' => 'IN'
                ),
                array(
                    'key' => '_stock_status',
                    'value' => 'instock',
                    'compare' => '='
                )
            );

            $query->set('meta_query', $meta_query);
        }
    }
}

add_action('pre_get_posts','search_filter');









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
 need to add proper validation
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


// custom meta fields

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_private-events',
		'title' => 'Private Events',
		'fields' => array (
			array (
				'key' => 'field_588a448046f6d',
				'label' => 'Events Slider',
				'name' => 'events_slider',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_588a44ac46f6e',
						'label' => 'Slider Image',
						'name' => 'slider_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_588a44c546f6f',
						'label' => 'Slider Title',
						'name' => 'slider_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_588a44e146f70',
						'label' => 'Slider Copy',
						'name' => 'slider_copy',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'no',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-private-events.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



// Handle cart in header fragment for ajax add to cart
add_filter('add_to_cart_fragments', 'woocommerceframework_header_add_to_cart_fragment');

if (!function_exists('woocommerceframework_header_add_to_cart_fragment')) {
	function woocommerceframework_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
        <?php if (sizeof($woocommerce->cart->cart_contents)>0) :
		            echo ' <ul class="mini-cart active-cart">';
					else :
		            echo '<ul class="mini-cart active-cart">';
		            endif;
		 ?> 
			<li>
				<a onclick="javascript:location.href='/cart'" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>" class="cart-parent"><span>
				<?php echo sprintf(_n('<mark>%d </mark>', '<mark>%d</mark>', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>
				</span>

				</a>
				<?php

		        echo '<ul class="cart_list active">';
		          echo '<span class="arrow">arrow</span>';
		           if (sizeof($woocommerce->cart->cart_contents)>0) : 
				   echo '<div class="cart-header">';
				   echo sprintf(_n('<h4>You have %d item in your cart.</h4><div class="count-down"><i class="count"></i><span></span></div>', '<h4>You have %d items in your cart. </h4><div class="count-down"><i class="count"></i><span></span></div>', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
				   echo '</div>';
				   foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
			           $_product = $cart_item['data'];
			           if ($_product->exists() && $cart_item['quantity']>0) :
			              
						   echo '<li class="cart_list_product"><a href="'.get_permalink($cart_item['product_id']).'">';
							
			               echo '<figure class="crop-img">'.$_product->get_image(). '</figure>';
							echo '<h3>';
			               echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product).'</h3></a>';

			               if($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
			                   echo woocommerce_get_formatted_variation( $cart_item['variation'] );
			                 endif;

			               echo '<span class="price">'.woocommerce_price($_product->get_price()).'</span></li>';
			           endif;
			       endforeach;
				
		        	else: 
					
					echo '<li class="cart-title">'.__('<h3>There are no items in your cart.</h3>','woothemes').'</li>';
					
				
					endif;
		        	if (sizeof($woocommerce->cart->cart_contents)>0) :
		            echo '<ul class="inline">';
					echo '<li class="total"><strong>';
					
					

		            if (get_option('js_prices_include_tax')=='yes') :
		                _e('Total', 'woothemes');
		            else :
		                _e('Subtotal', 'woothemes');
		            endif;



		            echo ':</strong>'.$woocommerce->cart->get_cart_total();' ';

		            ?><span class="pull-right"><a onclick="javascript:location.href='/cart'" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn checkout-button checkout">View Cart</a></span></li><?php
					echo '</ul>';
		        endif;

		        echo '</ul>';

		    ?>
			</li>
		</ul>
        </div>
       
		<?php
		/* mini cart drop down when product added to cart
		if (sizeof($woocommerce->cart->cart_contents)>0){
			 echo '<script>setHover();</script>';
		}*/
		$fragments['ul.mini-cart.active-cart'] = ob_get_clean();

		return $fragments;

	}
}


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 2; // arranged in 2 columns
	return $args;
}


// Adds ACF options
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Esters Settings',
		'menu_title'	=> 'Esters Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

// Remove unwanted WooCommerce content
add_action('init', function() {
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
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
	_e('Shipping costs will be calculated once you have provided your address.', 'woocommerce');
}

add_filter('post_class', function($classes) {
	if (is_product()) $classes[] = 'single-product';
	return $classes;
});
add_filter('woocommerce_related_products_columns', function($columns) {
	return 4;
});
