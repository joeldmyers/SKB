<?php
/*
Title: Investments
Order: 30
Flow: User
Tab Order: 30
*/
   
  piklist('include_user_profile_fields', array(
    'meta_boxes' => array(
      'Investor Investments',
    )
  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Workflow Tab'
  ));

?>