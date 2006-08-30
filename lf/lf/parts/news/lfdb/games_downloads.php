<?
$tablename=$lfconf_db['prefix']."games_downloads";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "bigint(20)";

$dbid = "id";
	//name

$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(20)";

	//version

$column++;
$db[$column]['name']  = "version";
$db[$column]['type']  = "varchar(20)";

	//added_by

$column++;
$db[$column]['name']  = "added_by";
$db[$column]['type']  = "varchar(20)";

	//date

$column++;
$db[$column]['name']  = "date";
$db[$column]['type']  = "text";

	//distro

$column++;
$db[$column]['name']  = "distro";
$db[$column]['type']  = "varchar(20)";

	//distro_version

$column++;
$db[$column]['name']  = "distro_version";
$db[$column]['type']  = "varchar(20)";

	//comments

$column++;
$db[$column]['name']  = "comments";
$db[$column]['type']  = "text";

	//link

$column++;
$db[$column]['name']  = "link";
$db[$column]['type']  = "varchar(100)";

	//isbroken

$column++;
$db[$column]['name']  = "isbroken";
$db[$column]['type']  = "varchar(3)";

?>