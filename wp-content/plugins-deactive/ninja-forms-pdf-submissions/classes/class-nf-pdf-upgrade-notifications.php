<?php
/**
 * PDF Notification Conversion
 * This class handles converting pre-2.8 NF forms to the notification & pdf attachment settings.
 *
 * @since       1.3
 */
if ( class_exists( 'NF_Step_Processing' ) ) {

    class NF_PDF_Upgrade_Notifications extends NF_Step_Processing {

        function __construct() {
            $this->action = 'pdf_convert_notifications';

            parent::__construct();
        }


        /**
         * Run our loading process.
         *
         * @since  1.3
         * @return array $args
         */
        public function loading() {

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

            // Get our total number of forms.
            $form_count = nf_get_form_count();

            // Get all our forms
            $forms = ninja_forms_get_all_forms( true );

            $x = 1;
            if ( is_array( $forms ) ) {
                foreach ( $forms as $form ) {
                    $this->args['forms'][$x] = $form['id'];
                    $x++;
                }
            }

            if ( empty( $this->total_steps ) || $this->total_steps <= 1 ) {
                $this->total_steps = $form_count;
            }

            $args = array(
                'total_steps' 	=> $this->total_steps,
                'step' 			=> 1,
            );

            $this->redirect = admin_url( 'index.php?page=nf-about' );

            return $args;
        }


        /**
         * This function is called for every step.
         *
         * @since  1.3
         * @return void
         */
        public function step() {
            global $ninja_forms_fields;

            // Get our form ID
            $form_id = $this->args['forms'][ $this->step ];

            // Get a list of forms that we've already converted.
            $completed_forms = get_option( 'nf_pdf_convert_notifications_forms', array() );

            // Bail if we've already converted the pdf notifications for this form.
            if ( in_array( $form_id, $completed_forms ) ) {
                return false;
            }

            // Grab our form from the database
            $form_settings = Ninja_Forms()->form( $form_id )->settings;

            // update the notifications
            $this->update_notification( $form_id, $form_settings );

            // add this form to the completed list of forms
            $completed_forms = get_option( 'nf_pdf_convert_notifications_forms' );
            if ( ! is_array( $completed_forms ) || empty ( $completed_forms ) ) {
                $completed_forms = array( $form_id );
            } else {
                $completed_forms[] = $form_id;
            }
            update_option( 'nf_pdf_convert_notifications_forms', $completed_forms );

            // Unset our old settings and save the form.
            if ( isset ( $form_settings['admin_attach_pdf'] ) || isset ( $form_settings['user_attach_pdf'] ) ) {
                unset( $form_settings['admin_attach_pdf'] );
                unset( $form_settings['user_attach_pdf'] );

                $args = array(
                    'update_array' => array(
                        'data'     => serialize( $form_settings ),
                    ),
                    'where'        => array(
                        'id'       => $form_id,
                    ),
                );

                ninja_forms_update_form( $args );
            }
        }


        /**
         * Update the user / admin notification
         *
         * @param  $form_id       int
         * @param  $form_settings array
         * @since  1.3
         * @return void
         */
        public function update_notification( $form_id, $form_settings ) {

            // see if the form is set to either add the pdf to the admins email or the users email or both
            $update_admin_pdf = false;
            if ( isset ( $form_settings['admin_attach_pdf'] ) &&
               ! empty ( $form_settings['admin_attach_pdf'] ) ) {
                 $update_admin_pdf = true;
            }
            $update_user_pdf = false;
            if ( isset ( $form_settings['user_attach_pdf'] ) &&
               ! empty ( $form_settings['user_attach_pdf'] ) ) {
                 $update_user_pdf = true;
            }

            // only update notifications for forms that had a admin or user pdf
            if ( $update_admin_pdf || $update_user_pdf ) {
                $notifications = nf_get_notifications_by_form_id( $form_id );
                if ( is_array( $notifications ) ) {
                    foreach ( $notifications as $id => $n ) {
                        // look for the notifications that were automatically created by NF 2.8 update and have the admin_email or user_email option set
                        if ( ( $update_admin_pdf && nf_get_object_meta_value( $id, 'admin_email' ) == true ) ||
                           ( $update_user_pdf && nf_get_object_meta_value( $id, 'user_email' ) == true )
                        ) {
                            // Update our attach pdf option
                            Ninja_Forms()->notification( $id )->update_setting( 'attach_pdf', 1 );
                        }
                    }
                }
            }
        }


        /**
         * This function is called for after the process has run.
         *
         * @since  1.3
         * @return void
         */
        public function complete() {
            update_option( 'nf_pdf_convert_notifications_complete', true );
        }
    }

    new NF_PDF_Upgrade_Notifications();
}
