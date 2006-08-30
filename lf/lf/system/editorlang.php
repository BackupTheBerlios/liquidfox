<?
if ($_GET['edit_level']<>"") {	

	$tmpname=str_replace(" ","",$lang[$langI]['change']);
	$lang2[$tmpname]=$lang[$langI]['to'];

//	$lang2[$lang[$langI]['change']]=$lang[$langI]['to'];
//	$langI++; 	$lang[$langI]['to']= $lang[$langI-1]['to'];

//	$langI++;


	$lang[$langI]['change']=htmlspecialchars($lang[$langI]['to']);
	$lang[$langI]['to'] = $lang[$langI]['change'];

//	$langI++; 	$lang[$langI]['to']= $lang[$langI-1]['change'];
//				$lang[$langI]['change']=$lang[$langI-1]['to'];




	
	}
?>