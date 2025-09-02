<!DOCTYPE html>
<html lang="en">
<head>
<title>paruba.php</title>
<!-- <meta charset="iso-8859-1"> -->
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<link rel="shortcut icon" href="https://threejs.org/files/favicon.ico"/>

<style>

a{font-family:Arial;font-size:9pt;font-weight:bold;color:#c00;text-decoration:none;}
a:hover{color:#060;}

@font-face {font-family:myq;src:url('../fonte/MysteryQuest-Regular.ttf');}
@font-face {font-family:con;src:url('../fonte/lucida_console.ttf');}

html{width:100%;height:100%;}

b{position:relative;font-family:Arial;font-size:9pt;top:5px;left:424px;color:#c00;background-color:#ccc;border:1px solid #c00;padding:2px;}

body{margin:0px;background-color:#a6c4f4;overflow:hidden;background-image:url('img/wall_drops_r.jpg');background-repeat:no-repeat;background-size:100% 100%;}

button{width:20px;font-size:12pt;font-family:con;background-color:#ccc;color:#fff;border:none;}
.btn{width:100px;color:#fff;font-family:con;font-size:10pt;background-color:#06a;border:1px outset #fff;padding:2px;display:z-index:1;cursor:pointer;}
.btn:hover{background-color:#f00;border:1px inset #fff;}
.babb{width:30px;height:24px;background-color:#ccc;color:#006;border:2px;border-style:outset;border-color:#fff #000 #000 #fff;font-size:12pt;font-weight:normal;}
.boc{width:20px;height:24px;background-color:#909;color:#fff;border:2px;border-style:outset;border-color:#fff #000 #000 #fff;font-size:12pt;font-weight:normal;}
.bok{width:30px;height:24px;background-color:#c00;border:2px;border-style:outset;border-color:#fff #000 #000 #fff;font-size:12pt;font-weight:normal;cursor:pointer;}

input{width:48px;height:18px;font-size:10pt;font-family:con;background-color:#014;color:#0ff;border:2px;border-style:inset;border-color:#000 #fff #fff #000;text-align:right;}
input::-webkit-outer-spin-button,input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0;}
input[type=number]{-moz-appearance:textfield;}
.inputXY{font-size:10pt;width:40px;color:#008;background-color:#cc00;text-align:right;border:none;}
.inputWDH{width:40px;background-color:#909;color:#fff;}

select{font-size:12pt;font-family:con;background-color:#ccc;color:#006;border:none;text-align:center;}

span{font-family:con;font-size:12pt;color:#008;}
.spanXY{font-size:10pt;}

table{z-index:1;}
tr,td{padding:0px;border:0px solid black;}
.tdb{font-family:Arial;font-size:11pt;font-weight:bold;padding:4px;border:1px solid black;text-align:center;}

</style>

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/dialogify.min.js"></script>

<script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>
<script type="importmap">
	{
	"imports":	{
			"three": "https://unpkg.com/three@0.152.0/build/three.module.js",
			"three/addons/": "https://unpkg.com/three@0.152.0/examples/jsm/"
			}
	}
</script>

</head>

<body id="corpo">

<span style="position:absolute;left:1%;width:99%;text-align:center;top:50px;">
<span id="arq" style="border:2px;border-style:outset;border-color:#ccc;background-color:#ccc;display:none;">&nbsp;Archive File Name:
<input type="text" id="arqname" name="arqname" value="" autocomplete="off" style="width:200px;text-align:left;"><button onclick="document.getElementById('arq').style.display='none';" class="bok">OK</button>
</span>
<span id="opa" style="border:2px;border-style:outset;border-color:#ccc;background-color:#ccc;display:none;">&nbsp;Opacity of walls:
<input type="number" id="valopa" name="valoopa" value=0.5 autocomplete="off" style="width:36px;text-align:left;"><button onclick="document.getElementById('opa').style.display='none';" class="bok">OK</button>
</span>
</span>

<span id="EvFi" style="position:absolute;left:20.41%;top:30.41%;font-family:myq;font-size:41pt;color:#041;display='';">Par<font style="color:#414;">uba</font>
<font style="color:#0ff;font-size:30.41px;"><br>... and the rain painted the garage wall...</font></span>

<select id="sol" style="position:absolute;left:10px;top:10px;display:none;" autocomplete="off"></select>


<table id="ztab" style="position:absolute;left:-120px;top:24px;width:120px;border-width:2px;border-style:outset;border-color:#ccc;background-color:#ccc;padding:4px;display:none;opacity:0.6;">
<tr><td>x</td><td><input type="number" id="zx" name="zx" autocomplete="off"></td><td><button onclick="document.getElementById('arq').style.display='none';" class="bok">OK</button></td></tr>
<tr><td>y</td><td><input type="number" id="zy" name="zy" autocomplete="off"></td><td></td></tr>
<tr id="trzz" style="display:none;"><td>z</td><td><input type="number" id="zz" name="zz" autocomplete="off"></td><td></td></tr>
<tr id="trzry" style="display:none;"><td>ry</td><td><input type="number" id="zry" name="zry" autocomplete="off"></td><td></td></tr>
<tr id="trzrz" style="display:none;"><td>rz</td><td><input type="number" id="zrz" name="zrz" autocomplete="off"></td><td></td></tr>
</table>

<!-- Menu ******** -->

<div id="menu" autocomplete="off" style="position:absolute;left:-494px;top:80px;width:500px;height:400px;border:2px;border-style:outset;border-color:#eee;background-color:#eee;padding:4px;display:none;opacity:0.5;overflow:auto;direction:rtl;text-align:left;background-image:url(img/veamanbrS.png);background-position: center; ">

<b id="bmenu">Menu</b>

<center>
<div style="border:1px solid red;width:160px;background-color:#ccc;text-align:center;"><a href="paruba.txt" target="_blank">click here for full code</a></div><br>

<table style="position:relative;width:460px;text-align:top;">
<tr style="vertical-align:top;">

<td>
<table>
<tr><td class="tdb" style="border:0px;">
<i>You are in </i><i id="spanD">scr</i><i>&nbsp;D</i><br><br>
<button id="labB" class="btn">EXAMPLE</button><br><br>
<button id="labC" class="btn" onclick="repla();">RESTART</button><br><br>
<button id="labD" class="btn">SAVE</button><br>
<br>
<i>screen color</i>&nbsp;<input type="color" id="bgcolor" name="bgcolor" autocomplete="off" value="#bad2f8" style="width:16px;height:16px;padding:0px;border:2px outset #fff;border-color:#fff #000 #000 #fff;cursor:pointer;">
<br><i id="spancor" style="font-weight:normal;"></i>
<br>
<i id="spanC" style="display:none;"></i>
</td>
</tr>
</table>
</td>

<td>
<table>
<tr><td class="tdb">C ground<br>wall depths</td></tr>
<tr><td class="tdb">V return<br>wall depths</td></tr>
<tr><td class="tdb">X input<br>file name</td></tr>
<tr><td class="tdb">O walls<br>opacity</td></tr>
<tr><td class="tdb">P reset<br>camera<br>controls</td></tr>
</table>
</td>

<td>
<table>
<tr><td class="tdb">G scale + x</td></tr>
<tr><td class="tdb">H scale - x</td></tr>
<tr><td class="tdb">J scale + y</td></tr>
<tr><td class="tdb">K scale - y</td></tr>
<tr><td class="tdb">T scale + z</td></tr>
<tr><td class="tdb">B scale - z</td></tr>
<tr><td class="tdb">R rotate<br>Right</td></tr>
<tr><td class="tdb">L rotate<br>Left</td></tr>
<tr><td class="tdb">DEL</td></tr>
</table>
</td>

<td>
<table>
<tr><td class="tdb">A &larr;</td></tr>
<tr><td class="tdb">D &rarr;</td></tr>
<tr><td class="tdb">W &uarr;</td></tr>
<tr><td class="tdb">S &darr;</td></tr>
<tr><td class="tdb">arrow &larr; scene</td></tr>
<tr><td class="tdb">arrow &rarr; scene</td></tr>
<tr><td class="tdb">arrow &uarr; scene</td></tr>
<tr><td class="tdb">arrow &darr; scene</td></tr>
<tr><td class="tdb">space<br>clear<br>arrows acts</td></tr>
</table>
</td>

</tr>
</table>

</center>

<div style="font-family:Arial;font-size:11pt;font-weight:bold;margin:14px;">

<center>********<br>SOME HELP<br><br>********<br></center>
You can start creating a wall<br>
Click Create and then click Wall15<br>
Click A, move mouse and click<br>
Click B, move mouse and click<br>
Having the two points click OK

<br><br><center>********<br><br></center>
Finishing a creation, You can press any of the keys ADWSRLGHJKTB and feel the alterations

<br><br><center>********<br>PLUS and MINUS keys<br><br></center>
You can adjust the amount of movement, scale, or rotation intensity (per click)
 via + or - keys

<br><br><center>********<br><br></center>
Now let's create a boxy<br>
Click Create and then click Boxy<br>
Click A, move mouse and click<br>
Now You may change it's dimension with W, D and H inputs fields<br>
If You don't change those values, it will create a small but tall boxy. Then, click OK

<br><br><center>********<br>CHANGES and DEL<br><br></center>
Clicking on the object, You can modify it<br>
You can change the size, orientation and the place of the object<br>
You can press any of the keys ADWSRLGHJKTB and apply to the object<br>
Once selected, You can delete the object with DEL Key<br>
When You delete an object, it goes to a trash place (far left ... You can see it, panning the screen with the mouse wheel), and then it stays on screen but will not be saved<br>
This was created because the difficulty to remove all childs of the objects, detected by the raycasting

<br><br><center>********<br>C and V<br><br></center>
The C Key puts down all wall heights (flattening them), turning easy to adjust the positions of the objects<br>
V Key puts back the wall heights

<br><br><center>********<br>EXAMPLE<br><br></center>
The EXAMPLE button loads some objects of an unfinished floorplan<br>
It is loaded ONLY ONCE per run

<br><br><center>********<br>RESTART<br><br></center>
The RESTART button starts all over again

<br><br><center>********<br>SAVE<br><br></center>
The SAVE button is disabled<br>
You will have to get the code and make some changes to enable the save function<br>
There will be some slashes in the page code (// in JS code) inhibiting this function for the Showcase presentation<br>
There are few changes to be done to run and save in Your local (127.0.0.1 PHP Server) or in a WWW PHP Server

<br><br><center>********<br><br></center>
The complete code of the page will be shown by clicking below<br><br>
<center><div style="border:1px solid red;width:160px;background-color:#ccc;"><a href="paruba.txt" target="_blank">click here for full code</a></div>
<center>

<br><br><center>********<br><br></center>
This is a start project... <img src="img/smiley.png" style="width:64px;heigth:64px;"></image>

<br><br><center>********<br><br></center>

</div>

</div>
<!-- Menu End ******** -->

<!-- Top ******** -->

<div id="vejo" style="display:none;">

<div id="top" style="position:absolute;left:0%;top:0px;width:100%;height:25px;background-color:#ccc;"></div>

<span style="position:absolute;left:0%;bottom:26px;width:100%;text-align:center;background-color:transparent;">
<span id="obs" style="color:#000;font-size:12pt;border:2px;font-weight:bold;border-style:outset;border-color:#ccc;padding:2px;background-color:#ccc;display:none;padding-left:10px;padding-right:10px;"></span>
</span>

<div id="curxy" style="position:absolute;left:0px;top:0px;width:10%;z-index:1;">
<span class="spanXY">&nbsp;x=</span><input class="inputXY" type="text" id="spanB1" name="spanB1">
<span class="spanXY">y=</span><input class="inputXY" type="text" id="spanB2" name="spanB2">
</div>

<div style="position:absolute;left:0px;top:0px;left:12%;width:5%;text-align:left;">
<select id="itemsel" autocomplete="off" style="font-family:con;font-size:12pt;height:24px;border:2px;border-style:outset;border-color:#ccc;cursor:pointer">
<option value="S" selected>Create</option>
<option value="#boxy">Boxy</option>
<option value="#floorc">Floor_Cor</option>
<option value="#floort">Floor_Tex</option>
<option value="#shower">Shower</option>
<option value="#sink">Sink</option>
<option value="#toilet">Toilet</option>
<option value="#toiletb">Toilet_Box</option>
<option value="#wall15">Wall 15</option>
</select>
</div>


<div id="otc">
<div id="topedit" style="position:absolute;left:0px;top:0px;left:23%;width:60%;text-align:left;display:none;">
<span id="altobs" style="font-family:con;font-size:12pt;display:;">obs.
<input type="number" id="numobs" name="numobs" autocomplete="off" readonly style="width:28px;">
<input type="text" id="obsobs" name="obsobs" autocomplete="off" style="width:240px;text-align:left;">
</span>
<span id="alttex" style="font-family:con;font-size:12pt;display:none;"></span>
<span id="imgcol" style="font-family:con;font-size:12pt;">texture</span>
<input type="number" id="numtex" name="numtex" autocomplete="off" readonly style="width:28px;">
<input type="text" id="imgtex" name="imgtex" autocomplete="off" readonly style="width:160px;text-align:left;">
<select id="texsel" autocomplete="off" style="font-family:con;font-size:12pt;height:24px;border:2px;border-style:outset;border-color:#ccc;cursor:pointer;">
<option id="op40" value="T" selected>Select</option>
<option id="op1"  value="cimento2.jpg">Cimento</option>
<option id="op2"  value="pcb03.png">PCB</option>
<option id="op3"  value="samick_r1.png">Samick</option>
<option id="op4"  value="wooden_floor.png">WoodF</option>
<option id="op5"  value="wood_grain.jpg">WoodG</option>
<option id="op23" value="sixcolor">color</option>
<option id="op24" value="sixbranc">branc</option>
<option id="op25" value="sixcinza">cinza</option>
<option id="op26" value="sixbuild">build</option>
<option id="op27" value="sixstove">stove</option>
<option id="op28" value="sixturqu">turqu</option>
<option id="op29" value="sixverme">verme</option>
<option id="op30" value="sixwoodf">woodF</option>
<option id="op31" value="sixwoodg">woodG</option>
</select>
<input type="color" id="corwal" name="corwal" autocomplete="off" value="#eeeeee" style="width:23px;height:24px;border:1px solid #ccc;padding:0px;cursor:pointer;vertical-align:bottom;">
</div>
</div>

<div id="topselect" style="position:absolute;left:0px;top:0px;left:25%;width:40%;text-align:left;display:;">
<span id="sBA" style="display:none;">
<button id="BA" onclick="javascript:butA=1;" class="bok">A</button>
<input type="number" id="inpAx" name="inpAx" value=0 autocomplete="off">
<input type="number" id="inpAy" name="inpAy" value=0 autocomplete="off">
</span>
<span id="sBB" style="display:none;">
<button id="BB" onclick="javascript:butB=1;" class="bok">B</button>
<input type="number" id="inpBx" name="inpBx" value=0 autocomplete="off">
<input type="number" id="inpBy" name="inpBy" value=0 autocomplete="off">
</span>
<span id="sBC" style="display:none;">
<input type="color" id="selcolor" name="selcolor" autocomplete="off" value="#009000" style="width:23px;height:24px;border:1px solid #ccc;padding:0px;cursor:pointer;vertical-align:bottom;">
</span>
<span id="sBW" style="display:none;"><button id="W" class="boc">W</button>
<input class="inputWDH" type="number" id="inpw" name="inpw" value=0.5 autocomplete="off">
</span>
<span id="sBD" style="display:none;"><button id="D" class="boc">D</button>
<input class="inputWDH" type="number" id="inpd" name="inpd" value=0.6 autocomplete="off">
</span>
<span id="sBH" style="display:none;"><button id="H" class="boc">H</button>
<input class="inputWDH" type="number" id="inph" name="inph" value=2.4 autocomplete="off">
</span>
<span id="sOK" style="display:none;"><button style="width:50px;" id="bOK" class="bok">OK</button></span>
</div>

<div id="topalvosel" style="position:absolute;left:0px;top:25px;left:1%;width:99%;text-align:center;display:none;">
<select id="alvosel" autocomplete="off" style="font-family:con;font-size:12pt;height:24px;border:2px;border-style:outset;border-color:#ccc;cursor:pointer;">
<option value="A" selected >Search</option>
</select>
</div>

<div style="position:absolute;left:0px;top:0px;left:80%;width:10%;text-align:right;">
<button id="but2D" style="color:#060;width:48px;height:24px;border:2px;border-style:inset;border-color:#000 #fff #fff #000;cursor:pointer;">2D</button>
&nbsp;&nbsp;
<button id="but3D" style="color:#c00;width:48px;height:24px;border:2px;border-style:outset;border-color:#fff #000 #000 #fff;cursor:pointer;">3D</button>
</div>

<span id="paruba" style="position:absolute;left:0px;top:0px;left:90%;width:10%;text-align:center;text-decoration:underline #c00;text-decoration-thickness:1px;font-family:myq;font-size:12pt;color:#030;font-weight:bold;padding:0px;">Par<font style="color:#303;">uba</font></span>

</div>

<!-- Top End ******** -->

<span id="resumo" onclick="this.style.display='none';" style="position:absolute;font-size:11pt;font-weight:bold;line-height:20px;left:2.5%;top:30px;width:95%;height:200px;background-color:#eeeeee;padding:4px;display:none;overflow:auto;"></span>

<span id="paraspanobs" style="position:absolute;height:20px;bottom:2px;width:100%;text-align:center;display:;">&nbsp;
<span id="spanobs" style="font-size:12pt;color:#000;font-weight:bold;border-width:2px;border-style:outset;padding:2px;padding-left:10px;padding-right:10px;border-color:#ccc;background-color:#fcc;display:none;">...</span>
</span>

<script type="module">

import * as THREE from "three";
import{OrbitControls} from "three/addons/controls/OrbitControls.js";
import{TDSLoader} from "three/addons/loaders/TDSLoader.js";
import{DDSLoader} from "three/addons/loaders/DDSLoader.js";
import{MTLLoader} from "three/addons/loaders/MTLLoader.js";
import{OBJLoader} from "three/addons/loaders/OBJLoader.js";


// var nomarq="your_file_path_in_same_paruba_page_dir/your_save_arq.txt";
// or var nomarq="your_save_arq.txt";

var nomarq="plan_all.txt";

var renderer,scene,camera,manager,controls,loader;
var color,csvstr,isected,isected2,isects,isects2,plane,key,qualsel;
var piruba,pirubaName,pirubaId,boundingBox,timeout,alvosel;
var starA,starB,starC,starD,starE,starF,grid,pr,su,vertexColors,trashtex,trash;

var pointer=new THREE.Vector2();
var mouse=new THREE.Vector2();
var a=new THREE.Vector2();
var b=new THREE.Vector2();
var raycaster=new THREE.Raycaster();
var xmlhttp;
var myArray;
var controles;
var textDel;

var psect=[];
var alvos=[];
var alvos2=[];
var geo=[];
var mat=[];
var box=[];
var esf=[];
var cyl=[];
var cir=[];
var toilet=[];
var toiletb=[];
var shower=[];
var sink=[];
var floorc=[];
var floort=[];
var Ar=[];
var fw=[];
var fd=[];
var fh=[];
var wid=[];
var hei=[];
var dep=[];
var mtobj=[];
var obobj=[];
var axes=[];
var texload=[];
var colors=[];
var six=[];
var mat6=[];
var pic=[];
var vi=[];

var ksink=[];//1.4_0.7_0.9
var stove=[];//0.6_0.7_0.9
var wash=[];//0.6_0.7_0.9
var boxy=[];//0.5_0.6_2.4
var freezer=[];//0.7_0.8_2.0

var del=[];for(let o=1;o<1000;o++){del[o]=0;}
var obs=[];for(let o=1;o<1000;o++){obs[o]="";}
var tex=[];for(let o=1;o<1000;o++){tex[o]="";}
var zant=[];for(let o=0;o<1000;o++){zant[o]=0;}

var valx=0;
var valy=0;
var create=0;
var bmenupos=0;
var jaV=0;
var move=0;
var w=0;
var fiz=1;
var mr=0.05;
var mrpasso=0.01;
var mrdefault=0.01;
var sca=-0.1;
var scale=0;
var butA=0;
var butB=0;
var p=Math.PI;
var Ax=0;
var Ay=0;
var Bx=0;
var By=0;
var tAx=0;
var tAy=0;
var tBx=0;
var tBy=0;
var hipo=0;
var poszantes=0;
var tela=2;
var telaant=3;
var numitemsel=0;
//var z=3;
var k=0;
var contaR=0;
var pirubaObj=0;
var alvlen=0;
var alvlen3="";
var wallcolor="#900";
var bgcorant="#ffffff";
var bgcor="#a6c4f4";
var cor0ff0="#000 #fff #fff #000";
var corf00f="#fff #000 #000 #fff";
var larg=0.0001;
var prof=0.0001;
var alt=0.0001;
var rota=0.0001;
var strsave="";
var ewall=0;
var mmenu=0;
var nok=0;
var degy=0.0001;
var degz=0.0001;
var escdel=0;
var delval=1;

var bId=function(id){return document.getElementById(id);}
var dAx=bId("inpAx");
var dAy=bId("inpAy");
var dBx=bId("inpBx");
var dBy=bId("inpBy");
var dBA=bId("BA");
var dBB=bId("BB");
var dbOK=bId("bOK");
var dsBA=bId("sBA");
var dsBB=bId("sBB");
var dsBC=bId("sBC");
var dsBW=bId("sBW");
var dsBD=bId("sBD");
var dsBH=bId("sBH");
var dsOK=bId("sOK");
var dbut2D=bId("but2D");
var dbut3D=bId("but3D");
var dmenu=bId("menu");
var dparuba=bId("paruba");
var dres=bId("resumo");
var dalvosel=bId("alvosel");
var dcorwal=bId("corwal");
var ditemsel=bId("itemsel");
var dnumtex=bId("numtex");
var daltobs=bId("altobs");
var dalttex=bId("alttex");
var dobs=bId("obs");
var dtexsel=bId("texsel");
var dimgtex=bId("imgtex");
var dimgcol=bId("imgcol");
var dspanobs=bId("spanobs");
var dbgcolor=bId("bgcolor");
var dlabB=bId("labB");
var dlabD=bId("labD");
var dlabC=bId("labC");
var dcorpo=bId("corpo");
var dnumobs=bId("numobs");
var dobsobs=bId("obsobs");
var dtopedit=bId("topedit");
var darqname=bId("arqname");
var darq=bId("arq");
var dvalopa=bId("valopa");
var dopa=bId("opa");

var dztab=bId("ztab");
var dzx=bId("zx");
var dzy=bId("zy");
var dzz=bId("zz");
var dzrz=bId("zrz");
var dzry=bId("zry");

var dtrzz=bId("trzz");
var dtrzry=bId("trzry");
var dtrzrz=bId("trzrz");

pr="img/";su=".png";
var sixcolor=[pr+"yellow"+su,pr+"green"+su,pr+"red"+su,pr+"gray"+su,pr+"blue"+su,pr+"black"+su];
var sixbranc=[pr+"quaB"+su,pr+"quaB"+su,pr+"quaB"+su,pr+"quaB"+su,pr+"quaB"+su,pr+"quaB"+su];
var sixcinza=[pr+"quaC"+su,pr+"quaC"+su,pr+"quaC"+su,pr+"quaC"+su,pr+"quaC"+su,pr+"quaC"+su];
var sixbuild=[pr+"build3right"+su,pr+"build3left"+su,pr+"build3top"+su,pr+"build3bottom"+su,pr+"quaC"+su,pr+"quaB"+su];
var sixstove=[pr+"stoveright"+su,pr+"stoveleft"+su,pr+"stovetop"+su,pr+"stovebottom"+su,pr+"stovefront"+su,pr+"stoveback"+su];
var sixturqu=[pr+"qua088"+su,pr+"qua088"+su,pr+"qua088"+su,pr+"qua088"+su,pr+"qua088"+su,pr+"qua088"+su];
var sixverme=[pr+"quaf00"+su,pr+"quaf00"+su,pr+"quaf00"+su,pr+"quaf00"+su,pr+"quaf00"+su,pr+"quaf00"+su];

let wf="wooden_floor";
var sixwoodf=[pr+wf+su,pr+wf+su,pr+wf+su,pr+wf+su,pr+wf+su,pr+wf+su];

pr="img/";su=".jpg";
let wg="wood_grain";
var sixwoodg=[pr+wg+su,pr+wg+su,pr+wg+su,pr+wg+su,pr+wg+su,pr+wg+su];

	// posx=right negx=left posy=top negy=bottom posz=front negz=back

// rad to degree ... rotation.y*(180/p);

function indo(){
	init();
	animate();
	clearalvosel();
	document.getElementById("vejo").style.display="";
	document.getElementById("spanobs").style.display="";
	document.getElementById("EvFi").style.display="none";
	mudabgcor();
	document.getElementById("menu").style.display="";
}

var element=dmenu;
element.addEventListener("scroll",(event) => {
setTimeout(() => {bmenupos=$(element).scrollTop();document.getElementById("bmenu").style.top=bmenupos+"px";},300);});


//vname,vx,vy
function paravi(){
	if(pirubaId && qualsel=="S"){
		if(telaant==2){dztab.style.display="";}
		dtrzz.style.display="none";dtrzry.style.display="none";dtrzrz.style.display="none";
		dtopedit.style.display="";dimgcol.style.display="";dalttex.style.display="";daltobs.style.display="";dnumtex.style.display="";dimgtex.style.display="";
		let tipo=pirubaName.substring(0,4);
		let tipo7=pirubaName.substring(0,7);
		daltobs.style.display="";dnumtex.style.display="";dimgtex.style.display="";
		if(tipo=="#box"){dimgcol.innerText="six images";dtexsel.style.display="";dcorwal.style.display="none";funtex();dtrzrz.style.display="";}
		if(tipo=="#sin" || tipo=="#toi" || tipo=="#sho"){dnumtex.style.display="none";dimgtex.style.display="none";dtexsel.style.display="none";dimgcol.style.display="none";dcorwal.style.display="none";dtrzry.style.display="";}
		if(tipo7=="#floorc" || tipo=="#wal"){funwal();dimgcol.innerText="color";dtexsel.style.display="none";dcorwal.style.display="";dcorwal.value=tex[pirubaId];dtrzrz.style.display="";}
		if(tipo7=="#floort"){dcorwal.style.display="none";dimgcol.innerText="image";dtexsel.style.display="";funimg();dtrzrz.style.display="";}
		if(delval==1){
			dzx.value=piruba.position.x;
			dzy.value=piruba.position.y;
			dzz.value=piruba.position.z;
			dzry.value=parseInt(piruba.rotation.y*(1800/p))/10;
			dzrz.value=parseInt(piruba.rotation.z*(1800/p))/10;
		}
	}
}

function myObs(){
	let theObs=prompt("Create/Edit the observation for "+pirubaName.substring(1),obs[pirubaId]);
	if(theObs!=null){obs[pirubaId]=theObs;dobsobs.value=obs[pirubaId];}
}

function myDel(){
	textDel="OK to Delete it or Cancel.";
}

// Init ********

function init(){

	dBA.onclick=function XBBA(){paraBA();}
	dBB.onclick=function XBBB(){paraBB();}
	ditemsel.onchange=function TEM(){funitemsel();}
	ditemsel.onclick=function PIT(){funitemselclick();}
	dalvosel.onchange=function PALV(){funalvosel(0);}
	dmenu.onmouseover=function MY(){menuY();}
	dmenu.onmouseout=function MN(){menuN();}
	dztab.onmouseover=function MY(){delval=0;dztab.style.opacity=0.99;}
	dztab.onmouseout=function MN(){delval=1;dztab.style.opacity=0.6;}
	dparuba.onclick=function MY(){menuY();}
	dbut2D.onclick=function T2(){tela2D();}
	dbut3D.onclick=function T3(){tela3D();}
	dbgcolor.onchange=function PBGC(){mudabgcor();}
	dobsobs.onclick=function OP(){dobsobs.style.opacity="0.5";}
	dtexsel.onchange=function TX(){mudatex();}
	dbOK.onclick=function BOK(){sOKhide(1);}
	dcorwal.onchange=function PCW(){mudatex();}
	dvalopa.onchange=function XOPA(){mudaopa();}
	dlabB.onclick=function EXA(){if(jaV==0){myFunction();jaV=1;sOKhide(0);}}
	darqname.onchange=function ARQ(){nomarq=darqname.value;}
	dzx.onchange=function VZX(){piruba.position.x=dzx.value;box[1000+pirubaId].position.x=dzx.value;box[2000+pirubaId].position.x=dzx.value;poscyl();clearalvosel();}
	dzy.onchange=function VZY(){piruba.position.y=dzy.value;box[1000+pirubaId].position.y=dzy.value;box[2000+pirubaId].position.y=dzy.value;poscyl();clearalvosel();}
	dzz.onchange=function VZZ(){piruba.position.z=dzz.value;box[1000+pirubaId].position.z=dzz.value;box[2000+pirubaId].position.z=dzz.value;poscyl();clearalvosel();}
	dzry.onchange=function VZRY(){piruba.rotation.y=dzry.value/(180/p);box[1000+pirubaId].rotation.z=dzry.value/(180/p);box[2000+pirubaId].rotation.z=dzry.value/(180/p);poscyl();clearalvosel();}
	dzrz.onchange=function VZRZ(){piruba.rotation.z=dzrz.value/(180/p);box[1000+pirubaId].rotation.z=dzrz.value/(180/p);box[2000+pirubaId].rotation.z=dzrz.value/(180/p);poscyl();clearalvosel();}

//	Button for SAVE here commented
//	dlabD.onclick=function SAV(){grava();}

	dlabC.onclick=function REP(){repla();}

	renderer=new THREE.WebGLRenderer({antialias:true,alpha:true});
	renderer.outputColorSpace=THREE.LinearSRGBColorSpace;
	renderer.setPixelRatio( window.devicePixelRatio );
	renderer.setSize(window.innerWidth,window.innerHeight);
	document.body.appendChild(renderer.domElement);

	scene=new THREE.Scene();

	camera=new THREE.PerspectiveCamera(40,window.innerWidth/window.innerHeight,1,1000);
	camera.position.set(0,0,30);
	poszantes=30;

	manager=new THREE.LoadingManager();
	manager.onStart=function(url,itemsLoaded,itemsTotal){console.log('Started loading file: '+url+'.\nLoaded '+itemsLoaded+' of '+itemsTotal+' files.');};
	manager.onLoad=function(){console.log('Loading complete!');dspanobs.innerText="All Loaded";};
	manager.onProgress=function(url,itemsLoaded,itemsTotal){console.log('loading texture'+url+' '+parseInt(itemsLoaded/itemsTotal*100)+'%');dspanobs.innerText='loading texture'+url+' '+parseInt(itemsLoaded/itemsTotal*100)+'%';};
	manager.onError=function(url){console.log('Error loading texture:'+url);dspanobs.innerText='Error loading texture:'+url;};
	manager.addHandler(/\.dds$/i,new DDSLoader());

	controls=new OrbitControls(camera,renderer.domElement);
	controls.enablePan=true;
	controls.enableRotate=true;
	controls.enableDamping=true;
	controls.saveState();

	document.addEventListener('mousemove',onMouseMove);
	document.addEventListener("mousedown",onMouseDown);
	document.addEventListener('mouseup',onMouseUp);
	document.addEventListener("wheel",onMouseWheel);
	window.addEventListener("keydown",Key);
	window.addEventListener("keyup",NoKey);
	window.addEventListener('resize',onWindowResize);
	onWindowResize();

	starA=new THREE.PointLight("#fff",0.5);starA.position.set(0,0,50);scene.add(starA);
	starF=new THREE.AmbientLight("#fff",0.5);scene.add(starF);

	mtobj[1]="models/extras/toiletA.mtl";
	obobj[1]="models/extras/toiletA.obj";
	new MTLLoader(manager).load(mtobj[1],function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(obobj[1],function(object){toilet=object;toilet.position.set(0,0.4,0);toilet.scale.set(0.05,0.05,0.05);toilet.rotation.set(p/2,0,0);},manager.onProgress,manager.onError);});
		mtobj[2]="models/extras/sink.mtl";
		obobj[2]="models/extras/sink.obj";
		new MTLLoader(manager).load(mtobj[2],function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(obobj[2],function(object){sink=object;sink.position.set(0,0.4,0);sink.scale.set(0.05,0.05,0.05);sink.rotation.set(p/2,0,0);},manager.onProgress,manager.onError);});
	mtobj[3]="models/extras/shower.mtl";
	obobj[3]="models/extras/shower.obj";
	new MTLLoader(manager).load(mtobj[3],function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(obobj[3],function(object){shower=object;shower.position.set(0,0.4,0);shower.scale.set(0.5,0.5,0.5);shower.rotation.set(p/2,0,0);},manager.onProgress,manager.onError);});
		mtobj[4]="models/extras/toilet.mtl";
		obobj[4]="models/extras/toilet.obj";
		new MTLLoader(manager).load(mtobj[4],function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(obobj[4],function(object){toiletb=object;toiletb.position.set(0,0.4,0);toiletb.scale.set(0.05,0.05,0.05);toiletb.rotation.set(p/2,0,0);},manager.onProgress,manager.onError);});

	grid=new THREE.GridHelper(100,200,'#88a','#99b');
	grid.geometry.rotateX(Math.PI/2);
	grid.position.set(0,0,0);
	grid.name="grid";
	scene.add(grid);
	alvos.push(grid);

	geo[0]=new THREE.SphereGeometry(0.08,16,16);
	mat[0]=new THREE.MeshBasicMaterial({color:'#ff0000'});
	esf[0]=new THREE.Mesh(geo[0],mat[0]);
	esf[0].position.set(0,0,0);

	for(let u=0;u<101;u++){esf[u]=esf[0].clone();esf[u].position.set(-(u-50),0,0);scene.add(esf[u]);}
	for(let u=0;u<101;u++){esf[u]=esf[0].clone();esf[u].position.set(0,-(u-50),0);scene.add(esf[u]);}

	geo[2]=new THREE.CylinderGeometry(0.2,0.001,4,32);
	mat[2]=new THREE.MeshBasicMaterial({vertexColors:true});
	cyl[0]=new THREE.Mesh(geo[2],new THREE.MeshNormalMaterial());
	cyl[0].position.set(0,0,2);
	cyl[0].rotation.set(p/2,0,0);

	geo[3]=new THREE.CircleGeometry(0.4,16,1.57,1.57);
	mat[3]=new THREE.MeshBasicMaterial({color:'#c00'});
	cir[0]=new THREE.Mesh(geo[3],mat[3]);
	cir[0].position.set(0,0,0);

	geo[4]=new THREE.CircleGeometry(0.4,16,-1.57,1.57);
	mat[4]=new THREE.MeshBasicMaterial({color:'#0c0'});
	cir[1]=new THREE.Mesh(geo[4],mat[4]);
	cir[1].position.set(0,0,0);

	trashtex=new THREE.TextureLoader(manager).load("img/trash.png");
	geo[5]=new THREE.PlaneGeometry(4,4);
	mat[5]=new THREE.MeshBasicMaterial({map:trashtex,color:'#fff',transparent:true});
	trash=new THREE.Mesh(geo[5],mat[5]);
	trash.position.set(-99,0,0);
	scene.add(trash);

	plane=new THREE.Plane(new THREE.Vector3(0,0,1),0);

	loader=new THREE.TextureLoader();

// Init  End ********

}

function funsix(prsu){
	pic=prsu;
	six.push(new THREE.MeshBasicMaterial({map:loader.load(pic[0])}));
	six.push(new THREE.MeshBasicMaterial({map:loader.load(pic[1])}));
	six.push(new THREE.MeshBasicMaterial({map:loader.load(pic[2])}));
	six.push(new THREE.MeshBasicMaterial({map:loader.load(pic[3])}));
	six.push(new THREE.MeshBasicMaterial({map:loader.load(pic[4])}));
	six.push(new THREE.MeshBasicMaterial({map:loader.load(pic[5])}));
}

function onMouseDown(event){
	nok=0;if(event.clientY<30 || dmenu.style.opacity=="0.99"){nok=1;}
	fiz=0;
	if(nok==0 && delval==1){
		move=1;
		calc();
		if(isected2 && isected2.name!="grid"){funalvosel(1);paravi()}
		if(butA==1 && isected && nok==0 && psect){dAx.value=psect.x-scene.position.x;dAy.value=psect.y-scene.position.y;}
		if(butB==1 && isected && nok==0 && psect){dBx.value=psect.x-scene.position.x;dBy.value=psect.y-scene.position.y;}
	}
}

function onMouseMove(event){
    	obs[pirubaId]=obs[pirubaId];
	nok=0;if(event.clientY<30 || dmenu.style.opacity=="0.99"){nok=1;}
	mouse.x=(event.clientX/window.innerWidth)*2-1;
	mouse.y=-(event.clientY/window.innerHeight)*2+1;
	mouse.z=0;
	raycaster.setFromCamera(mouse,camera);
	isects=raycaster.intersectObjects(alvos,false);
	isects2=raycaster.intersectObjects(alvos2,false);
	if(isects.length>0){
		if(isected!=isects[0].object){isected=isects[0].object;document.getElementById("spanC").innerText="hit ... "+ isected.name;}
	} else {
		isected=null;document.getElementById("spanC").innerText="hit not";
	}
	if(qualsel=="S" && tela==2){
		if(isects2.length>0){
			if(isected2!=isects2[0].object){
				isected2=isects2[0].object;dcorpo.style.cursor="pointer";
				dobs.style.display="";
				dobs.innerHTML="<font style='color:#f00;'>mouse over:&nbsp;</font>"+isected2.name.substring(1)+" "+obs[parseInt(isected2.name.substr(isected2.name.length-3))];
			}
		} else {
			isected2=null;dcorpo.style.cursor="default";dobs.innerText="";dobs.style.display="none";
		}
	}
	calc();
	if(psect){
		if(psect.x && nok==0){
			document.getElementById("spanB1").value=psect.x-scene.position.x;
			document.getElementById("spanB2").value=psect.y-scene.position.y;
		}
	}
	if(document.getElementById("spanC").innerText=="hit not"){document.getElementById("spanB1").innerText="";document.getElementById("spanB2").innerText="";}
}

function onMouseUp(event){move=0;}

function calc(){
	if(isected!=null){
		mouse.x=(event.clientX/window.innerWidth)*2-1;
		mouse.y=-(event.clientY/window.innerHeight)*2+1;
		mouse.z=0;
		raycaster=new THREE.Raycaster();
		raycaster.setFromCamera(mouse,camera);
		isects=new THREE.Vector3();
		psect=raycaster.ray.intersectPlane(plane,isects);
		if(psect){
			valx=+(psect.x.toFixed(1));
			valy=+(psect.y.toFixed(1));
			psect.x=valx;
			psect.y=valy;
		}
	}
}

function onMouseWheel(e){
	if(tela==2){
		scale += e.deltaY * -0.01;
		if(scale>sca){if(camera.position.z<150){camera.position.z +=0.1;sca=scale;}}
		if(scale<sca){if(camera.position.z<3){camera.position.z -=0.1;sca=scale;}}
		if(camera.position.z<3){camera.position.z=3;}
		if(camera.position.z>150){camera.position.z=150;}
		poszantes=camera.position.z;
	}
}

function onWindowResize(){
	camera.aspect=window.innerWidth/window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize(window.innerWidth,window.innerHeight);
}

function paraBA(){
	butA=1-butA;butB=0;
	dBA.style.backgroundColor="#900";
	dBA.style.borderStyle="inset";
	dBA.style.borderColor=cor0ff0;
	if(butA==1){dBA.style.backgroundColor="#0c0";}
	dBB.style.backgroundColor="#900";
	dBB.style.borderStyle="outset";
	dBB.style.borderColor=corf00f;
	if(butA==0){
		dBA.style.backgroundColor="#900";
		dBA.style.borderStyle="outset";
		dBA.style.borderColor=corf00f;
	}
}

function paraBB(){
	butB=1-butB;butA=0;
	dBB.style.backgroundColor="#900";
	dBB.style.borderStyle="inset";
	dBB.style.borderColor=cor0ff0;"#000 #fff #fff #000";
	if(butB==1){dBB.style.backgroundColor="#0c0";}
	dBA.style.backgroundColor="#900";
	dBA.style.borderStyle="outset";
	dBA.style.borderColor=corf00f;
	if(butB==0){
		dBB.style.backgroundColor="#900";
		dBB.style.borderStyle="outset";
		dBB.style.borderColor=corf00f;
	}
}


function funitemselclick(){
	ditemsel.style.borderStyle="inset";
	ditemsel.style.borderColor=cor0ff0;
	dBA.style.backgroundColor="#900";
	dBA.style.borderStyle="outset";
	dBA.style.borderColor=cor0ff0;
	dBB.style.backgroundColor="#900";
	dBB.style.borderStyle="outset";
	dBB.style.borderColor=corf00f;
	pirubaObj=0;
}

function circs(){scene.remove(box[0]);cir[0].position.set(0,0,0);cir[1].position.set(0,0,0);scene.remove(cir[0]);scene.remove(cir[1]);}

function funitemsel(){
	scene.remove(cyl[0]);
	for(let u=1000;u<2000;u++){scene.remove(box[u]);}
	qualsel=ditemsel.value;
	butA=0;butB=0;
	pirubaName=qualsel;
	if(qualsel!="S"){document.getElementById("topselect").style.display="";dtopedit.style.display="none";}
	if(qualsel=="#wall15"){dsBA.style.display="";dsBB.style.display="";dsBC.style.display="";dsOK.style.display="";}
	if(qualsel=="#toilet" || qualsel=="#toiletb" || qualsel=="#sink" || qualsel=="#shower"){dsBA.style.display="";dsOK.style.display="";}
	if(qualsel=="#floorc"){dsBA.style.display="";dsBB.style.display="";dsBC.style.display="";dsOK.style.display="";}
	if(qualsel=="#floort"){dsBA.style.display="";dsBB.style.display="";dsOK.style.display="";}
	if(qualsel=="#boxy"){dsBA.style.display="";dsBW.style.display="";dsBD.style.display="";dsBH.style.display="";dsOK.style.display="";}
	if(qualsel=="S"){dsBA.style.display="none";dsBB.style.display="none";dsBC.style.display="none";dsOK.style.display="none";funfim();}
}

function clearalvosel(){
	dztab.style.display="none";
	alvosel=dalvosel;
	let options=alvosel.getElementsByTagName('option');
	for (var i=options.length;i--;){alvosel.removeChild(options[i]);}
	alvosel=dalvosel;
	alvooption=document.createElement("option");
	alvooption.text="Search";
	alvooption.value="A";
	alvosel.add(alvooption);
	alvosel=dalvosel;
	var alvooption=document.createElement("option");

	alvooption=document.createElement("option");
	alvooption.text="none";
	alvooption.value="none";
	alvosel.add(alvooption);

	for(let j=1;j<1000;j++){
		if(alvos[j] && del[j]==0){
			alvooption=document.createElement("option");
			alvooption.text=alvos[j].name+obs[j].substring(0,41);
			alvooption.value=alvos[j].name;
			alvosel.add(alvooption);
		}
		if(alvos[j] && del[j]==1){
			alvooption=document.createElement("option");
			alvooption.text="X_"+alvos[j].name;
			alvooption.value="X_"+alvos[j].name;
			alvosel.add(alvooption);
		}
	}
	dalvosel.value="A";

	dres.innerHTML="";
	let co=0
	for(let j=0;j<1000;j++){
		if(alvos[j] && del[j]==0){
			co++;
			strsave="";
			piruba=alvos[j];
			pirubaId=j;
			pirubaName=alvos[j].name;
			funpirubaObj();

			let mostra=1;

			if(mostra==0){
				if(pirubaObj==1){strsave=co+"-"+pirubaName+" x:"+parseFloat(piruba.position.x).toFixed(3)+" y:"+parseFloat(piruba.position.y).toFixed(3)+" r:"+parseFloat(piruba.rotation.y).toFixed(3)+" w:"+" d:"+" h:"+" obs:"+obs[pirubaId]+" tex:";}
				if(pirubaObj==2 || pirubaObj==3){strsave=co+"-"+pirubaName+" x:"+parseFloat(piruba.position.x).toFixed(3)+" y:"+parseFloat(piruba.position.y).toFixed(3)+" r:"+parseFloat(piruba.rotation.z).toFixed(3)+" w:"+parseFloat(fw[pirubaId]*piruba.scale.x).toFixed(3)+" d:"+parseFloat(fd[pirubaId]*piruba.scale.y).toFixed(3)+" h:"+parseFloat(fh[pirubaId]*piruba.scale.z).toFixed(3)+" obs:"+obs[pirubaId]+" tex:"+tex[pirubaId];}
			}else{
				let pName=pirubaName;
				let mika=pName.indexOf("_");
				pirubaName=pName.substring(0,mika);
				if(pirubaObj==1){                strsave=pirubaName+";"+parseFloat(piruba.position.x).toFixed(3)+";"+parseFloat(piruba.position.y).toFixed(3)+";"+parseFloat(piruba.rotation.y).toFixed(3)+";"+";"+";"+";"+obs[pirubaId]+";"+tex[pirubaId]+";";}
				if(pirubaObj==2 || pirubaObj==3){strsave=pirubaName+";"+parseFloat(piruba.position.x).toFixed(3)+";"+parseFloat(piruba.position.y).toFixed(3)+";"+parseFloat(piruba.rotation.z).toFixed(3)+";"+parseFloat(fw[pirubaId]*piruba.scale.x).toFixed(3)+";"+parseFloat(fd[pirubaId]*piruba.scale.y).toFixed(3)+";"+parseFloat(fh[pirubaId]*piruba.scale.z).toFixed(3)+";"+obs[pirubaId]+";"+tex[pirubaId]+";";}
			}
			dres.innerHTML=dres.innerHTML+strsave+"<br>";
		}
	}
}

function funalvosel(j){
	for(let f=1;f<1000;f++){if(vi[f]){vi[f].position.set(-100,0,4);scene.remove(vi[f]);}}
	for(let u=1000;u<2000;u++){scene.remove(box[u]);}
	if(j==1){dalvosel.value=isected2.name;}
	let select=dalvosel;
	pirubaName=select.value.toString();
	let mika=pirubaName.indexOf("_")+4;
	pirubaId=parseInt(pirubaName.substr(pirubaName.length-3));
	if(dalvosel.options[pirubaId]){
		piruba=alvos[pirubaId];
		show();
		if(piruba){
			paravi();
			cyl[0].position.set(piruba.position.x,piruba.position.y,2);
			scene.add(cyl[0]);
			//simpvi();
			scene.add(box[pirubaId+1000]);
			if(tela==3){
				dobs.innerText=pirubaName.substring(0,mika) + " " + obs[pirubaId];
				dtopedit.style.display="";
			}
			dnumobs.value=pirubaId;dobsobs.value=obs[pirubaId];
			dnumtex.value=pirubaId;dimgtex.value=tex[pirubaId];
		}
	}else{
		dnumobs.value="";dobsobs.value="";
		dnumtex.value="";dimgtex.value="";
		dspanobs.innerText="...";
		scene.remove(cyl[0]);
	}
}

function grava(){
	strsave="Arquivo";
	document.getElementById("ppara").innerHTML=strsave;
	$.ajax({
		method:"POST",url:"wrap_plan_all.php",data:{text:$("p.unbroken").text(),data2:nomarq}})
		.done(function(response){$("p.broken").html(response);
	});
	let qtas=0;
	for(let j=0;j<1000;j++){
		if(alvos[j] && del[j]==0){
			strsave="";
			piruba=alvos[j];
			pirubaId=j;
			pirubaName=alvos[j].name;
			funpirubaObj();
			let pName=pirubaName;
			let mika=pName.indexOf("_");
			pirubaName=pName.substring(0,mika);
			if(pirubaObj==1){strsave=pirubaName+";"+parseFloat(piruba.position.x).toFixed(3)+";"+parseFloat(piruba.position.y).toFixed(3)+";"+parseFloat(piruba.rotation.y).toFixed(3)+";"+";"+";"+";"+obs[pirubaId]+";"+tex[pirubaId]+";";}
			if(pirubaObj==2 || pirubaObj==3){strsave=pirubaName+";"+parseFloat(piruba.position.x).toFixed(3)+";"+parseFloat(piruba.position.y).toFixed(3)+";"+parseFloat(piruba.rotation.z).toFixed(3)+";"+parseFloat(fw[pirubaId]*piruba.scale.x).toFixed(3)+";"+parseFloat(fd[pirubaId]*piruba.scale.y).toFixed(3)+";"+parseFloat(fh[pirubaId]*piruba.scale.z).toFixed(3)+";"+obs[pirubaId]+";"+tex[pirubaId]+";";}
			document.getElementById("ppara").innerHTML=strsave;
			$.ajax({
				method:"POST",url:"wrap_plan_all.php",data:{text:$("p.unbroken").text(),data2:nomarq}})
				.done(function(response){$("p.broken").html(response);
			});
			qtas++;
		}
	}
	if(qtas==0){alert("Nenhuma gravada");}
	if(qtas==1){alert("Uma gravada(s)");}
	if(qtas>1){alert(qtas+" gravada(s)");}
}

function tela2D(){
	tela=2;
	dbut2D.style.borderColor=cor0ff0;dbut2D.style.color="#060";dbut2D.style.borderStyle="inset";
	dbut3D.style.borderColor=corf00f;dbut3D.style.color="#c00";dbut3D.style.borderStyle="outset";
}

function tela3D(){
	tela=3;
	dbut3D.style.borderColor=cor0ff0;dbut3D.style.color="#060";dbut3D.style.borderStyle="inset";
	dbut2D.style.borderColor=corf00f;dbut2D.style.color="#c00";dbut2D.style.borderStyle="outset";
}

function funpirubaObj(){
	pirubaObj=0;
	if(pirubaName){
		let tipo=pirubaName.substring(0,4);
		if(tipo=="#sho" || tipo=="#sin" || tipo=="#toi"){pirubaObj=1;}
		if(tipo=="#wal"){pirubaObj=2;}
		if(tipo=="#box" || tipo=="#flo"){pirubaObj=3;}
	}
}

function forpiruba(z){
	pirubaName=alvos[z].name;
	piruba=alvos[z];
	pirubaId=parseInt(pirubaName.substr(pirubaName.length-3));
	show();
}

function show(){
	if(piruba){
		funpirubaObj();
		strsave="?";
		degy=parseFloat((piruba.rotation.y)*(180/p)).toFixed(1);
		degz=parseFloat((piruba.rotation.z)*(180/p)).toFixed(1);
		if(pirubaObj==1){strsave="<font style='color:#f00;'>selected:&nbsp;</font><font style='background-color:#ffc;'>&nbsp;"+pirubaName.substring(1)+"&nbsp;</font> x:"+parseFloat(piruba.position.x).toFixed(2)+" y:"+parseFloat(piruba.position.y).toFixed(2)+" r:"+degy+"&deg; w:"+" d:"+" h:"+" obs:"+obs[pirubaId]+" tex:"+"";}
		if(pirubaObj==2 || pirubaObj==3){strsave="<font style='color:#f00;'>selected:&nbsp;</font><font style='background-color:#ffc;'>&nbsp;"+pirubaName.substring(1)+"&nbsp;</font> x:"+parseFloat(piruba.position.x).toFixed(2)+" y:"+parseFloat(piruba.position.y).toFixed(2)+" r:"+degz+"&deg; w:"+parseFloat(fw[pirubaId]*piruba.scale.x).toFixed(2)+" d:"+parseFloat(fd[pirubaId]*piruba.scale.y).toFixed(2)+" h:"+parseFloat(fh[pirubaId]*piruba.scale.z).toFixed(2)+" obs:"+obs[pirubaId]+" tex:"+tex[pirubaId]+"";}
		dspanobs.innerHTML=strsave;
		dspanobs.style.display="";
		pirubaObj=0;
	}
}

function NoKey(e){let oi=0;}

function Key(e){
        key=e.keyCode;
	//alert(key);

	// (key==90 && e.ctrlKey)...controlZ
	// (key==90 && e.shiftKey)...shiftZ

	//if(key==27){escdel=1;}//ESC
	if(key==88){darq.style.display="";}//X
	if(key==90){darq.style.display="none";}//Z

	//if(key==51){myFunction();}// 3
	//if(key==77){if(jaV==0){jaV=1;sOKhide(0);}}//M
	if(key==77){if(jaV==0){myFunction();jaV=1;sOKhide(0);}}//M

	if(key==37){scene.position.x -=1;}//<
	if(key==39){scene.position.x +=1;}//>
	if(key==38){scene.position.y +=1;}//UP
	if(key==40){scene.position.y -=1;}//DOWN
	if(key==32){scene.position.x=0;scene.position.y=0;}//SPACE
	if(key==80){controls.reset();}//P

	if(piruba){
		funpirubaObj();
		if(pirubaObj==1){
			if(key==82){piruba.rotation.y -=mr/6;box[pirubaId+1000].rotation.z -=mr/6;box[pirubaId+2000].rotation.z -=mr/6;}//R
			if(key==76){piruba.rotation.y +=mr/6;box[pirubaId+1000].rotation.z +=mr/6;box[pirubaId+2000].rotation.z +=mr/6;}//L
			//nao aumenta volume de obj
			//if(key==71){piruba.scale.x=piruba.scale.x*1.05;box[pirubaId+1000].scale.x=(box[pirubaId+1000].scale.x)*1.05;piruba.scale.y=piruba.scale.y*1.05;;box[pirubaId+1000].scale.y=box[pirubaId+1000].scale.y*1.05;piruba.scale.z=piruba.scale.z*1.05;box[pirubaId+1000].scale.z=box[pirubaId+1000].scale.z*1.05;}//G
			//if(key==74){piruba.scale.x=piruba.scale.x*0.95;box[pirubaId+1000].scale.x=(box[pirubaId+1000].scale.x)*0.95;piruba.scale.y=piruba.scale.y*0.95;;box[pirubaId+1000].scale.y=box[pirubaId+1000].scale.y*0.95;piruba.scale.z=piruba.scale.z*0.95;box[pirubaId+1000].scale.z=box[pirubaId+1000].scale.z*0.95;}//J
		}
		// wall boxy floorc floort
		if(pirubaObj==2 || pirubaObj==3){
			if(key==82){piruba.rotation.z -=mr/6;box[pirubaId+1000].rotation.z -=mr/6;box[pirubaId+2000].rotation.z -=mr/6;}//R
			if(key==76){piruba.rotation.z +=mr/6;box[pirubaId+1000].rotation.z +=mr/6;box[pirubaId+2000].rotation.z +=mr/6;}//L
			if(key==71){piruba.scale.x=piruba.scale.x*(1+mr);box[pirubaId+1000].scale.x=box[pirubaId+1000].scale.x*(1+mr);box[pirubaId+2000].scale.x=box[pirubaId+2000].scale.x*(1+mr);}//G
			if(key==72){piruba.scale.x=piruba.scale.x*(1-mr);box[pirubaId+1000].scale.x=box[pirubaId+1000].scale.x*(1-mr);box[pirubaId+2000].scale.x=box[pirubaId+2000].scale.x*(1-mr);}//H
			if(key==74){piruba.scale.y=piruba.scale.y*(1+mr);box[pirubaId+1000].scale.y=box[pirubaId+1000].scale.y*(1+mr);box[pirubaId+2000].scale.y=box[pirubaId+2000].scale.y*(1+mr);}//J
			if(key==75){piruba.scale.y=piruba.scale.y*(1-mr);box[pirubaId+1000].scale.y=box[pirubaId+1000].scale.y*(1-mr);box[pirubaId+2000].scale.y=box[pirubaId+2000].scale.y*(1-mr);}//K
			if(key==84){piruba.scale.z=piruba.scale.z*(1+mr);box[pirubaId+1000].scale.z=(box[pirubaId+1000].scale.z)*(1+mr);box[pirubaId+2000].scale.z=(box[pirubaId+2000].scale.z)*(1+mr);}//T
			if(key==66){piruba.scale.z=piruba.scale.z*(1-mr);box[pirubaId+1000].scale.z=(box[pirubaId+1000].scale.z)*(1-mr);box[pirubaId+2000].scale.z=(box[pirubaId+2000].scale.z)*(1-mr);}//B
				if(key==86){for(let f=0;f<1000;f++){if(zant[f]!=0 && box[f] && box[f+1000] && box[f+2000]){box[f].scale.z=zant[f]/fh[f];box[f+1000].scale.z=zant[f]/fh[f];box[f+2000].scale.z=zant[f]/fh[f];zant[f]=0;}}}//V
				if(key==67){for(let f=0;f<1000;f++){if(zant[f]==0 && box[f] && box[f+1000] && box[f+2000]){zant[f]=box[f].scale.z*fh[f];box[f].scale.z=0.01;box[f+1000].scale.z=0.01;box[f+2000].scale.z=0.01;}}}//C
		}

		if(key==87){piruba.position.y +=mr;box[pirubaId+1000].position.y +=mr;box[pirubaId+2000].position.y +=mr;}//W
		if(key==83){piruba.position.y -=mr;box[pirubaId+1000].position.y -=mr;box[pirubaId+2000].position.y -=mr;}//S
		if(key==65){piruba.position.x -=mr;box[pirubaId+1000].position.x -=mr;box[pirubaId+2000].position.x -=mr;}//A
		if(key==68){piruba.position.x +=mr;box[pirubaId+1000].position.x +=mr;box[pirubaId+2000].position.x +=mr;}//D
		cyl[0].position.set(piruba.position.x,piruba.position.y,2);
		show();

		if(key==46 && delval==1){
			myDel();
  			if (confirm(textDel)==true){
				del[pirubaId]=1;
				piruba.position.x=-100;box[pirubaId+1000].position.x=-100;box[pirubaId+2000].position.x=-100;
				piruba.position.y=0;box[pirubaId+1000].position.y=0;box[pirubaId+2000].position.y=0;
				clearalvosel();
				//escdel=1;
			}
		}//DEL

		if(key==79){dopa.style.display="";}//O
		if(key==107){mr=mr+mrpasso;}//+
		if(key==109){if(mr>mrdefault){mr=mr-mrpasso;}}//-

		if(key==49 && e.shiftKey){dres.style.display="";}//SHIFT 1
		if(key==50 && e.shiftKey){dres.style.display="none";}//SHIFT 2

		if(key==106){grava();}//*

		cyl[0].position.set(piruba.position.x,piruba.position.y,2);

		paravi();

		pirubaObj=0;
	}
}

function mudacor(){cor=document.getElementById("favcolor").value;}

function mudabgcor(){
	bgcor=dbgcolor.value;
	dcorpo.style.backgroundColor=bgcor;
	document.getElementById("spancor").innerText=bgcor;
		dztab.style.backgroundColor=bgcor;
		dztab.style.borderColor=corf00f;
		dspanobs.style.backgroundColor=bgcor;
		dspanobs.style.borderColor=corf00f;
	document.getElementById("top").style.backgroundColor=bgcor;
		dobs.style.backgroundColor=bgcor;
		dobs.style.borderColor=corf00f;
		darq.style.backgroundColor=bgcor;
		darq.style.borderColor=corf00f;
	dmenu.style.backgroundColor=bgcor;
	dmenu.style.borderColor=corf00f;
	document.getElementById("spancor").innerText=bgcor;
	dalvosel.style.borderColor=corf00f;
	ditemsel.style.borderColor=corf00f;
		dtexsel.style.borderColor=corf00f;
		dtexsel.value="T";
}

function sOKhide(c){
	create=c;
	if(create==1){	
		butA=0;butB=0;
		alvlen=Number(alvos.length);
		alvlen3=("000"+alvlen.toString()).slice(-3);
		numitemsel=1;
		if(qualsel=="#wall15" && hipo>0.0001){
			fiz=1;
			geo[alvlen]=new THREE.BoxGeometry(hipo,0.15,3);
			geo[alvlen].translate(hipo/2,0,3/2);
			wallcolor=document.getElementById("selcolor").value;
			tex[alvlen]=wallcolor;
			mat[alvlen]=new THREE.MeshBasicMaterial({color:wallcolor,transparent:true,opacity:0.5});
			box[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
			if(tBx>=tAx){box[alvlen].rotation.z=Math.asin(tBy/hipo);}
			if(tBx<tAx){box[alvlen].rotation.z=-Math.asin(tBy/hipo)+p;}
			rota=box[alvlen].rotation.z;
			box[alvlen].rotation.z=rota;
			funwall15();
			fw[alvlen]=hipo;fd[alvlen]=0.15;fh[alvlen]=3;
		}
		if(qualsel=="#toilet"){
			fiz=1;
			toilet[alvlen]=toilet.clone();
			boundingBox=new THREE.Box3().setFromObject(toilet[alvlen]);
			funtoilet();
		}
		if(qualsel=="#toiletb"){
			fiz=1;
			toiletb[alvlen]=toiletb.clone();
			boundingBox=new THREE.Box3().setFromObject(toiletb[alvlen]);
			funtoiletb();
		}
		if(qualsel=="#sink"){
			fiz=1;
			sink[alvlen]=sink.clone();
			boundingBox=new THREE.Box3().setFromObject(sink[alvlen]);
			funsink();
		}
		if(qualsel=="#shower"){
			fiz=1;
			shower[alvlen]=shower.clone();
			boundingBox=new THREE.Box3().setFromObject(shower[alvlen]);
			funshower();
		}
		if(qualsel=="#floorc"){
			fiz=1;
			geo[alvlen]=new THREE.BoxGeometry(Math.abs(Ax-Bx),Math.abs(Ay-By),0.02);
			geo[alvlen].translate(Math.abs(Ax-Bx)/2,-Math.abs(Ay-By)/2,0.01);
			wallcolor=document.getElementById("selcolor").value;
			tex[alvlen]=wallcolor;
			mat[alvlen]=new THREE.MeshBasicMaterial({color:wallcolor});
			floorc[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
			funfloorc();
			fw[alvlen]=Math.abs(Ax-Bx);fd[alvlen]=Math.abs(Ay-By);fh[alvlen]=0.01;
		}
		if(qualsel=="#floort"){
			fiz=1;
			tex[alvlen]="wood_grain.jpg";
			texload[alvlen]=new THREE.TextureLoader(manager).load("img/"+tex[alvlen]);
			geo[alvlen]=new THREE.BoxGeometry(Math.abs(Ax-Bx),Math.abs(Ay-By),0.04);
			geo[alvlen].translate(Math.abs(Ax-Bx)/2,-Math.abs(Ay-By)/2,0.02);
			mat[alvlen]=new THREE.MeshBasicMaterial({map:texload[alvlen],transparent:true});
			floort[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
			funfloort();
			fw[alvlen]=Math.abs(Ax-Bx);fd[alvlen]=Math.abs(Ay-By);fh[alvlen]=0.02;
		}
		if(qualsel=="#boxy"){
			fiz=1;
			larg=document.getElementById("inpw").value;
			prof=document.getElementById("inpd").value;
			alt=document.getElementById("inph").value;
			geo[alvlen]=new THREE.BoxGeometry(larg,prof,alt);
			geo[alvlen].translate(larg/2,-prof/2,alt/2);
			six=[];funsix(sixcolor);tex[alvlen]="sixcolor";
			boxy[alvlen]=new THREE.Mesh(geo[alvlen],six);
			document.getElementById("inpw").value=0.5;
			document.getElementById("inpd").value=0.6;
			document.getElementById("inph").value=2.4;
			funboxy();
			fw[alvlen]=larg;fd[alvlen]=prof;fh[alvlen]=alt;
		}
		funfim();
		dspanobs.innerText="...";
	}
	if(create==0){
		for(let q=1;q<1000;q++){
    			if(document.getElementById("sol").options[q] && document.getElementById("sol").options[q].text.length>9){
				csvstr=document.getElementById("sol").options[q].text;
				Ar=csvstr.split(";");
				qualsel=String(Ar[0]);Ax=parseFloat(Ar[1]);Ay=parseFloat(Ar[2]);rota=parseFloat(Ar[3]);larg=Ar[4];prof=Ar[5];alt=Ar[6];
				pirubaName=qualsel;
				funpirubaObj();
				butA=0;butB=0;
				alvlen=Number(alvos.length);
				alvlen3=("000"+alvlen.toString()).slice(-3);
				numitemsel=1;

				if(qualsel=="#wall15"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					geo[alvlen]=new THREE.BoxGeometry(larg,prof,alt);
					geo[alvlen].translate(larg/2,0,alt/2);
					wallcolor=tex[alvlen];
					mat[alvlen]=new THREE.MeshBasicMaterial({color:wallcolor,transparent:true,opacity:0.5});
					box[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
					box[alvlen].rotation.z=rota;
					funwall15();
					fw[alvlen]=larg;fd[alvlen]=prof;fh[alvlen]=alt;
				}
				if(qualsel=="#toilet"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					toilet[alvlen]=toilet.clone();
					boundingBox=new THREE.Box3().setFromObject(toilet[alvlen]);
					toilet[alvlen].rotation.y=rota;
					funtoilet();
				}
				if(qualsel=="#toiletb"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					toiletb[alvlen]=toiletb.clone();
					boundingBox=new THREE.Box3().setFromObject(toiletb[alvlen]);
					toiletb[alvlen].rotation.y=rota;
					funtoiletb();
				}
				if(qualsel=="#sink"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					sink[alvlen]=sink.clone();
					boundingBox=new THREE.Box3().setFromObject(sink[alvlen]);
					sink[alvlen].rotation.y=rota;
					funsink();
				}
				if(qualsel=="#shower"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					shower[alvlen]=shower.clone();
					boundingBox=new THREE.Box3().setFromObject(shower[alvlen]);
					shower[alvlen].rotation.y=rota;
					funshower();
				}
				if(qualsel=="#floorc"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					geo[alvlen]=new THREE.BoxGeometry(larg,prof,alt);
					geo[alvlen].translate(larg/2,-prof/2,alt/2);
					wallcolor=tex[alvlen];
					mat[alvlen]=new THREE.MeshBasicMaterial({color:wallcolor});
					floorc[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
					floorc[alvlen].rotation.z=rota;
					funfloorc();
					fw[alvlen]=larg;fd[alvlen]=prof;fh[alvlen]=alt;
				}
				if(qualsel=="#floort"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					if(!tex[alvlen]){
						texload[alvlen]=new THREE.TextureLoader(manager).load("img/wood_grain.jpg");
					}else{
						texload[alvlen]=new THREE.TextureLoader(manager).load("img/"+tex[alvlen]);
					}
					geo[alvlen]=new THREE.BoxGeometry(larg,prof,alt);
					geo[alvlen].translate(larg/2,-prof/2,alt/2);
					mat[alvlen]=new THREE.MeshBasicMaterial({map:texload[alvlen],transparent:true});
					floort[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
					floort[alvlen].rotation.z=rota;
					funfloort();
					fw[alvlen]=larg;fd[alvlen]=prof;fh[alvlen]=alt;
				}
				if(qualsel=="#boxy"){
					obs[alvlen]=Ar[7];tex[alvlen]=Ar[8];
					geo[alvlen]=new THREE.BoxGeometry(larg,prof,alt);
					geo[alvlen].translate(larg/2,-prof/2,alt/2);
					if(!tex[alvlen]){tex[alvlen]="cimento2.jpg";}
					if(tex[alvlen].substring(0,3)=="six"){
						six=[];
						funsix(eval(tex[alvlen]));
						boxy[alvlen]=new THREE.Mesh(geo[alvlen],six);
					}else{
						texload[alvlen]=new THREE.TextureLoader(manager).load("img/"+tex[alvlen]);
						mat[alvlen]=new THREE.MeshBasicMaterial({map:texload[alvlen]});
						boxy[alvlen]=new THREE.Mesh(geo[alvlen],mat[alvlen]);
					}
					boxy[alvlen].rotation.z=rota;
					funboxy();
					fw[alvlen]=larg;fd[alvlen]=prof;fh[alvlen]=alt;
				}

			}
		}
		fiz=1;
		butA=0;butB=0;
		alvlen=Number(alvos.length);
		alvlen3=("000"+alvlen.toString()).slice(-3);
		numitemsel=1;
		rota=0;
		funfim();
	}
}

function funwall15(){
	box[alvlen].position.set(Ax,Ay,0);
	box[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(box[alvlen]);alvos.push(box[alvlen]);
	funwaflca();
}

function funtoilet(){
	toilet[alvlen].position.set(Ax,Ay,-0.05);
	toilet[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(toilet[alvlen]);alvos.push(toilet[alvlen]);
	funtosish();
}

function funtoiletb(){
	toiletb[alvlen].position.set(Ax,Ay,-0.05);
	toiletb[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(toiletb[alvlen]);alvos.push(toiletb[alvlen]);
	funtosish();
}

function funsink(){
	sink[alvlen].position.set(Ax,Ay,-0.05);
	sink[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(sink[alvlen]);alvos.push(sink[alvlen]);
	funtosish();
}

function funshower(){
	shower[alvlen].position.set(Ax,Ay,-0.05);
	shower[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(shower[alvlen]);alvos.push(shower[alvlen]);
	funtosish();
}

function funfloorc(){
	floorc[alvlen].position.set(Ax,Ay,0);
	floorc[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(floorc[alvlen]);alvos.push(floorc[alvlen]);
	funwaflca();
}
function funfloort(){
	floort[alvlen].position.set(Ax,Ay,0);
	floort[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(floort[alvlen]);alvos.push(floort[alvlen]);
	funwaflca();
}

function funboxy(){
	boxy[alvlen].position.set(Ax,Ay,0);
	boxy[alvlen].name=qualsel+"_"+alvlen3;
	scene.add(boxy[alvlen]);alvos.push(boxy[alvlen]);
	funwaflca();
}

function funtosish(){
	forpiruba(alvlen);
	wid[alvlen]=parseFloat(boundingBox.max.x-boundingBox.min.x);
	hei[alvlen]=parseFloat(boundingBox.max.y-boundingBox.min.y);
	dep[alvlen]=parseFloat(boundingBox.max.z-boundingBox.min.z);
	geo[alvlen+1000]=new THREE.BoxGeometry(wid[alvlen],hei[alvlen],dep[alvlen]);
	geo[alvlen+1000].translate(0,-hei[alvlen]/2,dep[alvlen]/2);
	mat[alvlen+1000]=new THREE.MeshBasicMaterial({color:'#009',wireframe:true});
	box[alvlen+1000]=new THREE.Mesh(geo[alvlen+1000],mat[alvlen+1000]);
	box[alvlen+1000].position.set(Ax,Ay,-0.05);
	box[alvlen+1000].rotation.z=rota;
	box[alvlen+1000].name=qualsel+"_"+alvlen3+"_";
	fun2000();
}

function funwaflca(){
	forpiruba(alvlen);
	geo[alvlen+1000]=geo[alvlen].clone();
	mat[alvlen+1000]=new THREE.MeshBasicMaterial({color:'#009',wireframe:true});
	box[alvlen+1000]=new THREE.Mesh(geo[alvlen+1000],mat[alvlen+1000]);
	box[alvlen+1000].position.set(Ax,Ay,0);
	box[alvlen+1000].rotation.z=rota;
	fun2000();
}

function funfim(){
	rota=0;
	dAx.value=0;dAy.value=0;dBx.value=0;dBy.value=0;
	ditemsel.value="S";
	qualsel="S";
	const mytime=setTimeout(mfunc,750);
	clearalvosel();
	numitemsel=0;
	show();
	circs();
	dsBA.style.display="none";dsBB.style.display="none";dsBC.style.display="none";dsBW.style.display="none";dsBD.style.display="none";dsBH.style.display="none";dsOK.style.display="none";
}

function mfunc(){
	ditemsel.style.borderStyle="outset";
	ditemsel.style.borderColor=corf00f;
}

function fun2000(){
	geo[alvlen+2000]=geo[alvlen+1000].clone();
	mat[alvlen+2000]=new THREE.MeshStandardMaterial({color:'#009',wireframe:true,transparent:true,opacity:0.1});
	box[alvlen+2000]=new THREE.Mesh(geo[alvlen+2000],mat[alvlen+2000]);
	box[alvlen+2000].position.set(Ax,Ay,-0.05);
	box[alvlen+2000].rotation.z=rota;
	box[alvlen+2000].name=qualsel+"_"+alvlen3;
	scene.add(box[alvlen+2000]);
	alvos2.push(box[alvlen+2000]);
}

function mudatex(){
	let numo=dnumtex.value;
	if(Number(numo)>0 && alvos[numo]){
		let texo=dtexsel.value;
		if(texo!="T"){
			tex[numo]=texo.toString();
			if(boxy[numo]){
				if(texo.substring(0,3)=="six"){
					six=[];
					funsix(eval(texo));
					boxy[numo].material=six;
					dimgtex.value=texo.toString();
				}else{
					boxy[numo].material=new THREE.MeshBasicMaterial({map:new THREE.TextureLoader(manager).load("img/"+tex[numo]),color:'#fff',transparent:true});
				}
			}
			if(floort[numo] && texo!="bridge" && texo!="tun"){
				floort[numo].material=new THREE.MeshBasicMaterial({map:new THREE.TextureLoader().load("img/"+tex[numo]),color:'#fff',transparent:true});
				dimgtex.value=texo.toString();
			}
		}
		ewall=0;
		if(box[numo]){
			ewall=1;
			tex[numo]=dcorwal.value;
			box[numo].material.color.set(tex[numo]);
		}
		if(floorc[numo]){
			ewall=1;
			tex[numo]=dcorwal.value;
			floorc[numo].material.color.set(tex[numo]);
		}
		forpiruba(numo);
	}
	dtexsel.value="T";
	if(ewall==1){dimgtex.value=dcorwal.value;}
}

function mudaopa(){
	for(let j=1;j<1000;j++){
		if(alvos[j]){
			let tipo=alvos[j].name.substring(0,4);
			if(tipo=="#wal"){box[j].material.opacity=dvalopa.value;}
		}
	}
}

function funfazsel(){
	let filter=document.getElementById("imgsel");
	let option=document.createElement("option");
	let sfilter="";
	for(let q=1;q<1000;q++){
		if(dtexsel.options[q]){
			sfilter=dtexsel.options[q].text;
			if(sfilter.substring(0,1)!="#"){
				option=document.createElement("option");
				option.text=sfilter;
				filter.add(option);
			}
		}
	}
}

function menuY(){if(mmenu==1){dmenu.style.left="-2px";dmenu.style.opacity="0.99";}}
function menuN(){if(mmenu==1){dmenu.style.left="-494px";dmenu.style.opacity="0.5";}}

function funimg(){
	for(let m=1;m<41;m++){if(document.getElementById("op"+m)){document.getElementById("op"+m).style.display="";}}
	for(let m=21;m<41;m++){if(document.getElementById("op"+m)){document.getElementById("op"+m).style.display="none";}}
}

function funtex(){
	for(let m=1;m<41;m++){if(document.getElementById("op"+m)){document.getElementById("op"+m).style.display="";}}
	document.getElementById("op40").style.display="none";
	for(let m=1;m<21;m++){if(document.getElementById("op"+m)){document.getElementById("op"+m).style.display="none";}}
}

function funwal(){
	for(let m=1;m<21;m++){if(document.getElementById("op"+m)){document.getElementById("op"+m).style.display="none";}}
	dcorwal.value=tex[dnumtex.value];
	dcorwal.style.display="";
}

function poscyl(){
	cyl[0].position.set(piruba.position.x,piruba.position.y,2);
	show();
}

function repla(){window.location.replace(window.location.href);}

// Animate ********
function animate(){
	requestAnimationFrame(animate);
	w++;w++;
	if(w==8){dcorpo.style.backgroundImage="url('img/transpa.png')";}

	if(w>50 && w<150){dmenu.style.opacity=0.99;dmenu.style.left=(-496+w-50)+"px";}
	if(w>150 && w<250){dmenu.style.opacity=0.5;dmenu.style.left=(-396-w+150)+"px";}
	if(w==252){mmenu=1;}

	if(dobsobs.style.opacity=="0.5"){dobsobs.style.opacity="1";myObs();}

	if(telaant!=tela){
		document.getElementById("spanD").innerText=tela;
		telaant=tela;
		if(telaant==2){
			//controles.activate();
			for(let f=1;f<1000;f++){scene.remove(vi[f]);}
			dcorpo.style.cursor="default";
			document.getElementById("topalvosel").style.display="none";
			document.getElementById("topselect").style.display="";
			dtopedit.style.display="none";
			scene.rotation.x=0;
			controls.reset();
			controls.enablePan=true;
			controls.reset();
			controls.enableRotate=false;
			controls.enablePan=true;
			camera.position.set(0,0,poszantes);
			controls.update();
		}
		if(telaant==3){
			//controles.deactivate();
			dcorpo.style.cursor="pointer";
			dobs.style.display="none";
			dztab.style.display="none";
			document.getElementById("topalvosel").style.display="";
			dtopedit.style.display="";
			scene.rotation.x=-p/2.2;
			controls.reset();
			controls.enableRotate=true;
			controls.enablePan=true;
			controls.reset();
			controls.update();
			camera.position.z=25;
			butA=0;butB=0;
			dBB.style.backgroundColor="#900";
			dBB.style.borderStyle="outset";
			dBB.style.borderColor=cor0ff0;
				dBA.style.backgroundColor="#900";
				dBA.style.borderStyle="outset";
				dBA.style.borderColor=cor0ff0;
		}
	}
	if(fiz==0){
		Ax=parseFloat(dAx.value);Ay=parseFloat(dAy.value);
		Bx=parseFloat(dBx.value);By=parseFloat(dBy.value);
		tAx=0.00001;tAy=0.00001;
		tBx=Bx-Ax;tBy=By-Ay;
		hipo=Math.sqrt(Math.pow(Math.abs(tAx-tBx),2)+Math.pow(Math.abs(tAy-tBy),2));
		funpirubaObj();
		circs();
		if(qualsel!="S"){
			if(pirubaObj==2){
				geo[0]=new THREE.BoxGeometry(hipo,0.1,0);
				geo[0].translate(hipo/2,0,0);
				mat[0]=new THREE.MeshBasicMaterial({color:'#900'});
				box[0]=new THREE.Mesh(geo[0],mat[0]);
				if(tBx>=tAx){box[0].rotation.z=Math.asin(tBy/hipo);}
				if(tBx<tAx){box[0].rotation.z=-Math.asin(tBy/hipo);box[0].rotation.y=p;box[0].rotation.x=-p;}
				box[0].position.set(Ax,Ay,0);
				scene.add(box[0]);
				cir[0].position.set(Ax,Ay,0);scene.add(cir[0]);cir[1].position.set(Bx,By,0);scene.add(cir[1]);
				fiz=1;
			}
			if(pirubaObj==3 && qualsel!="#boxy"){cir[0].position.set(Ax,Ay,0);scene.add(cir[0]);cir[1].position.set(Bx,By,0);scene.add(cir[1]);fiz=1;}
			if(qualsel=="#boxy"){cir[0].position.set(Ax,Ay,0);scene.add(cir[0]);fiz=1;}
			if(pirubaObj==1){cir[0].position.set(Ax,Ay,0);scene.add(cir[0]);fiz=1;}
			if(pirubaObj==0){circs();fiz=1;}
		}
	}

	if(escdel==1){
		dtopedit.style.display="none";
		qualsel="S";
		//paravi();
		scene.remove(cyl[0]);
		for(let f=0;f<1000;f++){
			scene.remove(box[f+1000]);
			scene.remove(box[f+2000]);
		}
		escdel=0;
	}

	controls.update();
	renderer.render(scene,camera);

// Animate End ********
}

document.getElementById("arqname").value=nomarq;
document.getElementById("ztab").style.left=window.innerWidth-120+"px";

window.setTimeout(indo,2410);

function loadXMLDoc(url,cfunc){
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
	xmlhttp.onreadystatechange=cfunc;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

function myFunction(){
	loadXMLDoc(nomarq,function(){
	if(xmlhttp.readyState==4 && xmlhttp.status==200){
		myArray=xmlhttp.responseText.split("\n");
		for(let k=0;k<1000;k++){
			var opt=document.createElement('option');
			if(myArray[k]){
				opt.value=myArray[k];
				opt.innerHTML=myArray[k];
				sol.appendChild(opt);
			}
		}
	}});
	window.setTimeout(vindo,500);
}

function vindo(){sOKhide(0);}

</script>

<p style='position:absolute;left:300px;top:450px;display:none;' id="ppara" class="unbroken">Bom Retiro Sao Paulo Sao Paulo Brasil</p>
<p class="broken" style='position:absolute;left:300px;top:470px;display:none;'></p>

<script>
/*
Paruba: a light and fast alternative to sketch floorplan

The Paruba project is an alternative for sketching simple construction plants.
You won't have the possibility to save your project in Showcase site.
Removing slashes in a comment, then You will be able to save objects in Your Server.

Thanks for the creative and knowledgeable staff of Three.js.

Jose Roberto Lazzareschi
*/
</script>

</body>
</html>
