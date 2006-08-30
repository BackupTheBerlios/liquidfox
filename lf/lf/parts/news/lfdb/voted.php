<?
$tablename=$lfconf_db['prefix']."voted";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//nickname

$column++;
$db[$column]['name']  = "nickname";
$db[$column]['type']  = "varchar(15)";

	//game

$column++;
$db[$column]['name']  = "game";
$db[$column]['type']  = "varchar(30)";

?>