<?
// _SELECTB_
//	$colquery=mysql_query("SELECT category FROM `games` GROUP BY category");	
	$tagquery="";
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE ";
	$tagquery['4']=" = '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['end']=" LIMIT 1";
	$tagquery['tag']="~SELECTB~";
	$tagquery['num']="5";
	include $lfpath."system/multiple_tags.php";

// _COUNT_
	$tagquery="";
	$tagquery['1']="SELECT COUNT(*) FROM `".$lfconf_db['prefix'];
	$tagquery['end']="`";
	$tagquery['tag']="~COUNT~";
	$tagquery['num']="1";
	include $lfpath."system/multiple_tags.php";
//	$tagged = show_tag ($lftheme,  "~COUNTI~","1", $tagquery, "theme");

// _CONTW_
	$tagquery="";	
	$tagquery['1']="SELECT COUNT(*) FROM ".$lfconf_db['prefix'];
	$tagquery['2']=" WHERE `";
	$tagquery['3']="` LIKE '";
	$tagquery['end']="' LIMIT 1";
	$tagquery['tag']="~COUNTW~";
	$tagquery['num']="3";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _CONTW2_
	$tagquery="";	
	$tagquery['1']="SELECT COUNT(";
	$tagquery['2']=") FROM ".$lfconf_db['prefix'];
	$tagquery['3']=" WHERE ";
	$tagquery['end']=" LIMIT 1";
	$tagquery['tag']="~COUNTW2~";
	$tagquery['num']="3";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _CONTW3_
	$tagquery="";	
	$tagquery['1']="SELECT COUNT(*) FROM `" . $lfconf_db['prefix'];
	$tagquery['2']="` WHERE `";
	$tagquery['3']="` = '";
	$tagquery['4']="' AND `";
	$tagquery['5']="` = '";
	$tagquery['end']="' LIMIT 1";
	$tagquery['tag']="~COUNTW3~";
	$tagquery['num']="5";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _SHOWAFTER_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` > '";
	$tagquery['5']="' GROUP BY '";
	$tagquery['end']="' LIMIT 0,1";
 	$tagquery['tag']="~SHOWAFTER~";
	$tagquery['num']="5";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _SHOWPRE_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` < '";
	$tagquery['5']="' GROUP BY '";
	$tagquery['end']="' LIMIT 0,1 DESC";
 	$tagquery['tag']="~SHOWPRE~";
	$tagquery['num']="5";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _CONTWN_
	$tagquery="";	
	$tagquery['1']="SELECT COUNT(*) FROM ".$lfconf_db['prefix'];
	$tagquery['2']=" WHERE `";
	$tagquery['3']="` <> '";
	$tagquery['end']="' LIMIT 1";
	$tagquery['tag']="~COUNTWN~";
	$tagquery['num']="3";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _CONTWG_
	$tagquery="";	
	$tagquery['1']="SELECT COUNT(*) FROM ".$lfconf_db['prefix'];
	$tagquery['2']=" WHERE ";
	$tagquery['3']=" LIKE '";
	$tagquery['4']="' GROUP BY '";
	$tagquery['end']="' LIMIT 1";
	$tagquery['tag']="~COUNTWG~";
	$tagquery['num']="4";
	include $lfpath."system/multiple_tags.php";

// COUNTGET - counting the loop query
	$tagquery="";	
	$tagquery['1']="SELECT COUNT(*) FROM `".$lfconf_db['prefix'];
	$tagquery['end']="`".$q_middle;
	$tagquery['tag']="~COUNTGET~";
	$tagquery['num']="1";
	include $lfpath."system/multiple_tags.php";

// _SHOWFIRST_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` ORDER BY ";
	$tagquery['end']=" LIMIT 1";
	$tagquery['tag']="~SHOWFIRST~";
	$tagquery['num']="3";
	include $lfpath."system/multiple_tags.php";

// _SHOWLAST_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` ORDER BY ";
	$tagquery['end']=" DESC LIMIT 1";
	$tagquery['tag']="~SHOWLAST~";
	$tagquery['num']="3";
	include $lfpath."system/multiple_tags.php";

// _DoubleSHOWLAST_ - show last object from 2 tables
	$tagquery="";	
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM `".$lfconf_db['prefix'];
	$tagquery['3']="`,`";
	$tagquery['4']="` WHERE ";
	$tagquery['5']=" = ";
	$tagquery['6']=" AND `";
	$tagquery['7']="` = '";
	$tagquery['8']="' ORDER BY ";
	$tagquery['end']=" DESC LIMIT 1";
	$tagquery['tag']="~DSHOWLAST~";
	$tagquery['num']="8";
	include $lfpath."system/multiple_tags.php";

//SELECT category FROM `games` WHERE 1  GROUP BY category
// _LIST_ALL_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` GROUP BY ";
	$tagquery['end']="";
	$tagquery['tag']="~LIST_ALL~";
	$tagquery['num']="3";
	include $lfpath."system/multiple_tags.php";



// _SELECTCOL_
	$lftheme['content']=str_replace("<!-- lftag -->" , "" , $lftheme['content']);
	$lftheme['content']=str_replace("<!-- /lftag -->" , "" , $lftheme['content']);
//	$colquery=mysql_query("SELECT category FROM `games` GROUP BY category");	
	$tagquery="";
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE ";
	$tagquery['4']=" LIKE '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['end']="";
	$tagquery['tag']="~SELECTCOL~";
	$tagquery['num']="3";
	include $lfpath."system/multiple_tags.php";

	$lftheme['content']=str_replace("<!-- lftag -->" , "<option>" , $lftheme['content']);
	$lftheme['content']=str_replace("<!-- /lftag -->" , "</option>" , $lftheme['content']);

	
// _SELECT_
//	$colquery=mysql_query("SELECT category FROM `games` GROUP BY category");	
	$tagquery="";
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE ";
	$tagquery['4']=" = '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['end']=" LIMIT 1";
	$tagquery['tag']="~SELECT~";
	$tagquery['num']="5";
	include $lfpath."system/multiple_tags.php";
//	$lftheme = show_tag ($lftheme,  $tagquery['tag'],$tagquery['num'], $tagquery,"theme");

// _LIKE_
//	$colquery=mysql_query("SELECT category FROM `games` GROUP BY category");	
	$tagquery="";
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE ";
	$tagquery['4']=" LIKE '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['end']=" LIMIT 1";
	$tagquery['tag']="~LIKE~";
	$tagquery['num']="5";
	include $lfpath."system/multiple_tags.php";

// _FREESELECT_
//	$colquery=mysql_query("SELECT category FROM `games` GROUP BY category");	
	$tagquery="";
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM ".$lfconf_db['prefix'];
	$tagquery['3']=" WHERE ";
	$tagquery['4']=" = '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['end']=" LIMIT 1";
	$tagquery['tag']="~FREESELECT~";
	$tagquery['num']="5";
	include $lfpath."system/multiple_tags.php";

//_LINKCOL_
	$tagquery="";
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` LIKE '";
	$tagquery['5']="' GROUP BY '";
	$tagquery['6']="' ORDER BY '";
	$tagquery['end']="'";
	$tagquery['tag']="~LINKCOL~";
	$tagquery['num']="6";
	$check_split = "";
	include $lfpath."system/linkcol_tag.php";

//_LINKCOL2_
	$tagquery="";
	$tagquery['1']="SELECT ";
	$tagquery['2']=" FROM `".$lfconf_db['prefix'];
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` LIKE '";
	$tagquery['5']="' AND `";
	$tagquery['6']="` LIKE '";
	$tagquery['7']="' GROUP BY '";
	$tagquery['8']="' ORDER BY '";
	$tagquery['end']="'";
	$tagquery['tag']="~LINKCOL2~";
	$tagquery['num']="8";
	$check_split = "";
	include $lfpath."system/linkcol_tag.php";

//_PLACE_
	$tagquery="";
	$tagquery['1']="SELECT COUNT(*) FROM `".$lfconf_db['prefix'];
	$tagquery['2']="` WHERE `";
	$tagquery['3']="` < '";
	$tagquery['4']="' AND `";
	$tagquery['5']="` = '";
	$tagquery['end']="'";
	$tagquery['tag']="~PLACE~";
	$tagquery['num']="5";
	$check_split = "";
	include $lfpath."system/multiple_tags.php";
 
// Doublecount
	$tagquery="";
	$tagquery['1']="SELECT COUNT(*) FROM `".$lfconf_db['prefix']; //table
	$tagquery['2']="`,`".$lfconf_db['prefix'];// second table
	$tagquery['3']="` WHERE ".$lfconf_db['prefix']; //column 1
	$tagquery['4']=" = ";		//column 2
	$tagquery['5']=" AND `";	//column 3
	$tagquery['6']="` = '";		//value 3
	$tagquery['end']="'";
	$tagquery['tag']="~DCOUNT~";
	$tagquery['num']="6";
	$check_split = "";
	include $lfpath."system/multiple_tags.php";

// Cleaning the loop tags
	$lftheme['content']=str_replace("_START_LOOP_","",$lftheme['content']);
	$lftheme['content']=str_replace("_END_LOOP_","",$lftheme['content']);

// _SHOWPRE_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `";
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` < '";
	$tagquery['5']="' GROUP BY '";
	$tagquery['end']="' DESC LIMIT 0,1";
 	$tagquery['tag']="~SHOWPRE~";
	$tagquery['num']="5";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _SHOWAFTER_
	$lftheme['content']=str_replace('<!-- lftag -->','',$lftheme['content']);
	$lftheme['content']=str_replace('<!-- /lftag -->','',$lftheme['content']);
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `";
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` >= '";
	$tagquery['5']="' GROUP BY '";
	$tagquery['end']="' LIMIT 1,1";
 	$tagquery['tag']="~SHOWAFTER~";
	$tagquery['num']="5";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

//echo $lftheme['content'];exit;

// _SHOWAFTER2_
	$lftheme['content']=str_replace('<!-- lftag -->','',$lftheme['content']);
	$lftheme['content']=str_replace('<!-- /lftag -->','',$lftheme['content']);
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `";
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` >= '";
	$tagquery['5']="' AND `";
	$tagquery['6']="` = '";
	$tagquery['7']="' GROUP BY '";
	$tagquery['end']="' LIMIT 1,1";
 	$tagquery['tag']="~SHOWAFTER2~";
	$tagquery['num']="7";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _SHOWPRE2_
	$lftheme['content']=str_replace('<!-- lftag -->','',$lftheme['content']);
	$lftheme['content']=str_replace('<!-- /lftag -->','',$lftheme['content']);
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `";
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` <= '";
	$tagquery['5']="' AND `";
	$tagquery['6']="` = '";
	$tagquery['7']="' GROUP BY '";
	$tagquery['end']="' LIMIT 1,1";
 	$tagquery['tag']="~SHOWPRE2~";
	$tagquery['num']="7";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _SHOWAFTER3_
	$lftheme['content']=str_replace('<!-- lftag -->','',$lftheme['content']);
	$lftheme['content']=str_replace('<!-- /lftag -->','',$lftheme['content']);
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `";
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` >= '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['6']=" ORDER BY ";
	$tagquery['end']=" LIMIT 1,1";
 	$tagquery['tag']="~SHOWAFTER3~";
	$tagquery['num']="6";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

// _SHOWPRE3_
	$tagquery="";	
	$tagquery['1']="SELECT `";
	$tagquery['2']="` FROM `";
	$tagquery['3']="` WHERE `";
	$tagquery['4']="` <= '";
	$tagquery['5']="' GROUP BY ";
	$tagquery['6']=" ORDER BY ";
	$tagquery['end']=" DESC LIMIT 1,1";
 	$tagquery['tag']="~SHOWPRE3~";
	$tagquery['num']="6";
	$tagquery['else']="0";
	include $lfpath."system/multiple_tags.php";

?>