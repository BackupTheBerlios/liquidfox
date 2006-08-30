<?
$tablename=$lfconf_db['prefix']."comments";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "bigint(20)";

$dbid = "id";
	//name

$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(30)";

	//desc

$column++;
$db[$column]['name']  = "comment";
$db[$column]['type']  = "text";


$column++;
$db[$column]['name']  = "email";
$db[$column]['type']  = "varchar(100)";

$column++;
$db[$column]['name']  = "ident";
$db[$column]['type']  = "varchar(32)";

$column++;
$db[$column]['name']  = "date";
$db[$column]['type']  = "varchar(32)";

$column++;
$db[$column]['name']  = "to";
$db[$column]['type']  = "bigint(20)";
?>