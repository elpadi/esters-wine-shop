<?php

add_action('wp_enqueue_scripts', function() {
	wp_register_script( 'my-ajax-request', get_stylesheet_directory_uri(). '/assets/scripts/query.js', ['jquery'], null, true);
	wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'my-ajax-request' );
});
add_action( 'wp_ajax_filter_action', 'filter_action' );
add_action( 'wp_ajax_nopriv_filter_action', 'filter_action', 20, 1); 

function filter_action() {
	global $post;	
	$wine_type = $_POST['wine_type'];
	$region = $_POST['region'];
	$variety = $_POST['variety'];

	if (empty($_POST['price'])) {
		$price = "0";
	}
	else {
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
		while( $query->have_posts() ):
			$query->the_post();
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
		while ( $search->have_posts() ) :
			$search->the_post();
			get_template_part('woocommerce/content','product');
		endwhile;
	else :
		get_template_part('woocommerce/loop/no-products-found');
	endif;
	$content = ob_get_clean();
	echo $content;
	die();
}

// Handle cart in header fragment for ajax add to cart
add_filter('add_to_cart_fragments', 'woocommerceframework_header_add_to_cart_fragment');

if (!function_exists('woocommerceframework_header_add_to_cart_fragment')) {
	function woocommerceframework_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		if (sizeof($woocommerce->cart->cart_contents)>0) :
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
