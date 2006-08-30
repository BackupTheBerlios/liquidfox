<?
$lfaction_set['table']		= $lfconf_db['prefix']."comments";
$lfaction_set['action']		= "add";
$lfaction_set['depencies']	= "connected";

$_POST['fpage']=str_replace("_-_","&",$_POST['fpage']);
$_POST['fpage']=str_replace("::","?",$_POST['fpage']);
$lfaction_set['fpage']		= $_POST['fpage'];

$lfaction_set['allow_update'] 	= "yes";
$lfaction_set['update_fields']	= "name,comment";
$lfaction_set['update_depencies']= "oper";

$lfaction_type['name'] = "text";
$lfaction_type['comment'] = "text";
$lfaction_type['table'] = "text";

$lfaction_static['by'] = $_COOKIE['nickname'];
$lfaction_static['message'] = $_POST['mid'];
$lfaction_static['time'] = date("G:i");
$lfaction_static['date'] = date("j/n/Y");

?>