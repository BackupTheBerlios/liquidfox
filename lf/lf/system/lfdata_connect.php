<?
if (empty($lf_used['lfdata_connect'])) {
    $lf_used['lfdata_connect']= "yes";

function lfdata_connect($data_host,$data_user,$data_pass,$db)	{
   /* starts or stops database connection */
		if ($mysql_link=mysql_connect($data_host,$data_user,$data_pass)){
		lfquery("use `".$db."`");

			if (mysql_error($mysql_link)=="Unknown database '".$db."'") {
				lfquery("CREATE DATABASE ".$db);
				lfquery("use `".$db."`");
				};
			}
			else {$lferror="Can not connect to database";};

		if ((!(mysql_error($mysql_link)=="")) 
		AND (mysql_error($mysql_link)<>"Unknown database '".$db."'")) {
			echo "lfdata_connect.php,"._LINE.": ".mysql_error($mysql_link); };
		include "config.php";
		lfquery("SET NAMES '".$lfconf_db['encoding']."'", $mysql_link);
		return $mysql_link;};

}; // End "if ($lf_used['lfdata_connect']<>"yes";)"
?>