<?php // Theme Settings

add_filter('piklist_admin_pages', 'skb_theme_setting_pages');
  
function skb_theme_setting_pages( $pages ) {
	
	$pages[] = array(
		'page_title' => __( 'Settings' ),
		'menu_title' => __( 'Settings', 'piklist' ),
		'sub_menu' => 'themes.php',
		'capability' => 'manage_options',
		'menu_slug' => 'skb_theme_settings',
		'setting' => 'skb_theme_settings',
		'single_line' => true,
		'default_tab' => 'General',
		'save_text' => 'Save Settings'
	);

	return $pages;

}