<?php

function nf_sp_admin_js(){
	global $pagenow, $typenow;
	if ( ( $pagenow != 'post.php' || $pagenow != 'edit.php' ) && $typenow != 'nf_sub' )
		return false;

	wp_enqueue_script( 'nf-sp-admin',
		NINJA_FORMS_SAVE_PROGRESS_URL .'/js/dev/admin.js',
		array( 'jquery' ) );

	wp_enqueue_style( 'nf-sp-admin',
		NINJA_FORMS_SAVE_PROGRESS_URL .'/css/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'nf_sp_admin_js' );