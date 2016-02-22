<?php
/**
 * Template for displaying glossary terms in an archive format
 */
if ( have_posts() ) {

    $current_letter = 'A';
    $first_letter = 'A';

	echo '<h2 id="' . $first_letter . '">' . $first_letter . '</h2>';

	// We are starting with the A so kick out the first panel group and
	// we'll handle the rest in the loop
	echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';

    while ( have_posts() ) {

		the_post();

		$glossary_term = get_the_title();
		$glossary_definition = get_post_meta( get_the_id(), 'glossary_term_definition', TRUE );

		$first_letter = strtoupper( substr( $glossary_term, 0, 1 ) );			

		if ( $first_letter != $current_letter ) {

			echo '</div>';

			echo '<h2 id="' . $first_letter . '">' . $first_letter . '</h2>';

			$current_letter = $first_letter; 

			?>

			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		<?php } ?>	

		<div class="panel">
			<div id="heading<?php echo get_the_id(); ?>" role="tab">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo get_the_id(); ?>" aria-expanded="true" aria-controls="collapse<?php echo get_the_id(); ?>">
					<strong><?php echo $glossary_term; ?></strong>
				</a>
			</div>
			<div id="collapse<?php echo get_the_id(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo get_the_id(); ?>">
				<div class="panel-body">
					<?php echo $glossary_definition; ?>
				</div>
			</div>
		</div>

	<?php } ?>

	</div>

<?php 

} else {

 	echo '<p>Sorry, no glossary terms were found.</p>';

}