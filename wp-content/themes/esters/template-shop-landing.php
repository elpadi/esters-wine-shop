<?php
/**
 * Template Name: Shop Landing
 */
?>
<section class="shop-section">
    <div class="container">
        <div class="wrapper">
            <div class="row equalHeights">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="entry">
                        <h3>Join Our Wine Clubs!</h3>
                        <p>Do you love wine and want to bring the Esters experience home with you on the regular? Each month, wines for the clubs are hand selected by our sommelier team: delicious, Esters-approved wines, from small producers. We have three different options, because wine is not one-size-fits-all.</p>
                        <ul class="list-inline">
                            <li><a class="btn btn-outline" href="<?= esc_url(home_url('/')); ?>product/savvy-sipper">Savvy Sipper</a></li>
                            <li><a class="btn btn-outline" href="<?= esc_url(home_url('/')); ?>product/adventurer/">Adventurer</a></li>
                            <li><a class="btn btn-outline" href="<?= esc_url(home_url('/')); ?>product/collector">Collector</a></li>
                        </ul>
                    </div><!-- entry -->
                </div><!-- col -->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="entry">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
								<h3>Shop Online!</h3>
								<p>Do you love wine and want to bring the Esters experience home with you on the regular? Esters-approved wines, from small producers and local vineyards!</p>
								<br>
								<ul class="list-inline"><li>
									<a class="btn btn-outline" href="<?= esc_url(home_url('/')); ?>shop/wines/">Shop Now!</a>
								</li></ul>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 hidden-sm hidden-xs">
								<figure class="img-holder">
                                	<?php // get the thumbnail id using the queried category term_id
									$wines_id = get_woocommerce_term_meta( 48, 'thumbnail_id', true );  ?>
								   <img src="<?= $image = wp_get_attachment_url( $wines_id ); ?>" class="img-responsive" alt="Wine">
								</figure>
                            </div><!-- col  -->
                        </div><!-- row -->
                    </div><!-- entry -->
                </div><!-- col -->
            </div><!-- row -->
		</div><!-- wrapper -->
	</div><!-- container -->
</section>
