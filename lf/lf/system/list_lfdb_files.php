<?
include "config.php";
	foreach ($lfpart as $part) {
			// List all the files 
			$dir = "parts/".$part."/lfdb";; 
			include $lfpath."system/lf_filelist.php";
			$i1=1;
			while ($lf_file[$i1]<>"") {
				$table_name = str_replace(".php","",$lf_file[$i1]);
				$table_file[$table_name] = "parts/" . $part ."/lfdb/". $lf_file[$i1];
				$table_file[$lfconf_db['prefix'].$table_name] = "parts/" . $part ."/lfdb/". $lf_file[$i1];
				$i1++;	
				};	
		};

?>