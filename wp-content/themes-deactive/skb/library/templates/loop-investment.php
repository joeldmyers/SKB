<?php
/**
 * Template for displaying investments in an archive format
 */
global $wp_query;
if ( have_posts() ) {

		$current_section = get_query_var( 'current_section', '' );

		$post_count = 0;

		while ( have_posts() ) { 

			the_post();

			if ( has_term( $current_section, 'investment_category') ) {

				$investment_title = get_the_title();
				$investment_permalink = get_the_permalink();
				$investment_overview = get_post_meta( get_the_id(), 'investment_overview', true );

				if ( has_post_thumbnail() ) {
					$investment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumbnail' );
					$investment_image = '<img class="img-responsive" src="' . $investment_image_src[0] . '">';
				} else {
					$investment_image = '<img src="' . get_template_directory_uri() . '/library/images/investment-thumb.jpg" class="img-responsive" title="SKB IN CROWD">';
				}

				$post_count++;

				echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';

				if ( has_term( array( 'active' ), 'investment_category' ) ) {
					echo '<a class="clearfix" href="' . $investment_permalink . '"><span><i class="dashicons dashicons-plus"></i> LEARN MORE </span>' . $investment_image . '</a>';
				}

				if ( has_term( array( 'coming' ), 'investment_category' ) ) {
					echo '<a class="clearfix" href="' . $investment_permalink . '"><span><i class="dashicons dashicons-plus"></i> PREVIEW </span>' . $investment_image . '</a>';
				}

				if ( has_term( array( 'closed' ), 'investment_category' ) && 'Yes' == get_post_meta( get_the_id(), 'investment_case_study', true ) ) {
					echo '<a class="clearfix" href="' . $investment_permalink . '"><span><i class="dashicons dashicons-plus-alt"></i> CASE STUDY </span>' . $investment_image . '</a>';
				} elseif ( has_term( array( 'closed' ), 'investment_category' ) ) {
					echo '<a class="clearfix" href="' . $investment_permalink . '"><span><i class="dashicons dashicons-plus"></i> OVERVIEW </span>' . $investment_image . '</a>';
				}
				
				echo '<h4>' . $investment_title . '</h4>';
				echo '<div>' . $investment_overview . '</div>';
				echo '</div>';

				/* Using Bootstrap visibility classes we will ensure everything wraps nicely */

				$visible_classes = array();

				if ( $post_count != $wp_query->found_posts ) {
		 
		 			$visible_classes[] = 'clearfix';
		 			$visible_classes[] = 'visible-xs-inline'; 

					if ( $post_count % 2 == 0 ) { $visible_classes[] = 'visible-sm-inline'; }
					if ( $post_count % 3 == 0 ) { $visible_classes[] = 'visible-md-inline'; }
					if ( $post_count % 4 == 0 ) { $visible_classes[] = 'visible-lg-inline'; }

					if ( count( $visible_classes ) > 1 ) {

						echo '<div class="' . implode( ' ', $visible_classes ) . '">&nbsp;</div>';

					}

				}
			}
		}

} else {

 	echo '<div class="col-xs-12"><p>' . __( 'No investments were found.', 'skb-theme' ) . '</p></div>';

}