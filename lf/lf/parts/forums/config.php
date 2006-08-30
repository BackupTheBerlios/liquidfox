<?
if ($_GET['equal_forums']<>"") 	{
	$_GET['equal_messages']	= $_GET['equal_forums'];
	}
else {
	$_GET['equal_messages']	= "0";
	$_GET['equal_forums']	= "0";
	};

// ------------- Main Forums -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "main_forums";
$lfdefault['main_forums_table']	=  $lfconf_db['prefix']."forums";
$lfdefault['main_forums_query']	= "SELECT * FROM `".$lfconf_db['prefix']."forums` WHERE `sub_id` ='[1]' ORDER BY `name`";

$lfdefault['main_forums_1_name']		= "equal_forums";
$lfdefault['main_forums_1_default']		= "0";
$lfdefault['main_forums_1_gets']		= "all";	// allow to get all 


// ------------- Sub Forums -------------
$loopII++;
$lfdefault[$loopII.'_name']	    	= "subforums";
$lfdefault['subforums_table']		= $lfconf_db['prefix']."forums";
$lfdefault['subforums_query']		= "SELECT * FROM `".$lfconf_db['prefix']."forums` WHERE `sub_id` = '[multi]'";
$lfdefault['subforums_multi']		= "id";
//$lfdefault['subforums_multi_query']	= "SELECT `id` FROM `forums` WHERE `sub_id` = '0'";
$lfdefault['subforums_recursive']	= "SELECT * FROM `".$lfconf_db['prefix']."forums` WHERE `sub_id` = '[[id]]'";


// ------------- Forums -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "forums";
$lfdefault['forums_table']	=  $lfconf_db['prefix']."forums";
$lfdefault['forums_query']	= "SELECT * FROM `".$lfconf_db['prefix']."forums` WHERE `sub_id` ='[1]'";

$lfdefault['forums_1_name']		= "equal_forums";
$lfdefault['forums_1_default']	= "0";
$lfdefault['forums_1_gets']		= "all";	// allow to get all 


// ------------- Messages -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "messages";
$lfdefault['messages_table']	=  $lfconf_db['prefix']."messages";
$lfdefault['messages_query']	= "SELECT * FROM `".$lfconf_db['prefix']."messages` WHERE (`forum` = '[1]') ORDER BY `id` DESC";

$lfdefault['messages_1_name']		= "equal_forums";
$lfdefault['messages_1_default']	= "0";
$lfdefault['messages_1_gets']		= "all";	// allow to get all 


// ------------- Last news Comments -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "news_comments";
$lfdefault['news_comments_table']	=  $lfconf_db['prefix']."games";
$lfdefault['news_comments_query']	= "SELECT * FROM `".$lfconf_db['prefix']."games`,`".$lfconf_db['prefix']."comments` WHERE `category` LIKE '%[1]%' AND ".$lfconf_db['prefix']."comments.message = ".$lfconf_db['prefix']."games.id AND `table`='games'  ORDER BY ".$lfconf_db['prefix']."comments.id DESC LIMIT 0,15";

$lfdefault['news_comments_1_name']		= "like_news";
$lfdefault['news_comments_1_default']	= "%";
$lfdefault['news_comments_1_gets']		= "all";	// allow to get all 


// ------------- comments_news -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "comments_news";
$lfdefault['comments_news_table']	=  $lfconf_db['prefix']."comments";
$lfdefault['comments_news_query']	= "SELECT * FROM `".$lfconf_db['prefix']."comments` WHERE `table` = 'games' AND `message` = '[1]'";

$lfdefault['comments_news_1_name']		= "equal_news";
$lfdefault['comments_news_1_default']	= "0";
$lfdefault['comments_news_1_gets']		= "all";

// ------------- comments_gallery -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "comments_products";
$lfdefault['comments_products_table']	=  $lfconf_db['prefix']."comments";
$lfdefault['comments_products_query']	= "SELECT * FROM `".$lfconf_db['prefix']."comments` WHERE `table` = 'products' AND `message` = '[1]'";

$lfdefault['comments_products_1_name']		= "equal_product";
$lfdefault['comments_products_1_default']	= "0";
$lfdefault['comments_products_1_gets']		= "all";
//$lfdefault['comments_news_1_id']		= "message";

// ------------- Comments -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "comments";
$lfdefault['comments_table']	=  $lfconf_db['prefix']."comments";
$lfdefault['comments_query']	= "SELECT * FROM `".$lfconf_db['prefix']."comments` WHERE `message` = '[1]' AND `table`<>'".$lfconf_db['prefix']."games'";

$lfdefault['comments_1_name']		= "mid";
$lfdefault['comments_1_default']	= "0";
$lfdefault['comments_1_gets']		= "all";	// allow to get all 

/*
// ------------- Messages -------------
$loopII++;
$lfdefault[$loopII.'_name']	= "messages";
$lfdefault['messages_table']	=  $lfconf_db['prefix']."messages";
$lfdefault['messages_query']	= "SELECT * FROM `messages` WHERE `id` = '[1]'";

$lfdefault['comments_1_name']		= "equal_forums";
$lfdefault['comments_1_default']	= "0";
$lfdefault['comments_1_gets']		= "all";	// allow to get all 
//$lfdefault['comments_1_id']			= "message";


$loopII++;
$lfdefault[$loopII++.'_name']	="forums";
$lfdefault['table_forums']	="forums";
$lfdefault['start_forums']	="0"	;
$lfdefault['loops_forums']	="10"	;
$lfdefault['orderby_forums']	="name"	;
$lfdefault['where_forums']	="sub_id"	;
$lfdefault['equal_forums']	="0"	;
$lfdefault['desc_forums']	="no"	;

$loopII++;
$lfdefault[$loopII++.'_name']	="messages";
$lfdefault['table_messages']	="messages";
$lfdefault['start_messages']	="0"	;
$lfdefault['loops_messages']	="5"	;
$lfdefault['orderby_messages']	="id"	;
$lfdefault['where_messages']	="forum";
if ($_GET['equal_forums']<>"") 	{$lfdefault['equal_messages']	= $_GET['equal_forums'];}
						else 	{$lfdefault['equal_messages']	= "0";};

$loopII++;
$lfdefault[$loopII++.'_name']	="comments";
$lfdefault['table_comments']	="comments";
$lfdefault['start_comments']	="0"	;
$lfdefault['loops_comments']	="5"	;
$lfdefault['orderby_comments']	="id"	;
$lfdefault['where_comments']	="message";
$lfdefault['equal_comments']	= $_GET['mid'];

$lfdefault['desc_messages']	="yes"	;

$lfcanuse['messages']['date'] = "yes" ;
$lfcanuse['messages']['time'] = "yes" ;
$lfcanuse['messages']['name'] = "yes" ;
$lfcanuse['messages']['message'] = "yes" ;
$lfcanuse['messages']['id'] = "yes" ;
$lfcanuse['messages']['by'] = "yes" ;

$lfcanuse['comments']['date'] = "yes" ;
$lfcanuse['comments']['time'] = "yes" ;
$lfcanuse['comments']['name'] = "yes" ;
$lfcanuse['comments']['comment'] = "yes" ;
$lfcanuse['comments']['forum'] = "yes" ;
$lfcanuse['comments']['id'] = "yes" ;
$lfcanuse['comments']['by'] = "yes" ;

$lfcanuse['forums']['image'] = "yes" ;
$lfcanuse['forums']['name']	 = "yes" ;
$lfcanuse['forums']['desc']	 = "yes" ;
$lfcanuse['forums']['id']	 = "yes" ;

$allowget['equal_forums']="yes";
$allowget['mid']="yes";
*/
?>