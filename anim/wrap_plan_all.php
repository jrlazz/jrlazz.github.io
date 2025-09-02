<?php
$text=$_POST['text'];
$arq=$_POST['data2'];
#$output=wordwrap(str_replace("#","'",$text),60,"<br>");
$output=$text;
#$file=fopen('plan_all.txt','a');
$file=fopen($arq,'a');
$nome=$output;
fwrite($file,$nome.PHP_EOL);
fclose($file);
echo $output;
?>