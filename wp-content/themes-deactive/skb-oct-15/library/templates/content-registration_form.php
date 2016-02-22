<?php global $skb_error; ?>
<?php if ( ! is_wp_error( $skb_error ) ) { ?>
<form id="accredited_form" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" class="row">
	<h1>Please complete the form below to create a free account, read offerings and invest</h1>
	<br>
	<div class="col-xs-12 col-sm-6">
            <p>Registering for an account with SKB IN CROWD will give you access to all real estate investments from SKB. SKB IN CROWD is regulated by <a href="http://finra.org" target="_blank">FINRA</a> (Financial Industry Regulatory Authority) and only works with <a class="accredited" tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A natural person who had 'individual income' in excess of $200,000, or joint income in excess of $300,000, in each of the last two calendar years and reasonably expects to reach the same income level in the current calendar year. Or a natural person whose 'net worth,' (excluding principal residence) either individually or jointly exceeds $1,000,000.">accredited investors</a>.</p>
	</div>
	<div class="form-group col-xs-12 col-sm-6">
            <label for="accredited_investor">Please confirm your accreditation:</label><br>
            <input type="radio" name="accredited_investor" value="1">  Yes, I am an accredited investor.<br>
            <input type="radio" name="accredited_investor" value="0">  No, I am not an accredited investor.<br><br>
            <input type="submit" class="btn btn-primary btn-lg" id="next" name="next" value="Next">		
	</div>
    <p>Already registered? Proceed to <a href="/my-account/">login</a>.</p>
</form>

<div id="not-accredited" class="row hide">
    <h1>Thank you for your interest in SKB IN CROWD</h1>
    <p>Unfortunately, we are unable to work with you at this time. SKB IN CROWD is regulated by <a href="http://www.finra.org" target="_blank">FINRA</a> (Financial Industry Regulatory Authority) and is limited to working with <a class="accredited" tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="A natural person who had 'individual income' in excess of $200,000, or joint income in excess of $300,000, in each of the last two calendar years and reasonably expects to reach the same income level in the current calendar year. Or a natural person whose 'net worth,' (excluding principal residence) either individually or jointly exceeds $1,000,000.">accredited investors</a> only. Please visit <a href="http://www.finra.org" target="_blank">finra.org</a> to find out about more out becoming an accredited investor. Should your accreditation status change, we welcome you to visit us again to set up an account.
</div>

<form id="register_form" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" class="row hide">
    
<?php } else { ?>
    
<form id="register_form" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" class="form-inline" role="form">
    
<?php } ?>
    
    <h1>Please complete the form below to create a free account, read offerings and invest</h1>

    <div class="form-group col-xs-12 col-sm-6">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first-name" value="<?php echo(isset($_POST['first_name']) ? $_POST['first_name'] : null); ?>" placeholder="Enter your first name" required>
    </div>
    
    <div class="form-group col-xs-12 col-sm-6">
            <label for="password">Password (8 character minimum required)</label>
            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter a password" required>
    </div>

    <div class="form-group col-xs-12 col-sm-6">
        <label for="last_name">Last Name</label>
        <div>
                <input type="text" class="form-control" name="last_name" id="last-name" value="<?php echo(isset($_POST['last_name']) ? $_POST['last_name'] : null); ?>" placeholder="Enter your last name" required>
        </div>
    </div>
    
    <div class="form-group col-xs-12 col-sm-6">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm-password" value="" placeholder="Confirm password" required>
    </div>    

    <div class="form-group col-xs-12 col-sm-6">	

        <?php
                if ( is_wp_error( $skb_error ) && in_array( 'skb_email', $skb_error->get_error_codes() ) ) {
                        echo '<div class="col-xs-12"><div class="alert alert-danger" role="alert">' . $skb_error->get_error_message( 'skb_email' ) . '</div></div>';
                }
        ?>
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo(isset($_POST['email']) ? $_POST['email'] : null); ?>" placeholder="Enter your email address" required>
    </div>
    
    <div class="form-group col-xs-12 col-sm-6">
        
            <label class="" for="referred_by">
                How did you find out about SKB?
                <select class="form-control" id="select_referral" name="select_referral">
                    <option>Select one</option>
                    <option>Internet Search</option>
                    <option>Advertisement</option>
                    <option>News Article</option>
                    <option value="managing-director">Managing Director</option>
                </select>
            </label>
        
            <label class="" for="select_director">
                <select class="form-control" id="select_director" name="select_director" style="display:none">
                    <option>Select Managing Director</option>
                    <option>Richard Morean</option>
                    <option>Will Short</option>
                    <option>Margaret Hill</option>
                    <option>Robert Scanlan</option>
                    <option>Todd Gooding</option>
                    <option>Robert R. Walker, Jr.</option>
                    <option>Paul P. Rabinovitch</option>
                    <option>William A. Walters</option>
                </select>
            </label>
        
    </div> 
    
    <div class="form-group col-xs-12 col-sm-6 pull-left">
            <label for="register_phone">Phone</label>
            <input type="password" class="form-control" name="register_phone" id="confirmregister_phonepassword" value="" placeholder="Phone">
    </div> 
    
    
    <div class="form-group col-xs-12 col-sm-6">
            <label class="checkbox-inline" for="receive_series_emails"><input type="checkbox" class="checkbox" name="receive_series_emails" id="receive_series_emails">Receive SKB's investor series emails</label>
    </div> 
    
    
    <?php
            if ( is_wp_error( $skb_error ) && in_array( 'skb_password', $skb_error->get_error_codes() ) ) {
                    echo '<div id="error_field" class="col-xs-12"><div class="alert alert-danger" role="alert">' . $skb_error->get_error_message( 'skb_password' ) . '</div></div>';
            }
    ?>
    
    
    <div class="form-group col-xs-12 col-sm-12">
    <p id="error_field" ></p>
    </div>
    <div class="form-group col-xs-12">
            <input type="submit" class="btn btn-primary btn-lg" id="register" name="register" value="Register">
            <span>Already registered? <underline><a href="<?php echo site_url(); ?>/login" >Login</a></underline></span>
            <br><br>
            <strong><small>We will not sell or share your personal information.</small></strong>
    </div>
    

</form>

<div class="clearfix"></div>

<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery('#select_referral').on('change', function() {
            var select_r_val = jQuery('#select_referral').val(); 
            if (select_r_val == 'managing-director') {
                jQuery('#select_director').show();
            } else {
                jQuery('#select_director').hide();
            }
        });
    });

</script>
