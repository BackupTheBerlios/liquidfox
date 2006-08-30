<?php
// ------------- Last news -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "Lnews";
$lfdefault['Lnews_table']	= "games";
$lfdefault['Lnews_query']	= "SELECT * FROM `".$lfconf_db['prefix']."games` ORDER BY `id` DESC LIMIT 0,5";

// ------------- Last news by category -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "latest_category_news";
$lfdefault['latest_category_news_table']	= "games";
$lfdefault['latest_category_news_query']	= "SELECT * FROM `".$lfconf_db['prefix']."games` GROUP BY `category` ORDER BY `category` LIMIT 0,25";


// ------------- News -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "news";
$lfdefault['news_table']	= "games";
$lfdefault['news_query']	= "SELECT * FROM `".$lfconf_db['prefix']."games` WHERE `[1]` LIKE '%[2]%' AND [6] = '[7]'  ORDER BY `[3]` [8] LIMIT [4],[5]";

$lfdefault['news_1_name']		= "where_news";
$lfdefault['news_1_default']	= "category";
$lfdefault['news_1_gets']		= "name,category,id,section";

$lfdefault['news_2_name']		= "like_news";
$lfdefault['news_2_default']	= "%";
$lfdefault['news_2_gets']		= "all";	// allow to get all 

$lfdefault['news_3_name']		= "orderby_news";
$lfdefault['news_3_default']	= "id";
$lfdefault['news_3_gets']		= "id,name,add_date,category";

$lfdefault['news_4_name']		= "start_news";
$lfdefault['news_4_default']	= "0";
$lfdefault['news_4_gets']		= "all";

$lfdefault['news_5_name']		= "loops_news";
$lfdefault['news_5_default']	= "10";
$lfdefault['news_5_gets']		= "all";

$lfdefault['news_6_name']		= "where2_news";
$lfdefault['news_6_default']	= "'1'";
$lfdefault['news_6_gets']		= "id,'1',section";

$lfdefault['news_7_name']		= "equal_news";
$lfdefault['news_7_default']	= "1";
$lfdefault['news_7_gets']		= "all";

$lfdefault['news_8_name']		= "desc_news";
$lfdefault['news_8_default']	= "DESC";
$lfdefault['news_8_gets']		= ",DESC";	// allow to get all 

// ------------- Events -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "events";
$lfdefault['events_table']	= "games";
$lfdefault['events_query']	= "SELECT * FROM `".$lfconf_db['prefix']."games` WHERE `category` = 'אירועים' LIMIT 0,3";

// ------------- Needed -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "needed";
$lfdefault['needed_table']	= "games";
$lfdefault['needed_query']	= "SELECT * FROM `".$lfconf_db['prefix']."games` WHERE `category` = 'דרושים' LIMIT 0,3";



/*
$loopII++;
$lfdefault['loops']		="news";
$lfdefault[$loopII.'_name']	="news";
$lfdefault['table_news']	="games";
$lfdefault['start_news']	="0"	;
$lfdefault['loops_news']	="5"	;
$lfdefault['orderby_news']	="add_date"	;
$lfdefault['where_news']	="id"	;
$lfdefault['desc_news']	="yes"	;
$allowget['where_news']= "yes";
$allowget['like_news']= "yes";

$loopII++;
$lfdefault['loops']		="events";
$lfdefault[$loopII.'_name']	="events";
$lfdefault['table_events']	="games";
$lfdefault['start_events']	="0"	;
$lfdefault['loops_events']	="3"	;
$lfdefault['orderby_events']	="add_date"	;
$lfdefault['where_events']	="category"	;
$lfdefault['like_events']	="אירועים"	;
$lfdefault['desc_events']	="yes"	;

$loopII++;
$lfdefault['loops']		="needed";
$lfdefault[$loopII.'_name']	="needed";
$lfdefault['table_needed']	="games";
$lfdefault['start_needed']	="0"	;
$lfdefault['loops_needed']	="5"	;
$lfdefault['orderby_needed']	="add_date"	;
$lfdefault['where_needed']	="category"	;
$lfdefault['like_needed']	="דרושים"	;
$lfdefault['desc_needed']	="yes"	;

	// Limiting fileds

// This list is a list of fields that visible to any user on site

$lfcanuse['games']['category']	 = "yes" ;
$lfcanuse['games']['name']	 = "yes" ;
$lfcanuse['games']['section']	 = "yes" ;
$lfcanuse['games']['added_by']	 = "yes" ;
$lfcanuse['games']['added_desc'] = "yes" ;
$lfcanuse['games']['free_desc']	 = "yes" ;
$lfcanuse['games']['desc']	 = "yes" ;
$lfcanuse['games']['other_desc'] = "yes" ;
$lfcanuse['games']['pic_loc']	 = "yes" ;
$lfcanuse['games']['sections']	 = "yes" ;
$lfcanuse['games']['add_date']	 = "yes" ;
$lfcanuse['games']['id']	 = "yes" ;
$lfcanuse['games']['home']	 = "yes" ;
$lfcanuse['games']['link_fans']	 = "yes" ;
$lfcanuse['games']['link_pics']	 = "yes" ;
$lfcanuse['games']['link_log']	 = "yes" ;
$lfcanuse['games']['game_grade']= "yes" ;
$lfcanuse['games']['music_grade']= "yes" ;
$lfcanuse['games']['story_grade']= "yes" ;
$lfcanuse['games']['graphics_grade']= "yes" ;

$allowget['orderby_news'] = "yes";
$allowget['start_news'] 	= "yes";
$allowget['where_news'] 	= "yes";
$allowget['equal_news'] 	= "yes";
$allowget['content']	="yes"	;
$allowget['like_news']		="yes";
$allowget['lfupdate_id']="yes";
$allowget['lfupdate']	="yes";
$allowget['id']	="yes";
$allowget['to']	="yes";

$allowget['where_2'] 	= "yes";
$allowget['like_2']		="yes";

// supertags
$st_i++;
$lfsupertag[$st_i]['tag']     = "[countblabla]";
$lfsupertag[$st_i]['take']    = "part"/*  from each row ;
$lfsupertag[$st_i]['do']          = "*";
$lfsupertag[$st_i]['second_do']   = "+";
$lfsupertag[$st_i]['last_do']     = "/";
$lfsupertag[$st_i]['last_num']     = "2";
$lfsupertag[$st_i]['rows']    = "row,row2,row3";*/

?>