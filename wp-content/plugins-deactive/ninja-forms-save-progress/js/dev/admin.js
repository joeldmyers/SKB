jQuery( document ).ready( function( $ ) {

	$( document ).on( 'click', '.edit-sub-status', function( e ) {
		e.preventDefault();
		$( this ).fadeOut( 'fast' );
		$( this ).next( 'div' ).slideDown( 'fast' );
	});	

	$( document ).on( 'click', '.cancel-sub-status', function( e ) {
		e.preventDefault();
		$( this ).parent().slideUp( 'fast' );
		$( this ).parent().prev( 'a' ).fadeIn( 'fast' );
	});

	$( document ).on( 'click', '.save-sub-status', function( e ) {
		e.preventDefault();
		var value =	$('#sub-status-select option:selected').text();
		$( '#sub-status-display' ).html( value );
		$( this ).parent().slideUp( 'fast' );
		$( this ).parent().prev( 'a' ).fadeIn( 'fast' );
	});

});