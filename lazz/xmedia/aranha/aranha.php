<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title><title>* Tunin * /tunin/aranha/brin.html</title>
<!-- Autor: Jos&#233; Roberto Lazzareschi-->
<!-- XMEDIA-->

<script src="../../../js/wavesurfer.min.js"></script>
<script src="../../../js/app.js"></script>

<style>
body {font-size:12pt;}
input  {opacity:.8; filter: invert(48%) sepia(98%) saturate(2378%) hue-rotate(87deg) brightness(123%) contrast(125%);}
td {padding:0px; border:0px;}
a {text-decoration:none;}
img {position:relative;}
button {font-size:4pt; background-color:transparent; border:0px;}
</style>

</head>

<body background="f_ar1.gif">
<br>
<center>

<img src="t1.png">

<br>

<font face=arial color="#FF0000">
<h1>Cuidado! / Take Care!</h1>
</font>

<font color="#000066">
<h1>* Aranhas Escandalosas *<br>
* Scandalous Spiders *</h1>
</font>


<table width=40% border=0 cellspacing=4 cellpadding=4>
<tr>

<td>
<center>
<img src="agaran.gif">
</center>
</td>

<td>
<center>
<font face=arial color=#aa00aa">
<h3>
A seguir, voc&#234; poder&#225; encontrar a aranha que mostra <font color=#ff0000">Quase<font color=#aa00aa> Tudo!
<br>
&#201; de sua inteira responsabilidade navegar e encontr&#225;-la!
</h3>
<h5>Following, you may find the spider that shows <font color=#000000>near</font> everything!
<br>
It's your entire responsibility to move down and find her!</h5>
</center>
</font>
</td>


</td>
</table>
<br>
<img src="agaranb.gif">
<br>
<br>
<table width=60% border=0 cellspacing=0 cellpadding=0>
<tr>

<td>
<center>
<h3>
<font face=arial color=#aa00aa">
... no caso de prosseguir, voc&#234; encontrar&#225; a aranha mais escandalosa da Internet, aquela que <font color=#ff0000>MOSTRA TUDO!<font color=#aa00aa">
<br>
Nem preciso alert&#225;-lo do perigo que correm as pessoas despreparadas!
<br>
Se fosse voc&#234;, n&#227;o arriscaria!
</h3>
<h5>In the case of desire to go ahead-down and see the most scandalous spider of the Internet, <font color=#000000>that shows everything</font>.
<br>
I don't care!!!<br>
If I were you, I wouldn't do it !!!</h5>
</font>
</center>
</td>

<td>
<center>
<img src="agaran.gif">
</center>
</td>

</tr>
</table>

<br>
<img src="agaranb1.gif">
<br>

<a href="../bindex.php"><img border=0 src="t2.gif"></a>
<br>
<br>
<div class="container" style="width:400px;">
<button id="playPause">
<img id="play" src="../des/alt_fal_1.png" onclick="mostra();" style="width:40px;cursor:pointer;"></img>
<img id="pause" src="../des/alt_fal_0.png" onclick="esconde();" style="width:40px;cursor:pointer;"></img>
</button>
<input id="inpa" onchange="vol();" type="range" min="0" max="1" value="0" step="0.01" style="width:320px;">
<div id="waveform4" style="width:400px;height:128px;"></div>
<script>
var wavesurfer=WaveSurfer.create({
	container:'#waveform4',waveColor:'#0f0',progressColor:'#f00',splitChannels:false,height:128,barWidth:.5
});
</script>
<div id="playlist" hidden><a href="12a.mp3" class="list-group-item active"></a></div>
</div>

</center>

<script>
document.getElementById("inpa").value=0.49;
wavesurfer.setVolume(.5);
function vol(){	wavesurfer.setVolume(document.getElementById("inpa").value);}
function brmens(){document.getElementById("mens").innerHTML="... doces<br>sonhos!";}
function enmens(){document.getElementById("mens").innerHTML="... sweet<br>dreams!";}
function esconde(){document.getElementById("inpa").style.visibility="hidden";}
function mostra(){document.getElementById("inpa").style.visibility="visible";}
</script>


<div style="position:absolute;left:100px;top:50px;">
<center>
<img src="../des/dortunin.gif">
<br>
<img border=0 src="../des/dortmail.gif" style="top:-4px;" title="jrlazz@yahoo.com" style="cursor:pointer;">
<br>
<a href="../bindex.php"><img border=0 src="../des/dorthome.gif" style="top:-7px;"></a>
<br>
<img src="../des/agmidife.gif">&nbsp;&nbsp;<img src="../des/agmidifd.gif">
<br>
<!--
<img src="../des/br_png.png" width="30" onclick="brmens();" style="cursor:pointer;">
<img src="../des/en_png.png" width="30" onclick="enmens();" style="cursor:pointer;">
-->
</center>
</div>
</body>
</html>
