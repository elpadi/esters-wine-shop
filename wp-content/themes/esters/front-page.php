
   <section class="slider-sec">
    <div class="main-slider Modern-Slider">
       <?php if( have_rows('slider') ): ?>
 	<?php while( have_rows('slider') ): the_row(); ?>
  <div class="item slide" style="background-image:url(<?php the_sub_field('hero_image'); ?>);">
	   <div class="info">
				<div class="entry">
			  <h3><?php the_sub_field('hero_title'); ?></h3>
			 	<?php $sub_copy = get_sub_field('sub_copy');
					  $link = get_sub_field('call-to-action');
			  		if ($sub_copy) {
					 echo '<p>'.get_sub_field('sub_copy').'</p>';
					} 
					
					if ($link) {
					 echo '<a href="'.get_sub_field('call-to-action').'" class="btn btn-outline">View <i class="ion-ios-arrow-right"></i></a>';
					} 
					?>
			</div>
		  </div> 
	  </div>
       <?php endwhile; ?>
<?php endif; ?>
       
        </div>
    <div class="address hidden">
        <p><a href="https://goo.gl/p19fkc" target="_blank">1314 Seventh Street, Santa Monica, CA 90401</a> | Phone: 310.899.6900</p>
    </div>
</section>

