<?php

/**
 * Filter the submitted date if the submission has been saved.
 * 
 * @since 1.0.7
 * @return string $date;
 */
function nf_sp_edit_sub_date_submitted( $date, $sub_id ) {
	if ( Ninja_Forms()->sub( $sub_id )->action == 'save' )
		$date = '';
	return $date;
}

add_filter( 'nf_edit_sub_date_submitted', 'nf_sp_edit_sub_date_submitted', 10, 2 );

/**
 * Filter the status on the subs table
 * 
 * @since 1.0.7
 * @return string $status
 */
function nf_sp_sub_table_status( $status, $sub_id ) {
	if ( Ninja_Forms()->sub( $sub_id )->action == 'save' )
		$status = __( 'Saved', 'ninja-forms-sp' );
	return $status;
}

add_filter( 'nf_sub_table_status', 'nf_sp_sub_table_status', 10, 2 );

/**
 * Add our sub status screen option
 * 
 * @since 1.0.7
 * @return void
 */
function nf_sp_sub_status_screen_option() {

	if ( nf_sp_pre_27() )
		return false;

	if ( ! $user = wp_get_current_user() )
		return false;

	if ( ! isset ( $_REQUEST['form_id'] ) || $_REQUEST['form_id'] == '' )
		return false;

	$form_id = $_REQUEST['form_id'];

	// Bail if we don't have save progress enabled for this form
	if ( Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) != 1 )
		return false;

	$sub_status = get_user_meta( $user->ID, 'nf_sub_status', true );
	$html = __( 'Status', 'ninja-forms-sp' ) . ': <select name="nf_sub_status">
		<option value="any" ' . selected( $sub_status, 'any', false ) . '>' . __( 'Any', 'ninja-forms-sp' ) . '</option>
		<option value="saved" ' . selected( $sub_status, 'saved', false ) . '>' . __( 'Saved', 'ninja-forms-sp' ) . '</option>
		<option value="submitted" ' . selected( $sub_status, 'submitted', false ) . '>' . __( 'Submitted', 'ninja-forms-sp' ) . '</option>
	</select> | ';
	Ninja_Forms()->subs_cpt->screen_options .= $html;
}

add_action( 'admin_init', 'nf_sp_sub_status_screen_option' );

/**
 * Save our sub status screen option
 * 
 * @since 1.0.7
 * @return $value
 */
function nf_sp_save_sub_status_screen_option() {
	global $pagenow, $typenow;

	if ( nf_sp_pre_27() )
		return false;

	if ( ! is_admin() )
		return false;

	if ( ! isset ( $_REQUEST['form_id'] ) || $_REQUEST['form_id'] == '' )
		return false;

	$form_id = $_REQUEST['form_id'];

	// Bail if we don't have save progress enabled for this form
	if ( Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) != 1 )
		return false;

	if ( ! isset ( $_REQUEST['post_type'] ) || $_REQUEST['post_type'] != 'nf_sub' )
		return false;

	if ( $pagenow != 'edit.php' )
		return false;

	if ( ! isset ( $_POST['nf_sub_status'] ) )
		return false;

	if ( ! $user = wp_get_current_user() )
		return false;

	update_user_meta( $user->ID, 'nf_sub_status', $_POST['nf_sub_status'] );
}

add_action( 'init', 'nf_sp_save_sub_status_screen_option' );

/**
 * Filter the table query based on the sub status that the user has selected.
 * 
 * @since 1.0.7
 * @return array $qv
 */
function nf_sp_filter_query( $qv, $form_id ) {
	// Bail if we don't have a form id
	if ( empty ( $form_id ) )
		return $qv;

	// Bail if we don't have save progress enabled for this form
	if ( Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) != 1 )
		return $qv;

	// Bail if our user isn't logged in.
	if ( ! $user = wp_get_current_user() )
		return false;

	// Get our sub status value
	$status = get_user_meta( $user->ID, 'nf_sub_status', true );

	if ( $status == 'submitted' ) {
		$qv['meta_query'][] = array(
			'key' 		=> '_action',
			'value' 	=> 'submit',
			'compare' 	=> '=',
		);
	} else if ( $status == 'saved' ) {
		$qv['meta_query'][] = array(
			'key' 		=> '_action',
			'value' 	=> 'save',
			'compare' 	=> '=',
		);
	}

	return $qv;
}

add_filter( 'nf_subs_table_qv', 'nf_sp_filter_query', 10, 2 );

/**
 * Filter the submission table post class so that we can add "saved" if the submission isn't completed
 * 
 * @since 1.0.7
 * @return string $classes
 */
function nf_sp_filter_tr( $classes, $class, $sub_id ) {
	global $pagenow, $typenow;
	if ( $pagenow == 'edit.php' && $typenow == 'nf_sub' ) {
		if ( Ninja_Forms()->sub( $sub_id )->action == 'save' ) {
			$classes[] = 'nf-sub-saved';
		}
	}
	return $classes;
}

add_filter( 'post_class', 'nf_sp_filter_tr', 10, 3 );

/**
 * Filter the submission status to show submitted/saved
 * 
 * @since 1.0.7
 * @return string $status
 */
function nf_sp_filter_status( $status, $sub_id ) {
	$form_id = Ninja_Forms()->sub( $sub_id )->form_id;
	if ( Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) != 1 )
		return $status;

	if ( Ninja_Forms()->sub( $sub_id )->action == 'save' )
		$status = __( 'Saved', 'ninja-forms-sp' );
	return $status;
}

add_filter( 'nf_sub_edit_status', 'nf_sp_filter_status', 10, 2 );

/**
 * Add an edit link and div for editing submission status
 * 
 * @since 1.0.7
 * @return void
 */
function nf_sp_output_edit_status( $sub ) {
	$form_id = Ninja_Forms()->sub( $sub->ID )->form_id;

	if ( Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) != 1 )
		return false;

	$action = Ninja_Forms()->sub( $sub->ID )->action;
	?>
	<a href="#" class="edit-sub-status hide-if-no-js" style="display: inline;">
		<span aria-hidden="true"><?php _e( 'Edit', 'ninja-forms-sp' ); ?></span> 
		<span class="screen-reader-text"><?php _e( 'Edit status', 'ninja-forms-sp' ); ?></span>
	</a>
	<div id="sub-status-select" class="hide-if-js" style="display: none;">
		<select name="_action" id="">
			<option value="save" <?php selected( $action, 'save' );?>><?php _e( 'Saved', 'ninja-forms' );?></option>
			<option value="submit" <?php selected( $action, 'submit' );?>><?php _e( 'Submitted', 'ninja-forms' );?></option>
		</select>
		<a href="#" class="save-sub-status hide-if-no-js button"><?php _e( 'OK', 'ninja-forms-sp' ); ?></a>
		<a href="#" class="cancel-sub-status hide-if-no-js button-cancel"><?php _e( 'Cancel', 'ninja-forms-sp' ); ?></a>
	</div>
	<?php
}

add_action( 'nf_sub_edit_after_status', 'nf_sp_output_edit_status' );

function nf_sp_edit_sub(){
	// Save our metabox values
	add_action( 'save_post', 'nf_sp_save_info', 10, 2 );
}

add_action( 'admin_init', 'nf_sp_edit_sub' );

/**
 * Save our submission user values
 * 
 * @since 1.0.7
 * @return void
 */
function nf_sp_save_info( $sub_id, $post ) {
	global $pagenow;

	if ( ! isset ( $_POST['nf_edit_sub'] ) || $_POST['nf_edit_sub'] != 1 )
		return $sub_id;

	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return $sub_id;

	if ( $pagenow != 'post.php' )
		return $sub_id;

	if ( $post->post_type != 'nf_sub' )
		return $sub_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $sub_id ) )
    	return $sub_id;

    // Bail if the form doesn't have save progress enabled
    $form_id = Ninja_Forms()->sub( $sub_id )->form_id;
    if ( Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) != 1 )
    	return false;

    Ninja_Forms()->sub( $sub_id )->update_action( $_POST['_action'] );

} // function nf_sp_save_info

/**
 * Add a column to the CSV output that stats what this is.
 *
 * @since 1.1.6
 */
function nf_sp_csv_filter( $label_array, $sub_ids ) {
	// Add our sequential number.
	$label_array[0]['_action'] = __( 'Status', 'ninja-forms' );
	return $label_array;
}

add_filter( 'nf_subs_csv_label_array_before_fields', 'nf_sp_csv_filter', 10, 2 );