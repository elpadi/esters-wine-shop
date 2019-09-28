<?php
use WordpressLib\Theme\Assets;
use WordpressLib\Customizer\Section as CustomizerSection;

global $themeData;

define('THEME_NAME', 'esters');
$themeData = [];

require_once ABSPATH.'/vendor/autoload.php';

function theme_svg($name, $dir='img') {
	if (strpos("$name$dir", '.') !== FALSE) {
		throw new InvalidArgumentException("Neither SVG filename nor directory may contain any dots.");
	}
	return file_get_contents(get_stylesheet_directory()."/assets/$dir/$name.svg");
}

add_action('wp_enqueue_scripts', function() {

	//$assets->js('main', ['jquery-ui-dialog']);
	
	$dist_dir = get_stylesheet_directory().'/assets/dist';
	$dist_url = get_stylesheet_directory_uri().'/assets/dist';

	$env = IS_LOCAL ? 'dev' : 'prod';
	wp_enqueue_style(THEME_NAME, "$dist_url/$env.css", ['wp-jquery-ui-dialog'], filemtime("$dist_dir/$env.css"));
	wp_register_script(THEME_NAME, "$dist_url/$env.js", ['jquery-ui-dialog','wp-api'], filemtime("$dist_dir/$env.js"));
	
	wp_deregister_script('twentynineteen-touch-navigation');

	wp_localize_script(THEME_NAME, 'JS_VARS', apply_filters('js_vars', []));
	wp_enqueue_script(THEME_NAME);

}, 100);

add_filter('js_vars', function($vars) {
	return array_merge_recursive($vars, [
		'URLS' => [
			'AJAX' => admin_url('admin-ajax.php'),
			'THEME' => get_stylesheet_directory_uri(),
		],
	]);
});

function ajax_action($tag, $fn) {
	add_action("wp_ajax_nopriv_$tag", $fn);
	add_action("wp_ajax_$tag", $fn);
}

ajax_action('icon_html', function() {
	echo theme_svg($_GET['name'], $_GET['dir']);
	wp_die();
});

ajax_action('instagram_feed', function() {
	$token = get_option('api_tokens_instagram');
	if ($token) {
		$resp = file_get_contents(sprintf('https://api.instagram.com/v1/users/self/media/recent/?access_token=%s',
			$token
		));
		if ($resp) {
			echo $resp;
			wp_die();
		}
	}
	wp_send_json_error();
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
	global $post;
	if (is_page()) {
		$classes[] = "page--$post->post_name";
	}
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

$themeData['legal'] = (new CustomizerSection('legalese_items','Legal Info'))->addFields([
	['text','copyright'],
	['page','tnc','Terms and Conditions'],
	['page','privacy','Privacy Policy'],
	['page','tou','Terms of Use'],
]);

$themeData['apiTokens'] = (new CustomizerSection('api_tokens','API Tokens'))->addFields([
	['text','instagram','Instagram API Access Token'],
]);

add_filter('the_content', function($content) {
	if (is_front_page()) {
		ob_start();
		get_template_part('template-parts/content/home-slideshow');
		$content = ob_get_clean().$content;
	}
	return $content;
});
