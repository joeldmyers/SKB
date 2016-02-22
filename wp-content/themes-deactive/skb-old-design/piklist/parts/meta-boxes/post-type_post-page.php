<?php
/*
Title: Post/Page Options
Description: Settings for Post/Page Display
Post Type: post, page
Context: normal
Priority: high
Lock: true
Collapse: false
Meta Box: true
*/

piklist( 'field', array(
		'type' => 'radio',
		'scope' => 'post_meta',
		'field' => 'show_title',
		'label' => __( 'Show Title?' ),
		'description' => __( 'Should title be shown on post/page?' ),		
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'Yes' => 'Yes',
			'No' => 'No',
		),
		'value' => 'Yes',
	)
);