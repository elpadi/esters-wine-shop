<?php
use Functional as F;
use WordpressLib\Theme\Assets;
use WordpressLib\Posts\CustomType;
use WordpressLib\Customizer\Section as CustomizerSection;
use ThemeLib\Theme;
use ThemeLib\ACF\EventFields;
use ThemeLib\Esters\Shop\Shop;
use ThemeLib\Esters\Shop\FreeShipping;

require_once ABSPATH.'/vendor/autoload.php';
require_once __DIR__.'/custom-fields.php';

define('THEME_NAME', 'esters');

Theme::create(__DIR__);
Theme::instance()->enqueueScripts();
Theme::instance()->set('customFields', get_theme_custom_fields_definitions());


Theme::ajaxActionJSON('get_calendar_events', function() {
	return Theme::instance()->get('customFields') ? (new EventFields())->getPosts() : FALSE;
}, "Could not get our calendar events.");


Theme::ajaxActionJSON('instagram_feed', function() {
	return Theme::transientCache('esters_instagram_feed', function() {
		$token = get_option('api_tokens_instagram');
		if (!$token) throw new \RuntimeException("Missing Instagram API Token.");

		return file_get_contents(sprintf('https://api.instagram.com/v1/users/self/media/recent/?access_token=%s',
			$token
		));
	}, 60 * 60);
});

if (is_admin() == false) {

	add_filter('theme_mod_custom_logo', function($value) {
		return 1;
	});

	add_filter('get_custom_logo', function($html) {
		$end = '</a>';
		return str_replace($end, Theme::instance()->svg('logo').$end, $html);
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

Theme::instance()->set('customizerSections', [
	'onlineShops' => (new CustomizerSection('online_shops','Online Shops'))->addRepeater([
		['text','title'],
		['text','url','URL'],
	], 4, 'Shop'),

	'contactInfo' => (new CustomizerSection('contact_info','Contact Info'))->addFields([
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
	]),

	'legal' => (new CustomizerSection('legalese_items','Legal Info'))->addFields([
		['text','copyright'],
		['page','tnc','Terms and Conditions'],
		['page','privacy','Privacy Policy'],
		['page','tou','Terms of Use'],
	]),

	'apiTokens' => (new CustomizerSection('api_tokens','API Tokens'))->addFields([
		['text','instagram','Instagram API Access Token'],
	]),
]);

Theme::instance()->set('postTypes', [
	'events' => new CustomType('calendar-event', 'Event'),
]);

add_action('init', function() {
	Theme::instance()->get('postTypes', 'events')->register();
});

add_filter('comments_open', function($open, $post_id) {
	return FALSE;
}, 10, 2);

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    $fragments['#theme-header__cart__num'] = Shop::generateCartCountHTML();
    return $fragments;
});
