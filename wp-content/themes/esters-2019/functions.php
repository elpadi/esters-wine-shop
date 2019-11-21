<?php
use Functional as F;
use WordpressLib\Theme\Assets;
use WordpressLib\Posts\CustomType;
use WordpressLib\Customizer\Section as CustomizerSection;
use ThemeLib\ACF\EventFields;
use ThemeLib\Esters\Shop\FreeShipping;

global $themeData;

define('THEME_NAME', 'esters');
$themeData = [];

require_once ABSPATH.'/vendor/autoload.php';
require_once __DIR__.'/custom-fields.php';

function theme_svg($name, $dir='img') {
	if (strpos("$name$dir", '.') !== FALSE) {
		throw new InvalidArgumentException("Neither SVG filename nor directory may contain any dots.");
	}
	return file_get_contents(get_stylesheet_directory()."/assets/$dir/$name.svg");
}

call_user_func(function() {
	$dist_dir = get_stylesheet_directory().'/assets/dist';
	$dist_url = get_stylesheet_directory_uri().'/assets/dist';

	$env = IS_LOCAL ? 'dev' : 'prod';

	$assetFilename = function($ext, $p) use ($env) { return "$p.$env.$ext"; };
	$isValidAsset = function($dist_dir, $filename) { return is_readable("$dist_dir/$filename") && filesize("$dist_dir/$filename"); };

	$registerApp = function($js_deps=[]) use ($env, $dist_dir, $dist_url) {
		$name = THEME_NAME.'-app';
		$filename = "app.$env.js";
		wp_register_script($name, "$dist_url/$filename", $js_deps, filemtime("$dist_dir/$filename"));
		wp_localize_script($name, 'JS_ENV', apply_filters('js_vars', []));
		return $name;
	};

	$vars = get_defined_vars();

	add_action('wp_enqueue_scripts', function() use ($vars) {
		global $post;

		extract($vars);

		$css_deps = ['wp-jquery-ui-dialog'];
		$js_deps = [$registerApp(['jquery-ui-dialog','wp-api'])];
		wp_deregister_script('twentynineteen-touch-navigation');

		$css_paths = ['template'];
		$js_paths = [];

		$dist_url .= '/frontend';
		$dist_dir .= '/frontend';

		if (function_exists('is_woocommerce')) {
			//$js_paths[] = 'shop';
			if (is_product()) {
				$css_paths[] = 'shop/product';
				$js_paths[] = 'shop/product';
			}
			if (is_shop() || is_product_category() || is_product_tag()) {
				$css_paths[] = 'shop/product-listing';
				$js_paths[] = 'shop/product-listing';
			}
			if (is_cart()) {
				$css_paths[] = 'shop/cart';
			}
			if (is_checkout()) {
				$css_paths[] = 'shop/checkout';
			}
			if (is_account_page()) {
				$css_paths[] = 'shop/account';
			}
		}

		if (is_page()) {
			$css_paths[] = "pages/$post->post_name";
			if (!in_array($post->post_name, ['home','our-menu','private-events','shop-landing'])) {
				$js_paths[] = 'page';
			}
			$js_paths[] = "pages/$post->post_name";
		}

		foreach(F\filter(F\map($css_paths, F\partial_left($assetFilename, 'css')), F\partial_left($isValidAsset, $dist_dir)) as $i => $filename) {
			$name = THEME_NAME.'-frontend-'.str_replace('/', '-', basename($filename));
			wp_enqueue_style($name, "$dist_url/$filename", $css_deps, filemtime("$dist_dir/$filename"));
		}

		// add at least the default page JS file, ensuring the global.js code (imported by base/app) is always enqueued.
		$js_names = F\filter(F\map($js_paths, F\partial_left($assetFilename, 'js')), F\partial_left($isValidAsset, $dist_dir));
		if (empty($js_names)) $js_names[] = $assetFilename('js', 'page');

		foreach($js_names as $i => $filename) {
			$name = THEME_NAME.'-'.str_replace('/', '-', $filename);
			wp_enqueue_script($name, "$dist_url/$filename", $js_deps, filemtime("$dist_dir/$filename"));
		}
	}, 100);

	add_action('admin_enqueue_scripts', function() use ($vars) {
		extract($vars);

		$css_deps = [];
		$css_paths = [];

		$js_deps = [$registerApp()];
		$js_paths = [];

		$dist_url .= '/admin';
		$dist_dir .= '/admin';

		if (strpos($_SERVER['REQUEST_URI'], 'customize.php') !== FALSE) {
			$js_paths[] = 'customizer';
		}

		$js_names = F\filter(F\map($js_paths, F\partial_left($assetFilename, 'js')), F\partial_left($isValidAsset, $dist_dir));
		foreach($js_names as $i => $filename) {
			$name = THEME_NAME.'-'.str_replace('/', '-', $filename);
			wp_enqueue_script($name, "$dist_url/$filename", $js_deps, filemtime("$dist_dir/$filename"));
		}
	}, 100);
});


add_filter('js_vars', function($vars) {
	return array_merge_recursive($vars, [
		'URLS' => [
			'AJAX' => admin_url('admin-ajax.php'),
			'THEME' => get_stylesheet_directory_uri(),
		],
		'DEBUG' => WP_DEBUG ? 1 : 0,
		'USER' => ['ID' => get_current_user_id()],
		'IS_ADMIN' => is_admin(),
	]);
});

function ajax_action($tag, $fn) {
	add_action("wp_ajax_nopriv_$tag", $fn);
	add_action("wp_ajax_$tag", $fn);
}

ajax_action('esters_get_calendar_events', function() {
	global $themeData;
	header('Content-type: application/json');

	if (isset($themeData['custom_fields'])) {
		$fields = new EventFields();
		echo json_encode($fields->getPosts());
	}

	wp_die();
});

ajax_action('icon_html', function() {
	echo theme_svg($_GET['name'], $_GET['dir']);
	wp_die();
});

ajax_action('instagram_feed', function() {
	$cacheKey = 'esters_instagram_feed';
	if ($resp = get_transient($cacheKey)) return $resp;
	if ($token) {
		$resp = file_get_contents(sprintf('https://api.instagram.com/v1/users/self/media/recent/?access_token=%s',
			$token
		));
		if ($resp) {
			set_transient($cacheKey, $resp, 60*60);
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

	add_filter('the_title', function($title, $id) {
		global $post;
		if ($post && $id == $post->ID && $title == 'Calendar') return 'Tastings At Esters';
		return $title;
	}, 10, 2);

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

	new FreeShipping();
}

add_filter('body_class', function($classes) {
	global $post;

	$classes[] = 'theme--'.THEME_NAME;
	$classes[] = 'user--'.get_current_user_id();

	if (is_page()) {
		$classes[] = "page--$post->post_name";
		if (!is_front_page() && !in_array($post->post_name, [
			'our-menu',
			'private-events',
		])) $classes[] = "page-template";
		if (in_array($post->post_name, ['our-menu','shop-landing'])) $classes[] = 'content-bg-pattern';
		if (in_array($post->post_name, ['terms-and-conditions','privacy-policy','terms-of-use'])) $classes[] = 'legal-page';
	}

	if (function_exists('is_woocommerce') && (is_shop() || is_product_category() || is_product_tag())) {
		$classes[] = 'content-bg-pattern';
		$classes[] = 'product-listing';
	}

	return $classes;
});

$themeData['onlineShops'] = (new CustomizerSection('online_shops','Online Shops'))->addRepeater([
	['text','title'],
	['text','url','URL'],
], 4, 'Shop');

$themeData['contactInfo'] = (new CustomizerSection('contact_info','Contact Info'))->addFields([
	['text','family_heading_text'],
	['text','family_heading_url'],
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

$themeData['eventsPostType'] = new CustomType('calendar-event', 'Event');

add_action('init', function() use ($themeData) {
	$themeData['eventsPostType']->register();
});

add_filter('comments_open', function($open, $post_id) {
	return FALSE;
}, 10, 2);

$themeData['generateCartCountHTML'] = function() { return sprintf('<span id="theme-header__cart__num" class="round">%d</span>', function_exists('WC') ? WC()->cart->get_cart_contents_count() : 0); };

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) use ($themeData) {
    $fragments['#theme-header__cart__num'] = call_user_func($themeData['generateCartCountHTML']);
    return $fragments;
});
