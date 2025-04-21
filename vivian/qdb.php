<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta charset="utf-8" /> 

<title>qdb.php</title>

<style>

@font-face {font-family:tipo;src:url('../fonte/Lato-Bold.ttf');}
body { margin:0px; margin-top:0px; background-color:#fff;font-family:tipo; font-size:20pt; font-weight:bold; overflow:hidden;}
span { font-family:tipo; font-size:9pt;}
img { position:relative;}
div { border-radius:50%; border:1px solid transparent; z-index:9; cursor:move; position:absolute; visibility:hidden; overflow:hidden; padding:5px; text-align:center;}
div:active { border:1px solid #fc0;}
a { text-decoration:none; color:#008;}
a:hover { color:#f00;}
.noselect { -webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;}
.tro { transform: rotate(0deg) translateX(0px);}

</style>

</head>

<body class="noselect">

<?php

$im=array();
$vim=array();
$vimdeg=array();
$vimcor=array();
$vimleft=array();
$vimtop=array();
$vimw=array();
$vimh=array();
$vimimg=array();
$vim[1]="jrlazz";
$JRL="jrlazz";

$fator=3;

$quantas=38;// com shuffle

if($_SERVER["REQUEST_METHOD"]=="POST"){
	for($u=1;$u<=$quantas;$u++){
		$parapos="pos".$u;
		if (isset($_POST[$parapos])){$vim[$u]=$_POST[$parapos];}
	}
	for($u=0;$u<$quantas;$u++){
		$vimpro[$u]=substr($vim[$u+1],0,4);
		$vimdeg[$u]=substr($vim[$u+1],4,4);
		$vimcor[$u]=substr($vim[$u+1],8,4);
		$vimleft[$u]=substr($vim[$u+1],12,7);
		$vimtop[$u]=substr($vim[$u+1],19,7);
		$vimw[$u]=substr($vim[$u+1],26,7);
		$vimimg[$u]=substr($vim[$u+1],33);
	}
	$JRL=$vim[1];
}

if($JRL=="jrlazz"){
	$indice=0;
	$files=array_diff(scandir('img/quarto_01'),array('.', '..'));
	$fales=preg_grep('~\.(jpg|png)$~',$files);
	for($x=0;$x<=count($files); $x++){
		if($fales[$x]){
			if(substr($fales[$x],0,10)=="quarto_01_"){
				$im[$indice]=$fales[$x];
				$indice++;
			}
		}
	}
	shuffle($im);
	for ($x=0; $x<$quantas; $x++){
		$size=getimagesize('../img/quarto_01/'.$im[$x]);
//		if(stripos($im[$x],"_cob") || stripos($im[$x],"_liv") || stripos($im[$x],"_esp") || stripos($im[$x],"_bor")){$fator=2;}
//		if(stripos($im[$x],"_vermelhog") || stripos($im[$x],"_rosag") || stripos($im[$x],"_coisog") || stripos($im[$x],"_coiso2g") || stripos($im[$x],"_amarelo") || stripos($im[$x],"_azulg")){$fator=4;}
		$ze=intval($size[0]/$fator);
		$zestr=strval(5000000+$ze);
		echo "<div style='width:".$ze."px;padding:".intval($ze/12)."px;' id='div".($x+1)."'><img class='tro' id='imgimg".($x+1)."' title='".($x+1)."' src='../img/quarto_01/".$im[$x]."' style='width:".$ze."px;'></img></div>";
		$vim[$x+1]="50005000100050000005000000".$zestr.$im[$x];
	}
} else {
	for ($x=0; $x<$quantas; $x++){
		$ze=intval($vimw[$x])-5000000;
		$pro=(intval($vimpro[$x])-4900)/100;
		$widthimg=intval($pro*$ze);
		$rotdeg=intval($vimdeg[$x])-5000;
		echo "<div style='width:".$widthimg."px;padding:".intval($widthimg/12)."px;' id='div".($x+1)."'><img class='tro' id='imgimg".($x+1)."' title='".($x+1)."' src='../img/quarto_01/".$vimimg[$x]."' style='width:".$widthimg."px;transform:rotate(".$rotdeg."deg);'></img></div>";
	}
}

?>

<center>
<p style="position:absolute;top:-10px;line-height:10px;width:99%;text-align:center;">
QUARTO DA BAGUN&Ccedil;A
<br><br>
<span>INSTRU&Ccedil;&Otilde;ES DE USO: CLIQUE NO OBJETO E ARRASTE-O PARA ONDE DESEJAR. APERTE A TECLA "E" PARA GIRAR O OBJETO PARA A ESQUERDA, E A TECLA "D" PARA GIRAR O OBJETO PARA A DIREITA.<br>
 APERTE A TECLA "P" PARA APROXIMAR O OBJETO, E A TECLA "L" PARA AFAST&Aacute;-LO. DIVIRTA-SE! SE A IMAGEM "COLAR", TECLE ESPA&Ccedil;O!</span>
</p>
</center>

<script>

var imgimgId="";
var filt=new Array();
var divId="";
var divIdaux="";
var i=0;
var divQtd=0;
var JRL="<?php echo $JRL; ?>";
var jsarray=<?php echo '["'.implode('","',$vim).'"]' ?>; // php array to javascript array
var jsvimpro=new Array();
var jsvimdeg=new Array();
var jsvimcor=new Array();
var jsvimleft=new Array();
var jsvimtop=new Array();
var jsvimw=new Array();
var jsvimimg=new Array();
var nId="";
var deltaDEG=0;
var keyCodeOK=0;
var pro=0;
var deltaLP=0;
var quantas="<?php echo $quantas; ?>";
var rot=0;
var rotdeg="";
var rotval=0;
var rotvem=0;
var widthvem=0;

// alert(jsarray[0]);

function rodadir(divId){deltaDEG=2;auxroda(divId);}
function rodaesq(divId){deltaDEG=-2;auxroda(divId);}
function auxroda(divId){
	nId=parseInt(divId.substr(3));
	imgimgId="imgimg"+nId;
	rotvem=document.getElementById(imgimgId).style.transform;
	rotval=Number(rotvem.replace("rotate(","").replace("deg)",""));
	rot=rotval+deltaDEG;
	if(rot>360){rot=rot-360;}
	if(rot<-360){rot=rot+360;}
	rotdeg=rot+"deg";
	document.getElementById(imgimgId).style.transform="rotate("+rotdeg+")";
	jsvimdeg[nId]=5000+rot;
	nIdpos(divId,nId,jsvimdeg[nId],jsvimpro[nId]);
}

function perto(divId){deltaLP=0.02;auxdist(divId,deltaLP);}
function longe(divId){deltaLP=-0.02;auxdist(divId,deltaLP);}
function auxdist(divId,deltaLP){
	nId=Number(divId.substr(3));
	imgimgId="imgimg"+nId;
	pro=((parseInt(jsvimpro[nId])-4900)/100)+deltaLP;
	widthvem=parseInt(jsvimw[nId])-5000000;
	jsvimpro[nId]=(parseInt(jsvimpro[nId])+(deltaLP*100));
	document.getElementById(imgimgId).style.width=(pro*widthvem)+"px";
	document.getElementById(divId).style.width=(pro*widthvem)+"px";
	document.getElementById(divId).style.padding=(pro/12*widthvem)+"px";
	nIdpos(divId,nId,jsvimdeg[nId],jsvimpro[nId]);
}

// cria as function()'s referentes aos dragstart's
<?php
	for ($x=1; $x<=$quantas; $x++){
		echo "document.getElementById('div".$x."').onmousedown=function(event){divId='div".$x."';comum(divId);};";
	}
?>

function comum(divId){
	nId=divId.substr(3);
	for(i=1;i<divQtd;i++){divIdaux="div"+i;document.getElementById(divIdaux).style.zIndex=9;}
	document.getElementById(divId).style.zIndex=99;
	let shiftX=event.clientX-document.getElementById(divId).getBoundingClientRect().left;let shiftY=event.clientY-document.getElementById(divId).getBoundingClientRect().top;
	document.body.append(document.getElementById(divId));
	moveAt(event.pageX,event.pageY);
	function moveAt(pageX, pageY){
		document.getElementById(divId).style.left=pageX-shiftX+'px';
		document.getElementById(divId).style.top=pageY-shiftY+'px';
		nIdpos(divId,nId,jsvimdeg[nId],jsvimpro[nId]);
	}
	function onMouseMove(event){moveAt(event.pageX, event.pageY);}
	document.addEventListener('mousemove',onMouseMove);
	document.getElementById(divId).onmouseup=function(){document.removeEventListener('mousemove',onMouseMove);document.getElementById(divId).onmouseup=null;};
	document.getElementById(divId).onmouseup=function(){document.removeEventListener('mousemove',onMouseMove);document.getElementById(divId).onmouseup=null;};
	document.getElementById(divId).onmouseup=function(){document.removeEventListener('mousemove',onMouseMove);document.getElementById(divId).onmouseup=null;};
}

// cria os dragstart's
<?php
	for ($x=1; $x<=$quantas; $x++){
		echo "div".$x.".ondragstart=function(){return false;};";
	}
?>

// busca da quantidade de elementos div
var x=document.getElementsByTagName("div");
divQtd=x.length;

for(i=0;i<(divQtd);i++){
	jsvimpro[i+1]=jsarray[i].substr(0,4);
	jsvimdeg[i+1]=jsarray[i].substr(4,4);
	jsvimcor[i+1]=jsarray[i].substr(8,4);
	jsvimleft[i+1]=jsarray[i].substr(12,7);
	jsvimtop[i+1]=jsarray[i].substr(19,7);
	jsvimw[i+1]=jsarray[i].substr(26,7);
	jsvimimg[i+1]=jsarray[i].substr(33);
}

// posicionamentos
if(JRL=="jrlazz"){
	for(i=1;i<=divQtd;i++){
		divId="div"+i;
		document.getElementById(divId).style.left=(100+400*Math.random())+"px";
		document.getElementById(divId).style.top=(250+200*Math.random())+"px";
		document.getElementById(divId).style.visibility="visible";
	}
} else {
	for(i=1;i<=divQtd;i++){
		divId="div"+i;
		document.getElementById(divId).style.left=(parseInt(jsvimleft[i])-5000000)+"px";
		document.getElementById(divId).style.top=(parseInt(jsvimtop[i])-5000000)+"px";
		document.getElementById(divId).style.visibility="visible";
	}
}

// para entrada de E, D, A ou espaço
keyCodeOK=1;
function checkKey(e){
	if(keyCodeOK==1){
		e=e || window.event;
		if(e.keyCode=='68'){rodadir(divId);}// D direita
		else if(e.keyCode=='69'){rodaesq(divId);}// E esquerda
		else if(e.keyCode=='76'){if(jsvimpro[nId]>4920){longe(divId);}}// L longe
		else if(e.keyCode=='80'){if(jsvimpro[nId]<5250){perto(divId);}}// P longe
		//else if(e.keyCode=='65'){form_id.submit();}// submit
		else if(e.keyCode=='32'){form_id.submit();}// submit
		//alert(e.keyCode);
	}
}
document.onkeydown=checkKey;

// para a rodinha do mouse
var sca=1;
function zoom(event) {
	event.preventDefault();
	scale += event.deltaY * -0.1;
	if(scale>sca){rodadir(divId);sca=scale;}
	if(scale<sca){rodaesq(divId);sca=scale;}
}
let scale=1;
const el=document.querySelector('body');
el.onwheel=zoom;

</script>

<form id='form_id' method="POST" action="form02.php" enctype="multipart/form-data" hidden>
<?php
	for($u=1;$u<=$quantas;$u++){echo "<input type='text' id='pos".$u."' name='pos".$u."'></input>";}
?>
<input type="text" id="assunto" name="assunto" value=""></input>
<input type="submit"></input>
</form>

<script>

// alterando dados de formulário
for(z=1;z<=quantas;z++){
	document.getElementById("pos" + z).value=jsvimpro[z].toString() + jsvimdeg[z].toString() + jsvimcor[z] + (5000000+parseInt(document.getElementById("div" + z).style.left)).toString() + (5000000+parseInt(document.getElementById("div" + z).style.top)).toString() + jsvimw[z] + jsvimimg[z];
}

function nIdpos(divId,nId,deg,pro){
	document.getElementById("pos" + nId).value=pro.toString() + deg.toString() + jsvimcor[nId] + (5000000+parseInt(document.getElementById(divId).style.left)).toString() + (5000000+parseInt(document.getElementById(divId).style.top)).toString() + jsvimw[nId] + jsvimimg[nId];
}

//alert("FIM");

</script>

<button onclick="javascript:window.location.href='form02.php';" style="position:absolute;left:10px;top:10px;background-color:red;color:#ff0;border-color: white black black white;font-weight:bold;padding:6px;cursor:pointer;" title="reiniciar" alt="reiniciar"></button>

</body>
</html>
