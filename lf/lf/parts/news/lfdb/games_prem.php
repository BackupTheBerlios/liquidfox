<?
$tablename=$lfconf_db['prefix']."games_prem";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//game

$column++;
$db[$column]['name']  = "game";
$db[$column]['type']  = "varchar(30)";

	//user

$column++;
$db[$column]['name']  = "user";
$db[$column]['type']  = "varchar(15)";

	//mode

$column++;
$db[$column]['name']  = "mode";
$db[$column]['type']  = "varchar(4)";

?>