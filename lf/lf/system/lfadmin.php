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
<?
// fixing multiple table selections
$tempsplit=split("`,`",$_GET['table']);
$_GET['table']=$tempsplit['0'];
?>
<div align=center> You are now editing <b><? echo $_GET['field']?></b> from <b><? echo $_GET['table']?></b></div>
<a href="index.php">[back to site]</a><br>
<? include "config.php";
include "lfparts.php";
include $lfpath."includes/list_lfdb_files.php";



// Checking if nickname and password are ok according lfadmin
if (($_COOKIE[$lfadmin['nickname']['cookie']]==$lfadmin['nickname']['value']) 
AND ($_COOKIE[$lfadmin['password']['cookie']]==$lfadmin['password']['value'])) {

	// connecting to database
	include $lfpath."functions/lfdata_connect.php";
	$lf_connection =
	lfdata_connect($lfconf_db['host'],$lfconf_db['user'],$lfconf_db['pass'],$lfconf_db['db']);

	// loading posts
	if ($_POST['table']<> "") {
		$_GET['table'] = $_POST['table'] ;
		$_GET['id'] = $_POST['id_value'] ;
		$_GET['field'] = $_POST['field'] ;
		};
	
	// getting the id
	include $table_file[$_GET['table']];
	$q = "SELECT * FROM " . $_GET['table'] . " WHERE " . $dbid . " = '".$_GET['id']."'";
	$query = lfquery($q);
	$result = mysql_fetch_array($query);
	
	// Checking for action
	if ($_POST['do']=="edit") {
		$q2 = "UPDATE " . $_POST['table'] . " SET `" . $_POST['field'] . "` = '" . $_POST['value'] . "' WHERE " . $_POST['id_name'] . " = '".$_POST['id_value']."'";
		lfquery($q2);
		header('Location: index.php');
		}
	elseif ($_POST['do']=="del") {
		$q2 = "DELETE FROM `" . $_POST['table'] . "` WHERE " . $_POST['id_name'] . " = '".$_POST['id_value']."'";
		lfquery($q2);
		header('Location: index.php');
		};

	// Showing edit options
	 ?>
	<form enctype="multipart/form-data" action="lfadmin.php" method="post" id="artwork_form"
 target="_self">

	<input type=hidden name="table" value="<? echo $_GET['table']; ?>">
	<input type=hidden name="field" value="<? echo $_GET['field']; ?>">
	<input type=hidden name="do"    value="del">
	<input type=hidden name="id_name" value="<? echo $dbid; ?>">
	<input type=hidden name="id_value" value="<? echo $_GET['id']; ?>">	
	<div align=center><input type=submit value="delete row '<? echo $_GET['id']?>' from <? echo $_GET['table']?> (no way to undo!)"></div>
	</form>
	<br><div align=center> [edit] </div>

	<!-- Edit form -->
	<form enctype="multipart/form-data" action="lfadmin.php" method="post" id="artwork_form"
 target="_self">

	<textarea style="width: 100%;" name="value" rows=12><? echo $result[$_GET['field']]; ?></textarea><br>
	<input type=hidden name="table" value="<? echo $_GET['table']; ?>">
	<input type=hidden name="field" value="<? echo $_GET['field']; ?>">
	<input type=hidden name="do"    value="edit">
	<input type=hidden name="id_name" value="<? echo $dbid; ?>">
	<input type=hidden name="id_value" value="<? echo $_GET['id']; ?>">	
	<div align=center><input type=submit value=submit></div>
	</form>
<? }; 

?>
</body>
</html>