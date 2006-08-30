<?
$tablename=$lfconf_db['prefix']."versions";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "bigint(20)";

$dbid = "id";
	//game_name

$column++;
$db[$column]['name']  = "game_name";
$db[$column]['type']  = "varchar(20)";

	//version

$column++;
$db[$column]['name']  = "version";
$db[$column]['type']  = "varchar(20)";

?>