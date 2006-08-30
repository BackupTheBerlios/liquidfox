<?
$lfaction_set['table']	 = $lfconf_db['prefix']."comments";
$lfaction_set['action']  = "del";

$_GET['fpage']=str_replace("_-_","&",$_GET['fpage']);
$_GET['fpage']=str_replace("::","?",$_GET['fpage']);
$lfaction_set['fpage']		= $_GET['fpage'];

// For checks
$lfaction_set['chby']	 = "id";
$lfaction_set['get']	 = "delete";
$lfaction_set['depencies'] = "connected,oper";

// Change on db
$lfaction_chdb="enabled";
?>