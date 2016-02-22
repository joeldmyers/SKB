<?php
/*
Title: Investment Update
Description: Investment Update custom post type fields
Post Type: investment_update
Context: normal
Priority: high
Order: 10
Lock: true
Collapse: false
Meta Box: true
*/

piklist( 'field', array(
		'type' => 'select',
		'field' => 'investment_id',
		'label' => 'Investment',
		'choices' => piklist( 
		  get_posts( 
		      array(
		          'post_type' => 'investment',
		          'posts_per_page' => -1,
		          'post_status' => 'publish',
		          'investment_category' => array( 'active', 'coming' ),
		      ),
		      'objects'
		  ),
		  array( 'ID', 'post_title' )
		)
	)
);

piklist( 'field', array(
		'type' => 'file',
		'field' => 'investment_document',
		'label' => 'Update Document',
		'options' => array(
			'basic' => true
		)
	)
);