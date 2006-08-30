<?
function lfquery_cached($lfquery) {
	$lfquery = str_replace("/*","",$lfquery);
	$lfquery = str_replace("*/","",$lfquery);
//	$lfquery = (mysql_escape_string($lfquery));
	if (!(file_exists("cached/temp/".md5($lfquery).".php"))) {
		$result=mysql_query($lfquery);
		// Returning error if exits
		if (mysql_error()<>"") {
			echo "<div style=\"direction: ltr;width: 100%;color: red;background: black;  top:0px\">Error in \"$lfquery\": ".mysql_error()."</div>";
			};
		$i="2";
		$result3 = "<?\n";
		if ($result<>"") {
			// For fetch array
			while ($result2['fetch_array'][$i]=mysql_fetch_array($result)) {
				$rownum="0";
				foreach ($result2['fetch_array'][$i] as $nname => $vvalue) {
					$result3 .= '$result2[\'fetch_array\'][\'' . $i . '\'][\''.$nname.'\'] = \''. mysql_escape_string($vvalue) .'\';' . "\n";
					if ($check_done<>"yes") {
						$result3 .= '$result2[\'fetch_row\'][\'' . $i . '\'][\''.$rownum.'\'] = \''. mysql_escape_string($vvalue) .'\';' . "\n";		
						$result2['fetch_row'][$i][$rownum]=mysql_escape_string($vvalue);
						$rownum++;
						$check_done="yes";// for skipping values
						}
					else {
						$check_done="no";
						};
					};
				$i++;
				};
			};
//print_r($result2);exit;
		$result3 .= "?>";
//		echo $result3;
		include "config.php";
		if ($querycache=="yes") {
			file_put_contents("cached/temp/".md5($lfquery).".php", $result3);
			};
		}
	else {
		$result2="";
		include ("cached/temp/".md5($lfquery).".php");
//		echo "ok";
 		};


	//	global $_CNTarray;	
//		$_CNTarray="";
		
/*	$i="1";
		while ($result2['row_values'][$i]=mysql_fetch_row($result)) {
			$i++;
			};*/

//	echo "<div dir=ltr>".$lfquery."<hr />";print_r($result2);echo "</div><br /><br /><br />";
	global $_CNTarray;
	$_CNTarray['in_row'][$lfquery]="";
	$result2['query']=$lfquery;
	return $result2;
	};

function lfquery($lfquery) {
	$lfquery = str_replace("/*","",$lfquery);
	$lfquery = str_replace("*/","",$lfquery);
//	$lfquery = (mysql_escape_string($lfquery));
	$result=mysql_query($lfquery);
	// Returning error if exits
	if (mysql_error()<>"") {
//		echo "<div style=\"direction: ltr;width: 100%;color: red;background: black;  top:0px\">Error in \"$lfquery\": ".mysql_error()."</div>";
		};
	return $result;
	}

function lf_num_rows($query) {
//print_r($query);
//	echo "<div dir=ltr>".$query['query']."</div>";
	$return = 0;
	if ($query['fetch_array']<>"") {
		foreach ($query['fetch_array'] as $d) {
			$return++;
			};
		};
	return $return;
	};

function lf_fetch_array($query) {
	global $_CNTarray;
//print_r($query);
//print_r($query['all_values']);
	$counter=$_CNTarray['in_row'][md5($query['query'])];
	if ($counter=="") {
		$counter="1.5";
		};
	
	$counter=$counter+1;
//	echo $counter . " ";
/*
	if ($query['fetch_array'][$_CNTarray['in_row']]=="") {
			$_CNTarray['in_row']="-2";
			return "";
		};		
*/
	$_CNTarray['in_row'][md5($query['query'])] = $counter;
	return $query['fetch_array'][$counter];
	};

function lf_fetch_row($query) {
	global $_CNTarray;
//print_r($query);
//print_r($query['all_values']);
	$counter=$_CNTarray['in_row'][md5($query['query'])];
	if ($counter=="") {
		$counter="1.5";
		};
	
	$counter=$counter+0.5;
//	echo $counter . " ";
/*
	if ($query['fetch_array'][$_CNTarray['in_row']]=="") {
			$_CNTarray['in_row']="-2";
			return "";
		};		
*/
	$_CNTarray['in_row'][md5($query['query'])] = $counter;
	return $query['fetch_row'][$counter];
	};


?>