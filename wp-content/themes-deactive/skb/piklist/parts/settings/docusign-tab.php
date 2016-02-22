<?php
/*
Title: Connection Settings
Setting: skb_theme_settings
Tab: Docusign
Tab Order: 50
Order: 10
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'docusign_key',
		'label' => __( 'DocuSign Key' ),
		'description' => __( 'DocuSign Integrator Key found on Preferences -> API page.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'text',
		'field' => 'docusign_username',
		'label' => __( 'DocuSign UserID' ),
		'description' => __( 'DocuSign API UserID or Email Address to log in.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'text',
		'field' => 'docusign_password',
		'label' => __( 'DocuSign Password' ),
		'description' => __( 'DocuSign API Password.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'text',
		'field' => 'docusign_api_url',
		'label' => __( 'DocuSign API URL' ),
		'description' => __( 'DocuSign API URL found on .', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);