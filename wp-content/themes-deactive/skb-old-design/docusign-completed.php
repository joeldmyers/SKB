<?php /* Template Name: Docusign Completed */ 

	// Docusign is loaded in an iframe and once completed directs the user to a url of our choice 
	// However, it is stuck in the iframe so to resolve that we direct Docusign here, then redirect 
	// the parent to the aiq landing page, probably a better way but this will do for now

	// We need to identify the user role and AIQ count and handle accordingly

	if ( ! is_user_logged_in() ) {

		$redirect_url = home_url( '/register' );
		wp_redirect( $redirect_url );
		exit;

	}

	$user_id = get_current_user_id();
    $theme_settings = get_option('skb_theme_settings');

	if ( current_user_can( 'registered_investor' ) ) {

		switch_user_role( 'waiting_investor', $user_id );

		$subject = $theme_settings['first_aiq_completed_subject'];
		$email_title = $subject;
		$email_body = 'Dear ' . $to_name . ',<br><br>';
		$email_body .= do_shortcode( wpautop( $theme_settings['first_aiq_completed_message'] ) );
		$email_footer = '';

		// Setup single cron events for each of cooling phases which include emails and lastly a role change to approved
		wp_schedule_single_event( time() + ( 2 * 24 * 60 * 60 ), 'skb_waiting_investor', array( $user_id, '1') );
		wp_schedule_single_event( time() + ( 5 * 24 * 60 * 60 ), 'skb_waiting_investor', array( $user_id, '2') );

		$redirect_url = get_permalink( $theme_settings['first_aiq_landing'] );


	} elseif ( current_user_can( 'waiting_investor' ) ) {

		$subject = $theme_settings['additional_aiq_completed_subject'];
		$email_title = $subject;
		$email_body = 'Dear ' . $to_name . ',<br><br>';
		$email_body .= do_shortcode( wpautop( $theme_settings['additional_aiq_completed_message'] ) );
		$email_footer = '';
		
		$redirect_url = get_permalink( $theme_settings['second_aiq_landing'] );

	} elseif ( current_user_can( 'approved_investor' ) ) {

		$subject = $theme_settings['approved_aiq_completed_subject'];
		$email_title = $subject;
		$email_body = 'Dear ' . $to_name . ',<br><br>';
		$email_body .= do_shortcode( wpautop( $theme_settings['approved_aiq_completed_message'] ) );
		$email_footer = '';

		$redirect_url = get_permalink( $theme_settings['approved_landing'] );

	} else {

		$subject = $theme_settings['approved_aiq_completed_subject'];
		$email_title = $subject;
		$email_body = 'Dear ' . $to_name . ',<br><br>';
		$email_body .= do_shortcode( wpautop( $theme_settings['approved_aiq_completed_message'] ) );
		$email_footer = '';

		// We've got someone like an administrator, editor etc. who is testing the site
		$redirect_url = get_permalink( $theme_settings['approved_landing'] );

	}

	// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );

	ob_start();
	include( locate_template( 'library/templates/email-basic.php', FALSE, TRUE ) );
	$message = ob_get_clean();

	wp_mail( $to, $subject, $message, $headers );

	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );


	wp_redirect( $redirect_url );
	exit;

?>

<script type="text/javascript">
    function redirect_page() {
        window.top.location.href = "<?php echo $redirect_url; ?>"; 
    }
    redirect_page();
</script>