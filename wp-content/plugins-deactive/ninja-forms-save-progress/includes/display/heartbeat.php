<?php
// Function that receives the heartbeat API call and saves the user's data.

function ninja_forms_heartbeat_received( $response, $data ) {
 	$params = array();
 	parse_str( $data['ninja_forms_test']['form_data'], $params );
	$data['ninja_forms_test']['form_data'] = $params;
	$response['ninja_forms_test'] = $data;
    return $response;
}

add_filter( 'heartbeat_received', 'ninja_forms_heartbeat_received', 10, 2 );