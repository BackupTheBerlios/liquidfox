<?
function show_tag($lftheme,$tagname,$tagvarsnum,$tagquery,$return) {
	include "config.php";
	$result_array="";
	$checkstring= split( $tagname, $lftheme['content']);
	if ($checkstring['1']<>"") { // <- Checking if exists
		$i="1";
		while ($checkstring[$i]<>"") {
			$checkstring2="";
			$checkstring2=split( "~", $checkstring[$i]);;
			for ($i2=1; $i2<=$tagvarsnum ; $i2++) {
				$Iresult="0";
				$Iresult_gets="0";
				$i3="1";
				$q2="";
				
				$replacestring=""; // What to replace
				if ($tagquery[$i3]<>"tagid") {
					while ( $tagquery[$i3]<>"" ) {
						if ($tag_block[$checkstring2[$i3-1]]<>"yes") {
							$q2 .= $tagquery[$i3] . $checkstring2[$i3-1];
							}
						$Iresult_gets++;
						$result_array['query'][$Iresult_gets]=$checkstring2[$i3-1];
							
						$i3++;
						$replacestring .= $checkstring2[$i3-2]."~";
						};
					$replacestring=$tagname.$replacestring;
					}
				$q2 .= $tagquery['end'];
//				$lftheme['content'].= $q2."<br>";
				if ($empty_query[$q2]<>"yes") {
					$result2="";	$result2['0']="";
	
					// for theme
					$query2 ="";
					if ($query2=lfquery($q2)) { 
						while ($result3 = mysql_fetch_row($query2)) {
							$result2['0'] .= "<!-- lftag -->".$result3['0']."<!-- /lftag -->";
							// print_r($result3);
							}
						};
	
//					$lftheme['content'].= $result2['0']."<br>---------<br>";

					if ($result3=="") {
						$empty_query[$q2]="yes";
						};

					// for array
//					echo $tagname."<br><div dir=ltr>".$q2."</div><br>";
					$result_array="";
					if ($result2['0'] <> "") {
						$query2=lfquery($q2);
						while ($result3 = mysql_fetch_array($query2)) {
							$Iresult++;
							$result_array[$Iresult]=$result3;
							};
						};

					$result_array['set']['replacestring']=$replacestring;
					//echo "<div dir=ltr>[".$replacestring."], [".$result2['0']."]</div><br>";
					$lftheme['content']=str_replace($replacestring, $result2['0'], $lftheme['content']);
					};
				};
			$i++;
			};
		};

	if ($return == "theme") {
		return $lftheme;
		}
	elseif ($return == "array") {
		//print_r($result_array);
		return $result_array;
		};
	};
?>