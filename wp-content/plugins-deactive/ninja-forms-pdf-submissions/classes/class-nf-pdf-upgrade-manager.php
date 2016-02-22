<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
 * Ninja Forms - PDF Upgrade Manager
 *
 * Check if the database needs any updates when upgrading
 *
 * @author Patrick Rauland
 * @since 1.3.0
 */
class NF_PDF_Upgrade_Manager {

    /**
     * Construct
     *
     * @since 1.3
     * @param string $file
     */
    public function __construct( $file ) {

        add_action( 'admin_notices', array( $this, 'display_upgrade_notices' ) );

    }


    /**
     * Display Upgrade Notices
     *
     * @since  1.3
     * @return void
     */
    public function display_upgrade_notices( ) {

        // Don't show notices on the processing page or upgrade page
        if ( isset ( $_GET['page'] ) && ( $_GET['page'] == 'nf-processing' || $_GET['page'] == 'nf-upgrades') ) {
            return;
        }

        // update the notifications for NF 2.8
        $this->nf_2_8_notifications();

    }


    /**
     * Check to see if we need to update the notifications for NF 2.8
     *
     * @since  1.3
     * @return void
     */
    public function nf_2_8_notifications( ) {

        // Convert notifications
        $notifications_update     = get_option( 'nf_convert_notifications_complete', false );
        $pdf_notifications_update = get_option( 'nf_pdf_convert_notifications_complete', false );

        // only show if the regular notifications update is complete and the pdf notifications updates isn't yet complete
        if ( defined( 'NINJA_FORMS_VERSION' ) && version_compare(NINJA_FORMS_VERSION, '2.8', '>=' ) && $notifications_update && ! $pdf_notifications_update ) {
            printf(
                '<div class="update-nag"><p>' . __( 'Ninja Forms PDF Form Submissions needs to upgrade your form notifications, <a href="%s">start the upgrade</a>.', 'nf-pdf' ) . '</p></div>',
                admin_url( 'index.php?page=nf-processing&action=pdf_convert_notifications' )
            );
        }

    }
}
new NF_PDF_Upgrade_Manager( __FILE__ );
