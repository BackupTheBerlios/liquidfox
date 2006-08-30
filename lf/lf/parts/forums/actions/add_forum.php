<?
$lfaction_set['table']		= $lfconf_db['prefix']."forums";
$lfaction_set['action']		= "add";
$lfaction_set['depencies']	= "oper";

$_POST['fpage']=str_replace("_-_","&",$_POST['fpage']);
$_POST['fpage']=str_replace("::","?",$_POST['fpage']);
$lfaction_set['fpage']		= $_POST['fpage'];

$lfaction_set['allow_update'] 	= "yes";
$lfaction_set['update_fields']	= "name,desc,image";
$lfaction_set['update_depencies']= "oper";

$lfaction_type['name'] = "text";
$lfaction_type['subid'] = "text";
$lfaction_type['desc'] = "text";
$lfaction_type['sub_id'] = "text";
$lfaction_type['image'] = "file";

// Files checks
$lfaction_file['image']['allow_empty']  = "yes";
$lfaction_file['image']['types']  	  = "image/jpeg,image/gif,image/png";
$lfaction_file['image']['max_size']	  = "80000";
$lfaction_file['image']['upload_loc']   = "uploads";
$lfaction_file['image']['add_table_id'] = "yes";
$lfaction_file['image']['table_id'] 	  = "id";
?>