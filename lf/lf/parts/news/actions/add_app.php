<?
$lfaction_set['table']	    = $lfconf_db['prefix']."games";
$lfaction_set['action']	    = "add";
$lfaction_set['second_id']['1'] = "name";
$lfaction_set['depency']	= "connected";

// types
$lfaction_type['name'] 		= "text";
$lfaction_type['desc'] 		= "text";
$lfaction_type['home'] 		= "text";
$lfaction_type['link_pics'] 	= "text";
$lfaction_type['link_fans'] 	= "text";
$lfaction_type['link_log']  	= "text";
$lfaction_type['category'] 	= "text";
$lfaction_type['pic_loc'] 	= "file";
$lfaction_mt['link_pics']	= "yes";
$lfaction_mt['link_fans']	= "yes";
$lfaction_mt['link_log']		= "yes";
// Regex values 
 
//$lfaction_reg['name'] = "^[a-zA-Z0-9_]{2,20}$^";
$lfaction_reg['name'] = "^[a-zA-Z�0-9_]{2,20}$^";
$lfaction_reg['desc'] = "^.{20,3200}$^";
$lfaction_reg['home'] = '^http:\/\/[_\.?=a-zA-Z0-9\/]{5,60}$^';
$lfaction_reg['link_pics'] = $lfaction_reg['home'];
$lfaction_reg['link_fans'] = $lfaction_reg['home'];
$lfaction_reg['link_log']  = $lfaction_reg['home'];
$lfaction_reg_not['category'] = "� �� � �����";

// Files checks
$lfaction_file['pic_loc']['allow_empty']  = "no";
$lfaction_file['pic_loc']['types']  	  = "image/jpeg,image/gif,image/png";
$lfaction_file['pic_loc']['max_size']	  = "80000";
$lfaction_file['pic_loc']['upload_loc']   = "uploads";
$lfaction_file['pic_loc']['add_table_id'] = "yes";
$lfaction_file['pic_loc']['table_id'] 	  = "id";

// Static values
$lfaction_static['section'] = "apps";
$lfaction_static['add_date'] = date("j/n/Y");
$lfaction_static['added_by'] = $_COOKIE['nickname'];
?>