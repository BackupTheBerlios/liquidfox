<?
$check_split = split($tagquery['tag'],$lftheme['content']);
$added = "";
while ($check_split['1']<>"") {
	$result_array="";
	$result_array=show_tag ($lftheme,  $tagquery['tag'], $tagquery['num'] , $tagquery, "array");	
	if ($result_array<>"") {

		include $table_file[$result_array['query']['2']]; 	// Including table file for $dBid
		$linkcol="";
		foreach ($result_array as $resName => $resValue) {	// For each result show a link
			
			if ($resName<>"query" AND $resName<>"set") { 	// For not showin result for settings
//						$lftheme['content'].= $resValue[$result_array['query']['5']]."<br>";
				if ($tag_block[$result_array['query']['5']]<>"yes") {
					
					$addstring = "</a><!-- linkcol ".$result_array['query']['2']."_".$result_array['query']['5']." -->"."<a href=\"system/lfredirect.php?&amp;where=".$dbid."&amp;equal=".$resValue[$dbid]."&amp;lfredirect=".$result_array['query']['2']."_".$result_array['query']['5']."\">". $resValue[$result_array['query']['5']]."</a><!-- linkcol_end ".$result_array['query']['2']."_".$result_array['query']['5']." -->";
					};
					// this if is dealing with the doubles issue...
				if ($added[$resValue[$result_array['query']['5']]]<>"yes") {
					$added[$resValue[$result_array['query']['5']]]="yes";
					$linkcol .= $addstring;
					};
				};
			};
		};
	//echo $result_array['set']['replacestring']."<br>";
	//echo $linkcol."<br>";
	$lftheme['content'] = str_replace($result_array['set']['replacestring'], $linkcol, $lftheme['content']);
	$check_split="";
	$check_split = split($tagquery['tag'],$lftheme['content']);
	};
?>