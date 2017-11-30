<?php
/**
 * Template Name: Club
 */
?>
<div class="container">
<div id="content">


<div class="sub-sec">
            <div class="entry-content text-center fadein">
                <h2 class="sec-title large fadein">Join our Wine Clubs!</h2>
                <p>Do you love wine and want to bring the Esters experience home with you on the regular ? Each month, wines for the clubs are hand selected by our sommelier team: delicious, Esters-approved wines, from small producers. We have three different options, because wine is not one-size-fits-all.</p>
            </div>
        </div>
        <ul class="products row">

					<?php
			$params = array(
        'posts_per_page' => -1,
        'post_type' => 'product',
		'meta_query' => array(
			 array(
                    'key' => '_virtual',
                    'value' => "yes",
                   	'compare' => '='
					
                ),
            )
); 
			$wc_query = new WP_Query($params); 
			?>
			<?php if ($wc_query->have_posts()) :  ?>
			<?php while ($wc_query->have_posts()) : 
							$wc_query->the_post();  ?>
			<?php wc_get_template_part( 'club', 'product' ); ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata();  ?>
			<?php else:  ?>
			<p>
				 <?php _e( 'No Products' );  ?>
			</p>
			<?php endif; ?>
	</ul>
			
</div>
</div>
