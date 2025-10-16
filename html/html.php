<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta charset="utf-8" /> 

<title>escrevendo uma página html</title>

<style>
@font-face {font-family:tipo;src:url('../fonte/Lato-Bold.ttf');}
body { margin:16px; margin-top:16px; font-family:tipo; font-size:16pt; background-color:#ccc;}
span { font-family:tipo; font-size:14pt;}
select {border:1px solid #c00; font-size:14pt;}
button {border:2px outset #fff; border-color: #fff #000 #000 #fff; font-family:tipo; font-size:12pt;}
button:active {border-style:inset; border-color: #000 #fff #fff #000;}
textarea {padding:8px; border:}
table { width:80%;}
td { width:40%; vertical-align:top;}

</style>

<script src="../js/console.min.js"></script>

</head>

<body>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST["comments"])){$comments=$_POST["comments"];}
}
//echo $comments;
?>

<center>


Na caixa azul claro abaixo vamos começar a escrever uma 
página que possa ser vista na Internet...
<br>
<span style="font-size:12pt;color:#c00;">Após escrever algo, clique em </span><span style="font-size:10pt;border-radius:4px;background-color:#fc0;border:1px outset #c00;padding:2px;">&nbsp;Enviar para o Meu Browser&nbsp;</span>&nbsp;...
<br>
<br>
<table><tr>
<!-- TR1 TD 1 -->
<td>
<center>
<span style="color:#009;">Minha Página</span><br>
<form id="form_id" action="html.php" method="post">
<textarea cols="60" rows="16" id="comments" name="comments" style="border:2px solid #00c;background-color:#cff;">
<?php
echo $comments;
?>
</textarea><br>
<button onclick="manda();" type="button" name="id" style="font-size:14pt;background-color:#fc0;color:#900;width:400px;border-radius:8px;">Enviar para o Meu Browser</button>
</form>
<!--
<textarea id="tarea" cols="40" rows="4">
<?php
echo $comments;
?>
</textarea>
<br>
<button onclick="copia();" type="button" name="id" name="button">Copiar para a caixa de entrada</button>
-->
</center>
</td>


<!-- TR1 TD 2 -->
<td>
<center>
<span style="color:#090;">Meu Browser</span><br>
<iframe id="ifra" src="iframe_01.php" width="100%" height="300" style="border:2px solid #0c0;background-color:#fff;"></iframe>
</center>
</td>



</tr></table>


<br>
<button onclick="carrega(1);" type="button"> Exemplo 1 </button>&nbsp;&nbsp;&nbsp;&nbsp;
<button onclick="carrega(2);" type="button"> Exemplo 2 </button>&nbsp;&nbsp;&nbsp;&nbsp;
<button onclick="carrega(3);" type="button"> Exemplo 3 </button>&nbsp;&nbsp;&nbsp;&nbsp;
<button onclick="carrega(4);" type="button"> Exemplo 4 </button><br>
<span style="font-size:10pt;color:#c00;">Após clicar num exemplo, clique em </span><span style="font-size:8pt;border-radius:4px;background-color:#fc0;border:1px outset #c00;padding:2px;">&nbsp;Enviar para o Meu Browser&nbsp;</span>
<br>
<br>

<textarea hidden id="tarea1" cols="80" rows="4" style="font-size:9pt;">
Olá<br>
Meus Amigos da Escolinha
<h1>Olá (muito grande)</h1>
<img onclick="alerta();" src="girl_p.png"></img>
<h2>Olá (grande)</h2>
<img src="grupo_p.png"></img>
<h3>Olá (médio)</h3>
<img src="boy_p.png"></img>
<h4>Olá (menor)</h4>
<img src="regras.png"></img>
<h5>Olá (pequeno)</h5>
<script>
function alerta(){
alert("Você clicou na figura da menina!");
}
</script>
</textarea>


<?php
//$comments=$_POST['comments'];
?>

<?php
//echo file_put_contents("teste.txt",$comments);
file_put_contents("teste.txt",$comments);
?>

</center>

<script>
function copia(){
	document.getElementById("comments").value=document.getElementById("tarea").value;
}

function manda(){
//	document.getElementById("tarea").innerHTML=document.getElementById("comments").value;
	form_id.submit();
}

var exemplo=[];

exemplo[1]="Olá eu sou eu<br>Olá<br>eu<br>sou<br>eu<hr>";
exemplo[2]="Escreva aqui alguma palavra e clique em Enviar para o Meu Browser";
exemplo[3]="<h1>Quase</h1> ficou grandão!!!";
exemplo[4]=document.getElementById("tarea1").value;

function carrega(ex){
	document.getElementById("comments").value=exemplo[ex];
//	if(ex==2){document.getElementById("comments").value=exemplo02;}
}

function recarrega(){
window.location="html.php";
}

document.getElementById("ifra").height=4+document.getElementById("comments").rows*17;

</script> 


<button type="button" title="Reiniciar" alt="Reiniciar" style="position:absolute;left:16px;top:16px;width:16px;height:20px;background-color:#f00;" onclick="recarrega();"></button>

HTML é abreviação da expressão inglesa HyperText Markup Language, que significa Linguagem de Marcação de Hipertexto
<br>
Clicando no botão Exemplo 1...<br>
A sequência de símbolos e letras <span style="color:#900;font-size:20pt;"> < b r > </span> faz pular a linha!!!
<br>
A sequência de símbolos e letras <span style="color:#900;font-size:20pt;"> < h r > </span> traça uma linha!!!
<br>
Esses comandos da linguagem html são as "marcações de texto", tornam o texto um "hipertexto", ou texto com marcas que modificam a apresentação!!!
<br>
<br>
O Exemplo 4 é mais complexo. Pois a linguagem html tem uma prima chamada "script".
<br>
Ela precisa da prima para que os comandos de mouse possam funcionar.
<br>
Se Você clicar na imagem da menina... aparecerá um alerta na tela!!!
<br>
<br>
No Exemplo 3, observe que se Você colocar a sequência de símbolos e letras <span style="color:#900;font-size:20pt;"> < h 1 > </span> antes de uma palavra, 
e a sequência <span style="color:#900;font-size:20pt;"> < / h 1 > </span> depois dela, a palavra ficará escrita com 
letras MUITO GRANDES, e o restante do texto irá para uma nova linha.
<br>
<br>
<center><img src="regras.png"></img></center>
<br>
<br>
</body>
</html>