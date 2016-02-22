<?php if ( ! wp_is_mobile() || is_ipad() || is_user_logged_in() ) { ?>
<div class="clearfix">
	<?php if ( wp_is_mobile() && ! is_ipad() ) { ?>
	<ul class="nav nav-pills nav-account">
	<?php } else { ?>
	<ul class="nav nav-pills pull-right nav-account">
	<?php } ?>
	<?php if ( is_user_logged_in() ) { ?>

		<li><a href="<?php echo home_url( '/my-account' ); ?>" class="menu-welcome"><span class="hidden-xs">Welcome: <?php echo do_shortcode('[investor_firstname]'); ?></span><span class="hidden-sm hidden-md hidden-lg">My Account</a></li>
		<li><a href="<?php echo home_url( '/dashboard' ); ?>" class="menu-dashboard"><span class="hidden-xs">Investor </span>Dashboard</a></li>
		<li><a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" class="menu-log-in-out">Log Out</a></li>

	<?php } else { ?>

		<li class="hidden-xs"><a href="<?php echo home_url( '/register/' ); ?>" class="menu-register">Get Started</a></li>
		<li class="hidden-xs"><a href="<?php echo home_url( '/my-account/' ); ?>" class="menu-log-in-out">Log In</a></li>

	<?php } ?>
	</ul>
</div>
<?php } ?>