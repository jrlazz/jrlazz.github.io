<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>* Tunin * /tunin/nat96/br1.html</title>
<!-- Author: Jos&#233; Roberto Lazzareschi -->
<!-- Xmedia -->

<style>

<style>
body {font-size:12pt;}
input  {opacity:.8; filter: invert(48%) sepia(98%) saturate(2378%) hue-rotate(87deg) brightness(123%) contrast(125%);}
td {padding:0px; border:0px;}
a {text-decoration:none;}
img {position:relative;}
button {font-size:4pt; background-color:transparent; border:0px;}
</style>

<script src="../../../js/wavesurfer.min.js"></script>
<script src="../../../js/app.js"></script>

</head>

<body bgcolor="#000" background="natfun1.jpg">

<gatenschinber></gatenschimber>

<basefont size=4>

<br>
<br>

<center>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr valign=center>

<td  width="30%"><center><a href="../bindex.php"><img src="../des/dortunin.gif"><br><img border=0 src="../des/dortmail.gif" style="position:relative;top:-4px;" title="jrlazz@yahoo.com"><br><img border=0 src="../des/dorthome.gif" style="position:relative;top:-7px;"></a></center></td>

<td width="40%">
<center>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><img src="agtree1.gif"></td>
</tr>
</table>
</center>
</td>

<td width=30%>
<center>
<h2><i>
<font color=#999966>Feliz&nbsp;</font><font color=#ff0000>N</font><font color=#00ff00>a</font><font color=#aaaaff>t</font><font color=#ffff00>a</font><font color=#00ffff>l</font><font color=#ff00ff>&nbsp;!</font>
<br>
<font color=#999966>e</font>
<br>
<font color=#999966>Webio&nbsp;</font>
<font color=#ff0000>A</font><font color=#ffff00>n</font><font color=#ffffff>o</font>
<font color=#00ff00>&nbsp;N</font><font color=#ddddff>o</font><font color=#ff00aa>v</font><font color=#00ffaa>o</font><font color=#ffdddd>&nbsp;!</font>
</i></h2>
<br>
<br>
<h2><i>
<font color=#999966>Happy&nbsp;</font><font color=#ff0000>C</font><font color=#00ff00>h</font><font color=#aaaaff>r</font><font color=#ffff00>i</font><font color=#00ffff>s</font><font color=#00ff00>t</font><font color=#aaaaff>m</font><font color=#ffff00>a</font><font color=#ffff00>s</font><font color=#ff00ff>&nbsp;!</font>
<br>
<font color=#999966>and</font>
<br>
<font color=#999966>Happy&nbsp;<font color=#ff0000>N</font><font color=#ffff00>e</font><font color=#ffffff>w</font><font color=#00ff00>&nbsp;Y</font><font color=#ddddff>e</font><font color=#ff00aa>a</font><font color=#00ffaa>r</font><font color=#ffdddd>&nbsp;!</font>
</i></h2>


</center>
</td>
</tr>
</table>
<br>
<br>
<br>
<!--
<a href="nat96.mid">
<img src="../des/agmidife.gif">
clique e ou&ccedil;a o &aacute;udio / click to listen to the audio
<img src="../des/agmidifd.gif">
</a>
-->

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
<div id="playlist" hidden><a href="nat96.mp3" class="list-group-item active"></a></div>
</div>

</center>

<script>
document.getElementById("inpa").value=0.49;
wavesurfer.setVolume(.5);
function vol(){	wavesurfer.setVolume(document.getElementById("inpa").value);}
function esconde(){document.getElementById("inpa").style.visibility="hidden";}
function mostra(){document.getElementById("inpa").style.visibility="visible";}
</script>

</center>

</body>
</html>