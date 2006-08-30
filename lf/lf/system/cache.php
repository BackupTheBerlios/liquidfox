<?
// Doing all if's on site
if (file_exists("design/default/main.html")) {
		$lftheme['content']=file_get_contents("design/default/main.html");
		}
	else {
		if (file_exists("parts/". $lftheme['default'] ."/main.html")) {
			$lftheme['content']=file_get_contents("parts/". $lftheme['default'] ."/main.html");
			};
		};
$splt_content=split("_",$_GET['content']);

if ($splt_content['0']=="default") {
	$contentfile = file_get_contents("design/default/content/".$splt_content['1'].".html");	
	}
else {
	$dir="parts";
	include "system/lf_filelist.php";
	foreach ($lf_file as $fileNumber => $fileValue) {
		if (file_exists("parts/". $fileValue."/content/". $_GET['content'] .".html")) {
			$contentfile = file_get_contents("parts/". $fileValue."/content/". $_GET['content'] .".html");
			};
		};
//	$contentfile = file_get_contents("parts/". $lftheme['default']."/content/".$_GET['content'].".html");	
	};
	
$lftheme['content']=str_replace("[LF_CONTENT]",$contentfile,$lftheme['content']);



if ($lfcache=="yes") {
    $cachefile="";
    foreach($_GET as $name => $value) {
	   $cachefile .= $name ."__".$value."__";
	   };

    foreach($_COOKIE as $name => $value) {
	   $cachefile .= $name ."__".$value."__";
	   };

    $cachefile = md5($cachefile);
    if (file_exists("cached/data/".$_GET['content']."_".$cachefile.".html")) {
	   $lftheme['content'] = file_get_contents("cached/data/" . $_GET['content'] . "_" . $cachefile . ".html");
	   $loadtofile="yes";
		
	   }
    else {
	   $lftheme['content'] = lftheme_load($lftheme['default'],$lang,$lfcanuse,$msg,$_oldGET,$lfdefault);
	   file_put_contents("cached/data/" . $_GET['content'] ."_" . $cachefile . ".html", $lftheme['content']);
	   };
    }
else {
    $lftheme['content'] = lftheme_load($lftheme['default'],$lang,$lfcanuse,$msg,$_oldGET,$lfdefault);
    };

//include "system/ifs.php";

/*
if ((file_exists("cached/data/".$cachefile.".html")) 
	AND ($lfcache[$_GET['content']]=="yes")) {

	if (date("U")+$lfcache_set['time'] >= (file_get_contents("cached/date/".$cachefile.".html"))) {
		$lftheme['content'] = file_get_contents("cached/data/".$cachefile.".html");
		}
	else {
		$lftheme['content'] = lftheme_load($lftheme['default'],$lang,$lfcanuse,$msg,$_oldGET);
//		if ($lfcache[$_GET['content']] == "yes") {
			file_put_contents("cached/data/".$cachefile.".html",$lftheme['content']);
//			file_put_contents("cached/date/".$cachefile.".html",date("U"));
//			};
		}
	}
else	{
	$lftheme['content'] = lftheme_load($lftheme['default'],$lang,$lfcanuse,$msg,$_oldGET);
//	if ($lfcache[$_GET['content']] == "yes") {
		file_put_contents("cached/data/".$cachefile.".html",$lftheme['content']);
//		file_put_contents("cached/date/".$cachefile.".html",date("U"));
//		};
	};
*/
// Creating Databases

if ($lfconf_db['allow']=="yes") {
	$lftheme['content'] = lfdb($lftheme['content']); 
	echo mysql_error($lf_connection);
	};

// site counter
include "system/counter.php";

// Show the site
header('Content-Type: text/html; charset=utf-8');
echo $lftheme['content'];
/*
if ($loadtofile=="yes") {
	$lftheme['content'] = lftheme_load($lftheme['default'],$lang,$lfcanuse,$msg,$_oldGET);
	file_put_contents("cached/data/".$cachefile.".html",$lftheme['content']);
	};
*/
// Shoing errors
//echo mysql_error($lf_connection);
?>