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

<title>tareb.php</title>

<!--
<script src="../js/console.min.js"></script>
-->

<link rel='shortcut icon' type='image/x-icon' href='http://jrlazz.eu5.org/html/boy.ico' />

<!-- https://icoconvert.com/ -->

<style>
body { background-color:#9aa;}
textarea { font-family:monospace;font-size:20px;font-weight:bold;background-color:#bcc;line-height:20px;overflow:auto;}
div { font-family:Arial;font-size:12px;font-weight:bold;padding:0px;color:#fff;}
button { font-family:Arial;font-size:12pt;font-weight:bold;background-color:#fc0;color:#900;width:80px;border-radius:4px;border:2px outset black;border-color:#fff #000 #000 #fff;}
button:active { background-color:#cf0;border:2px inset black;border-color:#000 #000 #fff #fff;}
img { width:40px;}
table { padding:0px;}
td { vertical-align:top;}
</style>

</head>

<body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["comments"])){$comments=$_POST["comments"];}
}
if($comments){file_put_contents("tosto.txt",$comments);};
?>
<center>
<input type="text" value="         ****         " id="myInput" style="width:3px;background-color:#9aa;border:0px;"></input>
<img onclick="myFunction();" src="aster_2.png"></img>&nbsp;&nbsp;&nbsp;
<img onclick="cima();" src="cima.png"></img>&nbsp;&nbsp;&nbsp;
<img onclick="baixo();" src="baixo.png"></img>
<br><br>
</center>
<form id="form_id" action="tareb.php" method="post">
<center>
<img onclick="manda();" src="save_button.png"></img>
<br>
<table><tr><td style="width:10px;"><div id="emtd" style="padding-top:2px;max-height:365px;overflow:hidden;text-align:right;line-height:20px;">1</div></td><td>
<textarea rows="18" cols="22" id="comments" name="comments" style="background-color:#cff;">
<?php
//if($comments){echo $comments;}
$lendo=file_get_contents("tosto.txt");
if(strlen($lendo)>0){echo $lendo;}
?>
</textarea>
</td></tr></table>
<br>
<img onclick="manda();" src="save_button.png"></img>
<br>
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
	window.location.href='tareb.php';
}

window.addEventListener("orientationchange", checkOrientation, false);

var el=document.querySelector('textarea');
var ol=document.querySelector('div');

function displayDate(){
	el=document.querySelector('textarea');
	ol=document.querySelector('div');
	ol.scrollTop=el.scrollTop;
}

var text=document.getElementById("comments").value;   
var lines=text.split(/\r|\r\n|\n/);
var count=lines.length;

function cima(){
el.scrollTop=0;
}

function baixo(){
el.scrollTop=count*20;
}

let udo="";
for(x=1;x<1000;x++){
udo=udo+x+"<br>";
}


//el.scrollTop = 36;

document.getElementById("emtd").innerHTML=udo; 

document.getElementById("comments").addEventListener("scroll", displayDate);

function myFunction() {
	var copyText = document.getElementById("myInput");
	copyText.select();
	copyText.setSelectionRange(0, 99999)
	document.execCommand("copy");
}

</script> 

</body>
</html>