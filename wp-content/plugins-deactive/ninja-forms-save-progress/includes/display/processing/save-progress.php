<?php

function ninja_forms_before_save_progress(){
	global $ninja_forms_processing;
	
	if( $ninja_forms_processing->get_extra_value('_save_progress') ){
		$ninja_forms_processing->set_action( 'save' );
	}
}

add_action( 'ninja_forms_before_pre_process', 'ninja_forms_before_save_progress' );

function nf_sp_save(){
	global $ninja_forms_processing, $ninja_forms_fields;
	$save_msg = $ninja_forms_processing->get_form_setting( 'save_msg' );
	$save_msg = do_shortcode( $save_msg );
	$hide_complete = $ninja_forms_processing->get_form_setting( 'hide_saved' );
	$clear_complete = $ninja_forms_processing->get_form_setting( 'clear_saved' );
	if( $ninja_forms_processing->get_action() == 'save' ){
		if( $ninja_forms_processing->get_form_setting( 'sub_id' ) ){
			$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
		}else{
			$sub_id = '';
		}

		$action = 'save';
		$user_id = $ninja_forms_processing->get_user_ID();
		
		$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
		$form_id = $ninja_forms_processing->get_form_ID();

		$field_data = $ninja_forms_processing->get_all_fields();

		if ( $sub_id == '' ) {
			$sub_id = Ninja_Forms()->subs()->create( $form_id );
		}

		Ninja_Forms()->sub( $sub_id )->update_action( $action );
		Ninja_Forms()->sub( $sub_id )->update_user_id( $user_id );

		if( is_array( $field_data ) AND ! empty( $field_data ) ) {
			foreach( $field_data as $field_id => $user_value ) {
				$field_row = $ninja_forms_processing->get_field_settings( $field_id );
				$field_type = $field_row['type'];
				if ( isset ( $ninja_forms_fields[ $field_type ]['save_sub'] ) ) {
					$save_sub = $ninja_forms_fields[ $field_type ]['save_sub'];
					if( $save_sub ){
						$user_value = apply_filters('ninja_forms_save_sub', $user_value, $field_id);
						// Add our submitted field value.
						Ninja_Forms()->sub( $sub_id )->add_field( $field_id, $user_value );
					}
				}
			}
		}

		$ninja_forms_processing->update_form_setting( 'sub_id', $sub_id );
		
		$ninja_forms_processing->remove_all_errors();
		$ninja_forms_processing->add_error( '_save_progress', __( 'Saved', 'ninja-forms-sp'), 'save_progress' );
		$ninja_forms_processing->add_success_msg( '_save_progress', $save_msg );
		$ninja_forms_processing->update_form_setting( 'hide_complete', $hide_complete );
		$ninja_forms_processing->update_form_setting( 'clear_complete', $clear_complete );
		
		do_action( 'ninja_forms_save_progress', $sub_id );
	}
}

function nf_sp_update_submitted_date( $sub_id ) {
	global $ninja_forms_processing;
	if ( Ninja_Forms()->sub( $sub_id )->action == 'save' )
		Ninja_Forms()->sub( $sub_id )->update_date_submitted( current_time( 'mysql' ) );
}

function nf_sp_save_version() {
	if ( nf_sp_pre_27() ) {
		add_action( 'ninja_forms_pre_process', 'ninja_forms_save_progress', 1002 );
	} else {
		add_action( 'ninja_forms_pre_process', 'nf_sp_save', 1002 );
		add_action( 'nf_before_save_sub', 'nf_sp_update_submitted_date' );	
	}	
}

add_action( 'init', 'nf_sp_save_version', 1 );