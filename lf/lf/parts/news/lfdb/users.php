<?
$tablename=$lfconf_db['prefix']."users";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "bigint(20)";

$dbid = "id";
	//points

$column++;
$db[$column]['name']  = "points";
$db[$column]['type']  = "int(11)";

	//mode

$column++;
$db[$column]['name']  = "mode";
$db[$column]['type']  = "varchar(4)";

	//nickname

$column++;
$db[$column]['name']  = "nickname";
$db[$column]['type']  = "varchar(15)";

	//password

$column++;
$db[$column]['name']  = "password";
$db[$column]['type']  = "varchar(100)";

	//email

$column++;
$db[$column]['name']  = "email";
$db[$column]['type']  = "varchar(40)";

	//mess_net

$column++;
$db[$column]['name']  = "mess_net";
$db[$column]['type']  = "varchar(10)";

	//mess_id

$column++;
$db[$column]['name']  = "mess_id";
$db[$column]['type']  = "varchar(30)";

	//distro

$column++;
$db[$column]['name']  = "distro";
$db[$column]['type']  = "varchar(20)";

	//status

$column++;
$db[$column]['name']  = "status";
$db[$column]['type']  = "varchar(10)";

	//add_date

$column++;
$db[$column]['name']  = "add_date";
$db[$column]['type']  = "text";

	//ident

$column++;
$db[$column]['name']  = "ident";
$db[$column]['type']  = "varchar(100)";

	//first_time_password

$column++;
$db[$column]['name']  = "first_time_password";
$db[$column]['type']  = "varchar(100)";

	//theme

$column++;
$db[$column]['name']  = "theme";
$db[$column]['type']  = "varchar(20)";

	//last_time

$column++;
$db[$column]['name']  = "last_time";
$db[$column]['type']  = "bigint(20)";

	//flood_time

$column++;
$db[$column]['name']  = "flood_time";
$db[$column]['type']  = "bigint(20)";

?>