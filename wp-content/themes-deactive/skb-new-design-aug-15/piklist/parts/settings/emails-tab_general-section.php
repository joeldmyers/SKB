<?php
/*
Title: General Email Settings
Setting: skb_theme_settings
Tab: Emails
Tab Order: 30
Order: 10
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'skb_from_name',
		'label' => __( 'From Name' ),
		'description' => __( 'Name emails will be sent from.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'text',
		'field' => 'skb_from_email',
		'label' => __( 'From Email' ),
		'description' => __( 'Email address messages will be sent from.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);