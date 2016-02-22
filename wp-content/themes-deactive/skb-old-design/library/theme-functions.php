<?php 
// Display Flexslider
function get_slides( $args ) {

	$args['post_type'] = 'slide';
	$args['post_status'] = 'publish';

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		echo '<div class="main-slider flexslider">';
		echo '<ul class="slides">';

		while ( $query->have_posts() ) { 

			$query->the_post();

			$slide_content = get_post_meta( get_the_id(), 'slide_content', TRUE );

			if ( has_post_thumbnail() ) {
				$slide_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
			}
			?>

		    <li>
          		<div class="slide-image" style="background-image: url( '<?php echo $slide_image_src[0]; ?>' );"></div>
          		<div class="slide-text"><?php echo do_shortcode( wpautop( $slide_content) ); ?><a class="idiot-arrow" href="#skb-deals"><span class="dashicons dashicons-arrow-down-alt2 hidden-xs"></span></a></div>
		    </li>

		<?php }

		echo '</ul>';
		echo '</div>';

		$theme_settings = get_option('skb_theme_settings');

		$slider_speed = 1000 * (int) $theme_settings['slider_speed'];
		?>

		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery('.main-slider').flexslider({
		    animation: "slide",
		    slideshowSpeed: <?php echo $slider_speed; ?>,
			animationSpeed: 500,
		  });
		});
		</script>

	<?php }

}


function get_mobile_banner() { 

	get_template_part( 'library/templates/content' , 'mobile_banner' );

}


// Display Investments
function get_investments( $args ) {
	
	$args['post_type'] = 'investment';
	$args['post_status'] = 'publish';

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		$post_count = 0;

		while ( $query->have_posts() ) { 

			$query->the_post();

			$investment_title = get_the_title();
			$investment_permalink = get_the_permalink();
			$investment_overview = get_post_meta( get_the_id(), 'investment_overview', TRUE );

			if ( has_post_thumbnail() ) {
				$investment_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumbnail' );
				$investment_image = '<img src="' . $investment_image_src[0] . '" class="img-responsive" >';
			} else {
				$investment_image = '<img src="http://placehold.it/320x240/685443/fff&text=SKB" class="img-responsive" title="No Featured Image">';
			}

			$post_count++;

			if ( $post_count % 2 != 0 ) {
				echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 odd">';
			} else {
				echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';
			}
			echo '<a class="clearfix" href="' . $investment_permalink . '"><span><i class="dashicons dashicons-plus"></i> LEARN MORE </span>' . $investment_image . '</a>';
			echo '<h4>' . $investment_title . '</h4>';
			echo '<div>' . $investment_overview . '</div>';
			echo '</div>';			

			/* Using Bootstrap visibility classes we will ensure everything wraps nicely */

			$visible_classes = array();

			if ( $post_count != $query->found_posts ) {
	 
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

	wp_reset_postdata();	

}


// Display Testimonials
function get_testimonials( $args ) {
  
	$args['post_type'] = 'testimonial';
	$args['post_status'] = 'publish';	

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		echo '<div class="testimonials flexslider">';
		echo '<ul class="slides">';
		while ( $query->have_posts() ) { 

			$query->the_post();

			$testimonial_source = get_the_title();
			$testimonial_quote = get_the_excerpt();

			?>

			<li>
			<blockquote>
				<p><?php echo $testimonial_quote; ?></p>
				<footer><cite><?php echo $testimonial_source; ?></cite></footer>
			</blockquote>
			</li>

			<?php
			
		}

		echo '</ul>';
		echo '</div>';

		?>

		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery('.testimonials').flexslider({
		    animation: "fade",
		    keyboard: FALSE,
		    controlNav: FALSE,
		  });
		});
		</script>

		<?php
						
	}

	wp_reset_postdata();	
}

// Display Partners
function get_partners( $args ) {
  
	$args['post_type'] = 'partner';
	$args['post_status'] = 'publish';

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		$post_count = 0;

		while ( $query->have_posts() ) { 

			$query->the_post();

			$partner_title = get_the_title();
			// $partner_details = get_post_meta( get_the_id(), 'partner_details', TRUE );

			if ( has_post_thumbnail() ) {
				$partner_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumbnail' );
				$partner_image = '<img src="' . $partner_image_src[0] . '" class="img-responsive" >';
			} else {
				$partner_image = '<img src="http://placehold.it/240x240/685443/fff&text=SKB" class="img-responsive" title="No Featured Image">';
			}

			$post_count++;

			if ( 1 == $post_count ) {
				echo '<div class="col-xs-4 col-md-2 col-md-offset-3">';
			} else {
				echo '<div class="col-xs-4 col-md-2">'; 
			}
			echo $partner_image;
			echo '</div>';
			
		}

	}

	wp_reset_postdata();	
}

function log_in_user( $username, $password, $remember = FALSE ) {

	global $user;

	$redirect_url = home_url( '/' );
	
	$args = array(
		'user_login' => $username,
		'user_password' => $password,
		'remember' => $remember,
		);

	$user = wp_signon( $args, FALSE );
	
	if ( ! is_wp_error( $user ) ) {
	
		wp_set_current_user( $user->ID );
		wp_set_auth_cookie( $user->ID );

		$theme_settings = get_option('skb_theme_settings');

		if ( current_user_can( 'pending_investor' ) ) {

			wp_logout();
			$redirect_url = get_permalink( $theme_settings['unconfirmed_landing']);

		} elseif ( current_user_can( 'registered_investor' ) ) {

		    $redirect_url = home_url( '/aiq-form' );

		}

		wp_redirect( $redirect_url );

		exit;
	
	}
}
 
function register_user( $first_name, $last_name, $email, $password ) { 

	date_default_timezone_set('America/Los_Angeles');

	$full_name = $first_name . ' ' . $last_name;

	$args = array(
		'first_name' => $first_name,
		'last_name' => $last_name,
		'nickname' => $first_name,
		'display_name' => $fullname,
		'user_nicename' => $first_name . '-' . $last_name,
		'user_login' => $email,
		'user_email' => $email,
		'user_pass' => $password,
		'role' => 'pending_investor',
		'user_registered' => date( 'Y-m-d H:i:s', time() ),
		);

	$user_id = wp_insert_user( $args );

	if ( ! is_wp_error( intval( $user_id ) ) ) {

		$bytes = openssl_random_pseudo_bytes( 4, $cstrong );
    	$hex = bin2hex( $bytes );
		$vid = $hex . $user_id;

		$validate_link = home_url( '/my-account/?register_user=' . $vid );

		$theme_settings = get_option('skb_theme_settings');

		$from_name = $theme_settings['skb_from_name'];
		$from_email = $theme_settings['skb_from_email'];

   		$headers = 'From: ' . $from_name . ' <' . $from_email . '>' . PHP_EOL;	
		$to = $fullname . ' <' . $email . '>';
		$subject = $theme_settings['confirm_registration_subject'];

		$email_title = $subject;
		$email_body = 'Dear ' . $first_name . ',' . PHP_EOL;
		$email_body .= do_shortcode( wpautop( $theme_settings['confirm_registration_message'] ) );
		$email_footer = '<a href="' . $validate_link . '" title="Confirm Registration">Confirm your email and complete registration.</a>' . PHP_EOL;
		$email_footer .= '<br><br>If you are unable to use the link above then copy and paste this link into your browser :<br><br>' . PHP_EOL;
		$email_footer .= $validate_link;

		// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
		add_filter( 'wp_mail_content_type', 'set_html_content_type' );

		ob_start();
		include( locate_template( 'library/templates/email-basic.php', FALSE, TRUE ) );
		$message = ob_get_clean();

		wp_mail( $to, $subject, $message, $headers );

		remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

		$redirect_page = $theme_settings['registration_landing'];
		$redirect = get_permalink( $redirect_page );
		
		wp_redirect( $redirect );

		exit;
	
	}

}

/*function check_user_role( $role, $user_id = null ) {
 
    if ( is_numeric( $user_id ) ) {

		$user = get_userdata( $user_id );
    
    } else {

        $user = wp_get_current_user();

    }
 
    if ( empty( $user ) ) {
	
		return FALSE;
 	
 	} else {

	    return in_array( $role, (array) $user->roles );

	}

}*/

function switch_user_role( $role, $user_id = null ) {

    $user = get_user_by( 'id', $user_id );

    if ( $user ) {

        $roles = $user->roles;

        if ( count( $roles == 1 ) ) {

            $user->remove_all_caps();
            $user->set_role( $role );

        }
    }

}

function set_html_content_type() {

	return 'text/html';

}

function get_following_investments() {

	$investments = get_user_meta( get_current_user_id(), 'following_investments', FALSE );
	$html = '<ul class="list-group">';

	if ( empty( $investments ) ) {

		$html .= '<a href="' . home_url( '/investments' ) . '" class="list-group-item"><h4 class="list-group-item-heading">Browse Investments</h4><p class="list-group-item-text">You are following 0 investments.</p></a>';
	
	} else {

		foreach ( $investments as $investment ) {

			$html .= '<a href="' . get_the_permalink( $investment ) . '" class="list-group-item clearfix">' . get_the_post_thumbnail( $investment, array( 90, 90), array( 'class' => 'pull-left' ) )  . '<h4 class="list-group-item-heading" style="margin-left: 100px;">' . get_the_title( $investment ) . '</h4></p></a>';

	  	}

	}

	$html .= '</ul>';

	return $html;

}

function get_investment_followers() {

	$investors = get_post_meta( get_the_id(), '_investment_followers', FALSE );
	$html = '<div class="alert alert-info"><p><strong>Followed By: </strong>';
	$followers = array();

	if ( empty( $investors ) ) {

		$html .= 'No investors are following this investment.';
	
	} else {

		foreach ( $investors as $investor ) {

			$user = get_user_by( 'id', (int) $investor );
			if ( $user ) {
				$followers[] = $user->first_name . ' ' . $user->last_name;
			}

	  	}

	  	$html .= implode( ', ', $followers );

	}

	$html .= '</p><p>* Only site Adminstrators can see this while WP_DEBUG is TRUE.</p>';
	$html .= '</div>';

	return $html;

}

function get_investment_readers() {

	$investors = get_post_meta( get_the_id(), '_read_investment', FALSE );
	$html = '<div class="alert alert-info"><p><strong>Read By: </strong>';
	$readers = array();

	if ( empty( $investors ) ) {

		$html .= 'No investors have read this investment.';
	
	} else {

		foreach ( $investors as $investor ) {

			$user = get_user_by( 'id', (int) $investor );
			if ( $user ) {
				$readers[] = $user->first_name . ' ' . $user->last_name;
			}

	  	}

	  	$html .= implode( ', ', $readers );

	}

	$html .= '</p><p>* Only site Adminstrators can see this while WP_DEBUG is TRUE.</p>';
	$html .= '</div>';

	return $html;

}

function send_to_docusign( $to_name, $to_email, $form_id, $sub_id ) {

	global $ninja_forms_processing;

	$theme_settings = get_option('skb_theme_settings');

	$integratorKey = $theme_settings['docusign_key'];
	$username = $theme_settings['docusign_username'];
	$password = $theme_settings['docusign_password'];

	$recipientName = $to_name;		// recipient (signer) name
	$recipientEmail = $to_email;	// recipient (signer) email

	// Get our Ninja Form Submission PDF
	$skb_pdf = new NF_PDF_Submission( __FILE__ );
	$skb_pdf_content = $skb_pdf->create_pdf_content( $sub_id );
	$page_count = SKB_PDF_PAGE_COUNT;

	// $skb_pdf_file = $skb_pdf->create_temp_file( $skb_pdf_content, $sub_id );
	// $documentName = $skb_pdf_file;
	
	$documentName = 'SKB IN CROWD - ' . $ninja_forms_processing->data['form']['form_title'] . ' - #' . $sub_id;

	// construct the authentication header:
	$header = "<DocuSignCredentials><Username>" . $username . "</Username><Password>" . $password . "</Password><IntegratorKey>" . $integratorKey . "</IntegratorKey></DocuSignCredentials>";

	// $url = "https://demo.docusign.net/restapi/v2/login_information";
	$url = $theme_settings['docusign_api_url'];
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-DocuSign-Authentication: $header"));

	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 200 ) {

		// This needs to be handled better
		echo '<p>Error calling webservice, status is ' . $status . '</p>';
		echo '<p><a href="' . home_url( '/' ) . '">Please try again</a>.</p>';
		exit(-1);
	
	}

	$response = json_decode($json_response, TRUE);
	$accountId = $response["loginAccounts"][0]["accountId"];
	$baseUrl = $response["loginAccounts"][0]["baseUrl"];
	curl_close($curl);

	$clientUserId = 'skb-' . get_current_user_id() . '-' . time();

	$embedded = TRUE;
	
	switch ( $form_id ) {

		case 2: // Individual

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Individual Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";
	
			break;

		case 3: // Invest in this Deal

			$embedded = FALSE;

			switch ( $ninja_forms_processing->get_field_value( 831 ) ) {

				case 'Trust':

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"routingOrder\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Trustees Signature :\",
						    	\"anchorXOffset\":\"1.5\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

				    if ( 'checked' == $ninja_forms_processing->get_field_value( 1776 ) ) {

						$recipientEmail2 = $ninja_forms_processing->get_field_value( 1772 );
						$recipientName2 = $ninja_forms_processing->get_field_value( 1607 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 );

						$signers .= ",{
					        \"email\":\"$recipientEmail2\",
					        \"name\":\"$recipientName2\",
					        \"recipientId\":\"2\",
					        \"routingOrder\":\"2\",
					        \"tabs\":{
								\"signHereTabs\":[
									{
							    	\"anchorString\":\"Co-Trustee Signature :\",
							    	\"anchorXOffset\":\"1.5\",
							    	\"anchorYOffset\":\"0\",
							    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
							    	\"anchorUnits\":\"inches\",
							    	\"documentId\":\"1\",
					            	}
								]
							}
					    }";

					}

					break;

				case 'Joint Tenants':

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Individual Signature :\",
						    	\"anchorXOffset\":\"1.5\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					$recipientEmail2 = $ninja_forms_processing->get_field_value( 1772 );
					$recipientName2 = $recipientName = $ninja_forms_processing->get_field_value( 1603 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 );

					$signers .= ",{
				        \"email\":\"$recipientEmail2\",
				        \"name\":\"$recipientName2\",
				        \"recipientId\":\"2\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Joint Tenant Signature :\",
						    	\"anchorXOffset\":\"1.75\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					break;

				case 'Tenants in Common':

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Individual Signature :\",
						    	\"anchorXOffset\":\"1.5\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					$recipientEmail2 = $ninja_forms_processing->get_field_value( 1772 );
					$recipientName2 = $ninja_forms_processing->get_field_value( 1597 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 );

					$signers .= ",{
				        \"email\":\"$recipientEmail2\",
				        \"name\":\"$recipientName2\",
				        \"recipientId\":\"2\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Tenant in Common Signature :\",
						    	\"anchorXOffset\":\"2\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					break;

				case 'Community Property':

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Individual Signature :\",
						    	\"anchorXOffset\":\"1.5\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					$recipientEmail2 = $ninja_forms_processing->get_field_value( 1772 );
					$recipientName2 = $ninja_forms_processing->get_field_value( 1606 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 );

					$signers .= ",{
				        \"email\":\"$recipientEmail2\",
				        \"name\":\"$recipientName2\",
				        \"recipientId\":\"2\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Spouse Signature :\",
						    	\"anchorXOffset\":\"1.25\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					break;

				case 'Individual Retirement Account':

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Beneficial Signature :\",
						    	\"anchorXOffset\":\"1.5\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					break;


				case 'Limited Partnership':

					$recipientName = $ninja_forms_processing->get_field_value( 1796 );
					$recipientEmail = $ninja_forms_processing->get_field_value( 1786 );

					if ( 'checked' == $ninja_forms_processing->get_field_value( 1782 ) ) {

						$signers = "{
					        \"email\":\"$recipientEmail\",
					        \"name\":\"$recipientName\",
					        \"recipientId\":\"1\",
					        \"tabs\":{
								\"signHereTabs\":[
									{
							    	\"anchorString\":\"Authorized Officer Signature :\",
							    	\"anchorXOffset\":\"2\",
							    	\"anchorYOffset\":\"0\",
							    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
							    	\"anchorUnits\":\"inches\",
							    	\"documentId\":\"1\",
					            	}
								]
							}
					    }";

					} else {

						$signers = "{
					        \"email\":\"$recipientEmail\",
					        \"name\":\"$recipientName\",
					        \"recipientId\":\"1\",
					        \"tabs\":{
								\"signHereTabs\":[
									{
							    	\"anchorString\":\"General Partner Signature :\",
							    	\"anchorXOffset\":\"2\",
							    	\"anchorYOffset\":\"0\",
							    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
							    	\"anchorUnits\":\"inches\",
							    	\"documentId\":\"1\",
					            	}
								]
							}
					    }";

					}

					break;

				case 'Limited Liability Company':

					$recipientName = $ninja_forms_processing->get_field_value( 834 );
					$recipientEmail = $ninja_forms_processing->get_field_value( 1793 );

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Authorized Signature :\",
						    	\"anchorXOffset\":\"2.25\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					if ( 'checked' == $ninja_forms_processing->get_field_value( 1795 ) ) {

						$recipientName2 = $ninja_forms_processing->get_field_value( 951 );
						$recipientEmail2 = $ninja_forms_processing->get_field_value( 1794 );

					    $signers .= ",{
					        \"email\":\"$recipientEmail2\",
					        \"name\":\"$recipientName2\",
					        \"recipientId\":\"2\",
					        \"tabs\":{
								\"signHereTabs\":[
									{
							    	\"anchorString\":\"Authorized Signature 2 :\",
							    	\"anchorXOffset\":\"2.25\",
							    	\"anchorYOffset\":\"0\",
							    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
							    	\"anchorUnits\":\"inches\",
							    	\"documentId\":\"1\",
					            	}
								]
							}
					    }";

					}

					break;


				case 'Corporation':

					$recipientName = $ninja_forms_processing->get_field_value( 834 );
					$recipientEmail = $ninja_forms_processing->get_field_value( 1793 );

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Authorized Signature :\",
						    	\"anchorXOffset\":\"2.25\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					if ( 'checked' == $ninja_forms_processing->get_field_value( 1795 ) ) {

						$recipientName2 = $ninja_forms_processing->get_field_value( 951 );
						$recipientEmail2 = $ninja_forms_processing->get_field_value( 1794 );

					    $signers .= ",{
					        \"email\":\"$recipientEmail2\",
					        \"name\":\"$recipientName2\",
					        \"recipientId\":\"2\",
					        \"tabs\":{
								\"signHereTabs\":[
									{
							    	\"anchorString\":\"Authorized Signature 2 :\",
							    	\"anchorXOffset\":\"2.25\",
							    	\"anchorYOffset\":\"0\",
							    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
							    	\"anchorUnits\":\"inches\",
							    	\"documentId\":\"1\",
					            	}
								]
							}
					    }";

					}

					break;

				case 'Individual Investor':
				default:

				    $signers = "{
				        \"email\":\"$recipientEmail\",
				        \"name\":\"$recipientName\",
				        \"recipientId\":\"1\",
				        \"tabs\":{
							\"signHereTabs\":[
								{
						    	\"anchorString\":\"Individual Signature :\",
						    	\"anchorXOffset\":\"1.5\",
						    	\"anchorYOffset\":\"0\",
						    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
						    	\"anchorUnits\":\"inches\",
						    	\"documentId\":\"1\",
				            	}
							]
						}
				    }";

					break;

			} // END of Invest in this Deal Switch Statement

			break; 

		case 4: // Trust

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"routingOrder\":\"1\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Trustees Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			if ( 'checked' == $ninja_forms_processing->get_field_value( 1596 ) ) {

				$recipientEmail2 = $ninja_forms_processing->get_field_value( 1766 );
				$recipientName2 = $ninja_forms_processing->get_field_value( 1592 ) . ' ' . $ninja_forms_processing->get_field_value( 1593 );

				$signers .= ",{
			        \"email\":\"$recipientEmail2\",
			        \"name\":\"$recipientName2\",
			        \"recipientId\":\"2\",
			        \"routingOrder\":\"2\",
			        \"tabs\":{
						\"signHereTabs\":[
							{
					    	\"anchorString\":\"Co-Trustee Signature :\",
					    	\"anchorXOffset\":\"1.5\",
					    	\"anchorYOffset\":\"0\",
					    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
					    	\"anchorUnits\":\"inches\",
					    	\"documentId\":\"1\",
			            	}
						]
					}
			    }";

			}

			break;

		case 6: // Joint Tenants

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Individual Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			$recipientEmail2 = $ninja_forms_processing->get_field_value( 1769 );
			$recipientName2 = $ninja_forms_processing->get_field_value( 1210 ) . ' ' . $ninja_forms_processing->get_field_value( 1211 );

			$signers .= ",{
		        \"email\":\"$recipientEmail2\",
		        \"name\":\"$recipientName2\",
		        \"recipientId\":\"2\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Joint Tenant Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;

		case 7: // Tenants in Common

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Individual Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			$recipientEmail2 = $ninja_forms_processing->get_field_value( 1770 );
			$recipientName2 = $ninja_forms_processing->get_field_value( 1229 ) . ' ' . $ninja_forms_processing->get_field_value( 1231 );

			$signers .= ",{
		        \"email\":\"$recipientEmail2\",
		        \"name\":\"$recipientName2\",
		        \"recipientId\":\"2\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Tenant in Common Signature :\",
				    	\"anchorXOffset\":\"2\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;

		case 8: // Community Property

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Individual Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			$recipientEmail2 = $ninja_forms_processing->get_field_value( 1771 );
			$recipientName2 = $ninja_forms_processing->get_field_value( 1254 ) . ' ' . $ninja_forms_processing->get_field_value( 1255 );

			$signers .= ",{
		        \"email\":\"$recipientEmail2\",
		        \"name\":\"$recipientName2\",
		        \"recipientId\":\"2\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Spouse Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;

		case 9: // Individual Retirement Account

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Beneficial Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;


		case 11: // Limited Partnership

			if ( 'checked' == $ninja_forms_processing->get_field_value( 1937 ) ) {

				$recipientName = $ninja_forms_processing->get_field_value( 1587 );
				$recipientEmail = $ninja_forms_processing->get_field_value( 1938 );

			    $signers = "{
			        \"email\":\"$recipientEmail\",
			        \"name\":\"$recipientName\",
			        \"recipientId\":\"1\",
			        \"clientUserId\":\"$clientUserId\",
			        \"tabs\":{
						\"signHereTabs\":[
							{
					    	\"anchorString\":\"Authorized Officer Signature :\",
					    	\"anchorXOffset\":\"2\",
					    	\"anchorYOffset\":\"0\",
					    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
					    	\"anchorUnits\":\"inches\",
					    	\"documentId\":\"1\",
			            	}
						]
					}
			    }";

			} else {

				$recipientName = $ninja_forms_processing->get_field_value( 1584 );
				$recipientEmail = $ninja_forms_processing->get_field_value( 1781 );

				$signers = "{
			        \"email\":\"$recipientEmail\",
			        \"name\":\"$recipientName\",
			        \"recipientId\":\"1\",
			        \"clientUserId\":\"$clientUserId\",
			        \"tabs\":{
						\"signHereTabs\":[
							{
					    	\"anchorString\":\"General Partner Signature :\",
					    	\"anchorXOffset\":\"2\",
					    	\"anchorYOffset\":\"0\",
					    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
					    	\"anchorUnits\":\"inches\",
					    	\"documentId\":\"1\",
			            	}
						]
					}
			    }";

			}

			break;

		case 12: // Limited Liability Corporation

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Authorized Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;


		case 14: // Corporation
		
			$recipientName = $ninja_forms_processing->get_field_value( 1588 );

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Authorized Officer Signature :\",
				    	\"anchorXOffset\":\"2\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;

		default: 

		    $signers = "{
		        \"email\":\"$recipientEmail\",
		        \"name\":\"$recipientName\",
		        \"recipientId\":\"1\",
		        \"clientUserId\":\"$clientUserId\",
		        \"tabs\":{
					\"signHereTabs\":[
						{
				    	\"anchorString\":\"Signature :\",
				    	\"anchorXOffset\":\"1.5\",
				    	\"anchorYOffset\":\"0\",
				    	\"anchorIgnoreIfNotPresent\":\"FALSE\",
				    	\"anchorUnits\":\"inches\",
				    	\"documentId\":\"1\",
		            	}
					]
				}
		    }";

			break;

	}

	$data = "{		
	  \"emailSubject\":\"SKB IN CROWD - Signature Request\",
	  \"emailBlurb\":\"Please sign this document by following the REVIEW DOCUMENT link above.\",
	  \"documents\":[
	    {
	      \"documentId\":\"1\",
	      \"name\":\"$documentName\"
	    }
	  ],
	  \"recipients\":{
	    \"signers\":[
	    	$signers
	    ]
	  },
	  \"status\":\"sent\"
	}";

	//$file_contents = file_get_contents($documentName);
	$file_contents = $skb_pdf_content;

	$requestBody = "\r\n"
	."\r\n"
	."--myboundary\r\n"
	."Content-Type: application/json\r\n"
	."Content-Disposition: form-data\r\n"
	."\r\n"
	."$data\r\n"
	."--myboundary\r\n"
	."Content-Type:application/pdf\r\n"
	."Content-Disposition: file; filename=\"$documentName\"; documentid=1 \r\n"
	."\r\n"
	."$file_contents\r\n"
	."--myboundary--\r\n"
	."\r\n";

	// *** append "/envelopes" to baseUrl and as signature request endpoint
	$curl = curl_init($baseUrl . "/envelopes" );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);                                                                  
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: multipart/form-data;boundary=myboundary',
		'Content-Length: ' . strlen($requestBody),
		"X-DocuSign-Authentication: $header" )                                                                       
	);

	// parse the response
	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ( $status != 201 ) {

		$ninja_forms_processing->update_form_setting( 'DocuSign_Error_Status', $status );
		$ninja_forms_processing->update_form_setting( 'DocuSign_Error_Status', $json_response );
		if ( WP_DEBUG_LOG ) {
			error_log( 'DocuSign Error Status : ' . $status . ' - ' . $json_response );
		}

		exit;
		
	} else {

		$response = json_decode($json_response, TRUE);
		$envelopeId = $response["envelopeId"];

		//--- add results to form submission
		$ninja_forms_processing->update_form_setting( 'DocuSign_Envelope_ID', $response["envelopeId"] );

	}

	if ( $embedded ) {

		$docusign_redirect_url = home_url() . '/docusign-completed';

		// Get the Embedded Singing View 
		$data = array(
			"returnUrl" => $docusign_redirect_url,
			"authenticationMethod" => "None",
			"email" => $recipientEmail, 
			"userName" => $recipientName, 
			"clientUserId" => $clientUserId
		);                                                                    
		
		$data_string = json_encode($data);    
		$curl = curl_init($baseUrl . "/envelopes/$envelopeId/views/recipient" );
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string),
			"X-DocuSign-Authentication: $header" )                                                                       
		);
		
		$json_response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if ( $status != 201 ) {
			echo "error calling webservice, status is:" . $status . "\nerror text is --> ";
			print_r($json_response); echo "\n";
			exit(-1);
		}
		
		$response = json_decode($json_response, TRUE);
		$url = $response["url"];
		
		// Docusign embedded is at $url 
		// Navigate to this URL to start the embedded signing view of the envelope"; 

		return $url;

	} else {

		return FALSE;

	}

}

function is_ipad() { 

	if ( ! empty( $_SERVER['HTTP_USER_AGENT'] ) && strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) ) {

		return TRUE;
	
	} else {

		return FALSE;

	}

}

function add_debug_log_item( $log )  {

    if ( TRUE === WP_DEBUG ) {

        if ( is_array( $log ) || is_object( $log ) ) {

            error_log( print_r( $log, TRUE ) );

        } else {

            error_log( $log );

        }

    }

}