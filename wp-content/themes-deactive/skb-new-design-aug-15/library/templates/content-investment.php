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
                        echo skb_get_offering_remaining_equity($post);
                        echo skb_get_offering_total_equity($post);
                        
	        echo '</div>';
	        echo '</div>'; // end the row

			$terms = get_the_terms( get_the_id(), 'investment_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {

				foreach ( $terms as $term ) {

					if ( 'Active' == $term->name ) { ?>
						<br>
						<div class="row">
							<div class="col-xs-12">
								<div class="alert alert-success alert-dismissible fade in hide" id="alert-follow" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div id="ajax_follow_response"></div>
								</div>
								<div class="btn-group">
									<?php 
									if ( is_user_logged_in() ) {
										$following_investments = get_user_meta( get_current_user_id(), 'following_investments', false );
										if ( ! in_array( get_the_id(), $following_investments ) ) { 
										?>
                                                                                    <div role="presentation" class="col-lg-3 col-md-6">
                                                                                            <button type="button" id="follow_investment" class="btn btn-primary">
                                                                                                    <span class="dashicons dashicons-plus-alt"></span>&nbsp; Follow Investment
                                                                                            </button>
                                                                                    </div>
										<?php } else { ?>
                                                                                    <div role="presentation" class="col-lg-3 col-md-6">
                                                                                            <button type="button" id="unfollow_investment" class="btn btn-primary">
                                                                                                    <span class="dashicons dashicons-dismiss"></span>&nbsp; Unfollow Investment
                                                                                            </button>
                                                                                    </div>
										<?php } ?>
										<?php
										if ( get_post_meta( get_the_id(), 'investment_offering', TRUE ) ) { ?>
                                                                                    <div role="presentation" class="col-lg-3 col-md-6">
                                                                                            <button type="button" id="read_investment" class="btn btn-primary">
                                                                                                    <span class="dashicons dashicons-analytics"></span>&nbsp; Information Memorandum
                                                                                            </button>
                                                                                    </div>
										<?php 
										}
                                                                                
										$read_list = get_user_meta( get_current_user_id(), 'read_list', false );
                                                                                
										if ( ! in_array( get_the_id(), $read_list ) ) { 
										?>
                                                                                    <div role="presentation" class="col-lg-3 col-md-6" data-toggle="tooltip" title="You are required to read the offering memorandum before investing." >
                                                                                        <button type="button"id="invest_in_this_deal" class="btn btn-primary disabled" >
                                                                                            <span class="dashicons dashicons-chart-line"></span>&nbsp; Start Investment Process
                                                                                        </button>
                                                                                    </div>
                                                                                    
										<?php } else { ?>
                                                                                    
                                                                                    <div role="presentation" class="col-lg-3 col-md-6">
                                                                                            <a href="<?php echo get_permalink(1992) . '/invest-in-this-deal/?deal_id=' . get_the_ID(); ?>" >
                                                                                                <button type="button" id="invest_in_this_deal" class="btn btn-primary" >
                                                                                                    <span class="dashicons dashicons-chart-line"></span>&nbsp; Start Investment Process
                                                                                                </button>
                                                                                            </a>
                                                                                    </div>
                                                                                    
									<?php } ?>
                                                                                    
                                                                                    <div role="presentation" class="col-lg-3 col-md-6">
											<button id="investment_req_btn" type="button"  class="btn btn-primary" data-toggle="modal" data-target="#investment_req_modal" disabled>
                                                                                            <span class="dashicons dashicons-chart-line"></span><span>&nbsp; Loading...</span>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php
                                                                                
									} else { ?>
                                                                                    
										<div role="presentation" class="col-lg-3 col-md-6">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
												<span class="dashicons dashicons-plus-alt"></span>&nbsp; Follow Investment
											</button>
										</div>
										<div role="presentation" class="col-lg-3 col-md-6">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
												<span class="dashicons dashicons-analytics"></span>&nbsp; Information Memorandum
											</button>
										</div>
                                                                                
										<div role="presentation" class="col-lg-3 col-md-6">
											<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
												<span class="dashicons dashicons-chart-line"></span>&nbsp; Start Investment Process
                                                                                        </button>
										</div>
                                                                                <div role="presentation" class="col-lg-3 col-md-6">
											<button  id="investment_req_btn" type="button"  class="btn btn-primary" data-toggle="modal" data-target="#investment_req_modal" disabled>
												<span class="dashicons dashicons-chart-line"></span><span>&nbsp; Loading...</span>
                                                                                        </button>
										</div>
                                                                                
									<?php } ?>
								</div>
							</div>
						</div>

						<?php if ( is_user_logged_in() ) { ?>

						<div class="row">
							<div class="col-xs-12">
								<div class="collapse" id="invest_form">
									<?php if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 55 ); } ?>
								</div>
							</div>
						</div>

						<?php } ?>

					<?php } elseif ( 'Coming' == $term->name ) { ?>
						<br>
						<div class="row">
							<div class="col-xs-12">
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
                                                                            <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#investment_req_modal" disabled>
                                                                                <span class="dashicons dashicons-chart-line"></span>&nbsp; Investment Requirements
                                                                            </button>
                                                            
									<?php } else { ?>
                                                            
                                                                            <button type="button" id="unfollow_invesment" class="btn btn-primary">
                                                                                <span class="dashicons dashicons-dismiss"></span> Unfollow Investment
                                                                            </button>
                                                                            <button  id="investment_req_btn" type="button"  class="btn btn-primary" data-toggle="modal" data-target="#investment_req_modal" disabled>
                                                                                <span class="dashicons dashicons-chart-line"></span>&nbsp; Investment Requirements
                                                                            </button>
                                                            
									<?php }

								} else { ?>

									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegisterModal">
                                                                            <span class="dashicons dashicons-plus-alt"></span>&nbsp; Follow Investment
									</button>
                                                                        <button  id="investment_req_btn" type="button"  class="btn btn-primary" data-toggle="modal" data-target="#investment_req_modal" disabled>
                                                                            <span class="dashicons dashicons-chart-line"></span><span>&nbsp; Loading...</span>
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
                                        
                                        <div class="modal" id="investment_req_modal" tab-index="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Investment Requirements</h4>
                                                    </div>
                                                    <div class="modal-body investment_req_modal">
                                                        <select class="form-control" id="investment_req_dropdown" name="investment_req_dropdown" >
                                                            <option>Select an investment entity to view requirements</option>
                                                            <option value="ind">Individual</option>
                                                            <option value="tru">Trust</option>
                                                            <option value="jts">Joint Tenants (Available only for married couples)</option>
                                                            <option value="tic">Tenants in Common (Available only for married couples)</option>
                                                            <option value="com">Community Property</option>
                                                            <option value="ira">Individual Retirement Account</option>
                                                            <option value="ltp">Limited Partnership</option>
                                                            <option value="llc">Limited Liability Company</option>
                                                            <option value="crp">Corporation</option>
                                                        </select>
                                                    
                                                    
                                                        <div id="investment_req_ind">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to <a href="mailto:mhill@skbcos.com"> mhill@skbcos.com</a>, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount</li>
                                                                <li>Source of funds (i.e. personal bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, Account number</li>
                                                                <li>Social security number</li>
                                                                <li>Identification (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney (click here to download)*</li>
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_tru">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount</li>
                                                                <li>Source of funds (i.e. bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, Account number</li>
                                                                <li>Trust name</li>
                                                                <li>Tax ID number</li>
                                                                <li>Trust agreement and any amendments (click here to download)*</li>
                                                                <li>Identification of trustee (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney (click here to download)*</li>
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_jts">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount</li>
                                                                <li>Source of funds (i.e. personal bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, Account number</li>
                                                                <li>Social security number for both primary contact and spouse</li>
                                                                <li>Identification for both primary contact and spouse (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney for both primary contact and spouse (click here to download)*</li>
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_tic">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount</li>                                                                     
                                                                <li>Source of funds (i.e. personal bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, Account number</li>
                                                                <li>Social security number for both Joint Tenant and Tenant in Common</li>
                                                                <li>Identification each joint tenant (Driver's license or State issued ID; or U.S. passport; or Alien identification card and foreign passport.)*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney for each joint tenant (click here to download)*</li>
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_com">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount</li> 
                                                                <li>Source of funds (i.e. personal bank account)</li> 
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, </li> 
                                                                <li>Account number</li> 
                                                                <li>Social security number for both primary contact and spouse</li> 
                                                                <li>Identification for both primary contact and spouse (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li> 
                                                                <li>Accredited investor verification form completed by your accountant or attorney for both primary contact and spouse (click here to download)*</li> 
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_ira">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount </li>
                                                                <li>Source of funds (i.e. bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, </li>
                                                                <li>Account number</li>
                                                                <li>Social security number of primary contact / beneficiary </li>
                                                                <li>IRA name</li>
                                                                <li>Custodian name </li>
                                                                <li>Tax ID number </li>
                                                                <li>Contact information for IRA (address, email phone)</li>
                                                                <li>Identification of beneficiary (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney (click here to download)*</li>
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_ltp">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount </li>
                                                                <li>Source of funds (i.e. bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, </li>
                                                                <li>Account number</li>
                                                                <li>Tax id number</li>
                                                                <li>Limited partnership name</li>
                                                                <li>Is general partner an individual?  Yes: </li>
                                                                    <ul>
                                                                        <li>General Partner Name </li>
                                                                        <li>General Partner Email 	</li>
                                                                    </ul>
                                                                <li>Is general partner a corporation?  Yes: </li>
                                                                    <ul>
                                                                        <li>General Partner Name </li>
                                                                        <li>Authorized Officer Name </li>
                                                                        <li>Authorized Author Email 	</li>
                                                                    </ul>
                                                                <li>Limited partnership agreement and any amendments*</li>
                                                                <li>Identification of general partner if general partner is an individual, or authorized officer if general partner is a corporation (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney (click here to download)*</li>
                                                            </ul>
                                                        </div>
                                                        
                                                        <div id="investment_req_llc">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount </li>
                                                                <li>Source of funds (i.e. bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, </li>
                                                                <li>Account number</li>
                                                                <li>LLC name</li>
                                                                <li>Tax ID number </li>
                                                                <li>Managing member </li>
                                                                    <ul>
                                                                        <li>Name </li>
                                                                        <li>Email </li>
                                                                        <li>Social security number</li>
                                                                        <li>Identification (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                    </ul>
                                                                <li>Limited liability company agreement and any amendments*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney (click here to download)*</li>
                                                            </ul>
                                                        </div>

                                                        <div id="investment_req_crp">
                                                            <p>Following is a list of items required to submit your investment request. Once you have all of the items prepared please click "NEXT" to proceed with your investment .</p>
                                                            <p><strong>Note:</strong> <italic>All completed forms referenced here must either be uploaded to the investment form or emailed to mhill@skbcos.com, prior to SKB accepting your investment. Failure to submit these forms prior to the closing date will exclude you from the investment.</italic></p>
                                                            <p><strong>Note:</strong> <italic>Electronic copies (pdf or jpg) of the following asterisked (*) items are required to complete the investment form.</italic></p>
                                                            <ul id="investment_req_ul">
                                                                <li>Investment amount </li>
                                                                <li>Source of funds (i.e. bank account)</li>
                                                                <li>Bank Information: Name of bank, Address of bank, ABA/Routing Number, </li>
                                                                <li>Account number</li>
                                                                <li<li>Corporation name </li>
                                                                Tax ID number</li>
                                                                <li>Authorized signer</li>
                                                                    <ul>
                                                                        <li>Title</li>
                                                                        <li>Email </li>
                                                                        <li>Social security number</li>
                                                                        <li>Identification (Driver's license or State issued ID; or U.S. passport; or both Alien identification card and foreign passport.)*</li>
                                                                    </ul>
                                                                <li>Corporation agreement and any amendments*</li>
                                                                <li>Accredited investor verification form completed by your accountant or attorney (click here to download)*</li>
                                                            </ul>
                                                        </div>
                                                    
                                                    
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>                                               
                                            </div>
                                        </div>
                                            

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
