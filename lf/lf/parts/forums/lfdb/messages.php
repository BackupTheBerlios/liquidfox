<?
$tablename=$lfconf_db['prefix']."messages";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//nickname

$column++;
$db[$column]['name']  = "message";
$db[$column]['type']  = "text";

	//name
$dbname="name";
$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(60)";

	//name
$dbname="name";
$column++;
$db[$column]['name']  = "by";
$db[$column]['type']  = "varchar(60)";

	// forum
$column++;
$db[$column]['name']  = "forum";
$db[$column]['type']  = "varchar(20)";

	// forum
$column++;
$db[$column]['name']  = "time";
$db[$column]['type']  = "varchar(5)";

	// forum
$column++;
$db[$column]['name']  = "date";
$db[$column]['type']  = "varchar(10)";

	// Trash (yes or not)
$column++;
$db[$column]['name']  = "hidden";
$db[$column]['type']  = "varchar(3)";
?>