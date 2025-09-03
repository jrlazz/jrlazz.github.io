<!DOCTYPE html>
<html lang="en">
<head>
<title>evelyn_z.php</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="https://threejs.org/files/favicon.ico"/>

<style>

body{margin:0;background-color:#024;color:#ff0;font-family:Verdana;font-size:13px;overscroll-behavior:none;line-height:20px;overflow:hidden;}
button{font-family:Verdana;background-color:#033;cursor:pointer;color:#ff0;}
button:hover{background-color:#fc6;color:#033;}
button:active{background-color:#0f0;color:#033;}
.DIM{width:70px;height:20px;border-width:1px;border-color:#880;text-align:center;padding:0px;color:#880;}
.NUM{width:20px;height:20px;border-width:1px;border-color:#880;text-align:center;padding:0px;color:#880;}
.OK{width:20px;height:20px;border-width:1px;border-color:#ff0;text-align:center;padding:0px;color:#ff0;font-weight:bold;}
.NOK{width:20px;height:20px;border-width:1px;border-color:#880;text-align:center;padding:0px;color:#0ff;}
a{cursor: pointer;}
input{width:40px;height:16px;background-color:#033;color:#ffcc00;font-family:Verdana;}
select{background-color:#033;color:#ffcc00;font-family:Verdana;border:none;}
table{border:1px solid #cc0;}
td{text-align:center;]

</style>

<script type="importmap">{"imports":{"three":"https://esm.sh/three@0.175.0/build/three.module.js","three/addons/":"https://esm.sh/three@0.175.0/examples/jsm/"}}</script>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/jquery-ui.js"></script>

</head>

<body>

<span style="position:absolute;left:200px;top:50px;font-size:16pt;color:#ff0000;background-color:#012;padding:8px;" id="spancompleto">Please wait loads!</span>
<button onmouseover="javascript:this.style.color='#600'"; onmouseout="javascript:this.style.color='#0f0'"; onclick="javascript:window.open('evelyn_1_code.txt','_blank');" style="position:absolute;left:20px;top:400px;font-size:16pt;color:#0f0;padding:4px;border:2px outset #ff0;">view code</button>
<button onmouseover="javascript:this.style.color='#600'"; onmouseout="javascript:this.style.color='#0f0'"; onclick="javascript:window.open('3ds.txt','_blank');" style="position:absolute;left:20px;top:500px;font-size:16pt;color:#0f0;padding:4px;border:2px outset #ff0;">view 3ds.txt</button>

<script type="module">

import * as THREE from "three";
import { OrbitControls } from "three/addons/controls/OrbitControls.js";
import { DDSLoader } from "three/addons/loaders/DDSLoader.js";
import { MTLLoader } from "three/addons/loaders/MTLLoader.js";
import { OBJLoader } from "three/addons/loaders/OBJLoader.js";
import { STLLoader } from "three/addons/loaders/STLLoader.js";
import { Reflector } from "three/addons/objects/Reflector.js";
import { FBXLoader } from "three/addons/loaders/FBXLoader.js";
import { GLTFLoader } from "three/addons/loaders/GLTFLoader.js";
import { ColladaLoader } from "three/addons/loaders/ColladaLoader.js";

var renderer,scene,camera,material,geometry,objLoader;
var ambient,spotLight,pointlight;

var altera=0;

var mesh=null;
var color=Math.random()*0xffffff;

var k=0;
var w=0;

var boxy=[];
var oo=[];
var pp=[];
var jar=[];
var mar=[];

var loader=[];
var loaderCount=0;
var mixer=[];
var mixerCount=-1;
var avatar=[];
var avatarCount=0;
var rot=0;

var pegasol;
var valusol;
var stra;
var conta=0;
var contaboxy=0;
var quaqua=0;
var completo=0;
var v=1;

var de2ra=function(degree){return degree*(Math.PI/180);};

var ativo;

var group=new THREE.Group();

const clock=new THREE.Clock();

let clipobject;

var ini=0;

function init(){
	renderer=new THREE.WebGLRenderer({antialias:true,alpha:true});
	renderer.setPixelRatio(window.devicePixelRatio);
	renderer.setSize(window.innerWidth,window.innerHeight);
	document.body.appendChild(renderer.domElement);
	renderer.outputColorSpace=THREE.SRGBColorSpace;
	//renderer.shadowMap.enabled=true;renderer.shadowMap.type=THREE.PCFSoftShadowMap;

	renderer.setClearColor(0x002244,1);

	scene=new THREE.Scene();
	scene.position.set(0,-2,0);
	camera=new THREE.PerspectiveCamera(35,window.innerWidth/window.innerHeight,1,1000);
	camera.position.set(10,15,30);

	const onError=function(){};
	const manager=new THREE.LoadingManager();
	manager.onStart=function(url,itemsLoaded,itemsTotal){
		console.log('Started loading file: ' + url + '.\nLoaded ' + itemsLoaded + ' of ' + itemsTotal + ' files.');
	};
	manager.onLoad=function(){
		console.log('Loading complete!');
		document.getElementById("spancompleto").innerText="Loaded... more a few seconds to use...";completo=1;
		document.getElementById("spancompleto").style.color="#00ff00";completo=1;
	};
	manager.onProgress=function(url,itemsLoaded,itemsTotal){
		console.log('loading texture'+url+' '+parseInt(itemsLoaded/itemsTotal*100)+'%');
		document.getElementById("spancompleto").innerText='loading texture'+url+' '+parseInt(itemsLoaded/itemsTotal*100)+'%';
	};
	manager.onError=function(url){
		console.log('Error loading texture:'+url);
		document.getElementById("spancompleto").innerText='Error loading texture:'+url;
	};

	manager.addHandler(/\.dds$/i,new DDSLoader());

	const controls=new OrbitControls(camera,renderer.domElement);
	controls.addEventListener('change',render);
	controls.minDistance=1;
	controls.maxDistance=200;
	controls.enablePan=true;

	const axesHelper=new THREE.AxesHelper(.5);
	scene.add(axesHelper);

	var gridBaseGeo=new THREE.BoxGeometry(16,16,0.01);
	var gridBaseMat=new THREE.MeshPhongMaterial({color:0x333333,side:THREE.DoubleSide});
	var gridBase=new THREE.Mesh(gridBaseGeo,gridBaseMat);
	gridBase.position.set(0,-1.55,0);gridBase.rotation.set(0,0,0);gridBase.rotation.x=de2ra(90);
	gridBase.receiveShadow=true;
	scene.add(gridBase);
	var grid=new THREE.GridHelper(14,14);//size,divisions
	grid.material.color.setHex(0xaaaaaa);
	grid.position.set(0,-1.5,0);
	scene.add(grid);

	ambient=new THREE.AmbientLight(0xffcc99,5);
	scene.add(ambient);
	spotLight=new THREE.SpotLight(0xff9900,10);
	spotLight.position.set(0,10,0);
	spotLight.decay=0;
	spotLight.angle=Math.PI/5.77;
	//spotLight.castShadow=true;
	//spotLight.shadow.mapSize.width=1024;
	//spotLight.shadow.mapSize.height=1024;
	scene.add(spotLight);
	pointlight=new THREE.PointLight(0x00ffff,5);
	pointlight.position.set(-7,4.95,5 );
	scene.add(pointlight);// heli


// ******** Starting with 3ds.txt

pegasol=document.getElementById('sol');

for(w=1;w<400;w++){
	if(pegasol.options[w]){
		valusol=pegasol.options[w].value;
		if(valusol.length>5){
			stra=valusol;jar=stra.split(",");mar[jar[0]]=jar;
		}
	}
}
for(w=0;w<400;w++){
	if(mar[w]){
		if(mar[w][11].replaceAll("'","")=="DAE"){		fazDAE(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="FBX"){		fazFBX(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="Geometry"){		fazGeometry(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="Geometry6"){		fazGeometry6(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="GLB"){		fazGLB(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="Mirror1side"){	fazMirror1side(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="Mirror2sides"){	fazMirror2sides(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="MTL"){		fazMTL(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="OBJ"){		fazOBJ(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
		if(mar[w][11].replaceAll("'","")=="STL"){		fazSTL(mar[w][0],mar[w][1],mar[w][2],mar[w][3],mar[w][4],mar[w][5],mar[w][6],mar[w][7],mar[w][8],mar[w][9],parseInt(mar[w][10]),mar[w][11].replaceAll("'",""),mar[w][12].replaceAll("'",""),mar[w][13].replaceAll("'",""));}
	}
}

	// Edificio Evelyn, Rua Girassol, 594 Apto. 502, CEP: 05433-001

	// STL
	function fazSTL(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		ativo=i;
		loaderCount++;
		loader[loaderCount]=new STLLoader(manager);
		loader[loaderCount].load('repo/'+f,function(geometry){
			material=new THREE.MeshLambertMaterial({transparent:true,opacity:.7,emissive:"#0f0",emissiveIntensity:0});
			mesh=new THREE.Mesh(geometry,material);
			boxy[i]=mesh;
			boxy[i].material.color.set(c);
			boxy[i].rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
			boxy[i].scale.set(gx,gy,gz);
			boxy[i].position.set(x,y,z);
			//boxy[i].castShadow=true;
			//boxy[i].receiveShadow=true;
			scene.add(boxy[i]);
		});
	}
	// MTL
	function fazMTL(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		new MTLLoader(manager).load('repo/' + f +'.mtl',function(materials){materials.preload();new OBJLoader(manager).setMaterials(materials).load('repo/' + f + '.obj',function(object){
			//object.children[k].castShadow=true;
			object.scale.set(gx,gy,gz);
			object.rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
			object.position.set(x,y,z);
			scene.add(object);
			boxy[i]=object;
			},manager.onProgress,manager.onError);});
	}
	// OBJ
	function fazOBJ(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		const path="repo/";
		const texture=new THREE.TextureLoader(manager).load(path+src);
		texture.colorSpace=THREE.SRGBColorSpace;;
		texture.wrapS=THREE.RepeatWrapping;texture.wrapT=THREE.RepeatWrapping;
		texture.repeat.set(1,1);
		objLoader=new OBJLoader(manager);
		objLoader.setPath('');
		objLoader.load('repo/'+f,function(object){
		boxy[i]=object.children[0];
		boxy[i].scale.set(gx,gy,gz);
		boxy[i].position.set(x,y,z);
		boxy[i].rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
		//boxy[i].castShadow=true;boxy[i].receiveShadow=true;
		boxy[i].material=new THREE.MeshLambertMaterial({color:0xffffff,refractionRatio:0.55,map:texture,opacity:1});
		scene.add(boxy[i]);
		});
	}
	// Geometry Vivi ... 3.97x6.20
	function fazGeometry(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		const path="repo/";
		const texture=new THREE.TextureLoader(manager).load(path+src);
		texture.colorSpace=THREE.SRGBColorSpace;
		texture.wrapS=THREE.RepeatWrapping;
		texture.wrapT=THREE.RepeatWrapping;
		texture.repeat.set(1,1);
		if(f=="Sphere"){geometry=new THREE.SphereGeometry(gx,gy,gz);}
		if(f=="Box"){geometry=new THREE.BoxGeometry(1,1,1);}
		const material=new THREE.MeshBasicMaterial({map:texture,transparent:true,opacity:.95});
		mesh=new THREE.Mesh(geometry,material);
		if(f=="Box"){mesh.scale.set(gx,gy,gz);}
		mesh.position.set(x,y,z);
		mesh.rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
		boxy[i]=mesh;
		scene.add(boxy[i]);
	}
	function fazGeometry6(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		jar=src.split("*")
		const path="repo/";
		loaderCount++;
		loader[loaderCount]=new THREE.TextureLoader(manager);
		const material=[
		new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[0])}),
		new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[1])}),
		new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[2])}),
		new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[3])}),
		new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[4])}),
		new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[5])}),
		];
		geometry=new THREE.BoxGeometry(gx,gy,gz);
		geometry=new THREE.BoxGeometry(1,1,1);
		mesh=new THREE.Mesh(geometry,material);
		mesh.scale.set(gx,gy,gz);
		mesh.position.set(x,y,z);
		mesh.rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
		boxy[i]=mesh;
		scene.add(boxy[i]);
	}
	// Mirror
	function fazMirror1side(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		geometry=new THREE.PlaneGeometry(1,1);
		boxy[i]=new Reflector(geometry,{clipBias:0.003,textureWidth:window.innerWidth*window.devicePixelRatio,textureHeight:window.innerHeight*window.devicePixelRatio,color: 0x889999});
		boxy[i].scale.set(gx,gy,gz);
		boxy[i].position.set(x,y,z);
		boxy[i].rotation.set(0,de2ra(ry),0);
		scene.add(boxy[i]);
	}
	function fazMirror2sides(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		boxy[i]=new THREE.Object3D();
		scene.add(boxy[i]);
		geometry=new THREE.PlaneGeometry(1,1);
		var mirA=new Reflector(geometry,{clipBias:0.003,textureWidth:window.innerWidth*window.devicePixelRatio,textureHeight:window.innerHeight*window.devicePixelRatio,color: 0x889999});
		mirA.position.set(0,0,-2);
		mirA.rotateY(-Math.PI);
		var mirB=new Reflector(geometry,{clipBias:0.003,textureWidth:window.innerWidth*window.devicePixelRatio,textureHeight:window.innerHeight*window.devicePixelRatio,color: 0x889999});
		mirB.add(mirA);
		boxy[i].add(mirB);
		boxy[i].scale.set(gx,gy);
		boxy[i].rotateY(de2ra(ry));
		boxy[i].position.set(x,y,z);
	}
	// FBX
	function fazFBX(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		loaderCount++;
		loader[loaderCount]=new FBXLoader(manager);
		loader[loaderCount].load('repo/'+f,function(object){
			const animations=object.animations;
			mixerCount++;
			mixer[mixerCount]=new THREE.AnimationMixer(object);
			if(animations[0]){mixer[mixerCount].clipAction(animations[0]).play();}
			//object.traverse(function(child){if(child.isMesh){child.castShadow=true;child.receiveShadow=true;}});
			object.scale.set(gx,gy,gz);
			object.position.set(x,y,z);
			boxy[i]=object;
			scene.add(boxy[i]);
			v++;
		});
	}
	// GLB
	function fazGLB(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		loaderCount++;
		loader[loaderCount]=new GLTFLoader(manager);
		loader[loaderCount].load('repo/'+f,function(gltf){
			const model=gltf.scene;
			model.animations=gltf.animations;
			mixerCount++;
			mixer[mixerCount]=new THREE.AnimationMixer(model);
			if(model.animations[1]){mixer[mixerCount].clipAction(model.animations[1]).play();}
			model.position.set(x,y,z);
			model.scale.set(gx,gy,gz);
			model.rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
			model.traverse(function(object){
				if(object.isMesh){
					//object.castShadow=true;
					if(c!=0){
						object.material.color.set(c);
						object.material.emissive.set(c);
						object.material.emissiveIntensity=0.5;
					}
				}
			});
			boxy[i]=model;
			scene.add(boxy[i]);
		},manager.onLoad);
	}
	//DAE
	function fazDAE(i,gx,gy,gz,x,y,z,rx,ry,rz,c,t,f,src){
		loaderCount++;
		loader[loaderCount]=new ColladaLoader(manager);
		loader[loaderCount].load('repo/'+f,function(collada){
			const animations=collada.animations;
			avatarCount++;
			avatar[avatarCount]=collada.scene;
			avatar[avatarCount].traverse(function(node){if(node.isSkinnedMesh){node.frustumCulled=false;}});
			mixerCount++;
			mixer[mixerCount]=new THREE.AnimationMixer(avatar[avatarCount]);
			if(animations[0]){mixer[mixerCount].clipAction(animations[0]).play();}
			avatar[avatarCount].position.set(x,y,z);
			avatar[avatarCount].scale.set(gx,gy,gz);
			avatar[avatarCount].rotation.set(de2ra(rx),de2ra(ry),de2ra(rz));
			boxy[i]=avatar[avatarCount];
			scene.add(boxy[i]);
		});
	}

// ******** RENDER

	render();
	window.addEventListener('resize',onResize,false);
	document.addEventListener('keydown',checkKey);
}

function onResize() {
	camera.aspect=window.innerWidth/window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize(window.innerWidth,window.innerHeight);
}


function animate() {
	requestAnimationFrame(animate);
	const delta=clock.getDelta();
	if(mixer[0]){mixer[0].update(delta);}
	if(mixer[1]){mixer[1].update(delta);}
	if(mixer[2]){mixer[2].update(delta);}
	if(mixer[3]){mixer[3].update(delta);}
	if(mixer[4]){mixer[4].update(delta);}
	if(mixer[5]){mixer[5].update(delta);}
	if(mixer[6]){mixer[6].update(delta);}
	if(mixer[7]){mixer[7].update(delta);}
	if(mixer[8]){mixer[8].update(delta);}
	if(mixer[9]){mixer[9].update(delta);}
	render();
}

function render(){
ini++;

if(ini==120){
	j=0;
	mudativo(j);
	document.getElementById("spancompleto").innerText="";
}

if(ini>130){
	if(inkeyA==1 || inkeyD==1){boxy[ativo].position.x=boxPX;inkeyA=0;inkeyD=0;}
	if(inkeyW==1 || inkeyS==1){boxy[ativo].position.y=boxPY;inkeyW=0;inkeyS=0;}
	if(inkeyC==1 || inkeyB==1){boxy[ativo].position.z=boxPZ;inkeyC=0;inkeyB=0;}
	if(inkeyG==1 || inkeyH==1){boxy[ativo].rotation.y=boxRY;inkeyG=0;inkeyH=0;}

	if(sai0==1){scene.remove(boxy[0]);sai0=0;}
	if(sai0==2){scene.add(boxy[0]);sai0=0;}

	if(altinp==1){
		repos();
		ativo=boxAtivo;

		if(boxFile!="Sphere" && boxType!="Mirror2sides"){boxy[ativo].scale.x=boxSX;boxy[ativo].scale.y=boxSY;boxy[ativo].scale.z=boxSZ;}

		if(boxType=="Mirror2sides"){boxy[ativo].scale.x=boxSX;boxy[ativo].scale.y=boxSY;boxy[ativo].scale.z=boxSZ;}

		boxy[ativo].position.x=boxPX;boxy[ativo].position.y=boxPY;boxy[ativo].position.z=boxPZ;
		boxy[ativo].rotation.x=boxRX;boxy[ativo].rotation.y=boxRY;boxy[ativo].rotation.z=boxRZ;	

		if(boxType=="FBX" || boxType=="Geometry" || boxType=="OBJ" || boxType=="STL"){boxy[ativo].material.color.setHex(boxC);}

		if(boxType=="GLB"){
			boxy[ativo].traverse(function(object){
				if(object.isMesh){
					//object.castShadow=true;
					if(boxC!=0){
						object.material.color.set(boxC);
						object.material.emissive.set(boxC);
						object.material.emissiveIntensity=0.5;
					}else{
						object.material.color.setHex(0xffffff00);
						object.material.emissive.set(boxC);
						object.material.emissiveIntensity=0.5;
					}
				}
			});
		}

		if(boxSRC!="_" && boxSRC.indexOf("*")==-1){
			const path="repo/";
			const texture=new THREE.TextureLoader().load(path+boxSRC);
			texture.colorSpace=THREE.SRGBColorSpace;
			boxy[ativo].material=new THREE.MeshBasicMaterial({map:texture});
			boxy[ativo].material.needsUpdate=true;
			}

		if(boxType=="Geometry6"){
			jar=boxSRC.split("*")
			const path="repo/";
			loaderCount++;
			loader[loaderCount]=new THREE.TextureLoader();
			const material=[
			new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[0])}),
			new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[1])}),
			new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[2])}),
			new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[3])}),
			new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[4])}),
			new THREE.MeshBasicMaterial({map:loader[loaderCount].load(path+jar[5])}),
			];
			boxy[ativo].material=material;
			boxy[ativo].scale.set(boxSX,boxSY,boxSZ);
		}

		if(boxFile!="Sphere" && boxType!="Mirror2sides"){boxy[ativo].scale.x=boxSX;boxy[ativo].scale.y=boxSY;boxy[ativo].scale.z=boxSZ;}

		if(ativo==98){
			const path="repo/";
			boxy[ativo].material.map=new THREE.TextureLoader().load(path+boxSRC);
			boxy[ativo].rotation.x=de2ra(boxRX);
			boxy[ativo].material.needsUpdate=true;
		}
		if(ativo==18){
			boxy[ativo].material.opacity=1;
		}

		if(boxType=="Geometry"){
			if(boxFile=="Sphere"){
				const path="repo/";
				boxy[ativo].geometry=new THREE.SphereGeometry(boxSX,24,24);
				const texture1=new THREE.TextureLoader().load(path+boxSRC);
				texture1.colorSpace=THREE.SRGBColorSpace;
				boxy[ativo].material=new THREE.MeshBasicMaterial({map:texture1,transparent:true,opacity:1});
			}
			if(boxFile=="Box"){
				const path="repo/";
				boxy[ativo].geometry1=new THREE.BoxGeometry(boxSX,boxSY,boxSZ);
				const texture1=new THREE.TextureLoader().load(path+boxSRC);
				texture1.colorSpace=THREE.SRGBColorSpace;
				boxy[ativo].material=new THREE.MeshBasicMaterial({map:texture1,transparent:true,opacity:1});
			}
			boxy[ativo].material.opacity=.95;
			boxy[ativo].material.needsUpdate=true;
			boxy[ativo].geometry.needsUpdate=true;
		}
		altinp=0;
	}

	conta++;
	contaboxy++;

	if(conta==1){
		boxy[99].material.opacity=1;
		boxy[99].material.emissiveIntensity=20;
		boxy[99].position.set(boxPX,boxPY,boxPZ);
		boxy[98].position.set(boxPX,boxPY,boxPZ);
	}
	if(conta==20){
		boxy[99].position.set(0,-1000,0);
		boxy[98].position.set(0,-1000,0);
	}
	if(conta>40){conta=0;}

	if(boxy[37]){boxy[37].rotation.y +=passo*2;}
	if(boxy[38]){boxy[38].rotation.x -=passo*2;}

	if(contaboxy<300){
		boxy[3].rotation.y -=passo/4;
		boxy[4].rotation.y +=passo/4;
		if(quaqua==1 && boxy[33]){boxy[33].rotation.y +=passo/4;}
		//boxy[4].position.y -=.01;
		//boxy[4].scale.x -=.02;
	} else {
		boxy[3].rotation.y +=passo/4;
		boxy[4].rotation.y -=passo/4;
		if(boxy[33]){boxy[33].rotation.y -=passo/4;}
		//boxy[4].position.y +=.01;
		//boxy[4].scale.x +=.02;
	}
	if(contaboxy>600){
		contaboxy=0;
		quaqua=1;
		//boxy[4].position.y=-1.5;
	}

	if(completo==1){document.getElementById("spancompleto").innerText="";}
}

	renderer.render(scene,camera);

}


init();

animate();

render();

</script>

<script>


// ******** Output

function conlog(){
	var vem=boxAtivo+","+boxSX+","+boxSY+","+boxSZ+","+boxPX+","+boxPY+","+boxPZ+","+around(boxRX/0.0174532925)+","+around(boxRY/0.0174532925)+","+around(boxRZ/0.0174532925)+","+"0x"+("000000"+boxC.toString(16)).substr(-6)+",#"+boxType+"#,#"+boxFile+"#,#"+boxSRC+"#,#"+boxOBS+"#";
	var person=prompt("Gravar novo 3D n\xFAmero? ou 0 para anular grava\xE7\xE3o","");
	if(person==null || person==""){
	} else {
		vem=person+","+boxSX+","+boxSY+","+boxSZ+","+boxPX+","+boxPY+","+boxPZ+","+around(boxRX/0.0174532925)+","+around(boxRY/0.0174532925)+","+around(boxRZ/0.0174532925)+","+"0x"+("000000"+boxC.toString(16)).substr(-6)+",#"+boxType+"#,#"+boxFile+"#,#"+boxSRC+"#,#"+boxOBS+"#";
	}
	if(person!="0"){
		var obser=prompt("nova observa\xE7\xE3o?","");
		if(obser==null || obser==""){
		} else {
			vem=person+","+boxSX+","+boxSY+","+boxSZ+","+boxPX+","+boxPY+","+boxPZ+","+around(boxRX/0.0174532925)+","+around(boxRY/0.0174532925)+","+around(boxRZ/0.0174532925)+","+"0x"+("000000"+boxC.toString(16)).substr(-6)+",#"+boxType+"#,#"+boxFile+"#,#"+boxSRC+"#,#"+obser+"#";
		}
		alert(vem);
		document.getElementById("ppara").innerHTML=vem;
		$.ajax({
			method:"POST",url:"wrap.php",data:{text:$("p.unbroken").text()}})
			.done(function(response){$("p.broken").html(response);
		});
	}
}

var boxAtivo,boxSX,boxSY,boxSZ,boxPX,boxPY,boxPZ,boxRX,boxRY,boxRZ,boxC,boxType,boxFile,boxSRC,boxOBS;
var inkeyA,inkeyD,inkeyW,inkeyS,inkeyC,inkeyB,inkeyG,inkeyH;
var passo=0.1;
var sai0;
var altinp=0;
var pontonum=0;

function checkKey(e){
	var e=window.event;
//	alert(e.keyCode);

	if(e.keyCode=='65'||e.keyCode=='97') {inkeyA=1;boxPX=around(Number(boxPX)-passo);document.getElementById("inpX").value=boxPX;}//Esq A
	if(e.keyCode=='68'||e.keyCode=='100'){inkeyD=1;boxPX=around(Number(boxPX)+passo);document.getElementById("inpX").value=boxPX;}//Dir D
	if(e.keyCode=='66'||e.keyCode=='98'){inkeyW=1;boxPY=around(Number(boxPY)-passo);document.getElementById("inpY").value=boxPY;}//Cima C
	if(e.keyCode=='87'||e.keyCode=='119'){inkeyC=1;boxPZ=around(Number(boxPZ)-passo);document.getElementById("inpZ").value=boxPZ;}//Frente W
	if(e.keyCode=='67'||e.keyCode=='99'){inkeyS=1;boxPY=around(Number(boxPY)+passo);document.getElementById("inpY").value=boxPY;}//Baixo B
	if(e.keyCode=='83'||e.keyCode=='115'){inkeyB=1;boxPZ=around(Number(boxPZ)+passo);document.getElementById("inpZ").value=boxPZ;}//Tras S

	if(e.keyCode=='71'||e.keyCode=='103'){inkeyG=1;boxRY=Number(boxRY)+passo/10;document.getElementById("rotY").value=around(boxRY*57.295779513);}//G
	if(e.keyCode=='72'||e.keyCode=='104'){inkeyH=1;boxRY=Number(boxRY)-passo/10;document.getElementById("rotY").value=around(boxRY*57.295779513);}//H

	if(e.keyCode=='80'||e.keyCode=='112'){passo=passo*2;document.getElementById("passoval").value=passo;}//P
	if(e.keyCode=='76'||e.keyCode=='108'){passo=passo/2;document.getElementById("passoval").value=passo;}//L

	if(e.keyCode=='13'){alterainp();document.getElementById("passoval").focus();}//Enter
}

function around(x){
	if(x>360){x=x-360;}
	if(x<-360){x=x+360;}
	return(Math.round(x*1000)/1000);
}

function mostracor(){
	boxC=parseInt((document.getElementById("favcolor").value.substring(1)),16);
	altinp=1;
}

var str="";

function alterainp(){
	boxSX=document.getElementById("Comp").value;
	boxSY=document.getElementById("Altu").value;
	boxSZ=document.getElementById("Espe").value;
	boxPX=document.getElementById("inpX").value;
	boxPY=document.getElementById("inpY").value;
	boxPZ=document.getElementById("inpZ").value;
	boxRX=document.getElementById("rotX").value*0.0174532925;
	boxRY=document.getElementById("rotY").value*0.0174532925;
	boxRZ=document.getElementById("rotZ").value*0.0174532925;
	boxType=document.getElementById("arqtype").innerHTML;
	boxSRC=document.getElementById("arqsrc").innerHTML;
	document.getElementById("sel").selectedIndex=0;
	document.getElementById("sel6").selectedIndex=0;
	altinp=1;
}

</script>

<table style="position:absolute;left:10px;top:80px;width:150px;background-color:#033;">
<tr><td>&nbsp;A left&nbsp;</td><td>&nbsp;D right&nbsp;</td></tr>
<tr><td>&nbsp;W back&nbsp;</td><td>&nbsp;S front&nbsp;</td></tr>
<tr><td>&nbsp;C up&nbsp;</td><td>&nbsp;B down&nbsp;</td></tr>
<tr><td>&nbsp;G clock-&nbsp;</td><td>&nbsp;H clock+&nbsp;</td></tr>
<tr><td colspan="2"><center>passo...</center></td></tr>
<tr><td>&nbsp;L (/2)&nbsp;</td><td>&nbsp;P (x2)&nbsp;</td></tr>
</table>

<table id="tabcontrol" style="position:absolute;left:1100px;top:80px;width:150px;background-color:#033;">
<tr><td colspan="3"><button style="width:140px;" onclick="alterainp();">OK</button></td></tr>
<tr><td><span>Comp</span></td><td><span>Altu</span></td><td><span>Espe</span></td></tr>
<tr><td><input type="text" onkeyup="clearInvalid(this.id);" id="Comp" value=3></input></td><td><input type="text" onkeyup="clearInvalid(this.id);" id="Altu" value=3></input></td><td><input type="text" onkeyup="clearInvalid(this.id);" id="Espe" value=0.15></input></td></tr>
<tr><td><span>PosX</span></td><td><span>PosY</span></td><td><span>PosZ</span></td><td></td></tr>
<tr><td><input type="text" onkeyup="clearInvalid(this.id);" id="inpX" value=-1.85></input></td><td><input type="text" onkeyup="clearInvalid(this.id);" id="inpY" value=0></input></td><td><input type="text" onkeyup="clearInvalid(this.id);" id="inpZ" value=0.15></input></td></tr>
<tr><td><span>RotX</span></td><td><span>RotY</span></td><td><span>RotZ</span></td><td></td></tr>
<tr><td><input type="text" onkeyup="clearInvalid(this.id);" id="rotX" value=0></input></td><td><input type="text" onkeyup="clearInvalid(this.id);" id="rotY" value=90></input></td><td><input type="text" onkeyup="clearInvalid(this.id);" id="rotZ" value=0></input></td></tr>
<tr><td><span>Passo</span></td><td colspan="2"><input style="width:60px;" type="text" id="passoval" value=.01 readonly></input></td></tr>
<tr><td><span>Cor</span></td><td colspan="2"><input type="color" style="width:80px;height:24px;border:none;cursor:pointer;" onchange="mostracor();" id="favcolor" value="#ff0000"></td></tr>
<tr><td colspan="3"><span id="arqtype">&nbsp;</span></td></tr>
<tr><td colspan="3"><span id="arqfile">&nbsp;</span></td></tr>
<tr><td colspan="3"><span style="font-size:9px;" id="arqobs">&nbsp;</span></td></tr>
</td></tr>
</table>

<span style="position:absolute;width:85%;top:500px;font-size:9px;text-align:center;" id="arqsrc">&nbsp;</span>

<div style="position:absolute;left:1200px;top:10px;width:150px;">
<button id="99" class='DIM' style="background-color:#ff0;" onclick='dimuda(this.innerHTML);'>0-99</button>&nbsp;<button id="199" class='DIM' onclick='dimuda(this.innerHTML);'>100-199</button>
</div>
<div style="position:absolute;left:1200px;top:33px;width:150px;">
<button id="299" class='DIM' onclick='dimuda(this.innerHTML);'>200-299</button>&nbsp;<button id="399"class='DIM' onclick='dimuda(this.innerHTML);'>300-399</button>
</div>

<div id="divsel" style="position:absolute;left:0px;width:85%;top:55px;display:none;">
<center>
<select onchange="javascript:document.getElementById('arqsrc').innerHTML=this.value.toString();alterainp()" id="sel">
<option value="s" selected>select src file</option>
<?php
$ja="'";
$dir="./repo";$a=scandir($dir);if($handle=opendir($dir)){
while(false !== ($file=readdir($handle))){
if ($file != "." && $file != ".." && substr($file,-4)==".jpg"){$fale=$ja.$file.$ja;echo "<option value=$fale>$fale</option>";}
}
closedir($handle);
}
?>
</select>
</center>
</div>

<div id="divsel6" style="position:absolute;left:0px;width:85%;top:55px;display:none;">
<center>
<select style="font-size:10px;" onchange="javascript:document.getElementById('arqsrc').innerHTML=this.value.toString();alterainp()" id="sel6">
<option value="s" selected>select src6 file</option>
<?php
$opa=0;
$file=fopen('3ds6i.txt','r');
while(($line=fgetcsv($file))!==FALSE){
$opa++;
if($opa>1){echo "<option value=$line[0]>$line[0]</option>";}
}
fclose($file);
?>
</select>
</center>
</div>

<button onmouseover="javascript:this.style.color='#600';" onmouseout="javascript:this.style.color='#0f0';" title="do not save 3ds.txt" style="position:absolute;left:10px;top:240px;width:150px;height:25px;cursor:pointer;color:#0f0;text-align:center;border:2px outset #ff0;">edit/copy/save</button>
<!--
<div onclick="conlog();" title="grava 3DS" style="position:absolute;left: 30px;top:240px;width:20px;height:20px;background-color:blue;cursor:pointer;"></div>
<div onclick="javascript:document.getElementById('obstab').style.display='none';" title="esconde obs" style="position:absolute;left: 70px;top:240px;width:20px;height:20px;background-color:red;cursor:pointer;"></div>
<div onclick="javascript:document.getElementById('obstab').style.display='inline';" title="mostra obs" style="position:absolute;left:110px;top:240px;width:20px;height:20px;background-color:green;cursor:pointer;"></div>
-->
<script>

document.getElementById("sel").selectedIndex=0;
document.getElementById("passoval").value=0.1;

document.getElementById("tabcontrol").style.left=(window.innerWidth-170)+"px";
function repos(){document.getElementById("arqsrc").style.top=(window.innerHeight-20)+"px";}
repos();
document.write("<div id='099A' style='position:absolute;width:1000px;left:170px;top:10px;height:20px;'>");
for(k=0;k<50;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+k+"</button>");}
document.write("</div>");
document.write("<div id='099B' style='position:absolute;width:1000px;left:170px;top:33px;height:20px;'>");
for(k=50;k<100;k++){document.write("<button id='N"+k+"' title=N"+k+" class='NUM' onclick='mudativo("+k+");'>"+k+"</button>");}
document.write("</div>");

document.write("<div id='100199A' style='position:absolute;width:1000px;left:170px;top:10px;height:20px;display:none;'>");
for(k=100;k<150;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+(k-100)+"</button>");}
document.write("</div>");
document.write("<div id='100199B'style='position:absolute;width:1000px;left:170px;top:33px;height:20px;display:none;'>");
for(k=150;k<200;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+(k-100)+"</button>");}
document.write("</div>");

document.write("<div id='200299A' style='position:absolute;width:1000px;left:170px;top:10px;height:20px;display:none;'>");
for(k=200;k<250;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+(k-200)+"</button>");}
document.write("</div>");
document.write("<div id='200299B' style='position:absolute;width:1000px;left:170px;top:33px;height:20px;display:none;'>");
for(k=250;k<300;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+(k-200)+"</button>");}
document.write("</div>");

document.write("<div id='300399A' style='position:absolute;width:1000px;left:170px;top:10px;height:20px;display:none;'>");
for(k=300;k<350;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+(k-300)+"</button>");}
document.write("</div>");
document.write("<div id='300399B' style='position:absolute;width:1000px;left:170px;top:33px;height:20px;display:none;'>");
for(k=350;k<400;k++){document.write("<button id='N"+k+"' class='NUM' onclick='mudativo("+k+");'>"+(k-300)+"</button>");}
document.write("</div>");

for(k=0;k<400;k++){
	if(document.getElementById("N"+k)){
		document.getElementById("N"+k).title=document.getElementById("N"+k).id;
	}
}

function altAti(stra,j){
	var jar=[];
	jar[j]=stra.split(",");
	boxAtivo=jar[j][0];
	boxSX=jar[j][1];boxSY=jar[j][2];boxSZ=jar[j][3];
	boxPX=jar[j][4];boxPY=jar[j][5];boxPZ=jar[j][6];
	boxRX=jar[j][7];boxRY=jar[j][8];boxRZ=jar[j][9];
	boxC=parseInt(jar[j][10]);
	boxType=jar[j][11].replaceAll("'","");
	boxFile=jar[j][12].replaceAll("'","");
	boxSRC=jar[j][13].replaceAll("'","");
	boxOBS=jar[j][14].replaceAll("'","")+" "+jar[j][0];
	document.getElementById("Comp").value=boxSX;
	document.getElementById("Altu").value=boxSY;
	document.getElementById("Espe").value=boxSZ;
	document.getElementById("inpX").value=boxPX;
	document.getElementById("inpY").value=boxPY;
	document.getElementById("inpZ").value=boxPZ;
	document.getElementById("rotX").value=boxRX;
	document.getElementById("rotY").value=boxRY;
	document.getElementById("rotZ").value=boxRZ;
	document.getElementById("favcolor").value="#"+("000000"+boxC.toString(16)).substr(-6);
	document.getElementById("arqtype").innerHTML=boxType;
	document.getElementById("arqfile").innerHTML=boxFile;
	document.getElementById("arqsrc").innerHTML=boxSRC;
	document.getElementById("arqobs").innerHTML=boxOBS;
	if(boxType=="OBJ" || boxType=="Geometry"){document.getElementById("divsel").style.display='';} else {document.getElementById("divsel").style.display='none';}
	if(boxType=="Geometry6"){document.getElementById("divsel6").style.display='';} else {document.getElementById("divsel6").style.display='none';}
	alterainp();
}

var sar=[];

var j=0;

function mudativo(j){
//alert(j);
	for(k=0;k<400;k++){
		if(document.getElementById('N'+k)){
			document.getElementById('N'+k).className="NOK";
		}
	}
	document.getElementById('N'+j).className="OK";
	if(sar[j]){stra=sar[j];altAti(stra,j);}
}

function opalong(f){
	document.getElementById("sol").selectedIndex=0;
	//alert(f.substr(20));
	alert(f);
}

</script>

<div style='position:absolute;left:10px;top:260px;height:20px;font-size:10px;line-height:10px;color:#660;display:none;'>
<!--
<select onchange="opalong(this.value);" id="sol" style='font-size:9px;'>
-->
<select id="sol" style='font-size:9px;'>

<option value="s" selected>select src file</option>
<?php
	if($file=fopen("3ds.txt","r")){
		while(!feof($file)){$line=fgets($file);
			echo "<option value=$line>$line</option>";
		}
		fclose($file);
	}
?>
</select>
</div>

<div id="obstab" style='position:absolute;left:10px;top:270px;height:250px;overflow-y:scroll;display:none;'>
<?php
	echo "<table style='border:none;font-size:10px;line-height:10px;'>";
	$file=fopen('new3ds.txt','r');
	while (($line = fgetcsv($file))!==FALSE){
		if($line[14]!="'_'"){echo "<tr><td>".$line[0]."</td><td id=$line[0]>".str_replace("'","",$line[14])."</td></tr>";}
	}
	fclose($file);
	echo "</table>";
?>
</div>

<div style='position:absolute;left:10px;top:15px;width:150px;font-family:Geogia;font-size:41px;color:#660;'><center>Evelyn</center></div>

<p style='position:absolute;left:300px;top:450px;display:none;' id="ppara" class="unbroken">United States of America (USA)</p>
<p class="broken" style='position:absolute;left:300px;top:470px;display:none;'></p>

<script>

var option=document.createElement("option");
option.text="JR";
option.value="Lazzareschi";
var dosel=document.getElementById("sel");
dosel.appendChild(option);

function selectOption(nr) {
	var praselect = $("#sel");
		if(praselect.children().length>=nr){
		valua=praselect.find('option:eq('+nr+')').val();
	}
}

var pegasol=document.getElementById('sol');
var varia=0;
for(k=1;k<400;k++){
	if(pegasol.options[k]){
		varia=pegasol.options[k].value;
		jar=varia.split(",");
		if(jar[0]<400 && document.getElementById("N"+jar[0])){document.getElementById('N'+jar[0]).style.backgroundColor="#906";}// background color
		sar[jar[0]]=varia;
	}
}

function clearInvalid(tid) {
	document.getElementById(tid).value=document.getElementById(tid).value.replace(/[^\d.-]/g, '');;
}

// obs nos ids
for(k=0;k<400;k++){
	if(document.getElementById(k) && document.getElementById("N"+k)){
		document.getElementById("N"+k).title=document.getElementById(k).innerHTML;
	}
}

function dimuda(dima){
	document.getElementById("099A").style.display="none";document.getElementById("099B").style.display="none";
	document.getElementById("100199A").style.display="none";document.getElementById("100199B").style.display="none";
	document.getElementById("200299A").style.display="none";document.getElementById("200299B").style.display="none";
	document.getElementById("300399A").style.display="none";document.getElementById("300399B").style.display="none";
	document.getElementById("99").style.backgroundColor="#033";
	document.getElementById("199").style.backgroundColor="#033";
	document.getElementById("299").style.backgroundColor="#033";
	document.getElementById("399").style.backgroundColor="#033";
	if(dima=="0-99"){document.getElementById("099A").style.display="";document.getElementById("099B").style.display="";document.getElementById("99").style.backgroundColor="#ff0";}
	if(dima=="100-199"){document.getElementById("100199A").style.display="";document.getElementById("100199B").style.display="";document.getElementById("199").style.backgroundColor="#ff0";}
	if(dima=="200-299"){document.getElementById("200299A").style.display="";document.getElementById("200299B").style.display="";document.getElementById("299").style.backgroundColor="#ff0";}
	if(dima=="300-399"){document.getElementById("300399A").style.display="";document.getElementById("300399B").style.display="";document.getElementById("399").style.backgroundColor="#ff0";}
}


function parasim(){

}



/*

Evelyn floorplan project - open code

Hi Three.js followers,

the link:

http://jrlazz.eu5.org/evelyn/evelyn_1.php

It is an alternative floorplan Three.js page.

The way it is presented, You can click in one numbered-ocupied-red box
 and move/altere with WADS GH and LP keys or inputting values and clicking 'OK'.

This online page will not save altered data for not accept movements that
 can obstruct future visits.

I suppose the the interested One's must study the code and create His/Her own
application page.

The PHP code (very small code) is just needed to save and restore the 3ds.txt
 file.

You can view the 3ds.txt file to find how the objects are stored in the Evelyn floorplan.

The 3ds.txt file has a number,  has a number, position, scale, type of object, reference file, and obs.
 X before the number means that the line is not considered.

Please try a click in the 2, 3 or 4 numbered-ocupied-red boxes and move the vase flowers.

Please try the numbered-ocupied-red number 41 and choose a new image...

In the real application I can use box 0 to start some wall, move it, change it,
 and then save it to a new  numbered position. Then passed from green to red.

This work started in 2021 to draw the apartament my Daughter lived.

The page uses the Three.js 150 and the files used (images, meshes, etc.) are stored
 in the 'repo' path.

The 3ds.txt file is in the path of evelin...php page.

Well, depending of interested visits, I can include more detaisl.

PS: Helicopter is from City Hall People to see if the floorplan can be approved!!!

________

Again, Thanks for the great Three.js Team!

Jose Roberto Lazzareschi

*/

</script>

</body>

</html>
