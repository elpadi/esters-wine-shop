<?php
/**
 * Template Name: Tastings Template
 */
?>


<!-- Event Page Section -->
<section id="event-page" class="event-section">
	<div class="container">
		<div class="entry text-center">
			<h2 class="sec-title">TASTINGS AT ESTERS</h2>
			<div class="entry-content">
				<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('templates/content', 'page'); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>

</section>

<!-- Events at Esters Section -->

<section id="tastings" class="events-section tastings">
	<div class="text-center">
		<h2 class="sec-title">What's Upcoming At Esters</h2>
	</div>
	<div class="panel-group tastings-inner" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="container">
			<?php 
	  
	  	// $date =  date_i18n( get_option( 'date_format' ), strtotime( '11/15-1976' ) );
		$date = date('Y-m-d');
		query_posts( array( 'post_type' => 'events',	'meta_key' => 'real_date', 'orderby' => 'meta_value meta_value_num', 'order' => 'ASC', 
		'meta_compare' => '>=', 
		'meta_value' => $date) );

		$first = true;
		
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		
		if ( $first == true ) {
			
			$class = "in";
			$first = false;
			
		}
		
		else {
			
			$class=" ";
			
			}
		
		?>
			<div class="panel">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo the_ID();?>" aria-expanded="true" aria-controls="<?php echo the_ID();?>">
					<div class="row event-head event-link">
						<div class="col-sm-1 col-xs-2"><br>
							<h3>
								<?php echo the_field('date');?>
							</h3>
							<!--<h3><?php echo the_field('display_date');?></h3>-->
						</div>
						<div class="col-sm-3 col-xs-10">
							<div class="event-img" style="background:url(<?php echo the_field('image_one');?>) no-repeat center; background-size:contain;"></div>
						</div>
						<div class="col-sm-8 col-xs-12">
							<p class="event-description">
								<?php echo the_field('brief_description');?>
							</p>
						</div>
					</div>
				</a>
				<div id="<?php echo the_ID();?>" class="collapse <?php echo $class; ?> fade" role="tabpanel" aria-labelledby="EventInfo">
					<div class="panel-body">
						<div class="text-center">
							<h2 class="sec-title">
								<?php echo the_title();?>
							</h2>
						</div>
						<h4 class="text-center">
							<?php echo the_field('time');?>
						</h4>
						<p>
							<?php echo the_field('full_description');?>
						</p>
					</div>
				</div>
			</div>
			<?php endwhile; endif; wp_reset_query(); ?>
		</div>
	</div>

</section>