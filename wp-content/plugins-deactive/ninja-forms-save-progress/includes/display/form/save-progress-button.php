<?php
/**
 * Outputs the HTML for the save button.
 *
**/

function nf_sp_display_save_button( $form_id ) {
	global $ninja_forms_processing;

    $plugin_settings = nf_sp_get_settings();

    if( isset( $plugin_settings['save_button'] ) && $plugin_settings['save_button'] ) {
        $save_button_label = __( $plugin_settings['save_button'], 'ninja-forms-sp' );
    } else {
        $save_button_label = __( 'Save Progress', 'ninja-forms-sp' );
    }

    if( isset( $plugin_settings['cancel_button_label'] ) && $plugin_settings['cancel_button_label'] ) {
        $cancel_button_label = __( $plugin_settings['cancel_button_label'], 'ninja-forms-sp' );
    } else {
        $cancel_button_label = __( 'Cancel', 'ninja-forms-sp' );
    }

	$save_progress = Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' );
	$multi_save = Ninja_Forms()->form( $form_id )->get_setting( 'multi_save' );

	if( isset( $_REQUEST['save_id'] ) ){
		$save_id = $_REQUEST['save_id'];
	}else if( is_object( $ninja_forms_processing ) ){
		$save_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
	}else{
		$save_id = '';
	}

	if(is_user_logged_in() AND $save_progress == 1 AND !is_admin() AND ( !isset( $_REQUEST['nf_action'] ) OR $_REQUEST['nf_action'] == 'sp_edit_save' OR $_REQUEST['nf_action'] == 'sp_delete_save' ) ){
	?>
	<div id="ninja_forms_form_<?php echo $form_id;?>_save_progress">
		<input type="submit" class="ninja-forms-save-progress" name="_save_progress" value="<?php echo $save_button_label; ?>">
		<?php
		if( $multi_save == 1 AND $save_id != '' ){
			$cancel_url = remove_query_arg( array( 'save_id', 'nf_action' ) );
			?>
			<a href="<?php echo $cancel_url;?>"><input type="button" name="_cancel_save_progress" value="<?php echo $cancel_button_label; ?>"></a>
			<?php
		}
		?>
	</div>
	<?php
	}
}

function nf_sp_save_button_version() {
	if ( nf_sp_pre_27() ) {
		add_action('ninja_forms_display_after_fields', 'ninja_forms_display_save_button');
	} else {
		add_action('ninja_forms_display_after_fields', 'nf_sp_display_save_button');
	}
}

add_action( 'init', 'nf_sp_save_button_version', 1 );