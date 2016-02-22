<?php
/*
Title: Investor Tax Center
Capability: manage_options
Order: 10
Collapse: false
*/

  // Any field with the scope set to the field name of the upload field will be treated as related
  // data to the upload. Below we see we are setting the post_status and post_title, where the
  // post_status is pulled dynamically on page load, hence the current status of the content is
  // applied. Have fun! ;)
  //
  // NOTE: If the post_status of an attachment is anything but inherit or private it will NOT be
  // shown on the Media page in the admin, but it is in the database and can be found using query_posts
  // or get_posts or get_post etc....

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'investor_taxes'
    ,'add_more' => true
    ,'label' => 'Tax Documents'
    ,'description' => 'Add tax documents for the investor.  You can add as many as you want, and they can be drag-and-dropped into the order that you would like them to appear.'
    ,'fields'  => array(
      array(
        'type' => 'select'
        ,'field' => 'tax_year'
        ,'label' => 'Tax Year'
        ,'columns' => 3
        ,'value' => '2014'
        ,'choices' => array(
          '2012' => '2012'
          ,'2013' => '2013'
          ,'2014' => '2014'
          ,'2015' => '2015'
          ,'2016' => '2016'
          ,'2017' => '2017'
          ,'2018' => '2018'
        )
      )
      ,array(
          'type' => 'select',
          'field' => 'tax_investment',
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
      )
      ,array(
        'type' => 'text'
        ,'field' => 'tax_investment_entity'
        ,'label' => 'Investment Entity'
        ,'columns' => 3
      )
      ,array(
        'type' => 'text'
        ,'field' => 'tax_form'
        ,'label' => 'Tax Form'
        ,'columns' => 3
      )
      ,array(
        'type' => 'file'
        ,'field' => 'tax_document'
        ,'label' => 'Tax Document'
        ,'limit' => 1
        ,'columns' => 12
        ,'options' => array(
          'basic' => true
        )
      )
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));