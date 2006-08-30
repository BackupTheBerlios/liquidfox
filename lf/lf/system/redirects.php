<?
$Iredirect="0";

$Iredirect++;
$lfredirect_set[$Iredirect]['name']	=	"chapters_chapName";
$lfredirect_set[$Iredirect]['url']		=
"index.php?content=book&where_book2=chapID";
$lfredirect_set[$Iredirect]['values']	=	"equal_book2,".$_GET['equal'];

$Iredirect++;
$lfredirect_set[$Iredirect]['name']	=	"chapters_subchapName";
$lfredirect_set[$Iredirect]['url']		=
"index.php?content=book&where_book2=chapID";
$lfredirect_set[$Iredirect]['values']	=	"equal_book2,".$_GET['equal'];

?>