<?php 
get_header();
get_template_part( 'library/templates/nav', 'investment' ); 
?>

<div class="container">
	<div class="row"> 
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>

<?php get_footer();