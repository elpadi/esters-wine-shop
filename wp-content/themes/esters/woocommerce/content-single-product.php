<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
$product_type = $product->product_type;

if ($product_type == "subscription") {
	$alt_class = "col-xs-12 col-sm-12 col-md-6";
	
} else {
	$alt_class = "col-xs-12 col-sm-12 col-md-6";
	$hidden_class = "hidden";
	}
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div class="single-product <?= $product_type; ?>-product" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>">
<div class="row">
    <div class="<?= $alt_class; ?>">
        <?php
            /**
             * woocommerce_before_single_product_summary hook.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action( 'woocommerce_before_single_product_summary' );
        ?>
    </div>


        <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="summary entry-summary">
                
                <?php
                    /**
                     * woocommerce_single_product_summary hook.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action( 'woocommerce_single_product_summary' );
                ?>
                
                <?php $product->get_categories( '', '',  get_the_terms( $post->ID, 'product_cat'), 'woocommerce' ); ?>
      <?php 
                /*
    $attributes = $product->get_attributes();
    
    foreach ( $attributes as $attribute ) :

		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) 
			continue;

		$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
		$att_val = apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

		if( empty( $att_val ) )
			continue; ?>
        <div class="att_label "><?php echo wc_attribute_label( $attribute['name'] ); ?></div>
		<div class="att_value"><?php echo $att_val; ?></div><!-- .att_value -->
	<?php endforeach;  */ ?>
					       

            </div><!-- .summary -->

            
            <?php
                /**
                 * woocommerce_after_single_product_summary hook.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
            
            
             
               
                //do_action( 'woocommerce_after_single_product_summary' );
            
           
               //remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            
            
            ?>

            <meta itemprop="url" content="<?php the_permalink(); ?>" />

        </div><!-- #product-<?php the_ID(); ?> -->

</div>
        
        
        <?php
     
                /**
                 * woocommerce_after_single_product_summary hook.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
            
            if ($product_type == "subscription") {
			
	
				} else {
					
				do_action( 'woocommerce_after_single_product_summary' );
			
			}
             
               
               
            
           
               remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            
            
            ?>
			<div class="fine-print <?= $hidden_class; ?>">
            <div class="entry-content">
                <h3>Perks of the Clubs</h3>
                <ul>
                    <li>Two bottles of wine every month</li>
                    <li>Free shipping of club wines</li>
                    <li>Two-bottle wine tote canvas bag</li>
                    <li>Info tag with each bottle: story behind the wine, technical information, pairing suggestions &amp; why we love it</li>
                    <li>Invite to pick-up parties where we open special wine just for club members</li>
                    <li>10% off retail purchases on the day of pick-up party  </li>                  
                </ul>
            </div>
            <div class="entry-content">
                <h3>The Fine Print</h3>
                <ul>
                    <li>Wines will be ready on the third monday of each month  </li>
				 	<li>Wines will be shipped the week of the pick up party  </li>
					<li>Prices include tax and shipping </li>
					<li>Shipments must be accepted by a person who is at least 21 years of age.  we check id and so do our shipping and delivery partners.</li> 
                </ul>
            </div>
            <div class="entry-content">
                <h3>CANCELLATION POLICY</h3>
                <ul>
                    <li>We require 30 days notice to cancel month-to-month subscriptions.</li>
                </ul>
            </div> 

                
			</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
