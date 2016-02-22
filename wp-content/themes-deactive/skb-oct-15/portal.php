<?php /* Template Name: Portal */
//test

get_header(); 

?>

<div class="container" id="coming-attractions">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Portal</h2>
		</div>
	</div>
	<div class="row"> 
		<?php get_template_part( 'library/templates/content', 'portal' ); ?>
	</div>
</div>

<?php

get_footer();