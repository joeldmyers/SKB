<?php
get_header();
get_template_part( 'library/templates/nav' , 'about' ); 
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12 hidden-xs">
			<ol class="breadcrumb">
			  <li><a href="<?php echo home_url( '/team-members/' ); ?>">Team</a></li>
			  <li class="active"><?php echo get_the_title(); ?></li>
			</ol>
		</div>
	</div>
	<div class="row" id="main-content">
		<?php get_template_part( 'library/templates/content' , 'team_member' ); ?>
	</div>
</div>

<?php get_footer();