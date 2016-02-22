<?php
/*
 * Ninja Forms - PDF Submission
 *
 * Automatically convert form submissions into PDFs. View PDFs in backend or attach to form email.
 *
 * @package WordPress
 * @author Patrick Rauland
 * @since 1.0.0
 */
class NF_PDF_Submission {

	// the path to the Ninja Forms PDF Submissions templates
	private $template_base;

	/**
	 * Construct
	 *
	 * @param string $file
	 */
	public function __construct( $file ) {

		// load the template path for this plugin
		$this->template_base = plugin_dir_path( NF_PDFSUBMISSION_PLUGIN_FILE ) . 'templates/';

		// let's get this plugin started!
		add_action( 'nf_email_notification_attachment_types', array( $this, 'load_fields' ), 20 );
		add_action( 'init', array( $this, 'init' ), 10 );

		// handle exporting PDFs from view submission page
		if( isset( $_REQUEST['ninja_forms_export_subs_to_pdf'] ) AND $_REQUEST['ninja_forms_export_subs_to_pdf'] != '' ) {
			add_action( 'admin_init', array( $this, 'bulk_export_pdf' ) );
		}

	}


	/**
	 * Init the extension settings
	 *
	 * @return void
	 */
	public function init() {

		// make sure the required functions exist before loading anything
		if( function_exists( 'ninja_forms_get_csv_delimiter' ) &&
			function_exists( 'ninja_forms_get_csv_enclosure' ) &&
			function_exists( 'ninja_forms_get_csv_terminator' ) &&
			function_exists( 'ninja_forms_export_subs_to_csv' ) ) {

			// add the pdf to the email notification
			add_action( 'nf_email_notification_attachments', array( $this, 'add_pdf_attachment' ), 10, 2 );

			// add link on form submission page
			add_filter( 'ninja_forms_sub_table_row_actions', array( $this, 'add_pdf_download_link' ), 40, 4 );

		} else {
			// throw an error
			add_action( 'admin_notices', array( $this, 'ninja_form_functions_notice' ) );
		}
	}


	/**
	 * Load the fields on the notification page
	 *
	 * @return void
	 */
	public function load_fields( $attachment_types ) {

		// we need to add PDF to the list of available attachment options
		$attachment_types['attach_pdf'] = 'Submission PDF';

		return $attachment_types;

	}


	/**
	 * Add the PDF attachment
	 *
	 * @return void
	 */
	public function add_pdf_attachment( $attachments, $id ) {
		global $ninja_forms_processing;

		// make sure this form is supposed to attach a PDF
		if ( Ninja_Forms()->notification( $id )->get_setting( 'attach_pdf' ) ){

			// Get our submission ID
			$sub_id = $ninja_forms_processing->get_form_setting( 'sub_id' );

			// convert submission id to array
			$sub_ids = array( $sub_id );

			// create PDF
			$pdf_content = $this->create_pdf_content( $sub_id );

			// create temporary file
			$new_file = $this->create_temp_file( $pdf_content, $sub_id );

			// add new file to attachment array
			$attachments[] = $new_file;
		}

		return $attachments;
	}


	/**
	 * Create the PDF
	 *
	 * @return string - pdf content
	 */
	public function create_pdf_content( $sub_id ) {

		// include the DOMPDf class
		require_once( WP_PLUGIN_DIR . "/ninja-forms-pdf-submissions/lib/dompdf/dompdf_config.inc.php");

		// get an array of fields and field values
		$fields = $this->get_form_submission( $sub_id );

		// create table of results
		$table = $this->create_results_table( $fields );

		// get form title
		$title = $this->get_form_title( $sub_id );

		// get form ID
		$submission = ninja_forms_get_sub_by_id( $sub_id );
		$form = ninja_forms_get_form_by_id( $submission['form_id'] );
		$form_ID = $form['id'];

		// format the HTML
		ob_start();
		nf_pdf_get_template( 'pdf.php', array( 'title' => $title, 'table' => $table, 'fields' => $fields, 'form_ID' => $form_ID ), '', $this->template_base );
		$html = ob_get_clean();

		// Create the PDF
		$dompdf = new DOMPDF();
		$dompdf->set_base_path( realpath( WP_PLUGIN_DIR . '/ninja-forms-pdf-submissions/include/' ) );
		$dompdf->load_html( $html );
		$dompdf->render();
		$output = $dompdf->output();

		return $output;
	}

	/**
	 * Create the PDF
	 *
	 * @return string - html table
	 */
	public function create_results_table( $fields ) {

		// open buffer
		ob_start();

		// loop through each row and create the html table
		echo "<table>";
		foreach ( $fields as $field ) {
			echo "<tr>";
			echo "<td>" . $field['label'] . "</td>";
			echo "<td>" . $field['value'] . "</td>";
			echo "</tr>\n";
		}
		echo "</table>";

		$table = ob_get_clean();

		return $table;
	}


	/**
	 * Get the form title
	 *
	 * @param  int    - $sub_id - submission id
	 * @return string - html table
	 */
	public function get_form_title( $sub_id ) {
		global $ninja_forms_processing;

		$form_title = false;

		// make sure the form title is set
		if ( isset( $ninja_forms_processing )  &&
			 isset( $ninja_forms_processing->data ) &&
			 isset( $ninja_forms_processing->data['form'] ) &&
			 isset( $ninja_forms_processing->data['form']['form_title'] ) ) {

			// set the form title
			$form_title = $ninja_forms_processing->data['form']['form_title'];
		} else {
			// if we're not currently processing the form we need to get the title from the database
			$submission = ninja_forms_get_sub_by_id( $sub_id );
			$form = ninja_forms_get_form_by_id( $submission['form_id'] );

			 // make sure we have the right data
			 if ( isset( $form ) &&
				  isset( $form['data'] ) &&
				  isset( $form['data']['form_title'] ) ) {
				 $form_title = $form['data']['form_title'];
			 }
		}

		return $form_title;
	}


	/**
	 * Return the form submission
	 *
	 * @param  int   - $sub_id - the submission id of the form
	 * @return array
	 */
	public function get_form_submission( $sub_id ) {

		global $ninja_forms_fields;

		// Get the fields attached to the Form ID
		$submission = ninja_forms_get_sub_by_id( $sub_id );

		// make sure we have some data
		if ( is_array( $submission ) && is_array( $submission['data'] ) ) {

			$results = array();

			// before looping through the fields let's add the date to the results
			// default is off but can be turned on via a filter
			if ( apply_filters( 'ninja_forms_submission_pdf_fetch_date', false, $sub_id ) && isset( $submission['date_updated'] ) ) {
				$results[] = array (
					'label' => __( 'Date Submitted', 'nf-pdf' ),
					'value' => $this->get_form_submission_date( $submission['date_updated'] )
				);
			}

			// we should also add the option to add the sequential number to the form
			// default is off but can be turned on via a filter
			if ( apply_filters( 'ninja_forms_submission_pdf_fetch_sequential_number', false, $sub_id ) ) {
				$results[] = array (
					'label' => __( 'Form Submission ID', 'nf-pdf' ),
					'value' => Ninja_Forms()->sub( $sub_id )->get_seq_num()
				);
			}

			// loop through the fields
			foreach( $submission['data'] as $key => $value ) {

				$user_value = apply_filters( 'ninja_forms_pdf_pre_user_value', $value['user_value'] );
				// if the user submitted value is an array we need to make it pretty
				if ( is_array( $user_value ) ) {
					$user_value = implode( ", ", $user_value );
				}

				// get field data
				$field = ninja_forms_get_field_by_id( $value['field_id'] );

				// get the field type settings
				if ( isset( $field ) && isset( $field['type'] ) ) {
					$field_type = $field['type'];
					// make sure the field type exists
					if ( isset( $ninja_forms_fields[$field_type] ) ){
						$reg_field = $ninja_forms_fields[$field_type];
						// make sure the field data is being processed and saved and the data is set.
						// this makes sure it isn't a weird "field" like a page divider or the submit button
						if ( $reg_field['process_field'] && $reg_field['save_sub'] && isset ( $field['data']['label'] ) && ( false != $user_value ) ) {
							// get the field label
							$label = '';
							if ( isset ( $field['data']['admin_label'] ) && ! empty ( $field['data']['admin_label'] ) ) {
								$label = $field['data']['admin_label'];
							} else if ( isset ( $field['data']['label'] ) ) {
								$label = $field['data']['label'];
							}

							// save field label & value in a variable to return at the end
							$results[ $value['field_id'] ] = array (
								'label' => $label,
								'value' => apply_filters( 'ninja_forms_pdf_field_value', wpautop( html_entity_decode( $user_value ) ), $value['field_id'], $field )
							);
						}
					}
				}
			}
		}
		return $results;
	}


	/**
	* Get the date of the form submission and return it based on NF settings
	*
	* @param  string - $submission_date - the date of the submission
	* @return string
	*/
	public function get_form_submission_date( $submission_date ) {

		// get NF date format
		$plugin_settings = nf_get_settings();
		if ( isset( $plugin_settings['date_format'] ) AND '' != $plugin_settings['date_format'] ) {
			$date_format = $plugin_settings['date_format'];
		} else {
			$date_format = 'm/d/Y';
		}

		$date = strtotime( $submission_date );
		$date = date( $date_format, $date );

		return $date;
	}


	/**
	 * Create temporary file
	 *
	 * @return string - location of file
	 */
	public function create_temp_file( $content, $sub_id ) {

		// create temporary file
		$path = tempnam( get_temp_dir(), 'Sub' );
		$temp_file = fopen( $path, 'r+' );

		// write to temp file
		fwrite( $temp_file, $content );
		fclose( $temp_file );

		// find the directory we will be using for the final file
		$path = pathinfo( $path );
		$dir = $path['dirname'];
		$basename = $path['basename'];

		// create name for file
		$new_name = $this->get_pdf_file_name( 'ninja-forms-submission' . $sub_id, $sub_id );

		// remove a file if it already exists
		if ( file_exists( $dir.'/'.$new_name.'.pdf' ) ) {
			unlink( $dir.'/'.$new_name.'.pdf' );
		}

		// move file
		rename( $dir.'/'.$basename, $dir.'/'.$new_name.'.pdf' );
		$new_file = $dir.'/'.$new_name.'.pdf';

		return $new_file;
	}


	/**
	 * Add PDF download link on the view form submission page
	 */
	public function add_pdf_download_link( $row_actions, $data, $sub_id, $form_id ) {

		// create download link
		$pdf_download_link = add_query_arg( array('ninja_forms_export_subs_to_pdf' => 1, 'sub_id' => $sub_id, 'form_id' => $form_id ) );

		// turn on the output buffer
		ob_start();
		?>
		<span class="export"><a href="<?php echo $pdf_download_link;?>" class="ninja-forms-export-sub-pdf"><?php _e( 'Export to PDF', 'nf-pdf' ); ?></a></span>
		<?php
		$action = ob_get_clean();

		// return the new html with the rest of the $row_actions array
		$row_actions['export_pdf'] = $action;
		return $row_actions;
	}


	/**
	 * Add PDF download link on the view form submission page
	 *
	 * @param $name   name of the file
	 * @param $sub_id submission id
	 * @since 1.3.3
	 */
	public function get_pdf_file_name( $name = 'ninja-forms-submission', $sub_id = '' ) {
		return apply_filters( 'ninja_forms_submission_pdf_name', $name, $sub_id );
	}


	/**
	 * Bulk export the PDFs
	 */
	public function bulk_export_pdf( ) {

		// make sure we have the right data
		if( isset( $_REQUEST['sub_id'] ) AND $_REQUEST['sub_id'] != '' ) {

			$sub_id = $_REQUEST['sub_id'];

			// get submission ids
			$sub_ids = array( esc_html( $sub_id ) );

			// loop through each submission and create the pdf
			foreach(  $sub_ids as $key => $value) {
				$pdf_content = $this->create_pdf_content( $value );
				$file_name   = $this->get_pdf_file_name( $value );

				header( "Content-type: application/pdf" );
				header( "Content-Disposition: attachment; filename=" . $file_name . ".pdf"  );
				header( "Pragma: no-cache" );
				header( "Expires: 0" );

				echo $pdf_content;

				die();
			}

		}
	}


	/**
	 * Add a notice to the admin screen letting users know that they don't have all of the required NF functions
	 */
	public function ninja_form_functions_notice( ) {
		?>
		<div class="error">
			<p><?php _e( 'You don&#39;t seem to have all of the required Ninja Form functions for Ninja Form PDF Submissions to work. Please update to the latest version of Ninja Forms.', 'nf-pdf' ); ?></p>
		</div>
		<?php
	}

}
