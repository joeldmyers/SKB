<?php
/*
Title: Investor Overview
Capability: manage_options
Order: 10
*/

  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Totals'
    ,'description' => ''
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'current_capital'
        ,'label' => 'Current Capital'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,
      ),
      array(
        'type' => 'text'
        ,'field' => 'committed_capital'
        ,'label' => 'Committed Capital'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,        
      ),
      array(
        'type' => 'text'
        ,'field' => 'distributions'
        ,'label' => 'Distributions'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
    )));


  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Account Balance'
    ,'description' => ''
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'account_balance_capital_balance'
        ,'label' => 'Capital Balance'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_balance_bridge_loan'
        ,'label' => 'Bridge Loan'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,        
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_balance_reservations'
        ,'label' => 'Reservations'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),      
      array(
        'type' => 'text'
        ,'field' => 'account_balance_equity'
        ,'label' => 'Equity'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_balance_committed_capital'
        ,'label' => 'Committed Capital'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_balance_total_capital'
        ,'label' => 'Total Capital'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
    )));

  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Distributions'
    ,'description' => ''
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'distributions_bridge_loan'
        ,'label' => 'Bridge Loan'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,        
      ),
      array(
        'type' => 'text'
        ,'field' => 'distributions_interest'
        ,'label' => 'Interest'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),      
      array(
        'type' => 'text'
        ,'field' => 'distributions_equity'
        ,'label' => 'Equity'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
      array(
        'type' => 'text'
        ,'field' => 'distributions_distributions'
        ,'label' => 'Distributions'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
      array(
        'type' => 'text'
        ,'field' => 'distributions_total'
        ,'label' => 'Distributions Total'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
    )));

  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Account Activity'
    ,'description' => ''
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'account_activity_investments'
        ,'label' => 'Investments'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_activity_refunded'
        ,'label' => 'Refunded'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,        
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_activity_capital_returned'
        ,'label' => 'Capital Returned'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
      array(
        'type' => 'text'
        ,'field' => 'account_activity_total_distributions'
        ,'label' => 'Total Distributions'
        ,'value' => '0'
        ,'help' => 'Investor Dashboard Overview'
        ,'attributes' => array(
          'class' => 'regular-text'
        ),
        'columns' => 3,  
      ),
    )));


  piklist('shared/code-locater', array(
    'location' => __FILE__
    ,'type' => 'Meta Box'
  ));

?>