<?
function lftheme_load($default_theme,$lang,$lfcanuse,$msg,$_oldGET, $lfdefault) {

	global $_CNT;
	// Creating lfdb tables location list
	include "lfparts.php";			// get the lfparts list
	include "system/list_lfdb_files.php";	// get the lfdb files list

	// Clean content from empty stuff
	$lftheme['content']=str_replace("scr=''","",$lftheme['content']);
	include "config.php";

	include "system/lfconfigs.php";
	
	// not empty
	if ($lfnotempty<>"") {
		foreach ($lfnotempty as $nmt_name => $nmt_value) {
			if ($_GET[$nmt_name] == "") {
				$_GET[$nmt_name]="NOT_EMPTY";
				};
			};	
		};

	// Replacing everything needed to be replaced
	if ($lfreplace<>"") {
		foreach ($lfreplace as $rpl) {
			if ($rpl['content'] == $_GET['content']) {
				$string_replace = split(",",$rpl['replace']);
				$string_with 	= split(",",$rpl['with']);
	
				if ($rpl['type']=="post") {
					if ($_POST[$rpl['name']]<>"") {
						
						foreach ($string_replace as $rplc_name => $rplc_value) {
							$_POST[$rpl['name']]=str_replace( $string_replace[$rplc_name],$string_with[$rplc_name],$_POST[$rpl['name']]);
							};
						};
					};
				};
			};
		};


	if ($_COOKIE['lftheme']<>"") {
		$dir="themes"; include $lfpath."system/lf_filelist.php";
		};

	if ((file_exists("design/default/main.html") AND ($_COOKIE['theme']==""))) {
		$lftheme['content']=file_get_contents("design/default/main.html");
		}
	elseif ($_COOKIE['theme']<>"") {
		$contentfile = $lftheme['content']=file_get_contents("design/" . $_COOKIE['theme'] . "/main.html");
		}
	else {
		if (file_exists("parts/". $default_theme ."/main.html")) {
			$lftheme['content']=file_get_contents("parts/". $default_theme ."/main.html");
			};
		};

	if ($_GET['nomain']=="yes") {
		$lftheme['content'] = "[LF_CONTENT]";
		};

	// addon for admin
	if ($_GET['admin']=="yes") {
		$lftheme['content']=file_get_contents("admin/main.html");
		if ($_GET['content']==$lfdefault['content']) {
			$_GET['content']="main";
			};
		};

$contentfile="";
	// Loading _LF_CONTENT_

	if ($_GET['content']<>"") {
	
		if ($msg<>"") {
			$_GET['content']=$_POST['lfaction'];
			};

	$splt_content=split("\|",$_GET['content']);

	if (($splt_content['0']=="default") AND ($_COOKIE['theme']=="")) {
		$contentfile = file_get_contents("design/default/content/".$splt_content['1'].".html");	
		}
	elseif (($_COOKIE['theme']<>"") AND (file_exists("design/".$_COOKIE['theme']."/content/".$splt_content['1'].".html"))) {
		$contentfile = file_get_contents("design/".$_COOKIE['theme']."/content/".$splt_content['1'].".html");
		}
	else {
//		$contentfile = file_get_contents("parts/". $default_theme."/content/".$_GET['content'].".html");	
		$dir="parts";
		include "system/lf_filelist.php";
		foreach ($lf_file as $fileNumber => $fileValue) {
			if (file_exists("parts/". $fileValue."/content/". $_GET['content'] .".html")) {
				$contentfile = file_get_contents("parts/". $fileValue."/content/". $_GET['content'] .".html");
				};
			};
		if (file_exists("design/default/content/". $_GET['content'] .".html")) {
			$contentfile = file_get_contents("design/default/content/". $_GET['content'] .".html");
			};
		if (file_exists("design/".$_COOKIE['theme']."/content/". $_GET['content'] .".html")) {
			$contentfile = file_get_contents("design/".$_COOKIE['theme']."/content/". $_GET['content'] .".html");
			};
		};

		// addon for admin
		if ($_GET['admin']=="yes") {
			if (file_exists("admin/content/". $_GET['content'] .".html")) {
				$contentfile = file_get_contents("admin/content/". $_GET['content'] .".html");
				}
			else {
				$contentfile="";
				};
			};

		$lftheme['content']=str_replace("[LF_CONTENT]",$contentfile,$lftheme['content']);
		if ($msg<>"") {
			$lftheme['content']=str_replace("[LF_MSG]",$msg,$lftheme['content']);
			}
		else {
			$lftheme['content']=str_replace("[LF_MSG]","",$lftheme['content']);
			};
		}
	else {
		$lftheme['content']=str_replace("[LF_CONTENT]","",$lftheme['content']);
		};

	//  Checking if content is for update
	if ($_GET['lfupdate']=="yes") {
//echo ";
		// Including action file configuration
		foreach ($lfpart as $varName => $value) {
			$fileName="parts/".$value."/actions/".$_GET['content'].".php";
			if (file_exists($fileName)) {
				include $fileName;
				};
			};

		// Checking if allow update
		if ($lfaction_set['allow_update']   == "yes") {
			
			include $table_file[$lfaction_set['table']];

			// fetching data
			$q = "SELECT * FROM ".$lfaction_set['table']." WHERE ".$dbid." = '".$_GET['lfupdate_id']."'";
			
			$result=lfquery_cached($q);
			$result_row=lf_fetch_array($result);

			// Checking for updates to hide
			if ($lfaction_set['update_depencies']<>"") {
				$hideme=split(",",$lfaction_set['update_hide']);
				foreach ($hideme as $hide) {
					$hide_value[$hide]="yes";
					};
				};
			// saving to posts
			foreach($db as $db2) {
				if ($hide_value[$db2['name']]<>"yes") {// checking if value not hided
					$_POST[$db2['name']]=$result_row[$db2['name']];
						// Normalizing
						$_POST[$db2['name']] = str_replace('\&quot;','&quot;',$_POST[$db2['name']] );
						$_POST[$db2['name']] = str_replace('\\\'','\'',$_POST[$db2['name']] );
						$_POST[$db2['name']] = str_replace('|<|','(',$_POST[$db2['name']] );
						$_POST[$db2['name']] = str_replace('|>|',')',$_POST[$db2['name']] );
						};
				};


			//adding the update notice to the code
			$lftheme['content']=str_replace('<!-- [lfupdate] -->',"<input type=\"hidden\" name=\"lfupdate\" value=\"yes\" />\n<input type=\"hidden\" name=\"lfupdate_id\" value=\"".$_GET['lfupdate_id']."\" />",$lftheme['content']);

			// Disabling unneeded fields
			$fields = split(",",$lfaction_set['update_fields']);
			foreach ($lfaction_type as $action_name => $action_value) {
				$change_it = "yes";
				foreach ($fields as $field) {

					if ($field==$action_name) {
						$change_it = "no";
						};
					};
				if ($change_it=="yes") { // disabling field
					$lftheme['content']=str_replace('name="'.$action_name,' disabled="disabled" name="'.$action_name,$lftheme['content']);
					};

				};

			};
		};

	

// Shoing Cookie tags
	foreach($_COOKIE as $cookie_name => $cookie_value) {
		$lftheme['content']=str_replace("[COOKIE_".$cookie_name."]",$cookie_value,$lftheme['content']);
		};


if ($_GET['skiploops']=="") {
/* ----------------------------------------------------- */
	//	[LOOP]	//
/* ----------------------------------------------------- */
	
	// Using default if not selected
	if ($_GET['loops_1'] == "") 	{$_GET['loops_1'] = "1";};
	
	// Create a loop
		// Caching the loop start
	$i5=1; /* loop counter */
	for ($i=1; $i<=$loopII; $i++) {
		
	
 	$i5=$lfdefault[$i.'_name'];
	
//preg_replace(,$lfcached_loop,$lftheme['content']);
	if (preg_match('/<\!-- START_LOOP_'.$i5. ' -->.+?<\!-- END_LOOP_'.$i5.' -->/s',$lftheme['content']) OR preg_match('/\[START_LOOP_'.$i5. '\].+?\[END_LOOP_'.$i5.'\]/s',$lftheme['content'])) {

			// for recursive
			if ($recursive_loop_content[$i5]<>"") {
				$lftheme['content'] = str_replace("<!-- recursive_" . $i5 . " -->", "<div class=\"subrecursive\">[START_LOOP_".$i5 ."]".$recursive_loop_content[$i5] . "[END_LOOP_". $i5 ."]</div>" ,$lftheme['content']);
	//  		echo "<div dir=ltr>< !-- recursive_" . $i5 . " -->";
	//  		echo "<hr />";
	//  		echo  "<div >[START_LOOP_".$i5 ."]".$recursive_loop_content[$i5] . "[END_LOOP_". $i5 ."]";
	//		echo "<hr /><hr /></div>";
	//			echo "|".$recursive_loop_content[$i5]."|\n";
				};
	/*			if ($i5=="subforums_4_6") {
					echo $lftheme['content'];exit;
					};*/
			
	//		echo $i5."<br />".;
			
			$checkstring = split( ("\[START_LOOP_".$i5."\]"), $lftheme['content']);
			$checkstring2= split( '\[END_LOOP_'.$i5."\]", $checkstring['1']);
	
				// Count how many rows it will show
	//			print_r($_GET);exit;
	//			if ($_GET['loops_'.$i5]=="") {$_GET['loops_'.$i5]="10";};
	
				$completed=""; // This var will contain the final string of the show...
	
					$q="";		$q	= $lfdefault[$i5.'_query'];
	
					$varsCounter=1;
	
					while ($lfdefault[$i5.'_'.$varsCounter.'_name']<>"") {

						// Securing
						if ($secured[$lfdefault[$i5.'_'.$varsCounter.'_name']]=="") {
							$_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']]=mysql_escape_string($_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']]);
							$secured[$lfdefault[$i5.'_'.$varsCounter.'_name']]="yes";
							
							};

						// If allow to get all kind of input
						if ($lfdefault[$i5.'_'.$varsCounter.'_gets']=="all") {
							if ($_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']]<>"") {
									// Checking value security
									if ($lfdefault[$i5.'_'.$varsCounter.'_id']<>"") {
										$idQuery=lfquery_cached("SELECT `".$lfdefault[$i5.'_'.$varsCounter.'_id']."` FROM `". $lfdefault[$i5.'_table'] . "`" );
	
										$value_is_ok="no";
													
										while($idResult=lf_fetch_row($idQuery)) {
											if ($idResult==$_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']]) {
												$value_is_ok="yes";
												};
											};
										}
									else {
										$value_is_ok="yes";
										};
								if ($value_is_ok=="yes") {
									$q=str_replace("[".$varsCounter."]",$_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']],$q);
									}
								else {
									$q=str_replace("[".$varsCounter."]","",$q);
									};
								}
							else {
								$q=str_replace("[".$varsCounter."]",$lfdefault[$i5.'_'.$varsCounter.'_default'],$q);
								}
							};
	
						if ($lfdefault[$i5.'_'.$varsCounter.'_gets']=="none") {
								$q=str_replace("[".$varsCounter."]",$lfdefault[$i5.'_'.$varsCounter.'_default'],$q);
							};
	
						// If allow to get only some varibles
						if (($lfdefault[$i5.'_'.$varsCounter.'_gets']<>"all")
							AND ($lfdefault[$i5.'_'.$varsCounter.'_gets']<>"none")) {
	
							$allowchageparts="";
							$allowchageparts=split(",",$lfdefault[$i5.'_'.$varsCounter.'_gets']);
							foreach($allowchageparts as $acp_name => $acp_value) {
								$allowvalue[$acp_value]="yes";
								};
							if ($_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']]<>"") {
								if ($allowvalue[$_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']]]=="yes") {
									// inserting value
									$q=str_replace("[".$varsCounter."]",$_GET[$lfdefault[$i5.'_'.$varsCounter.'_name']],$q);
									}
								}
							else {
								if ($allowvalue[$lfdefault[$i5.'_'.$varsCounter.'_default']]=="yes") {
	//echo $lfdefault[$i5.'_'.$varsCounter.'_default'].":"."[".$varsCounter."]"."<br>";
									$q=str_replace("[".$varsCounter."]",$lfdefault[$i5.'_'.$varsCounter.'_default'],$q);
									};
								}
							};
						$varsCounter++;
						};
	
//					echo "<div dir=ltr>".$i5." : ".$q."</div>";
					$cookies="";$splt_cookies=split(",",$loopcache_cookies);
					foreach($splt_cookies as $cookiename) {
						$cookies .= "|".$cookiename."|".$_COOKIE[$cookiename];
						};
	//				echo $cookies."<br />";
	//				echo "cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_".(md5($q.$cookies)).".php"."<br />";
					if (file_exists("cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_".(md5($q.$cookies)).".php")) {
	
						$lfcached_content=""; $lfcached_result="";
	//					echo "<div dir=ltr>cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_".(md5($q)).".php</div>";
	
						include "cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_".(md5($q.$cookies)).".php";
	//					echo $cached_result;
						if ($lfcached_result<>"") {
							$lftheme['content'] = str_replace($lfcached_content, $lfcached_result, $lftheme['content']);
							};
	//
						if (file_exists("cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_s_".(md5($q.$cookies)).".php")) {
//						echo "<div dir=ltr>cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_s_".(md5($q.$cookies)).".php</div>";
							include "cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_s_".(md5($q.$cookies)).".php";
							$lftheme['content']=preg_replace('/<\!-- START_LOOP_'.$i5. ' .+?END_LOOP_'.$i5.' -->/s',$lfcached_loop,$lftheme['content']);
							};
						}
					else {
						$infoquery="";
						$infoquery=lfquery_cached($q);
//						$_GET['loops_'.$i5]="";

						if ($infoquery<>"") {

							if ((lf_num_rows($infoquery)<>"") AND ($_GET['loops_'.$i5]=="")) {
								
								$_GET['loops_'.$i5] = lf_num_rows($infoquery);
								};
							};
						// Doing the second query if needed

						if ($_GET['secondwhere_'.$i5]<>"") {
							$row="";
							$row=lf_fetch_array($infoquery);
							$q_middle2 = " WHERE `" . $_GET['secondwhere_'.$i5]."` = '".$row[$_GET['secondwhere_'.$i5]]."' ".$_GET['secondwhereadd_'.$i5]." ";
							$q = $q_start . $q_middle2 . $q_end .$q_end2 . $_GET['queryend_'.$i5];
		//					echo $q."<br><br>------<br>";
							$infoquery=lfquery_cached($q);
							};
		
		$Iobj = 1; // Count for the static objects
		//$q.=$_GET['queryend_'.$i5];
					for ($i8=1; $i8 <= $_GET['loops_'.$i5]; $i8++) { // Starting the loop of rows will be shown
						// Getting the columns list query 
	//					$colquery=lfquery_cached($q);
	//					$db="";
	//					include $table_file[$lfaction_set['table']];
	
						// Skipping to the right column
			
						if ($i8=="1001"){exit;}; // exit on override...
						$checkstring3=$checkstring2['0']; // checkstring3 gets the stracture
						if ($lfdefault[$i5.'_table']<>"_session") {
						$colresult="";
							if ($infoquery<>"") {
								$row=lf_fetch_array($infoquery);
								if ($row<>"") {
									foreach ($row as $rowName => $rowValue) {
										$colresult[$rowName]=$rowValue;
										};
									};
								}
							else {
								$row="";
								};
		//					echo "<br>----------------------------<br>";
							$row_is_empty=false;
							if ($row == "") {$row_is_empty=true;};
			
		//					while ($col=lf_fetch_array($colquery)) {// Get the row name
							$table_files = split("`,`",$lfdefault[$i5.'_table']);		
					/*		if ($colquery<>"") {
								$colresult=lf_fetch_array($colquery);
								}
							else {
								$colresult="";
								};
	*/
							if ($colresult<>"") {
	
								foreach ($colresult as $colname => $colvalue) {
		
									$col['Field'] = $colname;
		
									// getting the id from lfdb
									if ($table_files['1']<>"") {
										foreach ($table_files as $include_table) {
											include $lfconf_db['prefix']. $table_file[$include_table];
											};
										}
									else {
										if ($table_file[$lfdefault[$i5."_table"]]<>"") {
											include $table_file[$lfdefault[$i5."_table"]];
											}
										else { // removing prefix
	//echo $lfdefault[$i5."_table"];
											$noprefix_table_file=str_replace($lfconf_db['prefix'],"",$lfdefault[$i5."_table"]);
											include $table_file[$noprefix_table_file];
											};
										};
									// replace the stracture with the value of the field in the row
		//							if ($lfcanuse[$lfdefault[$i5.'_table']][$col['Field']]=="yes") {
										// lfadmin addon
										$lfadmin_row[$col['Field']]="";
										if (($_COOKIE[$lfadmin['nickname']['cookie']]
											==$lfadmin['nickname']['value']) 
										AND ($_COOKIE[$lfadmin['password']['cookie']]
											== $lfadmin['password']['value'])) {
											$lfadmin_row[$col['Field']] = "<a style=\"color: #000000\" href=\"lfadmin.php?action=edit&amp;id=".$row[$dbid]."&amp;table=".$lfdefault[$i5.'_table']."&amp;field=".$col['Field']."\" >[edit]"."</a> ";
											$lfadmin_row2[$col['Field']]=$row[$col['Field']];
											};
										// end of lfadmin
	//									echo $i5." ";
	
										if ($lfadmin_row[$col['Field']]=="") {
	//										echo "<div dir=ltr>".$col['Field']."<br></div>";
	//										print_r($row);echo "<hr/>";
											// making rows
											$row[$col['Field']] = str_replace("\n","<br />",$row[$col['Field']] );
											$row[$col['Field']] = str_replace('\&quot;','&quot;',$row[$col['Field']] );
											$row[$col['Field']]  = str_replace('\\\'','\'',$row[$col['Field']] );
											// For markup
		
											if ($lfconf_markup<>"") {
												foreach ($lfconf_markup as $mu_name => $mu_value) {
													$row[$col['Field']]=str_replace($_GET[$mu_value] ,"<b class=\"markup\">".$_GET[$mu_value]."</b>", $row[$col['Field']]);
													}
												};
		
											// changing string
											
											if ($row[$col['Field']]<>"") {
		//										echo $checkstring3."<Br>";
			//									echo $col['Field']."<br>";
				//								echo $row[$col['Field']];echo "<Br><br>";	
												};
											// addon for recursive
			//							if ($i5=="subforums_4_6"){echo "<div dir=ltr style='background: black; color: white'>".$i5."</div>";print_r($row);echo "<br />"."<br />";	};
											if ($lfdefault[$i5."_recursive"]<>"") {
	//echo "ok";
												if (($lfdefault[$i5.'_multi']==$col['Field']) AND ($recursive_value[$row[$col['Field']]]<>"yes")) {
													$recursive_loop[$row[$col['Field']]]   =  "yes";
														$recursive_loop_content[$i5."_".$row[$col['Field']]]=$checkstring2['0'];
													};
												};
	
											// replace in loop
											$checkstring3=str_replace("[[".$col['Field']."]]" ,$row[$col['Field']] , $checkstring3);
											if ($row[$col['Field']]<>"") {
												$lftheme['content']=str_replace("[".$i5."_".$col['Field']."[".$Iobj."]]" ,$row[$col['Field']] , $lftheme['content']);
												
												// Deleting commented images
												$lftheme['content']=str_replace("<!-- ".$i5."_".$col['Field']."[".$Iobj."]" ,"" , $lftheme['content']);
												$lftheme['content']=str_replace($i5."_".$col['Field']."[".$Iobj."] -->" ,"" , $lftheme['content']);
		//										$lftheme['content'] .= "<div dir=ltr>[".$col['Field']."[".$Iobj."]]:".$row[$col['Field']]."</div>";
												};
											
		
											}
										else {
		
											// For Links
											$checkstring3=str_replace("<a href='[[".$col['Field']."]]" ,$lfadmin_row[$col['Field']]."<a  href='".$lfadmin_row2[$col['Field']] , $checkstring3);
											
											$checkstring3=str_replace("<a href=\"[[".$col['Field']."]]" ,$lfadmin_row[$col['Field']]."<a  href=\"".$lfadmin_row2[$col['Field']] , $checkstring3);
		
											// For Images
											$checkstring3=str_replace("<img src='[[".$col['Field']."]]" ,$lfadmin_row[$col['Field']]."<img src='".$lfadmin_row2[$col['Field']] , $checkstring3);
		
											$checkstring3=str_replace("<img src=\"[[".$col['Field']."]]" ,$lfadmin_row[$col['Field']]."<img src=\"".$lfadmin_row2[$col['Field']] , $checkstring3);
											
											// make some cleaning
											$checkstring3=str_replace("=[[".$col['Field']."]]" ,"=".$lfadmin_row2[$col['Field']] , $checkstring3);
		
											$checkstring3=str_replace("_[[".$col['Field']."]]" ,"_".$lfadmin_row2[$col['Field']] , $checkstring3);
											
											$checkstring3=str_replace("\"[[".$col['Field']."]]" ,"\"".$lfadmin_row2[$col['Field']] , $checkstring3);
		
											// Normal text
											$checkstring3=str_replace("[[".$col['Field']."]]" ,$lfadmin_row[$col['Field']].$lfadmin_row2[$col['Field']] , $checkstring3);
											};
		/*								};*/
	
									};
								$Iobj++;
								};
							if ($lfdefault[$i5."_recursive"]<>"") {
								
								};
							};
		
		
						if (!$row_is_empty) { // if stracture have been changed
							if ($completed=="") {
								$autocount = 0;
								};
							$autocount++;
							$checkstring3=str_replace("[AUTOCOUNT]",$autocount,$checkstring3);
							$completed .= $checkstring3;     // add the row to the site
							};                               // if not, it's means that there is no new row
							
						};
		
					if ($lfdefault[$i5.'_table']=="_session") { // If it is session
						if ($_SESSION<>"") {
							$completed = "";
							$checkstring4 = $checkstring3;
	
							foreach ($_SESSION as $idarray_name ) {
								
								foreach ($idarray_name as $array_name => $array_value) {
									;
									if ($array_value<>"") {
										foreach ($array_value as $final_array_name => $final_array_value) {
											
											$checkstring4 = str_replace("[[".$final_array_name."]]",$final_array_value, $checkstring4);
											};
										
										$completed .= $checkstring4;
										$checkstring4 = $checkstring3;
										};
									};
								};
		
							};	
						
						};
					
					// Adding the loop to the content
					$completed=str_replace("<!-- SL_".$i5." -->","",$completed); // For second loop
					$completed=str_replace("[ SL_".$i5." ]","",$completed); // For second loop
	
					$lftheme['content']=str_replace($checkstring2['0'],$completed,$lftheme['content']);

					// adding the loop to the cache system
					if ($loopcache=="yes") {
		//				$cached_content=$checkstring2['0'];$cached_result=$completed;
						$cached_result 	= str_replace("\\\\\"",'"',$completed);
						$cached_result 	= str_replace("\\\"",'"',$cached_result);
						$cached_result 	= str_replace("\"",'\\"',$cached_result);
						$cached_result	= str_replace("\\\\","\\",$cached_result);
						$cached_content	= str_replace("\\\\\"",'"',$checkstring2['0']);
						$cached_content	= str_replace("\\\"",'"',$cached_content);
						$cached_content = str_replace("\"",'\\"',$cached_content);
						$cached_content	= str_replace("\\\\","\\",$cached_content);
		//				$cached_result 	= str_replace("\t",'\\t"',$completed);
						$cookies="";$splt_cookies=split(",",$loopcache_cookies);
						foreach($splt_cookies as $cookiename) {
							$cookies .= "|".$cookiename."|".$_COOKIE[$cookiename];
							};
						
						file_put_contents("cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_".(md5($q.$cookies)).".php", "<?\n".
						"\$lfcached_content=\"".$cached_content."\";\n".
						"\$lfcached_result =\"".$cached_result."\";\n".
						"?>");
					
	
						$splitted_content2['1']="";
						$splitted_content2=split("<!-- START_LOOP_" . $i5 . " --\>" , $lftheme['content'] );
						if ($splitted_content2['1']<>"") {
							$splitted_content3 = split("<!-- END_LOOP_" . $i5 . " --\>" , $splitted_content2['1'] );
							$splitted_content3['0']=str_replace("\"","\\\"",$splitted_content3['0']);
							file_put_contents("cached/queries/".$lfdefault[$i5.'_table']."_".$_GET['content']."_".$i5."_s_".(md5($q.$cookies)).".php", "<?\n".
						"\$lfcached_loop=\"".$splitted_content3['0']."\";\n".
						"?>");
							};
						};
			};
	
	//			};
	
			$checkstring = "";
			$lftheme['content'] = str_replace("[START_LOOP_".$i5."]" , "" , $lftheme['content']);
			$lftheme['content'] = str_replace("[END_LOOP_".$i5."]" , "" , $lftheme['content']);
	
	
		// Making the [NEXT_#] Button
			$link="index.php?";
			
			if ($_oldGET<>"") {
				foreach($_oldGET as $varName => $value) { 
					$dv=/*htmlspecialchars*/ $value;
					$link .= '&amp;'./*htmlspecialchars*/($varName)."=".$dv;
					};
				};
	
			$link .="&amp;start_".$i5."=".($_GET['start_'.$i5]+$_GET['loops_'.$i5]);
			
			// Getting the number of rows
//			echo $q."<br />";
			$infoquery2=lfquery_cached(str_replace("LIMIT","# LIMIT",$q));
			$countsum=lf_num_rows($infoquery2);	
			if ($lfdefault[$i5.'_table']<>"_session") {	
				if ($countsum<>"") {
//					$countsum=lf_fetch_row($countsum);
//echo $countsum;
					}
				else {
					$countsum="0";
					};
				};
			if (!($_GET['start_'.$i5]+$_GET['loops_'.$i5]+1 > $countsum)) {
				$lftheme['content']=str_replace("[NEXT_".$i5."]","<a class=\"nextback\" href=\"".$link."\">[NEXT_".$i5."]</a>",$lftheme['content']);
				}
				else {
					$lftheme['content']=str_replace("[NEXT_".$i5."]","",$lftheme['content']);
				};
	
			// add page number
			$lftheme['content']=str_replace("[PAGE_".$i5."]",$countsum,$lftheme['content']);
			
		
			// Making the _BACK_ Button
			$link="index.php?";
	//		$bakGET['start']=$_GET['start_'.$i5];
			if ($_oldGET<>"") {
				foreach($_oldGET as $varName => $value) { 
					$dv=$value;
					$link .= '&amp;'./*htmlspecialchars*/($varName)."="./*htmlspecialchars*/($dv);
					};
				};

			$link .="&amp;start_".$i5."=".($_GET['start_'.$i5]-$_GET['loops_'.$i5]);
	//		echo $i5."<br>";
	//		echo ($_GET['start_'.$i5]-$_GET['loops_'.$i5])."<br>";
			if ((($_GET['start_'.$i5]-$_GET['loops_'.$i5]) >= 0))   {
				$lftheme['content']=str_replace("[BACK_".$i5."]","<a class=\"nextback\" href=\"".$link."\">[BACK_".$i5."]</a>",$lftheme['content']);
				}
				else {
					if ($_GET['start_'.$i5] <= "0") {
	
						$lftheme['content']=str_replace("[BACK_".$i5."]","",$lftheme['content']);
						};
					};
	
	
		
			// Show [PAGECOUNT_#] tag
			if (($_GET['start_'.$i5]+$_GET['loops_'.$i5])<=$countsum) {
				
				$lftheme['content']=str_replace("[PAGECOUNT_".$i5."]",($_GET['start_'.$i5]+1)."-".($_GET['start_'.$i5]+$_GET['loops_'.$i5]),$lftheme['content']);
				}
			else {
				
				$lftheme['content']=str_replace("[PAGECOUNT_".$i5."]",($_GET['start_'.$i5]+1)."-".$countsum,$lftheme['content']);
				};

	//echo $lftheme['content']."<div>-------------------------</div>";
				
			if ($recursive_loop<>"") {
				foreach ($recursive_loop AS $Rvalue => $Rname) {
					$Rquery = str_replace("[[".$lfdefault[$i5.'_multi']."]]" , $Rvalue, $lfdefault[$i5.'_recursive']);
					$Rlfq = lfquery_cached($Rquery);
					$Rresult = ""; $Rresult = lf_fetch_row($Rlfq);
	
					if (($i5<>"") 
					AND ($Rvalue<>"")
					AND ($Rresult['0']<>"")) {
						$loopII++;
						$table_name=$i5 . "_" . $Rvalue;
						$lfdefault[$loopII.'_name']	= $table_name;
						$lfdefault[$table_name.'_table']	= $lfdefault[$i5."_table"];
			//			echo $lfdefault[$i5."_table"];
						$lfdefault[$table_name.'_query']	= $Rquery;
	//				echo "<div dir=ltr>".$table_name.":".$Rquery."</div><hr />";
					$lfdefault[$table_name.'_recursive'] = $lfdefault[$lfdefault[$i."_name"] . '_recursive'];
	/*					$loopII++;
						$table_name=$i5 . "_" . $Rvalue;
	//					echo $table_name."<br />";
						
						$lfdefault[$loopII.'_name']	= $table_name;
						$lfdefault[$table_name.'_table']	= $lfdefault[$i5."_table"];
						$lfdefault[$table_name.'_query']	= $Rquery;*/
	//					$lfdefault[$table_name.'_recursive'] = $lfdefault[$i5."_recursive"];
	//					$lfdefault[$table_name.'_multi'] = $lfdefault[$i5.'_multi'];
	
	//				echo '<div dir=ltr>$lfdefault['.$table_name.'_table]= '.$lfdefault[$i5."_table"]."<br/>" .			'$lfdefault['.$table_name.'_query]	= '.$Rquery.					'<br />$lfdefault['.$table_name.'_recursive] = ' .$lfdefault[$i5."_recursive"].					'<br />$lfdefault['.$table_name.'_multi] = '.$lfdefault[$i5.'_multi']."</div><hr />";
						};
					};
				};
			$recursive_loop="";
			// finishing loop
			$i5++;
			$checkstring = split( "\[START_LOOP_".$i5."\]", $lftheme['content']);
	//echo "<div>".date("s")."</div>";
			};

		};

	};



/* ----------------------------------------------------- */
//[/LOOP]
/* ----------------------------------------------------- */
//print_r($recursive_table);
	


			// TAGS

		// session tags


	// ADDING session tags
	if ($_SESSION['lfarray']<>"") {
		foreach ($_SESSION as $session) {
			foreach ($session as $s1_name => $s1_value) {
				foreach ($s1_value as $s2_name => $s2_value) {
					$lftheme['content'] =str_replace("[SESSION_". $s1_name."_".$s2_name."]",$s2_value,$lftheme['content']);
					};
				};
			};
		};

	$step = 0; // help count every second number

	//	[SCOUNT_] - counts sum of _session
	if ($scount_sum<>"") {
		foreach ($scount_sum as $sum_name => $sum_value) {
			$lftheme['content'] = str_replace("[SCOUNT_".$sum_name."]", $sum_value, $lftheme['content']);
			};
		};
	//	[SARRAY_] - counts sum of _session
$s_icounter="0";
	if ($s_array<>"") {
		foreach ($s_array as $s_name => $s_value) {
			$lftheme['content'] = str_replace("[SARRAY_".$s_name."]", $s_value, $lftheme['content']);
			};
		};


//	$s_splitted = split(",",$s_array);

	// Making the [GET_###] addon
	foreach($_GET as $varName => $value) { 
		$lftheme['content'] = str_replace ("[GET_".$varName."]" , /*htmlspecialchars*/($value) , $lftheme['content']);
		};

	// Making the [POST_###] addon
		foreach($_POST as $varName => $value) { 
			$lftheme['content'] = str_replace ("[POST_".$varName."]" , /*htmlspecialchars*/($value) , $lftheme['content']);
			};

	// Making the [OPTIONPOST_###] addon
		foreach($_POST as $varName => $value) { 
			$lftheme['content'] = str_replace ("<!-- [OPTIONPOST_".$varName."] -->" , "<option>". /*htmlspecialchars*/($value) ."</option>" , $lftheme['content']);
			};

	// Making the [COOKIE_###] addon
		foreach($_COOKIE as $varName => $value) { 
			$lftheme['content'] = str_replace ("[COOKIE_".$varName."]" , /*htmlspecialchars*/($value) , $lftheme['content']);
			};

	include $lfpath."tags.php";

	// Making the [_GET_] addon
	$changed_get="";
	if ($_oldGET<>"") {
		foreach($_oldGET as $varName => $value) { 
			$dv=$value;
			$changed_get .= '&amp;'./*htmlspecialchars*/($varName)."=".$dv;
			};
		};

	$lftheme['content']=str_replace("[_GET_]", /*htmlspecialchars*/($changed_get) ,$lftheme['content']);
	include "system/ifs.php";

	// Adding lang support
	
/*	$i="1";
	while ($lang[$i]['change']<>"") {
		$lftheme['content'] = str_replace ($lang[$i]['change'] , $lang[$i]['to'] , $lftheme['content']);
		$i++;
		}
*/
	// Inserting default values into [POST] forms

	foreach ($_POST as $varName => $value) {
		// Change normal posts (name[POST])
		$lftheme['content'] = str_replace ("\"".$varName."[POST]\"" , "\"".$varName."\" value=\"".$value."\" " , $lftheme['content']);

		// Change textarea posts (</textarea><!--[name_TEXTPOST]-->)
		$lftheme['content'] = str_replace ("</textarea><!--[".$varName."_TEXTPOST]-->" , $value."</textarea>" , $lftheme['content']);
		
		// Change all Select posts (<!-- [name_SELECTPOST] -->)
		$lftheme['content'] = str_replace ("<!-- [".$varName."_SELECTPOST] -->" , "<option>".$value."</option>" , $lftheme['content']);

		};

// Inserting default values into [GET] forms

	foreach ($_GET as $varName => $value) {

		// Change normal posts (name[GET])
		$lftheme['content'] = str_replace ($varName."[GET]\"" , $varName."\" value=\"".$value."\" " , $lftheme['content']);

		};

	// Cleaning empty [GET]s
	$lftheme['content'] = str_replace ("[GET]" , "", $lftheme['content']);
	
	// Clearing un-needed [POST]s
	$lftheme['content'] = str_replace("[POST]","",$lftheme['content']);
	
	// Cleaning content from <!-- lftag --> and <!-- /lftag -->
	$lftheme['content'] = str_replace("<!-- lftag -->","",$lftheme['content']);
	$lftheme['content'] = str_replace("<!-- /lftag -->","",$lftheme['content']);

	// Adding the css file
	if ($lftheme['css_file']=="") {
//		$css_add = file_get_contents("parts/".$lftheme['default']."/".$lftheme['css_file']);
		$dir="parts";
		include "system/lf_filelist.php";
		$Ipart = 0;
		foreach ($lf_file as $fileNumber => $fileValue) {
			$css_add .= file_get_contents("parts/".$fileValue."/css.css");
			};
		$lftheme['content'] = str_replace("/*[CSS]*/",$css_add,$lftheme['content']);
		}
	else {
		$lftheme['content'] = str_replace("/*[CSS]*/",file_get_contents($lftheme['css_file']),$lftheme['content']);
			
		};

	// getinfo_tag
	$splitted_content=split("\[\{" ,$lftheme['content']);
	if ($splitted_content['1']<>"") {
		foreach ($splitted_content as $splitted_name => $splitted_value) {
			if ($splitted_name<>"0") {
				$final_tag = split("\}\]",$splitted_value);
				$tag_value = split("##",$final_tag['0']);
				$supervalue[$tag_value['0']] .= ",".$tag_value['1'];
				$tagshowed[$tag_value['0']] = "yes" ;
				};
			};
		};

	// cleaning get info tags
	if ($tagshowed<>"") {
		foreach ($tagshowed as $tag_name => $tag_value) {
				$lftheme['content'] = str_replace("[{".$tag_name."##","",$lftheme['content']);
				};
		};
	$lftheme['content'] =str_replace("}]","",$lftheme['content']);

	// Cleaning the empty values
	$lftheme['content'] =str_replace("NOT_EMPTY","",$lftheme['content']);

	// showing supertag	
	include $lfpath."system/lfsupertag.php";
	
//	print_r($supervalue);

	// Doing all if's on site


	//Cleaning unfinished loops and ifs
	$lftheme['content']=preg_replace('/\[IF_(.+?)_part\].+?\[END_IF_\1_part\]/s',"",$lftheme['content']);
//	$lftheme['content']=preg_replace('/\[IF_([^_]+)_part\].+?\[END_IF_\1_part\]   /s',"",$lftheme['content']);

	$lftheme['content']=preg_replace('/\[IF(_.+?)\].+?\[END_IF\1\]/s',"",$lftheme['content']);

	$lftheme['content']=str_replace("src=\"\"", "src=\"parts/empty/images/empty.gif\"",$lftheme['content']);
	$lftheme['content']=str_replace("src=''", "src=\"parts/empty/images/empty.gif\"",$lftheme['content']);
	$lftheme['content']=preg_replace('/\[\[.+?\]\]/s',"",$lftheme['content']);
	$lftheme['content']=preg_replace('/\[GET_.+?\]/s',"",$lftheme['content']);

	$lftheme['content']=preg_replace('/\[START_LOOP.+?\].+?\[END_LOOP.+?\]/s',"",$lftheme['content']);

	// Claning <!-- [STARTDEL] and [ENDDEL] ->
 	$lftheme['content']=preg_replace('/<\!-- \[STARTDEL\].+?\[ENDDEL\] -->/s',"",$lftheme['content']);
//	$lftheme['content']=preg_replace('/<\!-- CUT -->.+?<\!-- ENDCUT -->/s',"",$lftheme['content']);
	$lftheme['content'] =str_replace("[ENDDEL] -->","",$lftheme['content']);
	// showing [nextvalue_#_#_]
	if (preg_match('/<\!-- \[NEXTVALUE.+?/s',$lftheme['content'])) {
		if ($lfconf_shownext<>"") {
			foreach ($lfconf_shownext as $table => $field) {
				$q="SELECT `".$field."` FROM ".$table." WHERE `".$field."` LIKE '%' ORDER BY `". $lfconf_shownext_orderby[$table]."`";
				$query=lfquery_cached($q);
				if ($query<>"") {
					while ($result = lf_fetch_row($query)) {
						if ($old_result<>"") {
							$lftheme['content']=str_replace("[NEXTVALUE_" . $table . "_" . $field . "_".$old_result."]", $result['0'],$lftheme['content']);
							};
						$old_result=$result['0'];
						};
					$lftheme['content']=str_replace("[NEXTVALUE_" . $table . "_" . $field . "_".$old_result."]", $old_result+1,$lftheme['content']);
					};
				};
			};
		};
	// Adding lang support
	if ($_GET['skiplang']<>"yes") {
		$i="1";
		while ($lang[$i]['change']<>"") {
			$lftheme['content'] = str_replace ($lang[$i]['change'] , $lang[$i]['to'] , $lftheme['content']);
			$i++;
			}
		};

	// Making the [ORIGINAL_GET_###] addon
	foreach($_GET as $varName => $value) { 
		$lftheme['content'] = str_replace ("[ORIGINAL_GET_".$varName."]" , /*htmlspecialchars*/($value) , $lftheme['content']);
		};
	// final things to delete
	$lftheme['content']=str_replace("-del-","",$lftheme['content']);

		
	// Return site content	

	return $lftheme['content'];
	}

?>