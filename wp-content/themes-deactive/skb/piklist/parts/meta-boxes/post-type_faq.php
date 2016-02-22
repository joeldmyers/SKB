<?php
/*
Title: FAQ Answer
Description: Team Member custom post type fields
Post Type: faq
Context: normal
Priority: high
Lock: true
Collapse: false
Meta Box: true
*/
 
piklist( 'field', array(
		'type' => 'editor',
		'field' => 'faq_answer',
		'label' => __( 'Answer' ),
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
		)
	)
);