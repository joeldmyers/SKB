<?php
/**
 * Template for displaying content for a single page
 */

$theme_settings = get_option('skb_theme_settings');
$sidebar_content = $theme_settings['main_sidebar'];
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

		if ( $sidebar_content != '' ) {

		    echo '<div class="col-xs-12 col-sm-7 col-md-8">';
		    $sidebar = true;
		
		} else {

		    echo '<div class="col-xs-12">';
			$sidebar = false;
	
		}        
    
		if ( 'Yes' == $show_title ) { 
			the_title( '<h1>', '</h1>', TRUE ); 
		}

		echo '<p style="display: none;">Last updated <time>' . get_the_modified_date() . ' ' . get_the_modified_time() . '</time></p>';

		the_content();

        echo '</div>';

        if ( $sidebar ) {

		    echo '<div class="hidden-xs col-sm-5 col-md-4">';
		    echo '<div class="well">';
		    echo do_shortcode( wpautop( $sidebar_content ) );
		    echo '</div>';
		    echo '</div>';

        }

    }

} else {

 	echo '<div class="col-xs-12"><p>' . __( 'Page not found.', 'skb-theme' ) . '</p></div>';

}

echo '</div>';
echo '</div>';