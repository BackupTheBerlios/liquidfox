<?
$lf_file="";
if ($handle = opendir($dir)) { 
$lf_file_number="0";

    while (false !== ($file = readdir($handle))) { 
	$lf_file_number++;
	if ($lf_file_number>"2") {
		$lf_file[$lf_file_number-2]=$file; };};
closedir($handle);};
?>