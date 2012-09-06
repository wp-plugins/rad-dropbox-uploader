<?php
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
</div>