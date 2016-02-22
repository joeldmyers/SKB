<?php /* Template Name: About */
get_header();
get_template_part( 'library/templates/nav', 'about' );
?>

<div class="container">
    <?php get_template_part( 'library/templates/content' , 'page' ); ?>
</div>

<?php get_footer();