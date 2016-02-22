<?php
// Ninja Forms 

//  1 - Contact
//  2 - Individual
//  3 - Invest in this Deal 
//  4 - Trust 
//  5 - *Deleted
//  6 - Joint Tenants 
//  7 - Tenants in Common 
//  8 - Community Property 
//  9 - Individual Retirement Account 
// 10 - *Deleted
// 11 - Limited Partnership
// 12 - Limited Liability Corporation 
// 13 - *Deleted
// 14 - Corporation
// 15 - Existing Investor 

// 42 - Investor Verification


add_action( 'wp_head', 'skb_move_ninja_forms_messages' );
add_action( 'init', 'skb_ninja_forms_check' );
add_action( 'init', 'skb_ninja_forms_submitted' );
add_action( 'init', 'skb_ninja_forms_completed' );

add_filter( 'ninja_forms_submission_pdf_name', 'skb_pdf_name', 20, 2 );

add_filter( 'ninja_forms_field', 'adjust_ninja_forms_field', 15, 2 );
add_filter( 'ninja_forms_field_wrap_class', 'add_custom_ninja_forms_field_wrap_class', 10, 2 );

add_action( 'ninja_forms_display_before_field', 'insert_ninja_forms_display_before_field', 10, 2 );
add_action( 'ninja_forms_display_after_field', 'insert_ninja_forms_display_after_field', 10, 2 );


// Move responses down to after the form so user can easily see them when submitting
function skb_move_ninja_forms_messages() {

    remove_action( 'ninja_forms_display_before_form', 'ninja_forms_display_response_message', 10 );
    add_action( 'ninja_forms_display_after_form', 'ninja_forms_display_response_message', 10 );

}

// Check user/form access
function skb_ninja_forms_check() {

	add_action( 'ninja_forms_display_pre_init', 'skb_form_check' );

}

// Form submitted, handle data
function skb_ninja_forms_submitted() {

	add_action( 'ninja_forms_pre_process', 'skb_form_submitted' );

}

function skb_ninja_forms_completed() {

	add_action( 'ninja_forms_post_process', 'skb_form_completed' );

}


function skb_form_check() {

	global $ninja_forms_loading;

	$current_form_id = $ninja_forms_loading->get_form_ID();
	$current_form_id = '2';

	// Check the current form to see if we need to limit the user from filling out this form again

	switch ( $current_form_id ) {

		case '2': // Individual
		case '6': // Joint Tenants
		case '7': // Tenants in Common
		case '8': // Community Property

			// Multiple submissions are not allowed	
			break;

		case '4':  // Trust
		case '9':  // IRA 
		case '11': // Limited Partnership 
		case '12': // LLC 
		case '14': // Corporation 
		default:

			// Multiple submissions are allowed or not an AIQ form
			return;

	}

	$user_id = get_current_user_id();

	$args = array(
		'user_id'   => $user_id,
	);
	
	$subs = Ninja_Forms()->subs()->get( $args );

	foreach ( $subs as $sub ) {

		$form_id = $sub->form_id;

		switch ( $form_id ) {

			case '2': // Individual
			case '6': // Joint Tenants
			case '7': // Tenants in Common
			case '8': // Community Property
				// Multiple submissions are not allowed	
				$ninja_forms_loading->add_error( 'skb_duplicate', 'Multiple submissions of this form are not allowed.' );
				break;

			default:
				// not an AIQ form;
				break;

		}

	}

}


function skb_form_submitted() {

	global $ninja_forms_processing;

	$form_id = $ninja_forms_processing->get_form_ID();

	switch ($form_id) {

		case 2:

			// Individual

			$user_id = get_current_user_id();
			$user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user_id ) );
	
			$first_name = $ninja_forms_processing->get_field_value( 18 );
			$last_name = $ninja_forms_processing->get_field_value( 17 );
			$phone = $ninja_forms_processing->get_field_value( 26 );
			$address_1 = $ninja_forms_processing->get_field_value( 19 );
			$address_2 =  $ninja_forms_processing->get_field_value( 20 );
			$city = $ninja_forms_processing->get_field_value( 22 );
			$state = $ninja_forms_processing->get_field_value( 24 );
			$postal_code = $ninja_forms_processing->get_field_value( 21 );
			$country = $ninja_forms_processing->get_field_value( 23 );
			$dob = $ninja_forms_processing->get_field_value( 1021 );

			update_user_meta( $user_id, 'first_name', $first_name, $user_meta['first_name'] );
			update_user_meta( $user_id, 'last_name', $last_name, $user_meta['last_name'] );
			update_user_meta( $user_id, 'phone', $phone, $user_meta['phone'] );
			update_user_meta( $user_id, 'address_1', $address_1, $user_meta['address_1'] );
			update_user_meta( $user_id, 'address_2', $address_2, $user_meta['address_2'] );
			update_user_meta( $user_id, 'city', $city, $user_meta['city'] );
			update_user_meta( $user_id, 'state', $state, $user_meta['state'] );
			update_user_meta( $user_id, 'postal_code', $postal_code, $user_meta['postal_code'] );
			update_user_meta( $user_id, 'country', $country, $user_meta['country'] );
			update_user_meta( $user_id, 'dob', $dob, $user_meta['dob'] );
			break;

		case 42:

			// We've got an Investor Verification Being Uploaded
			$user_id = get_current_user_id();
			update_user_meta( $user_id, 'user_verification', date( 'Y-m-d H:i:s', time() ) );
			break;


		default:

			break;
	
	}

}


function skb_form_completed() {

	global $ninja_forms_processing;

	$form_id = $ninja_forms_processing->get_form_ID();
	$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );

	$skb_forms = array( 2, 3, 4, 6, 7, 8, 9, 11, 12, 14, 15 );

	if ( ! in_array( $form_id, $skb_forms , true ) || ! is_user_logged_in() ) {

		return;

	}

	$theme_settings = get_option('skb_theme_settings');

	$from_name = $theme_settings['skb_from_name'];
	$from_email = $theme_settings['skb_from_email'];

	$user_id = get_current_user_id();
	$user_info = get_userdata( $user_id );
	$user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user_id ) );

	$to_name = $user_meta['first_name'] . ' ' . $user_meta['last_name'];
	$to_email = $user_info->user_email;

	$headers = 'From: ' . $from_name . ' <' . $from_email . '>' . PHP_EOL;	
	$to = $to_name . ' <' . $to_email . '>';

	switch ($form_id) {
		case 3:
			// Invest in this Deal

			$subject = $theme_settings['invest_subject'];
			$email_title = $subject;
			$email_body = 'Dear ' . $to_name . ',<br><br>';
			$email_body .= do_shortcode( wpautop( $theme_settings['invest_message'] ) );
			$email_footer = '';

			// Send to DocuSign to be signed
			// send_to_docusign( $to_name, $to_email, $form_id, $sub_id );

			$redirect_url = get_permalink( $theme_settings['invest_landing'] );

			break;

		case 15:
			// Existing Investor

			$subject = $theme_settings['existing_investor_subject'];
			$email_title = $subject;
			$email_body = 'Dear ' . $to_name . ',<br><br>';
			$email_body .= do_shortcode( wpautop( $theme_settings['existing_investor_message'] ) );
			$email_footer = '';

			$redirect_url = get_permalink( $theme_settings['existing_landing'] );

			break;

		default: 
			// The rest are AIQs to send to DocuSign to be signed

			$result = send_to_docusign( $to_name, $to_email, $form_id, $sub_id );

			if ( $result ) {

				$redirect_url = home_url( '/docusign?url=' . urlencode( $result ) );

			} else {

				$redirect_url = home_url( '/docusign-error' );

			}

			wp_redirect( $redirect_url );
			exit;

	}

	// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );

	ob_start();
	include( locate_template( 'library/templates/email-basic.php', false, true ) );
	$message = ob_get_clean();

	wp_mail( $to, $subject, $message, $headers );

	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
	
	wp_redirect( $redirect_url );
	exit;

}


function skb_pdf_name( $name, $sub_id ) { 

	$name = 'skbincrowd-doc_' . $sub_id; 
	return $name; 

}

function adjust_ninja_forms_field( $data, $field_id ){

  // Fields we don't want to mess with
  if ( in_array( $field_id, array( '28', '43', '44', '45', '46', '47', '48', '50', '51', '53', '55', '56', '58', '59', '60', '62', '63', '64', '65', '67', '68', '61', '73', '98', '121', '122', '123', '125', '126', '127', '130', '131', '132', '133', '136', '141', '142', '143', '145', '150', '173', '367', '915', '916', '917', '924', '925', '926', '941', '943', '968', '969', '974', '1113', '1595', '1596', '1867', '2123', '2124', '2125', '2126', '2127', '2128', '2130' ) ) ) {
  	return $data;	
  }

  $data['class'] .= ' form-control';

  // Prepopulate certain fields
  if ( in_array( $field_id, array( '1013', '1021', '101', '103', '104', '105', '106', '107', '108', '109' ) ) ) {

	$user_id = get_current_user_id();
	$user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user_id ) );

	$first_name = $user_meta['first_name'];
	$last_name = $user_meta['last_name'];
	$phone = $user_meta['phone'];
	$address_1 = $user_meta['address_1'];
	$address_2 = $user_meta['address_2'];
	$city = $user_meta['city'];
	$state = $user_meta['state'];
	$postal_code = $user_meta['postal_code'];
	$country = $user_meta['country'];
	$dob = $user_meta['dob'];

	// Address 1
	if ( in_array( $field_id, array( '1013', '1021' ) ) ) {

	    $data['default_value'] = $dob;

	}


	// Address 1
	if ( in_array( $field_id, array( '103' ) ) ) {

	    $data['default_value'] = $address_1;

	}


	// Address 2
	if ( in_array( $field_id, array( '104' ) ) ) {

	    $data['default_value'] = $address_2;

	}


	// Phone
	if ( in_array( $field_id, array( '109' ) ) ) {

	    $data['default_value'] = $phone;

	}

	// City
	if ( in_array( $field_id, array( '106' ) ) ) {

	    $data['default_value'] = $city;

	}

	// State
	if ( in_array( $field_id, array( '107' ) ) ) {

	    $data['default_value'] = $state;

	}

	// Zip
	if ( in_array( $field_id, array( '105' ) ) ) {

	    $data['default_value'] = $postal_code;

	}

	// Country
	if ( in_array( $field_id, array( '108' ) ) ) {

	    $data['default_value'] = $country;

	}


  }


  return $data;
}


function add_custom_ninja_forms_field_wrap_class( $field_wrap_class, $field_id ) {

  // Fields we don't want to mess with
  if ( in_array( $field_id, array( '74' ) ) ) {
  	return $field_wrap_class;	
  }

  $field_wrap_class .= ' form-group col-xs-12';
  
  if ( in_array( $field_id, array( '19', '20', '103', '104', '157', '944', '945', '996', '997', '1002', '1003', '1010', '1266', '1016', '1038', '1039', '1044', '1114', '1115', '1226', '1264', '1265', '2127' ) ) ) {
  
  	$field_wrap_class .= ' col-md-6';
  
  } elseif ( in_array( $field_id, array( '29', '30', '33', '1023', '1857', '1858', '1859', '1860' ) ) ) {

	$field_wrap_class .= ' col-md-5'; 

  } elseif ( in_array( $field_id, array( '17', '18', '100', '101', '1224', '1225', '1261', '1262', '1855', '1592', '1593', '1798' ) ) ) {

	$field_wrap_class .= ' col-md-4'; 

  } elseif ( in_array( $field_id, array( '21', '22', '23', '24', '26', '27', '105', '106', '107', '108', '109', '110', '946', '947', '948', '949', '965', '998', '999', '1000', '1001', '1005', '1006', '1007', '1116', '1117', '1118', '1119', '1208', '1209', '1040', '1041', '1042', '1043', '1196' ) ) ) {
  
  	$field_wrap_class .= ' col-md-3';

  } elseif ( in_array( $field_id, array( '28', '367', '941', '1013', '1021', '1594', '1595', '1856' ) ) ) {
  
  	$field_wrap_class .= ' col-md-2';
 
  }

  return $field_wrap_class;

}


function insert_ninja_forms_display_before_field( $field_id, $data ) {

  // Fields we want to drop something in before
  if ( in_array( $field_id, array( '18', '34', '58', '67', '116', '121', '126', '131', '142', '157', '2126', '2127', '969', '1596', '2123', '2125' ) ) ) {

  	echo '<div class="row" style="border: 1px solid black; border-radius: 5px; padding: 1em 0; margin: 1em 0;">';

  }

}


function insert_ninja_forms_display_after_field( $field_id, $data ) {

  // Fields we want to drop something in after
  if ( in_array( $field_id, array( '33', '50', '56', '66', '68', '139', '143', '949', '173', '110', '1266', '1119', '1226', '1860', '1868', '1867' ) ) ) {

 	echo '</div>';
  	
  }

}