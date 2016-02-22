<?php
/**
 * Adds the sub_id to the form if a sub_id is set.
 *
**/

function nf_sp_set_sub_id( $form_id ) {
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
					if ( Ninja_Forms()->sub( $save_id )->user_id == $user_id && Ninja_Forms()->sub( $save_id )->action == 'save' ) {
						$sub_id = $save_id;
					} else {
						$sub_id = '';
					}
				}
			}else{
				$sub = nf_sp_get_saved_form( $user_id, $form_id );
				if ( $sub ) {
					$sub_id = $sub->sub_id;
				} else {
					$sub_id = '';
				}
			}

			if ( isset ( $ninja_forms_loading ) ) {
				$ninja_forms_loading->update_form_setting( 'sub_id', $sub_id );
			}
		}
	}
}

function nf_sp_set_sub_id_version() {
	if ( nf_sp_pre_27() ) {
		add_action( 'ninja_forms_display_pre_init', 'nf_set_sub_id' );
	} else {
		add_action( 'ninja_forms_display_pre_init', 'nf_sp_set_sub_id' );
	}	
}

add_action( 'init', 'nf_sp_set_sub_id_version', 1 );

function ninja_forms_display_sub_id( $form_id ){
	global $ninja_forms_loading, $ninja_forms_processing;

	// Bail if we've just submitted the form
	if ( isset ( $ninja_forms_processing ) && $ninja_forms_processing->get_action() != 'save' )
		return false;
	
	if ( isset ( $ninja_forms_loading ) && $ninja_forms_loading->get_form_ID() == $form_id ) {
		$sub_id = $ninja_forms_loading->get_form_setting( 'sub_id' );
	} else if ( isset ( $ninja_forms_processing ) && $ninja_forms_processing->get_form_ID() == $form_id ) {
		$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );
	} else {
		$sub_id = '';
	}

	// if( ! empty( $sub_id ) ){
		?>
		<input type="hidden" name="_sub_id" value="<?php echo $sub_id;?>">
		<?php			
	// }

}

function nf_add_display_sub_id() {
	add_action( 'ninja_forms_display_after_open_form_tag', 'ninja_forms_display_sub_id' );	
}

add_action( 'init', 'nf_add_display_sub_id' );