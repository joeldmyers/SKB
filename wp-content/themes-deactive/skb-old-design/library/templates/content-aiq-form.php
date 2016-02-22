<?php
/**
 * Template for displaying content for a single AIQ Form
 */

$show_title = get_post_meta( get_the_id(), 'show_title', true );

if ( have_posts() ) { 

    while ( have_posts() ) { 

		the_post();

       if ( has_post_thumbnail() ) {

            $hero_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
            $hero_image = '<img class="img-responsive" src="' . $hero_image_src[0] . '">';
            echo '<div class="hero">' . $hero_image . '</div>';
            echo '<br><br>';
        
        } 

        echo '<div class="container">';
        echo '<div class="row">';        
	    echo '<div class="col-xs-12">';
    
		if ( 'Yes' == $show_title ) { 
			the_title( '<h1>', '</h1>', TRUE ); 
		}

		the_content();

        echo '</div>';

    }

} else {

 	echo '<div class="col-xs-12"><p>' . __( 'Page not found.', 'skb-theme' ) . '</p></div>';

}

echo '</div>';
echo '</div>';