<?php
/*
Title: Investor Message
Description: Investor Message custom post type fields
Post Type: investor_message
Context: normal
Priority: high
Order: 10
Lock: true
Collapse: false
Meta Box: true
*/

piklist( 'field', array(
		'type' => 'select',
		'field' => 'investor_message_user',
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
		'type' => 'select',
		'field' => 'investor_message_investment',
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
		'type' => 'text',
		'field' => 'investor_message_subject',
		'label' => __( 'Subject' ),
		'attributes' => array(
			'class' => 'text'
		),
		'position' => 'wrap'
	)
);


piklist( 'field', array(
		'type' => 'editor',
		'field' => 'investor_message_content',
		'label' => __( 'Message' ),
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


piklist( 'field', array(
		'type' => 'hidden'
		 ,'field' => 'investor_message_status'
		 ,'value' => 'Unread'
		)
);