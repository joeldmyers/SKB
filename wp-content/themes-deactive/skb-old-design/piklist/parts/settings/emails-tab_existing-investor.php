<?php
/*
Title: Existing Investor
Setting: skb_theme_settings
Tab: Emails
Order: 65
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'existing_investor_subject',
		'label' => __( 'Subject' ),
		'description' => __( 'Subject of existing investor email.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'existing_investor_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in existing investor email. Message will be wrapped in template and email confirmation link will be added below message.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);