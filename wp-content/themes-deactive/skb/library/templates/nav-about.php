<nav class="navbar navbar-inverse navbar-static-top">
	<?php
	wp_nav_menu( array(
		'menu'              => 'about',
		'theme_location'    => 'skb_about-menu',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'container',
		'container_id'      => '',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		'walker'            => new wp_bootstrap_navwalker(),
		)
	);
	?>
</nav>