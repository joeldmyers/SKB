<?php
add_action( 'init', 'ninja_forms_register_login_settings_metabox' , 11 );

function ninja_forms_register_login_settings_metabox(){

	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'label_settings',
		'slug' => 'save_button_label',
		'title' => __('Save Progress Button Labels', 'ninja-forms-sp'),
		'settings' => array(
			array(
				'name' => 'save_button',
				'type' => 'text',
				'label' => __('Save Button Text', 'ninja-forms-sp'),
				'default_value' => __( 'Save Progress', 'ninja-forms-sp' ),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}	

	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'label_settings',
		'slug' => 'login_labels',
		'title' => __('Save Progress Login Labels', 'ninja-forms-sp'),
		'settings' => array(
			array(
				'name' => 'login_link',
				'type' => 'text',
				'label' => __('Login Link Text', 'ninja-forms-sp'),
			),
			array(
				'name' => 'username_label',
				'type' => 'text',
				'label' => __('Username Label', 'ninja-forms-sp'),
			),
			array(
				'name' => 'reset_password',
				'type' => 'text',
				'label' => __('Password Reset Link Text', 'ninja-forms-sp'),
			),
			array(
				'name' => 'password_label',
				'type' => 'text',
				'label' => __('Password Label', 'ninja-forms-sp'),
			),	
			array(
				'name' => 'repassword_label',
				'type' => 'text',
				'label' => __('Password Re-entry Label', 'ninja-forms-sp'),
			),
			array(
				'name' => 'password_mismatch',
				'type' => 'text',
				'label' => __('Password Mismatch Message', 'ninja-forms-sp'),
			),			
			array(
				'name' => 'login_button_label',
				'type' => 'text',
				'label' => __('Login Button Label', 'ninja-forms-sp'),
			),
			array(
				'name' => 'cancel_button_label',
				'type' => 'text',
				'label' => __('Cancel Button Label', 'ninja-forms-sp'),
			),
			array(
				'name' => 'login_error',
				'type' => 'text',
				'label' => __('Login Error Message', 'ninja-forms-sp'),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}
	
	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'label_settings',
		'slug' => 'register_labels',
		'title' => __('Save Progress Registration Labels', 'ninja-forms-sp'),
		'settings' => array(
			array(
				'name' => 'register_link',
				'type' => 'text',
				'label' => __('Register Link Text', 'ninja-forms-sp'),
			),
			array(
				'name' => 'email_label',
				'type' => 'text',
				'label' => __('Email Label', 'ninja-forms-sp'),
			),
			array(
				'name' => 'register_button_label',
				'type' => 'text',
				'label' => __('Register Button Label', 'ninja-forms-sp'),
			),
			array(
				'name' => 'register_error',
				'type' => 'text',
				'label' => __('Registration Error Message', 'ninja-forms-sp'),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}

	$args = array(
		'page' => 'ninja-forms-settings',
		'tab' => 'label_settings',
		'slug' => 'register_spam_labels',
		'title' => __('Save Progress Registration Spam Settings', 'ninja-forms-sp'),
		'settings' => array(
			array(
				'name' => 'register_spam_q',
				'type' => 'text',
				'label' => __('Register Spam Question', 'ninja-forms-sp'),
			),
			array(
				'name' => 'register_spam_a',
				'type' => 'text',
				'label' => __('Register Spam Answer', 'ninja-forms-sp'),
			),
			array(
				'name' => 'register_spam_error',
				'type' => 'text',
				'label' => __('Register Spam Error Message', 'ninja-forms-sp'),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}
	
}


/**
 * Add a filter to our nf_get_settings function to give the previous and next buttons a default value.
 *
 */

function nf_sp_labels_filter( $settings ) {
	$settings['save_button'] = isset ( $settings['save_button'] ) ? $settings['save_button'] : __( 'Save Progress', 'ninja-forms-sp');
	$settings['login_link'] = isset ( $settings['login_link'] ) ? $settings['login_link'] : __( 'Login', 'ninja-forms-sp');
	$settings['username_label'] = isset ( $settings['username_label'] ) ? $settings['username_label'] : __( 'Username', 'ninja-forms-sp');
	$settings['reset_password'] = isset ( $settings['reset_password'] ) ? $settings['reset_password'] : __( 'Reset Password', 'ninja-forms-sp');
	$settings['password_label'] = isset ( $settings['password_label'] ) ? $settings['password_label'] : __( 'Password', 'ninja-forms-sp');
	$settings['repassword_label'] = isset ( $settings['repassword_label'] ) ? $settings['repassword_label'] : __( 'Re-enter password', 'ninja-forms-sp');
	$settings['password_mismatch'] = isset ( $settings['password_mismatch'] ) ? $settings['password_mismatch'] : __( 'Passwords do not match', 'ninja-forms-sp');
	$settings['login_button_label'] = isset ( $settings['login_button_label'] ) ? $settings['login_button_label'] : __( 'Login', 'ninja-forms-sp');
	$settings['cancel_button_label'] = isset ( $settings['cancel_button_label'] ) ? $settings['cancel_button_label'] : __( 'Cancel', 'ninja-forms-sp');
	$settings['login_error'] = isset ( $settings['login_error'] ) ? $settings['login_error'] : __( 'Login Failed', 'ninja-forms-sp');
	$settings['register_link'] = isset ( $settings['register_link'] ) ? $settings['register_link'] : __( 'Register', 'ninja-forms-sp');
	$settings['email_label'] = isset ( $settings['email_label'] ) ? $settings['email_label'] : __( 'Email', 'ninja-forms-sp');
	$settings['register_button_label'] = isset ( $settings['register_button_label'] ) ? $settings['register_button_label'] : __( 'Register', 'ninja-forms-sp');
	$settings['register_error'] = isset ( $settings['register_error'] ) ? $settings['register_error'] : __( 'Registration Error', 'ninja-forms-sp');
	$settings['register_spam_q'] = isset ( $settings['register_spam_q'] ) ? $settings['register_spam_q'] : __( '4 + 4 = ', 'ninja-forms-sp');
	$settings['register_spam_a'] = isset ( $settings['register_spam_a'] ) ? $settings['register_spam_a'] : __( '8', 'ninja-forms-sp');
	$settings['register_spam_error'] = isset ( $settings['register_spam_error'] ) ? $settings['register_spam_error'] : __( 'Please answer the anti-spam question correctly.', 'ninja-forms-sp');
	return $settings;
}

add_filter( 'ninja_forms_settings', 'nf_sp_labels_filter' );