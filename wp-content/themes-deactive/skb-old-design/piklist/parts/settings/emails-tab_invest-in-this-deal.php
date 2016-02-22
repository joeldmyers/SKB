<?php
/*
Title: Invest in this Deal
Setting: skb_theme_settings
Tab: Emails
Order: 70
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'invest_subject',
		'label' => __( 'Subject' ),
		'description' => __( 'Subject of invest in this deal email.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'invest_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in invest in this deal email. Message will be wrapped in template and email confirmation link will be added below message.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);