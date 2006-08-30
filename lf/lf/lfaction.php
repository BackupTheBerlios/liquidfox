<?
	if ((substr(phpversion(),0,1))=="4") {
		include "system/file_put_contents.php"; // For php version 4
		};

// for a jump link
if ($_GET['lfaction']=="jump") {
	// loading link
	header('Location: '.$_GET['to']);
	}

// Change name of action if needed
if ($_POST['lfaction_add']<>"") {
	$_POST['lfaction'] = $_POST['lfaction']."_".$_POST['lfaction_add'];
	};

// Set yes if you want it to load the page after done...
$setheader = "yes" ;
// Checking if action is delete all cookies
if ($_GET['action']=="delcookies") {
	// deleting cookies
	foreach($_COOKIE as $cookie_name => $cookie_value) {
//		echo $cookie_name."<br />";
		setcookie($cookie_name ,"");
		$_COOKIE[$cookie_name]="";
		};

	// loading index.php
	header('Location: index.php');
	};

if ($_GET['action']=="setcookie") {
	setcookie($_GET['cookie'],$_GET['value']);

	// loading index.php
	header('Location: index.php');
	}

// for firefox
//	print_r($_FILES);exit;

$lfaction['includes']="yes";
include $lfpath."system/lfaction_security.php";
include "config.php";
include "system/lfparts.php";
include $lfpath."system/lfdata_connect.php";
include $lfpath."system/show_tag.php";
include $lfpath."system/lfquery.php";      // caching querys
include $lfpath."system/list_lfdb_files.php";

if ($_GET['lfaction']<>"") {
	$_POST['lfaction']=$_GET['lfaction'];
	};
/*
foreach ($lfpart as $varName => $value) {
	$fileName="parts/".$value."/actions/".$_POST['lfaction'].".php";
	if (file_exists($fileName)) {
		include $fileName;
		}
	};
*/
$splt_actionfile=split("\|",$_POST['lfaction']);
include "parts/".$splt_actionfile['0']."/actions/".$splt_actionfile['1'].".php";

if ((($lfaction_set['action']=="add") OR ($lfaction_set['action']=="update") OR ($lfaction_set['action']=="del")) AND ($msg=="")) {
    $dir= "cached/data/";
    include "system/lf_filelist.php";
	if ($lf_file<>"") {
		foreach($lf_file as $Fname => $Fvalue) {
			unlink("cached/data/".$Fvalue);
			};
		};

	$dir= "cached/temp/";
    include "system/lf_filelist.php";
	if ($lf_file<>"") {
		foreach($lf_file as $Fname => $Fvalue) {
			unlink("cached/temp/".$Fvalue);
			};
		};

    $dir= "cached/queries/";
    include "system/lf_filelist.php";
	if ($lf_file<>"") {
		foreach($lf_file as $Fname => $Fvalue) {
			$table_check = split("_",$Fvalue);
			if ( $table_check['0'] == $lfaction_set['table']) {
				unlink("cached/queries/".$Fvalue);
				};
			};
		};

    $dir= "cached/queries/";
    include "system/lf_filelist.php";
	if ($lf_file<>"") {
		foreach($lf_file as $Fname => $Fvalue) {
			$table_check = split("_",$Fvalue);
			if ( $table_check['0'] == $lfaction_set['table']) {
				unlink("cached/queries/".$Fvalue);
				};
			};
		};
    };

// Making multifield if needed
if ($lfaction_set['GET']=="yes") {
	$_POST=$_GET;
	};

	// Making multifield if needed
if ($lfaction_set['multifield']<>"") {
	$splitted_multifield=split($lfaction_set['multifield_char'],$_POST[$lfaction_set['multifield']]);
	foreach ($splitted_multifield as $splt_value) {
		$Isplt++;
		$lfaction_multi[$lfaction_set['multifield']]="yes"; //enablingsss
		$_POST[$lfaction_set['multifield']."_".$Isplt]=$splt_value;
		foreach ($lfaction_type as $typename => $typevalue) {
			if ($typename<>$lfaction_set['multifield']) {
				$lfaction_multi[$typename]="yes"; //enabling
				$_POST[$typename."_".$Isplt]=$_POST[$typename];
				
				};
			};
		};
	foreach ($lfaction_type as $typename => $typevalue) {	
		unset($_POST[$typename]);
		};
	};

function checkvar ($varName,$lfaction_type,$lfaction_reg,$lfaction_mt,$msg,$_POST,$lfaction_set) {
	
	// allow empty passwords on update mode
	if ($_POST['lfupdate']=="yes") {
		
		if ($lfaction_set['allow_update']   == "yes") {
			if ($lfaction_type[$varName]=="md5") {
				$lfaction_mt[$varName]="yes";
				};
			};
		};
	
	if (($lfaction_type[$varName]=="text") OR ($lfaction_type[$varName]=="mail") OR ($lfaction_type[$varName]=="md5") OR (($lfaction_type[$varName]=="other") AND ($_POST[$varName]<>"") )) {

	// Check regex for vars
	if ($lfaction_reg[$varName]<>"") {
//debug			echo $lfaction_reg[$varName].",".$_POST[$varName]."<br>";
		if(!preg_match($lfaction_reg[$varName],$_POST[$varName])) {
			if ($lfaction_mt[$varName]=="yes") {
				if ($_POST[$varName]<>"") {
					$msg = "[problem in field] '[".$varName."]'<br>";
					$msg .= "[error_".$lfaction_reg[$varName]."]";
					};
				}
			else {
				$msg = "[problem in field] '[".$varName."]'<br>";
				$msg .= "[error_".$lfaction_reg[$varName]."]";
				};
			};
		return $msg;
		};

	if ($lfaction_reg_not[$varName]<>"") {
		if($lfaction_reg_not[$varName]==$_POST[$varName]) {
			$msg = "[problem in field] '[".$varName."]'<br>";
			$msg .= "[error_".$lfaction_reg_not[$varName]."]";
			};
		};
		};
	};

function add ($lfaction_set,$_POST,$lfaction_static,$table_file,$lfaction_type,$lfaction_get,$lfaction_file) {
		// adding the "push" option
	if (($lfaction_set['action']=="add") AND ($lfaction_set['push']['field']<>"")) {
		mysql_query("UPDATE `book` SET `" . $lfaction_set['push']['field']."`=`" . $lfaction_set['push']['field'] . "`+" . $lfaction_set['push']['value']." WHERE `place`>=". $_POST[$lfaction_set['push']['field']] . ";");
			};

	$sql_query="INSERT INTO " . $lfaction_set['table'] . "(";
	
		// The begining of the query
	$q="SHOW COLUMNS IN ".$lfaction_set['table'];
	$query=lfquery($q);
	while ($result=mysql_fetch_row($query)) {
		$sql_query .= "`".$result['0']."`, ";
		}

		// The values of the quiery
	$sql_query .= ") VALUES (";
			
	$q="SHOW COLUMNS IN ".$lfaction_set['table'];
	$query=lfquery($q);

	include $table_file[$lfaction_set['table']]; // From "system/list_lfdb_files.php"

	while ($result=mysql_fetch_row($query)) {

		if ($dbid<>$lfaction_set['table']) { // not including ID
			// Check if it is a normal text
//		echo $lfaction_type[$result['0']]."<br>";
			if (($lfaction_type[$result['0']]=="text") OR ($lfaction_type[$result['0']]=="mail")) {
				
				if ($lfaction_static[$result['0']]=="") {
					$sql_query .= "'".$_POST[$result['0']]."', ";
					};
				}
			// Check if it is a uploaded file
			elseif ($lfaction_type[$result['0']]=="file") {
				if ($lfaction_static[$result['0']]=="") {
					if ($_FILES[$result['0']]['name']<>"") {
						$sql_query .= "'".$lfaction_file[$result['0']]['upload_loc']."/".$_FILES[$result['0']]['name']."', ";
						}
					else {
						$sql_query .= "'', ";
						};
					};
				}
			elseif ($lfaction_type[$result['0']]=="md5") {
				if ($lfaction_static[$result['0']]=="") {
					$sql_query .= "'".md5($_POST[$result['0']])."', ";
					};
				}
			elseif ($lfaction_type[$result['0']]=="get") {
				
				$q55 = "SELECT " . $lfaction_get[$result['0']]['get'] . " FROM " . $lfaction_get[$result['0']]['table'] . " WHERE " . $lfaction_get[$result['0']]['where'] . " = '" . $lfaction_get[$result['0']]['with'] . "'";
				
				$query55 = lfquery ($q55);

				$get_result = mysql_fetch_row($query55);
				if ($lfaction_static[$result['0']]=="") {
					$sql_query .= "'".$get_result['0']."', ";
					};
				}

			// else inserting a blank value
			else {
				if ($lfaction_static[$result['0']]=="") {
					$sql_query .= "'', ";
					};
				};

			// check if it is a static value
			if ($lfaction_static[$result['0']]<>"") {
				$sql_query .= "'".$lfaction_static[$result['0']]."', ";
				};
			}
		}
	
		// The end of the query
	$sql_query .= ")      ";
	$sql_query = str_replace(", )", ")", $sql_query);
	if ($_POST['lfupdate']=="yes") {
		if ($lfaction_set['allow_update']   == "yes") {
			$sql_query_willbe = "UPDATE ".$lfaction_set['table']." SET ";
			$cutted_qery	      = split("\(",$sql_query); // splitting into 2 rows
			$cutted_qery_2_1= split("`",$cutted_qery['1']); // spliting row 1 - for fields
			$cutted_qery_2_2= split("'",$cutted_qery['2']); // spliting row 1 - for values
			$update_fileds=split(",",$lfaction_set['update_fields']);
//			print_r($cutted_qery_2_1);echo "<br><br>";
//			print_r($cutted_qery_2_1);echo "<br><br>";exit;
			// Making a list of allowed fields
			foreach ($update_fileds as $fieldvalue) {
				$allow_update[$fieldvalue]="yes";
				$allow_update[" ".$fieldvalue]="yes";
				};
			$cutName=1;
			while ($cutted_qery_2_1[$cutName]<>"") {
				//caching allowed fields
				$cutValue= str_replace(") VALUES ","",$cutValue); // cleaning broken end
				$cutted_qery_2_2[$cutName]= str_replace("')","'",$cutted_qery_2_2[$cutName]); // cleaning broken end
//				echo $cutValue.":".$cutted_qery_2_2[$cutName]."<br>";
//				print_r($allow_update);
				if ($allow_update[$cutted_qery_2_1[$cutName]]=="yes") { // If update is allowed

					if ($cutted_qery_2_1[$cutName]<>$dbid) {
							// Checking if not empty
						if (($cutted_qery_2_2[$cutName]<>"") AND ($cutted_qery_2_2[$cutName]<>" ''")){
							$sql_query_willbe.=" `". $cutted_qery_2_1[$cutName]. "` = '" . $cutted_qery_2_2[$cutName]."' , ";
							};
						};
					};
				$cutName=$cutName+2;
				};
			};

		//cleaning end and adding key and fit in query
		
		$sql_query_willbe.="___";
		$sql_query_willbe = str_replace(") VALUES","",$sql_query_willbe);
		$sql_query=str_replace(", ___"," WHERE `".$dbid."` = '".$_POST['lfupdate_id']."'",$sql_query_willbe);
		};/*
	$sql_query = str_replace("||_-","(",$sql_query);
	$sql_query = str_replace("-_||",")",$sql_query);*/
	// Make a fix for multiple
//	$sql_query=str_replace(";\\')",";')",$sql_query);
//	$sql_query=str_replace(":\\')",":')",$sql_query);
	$sql_query=str_replace("\')     ","')",$sql_query);
	return ($sql_query);
	};

// Connetcting to database
$lf_connection=
lfdata_connect($lfconf_db['host'],$lfconf_db['user'],$lfconf_db['pass'],$lfconf_db['db']);

// Check var type
	//(lfaction type is taken from the actions/actionfile.php
$delete_file="";
$multi_count="1";
if (($lfaction_set['action']=="add") OR ($lfaction_set['action']=="check")) {

	// checking if it is in the allowed updates
	if ($lfaction_set['allow_update']   == "yes") {
		if ($_POST['lfupdate']=="yes") {
			$fields = split(",",$lfaction_set['update_fields']);
			foreach ($lfaction_type as $action_name => $action_value) {
				$change_it = "yes";
				foreach ($fields as $field) {
					if ($field==$action_name) {
						$change_it = "no";
						};
					};
				if ($change_it=="yes") { // disabling field
					$dont_check[$action_name]="yes";
					};
				};
			};
		};


		foreach($lfaction_type as $varName => $value) {
			if  ($dont_check[$varName]<>"yes") {
				// Checking for 'other' fields
				if ($lfaction_type[$varName]=="other") {
					if ($_POST[$varName]<>"") {
						$_POST[$lfaction_linked[$varName]]=$_POST[$varName];
						};
					};
			
			// Processing the text types
			mb_internal_encoding('UTF-8'); // making it utf8 comptible
			mb_regex_encoding('UTF-8');    // making it utf8 comptible
			if ($lfaction_multi[$varName]=="yes") {
//				$multi_count="1";
				while ($_POST[$varName."_".$multi_count]<>"") {
					if ($_POST[$varName."_".$multi_count]<>"") {
						$_POST[$varName]=$_POST[$varName."_".$multi_count];
						};
					if ($msg=="") {
						$msg=checkvar ($varName,$lfaction_type,$lfaction_reg,$lfaction_mt,$msg,$_POST,$lfaction_set);
						// Check mail var
						if ($lfaction_type[$varName]=="mail") {
							$email=$lfaction_mail[$varName];
							};
						};
					$multi_count++;
					};
				}
			else {
				if ($msg=="") {
					$msg=checkvar ($varName,$lfaction_type,$lfaction_reg,$lfaction_mt,$msg,$_POST,$lfaction_set);
					if ($lfaction_type[$varName]=="mail") {
						$email=$lfaction_mail[$varName];
						};
					};
				};
		
			//if ($lfaction_multi[$varName]
			if ($_POST['lfupdate']=="yes") {					// 
				if ($lfaction_set['allow_update']   == "yes") { 		// If in update mode	
					include $table_file[$lfaction_set['table']];		// include table file
						}
				};
	
				// Check mail var
			if ($lfaction_type[$varName]=="mail") {
				$email=$lfaction_mail[$varName];
				};
			// Check files update mode addon
			
			if ($lfaction_type[$varName]=="file") {						// If 		it is a file			
				if ($_FILES[$varName]['name']=="") { 					// and 	If not recived any file
					if ($_POST['lfupdate']=="yes") {					// 
						if ($lfaction_set['allow_update']   == "yes") { 		// and 	If in update mode
								$lfaction_type[$varName]="nothing";	// then 	Ignore empty file
								};
							};
					}
				else {												// if there is a new image
						if ($_POST['lfupdate']=="yes") {					// 
							if ($lfaction_set['allow_update']   == "yes") { 		// and 	If in update mode
								$image_q="SELECT ".$varName. " FROM ". $lfaction_set['table']. " WHERE `".$dbid. "` = '".$_POST['lfupdate_id']."'";
								$image_query=lfquery($image_q);
								$image_result=mysql_fetch_row($image_query);
								$delete_file=$image_result['0'];				// Then delete old image
								};
							};
						};
				};
	
			// Check files
			if ($lfaction_type[$varName]=="file") {	
				// Check if empty 
				if ($lfaction_file[$varName]['allow_empty']=="no") {
		//debug			print_r($_FILES);
					if ($_FILES[$varName]['name']=="") {
						if ($lfaction_mt[$varName]<>"yes") {
							$msg = "[problem in field] '[".$varName."]'<br>";
							$msg .= "[file_is_missing]";
							};
						}
					else {
						// Checking the file type
						$file_types=split(',',$lfaction_file[$varName]['types']);
						foreach ($file_types as $file_type) {
							if ($_FILES[$varName]['type'] == $file_type) {
								$file_type_ok="yes";
								};
							};
						if ($file_type_ok=="yes") {
							}
						else {
							$msg  = "[problem in field] '[".$varName."]'<br>";
							$msg .= "[error_".$lfaction_file[$varName]['types']."]";			
							};
		
						// Checking the size
						if ($_FILES[$varName]['size'] > $lfaction_file[$varName]['max_size']) {
							$msg  = "[problem in field] '[".$varName."]'<br>";
							$msg .= "[error_size_".$lfaction_file[$varName]['max_size']."]";					
							}; 
		
						};
	
					};
	
				// Adding id if needed
				if (($lfaction_file[$varName]['add_table_id'] == "yes") AND ($_FILES[$varName]['name']<>"")) {
					$q = "SELECT ".$lfaction_file[$varName]['table_id']." FROM ".$lfaction_set['table']." WHERE " . $lfaction_file[$varName]['table_id'] . " LIKE '%' ORDER BY 'id' DESC";
					if ($_POST['lfupdate']=="yes") {					// And for update mode
						if ($lfaction_set['allow_update']   == "yes") {
							$q = "SELECT ".$lfaction_file[$varName]['table_id']." FROM ".$lfaction_set['table']." WHERE ". $dbid . " = '".$_POST['lfupdate_id']."'";
							};
						};
					$query = lfquery($q);
					$result = mysql_fetch_row($query);
					if ($_POST['lfupdate']=="yes") {					// And for update mode
						if ($lfaction_set['allow_update']   == "yes") {
							$result['0']--;
							};
						};
					$_FILES[$varName]['name']=$result['0']."_".$varName."_".$_FILES[$varName]['name'];
					};
				// Upload the image if there is no error
				if (($msg=="") AND ($_FILES[$varName]['tmp_name']<>"")) {
	
					if (!(@move_uploaded_file($_FILES[$varName]['tmp_name'] , $lfaction_file[$varName]['upload_loc']."/".$_FILES[$varName]['name'])))   {
						$msg  = "[problem in field] '[".$varName."]'<br>";
						$msg .= "[error moving file file from temp]";
						};
					};
	
				}
	
			// Check equal types
			if ($lfaction_type[$varName]=="equal") {
				if ($_POST[$varName] <> $_POST[$lfaction_linked[$varName]]) {
					$msg = "[error_not_eqaul_" . $varName . "_" . $lfaction_linked[$varName] . "]";
					};
				};
	
			};
		};

	}

elseif (($lfaction_set['action']=="del") OR ($lfaction_set['action']=="update")) {

	include $lfpath."system/ifs.php"; // doing all ifs

	$depencies=split(",",$lfaction_set['depencies']);
	if ($depencies<>"") {
		foreach ($depencies as $depency) {
			if ($_GET['if__'.$depency]=="no") {
				$msg="[error_depency_".$depency."]";
				};
			};
		};

	if ($lfaction_set['action']=="del") {
		$q="DELETE FROM ".$lfaction_set['table']." WHERE " . $lfaction_set['chby'] . " = '" . $_GET[$lfaction_set['get']]."'";
		}
	else {
		$q_updt="SHOW COLUMNS IN ".$lfaction_set['table'];
		$query_updt=lfquery($q_updt);
		$first_q=$q=" WHERE " . $lfaction_set['chby'] . " = '" . $_GET[$lfaction_set['get']]."'";
		while ($result_updt=mysql_fetch_row($query_updt)) {
			if ($_GET['ch_'.$result_updt['0']]<>"") {
				if ($first_q==$q) {
					$q = "SET ".$result_updt['0']." = '".$_GET['ch_'.$result_updt['0']]."' ".$q;
					}
				else {
					$q = ", ".$result_updt['0']." = '".$_GET['ch_'.$result_updt['0']]."' ".$q;
					};
				};
			};
		$q = "UPDATE ".$lfaction_set['table']." ".$q;
		};

//	echo $q."<br>";
	// if there is no error and there is a delete query, do the query
	if (($msg == "") and ($q<>"")) {
		lfquery($q);
//		echo $q;
//		$msg="[deleted_successfully]";
		};
	};

// Building SQL quiery for add,del and edit actions
if (		($lfaction_set['action'] == "add")
	OR	($lfaction_set['action'] == "edit") ) {
		// Check the depencies
		include $lfpath."system/ifs.php";
		$depencies=split(",",$lfaction_set['depencies']);
		if ($depencies<>"") {
			foreach ($depencies as $depency) {
				if ($_GET['if__'.$depency]=="no") {
					$msg="[error_depency_".$depency."]";
					};
				};
			};

		// For update depencies and for adding id
		
		if ($_POST['lfupdate']=="yes") {
			if ($lfaction_set['allow_update']   == "yes") {
				$depencies="";
				$depencies=split(",",$lfaction_set['update_depencies']);
				if ($depencies<>"") {
					foreach ($depencies as $depency) {
						if ($_GET['if__'.$depency]=="no") {
							$msg="[error_depency_".$depency."]";
							};
						};
					};
				};
			$_GET['lfupdate']="yes";
			$_GET['lfupdate_id']=$_POST['lfupdate_id'];
			};

		// The begining of the query
	
	if ($msg=="") { // If there is no error
		if ($lfaction_set['multi'] == "yes") {
			$I="1";
			while ($I < $multi_count) {
				foreach ($lfaction_multi as $multi => $mvalue) {
					if ($_POST[$multi."_".$I]<>"") {
						$_POST[$multi]=$_POST[$multi."_".$I];
						};
					};
			
				lfquery (add ($lfaction_set,$_POST,$lfaction_static,$table_file,$lfaction_type,$lfaction_get,$lfaction_file));
				//echo (add ($lfaction_set,$_POST,$lfaction_static,$table_file,$lfaction_type,$lfaction_get,$lfaction_file))."<br>";
				//$multi_count--;
				$I++;
				};
//			print_r($_POST);
//			exit;
			}
		else {
			$sql_query=add ($lfaction_set,$_POST,$lfaction_static,$table_file,$lfaction_type,$lfaction_get,$lfaction_file);
			//echo $sql_query."<br>";
			};
		};
	/*
	if ($lfaction_set['action'] == "del") {
		if ($lfaction_set['del_by']<>"") {
			$sql_query = "DELETE * FROM ".$lfaction_set['table']." WHERE  ".$lfaction_set['del_by']. " = '".$_POST[$lfaction_set['del_by']]."'";
			};
		};
*/

	// Checking the second id
	if (($lfaction_set['second_id']<>"") AND ($msg=="")) {
		foreach($lfaction_set['second_id'] as $varName => $value) {
			$q = "SELECT " . $lfaction_set['second_id'][$varName] . " FROM `" . $lfaction_set['table'] . "` WHERE ".$lfaction_set['second_id'][$varName] . " = "."'" . $_POST[$lfaction_set['second_id'][$varName]] . "'";
//			echo $q."<br>";
			if ($query =lfquery($q)) {
				$result = mysql_fetch_row($query);
				}
			else {
				$result="[none]";
				$result['0']="[none]";	
				};
			if ($result['0']==$_POST[$lfaction_set['second_id'][$varName]]) {
			//added for update type
				$show_msg="yes";
				if (($_POST['lfupdate']=="yes") AND ($lfaction_set['allow_update'] 	= "yes")){
					if ($dont_check[$lfaction_set['second_id'][$varName]]=="yes") {
						$show_msg="no";
						};
					};
			//end of added
				if ($show_msg=="yes") {
					$msg = "[already exits a content with the same] [".$lfaction_set['second_id'][$varName]."]";
					};
				};
			};
		};
	
			// Checking if the basic value is ok

	if ($lfaction_set['action']<>"del") {
		include $lfpath."system/ifs.php";
		};

	if ($msg=="") {// if there is no error
		if ($lfcheck_value[$lfaction_set['depency']]=="no") {
			$msg="[error_depency_" . $_POST['lfaction'] . "_" . $lfaction_set['depency']."]";
			};
		};


	// Checking if there is no error, and if not doing query
//	echo $msg;exit;
	if  ($msg == "")  {
		//cleaning up
//		$sql_query=str_replace('\\\\\\',"\\",$sql_query);
//		$sql_query=str_replace('\\\\\\&quot;',"&quot;",$sql_query);
//		$sql_query=str_replace('\'',"&quot;",$sql_query);
		// doing the query

//		echo $sql_query;exit;
		$sql_query=str_replace("|<|","(",$sql_query);
		$sql_query=str_replace("|>|",")",$sql_query);



		// doing the query
		
		mysql_query($sql_query);
//		echo mysql_error();

		
		// Deleting file
		if ($delete_file<>"") {
			unlink($delete_file); // Delete the file
			};

		// sending mail
		if ($email['msg']<>"") {
			mail($email['to'], $email['subject'], $email['msg'], $email['headers']);
			};
		};
	}

// Checking 'check' action values
if ($lfaction_set['action'] == "check") {
	$depencies=$lfaction_set['depencies'];
	include $lfpath."system/ifs.php";

	$depencies=split(",",$lfaction_set['depencies']);
	if ($depencies<>"") {
		foreach ($depencies as $depency) {
			if ($_GET['if__'.$depency]=="no") {
				$msg="[error_depency_".$depency."]";
				};
			};
		};

	$q=" WHERE (";
	if ($lfaction_check<>"") {
		$lfaction_check_with_array = split("," , $lfaction_check['with']);
		$firstcheck="on";
	
		foreach ($lfaction_check_with_array as $lfaction_check_with) {
			if ($firstcheck == "off") {
				$q .= " OR ";
				};
	
			$q .= $lfaction_check['column']." = '".$lfaction_check_with."' ";
			$firstcheck="off";
			};
		}
	else {
		$q.="1";
		};
	foreach($lfaction_type as $varName => $value) { 
		if (($value == "text") OR ($value == "mail") ) {
			$q .= ") AND (" . $varName . " = '".$_POST[$varName]."'";
			}
		elseif ($value == "md5" ) {
			$q .= ") AND (" . $varName . " = '".md5($_POST[$varName])."'";
			}
		elseif ($value == "static_insert" ) {
				$q2 = "UPDATE `" . $lfaction_set['table'] . "` SET " . $varName . " = '" . $lfaction_static[$varName] . "'";
				};
			};
	$q .= ")";

	$query  = lfquery("SELECT * FROM `" . $lfaction_set['table'] . "`".$q);
//	echo "<div dir=ltr>SELECT * FROM `" . $lfaction_set['table'] . "`".$q."</div>";
	if ($query<>"") {

		$result = mysql_fetch_row($query);
		}
	else {
		$result="";
		};
	
//	print_r($result);exit;
	if ($result == "") {
		$msg = "[error_lfaction_".$_POST['lfaction']."]";
		};
	if (($lfaction_set['save'] == "cookie") and ($msg == "")) {
		foreach($lfaction_type as $varName => $value) { 
//			echo $value."<br>";
			
			if (($value == "text") and ($lfaction_save[$varName]=="yes")) {
				setcookie( $varName , $_POST[$varName]);
				}
			elseif (($value == "md5") and ($lfaction_save[$varName]=="yes") ) {
				setcookie( $varName , md5($_POST[$varName]));
				
				}
			elseif (($value == "static_insert") and ($lfaction_save[$varName]=="yes")) {
				setcookie( $varName , $lfaction_static[$varName]);
				};
			};
		};
	// sending mail
	if (($email['msg']<>"") AND ($msg=="") AND ($lfaction_set['action'] == "check")) {
		mail($email['to'], $email['subject'], $email['msg'], $email['headers']);
//		echo $email['to'].",". $email['subject'].",". $email['msg'].",". $email['headers'];exit;
		};
	// if there is no error and there is a insert query, do the query


	if (($msg == "") and ($lfaction_set['query']<>"")) {
		lfquery($lfaction_set['query']);
		};

	if (($msg == "") and ($q2<>"")) {
		lfquery($q2.$q);
		};
	}

// Checking if index.php should be load by header or include
	// if the action is add or there is a error

if ($setheader=="yes") {
	if ((($lfaction_set['action']=="add") 
	OR ($lfaction_set['action']=="update")
	OR ($lfaction_set['action']=="del")) 
	OR ($msg<>"")) {
		if (($lfaction_set['fpage']<>"") and ($msg=="")) {
			header('Location: '.$lfaction_set['fpage']);
			}
		elseif (($lfaction_set['page']<>"") and ($msg=="")) {
			header('Location: index.php?content='.$lfaction_set['page']);
			}
		else {	
			include "index.php";
			};
		}
		// if the action is check and there is no error
	elseif (($lfaction_set['action']=="check") and ($msg=="")) {
		if ($lfaction_set['page']<>"")  {
			header('Location: index.php?content='.$lfaction_set['page']);
			}
		elseif ($lfaction_set['fpage']<>"") {
			header('Location: '.$lfaction_set['fpage']);
			}
		else {	
			header('Location: index.php');
			};
		};
	};
?>