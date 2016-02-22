<?php
/*
Title: Team Member Details
Description: Team Member custom post type fields
Post Type: team_member
Context: normal
Priority: high
Lock: true
Collapse: false
Meta Box: true
*/
 
piklist( 'field', array(
		'type' => 'text',
		'scope' => 'post_meta',
		'field' => 'team_member_title',
		'label' => __( 'Title' ),
		'attributes' => array(
			'class' => 'text'
		),
		'position' => 'wrap'
	)
);

piklist( 'field', array(
		'type' => 'editor',
		'field' => 'team_member_bio',
		'label' => __( 'Bio' ),
		'description' => __( 'Bio' ),
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