<?
$tablename=$lfconf_db['prefix']."forums";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//nickname

$column++;
$db[$column]['name']  = "image";
$db[$column]['type']  = "varchar(60)";

	//name
$dbname="name";
$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(30)";

	// desc
$column++;
$db[$column]['name']  = "desc";
$db[$column]['type']  = "text";

	// subid
$column++;
$db[$column]['name']  = "admins";
$db[$column]['type']  = "varchar(20)";

	// subid
$column++;
$db[$column]['name']  = "sub_id";
$db[$column]['type']  = "varchar(20)";
?>