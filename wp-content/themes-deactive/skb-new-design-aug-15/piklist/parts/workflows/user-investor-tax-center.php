<?php
/*
Title: Tax Center
Order: 60
Flow: User
Tab Order: 60
*/
   
  piklist('include_user_profile_fields', array(
    'meta_boxes' => array(
      'Investor Tax Center',
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>