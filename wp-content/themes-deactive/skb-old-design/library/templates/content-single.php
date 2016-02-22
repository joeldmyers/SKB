<?php
/**
 * Template for displaying content for a single post
 */

$theme_settings = get_option('skb_theme_settings');
$sidebar_content = $theme_settings['main_sidebar'];
$show_title = get_post_meta( get_the_id(), 'show_title', true );

if ( have_posts() ) { 

    while ( have_posts() ) { 

		the_post();

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

		echo '<p><time>' . get_the_date() . '</time></p>';

		the_content();

		comments_template();

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

 	echo '<div class="col-xs-12"><p>' . __( 'Post not found.', 'skb-theme' ) . '</p></div>';

}
