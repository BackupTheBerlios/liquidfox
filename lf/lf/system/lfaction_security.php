<?
// Security
function secure($text){
	// Make sepcial chars a normal chars
	$text=htmlspecialchars($text);
	$text=str_replace("(","|<|",$text);
	$text=str_replace(")","|>|",$text);
//	$text=str_replace("'","|`|",$text);
	$text=str_replace("'","\`",$text);
	return $text;
	};

// Securing all GET vars
foreach($_GET as $varName => $value) { 
	$dv=$value;
 	$_GET[$varName] = secure($dv);
    	};

// Securing all POST vars
foreach($_POST as $varName => $value) { 
	$dv=$value;
 	$_POST[$varName] = secure($dv);
    	};

// Removing gets varibles for PHP4
foreach($_GET as $varName => $value) { 
 	unset($varName);
    	};

// End of security
?>