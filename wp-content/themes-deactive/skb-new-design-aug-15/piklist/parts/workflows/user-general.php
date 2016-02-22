<?php
/*
Title: General
Order: 10
Flow: User
Default: true
*/
  
  piklist('include_user_profile_fields', array(
    'meta_boxes' => array(
      'Name',
      'Mailing Address',
      'Contact Info',
      'About the user',
      'About Yourself',
      'Personal Options'
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>