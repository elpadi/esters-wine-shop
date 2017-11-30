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
                        <?php if( have_rows('events_slider') ): ?>
 	            <?php while( have_rows('events_slider') ): the_row(); ?>
                  <li class="item darken" style="background-image:url(<?php the_sub_field('slider_image'); ?>);">
                            <div class="center-item active">
                              <h2><?php the_sub_field('slider_title'); ?></h2>
                              <div class="additional-desc">
                                   <?php $sub_copy = get_sub_field('slider_copy');
					 
                                    if ($sub_copy) {
                                     echo '<p>'.get_sub_field('slider_copy').'</p>';
                                    } 
                                  ?>
                                   </div>
                                <a id="details" class="hidden">View Details</a>	
                            </div>
                        </li>
                   <?php endwhile; ?>
                    <?php endif; ?>
                        </ul>
                    <a class="scroll-down" href="#myCarousel" data-slide="next">Scroll</a>             
                </div>        
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="right-column-pd">
                    <h2 class="entry-head">Host Your Parties At Esters</h2>
                    <!-- new nav -->
                    <div id="menu" class="hidden-xs">
                        <ul>
                    <?php if( have_rows('events_slider') ): ?>
                        <?php $i = 0; ?>
 	                    <?php while( have_rows('events_slider') ): the_row();
                           
                            ?>
                          <li> <a data-slide-index="<?= $i; ?>" href=""><?php the_sub_field('slider_title'); ?></a>
                             <?php 
                               $i++;
                              endwhile; ?>
                            <?php endif; ?>
                           </ul>
                    </div>
                    <!-- // new nav -->
                    <h3 class="sub-head">Private Event Request</h3>
                    <p>Please complete the form below so that we may better assist you.</p>
                    <?php echo do_shortcode('[contact-form-7 id="843" title="Private Events"]');?>

                    <div class="entry-sm menu-select">
                        <p>If you have any further questions, please email <a href="mailto:events@esterswineshop.com">events@esterswineshop.com</a></p>
                    </div>
                </div>
            </div>
        </div>
</div>


