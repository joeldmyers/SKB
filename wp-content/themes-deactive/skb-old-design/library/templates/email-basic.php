<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $email_title; ?></title>
        <style type="text/css">
			/* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

			/* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table{border-collapse:collapse !important;}
			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

			/* ========== Page Styles ========== */

			#bodyCell{padding:20px;}
			#templateContainer{width:600px;}

			body, #bodyTable{
				background-color:#FFFFFF;
			}

			#bodyCell{

			}

			#templateContainer{
				
			}

			h1{
				color:#202020 !important;
				display:block;
				font-family:Helvetica;
				font-size:26px;
				font-style:normal;
				font-weight:bold;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			h2{
				color:#404040 !important;
				display:block;
				font-family:Helvetica;
				font-size:20px;
				font-style:normal;
				font-weight:bold;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			h3{
				color:#606060 !important;
				display:block;
				font-family:Helvetica;
				font-size:16px;
				font-style:italic;
				font-weight:normal;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			h4{
				color:#808080 !important;
				display:block;
				font-family:Helvetica;
				font-size:14px;
				font-style:italic;
				font-weight:normal;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}

			/* ========== Header Styles ========== */

			#templateHeader{

			}

			#templateLogo{
				border-top:4px solid #00263d;
			}

			/**
			* @tab Header
			* @section header text
			* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
			*/
			.headerContent{
				color:#505050;
				font-family:Helvetica;
				font-size:20px;
				font-weight:bold;
				line-height:100%;
				padding-top:0;
				padding-right:0;
				padding-bottom:0;
				padding-left:0;
				text-align:left;
				vertical-align:middle;
			}

			#headerLogo {
				max-width:320px; 
				padding: 20px;
			}

			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				color:#EB4102;
				font-weight:normal;
				text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:600px;
			}

			/* ========== Body Styles ========== */

			#templateBody{
				background-color:#FFFFFF;
			}

			.bodyContent{
				color:#505050;
				font-family:Helvetica;
				font-size:14px;
				line-height:150%;
				padding-top:20px;
				padding-right:20px;
				padding-bottom:20px;
				padding-left:20px;
				text-align:left;
			}

			.bodyContent a:link, .bodyContent a:visited, /* Yahoo! Mail Override */ .bodyContent a .yshortcuts /* Yahoo! Mail Override */{
				color:#EB4102;
				font-weight:normal;
				text-decoration:underline;
			}

			.bodyContent img{
				display:inline;
				height:auto;
				max-width:560px;
			}

			/* ========== Footer Styles ========== */

			#templateFooter{
				background-color:#FFFFFF;
			}

			.footerContent{
				color:#808080;
				font-family:Helvetica;
				font-size:10px;
				line-height:150%;
				padding-top:20px;
				padding-right:20px;
				padding-bottom:20px;
				padding-left:20px;
				text-align:left;
			}

			.footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{
				color:#606060;
				font-weight:normal;
				text-decoration:underline;
			}

			/* /\/\/\/\/\/\/\/\/ MOBILE STYLES /\/\/\/\/\/\/\/\/ */

            @media only screen and (max-width: 480px){
				/* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */
                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */

				/* /\/\/\/\/\/\/ MOBILE RESET STYLES /\/\/\/\/\/\/ */
				#bodyCell{padding:10px !important;}

				/* /\/\/\/\/\/\/ MOBILE TEMPLATE STYLES /\/\/\/\/\/\/ */

				/* ======== Page Styles ======== */

				#templateContainer{
					max-width:600px !important;
					width:100% !important;
				}

				h1{
					font-size:24px !important;
					line-height:100% !important;
				}

				h2{
					font-size:20px !important;
					line-height:100% !important;
				}

				h3{
					font-size:18px !important;
					line-height:100% !important;
				}

				h4{
					font-size:16px !important;
					line-height:100% !important;
				}

				/* ======== Header Styles ======== */

				#templatePreheader{display:none !important;} /* Hide the template preheader to save space */

				#headerImage{
					height:auto !important;
					max-width:600px !important;
					width:100% !important;
				}

				.headerContent{
					font-size:20px !important;
					line-height:125% !important;
				}

				/* ======== Body Styles ======== */

				.bodyContent{
					font-size:18px !important;
					line-height:125% !important;
				}

				/* ======== Footer Styles ======== */

				.footerContent{
					font-size:14px !important;
					line-height:115% !important;
				}

				.footerContent a{display:block !important;} /* Place footer social and utility links on their own lines, for easier access */
			}
		</style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
            	<tr>
                	<td align="center" valign="top" id="bodyCell">
                    	<!-- BEGIN TEMPLATE // -->
                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                           	<!-- BEGIN HEADER // -->
                            <tr>
                            	<td align="left" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateLogo">
                                        <tr>
                                            <td valign="top" class="headerContent">
                                            	<img src="<?php echo home_url( '/wp-content/themes/skb/library/images/logo.png' ); ?>" style="max-width:320px; padding: 20px;" id="headerLogo" />
                                            </td>
                                        </tr>
                                    </table>
                            	</td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                                        <tr>
                                            <td valign="top" class="headerContent">
                                            	<img src="<?php echo home_url( '/wp-content/themes/skb/library/images/email_header.png' ); ?>" style="max-width:600px;" id="headerImage" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- // END HEADER -->
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN BODY // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td valign="top" class="bodyContent">
                                                <?php 
                                                if ( $email_body != '' ) { echo '<p>', $email_body, '</p>'; }
                                                if ( $email_footer != '' ) { echo '<p>', $email_footer, '</p>'; }
                                               	?>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN FOOTER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                        <tr>
                                            <td valign="top" class="footerContent" style="padding-top:0;">
                                                <p><strong>SKB IN CROWD</strong>
                                                <br />810 NW Marshall Street 
                                                <br />Portland, Oregon 97209
                                                <br />877-795-4679</p>
                                                <p><em>Copyright &copy; <?php echo date('Y'); ?> ScanlanKemperBard Companies. All rights reserved.</em></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>