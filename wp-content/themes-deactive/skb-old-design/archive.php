<?php get_header(); ?>

<div class="container">

    <div class="row">
 
    <?php 
    
        echo '<div class="col-xs-12">';
    
        echo '<h1>' . single_term_title( '', FALSE ) . '</h1>';
    
        get_template_part( 'library/templates/content', 'single' );
    
        echo '</div>';
    
    ?>

    </div>

</div>

<?php get_footer();