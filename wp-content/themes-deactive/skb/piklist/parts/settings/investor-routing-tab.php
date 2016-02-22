<?php
/*
Title:  Landing Pages
Setting: skb_theme_settings
Tab: Landing Pages
Tab Order: 60
Order: 10
*/

piklist( 'field', array(
        'type' => 'select',
        'field' => 'registration_landing',
        'label' => 'Registration',
        'description' => '<p>Where to send a <strong>New Investor</strong> after they submit the registration form.</p>',
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);


piklist( 'field', array(
        'type' => 'select',
        'field' => 'unconfirmed_landing',
        'label' => 'Unconfirmed',
        'description' => '<p>Where to send a <strong>New Investor</strong> who attempts to log in before confirming their email.</p>',
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);


piklist( 'field', array(
        'type' => 'select',
        'field' => 'first_aiq_landing',
        'label' => 'First AIQ Submitted - Registered Investor',
        'description' => '<p>Where to send a <strong>Registered Investor</strong> after they submit their first AIQ form.</p>',
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);


piklist( 'field', array(
        'type' => 'select',
        'field' => 'additional_aiq_landing',
        'label' => 'Additional AIQ Submitted - Waiting Investor',
        'description' => '<p>Where to send a <strong>Waiting Investor</strong> after they submit additional AIQ forms.</p>',
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);


piklist( 'field', array(
        'type' => 'select',
        'field' => 'approved_landing',
        'label' => 'AIQ Submitted - Approved Investor',
        'description' => '<p>Where to send an <strong>Approved Investor</strong> after the submit an AIQ form.</p>',
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);


piklist( 'field', array(
        'type' => 'select',
        'field' => 'existing_landing',
        'label' => 'Existing Investor Form Submitted',
        'description' => '<p>Where to send a <strong>User</strong> after they submit an Existing Investor form.</p>',        
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);

piklist( 'field', array(
        'type' => 'select',
        'field' => 'invest_landing',
        'label' => 'Invest in this Deal Submitted',
        'description' => '<p>Where to send an <strong>Approved Investor</strong> after they submit an Invest in this Deal form.</p>',        
        'choices' => piklist( 
            get_posts( 
                array(
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                ),
                'objects'
            ),
            array( 'ID', 'post_title' )
        ),
    )
);