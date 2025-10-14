<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Muitos Sons</title>
<style type="text/css">
@font-face {font-family:tipo;src:url('../fonte/Lato-Bold.ttf');}

body {font-family:tipo;background-color:#bcc;}
button {font-family:tipo; font-size:12pt; border:2px outset white;border-color:#fff #000 #000 #fff; padding:2px; padding-left:4px; padding-right:4px; background-color:#abb;color:#122;}
button:active {border:2px inset white;border-color:#000 #fff #fff #000;background-color:#fe9;color:#c00;}
</style>
</head>

<body>
<center>

<button onclick="abre(1);" type="button">Dois Sons</button>
<button onclick="abre(2);" type="button">Uma mp3</button>
<button onclick="abre(3);" type="button">Stream e mp3's</button>
<button onclick="abre(4);" type="button">Muitas Notas</button>
<button onclick="abre(5);" type="button">Piano</button>
<br>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["qualurl"])){$qualurl=$_POST["qualurl"];}
}

// echo "josé".$qualurl."<br>";

$ar=array();
$arwidth=array();
$arheigth=array();

$ar[1]="twosounds.html";$arwidth[1]=840;$arheigth[1]=600;
$ar[2]="onemp3.html";$arwidth[2]=840;$arheigth[2]=600;
$ar[3]="visu5.php";$arwidth[3]=806;$arheigth[3]=430;
$ar[4]="sobresom.html";$arwidth[4]=1200;$arheigth[4]=440;
$ar[5]="horwood.html";$arwidth[5]=1200;$arheigth[5]=600;

if($qualurl){
	echo "<iframe src=".$ar[$qualurl]." width=".$arwidth[$qualurl]." height=".$arheigth[$qualurl]." style='border:0px;'></iframe>";
} else {
echo "<br><br><img src='samick_s.jpg' style='border:12px inset gold;'></img>";
}

?>

<form hidden id='form_id' action='maissom.php' method='post' style="position:absolute;left:416px;top:16px;width:16px;height:20px;background-color:#f00;">
	<input type='txt' id='qualurl' name='qualurl' value=<?php echo $qualurl; ?>>
</form>

<script>

function abre(i){
	document.getElementById("qualurl").value=i;
	document.getElementById("form_id").submit();
}

function recarrega(){
	window.location="maissom.php";
}

</script>

</center>

<button type="button" title="Reiniciar" alt="Reiniciar" style="position:absolute;left:8px;top:8px;width:20px;height:20px;background-color:#f00;" onclick="recarrega();"></button>

</body>
</html>