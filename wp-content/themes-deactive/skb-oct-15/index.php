<?php get_header(); ?>

<div class="container">

    <div class="row">
 
    <?php 
    
        echo '<div class="col-xs-12">';
    
        the_title( '<h1>', '</h1>', TRUE );
    
        get_template_part( 'library/templates/content', 'single' );
    
        echo '</div>';
    
    ?>

    </div>

</div>

<?php get_footer();