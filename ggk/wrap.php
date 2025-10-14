<?php
$text=$_POST['text'];
$output=wordwrap(str_replace("#","'",$text),60,"<br>");
$file=fopen('3ds.txt','a');
$nome=$output;
fwrite($file,$nome.PHP_EOL);
fclose($file);
echo $output;
?>