<?php
/*
Title: Details
Description: Investment custom post type fields
Post Type: investment
Context: normal
Priority: high
Order: 10
Lock: true
Collapse: false
Meta Box: true
*/

piklist( 'field', array(
		'type' => 'radio',
		'scope' => 'post_meta',
		'field' => 'investment_featured',
		'label' => __( 'Featured?' ),
		'description' => __( 'Should investment be shown on homepage?' ),		
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'Yes' => 'Yes',
			'No' => 'No',
		),
		'value' => 'No',
	)
);

piklist( 'field', array(
		'type' => 'select',
		'scope' => 'taxonomy',
		'field' => 'investment_category',
		'label' => __( 'Investment Status' ),
		'choices' => piklist( get_terms( 'investment_category', array( 'hide_empty' => false ) ), array( 'term_id', 'name' ) ),
	)
);

piklist( 'field', array(
		'type' => 'text',
		'scope' => 'post_meta',
		'field' => 'investment_city',
		'label' => __( 'City' ),
		'attributes' => array(
			'class' => 'text'
		),
	)
);

piklist( 'field', array(
		'type' => 'select',
		'scope' => 'post_meta',
		'field' => 'investment_state',
		'label' => __( 'State' ),
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'AL' => 'Alabama',
			'AK' => 'Alaska',
			'AZ' => 'Arizona',
			'AR' => 'Arkansas',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DE' => 'Delaware',
			'DC' => 'District Of Columbia',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'HI' => 'Hawaii',
			'ID' => 'Idaho',
			'IL' => 'Illinois', 
			'IN' => 'Indiana', 
			'IA' => 'Iowa',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'ME' => 'Maine',
			'MD' => 'Maryland', 
			'MA' => 'Massachusetts',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MS' => 'Mississippi',
			'MO' => 'Missouri',
			'MT' => 'Montana',
			'NE' => 'Nebraska',
			'NV' => 'Nevada',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NY' => 'New York',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma', 
			'OR' => 'Oregon',
			'PA' => 'Pennsylvania',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VT' => 'Vermont',
			'VA' => 'Virginia',
			'WA' => 'Washington',
			'WV' => 'West Virginia',
			'WI' => 'Wisconsin',
			'WY' => 'Wyoming',
		),
	)
);


piklist( 'field', array(
		'type' => 'text',
		'scope' => 'post_meta',
		'field' => 'investment_goal',
		'label' => __( 'Goal' ),
		'description' => 'USD, no symbols. Ex. 1000000',
		'attributes' => array(
			'class' => 'text'
		),
	)
);


piklist( 'field', array(
        'type' => 'file'
        ,'field' => 'investment_offering'
        ,'label' => 'Investment Offering PDF'
        ,'options' => array(
          'basic' => true
        )
      )
);


piklist( 'field', array(
		'type' => 'select',
		'scope' => 'post_meta',
		'field' => 'investment_type',
		'label' => __( 'Investment Type' ),
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'Bridge Loan' => 'Bridge Loan',
			'Core' => 'Core',
			'Core Plus' => 'Core Plus',
			'Opportunistic' => 'Opportunistic',
			'Value Add' => 'Value Add',
		),
	)
);

piklist( 'field', array(
		'type' => 'select',
		'scope' => 'post_meta',
		'field' => 'investment_property_type',
		'label' => __( 'Investment Property Type' ),
		'attributes' => array(
			'class' => 'text'
		),
		'choices' => array(
			'Acquisition of land' => 'Acquisition of land',
			'Equity Purchase' => 'Equity Purchase',
			'Flex' => 'Flex',
			'Industrial' => 'Industrial',
			'Mixed-Use' => 'Mixed-Use',
			'Office' => 'Office',
			'Retail' => 'Retail',
			'Unsecured Recourse Loan' => 'Unsecured Recourse Loan',
		),
	)
);

piklist('field', array(
	'type' => 'html',
	'label' => 'Overview',
	'value' => 'Enter the investment overview below. Should be concise and is shown below the thumbnail on investment listing pages.</p>'
	)
);

piklist( 'field', array(
		'type' => 'editor',
		'field' => 'investment_overview',
		'label' => __( 'Overview' ),		
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

piklist('field', array(
	'type' => 'html',
	'label' => 'Description',
	'value' => 'Enter the investment description below. Will be shown on the full investment detail page.</p>'
	)
);

piklist( 'field', array(
		'type' => 'editor',
		'field' => 'investment_description',
		'label' => __( 'Description' ),
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
