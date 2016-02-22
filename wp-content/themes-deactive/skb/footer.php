<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-2',
					)
				);
				?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-3',
					)
				);
				?>
			</div>
			<div class="col-xs-6 col-md-3">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-4',
					)
				);
				?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-5',
					)
				);
				?>
			</div>
			<div class="clearfix visible-xs-inline visible-sm-inline"></div>
			<div class="col-xs-6 col-md-3">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-1',
					)
				);
				?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'skb_footer-menu-6',
					)
				);
				?>
			</div>
			<div class="col-xs-6 col-md-3">
				<?php 
				$theme_settings = get_option('skb_theme_settings');
				$footer_contact = $theme_settings['footer_contact'];
				echo $footer_contact;
				?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>