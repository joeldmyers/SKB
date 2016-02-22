<?php

add_action( 'init', 'ninja_forms_register_save_progress_edit_sub' );
function ninja_forms_register_save_progress_edit_sub(){
	if( is_admin() ){
		add_action( 'ninja_forms_display_after_open_form_tag', 'ninja_forms_save_progress_edit_sub' );
		add_filter( 'ninja_forms_edit_sub_args', 'ninja_forms_save_progress_edit_sub_args' );		
	}
}

function ninja_forms_save_progress_edit_sub( $form_id ){
	global $ninja_forms_processing;

	if( isset( $_REQUEST['sub_id'] ) ){
		$sub_id = $_REQUEST['sub_id'];
	}else{
		$sub_id = '';
	}
	if( $sub_id != '' ){
		$sub_row = ninja_forms_get_sub_by_id( $sub_id );
		$status = $sub_row['status'];
	
	_e( 'Submission Status', 'ninja-forms-sp' );
	?>	
	<select name="_status" id="">
		<option value="0" <?php selected( $status, 0 );?>><?php _e( 'Incomplete', 'ninja-forms-sp' );?></option>
		<option value="1" <?php selected( $status, 1 );?>><?php _e( 'Complete', 'ninja-forms-sp' );?></option>
	</select>
	<?php
	}
}

function ninja_forms_save_progress_edit_sub_args( $args ){
	global $ninja_forms_processing;

	if( $ninja_forms_processing->get_extra_value( '_status' ) !== false ){
		
		$args['status'] = $ninja_forms_processing->get_extra_value( '_status' );
	}

	return $args;
}

function ninja_forms_get_saved_form( $user_id, $form_id, $multi = false ){
	global $wpdb;

	if( $multi ){
		$sub_results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".NINJA_FORMS_SUBS_TABLE_NAME." WHERE `user_id` = %d AND `form_id` = %d AND `status` = 0 AND `saved` = 1", $user_id, $form_id ), ARRAY_A );
		if( is_array( $sub_results ) AND !empty( $sub_results ) ){
			for ($x=0; $x < count( $sub_results ); $x++ ) { 
				$sub_results[$x]['data'] = unserialize( $sub_results[$x]['data'] );
			}
		}
		return $sub_results;
	}else{
		$sub_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".NINJA_FORMS_SUBS_TABLE_NAME." WHERE `user_id` = %d AND `form_id` = %d AND `status` = 0 AND `saved` = 1 LIMIT 1", $user_id, $form_id ), ARRAY_A );
		if( is_array( $sub_row ) AND !empty( $sub_row ) ){
			$sub_row['data'] = unserialize( $sub_row['data'] );
		}		
		return $sub_row;
	}	
}

/*
 *
 * Function used to delete saved submissions if the user selects "Delete"
 * 
 * @since 1.1
 * @returns void
 */

function ninja_forms_save_progress_delete_save(){
	$sub_id = $_REQUEST['save_id'];
	$form_row = ninja_forms_get_form_by_sub_id( $sub_id );
	$form_data = $form_row['data'];
	if( isset( $form_data['save_delete'] ) AND $form_data['save_delete'] == 1 ){
		ninja_forms_delete_sub( $sub_id );
	}
	$redirect = remove_query_arg( array( 'ninja_forms_action', 'save_id' ) );
	wp_redirect( $redirect );
	die();
}

if( isset( $_REQUEST['ninja_forms_action'] ) AND $_REQUEST['ninja_forms_action'] == 'delete_save' ){
	add_action( 'init', 'ninja_forms_save_progress_delete_save' );	
}

function ninja_forms_save_progress_activation(){
	// Deprecated activation hook.
	if ( nf_sp_pre_27() ) {
		global $wpdb;
		
		if($wpdb->get_var("SHOW COLUMNS FROM ".NINJA_FORMS_SUBS_TABLE_NAME." LIKE 'saved'") != 'saved') {
			$sql = "ALTER TABLE ".NINJA_FORMS_SUBS_TABLE_NAME." ADD `saved` INT(11) NOT NULL DEFAULT  '0'";
			$wpdb->query($sql);
			$all_subs = ninja_forms_get_all_subs();
			if( is_array( $all_subs ) AND !empty( $all_subs ) ){
				foreach( $all_subs as $sub ){
					if( $sub['action'] == 'save' ){
						$sub_id = $sub['id'];
						$update_array = array(
							'saved' => 1,
						);
						$wpdb->update( NINJA_FORMS_SUBS_TABLE_NAME, $update_array, array( 'id' => $sub_id ) );
					}
				}
			}
		}
	}
}

add_action( 'init', 'ninja_forms_save_progress_register_select_sub_option', 20 );
function ninja_forms_save_progress_register_select_sub_option(){
	$args = array(
		'page' => 'ninja-forms-subs',
		'tab' => 'view_subs',
		'sidebar' => 'select_subs',
		'type' => '',
		'name' => 'add_incomplete',
		'display_function' => 'ninja_forms_save_progress_select_sub_option',
		'label' => __( 'Include Incomplete Submissions?', 'ninja-forms-sp' ),
	);
	if( function_exists( 'ninja_forms_register_sidebar_option' ) ){
		ninja_forms_register_sidebar_option( 'add_incomplete', $args );
	}

	remove_filter( 'ninja_forms_view_subs_results', 'ninja_forms_view_subs_default_filter' );
	remove_filter( 'ninja_forms_download_all_subs_results', 'ninja_forms_view_subs_default_filter' );
	
	add_filter( 'ninja_forms_view_subs_args', 'ninja_forms_sp_filter_view_subs_args' );
	add_filter( 'ninja_forms_view_subs_results', 'ninja_forms_save_progress_filter_subs_results' );
	add_filter( 'ninja_forms_download_all_subs_results', 'ninja_forms_save_progress_filter_subs_results' );
	if ( nf_sp_pre_27() ) {
		add_filter( 'ninja_forms_export_subs_label_array', 'ninja_forms_save_progress_filter_export_subs_label' );
		add_filter( 'ninja_forms_export_subs_value_array', 'ninja_forms_save_progress_filter_export_subs_value', 10, 2 );		
	}

}

function ninja_forms_save_progress_select_sub_option( $slug, $data ){
	if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] == '' ){
		unset( $_SESSION['ninja_forms_add_incomplete'] );
		$add_incomplete = '';
	}else if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] != '' ){
		$_SESSION['ninja_forms_add_incomplete'] = $_REQUEST['add_incomplete'];
		$add_incomplete = $_REQUEST['add_incomplete'];
	}else if( isset( $_SESSION['ninja_forms_add_incomplete']) AND $_SESSION['ninja_forms_add_incomplete'] != '' ){
		$add_incomplete = $_SESSION['ninja_forms_add_incomplete'];
	}else{
		$add_incomplete = '';
	}
	?>
	<input type="hidden" name="add_incomplete" value="0">
	<label>
		<input type="checkbox" name="add_incomplete" value="1" <?php checked( $add_incomplete, 1 );?>>
		<?php _e( 'Include incomplete submissions?', 'ninja-forms-sp' );?>
	</label>
	<br />
	<?php
}

function ninja_forms_save_progress_filter_subs_results( $sub_results ){
	if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] == '' ){
		unset( $_SESSION['ninja_forms_add_incomplete'] );
		$add_incomplete = '';
	}else if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] != '' ){
		$_SESSION['ninja_forms_add_incomplete'] = $_REQUEST['add_incomplete'];
		$add_incomplete = $_REQUEST['add_incomplete'];
	}else if( isset( $_SESSION['ninja_forms_add_incomplete']) AND $_SESSION['ninja_forms_add_incomplete'] != '' ){
		$add_incomplete = $_SESSION['ninja_forms_add_incomplete'];
	}else{
		$add_incomplete = '';
	}
	if( is_array( $sub_results ) AND !empty( $sub_results ) ){
		$tmp_array = array();
		for ($i=0; $i < count( $sub_results ); $i++) { 
			if( $sub_results[$i]['status'] == 1 ){
				$tmp_array[] = $sub_results[$i];
			}
			if( $add_incomplete == 1 ){
				if( $sub_results[$i]['status'] == 0 && $sub_results[$i]['saved'] == 1 ){
					$tmp_array[] = $sub_results[$i];
				}
			}
		}
		$sub_results = $tmp_array;
	}

	return $sub_results;
}

function ninja_forms_sp_filter_view_subs_args( $args ) {
	if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] == '' ){
		unset( $_SESSION['ninja_forms_add_incomplete'] );
		$add_incomplete = '';
	}else if( isset( $_REQUEST['add_incomplete'] ) AND $_REQUEST['add_incomplete'] != '' ){
		$_SESSION['ninja_forms_add_incomplete'] = $_REQUEST['add_incomplete'];
		$add_incomplete = $_REQUEST['add_incomplete'];
	}else if( isset( $_SESSION['ninja_forms_add_incomplete']) AND $_SESSION['ninja_forms_add_incomplete'] != '' ){
		$add_incomplete = $_SESSION['ninja_forms_add_incomplete'];
	}else{
		$add_incomplete = '';
	}
	if ( $add_incomplete == 1 ) {
		unset( $args['status'] );
	}
	return $args;
}

function ninja_forms_save_progress_filter_export_subs_label( $label_array ){
	array_splice($label_array[0], 1, 0, __( 'Status', 'ninja-forms-sp' ) );
	return $label_array;
}

function ninja_forms_save_progress_filter_export_subs_value( $value_array, $sub_id_array ){
	if( is_array( $value_array ) AND !empty( $value_array ) ){
		for ($i=0; $i < count( $value_array ); $i++) {
			if( isset( $sub_id_array[$i] ) ){
				$sub_row = ninja_forms_get_sub_by_id( $sub_id_array[$i] );
				$status = $sub_row['status'];
				if( $status == 1 ){
					$status = __( 'Complete', 'ninja-forms-sp' );
				}else{
					$status = __( 'Incomplete', 'ninja-forms-sp' );
				}
			}
			array_splice($value_array[$i], 1, 0, $status );
		}
	}
	
	return $value_array;
}

function ninja_forms_save_progress_check_save( $form_id ){
	global $ninja_forms_loading, $ninja_forms_processing;

	if ( is_admin() )
		return false;

	if ( isset ( $ninja_forms_loading ) ) {
		$save_progress = $ninja_forms_loading->get_form_setting( 'save_progress' );
		$sub_id = $ninja_forms_loading->get_form_setting( 'sub_id' );
	} else {
		$save_progress = $ninja_forms_processing->get_form_setting( 'save_progress' );
		$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
		if ( $ninja_forms_processing->get_action() != 'save' )
			return false;
	}

	if ( $save_progress != 1 )
		return false;

	if( $sub_id != '' ){
		$sub_row = ninja_forms_get_sub_by_id( $sub_id );
	}else{
		$sub_row = array();
	}

	if ( isset ( $sub_row['data'] ) ) {
		$sub_data = $sub_row['data'];
		if( is_array( $sub_data ) AND !empty( $sub_data ) ){
			foreach( $sub_data as $row ){
				if ( isset ( $ninja_forms_loading ) ) {
					$ninja_forms_loading->update_field_value( $row['field_id'], $row['user_value'] );
				} else {
					$ninja_forms_processing->update_field_value( $row['field_id'], $row['user_value'] );
				}
			}
		}			
	} 
}

/**
 * Adds the sub_id to the form if a sub_id is set.
 *
**/

function nf_set_sub_id( $form_id ) {
	global $ninja_forms_processing, $ninja_forms_loading;

	// Bail if we aren't on initial load
	if ( isset ( $ninja_forms_processing ) )
		return false;

	$multi_save = $ninja_forms_loading->get_form_setting( 'multi_save' );

	if( isset( $_REQUEST['save_id'] ) ){
		$save_id = $_REQUEST['save_id'];
	}else{
		$save_id = '';
	}

	$user_id = get_current_user_id();

	if( ! empty( $user_id ) ){
		$sub_id = '';

		if( !is_admin() ){
			if( $multi_save == 1 ){
				if( $save_id != '' ){
					$sub_row = ninja_forms_get_sub_by_id( $save_id );
					if( $sub_row['user_id'] == $user_id AND isset( $sub_row['saved'] ) AND $sub_row['saved'] == 1 ){
						$sub_id = $save_id;
					}else{
						$sub_id = '';
					}				
				}
			}else{
				$sub_row = ninja_forms_get_saved_form( $user_id, $form_id );
				if(is_array($sub_row) AND !empty($sub_row)){
					$sub_id = $sub_row['id'];
				}else{
					$sub_id = '';
				}
			}

			if ( isset ( $ninja_forms_loading ) ) {
				$ninja_forms_loading->update_form_setting( 'sub_id', $sub_id );
			}
		}
	}
}

function ninja_forms_save_progress(){
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

		$sub_data = array();

		if(is_array($field_data) AND !empty($field_data)){
			foreach($field_data as $field_id => $user_value){
				$field_row = ninja_forms_get_field_by_id($field_id);
				$field_type = $field_row['type'];
				if ( isset ( $ninja_forms_fields[$field_type]['save_sub'] ) ) {
					$save_sub = $ninja_forms_fields[$field_type]['save_sub'];
					if($save_sub){
						ninja_forms_remove_from_array($sub_data, "field_id", $field_id, TRUE);
						$user_value = apply_filters('ninja_forms_save_sub', $user_value, $field_id);
						array_push( $sub_data, array( 'field_id' => $field_id, 'user_value' => $user_value ) );
					}
				}
			}
		}

		$args = array(
			'form_id' => $form_id,
			'user_id' => $user_id,
			'action' => $action,
			'status' => 0,
			'saved' => 1,
			'data' => serialize( $sub_data ),
		);

		if($sub_id != ''){
			$args['sub_id'] = $sub_id;
			ninja_forms_update_sub($args);
			$ninja_forms_processing->update_form_setting( 'sub_id', $sub_id );
		}else{
			$sub_id = ninja_forms_insert_sub($args);
			$ninja_forms_processing->update_form_setting( 'sub_id', $sub_id );
		}
		
		$ninja_forms_processing->remove_all_errors();
		$ninja_forms_processing->add_error( '_save_progress', __( 'Saved', 'ninja-forms-sp'), 'save_progress' );
		$ninja_forms_processing->add_success_msg( '_save_progress', $save_msg );
		$ninja_forms_processing->update_form_setting( 'hide_complete', $hide_complete );
		$ninja_forms_processing->update_form_setting( 'clear_complete', $clear_complete );
		
		do_action( 'ninja_forms_save_progress', $sub_id );
	}
}

function ninja_forms_save_progress_output_table( $user_id, $form_id, $cols = array(), $url = '' ){
	global $ninja_forms_processing, $wp;
	$sub_results = ninja_forms_get_saved_form( $user_id, $form_id, true );
	$form_row = ninja_forms_get_form_by_id( $form_id );
	$form_data = $form_row['data'];
	if( isset( $form_data['save_delete'] ) ){
		$delete = $form_data['save_delete'];
	}else{
		$delete = 0;
	}

	$plugin_settings = nf_get_settings();
	$date_format = $plugin_settings['date_format'];

	$cols_array = array();

	if( isset( $_REQUEST['save_id'] ) ){
		$save_id = $_REQUEST['save_id'];
	}else if( is_object( $ninja_forms_processing ) ){
		$save_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
	}else{
		$save_id = '';
	}

	if( is_array( $sub_results ) AND !empty( $sub_results ) ){

		if( is_array( $cols ) AND !empty( $cols ) ){
			foreach( $cols as $field_id ){
				$field_row = ninja_forms_get_field_by_id( $field_id );
				$field_data = $field_row['data'];
				if( isset( $field_data['label'] ) ){
					$cols_array[] = $field_data['label'];
				}
			}
		}

		if( $url == '' ){
			?>
			<h4><?php _e( 'Continue a saved form', 'ninja-forms-sp' );?></h4>
			<?php
		}
		?>
		
		<table>
			<thead>
				<tr>
					<?php
					if( $delete == 1 ){
						?>
						<th></th>
						<?php
					}
					?>
					<th><?php _e( 'Date Updated', 'ninja-forms-sp' );?></th>
					<?php
					if( is_array( $cols_array ) AND !empty( $cols_array ) ){
						foreach( $cols_array as $label ){
							?>
							<th><?php echo $label;?></th>
							<?php
						}
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				if( is_array( $sub_results ) AND !empty( $sub_results ) ){
					foreach( $sub_results as $sub ){
						if( $save_id == $sub['id'] ){
							$tr_class = 'ninja-forms-save-active';
							$active = true;
						}else{
							$tr_class = 'ninja-forms-save-inactive';
							$active = false;
						}
						if( $url == '' ){
							$edit_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'edit_save' ) );
							$delete_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'delete_save' ) );
						}else{
							$edit_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'edit_save' ), $url );
							$delete_url = add_query_arg( array( 'save_id' => $sub['id'], 'ninja_forms_action' => 'delete_save' ), $url );
						}
						?>
						<tr class="<?php echo $tr_class;?>">
							<?php
							if( $delete == 1 ){
							?>
							<td>
								<a href="<?php echo $delete_url;?>" class="ninja-forms-save-progress-delete-sub"><?php _e( 'Delete', 'ninja-forms-sp' );?></a>
							</td>			
							<?php
							}
							?>				
							<td>
								<?php
								if( !$active ){ 
									/* <a href="<?php echo $edit_url;?>#ninja_forms_form_<?php echo $form_id;?>"> */
									?>
									<a href="<?php echo $edit_url;?>">
									<?php 
								}
								$date_updated = $sub['date_updated'];
								$date_updated = strtotime( $date_updated );
								$date_updated = date( $date_format, $date_updated );
								echo $date_updated;
								if( !$active ){ ?>
									</a>
								<?php
								} 
								?>
							</td>

							<?php
							if( is_array( $cols ) AND !empty( $cols ) ){
								foreach( $cols as $field_id ){
									foreach( $sub['data'] as $data ){
										if( $data['field_id'] == $field_id ){
											$user_value = $data['user_value'];
											$field_row = ninja_forms_get_field_by_id( $field_id );
											if ( isset ( $data['user_value'] ) ) {
												if ( $field_row['type'] == '_list' ) {
													foreach ( $field_row['data']['list']['options'] as $option ) {
														if ( isset ( $option['value'] ) and $option['value'] == $data['user_value'] ) {
															$user_value = $option['label'];
															break;
														}
													}
												}
											}
											?>
											<td>
												<?php
												if( !$active ){ 
													?>
													<a href="<?php echo $edit_url;?>">
													<?php 
												} 
												echo $user_value;
													if( !$active ){ ?>
														</a>
													<?php
													} 
												?>
											</td>
											<?php									
										}
									}
								}
							}
							?>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
		<?php
	}
}

function ninja_forms_display_save_button($form_id){
	global $ninja_forms_processing;

	$form_row = ninja_forms_get_form_by_id($form_id);
	$form_data = $form_row['data'];

	if( isset( $form_data['save_progress'] ) ){
		$save_progress = $form_data['save_progress'];
	}else{
		$save_progress = 0;
	}

	if( isset( $form_data['multi_save'] ) ){
		$multi_save = $form_data['multi_save'];
	}else{
		$multi_save = 0;
	}

	if( isset( $_REQUEST['save_id'] ) ){
		$save_id = $_REQUEST['save_id'];
	}else if( is_object( $ninja_forms_processing ) ){
		$save_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
	}else{
		$save_id = '';
	}

	if(is_user_logged_in() AND $save_progress == 1 AND !is_admin() AND ( !isset( $_REQUEST['ninja_forms_action'] ) OR $_REQUEST['ninja_forms_action'] == 'edit_save' OR $_REQUEST['ninja_forms_action'] == 'delete_save' ) ){
	?>
	<div id="ninja_forms_form_<?php echo $form_id;?>_save_progress">
		<input type="submit" class="ninja-forms-save-progress" name="_save_progress" value="<?php _e( 'Save Progress', 'ninja-forms-sp' );?>">
		<?php
		if( $multi_save == 1 AND $save_id != '' ){
			$cancel_url = remove_query_arg( array( 'save_id', 'ninja_forms_action' ) );
			?>
			<a href="<?php echo $cancel_url;?>"><input type="button" name="_cancel_save_progress" value="<?php _e( 'Cancel', 'ninja-forms-sp' );?>"></a>
			<?php
		}
		?>
	</div>
	<?php
	}
}