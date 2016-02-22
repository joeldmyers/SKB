<?php
/*
Title: Team Member Page
Setting: skb_theme_settings
Tab: Page Options
Order: 40
*/

piklist( 'field', array(
	'type' => 'editor',
	'field' => 'team_member_intro',
	'label' => __( 'Team Member Intro' ),
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