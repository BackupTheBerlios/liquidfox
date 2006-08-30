<?
$count="0";
$count_bydate="0";

$fileName="cached/counter/bydate/".date("Ynd").".php";
if (file_exists($fileName)) {
	include $fileName;
	};
if (file_exists("cached/counter/counter.php")) {
	include "cached/counter/counter.php";
	};
if ($sawip[$_SERVER['REMOTE_ADDR']]<>"yes") {
	$count++;
	$count_bydate++;
	$sawip[$_SERVER['REMOTE_ADDR']]="yes";
	};
$file="<?\n\$count_bydate=\"".$count_bydate."\";\n";
foreach ($sawip as $varname => $varvalue) {
	$file.="\$sawip['".$varname."']=\"".$varvalue."\";\n";
	};
$file.="\n?>";
file_put_contents($fileName, $file);
file_put_contents("cached/counter/counter.php","<? \$count=\"".$count."\"; ?>");
// using tag
$lftheme['content'] = str_replace("[count]",$count,$lftheme['content']);
$lftheme['content'] = str_replace("[count_bydate]",$count_bydate,$lftheme['content']);
?>