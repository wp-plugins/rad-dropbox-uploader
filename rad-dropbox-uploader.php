<?php
/*
Plugin Name: RAD Dropbox Uploader
Plugin URI: http://www.radmediaco.com/free-plugins/rad-text-highlighter/
Description: Allow users to upload files directly to your Dropbox account from WordPress administration! Also use the easy to customize shortcode to allow your users to upload files too! Great for web designers & users alike!
Author: RAD Media Company
Version: 1.0.4
Author URI: http://www.radmediaco.com
*/

/* Begin Page & Database Settings */
/* Runs when plugin is activated */
register_activation_hook(__FILE__,'rad_dropbox_install');
function rad_dropbox_install() {
add_option('rad_dropbox_email', '', '', 'yes');
add_option('rad_dropbox_password', '', '', 'yes');
add_option('rad_dropbox_directory', '/', '', 'yes');
}

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'rad_dropbox_remove' );
function rad_dropbox_remove() {
delete_option('rad_dropbox_email');
delete_option('rad_dropbox_password');
delete_option('rad_dropbox_directory');
}

/* Admin Pages Configuration */
add_action('admin_menu', 'rad_dropbox_add_pages');
function rad_dropbox_add_pages() {
add_menu_page('RAD Dropbox Uploader', 'Dropbox', 8, 'rad-dropbox-uploader', 'rad_dropbox_top_page', WP_PLUGIN_URL.'/rad-dropbox-uploader/assets/icon-small.png');
add_submenu_page('rad-dropbox-uploader','RAD Dropbox Settings', 'Settings', 8, 'rad_dropbox_settings', 'rad_dropbox_settings');
}
/* End Page & Database Settings */

/* Begin Uploader Page */
function rad_dropbox_top_page() { ?>

<div class="wrap">
<?php include('inc/header.php');
$email = get_option('rad_dropbox_email');
$password = get_option('rad_dropbox_password');
$directory = get_option('rad_dropbox_directory');
?>
<div id="poststuff" class="metabox-holder has-right-sidebar">
<!-- BEGIN SIDEBAR -->
<div id="side-info-column" class="inner-sidebar">
<?php
include('inc/sidebar.php'); ?>
</div>
<!-- END SIDEBAR -->

<!-- BEGIN CONTENT AREA -->
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
<?php
require('classes/dropbox.class.php');
include('pages/uploader.php');
include('inc/footer.php');
include('inc/copyright.php');
?>

</div>
</div>
<!-- END CONTENT AREA -->

</div>
</div>

<?php }
/* End Uploader Page */

/* Begin Settings Page */
function rad_dropbox_settings() {  ?>

<div class="wrap">
<?php include('inc/header.php');
$email = get_option('rad_dropbox_email');
$password = get_option('rad_dropbox_password');
$directory = get_option('rad_dropbox_directory');
?>
<div id="poststuff" class="metabox-holder has-right-sidebar">
<!-- BEGIN SIDEBAR -->
<div id="side-info-column" class="inner-sidebar">
<?php
include('inc/sidebar.php'); ?>
</div>
<!-- END SIDEBAR -->

<!-- BEGIN CONTENT AREA -->
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
<?php
require('classes/dropbox.class.php');
include('pages/settings.php');
include('inc/footer.php');
include('inc/copyright.php');
?>

</div>
</div>
<!-- END CONTENT AREA -->

</div>
</div>

<?php  }

/* BEGIN SHORTCODE */
function rad_dropbox_shortcode( $atts ) {
$email = get_option('rad_dropbox_email');
$password = get_option('rad_dropbox_password');
$directory = get_option('rad_dropbox_directory');
require 'classes/dropbox.class.php';
include('inc/shortcode.php');
} add_shortcode( 'rad-dropbox', 'rad_dropbox_shortcode' ); ?>