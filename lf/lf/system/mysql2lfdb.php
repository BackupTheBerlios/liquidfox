<?
// Check all user vars
include $lfpath."includes/security.php";
include $lfpath."functions/lfdata_connect.php";
include "config.php";
/* To Restore
// Checking if nickname and password are ok according lfadmin
if (($_COOKIE[$lfadmin['nickname']['cookie']]==$lfadmin['nickname']['value']) 
AND ($_COOKIE[$lfadmin['password']['cookie']]==$lfadmin['password']['value'])) {
*/
	// Securing $_GET`s
	foreach($_GET as $varName => $value) { 
			$dv=$value;
			$_GET[$varName] = mysql_escape_string($dv);
			};
	
	// Starting Connection to Database
	$lf_connection=
	lfdata_connect($lfconf_db['host'],$lfconf_db['user'],$lfconf_db['pass'],$lfconf_db['db']);
	
	// Getting the tables list
	$q="SHOW TABLES";
	$table_query=lfquery($q);
	while ($table_result=mysql_fetch_row($table_query)) {
	//	echo $table_result['0'];
		//  Getting the columns list
		$q="SHOW COLUMNS IN ".$table_result['0'];
		$query=lfquery($q);
		
		// Making the lfdb file
		$file  =	"<?\n".
				'$tablename="'.$table_result['0'].'";'."\n".
				'$column=0; // Don\'t touch'."\n\n";
		
		while ($result=mysql_fetch_row($query)) {
			$file .= "\t//".$result['0']."\n\n";
			$file .= '$column++;'."\n";
			$file .= '$db[$column][\'name\']  = "'.$result['0'].'"'.";\n";
			$file .= '$db[$column][\'type\']  = "'.$result['1'].'"'.";\n\n";
			if ($result['5']=="auto_increment") {
				$file .= '$dbid = "'.$result['0'].'";'."\n";
				};
			}
		$file .= "?>";
		
		// Saving file
		file_put_contents("lfdb/".$table_result['0'].".php", $file);
	
		};
/* To Restore
	};
*/
header( "Location: lfeasy.php?msg=mysql2lfdb" );
?>