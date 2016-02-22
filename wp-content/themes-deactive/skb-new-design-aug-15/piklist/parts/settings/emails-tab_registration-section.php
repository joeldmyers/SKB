<?php
/*
Title: Pending Investor Confirmation
Setting: skb_theme_settings
Tab: Emails
Order: 20
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'confirm_registration_subject',
		'label' => __( 'Subject' ),
		'description' => __( 'Subject of email to confirm registration.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'confirm_registration_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in email. Message will be wrapped in template and email confirmation link will be added below message.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 12,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);