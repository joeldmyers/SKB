<?php
/**
 * Outputs the HTML for user registration.
 *
**/
add_action('init', 'ninja_forms_register_display_register_user');
function ninja_forms_register_display_register_user(){
	add_action('ninja_forms_display_before_fields', 'ninja_forms_display_register_user');
}

function ninja_forms_display_register_user($form_id){
	global $ninja_forms_processing;
	
	$plugin_settings = nf_sp_get_settings();
	$register_link = $plugin_settings['register_link'];
	$username_label = $plugin_settings['username_label'];
	$email_label = $plugin_settings['email_label'];
	$password_label = $plugin_settings['password_label'];
	$repassword_label = $plugin_settings['repassword_label'];
	$register_button_label = $plugin_settings['register_button_label'];
	$cancel_button_label = $plugin_settings['cancel_button_label'];
	$spam_q = $plugin_settings['register_spam_q'];
	
	if(isset($_POST['_ninja_forms_register_log'])){
		$register_log = $_POST['_ninja_forms_register_log'];
	}else{
		$register_log = '';
	}
		
	if(isset($_POST['_ninja_forms_register_email'])){
		$register_email = $_POST['_ninja_forms_register_email'];
	}else{
		$register_email = '';
	}	
		
	if(!is_user_logged_in() && Ninja_Forms()->form( $form_id )->get_setting( 'save_progress' ) == 1 ){
		$display = "display:none;";

		$log_error_class = '';
		$log_error_msg = '';

		$email_error_class = '';
		$email_error_msg = '';

		$password_error_class = '';
		$password_error_msg = '';

		$repassword_error_class = '';
		$repassword_error_msg = '';

		$spam_error_class = '';
		$spam_error_msg = '';

		if( is_object( $ninja_forms_processing) AND $ninja_forms_processing->get_form_ID() == $form_id){
			if($ninja_forms_processing->get_error('_register_log')){
				$display = "";
				$log_error_class = 'ninja-forms-error';
				$log_error_msg = $ninja_forms_processing->get_error('_register_log');
				$log_error_msg = $log_error_msg['msg'];	
			}
			
			if($ninja_forms_processing->get_error('_register_email')){
				$display = '';
				$email_error_class = 'ninja-forms-error';
				$email_error_msg = $ninja_forms_processing->get_error('_register_email');
				$email_error_msg = $email_error_msg['msg'];
			}

			if($ninja_forms_processing->get_error('_register_password')){
				$display = '';
				$password_error_class = 'ninja-forms-error';
				$password_error_msg = $ninja_forms_processing->get_error('_register_password');
				$password_error_msg = $password_error_msg['msg'];
			}

			if($ninja_forms_processing->get_error('_register_repassword')){
				$display = '';
				$repassword_error_class = 'ninja-forms-error';
				$repassword_error_msg = $ninja_forms_processing->get_error('_register_repassword');
				$repassword_error_msg = $repassword_error_msg['msg'];
			}

			if($ninja_forms_processing->get_error('_register_spam')){
				$display = "";
				$spam_error_class = 'ninja-forms-error';
				$spam_error_msg = $ninja_forms_processing->get_error('_register_spam');
				$spam_error_msg = $spam_error_msg['msg'];
			}

		}
		
		
		?>
		<div id="ninja_forms_form_<?php echo $form_id;?>_register_form" class="" style="<?php echo $display;?>">

            <div id="ninja_forms_register_log_div_wrap" class="field-wrap text-wrap label-above">
                <label for="_ninja_forms_register_log" id="_ninja_forms_register_log_label"><?php _e($username_label, 'ninja-forms');?></label>
                <input id="ninja_forms_register_log" type="text" name="_ninja_forms_register_log" class="<?php echo $log_error_class;?>" value="<?php echo $register_log;?>">
                <div id="_ninja_forms_form_<?php echo $form_id;?>_register_log_error" class="ninja-forms-field-error">
                    <?php
                    echo $log_error_msg;
                    ?>
                </div>
            </div>

            <div id="ninja_forms_register_email_div_wrap" class="field-wrap text-wrap label-above">
                <label for="_ninja_forms_register_email" id="_ninja_forms_register_email_label"><?php _e($email_label, 'ninja-forms');?></label>
                <input id="ninja_forms_register_email" type="text" name="_ninja_forms_register_email" class="<?php echo $email_error_class;?>" value="<?php echo $register_email;?>">
                <div id="_ninja_forms_form_<?php echo $form_id;?>_register_email_error" class="ninja-forms-field-error">
                    <?php
                    echo $email_error_msg;
                    ?>
                </div>
            </div>

            <div id="ninja_forms_register_password_div_wrap" class="field-wrap text-wrap label-above">
                <label for="_ninja_forms_register_password" id="_ninja_forms_register_password_label"><?php _e($password_label, 'ninja-forms');?></label>
                <input id="ninja_forms_register_password" type="password" name="_ninja_forms_register_password" class="<?php echo $password_error_class;?>" value="">
                <div id="_ninja_forms_form_<?php echo $form_id;?>_register_password_error" class="ninja-forms-field-error">
                    <?php
                    echo $password_error_msg;
                    ?>
                </div>
            </div>

            <div id="ninja_forms_register_repassword_div_wrap" class="field-wrap text-wrap label-above">
                <label for="_ninja_forms_register_repassword" id="_ninja_forms_register_repassword_label"><?php _e($repassword_label, 'ninja-forms');?></label>
                <input id="ninja_forms_register_repassword" type="password" name="_ninja_forms_register_repassword" class="<?php echo $repassword_error_class;?>" value="">
                <div id="_ninja_forms_form_<?php echo $form_id;?>_register_repassword_error" class="ninja-forms-field-error">
                    <?php
                    echo $repassword_error_msg;
                    ?>
                </div>
            </div>


            <div id="ninja_forms_register_spam_div_wrap" class="field-wrap text-wrap">
                <label for="_ninja_forms_register_spam" id="_ninja_forms_register_spam_label"><?php _e($spam_q, 'ninja-forms');?></label>
                <input id="ninja_forms_register_spam" type="text" name="_ninja_forms_register_spam" class="ninja-forms-field-error <?php echo $spam_error_class;?>"><br />
                <div id="_ninja_forms_form_<?php echo $form_id;?>_register_spam_error">
                    <?php
                    echo $spam_error_msg;
                    ?>
                </div>
            </div>


			<input type="submit" id="ninja_forms_form_<?php echo $form_id;?>_wp_register" name="_ninja_forms_wp_register" value="<?php _e($register_button_label, 'ninja-forms');?>" class="ninja-forms-display-wp-register ninja-forms-save-progress"> <input type="button" onclick="javascript:ninja_forms_toggle_login_register('register', <?php echo $form_id;?>);" id="ninja_forms_form_<?php echo $form_id;?>_hide_register_user" class="ninja-forms-display-hide-register-user" value="<?php _e($cancel_button_label, 'ninja-forms');?>">
			
		</div>
		<?php
	}
}