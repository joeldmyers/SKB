<?php
/*
Title: Glossary Term Definition
Description: Glossary Term custom post type fields
Post Type: glossary_term
Context: normal
Priority: high
Lock: true
Collapse: false
Meta Box: true
*/
 
piklist( 'field', array(
		'type' => 'editor',
		'field' => 'glossary_term_definition',
		'label' => __( 'Definition' ),
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