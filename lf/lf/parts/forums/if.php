<?
// Checks if a user is a owner of a msg
$Iif++;
$if[$Iif]			= "cmt_owner";
$if_check['cmt_owner']['type']  	= "sql";
$if_check['cmt_owner']['sql']   	= "SELECT * FROM ".$lfconf_db['prefix']."comments WHERE `by` = '".$_COOKIE['nickname']."' ADN `id` = '".$_GET['mid'].$_POST['mid']."'";

$Iif++;
$if[$Iif]			= "msg_owner";
$if_check['msg_owner']['type']  	= "sql";
$if_check['msg_owner']['sql']   	= "SELECT * FROM `".$lfconf_db['prefix']."messages` WHERE `by` = '".$_COOKIE['nickname']."' AND `id` = '".$_GET['mid'].$_POST['mid']."'";


//echo "<div dir=ltr>SELECT * FROM comment WHERE `by` = '".$_COOKIE['nickname']."' AND `id` = '".$_GET['mid'].$_POST['mid']."'</div>";

// Special if that checks if user owns a comment
$Iif++;
$if[$Iif]			= $_COOKIE['nickname']."_".$_COOKIE['nickname']."_own_comment";
//echo "<div dir=ltr>".$_COOKIE['nickname']."_".$_COOKIE['nickname']."_own_comment"."</div>";
$if_check[$_COOKIE['nickname']."_".$_COOKIE['nickname']."_own_comment"]['type']  	= "true";
$if_check[$_COOKIE['nickname']."_".$_COOKIE['nickname']."_own_comment"]['check']   	= true;

// Edit level
$Iif++;
$if[$Iif]			= "editlevel1";
$if_check['editlevel1']['type']  	= "true";
$if_check["editlevel1"]['check']   = ($_GET['edit_level']=="");


$Iif++;
$if[$Iif]			= "editlevel2";
$if_check['editlevel2']['type']  	= "true";
$if_check["editlevel2"]['check']   = ($_GET['edit_level']=="2");


$Iif++;
$if[$Iif]			= "editlevel3";
$if_check['editlevel3']['type']  	= "true";
$if_check["editlevel3"]['check']   = ($_GET['edit_level']=="3");

$Iif++;
$if[$Iif]			= "textedit";
$if_check['textedit']['type']  	= "true";
$if_check["textedit"]['check']   = ($_GET['textedit']=="yes");
/*
// same if
$Iif++;
$if[$Iif]                       = "[COOKIE_nickname]_".$_COOKIE['nickname'] . "_own_comment";
echo "<div dir=ltr>"."[COOKIE_nickname]_".$_COOKIE['nickname'] . "_own_comment"."</div>";
$if_check['siteadmin']['type']          = "true";
$if_check['siteadmin']['check']         = false;
*/
?>