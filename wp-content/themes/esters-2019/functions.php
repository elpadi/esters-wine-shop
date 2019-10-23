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

call_user_func(function() {
	$enqueue = function() {
		$dist_dir = get_stylesheet_directory().'/assets/dist';
		$dist_url = get_stylesheet_directory_uri().'/assets/dist';

		$env = IS_LOCAL ? 'dev' : 'prod';
		if (is_admin()) {
			$env = "admin.$env";
			$css_deps = $js_deps = [];
		}
		else {
			$css_deps = ['wp-jquery-ui-dialog'];
			$js_deps = ['jquery-ui-dialog','wp-api'];
			wp_deregister_script('twentynineteen-touch-navigation');
		}

		wp_enqueue_style(THEME_NAME, "$dist_url/$env.css", $css_deps, filemtime("$dist_dir/$env.css"));
		wp_register_script(THEME_NAME, "$dist_url/$env.js", $js_deps, filemtime("$dist_dir/$env.js"));

		wp_localize_script(THEME_NAME, 'JS_VARS', apply_filters('js_vars', []));
		wp_enqueue_script(THEME_NAME);
	};
	add_action('wp_enqueue_scripts', $enqueue, 100);
	add_action('admin_enqueue_scripts', $enqueue, 100);
});


add_filter('js_vars', function($vars) {
	return array_merge_recursive($vars, [
		'URLS' => [
			'AJAX' => admin_url('admin-ajax.php'),
			'THEME' => get_stylesheet_directory_uri(),
		],
		'DEBUG' => WP_DEBUG ? 1 : 0,
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

$themeData['homeSlides'] = (new CustomizerSection('home_slides','Home Slideshow'))->addFields([
	['button','rollover','Prepend Slide',['value' => 'Prepend']],
], 'theme_mod')->addRepeater([
	['text','title'],
	['image','image'],
	['textarea','byline'],
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
	if (!WP_DEBUG && is_page('about')) {
		$content .= '<div class="embedded-map full-width"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3306.9544717866524!2d-118.49583638667592!3d34.01937958061484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2a4ce955a98e5%3A0x9f552a66874e8b9b!2sEsters%20Wine%20Shop%20%26%20Bar!5e0!3m2!1sen!2sus!4v1571803708124!5m2!1sen!2sus" width="800" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>';
	}
	return $content;
});
