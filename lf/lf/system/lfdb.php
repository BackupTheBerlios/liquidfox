<?
function lfdb($theme) {
include "config.php";
include "lfparts.php";
foreach ($lfpart as $part) {
	// List all the files 
	$dir = "parts/".$part."/lfdb";; 
	include $lfpath."system/lf_filelist.php";
	
	// Restarting Varibles
	$i1="1";
	
	while ($lf_file[$i1]<>"") {
		$i4=$i3=$i2="1";
		$db="";
		$tablename="";
		include $lfpath."parts/".$part."/lfdb/".$lf_file[$i1];
	
		// Changing table name if needed ($tablename taken from the lfdb file)
		if ($lfconf_db['change_tables']=="yes") {
			if (($tablename<>str_replace(".php","",$lf_file[$i1])) AND ($tablename<>"" )) {
				lfquery("RENAME TABLE `".str_replace(".php","",$lf_file[$i1])."` TO `".$tablename."`");
				rename( "parts/".$part."/lfdb/".$lf_file[$i1] , "parts/".$part."/lfdb/".$tablename.".php");
			}
				else {
				$tablename = str_replace(".php","",$lf_file[$i1]);
				};
		};
	
		$db['0']['name'] = $dbid;
	
			// Creating table
		if ($lfconf_db['create_tables']=="yes") {
			$q="CREATE TABLE IF NOT EXISTS `".$tablename."` (\n"."
			`".$dbid."` int (11) NOT NULL auto_increment ,\n
			PRIMARY KEY (`".$dbid."`) ) \n
			TYPE=MyISAM AUTO_INCREMENT=1 ;\n\n";
			$db["0"]['name']  = $dbid; // needed For Adding first table
			lfquery($q);
		};
	
		if ($lfconf_db['update_culmus']=="yes") {
	
			// Renaming id if needed
			
			$query=lfquery("SHOW COLUMNS IN `".$tablename."`");
			$row=mysql_fetch_array($query); 
		
			if ($row["Field"]<>$dbid) {
				$q="ALTER TABLE ".$tablename." CHANGE ".$row["Field"]." ".$dbid ." ".$row['Type'];
				lfquery($q);
				};
		
			// Deleting Columns that not in the config file
			$i4="1";
			$query=lfquery("SHOW COLUMNS IN `".$tablename."`");
			$row=mysql_fetch_array($query); // Skipping the id line
			while ($row=mysql_fetch_array($query)) {
				if (empty($db[$i4]['name'])) {
					$q="ALTER TABLE `".$tablename."`  DROP `". $row["Field"] . "`" ;
					lfquery($q);
					};
				$i4++;
				};
		
				// Updating Columns
			$i4="1";
			$query=lfquery("SHOW COLUMNS IN `".$tablename."`");
			$row=mysql_fetch_array($query); // Skipping the id line
		
			while ($row=mysql_fetch_array($query)) {
					// Updating db info
				if (($db[$i4]['name']<>$row["Field"]) OR ($db[$i4]['type'] <>$row["Type"] )) {
					$q="ALTER TABLE ".$tablename." CHANGE ".$row["Field"]." ".$db[$i4]['name']." ".$db[$i4]['type'];
					lfquery($q);
					};
				$i4++;
				};
		};
		
			// Creating Columns
		if ($lfconf_db['create_culomns']=="yes") {
			while ($db[$i2]["name"]<>"") {
				$query=lfquery("desc `".$tablename."` `".$db[$i2]["name"]."`");
				if (mysql_fetch_array($query)=="") {
					$q = "ALTER TABLE `".$tablename."` ADD `".$db[$i2]["name"]."` ".$db[$i2]["type"]/*." DEFAULT '".$db[$i2]["default"]*/." NOT NULL AFTER `".$db[$i2-1]["name"]."` ;
;\n";
					$q = str_replace("default 'auto_increment'","auto_increment",$q);
					$q = str_replace("DEFAULT ''","",$q);
					lfquery($q);
//echo "<div dir=ltr>".$q."</div>";
					}
				$i2++;
				};
		};
			// Checking for non-existent tables (for deleting non existing tables later)
		if ($lfconf_db['delete_tables']=="yes") {
			$q="SHOW TABLES";
			$query=lfquery($q);
			while ($row=mysql_fetch_array($query)) {
				if ($row['0'] == $tablename) {
					$table_exists[$tablename]="yes";};
			/*echo $row['0']."<br>";*/};
			}
			// Checking for actions
		$db_action['1']['action']="";
		$i1++; // Going to the next file
		};
	
	
	// Deleting non exists tables
	if ($lfconf_db['delete_tables']=="yes") {
		$q="SHOW TABLES";
		$query=lfquery($q);
		while ($row=mysql_fetch_array($query)) {
			if ($table_exists[$row['0']] <> "yes") {
				$q="DROP TABLE `".$row['0']."`";
				lfquery($q);
				};};
		};
	};
// Finishing lfdb
return $theme;
};

?>