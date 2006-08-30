<?
$dir="parts";
include "system/lf_filelist.php";
$Ipart = 0;
$loopII="0";
foreach ($lf_file as $fileNumber => $fileValue) {
	include "parts/".$fileValue."/config.php";
	};

// Making multi loops
$i=1;
while ($lfdefault[$i.'_name']<>"") {

	if ($lfdefault[$lfdefault[$i."_name"].'_multi']<>"") {
		$query = lfquery_cached("SELECT `" . $lfdefault[$lfdefault[$i."_name"].'_multi'] . "` FROM `" . $lfdefault[$lfdefault[$i."_name"].'_table'] . "`");
/*		?><div dir=ltr><?
		print_r($query);
		?></div><?*/
		while ($lfresult = lf_fetch_row($query)) {
			$loopII++;
			$table_name=$lfdefault[$i."_name"] . "_" . $lfresult['0'];
//			echo $table_name."<br />";
//			echo $lfdefault[$i."_name"] . "_" . $lfresult['0'];
			if ($lfdefault[$table_name.'_table']=="") {
				$lfdefault[$loopII.'_name']	= $table_name;

				$lfdefault[$table_name.'_table']	= $lfdefault[$lfdefault[$i."_name"].'_table'];
				
				$lfdefault[$table_name.'_query']	= str_replace("[multi]" , $lfresult['0'], $lfdefault[$lfdefault[$i."_name"] . '_query']);
				$lfdefault[$table_name.'_recursive'] = $lfdefault[$lfdefault[$i."_name"] . '_recursive'];	
				$lfdefault[$table_name.'_multi'] = $lfdefault[$lfdefault[$i."_name"] . '_multi'];
//				echo $lfdefault[$lfdefault[$i."_name"] . '_multi'];
				}
			else {
				$loopII--;
				};
//			echo $lfdefault[$table_name.'_query']."<br>";
//			print_r($lfresult);
			}
//		echo $lfdefault[$lfdefault[$i."_name"].'_multi_query'];
		};
	$i++;
	};

// loading defautl $_GET['table_loops'] value
for ($loop_c="1";$loop_c <= $loopII;$loop_c++) {
	$loop_d="1";
	while ($lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_name']<>"") {
		if ($lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_name'] == "loops_".$lfdefault[$loop_c.'_name']) {
			if ($_GET[$lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_name']]=="") {
				$_GET[$lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_name']] = $lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_default'];
//				echo $lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_name'].":".$lfdefault[$lfdefault[$loop_c.'_name']."_".$loop_d.'_default']."<br />";
//				echo ;
				};
			};
		$loop_d++;
		};
	};

/*
echo "<div dir=ltr>";
print_r($lfdefault);
echo "</div><br /><br />";
/**/
?>