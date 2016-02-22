<?php
/*
Title: Glossary Page
Setting: skb_theme_settings
Tab: Page Options
Order: 30
*/

piklist( 'field', array(
		'type' => 'file',
		'field' => 'glossary_banner',
		'label' => __('Glossary Banner','piklist'),
		'description' => __('Banner to show on Glossary page.', 'piklist' ),
		'options' => array(
			'modal_title' => __( 'Add Image', 'piklist' ),
			'button' => __( 'Select', 'piklist' ),
		)
	)
);

piklist( 'field', array(
	'type' => 'editor',
	'field' => 'glossary_intro',
	'label' => __( 'Glossary Intro' ),		
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
		'field' => 'glossary_sidebar',
		'label' => __( 'Glossary Sidebar' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 12,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
); 