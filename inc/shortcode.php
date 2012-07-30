<?php 
extract(shortcode_atts(array("dir" => $directory, "button" => 'Upload To Dropbox!'), $atts));
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