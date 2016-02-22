<?php
/*
Plugin Name: Ninja Forms - Save Progress
Plugin URI: http://ninjaforms.com
Description: Save Progress add-on for Ninja Forms.
Version: 1.2.2
Author: The WP Ninjas
Author URI: http://ninjaforms.com
Text Domain: ninja-forms-sp
Domain Path: /lang/

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

define("NINJA_FORMS_SAVE_PROGRESS_DIR", WP_PLUGIN_DIR."/".basename( dirname( __FILE__ ) ) );
define("NINJA_FORMS_SAVE_PROGRESS_URL", plugins_url()."/".basename( dirname( __FILE__ ) ) );
define("NINJA_FORMS_SAVE_PROGRESS_VERSION", "1.2.2");

function ninja_forms_save_progress_setup_license() {
  if ( class_exists( 'NF_Extension_Updater' ) ) {
    $NF_Extension_Updater = new NF_Extension_Updater( 'Save User Progress', NINJA_FORMS_SAVE_PROGRESS_VERSION, 'WP Ninjas', __FILE__, 'save_progress' );
  }
}

add_action( 'admin_init', 'ninja_forms_save_progress_setup_license' );


/**
 * Load translations for add-on.
 * First, look in WP_LANG_DIR subfolder, then fallback to add-on plugin folder.
 */
function ninja_forms_sp_load_translations() {

  /** Set our unique textdomain string */
  $textdomain = 'ninja-forms-sp';

  /** The 'plugin_locale' filter is also used by default in load_plugin_textdomain() */
  $locale = apply_filters( 'plugin_locale', get_locale(), $textdomain );

  /** Set filter for WordPress languages directory */
  $wp_lang_dir = apply_filters(
    'ninja_forms_sp_wp_lang_dir',
    trailingslashit( WP_LANG_DIR ) . 'ninja-forms-sp/' . $textdomain . '-' . $locale . '.mo'
  );

  /** Translations: First, look in WordPress' "languages" folder = custom & update-secure! */
  load_textdomain( $textdomain, $wp_lang_dir );

  /** Translations: Secondly, look in plugin's "lang" folder = default */
  $plugin_dir = trailingslashit( basename( dirname( __FILE__ ) ) );
  $lang_dir = apply_filters( 'ninja_forms_sp_lang_dir', $plugin_dir . 'lang/' );
  load_plugin_textdomain( $textdomain, FALSE, $lang_dir );

}
add_action( 'plugins_loaded', 'ninja_forms_sp_load_translations' );

require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/admin/form-settings-metabox.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/admin/edit-sub-addon.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/admin/login-settings.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/admin/scripts.php");

require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/scripts.php");

require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/fields/restore-progress.php");

require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/login-form.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/save-progress-button.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/register-form.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/resume-link.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/sub-id.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/form-visibility.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/form/save-table.php");

require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/processing/save-progress.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/processing/register.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/processing/login.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/processing/save-sub-filter.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/display/processing/email-saved.php");

require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/activation.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/shortcode.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/functions.php");
require_once(NINJA_FORMS_SAVE_PROGRESS_DIR."/includes/deprecated.php");

register_activation_hook( __FILE__, 'ninja_forms_save_progress_activation' );

function nf_sp_pre_27() {
	if ( defined( 'NINJA_FORMS_VERSION' ) ) {
		if ( version_compare( NINJA_FORMS_VERSION, '2.7' ) == -1 ) {
			return true;
		} else {
			return false;
		}		
	} else {
		return null;
	}
}

/**
 * Get the saved copies of this form by user_id and form_id.
 * 
 * @since 1.1.3
 * @return array $subs
 */

function nf_sp_get_saved_form( $user_id, $form_id, $multi = false ){
	
	if ( nf_sp_pre_27() )
		return ninja_forms_get_saved_form( $user_id, $form_id, $multi );

	$args = array(
		'user_id' 	=> $user_id,
		'form_id' 	=> $form_id,
		'action' 	=> 'save',
	);

	$subs = Ninja_Forms()->subs()->get( $args );
	if ( is_array ( $subs ) && ! empty ( $subs ) ) {
		if( $multi ){
			return $subs;
		}else{
			return $subs[0];
		}		
	} else {
		return false;
	}
}

/*
 *
 * Function used to delete saved submissions if the user selects "Delete"
 * 
 * @since 1.1
 * @returns void
 */

function nf_sp_delete_save(){
	$sub_id = $_REQUEST['save_id'];
	$form_id = Ninja_Forms()->sub( $sub_id )->form_id;
	$user_id = get_current_user_id();
	if( Ninja_Forms()->form( $form_id )->get_setting( 'save_delete' ) == 1 && Ninja_Forms()->sub( $sub_id )->user_id == $user_id ){
		Ninja_Forms()->sub( $sub_id )->delete();
	}
	$redirect = remove_query_arg( array( 'nf_action', 'save_id' ) );
	wp_redirect( $redirect );
	die();
}

add_action( 'nf_sp_delete_save', 'nf_sp_delete_save' );