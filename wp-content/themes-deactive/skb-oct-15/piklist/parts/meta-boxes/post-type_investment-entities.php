<?php
/*
Title: Investment Deal
Description: Investment Deal custom post type fields
Post Type: investment_entity
Context: normal
Priority: high
Order: 10
Lock: true
Collapse: false
Meta Box: true
*/
global $post;

$deals = get_posts( array(
    'posts_per_page' => -1,
    'post_type' => 'investment_deal',
    'meta_key' => 'investment_deal_entity_id',
    'meta_value' => $post->ID
        //'investment_deal_entity_id' => $id
    )
);

if (empty($deals)){
    $deal_titles = '<li>'. __('This Entity has no deals', 'skb' ) .'</li>';
}

 // replaced with post_title
/* piklist( 'field', array(
		'type' => 'select',
		'field' => 'investment_entity_name',
		'label' => 'Entity Name',
                'attributes' => array(
                    'class' => 'disabled'
                ),
		'choices' => array(
    		'' => 'Choose Entity'
  		)
  		+ piklist( 
		  get_posts( 
		      array(
		          'post_type' => 'investment_entity',
		          'posts_per_page' => -1,
		          'post_status' => 'publish',
		         // 'investment_category' => array( 'active', 'coming' ),
		      ),
		      'objects'
		  ),
		  array( 'ID', 'post_title' )
		)
	)
); */

piklist( 'field', array(
		'type' => 'text',
		'field' => 'investment_entity_type',
		'label' => __( 'Entity Type' ),
		'description' => ''
    )
    /*
		'attributes' => array(
			'class' => 'disabled'
		),
                'choices' => array(
                    'trust' => 'Trust',
                    'tenants' => 'Tenants in Common (Available only for married couples)',
                    'community' => 'Community Property',
                    'individual' => 'Individual Retirement Account',
                    'lp' => 'Limited Partnership',
                    'llc' => 'Limited Liability Company',
                    'corporation' => 'Corporation'
  		)
	) */
);
piklist( 'field', array(
		'type' => 'text',
		'field' => 'investment_entity_user_name',
		'label' => 'Investor'
                /*'attributes' => array(
                    'class' => 'disabled'
                ),
		'choices' => array(
    		'' => 'Investor Name'
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
		)*/
	)
);


piklist( 'field', array(
		'type' => 'hidden',
		'field' => 'investment_entity_user_id',
		'attributes' => array(
			'class' => 'hidden'
		),
	)
);

foreach ($deals as $deal) {
    $deal_titles .= '<li>'.$deal->post_title.'</li>';
}

piklist( 'field', array(
		'type' => 'select',
		'field' => 'investment_entity_all_deals',
		'label' => __( 'Entity Deals' ),
		'description' => 'Deals belonging to Entity',
		'attributes' => array(
			'class' => 'disabled'
		),
                'choices' => array($deal_titles
  		)
        )
);



/*
piklist('field', array(
    'type' => 'html'
    ,'label' => 'Deals'
    ,'field' => 'investment_entity_all_deals' // 'field' is only required for a settings page.
    ,'description' => 'Deals belonging to this Entity'
    ,'value' => '<ul>'.$deal_titles.'</ul>'
  ));


*/
/*
piklist( 'field', array(
		'type' => 'file',
		'field' => 'investment_deal_docs',
		'label' => 'Documents',
		'options' => array(
			'basic' => true
		)
	)
);*/