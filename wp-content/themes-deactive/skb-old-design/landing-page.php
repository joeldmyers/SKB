<?php /* Template Name: Landing Page */
get_header();

if ( have_posts() ) { 

    while ( have_posts() ) { 

        the_post();

        if ( has_post_thumbnail() ) {

            $fullscreen_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
            
        } 

        ?>

            <div class="fullscreen" style="background-image: url('<?php echo $fullscreen_image_src[0]; ?>');">
                <div class="landing-message">
                    <?php echo get_the_content(); ?>
                </div>         
            </div>
        
        <?php    
    }

} else {

    echo '<div class="col-xs-12"><p>' . __( 'Page not found.', 'skb-theme' ) . '</p></div>';

}

get_footer();