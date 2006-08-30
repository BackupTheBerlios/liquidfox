<?
$lfaction_set['table']	= $lfconf_db['prefix']."users";
$lfaction_set['action']	= "check";
$lfaction_set['GET']	= "yes";
$lfaction_set['page']	= "auth_succeed";

// types
$lfaction_type['nickname']		= "text";
$lfaction_type['ident']			= "md5";
$lfaction_type['mode']			= "static_insert";
$lfaction_type['ident']			= "static_insert";
$lfaction_type['first_time_password'] 	= "text";

// Checks
$lfaction_save['nickname']	= "yes";
$lfaction_save['ident']		= "yes";

$lfaction_check['column'] = "mode";
$lfaction_check['with']   = "ntba";

// Regex values 
 
$lfaction_reg['nickname'] = "^[a-zA-Z0-9_א-ת]{2,20}$^";

// Static
	// changing ntba to user
$lfaction_static['mode'] = "user";

	// Generate random identification
$lfaction_static['ident'] = md5($_POST['nickname'].$_POST['first_time_password'].rand(1, 10000000));
?>