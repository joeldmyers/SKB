=== Plugin Name ===
Contributors: blueliquiddesigns
Donate link: https://gravitypdf.com
Tags: gravity, forms, pdf, automation, attachment
Requires at least: 3.9
Tested up to: 4.3
Stable tag: 3.7.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl.txt

Automatically generate, email and download PDF documents with Gravity Forms and Gravity PDF.

== Description ==


If you have ever used Gravity Forms you’ll know just how powerful it is to build forms and capture information with WordPress. But what it lacks is an easy way to display that information as a document. That’s where our plugin comes into the picture. The software allows you to generate a PDF document, that includes data captured through Gravity Forms, by using HTML/CSS templates. Use the tools you know and love to easily create PDFs.

Note: The software is a [developer toolkit](https://developer.gravitypdf.com/) with limited UX controls. To create custom PDF templates you need to be familiar with PHP, HTML and CSS. [Alternativly we offer development services](https://gravitypdf.com/) and can create and install the PDF templates for you.

**Benefits**

* Save Hours in Data Entry - You’ll never have to fill out documents by hand. The software automates the entire process for you.
* Completely Digitise Your Paperwork - Go completely paperless, saving on printing costs, reduce waste and help the environment at the same time.
* Never Lose a Document - As long as the original entry is available you will have access to the entry’s PDFs from your website.
* Better Client Management - Your clients can complete one form and have multiple documents automatically generated, which means you’ll never forget to complete a document.
* Password Protected Documents - Worried about security? You can easily password protect the PDFs with a 128-bit encryption and even let the user select a password when filling out a form.
* Automatic Email PDFs - Automatically email the PDF when a user completes the form. Have it emailed to people in your organisation, the user, or both.
* Paywall Your Document - Using Gravity Forms payment add-ons – like PayPal, Authorize.net or Stripe – you can restrict access to the PDF until after the payment is verified.
* Conditional Content - Gravity Forms allows you to show fields based on conditions you define in your form, and so does our software. You can even have completely different PDFs generated based on the user responses.

**PDF Features**

The PDF software includes powerful feature that allow you to control the look and feel of your document. It includes:

* Language Support - almost all languages are supported including RTL (right to left) languages like Arabic, Hebrew and CJK languages - Chinese, Japanese and Korean.
* HTML Page Numbering
* Odd and even paging with mirrored margins (most commonly used in printing).
* Nested Tables
* Text-justification and hyphenation
* Table of Contents
* Index
* Bookmarks
* Watermarks
* Password protection
* UTF-8 encoded HTML

**Demos**

We put together five demos showcasing how powerful the PDF software can be. [Take a look](https://gravitypdf.com/#GFdemo).

**Server Requirements**

1. PHP 5.2+ (5.4+ recommended)
2. MB String with Regex enabled (--enable-mbregex)
3. GD Library
4. RAM:	Recommended: 128MB. Minimum: 64MB.

**Software Requirements**

1. [Purchase and install Gravity Forms](https://www.e-junkie.com/ecom/gb.php?cl=54585&c=ib&aff=235154)
2. Wordpress 3.9+
3. Gravity Forms 1.8+

**Documentation and Support**

To view the Development Documentation head to [https://developer.gravitypdf.com](https://developer.gravitypdf.com). If you need support with the plugin please post a topic in our [support forums](https://support.gravitypdf.com).

== Installation ==

1. Upload this plugin to your website and activate it
2. Head to Forms -> Settings -> PDF to initialise the plugin.
3. Create a form in Gravity Forms and configure notifications
4. Get the Form ID and follow the steps below in [the configuration section](http://developer.gravitypdf.com/documentation/getting-started-with-gravity-pdf-configuration/)
5. Modify the PDF template file ([see the advanced templating section in the documentation](http://developer.gravitypdf.com/documentation/custom-templates-introduction/)) inside your active theme's PDF_EXTENDED_TEMPLATES/ folder.


== Frequently Asked Questions ==

All FAQs can be [viewed on the Gravity PDF website](https://gravitypdf.com/#faqs).

== Screenshots ==

1. The View PDF button is avaliable for each Gravity Form entry
2. Multiple PDFs can be assigned to a form and is also avaliable on the detailed entry view.
3. The configuration.php file allows you to easily assign PDFs to Gravity Forms

== Changelog ==

= 3.7.5 =
* Housekeeping - Tweak mPDF package to be PHP7 compatible.

= 3.7.4 =
* Housekeeping - Revert patch made in last update as Gravity Forms 1.9.9 fixes the issue internally.

= 3.7.3 =
* Bug - Gravity Forms 1.9 didn't automatically nl2br paragraph text mergetags. Fixed this issue in custom PDF templates.

= 3.7.2 =
* Bug - Updated $form_data['date_created'], $form_data['date_created_usa'], $form_data['misc']['date_time'], $form_data['misc']['time_24hr'] and $form_data['misc']['time_12hr'] to factor in the website's timezone settings.

= 3.7.1 =
* Housekeeping - Allow control over signature width in default template using the 'gfpdfe_signature_width' filter
* Housekeeping - Add better error checking when migrating PDF template folder
* Housekeeping - Add unit testing to the directory migration function
* Bug - Fixed backwards-compatiiblity PHP error when viewing custom PDF templates on Gravity Forms 1.8.3 or below.
* Bug - Ensure checkbox field names are included in the $form_data array

= 3.7.0 =
* Feature - Added 'default-show-section-content' configuration option. You can now display the section break content in the default template. Note: if this option is enabled and the section break is empty it will still be displayed on the PDF.
* Feature - Added hooks 'gfpdfe_template_location' and 'gfpdfe_template_location_uri' to change PDF template location
* Housekeeping - Migrate your template and configuration files. As of Gravity PDF 3.7 we'll be dropping the 'site_name' folder for single WordPress installs and changing the multisite install directory to the site ID.
* Housekeeping - Added $form_data['html_id'] key which has the HTML fields added by their ID (much like the signature_details_id key).
* Housekeeping - Add large number of unit tests
* Housekeeping - Derestrict certain pages software loads on.
* Housekeeping - Split up PDF viewing security components into smaller chunks (easier to unit test)
* Housekeeping - Remove CLI-checking override in RAM settings
* Housekeeping - Included directory paths by default on the system status page
* Housekeeping - Updated configuration.php examples to include new default config option and refined the copy
* Bug - Fixed issue initialising plugin when memory limit was set to -1 (unlimited)
* Bug - Fix Multisite migration problem where if an error was thrown for one of the sub sites it caused all of the sites to show an error (even if they were successful)
* Bug - Fix typo in example-template.php file
* Bug - Fix up notices in custom templates when using poll/survey/quiz add ons.
* Bug - Fix up notice in custom template when the form description is empty
* Bug - Fix up notices in mPDF template when using headers/footers
* Bug - Fix up error in PDF when signature field wasn't filled in


= 3.6.0 =
* Feature - Added support for Gravity Form's sub-field middle name  (1.9Beta)
* Feature - Patch mPDF with full :nth-child support on TD and TR table cells
* Feature - Added $form_data[products_totals][subtotal] key (total price without shipping costs added)
* Feature - Added formated money to all product fields in the $form_data array
* Feature - Default templates: only show fields who's conditional logic is true. Perfect when used with default-show-html
* Housekeeping - Move PDF_EXTENDED_TEMPLATES folder to the /wp-content/upload/ directory. Get more info about the move (see http://developer.gravitypdf.com/news/migrating-template-directory-means/)
* Housekeeping - Refined when admin resources are loaded
* Housekeeping - Fixed typo during initial initialisation
* Housekeeping - Switched icons back to FontAwesome which is shipped by default with Gravity Forms
* Housekeeping - Display full path to mPDF tmp directory when there are issues writing to it
* Housekeeping - Modified font installation message.
* Housekeeping - Update example-header-and-footer_06.php and example-advanced-headers_07.php to better reflect current mPDF features
* Bug - Fixed issue pulling the correct configuration when multiple nodes were assigned to multiple forms
* Bug - Fixed number field formatting issue which always rounded to two decimal places
* Bug - Fixed JS namespace issue with WordPress Leads plugin
* Bug - Fixed error initialising fonts / backing up PDF_EXTENDED_TEMPLATES directory when using the glob() function
* Bug - Fix issue with PHP 5.0 and 5.1 array_replace_recursive function when used with an array inside the $gf_pdf_config array
* Bug - Fixed fatal error when logged in user attempts to view PDF they don't have access to
* Bug - Fixed issue in $form_data array where single-column list items where being returned as an array and not a HTML list.
* Bug - Prevent unauthorised users auto-initialising the software or migrating the templates folder
* Bug - Fixed up incorrect formatting issue when using custom font name
* Bug - Fixed issue displaying Times New Roman in PDF templates

= 3.5.11.1 =
* Bug - Fix issue saving and sending blank PDFs due to security fix

= 3.5.11 =
* Bug - Fix security issue which gave unauthorised users access to Gravity Form entires

= 3.5.10 =
* Housekeeping - Include individual scoring for Gravity Form Survey Likert field in the $form_data['survey'] array
* Bug - Fix fatal error when Gravity Forms isn't activated, but Gravity PDF is.

= 3.5.9 =
* Bug - Rollback recent changes that introduced the GFAPI as introduces errors for older versions of Gravity Forms. Will reintroduce in next major release and increase the minimum Gravity Forms version.

= 3.5.8 =
* Bug - Fixed issue affected some users where a depreciated function was causing a fatal error

= 3.5.7 =
* Bug - Fixed issue where the PDF settings page was blank for some users

= 3.5.6 =
* Bug - Fixed issue with last release that affected checks to see if Gravity Forms has submitting
* Bug - Fixed fatal error with servers using PHP5.2 or lower
* Bug - Fixed E_NOTICE for replacement array_replace_recursive() function in PHP5.2 or lower
* Bug - Fixed issue with AJAX spinner showing when submitting support request

= 3.5.5 =
* Housekeeping - Include French translation (thanks to Marie-Aude Koiransky-Ballouk)
* Housekeeping - Wrap 'Initialise Fonts' text in translation ready _e() function
* Housekeeping - Tidy up System Status CSS styles to accomidate translation text lengths
* Housekeeping - Fix E_NOTICE when viewing entry details page when form has no PDF configuration
* Bug - Fixed load_plugin_textdomain which was incorrectly called.
* Bug - Correctly check if the plugin is loaded correctly before letting the PDF class fully load

= 3.5.4 =
* Bug - Fixed issue with incorrect PDF name showing on the entry details page
* Bug - Fixed issue with custom fonts being inaccessible without manually reinstalling after upgrading.
* Housekeeping - Added in two new filters to modify the $mpdf object. 'gfpdfe_mpdf_class' and 'gfpdfe_mpdf_class_pre_render' (replaces the gfpdfe_pre_render_pdf filter).

= 3.5.3 =
* Bug - Mergetags braces ({}) were being encoded before conversion
* Bug - Fixed issue with empty string being passed to array filter
* Housekeeping - Enabled mergetag usage in the pdf_password and pdf_master_password configuration options
* Housekeeping - Correctly call $wpdb->prepare so the variables in are in the second argument

= 3.5.2 =
* Bug - Initialisation folder .htaccess file was preventing template.css from being loaded by the default templates.

= 3.5.1 =
* Bug - Fixed issue with core fonts Arial/Helvetica, Times/Times New Roman and Courier not displaying in the PDF.
* Bug - Fixed display issues for multiple PDFs on the details admin entry page
* Housekeeping - Made the details entry page PDF view consistent for single or multiple PDFs
* Housekeeping - Ensured all javascript files are minified and are correctly being used
* Housekeeping - Remove legacy notices from mPDF package

= 3.5.0 =
* Feature - No longer need to reinitialise every time the software is updated.
* Feature - Add auto-initialiser on initial installation for sites that have direct write access to their server files
* Feature - Add auto-initialiser on initial installation across entire multisite network for sites who have direct write access to their server files.
* Feature - Add auto-PDF_EXTENDED_TEMPLATES theme syncer for sites that have direct write access to their server files
* Feature - Correctly added language support. The .PO file is located in the /language/ folder if anyone would like to do a translation.

* Housekeeping - Restrict initialisation process to 64MB or greater to counter problems with users reporting a 'white screen' when running in a low-RAM environment.
* Housekeeping - Refractor the admin notices code
* Housekeeping - Create responsive PDF settings page
* Housekeeping - Minify CSS and Javascript files
* Housekeeping - Remove FontAwesome fonts from package and use Wordpress' build-in 'dashicons'
* Housekeeping - Refine action and error messages
* Housekeeping - Update initialisation tab copy for both pre- and post- initialisation
* Housekeeping - Use Gravity Forms get_ip() function instead of custom function
* Housekeeping - The in-built support form uses SSL once again (disabled in the past due to some servers being unable to verify the certificate).

* Bug - When testing write permissions, file_exist() is throwing false positives for some users which would generate a warning when unlink() is called. Hide warning using '@'.

= 3.4.1 =
* Bug - Fix typo that effected sites running PHP5.2 or below.

= 3.4.0.3 =
* Bug - Define array_replace_recursive() if it doesn't exist, as it is PHP 5.3 only.

= 3.4.0.2 =
* Housekeeping - Wrapped the View PDF and Download buttons in correct language functions - _e()
* Bug - Fix problem displaying the signature field
* Bug - Fix notice errors with new 'save' PDF hook

= 3.4.0.1 =
* Housekeeping - Add commas on the last line of every config node in the configuration.php file
* Housekeeping - Fix up initialisation error messages
* Bug - Fix up mPDF bugs - soft hyphens, watermarks over SVG images, inline CSS bug

= 3.4.0 =
* Feature - Added auto-print prompt ability when you add &print=1 to the PDF URL (see https://developer.gravitypdf.com/documentation/display-pdf-in-browser/ for details)
* Feature - Added ability to rotate absolute positioned text 180 degrees (previously only 90 and -90). Note: feature in beta
* Feature - Backup all template files that are overridden when initialising to a folder inside PDF_EXTENDED_TEMPLATES
* Feature - Added SSH initialisation support
* Feature - Allow MERGETAGS to be used in all PDF templates, including default template (but only in the HTML field).
* Feature - Updated mPDF to 3.7.1
* Feature - Enable text/image watermark support. Added new example template example-watermark09.php showing off its usage (see http://gravitypdf.com/documentation-v3-x-x/templates/watermarks/)
* Feature - Added full survey, poll and quiz support to both the default template and $form_data (see https://developer.gravitypdf.com/documentation/accessing-survey-poll-quiz-data/)
* Feature - Shortcodes will now be processed in all templates, including default template (but only in the HTML field).
* Feature - Added 'save' configuration option so PDFs are saved to the local disk when 'notifications' aren't enabled.
* Feature - Added 'dpi' configuration option to modify the PDF image DPI. Default 96dpi. Use 300dpi for printing.
* Feature - Added PDF/A1-b compliance option. Enable with 'pdfa1b' => true. See http://mpdf1.com/manual/index.php?tid=420&searchstring=pdf/a1-b for more details.
* Feature - Added PDF/X1-a compliance option. Enable with 'pdfx1a' => true. See http://mpdf1.com/manual/index.php?tid=481&searchstring=pdf/x-1a for more details.
* Feature - Added new constant option 'PDF_REPACK_FONT' which when enabled may improve function with some PostScript printers (disabled by default). Existing sites will need to add  define('PDF_REPACK_FONT', true); to the bottom of their configuration.php file.
* Feature - Added a sleuth of new hooks and filters for developers. See https://developer.gravitypdf.com/documentation/filters-and-hooks/ for examples.
* Feature - Added $form_data['form_description'] key to $form_data array
* Feature - Update $form_data['products'] array key to field ID
* Feature - Added survey Likert output function for custom templates (much like the product table function). It can be used with the following command 'echo GFPDFEntryDetails::get_likert($form, $lead, $field_id);' where $field_id is substituted for the form field ID.
* Feature - Added field descriptions to the $form_data array under the $form_data['field_descriptions'] key.
* Feature - Added pre and post PDF generation filters and actions to pdf-render.php. These include gfpdfe_pre_render_pdf, gfpdfe_pdf_output_type, gfpdfe_pdf_filename and gfpdf_post_pdf_save.
* Feature: $form_data['signature'] et al. keys now contain the signature width and height attributes

* Housekeeping - Ensure the form and lead IDs are correctly passed throughout the render functions.
* Housekeeping - Update settings page link to match new Gravity Forms URL structure
* Housekeeping - Check if $lead['gfsurvey_score'] exists before assigning to $form_data array
* Housekeeping - Removed table and font checksum debugging from mPDF when WP_DEBUG enabled as they produced inaccurate results.
* Housekeeping - Fixed up mPDF logging location when WP_DEBUG enabled. Files now stored in wp-content/themes/Active_Theme_Folder/PDF_EXTENDED_TEMPLATES/output/ folder.
* Housekeeping - Removed API logging locally when WP_DEBUG is enabled.
* Housekeeping - Increase API timeout interval as some overseas users reported timeout issues
* Housekeeping - Modified mPDF functions Image() and purify_utf8_text() to validate the input data so we don't have to do it every time through the template.
* Housekeeping - Added ability to not re-deploy every update (not enabled this release as template files were all updated)
* Housekeeping - Additional checks on load to see if any of the required file/folder structure is missing. If so, re-initilise.
* Housekeeping - Save resources and turn off automatic rtl identification. Users must set the RTL option when configuring form
* Housekeeping - Turn off mPDFs packTableData setting, decreasing processing time when working with large tables.
* Housekeeping - $gf_pdf_default_configuration options now merge down into existing PDF nodes, instead of applying to only unassigned forms. $gf_pdf_config settings override any in $gf_pdf_default_configuration
* Housekeeping - Center aligned Survey Likery field results
* Housekeeping - Partially refactored the pdf-entry-detail.php code
* Housekeeping - All default and example templates have been tidied. This won't affect custom templates.
* Housekeeping - Set the gform_notification order number to 100 which will prevent other functions (example snippets from Gravity Forms, for instance) from overridding the attached PDF.
* Housekeeping - Fix spelling mistake on initialising fonts
* Housekeeping - Remove wpautop() function from Gravity Form HTML output, which was applied before rendering and was messing up the HTML markup.
* Housekeeping - Remove empty list rows from the $form_data['list'] array in single and multi-column lists.
* Housekeeping - Apply same CSS styles (padding, border and line height) to HTML fields as done to form values in default templates
* Housekeeping - Replaced arbitrary wrapper IDs in the default templates with the actual field ID

* Bug - Fixed signature rendering issue when custom signature size was being used
* Bug - Fixed static error types in helper/install-update-manager.php file.
* Bug - Fixed redeployment error message which wasn't showing correctly
* Bug - Fixed issue with PDF not attaching to notification using Paypal's delayed notification feature
* Bug - Fixed strict standard warning about calling GFPDF_Settings::settings_page();
* Bug - Fixed strict standard warning about calling GFPDFEntryDetail::pdf_get_lead_field_display();
* Bug - Fixed issue with Gravity Form Post Category field causing fatal error generating PDF
* Bug - Fixed number field formatting issue when displaying on PDF.
* Bug - Do additional check for PHP's MB_String regex functions before initialising ti prevent errors after initialising
* Bug - Fixed problem with multiple nodes assigned to a form using the same template
* Bug - Fixed path to fallback templates when not found
* Bug - Fixed problem with master password setting to user password


= 3.3.4 =
* Bug - Fixed issue linking to PDF from front end
* Housekeeping - Removed autoredirect to initialisation page

= 3.3.3 =
* Bug - Correctly call javascript to control admin area 'View PDFs' drop down
* Bug - Some users still reported incorrect RAM. Convert MB/KB/GB values to M/K/G as per the PHP documentation.
* Housekeeping - Show initilisation prompt on all admin area pages instead of only on the Gravity Forms pages

= 3.3.2.1 =
* Bug - Incorrectly showing assigned RAM to website

= 3.3.2 =
* Bug - Some hosts reported SSL certificate errors when using the support API. Disabled HTTPS for further investigation. Using hash-based verification for authentication.
* Housekeeping - Forgot to disable API debug feature after completing beta

= 3.3.1 =
* Bug - $form_data['list'] was mapped using an incremental key instead of via the field ID

= 3.3.0 =
* Feature - Overhauled the initialisation process so that the software better reviews the host for potential problems before initialisation. This should help debug issues and make users aware there could be a problem before they begin using the software.
* Feature - Overhauled the settings page to make it easier to access features of the software
* Feature - Added a Support tab to the settings page which allows users to securely (over HTTPS) submit a support ticket to the Gravity PDF support desk
* Feature - Changed select, multiselect and radio fields so that the default templates use the name rather than the value. $form_data now also includes the name and values for all these fields.
* Feature - $form_data now includes all miscellaneous lead information in the $form_data['misc'] array.
* Feature - $form_data now contains 24 and 12 hour time of entry submission.
* Feature - Added localisation support
* Compatibility - Added new multi-upload support which was added in Gravity Forms 1.8.
* Bug - Added 'aid' parametre to the PDF url when multiple configuration nodes present on a single form
* Bug - Fixed issue when Gravity Forms in No Conflict Mode
* Bug - Font config.php's array keys now in lower case
* Housekeeping - Moved all initialisation files to a folder called 'initialisation'.
* Housekeeping - Renamed the configuration.php file in the plugin folder to configuration.php.example to alleviate confusion for developers who unwittingly modify the plugin configuration file instead of the file in their active theme's PDF_EXTENDED_TEMPLATES folder.
* Housekeeping - Updated the plugin file system to a more MVC-style approach, with model and view folders.
* Housekeeping - Removed ability to directly access default and example template files.
* Housekeeping - Fixed PHP notices in default templates related to the default template-only configuration options
* Housekeeping - Update core styles to match Wordpress 3.8/Gravity Forms 1.8.
* Housekeeping - Updated header/footer examples to use @page in example.

= 3.2.0 =
* Feature - Can now view multiple PDFs assigned to a single form via the admin area. Note: You must provide a unique 'filename' parameter in configuration.php for multiple PDFs assigned to a single form.
* Feature - You can exclude a field from the default templates using the class name 'exclude'. See our [FAQ topic](https://gravitypdf.com/#faqs) for more details.
* Bug - Fixed issue viewing own PDF entry when logged in as anything lower than editor.
* Bug - Fixed data return bug in pdf-entry-details.php that was preventing all data returning correctly.
* Bug - Fixed PHP Warning when using products with no options
* Bug - Fixed issue with invalid characters being added to the PDF filename. Most notably the date mergetag.
* Bug - Limit filename length to 150 characters which should work on the majority of web servers.
* Bug - Fixed problem sending duplicate PDF when using mass resend notification feature
* Depreciated - Removed GF_FORM_ID and GF_LEAD_ID constants which were used in v2.x.x of the software. Ensure you follow [v2.x.x upgrade guide](https://developer.gravitypdf.com/news/version-2-3-migration-guide/) to your templates before upgrading.

= 3.1.4 =
* Bug - Fixed issue with plugin breaking website's when the Gravity Forms plugin wasn't activated.
* Housekeeping - The plugin now only supports Gravity Forms 1.7 or higher and Wordpress 3.5 or higher.
* Housekeeping - PDF template files can no longer be accessed directly. Instead, add &amp;html=1 to the end of your URL when viewing a PDF.
* Extension - Added additional filters to allow the lead ID and notifications to be overridden.

= 3.1.3 =
* Feature - Added signature_details_id to $form_data array which maps a signatures field ID to the array.
* Extension - Added pre-PDF generator filter for use with extensions.
* Bug - Fixed issue with quotes in entry data breaking custom templates.
* Bug - Fixed issue with the plugin not correctly using the new default configuration template, if set.
* Bug - Fixed issue with signature not being removed correctly when only testing with file_exists(). Added second is_dir() test.
* Bug - Fixed issue with empty signature field not displaying when option 'default-show-empty' is set.
* Bug - Fixed initialisation prompt issue when the MPDF package wasn't unpacked.

= 3.1.2 =
* Feature - Added list array, file path, form ID and lead ID to $form_data array in custom templates
* Bug - Fixed initialisation prompt issue when updating plugin
* Bug - Fixed window.open issue which prevented a new window from opening when viewing a PDF in the admin area
* Bug - Fixed issue with product dropdown and radio button data showing the value instead of the name field.
* Bug - Fixed incorrect URL pointing to signature in $form_data

= 3.1.1 =
* Bug - Users whose server only supports FTP file manipulation using the WP_Filesystem API moved the files into the wrong directory due to FTP usually being rooted to the Wordpress home directory. To fix this the plugin attempts to determine the FTP directory, otherwise assumes it is the WP base directory.
* Bug - Initialisation error message was being called but the success message was also showing.

= 3.1.0 =
* Feature - Added defaults to configuration.php which allows users to define the default PDF settings for all Gravity Forms. See the [installation and configuration documentation](https://developer.gravitypdf.com/documentation/getting-started-with-gravity-pdf-configuration/) for more details.
* Feature - Added three new configuration options 'default-show-html', 'default-show-empty' and 'default-show-page-names' which allow different display options to the three default templates. See the [installation and configuration documentation](http://gravitypdf.com/documentation-v3-x-x/installation-and-configuration/#default-template) for more details.
* Feature - Added filter hooks 'gfpdfe_pdf_name' and 'gfpdfe_template' which allows developers to further modify a PDF name and template file, respectively, outside of the configuration.php. This is useful if you have a special case naming convention based on user input. See [https://developer.gravitypdf.com/documentation/filters-and-hooks/](https://developer.gravitypdf.com/documentation/filters-and-hooks/) for more details about using these filters.
* Feature - Custom font support. Any .ttf font file added to the PDF_EXTENDED_TEMPLATES/fonts/ folder will be automatically installed once the plugin has been initialised. Users also have the option to just initialise the fonts via the settings page. See the [font/language documentation ](https://developer.gravitypdf.com/documentation/language-support/#install-custom-fonts) for details.
* Compatability - Use Gravity Forms get_upload_root() and get_upload_url_root() instead of hard coding the signature upload directory in pdf-entry-detail.php
* Compatability - Changed depreciated functions get_themes() and get_theme() to wp_get_theme() (added in Wordpress v3.4).
* Compatability - The plugin now needs to be initialised on fresh installation and upgrade. This allows us to use the WP_Filesystem API for file manipulation.
* Compatability - Automatic copying of PDF_EXTENDED_TEMPLATES folder on a theme change was removed in favour of a user prompt. This allows us to take advantage of the WP_Filesystem API.
* Compatability - Added Wordpress compatibility checker (minimum now 3.4 or higher).
* Bug - Removed ZipArchive in favour of Wordpress's WP_Filesystem API unzip_file() command. Some users reported the plugin would stop their entire website working if this extension wasn't installed.
* Bug - Fixed Gravity Forms compatibility checker which wouldn't return the correct response.
* Bug - Fixed minor bug in pdf.php when using static call 'self' in add_filter hook. Changed to class name.
* Bug - Removed PHP notice about $even variable not being defined in pdf-entry-detail.php
* Bug - Prevent code from continuing to excecute after sending header redirect.

= 3.0.2 =
* Backwards Compatibility - While PHP 5.3 has was released a number of years ago it seems a number of hosts do not currently offer this version to their clients. In the interest of backwards compatibility we've re-written the plugin to again work with PHP 5+.
* Signature / Image Display Bug - All URLs have been converted to a path so images should now display correctly in PDF.

= 3.0.1 =
* Bug - Fixed issue that caused website to become unresponsive when Gravity Forms was disabled or upgraded
* Bug - New HTML fields weren't being displayed in $form_data array
* Feature - Options for default templates to disable HTML fields or empty fields (or both)

= 3.0.0 =
As of Gravity PDF v3.0.0 we have removed the DOMPDF package from our plugin and integrated the more advanced mPDF system. Along with a new HTML to PDF generator, we've rewritten the entire plugin's base code to make it more user friendly to both hobbyists and rock star web developers. Configuration time is cut in half and advanced features like adding security features is now accessible to users who have little experience with PHP.

New Features include:

* Language Support - almost all languages are supported including RTL (right to left) languages like Arabic and Hebrew and CJK languages - Chinese, Japanese and Korean.
* HTML Page Numbering
* Odd and even paging with mirrored margins (most commonly used in printing).
* Nested Tables
* Text-justification and hyphenation
* Table of Contents
* Index
* Bookmarks
* Watermarks
* Password protection
* UTF-8 encoded HTML
* Better system resource handling

A new HTML to PDF package wasn't the only change to this edition of the software. We have rewritten the entire configuration system and made it super easy to get the software up and running.

Users will no longer place code in their active theme's functions.php file. Instead, configuration will happen in a new file called configuration.php, inside the PDF_EXTENDED_TEMPLATES folder (in your active theme).

Other changes include
* Improved security - further restrictions were placed on non-administrators viewing template files.
* $form_data array tidied up - images won't be wrapped in anchor tags.

For more details [view the 3.x.x online documentation](https://developer.gravitypdf.com/).

= 2.2.3 =
* Bug - Fixed mb_string error in the updated DOMPDF package.

= 2.2.2 =
* DOMPDF - We updated to the latest version of DOMPDF - DOMPDF 0.6.0 beta 3.
* DOMPDF - We've enabled font subsetting by default which should help limit the increased PDF size when using DejaVu Sans (or any other font).

= 2.2.1 =
* Bug - Fixed HTML error which caused list items to distort on PDF

= 2.2.0 =
* Compatibility - Ensure compatibility with Gravity Forms 1.7. We've updated the functions.php code and remove gform_user_notification_attachments and gform_admin_notification_attachments hooks which are now depreciated. Functions gform_pdf_create and gform_add_attachment have been removed and replaced with gfpdfe_create_and_attach_pdf(). See upgrade documentation for details.
* Enhancement - Added deployment code switch so the template redeployment feature can be turned on and off. This release doesn't require redeployment.
* Enhancement - PDF_Generator() variables were getting long and complex so the third variable is now an array which will pass all the optional arguments. The new 1.7 compatible functions.php code includes this method by default. For backwards compatibility the function will still work with the variable structure prior to 2.2.0.
* Bug - Fixed error generated by legacy code in the function PDF_processing() which is located in render_to_pdf.php.
* Bug - Images and stylesheets will now try and be accessed with a local path instead of a URL. It fixes problem where some hosts were preventing read access from a URL. No template changes are required.

= 2.1.1 =
* Bug - Signatures stopped displaying after 2.1.0 update. Fixed issue.
* Bug - First time install code now won't execute if already have configuration variables in database

= 2.1.0 =

* Feature - Product table can now be accessed directly through custom templates by running GFPDFEntryDetail::product_table($form, $lead);. See documentation for more details.
* Feature - Update screen will ask you if you want to deploy new template files, instead of overriding your modified versions.
* Feature - Product subtotal, shipping and total have been added to $form_data['field'] array to make it easier to work with product details in the custom template.
* Feature - Added two new default template files. One displays field and name in two rows (like you see when viewing an entry in the admin area) and the other removes all styling. See documentation on use.
* Security - Tightened PDF template security so that custom templates couldn't be automatically generated by just anyone. Now only logged in users with the correct privileges and the user who submitted the form (matched against IP) can auto generate a PDF. See documentation on usage.
* Depreciated - Removed form data that was added directly to the $form_data array instead of $form_data['field'] array. Users upgrading will need to update their custom templates if not using field data from the $form_data[�field'] array. If using $form_data['field'] in your custom template this won't affect you.
* Bug - Fixed problem with default template not showing and displaying a timeout error. Removed table tags and replaced with divs that are styled appropriately.
* Bug - The new plugin theme folder will successfully create when upgrading. You won't have to deactivate and reactivate to get it working.
* Bug - some installs had plugins that included the function mb_string which is also included in DOMPDF. DOMPDF will now check if the function exists before creating it.
* Bug - Remove empty signature field from the default template.
* Bug - fixed problem with redirecting to login screen even when logged in while accessing template file through the browser window directly.
* Bug - fixed error where sample template would reimport itself automatically even after deleting it. Will now only reimport if any important changes to template need to be viewed straight after an update.
* Bug - Moved render_to_pdf.php constants to pdf.php so we can use the constants in the core files. Was previously generating an error.
* Housekeeping - Cleaned up core template files, moved functions into classes and added more in-file documentation.
* Housekeeping - moved install/upgrade code from pdf.php to installation-update-manager.php
* Housekeeping - changed pdf-entry-detail.php class name from GFEntryDetail to GFPDFEntryDetail to remove compatibility problems with Gravity Forms.
* Housekeeping - created pdf-settings.php file to house the settings page code.

= 2.0.1 =
* Fixed Signature bug when checking if image file exists using URL instead of filesystem path
* Fixed PHP Constants Notice

= 2.0.0 =
* Moved templates to active theme folder to prevent custom themes being removed on upgrade
* Allow PDFs to be saved using a custom name
* Fixed WP_Error bug when image/css file cannot be found
* Upgraded to latest version of DOMPDF
* Removed auto-load form bug which would see multiple instances of the example form loaded
* Created a number of constants to allow easier developer modification
* Plugin/Support moved to dedicated website.
* Pro/Business package offers the ability to write fields on an existing PDF.

= 1.2.3 =
* Fixed $wpdb->prepare error

= 1.2.2 =
* Fixed bug with tempalte shipping method MERGETAGS
* Fixed bug where attachment wasn't being sent
* Fixed problem when all_url_fopen was turned off on server and failed to retreive remote images. Now uses WP_HTTP class.

= 1.2.1 =
* Fixed path to custom css file included in PDF template

= 1.2.0 =
* Template files moved to the plugin's template folder
* Sample Form installed so developers have a working example to modify
* Fixed bug when using WordPress in another directory to the site

= 1.1.0 =
* Now compatible with Gravity Forms Signature Add-On
* Moved the field data functions out side of the Gravity Forms core so users can freely style their form information (located in pdf-entry-detail.php)
* Simplified the field data output
* Fixed bug when using product information

= 1.0.0 =
* First release.

== Upgrade Notice ==

= 3.7.0 =
WARNING: Minimum WordPress and Gravity Forms versions have been bumped to WordPress 3.9+ and Gravity Forms 1.8+. If you aren't running either version of this software DO NOT UPGRADE.
