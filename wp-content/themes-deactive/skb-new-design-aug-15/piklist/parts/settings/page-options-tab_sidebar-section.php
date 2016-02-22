<?php
/*
Title: Sidebar Content
Setting: skb_theme_settings
Tab: Page Options
Tab Order: 50
Order: 10
*/

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'main_sidebar',
		'label' => __( 'Main Sidebar' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 12,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
); 