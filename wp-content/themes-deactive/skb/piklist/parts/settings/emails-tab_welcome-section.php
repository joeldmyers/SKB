<?php
/*
Title: Welcome Approved Investor
Setting: skb_theme_settings
Tab: Emails
Order: 60
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'welcome_subject',
		'label' => __( 'Subject' ),
		'description' => __( 'Subject of welcome email.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'welcome_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in welcome email. Message will be wrapped in template and email confirmation link will be added below message.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);