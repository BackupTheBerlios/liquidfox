<?
$dir="parts";
include "system/lf_filelist.php";
$Ipart = 0;
foreach ($lf_file as $fileNumber => $fileValue) {
	$Ipart++; $lfpart[$Ipart]=$fileValue;
	};
?>