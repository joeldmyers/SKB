<?php
/*
Title: Investor Investments
Capability: manage_options
Order: 10
Collapse: false
*/


piklist('field', array(
    'type' => 'group',
    'field' => 'investor_investments',
    'add_more' => true,
    'label' => 'Investments',
    'description' => 'Add investments for the investor to view on their dashboard.  You can add as many as you want, and they can be drag-and-dropped into the order that you would like them to appear.',
    'fields'  => array(
        array(
            'type' => 'select',
            'field' => 'investor_investment',
            'label' => 'Investment',
            'columns' => 3,
            'choices' => piklist( 
                get_posts( 
                    array(
                        'post_type' => 'investment',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'investment_category' => array( 'active', 'coming' ),
                    ),
                    'objects'
                ),
                array( 'ID', 'post_title' )
            )
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_entity',
            'label' => 'Investment Entity',
            'columns' => 3
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_type',
            'label' => 'Type',
            'columns' => 3
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_status',
            'label' => 'Status',
            'columns' => 3
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_original_capital',
            'label' => 'Original Capital',
            'columns' => 4
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_returned_capital',
            'label' => 'Returned Capital',
            'columns' => 4
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_transfer_adjustments',
            'label' => 'Transfer / Adjustments',
            'columns' => 4
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_current_capital',
            'label' => 'Current Capital',
            'columns' => 4
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_income_distributions',
            'label' => 'Income Distributions',
            'columns' => 4
        ),
        array(
            'type' => 'text',
            'field' => 'investor_investment_other_distributions',
            'label' => 'Other Distributions',
            'columns' => 4
        )
    )
));

piklist('shared/code-locater', array(
    'location' => __FILE__,
    'type' => 'Setting'
));
?>