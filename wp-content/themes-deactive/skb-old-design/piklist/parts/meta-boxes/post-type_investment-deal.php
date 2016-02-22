<?php
/*
Title: Investment Deal
Description: Investment Deal custom post type fields
Post Type: investment_deal
Context: normal
Priority: high
Order: 10
Lock: true
Collapse: false
Meta Box: true
*/


piklist( 'field', array(
		'type' => 'select',
		'field' => 'investment_deal_investment',
		'label' => 'Select Investment',
		'choices' => array(
    		'' => 'Choose Investment'
  		)
  		+ piklist( 
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
		'type' => 'select',
		'field' => 'investment_deal_user',
		'label' => 'Select Investor',
		'choices' => array(
    		'' => 'Choose User'
  		)
  		+ piklist( 
		  get_users( 
		      array(
		          'orderby' => 'display_name',
		          'order' => 'ASC',
		      ),
		      'objects'
		  ),
		  array( 'ID', 'display_name' )
		)
	)
);


piklist( 'field', array(
		'type' => 'text',
		'field' => 'investment_deal_amount',
		'label' => __( 'Investment Amount' ),
		'description' => 'USD, no symbols. Ex. 1000000',
		'attributes' => array(
			'class' => 'text'
		),
	)
);


piklist( 'field', array(
		'type' => 'file',
		'field' => 'investment_deal_docs',
		'label' => 'Documents',
		'options' => array(
			'basic' => true
		)
	)
);