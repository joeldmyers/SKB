<?php

/**
 * Add our metaboxes to the form settings tab
 * 
 * @since 1.0
 * @return void
 */

function nf_register_sp_metabox(){

	$save_table_cols = array();
	if( isset( $_REQUEST['form_id'] ) ){
		$form_id = $_REQUEST['form_id'];
		$fields = ninja_forms_get_fields_by_form_id( $form_id );
		
		foreach( $fields as $field ){
			if( isset( $field['data']['label'] ) ){
				$save_table_cols[] = array( 'name' => $field['data']['label'], 'value' => $field['id'] );
			}else{
				$save_table_cols[] = array( 'name' => 'Field ID: '.$field['id'], 'value' => $field['id'] );
			}
		}
	}else{

	}

	$args = array(
		'page' => 'ninja-forms',
		'tab' => 'form_settings',
		'slug' => 'save_progress',
		'title' => __('Save Progress Settings', 'ninja-forms'),
		'display_function' => '',
		'state' => 'closed',
		'settings' => array(
			array(
				'name' => 'save_progress',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Allow users to save progress?', 'ninja-forms-sp'),
				'display_function' => '',
			),
			array(
				'name' => 'clear_saved',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Clear Saved Form?', 'ninja-forms-sp'),
				'display_function' => '',
			),
			array(
				'name' => 'hide_saved',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Hide Saved Form?', 'ninja-forms-sp'),
				'display_function' => '',
			),
			array(
				'name' => 'clear_incomplete_saves',
				'type' => 'text',
				'label' => __('Number of days to keep incomplete form entries', 'ninja-forms-sp'),
			),
			array(
				'name' => 'save_msg',
				'type' => 'rte',
				'label' => __('Saved Form Message', 'ninja-forms-sp'),
				'desc' => __('If you want to include field data entered by the user, for instance a name, you can use the following shortcode: [ninja_forms_field id=23] where 23 is the ID of the field you want to insert. This will tell Ninja Forms to replace the bracketed text with whatever input the user placed in that field. You can find the field ID when you expand the field for editing.', 'ninja-forms-sp'),
			),
			array(
				'name' => 'email_saved',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __('Email user when they save a form?', 'ninja-forms-sp'),
				'display_function' => '',
			),
			array(
				'name' => 'saved_format',
				'type' => 'select',
				'desc' => '',
				'label' => __('Saved Form Email Format', 'ninja-forms-sp'),
				'display_function' => '',
				'options' => array(
					array( 'name' => __( 'HTML', 'ninja-forms-sp' ), 'value' => 'html' ),
					array( 'name' => __( 'Plain Text', 'ninja-forms-sp' ), 'value' => 'plain' )
				),
			),
			array(
				'name' => 'saved_from_name',
				'type' => 'text',
				'label' => __('Saved Form Email From Name', 'ninja-forms-sp'),
			),
			array(
				'name' => 'saved_from_address',
				'type' => 'text',
				'label' => __('Saved Form Email From Address', 'ninja-forms-sp'),
			),
			array(
				'name' => 'saved_subject',
				'type' => 'text',
				'label' => __('Saved Form Email Subject', 'ninja-forms-sp'),
			),
			array(
				'name' => 'save_email_msg',
				'type' => 'rte',
				'label' => __('Saved Form Email Message', 'ninja-forms-sp'),
				'desc' => __('If you want to include field data entered by the user, for instance a name, you can use the following shortcode: [ninja_forms_field id=23] where 23 is the ID of the field you want to insert. This will tell Ninja Forms to replace the bracketed text with whatever input the user placed in that field. You can find the field ID when you expand the field for editing.', 'ninja-forms-sp'),
			),
			array(
				'name' => 'multi_save',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __( 'Allow multiple saved forms?', 'ninja-forms-sp' ),
				'display_function' => '',
			),
			array(
				'name' => 'save_table',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __( 'Display saved submission table above form?', 'ninja-forms-sp' ),
			),			
			array(
				'name' => 'save_table_cols',
				'type' => 'multi_select',
				'desc' => __( 'Use CTRL + click to select multiple fields (COMMAND + click for Mac users). The number of field columns you want will depend upon the size of your field labels and values. Three is a good, standard value.' , 'ninja-forms-sp' ),
				'options' => $save_table_cols,
				'label' => __( 'Use these fields as table columns', 'ninja-forms-sp' ),
				'size' => 5,
			),
			array(
				'name' => 'save_delete',
				'type' => 'checkbox',
				'desc' => '',
				'label' => __( 'Allow users to delete their saves?', 'ninja-forms-sp' ),
			),
		),
	);
	if( function_exists( 'ninja_forms_register_tab_metabox' ) ){
		ninja_forms_register_tab_metabox($args);
	}
}

add_action( 'admin_init', 'nf_register_sp_metabox', 11 );