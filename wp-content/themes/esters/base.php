<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?><!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.3.15/slick.css"/>

  <body <?php body_class(); ?>>
      
<?php if (!WP_DEBUG) echo '<div class="loader"></div>'; ?>
      
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container-fluid" role="document">
      <div class="content row">
        <main>
          <?php include Wrapper\template_path();
          
			if (is_page("about")) {
				
			} else {
				 get_template_part('templates/global', 'contact');
			}
          ?>
        </main><!-- /.main -->
       
      </div><!-- /.content -->
    </div><!-- /.wrap -->
      

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
    
    
    <!-- Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUp">
  <div class="modal-dialog" role="document">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Welcome to Esters</h4>
      </div>
      <div class="modal-body">
          <p>Sign up for updates on wine, gift boxes and tastings.</p>
          <div id="mc_embed_signup" class="text-center"> 
                            <form action="//esterswineshop.us12.list-manage.com/subscribe/post?u=d7bdbe6762bb767644ba2a49d&amp;id=df10a8e839" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
                            <div id="mc_embed_signup_scroll">
                           
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required="">
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;"><input type="text" name="b_d7bdbe6762bb767644ba2a49d_df10a8e839" tabindex="-1" value=""></div>
                            <input type="submit" value="SUBMIT" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            </form>
                        </div>
      </div>
      
    </div>
  </div>
</div>


  </body>
</html>
