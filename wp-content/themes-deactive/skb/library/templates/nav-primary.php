<?php
$theme_settings = get_option('skb_theme_settings');
$site_logo = $theme_settings['site_logo'];
?>
<div class="navbar navbar-default navbar-static-top nav-primary hidden-xs hidden-sm" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand text-hide hidden-xs hidden-sm" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php bloginfo( 'name' ); ?>
			</a>
		</div>
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
	</div>
</div>