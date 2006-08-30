<?
$tablename=$lfconf_db['prefix']."security";
$column=0; // Don't touch

	//ip

$column++;
$db[$column]['name']  = "ip";
$db[$column]['type']  = "varchar(39)";

	//last_time

$column++;
$db[$column]['name']  = "last_time";
$db[$column]['type']  = "bigint(20)";

	//flood_at

$column++;
$db[$column]['name']  = "flood_at";
$db[$column]['type']  = "bigint(20)";

?>