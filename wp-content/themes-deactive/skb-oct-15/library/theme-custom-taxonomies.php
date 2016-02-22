<?php

/* Theme custom taxonomies
------------------------------------------------*/

add_filter('piklist_taxonomies', 'skb_taxonomies');

function skb_taxonomies( $taxonomies ) {
    $taxonomies[] = array(
        'post_type' => 'faq',
        'name' => 'faq_category',
        'show_admin_column' => false,
        'configuration' => array(
            'hide_meta_box' => true,
            'hierarchical' => false,
            'labels' => piklist('taxonomy_labels', 'FAQ Category'),
            'show_ui' => false,
            'query_var' => true,
            'rewrite' => array( 
                'slug' => 'faq-category' 
            )
        )
    );

    $taxonomies[] = array(
        'post_type' => 'investment',
        'name' => 'investment_category',
        'show_admin_column' => false,
        'configuration' => array(
            'hide_meta_box' => true,
            'hierarchical' => false,
            'labels' => piklist('taxonomy_labels', 'Investment Category'),
            'show_ui' => false,
            'query_var' => true,
            'rewrite' => array( 
                'slug' => 'investment-category' 
            )
        )
    );

    $taxonomies[] = array(
        'post_type' => 'glossary_term',
        'name' => 'glossary_category',
        'show_admin_column' => false,
        'configuration' => array(
            'hide_meta_box' => true,
            'hierarchical' => false,
            'labels' => piklist('taxonomy_labels', 'Glossary Category'),
            'show_ui' => false,
            'query_var' => true,
            'rewrite' => array( 
                'slug' => 'glossary-category' 
            )
        )
    );

    return $taxonomies;
}