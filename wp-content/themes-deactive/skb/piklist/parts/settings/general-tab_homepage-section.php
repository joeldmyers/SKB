<?php
/*
Title: Homepage Settings
Setting: skb_theme_settings
Order: 10
*/

piklist( 'field', array(
		'type' => 'select',
		'field' => 'slider_speed',
		'label' => __( 'Slider Speed' ),
		'description' => __( 'Choose the amount of seconds to delay before switching the slider.', 'piklist' ),
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'7' => '7',
			'9' => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
		),
	)
);


piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'site_alert',
		'label' => __( 'Site Alert' ),
		'description' => __( 'Text shown above site on all pages (mobile and desktop).', 'piklist' ),
		'attributes' => array(
			'rows' => 3,
			'cols' => 50,
			'class' => 'large-text'
		)
	)
);


piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'intro_spot',
		'label' => __( 'Intro Text' ),
		'description' => __( 'Text shown below main slider on homepage.', 'piklist' ),
		'attributes' => array(
			'rows' => 3,
			'cols' => 50,
			'class' => 'large-text'
		)
	)
);


piklist( 'field', array(
		'type' => 'text',
		'field' => 'closed_deals_title',
		'label' => __( 'Closed Deals Title' ),
		'description' => __( 'Title shown above closed deals on homepage.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);


piklist( 'field', array(
		'type' => 'editor',
		'field' => 'about_caption',
		'label' => __( 'About Caption' ),
		'description' => __( 'Text to show next to about image on homepage.' ),
		'value' => '',
		'options' => array (
			'wpautop' => false,
			'media_buttons' => true,
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
		'type' => 'file',
		'field' => 'about_image',
		'label' => __('About Image','piklist'),
		'description' => __('Image to show next to about caption on homepage.', 'piklist' ),
		'options' => array(
		'modal_title' => __( 'Add Image', 'piklist' ),
			'button' => __( 'Select', 'piklist' ),
			)
		)
);



piklist( 'field', array(
		'type' => 'text',
		'field' => 'partners_title',
		'label' => __( 'Partners Title' ),
		'description' => __( 'Title shown above partner logos on homepage.', 'piklist' ),
		'attributes' => array(
			'class' => 'regular-text'
		)
	)
);


piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'partners_caption',
		'label' => __( 'Partners Caption' ),
		'description' => __( 'Text shown above partner logos on homepage.', 'piklist' ),
		'attributes' => array(
			'rows' => 3,
			'cols' => 50,
			'class' => 'large-text'
		)
	)
);


piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'find_out_more',
		'label' => __( 'Find Out More' ),
		'description' => __( 'Text shown below partners section and call to action buttons on homepage.', 'piklist' ),
		'attributes' => array(
			'rows' => 3,
			'cols' => 50,
			'class' => 'large-text'
		)
	)
);


piklist( 'field', array(
		'type' => 'editor',
		'field' => 'privacy_notice',
		'label' => __( 'Privacy Notice' ),
		'description' => __( 'Privacy notice to show above footer on homepage.' ),
		'value' => 'Privacy notice content...',
		'options' => array (
			'wpautop' => false,
			'media_buttons' => true,
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