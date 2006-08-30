<?
$lfaction_set['table']	= $lfconf_db['prefix']."users";
$lfaction_set['action']	= "check";
$lfaction_set['save']	= "cookie";
//$lfaction_set['fpage']	= "index.php?content=after_login";
$lfaction_set['fpage']	= "index.php";


// types
$lfaction_type['nickname']	= "text";
$lfaction_type['password']	= "md5";
$lfaction_type['ident'] 	= "static_insert";


// Checks
$lfaction_save['nickname']	= "yes";
$lfaction_save['password']	= "yes";
$lfaction_save['ident']		= "yes";

$lfaction_check['column'] = "mode";
$lfaction_check['with']   = "admin,oper,user";

// Regex values 
 
//$lfaction_reg['nickname'] = "^[a-z�A-Z0-9_]{2,20}$^";
//$lfaction_reg['password'] = $lfaction_reg['nickname'];

// Static
	// Generate random identification
$lfaction_static['ident'] = md5($_POST['nickname'].$_POST['password'].rand(1, 10000000));

?>