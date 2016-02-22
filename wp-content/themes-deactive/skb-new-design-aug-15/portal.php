<?php /* Template Name: Portal */


<<<<<<< HEAD
get_header();

// @TODO if has_permission
=======
get_header(); 
>>>>>>> master

?>

<div class="container" id="coming-attractions">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Portal</h2>
		</div>
	</div>
<<<<<<< HEAD
    <?php if ( isset($_GET['event'] ) && $_GET['event'] == "signing_complete" ): ?>
        <div id="sportal-new-investments" class="alert alert-success fade in" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Documents successfully signed and created</div>
    <?php endif; ?>
    
    <div id="portal-new-investments" class="alert alert-danger" role="alert" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are new investments awaiting approval</div>
    <div id="portal-documents-creation" class="alert alert-info" role="alert" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are investments requiring documents</div>
    <div id="return-sign-status" class="alert alert-warning" role="alert" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are documents requiring signature</div>
=======
>>>>>>> master
	<div class="row"> 
		<?php get_template_part( 'library/templates/content', 'portal' ); ?>
	</div>
</div>

<?php

get_footer();