<?php
/**
 * Template for displaying team members in an archive format
 */
global $wp_query;
if ( have_posts() ) {

	$post_count = 0;

    while ( have_posts() ) {

		the_post();

		$team_member_name = get_the_title();
		$team_member_title = get_post_meta( get_the_id(), 'team_member_title', TRUE );
		$team_member_bio = get_post_meta( get_the_id(), 'team_member_bio', TRUE );
		$team_member_permalink = get_the_permalink();

		if ( has_post_thumbnail() ) {
			$team_member_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'medium' );
			$team_member_image = '<img class="img-responsive" src="' . $team_member_image_src[0] . '">';
		} else {
			$team_member_image = '<img src="http://placehold.it/320x480/685443/fff&text=No+Photo" class="img-responsive" title="No Featured Image">';
		}

		$post_count++;

		echo '<div class="col-xs-6 col-md-4 col-lg-3">';
		echo '<a href="' . $team_member_permalink . '" title="Read ' . $team_member_name . '\'s Bio">' . $team_member_image . '</a>';
		echo '<h4>' . $team_member_name . '</h4>';
		echo '<h5>' . $team_member_title . '</h5>';
		echo '</div>';

		/* Using Bootstrap visibility classes we will ensure everything wraps nicely */

		$visible_classes = array();

		if ( $post_count != $wp_query->found_posts ) {
 
 			$visible_classes[] = 'clearfix';

			if ( $post_count % 2 == 0 ) { $visible_classes[] = 'visible-xs-inline'; $visible_classes[] = 'visible-sm-inline';}	
			if ( $post_count % 3 == 0 ) { $visible_classes[] = 'visible-md-inline'; }			
			if ( $post_count % 4 == 0 ) { $visible_classes[] = 'visible-lg-inline'; }

			if ( count( $visible_classes ) > 1 ) {
				echo '<div class="' . implode( ' ', $visible_classes ) . '">&nbsp;</div>';
			}

		}

	}

} else {

 	echo '<p>' . __( 'No team members were found.', 'skb-theme' ) . '</p>';

}