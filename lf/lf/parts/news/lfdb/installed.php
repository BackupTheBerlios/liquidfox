<?
$tablename=$lfconf_db['prefix']."installed";
$column=0; // Don't touch

	//installed

$column++;
$db[$column]['name']  = "installed";
$db[$column]['type']  = "char(1)";

	//name

$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(100)";

	//desc

$column++;
$db[$column]['name']  = "desc";
$db[$column]['type']  = "text";

	//picnum

$column++;
$db[$column]['name']  = "picnum";
$db[$column]['type']  = "bigint(20)";

	//pic_loc

$column++;
$db[$column]['name']  = "pic_loc";
$db[$column]['type']  = "varchar(50)";

?>