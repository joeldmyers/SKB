<?php

function ninja_forms_init_user_login(){
	global $current_user, $user_ID, $ninja_forms_processing;
	if(isset($_POST['_ninja_forms_wp_login'])){
		$form_id = $_POST['_form_id'];	
		$creds = array();
		$creds['user_login'] = $_POST['_ninja_forms_login_log'];
		$creds['user_password'] = $_POST['_ninja_forms_login_password'];
		$creds['remember'] = false;
		$user = wp_signon( $creds, false );
		if(!is_wp_error($user)){
			wp_set_current_user($user->ID);
		}
	}
}

add_action( 'init', 'ninja_forms_init_user_login', 1 );


function ninja_forms_register_user_login(){
	add_action('ninja_forms_before_pre_process', 'ninja_forms_user_login');
}

add_action( 'init', 'ninja_forms_register_user_login', 5 );

function ninja_forms_user_login(){
	global $ninja_forms_processing, $current_user, $post;

	$plugin_settings = nf_sp_get_settings();
	$login_error = $plugin_settings['login_error'];

	if( $ninja_forms_processing->get_extra_value( '_ninja_forms_wp_login' ) ){
		if(is_user_logged_in()){


            $args = array(
                'form_id'   => $ninja_forms_processing->get_form_ID(),
                'user_id'   => $ninja_forms_processing->get_user_ID(),
            );
            $subs = Ninja_Forms()->subs()->get( $args );

            if ( empty( $subs ) ){
                $ninja_forms_processing->set_action( 'save' );
            } else {
                $ninja_forms_processing->set_action( 'login' );
                $ninja_forms_processing->add_error('_login_success', '', '_login_success' );
            }

			$current_url = add_query_arg( array('ninja-forms-login' => 1 ) );
			$ninja_forms_processing->update_form_setting( 'save_redirect', $current_url );
			// Reset our default values if they are based upon user info
			$all_fields = $ninja_forms_processing->get_all_fields();
			foreach ( $all_fields as $field_id => $user_value ) {
				$default_value = $ninja_forms_processing->get_field_setting( $field_id, 'default_value' );
				$default_value_type = $ninja_forms_processing->get_field_setting( $field_id, 'default_value_type' );
				// Check to see if our default value is one of our preset values:
				get_currentuserinfo();

				$user_ID 			= $current_user->ID;
				if ( $user_ID and !empty( $user_ID ) ) {
					$user_firstname 	= $current_user->user_firstname;
				    $user_lastname 		= $current_user->user_lastname;
				    $user_display_name 	= $current_user->display_name;
				    $user_email 		= $current_user->user_email;
				} else {
					$user_ID 			= '';
					$user_firstname 	= '';
				    $user_lastname 		= '';
				    $user_display_name 	= '';
				    $user_email 		= '';
				}


			    if ( is_object ( $post ) ) {
				    $post_ID 			= $post->ID;
				    $post_title 		= $post->post_title;
				    $post_url			= get_permalink( $post_ID );
			    } else {
			    	$post_ID      		= '';
			    	$post_title 		= '';
			    	$post_url 			= '';
			    }

			    if ( empty ( $user_value ) && ! empty( $default_value ) ) {
				    switch( $default_value ){
						case '_user_id':
							$default_value = $user_ID;
							break;
						case '_user_firstname':
							$default_value = $user_firstname;
							break;
						case '_user_lastname':
							$default_value = $user_lastname;
							break;
						case '_user_display_name':
							$default_value = $user_display_name;
							break;
						case '_user_email':
							$default_value = $user_email;
							break;
						case 'post_id':
							$default_value = $post_ID;
							break;
						case 'post_title':
							$default_value = $post_title;
							break;
						case 'post_url':
							$default_value = $post_url;
							break;
						case 'today':
							$plugin_settings = nf_get_settings();
							if ( isset ( $plugin_settings['date_format'] ) ) {
								$date_format = $plugin_settings['date_format'];
							} else {
								$date_format = 'm/d/Y';
							}
							$default_value = date( $date_format, strtotime( 'now' ) );
							break;
						default:
							if ( 'querystring' == $default_value_type ) {
								$default_value = isset ( $_GET[ $default_value ] ) ? $_GET[ $default_value ] : '';
							} else {
								$default_value = '';
							}
							break;
					}			    	
					$ninja_forms_processing->update_field_value( $field_id, $default_value );
			    }


			}

            wp_redirect( $current_url );
            exit();

		}else{
			$ninja_forms_processing->add_error('_login_password', $login_error, '_login_password');
		}
	}
}