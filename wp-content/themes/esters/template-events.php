<?php
/**
 * Template Name: Events Template
 */
?>

<section class="events" id="events">
    <div class="container">
        <div class="sub-sec">
            <div class="entry-content fadein">
            <div class="text-center">
                <h2 class="sec-title large fadein">ESTERS PRIVATE EVENTS</h2>
            </div>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('templates/content', 'page'); ?>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="entry entry-btns">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
                    <div class="col-xs-12 col-sm-4">
                        <a href="mailto:hello@esterswineshop.com" class="btn btn-block btn-white fadein">CONTACT US</a>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo site_url();?>/wp-content/uploads/2015/10/Catering-Menu.pdf" target="_blank" class="btn btn-block btn-white fadein">CATERING MENU</a>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <a href="#packages" rel="relativeanchor" class="btn btn-block btn-white fadein">EVENT PACKAGES</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="events-gallery">
        <div class="row">
            <div class="col-xs-8">
                <div class="row">
                    <div class="col-sm-12 sm-padding">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/events/img-5.jpg" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 sm-padding">
                        
                    <img src="<?php echo get_template_directory_uri();?>/dist/images/events/esters-green.png" class="img-responsive">

                    </div>
                    <div class="col-xs-6 col-sm-6 sm-padding">
                        <img src="<?php echo get_template_directory_uri();?>/dist/images/events/img-2.jpg" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-sm-12 sm-padding">
 
                    <img src="<?php echo get_template_directory_uri();?>/dist/images/events/img-3.jpg" class="img-responsive">
                       <img src="<?php echo get_template_directory_uri();?>/dist/images/events/img-1.jpg" class="img-responsive">                    <img src="<?php echo get_template_directory_uri();?>/dist/images/events/img-4.jpg" class="img-responsive">
                    
                    </div>
                </div>
            </div>
        </div>        
        </div> 

        <div class="sub-sec tasting-entry" id="packages">
            <div class="entry-content fadein">
                <div class="text-center">
                    <h2 class="sec-title fadein">Private Wine Tasting</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 fadein">
                        <div class="entry-table">
                            <ul>
                                <li>$80 per person or $700 minimum</li>
                                <li>individual selection of seasonal food and wine</li>
                                <li>pairing curated by our chef and sommelier</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <figure class="img-wrap">                        
                            <img src="<?php echo get_template_directory_uri();?>/dist/images/events/img-3.jpg" class="img-responsive">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-sec tasting-entry">
            <div class="entry-content fadein">
                <div class="text-center">
                    <h2 class="sec-title fadein">Showers/ Daytime Events</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <figure class="img-wrap">                        
                            <img src="<?php echo get_template_directory_uri();?>/dist/images/events/daytime.jpg" class="img-responsive">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-sm-6 fadein">
                        <div class="entry-table">
                        <ul>
                            <li>$45 per person (food only) or $1000 minimum</li>
                            <li>special menu options curated by Huckleberry Cafe</li>
                            <li>3hr window, must end by 4pm</li>
                            <li>beverages based off consumption</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-sec tasting-entry">
            <div class="entry-content fadein">
                <div class="text-center">
                    <h2 class="sec-title fadein">Cocktail Hour</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 fadein">
                        <div class="entry-table">
                        <ul>
                            <li>$300 minimum for a table</li>
                            <li>$500 minimum for half patio</li>
                            <li>2hr event, must end by 7pm</li>
                            <li>optional tailored cocktail hour menu</li>
                            <li>consumption based</li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <figure class="img-wrap">                        
                            <img src="<?php echo get_template_directory_uri();?>/dist/images/events/cocktail.jpg" class="img-responsive">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-sec tasting-entry">
            <div class="entry-content fadein">
                <div class="text-center">
                    <h2 class="sec-title fadein">Communal Table Reservation</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <figure class="img-wrap">                        
                            <img src="<?php echo get_template_directory_uri();?>/dist/images/events/patio.jpg" class="img-responsive">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-sm-6 fadein">
                        <div class="entry-table">
                        <ul>
                            <li>up to 15 guests</li>
                            <li>$500 minimum Sunday Thursday</li>
                            <li>$750 minimum Friday &amp; Saturday</li>
                            <li>consumption based</li>
                            <li>3hr window</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-sec tasting-entry">
            <div class="entry-content fadein">
                <div class="text-center">
                    <h2 class="sec-title fadein">Private Party Space</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 fadein">
                        <div class="entry-table">
                        <ul>
                            <li>$50 per person or $2000 minimum for half patio (add an additional $500 for weekend</li>
                            <li>$50 per person or $4000 minimum for full patio (add an additional $1000 for weekends)</li>
                            <li>special food menu curated by our chef</li>
                            <li>beverages based on consumption</li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <figure class="img-wrap">                        
                            <img src="<?php echo get_template_directory_uri();?>/dist/images/events/private.jpg" class="img-responsive">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-sec tasting-entry">
            <div class="entry-content fadein">
                <div class="text-center">
                    <h2 class="sec-title fadein">Buyouts</h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <figure class="img-wrap">                        
                            <img src="<?php echo get_template_directory_uri();?>/dist/images/events/buyouts.jpg" class="img-responsive">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-sm-6 fadein">
                        <div class="entry-table">
                        <ul>
                            <li>minimum $9000 during the week</li>
                            <li>minimum $12000 on weekend</li>
                            <li>special food menu curated by our chef</li>
                            <li>beverages based on consumption</li>
                            <li>use of entire shop and bar</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="entry entry-btns">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
                    <div class="col-xs-12 col-sm-4">
                        <a href="mailto:hello@esterswineshop.com" class="btn btn-block btn-white fadein">CONTACT US</a>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo site_url();?>/wp-content/uploads/2015/10/Catering-Menu.pdf" target="_blank" class="btn btn-block btn-white fadein">CATERING MENU</a>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <a href="#packages" rel="relativeanchor" class="btn btn-block btn-white fadein">EVENT PACKAGES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


