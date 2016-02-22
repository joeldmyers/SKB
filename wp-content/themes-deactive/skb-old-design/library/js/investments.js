jQuery(document).ready( function (){

	jQuery('#follow_investment').on('click', function(){
		jQuery.post(
		    Investment.ajaxurl, {
		        action : 'follow_investment',
		        investment_id : Investment.id,
		        follow_nonce : Investment.follow_nonce,
		    }, function(response) {
		        jQuery("#ajax_follow_response").html(response);
		        jQuery('#alert-follow').removeClass('hide');
		        jQuery('#follow_investment').addClass('disabled');
		    }
		);
	});

	jQuery('#unfollow_investment').on('click', function(){
		jQuery.post(
		    Investment.ajaxurl, {
		        action : 'unfollow_investment',
		        investment_id : Investment.id,
		        unfollow_nonce : Investment.unfollow_nonce,
		    }, function(response) {
		        jQuery("#ajax_follow_response").html(response);
		        jQuery('#alert-follow').removeClass('hide');
		        jQuery('#unfollow_investment').addClass('disabled');
		    }
		);
	});

	jQuery('#read_investment').on('click', function(){
		jQuery.post(
		    Investment.ajaxurl, {
		        action : 'mark_investment_read',
		        investment_id : Investment.id,
		        read_nonce : Investment.read_nonce,
		    }, function(response) {
				jQuery('#invest_in_this_deal').removeClass('disabled');
		    }
		);

		window.open(Investment.offering_pdf, "Investment Offering");

	});

});