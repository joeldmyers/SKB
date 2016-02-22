<?php

function nf_sp_get_settings() {
	$settings = apply_filters( 'ninja_forms_settings', get_option( 'ninja_forms_settings' ) );

	$settings['login_link'] = isset ( $settings['login_link'] ) ? $settings['login_link'] : __( 'Login', 'ninja-forms-sp' );
	$settings['username_label'] = isset ( $settings['username_label'] ) ? $settings['username_label'] : __( 'Username', 'ninja-forms-sp' );
	$settings['reset_password'] = isset ( $settings['reset_password'] ) ? $settings['reset_password'] : __( 'Reset Password', 'ninja-forms-sp' );
	$settings['password_label'] = isset ( $settings['password_label'] ) ? $settings['password_label'] : __( 'Password', 'ninja-forms-sp' );
	$settings['repassword_label'] = isset ( $settings['repassword_label'] ) ? $settings['repassword_label'] : __( 'Re-enter Password', 'ninja-forms-sp' );
	$settings['password_mismatch'] = isset ( $settings['password_mismatch'] ) ? $settings['password_mismatch'] : __( 'Passwords do not match', 'ninja-forms-sp' );
	$settings['login_button_label'] = isset ( $settings['login_button_label'] ) ? $settings['login_button_label'] : __( 'Login', 'ninja-forms-sp' );
	$settings['cancel_button_label'] = isset ( $settings['cancel_button_label'] ) ? $settings['cancel_button_label'] : __( 'Cancel', 'ninja-forms-sp' );
	$settings['login_error'] = isset ( $settings['login_error'] ) ? $settings['login_error'] : __( 'Login Failed', 'ninja-forms-sp' );
	$settings['register_link'] = isset ( $settings['register_link'] ) ? $settings['register_link'] : __( 'Register', 'ninja-forms-sp' );
	$settings['email_label'] = isset ( $settings['email_label'] ) ? $settings['email_label'] : __( 'Email', 'ninja-forms-sp' );
	$settings['register_button_label'] = isset ( $settings['register_button_label'] ) ? $settings['register_button_label'] : __( 'Register', 'ninja-forms-sp' );
	$settings['register_error'] = isset ( $settings['register_error'] ) ? $settings['register_error'] : __( 'Registration Error', 'ninja-forms-sp' );
	$settings['register_spam_q'] = isset ( $settings['register_spam_q'] ) ? $settings['register_spam_q'] : '4 + 4 = ';
	$settings['register_spam_a'] = isset ( $settings['register_spam_a'] ) ? $settings['register_spam_a'] : '8';
	$settings['register_spam_error'] = isset ( $settings['register_spam_error'] ) ? $settings['register_spam_error'] : __( 'Please answer the anti-spam question correctly', 'ninja-forms-sp' );

	$settings['login_link']            = apply_filters( 'ninja_forms_labels/login_link'            , $settings['login_link'] );
	$settings['username_label']        = apply_filters( 'ninja_forms_labels/username_label'        , $settings['username_label'] );
	$settings['reset_password']        = apply_filters( 'ninja_forms_labels/reset_password'        , $settings['reset_password'] );
	$settings['password_label']        = apply_filters( 'ninja_forms_labels/password_label'        , $settings['password_label'] );
	$settings['repassword_label']      = apply_filters( 'ninja_forms_labels/repassword_label'      , $settings['repassword_label'] );
	$settings['password_mismatch']     = apply_filters( 'ninja_forms_labels/password_mismatch'     , $settings['password_mismatch'] );
	$settings['login_button_label']    = apply_filters( 'ninja_forms_labels/login_button_label'    , $settings['login_button_label'] );
	$settings['cancel_button_label']   = apply_filters( 'ninja_forms_labels/cancel_button_label'   , $settings['cancel_button_label'] );
	$settings['login_error']           = apply_filters( 'ninja_forms_labels/login_error'           , $settings['login_error'] );
	$settings['register_link']         = apply_filters( 'ninja_forms_labels/register_link'         , $settings['register_link'] );
	$settings['email_label']           = apply_filters( 'ninja_forms_labels/email_label'           , $settings['email_label'] );
	$settings['register_button_label'] = apply_filters( 'ninja_forms_labels/register_button_label' , $settings['register_button_label'] );
	$settings['register_error']        = apply_filters( 'ninja_forms_labels/register_error'        , $settings['register_error'] );
	$settings['register_spam_q']       = apply_filters( 'ninja_forms_labels/register_spam_q'       , $settings['register_spam_q'] );
	$settings['register_spam_a']       = apply_filters( 'ninja_forms_labels/register_spam_a'       , $settings['register_spam_a'] );
	$settings['register_spam_error']   = apply_filters( 'ninja_forms_labels/register_spam_error'   , $settings['register_spam_error'] );

	return $settings;

}