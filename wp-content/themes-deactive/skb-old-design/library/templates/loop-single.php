<?php
/**
 * Template for displaying posts in an archive format
 */

if ( have_posts() ) {

    while ( have_posts() ) {

		the_post();

		echo '<div class="media">';

		if ( has_post_thumbnail() ) {

		    $thumbnail = get_the_post_thumbnail( get_the_id(), array( 180, 180 ), array( 'title' => 'Read ' . get_the_title() ) );
		    echo '<a class="media-object pull-left" href="' . get_the_permalink() .'">' . $thumbnail . '</a>';

		}  ?>

			<div class="media-body">
				<h4 class="media-heading"><a href="<?php the_permalink(); ?>" title="Read ' . <?php the_title(); ?> . '"><?php the_title(); ?></a></h4>
				<p><time><?php the_date(); ?></time></p>
				<p><?php the_excerpt(); ?></p>
			</div>
		</div>

    <?php }

} else {

 	echo '<p>' . __( 'No posts were found.', 'skb-theme' ) . '</p>';

}
