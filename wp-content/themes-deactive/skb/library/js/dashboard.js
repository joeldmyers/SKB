jQuery(document).ready( function (){

	jQuery( ".btn-link" ).click(function( event ) {
		var msg_status_id = jQuery(this).attr('id');
		jQuery.ajax({
			type: "post",
			url: Dashboard.ajaxurl,
			data: {
		        action : 'mark_message_read',
		        message_read_nonce : Dashboard.message_read_nonce,
		        message_id : jQuery(this).attr('id')
		    }
		})
	    .done(function(response) {
	    	if ( 'Read' == response ) {
		        jQuery("#msg_status_" + msg_status_id).html(response);
			}
	    });
	});

});