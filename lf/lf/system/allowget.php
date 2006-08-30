<?
foreach ($_GET as $varName => $varValue) {
	if ($allowget[$varName]=="") {
		$_GET[$varName]="";
		};
	};
?>