<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Audio Many</title>
<style type="text/css">
@font-face {font-family:tipo;src:url('../fonte/Lato-Bold.ttf');}

body {font-family:tipo;background-color:#bcc;}
button {font-family:tipo; font-size:12pt; border:2px outset white;border-color:#fff #000 #000 #fff; padding:2px; padding-left:4px; padding-right:4px; background-color:#abb;color:#122;}
button:active {border:2px inset white;border-color:#000 #fff #fff #000;background-color:#fe9;color:#c00;}
</style>
</head>

<body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["qualurl"])){$qualurl=$_POST["qualurl"];}
}
// echo $qualurl;
?>

<form hidden id='form_id' action='maissom.php' method='post' style="position:absolute;left:416px;top:16px;width:16px;height:20px;background-color:#f00;">
	<input type='txt' id='qualurl' name='qualurl' value=<?php echo $qualurl; ?>>
</form>


<center>
<!--
<button onclick="abre(1);" type="button">som_1</button>
-->
<button onclick="abre(2);" type="button">Dois Sons</button>
<button onclick="abre(3);" type="button">Uma mp3</button>
<button onclick="abre(4);" type="button">Stream e mp3's</button>
<button onclick="abre(5);" type="button">Muitas Notas</button>
<button onclick="abre(6);" type="button">Piano</button>

<!--
<button type='button' onclick='finalizar();' name='butfin' class='btn-primary'>Reiniciar</button>
-->
<br>
<iframe id="ifra_1" src="audio_show.php" width="800" height="300" style="visibility:hidden;border:0px;"></iframe>
<iframe id="ifra_2" src="twosounds.html" width="840" height="600" style="visibility:hidden;border:0px;"></iframe>
<iframe id="ifra_3" src="onemp3.html" width="840" height="600" style="visibility:hidden;border:0px;"></iframe>
<iframe id="ifra_4" src="visu5.php" width="806" height="430" style="visibility:hidden;border:0px;"></iframe>
<iframe id="ifra_5" src="sobresom.html" width="1200" height="440" style="position:relative;visibility:hidden;border:0px solid blue;left:0px;top:10px;"></iframe>
<iframe id="ifra_6" src="horwood.html" width="1200" height="500" style="position:relative;visibility:hidden;border:2px solid blue;left:0px;top:-400px;"></iframe>

<script>
var elifra=document.getElementsByTagName("iframe");
var qtdifra=elifra.length;
//alert(qtdifra);
var strifra;

function abre(i){
	for(x=0;x<qtdifra;x++){
		strifra="ifra_"+parseInt(x+1);
		document.getElementById(strifra).style.visibility="hidden";
	}
	//strifra="ifra_"+i;
	//document.getElementById(strifra).style.visibility="visible";
	document.getElementById("qualurl").value=i;
	document.getElementById("form_id").submit();
}

function recarrega(){
window.location="maissom.php";
}

function finalizar(){
	document.getElementById("form_id").submit();
}

var wscreen=window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
var hscreen=window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
var wpos=(wscreen-800)/2;
document.write("<style>iframe {position:absolute;left:"+wpos+"px;top:50px;}</style>");




strifra="ifra_"+"<?php echo $qualurl; ?>";
document.getElementById(strifra).style.visibility="visible";


</script>

</center>

<button type="button" title="Reiniciar" alt="Reiniciar" style="position:absolute;left:16px;top:16px;width:16px;height:20px;background-color:#f00;" onclick="recarrega();"></button>

</body>
</html>