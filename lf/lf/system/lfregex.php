<?
$Ireg=0;

$Ireg++;
$regex_type[$Ireg]['name']  = "name";
$regex_type[$Ireg]['value'] = "^[a-zA-Z0-9_א-ת]{2,20}$^";

$Ireg++;
$regex_type[$Ireg]['name']  = "desc";
$regex_type[$Ireg]['value'] = "^.{20,3200}$^";

$Ireg++;
$regex_type[$Ireg]['name']  = "url";
$regex_type[$Ireg]['value'] = "^http:\/\/[\.a-zA-Z0-9]{5,30}\.[a-zA-Z0-9]{2,5}$^";

?>