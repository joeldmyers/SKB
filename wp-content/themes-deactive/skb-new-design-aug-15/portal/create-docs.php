<?php
/*
 * Template Name: Create Docs
 */

get_header();

// get investment id
$deal_id = isset($_POST['i_id']) ? $_POST['i_id'] : false;

?>

<div id="portal-create-docs" class="container">
    
    
    <?php // maybe put this after this form is submitted
    update_post_meta( $deal_id, 'docs_created', true ); 
    
  // echo do_shortcode(['ninja_forms=57']);
    
    
    if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 57 ); }
    ?>
    
    
</div>

<?php get_footer(); ?>