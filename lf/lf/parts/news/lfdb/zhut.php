<?
$tablename=$lfconf_db['prefix']."zhut";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "int(11)";

$dbid = "id";
	//f_select

$column++;
$db[$column]['name']  = "f_select";
$db[$column]['type']  = "varchar(15)";

	//s_select

$column++;
$db[$column]['name']  = "s_select";
$db[$column]['type']  = "varchar(15)";

	//username

$column++;
$db[$column]['name']  = "username";
$db[$column]['type']  = "varchar(15)";

	//email

$column++;
$db[$column]['name']  = "email";
$db[$column]['type']  = "varchar(15)";

	//phone

$column++;
$db[$column]['name']  = "phone";
$db[$column]['type']  = "varchar(15)";

	//cell

$column++;
$db[$column]['name']  = "cell";
$db[$column]['type']  = "varchar(15)";

	//area

$column++;
$db[$column]['name']  = "area";
$db[$column]['type']  = "varchar(15)";

	//town

$column++;
$db[$column]['name']  = "town";
$db[$column]['type']  = "varchar(15)";

	//price

$column++;
$db[$column]['name']  = "price";
$db[$column]['type']  = "varchar(15)";

	//money_type

$column++;
$db[$column]['name']  = "money_type";
$db[$column]['type']  = "varchar(15)";

	//maam

$column++;
$db[$column]['name']  = "maam";
$db[$column]['type']  = "varchar(15)";

	//addons

$column++;
$db[$column]['name']  = "addons";
$db[$column]['type']  = "text";

?>