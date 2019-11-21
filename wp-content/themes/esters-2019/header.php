<?php
$theme = ThemeLib\Theme::instance();
$h_tpl = function($s) use ($theme) { include(__DIR__."/template-parts/header/$s.php"); };
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#bf9d3e">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<!-- favicon -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div id="theme-header__bird"><?= $theme->svg('bird'); ?></div>
			<h1 id="theme-header__logo"><a href="<?= home_url(); ?>"><?= $theme->svg('logo'); ?></a></h1>
			<div id="theme-header__account" class="hlist"><?php $h_tpl('account'); ?></div>
			<div id="theme-header__online-shops"><?php $h_tpl('online-shops'); ?></div>
			<button class="burger-btn burger-expand-btn clean-btn icon-btn btn"><?= $theme->svg('burger','icons'); ?></button>
			<button class="burger-btn burger-collapse-btn clean-btn icon-btn btn"><?= $theme->svg('no-alt','icons'); ?></button>
		</header><!-- #masthead -->
		<nav id="theme-nav">
			<?php wp_nav_menu(['theme_location' => 'menu-1', 'menu_class' => 'main-menu hlist']); ?>
			<?php get_search_form(); ?>
			<hr>
		</nav>
		<div id="content" class="site-content">
