<?
$doneIf['news']="done";

$Iif++;

$if[$Iif]			= "connected";
$if_check['connected']['type']  = "cookie";
$if_check['connected']['table'] = $lfconf_db['prefix']."users";
$if_check['connected']['cookie_fields']= "nickname,ident";

$Iif++;
$if[$Iif]			= "thisuser";
$if_check['thisuser']['type']  	= "sql";
$if_check['thisuser']['sql']   	= "SELECT nickname FROM ".$lfconf_db['prefix']."users WHERE `id` = '".$_POST['lfupdate_id']."' AND nickname = '".$_COOKIE['nickname']."' AND ident = '".$_COOKIE['ident']."'";

$Iif++;
$if[$Iif]					= "game";
$if_check['game']['type']  	= "sql";
$if_check['game']['sql']	= "SELECT * FROM ".$lfconf_db['prefix']."games WHERE `id` = '".$_GET['equal_1']."' AND `section` = 'games'";

$Iif++;
$if[$Iif]					= "own~".$_COOKIE['nickname']."~".$_COOKIE['nickname'];
$if_check["own~".$_COOKIE['nickname']."~".$_COOKIE['nickname']]['type']  	= "true";
if ($_COOKIE['nickname']<>"") {
	$if_check["own~".$_COOKIE['nickname']."~".$_COOKIE['nickname']]['check'] = true;
	}
else {
	$if_check["own~".$_COOKIE['nickname']."~".$_COOKIE['nickname']]['check'] = false;
	};


$Iif++;
$if[$Iif]					= "oper";
$if_check['oper']['type']  	= "sql";
$if_check['oper']['sql']	= "SELECT * FROM ".$lfconf_db['prefix']."users WHERE `nickname` = '".$_COOKIE['nickname']."' AND `ident` = '".$_COOKIE['ident']."' AND `password`='".$_COOKIE['password']."' AND `mode`='oper'";

if ($_GET['equal_news']<>"") {
	$_POST['lfupdate_id']=$_GET['equal_news'];
	};

$Iif++;
$if[$Iif]					= "game_owner";
$if_check['game_owner']['type']  	= "sql";
$if_check['game_owner']['sql']	= "SELECT * FROM `".$lfconf_db['prefix']."games` WHERE `added_by` = '".$_COOKIE['nickname']."' AND `id` = '".$_POST['lfupdate_id']."'";


//echo $if_check['game']['sql']."<br>";
/* TODO - finish oper check in includes/ifs.php
$Iif++;
$if[$Iif]			  = "oper";
$if_check['connected']['type']    = "equal";
$if_check['connected']['depency'] = "connected";
$if_check['connected']['table']   = "users";
$if_check['connected']['cookie_fields']  = "nickname,ident";
$if_check['connected']['equal']   = "";
*/
?>