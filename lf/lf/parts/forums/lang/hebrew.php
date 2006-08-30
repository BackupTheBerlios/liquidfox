<?
$langI++; 	$lang[$langI]['change']="פורום  <!-- curr -->";
			$lang[$langI]['to']="דף הפורומים הראשי";

$langI++; 	$lang[$langI]['change']="מיקום נוכחי:  <!-- curr -->";
			$lang[$langI]['to']="מיקום נוכחי: דף ראשי";

$langI++; 	$lang[$langI]['change']="<!-- 0comments --> תגובות";
			$lang[$langI]['to']="אין תגובות";

if ($_GET['lfupdate_id']<>"") {
$langI++; 	$lang[$langI]['change']="הוספת תגובה";
			$lang[$langI]['to']="עריכת תגובה";
	};

// for editor
	// red color
$langI++; 	$lang[$langI]['change']="^אדום ";
			$lang[$langI]['to']="<font color=\"red\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" אדום^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^ירוק ";
			$lang[$langI]['to']="<font color=\"green\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" ירוק^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^הדגש ";
			$lang[$langI]['to']="<font style=\"font-weight: bold\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" הדגש^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^קוקו ";
			$lang[$langI]['to']="<font style=\"text-decoration: underline;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" קוקו^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^קוחוצה ";
			$lang[$langI]['to']="<font style=\"text-decoration:  line-through;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" קוחוצה^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^קועליון ";
			$lang[$langI]['to']="<font style=\"text-decoration:  overline;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" קועליון^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^קונטוי ";
			$lang[$langI]['to']="<font style=\"font-style: italic;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" קונטוי^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^font_monospace ";
			$lang[$langI]['to']="<font style=\"font-family: monospace;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^font_monospace ";
			$lang[$langI]['to']="<font style=\"font-family: monospace;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^font_arial ";
			$lang[$langI]['to']="<font style=\"font-family: Helvetica,Arial,sans-serif;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^font_times ";
			$lang[$langI]['to']="<font style=\"font-family: Times New Roman,Times,serif;\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']="^font_courier ";
			$lang[$langI]['to']="<font style=\"font-family: Courier New,Courier,monospace\">";
			include "system/editorlang.php";

$langI++; 	$lang[$langI]['change']=" font^";
			$lang[$langI]['to']="</font>";
			include "system/editorlang.php";
// for text editor

			
?>