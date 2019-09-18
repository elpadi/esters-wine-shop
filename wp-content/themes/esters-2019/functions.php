<?php
define('THEME_NAME', 'esters');

use WordpressLib\Theme\Assets;

require_once ABSPATH.'/vendor/autoload.php';

function theme_svg($name, $dir='img') {
	return file_get_contents(get_stylesheet_directory()."/assets/$dir/$name.svg");
}

add_action('wp_enqueue_scripts', function() {

	//$assets->js('main', ['jquery-ui-dialog']);
	
	$dist_dir = get_stylesheet_directory().'/assets/dist';
	$dist_url = get_stylesheet_directory_uri().'/assets/dist';

	$env = IS_LOCAL ? 'dev' : 'prod';
	wp_enqueue_style(THEME_NAME, "$dist_url/$env.css", ['wp-jquery-ui-dialog'], filemtime("$dist_dir/$env.css"));
	wp_enqueue_script(THEME_NAME, "$dist_url/$env.js", ['jquery-ui-dialog','wp-api'], filemtime("$dist_dir/$env.js"));

});

add_action('login_enqueue_scripts', function() {
	
	$dist_dir = get_stylesheet_directory().'/assets/dist';
	$dist_url = get_stylesheet_directory_uri().'/assets/dist';

	$file = 'login';
	wp_enqueue_style(THEME_NAME.'-login', "$dist_url/$file.css", [], filemtime("$dist_dir/$file.css"));
	wp_enqueue_script(THEME_NAME.'-login', "$dist_url/$file.js", [], filemtime("$dist_dir/$file.js"));

});

/*
add_filter('login_headerurl', function($url) { return home_url(); });
add_filter('login_headertext', function($text) { return htmlspecialchars('Writings & Media Archive'); });
 */

if (is_admin() == false) {

	add_filter('theme_mod_custom_logo', function($value) {
		return 1;
	});

	add_filter('get_custom_logo', function($html) {
		$end = '</a>';
		return str_replace($end, theme_svg('logo').$end, $html);
	});

}

add_filter('body_class', function($classes) {
	return $classes;
});

