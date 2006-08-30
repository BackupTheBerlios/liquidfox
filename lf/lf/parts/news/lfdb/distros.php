<?
$tablename=$lfconf_db['prefix']."distros";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//name

$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(20)";

	//packtype

$column++;
$db[$column]['name']  = "packtype";
$db[$column]['type']  = "varchar(10)";

	//added_by

$column++;
$db[$column]['name']  = "added_by";
$db[$column]['type']  = "varchar(20)";

?>