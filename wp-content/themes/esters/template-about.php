<?php
/**
 * Template Name: About
 */
?>



<section class="about" id="about">
    <div class="container">
        <div class="entry">
            <div class="text-center">
            <h2 class="sec-title fadein">ABOUT ESTERS</h2>
            </div>
            <div class="entry-content fadein two-column">
				<?php the_field('intro'); ?>
            </div>
        </div>
        <div class="row">
        <div class="instagram-slider"></div>
        </div>
    </div>
    </section>


<section class="photo-gallery doc">
	<div class="container">
    	<div class="row">
      	<?php 
			$image_1 = get_field('image_1'); 
			$image_2 = get_field('image_2'); 
			$image_3 = get_field('image_3'); 
			$image_4 = get_field('image_4'); 
			$image_5 = get_field('image_5'); 
			$image_6 = get_field('image_6'); 
			$image_7 = get_field('image_7'); 
			$image_8 = get_field('image_8');
			$image_9 = get_field('image_9'); 
			$image_10 = get_field('image_10');
		?>     
      		<div class="col-sm-12 col-xs-12 sm-padding"> 
				 <?php if( $image_1 ): ?>
					<img src="<?php echo $image_1['url']; ?>" alt="<?php echo $image_1['alt']; ?>" class="img-responsive">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-2-lg.jpg" width="1198" height="799" alt="Esters and Husband" class="img-responsive">
				<?php endif; ?>
		  	</div>
      
		  	<div class="col-sm-6 col-xs-6 sm-padding"> 
		  		<?php if( $image_2 ): ?>
		  			<img src="<?php echo $image_2['url']; ?>" alt="<?php echo $image_2['alt']; ?>" class="img-responsive">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-3-tall.jpg" width="1198" height="799" alt="Chef making meat plate" class="img-responsive">
				<?php endif; ?>
		  		
		  		<?php if( $image_3 ): ?>
		  			<img src="<?php echo $image_3['url']; ?>" alt="<?php echo $image_3['alt']; ?>" class="img-responsive">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-1-md.jpg" width="1198" height="799" alt="Sausage Plate" class="img-responsive">
				<?php endif; ?>
		  	</div>
      
      		<div class="col-sm-6 sm-padding col-xs-6">
      			<?php if( $image_4 ): ?>
      				<img src="<?php echo $image_4['url']; ?>" alt="<?php echo $image_4['alt']; ?>" class="img-responsive lazy">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-3-md.jpg" width="595" height="892" alt="Esters Shop Interior" class="img-responsive lazy">
				<?php endif; ?>
				
				<?php if( $image_5 ): ?>
					<img src="<?php echo $image_5['url']; ?>" alt="<?php echo $image_5['alt']; ?>" class="img-responsive">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-2-tall.jpg" width="1198" height="799" alt="Ester Paper Bags" class="img-responsive">
				<?php endif; ?>
      		</div>
      
      		<div class="col-sm-12 col-xs-12 sm-padding"> 
      		<?php if( $image_6 ): ?>
      			<img src="<?php echo $image_6['url']; ?>" alt="<?php echo $image_6['alt']; ?>" class="img-responsive">
			<?php else: ?>
				<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-3-large.jpg" width="1198" height="799" alt="Esters Charcuterrie Platter" class="img-responsive">
			<?php endif; ?>
      		</div>
      		
      		<div class="col-sm-6 col-xs-6 sm-padding"> 
		  		<?php if( $image_7 ): ?>
		  			<img src="<?php echo $image_7['url']; ?>" alt="<?php echo $image_7['alt']; ?>" class="img-responsive">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-2-md.jpg" width="1198" height="799" alt="Proscuitto and Fig dish" class="img-responsive">
				<?php endif; ?>
		  		
		  		<?php if( $image_8 ): ?>
		  			<img src="<?php echo $image_8['url']; ?>" alt="<?php echo $image_8['alt']; ?>" class="img-responsive lazy">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-1-tall.jpg" width="595" height="892" alt="Ester" class="img-responsive lazy"> 
				<?php endif; ?>
		  	</div>
     		
     		<div class="col-sm-6 sm-padding col-xs-6">
      			<?php if( $image_9 ): ?>
      				<img src="<?php echo $image_9['url']; ?>" alt="<?php echo $image_9['alt']; ?>" class="img-responsive lazy">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-4-tall.jpg" width="1198" height="799" alt="Cocktails at Esters" class="img-responsive">
				<?php endif; ?>
				
				<?php if( $image_10 ): ?>
					<img src="<?php echo $image_10['url']; ?>" alt="<?php echo $image_10['alt']; ?>" class="img-responsive">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri();?>/dist/images/esters-4-md.jpg" width="1198" height="799" alt="Cheese and Olive Tapenade" class="img-responsive">
				<?php endif; ?>
      		</div>
    </div>
  </div>
</section>

<section class="gifts hidden" id="gifts">
    <div class="container">
        <div class="entry">
            <div class="text-center">
            <h2 class="sec-title fadein">GIFTS</h2>
            </div>
            <div class="entry-content fadein">
                <p>Esters has all your gifting needs!  Wine, goodies, gift baskets, flowers and gift cards.  We have pre-made and custom gift baskets available.  And check out all our packaging and wrapping options.  Please email <a href="mailto:hello@esterswineshop.com">hello@esterswineshop.com</a> for our current gift basket offerings as well as delivery options (in LA area only).</p>
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



<?php 

//get contact
get_template_part('templates/section', 'contact');

// get press
get_template_part('templates/section', 'press');

?>

<div class="entry text-center">
<a href="<?php echo site_url();?>/health-insurance-summary/" class="btn btn-white btn-md">Summary of Healthcare Surcharge &amp; Coverage</a>
</div>
