<?php
/*
Title: Partner Details
Description: Partner custom post type fields
Post Type: partner
Context: normal
Priority: high
Lock: true
Collapse: false
Meta Box: true
*/
 
piklist( 'field', array(
		'type' => 'text',
		'scope' => 'post_meta',
		'field' => 'partner_link',
		'label' => __( 'Link' ),
		'attributes' => array(
			'class' => 'large-text'
		),
		'position' => 'wrap'
	)
);

piklist( 'field', array(
		'type' => 'editor',
		'field' => 'partner_details',
		'label' => __( 'Details' ),
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