<?php
get_header();
get_template_part( 'library/templates/nav', 'about' );
$theme_settings = get_option('skb_theme_settings');
$team_member_intro = $theme_settings['team_member_intro'];
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2>SKB Team</h2>
			<?php echo do_shortcode( wpautop( $team_member_intro ) ); ?>
		</div>
	</div>
	<div class="row"> 
	    <?php get_template_part( 'library/templates/loop', 'team_member' ); ?>
	</div>
</div>

<?php get_footer();