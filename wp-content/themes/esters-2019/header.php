<?php
$h_tpl = function($s) { include(__DIR__."/template-parts/header/$s.php"); };
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div id="theme-header__bird"><?= theme_svg('bird'); ?></div>
			<h1 id="theme-header__logo"><a href="<?= home_url(); ?>"><?= theme_svg('logo'); ?></a></h1>
			<div id="theme-header__account" class="hlist"><?php $h_tpl('account'); ?></div>
			<div id="theme-header__online-shops"><?php $h_tpl('online-shops'); ?></div>
		</header><!-- #masthead -->
		<nav id="theme-nav">
			<?php wp_nav_menu(['theme_location' => 'menu-1', 'menu_class' => 'main-menu hlist']); ?>
			<?php get_search_form(); ?>
			<hr>
		</nav>
		<div id="content" class="site-content">
