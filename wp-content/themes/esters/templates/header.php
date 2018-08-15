<div id="order-online">
	<div id="order-online-inside">
		<h2><?php the_field('title_order', 'option'); ?></h2>
		<p>
			<?= order_online_button(1); ?>
			<span class="separator">&nbsp;</span>
			<?= order_online_button(2); ?>
			<span class="separator">&nbsp;</span>
			<?= order_online_button(3); ?>
		</p>
	</div>
</div>
   <div class="mobile-header visible-xs visible-sm">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
        <?php bloginfo('name'); ?>
    </a>
    <div class="bird"></div>
</div>
<div class="hamburger-menu">
    <div class="bar"></div>
</div>
<header class="banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-4 hidden">
                <div id="mc_embed_signup" class="hidden-xs hidden-sm text-center">
                    <form action="//esterswineshop.us12.list-manage.com/subscribe/post?u=d7bdbe6762bb767644ba2a49d&amp;id=df10a8e839" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <h5 class="sec-title small">SIGN UP FOR NEWSLETTER</h5><br>
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;"><input type="text" name="b_d7bdbe6762bb767644ba2a49d_df10a8e839" tabindex="-1" value="">
                            </div>
                            <input type="submit" value="SUBMIT" name="subscribe" id="mc-embedded-subscribe" class="button">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                <a class="brand" href="<?= esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>
        </div>
    </div>
    <div class="nav-container">
        <nav class="nav-primary">
            <?php
            if ( has_nav_menu( 'primary_navigation' ) ):
                wp_nav_menu( [ 'theme_location' => 'primary_navigation', 'menu_class' => 'main-menu nav-justified' ] );
            endif;
            /*
            <ul class="main-menu nav-justified">
            <li><a href="<?php echo site_url();?>/#top" rel="relativeanchor">HOME</a>
            </li>
            <li><a href="<?php echo site_url();?>/#about" rel="relativeanchor">OUR STORY</a>
            </li>
            <li><a href="<?php echo site_url();?>/#menu" rel="relativeanchor">MENU</a>
            </li>
            <li><a href="<?php echo site_url();?>/#gifts" rel="relativeanchor">GIFTS</a>
            </li>
            <li><a href="<?php echo site_url();?>/#info" rel="relativeanchor">INFO</a>
            </li>
            <li><a href="<?php echo site_url();?>/tastings">TASTINGS</a>
            </li>
            <li><a href="<?php echo site_url();?>/events">EVENTS</a>
            </li>
            <li><a href="<?php echo site_url();?>/shop">CLUB</a>
            </li>
            </ul>*/ ?>
        </nav>
        
        <?php
$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<div>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search', 'woocommerce' ) . '" />
        <i class="ion-ios-search-strong"></i>
		<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>';
?>
        
        <div class="product_form hidden-sm hidden-xs">
        <?php echo $form; ?>
        </div>
        
        <div id="add-to-cart" class="pull-right mobile-hide">
            <ul class="mini-cart active-cart">
                <li>
                    <a onclick="javascript:location.href=/cart/'" href="/cart/" title="View your shopping cart" class="cart-parent"> <span>
<mark>0</mark>
</span> </a>
                
                    <ul class="cart_list active"><span class="arrow">arrow</span>
                        <li class="cart-title">
                            <h3>There are no items in your cart.</h3>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="bird"></div>
</header>
