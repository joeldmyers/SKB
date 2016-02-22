<?php

function nf_sp_check_save( $form_id ){
	global $ninja_forms_loading, $ninja_forms_processing;

	if ( is_admin() )
		return false;

	if ( isset ( $ninja_forms_loading ) ) {
		$save_progress = $ninja_forms_loading->get_form_setting( 'save_progress' );
		$sub_id = $ninja_forms_loading->get_form_setting( 'sub_id' );
	} else if ( isset ( $ninja_forms_processing ) && $ninja_forms_processing->get_form_ID() != $form_id ) {
		$save_progress = $ninja_forms_processing->get_form_setting( 'save_progress' );
		$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
		if ( $ninja_forms_processing->get_action() != 'save' )
			return false;
	} else {
		return false;
	}

	if ( $save_progress != 1 )
		return false;

	if ( ! Ninja_Forms()->sub( $sub_id ) )
		return false;

	$sub_fields = Ninja_Forms()->sub( $sub_id )->get_all_fields();

	foreach ( $sub_fields as $field_id => $user_value ) {
		if ( isset ( $ninja_forms_loading ) ) {
			$ninja_forms_loading->update_field_value( $field_id, $user_value );
		} else {
			$ninja_forms_processing->update_field_value( $field_id, $user_value );
		}
	}
}

function nf_sp_save_check_version() {
	if ( nf_sp_pre_27() ) {
		add_action( 'ninja_forms_display_init', 'ninja_forms_save_progress_check_save', 11 );
	} else {
		add_action( 'ninja_forms_display_init', 'nf_sp_check_save', 11 );
	}	
}

add_action( 'init', 'nf_sp_save_check_version', 1 );

function ninja_forms_save_progress_clear_saved( $data, $field_id ) {
	global $ninja_forms_processing;

	if( is_object( $ninja_forms_processing ) AND $ninja_forms_processing->get_error( '_save_progress' ) ){
		$clear_saved = $ninja_forms_processing->get_form_setting( 'clear_saved' );
		if( $clear_saved == 1 ){
			$data['default_value'] = '';
		}
	}

	return $data;
}

add_filter( 'ninja_forms_field', 'ninja_forms_save_progress_clear_saved', 10, 2 );