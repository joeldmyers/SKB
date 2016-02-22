<?php
/*
Title: FAQ Page
Setting: skb_theme_settings
Tab: Page Options
Order: 20
*/

piklist( 'field', array(
		'type' => 'file',
		'field' => 'faq_banner',
		'label' => __('FAQ Banner','piklist'),
		'description' => __('Banner to show on FAQ page.', 'piklist' ),
		'options' => array(
			'modal_title' => __( 'Add Image', 'piklist' ),
			'button' => __( 'Select', 'piklist' ),
		)
	)
);

piklist( 'field', array(
	'type' => 'editor',
	'field' => 'faq_intro',
	'label' => __( 'FAQ Intro' ),
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

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'faq_sidebar',
		'label' => __( 'FAQ Sidebar' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 12,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
); 