<?php
/**
 * Plugin Name: Ninja Forms - PDF Form Submissions
 * Plugin URI: https://ninjaforms.com/extensions/pdf-form-submissions/
 * Description: Automatically convert form submissions into PDFs. View PDFs in backend or attach to form email.
<<<<<<< HEAD
 * Version: 1.3.4
 * Author: Never5
 * Author URI: http://www.never5.com/
=======
 * Version: 1.3.3
 * Author: Patrick Rauland
 * Author URI: http://www.patrickrauland.com/
>>>>>>> master
 * License: GPLv2
 */

/*
	Copyright 2015 Never5

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! class_exists( 'NF_PDF_Submission' ) ) {
	require 'classes/class-nf-pdf-submission.php';
	require 'classes/class-nf-pdf-activation.php';
	require 'classes/class-nf-pdf-integration.php';

	// set up a few constants we'll need for the extension & the updater
	define( 'NF_PDFSUBMISSION_PRODUCT_NAME', 'PDF Form Submission' );
<<<<<<< HEAD
	define( 'NF_PDFSUBMISSION_VERSION', '1.3.4' );
	define( 'NF_PDFSUBMISSION_AUTHOR', 'Never5' );
=======
	define( 'NF_PDFSUBMISSION_VERSION', '1.3.3' );
	define( 'NF_PDFSUBMISSION_AUTHOR', 'Patrick Rauland' );
>>>>>>> master
	define( 'NF_PDFSUBMISSION_PLUGIN_FILE', __FILE__ );

	// load templating functions
	include( 'include/pdf-templating.php' );

	global $NF_PDF_Submission, $NF_PDF_Integration;
<<<<<<< HEAD
	$NF_PDF_Submission  = new NF_PDF_Submission( __FILE__ );
=======
	$NF_PDF_Submission = new NF_PDF_Submission( __FILE__ );
>>>>>>> master
	$NF_PDF_Integration = new NF_PDF_Integration( __FILE__ );

	load_plugin_textdomain( 'nf-pdf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	// setup any activation functions
	$NF_PDF_Activation = new NF_PDF_Activation( __FILE__ );
	register_activation_hook( __FILE__, 'ninja_forms_activation' );

	/**
	 *    Setup the plugin database upgrader
	 */
	function ninja_forms_pdf_updater() {
		require 'classes/class-nf-pdf-upgrade-manager.php';
		require 'classes/class-nf-pdf-upgrade-notifications.php';
	}

	add_action( 'admin_init', 'ninja_forms_pdf_updater' );

	/**
	 *    Setup the updater & license page
	 */
	function ninja_forms_pdf_submission_setup_license() {
		if ( class_exists( 'NF_Extension_Updater' ) ) {
			$NF_Extension_Updater = new NF_Extension_Updater( NF_PDFSUBMISSION_PRODUCT_NAME, NF_PDFSUBMISSION_VERSION, NF_PDFSUBMISSION_AUTHOR, __FILE__, 'pdf_submission' );
		}
	}

	add_action( 'admin_init', 'ninja_forms_pdf_submission_setup_license' );
}
