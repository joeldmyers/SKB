<?php
/**
 * Template for displaying content for a single investment
 */

if ( have_posts() ) { 

    while ( have_posts() ) { 

		the_post();

		$investment_title = get_the_title();
		$investment_overview = get_post_meta( get_the_id(), 'investment_description', true );

		if ( has_term( array( 'closed' ), 'investment_category' ) && 'Yes' == get_post_meta( get_the_id(), 'investment_case_study', true ) ) {

			echo '<div class="row">';

			$case_study_content = get_post_meta( get_the_id(), 'investment_case_study_content', true );

			echo '<div class="col-xs-12 col-sm-7 col-md-8">';
		    echo '<h1>' . $investment_title . ' - Case Study</h1>';
			echo do_shortcode( wpautop( $case_study_content ) );
			echo '</div>';

			echo '<div class="col-xs-12 col-sm-5 col-md-4">';
			echo '<div class="well">';

			if ( has_post_thumbnail() ) {
				$investment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
				$investment_image = '<img class="img-responsive" style="max-height: 600px;" src="' . $investment_image_src[0] . '">';
			} else {
				$investment_image = '<img src="http://placehold.it/640x480/685443/fff&text=SKB" class="img-responsive" title="No Featured Image">';
			}

			echo $investment_image;
			echo '<h2>Overview</h2>';
			echo do_shortcode( wpautop( $investment_overview ) );


			$theme_settings = get_option('skb_theme_settings');
			$case_study_sidebar = $theme_settings['case_study_sidebar'];

			echo do_shortcode( wpautop( $case_study_sidebar ) );

			echo '</div>';
			echo '</div>';
			echo '</div>';

		} elseif ( has_term( array( 'closed' ), 'investment_category' ) ) {

			echo '<div class="row">';

			echo '<div class="col-xs-12">';
		    echo '<h1>' . $investment_title . ' - Closed Deal</h1>';
		    echo '</div>';

			if ( has_post_thumbnail() ) {
				$investment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'medium' );
				$investment_image = '<img class="img-responsive" src="' . $investment_image_src[0] . '">';
			} else {
				$investment_image = '<img src="http://placehold.it/640x480/685443/fff&text=SKB" class="img-responsive" title="No Featured Image">';
			}

		    echo '<div class="col-xs-12 col-sm-7 col-md-8">';
			echo $investment_image;
			echo '</div>';

			$investment_description = get_post_meta( get_the_id(), 'investment_description', true );
			echo '<div class="col-xs-12 col-sm-5 col-md-4">';
			echo '<div class="row">';
			echo '<div class="col-xs-12">';
			echo do_shortcode( wpautop( $investment_description ) );
	        echo '</div>';
	        echo '</div>';
	        echo '</div>';
	        echo '</div>';

		} elseif ( has_term( array( 'active', 'coming' ), 'investment_category' ) ) {

			echo '<div class="row">'; // start a row

			echo '<div class="col-xs-12">';
		    echo '<h1>' . $investment_title . '</h1>';
		    echo '</div>';

			if ( has_post_thumbnail() ) {
				$investment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'medium' );
				$investment_image = '<img class="img-responsive" src="' . $investment_image_src[0] . '">';
			} else {
				$investment_image = '<img src="http://placehold.it/640x480/685443/fff&text=SKB" class="img-responsive" title="No Featured Image">';
			}

		    echo '<div class="col-xs-12 col-sm-7 col-md-8">'; // left column
			echo $investment_image;
			echo '</div>';

			$investment_description = get_post_meta( get_the_id(), 'investment_description', true );
			echo '<div class="col-xs-12 col-sm-5 col-md-4">'; // right column
			echo do_shortcode( wpautop( $investment_description ) );
	        echo '</div>';
	        echo '</div>'; // end the row

			$terms = get_the_terms( get_the_id(), 'investment_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {

				foreach ( $terms as $term ) {

					if ( 'Active' == $term->name ) { ?>
						<br>
						<div class="row">
							<div class="col-xs-12 col-sm-7 col-md-8">
								<div class="alert alert-success alert-dismissible fade in hide" id="alert-follow" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div id="ajax_follow_response"></div>
								</div>
								<ul class="nav nav-pills">
									<?php 
									if ( is_user_logged_in() ) {
										$following_investments = get_user_meta( get_current_user_id(), 'following_investments', false );
										if ( ! in_array( get_the_id(), $following_investments ) ) { 
										?>
										<li role="presentation">
											<button type="button" id="follow_investment" class="btn btn-primary">
											 	<span class="dashicons dashicons-plus-alt"></span>&nbsp; Follow Investment
											</button>
										</li>
										<?php } else { ?>
										<li role="presentation">
											<button type="button" id="unfollow_investment" class="btn btn-primary">
											 	<span class="dashicons dashicons-dismiss"></span>&nbsp; Unfollow Investment
											</button>
										</li>
										<?php } ?>
										<?php
										if ( get_post_meta( get_the_id(), 'investment_offering', TRUE ) ) { ?>
										<li role="presentation">
											<button type="button" id="read_investment" class="btn btn-primary">
												<span class="dashicons dashicons-analytics"></span>&nbsp; Information Memorandum
											</button>
										</li>
										<?php 
										}
										$read_list = get_user_meta( get_current_user_id(), 'read_list', false );
										if ( ! in_array( get_the_id(), $read_list ) ) { 
										?>
										<li role="presentation">
											<button type="button" id="invest_in_this_deal" class="btn btn-primary disabled" data-toggle="collapse" data-target="#invest_form" aria-expanded="false" aria-controls="collapseExample">
												<span class="dashicons dashicons-chart-line"></span>&nbsp; Start Investment Process
											</button>
										</li>
										<?php } else { ?>
										<li role="presentation">
											<button type="button" id="invest_in_this_deal" class="btn btn-primary" data-toggle="collapse" data-target="#invest_form" aria-expanded="false" aria-controls="collapseExample">
												<span class="dashicons dashicons-chart-line"></span>&nbsp; Start Investment Process
											</button>
										</li>
									<?php }
									} else { ?>
										<li role="presentation">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
												<span class="dashicons dashicons-plus-alt"></span>&nbsp; Follow Investment
											</button>
										</li>
										<li role="presentation">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
												<span class="dashicons dashicons-analytics"></span>&nbsp; Information Memorandum
											</button>
										</li>
										<li role="presentation">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
												<span class="dashicons dashicons-chart-line"></span>&nbsp; Start Investment Process
											</button>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>

						<?php if ( is_user_logged_in() ) { ?>

						<div class="row">
							<div class="col-xs-12 col-md-8 col-offset-md-2">
								<div class="collapse" id="invest_form">
									<?php echo do_shortcode( '[ninja_forms_display_form id=3]' ); ?>
								</div>
							</div>
						</div>

						<?php } ?>

					<?php } elseif ( 'Coming' == $term->name ) { ?>
						<br>
						<div class="row">
							<div class="col-xs-12 col-md-8 col-offset-md-2">
								<div class="alert alert-success alert-dismissible fade in hide" id="alert-follow" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div id="ajax_watchlist_response"></div>
								</div>
								<?php 
								if ( is_user_logged_in() ) {
									$following_investments = get_user_meta( get_current_user_id(), 'following_investments', false );
									if ( ! in_array( get_the_id(), $following_investments ) ) { 
									?>
									<button type="button" id="follow_investment" class="btn btn-primary">
									 	<span class="dashicons dashicons-plus-alt"></span>Follow Investment
									</button>
									<?php } else { ?>
									<button type="button" id="unfollow_invesment" class="btn btn-primary">
									 	<span class="dashicons dashicons-dismiss"></span> Unfollow Investment
									</button>
									<?php }

								} else { ?>

									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
										<span class="dashicons dashicons-plus-alt"></span>&nbsp; Follow Investment
									</button>
								<?php } ?>

							</div>
						</div>
						<br>
					<?php } ?>

					<div class="modal" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Registration Required</h4>
					      </div>
					      <div class="modal-body">
					        <p>You are required to register for a free SKB IN CROWD account to continue. <a href="/register">Click here</a> to get started.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

				<?php }

			}

	    }

    }

} else {

 	echo '<div class="row"><div class="col-xs-12"><p>' . __( 'Investment not found.', 'skb-theme' ) . '</p></div></div>';

}

if ( TRUE === WP_DEBUG && current_user_can( 'administrator' ) ) { ?>

	<br>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<?php echo get_investment_followers(); ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?php echo get_investment_readers(); ?>
		</div>
	</div>

<?php }
