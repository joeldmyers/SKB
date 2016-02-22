<?php
get_header();
get_template_part( 'library/templates/nav', 'investment' );
?>

<div class="container" id="main-content">
    <?php get_template_part( 'library/templates/content' , 'investment' ); ?>
</div>

<?php get_footer();