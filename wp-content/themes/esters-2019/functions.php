<?php

use Functional as F;
use WordpressLib\Theme\Assets;
use WordpressLib\Posts\CustomType;
use WordpressLib\Customizer\Section as CustomizerSection;
use ThemeLib\Theme;
use ThemeLib\ACF\EventFields;
use ThemeLib\ACF\PressFields;
use ThemeLib\Esters\Shop\Shop;
use ThemeLib\Esters\Shop\FreeShipping;

require_once ABSPATH . '/vendor/autoload.php';
require_once __DIR__ . '/custom-fields.php';

define('THEME_NAME', 'esters');

Theme::create(__DIR__);
Theme::instance()->enqueueScripts();
Theme::instance()->disableCustomSelectDropdowns();
Theme::instance()->set('customFields', get_theme_custom_fields_definitions());

new Shop();

Theme::ajaxActionJSON('get_calendar_events', function () {
    return Theme::instance()->get('customFields') ? (new EventFields())->getPosts() : false;
}, "Could not get our calendar events.");

Theme::ajaxActionJSON('get_press_articles', function () {
    return Theme::instance()->get('customFields') ? (new PressFields())->getPosts() : false;
}, "Could not get our press articles.");


Theme::ajaxActionJSON('instagram_feed', function () {
    return Theme::transientCache('esters_instagram_feed', function () {
        $token = get_option('api_tokens_instagram');
        if (!$token) {
            throw new RuntimeException("Missing Instagram API Token.");
        }

        return file_get_contents(sprintf(
            'https://api.instagram.com/v1/users/self/media/recent/?access_token=%s',
            $token
        ));
    }, 60 * 60);
});

if (is_admin() == false) {
    add_filter('theme_mod_custom_logo', function ($value) {
        return 1;
    });

    add_filter('get_custom_logo', function ($html) {
        $end = '</a>';
        return str_replace($end, Theme::instance()->svg('logo') . $end, $html);
    });

    add_filter('the_title', function ($title, $id) {
        global $post;
        if ($post && $id == $post->ID && $title == 'Calendar') {
            return 'Tastings At Esters';
        }
        return $title;
    }, 10, 2);

    add_filter('the_content', function ($content) {
        if (is_front_page()) {
            ob_start();
            get_template_part('template-parts/content/home-slideshow');
            $content = ob_get_clean() . $content;
        }
        return $content;
    });

    new FreeShipping();
}

Theme::instance()->set('customizerSections', [
    'onlineShops' => (new CustomizerSection('online_shops'))->addRepeater([
        ['text','title'],
        ['text','url','URL'],
    ], 4, 'Shop'),

    'productPage' => (new CustomizerSection('product_page'))->addFields([
        ['textarea','subscription_disclaimer'],
    ]),

    'contactInfo' => (new CustomizerSection('contact_info'))->addFields([
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

    'legal' => (new CustomizerSection('legalese_items', 'Legal Info'))->addFields([
        ['text','copyright'],
        ['page','tnc','Terms and Conditions'],
        ['page','privacy','Privacy Policy'],
        ['page','tou','Terms of Use'],
        ['page','accessibility','Accessibility Statement'],
    ]),

    'apiTokens' => (new CustomizerSection('api_tokens', 'API Tokens'))->addFields([
        ['text','gmaps','Google Maps API Access Token'],
        ['text','instagram','Instagram API Access Token'],
    ]),
]);

Theme::instance()->set('postTypes', [
    'events' => new CustomType('calendar-event', 'Event'),
    'press' => new CustomType('press', 'Press Article'),
]);

add_action('init', function () {
    // no editor, no thumbnail
    F\invoke(Theme::instance()->get('postTypes'), 'register', [[], ['supports' => ['title']]]);
});

add_filter('comments_open', function ($open, $post_id) {
    return false;
}, 10, 2);

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    $fragments['#theme-header__cart__num'] = Shop::generateCartCountHTML();
    return $fragments;
});

// disable debug notices from Square API
foreach (['success','error'] as $noticeType) {
    add_filter('woocommerce_add_' . $noticeType, function ($msg) {
        foreach (['Array','HTTP'] as $needle) {
            if (strpos($msg, $needle) !== false) {
                    return '';
            }
        }
        return $msg;
    });
}
