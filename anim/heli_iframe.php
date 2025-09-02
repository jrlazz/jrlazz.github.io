<!DOCTYPE html>
<html lang="en">
<head>
<title>heli_iframe.php</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="../three.js.ico">
<link type="text/css" rel="stylesheet" href="main.css">
<style>
body {background-color:#004466;color:#ff0;}
div{position:absolute;top:500px;}
</style>
</head>

<body id="bod">
<span id="spanid" style="position:absolute;left:-20px;top:-20px;color:#fff;font-size:3pt;">
0
</span>
<div id="container" style="position:absolute;top:0px;"></div>

<script type="module">

//import * as THREE from './js/three.module.js';
//import { DDSLoader } from '../js/DDSLoader_res.js';
//import { MTLLoader } from '../js/MTLLoader_res.js';
//import { OBJLoader } from '../js/OBJLoader_res.js';

import * as THREE from 'https://cdn.skypack.dev/three/build/three.module.js';
import { DDSLoader } from 'https://cdn.skypack.dev/three/examples/jsm/loaders/DDSLoader.js';
import { MTLLoader } from 'https://cdn.skypack.dev/three/examples/jsm/loaders/MTLLoader.js';
import { OBJLoader } from 'https://cdn.skypack.dev/three/examples/jsm/loaders/OBJLoader.js';

	let mixer;

	const clock = new THREE.Clock();

	const container = document.getElementById( 'container' );

var target = new THREE.Vector3(); // create once an reuse it

var altera=0;
var completo=0;
var conta=0;
var passo=0.005;
var mov=0.05;
var point;
var cor;


const objects = [];

var k=0;

var rot=new Array();
rot[1]=0;

var w=0;
var ww=0;
var etapa=0;

var bone=new Array();bone=new THREE.Group();for(k=0;k<27;k++){bone[k]=new THREE.Group();}
var arte=new Array();arte=new THREE.Group();for(k=0;k<27;k++){arte[k]=new THREE.Group();}
var heli=new Array();heli=new THREE.Group();for(k=0;k<3;k++){heli[k]=new THREE.Group();}
var nave=new Array();nave=new THREE.Group();for(k=0;k<3;k++){nave[k]=new THREE.Group();}
var de2ra=function(degree){return degree*(Math.PI/180);};

var teclaA=0;var teclaD=0;
var teclaW=0;var teclaS=0;
var teclaG=0;var teclaH=0;
var teclaC=0;var teclaB=0;
var teclaV=0;
var setaE=0;var setaD=0;
var setaC=0;var setaB=0;

		//const stats = new Stats();
		//container.appendChild( stats.dom );

		const renderer = new THREE.WebGLRenderer( { antialias: true } );
		renderer.setPixelRatio( window.devicePixelRatio );
		renderer.setSize( window.innerWidth, window.innerHeight );
		container.appendChild( renderer.domElement );

		const scene=new THREE.Scene();
		scene.background=new THREE.Color(0x004466);

		const camera=new THREE.PerspectiveCamera(80,window.innerWidth/window.innerHeight,.5,200);
		camera.position.set(0,1,1.9);
		camera.position.set(0.5,1,3);
		camera.position.set(0,0,7);

	const manager=new THREE.LoadingManager();
	manager.onStart=function(url,itemsLoaded,itemsTotal){console.log('Started loading file:'+url+'.\nLoaded '+itemsLoaded+' of '+itemsTotal + ' files.' );};
	manager.onLoad=function(){console.log('Loading complete!');};
	manager.onProgress=function(url,itemsLoaded,itemsTotal){console.log('loading texture'+url+' '+(itemsLoaded/itemsTotal*100)+'%');};
	manager.onError=function(url){console.log('Error loading texture:'+url);};
	manager.addHandler(/\.dds$/i,new DDSLoader());

// luzes
	const ambientLight=new THREE.AmbientLight("#ffcc99",2);
	ambientLight.position.set(30,20,30);
	scene.add(ambientLight);
	point=new THREE.PointLight(0xffff00,2);//color,intensity,range,decay
	const axes=new THREE.AxesHelper(16);

// MTL
var mo="models/steve/partes.mtl";
var cox="models/steve/vivicox.obj";
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load('models/steve/steve_ca.obj',function(object){bone[0][0]=object;});});
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load('models/steve/steve_to.obj',function(object){bone[0][1]=object;});});
// 6 iguais a vivicox
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(cox,function(object){bone[2][0]=object;});});

	window.onresize = function () {

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize( window.innerWidth, window.innerHeight );

	};

function animate() {
	requestAnimationFrame(animate);
	ww++;
	if(ww==200){
		scene.add(bone[20]);
		point.position.set(0,10,2);
		scene.add(point);
		//scene.add(axes);
		//axes.position.set(0,0,9);
		bone[20].position.set(0,2.5,0);
	}


if(ww==200){window.parent.document.getElementById('spanic').innerHTML="<center>...</center>";}
if(ww==300){window.parent.document.getElementById('spanic').innerHTML="<center></center>";}

	if(conta==0 && ww>200){alterando();}

	if(altera==1){
		w++;

		if(bone[3].rotation.x>=1.071){rot[1]=1;}
		if(bone[3].rotation.x<-1.071){rot[1]=0;}

		if(rot[1]==0){
			bone[20][0].rotation.y -=passo*5;
			bone[22][0].rotation.x -=passo*5;
			bone[3].rotation.x +=passo*10;
			//bone[3][1].rotation.x +=passo*5;
		}else{
			bone[20][0].rotation.y +=passo*5;
			bone[22][0].rotation.x +=passo*5;
			bone[3].rotation.x -=passo*10;
			//bone[3][1].rotation.x -=passo*5;
		}

		cor=document.getElementById("spanid").innerHTML;

		bone[20].rotation.y=Number(cor);

		if(Number(cor)>0){
			bone[20].scale.set(1.5,1.5,1.5);
		}else{
			bone[20].scale.set(1,1,1);
		}
	}

	renderer.render( scene, camera );
}

function alterando(){
	conta++;
	
// 0:Cabeça 1:Torso 2:BD 3:BE 4:PD 5:PE

	bone[3][0]=bone[2][0].clone(); // vivicox membro sup esq braço BEs
	bone[3][1]=bone[2][0].clone(); // vivicox sup esq antebraço BEi

	bone[20][0]=bone[0][0].clone(); // CA
	bone[20][1]=bone[0][1].clone(); // TR
	bone[22][0]=bone[2][0].clone(); // vivicox membro sup dir BDs
	bone[22][1]=bone[2][0].clone(); // vivicox membro inf dir BDi
	bone[23][0]=bone[2][0].clone(); // vivicox membro sup esq braço BEs
	bone[23][1]=bone[2][0].clone(); // vivicox sup esq antebraço BEi
	bone[24][0]=bone[2][0].clone(); // vivicox inf dir coxa PDs
	bone[24][1]=bone[2][0].clone(); // vivicox inf dir perna PDi
	bone[25][0]=bone[2][0].clone(); // vivicox inf esq coxa PEs
	bone[25][1]=bone[2][0].clone(); // vivicox inf esq perna PEi


	bone[20][0].position.set(0,0,0);
	bone[20][0].scale.set(1,1,1);
	bone[20][1].position.set(0,0,0);

	bone[22][0].position.set(-1.8,-0.5,0);
	bone[22][0].scale.set(0.8,0.5,0.8);
	bone[22][0].rotation.set(-1.7,0,0);
	bone[22][1].scale.set(0.8,1,0.8);
	bone[22][1].position.set(0,-3,0);
	bone[22][1].rotation.set(0.2,0,0);
	bone[22][0].add(bone[22][1]);

	bone[23][0].position.set(1.8,0,0);
	bone[23][0].scale.set(0.8,0.5,0.8);
	bone[23][1].scale.set(0.8,1,0.8);
	bone[23][1].position.set(0,-3,0);
	bone[23][1].rotation.set(-0.3,0,0);
	bone[23][0].add(bone[23][1]);

	bone[24][0].position.set(-0.7,-2.7,0);
	bone[24][0].scale.set(0.8,0.8,0.8);
	bone[24][0].rotation.set(-1.57,0,0);
	bone[24][1].position.set(0,-3,0);
	bone[24][1].rotation.set(1.57,0,0);
	bone[24][0].add(bone[24][1]);

	bone[25][0].position.set(0.7,-2.7,0);
	bone[25][0].scale.set(0.8,.8,0.8);
	bone[25][0].rotation.set(-1.57,0,0);
	bone[25][1].position.set(0,-3,0);
	bone[25][1].rotation.set(1.57,0,0);
	bone[25][0].add(bone[25][1]);

	bone[20].scale.set(1,1,1);

	bone[20].add(bone[20][0]);
	bone[20].add(bone[20][1]);
	bone[20].add(bone[22][0]);
	bone[20].add(bone[23][0]);
	bone[20].add(bone[24][0]);
	bone[20].add(bone[25][0]);

altera++;

}


animate();

//window.parent.document.getElementById('spanid').innerHTML="JOSÉ";

</script>
</body>
</html>
