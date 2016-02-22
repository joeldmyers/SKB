<?php
/**
 * PDF Included With Form Submission
 *
 * @author 		Patrick Rauland
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<html>
<head>
	<link type="text/css" href="pdf.css" rel="stylesheet" />
</head>
<body>	
	<img src="../library/images/logo.png"/>	
	<h1><?php echo $title; ?></h1>
	<?php 
	global $ninja_forms_processing;

	$form_id = $ninja_forms_processing->get_form_ID();

	$date_submitted = '<p>Executed this ' . date('jS') . ' day of ' . date('F') . ', ' . date('Y') . '</p>';
	$names = '';
	$signatures = '';
	
	switch ( $form_id ) {

		case 2: // Individual
			$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 18 ) . ' ' . $ninja_forms_processing->get_field_value( 17 ) . '</p>';
			$signatures = '<p>Individual Signature : </p>';
			break;

		case 3: // Invest in this Deal

			// Which Entity did they select
			switch ( $ninja_forms_processing->get_field_value( 831 ) ) {

				case 'Trust':
					$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 1352 ) . '</p>';		
					$names .= '<p>Name of Trustee : ' . $ninja_forms_processing->get_field_value( 1777 ) . ' ' . $ninja_forms_processing->get_field_value( 77 ) . '</p>';
					$signatures = '<p>Trustees Signature : </p>';
					if ( 'checked' == $ninja_forms_processing->get_field_value( 1776 ) ) {
						$names .= '<p>Name of Co-Trustee : ' . $ninja_forms_processing->get_field_value( 1607 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 ) . '</p>';
						$signatures .= '<p>Co-Trustee Signature : </p>';
					}
					break;

				case 'Joints':
					$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 76 ) . ' ' . $ninja_forms_processing->get_field_value( 77 ) . '</p>';
					$names .= '<p>Name of Joint Tenant : ' . $ninja_forms_processing->get_field_value( 1603 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 ) . '</p>';
					$signatures = '<p>Individual Signature : </p>';
					$signatures .= '<p>Joint Tenant Signature : </p>';
					break;

				case 'Tenants in Common':
					$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 76 ) . ' ' . $ninja_forms_processing->get_field_value( 77 ) . '</p>';
					$names .= '<p>Name of Tenant in Common : ' . $ninja_forms_processing->get_field_value( 1597 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 ) . '</p>';
					$signatures = '<p>Individual Signature : </p>';
					$signatures .= '<p>Tenant in Common Signature : </p>';
					break;

				case 'Community Property':
					$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 76 ) . ' ' . $ninja_forms_processing->get_field_value( 77 ) . '</p>';
					$names .= '<p>Name of Spouse : ' . $ninja_forms_processing->get_field_value( 1606 ) . ' ' . $ninja_forms_processing->get_field_value( 1598 ) . '</p>';
					$signatures = '<p>Individual Signature : </p>';
					$signatures .= '<p>Spouse Signature : </p>';
					break;

				case 'Individual Retirement Account':
					$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 1352 ) . '</p>';
					$names .= '<p>Beneficial Owner : ' . $ninja_forms_processing->get_field_value( 76 ) . ' ' . $ninja_forms_processing->get_field_value( 77 ) . '</p>';
					$signatures = '<p>Beneficial Signature : </p>';
					break;

				case 'Limited Partnership':
					$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 1352 ) . '</p>';
					$names .= '<p>Name of General Partner : ' . $ninja_forms_processing->get_field_value( 1796 ) . '</p>';
					if ( 'checked' == $ninja_forms_processing->get_field_value( 1782 ) ) {
						$names .= '<p>Name of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 1796 ) . '</p>';
						$names .= '<p>Title of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 1785 ) . '</p>';
						$signatures = '<p>Authorized Officer Signature : </p>';
					} else {
						$signatures = '<p>General Partner Signature : </p>';
					}
					break;

				case 'Limited Liability Company':
					$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 1352 ) . '</p>';
					$names .= '<p>Name of Authorized Member : ' . $ninja_forms_processing->get_field_value( 834 ) . '</p>';
					$names .= '<p>Title of Authorized Member : ' . $ninja_forms_processing->get_field_value( 837 ) . '</p>';
					$signatures = '<p>Authorized Signature : </p>';
					if ( 'checked' == $ninja_forms_processing->get_field_value( 1795 ) ) {
						$names .= '<p>Name of Authorized Member 2 : ' . $ninja_forms_processing->get_field_value( 951 ) . '</p>';
						$names .= '<p>Title of Authorized Member 2 : ' . $ninja_forms_processing->get_field_value( 952 ) . '</p>';
						$signatures .= '<p>Authorized Signature 2 : </p>';
					}
					break;

				case 'Corporation':
					$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 1352 ) . '</p>';
					$names .= '<p>Name of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 834 ) . '</p>';
					$names .= '<p>Title of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 837 ) . '</p>';
					$signatures = '<p>Authorized Signature : </p>';
					if ( 'checked' == $ninja_forms_processing->get_field_value( 1795 ) ) {
						$names .= '<p>Name of Authorized Officer 2 : ' . $ninja_forms_processing->get_field_value( 951 ) . '</p>';
						$names .= '<p>Title of Authorized Officer 2 : ' . $ninja_forms_processing->get_field_value( 952 ) . '</p>';
						$signatures .= '<p>Authorized Signature 2 : </p>';
					}
					break;

				case 'Individual Investor':
				default:
					$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 76 ) . ' ' . $ninja_forms_processing->get_field_value( 77 ) . '</p>';
					$signatures = '<p>Individual Signature : </p>';
					break;

			}

			break;

		case 4: // Trust
			$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 153 ) . '</p>';		
			$names .= '<p>Name of Trustee : ' . $ninja_forms_processing->get_field_value( 100 ) . ' ' . $ninja_forms_processing->get_field_value( 101 ) . '</p>';
			$signatures = '<p>Trustees Signature : </p>';
			if ( $ninja_forms_processing->get_field_value( 1596 ) ) {
				$names .= '<p>Name of Co-Trustee : ' . $ninja_forms_processing->get_field_value( 1592 ) . ' ' . $ninja_forms_processing->get_field_value( 1593 ) . '</p>';
				$signatures .= '<p>Co-Trustee Signature : </p>';
			}
			break;

		case 6: // Joint Tenants
			$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 178 ) . ' ' . $ninja_forms_processing->get_field_value( 179 ) . '</p>';
			$names .= '<p>Name of Joint Tenant : ' . $ninja_forms_processing->get_field_value( 1210 ) . ' ' . $ninja_forms_processing->get_field_value( 1211 ) . '</p>';
			$signatures = '<p>Individual Signature : </p>';
			$signatures .= '<p>Joint Tenant Signature : </p>';
			break;

		case 7: // Tenants in Common
			$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 242 ) . ' ' . $ninja_forms_processing->get_field_value( 243 ) . '</p>';
			$names .= '<p>Name of Tenant in Common : ' . $ninja_forms_processing->get_field_value( 1229 ) . ' ' . $ninja_forms_processing->get_field_value( 1231 ) . '</p>';
			$signatures = '<p>Individual Signature : </p>';
			$signatures .= '<p>Tenant in Common Signature : </p>';
			break;

		case 8: // Community Property
			$names = '<p>Name of Individual : ' . $ninja_forms_processing->get_field_value( 306 ) . ' ' . $ninja_forms_processing->get_field_value( 307 ) . '</p>';
			$names .= '<p>Name of Spouse : ' . $ninja_forms_processing->get_field_value( 1254 ) . ' ' . $ninja_forms_processing->get_field_value( 1255 ) . '</p>';
			$signatures = '<p>Individual Signature : </p>';
			$signatures .= '<p>Spouse Signature : </p>';
			break;

		case 9: // Individual Retirement Account
			$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 375 ) . '</p>';
			$names .= '<p>Beneficial Owner : ' . $ninja_forms_processing->get_field_value( 371 ) . ' ' . $ninja_forms_processing->get_field_value( 372 ) . '</p>';
			$signatures = '<p>Beneficial Signature : </p>';
			break;

		case 11: // Limited Partnership
			$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 508 ) . '</p>';
			if ( 'checked' == $ninja_forms_processing->get_field_value( 1937 ) ) {
				$names .= '<p>Name of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 1587 ) . '</p>';
				$signatures = '<p>Authorized Officer Signature : </p>';
			} else {
				$names .= '<p>Name of General Partner : ' . $ninja_forms_processing->get_field_value( 1584 ) . '</p>';
				$signatures = '<p>General Partner Signature : </p>';
			}
			break;

		case 12: // Limited Liability Corporation
			$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 589 ) . '</p>';
			$names .= '<p>Name of Authorized Member : ' . $ninja_forms_processing->get_field_value( 585 ) . ' ' . $ninja_forms_processing->get_field_value( 586 ) . '</p>';
			$signatures = '<p>Authorized Signature : </p>';
			break;

		case 14: // Corporation
			$names = '<p>Entity Name : ' . $ninja_forms_processing->get_field_value( 747 ) . '</p>';
			$names .= '<p>Name of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 1588 ) . '</p>';
			$names .= '<p>Title of Authorized Officer : ' . $ninja_forms_processing->get_field_value( 1589 ) . '</p>';
			$signatures = '<p>Authorized Officer Signature : </p>';
			break;

		default: 
			break;

	}

	echo $table;
	echo '<hr>';
	// echo '<div style="page-break-after: always;"></div>';
	echo $date_submitted;
	echo $names;
	echo $signatures;

	?>
</body>
</html>