<?php
require_once( NINJA_FORMS_UPLOADS_DIR . '/includes/lib/s3/s3.php' );

/**
 * Class External_Amazon
 */
class External_Amazon extends NF_Upload_External {

	private $title = 'Amazon S3';

	private $slug = 'amazon';

	private $settings;

	private $connected_settings = false;

	private $file_path = false;

	function __construct() {
		$this->set_settings();
		parent::__construct( $this->title, $this->slug, $this->settings );
	}

	private function set_settings() {
		$this->settings = array(
			array(
				'name'  => 'amazon_s3_access_key',
				'type'  => 'text',
				'label' => __( 'Access Key', 'ninja-forms-uploads' ),
				'desc'  => '',
			),
			array(
				'name'  => 'amazon_s3_secret_key',
				'type'  => 'text',
				'label' => __( 'Secret Key', 'ninja-forms-uploads' ),
				'desc'  => '',
			),
			array(
				'name'  => 'amazon_s3_bucket_name',
				'type'  => 'text',
				'label' => __( 'Bucket Name', 'ninja-forms-uploads' ),
				'desc'  => '',
			),
			array(
				'name'          => 'amazon_s3_file_path',
				'type'          => 'text',
				'label'         => __( 'File Path', 'ninja-forms-uploads' ),
				'desc'          => __( 'The default file path in the bucket where the file will be uploaded to', 'ninja-forms-uploads' ),
				'default_value' => 'ninja-forms/'
			),
		);
	}

	public function is_connected() {
		$data = get_option( 'ninja_forms_settings' );
		if ( ( isset( $data['amazon_s3_access_key'] ) && $data['amazon_s3_access_key'] != '' ) &&
		     ( isset( $data['amazon_s3_secret_key'] ) && $data['amazon_s3_secret_key'] != '' ) &&
		     ( isset( $data['amazon_s3_bucket_name'] ) && $data['amazon_s3_bucket_name'] != '' ) &&
		     ( isset( $data['amazon_s3_file_path'] ) && $data['amazon_s3_file_path'] != '' )
		) {
			return true;
		}

		return false;
	}

	private function load_settings() {
		if ( ! $this->connected_settings ) {
			$data                     = get_option( 'ninja_forms_settings' );
			$settings                 = array();
			$settings['access_key']   = $data['amazon_s3_access_key'];
			$settings['secret_key']   = $data['amazon_s3_secret_key'];
			$settings['bucket_name']  = $data['amazon_s3_bucket_name'];
			$settings['file_path']    = $data['amazon_s3_file_path'];
			$this->connected_settings = $settings;
		}
	}

	private function prepare( $path = false ) {
		$this->load_settings();
		if ( ! $path ) {
			$path = apply_filters( 'ninja_forms_uploads_' . $this->slug . '_path', $this->connected_settings['file_path'] );
		} else if ( $path == '' ) {
			$path = $this->connected_settings['file_path'];
		}
		$this->file_path = $this->sanitize_path( $path );

		return new S3( $this->connected_settings['access_key'], $this->connected_settings['secret_key'] );
	}

	public function upload_file( $file, $path = false ) {
		$s3       = $this->prepare( $path );
		$filename = $this->get_filename_external( $file );
		$s3->putObjectFile( $file, $this->connected_settings['bucket_name'], $this->file_path . $filename, S3::ACL_PUBLIC_READ );

		return array( 'path' => $this->file_path, 'filename' => $filename );
	}

	public function file_url( $filename, $path = '' ) {
		$s3 = $this->prepare( $path );

		return $s3->getAuthenticatedURL( $this->connected_settings['bucket_name'], $this->file_path . $filename, 3600 );
	}
}