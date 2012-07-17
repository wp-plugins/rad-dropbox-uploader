<?php
/*
Plugin Name: RAD Dropbox Uploader
Plugin URI: http://www.radmediaco.com/plugins/wp-dropbox-uploader/
Description: Allow users to upload files directly to your Dropbox account from WordPress administration! Great for web designers & users alike!
Author: RAD Media Company
Version: 1.0.1
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
add_submenu_page('rad-dropbox-uploader','RAD Dropbox Documentation', 'Documentation', 8, 'rad_dropbox_shortcode_css', 'rad_dropbox_shortcode_css');
}
/* End Page & Database Settings */

/* Begin Uploader Page */
function rad_dropbox_top_page() { ?>

<div class="wrap">
<?php include('assets/header.php');
$email = get_option('rad_dropbox_email');
$password = get_option('rad_dropbox_password');
$directory = get_option('rad_dropbox_directory');
?>
<div id="poststuff" class="metabox-holder has-right-sidebar">

<!-- BEGIN SIDEBAR -->
<div id="side-info-column" class="inner-sidebar">

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-connect.php'); ?>
</div>
</div>

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-donate.php'); ?>
</div>
</div>

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-links.php'); ?>
</div>
</div>

</div>
<!-- END SIDEBAR -->

<!-- BEGIN CONTENT AREA -->
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
<?php
require 'assets/dropbox.class.php';
$rad_dropbox_settings = admin_url( 'admin.php?page=rad_dropbox_settings', '' );
if (empty($wp_settings_check)) { echo '<div class="message-yellow">You must enter your Dropbox account details first! Please go to the <a href="'.$rad_dropbox_settings.'">settings</a> page!</div><br>'; } 
echo $message;
?>
<div id="normal-sortables" class="meta-box-sortables">
<div id="about" class="postbox">
<div class="inside">
<br class="clear" />
<center>

<img src="<?php echo WP_PLUGIN_URL ?>/rad-dropbox-uploader/assets/dropbox-logo.png ">
<br><br>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="dest" value="<?php echo $directory ?>" />
<input type="file" name="file" /><br><br>
<input type="submit" value="Upload To Dropbox!" class="button-primary" />
</form>

</center>
<br class="clear" />
</div>
</div>
<?php include('assets/footer.php'); include('assets/copyright.php'); ?>
</div>
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
<?php include('assets/header.php'); ?>
<div id="poststuff" class="metabox-holder has-right-sidebar">

<!-- BEGIN SIDEBAR -->
<div id="side-info-column" class="inner-sidebar">

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-connect.php'); ?>
</div>
</div>

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-donate.php'); ?>
</div>
</div>

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-links.php'); ?>
</div>
</div>

</div>
<!-- END SIDEBAR -->

<!-- BEGIN CONTENT AREA -->
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
<?php
$rad_dropbox_email = $_POST["rad_dropbox_email"];
$rad_dropbox_password = $_POST["rad_dropbox_password"]; 
$rad_dropbox_directory = $_POST["rad_dropbox_directory"];
if ($_POST) {
update_option('rad_dropbox_email', $rad_dropbox_email, '', 'yes');
update_option('rad_dropbox_password', $rad_dropbox_password, '', 'yes');
update_option('rad_dropbox_directory', $rad_dropbox_directory, '', 'yes');
}
$wp_settings_check = get_option('rad_dropbox_email');
if (empty($wp_settings_check)) { ?>
<div id="normal-sortables" class="meta-box-sortables">
<div id="about" class="postbox">
<div class="inside">
<br class="clear" />
<center>

<img src="<?php echo WP_PLUGIN_URL ?>/rad-dropbox-uploader/assets/dropbox-logo.png "><br><br>
<form method="post">

<table border="0">
<tr>
<td width="50%">Dropbox Email:</td>
<td width="50%"><input type="text" name="rad_dropbox_email" value="<?php echo get_option('rad_dropbox_email'); ?>" /></td>
</tr>
<tr>
<td>Dropbox Password:</td>
<td><input type="password" name="rad_dropbox_password" value="<?php echo get_option('rad_dropbox_password'); ?>" /></td>
</tr>
<tr>
<td>Dropbox Directory:</td>
<td><input type="text" name="rad_dropbox_directory" value="<?php echo get_option('rad_dropbox_directory'); ?>" /></td>
</tr>
</table><br>
<input type="submit" name="save_settings" value="Save Settings!" class="button-primary" />
</form>

<?php } else { 
if ($_POST) {
update_option('rad_dropbox_email', $rad_dropbox_email, '', 'yes');
update_option('rad_dropbox_password', $rad_dropbox_password, '', 'yes');
update_option('rad_dropbox_directory', $rad_dropbox_directory, '', 'yes');
} ?>
<div class="message-yellow">Your account details have been saved!</div><br>
<div id="normal-sortables" class="meta-box-sortables">
<div id="about" class="postbox">
<div class="inside">
<br class="clear" />
<center>

<img src="<?php echo WP_PLUGIN_URL ?>/rad-dropbox-uploader/assets/dropbox-logo.png "><br><br>
To modify your account details, you must first reset them!<br><br>
<form method="post">
<input type="hidden" name="rad_dropbox_email" value="" />
<input type="hidden" name="rad_dropbox_password" value="" />
<input type="hidden" name="rad_dropbox_directory" value="/" />
<input type="submit" name="reset_settings" value="Reset Settings!" class="button-primary" />
</form>
<?php } ?>
</center>
<br class="clear" />
</div>
</div>
<?php include('assets/footer.php'); include('assets/copyright.php'); ?>
</div>
</div>
</div>
<!-- END CONTENT AREA -->

</div>
</div>

<?php 
/* Begin Documentation Page */
} function rad_dropbox_shortcode_css() { ?>

<div class="wrap">
<?php include('assets/header.php'); ?>
<div id="poststuff" class="metabox-holder has-right-sidebar">

<!-- BEGIN SIDEBAR -->
<div id="side-info-column" class="inner-sidebar">

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-connect.php'); ?>
</div>
</div>

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-donate.php'); ?>
</div>
</div>

<div class="meta-box-sortables">
<div id="about" class="postbox">
<?php include('assets/sidebar-links.php'); ?>
</div>
</div>

</div>
<!-- END SIDEBAR -->

<!-- BEGIN CONTENT AREA -->
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
<div id="normal-sortables" class="meta-box-sortables">
<div id="about" class="postbox">
<div class="inside">
<br class="clear" />
<center>
<img src="<?php echo WP_PLUGIN_URL ?>/rad-dropbox-uploader/assets/dropbox-logo.png ">
<br><br>
</center>
<p><b>How To Use Shortcode</b></p>
<p>Using the standard shortcode will create a basic upload form that will send uploads to the directory specified on the settings page of this plugin. There are 
two optional attributes that can be attached to this shortcode.</p>
<p>The "dir" attribute allows you to define the specific directory where uploads will be uploaded to. If the "dir" attribute is not used or is undefined, files 
will be uploaded to the directory specified under the settings page.</p>
<p>The "button" attribute allows you to specify the upload button text. If the "button" attribute is not used or is undefined, a default button text will appear.</p>
<p><center><table border="0">
<tr>
<td width="50%"><b>Standard Shortcode</b></td>
<td width="50%"><pre>[rad-dropbox]</pre></td>
</tr>
<tr>
<td><b>With Button Attribute</b></td>
<td><pre>[rad-dropbox button="Send File!"]</pre></td>
</tr>
<tr>
<td><b>With Directory Attribute</b><br><span style="font-size:10px;">Remember opening slash!</span></td>
<td><pre>[rad-dropbox dir="/Path/To/Folder"]</pre></td>
</tr>
<tr>
<td><b>Together</b><br><span style="font-size:10px;">Remember opening slash!</span></td>
<td><pre>[rad-dropbox dir="/Path/To/Folder" button="Upload!"]</pre></td>
</tr></table></center></p>
<br class="clear" />

<p><b>Implementing Custom CSS</b></p>
<p>Every element that displays with the shortcode has its own attached class. This allows you to customize the look and feel of the shortcode
form by adding the class names to your stylesheet, and customizing as you see fit.</p>
<p>There is a class attached to the form element, file selection element, & upload button element.</p>
<p>In addition, there is also a div around the file selection element, & another around the upload button element, as outlined below.</p>
<p><center><img src="<?php echo WP_PLUGIN_URL ?>/rad-dropbox-uploader/assets/css-layout.png" width="100%"></center></p>


<p><center><table border="0">
<tr>
<td width="50%"><b>Element Color</b></td>
<td width="50%"><b>CSS Example</td>
</tr>
<tr>
<td><b style="color:black;">Black</b> - Error Message</td>
<td><pre>div.rad-dropbox-error { CSS Here! }</pre></td>
</tr>
<tr>
<td><b style="color:black;">Black</b> - Success Message</td>
<td><pre>div.rad-dropbox-success { CSS Here! }</pre></td>
</tr>
<tr>
<td><b style="color:green;">Green</b> - File Select DIV</td>
<td><pre>div.rad-dropbox-file { CSS Here! }</pre></td>
</tr>
<tr>
<td><b style="color:blue;">Blue</b> - Upload Button DIV</td>
<td><pre>div.rad-dropbox-button { CSS Here! }</pre></td>
</tr>
<tr>
<td width="50%"><b style="color:red;">Red</b> - Form Element</td>
<td width="50%"><pre>form.rad-dropbox-uploader { CSS Here! }</pre></td>
</tr>
<tr>
<td><b style="color:orange;">Orange</b> - File Select Element</td>
<td><pre>input.rad-dropbox-file { CSS Here! }</pre></td>
</tr>
<tr>
<td><b style="color:purple;">Purple</b> - Upload Button Element</td>
<td><pre>input.rad-dropbox-button { CSS Here! }</pre></td>
</tr>
</table></center></p>
<br class="clear" />


<br class="clear" />
</div>
</div>
<?php include('assets/footer.php'); include('assets/copyright.php'); ?>
</div>
</div>
</div>
<!-- END CONTENT AREA -->

</div>
</div>

<?php }
/* End Documentation Page */

/* BEGIN SHORTCODE */
function rad_dropbox_shortcode( $atts ){
$email = get_option('rad_dropbox_email');
$password = get_option('rad_dropbox_password');
$directory = get_option('rad_dropbox_directory');
extract(shortcode_atts(array("dir" => $directory, "button" => 'Upload To Dropbox!'), $atts));
require 'assets/dropbox.class.php';
$rad_dropbox_settings = admin_url( 'admin.php?page=rad_dropbox_settings', '' );
if (empty($wp_settings_check)) { echo '<div class="message-yellow">You must enter your Dropbox account details first! Please go to the <a href="'.$rad_dropbox_settings.'">settings</a> page!</div><br>'; } 
echo $message; ?>

<form method="POST" enctype="multipart/form-data" class="rad-dropbox-uploader">
<input type="hidden" name="dest" value="<?php echo $dir; ?>" />
<div class="rad-dropbox-file">
<input type="file" name="file" class="rad-dropbox-file" />
</div>
<div class="rad-dropbox-button">
<input type="submit" value="<?php echo $button; ?>" class="rad-dropbox-button" />
</div>
</form>

<?php } add_shortcode( 'rad-dropbox', 'rad_dropbox_shortcode' ); ?>