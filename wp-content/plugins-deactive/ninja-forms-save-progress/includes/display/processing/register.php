<?php
/**
 * Functions used to register users.
 *
**/

function ninja_forms_init_register_user(){
	global $register_user, $ninja_forms_processing;

	if(isset($_POST['_ninja_forms_wp_register'])){
		$form_id = $_POST['_form_id'];
		$plugin_settings = nf_sp_get_settings();
		$spam_a = $plugin_settings['register_spam_a'];

		if(!empty($_POST['_ninja_forms_register_spam']) AND $_POST['_ninja_forms_register_spam'] == $spam_a){
			if(!empty($_POST['_ninja_forms_register_log']) AND !empty($_POST['_ninja_forms_register_password']) AND !empty($_POST['_ninja_forms_register_repassword']) AND !empty($_POST['_ninja_forms_register_email']) AND !empty($_POST['_ninja_forms_register_spam'])){
				if($_POST['_ninja_forms_register_password'] == $_POST['_ninja_forms_register_repassword']){
					$userdata = array(
						'user_login' => $_POST['_ninja_forms_register_log'],
						'user_pass' => $_POST['_ninja_forms_register_password'],
						'user_email' => $_POST['_ninja_forms_register_email'],
					);
					$userdata = apply_filters( 'nf_sp_register_user_data', $userdata );
					$register_user = wp_insert_user($userdata);
					if(!is_wp_error($register_user)){
						$creds = array();
						$creds['user_login'] = $_POST['_ninja_forms_register_log'];
						$creds['user_password'] = $_POST['_ninja_forms_register_password'];
						$creds['remember'] = false;
						if ( is_ssl() ) {
							$secure = true;
						} else {
							$secure = false;
						}
						$user = wp_signon( $creds, $secure );
						if(!is_wp_error($user)){
							wp_set_current_user($user->ID);
							wp_set_auth_cookie( $user->ID );
    						do_action( 'wp_login', $user->user_login );

							$current_url = add_query_arg( array() );
    						$ninja_forms_processing->update_form_setting( 'save_redirect', $current_url );
						}
					}else{
						//echo $register_user->get_error_code();
					}
				}
			}
		}
	}
}

add_action( 'init', 'ninja_forms_init_register_user' );

function ninja_forms_register_user(){
	global $ninja_forms_processing, $register_user;

	$form_id = $ninja_forms_processing->get_form_ID();
	$plugin_settings = nf_sp_get_settings();
	$spam_a = $plugin_settings['register_spam_a'];
	$spam_error = $plugin_settings['register_spam_error'];
	$gen_reg_error = $plugin_settings['register_error'];
	$req_field_error = $plugin_settings['req_field_error'];
	$password_mismatch_error = $plugin_settings['password_mismatch'];
	if( $ninja_forms_processing->get_extra_value( '_ninja_forms_wp_register' ) AND !is_user_logged_in()){
		$ninja_forms_processing->set_action( 'register' );
		$register_log = $ninja_forms_processing->get_extra_value( '_ninja_forms_register_log' );
		$register_password = $ninja_forms_processing->get_extra_value( '_ninja_forms_register_password' );
		$register_repassword = $ninja_forms_processing->get_extra_value( '_ninja_forms_register_repassword' );
		$register_email = $ninja_forms_processing->get_extra_value( '_ninja_forms_register_email' );
		$register_spam = $ninja_forms_processing->get_extra_value( '_ninja_forms_register_spam' );
		
		if( empty( $register_log ) ){
			$ninja_forms_processing->add_error('_register_log', __($req_field_error, 'ninja-forms'), '_register_log');
		}
		if( empty( $register_password ) ){
			$ninja_forms_processing->add_error('_register_password', __($req_field_error, 'ninja-forms'), '_register_passwordd');
		}
		if( empty( $register_repassword ) ){
			$ninja_forms_processing->add_error('_register_repassword', __($req_field_error, 'ninja-forms'), '_register_repassword');
		}
		if( empty( $register_email ) ){
			$ninja_forms_processing->add_error('_register_email', __($req_field_error, 'ninja-forms'), '_register_email');
		}
		if( empty( $register_spam ) ){
			$ninja_forms_processing->add_error('_register_spam', __($req_field_error, 'ninja-forms'), '_register_spam');
		}
		
		if( !$ninja_forms_processing->get_error('_ninja_forms_register_password') AND !$ninja_forms_processing->get_error( '_ninja_forms_register_repassword' ) ){
			if( $ninja_forms_processing->get_extra_value( '_ninja_forms_register_password' ) != $ninja_forms_processing->get_extra_value( '_ninja_forms_register_repassword' ) ){
				$ninja_forms_processing->add_error( '_register_password', __($password_mismatch_error, 'ninja-forms'), '_register_password' );
				$ninja_forms_processing->add_error( '_register_repassword', __($password_mismatch_error, 'ninja-forms'), '_register_repassword' );
			}
		}

		if( !empty( $register_spam ) AND !$ninja_forms_processing->get_error( '_register_spam' ) ){	
			if( isset( $register_user ) AND is_object( $register_user ) ){
				$error_code = $register_user->get_error_code();

				$register_error = $register_user->get_error_message();
				if( isset( $error_code ) AND $error_code == 'existing_user_login' ){
					$ninja_forms_processing->add_error( '_register_log', __( $register_error, 'ninja-forms' ), '_register_log' );
				} else if ( isset ( $error_code ) && 'existing_user_email' == $error_code ) {
					$ninja_forms_processing->add_error( '_register_email', __( $register_error, 'ninja-forms' ), '_register_email' );
				}
			}else{
				$ninja_forms_processing->add_error( '_register_spam', $spam_error, '_register_spam' );
			}
		}
	}else if( $ninja_forms_processing->get_extra_value( '_ninja_forms_wp_register' ) AND is_user_logged_in() ){
		$ninja_forms_processing->set_action( 'save' );
	}
}

add_action( 'ninja_forms_before_pre_process', 'ninja_forms_register_user' );

function nf_sp_save_redirect() {
	global $ninja_forms_processing;
	$save_redirect = $ninja_forms_processing->get_form_setting( 'save_redirect' );

	if ( ! empty( $save_redirect ) ) {
		$current_url = $save_redirect;

        $multi_save = $ninja_forms_processing->get_form_setting( 'multi_save' );
        if ( 1 == $multi_save ) {
            //Query last submission and append save_id and action
            $args = array(
                'form_id'   => $ninja_forms_processing->get_form_ID(),
                'user_id'   => $ninja_forms_processing->get_user_ID(),
            );
            $subs = Ninja_Forms()->subs()->get( $args );

            if( is_array( $subs ) AND isset( $subs[0] ) ){
                $query_args = array(
                    'save_id' => $subs[0]->sub_id,
                    'nf_action'  => 'sp_edit_save'
                );
                $current_url = add_query_arg( $query_args, $current_url );
            }
        }

		wp_redirect( $current_url );
		exit();
	}
}

add_action( 'ninja_forms_save_progress', 'nf_sp_save_redirect', 99999 );