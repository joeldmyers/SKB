<?php
/*
Title: User Dashboard Update
Setting: skb_theme_settings
Tab: Emails
Order: 80
*/



piklist( 'field', array(
		'type' => 'text',
		'field' => 'dashboard_update_subject',
		'label' => __( 'Subject' ),
		'description' => __( 'Subject of user dashboard update email.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'dashboard_update_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in user dashboard update email. Message will be wrapped in template and email confirmation link will be added below message.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);