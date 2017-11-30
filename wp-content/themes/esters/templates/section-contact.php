<div id="map-container"></div>
<section class="contact" id="info">
    <div class="container">
        <div class="entry">
            <div class="text-center">
            <h2 class="sec-title fadein"><?php the_field('footer_title', 'option'); ?></h2>
            </div>
            <div class="entry-content fadein">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 sm-entry border-col">
                        <h5><?php the_field('column_1_title', 'option'); ?></h5>
                        <p><a href="<?php the_field('google_map_link', 'option'); ?>" target="_blank"><?php the_field('address', 'option'); ?></a><br /><?php the_field('phone', 'option'); ?><br /><?php the_field('fax', 'option'); ?></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 sm-entry border-col">
                        <h5><?php the_field('column_2_title', 'option'); ?></h5>
                        <p><?php the_field('hours', 'option'); ?></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 sm-entry">
                        <h5><?php the_field('column_3_title', 'option'); ?></h5>
                         <p><a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></p>
                        <ul class="social-icons">
                            <li><a href="<?php the_field('instagram', 'option'); ?>" class="social-link" target="_blank"><i class="ion-social-instagram-outline"></i></a></li>
                            <li><a href="<?php the_field('twitter', 'option'); ?>" class="social-link" target="_blank"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="<?php the_field('facebook', 'option'); ?>" class="social-link" target="_blank"><i class="ion-social-facebook"></i></a></li>
                        </ul>
                        <div id="mc_embed_signup" class="text-center"> 
                            <form action="//esterswineshop.us12.list-manage.com/subscribe/post?u=d7bdbe6762bb767644ba2a49d&amp;id=df10a8e839" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                            <h5 class="sec-title small"><?php the_field('newsletter_sign-up_title', 'option'); ?></h5><br>
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;"><input type="text" name="b_d7bdbe6762bb767644ba2a49d_df10a8e839" tabindex="-1" value=""></div>
                            <input type="submit" value="SUBMIT" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>