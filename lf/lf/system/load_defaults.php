<?php
// Changing name if needed
foreach($_GET as $name => $value) {
	if ($getname[$name]<>"") {
		$_GET[$getname[$name]] = $_GET[$name];
		};
	};

// Using default if varible have not been given
/* OLD 
if ($lfdefault<>"") {
	foreach($lfdefault as $varName2 => $value) { 
		if ((($lfdefault[$varName2]<>"") and ($_GET[$varName2]=="")) OR ($allowget[$varName2]<>"yes")) {
			$_GET[$varName2] = $lfdefault[$varName2];
			};
		};
	};
*/
if ($lfdefault<>"") {
	foreach($lfdefault as $varName2 => $value) {
		if ($_GET[$varName2]=="") {
			$_GET[$varName2] = $lfdefault[$varName2];
			};
		};
	};


?>