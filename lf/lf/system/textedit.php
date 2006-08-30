<?

if ($_GET['textarea']=="") {
	$_GET['textarea'] = $_SESSION['textarea'];
	};

if ($_SESSION['original_textarea']=="") {
	$_SESSION['original_textarea'] = $_SESSION['textarea'];
	};

	if ($_GET['textedit']=="yes") {
		if ($_GET['operation']=='load_original') {
			$_SESSION['textarea'] = $_SESSION['original_textarea'];
			};
		if ($_GET['operation']=='zero') {
			$_SESSION['textarea'] = "";
			};
		if ($_GET['textarea_tosave']<>"") {
			$_GET['textarea']	=	$_GET['textarea_tosave'];
			$_SESSION['textarea']	=	$_GET['textarea_tosave'];
			};
		};

	if ($_GET['content']=="textedit") {
		foreach ($_POST as $Pname => $Pvalue) {
			$_POST[$Pname] = str_replace("\n","<br/>",$_POST[$Pname]);
			};
		};

	if ($_GET['content']=="textedit_content") {
		foreach ($_GET as $Pname => $Pvalue) {
			$_GET[$Pname] = str_replace("\n"," <br/>",$_GET[$Pname]);
			$_GET[$Pname] = str_replace("|b|"," <br/>",$_GET[$Pname]);
			$_GET[$Pname] = str_replace("&lt;br/&gt;"," <br/>",$_GET[$Pname]);
			};

		if ($_GET['edit_level']=="") {
				if ($_GET['closetag']<>"") {
					include "parts/forums/lang/hebrew.php";

					$_GET['textarea']=$_SESSION['textarea'];

					$splitted_textarea = split(" ",$_GET['textarea']);		
					$_GET['textarea']="";												
					$Icount="0";

					$countTo=count($splitted_textarea);
					while ($Icount<$countTo) {
									if ($lang2[$splitted_textarea[$Icount]]<>"") {
											$splitted_textarea2[$Icount]=$lang2[$splitted_textarea[$Icount]];
											$_GET['textarea'] .= $splitted_textarea2[$Icount];
											}
							else {
								$splitted_textarea2[$Icount]=$splitted_textarea[$Icount];
								};
		
							if ($splitted_textarea2[$Icount]<>"") {
										if ($wordCounter[$splitted_textarea[$Icount]]=="") {
												$wordCounter[$splitted_textarea[$Icount]]="0";
												};
												$wordCounter[$splitted_textarea[$Icount]]++;
		//echo $splitted_textarea[$Icount];
											if (($splitted_textarea[$Icount]==$_GET['startword'])
											AND ($_GET['startnum']==$wordCounter[$splitted_textarea[$Icount]])) {
		
												$splitted_textarea2[$Icount] = "◄".$splitted_textarea[$Icount];

												};

											if (($splitted_textarea[$Icount]==$_GET['endword'])
											AND ($_GET['endnum']==$wordCounter[$splitted_textarea[$Icount]])) {
		
												$splitted_textarea2[$Icount] .= "■";
												};

								$_GET['textarea'].=$splitted_textarea2[$Icount]." ";

								};
						$Icount++;
						};
		
		
									
									$_GET['opentag']=str_replace("__"," ",$_GET['opentag']);
									$_GET['opentag']=str_replace("_-_","+",$_GET['opentag']);
									$_GET['closetag']=str_replace("_-_","+",$_GET['closetag']);
									$_GET['closetag']=str_replace("~DEL~","",$_GET['closetag']);
									$_GET['closetag']=str_replace("__"," ",$_GET['closetag']);
									$_GET['textarea']=str_replace("◄"," ".$_GET['opentag']." " ,$_GET['textarea']);
									$_GET['textarea']=str_replace("■", " ".$_GET['closetag'] . " ",$_GET['textarea']);
									$_GET['textarea']=str_replace("\n", "<br/>",$_GET['textarea']);
									$_SESSION['textarea']=$_GET['textarea'];
									};
					};

			if ($_GET['textedit']=="yes") {
				
				$_GET['textarea_txt']=$_SESSION['textarea'];
				$_GET['textarea_txt']=str_replace("<br/>","\n",$_GET['textarea_txt']);
				include "parts/forums/lang/hebrew.php";
				$_GET['skiplang']="yes";
				};
			};
			
		if ($_GET['edit_level']=="2") {
							// for lnag
							include "parts/forums/lang/hebrew.php";
/*							$_GET['textarea'] = str_replace(" <br/>","<br/>",$_GET['textarea']);
							$_GET['textarea'] = str_replace(" <br/>","<br/>",$_GET['textarea']);
							$_GET['textarea'] = str_replace("<br/>","<br/> ",$_GET['textarea']);*/
//							$_GET['textarea'] = " ".$_GET['textarea'];
							$designed_textarea=$_GET['textarea'];
//							$_SESSION['textarea']=$_GET['textarea'];;

							$splitted_textarea = split(" ",$designed_textarea);		
//							print_r(						$splitted_textarea);
							$_GET['textarea']="";
							$Icount="0";
							$countTo=count($splitted_textarea);
							while ($Icount<$countTo) {
								// showing lang

								if ($splitted_textarea[$Icount]<>"") {

									if ($wordCounter[$splitted_textarea[$Icount]]=="") {
										$wordCounter[$splitted_textarea[$Icount]]="0";
										};
									$wordCounter[$splitted_textarea[$Icount]]++;
									if ($lang2[$splitted_textarea[$Icount]]<>"") {
										$splitted_textarea2[$Icount]=$lang2[$splitted_textarea[$Icount]];
										$_GET['textarea'] .= " ".$splitted_textarea2[$Icount];
										}
									else {
										$splitted_textarea2[$Icount]=$splitted_textarea[$Icount];
										if ($splitted_textarea2[$Icount]<>"") {
											$_GET['textarea'] .= "<a class=\"b2r\" href=\"index.php?edit_level=3&amp;content=textedit_content&amp;nomain=yes&amp;startword=".$splitted_textarea[$Icount]."&amp;startnum=".$wordCounter[$splitted_textarea[$Icount]]."&amp;opentag=".$_GET['opentag']."&amp;closetag=".$_GET['closetag']."&amp;action_name=".$_GET['action_name']."\">".$splitted_textarea2[$Icount]."</a> \n";
											};
										}
									};
								$Icount++;
								};
							$_GET['textarea3']=$_GET['textarea'];
							$_SESSION['textarea2']=$_GET['textarea'];;
							};
		if ($_GET['edit_level']=="3") {

			include "parts/forums/lang/hebrew.php";
			$_GET['textarea']=$_SESSION['textarea'];
			$_GET['textarea'] = str_replace("\n"," <br/>",$_GET[$Pname]);
			$splitted_textarea = split(" ",$_GET['textarea']);		
			$_GET['textarea']="";												
			$Icount="0";
			$countTo=count($splitted_textarea);
			while ($Icount<$countTo) {
				
//echo $splitted_textarea[$Icount]."<br />";
							if ($lang2[$splitted_textarea[$Icount]]<>"") {
									$splitted_textarea2[$Icount]=$lang2[$splitted_textarea[$Icount]];

									$_GET['textarea'] .= $splitted_textarea2[$Icount];
									}
					else {
						$splitted_textarea2[$Icount]=$splitted_textarea[$Icount];
						};

					if ($splitted_textarea2[$Icount]<>"") {
								if ($wordCounter[$splitted_textarea[$Icount]]=="") {
										$wordCounter[$splitted_textarea[$Icount]]="0";
										};
										$wordCounter[$splitted_textarea[$Icount]]++;
//echo $splitted_textarea[$Icount];
							
									if (($splitted_textarea[$Icount]==$_GET['startword'])
									AND ($_GET['startnum']==$wordCounter[$splitted_textarea[$Icount]])) {
										$splitted_textarea2[$Icount] = "◄".$splitted_textarea[$Icount];

										};
/*						$content="";
						for ($I=0;$I<=$Icount;$I++) {
							$content .= " ".$splitted_textarea[$I];
							};

						$content = $content."■";
						for ($I2=$I;$I2<=$countTo;$I2++) {
							$content .= ($splitted_textarea[$I2]." ");
							};
*/
//echo "<textarea>".$content."</textarea>";
						//checking if was a ◄

						if (preg_match('/◄/s',$splitted_textarea2[$Icount])) {
							$start_showing="ok";

							};

						if (($start_showing=="ok") OR ($_GET['nostart']=="yes")) {
							$_GET['textarea'] .= "<a class=\"b2r\" href=\"index.php?content=textedit_content&nomain=yes&startword=".$_GET['startword']."&startnum=".$_GET['startnum']."&endnum=".$wordCounter[$splitted_textarea[$Icount]]."&endword=".$splitted_textarea[$Icount]."&opentag=".$_GET['original_opentag']."&closetag=".$_GET['closetag']."&action_name=[GET_action_name]\" >".$splitted_textarea2[$Icount]."</a> \n";
							}
						else {
							$_GET['textarea'] .= $splitted_textarea2[$Icount]." ";
							if ($start_showing=="next") {
								$start_showing="ok";
								};
							};
						};
				$Icount++;
				};
			};


?>