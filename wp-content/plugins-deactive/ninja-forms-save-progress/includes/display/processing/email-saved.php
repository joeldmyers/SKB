<?php

add_action( 'init', 'ninja_forms_register_save_progress_email_user' );
function ninja_forms_register_save_progress_email_user(){
	add_action( 'ninja_forms_save_progress', 'ninja_forms_save_progress_email_user' );
}

function ninja_forms_save_progress_email_user(){
	global $ninja_forms_processing, $current_user;

	if( $ninja_forms_processing->get_form_setting( 'email_saved' ) ){
		$email_saved = $ninja_forms_processing->get_form_setting( 'email_saved' );
	}else{
		$email_saved = 0;
	}
	
	if( $email_saved == 1 ){

		get_currentuserinfo();
		$user_mailto = array();
		$all_fields = $ninja_forms_processing->get_all_fields();
		if(is_array($all_fields) AND !empty($all_fields)){
			foreach($all_fields as $field_id => $user_value){
				$field_row = $ninja_forms_processing->get_field_settings( $field_id );

				if(isset($field_row['data']['send_email'])){
					$send_email = $field_row['data']['send_email'];
				}else{
					$send_email = 0;
				}

				if($send_email){
					array_push($user_mailto, $user_value);
				}
			}
		}

		if ( empty( $user_mailto ) ) {
			$user_mailto = array( $current_user->user_email );
		}

		$email_from = $ninja_forms_processing->get_form_setting('saved_from_address');
		$email_from_name = $ninja_forms_processing->get_form_setting( 'saved_from_name' );
		$email_type = $ninja_forms_processing->get_form_setting('saved_format');

		$subject = $ninja_forms_processing->get_form_setting('saved_subject');
		$message = $ninja_forms_processing->get_form_setting('save_email_msg');

		//Apply shortcodes to each of our message fields.
		$subject = do_shortcode( $subject );
		$message = do_shortcode( $message );

		if( $email_type !== 'plain' ){
			$message = wpautop( $message );
		}

		$email_from = $email_from_name.' <'.$email_from.'>';

		$headers = "\nMIME-Version: 1.0\n";
		$headers .= "From: $email_from \r\n";
		$headers .= "Content-Type: text/".$email_type."; charset=utf-8\r\n";

		$attachments = apply_filters( 'ninja_forms_save_progress_email_attachments', array() );
		
		if(is_array($user_mailto) AND !empty($user_mailto)){
			wp_mail($user_mailto, $subject, $message, $headers, $attachments);
		}
	}
}