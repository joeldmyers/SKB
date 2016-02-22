<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-md-4 footer-company">
			</div>
            <div class="col-xs-6 col-md-1"></div>
			<div class="col-xs-6 col-md-2">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-1',
					)
				);
				?>
			</div>
            <div class="col-xs-6 col-md-2">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-2',
					)
				);
				?>
			</div>
            <div class="col-xs-6 col-md-3">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-3',
					)
				);
				?>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-4 footer-company">
				<img src="https://dev.skbincrowd.com/wp-content/uploads/2015/01/SKB_Theme_Two_R3B.png" width="100%">
			</div>
            <div class="col-xs-6 col-md-1"></div>
            <div class="col-xs-6 col-md-4 footer-address">
				<h5>810 NW Marshall St #300, <br />Portland, OR 97209<br/>503-220-2600 </h5>
            </div>
            <div class="col-xs-6 col-md-1">
            <img src="../wp-content/uploads/2015/01/Verisign.png">
            </div>
             <div class="col-xs-6 col-md-2 copyright-text">
            <p><img src="../wp-content/uploads/2015/01/Copyright-copy.png">COPYRIGHT <?php echo date('Y'); ?><br />All rights reserved.</p>
            </div>
		</div>
	</div>
    <?php $theme_settings = get_option('skb_theme_settings');
	if ( is_front_page() ) { ?>
    <div class="privacy-notice">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php echo $theme_settings['privacy_notice']; ?>
			</div>
		</div>
	</div>
</div>
	<?php }
	?>
</footer>
<?php wp_footer(); ?>
</body>
</html>