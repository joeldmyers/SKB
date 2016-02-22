<?php 
get_header();
get_template_part( 'library/templates/nav', 'investment' ); 
?>
<?php
set_query_var( 'current_section', 'active' );
?>
<div class="container" id="active-deals">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Active Deals</h2>
		</div>
	</div>
	<div class="row"> 
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>
<hr>
<?php
set_query_var( 'current_section', 'coming' );
rewind_posts();
?>
<div class="container" id="coming-attractions">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Coming Attractions</h2>
		</div>
	</div>
	<div class="row"> 
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>
<hr>
<?php
set_query_var( 'current_section', 'closed' );
rewind_posts(); 
?>
<div class="container" id="closed-deals">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Closed Deals <span style="font-size: 12px;"><i class="dashicons dashicons-plus-alt" style="font-size: 12px; height: 12px; width: 12px; vertical-align: text-top;"></i> Indicates Case Study</span></h2>
		</div>
	</div>
	<div class="row"> 
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>

<?php get_footer();