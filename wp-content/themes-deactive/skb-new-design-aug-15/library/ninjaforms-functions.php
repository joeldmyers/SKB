<?php
// Ninja Forms 

//  1 - Contact
//  2 - Individual
//  3 - Invest in this Deal 
//  4 - Trust 
//  5 - *Deleted
//  6 - Joint Tenants 
//  7 - Tenants in Common 
//  8 - Community Property 
//  9 - Individual Retirement Account 
// 10 - *Deleted
// 11 - Limited Partnership
// 12 - Limited Liability Corporation 
// 13 - *Deleted
// 14 - Corporation
// 15 - Existing Investor 

// 42 - Investor Verification


add_action( 'wp_head', 'skb_move_ninja_forms_messages' );
add_action( 'init', 'skb_ninja_forms_check' );
add_action( 'init', 'skb_ninja_forms_submitted' );
add_action( 'init', 'skb_ninja_forms_processing' );
add_action( 'init', 'skb_ninja_forms_completed' );

<<<<<<< HEAD

=======
>>>>>>> master
add_action( 'wp_ajax_skb_entity_state_change', 'skb_entity_state_change' );
add_action( 'wp_ajax_nopriv_skb_entity_state_change', 'skb_entity_state_change' );

add_action( 'ninja_forms_display_js', 'skb_entity_listener', 10, 1 );

add_filter( 'ninja_forms_submission_pdf_name', 'skb_pdf_name', 20, 2 );

add_filter( 'ninja_forms_field', 'adjust_ninja_forms_field', 15, 2 );
add_filter( 'ninja_forms_field_wrap_class', 'add_custom_ninja_forms_field_wrap_class', 10, 2 );

add_action( 'ninja_forms_display_before_field', 'insert_ninja_forms_display_before_field', 10, 2 );
add_action( 'ninja_forms_display_after_field', 'insert_ninja_forms_display_after_field', 10, 2 );

//add_action( 'ninja_forms_display_after_fields', 'skb_add_entity_id' );

//function skb_add_entity_id() {
   // echo '<input type="hidden" name="_investment_entity_id" value="">';
//}
function skb_entity_listener($form_id) {
    wp_enqueue_script( 'my-new-js', get_template_directory_uri() . '/library/js/skb-entity-listener.js' );
}

/*
 * used for data collection and exchange with ajax
 * see skb-entity-listener.js
 */
function skb_entity_state_change() {
    
    // exit if our page data doesn't exist
    if (!isset($_POST['investment_page'])) {
        return;
    }    
    $investment_page = $_POST['investment_page'];
        
    // default success to false
    $success = false;
    
    switch($investment_page):
        
        /* first page of invest in deal form
         * listens to the Entity Type dropdown on the first page of 
         * the Invest in this Deal form. Used by ajax to collect
         * entity data such as id and name later in the multi-part form */        
        case '1': 
            
            $entity_id = $_POST['entity_id'];
            
            $investment_meta = get_post_meta( $entity_id );
            $entity_name = get_the_title($entity_id);
            
            // if these files have been uploaded by this entity previously then
            // send them to ajax to hide them
            
            // LLC Managing Member ID
            if (isset($investment_meta['ninja_forms_field_2440']) && $investment_meta['ninja_forms_field_2440'][0] != '') {
                //$investment_meta['ninja_forms_field_2440'] = array();
                $investment_meta['ninja_forms_field_2440_uploaded'] = array('uploaded');
            }
            // LLC Company Agreements and Amendments
            if (isset($investment_meta['ninja_forms_field_2442']) && $investment_meta['ninja_forms_field_2442'][0] != '') {
              // $investment_meta['ninja_forms_field_2442'] = array();
                $investment_meta['ninja_forms_field_2442_uploaded'] = array('uploaded');
            }
            // trust
          // var_dump($investment_meta['ninja_forms_field_2560']);
            if (isset($investment_meta['ninja_forms_field_2560']) && $investment_meta['ninja_forms_field_2560'][0] != '') {
              // $investment_meta['ninja_forms_field_2442'] = array();
                $investment_meta['ninja_forms_field_2560_uploaded'] = array('uploaded');
            }
            
            // joint tenants
            if (isset($investment_meta['ninja_forms_field_2296']) && $investment_meta['ninja_forms_field_2296'][0] != '') {
              // $investment_meta['ninja_forms_field_2442'] = array();
                $investment_meta['ninja_forms_field_2296_uploaded'] = array('uploaded');
            }
            if (isset($investment_meta['ninja_forms_field_2298']) && $investment_meta['ninja_forms_field_2298'][0] != '') {
              // $investment_meta['ninja_forms_field_2442'] = array();
                $investment_meta['ninja_forms_field_2298_uploaded'] = array('uploaded');
            }
            
            // tenants in common
            if (isset($investment_meta['ninja_forms_field_2531']) && $investment_meta['ninja_forms_field_2531'][0] != '') {
                $investment_meta['ninja_forms_field_2531_uploaded'] = array('uploaded');
            }
            if (isset($investment_meta['ninja_forms_field_2529']) && $investment_meta['ninja_forms_field_2529'][0] != '') {
                $investment_meta['ninja_forms_field_2529_uploaded'] = array('uploaded');
            }
            
            // community
            if (isset($investment_meta['ninja_forms_field_2343']) && $investment_meta['ninja_forms_field_2343'][0] != '') {
                $investment_meta['ninja_forms_field_2343_uploaded'] = array('uploaded');
            }
            if (isset($investment_meta['ninja_forms_field_2345']) && $investment_meta['ninja_forms_field_2345'][0] != '') {
                $investment_meta['ninja_forms_field_2345_uploaded'] = array('uploaded');
            }
            
            // limited partnership
            if (isset($investment_meta['ninja_forms_field_2411']) && $investment_meta['ninja_forms_field_2411'][0] != '') {
                $investment_meta['ninja_forms_field_2411_uploaded'] = array('uploaded');
            }
            if (isset($investment_meta['ninja_forms_field_2413']) && $investment_meta['ninja_forms_field_2413'][0] != '') {
                $investment_meta['ninja_forms_field_2413_uploaded'] = array('uploaded');
            }
            
            // corporation
            if (isset($investment_meta['ninja_forms_field_2470']) && $investment_meta['ninja_forms_field_2470'][0] != '') {
                $investment_meta['ninja_forms_field_2470_uploaded'] = array('uploaded');
            }
            if (isset($investment_meta['ninja_forms_field_2472']) && $investment_meta['ninja_forms_field_2472'][0] != '') {
                $investment_meta['ninja_forms_field_2472_uploaded'] = array('uploaded');
            }
            
            // IRA
            if (isset($investment_meta['ninja_forms_field_2384']) && $investment_meta['ninja_forms_field_2384'][0] != '') {
                $investment_meta['ninja_forms_field_2384_uploaded'] = array('uploaded');
            }
            
            
            
          //  var_dump($investment_meta['investment_form_field_2440']);//die();
            
                        
       /**     $investment_amount = 
                    isset($investment_meta['investment_form_field_2301']) ?
                    $investment_meta['investment_form_field_2301'] :
                    '';
            $source_of_funds = 
                    isset($investment_meta['investment_form_field_2221']) ?
                    $investment_meta['investment_form_field_2221'] :
                    '';
            $name_of_bank = 
                    isset($investment_meta['investment_form_field_2222']) ?
                    $investment_meta['investment_form_field_2222'] : 
                    '';
            $address_of_bank = 
                    isset($investment_meta['investment_form_field_2223']) ?
                    $investment_meta['investment_form_field_2223'] : 
                    '';
            $aba_routing_num = 
                    isset($investment_meta['investment_form_field_2224']) ?
                    $investment_meta['investment_form_field_2224'] : 
                    '';
            $account_num = 
                    isset($investment_meta['investment_form_field_2225']) ?
                    $investment_meta['investment_form_field_2225'] : 
                    ''; 
      
            $user = wp_get_current_user();
             
            $user_meta = get_user_meta($user->ID);
            // @TODO check if $user->value exists before getting user_meta['value']
            $first_name = $user_meta['first_name'];
            $last_name =  $user_meta['last_name'];
            $address_1 = $user_meta['address_1'];
            $address_2 = $user_meta['address_2'];
            $city = $user_meta['city'];
            $state = $user_meta['state'];
            $zip = $user_meta['postal_code'];
            $phone = $user_meta['phone'];
            $email = $user->user_email;
           $address_2 = $user_meta['address_2'];
            
            $investment_meta[] = array( 'entity_id' => $entity_id );
            
            /* autofill first names 
            $investment_meta['ninja_forms_field_2231'] = $first_name;
            
            /* autofill last names 
            $investment_meta['ninja_forms_field_2233'] = $last_name;
            
            /* autofill address_1 
            $investment_meta['ninja_forms_field_2234'] = $address_1;
            
            /* autofill address_2 
            $investment_meta['ninja_forms_field_2235'] = $address_2;
            
            /* autofill city 
            $investment_meta['ninja_forms_field_2236'] = $city;
            
            /* autofill address_1 
            $investment_meta['ninja_forms_field_2237'] = $state;
            
            /* autofill address_1 
            $investment_meta['ninja_forms_field_2238'] = $zip;
            
            /* autofill address_1 
            $investment_meta['ninja_forms_field_2240'] = $phone;
            
            /* autofill address_1 
            $investment_meta['ninja_forms_field_2239'] = $email;
              */
            echo json_encode( $investment_meta );/*
                        'ninja_forms_field_2221' => $investment_amount,
                        'source_of_funds' => $source_of_funds,
                        'name_of_bank' => $name_of_bank,
                        'address_of_bank' => $address_of_bank,
                        'aba_routing_num' => $aba_routing_num,
                        'account_num' => $account_num,
                        'entity_name' => array($entity_name),
                        'entity_id' => $entity_id
                    )
            );*/
            
            $success = true;
            
            break;
        
        /* second page of invest in deal form
         * used to pre-populate fields
         * listens on keydown and uses ajax to
         * record values to post entity meta data
         */
        case '2': 
            
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            
            if( isset($post_meta) ) {
                
                $investment_amount = sanitize_text_field($_POST['investment_amount']);
                $source_of_funds = sanitize_text_field($_POST['source_of_funds']);
                $name_of_bank = sanitize_text_field($_POST['name_of_bank']);
                $address_of_bank = sanitize_text_field($_POST['address_of_bank']);
                $aba_routing_num = sanitize_text_field($_POST['aba_routing_num']);
                $account_num = sanitize_text_field($_POST['account_num']);
                
                //@TODO update user's meta data as well
                update_post_meta($entity_id, 'ninja_forms_field_2301', $investment_amount);
                update_post_meta($entity_id, 'ninja_forms_field_2221', $source_of_funds);
                update_post_meta($entity_id, 'ninja_forms_field_2222', $name_of_bank);
                update_post_meta($entity_id, 'ninja_forms_field_2223', $address_of_bank);
                update_post_meta($entity_id, 'ninja_forms_field_2224', $aba_routing_num);
                update_post_meta($entity_id, 'ninja_forms_field_2225', $account_num);
                
                $post_meta = get_post_meta($_POST['entity_id']);
                
                    echo json_encode($post_meta);
                
                }
                
            $success  = true;
            break;
            
            
            // Individual entity type
        case '3':
            
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name = sanitize_text_field($_POST['last_name']);
            $address_1 = sanitize_text_field($_POST['address_1']);
            $address_2 = sanitize_text_field($_POST['address_2']);
            $city = sanitize_text_field($_POST['city']);
            $state = sanitize_text_field($_POST['state']);
            $zip = sanitize_text_field($_POST['zip']);
            $email = sanitize_text_field($_POST['email']);
            $phone = sanitize_text_field($_POST['phone']);
            $ssn = sanitize_text_field($_POST['ssn']);
            $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
            $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
         //   $upload_id = sanitize_text_field($_POST['upload_id']);


            if (empty($first_name)) {
                $first_name = $user->user_firstname;
            }
            if (empty($last_name)) {
                $last_name = $user->user_lastname;
            }
            if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
            }
            
            update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2272', $upload_id);
            
            break;
            // Trust entity type
        case '4':
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
           // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $trustee_id = sanitize_file_name($_POST['trustee_id']);
//var_dump($trustee_id);

           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
           // }
          //  if (empty($last_name)) {
           //     $last_name = $user->user_lastname;
          //  }
           // if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
           // }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2560', $trustee_id);
            
            echo json_encode( $entity_id );
            
            break;
            // Joint Tenants entity type
        case '5':
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $joint_tenant_id_1 = sanitize_file_name($_POST['joint_tenant_id_one']);
              $joint_tenant_id_2 = sanitize_file_name($_POST['joint_tenant_id_two']);


           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
          //  }
          //  if (empty($last_name)) {
          //      $last_name = $user->user_lastname;
          //  }
          //  if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
          //  }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2296', $joint_tenant_id_1);
            update_post_meta($entity_id, 'ninja_forms_field_2298', $joint_tenant_id_2);
            
            break;
            // Tenants in Common entity type
        case '6':
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $joint_tenant_id_one = sanitize_file_name($_POST['joint_tenant_id_one']);
              $joint_tenant_id_two = sanitize_file_name($_POST['joint_tenant_id_two']);


           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
          //  }
          //  if (empty($last_name)) {
          //      $last_name = $user->user_lastname;
          //  }
          //  if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
          //  }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2531', $joint_tenant_id_one);
            update_post_meta($entity_id, 'ninja_forms_field_2529', $joint_tenant_id_two);
            
            break;
            // Community entity type
        case '7':
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $community_id_one = sanitize_file_name($_POST['community_id_one']);
              $community_id_two = sanitize_file_name($_POST['community_id_two']);


           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
          //  }
          //  if (empty($last_name)) {
          //      $last_name = $user->user_lastname;
          //  }
          //  if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
          //  }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2343', $community_id_one);
            update_post_meta($entity_id, 'ninja_forms_field_2345', $community_id_two);
            
            break;
            // Limited Partnership entity type
        case '8':
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $lp_id_one = sanitize_file_name($_POST['lp_id_one']);
              $lp_id_two = sanitize_file_name($_POST['lp_id_two']);


           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
          //  }
          //  if (empty($last_name)) {
          //      $last_name = $user->user_lastname;
          //  }
          //  if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
          //  }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2411', $lp_id_one);
            update_post_meta($entity_id, 'ninja_forms_field_2413', $lp_id_two);
            
            
            break;
            // Limited Liability Company entity type
        case '9':
            
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name = sanitize_text_field($_POST['last_name']);
            $address_1 = sanitize_text_field($_POST['address_1']);
            $address_2 = sanitize_text_field($_POST['address_2']);
            $city = sanitize_text_field($_POST['city']);
            $state = sanitize_text_field($_POST['state']);
            $zip = sanitize_text_field($_POST['zip']);
            $email = sanitize_text_field($_POST['email']);
            $phone = sanitize_text_field($_POST['phone']);
            $ssn = sanitize_text_field($_POST['ssn']);
            
            
            $llc_name = sanitize_text_field($_POST['llc_name']);
            $tax_id_number = sanitize_text_field($_POST['tax_id_number']);
            $managing_mem_name = sanitize_text_field($_POST['managing_mem_name']);
            $managing_mem_email = sanitize_text_field($_POST['managing_mem_email']);
            $managing_mem_phone = sanitize_text_field($_POST['managing_mem_phone']);
            $managing_mem_ssn = sanitize_text_field($_POST['managing_mem_ssn']);
            $check_add_contact_info = sanitize_text_field($_POST['check_add_contact_info']);
            $list_add_contact_info = sanitize_text_field($_POST['list_add_contact_info']);
            $managing_mem_id_upload = sanitize_file_name($_POST['managing_mem_id_upload']);
            $llc_operating_agreement_upload = sanitize_file_name($_POST['llc_operating_agreement_upload']);

            if (empty($first_name)) {
                $first_name = $user->user_firstname;
            }
            if (empty($last_name)) {
                $last_name = $user->user_lastname;
            }
            if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
            }
            
            update_post_meta($entity_id, 'ninja_forms_field_2416', $first_name);
            update_post_meta($entity_id, 'ninja_forms_field_2417', $last_name);
            update_post_meta($entity_id, 'ninja_forms_field_2418', $address_1);
            update_post_meta($entity_id, 'ninja_forms_field_2419', $address_2);
            update_post_meta($entity_id, 'ninja_forms_field_2420', $city);
            update_post_meta($entity_id, 'ninja_forms_field_2421', $state);
            update_post_meta($entity_id, 'ninja_forms_field_2422', $zip);
            update_post_meta($entity_id, 'ninja_forms_field_2423', $email);
            update_post_meta($entity_id, 'ninja_forms_field_2424', $phone);
            update_post_meta($entity_id, 'ninja_forms_field_2425', $ssn);
            
            update_post_meta($entity_id, 'ninja_forms_field_2427', $llc_name);
            update_post_meta($entity_id, 'ninja_forms_field_2428', $tax_id_number);
            update_post_meta($entity_id, 'ninja_forms_field_2429', $managing_mem_name);
            update_post_meta($entity_id, 'ninja_forms_field_2430', $managing_mem_email);
            update_post_meta($entity_id, 'ninja_forms_field_2431', $managing_mem_phone);
            update_post_meta($entity_id, 'ninja_forms_field_2432', $managing_mem_ssn);
            update_post_meta($entity_id, 'ninja_forms_field_2433', $check_add_contact_info);
            update_post_meta($entity_id, 'ninja_forms_field_2434', $list_add_contact_info);
            update_post_meta($entity_id, 'ninja_forms_field_2440', $managing_mem_id_upload);
            update_post_meta($entity_id, 'ninja_forms_field_2442', $llc_operating_agreement_upload);     
            
            echo json_encode( $entity_id );
            
            break;
            // Corporation entity type
        case '10':
            $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $corp_id_one = sanitize_file_name($_POST['corp_id_one']);
              $corp_id_two = sanitize_file_name($_POST['corp_id_two']);


           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
          //  }
          //  if (empty($last_name)) {
          //      $last_name = $user->user_lastname;
          //  }
          //  if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
          //  }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2470', $corp_id_one);
            update_post_meta($entity_id, 'ninja_forms_field_2472', $corp_id_two);
            
            break;
            // Individual Retirement Account entity type
        case '11':
           $entity_id = $_POST['entity_id'];
            $post_meta = get_post_meta($_POST['entity_id']);
            $user = wp_get_current_user();
            
            // $first_name = sanitize_text_field($_POST['first_name']);
           // $last_name = sanitize_text_field($_POST['last_name']);
           // $address_1 = sanitize_text_field($_POST['address_1']);
           // $address_2 = sanitize_text_field($_POST['address_2']);
           // $city = sanitize_text_field($_POST['city']);
           // $state = sanitize_text_field($_POST['state']);
           // $zip = sanitize_text_field($_POST['zip']);
           // $email = sanitize_text_field($_POST['email']);
           // $phone = sanitize_text_field($_POST['phone']);
           // $ssn = sanitize_text_field($_POST['ssn']);
           // $add_contact_info = sanitize_text_field($_POST['add_contact_info']);
           // $add_contact_info_val = sanitize_text_field($_POST['add_contact_info_val']);
              $ira_id = sanitize_file_name($_POST['ira_id']);


           // if (empty($first_name)) {
           //     $first_name = $user->user_firstname;
          //  }
          //  if (empty($last_name)) {
          //      $last_name = $user->user_lastname;
          //  }
          //  if (empty($address_1)) {
               // $address_1 = $user->user_address_1;
          //  }
            
            //update_post_meta($entity_id, 'ninja_forms_field_2253', $first_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2254', $last_name);
            //update_post_meta($entity_id, 'ninja_forms_field_2255', $address_1);
            //update_post_meta($entity_id, 'ninja_forms_field_2256', $address_2);
            //update_post_meta($entity_id, 'ninja_forms_field_2257', $city);
            //update_post_meta($entity_id, 'ninja_forms_field_2258', $state);
            //update_post_meta($entity_id, 'ninja_forms_field_2259', $zip);
            //update_post_meta($entity_id, 'ninja_forms_field_2260', $email);
            //update_post_meta($entity_id, 'ninja_forms_field_2261', $phone);
            //update_post_meta($entity_id, 'ninja_forms_field_2262', $ssn);
            //update_post_meta($entity_id, 'ninja_forms_field_2263', $add_contact_info);
            //update_post_meta($entity_id, 'ninja_forms_field_2266', $add_contact_info_val);
            
            
            update_post_meta($entity_id, 'ninja_forms_field_2384', $ira_id);
            
            break;
        default:
            break;
    endswitch;
    
    /***** do not remove ****/
    /*******/ wp_die(); /****/
    /************************/
    
    if( $success ) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
    
}

// Move responses down to after the form so user can easily see them when submitting
function skb_move_ninja_forms_messages() {

    remove_action( 'ninja_forms_display_before_form', 'ninja_forms_display_response_message', 10 );
    add_action( 'ninja_forms_display_after_form', 'ninja_forms_display_response_message', 10 );

}

// Check user/form access
function skb_ninja_forms_check() {

	//add_action( 'ninja_forms_display_pre_init', 'skb_form_check' );

}

// Form submitted, handle data
function skb_ninja_forms_submitted() {

	add_action( 'ninja_forms_pre_process', 'skb_form_submitted' );

}

function skb_ninja_forms_processing() {
    add_action ('ninja_forms_process', 'skb_form_processing' );
}

function skb_ninja_forms_completed() {

	add_action( 'ninja_forms_post_process', 'skb_form_completed' );

}

function skb_form_processing() {
   // global $ninja_forms_processing;
   // echo '<pre>';var_dump($ninja_forms_processing);echo '</pre>';die();
}


function skb_form_check() {

	global $ninja_forms_loading;
        
        //var_dump($ninja_forms_loading);
        
       // if (is_array($current_form_id)){
            $current_form_id = $ninja_forms_loading->get_form_ID();
       // } else {
       //     $current_form_id = 0;
       // }
	//$current_form_id = '2';
//var_dump($current_form_id);
	// Check the current form to see if we need to limit the user from filling out this form again
        // @TODO not sure if this is needed
	switch ( $current_form_id ) {

		case '2': // Individual
		case '6': // Joint Tenants
		case '7': // Tenants in Common
		case '8': // Community Property

			// Multiple submissions are not allowed	
			break;

		case '4':  // Trust
		case '9':  // IRA 
		case '11': // Limited Partnership 
		case '12': // LLC 
		case '14': // Corporation 
		default:

			// Multiple submissions are allowed or not an AIQ form
			return;

	}

	$user_id = get_current_user_id();

	$args = array(
		'user_id'   => $user_id,
	);
	
	$subs = Ninja_Forms()->subs()->get( $args );

	foreach ( $subs as $sub ) {

		$form_id = $sub->form_id;

		switch ( $form_id ) {

			case '2': // Individual
			case '6': // Joint Tenants
			case '7': // Tenants in Common
			case '8': // Community Property
				// Multiple submissions are not allowed	
				//$ninja_forms_processing->add_error( 'skb_duplicate', 'Multiple submissions of this form are not allowed.' );
				break;

			default:
				// not an AIQ form;
				break;

		}

	}

}


function skb_form_submitted() {

	global $ninja_forms_processing;
       // var_dump($ninja_forms_processing->data['action']);
       // var_dump($ninja_forms_processing);die();
        //$all_fields = $ninja_forms_processing->get_all_fields();
	$form_id = $ninja_forms_processing->get_form_ID();
        
	switch ($form_id) {

		case 2:
write_log($ninja_forms_processing->get_all_errors());
			// Individual
                        $entity_type = 'individual';
                        

			$user_id = get_current_user_id();
			$user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user_id ) );
	
			$first_name = $ninja_forms_processing->get_field_value( 18 );
			$last_name = $ninja_forms_processing->get_field_value( 17 );
			//$phone = $ninja_forms_processing->get_field_value( 26 );
			//$address_1 = $ninja_forms_processing->get_field_value( 19 );
			//$address_2 =  $ninja_forms_processing->get_field_value( 20 );
			//$city = $ninja_forms_processing->get_field_value( 22 );
			//$state = $ninja_forms_processing->get_field_value( 24 );
			//$postal_code = $ninja_forms_processing->get_field_value( 21 );
			//$country = $ninja_forms_processing->get_field_value( 23 );
			//$dob = $ninja_forms_processing->get_field_value( 1021 );
                        
                        $entity_name = $first_name . ' ' . $last_name . ' - Individual';
                        
                        
			//update_user_meta( $user_id, 'first_name', $first_name, $user_meta['first_name'] );
			//update_user_meta( $user_id, 'last_name', $last_name, $user_meta['last_name'] );
			//update_user_meta( $user_id, 'phone', $phone, $user_meta['phone'] );
			//update_user_meta( $user_id, 'address_1', $address_1, $user_meta['address_1'] );
			//update_user_meta( $user_id, 'address_2', $address_2, $user_meta['address_2'] );
			//update_user_meta( $user_id, 'city', $city, $user_meta['city'] );
			//update_user_meta( $user_id, 'state', $state, $user_meta['state'] );
			//update_user_meta( $user_id, 'postal_code', $postal_code, $user_meta['postal_code'] );
			//update_user_meta( $user_id, 'country', $country, $user_meta['country'] );
			//update_user_meta( $user_id, 'dob', $dob, $user_meta['dob'] );
			break;
                case 4:
                        $entity_type = 'trust';
                        $entity_name = $ninja_forms_processing->get_field_value(157);
                        break;
                case 6: 
                        $entity_type = 'tenants-joint';
                        $first_name = $ninja_forms_processing->get_field_value( 178 );
                        $last_name = $ninja_forms_processing->get_field_value( 179 );

                        $entity_name = $first_name . ' ' . $last_name;

                        if ($ninja_forms_processing->get_field_value( 1210)){
                            $entity_name .= ' & ' . $ninja_forms_processing->get_field_value( 1210);
                        } 
                        if ($ninja_forms_processing->get_field_value( 1211)){
                            $entity_name .= ' ' . $ninja_forms_processing->get_field_value( 1211);
                        } 
                        $entity_name .= ' - Joint Tenants';
                    break;
                case 7: $entity_type = 'tenants-common';
                        $first_name = $ninja_forms_processing->get_field_value( 242 );
                        $last_name = $ninja_forms_processing->get_field_value( 243 );

                        $entity_name = $first_name . ' ' . $last_name;

                        if ($ninja_forms_processing->get_field_value( 1229 )){
                            $entity_name .= ' & ' . $ninja_forms_processing->get_field_value( 1229 );
                        } 
                        if ($ninja_forms_processing->get_field_value( 1231 )){
                            $entity_name .= ' ' . $ninja_forms_processing->get_field_value( 1231 );
                        } 
                        $entity_name .= ' - Tenants In Common';
                        break;
                case 8: $entity_type = 'community';
                        $first_name = $ninja_forms_processing->get_field_value( 306 );
                        $last_name = $ninja_forms_processing->get_field_value( 307 );

                        $entity_name = $first_name . ' ' . $last_name;

                        if ($ninja_forms_processing->get_field_value( 1254)){
                            $entity_name .= ' & ' . $ninja_forms_processing->get_field_value( 1254);
                        } 
                        if ($ninja_forms_processing->get_field_value( 1255)){
                            $entity_name .= ' ' . $ninja_forms_processing->get_field_value( 1255);
                        } 
                        $entity_name .= ' - Community';
                       // $entity_name = $ninja_forms_processing->get_field_value(2160);
                        break;
                case 9: $entity_type = 'ira';
                        $entity_name = $ninja_forms_processing->get_field_value(375) . ' - Individual Retirement Account';
                        break;
                case 11: $entity_type = 'lp';
                        $entity_name = $ninja_forms_processing->get_field_value(508) . ' - Limited Partnership';
                        break;
                case 12: $entity_type = 'llc';
                        $entity_name = $ninja_forms_processing->get_field_value(589) . ' - Limited Liability Company';
                        break;
                case 14: $entity_type = 'corporation';
                        $entity_name = $ninja_forms_processing->get_field_value(747) . ' - Corporation';
                        break;
		case 42:

			// We've got an Investor Verification Being Uploaded
			$user_id = get_current_user_id();
			update_user_meta( $user_id, 'user_verification', date( 'Y-m-d H:i:s', time() ) );
			break;
                
                // Invest in This Deal form
                case 55:
                    
                    if ($ninja_forms_processing->data['action'] == 'submit' ) {
<<<<<<< HEAD
                        
                    //    $ninja_forms_processing->data['deal_id'] = $deal_id;
=======
>>>>>>> master
                       
                        
                        $form = $ninja_forms_processing->data['form'];
                        $fields = $ninja_forms_processing->get_all_fields();
                        
<<<<<<< HEAD
                        // create new investment_deal post
                        $account_num = substr($fields['2225'], -4);
                        $randomString = substr(str_shuffle("0123456789"), 0, 8);
                        
=======
                   //     if (isset($fields['2498'])) {
                     //       foreach ($fields['2498'] as $field) {
                      //          update_post_meta($post_entity, 'ninja_forms_field_2498', $field['file_url']);
                         //   write_log($field['file_url']);
                    //        }
                  //      }
                        
          //  write_log($fields);
           // die();
            
                        // create new investment_deal post
                        $account_num = substr($fields['2225'], -4);
                        $randomString = substr(str_shuffle("0123456789"), 0, 8);
>>>>>>> master
                        $args = array(
                          'post_title' => 'Investment '.$randomString.'-'.$account_num,
                          'post_type' => 'investment_deal',
                          'post_status' => 'pending',
                        );
<<<<<<< HEAD
                        
                        $deal_id = wp_insert_post($args);
                       // var_dump($deal_id);
                      //  $deal_id = $post_entity->ID;
                        // get the current user
                        $user = wp_get_current_user();
                        
                        $offering_id = $_GET['deal_id'];
                        //$ninja_forms_processing->update_form_setting( 'deal_id', $deal_id );
                        
=======
                        $post_entity = wp_insert_post($args);
                        
                        // get the current user
                        $user = wp_get_current_user();
                        $deal_id = $_GET['deal_id'];
>>>>>>> master
                       // var_dump($deal_id);die();
                        // @TODO get proper fields depending on entity type
                        // this meta is already updated in ajax
                        
                        
                        
<<<<<<< HEAD
                        update_post_meta($deal_id, 'investment_deal_user', $user->ID );
                        update_post_meta($deal_id, 'investment_deal_amount', $fields['2301'] );
                        update_post_meta($deal_id, 'investment_deal_entity', $fields['2475'] );
                        update_post_meta($deal_id, 'investment_offering_id', $offering_id );
                       // update_post_meta($post_entity, 'investment_deal_id', $deal_id );
                        //$theme_settings = get_option('skb_theme_settings');
                       // wp_redirect( get_permalink( $theme_settings['existing_landing'] ) );
                        //exit;
                    } 
                    
                   // return;
                    $ninja_forms_processing->update_form_setting( 'deal_id', $deal_id );
                    break;
                    
                case 57:
                  //  $deal_id = $_GET['deal_id'];
                  //  
                    
                    $entity_name = 'test';
=======
                        update_post_meta($post_entity, 'investment_deal_user', $user->ID );
                        update_post_meta($post_entity, 'investment_deal_amount', $fields['2301'] );
                        update_post_meta($post_entity, 'investment_deal_entity', $fields['2475'] );
                        update_post_meta($post_entity, 'investment_offering_id', $deal_id );
                        //$theme_settings = get_option('skb_theme_settings');
                       // wp_redirect( get_permalink( $theme_settings['existing_landing'] ) );
                        //exit;
                    }
                    
                   // return;
                    
>>>>>>> master
                    break;

		default:
			break;
	
	}
        // save deal
        
        
        // save entity
        // @TODO check if validation error? to keep from submitting multiple times
        if ($ninja_forms_processing->data['action'] == 'submit' ) {
            // not sure if this is needed
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
                return $post_id;
            }
               $user = wp_get_current_user();
           // $user = get_current_user();
            
            // set getting to know you cooldown
             if ( get_post_meta($user->ID, 'getting_to_know_you', true) == ''  ) {
                 update_post_meta($user->ID, 'getting_to_know_you', time() );
             }
            
             //var_dump($_POST);die();
            //$entity_name = 'test';
            // should be array list of entity forms?
<<<<<<< HEAD
            if($form_id != 55 && $form_id != 57) {
=======
            if($form_id != 55) {
>>>>>>> master
                $args = array(
                     'post_type' => 'investment_entity',
                     'post_title' => $entity_name,
                     'post_status' => 'draft',
                 );

                 $post_entity = wp_insert_post($args);

              

                 //wp_reset_postdata();     
                 if (isset($_POST['_wpnonce'])) {
                    if(isset($post_entity)) {
                       update_post_meta( $post_entity, 'investment_entity_type', $entity_type );
                       update_post_meta( $post_entity, 'investment_entity_user_name', $user->user_login );
                       update_post_meta( $post_entity, 'investment_entity_user_id', $user->ID );
                    }
                 }
            }
        }
}


function skb_form_completed() {
   // write_log('beginning completed');

	global $ninja_forms_processing;
        
      //  echo '<pre>';var_dump($ninja_forms_processing);echo '</pre>';die();
        $deal_id = $ninja_forms_processing->get_form_setting( 'deal_id' );   
	$form_id = $ninja_forms_processing->get_form_ID();
<<<<<<< HEAD
        $sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );        
      //  $deal_id = $ninja_forms_processing->get_form_setting( 'deal_id' );
        
        
   //     echo '<pre>';var_dump($ninja_forms_processing->data);die();echo '</pre>';
	$skb_forms = array( 2, 3, 4, 6, 7, 8, 9, 11, 12, 14, 15, 55, 57 );
=======
	$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );

	$skb_forms = array( 2, 3, 4, 6, 7, 8, 9, 11, 12, 14, 15, 55 );
>>>>>>> master
       // write_log('after skb_forms'); 
        //$all_fields = $ninja_forms_processing->get_all_fields();
  
                       

	if ( ! in_array( $form_id, $skb_forms , true ) || ! is_user_logged_in() ) {

		return;

	}
       //  write_log('after return');
        // this is where we need to add a new post
        // wp_insert_post (post type investment_entity
        /* if( is_array( $all_fields ) ){
             echo 'form id'.$form_id;
             switch( $form_id ) {
                 case 2:
                     $entity_type = 'Individual';
                     $entity_name = $all_fields[2162];
                     break;
                 case 4:
                     $entity_type = 'Trust';
                     $entity_name = $all_fields[2161];
                     break;
                 case 7:
                     $entity_type = 'Tenants in Common';
                     $entity_name = $all_fields[2163];
                     break;
                 
                 default: 
                     $entity_type = 'error';
                     $entity_name = '';
                     break;
             }
             
             $args = array(
                 'post_type' => 'investment_entity',
                 'post_title' => $entity_name,
                 'post_status' => 'pending',
                 ''
             );
             
             $post_entity = wp_insert_post($args);
             
             $user = wp_get_current_user();
             
             print_r($post_entity);
             
             update_post_meta( $post_entity, 'investment_entity_type', $entity_type );
             update_post_meta( $post_entity, 'investment_entity_user_name', $user->user_login );
           //  echo '<pre>';var_dump($all_fields);echo '</pre>';
             //die();
         }*/

	$theme_settings = get_option('skb_theme_settings');

	$from_name = $theme_settings['skb_from_name'];
	$from_email = $theme_settings['skb_from_email'];

	$user_id = get_current_user_id();
       //  write_log('after_user_id');
        // @todo why different methods below?
	$user_info = get_userdata( $user_id );
	$user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user_id ) );

	$to_name = $user_meta['first_name'] . ' ' . $user_meta['last_name'];
	$to_email = $user_info->user_email;

	$headers = 'From: ' . $from_name . ' <' . $from_email . '>' . PHP_EOL;	
	$to = $to_name . ' <' . $to_email . '>';
//write_log('form id '.$form_id);
	switch ($form_id) {
		case 55:
<<<<<<< HEAD
                    
                    update_post_meta($deal_id, 'investment_sub_id', $sub_id );
                    
                    
=======
>>>>>>> master
                    write_log('beginning form 55');
                        //$all_fields = $ninja_forms_processing->get_all_fields();
  
                       // if( is_array( $all_fields ) ){ //Make sure $all_fields is an array.
                          //Loop through each of our submitted values.
                        //  foreach( $all_fields as $field_id => $user_value ){
                         //     echo $user_value;
                            //Update an external database with each value
                        //  }
                       // } //die();
			// Invest in this Deal

			$subject = $theme_settings['invest_subject'];
			$email_title = $subject;
			$email_body = 'Dear ' . $to_name . ',<br><br>';
			$email_body .= do_shortcode( wpautop( $theme_settings['invest_message'] ) );
			$email_footer = '';

			// Send to DocuSign to be signed
			// send_to_docusign( $to_name, $to_email, $form_id, $sub_id );

			$redirect_url = get_permalink( $theme_settings['invest_landing'] );
                        
                       // update_post_meta($post_entity, 'investment_offering_id', $form_id );

			break;
                    
            //    case 57:
                   // $to_name, $to_email, $form_id, $sub_id
                 // echo '<pre>';  var_dump($ninja_forms_processing->get_form_setting('sub_id'));echo '</pre>';die();
                //  $sub_id = $ninja_forms_processing->get_form_setting('sub_id');
                    // TODO maybe use default SKB email here
                  //  $result = send_to_docusign($to_name,$to_email, $form_id, $sub_id);
                  //  if ( $result ) {

			//	$redirect_url = home_url( '/docusign?url=' . urlencode( $result ) );

			//} else {

			//	$redirect_url = home_url( '/docusign-error' );

			//}

			//wp_redirect( $redirect_url );
                 //   break;

		case 15:
			// Existing Investor

			$subject = $theme_settings['existing_investor_subject'];
			$email_title = $subject;
			$email_body = 'Dear ' . $to_name . ',<br><br>';
			$email_body .= do_shortcode( wpautop( $theme_settings['existing_investor_message'] ) );
			$email_footer = '';

			$redirect_url = get_permalink( $theme_settings['existing_landing'] );

			break;

		default: 
			// The rest are AIQs to send to DocuSign to be signed
<<<<<<< HEAD
 write_log('default');
=======
 //write_log('default');
>>>>>>> master
			$result = send_to_docusign( $to_name, $to_email, $form_id, $sub_id );

			if ( $result ) {

				$redirect_url = home_url( '/docusign?url=' . urlencode( $result ) );

			} else {

				$redirect_url = home_url( '/docusign-error' );

			}

			wp_redirect( $redirect_url );
			exit;

	}

	// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );
//write_log('beginning ob_start');
	ob_start();
	include( locate_template( 'library/templates/email-basic.php', false, true ) );
	$message = ob_get_clean();

	wp_mail( $to, $subject, $message, $headers );

	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
	// write_log('redirect');
	wp_redirect( $redirect_url );
	exit;

}


function skb_pdf_name( $name, $sub_id ) { 

	$name = 'skbincrowd-doc_' . $sub_id; 
	return $name; 

}

/*
 * @description handles pre-population of forms
 */
function adjust_ninja_forms_field( $data, $field_id ){
    
    global $ninja_forms_loading;
    
    $form = $ninja_forms_loading;
    $selected_entity = array();
    $user = wp_get_current_user();
    
    // Fields we don't want to mess with
    if ( in_array( $field_id, array( '28', '43', '44', '45', '46', '47', '48', '50', '51', '53', '55', '56', '58', '59', '60', '62', '63', '64', '65', '67', '68', '61', '73', '98', '121', '122', '123', '125', '126', '127', '130', '131', '132', '133', '136', '141', '142', '143', '145', '150', '173', '367', '915', '916', '917', '924', '925', '926', '941', '943', '968', '969', '974', '1113', '1595', '1596', '1867', '2123', '2124', '2125', '2126', '2127', '2128', '2130' ) ) ) {
        return $data;	
    }

    // prepopulate Entity Name field
    if (isset($data['label']) && $data['label'] == 'Entity') {
        
        $user = wp_get_current_user();

        $posts = get_posts( 
            array( 
                'post_type' => 'investment_entity',
                'posts_per_page' => -1,
                'post_status' => array('publish'),
                'meta_key' => 'investment_entity_user_id',
                'meta_value' => $user->ID
            )
        );
        
        $k = 0;
        $data['list']['options'] = array( array('label'=>'Select Entity'));
        foreach ($posts as $p) {
            $k++;
            $entity = $p->post_title;
            $entity_t = get_post_meta($p->ID, 'investment_entity_type', true);
            
            $data['list']['options'][$k]['label'] = $entity;
            $data['list']['options'][$k]['value'] = $entity_t;
            $data['list']['options'][$k]['selected'] = 'Select Entity';
            
            echo '<input type="hidden" id="_entity_'.$k.'_id" value="'.$p->ID.'"/>';
            
            
                // add entity id to global variable
          //  $ninja_forms_loading->selected_entity = $p->ID;
        }
        
    }
    
   // $data['entity_type'][$type_e];
   // $reflection = new ReflectionClass('ninja_forms_loading');
   // $methods = $reflection->getMethods();
   // array_walk(
   // $methods,
   // function (&$v) {
   //     $v = $v->getName();
    //}


  // Prepopulate certain fields
  if ( in_array( $field_id, array( '1013', '1021', '101', '103', '104', '105', '106', '107', '108', '109', '2440' ) ) ) {

	$user_id = get_current_user_id();
	$user_meta = get_user_meta( $user_id );
        
        foreach($user_meta as $meta) {
            $first_name = (isset($meta['first_name'])) ? $meta['first_name'] : '';
            $last_name = (isset($meta['last_name'])) ? $meta['last_name'] : '';
            $phone = (isset($meta['phone'])) ? $meta['phone'] : '';
            $address_1 = (isset($meta['address_1'])) ? $meta['address_1'] : '';
            $address_2 = (isset($meta['address_2'])) ? $meta['address_2'] : '';
            $city = (isset($meta['city'])) ? $meta['city'] : '';
            $state = (isset($meta['state'])) ? $meta['state'] : '';
            $postal_code = (isset($meta['postal_code'])) ? $meta['postal_code'] : '';
            $country = (isset($meta['country'])) ? $meta['country'] : '';
            $dob = (isset($meta['dob'])) ? $meta['dob'] : '';
        }
        
     /*   if ( in_array( $field_id, array('2440'))) {
           // $data = array();
           echo '<pre>'; var_dump($ninja_forms_loading->selected_entity);echo '</pre>';
           $data['default_value'] = 'already uploaded';
           $data['upload_multi_count']  = '1';
           $data['label'] = 'Already uploaded';
            return $data;
          }*/

	// Address 1
	if ( in_array( $field_id, array( '1013', '1021' ) ) ) {
	    $data['default_value'] = $dob;
	}


	// Address 1
	if ( in_array( $field_id, array( '103' ) ) ) {
	    $data['default_value'] = $address_1;
	}


	// Address 2
	if ( in_array( $field_id, array( '104' ) ) ) {
	    $data['default_value'] = $address_2;
	}


	// Phone
	if ( in_array( $field_id, array( '109' ) ) ) {
	    $data['default_value'] = $phone;
	}

	// City
	if ( in_array( $field_id, array( '106' ) ) ) {
	    $data['default_value'] = $city;
	}

	// State
	if ( in_array( $field_id, array( '107' ) ) ) {
	    $data['default_value'] = $state;
	}

	// Zip
	if ( in_array( $field_id, array( '105' ) ) ) {
	    $data['default_value'] = $postal_code;
	}

	// Country
	if ( in_array( $field_id, array( '108' ) ) ) {
	    $data['default_value'] = $country;
	}

  }

  return $data;
}

function add_custom_ninja_forms_field_wrap_class( $field_wrap_class, $field_id ) {
    
    // maybe check here if upload field exists in metadata remove it from form??

  // Fields we don't want to mess with
  if ( in_array( $field_id, array( '74' ) ) ) {
  	//return $field_wrap_class;	
  }

  $field_wrap_class .= ' form-group col-xs-12';
  
  if ( in_array( $field_id, array( '2301', '388', '374', '518', '1276', '599', '1286', '188', '1769', '1221', '259', '1770', '1233',
      '757', '1308', '1766', '323' ))) {
      
        $field_wrap_class .= ' col-md-8';
      
  } elseif ( in_array( $field_id, array( 
      '19', '20', '103', '104', '157', '944', '945', '996', '997', '1010', 
      '1266', '1016', '1044', '1114', '1115', '1226', '1264', '1265', '2127', '2224', '2225',
      '2281', '2282', '2283', '2286', '2508', '2319', '2320', '2321', '2324', '2521', '2255', '2256', '2257', '2260', '2234', '2235', '2236',
      '2239', '2246', '2546', '2547', '2328', '2329', '2330', '2389', '2390', '2391', '2418', '2419', '2420', '2447', '2448', '2449','2359', '2360',
      '2361', '2371', '2372', '2373', '2376', '2377', '2367', '2368', '1821', '1822', '1823', '1824', '375', '1869', '508', '510', '589', '591', '1933', '1934',
      '592', '593', '192', '193', '190', '191', '1826', '1827', '1828', '1829', '1841', '18433', '1839', '1840', '263', '264', '261', '262', '1843', '110', '1859',
      '1860', '1595', '1856', '1858', '1857', '965', '27', '941','28', '1023', '33', '29', '30', '1033', '328', '325', '326', '1862', '1863', '1864', '1865', 
      ) ) ) {
  
  	$field_wrap_class .= ' col-md-6';
  
  } elseif ( in_array( $field_id, array( '29', '30', '33',  ) ) ) {

	$field_wrap_class .= ' col-md-5'; 

  } elseif ( in_array( $field_id, array( '17', '18', '100', '101', '1224', '1225', '1261', '1262', '1855', '1592', '1593', '1798', '2221', '2279', '2280', '2511', '2285',
       '2505','2512','2507', '2317', '2539', '2318', '2323', '2517', '2518', '2519', '2253', '2254', '2542', '2259', '2231', '2544', '2233', '2244', '2245', '2565',
      '2326', '2566', '2327', '2331', '2333', '2334', '2335', '2350', '2567', '2351', '2352', '2353', '2354', '2387', '2568', '2388', '2392', '2394', '2395', '2396',
      '2416', '2417', '2569', '2421', '2387', '2568', '2388', '2423', '2424', '2425', '2427', '2428', '2429', '2430','2431','2432', '2445', '2570', '2446', '2450',
      '2452', '2453', '2454', '2460', '2461', '2462', '2357', '2358', '2571', '2362', '2364', '2573', '2365', '2374', '371', '2598', '372', '373', '387',
      '1198', '1199', '381', '382', '384', '385', '383', '386', '1299', '1300', '1301', '1302', '1303', '1304', '1296', '2597', '1297', '1072', '1073', '1074',
      '1075', '1076', '1077', '1818', '1078', '1295', '504', '2600', '505', '1820', '506', '517', '1204', '1205', '1584', '1587', '1938', '511', '512', '514', '515', '513',
      '516', '1268', '1269', '1270', '1271', '1272', '1273', '1274', '2599', '1275', '1915', '1096', '1097', '1098', '1102', '585', '2602', '586', '587', '598', '1202', '1203',
      '1929', '1930', '1931', '1287', '1288', '2601', '1927', '1089', '1090', '1091', '1092', '1093', '1094', '1280', '1281', '1282', '1283', '1284', '1285', '178', '2605', '179', 
      '180', '187', '1201', '1200', '1210', '1211', '2604', '233', '181', '182', '184', '185', '183', '186', '1215', '1216', '1217', '1218', '1219', '1220', '1832', '1833', '1834', 
      '1835', '1836', '1837', '1222', '1223', '2603', '1830', '1081', '1082', '1087', '242', '2608', '243', '244', '258', '1206', '1207', '1229', '2607', '1231', '250', '252', '253',
      '255', '256', '254', '257', '1237', '1238', '1239', '1240', '1241', '1242', '1845', '1846', '1847', '1848', '1849', '1850', '1234', '2606', '1235', '1866', '1104', '1105', '1110',
      '743', '744', '2610', '1305', '756', '1190', '1189', '747', '1306', '1588', '1589', '1870', '1871', '750', '751', '753', '754', '752', '755', '1311', '1312', '1313', '1314', '1315', '1316',
      '1307', '2609', '1309', '1814', '1049', '1050', '1051', '1052', '1053', '1054', '2593', '1013', '109', '1209', '1208', '2591', '1594', '2592', '1002', '1003', '2590', '26', '1196', '1021',
      '2589', '1038', '1039', '306', '2595', '307', '1032', '322', '1187', '1188', '1254', '2596', '1255', '1034', '1800', '1771', '316', '317', '319', '320', '318', '321', '1251',
      '1252', '1253', '1803', '1804', '1249', '1802', '1248', '1250', '1805', '1806', '1807', '1244', '2594', '1245', '1799', '984', '985', '986', '987', '988', '989', '1045', '1243'
      ) ) ) {

	$field_wrap_class .= ' col-md-4'; 

  } elseif ( in_array( $field_id, array( '21', '22', '23', '24', '26', '105', '106', '107', '108', '109', '110', '946', '947', '948', '949',
      '998', '999', '1000', '1001', '1005', '1006', '1007', '1116', '1117', '1118', '1119', '1040', '1041', '1042', '1043', '1196', '2287', '2288',
      '2513', '2509', '2325', '2541', '2520', '2522', '2261', '2262', '2240', '2242', '2247', '2248', '2237', '2238', '2456', '2457', '2458', '2459', '2369',
      '1101', '1099', '597' , '594', '595', '596' , '1083', '1084', '1085', '1086', '1106', '1107', '1108', '1109', '1004'
       ) ) ) {
  
  	$field_wrap_class .= ' col-md-3';

  } elseif ( in_array( $field_id, array(  '367', '2284', '2322', '2258', '2332', '2393', '2422', '2451', '2363', '2375',
      '1100' ) ) ) {
  
  	$field_wrap_class .= ' col-md-2';
 
  }

  return $field_wrap_class;

}


function insert_ninja_forms_display_before_field( $field_id, $data ) {

  // Fields we want to drop something in before
  if ( in_array( $field_id, array( '18', '34', '58', '67', '116', '121', '126', '131', '142', '157', '2126', '2503', '2127', '969', '1596', '2123', '2125', '2184', '2219', '2252' ) ) ) {

  	echo '<div class="row" style="border: 1px solid black; border-radius: 5px; padding: 1em 0; margin: 1em 0;">';

  }

}


function insert_ninja_forms_display_after_field( $field_id, $data ) {

  // Fields we want to drop something in after
  if ( in_array( $field_id, array( '33', '50', '56', '66', '68', '139', '143', '949', '173', '110', '1266', '1119', '1226', '1860', '1868', '1867', '2183', '2225', '2251', '2575') ) ) {

 	echo '</div>';
  	
  }

}