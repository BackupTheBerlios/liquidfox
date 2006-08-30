<?
function file_put_contents($file, $string) {
    $f=fopen($file, 'a+');
    ftruncate($f, 0);
    fwrite($f, $string);
    fclose($f);
 }
?>