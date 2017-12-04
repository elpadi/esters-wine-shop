<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// get_header( 'shop' ); 

 $terms = '';
    foreach ( (array) wp_get_post_terms( get_the_ID(), 'product_cat') as $term ) {
        if ( empty($term->slug ) )
           continue;
        $terms .= $term->name;
}  ?>


	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		//do_action( 'woocommerce_before_main_content' );
	?>
    
     <?php if ( has_term('gift-boxes', 'product_cat', $post ) )  {  ?>
   
<section class="gifts " id="gifts">
    <div class="container">
        <div class="entry">
            <div class="text-center">
            <h2 class="sec-title fadein">GIFTS</h2>
            </div>
            <div class="entry-content fadein">
                <p>Esters has all your gifting needs!  Wine, goodies, gift baskets, flowers and gift cards.  We have pre-made and custom gift baskets available.</p>
            </div>
        <div class="gift-gallery">
            <div class="row">
            <div class="col-xs-8">
                <div class="row">
                    <div class="col-sm-12 sm-padding">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/gifts6.jpg" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 sm-padding">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/gifts3.jpg" class="img-responsive">
                    </div>
                    <div class="col-xs-6 col-sm-6 sm-padding">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/gifts2.jpg" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-sm-12 sm-padding">
                    <img src="<?php echo get_template_directory_uri();?>/dist/images/gifts1.jpg" class="img-responsive">

                    <img src="<?php echo get_template_directory_uri();?>/dist/images/gifts5.jpg" class="img-responsive">

                    <img src="<?php echo get_template_directory_uri();?>/dist/images/gifts4.jpg" class="img-responsive">
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

</section>
<?php } ?>
    
    <div class="filter-section">
 <div class="container">
  <div class="entry-content text-center fadein">
               <?php if ($terms) {
                echo '<h2 class="sec-title large fadein">'.$terms.'</h2>';
    
                } else {
                    echo '<h2 class="sec-title large fadein">Shop</h2>';
                } ?>
           </div>
      <?php if ( has_term('wines', 'product_cat', $post ) )  {  ?>
      <a class="filter-dropdown visible-xs">FILTER PRODUCTS<i class="ion-navicon"></i></a>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10">
        <form id="filtering-form">
			<div class="row">
        <div class="filter-li col-xs-12 col-sm-3">
            <!-- pa_wine-type -->
            <?php
                if( $terms = get_terms( 'pa_wine-type') ) : // to make it simple I use default categories
                    echo '<select id="typefilter" name="typefilter" class="filter-select">

                    <option selected="selected">Wine Type</option>';
                    foreach ( $terms as $term ) :
                        echo '<option data-id="' . $term->term_id . '" value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                    endforeach;
                    echo '</select>';
                endif;
            ?>
        </div>
         <div class="filter-li col-xs-12 col-sm-3">
            <!-- pa_region -->
            <?php
                if( $terms = get_terms( 'pa_region') ) : // to make it simple I use default categories
                    echo '<select id="regionfilter" name="regionfilter" class="filter-select">

                    <option selected="selected">Region</option>';
                    foreach ( $terms as $term ) :
                        echo '<option data-id="' . $term->term_id . '" value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                    endforeach;
                    echo '</select>';
                endif;
            ?>
        </div>
        <div class="filter-li col-xs-12 col-sm-3">
            <!-- pa_grape -->
            <?php
                if( $terms = get_terms( 'pa_grape-varietal') ) : // to make it simple I use default categories
                    echo '<select id="varietyfilter" name="varietyfilter" class="filter-select">

                    <option selected="selected">Grape Varietal</option>';
                    foreach ( $terms as $term ) :
                        echo '<option data-id="' . $term->term_id . '" value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                    endforeach;
                    echo '</select>';
                endif;
            ?>
        </div>
       <div class="filter-li col-xs-12 col-sm-3">
            <!-- Max Price -->
                    <select id="price" name="price_max" tabindex="-98" class="filter-select">
                      <option selected="selected">Price</option>
                      <option data-id="0-25" value="0-25">$0 - $25</option>
                      <option data-id="25-50" value="25-50">$25 - $50</option>
                      <option data-id="51-100000" value="51-100000">$50 & Over</option>
                    </select>
        </div>
			</div>
            </form> 
		</div>
              <!--//col-->
            <div class="col-xs-12 col-sm-12 col-md-2 hidden-sm hidden-xs">
              
                <a class="btn btn-outline reset" href="#">Reset Filter</a>
                
                 
                   <?php
$form = '<div class="search-container hidden"><form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<div>
		<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search', 'woocommerce' ) . '" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__( '', 'woocommerce' ) .'" /><span class="icon-search"><i class="ion-ios-search-strong"></i></span><input type="hidden" name="post_type" value="product" />
	</div>
</form></div>';
echo $form; ?>
                          
		</div>   
      </div>

    
<?php }	 ?>
	</div>
</div>


	
	
	
<section class="products-wrapper" id="content">
      <div class="container">
      <div class="product-bg">
     
  
		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			// do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

          
			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				// do_action( 'woocommerce_before_shop_loop' );
			?>
     
        

			<?php woocommerce_product_loop_start(); ?>

				<?php //woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action( 'woocommerce_after_main_content' );
	?>
          </div>
	  </div>
</section>






