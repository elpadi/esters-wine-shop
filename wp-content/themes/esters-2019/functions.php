<?php
use WordpressLib\Theme\Assets;
use WordpressLib\Customizer\Section as CustomizerSection;

global $themeData;

define('THEME_NAME', 'esters');
$themeData = [];

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

$themeData['homeSlides'] = (new CustomizerSection('home_slides','Home Slideshow'))->addRepeater([
	['text','title'],
	['image','image'],
	['text','byline'],
	['page','page'],
], 5, 'Slide', 'theme_mod');

$themeData['onlineShops'] = (new CustomizerSection('online_shops','Online Shops'))->addRepeater([
	['text','title'],
	['text','url','URL'],
], 3, 'Shop');

$themeData['contactInfo'] = (new CustomizerSection('contact_info','Contact Info'))->addFields([
	['textarea','address'],
	['text','map_url','Map URL'],
	['text','phone'],
	['textarea','hours'],
	['text','email'],
	['text','instagram'],
	['text','twitter'],
	['text','facebook'],
	['textarea','newsletter'],
]);

add_filter('the_content', function($content) {
	if (is_front_page()) {
		ob_start();
		get_template_part('template-parts/content/home-slideshow');
		$content = ob_get_clean().$content;
	}
	return $content;
});
