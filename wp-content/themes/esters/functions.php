<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/events.php',    // Scripts and stylesheets
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/store.php', // Store functions
  'lib/gift.php', // Store functions
  'lib/ajax.php', // Ajax functions
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// shop query
/*
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive('product') ) return;
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'meta_query', array(array(
			'key' => '_virtual',
			'value' => "no",
			'compare' => '='
		)));
	
	}
}
*/

function search_filter($query) {
    if ( !is_admin() && $query->is_main_query() ) {
        if ($query->is_search) {
                
           // print_r("hello");
            
            $query->set('post_type', array('product'));

            $meta_query = array(
                'relation' => 'AND',
                array(
                    'key' => '_visibility',
                    'value' => 'visible',
                    'compare' => 'IN'
                ),
                array(
                    'key' => '_stock_status',
                    'value' => 'instock',
                    'compare' => '='
                )
            );

            $query->set('meta_query', $meta_query);
        }
    }
}

add_action('pre_get_posts','search_filter');

// Adds ACF options
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Esters Settings',
		'menu_title'	=> 'Esters Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

function order_online_button($index) {
	return sprintf('<a href="%s" target="_blank">%s</a>',
		get_field("option_{$index}_link", 'option'),
		get_field("option_{$index}_text", 'option')
	);
}
