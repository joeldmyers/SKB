jQuery(document).ready(function(jQuery) {
	jQuery(".ninja-forms-save-progress-delete-sub").click(function(e){
		var answer = confirm( ninja_forms_save_progress_settings['delete'] );
		if( !answer ){
			return false;
		}
	});

	jQuery( document ).on( 'click', '.ninja-forms-save-progress', function() {
		jQuery( document ).data( 'nf_save', true );
	});

	jQuery( 'body' ).on( "beforeSubmit.save", function(e, formData, jqForm, options ){
		if ( jQuery( document ).data( 'nf_save' ) == true ) {
			jQuery( document ).data( 'submit_action', 'save' );
			jQuery( document ).data( 'nf_save', false );
		}
	});

	jQuery(this).on('submitResponse.default', function(e, response){
		if ( typeof response.form_settings.sub_id !== 'undefined' ) {
			form_id = response.form_id;
			jQuery( "#ninja_forms_form_" + form_id ).find( 'input[name="_sub_id"]' ).val( response.form_settings.sub_id );
		}
		return true;
	});
});