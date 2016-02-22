<?php // Theme shortcodes

add_shortcode( 'skb_login_form', 'skb_login_form' );
add_shortcode( 'skb_registration_form', 'skb_registration_form' );
add_shortcode( 'cooling_end_date', 'cooling_end_date' );
add_shortcode( 'cooling_off_days_left', 'cooling_off_days_left' );
add_shortcode( 'investor_firstname', 'investor_firstname' );
add_shortcode( 'investor_lastname', 'investor_lastname' );
add_shortcode( 'investor_fullname', 'investor_fullname' );
add_shortcode( 'show_logged_in', 'show_logged_in' );
add_shortcode( 'hide_logged_in', 'hide_logged_in' );
add_shortcode( 'investor_dashboard_link', 'investor_dashboard_link' );
add_shortcode( 'website_home_url', 'website_home_url' );
add_shortcode( 'email_unsubscribe_link', 'email_unsubscribe_link' );
add_shortcode( 'email_preferences_link', 'email_preferences_link' );


function skb_login_form() {

	get_template_part( 'library/templates/content' , 'login_form' );

}

function skb_registration_form() {
    
  // echo do_shortcode('[userpro template=register]');

	get_template_part( 'library/templates/content', 'registration_form' );

}

function cooling_end_date() {

	$user = wp_get_current_user();

	// Start date began after user submitted first AIQ as a registered investor and changed to a cooling investor 
	$cooling_end_date = new DateTime( get_user_meta( $user->ID, 'user_registered', true ) );

	// Add 21 days of cooling off to start date
	$cooling_end_date->add( new DateInterval( 'P21D' ) );

	return $cooling_end_date->format('g:ia \o\n l F jS, Y');

}

function cooling_off_days_left() {

	$user = wp_get_current_user();

	// Start date began after user submitted first AIQ as a registered investor and changed to a cooling investor 
	$cooling_start_date = new DateTime( get_user_meta( $user->ID, 'user_registered', true ) );

	// Add 21 days of cooling off to end date
	$cooling_end_date = new DateTime( get_user_meta( $user->ID, 'user_registered', true ) );	
	$cooling_end_date->add( new DateInterval( 'P14D' ) );

	$cooling_timer = $cooling_start_date->diff($cooling_end_date);

	return $cooling_timer->format('%a days');

}

function investor_firstname() {

	$current_user = wp_get_current_user();

	return $current_user->first_name;

}

function investor_lastname() {

	$current_user = wp_get_current_user();

	return $current_user->last_name;

}

function investor_fullname() {

	$current_user = wp_get_current_user();

	return $current_user->first_name . ' ' . $current_user->last_name;	

}

function show_logged_in( $atts, $content = '' ) {

	if ( is_user_logged_in() ) {

		return $content;

	} else {

		return '';
		
	}

}

function hide_logged_in( $atts, $content = '' ) {

	if ( is_user_logged_in() ) {

		return '';

	} else {

		return $content;

	}
	
}

function investor_dashboard_link() {

	return '<a href="' . home_url( '/dashboard' ) . '">SKB IN CROWD Investor Dashboard</a>';

}


function website_home_url() {

	return '<a href="' . home_url( '/' ) . '">SKB IN CROWD</a>';

}

function email_unsubscribe_link() {
    return '<a href="' . home_url( '/unsubscribe' ) . '">unsubscribe</a>';
}
function email_preferences_link() {
    return '<a href="' . home_url( '/my-account#preferences' ) . '">Manage your email preferences</a>';
}