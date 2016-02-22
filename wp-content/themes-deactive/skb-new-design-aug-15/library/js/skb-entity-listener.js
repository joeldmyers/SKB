$jQ = jQuery.noConflict();
 //Dropzone.autoDiscover = false;

$jQ(document).ready(function() {
    
    $jQ('#ninja_forms_field_2185').val('Select Entity');
   //$jQ('.ninja-forms-form').dropzone();
   // $jQ('.ninja-forms-form').dropzone({
        //url:'../wp-admin/admin-ajax.php'
  //  });
   //$jQ('.multi').addClass('fileUpload');
   //$jQ('input[type=file]').html('test')
   // $jQ('.upload-wrap').addClass('dropzone');
    
    // submit button hack fix
    $jQ('input[type=text].ninja-forms-field, select.ninja-forms-field').addClass('input-lg');
    $jQ('.ninja-forms-req').addClass('required');
    $jQ('#ninja_forms_field_2277').on('click', function() {
       $jQ(this).val('Thank you, your form has been submitted');
       window.location.replace(document.location.origin+"/invest-in-this-deal-thank-you");
    });
    
    $jQ('.terms-checkbox').attr('disabled','disabled');
    $jQ('<p class="text-danger small">Please read the terms before accepting</p>').insertBefore('.terms-checkbox');
    $jQ('.terms-check').scroll(function () {
        if ($jQ(this).scrollTop() > $jQ(this).prop('scrollHeight') - $jQ(this).height() -50 ) {
            $jQ(this).parent().nextAll('.terms-checkbox').removeAttr('disabled');
        }
    });
    
    $jQ.validator.setDefaults({
    highlight: function(element) {
        jQuery(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'div',
    errorClass: 'alert alert-danger',
    errorPlacement: function(error, element) {
		error.insertBefore(element);
    }
});
      
      //var form = $jQ( "#ninja_forms_form_55" );
     // $jQ('*').removeAttr('alert');
      //$jQ('.ninja-forms-field').on('click',function(){
     //     $jQ('input[type=submit').removeAttr('disabled');
     // });
     
     $jQ('.ninja-forms-form input[type=submit]').attr('disabled','disabled');
      
      $jQ('body').on('click', '.ninja-forms-field', function(){
       //   $jQ('*').removeAttr('alert');
       //console.log('fire');
       $jQ('input[type=submit]').removeAttr('disabled');
            var id =  $jQ(this).attr('id');
            $jQ('#'+id).validate();
      });
      $jQ('.ninja-forms-field').on('click', function() {
          $jQ('input[type=submit]').removeAttr('disabled');
            var id =  $jQ(this).attr('id');
            $jQ('#'+id).validate();
      });
   
      $jQ('body').on( 'click', '.ninja-forms-mp-next', function(e) {        
        if (!$jQ(this).closest('form').valid()) {
            //console.log($jQ(this).closest('form'));
            $jQ('input[type=submit]').attr('disabled','disabled');
            $jQ('html, body').animate({
         scrollTop: ($jQ('.has-error:first').offset().top - 300)
    }, 2000);
        } else if ($jQ('.ninja-forms-mp-nav').valid()) {
            $jQ('input[type=submit]').removeAttr('disabled');
        }
        
      });
      ///////////////////////////////////////////
      // change to input
    $jQ('#ninja_forms_field_2185').on('change', function(e) {      
        // hacky way to get entity id
        var entity_id = $jQ('#_entity_'+this.selectedIndex+'_id').val();        
        $jQ('#skb_entity_id').val(entity_id);
        window.entity_id = entity_id;
            
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change';
        
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                investment_page: '1',
                entity_id: window.entity_id
            },
            success: function(response) {
               // console.log(response);
                // extract variables from response and attach them to the window
                for (var key in response) {
                
                // if the file is already uploaded then hide the field
                  // if (key == 'ninja_forms_field_2440') {
                        console.log(key);
                        if (response[key+"_uploaded"] == "uploaded") {
                        
                            $jQ('#'+key+'_div_wrap').remove();
                            console.log(response);
                       // }
                   } else {
                       if (key == 'ninja_forms_field_2440') { break; }
                        $jQ('#'+key).val(response[key]);
                   }
                } 
                
               // $jQ('#ninja_forms_field_2301').val(window.investment_amount[0]);
               // $jQ('#ninja_forms_field_2221').val(window.source_of_funds[0]);
              //  $jQ('#ninja_forms_field_2222').val(window.name_of_bank[0]);
              //  $jQ('#ninja_forms_field_2223').val(window.address_of_bank[0]);
               // $jQ('#ninja_forms_field_2224').val(window.aba_routing_num[0]);
               // $jQ('#ninja_forms_field_2225').val(window.account_num[0]);
                
                $jQ('.ninja-forms-cont').append('<input type="hidden" id="skb_entity_id" name="skb_entity_id" value="'+entity_id+'" />');
                
            },
            error: function(errorThrown){
               console.log('error'+errorThrown);
               console.log(errorThrown.responseText);
            }
        });
    });
    
    /*$jQ('body').bind('click', '#ninja_forms_form_55_mp_next', function(){
        var is_page_2 = $jQ('#ninja_forms_form_55_mp_page_2').attr('style');
        if ($jQ('#ninja_forms_form_55_mp_page_2').css('display') == 'none') {
            console.log(is_page_2);
        } else {
            $jQ('#ninja_forms_field_2221').val(window.source_of_funds);
        }
        console.log('not here');
    });
    $jQ('.ninja-forms-field').on( 'click', function() {
        console.log('clicked');
        var cclass = $jQ(this).attr('class');
        $jQ('.'+cclass).validate({
        highlight: function(element, errorClass, validClass) {
          $jQ(element).addClass(errorClass).removeClass(validClass);
          $jQ(element.form).find("label[for=" + element.id + "]")
            .addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
          $jQ(element).removeClass(errorClass).addClass(validClass);
          $jQ(element.form).find("label[for=" + element.id + "]")
            .removeClass(errorClass);
        }
      });*/
        
        
        
        // validate form, remove class from next/prev buttons, then add class after field validates
   
    
    $jQ('.entity_meta').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
        var investment_amount = $jQ('#ninja_forms_field_2301').val();
        var source_of_funds = $jQ('#ninja_forms_field_2221').val();
        var name_of_bank = $jQ('#ninja_forms_field_2222').val();
        var address_of_bank = $jQ('#ninja_forms_field_2223').val();
        var aba_routing_num = $jQ('#ninja_forms_field_2224').val();
        var account_num = $jQ('#ninja_forms_field_2225').val();
       
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '2',
                investment_amount:investment_amount,
                source_of_funds:source_of_funds,
                name_of_bank:name_of_bank,
                address_of_bank:address_of_bank,
                aba_routing_num:aba_routing_num,
                account_num:account_num
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    $jQ('.entity_meta_3').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
        var first_name = $jQ('#ninja_forms_field_2253').val();
        var last_name = $jQ('#ninja_forms_field_2254').val();
        var address_1 = $jQ('#ninja_forms_field_2255').val();
        var address_2 = $jQ('#ninja_forms_field_2256').val();
        var city = $jQ('#ninja_forms_field_2257').val();
        var state = $jQ('#ninja_forms_field_2258').val();
        var zip = $jQ('#ninja_forms_field_2259').val();
        var email = $jQ('#ninja_forms_field_2260').val();
        var phone = $jQ('#ninja_forms_field_2261').val();
        var ssn = $jQ('#ninja_forms_field_2262').val();
        var add_contact_info = $jQ('#ninja_forms_field_2263').val();
        var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
      //  var upload_id = $jQ('#ninja_forms_field_2272').val();
       
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '3',
                first_name: first_name,
                last_name: last_name,
                address_1: address_1,
                address_2: address_2,
                city: city,
                state: state,
                zip: zip,
                email: email,
                phone: phone,
                ssn: ssn,
                add_contact_info: add_contact_info,
                add_contact_info_val: add_contact_info_val,
                upload_id: upload_id
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // trust
    $jQ('.entity_meta_4').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var trustee_id = $jQ('#ninja_forms_field_2560').val();
       
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '4',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                trustee_id: trustee_id
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // joint tenant
    $jQ('.entity_meta_5').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var joint_tenant_id_one = $jQ('#ninja_forms_field_2296').val();
            var joint_tenant_id_two = $jQ('#ninja_forms_field_2298').val();
            
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '5',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                joint_tenant_id_one: joint_tenant_id_one,
                joint_tenant_id_two: joint_tenant_id_two
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // tenants in common
    $jQ('.entity_meta_6').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var joint_tenant_id_one = $jQ('#ninja_forms_field_2531').val();
          var joint_tenant_id_two = $jQ('#ninja_forms_field_2529').val();
            
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '6',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                joint_tenant_id_one: joint_tenant_id_one,
                joint_tenant_id_two: joint_tenant_id_two
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // community
    $jQ('.entity_meta_7').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var community_id_one = $jQ('#ninja_forms_field_2343').val();
          var community_id_two = $jQ('#ninja_forms_field_2345').val();
            
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '7',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                community_id_one: community_id_one,
                community_id_two: community_id_two
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // limited partnership
    $jQ('.entity_meta_8').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var lp_id_one = $jQ('#ninja_forms_field_2411').val();
          var lp_id_two = $jQ('#ninja_forms_field_2413').val();
            
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '8',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                lp_id_one: lp_id_one,
                lp_id_two: lp_id_two
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    
    $jQ('.entity_meta_9').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
        var first_name = $jQ('#ninja_forms_field_2416').val();
        var last_name = $jQ('#ninja_forms_field_2417').val();
        var address_1 = $jQ('#ninja_forms_field_2418').val();
        var address_2 = $jQ('#ninja_forms_field_2419').val();
        var city = $jQ('#ninja_forms_field_2420').val();
        var state = $jQ('#ninja_forms_field_2421').val();
        var zip = $jQ('#ninja_forms_field_2422').val();
        var email = $jQ('#ninja_forms_field_2423').val();
        var phone = $jQ('#ninja_forms_field_2424').val();
        var ssn = $jQ('#ninja_forms_field_2425').val();
        var llc_name = $jQ('#ninja_forms_field_2427').val();
        var tax_id_number = $jQ('#ninja_forms_field_2428').val();
        
        var managing_mem_name = $jQ('#ninja_forms_field_2429').val();
        var managing_mem_email = $jQ('#ninja_forms_field_2430').val();
        var managing_mem_phone = $jQ('#ninja_forms_field_2431').val();
        var managing_mem_ssn = $jQ('#ninja_forms_field_2432').val();
        var check_add_contact_info = $jQ('#ninja_forms_field_2433').val();
        var list_add_contact_info = $jQ('#ninja_forms_field_2434').val();
        var managing_mem_id_upload = $jQ('#ninja_forms_field_2440').val();
        var llc_operating_agreement_upload = $jQ('#ninja_forms_field_2442').val();
       
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '9',
                first_name: first_name,
                last_name: last_name,
                address_1: address_1,
                address_2: address_2,
                city: city,
                state: state,
                zip: zip,
                email: email,
                phone: phone,
                ssn: ssn,
                llc_name: llc_name,
                tax_id_number: tax_id_number,
                managing_mem_name: managing_mem_name,
                managing_mem_email: managing_mem_email,
                managing_mem_phone: managing_mem_phone,
                managing_mem_ssn: managing_mem_ssn,
                check_add_contact_info: check_add_contact_info,
                list_add_contact_info: list_add_contact_info,
                managing_mem_id_upload: managing_mem_id_upload,
                llc_operating_agreement_upload: llc_operating_agreement_upload
            },
            success: function(response) {
                
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // corporation
    $jQ('.entity_meta_10').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var corp_id_one = $jQ('#ninja_forms_field_2470').val();
          var corp_id_two = $jQ('#ninja_forms_field_2472').val();
            
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '10',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                corp_id_one: corp_id_one,
                corp_id_two: corp_id_two
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
    
    // IRA
    $jQ('.entity_meta_11').on('change', function(){
        
        var ajax_url = '../wp-admin/admin-ajax.php?action=skb_entity_state_change'; 
        
       // var first_name = $jQ('#ninja_forms_field_2253').val();
        //var last_name = $jQ('#ninja_forms_field_2254').val();
        //var address_1 = $jQ('#ninja_forms_field_2255').val();
       // var address_2 = $jQ('#ninja_forms_field_2256').val();
       // var city = $jQ('#ninja_forms_field_2257').val();
       // var state = $jQ('#ninja_forms_field_2258').val();
       // var zip = $jQ('#ninja_forms_field_2259').val();
       // var email = $jQ('#ninja_forms_field_2260').val();
       // var phone = $jQ('#ninja_forms_field_2261').val();
       // var ssn = $jQ('#ninja_forms_field_2262').val();
       // var add_contact_info = $jQ('#ninja_forms_field_2263').val();
       // var add_contact_info_val = $jQ('#ninja_forms_field_2266').val();
          var ira_id = $jQ('#ninja_forms_field_2384').val();
            
        $jQ.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: {
                action: 'skb_entity_state_change',
                entity_id: window.entity_id,
                investment_page: '11',
               // first_name: first_name,
               // last_name: last_name,
               // address_1: address_1,
               // address_2: address_2,
               // city: city,
               // state: state,
               // zip: zip,
               // email: email,
               // phone: phone,
               // ssn: ssn,
               // add_contact_info: add_contact_info,
               // add_contact_info_val: add_contact_info_val,
                ira_id: ira_id
            },
            success: function(response) {
               // console.dir(response);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
});