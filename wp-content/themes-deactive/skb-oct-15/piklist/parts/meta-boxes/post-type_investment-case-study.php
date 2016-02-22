<?php
/*
Title: Case Study
Description: Investment custom post type fields
Post Type: investment
Context: normal
Priority: high
Order: 30
Lock: true
Collapse: false
Meta Box: true
*/

piklist( 'field', array(
		'type' => 'radio',
		'scope' => 'post_meta',
		'field' => 'investment_case_study',
		'label' => __( 'Case Study?' ),
		'description' => __( 'Should investment be shown as a case study?' ),		
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'Yes' => 'Yes',
			'No' => 'No',
		),
		'value' => 'No',
	)
);

piklist('field', array(
	'type' => 'html',
	'label' => 'Case Study Content',
	'value' => 'Enter the case study content below.',
	)
);

piklist( 'field', array(
	'type' => 'editor',
	'field' => 'investment_case_study_content',
	'label' => __( 'Case Study Content' ),		
	'value' => '',
	'template' => 'field',
	'options' => array (
		'wpautop' => true,
		'media_buttons' => false,
		'tabindex' => '',
		'editor_css' => '',
		'editor_class' => '',
		'teeny' => false,
		'dfw' => false,
		'tinymce' => true,
		'quicktags' => true,
		),
	)
);