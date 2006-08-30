<?
$lfaction_set['table']			= $lfconf_db['prefix']."users";
$lfaction_set['action']			= "add";
$lfaction_set['second_id']['1']	= "nickname";
$lfaction_set['second_id']['2']	= "email";
$lfaction_set['fpage']	= "index.php?content=end_reg";

$lfaction_set['allow_update'] 	= "yes";
$lfaction_set['update_fields']	= "password,mess_net,mess_id,distro,password_equal,other_distro";
$lfaction_set['update_depencies'] = "thisuser";
$lfaction_set['update_hide']		= "email";

// types
$lfaction_type['nickname']	= "text";
$lfaction_type['password']	= "md5";
$lfaction_type['password_equal']= "equal";
$lfaction_type['email'] 	= "text";
$lfaction_type['mess_net'] 	= "text";
$lfaction_type['mess_id']	= "text";
$lfaction_type['distro']	= "text";
$lfaction_type['other_distro']  = "other";
$lfaction_type['first_time_password'] = "mail";

// Regex values 
//$lfaction_reg['nickname']       	= "^[a-zA-Z0-9_�]{2,20}$^";
//$lfaction_reg['password']       	= "^[a-zA-Z0-9_�]{6,20}$^";
//$lfaction_reg['email']	       		= "^[a-z0-9._%-]+@[a-z0-9._%-]+\.[a-z]{2,4}$^";
//$lfaction_reg['mess_net'] 		= $lfaction_reg['nickname'];
//$lfaction_reg['mess_id'] 		= "^[a-zA-Z0-9_�]{0,20}$^";
//$lfaction_reg['distro'] 		= $lfaction_reg['nickname'];
//$lfaction_reg['other_distro'] 	= $lfaction_reg['distro'];

// Linked fields
$lfaction_linked['password_equal'] 	= "password";
$lfaction_linked['other_distro']        = "distro";

// Static values
$lfaction_static['mode'] = "ntba"; // automaticly set the mode to "Need To Be Activated"
$lfaction_static['first_time_password'] = md5(rand(1, 10000000));

// Mail msg
$lfaction_mail['first_time_password']['headers']  = "MIME-Version: 1.0\r\n";
$lfaction_mail['first_time_password']['headers'] .= "Content-type: text/html; charset=utf-8\r\n";
$lfaction_mail['first_time_password']['to']       = $_POST['email'];
$lfaction_mail['first_time_password']['subject']  = "[you_got_mail_from_".$HTTP_HOST."]";
$lfaction_mail['first_time_password']['msg']	   = "<a href=\"http://". $HTTP_HOST . $REQUEST_URI. "?first_time_password=".$lfaction_static['first_time_password']."&nickname=".$_POST['nickname']."&lfaction=news|mailauth\">click here to authorize your acount</a>";

?>