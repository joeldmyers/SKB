<?php
/**
 * Template for displaying team members in a post format
 */
if ( have_posts() ) { 

    while ( have_posts() ) { 

		the_post();

		$team_member_name = get_the_title();
		$team_member_title = get_post_meta( get_the_id(), 'team_member_title', TRUE );
		$team_member_bio = get_post_meta( get_the_id(), 'team_member_bio', TRUE );
		if ( has_post_thumbnail() ) {
			$team_member_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'medium' );
			$team_member_image = '<img class="img-responsive" src="' . $team_member_image_src[0] . '">';
		} else {
			$team_member_image = '<img src="http://placehold.it/320x480/685443/fff&text=SKB" class="img-responsive" title="No Featured Image">';
		}
		echo '<div class="col-xs-12 col-sm-3">';
		echo $team_member_image;
		echo '</div>';
		echo '<div class="col-xs-12 col-sm-9">';
		echo '<h1>' . $team_member_name . '</h1>';
		echo '<h2>' . $team_member_title . '</h2>';
		echo do_shortcode( wpautop( $team_member_bio ) );
		echo '</div>';
    }

} else {

 	echo '<div class="col-xs-12"><p>' . __( 'Team member not found.', 'skb-theme' ) . '</p></div>';

}
