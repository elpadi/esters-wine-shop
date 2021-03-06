<div id="theme-header__cart">
	<?= ThemeLib\Esters\Shop\Shop::generateCartCountHTML(); ?>
	<a href="<?= get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?= $theme->svg('cart', 'icons'); ?></a>
</div>
<div id="theme-header__user">
	<a id="theme-header__user__icon" href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?= $theme->svg('user', 'icons'); ?></a>
	<a href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?= is_user_logged_in() ? 'Account' : 'Log In'; ?></a>
</div>
