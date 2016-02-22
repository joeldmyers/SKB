<?php
/*
Title: AIQ Completed Emails
Setting: skb_theme_settings
Tab: Emails
Order: 25
*/

piklist( 'field', array(
		'type' => 'text',
		'field' => 'first_aiq_completed_subject',
		'label' => __( 'Subject' ),
		'description' => __( '<p>Subject for First AIQ completed email for a Registered Investor transitioning to a Waiting Investor.</p>', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'first_aiq_completed_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send for First AIQ completed email. Message will be wrapped in template.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);

piklist( 'field', array(
		'type' => 'text',
		'field' => 'additional_aiq_completed_subject',
		'label' => __( 'Subject' ),
		'description' => __( '<p>Subject of additional AIQ completed email for Waiting Investor.</p>', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'additional_aiq_completed_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in AIQ completed email for Waiting Investor. Message will be wrapped in template.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);

piklist( 'field', array(
		'type' => 'text',
		'field' => 'approved_aiq_completed_subject',
		'label' => __( 'Subject' ),
		'description' => __( '<p>Subject of AIQ completed email for Approved Investor.</p>', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'approved_aiq_completed_message',
		'label' => __( 'Body' ),
		'description' => __( 'Message body to send in AIQ completed email for Approved Investor. Message will be wrapped in template.', 'piklist' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 10,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
);