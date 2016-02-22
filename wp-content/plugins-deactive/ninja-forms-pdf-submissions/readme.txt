=== Ninja Forms - PDF Submissions ===
Contributors: never5
Donate link: http://www.never5.com
Tags: form, forms, ninja forms, pdf, submission, download
Requires at least: 3.9
<<<<<<< HEAD
Tested up to: 4.3
Stable tag: 1.3.4
=======
Tested up to: 3.9
Stable tag: 1.3.3
>>>>>>> master

License: GPLv2 or later

== Description ==

An extension for Ninja Forms that can automagically attach a PDF file of the form submission along with an email notification. You can also download PDF copies of any form submission in the WordPress admin.

= Features =

* Automatically attach a PDF copy of the form submission with the admin email notification
* Download a PDF copy of a form submission via the WordPress admin

== Screenshots ==

To see up to date screenshots, visit the [Ninja Forms](http://wpninjas.com/ninja-forms/) page.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `ninja-forms-pdf-submissions` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Use ==

For help and video tutorials, please see the [documentation on the Ninja Forms website](http://wpninjas.com/ninja-forms/docs/).

== Changelog ==

<<<<<<< HEAD
= 1.3.4 - 2015-09-16 =
* Fix - Fixed a fatal that was caused by accessing an array of an object pre PHP 5.4.
* Tweak - add support for multiple uploaded files in PDF.

=======
>>>>>>> master
= 1.3.3 - 2015-06-04 =
* Fix   - Adding support for Fields Uploads extension. Will display the url to the file.
* Tweak - Adding a form submission ID which can be added to the PDF. See the ninja_forms_submission_pdf_fetch_sequential_number filter.
* Tweak - Adding paragraph tags to the field values with wpautop(). Necessary for multi-paragraph values.
* Tweak - The ninja_forms_submission_pdf_name filter now works for email attachments and for PDFs downloaded via the admin

= 1.3.2 - 2014-12-01 =
* Tweak - Removing fields from the PDF which are conditionally not shown to the user

= 1.3.1 - 2014-10-29 =
* Tweak - Adding support for table editor

= 1.3 - 2014-09-15 =
* Tweak - Using new notifications settings in Ninja Forms 2.8

= 1.2 - 2014-07-28 =
* Feature - Adding ninja_forms_submission_pdf_fetch_date filter to add the submission date to the form
* Tweak   - Using new admin_label in pdf if available
* Tweak   - Passing form fields & form ID into template

= 1.1 - 2014-06-24 =
* Feature - Attach PDFs to user email

= 1.0 =
* Initial release! PDF all the things!
