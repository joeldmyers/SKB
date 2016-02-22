<?php
/*
Title: Slide Content
Description: Slide custom post type fields
Post Type: slide
Context: normal
Priority: high
Lock: true
Collapse: false
Meta Box: true
*/

piklist( 'field', array(
		'type' => 'editor',
		'field' => 'slide_content',
		'label' => __( 'Slide Content' ),
		'value' => '',
		'template' => 'field',
		'options' => array (
			'wpautop' => false,
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