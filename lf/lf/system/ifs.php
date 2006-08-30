<?
include "lfparts.php";
$dir="parts";
include "system/lf_filelist.php";
foreach ($lf_file as $fileNumber => $fileValue) {
	include "parts/".$fileValue."/if.php";
	$Iif++;
	$if[$Iif] = $fileValue."_part";
	$if_check[$if[$Iif]]['type']  	= "true";
	$if_check[$if[$Iif]]['check']  	= true;
	};
$q = "";
if ($if<>"") {
	foreach ( $if as $if_name) {
//		echo $if_name.":".$if_check[$if_name]['type']."<br>";;
		$q="";
		if ($if_check[$if_name]['type'] == "cookie") {
			
			// If there is cookies
			if ($if_check[$if_name]['cookie_fields']<>"") {
				// Checking the cookies
				$if_cookie_fields = split( "," , $if_check[$if_name]['cookie_fields']);
				};
			
			// Building the select query
		//	print_r($if_check);
		
			if (($if_check[$if_name]['cookie_fields']<>"") AND ($q=="")) { // With cookies
				$q = "SELECT * from `" . $if_check[$if_name]['table'] . "` WHERE ". $if_cookie_fields['0'] . " = '".$_COOKIE[$if_cookie_fields['0']]."'" ;
				};
				
			for  ($i="2"; $i <= count($if_cookie_fields); $i++) {
				$q .= " AND ".$if_cookie_fields[$i-1]." = '".$_COOKIE[$if_cookie_fields[$i-1]]."'";
//				echo $q."<br>";
				};
//			echo $if_name.":<div dir=ltr align=center>".$q."<div>";
			}
		elseif ($if_check[$if_name]['type'] == "sql") {
			$q = $if_check[$if_name]['sql'];
//echo $if_name."<br />";
			};
//	echo $q."<br><br>";
		if (($if_check[$if_name]['type'] == "cookie") OR ($if_check[$if_name]['type'] == "sql")) {
			if ($q<>"") {
				if ($query  = lfquery($q)) {
					$result = mysql_fetch_array($query);
//					echo "<b>";print_r($result);echo "</b><br><br>";
					}
				else {
					$result="";
					};
				}
			else {
				$result = "";
				};
			}
		elseif ($if_check[$if_name]['type'] == "true") {
			if ($if_check[$if_name]['check']=="1") {
				$result="yes";
				}
			else {
				$result="";
				};
			};

		if ($result == "") {

			$_GET["if__".$if_name] = "no";// For caching
			$lfcheck_value[$if_name]="no";
			// empty if tags if query dont succeed
//			echo '<div dir=ltr>/\[IF_'.$if_name.'\].+?\[END_IF_'.$if_name.'\]/s'."</div>";
			$lftheme['content']=preg_replace('/\[IF_'.$if_name.'\].+?\[END_IF_'.$if_name.'\]/s',"",$lftheme['content']);

/*			$lftheme['content']=str_replace("[IF_".$if_name."]","<!-- [STARTDEL]",$lftheme['content']);
			$lftheme['content']=str_replace("[END_IF_".$if_name."]","[ENDDEL] -->",$lftheme['content']);*/
	
			$lftheme['content']=str_replace("[IF_NOT_".$if_name."]","",$lftheme['content']);
			$lftheme['content']=str_replace("[END_IF_NOT_".$if_name."]","",$lftheme['content']);
	
			}
		else {
			$_GET["if__".$if_name] = "yes";// For caching
			$lfcheck_value[$if_name]="yes";
			// empty if_not tags if query succeed

			$lftheme['content']=str_replace("[IF_NOT_".$if_name."]","<!-- [STARTDEL]",$lftheme['content']);
			$lftheme['content']=str_replace("[END_IF_NOT_".$if_name."]","[ENDDEL] -->",$lftheme['content']);

			$lftheme['content']=str_replace("<!-- [IF_".$if_name."]","",$lftheme['content']);
			$lftheme['content']=str_replace("[END_IF_".$if_name."] -->","",$lftheme['content']);

			$lftheme['content']=str_replace("[IF_".$if_name."]","",$lftheme['content']);
			$lftheme['content']=str_replace("[END_IF_".$if_name."]","",$lftheme['content']);
	
			};
		};
	};
//exit;
?>