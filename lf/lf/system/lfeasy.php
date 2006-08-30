<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>Administrator</title>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        theme_advanced_buttons3_add_before : "tablecontrols,separator"
});
</script>
</head>
<body style="direction: ltr; font-family: arial">
<a href="index.php" style="font-size:8px">[back to site]</a><br>
<div align=center>
<div align=center style="font-size: 32;">- <font color=red>L</font>iquid <font color=red>F</font>ox Easy -</div>
<div align=center style="font-size:6px">Administrator system panel</div><br>
<form method="post" action="lfeasy.php" name="bychar">
<? include "config.php";


// Checking if nickname and password are ok according lfadmin
if (($_COOKIE[$lfadmin['nickname']['cookie']]==$lfadmin['nickname']['value']) 
AND ($_COOKIE[$lfadmin['password']['cookie']]==$lfadmin['password']['value'])) {
	// including regex vars and file types
	include $lfpath."lfregex.php";
	include $lfpath."lf_filetypes.php";
	include "lfparts.php"; // For Parts list
	// Shoing messages if there are any
	if ($_GET['msg']=="mysql2lfdb") {
		echo "Table files created succesfully...<br>";
		};
	// Shoing main menu if no action selected
	if (($_GET['action']=="") AND ($_POST['action']=="")) {
		echo '
		<a href="lfeasy.php?action=create_table">'.	'Create table'.		'</a><br>
		<a href="lfeasy.php?action=edit_table">'.	'Edit table'.		'</a><br>
		<a href="mysql2lfdb.php">'.			'Use existing tables'.	'</a><br>
		<a href="lfeasy.php?action=create_action">'.	'Create action'.	'</a><br>
		<a href="lfeasy.php?action=edit_action">'.	'Edit action'.		'</a><br>
		';
		}
			//----------------------------------------------//
				   // Create Action Form //
			//----------------------------------------------//

	elseif ($_GET['action']=="create_action") {
		// If there is no selected table, make a table list
		if ($_GET['table'] == "") {
			echo "<b>Please select a table to make a action for:</b><br>";
			// Getting table list
			$dir="lfdb";
			include $lfpath."includes/lf_filelist.php"; 
			foreach ($lf_file as $filename) {
				$tablename = str_replace(".php","",$filename);
				echo "<a href=\"lfeasy.php?action=create_action&table=".$tablename."\">".$tablename."<br>";
				};
			}
		// If a table were selected
		else {
			// Getting information about the table
			include "lfdb/".$_GET['table'].".php";
			// shoing table name
			echo "Making a new action for table '<b><font color=blue>".$_GET['table']."</font></b>'<br>";
			// Showing ID
			if ($dbid<>"") {
				echo "This table ID is '<b><font color=blue>".$dbid."</font></b>'<br><br>";
				}
			else {
				echo "This table have no ID<br><br>";
				};
						
			// Select action type name and part
			echo "<div align=center>action type:	
				<select name=\"action_type\">
				<option value=add >	Add Content	</option>
				<option value=check >	Check Content	</option>
				</select> 
				&nbsp;&nbsp;&nbsp;&nbsp;
				Action Name: <input name=name>
				&nbsp;&nbsp;&nbsp;&nbsp;
				Action Part: <select name=part>";
				foreach ($lfpart as $part) {
					echo "<option>" . $part . "</option>";
					};
				echo "</select>
				</div>";
			echo "<div style=\"height:5px;\"></div>";
			
			// Creating the action maker form
			echo '<table width="100%" border=1 cellpadding="2" cellspacing="0">';
			echo "	<tr>
				<td align=center width=1 > Use 		</td>
				<td align=center width=1 > Field name and value	</td>
				<td align=center width=1 > Doubles And Cookies	</td>
				<td align=center > Type and link	</td>
				<td align=center > For File Type	</td>";
			echo "</tr>";

			foreach ($db as $lfdb) {
				echo "<tr>";
				// Use column
				echo "<td style=\"width:25px;\" align=center >";
				echo "<input name=\"use~".$lfdb['name']."\" type=\"checkbox\">";
				echo "</td>";

				// Name column
				echo "<td valign=top >";
				echo "<div style=\"font-size:28px;\">" . $lfdb['name'] . "</div>";
					// Regex 
				echo "<br>Value check: <select name=\"regex~".$lfdb['name'] ."\">";
				foreach($regex_type as $regex) {
					echo "<option value=\"".$regex['value']."\">";
					echo $regex['name'];
					echo "</option>";
					};
				echo "</select><div style=\"height:5px;\"></div>";
				echo "Static value:
				<select name=\"value_type~".$lfdb['name']."\">
				<option value=none>".	"None"		."</option>
				<option value=text>".	"Text"		."</option>
				<option value=cookie>".	"Cookie"	."</option>
				<option value=date>".	"This date"	."</option>
				</select><br><div style=\"height:5px;\"></div>
				Text/Cookie: <input name=\"textcookie~".$lfdb['name']."\">
				";
				echo "</td>";

				// ID column
				echo "<td  align=center valign=top ><br>";
				echo "<input name=\"id~".$lfdb['name']."\" type=\"checkbox\"> No doubles<br><br>";
				// Save column
				
				echo "<input name=\"save~".$lfdb['name']."\" type=\"checkbox\"> Save Cookie";
				echo "</td>";

				// Type column
				echo "<td  align=center valign=top >
				<div style=\"height:5px;\"></div>";
				echo "<select name=\"type~".$lfdb['name'] ."\">
				<option value=text >
				A normal text
				</option>

				<option value=file >	
				File Upload
				</option>

				<option value=mail>	
				Mail Adress
				</option>

				<option value=md5 >	
				Convert to md5
				</option>

				</select>
<br><br>
				<select name=\"type2~".$lfdb['name'] ."\">
				<option value=normal >
				Normal type
				</option>
				<option value=equal >
				Double check
				</option>

				<option value=other >
				Other check field
				</option>

				</select>
				<br><br>";
//				 Linked to:<br>";
				
//				echo "<select name=\"linked~".$lfdb['name'] ."\">";
//				echo "<option>None</option>";
//				foreach ($db as $lfdb_temp) {
//					echo "<option>".$lfdb_temp['name']."</option>";
//					};

//				echo "</select><br><br>
//				Extra check field:<br><input name=\"\">
				echo 	"</td>";

				// File type column
				echo "<td style=\"width:205px;\" align=left >";
					// Can Be Empty
				echo "<input name=\"filemt~".$lfdb['name']."\" type=\"checkbox\"> Can be empty<br>";
				echo "<div style=\"height:5px;\"></div>";
					// File Type
				echo "File-Type: ";
				echo "<select name=\"regex~".$lfdb['name'] ."\">";
				foreach($lf_filetype as $filetype) {
					echo "<option value=\"".$filetype['value']."\">";
					echo $filetype['name'];
					echo "</option>";
					};
				echo "</select><br>";
				echo "<div style=\"height:5px;\" ></div>";
					// Maximum size
				echo "max: <input size=12 name=\"max~".$lfdb['name']."\"> kb<br>";
				echo "<div style=\"height:5px;\"></div>";
					// upload directory
				echo 'upload to:<input name="upload_dir~'.$lfdb['name'].'" style="width:100px" value="uploads"><br>';
					// add id to name
				echo "<div style=\"height:5px;\"></div>";
				echo "<input name=\"addid~".$lfdb['name']."\" type=\"checkbox\"> Add text to File name<br>";
				echo "<div align=right>From:";
				echo "<select name=\"add_from~".$lfdb['name'] ."\">";
				foreach ($db as $lfdb_temp) {
					echo "<option>".$lfdb_temp['name']."</option>";
					};

				echo "</select></div></td>";

				echo "</td>";
				// end of row
				echo "<td >";
				echo "</td>";
				echo "</tr>";
				}
			echo '</table>';
			echo "<input type=hidden name=table value=".$_GET['table'].">";
			echo "<input type=hidden name=action value=create_action>";
			echo "<input type=submit style=\"width:100%;\"> </form>";
			// Showing a list of regex types
			echo "<div align=left>";
			echo "Regex Types list:<br>";
			foreach($regex_type as $regex) {
				echo "<font color=red>" . $regex['name'] . "</font> - <font color=green>".$regex['value']."</font><br>";
				};
			echo "</div>";
			
			};
		};
			//----------------------------------------------//
				   // Creating Action...  //
			//----------------------------------------------//
		
		if ($_POST['action']=="create_action") {
			// Building lfaction file ($afile)
			$afile = "<?\n";

				// Table name
			$afile .= '$lfaction[\'table\']		= "'.$_POST['table'].'";' . "\n";
				// Action type
			$afile .= '$lfaction[\'action\']		= "' . $_POST['action_type'] . '";'."\n";

				// Doubles checkers
			include "lfdb/".$_POST['table'].".php";
			$idcounter = 0;
			foreach ($db as $lfdb) {
				if  ($_POST['id~'.$lfdb['name']]<>"") {
					$idcounter++;
					$afile .= '$lfaction[\'second_id\'][\''.$idcounter.'\']	= "'.$lfdb['name'].'";'."\n";
					};
				};
				// Field type
			foreach ($db as $lfdb) {
				if  ($_POST['use~'.$lfdb['name']]<>"") {
					$afile .= '$lfaction_type[\''.$lfdb['name'].'\'] = "'.$_POST['type~'.$lfdb['name']].'";'."\n";

					if ($_POST['type2~'.$lfdb['name']]=="equal") {
						$afile .= '$lfaction_type[\''.$lfdb['name'].'_equal\'] = "equal";'."\n";
						$afile .= '$lfaction_linked[\''.$lfdb['name'].'_equal\'] = "'.$lfdb['name'].'";'."\n";
						};
					if ($_POST['type2~'.$lfdb['name']]=="other") {
						$afile .= '$lfaction_type[\'other_'.$lfdb['name'].'\'] = "other";'."\n";
						$afile .= '$lfaction_linked[\'other_'.$lfdb['name'].'\'] = "'.$lfdb['name'].'";'."\n";
						};
					};
				};

				// End of file
			$afile .= "?>";

 			echo "<textarea style=\"width:100%\" rows=10>".$afile."</textarea>";
			};
	};
?>
</div>
</body>
</html>