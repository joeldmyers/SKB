<?php
/*
Notice Type: updated
Notice ID: wp_helpers_1_8
Capability: manage_options
*/
?>

<?php $options = get_option('piklist_active_plugin_versions'); ?>

<?php printf(__('<h3>What\'s new in WordPress Helpers %1$s</h3>'), $options['wp-helpers/wp-helpers.php'][0]); ?>

<?php _e('<h4>Lots of new Media features!</h4>'); ?>

<?php printf(__('%1$sRequire Featured Images before publishing%2$s &#8594;'), '<a href="' . admin_url() . 'tools.php?page=piklist_wp_helpers&tab=writing">', '</a>'); ?>

<br />

<?php printf(__('%1$sSet defaults when embedding your images%2$s &#8594;'), '<a href="' . admin_url() . 'tools.php?page=piklist_wp_helpers&tab=media">', '</a>'); ?>

<br />

<?php printf(__('%1$sShow all available image sizes.%2$s &#8594;'), '<a href="' . admin_url() . 'tools.php?page=piklist_wp_helpers&tab=media">', '</a>'); ?>

<br />

<?php printf(__('%1$sDisplay image Exif data.%2$s &#8594;'), '<a href="' . admin_url() . 'tools.php?page=piklist_wp_helpers&tab=media">', '</a>'); ?>