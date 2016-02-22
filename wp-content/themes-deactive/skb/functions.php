<?php 
// Check for Piklist, used extensively and required for this theme
add_action( 'init', 'my_init_function' );
function my_init_function() {
	
	if ( is_admin() ) {
		include_once( TEMPLATEPATH . '/library/class-piklist-checker.php' );
 
		if ( !piklist_checker::check( __FILE__, 'theme' ) ) {
			return;
   		}
	}
}

// SKB Theme 
require_once( TEMPLATEPATH . '/library/theme-functions.php' );
require_once( TEMPLATEPATH . '/library/theme-settings.php' );
require_once( TEMPLATEPATH . '/library/theme-custom-post-types.php' );
require_once( TEMPLATEPATH . '/library/theme-custom-taxonomies.php' );
require_once( TEMPLATEPATH . '/library/theme-menus.php');
require_once( TEMPLATEPATH . '/library/theme-sidebars.php' );
require_once( TEMPLATEPATH . '/library/theme-widgets.php' );
require_once( TEMPLATEPATH . '/library/theme-shortcodes.php' );
require_once( TEMPLATEPATH . '/library/theme-actions.php' );
require_once( TEMPLATEPATH . '/library/theme-filters.php' );

require_once( TEMPLATEPATH . '/library/ninjaforms-functions.php' );
require_once( TEMPLATEPATH . '/library/wp-bootstrap-navwalker.php' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', 
	array( 
		'comment-list', 
		'comment-form', 
		'search-form', 
		'gallery', 
		'caption',
	)
);