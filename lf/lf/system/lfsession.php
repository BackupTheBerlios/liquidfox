<?

$name  = split("," , $_GET['s_name']);
$value = split("," , $_GET['s_value']);
$id = $_GET['id'];

session_start();

if ($_GET['s_action'] == "delall") {
	foreach ($_SESSION['lfarray'] as $sname => $svalue) {
		session_unregister($sname);
		$_SESSION['lfarray'][$sname]="";
		};
	$_SESSION['lfarray']="";
	unset($_SESSION['lfarray']);
	}
elseif (($_GET['s_action'] == "del") AND ($id<>"")) {
	foreach ($name as $varname => $varvalue) {
		unset($_SESSION['lfarray'][$id]);
		};
	}
elseif ($_GET['s_action'] == "ins" AND ($id<>"")) {
	foreach ($name as $varname => $varvalue) {
		if ($_GET['add']==$varvalue) {
			$_SESSION['lfarray'][$id][$varvalue] += $value[$varname];
			}
		else {
			$_SESSION['lfarray'][$id][$varvalue] = $value[$varname];
			};
		};
	};

 header("Location: lfredirect.php?lfredirect=lfsession_" .str_replace(",","",$_GET['s_name']) ."&redirect=" . $_GET['redirect']);
?>