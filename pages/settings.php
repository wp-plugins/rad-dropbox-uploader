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

</center>
<br class="clear" />
</div>
</div>
</div>

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

</center>
<br class="clear" />
</div>
</div>
</div>
<?php } ?>