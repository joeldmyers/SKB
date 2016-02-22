<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// class already exists abort abort!
if ( class_exists( 'NF_PDF_Integration' ) ) {
	return;
}

/*
 * Ninja Forms - PDF Integration
 *
 * Make sure that PDF Form Submissions works great with other plugins.
 *
 * @author Patrick Rauland
 * @since 1.3.3
 */
class NF_PDF_Integration {

	/**
	 * Construct
	 *
	 * @since 1.3.3
	 * @param string $file
	 */
	public function __construct( $file ) {
		add_filter( 'ninja_forms_pdf_pre_user_value', array( $this, 'file_uploads' ), 10 );
	}

	/**
	 * Init the extension settings
	 *
	 * @since  1.3.3
	 * @return string
	 */
<<<<<<< HEAD
	public function file_uploads( $field_value ) {

		// check to make sure it's an array. File upload values are always arrays
		if ( is_array( $field_value ) ) {

            $return = array();

            $values = array_values( $field_value );

            foreach( $values as $value ){

                // check to make sure the file_url key exists
                if( is_array( $value ) && array_key_exists( 'file_url', $value ) && $value['file_url'] ){

                    // set the value of the field in the pdf equal to the file url.
                    $return[] = esc_url( $value['file_url'] );

                }
            }

            $field_value = implode( ', ', $return );
		}

		return $field_value;
=======
	public function file_uploads( $value ) {

		// check to make sure it's an array. File upload values are always arrays
		if ( is_array( $value ) ) {
			// get the first inner array if there is one.
                    $array_vals = array_values($value);
			$inner_arr = $array_vals[0];

			// check to make sure the file_url key exists
			if ( is_array( $inner_arr ) && array_key_exists( 'file_url', $inner_arr ) && $inner_arr['file_url'] ) {
				// set the value of the field in the pdf equal to the file url.
				$value = esc_url( $inner_arr['file_url'] );
			}
		}
		return $value;
>>>>>>> master
	}
}
