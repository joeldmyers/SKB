jQuery(document).ready( function (){

	jQuery( "#account_form" ).submit(function( event ) {
		jQuery.ajax({
			type: "post",
			url: MyAccount.ajaxurl,
			data: {
		        action : 'update_user_account',
		        account_nonce : MyAccount.account_nonce,
		        first_name : jQuery('input[name=first_name]').val(),
		        last_name : jQuery('input[name=last_name]').val(),
		        phone : jQuery('input[name=phone]').val(),
		    },
		    success: function(response) {
		        jQuery("#ajax_account_response").html(response);
		        jQuery('#alert-account').removeClass('hide');
		    }
		});
		return false;
	});

	jQuery( "#address_form" ).submit(function( event ) {
		jQuery.ajax({
			type: "post",
			url: MyAccount.ajaxurl,
			data: {
		        action : 'update_user_address',
		        address_nonce : MyAccount.address_nonce,
		        address_1 : jQuery('input[name=address_1]').val(),
		        address_2 : jQuery('input[name=address_2]').val(),
		        city : jQuery('input[name=city]').val(),
		        state : jQuery('input[name=state]').val(),
		        postal_code : jQuery('input[name=postal_code]').val(),
		    },
		    success: function(response) {
		        jQuery("#ajax_address_response").html(response);
		        jQuery('#alert-address').removeClass('hide');
		    }
		});
		return false;
	});

	jQuery( "#password_form" ).submit(function( event ) {
		jQuery.ajax({
			type: "post",
			url: MyAccount.ajaxurl,
			beforeSend: function() {
				if( jQuery('input[name=new_password]').val() != jQuery('input[name=confirm_password]').val()){
					jQuery("#ajax_password_error").html('Passwords do not match');
			        jQuery('#alert-password-error').removeClass('hide');
					return false;
	            }
			},
			data: {
		        action : 'update_user_password',
		        password_nonce : MyAccount.password_nonce,
		        current_password : jQuery('input[name=current_password]').val(),
		        new_password : jQuery('input[name=new_password]').val(),
		    },
		    success: function(response) {
		        jQuery("#ajax_password_response").html(response);
		        jQuery('#alert-password').removeClass('hide');
		    }
		});
		return false;
	});

});