<?
$lfaction_set['table']		= $lfconf_db['prefix']."messages";
$lfaction_set['action']		= "add";
$lfaction_set['depencies']	= "connected";
if ($_GET['fpage']<>"") {
	$lfaction_set['fpage']		= "index.php?content=forums&equal_forums=".$_POST['forum'];
	}
else {
	$_POST['fpage']=str_replace("_-_","&",$_POST['fpage']);
	$_POST['fpage']=str_replace("::","?",$_POST['fpage']);
	$lfaction_set['fpage']=$_POST['fpage'];
	};

$lfaction_set['allow_update'] 	= "yes";
$lfaction_set['update_fields']	= "name,message";
$lfaction_set['update_depencies']= "connected,msg_own";

$lfaction_type['name'] = "text";
$lfaction_type['message'] = "text";

$lfaction_static['by'] = $_COOKIE['nickname'];
$lfaction_static['forum'] = $_POST['forum'];
$lfaction_static['time'] = date("G:i");
$lfaction_static['date'] = date("j/n/Y");

?>