<?php 
extract(shortcode_atts(array("dir" => $directory, "button" => 'Upload To Dropbox!'), $atts));
$rad_dropbox_settings = admin_url( 'admin.php?page=rad_dropbox_settings', '' );

if (empty($wp_settings_check)) { echo '<div class="message-yellow">You must enter your Dropbox account details first! Please go to the <a href="'.$rad_dropbox_settings.'">settings</a> page!</div><br>'; } 

echo $message; 

//beginning of mods here
$var_sHTML = '';

// concatenates the string below (the def of the HTML form) to the null string declared above.
// HTML below now concatenated with $variables instead of echoing their values 

$var_sHTML .= '<form method="POST" enctype="multipart/form-data" class="rad-dropbox-uploader">
<input type="hidden" name="dest" value="' . $dir . '" />
<div class="rad-dropbox-file">
<div style="margin-bottom:10px;"> <b>Upload Resume or Headshot</b> </div>
<input type="file" name="file" class="rad-dropbox-file" />
</div>
<div class="rad-dropbox-button">
<input type="submit" value="' . $button . '" class="rad-dropbox-button" />
</div>
</form>';

?>