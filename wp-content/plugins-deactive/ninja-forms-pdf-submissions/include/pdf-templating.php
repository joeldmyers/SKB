<?php

define("NF_PDF_TEMPLATE_URL", apply_filters( 'nf_pdf_template_url', 'ninja-forms-pdf-submissions/' ) );

/**
 * Get other templates passing attributes and including the file.
 *
 * @access public
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function nf_pdf_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	if ( $args && is_array($args) ) {
		extract( $args );
	}

	$located = nf_pdf_locate_template( $template_name, $template_path, $default_path );

	do_action( 'nf_pdf_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'nf_pdf_after_template_part', $template_name, $template_path, $located, $args );
}


/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *     yourtheme      /  $template_path  /  $template_name
 *     yourtheme      /  $template_name
 *     $default_path  /  $template_name
 *
 * @access public
 * @param mixed $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function nf_pdf_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// set a default template directory url
	if ( ! $template_path ) {
		$template_path = NF_PDF_TEMPLATE_URL;
	}
	if ( ! $default_path ) {
		$default_path = NF_PDF_TEMPLATE_URL . '/templates/';
	}

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name, $template_name
		)
	);

	// Get default template if we couldn't find anything in the theme
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	// Return what we found
	return apply_filters( 'nf_pdf_locate_template', $template, $template_name, $template_path );
}