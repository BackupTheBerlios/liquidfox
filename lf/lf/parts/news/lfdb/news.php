<?
$tablename=$lfconf_db['prefix']."news";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//subject

$column++;
$db[$column]['name']  = "subject";
$db[$column]['type']  = "varchar(20)";

	//game_id

$column++;
$db[$column]['name']  = "game_id";
$db[$column]['type']  = "bigint(20)";

	//desc

$column++;
$db[$column]['name']  = "desc";
$db[$column]['type']  = "varchar(20)";

	//link

$column++;
$db[$column]['name']  = "link";
$db[$column]['type']  = "varchar(100)";

	//trashed_by

$column++;
$db[$column]['name']  = "trashed_by";
$db[$column]['type']  = "varchar(15)";

?>