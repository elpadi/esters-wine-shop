<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page(),
    is_woocommerce(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {



	global $post;
	$theme_uri = get_template_directory_uri();
	$theme_path = get_template_directory();
	$load_css_file = function($rel_path, $path='') use ($theme_uri, $theme_path) {
		Assets\load_asset_file('css', $theme_uri, $theme_path, $rel_path, $path);
	};
	$load_js_file = function($rel_path, $path='') use ($theme_uri, $theme_path) {
		Assets\load_asset_file('js', $theme_uri, $theme_path, $rel_path, $path);
	};




		foreach (['vendor','base','components','templates/chapter','templates'] as $css_dir)
			Assets\load_asset_dir($theme_path, 'css', $css_dir, $load_css_file);
		$load_css_file('../foundation-icons/foundation-icons.css');
		$load_css_file('../style.css');
		$load_css_file('app.css');

		foreach (['vendor','components','templates'] as $js_dir)
			Assets\load_asset_dir($theme_path, 'js', "dist/$js_dir", $load_js_file);
		$load_js_file('dist/tome.js');


	/*
  wp_register_style('main-css', Assets\asset_path('styles/main.css', 'dist'), false, null);

  wp_register_script('bootstrap', Assets\asset_path('bootstrap-sass/assets/javascripts/bootstrap.min.js', 'bower_components'), [], null, true);
	
	wp_register_script('jquery', Assets\asset_path('jquery/dist/jquery.min.js', 'bower_components'), [], null, true);
  //wp_register_script('bootstrap-select', Assets\asset_path('bootstrap-select/dist/js/bootstrap-select.min.js', 'bower_components'), ['bootstrap'], null, true);
	//wp_register_script('bxslider', Assets\asset_path('bxslider-4/dist/jquery.bxslider.min.js', 'bower_components'), ['jquery'], null, true);
	wp_register_script('scrollreveal', Assets\asset_path('scrollreveal/dist/scrollreveal.min.js', 'bower_components'), ['jquery'], null, true);
	wp_register_script('slick', Assets\asset_path('slick-carousel/slick/slick.min.js', 'bower_components'), ['jquery'], null, true);
	wp_register_script('waypoints', Assets\asset_path('waypoints/lib/jquery.waypoints.min.js', 'bower_components'), ['jquery'], null, true);
	
	wp_register_script('main-js', Assets\asset_path('scripts/main.js'), ['bootstrap-select','bxslider','scrollreveal','slick','waypoints'], null, true);
	
	if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('main-js');
  wp_enqueue_style('main-css');
	 */
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
