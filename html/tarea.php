<!Doctype html>
<html>
<head>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
-->
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>tarea.php</title>

<!--
<script src="../js/console.min.js"></script>
-->

<link rel='shortcut icon' type='image/x-icon' href='http://jrlazz.eu5.org/html/jrl.ico' />

<!-- https://icoconvert.com/ -->

<style>
body { background-color:#abb;}
textarea {font-family:monospace;font-size:14pt;font-weight:bold;background-color:#bcc;}
button {font-family:Arial;font-size:12pt;font-weight:bold;background-color:#fc0;color:#900;width:80px;border-radius:4px;border:2px outset black;border-color:#fff #000 #000 #fff;}
button:active {background-color:#cf0;border:4px inset black;border-color:#000 #000 #fff #fff;}
</style>

</head>

<body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["comments"])){$comments=$_POST["comments"];}
}
if($comments){file_put_contents("tosto.txt",$comments);};
?>

<form id="form_id" action="tarea.php" method="post">
<center>
<button onclick="manda();" type="button">SAVE</button>
<br><br>
<textarea rows="18" cols="26" id="comments" name="comments" style="border:2px solid #00c;background-color:#cff;">
<?php
//if($comments){echo $comments;}
$lendo=file_get_contents("tosto.txt");
if(strlen($lendo)>0){echo $lendo;}
?>
</textarea>
<br><br>
<button onclick="manda();" type="button">SAVE</button>
<br><br>
</center>
</form>

<script>

function manda(){form_id.submit();}

var w=window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
//var h=window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
if(w>500){document.getElementById("comments").cols="40";}
//alert(w);

function checkOrientation(){
	w=window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	if(w>500){
		document.getElementById("comments").cols="40";
	} else {
		document.getElementById("comments").cols="26";
	}
	window.location.href='tarea.php';
}

window.addEventListener("orientationchange", checkOrientation, false);

</script> 

</body>
</html>