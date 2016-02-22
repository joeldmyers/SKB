<?php // Theme menus

add_theme_support( 'menus' );
register_nav_menus( array( 
    'skb_primary-menu' => 'Primary Menu',
    'skb_about-menu' => 'About Menu',
    'skb_footer-menu-1' => 'Footer Menu 1',
    'skb_footer-menu-2' => 'Footer Menu 2',
    'skb_footer-menu-3' => 'Footer Menu 3',
    'skb_footer-menu-4' => 'Footer Menu 4',
    'skb_footer-menu-5' => 'Footer Menu 5',
    'skb_footer-menu-6' => 'Footer Menu 6',
    )
);

if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {

    skb_create_menus( array(
        'Primary' => 'skb_primary-menu',
        'About' => 'skb_about-menu',
        'Footer Menu 1' => 'skb_footer-menu-1',
        'Footer Menu 2' => 'skb_footer-menu-2',
        'Footer Menu 3' => 'skb_footer-menu-3',
        'Footer Menu 4' => 'skb_footer-menu-4',
        'Footer Menu 5' => 'skb_footer-menu-5',
        'Footer Menu 6' => 'skb_footer-menu-6',
    	)
    );

}

function skb_create_menus( $menus ) {

	$locations = get_theme_mod( 'nav_menu_locations' );

	foreach( $menus as $name => $location ) {

		$menu_exists = wp_get_nav_menu_object( $name );

		if( ! $menu_exists ) {

    		$menu_id = wp_create_nav_menu( $name );
    		$locations[$location] = $menu_id;

		}
	}

	set_theme_mod( 'nav_menu_locations', $locations );
}