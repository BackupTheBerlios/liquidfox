<?
$tablename=$lfconf_db['prefix']."games";
$column=0; // Don't touch

	//id

$column++;
$db[$column]['name']  = "id";
$db[$column]['type']  = "bigint(20)";

$dbid = "id";
	//name

$column++;
$db[$column]['name']  = "name";
$db[$column]['type']  = "varchar(60)";

	//desc

$column++;
$db[$column]['name']  = "desc";
$db[$column]['type']  = "text";

	//added_desc

$column++;
$db[$column]['name']  = "added_desc";
$db[$column]['type']  = "text";

	//other_desc

$column++;
$db[$column]['name']  = "other_desc";
$db[$column]['type']  = "text";

	//free_desc

$column++;
$db[$column]['name']  = "free_desc";
$db[$column]['type']  = "text";

	//free_desc_history

$column++;
$db[$column]['name']  = "free_desc_history";
$db[$column]['type']  = "text";

	//pic_loc

$column++;
$db[$column]['name']  = "pic_loc";
$db[$column]['type']  = "varchar(100)";

	//home

$column++;
$db[$column]['name']  = "home";
$db[$column]['type']  = "varchar(100)";

	//link_fans

$column++;
$db[$column]['name']  = "link_fans";
$db[$column]['type']  = "varchar(100)";

	//link_pics

$column++;
$db[$column]['name']  = "link_pics";
$db[$column]['type']  = "varchar(100)";

	//link_log

$column++;
$db[$column]['name']  = "link_log";
$db[$column]['type']  = "varchar(100)";

	//category

$column++;
$db[$column]['name']  = "category";
$db[$column]['type']  = "varchar(20)";

	//add_date

$column++;
$db[$column]['name']  = "add_date";
$db[$column]['type']  = "text";

	//graphics_grade

$column++;
$db[$column]['name']  = "graphics_grade";
$db[$column]['type']  = "float";

	//music_grade

$column++;
$db[$column]['name']  = "music_grade";
$db[$column]['type']  = "float";

	//story_grade

$column++;
$db[$column]['name']  = "story_grade";
$db[$column]['type']  = "float";

	//game_grade

$column++;
$db[$column]['name']  = "game_grade";
$db[$column]['type']  = "float";

	//added_by

$column++;
$db[$column]['name']  = "added_by";
$db[$column]['type']  = "varchar(15)";

	//second_man

$column++;
$db[$column]['name']  = "second_man";
$db[$column]['type']  = "varchar(15)";

	//section

$column++;
$db[$column]['name']  = "section";
$db[$column]['type']  = "varchar(15)";

	//trashed_by

$column++;
$db[$column]['name']  = "trashed_by";
$db[$column]['type']  = "varchar(15)";

?>