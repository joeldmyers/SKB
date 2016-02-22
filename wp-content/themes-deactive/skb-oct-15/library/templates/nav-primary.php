<?php
$theme_settings = get_option('skb_theme_settings');
$site_logo = $theme_settings['site_logo'];
?>
		
<?php
wp_nav_menu( array(
        'menu'              => 'primary',
        'theme_location'    => 'skb_primary-menu',
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'navbar-right navbar-collapse collapse',
        'container_id'      => '',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker(),
        )
);
?>