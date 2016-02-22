<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon.png">
	<!-- IE6-8 shim for support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<?php wp_head(); ?>
<link href='//fonts.googleapis.com/css?family=Raleway:400,700,300' rel='stylesheet' type='text/css'>
</head>
<?php // throwing erros as non-oject so fixing
if (is_object($post)) {
    $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
}
?>
<body <?php body_class( 'cbp-spmenu-push' ); ?>  style="background-image:url(<?php if (!is_single()) echo $thumb_url; ?>); background-size: 100% auto; background-repeat: no-repeat;">
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1493348717657529',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<?php if ( ! is_page_template( 'docusign-started.php' ) ) { ?>

<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right hidden-md hidden-lg" id="cbp-spmenu-s2">
	<h3>Menu</h3>
	<?php if ( ! is_user_logged_in() ) { ?>
		<!--<a href="/register/">Get Started</a>
		<a href="/my-account/">Log In</a>-->
	<?php } ?>
	<a href="/about-us">About Us</a>
	<a href="/investments">Investments</a>
	<a href="/how-to-invest">How To Invest</a>
	<a href="/faqs">FAQ</a>
	<a href="/news">News</a>
	<a href="/contact-skb/">Contact Us</a>		
</nav>

<?php 
$theme_settings = get_option('skb_theme_settings');
$site_alert = $theme_settings['site_alert'];
if ( '' != $site_alert ) {
?>
<div class="alert alert-info" style="border-radius: 0; text-align: center;" role="alert"><?php echo $site_alert; ?></div>
<?php }

get_template_part( 'library/templates/nav', 'account' ); ?>

<div class="container hidden-md hidden-lg" style="margin-bottom: 10px;">
	<div class="row">
		<div class="col-xs-9">
			<a class="brand text-hide hidden-md hidden-lg" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php bloginfo( 'name' ); ?>
			</a>
		</div>
		<div class="col-xs-3">
			<button class="btn btn-primary pull-right" id="showRightPush">Menu</button>
		</div>
	</div>
</div>

<script>
	var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
		showRightPush = document.getElementById( 'showRightPush' ),
		body = document.body;

	showRightPush.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'cbp-spmenu-push-toleft' );
		classie.toggle( menuRight, 'cbp-spmenu-open' );
	};
</script>

<div class="navbar-header">
    <div class="navbar navbar-default navbar-static-top nav-primary hidden-xs hidden-sm" role="navigation">
	<div class="container">
    <?php if ( !is_page('dashboard') ): ?>
        <a class="navbar-brand text-hide hidden-xs hidden-sm" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="/wp-content/themes/skb-oct-15/library/images/SKB_LOGO.png">
        </a>
    <?php else: ?>
        <a class="navbar-brand text-hide hidden-xs hidden-sm" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri() . '/library/images/black-logo.png' ?>">
        </a>
    <?php endif; ?>
            
    <?php get_template_part( 'library/templates/nav', 'primary' );    ?>     
        </div>
    </div>
    
</div>

<?php
}