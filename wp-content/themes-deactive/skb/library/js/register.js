jQuery(document).ready( function () {

	jQuery('#accredited_form').submit(function( event ) {
	    var value = jQuery('input[name$="accredited_investor"]:checked').val();
	    if (value == '0') {
	    	jQuery('#accredited_form').addClass('hide');
	    	jQuery('#not-accredited').removeClass('hide');
	    } else if (value == '1') {
	    	jQuery('#accredited_form').addClass('hide');
	    	jQuery('#register_form').removeClass('hide');
	   	} else {
	   		alert( 'Please select your Accredited Investor status. ' + value);
	    }
        return false;
	});

	jQuery('#register_form').submit(function( event ) {
		if( jQuery('input[name=password]').val() != jQuery('input[name=confirm_password]').val()) {
			jQuery('#ajax_password_error').html('Passwords do not match');
	        jQuery('#alert-password-error').removeClass('hide');
			return false;
        }
	});

});