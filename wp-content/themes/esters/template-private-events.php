<?php
/**
 * Template Name: Private Events Template
 */
?>
<div class="private-dining">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="slide-container">        
				<ul class="bxslider">
					<?php if( have_rows('events_slider') ): while( have_rows('events_slider') ): the_row(); ?>
					<li class="item darken" style="background-image:url(<?php the_sub_field('slider_image'); ?>);">
						<div class="center-item active">
							<h2><?php the_sub_field('slider_title'); ?></h2>
							<div class="additional-desc"><?php if ($sub_copy = get_sub_field('slider_copy')) echo $sub_copy; ?></div>
							<a id="details" class="hidden">View Details</a>	
						</div>
					</li>
					<?php endwhile; endif; ?>
				</ul>
				<a class="scroll-down" href="#myCarousel" data-slide="next">Scroll</a>             
			</div><!-- slide-container -->
		</div><!-- col -->
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="right-column-pd">
				<h2 class="entry-head">Host Your Parties At Esters</h2>
				<div id="menu" class="hidden-xs">
				<ul>
					<?php if( have_rows('events_slider') ): $i = 0; while( have_rows('events_slider') ): the_row(); ?>
					<li>
						<a data-slide-index="<?= $i; ?>" href=""><?php the_sub_field('slider_title'); ?></a>
					</li>
					<?php $i++; endwhile;  endif; ?>
				</ul>
			</div>
			<!-- // new nav -->
			<h3 class="sub-head">Private Event Request</h3>
			<!--p>Please complete the form below so that we may better assist you.</p-->
			<?php //echo do_shortcode('[contact-form-7 id="843" title="Private Events"]'); ?>
			<script type="text/javascript" src="https://gatherhere.com/js/leadform.js" id="gather-loader" data-locationid="uzf7lw2m"></script>
			<div class="entry-sm menu-select">
				<p>If you have any further questions, please email <a href="mailto:events@esterswineshop.com">events@esterswineshop.com</a></p>
			</div>
		</div><!-- col -->
	</div><!-- row -->
</div><!-- private-dining -->
