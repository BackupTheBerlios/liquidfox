<?
include "system/globals.php";
$siteloadtime_1=date("s");

$dir = "design"; 
include $lfpath."system/lf_filelist.php";
$_COOKIE['theme'] = $lf_file[1];

include "system/_get_.php";

// Check all user vars
if ($setheader<>"yes") { // if lfaction didn't started yet

	include "system/security.php";	// secure the site
	include "config.php";			// load settings
	// Loading other config files
	include "system/lfparts.php";

//	include "system/lfconfigs.php";
	include "system/lfdata_connect.php"; // connecting to database function
	include "system/lfquery.php";        // caching querys
	include "system/show_tag.php";	// Showing site tags
	if ((substr(phpversion(),0,1))=="4") {
		include "system/file_put_contents.php"; // For php version 4
		};
	};



//include "system/allowget.php";
include "system/load_defaults.php"; // loading defaults from config.php
include "system/lfdb.php";         // crating, updating, removing - tables, columns
include "system/lftheme_load.php"; // loading site theme and tagss
//include "lfparts.php";		      // what parts to use


// Starting connection to session
session_start();
include "system/textedit.php";

// Starting Connection to Database
$lf_connection =
lfdata_connect($lfconf_db['host'],$lfconf_db['user'],$lfconf_db['pass'],$lfconf_db['db']);
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

if ($setheader<>"yes") { // if lfaction didn't started yet
	
//	include "system/lfconfigs.php";

	};
// config addon (config that needs connection)
include "system/tips.php";


// Doing LFDB
$lftheme['content'] = lfdb($lftheme['content']);

// Loading the theme
	// Loading default theme
if ($_COOKIE['lftheme']<>"") {
	$lftheme['default']=$_COOKIE['lftheme'];
	};

// Loading lang files
foreach ($lfpart as $varName => $value) {
	include "parts/".$value."/lang/".$lftheme['lang'].".php";
	};
if (file_exists("design/default/lang/".$lftheme['lang'].".php")) {
	include "design/default/lang/".$lftheme['lang'].".php";
	};
if (file_exists("design/".$_COOKIE['theme']."/lang/".$lftheme['lang'].".php")) {
	include "design/".$_COOKIE['theme']."/lang/".$lftheme['lang'].".php";
	};
include "system/cache.php"; // load theme
//$lftheme['content'] = lftheme_load($lftheme['default'],$lang,$lfcanuse,$msg);

//print_r($_SESSION);
/*?><div style="position:absolute; left:0px; top: 0px; background: black; color: white;"><?
$siteloadtime_2=date("s");
if ($siteloadtime_2>$siteloadtime_1) {
	echo $siteloadtime_2-$siteloadtime_1;
	}
else {
	echo $siteloadtime_2+(60-$siteloadtime_1);
	};
?></div>*/
?>
