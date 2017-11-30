<?php
/**
 * Template Name: Health Insurance Template
 */
?>

<section class="health">

<div class="container">
    <div class="text-center">
	   <h2 class="sec-title">HEALTH INSURANCE SUMMARY</h2>
    </div>
    <div class="entry text-center">
    	<h3 class="sec-title secondary">2015 Summary of Health Care Surcharge and Coverage</h3>
        <div class="health-head">
        <div class="row">
        	<div class="col-xs-4">
            	<h4>Surcharges</h4>
            </div>
        	<div class="col-xs-4">
            	<h4>Premiums</h4>
            </div>
        	<div class="col-xs-4">
            	<h4>Variance</h4>
            </div>
        </div>
         </div>
         <div class="row">
        	<div class="col-xs-4">
            	<p>$ 22,393.34</p>
            </div>
        	<div class="col-xs-4">
            	<p>$ 21,425.40</p>
            </div>
        	<div class="col-xs-4">
            	<p>$ 967.94</p>
            </div>
        </div>
       
    </div>
 	<div class="entry text-center">
        <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</div>
    
</section>




<?php 

//get contact
get_template_part('templates/section', 'contact');

// get press
get_template_part('templates/section', 'press');

?>

