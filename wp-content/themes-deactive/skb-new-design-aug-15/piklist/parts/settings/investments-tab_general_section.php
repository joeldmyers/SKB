<?php
/*
Title: General Settings
Setting: skb_theme_settings
Tab: Investments
Tab Order: 40
Order: 10
*/

piklist( 'field', array(
		'type' => 'textarea',
		'field' => 'case_study_sidebar',
		'label' => __( 'Case Study Sidebar' ),
		'value' => '',
		'template' => 'field',
		'attributes' => array (
			'rows' => 12,
			'columns' => 50,
			'class' => 'large-text',
		)
	)
); 

