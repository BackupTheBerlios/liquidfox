<?
$temp_password = rand(1, 10000000);
$lfaction_set['table']	= $lfconf_db['prefix']."users";
$lfaction_set['action']	= "check";
$lfaction_set['page']	= "sent";
$lfaction_set['query']	= "UPDATE ".$lfconf_db['prefix']."users SET `password` = '".md5($temp_password)."' WHERE `nickname` = '".$_POST['nickname']."'";

// types
$lfaction_type['nickname']	= "text";
$lfaction_type['email']		= "mail";

$lfaction_check['column'] = "mode";
$lfaction_check['with']   = "oper,user";

// Static
	// Generate random identification

// Mail msg
$lfaction_mail['email']['headers']  = "MIME-Version: 1.0\r\n";
$lfaction_mail['email']['headers'] .= "Content-type: text/html; charset=utf-8\r\n";
$lfaction_mail['email']['to']       = $_POST['email'];
$lfaction_mail['email']['subject']  = "Linuxfun new password";
$lfaction_mail['email']['msg']	   = "Your new password is: ".$temp_password;
?>