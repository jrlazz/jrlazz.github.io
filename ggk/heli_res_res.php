<!DOCTYPE html>
<html lang="en">
<head>
<title>heli.php</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../three.js.ico">
<link type="text/css" rel="stylesheet" href="main.css">
<style>
body {background-color:#000000;color:#ff0;}
a{color: #2983ff;}
</style>
</head>

<body>

<span id="spanid" style="position:absolute;left:10px;top:10px;width:100px;font-family:Lucida Console;color:#fc0;font-size:14pt;font-weight:bold;line-height:16px;z-index:2;">
<center><img src="img/arrows.png" width="70"></img><br>W or S
</center>
</span>
<span id="spanid" style="position:absolute;left:11px;top:11px;width:100px;font-family:Lucida Console;color:#000;font-size:14pt;font-weight:bold;line-height:16px;z-index:2;">
<center><img src="img/arrows.png" width="70"></img><br>W or S
</center>
</span>
<span id="spanic" style="position:absolute;left:10px;top:50%;width:99%;font-family:Lucida Console;color:#fc0;font-size:24pt;font-weight:bold;line-height:16px;z-index:2;">
<center>... downloading ...</center>
</span>
<iframe id="ifra" src="heli_iframe_res_res.php" scrolling="no" style="position:absolute;left:10px;top:80px;width:100px;height:100px;border-width:2px;border-color:#000 #fff #fff #000;overflow:hidden;z-index:2;">
<center>

</center>
</iframe>

<div id="container"></div>

<script type="module">

import * as THREE from '../js/three.module_res_res.js';
import { DDSLoader } from '../js/DDSLoader_res_res.js';
import { MTLLoader } from '../js/MTLLoader_res_res.js';
import { OBJLoader } from '../js/OBJLoader_res_res.js';

	let mixer;

	const clock = new THREE.Clock();

	const container = document.getElementById( 'container' );

var target = new THREE.Vector3();
var altera=0;
var completo=0;
var conta=0;
var passo=0.005;
var mov=0.05;
var point;
var axes;
var circle;

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


		const renderer = new THREE.WebGLRenderer( { antialias: true } );
		renderer.setPixelRatio( window.devicePixelRatio );
		renderer.setSize( window.innerWidth, window.innerHeight );
		container.appendChild( renderer.domElement );

		const pmremGenerator= new THREE.PMREMGenerator(renderer);

		const scene=new THREE.Scene();
		scene.background=new THREE.Color(0x44aadd);
		const camera=new THREE.PerspectiveCamera(80,window.innerWidth/window.innerHeight,.5,200);
		camera.position.set(0,5,30);
		camera.position.set(0,-30,0);

	const manager=new THREE.LoadingManager();
	manager.onStart=function(url,itemsLoaded,itemsTotal){console.log('Started loading file:'+url+'.\nLoaded '+itemsLoaded+' of '+itemsTotal + ' files.' );};
	manager.onLoad=function(){console.log('Loading complete!');};
	manager.onProgress=function(url,itemsLoaded,itemsTotal){console.log('loading texture'+url+' '+(itemsLoaded/itemsTotal*100)+'%');};
	manager.onError=function(url){console.log('Error loading texture:'+url);};
	manager.addHandler(/\.dds$/i,new DDSLoader());



// luzes
	const ambientLight=new THREE.AmbientLight("#fff",1);
	ambientLight.position.set(30,20,30);
	scene.add(ambientLight);

	point=new THREE.PointLight(0xff9900,3,3,2);//color,intensity,range,decay
	point.position.set(0,-1,27);

// MTL

mo="models/artes/Town.mtl";
var arteA="models/artes/Town.obj";
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(arteA,function(object){arte[1]=object;});});

var mo="models/steve/partes.mtl";
var cox="models/steve/vivicox.obj";
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load('models/steve/steve_ca.obj',function(object){bone[0][0]=object;});});
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load('models/steve/steve_to.obj',function(object){bone[0][1]=object;});});
// 6 iguais a vivicox
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(cox,function(object){bone[2][0]=object;});});

var mo="models/extras/heli_body.mtl";
var heli0="models/extras/heli_body.obj";
var heli1="models/extras/heli_sup.obj";
var heli2="models/extras/heli_tra.obj";
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(heli0,function(object){heli[0]=object;});});
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(heli1,function(object){heli[1]=object;});});
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(heli2,function(object){heli[2]=object;});});

mo="models/extras/naveE.mtl";
var nave0="models/extras/naveE.obj";
new MTLLoader(manager).load(mo,function(mat){mat.preload();new OBJLoader(manager).setMaterials(mat).load(nave0,function(object){nave[0]=object;});});


	//goldenrod
		const textureA=new THREE.TextureLoader(manager).load('img/fl4.jpg');
		textureA.wrapS=THREE.RepeatWrapping;
		textureA.wrapT=THREE.RepeatWrapping;
		textureA.repeat.set(10,1);
		var geoA=new THREE.BoxGeometry(3,10,3);
		const matA=new THREE.MeshBasicMaterial({map:textureA});
		var ACube=new THREE.Mesh(geoA,matA);
		ACube.position.set(-4,5,-9);
		scene.add(ACube);


	const textureF=new THREE.TextureLoader(manager).load('models/futebol.jpg');
	textureF.wrapS=THREE.RepeatWrapping;textureF.wrapT=THREE.RepeatWrapping;
	textureF.repeat.set(1,1);
	const metryF=new THREE.BoxGeometry(12,0.1,8);
	const erialF=new THREE.MeshBasicMaterial({map:textureF});
	const futebol=new THREE.Mesh(metryF,erialF);
	futebol.position.set(-15,0.15,-9);
	scene.add(futebol);

	var goldenrodT=new THREE.TextureLoader(manager).load('models/lajinha_amarela-are-1.jpg');
	goldenrodT.wrapS=THREE.RepeatWrapping;
	goldenrodT.wrapT=THREE.RepeatWrapping;
	goldenrodT.repeat.set(12,6);
	var goldenrodG=new THREE.BoxGeometry(22,0.1,9);
	var goldenrodM=new THREE.MeshBasicMaterial({map:goldenrodT});
	var goldenrodB=new THREE.Mesh(goldenrodG,goldenrodM);
	goldenrodB.position.set(-13,0.1,-9);
	scene.add(goldenrodB);

	// teal
	cubeGeometry=new THREE.BoxGeometry(1.5,10,1.5);
	cubeMaterial=new THREE.MeshBasicMaterial({color:'teal',transparent:true,opacity:1});
	var BCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
	BCube.position.set(3,5,-5);
	scene.add(BCube);

		const textureY=new THREE.TextureLoader(manager).load('img/fl1.jpg');
		textureY.wrapS=THREE.RepeatWrapping;
		textureY.wrapT=THREE.RepeatWrapping;
		textureY.repeat.set(6,1);
		var metryY=new THREE.BoxGeometry(1.5,8,1.5);
		const erialY=new THREE.MeshBasicMaterial({map:textureY});
		var mesh=new THREE.Mesh(metryY,erialY);
		mesh.position.set(10,4,-5);
		scene.add(mesh);

		const textureZ=new THREE.TextureLoader(manager).load('img/fl5.jpg');
		textureZ.wrapS=THREE.RepeatWrapping;
		textureZ.wrapT=THREE.RepeatWrapping;
		textureZ.repeat.set(10,1);
		var metryZ=new THREE.BoxGeometry(1.5,8,1.5);
		const erialZ=new THREE.MeshBasicMaterial({map:textureZ});
		mesh=new THREE.Mesh(metryZ,erialZ);
		mesh.position.set(15,4,-5);
		scene.add(mesh);




	cubeGeometry=new THREE.BoxGeometry(1.5,5,1.5);
	cubeMaterial=new THREE.MeshBasicMaterial({color:0x990000,transparent:true,opacity:1});
	var CCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
	CCube.position.set(5,2.5,-5);
	scene.add(CCube);

	cubeGeometry=new THREE.BoxGeometry(1.5,5,1.5);
	cubeMaterial=new THREE.MeshBasicMaterial({color:0x006699});
	var DCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
DCube.receiveShadow=true;
	DCube.position.set(3,2.5,0);scene.add(DCube);

	cubeMaterial=new THREE.MeshBasicMaterial({color:0x996699});
	var ECube=new THREE.Mesh(cubeGeometry,cubeMaterial);
ECube.receiveShadow=true;
	ECube.position.set(6,2.5,0);scene.add(ECube);

	cubeMaterial=new THREE.MeshBasicMaterial({color:0x000099});
	var FCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
FCube.receiveShadow=true;
	FCube.position.set(9,2.5,0);scene.add(FCube);

	cubeGeometry=new THREE.BoxGeometry(1,1,1);
	cubeMaterial=new THREE.MeshBasicMaterial({color:0x000000});
	var camA=new THREE.Mesh(cubeGeometry,cubeMaterial);
	//camA.position.set(0,15,0);
	cubeGeometry=new THREE.BoxGeometry(0.7,0.7,0.7);
	cubeMaterial=new THREE.MeshBasicMaterial({color:0xffff00});
	var camB=new THREE.Mesh(cubeGeometry,cubeMaterial);
	//camB.position.set(0,15,40);

var group1=new THREE.Group();
var group2=new THREE.Group();
var group3=new THREE.Group();
group1.add(DCube);
group1.add(ECube);
group1.add(FCube);scene.add(group1);
group2=group1.clone();group2.position.set(0,0,3);scene.add(group2);
group3=group1.clone();group3.position.set(0,0,6);scene.add(group3);


// tampao inferior
	var cubeGeometry=new THREE.BoxGeometry(100,0.1,100);
	var cubeMaterial=new THREE.MeshBasicMaterial({color:0x001122});
	var blackCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
	blackCube.position.set(50,-50,0);
	blackCube.rotation.set(0,0,1.57);
	scene.add(blackCube);
	var blackCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
	blackCube.position.set(-50,-50,0);
	blackCube.rotation.set(0,0,1.57);
	scene.add(blackCube);
	var blackCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
	blackCube.position.set(0,-50,-50);
	blackCube.rotation.set(0,1.57,1.57);
	scene.add(blackCube);
	var blackCube=new THREE.Mesh(cubeGeometry,cubeMaterial);
	blackCube.position.set(0,-50,50);
	blackCube.rotation.set(0,1.57,1.57);
	scene.add(blackCube);


// GRIDS
	var gridBaseGeo=new THREE.BoxGeometry(100,100,0.01);
	var gridBaseMat=new THREE.MeshPhongMaterial({color:0x444444});
	var gridBase=new THREE.Mesh(gridBaseGeo,gridBaseMat);
	gridBase.position.set(0,0,0);
	gridBase.rotation.x=de2ra(90);
	gridBase.receiveShadow=true;
	scene.add(gridBase);

	var gridBaseMat=new THREE.MeshPhongMaterial({color:0x001122});
	var gridBase=new THREE.Mesh(gridBaseGeo,gridBaseMat);
	gridBase.position.set(0,-0.1,0);
	gridBase.rotation.x=de2ra(90);
	gridBase.receiveShadow=true;
	scene.add(gridBase);

	var grid=new THREE.GridHelper(100,50);//size,divisions
	grid.material.color.setHex(0xffffff);
	grid.position.set(0,0.1,0);
	scene.add(grid);

//RUAS
	var ruaGeo=new THREE.BoxGeometry(100,2,0.01);
	var ruaMat=new THREE.MeshPhongMaterial({color:0x303030});
	var Arua=new THREE.Mesh(ruaGeo,ruaMat);
	Arua.position.set(0,0.2,0);
	Arua.rotation.set(de2ra(90),0,de2ra(90));
	Arua.receiveShadow=true;
	scene.add(Arua);

	ruaGeo=new THREE.BoxGeometry(100,2,0.01);
	ruaMat=new THREE.MeshPhongMaterial({color:0x303030});
	var Brua=new THREE.Mesh(ruaGeo,ruaMat);
	Brua.position.set(0,0.2,-25);
	Brua.rotation.set(de2ra(90),0,de2ra(0));
	Brua.receiveShadow=true;
	scene.add(Brua);


// textos
	var canvas1=document.createElement('canvas');
	var ctx=canvas1.getContext('2d');
	ctx.font="Normal 50px Arial";
	ctx.fillStyle="#fff";
	ctx.textAlign="center";
	ctx.fillText('Goldenrod',150,80);
	var tex1=new THREE.Texture(canvas1)
	tex1.needsUpdate=true;
	var mat1=new THREE.MeshBasicMaterial({map:tex1,side:THREE.DoubleSide});
	mat1.transparent=true;
	var mesh1=new THREE.Mesh(new THREE.PlaneGeometry(3,1.6),mat1);
	mesh1.position.set(-4,9,-7.4);
	scene.add(mesh1);

	var canvas1=document.createElement('canvas');
	var ctx=canvas1.getContext('2d');
	ctx.font="Normal 50px Arial";
	ctx.fillStyle="#000";
	ctx.textAlign="center";
	ctx.fillText('Teal',150,80);
	tex1=new THREE.Texture(canvas1)
	tex1.needsUpdate=true;
	mat1=new THREE.MeshBasicMaterial({map:tex1,side:THREE.DoubleSide});
	mat1.transparent=true;
	mesh1=new THREE.Mesh(new THREE.PlaneGeometry(3,1.6),mat1);
	mesh1.position.set(3,9,-4.2);
	scene.add(mesh1);


// sky
	const loader = new THREE.TextureLoader();
	loader.load('models/sky_cores_3.jpg',function(texture){
	//texture.encoding=THREE.sRGBEncoding;
	texture.mapping=THREE.EquirectangularReflectionMapping;
	scene.background=texture;  
});


//	animate();

	window.onresize = function () {

	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize( window.innerWidth, window.innerHeight );

	};


function animate() {
	requestAnimationFrame(animate);
	const delta=clock.getDelta();

	ww++;

	if(ww==400){
	camA.position.set(0,-5,-50);
	camA.position.set(0,40,-50);
	camB.position.set(0,0,40);
		heli[0].add(heli[1]);
		heli[0].add(heli[2]);
		heli[0].add(bone[20]);
		heli[0].add(point);
	heli[0].add(camA);
	heli[0].add(camB);
		heli[1].position.set(0,7.9,12);
		heli[2].position.set(1.2,5.8,-32);
		heli[2].rotation.set(0,0,1.57);
		heli[0].scale.set(.05,.05,.05);
		heli[0].rotation.set(0,3.14,0);
		heli[0].position.set(0,1,0);
		scene.add(heli[0]);

		arte[1].scale.set(0.5,0.5,0.5);
		arte[1].position.set(5,0,12);
		scene.add(arte[1]);

		nave[0].position.set(-10,10,-12);
		nave[0].rotation.set(0.25,0,0);
		nave[0].scale.set(0.01,0.01,0.01);
		scene.add(nave[0]);
	}


	if(conta==0 && ww>600){alterando();}

	if(altera==1){

		scene.updateMatrixWorld(true);
		//target.getPositionFromMatrix(bone[0].matrixWorld);
		target.setFromMatrixPosition(camB.matrixWorld);
		//alert(target.x + ',' + target.y + ',' + target.z);
		camera.lookAt(target.x,target.y,target.z);

		scene.updateMatrixWorld(true);
		target.setFromMatrixPosition(camA.matrixWorld);
		camera.position.set(target.x,target.y,target.z);

		if(bone[3].rotation.x>=1.071){rot[1]=1;bone[4].rotation.x=1.071;}
		if(bone[3].rotation.x<-1.071){rot[1]=0;bone[5].rotation.x=1.071;}

		if(rot[1]==0){
			bone[0].rotation.z +=passo*2;
			bone[0][0].rotation.y -=passo*5;
			bone[20][0].rotation.y -=passo*5;
			bone[22][0].rotation.x -=passo*5;
			bone[0][1].rotation.y +=passo*2;bone[0][1].rotation.x +=passo*2;
			bone[2].rotation.x -=passo*10;bone[2][1].rotation.x -=passo*5;bone[2][2].rotation.x -=passo*5;
			bone[3].rotation.x +=passo*10;bone[3][1].rotation.x +=passo*5;
			bone[4].rotation.x +=passo*10;bone[4][1].rotation.x +=passo;
			bone[5].rotation.x -=passo*10;bone[5][1].rotation.x -=passo;
		}else{
			bone[0].rotation.z -=passo*2;
			bone[0][0].rotation.y +=passo*5;
			bone[20][0].rotation.y +=passo*5;
			bone[22][0].rotation.x +=passo*5;
			bone[0][1].rotation.y -=passo*2;bone[0][1].rotation.x -=passo*2;
			bone[2].rotation.x +=passo*10;bone[2][1].rotation.x +=passo*5;bone[2][2].rotation.x +=passo*5;
			bone[3].rotation.x -=passo*10;bone[3][1].rotation.x -=passo*5;
			bone[4].rotation.x -=passo*10;bone[4][1].rotation.x -=passo;
			bone[5].rotation.x +=passo*10;bone[5][1].rotation.x +=passo;
		}

		w++;

		if(w==1){bone[0].position.set(-20,0.5,-5);}
		if(etapa==0){bone[0].position.x +=passo*20;}
		if(bone[0].position.x>-9.5){etapa=1;}
		if(etapa==1){bone[0].rotation.y=Math.PI;bone[0].position.z -=passo*10;}
		if(bone[0].position.z<-12.5){etapa=2;}
		if(etapa==2){bone[0].rotation.y=-Math.PI/2;bone[0].position.x -=passo*20;}
		if(bone[0].position.x<-20){etapa=3;}
		if(etapa==3){bone[0].rotation.y=0;bone[0].position.z +=passo*10;}
		if(bone[0].position.z>-5.5){bone[0].rotation.y=Math.PI/2;etapa=0;}

		heli[1].rotation.y -=0.1;
		heli[2].rotation.x -=0.1;
		nave[0].rotation.y +=0.01;

		if(teclaW==1){heli[0].rotation.y=-3.14+ang;	heli[0].position.z +=Math.cos(heli[0].rotation.y=-3.14+ang)*mov;	heli[0].position.x +=Math.sin(heli[0].rotation.y=-3.14+ang)*mov;		scene.position.z -=Math.cos(heli[0].rotation.y=-3.14+ang)*mov;	scene.position.x -=Math.sin(heli[0].rotation.y=+3.14+ang)*mov; myFunction(   0);}//W
		if(teclaV==1){heli[0].rotation.y=-3.14+ang;	heli[0].position.z -=Math.cos(heli[0].rotation.y=-3.14+ang)*mov;	heli[0].position.x -=Math.sin(heli[0].rotation.y=-3.14+ang)*mov;		scene.position.z +=Math.cos(heli[0].rotation.y=-3.14+ang)*mov;	scene.position.x +=Math.sin(heli[0].rotation.y=+3.14+ang)*mov; myFunction(3.14);}//V
		if(teclaH==1){heli[0].rotation.y -=.02;ang-=.02;}//G
		if(teclaG==1){heli[0].rotation.y +=.02;ang+=.02;}//H

		if(teclaB==1){if(heli[0].position.y>1){heli[0].position.y -=mov/2;}}//Cima
		if(teclaC==1){heli[0].position.y +=mov/2;}//Baixo
	}

	renderer.render( scene, camera );

}

function alterando(){
	conta++;

bone[2][1]=bone[2][0].clone(); // vivicox membro inf dir BDi

bone[3][0]=bone[2][0].clone(); // vivicox membro sup esq braco BEs
bone[3][1]=bone[2][0].clone(); // vivicox sup esq antebraco BEi
bone[4][0]=bone[2][0].clone(); // vivicox inf dir coxa PDs
bone[4][1]=bone[2][0].clone(); // vivicox inf dir perna PDi
bone[5][0]=bone[2][0].clone(); // vivicox inf esq coxa PEs
bone[5][1]=bone[2][0].clone(); // vivicox inf esq perna PEi

	bone[20][0]=bone[0][0].clone(); // CA
	bone[20][1]=bone[0][1].clone(); // TR
	bone[22][0]=bone[2][0].clone(); // vivicox membro sup dir BDs
	bone[22][1]=bone[2][0].clone(); // vivicox membro inf dir BDi
	bone[23][0]=bone[2][0].clone(); // vivicox membro sup esq braco BEs
	bone[23][1]=bone[2][0].clone(); // vivicox sup esq antebraco BEi
	bone[24][0]=bone[2][0].clone(); // vivicox inf dir coxa PDs
	bone[24][1]=bone[2][0].clone(); // vivicox inf dir perna PDi
	bone[25][0]=bone[2][0].clone(); // vivicox inf esq coxa PEs
	bone[25][1]=bone[2][0].clone(); // vivicox inf esq perna PEi

bone[0][0].position.set(0,2.1,0); // cabeca
bone[0][1].position.set(0,2  ,0); // torso
		bone[0][1].scale.y=0.8; // torso

bone[2][0].position.set(-1.75,1,0); // vivicox membro sup dir braco BDs
bone[2][0].scale.y=0.75;
bone[2][0].scale.x=0.75;

bone[2][1].position.set(-1.75,-0.5,0); // vivicox membro sup dir antebraco BDi
bone[2][1].scale.set(0.75,0.75,0.75);

bone[3][0].position.set(1.75,1,0); // vivicox membro sup esq braco BEs
bone[3][0].scale.y=0.75;
bone[3][0].scale.x=0.75;

bone[3][1].position.set(1.75,-0.5,0); // vivicox membro sup esq antebraco BEi
bone[3][1].scale.set(0.75,0.75,0.75);

bone[4][0].position.set(0.5,0,0); // vivicox membro inf dir coxa PDs
bone[4][0].scale.y=0.5; // 0.5

bone[4][1].position.set(0.5,-1.5,0); // vivicox membro inf dir PDi
bone[4][1].scale.set(0.85,0.85,0.85);

bone[5][0].position.set(-0.5,0,0); // vivicox membro inf esq coxa PEs
bone[5][0].scale.y=0.5; // 0.5

bone[5][1].position.set(-0.5,-1.5,0); // vivicox membro inf esq perna PEi
bone[5][1].scale.set(0.85,0.85,0.85);

bone[2][2]=bone[2][1].clone(); //membro sup dir mao
	bone[2][2].scale.set(2,.5,.5);
	bone[2][2].position.set(0,-2,0);

bone[2][1].add(bone[2][2]); // vivicox membro sup dir mao
bone[2].add(bone[2][0]); // vivicox membro sup dir braco BDs
bone[2].add(bone[2][1]); // vivicox membro sup dir antebraco BDi

bone[3].add(bone[3][0]); // vivicox membro sup esq braco BEs
bone[3].add(bone[3][1]); // vivicox membro sup esq antebraco BEi
scene.add(bone[2]);
scene.add(bone[3]);

bone[4].add(bone[4][0]); // vivicox membro inf dir coxa PDs
bone[4].add(bone[4][1]); // vivicox membro inf dir perna PDi
bone[5].add(bone[5][0]); // vivicox membro inf esq coxa PEs
bone[5].add(bone[5][1]); // vivicox membro inf esq perna PEi
scene.add(bone[4]);
scene.add(bone[5]);

bone[0][0].scale.set(0.8,0.8,0.8);

bone[0].add(bone[0][0]);
bone[0].add(bone[0][1]);
bone[0].add(bone[2]);
bone[0].add(bone[3]);

bone[4][1].rotation.x =0.5;
bone[5][1].rotation.x =0.5;

bone[0].add(bone[4]);
bone[0].add(bone[5]);

bone[0].rotation.y=Math.PI/2;


// LOUCURA ***********************************************
		bone[0].position.set(0,0,0);
		bone[0].scale.set(.1,.1,.1);

bone[0].position.y=-25;

scene.add(bone[0]);

bone[2].position.set( 0, 1,0);//braco dir
bone[3].position.set( 0, 1,0);//braco esq
bone[4].position.set(-1,-1,0);//perna dir
bone[5].position.set( 1,-1,0);//perna esq


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
	bone[25][0].scale.set(0.8,.8,1);
	bone[25][0].rotation.set(-1.57,0,0);
	bone[25][1].position.set(0,-3,0);
	bone[25][1].rotation.set(1.57,0,0);
	bone[25][0].add(bone[25][1]);

	bone[20].scale.set(1,1,1);
	bone[20].position.set(1.5,0.5,25);

	bone[20].add(bone[20][0]);
		bone[20].add(bone[20][1]);
	bone[20].add(bone[22][0]);
	bone[20].add(bone[23][0]);
	bone[20].add(bone[24][0]);
	bone[20].add(bone[25][0]);


altera++;

//animate();

}


var keys = [];
var ang=0;
//document.getElementById("spanid").innerText = "Keys currently pressed: ";

window.addEventListener("keydown",function(e){
        keys[e.keyCode]=e.keyCode;
        var keysArray=getNumberArray(keys);
 	teclaA=0;teclaD=0;teclaW=0;teclaS=0;teclaG=0;teclaH=0;teclaC=0;teclaB=0;teclaV=0;setaE=0;setaD=0;setaC=0;setaB=0;
	for(var i=0;i<keysArray.length;i++){
	if(keysArray[i]==37){teclaG=1;}//G Rot +
	if(keysArray[i]==39){teclaH=1;}//H Rot -
	if(keysArray[i]==87){teclaW=1;}//W Frente
	if(keysArray[i]==83){teclaV=1;}//V Pilot Tras
	if(keysArray[i]==38){teclaC=1;}//B Baixo
	if(keysArray[i]==40){teclaB=1;}//C Cima
	}
        //if(keysArray.toString()=="17,65"){document.getElementById("spanid").innerText +=" Select all!";}
},false);

window.addEventListener('keyup',function(e){
        keys[e.keyCode]=false;
	teclaA=0;teclaD=0;teclaW=0;teclaS=0;teclaG=0;teclaH=0;teclaC=0;teclaB=0;teclaV=0;setaE=0;setaD=0;setaC=0;setaB=0;
	for(var i=0;i<getNumberArray(keys).length;i++){
	if(getNumberArray(keys)[i]==37){teclaG=1;}//G Rot +
	if(getNumberArray(keys)[i]==39){teclaH=1;}//H Rot -
	if(getNumberArray(keys)[i]==87){teclaW=1;}//W Frente
	if(getNumberArray(keys)[i]==83){teclaV=1;}//V Pilot Tras
	if(getNumberArray(keys)[i]==38){teclaC=1;}//B Baixo
	if(getNumberArray(keys)[i]==40){teclaB=1;}//C Cima
	}
},false);

function getNumberArray(arr){
	var newArr = new Array();
	for(var i=0;i<arr.length;i++){
		if(typeof arr[i]=="number"){
			newArr[newArr.length]=arr[i];
		}
	}
	return newArr;
}

animate();

var ifrax=document.getElementById("ifra");
var ifray=(ifrax.contentWindow || ifrax.contentDocument);
if (ifray.document)ifray=ifray.document;

function myFunction(cor){
	ifray.getElementById("spanid").innerHTML=cor;
}

myFunction(0);

</script>
</body>
</html>
