<?php
/*
Title: Mailing Address
Capability: manage_options
Order: 20
*/

  piklist('field', array(
    'type' => 'group',
    'label' => 'Mailing Address',
    'description' => '',
    'fields' => array(
      array(
        'type' => 'text',
        'field' => 'address_1',
        'label' => 'Street Address',
        'columns' => 12
      ),
      array(
        'type' => 'text',
        'field' => 'address_2',
        'label' => 'PO Box, Suite, etc.',
        'columns' => 12
      ),
      array(
        'type' => 'text',
        'field' => 'city',
        'label' => 'City',
        'columns' => 3
      ),
      array(
        'type' => 'select',
        'field' => 'state',
        'label' => 'State',
        'columns' => 3,
        'choices' => array(
          'AL' => 'Alabama',
          'AK' => 'Alaska',
          'AZ' => 'Arizona',
          'AR' => 'Arkansas',
          'CA' => 'California',
          'CO' => 'Colorado',
          'CT' => 'Connecticut',
          'DE' => 'Delaware',
          'DC' => 'District Of Columbia',
          'FL' => 'Florida',
          'GA' => 'Georgia',
          'HI' => 'Hawaii',
          'ID' => 'Idaho',
          'IL' => 'Illinois',
          'IN' => 'Indiana',
          'IA' => 'Iowa',
          'KS' => 'Kansas',
          'KY' => 'Kentucky',
          'LA' => 'Louisiana',
          'ME' => 'Maine',
          'MD' => 'Maryland',
          'MA' => 'Massachusetts',
          'MI' => 'Michigan',
          'MN' => 'Minnesota',
          'MS' => 'Mississippi',
          'MO' => 'Missouri',
          'MT' => 'Montana',
          'NE' => 'Nebraska',
          'NV' => 'Nevada',
          'NH' => 'New Hampshire',
          'NJ' => 'New Jersey',
          'NM' => 'New Mexico',
          'NY' => 'New York',
          'NC' => 'North Carolina',
          'ND' => 'North Dakota',
          'OH' => 'Ohio',
          'OK' => 'Oklahoma',
          'OR' => 'Oregon',
          'PA' => 'Pennsylvania',
          'RI' => 'Rhode Island',
          'SC' => 'South Carolina',
          'SD' => 'South Dakota',
          'TN' => 'Tennessee',
          'TX' => 'Texas',
          'UT' => 'Utah',
          'VT' => 'Vermont',
          'VA' => 'Virginia',
          'WA' => 'Washington',
          'WV' => 'West Virginia',
          'WI' => 'Wisconsin',
          'WY' => 'Wyoming'
        )
      ),
      array(
        'type' => 'text',
        'field' => 'postal_code',
        'label' => 'Postal Code',
        'columns' => 3
      ),
      array(
        'type' => 'text',
        'field' => 'phone',
        'label' => 'Phone',
        'columns' => 3
      )
    )

  ));

  piklist('shared/code-locater', array(
    'location' => __FILE__,
    'type' => 'Meta Box'
  ));

?>