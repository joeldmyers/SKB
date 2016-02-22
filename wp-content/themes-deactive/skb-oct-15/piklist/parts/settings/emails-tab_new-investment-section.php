<?php
/*
Title: New Investment Posted - Sent to Approved Investors
Setting: skb_theme_settings
Tab: Emails
Order: 90
*/



piklist( 'field', array(
		'type' => 'text',
		'field' => 'new_investment_subject',
		'label' => __( 'Subject' ),
		'description' => __( 'Subject of new investment added email.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'new_investment_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in new investment added email. Message will be wrapped in template and email confirmation link will be added below message.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);