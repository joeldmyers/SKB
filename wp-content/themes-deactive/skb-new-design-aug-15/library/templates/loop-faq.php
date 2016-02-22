<?php
/**
 * Template for displaying faqs in an archive format
 */
if ( have_posts() ) { ?>

	<div class="col-xs-12">

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	    <?php 
	    while ( have_posts() ) {

			the_post();

			$faq_question = get_the_title();
			$faq_answer = get_post_meta( get_the_id(), 'faq_answer', TRUE );
			
			?>

			<div class="panel">
				<div id="heading<?php echo get_the_id(); ?>" role="tab">
					<li><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo get_the_id(); ?>" aria-expanded="true" aria-controls="collapse<?php echo get_the_id(); ?>">
						<strong><?php echo $faq_question; ?></strong>
					</a></li>
				</div>
				<div id="collapse<?php echo get_the_id(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo get_the_id(); ?>">
					<div class="panel-body">
						<?php echo $faq_answer; ?>
					</div>
				</div>
			</div>

		<?php } ?>

		</div>

	</div>

<?php 

} else {

 	echo '<p>' . __( 'No faqs were found.', 'skb-theme' ) . '</p>';

}