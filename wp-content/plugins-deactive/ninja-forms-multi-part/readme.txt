=== Ninja Forms - Multi-Part Forms Extension ===
Contributors: kstover, jameslaws
Donate link: http://wpninjas.com
Tags: form, forms
Requires at least: 3.8
Tested up to: 4.3
Stable tag: 1.3.5

License: GPLv2 or later

== Description ==
The Ninja Forms Multi-Part Extension allows you to break forms up into multiple pages. This can be very helpful for long or complex forms.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `ninja-forms` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the 'Forms' menu item in your admin sidebar
4. On the form settings page, you will now have options for multi-part forms.

== Use ==

For help and video tutorials, please visit our website: [Ninja Forms Documentation](http://wpninjas.com/ninja-forms/docs/)

== Changelog ==

= 1.3.5 (08 September 2015) =

*Bugs:*

* Fixed a bug that could cause the animated spinner to fail to show when building a form.

= 1.3.4 (17 March 2015) =

*Bugs:*

* When our JS changes, users browsers shouldn't keep old copies in the cache.

= 1.3.3 (4 March 2015) =

*Bugs:*

* Fixed a bug that could cause saving a new form to fail.

= 1.3.2 (4 March 2015) =

*Bugs:*

* Fixed a bug that could cause issues when adding a field type and then deactivating an extension that added it.

= 1.3.1 (27 February 2015) =

*Bugs:*

* Fixed several minor bugs with version 2.9 of Ninja Forms.
* Creating a new multi-part form should now work with older versions of Ninja Forms as well.

= 1.3 (4 February 2015) =

*Changes:*

* Preparing for the release of Ninja Forms 2.9.

= 1.2.8 (17 November 2014) =

*Changes:*

* Next and Previous button text can now be changed in the Forms->Settings->Labels tab.

*Bugs:*

* Fixed several bugs that prevented translations from working properly.
* Added several strings that weren't translatable previously to the .po and .pot files.

= 1.2.7 (16 September 2014) =

*Changes:*

* Compatibility with Ninja Forms 2.8.

= 1.2.6 (24 July 2014) =

*Changes:*

* Compatibility with Ninja Forms 2.7.

= 1.2.5 =

*Bugs:*

* Multi-part forms should now work properly with the Stripe extension in all implementations.

= 1.2.4 =

*Changes:*

* Changed the name of the "Confirmation Page" to "Review Page" to make the option's purpose more clear.

*Bugs:*

* Fixed a bug on the review page that caused hidden fields to sometimes be shown as textboxes that could be manipulated.

= 1.2.3 =

*Bugs:*

* Fixed a bug with page titles that prevented them from displaying properly on conditional pages.
* Fixed a bug that caused forms with several pages to have scrolling issues in the admin.

= 1.2.2 =

*Bugs:*

* Fixed a bug with confirmation pages and the conditional logic extension.
* Fixed a bug that could cause php errors without the conditional logic extension present.

= 1.2.1 =

*Bugs:*

* Fixed a bug with confirmation pages that could prevent them from working properly.

= 1.2 =

*Changes:*

* Added support for the new Ninja Forms loading system. This should significantly improve loading speed for forms that use multi-part forms.

= 1.1.1 =

*Bugs:*

* Fixed translation issues by adding a default language folder, fixing several bad text domains, and adding a proper translation loader.

*Changes:*

* Added a jQuery event for ‘mp_change_page’ that fires after the page has successfully changed.
* Added some CSS for WP 3.8 compatability.
* Admin scripts should now load the min or dev versions based on the NINJA_FORMS_JS_DEBUG constant.
* Removed old licensing file.

= 1.1 =

*Bugs:*

* Fixed a bug that could cause Multi-Part Javascript to run, even if the form wasn't a Multi-Part form.
* Fixed a bug that could cause initial page load to be incorrect with a Multi-Part form.

= 1.0.14 =

*Changes:*

* Added a class to the page title on each multi-part page so that it can be styled with Layout & Styles.

*Bugs:*

* Fixed bugs that could prevent the previous and next buttons from displaying correctly.

= 1.0.13 =

*Changes:*

* Changed the license and auto-update system to the one available in Ninja Forms 2.2.47.

= 1.0.12 =

*Bugs:*

* Fixed a bug that could cause Multi-Part forms to work incorrectly with the Save Progress extension.
* Fixed a bug that prevented form settings from being carried from Multi-Part page to Multi-Part page.

= 1.0.11 =

*Bugs:*

* Fixed a bug that prevented conditional logic from being properly applied to pages within a multi-part form.

= 1.0.10 =

*Changes:*

* Updated references to wpninjas.com with the new ninjaforms.com.

= 1.0.9 =

*Features:*

* When creating a multi-part form, page numbers can now be dragged and dropped to re-arrange the pages of your form.

*Bugs:*

* Minor bug-fixes.

= 1.0.8 =

*Changes:*

* Changed the Javascript methods used in order to be compatible with Ninja Forms 2.2.37.

= 1.0.7 =

*Changes:*

* Updates for compatibility with WordPress 3.6

= 1.0.6 =

*Bugs:*

* Fixed some minor visual bugs.

= 1.0.5 =

*Bugs:*

* Fixed a php warning caused by a function running even if Multi-Part forms weren't enabled.
* Fixed a bug that was causing breadcrumb navigation to have the incorrect classes applied.

= 1.0.4 =

*Bugs:*

* Fixed a bug that caused the new, shorter field length to show incorrectly when the settings were saved.

= 1.0.3 =

*Features:*

* Multi-Part Forms will now allow you to hide or show an entire page when used in conjunction with the Conditionals extension.
* A new "Confirmation Page" option has been added. If this is selected, the user will be presented with a page showing all of their entered data, separated by page.

*Changes:*

* Changed the way that MP forms CSS is laid out to make it compatiable with version 2.2.18 of Ninja Forms.

= 1.0.2 =

*Bugs:*

* Fixed a bug with Multi-Part Forms and AJAX submissions that might affect some users.

= 1.0.1 =

*Features:*

* Updated Multi-Part Forms so that the extension works with AJAX submissions.

*Changes:*

* The ID of the DIV that wraps the navigation elements has been changed to ninja_forms_mp_nav_wrap from ninja-forms-mp-nav-wrap.
* A class of 'ninja-forms-mp-nav-wrap' has been placed on the DIV that wraps the navigation elements.

= 1.0 =

*Bugs:*

* Fixed a bug that prevented multi-part from working properly with post creation.

= 0.9 =

*Bugs:*

* Fixed a bug that prevented two multi-part forms from working properly on the same page.

= 0.8 =

* Field values that are emailed should now appear in the proper order.

= 0.7 =

*Changes:*

* Added a prev/next wrapper, adjust default styling for breadcrumbs and progress-bar.

= 0.6 =
* Fixed a bug that prevented the Multi-Part extension from interacted properly with the Save Progress extension.

= 0.5 =
* Fixed a bug that was preventing required fields from being properly checked.
* Fixed a bug with breadcrumb navigation that prevented the page with the first error from reloading if a user skipped to the end of a form and submitted.
* Fixed a bug that was preventing a form from properly being changed into a Multi-Part form.

= 0.4 =
* Fixed a bug that caused design elements, especially text fields, from showing on multi-part forms.

= 0.3 =
* Various bug fixes including:
* A bug which prevented all fields from being emailed to the administrator.

= 0.2 =
* Various bug fixes.
* Changed the way that javascript and css files are loaded in extensions.