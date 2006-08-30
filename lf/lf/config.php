<?
// For elijah
	$_GET['loops_products']=5;
if ($_GET['like_products']=="") {
	$_GET['like_products']="Please select one of the albums above";
	}

// #####################
// # Database Settings #
// #####################

$lfconf_db['host'] 	= "localhost"	;
$lfconf_db['user'] 	= "root"	;
$lfconf_db['pass'] 	= "mooiamacow"	;
$lfconf_db['db']   	= "nb1"	;
$lfconf_db['update']	= "yes"		;
$lfconf_db['allow']	= "no"		;
$lfconf_db['encoding']  = "utf8"	;
$lfconf_db['prefix'] = "lf_";

//$allowget['debug']="yes";


// #################
// # lfadmin setup #
// #################

$lfadmin['user']['cookie'] = "user"	;  // what cookie contain the nickname
$lfadmin['user']['value']  = "nadav"	;
$lfadmin['password']['cookie'] = "password"	;
$lfadmin['password']['value']  = md5("admpasswd");

// #################
// # LFDB Settings #
// #################
//  _-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
// |                                                                 ||
// | Be carefull changing those values to "yes", a data may be lost! ||
// |_________________________________________________________________|

$lfconf_db['create_tables']      = "yes"	;
$lfconf_db['delete_tables']      = "no"	;
$lfconf_db['update_tables']      = "yes"	;
$lfconf_db['create_culomns']     = "yes"	;
$lfconf_db['delete_culomns']     = "no"	;
$lfconf_db['update_culomns']     = "yes"	;

// ######################   #      #                    #
// # Default site theme # #    # #   #   #  #  # # # #     #
// ######################    #     #                     #

//$lftheme['default']	= "netbook"	; // must be a name of directory under themes
$lftheme['default']		= "linuxfun";
$lftheme['lang']		= "hebrew"	;// laungage of the site
//$lftheme['css_file']	= "design/amit/css.css"   ;
//$lfdefault['content']	="lfbb_main"	;
$lfdefault['content']	= "news";

//  _-_-_-_-_-_-_-_-.
// |               ||
// | Cach Settings ||
// |_______________|

$lfcache="no"; // caching only full pages
$loopcache="no"; // caching loops
$querycache="no";
//loop-cache config
$loopcache_cookies="nickname";

?>