// prevent default popup dialog (for required fields)
window.alert = function() {};

jQuery(document).ready(function() {
    
    jQuery('[data-toggle="tooltip"]').tooltip({ placement: 'top'});
    
    jQuery('.faux-submit').attr('type','submit').val('Submit');
    jQuery("label[for='"+jQuery('.faux-submit').attr('id')+"']").remove();
    
    jQuery('.active-result').removeClass('result-selected');
    
    var html = '<div id="accredited_check"><h1>Please complete the form below to create a free account, read offerings and invest</h1>'
                 + '<div class="col-xs-12 col-sm-6"><p>Registering for an account with SKB IN CROWD will give you access to all real estate investments from SKB. SKB IN CROWD is regulated by <a href="http://finra.org" target="_blank">FINRA</a> (Financial Industry Regulatory Authority) and only works with <a class="accredited" tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A natural person who had "individual income" in excess of $200,000, or joint income in excess of $300,000, in each of the last two calendar years and reasonably expects to reach the same income level in the current calendar year. Or a natural person whose "net worth", (excluding principal residence) either individually or jointly exceeds $1,000,000." data-original-title="" title="">accredited investors</a>.</p></div>'
                 + '<div class="form-group col-xs-12 col-sm-6">'
		 + '<label for="accredited_investor">Please confirm your accreditation:</label><br>'
		 + '<input type="radio" name="accredited_investor" id="accredited_yes" value="1">  Yes, I am an accredited investor.<br>'
		 + '<input type="radio" name="accredited_investor" id="accredited_no" value="0">  No, I am not an accredited investor.<br><br>'
		 + '<input type="button" class="btn btn-primary btn-lg" id="accredited_next" name="next" value="Next" >'	
                 +  '</div>'
                 + '<p>Already registered? Proceed to <a href="/my-account/">login</a>.</p>'
                 + '</div>';
         
    jQuery('.page-id-2048 .container .row').eq(1).append(html);
    
    // enabled button after page loads
    jQuery('#investment_req_btn').removeAttr('disabled');
    jQuery('#investment_req_btn span:nth-child(2)').html(' Investment Requirements');
    // toggle display on dropdown
    jQuery('#investment_req_dropdown').on('change', function() {
        jQuery('.investment_req_modal div').fadeOut('slow');
       var select_val = jQuery('#investment_req_dropdown').val();
       jQuery('#investment_req_' + select_val).fadeIn('slow');
    });
    
    jQuery('input:radio[name=accredited_investor]').on('click', function() {
       window.accredited_investor = jQuery(this) 
    });
    
    jQuery(document).on('click','#accredited_next', function() {

         var vall = jQuery('input:radio[name=accredited_investor]:checked').val();
         //console.log(vall);
         if (vall == '1') {
             jQuery(this).parents('#accredited_check').remove(); 
             jQuery('.userpro').css('display','block');
         } else {
             jQuery('#accredited_check').html('<h1>Thank you for your interest in SKB IN CROWD</h1><p>Unfortunately, we are unable to work with you at this time. SKB IN CROWD is regulated by FINRA (Financial Industry Regulatory Authority) and is limited to working with <underline>accredited investors<underline> only. Please visit <a href="http://www.finra.org/">finra.org</a> to find out about more out becoming an accredited investor. Should your accreditation status change, we welcome you to visit us again to set up an account.</p>');
         }
         
    });
        
    
    
    jQuery('.userpro-input').on('click', function() {
        
        var ref_type = jQuery(this).children('.chosen-container').find('span').html();
        
        if (ref_type == 'SKB Managing Director') {
            
            jQuery('.userpro-field-_skb_managing_dir_referral').css('display','block');
            jQuery('.userpro-field-_skb_other_referral').css('display','none');
        }
        
        if (ref_type == 'Other') {
            jQuery('.userpro-field-_skb_other_referral').css('display','block');
            jQuery('.userpro-field-_skb_managing_dir_referral').css('display','none');
        }
        if (ref_type == "Advertisement" || ref_type == "News Article" || ref_type == "Internet Search" || ref_type == "Referral" ) {
             jQuery('.userpro-field-_skb_managing_dir_referral').css('display','none');
            jQuery('.userpro-field-_skb_other_referral').css('display','none');
        }
        
    });
});