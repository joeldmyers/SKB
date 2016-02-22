<?php 

/* Theme custom post_types
------------------------------------------------*/

add_filter( 'piklist_post_types', 'skb_post_types' );

function skb_post_types( $post_types ) {

	$post_types['investment'] = array(
		'labels' => piklist('post_type_labels', 'Investments'),
		'title' => __('Enter Investment Address'),
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-location-alt',
		'rewrite' => array(
			'slug' => 'investments'
			),
		'supports' => array(
			'title',
			'thumbnail',
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			),
	);

	$post_types['investment_update'] = array(
		'labels' => piklist('post_type_labels', 'Investment Updates'),
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-analytics',
		'rewrite' => array(
			'slug' => 'investment-updates'
			),
		'supports' => array(
			'title'
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			),
	);

	$post_types['investment_deal'] = array(
		'labels' => piklist('post_type_labels', 'Investment Deals'),
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-portfolio',
		'rewrite' => array(
			'slug' => 'investment-deals'
			),
		'supports' => array(
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			),
	);

	$post_types['investor_message'] = array(
		'labels' => piklist('post_type_labels', 'Investor Messages'),
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-email-alt',
		'rewrite' => array(
			'slug' => 'investment-message'
			),
		'supports' => array(
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			),
	);

	$post_types['slide'] = array(
		'labels' => piklist('post_type_labels', 'Slides'),
		'title' => __('Enter Slide Title'),
		'public' => false,
		'show_ui' => true,	
		'menu_icon' => 'dashicons-images-alt',
		'rewrite' => array(
			'slug' => 'slides'
			),
		'supports' => array(
			'title',		
			'thumbnail',
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			),
	);

	$post_types['team_member'] = array(
		'labels' => piklist('post_type_labels', 'Team Members'),
		'title' => __('Enter Full Name'),
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-businessman',
		'rewrite' => array(
			'slug' => 'team-members'
			),
		'supports' => array(
			'title',
			'thumbnail',
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			)
	);

	$post_types['partner'] = array(
		'labels' => piklist('post_type_labels', 'Partners'),
		'title' => __('Enter Partner Title'),
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-groups',
		'rewrite' => array(
			'slug' => 'partner'
			),
		'supports' => array(
			'title',
			'thumbnail'
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			)
	);

	$post_types['testimonial'] = array(
		'labels' => piklist('post_type_labels', 'Testimonials'),
		'title' => __('Enter Testimonial Source'),
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-editor-quote',
		'rewrite' => array(
			'slug' => 'testimonial'
			),
		'supports' => array(
			'title',
			'excerpt',
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			)
	);

	$post_types['faq'] = array(
		'labels' => piklist('post_type_labels', 'FAQ'),
		'title' => __('Enter Question'),
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-format-chat',
		'rewrite' => array(
			'slug' => 'faqs'
			),
		'supports' => array(
			'title',
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			)
	);

	$post_types['glossary_term'] = array(
		'labels' => piklist('post_type_labels', 'Glossary Terms'),
		'title' => __('Enter Term Title'),
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-book-alt',
		'rewrite' => array(
			'slug' => 'glossary-terms'
			),
		'supports' => array(
			'title',
			),
		'hide_meta_box' => array(
			'slug',
			'author',
			'revisions',
			'comments',
			'commentstatus'
			)
	);

	return $post_types;

}