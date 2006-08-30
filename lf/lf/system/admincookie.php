<?
include "config.php";
if (($_POST['nickname']==$lfadmin['nickname']['value']) 
AND (md5($_POST['password'])==$lfadmin['password']['value'])) {
	$msg = "login succesfully done";
	setcookie($lfadmin['nickname']['cookie'],$_POST['nickname']);
	setcookie($lfadmin['password']['cookie'],md5($_POST['password']));
	}
else {
	$msg = "login error";
	};
header("Location: index.php");
?>