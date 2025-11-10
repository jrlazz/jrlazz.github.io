<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="apple-mobile-web-app-title" content="CodePen">
<title>WebAudio API w/Oscilloscope</title>

<style>

html {
    display: table;
    margin: auto;
}

body {
    display: table-cell;
    vertical-align: middle;
}
//body { background:#4674FA;}
body { background:#bcc;}
span {font-family: cursive; color:#46e;}
.audio-viz__form { max-width:350px; margin:1rem auto 1rem; color:#fff;}
.audio-viz__radio + label:hover { cursor: pointer;}
.audio-viz__radio { display: none;}
.audio-viz__radio + label span { border: 2px solid #fff;  display: inline-block; vertical-align: middle;}

.audio-viz__radio:checked + label span { background: #1F007E;}

.audio-viz { position:absolute;left:2px;top:5px;}

.audio-viz__title { font-family:cursive; font-size:30px; text-align:center; color:#57f;}
.audio-viz__btn { margin: auto; display:-webkit-box; display:flex; z-index:1; background:#57f; color: white; font-size:14pt; padding:4px; padding-left:8px; padding-right:8px;}
.audio-viz__btn:hover { cursor:pointer;}

#oscilloscope { border-top: 2px solid #e6ebf1; border-bottom: 2px solid #e6ebf1;
  height: 200px; width: 802px; background-color: #040d7f;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.7'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  background-position: -5px -5px;
}

.sli {height: 5px; background: #57f;}
.sli::-moz-range-thumb { width:15px; height:15px; background:#008; cursor:pointer; border-radius:10px;}

</style>

</head>

<body>

<select id="sel" onchange="sele();" style="position:absolute;left:2px;top:78px;width:802px;z-index:3;background-color:#009;color:#ff0;font-size:14px;">
<option value="https://us3.internet-radio.com/proxy/kfxy?mp=/stream;">country:m4a:us3.internet-radio.com/proxy/kfxy?mp=/stream;</option>
<option value="https://us3.internet-radio.com/proxy/ycountry?mp=/stream;">country:mp3:us3.internet-radio.com/proxy/ycountry?mp=/stream;</option>
<option value="https://uk6.internet-radio.com/proxy/cherwell?mp=/stream;">country:mp3:uk6.internet-radio.com/proxy/cherwell?mp=/stream;</option>
<option value="https://us3.internet-radio.com/proxy/kfxy?mp=/stream;">country:m4a:us3.internet-radio.com/proxy/kfxy?mp=/stream;</option>
<option value="https://us3.internet-radio.com/proxy/ycountry?mp=/stream;">country:mp3:us3.internet-radio.com/proxy/ycountry?mp=/stream;</option>
<!--
<option value="http://www.partyviberadio.com:8020/;stream/3">country:mp3:us3.www.partyviberadio.com:8020/;stream/3</option>
-->

<option value="http://ice1.somafm.com/seventies-128-aac">ice1.somafm.128-aac</option>
<option value="http://ice6.somafm.com/seventies-128-mp3">ice6.somafm.128-mp3</option>
<option value="http://media-ice.musicradio.com:80/ClassicFMMP3">media-ice.musicradio.com:80/ClassicFMMP3</option>
<option value="https://playerservices.streamtheworld.com/api/livestream-redirect/WLTRFM.mp3">playerservices.streamtheworld.com/api/livestream-redirect/WLTRFM.mp3</option>
<option value="https://playerservices.streamtheworld.com/api/livestream-redirect/WRJAFM.mp3">playerservices.streamtheworld.com/api/livestream-redirect/WRJAFM.mp3</option>
<option value="https://us4.internet-radio.com/proxy/knklsturgis?mp=/stream;">us4.internet-radio.com/proxy/knklsturgis?mp=/stream;</option>
<option value="../lazz/audio/unstress_you_red.mp3" selected>unstress_you</option>
<option value="../lazz/audio/notforsale_red.mp3">notforsale</option>
<option value="../lazz/audio/comeplaywith_me_red.mp3">comeplaywith_me</option>
<option value="../lazz/audio/letmebe_red.mp3">letmebe</option>
<option value="https://us4.internet-radio.com/proxy/douglassinclair?mp=/stream;">rock:mp3:us4.internet-radio.com/proxy/douglassinclair?mp=/stream;</option>
<option value="https://uk7.internet-radio.com/proxy/danceradioukchatbox?mp=/stream;">rock:m4a:uk7.internet-radio.com/proxy/danceradioukchatbox?mp=/stream;</option>
<option value="https://us5.internet-radio.com/proxy/wcrr?mp=/stream;">rock:mp3:us5.internet-radio.com/proxy/wcrr?mp=/stream;</option>
<option value="https://uk2.internet-radio.com/proxy/classicrockmiami?mp=/stream;">rock:m4a:uk2.internet-radio.com/proxy/classicrockmiami?mp=/stream;</option>
<option value="https://us3.internet-radio.com/proxy/topblues?mp=/stream;">rock:m4a:us3.internet-radio.com/proxy/topblues?mp=/stream;</option>
<option value="https://us5.internet-radio.com/proxy/wcrg?mp=/stream;">rock:mp3:us5.internet-radio.com/proxy/wcrg?mp=/stream;</option>
<option value="https://uk1.internet-radio.com/proxy/meatliquor?mp=/stream;">rock:mp3:uk1.internet-radio.com/proxy/meatliquor?mp=/stream;</option>
<option value="https://uk5.internet-radio.com/proxy/top80radio?mp=/stream;">rock:m4a:uk5.internet-radio.com/proxy/top80radio?mp=/stream;</option>
<option value="https://us5.internet-radio.com/proxy/crplanet?mp=/stream;">rock:mp3:us5.internet-radio.com/proxy/crplanet?mp=/stream;</option>
<option value="https://us4.internet-radio.com/proxy/knklsturgis?mp=/stream;">rock:mp3:us4.internet-radio.com/proxy/knklsturgis?mp=/stream;</option>
<option value="https://uk7.internet-radio.com/proxy/242radio?mp=/stream;">rock:mp3:uk7.internet-radio.com/proxy/242radio?mp=/stream;</option>
<option value="https://uk2.internet-radio.com/proxy/nonstopx?mp=/stream;">rock:mp3:uk2.internet-radio.com/proxy/nonstopx?mp=/stream;</option>
<option value="https://uk3.internet-radio.com/proxy/dublinpirate?mp=/stream;">rock:mp3:uk3.internet-radio.com/proxy/dublinpirate?mp=/stream;</option>
<option value="https://us3.internet-radio.com/proxy/raverocksradio?mp=/stream;">mp3:us3.internet-radio.com/proxy/raverocksradio?mp=/stream;</option>
<option value="http://jrlazz.eu5.org/lazz/audio/unstress_you_red.mp3">freewha unstress_you_red.mp3</option>
<option value="200_400_1k_2k_4k_8k_10k_32kbps.mp3">200_400_1k_2k_4k_8k_10k_32kbps.mp3</option>


</select>

<div style="position:absolute;left:0px;top:385px;text-align:center;">
<input class="sli" id="slider" onchange="mudavol()" type="range" min="0" max="1" step="0.01" value=".1" style="width:800px;"></input>
<br><span id="valvol"></span>
</div>

<audio hidden id="player" controls><source id="sourceplayer" src="unstress_you_red.mp3"></audio>

<canvas width="800px" height="200px" background-color="#000000" id="soundCanv" style="position:absolute;left:2px;top:121px;border:1px solid #fff;z-index:3;"></canvas>

<div class="audio-viz">

<h1 class="audio-viz__title">WebAudio Visualizer</h1>

<form class="audio-viz__form" style="visibility:hidden;">
<input type="radio" class="audio-viz__radio" id="senventies" name="radio-selection" value="unstress_you_red.mp3" checked>
<label for="senventies"><span></span>unstress</label>
</form>

<canvas id="oscilloscope"></canvas>
<br><br>
<button class="audio-viz__btn" id="start">Start Audio</button>

</div>

<script>

let start_button=document.getElementById('start');
let radios=document.querySelectorAll('input[name="radio-selection"]');
let radios_length=radios.length;
let audioContext;
let masterGain;
var mudaudio=1;

// Audio Setup

var source;
var song;

function audioSetup() {
	audioContext=new (window.AudioContext || window.webkitAudioContext)();
	masterGain=audioContext.createGain();
	masterGain.connect(audioContext.destination);
	song=new Audio(source),
	songSource=audioContext.createMediaElementSource(song),
	songPlaying=false;
	song.crossOrigin='anonymous';
	songSource.connect(masterGain);
	for (var i=0,max=radios_length;i< max;i++){
		radios[i].addEventListener('change',function (){
			if (songPlaying){
				song.pause();
				start_button.innerHTML='Start Audio';
				songPlaying=!songPlaying;
			}
			// Without these lines the oscilloscope won't update
			// when a new selection is made via radio inputs
			song=new Audio(this.value);
			songSource=audioContext.createMediaElementSource(song),
			song.crossOrigin='anonymous';
			songSource.connect(masterGain);
		});
	}

	start_button.addEventListener('click', function () {
		if (songPlaying) {
		player.pause();
		player.currentTime=0;
		song.pause();
		start_button.innerHTML='Start Audio';
		start_button.style.backgroundColor='#090';
	} else {
//		song.volume=0.1;
		song.play();
		player.play();
		mudavol();
		drawOscilloscope();
		updateWaveForm();
		start_button.innerHTML='Stop Audio';
		start_button.style.backgroundColor='#c00';
	}

    songPlaying = !songPlaying;
  });
}


audioSetup();

// Create Wave Form

const analyser=audioContext.createAnalyser();
masterGain.connect(analyser);

const waveform=new Float32Array(analyser.frequencyBinCount);
analyser.getFloatTimeDomainData(waveform);

function updateWaveForm(){
	requestAnimationFrame(updateWaveForm);
	analyser.getFloatTimeDomainData(waveform);
}

// Draw Oscilloscope

function drawOscilloscope(){
	requestAnimationFrame(drawOscilloscope);
	const scopeCanvas=document.getElementById('oscilloscope');
	const scopeContext=scopeCanvas.getContext('2d');
	scopeCanvas.width=waveform.length;
	scopeCanvas.height=200;
	scopeContext.clearRect(0,0,scopeCanvas.width,scopeCanvas.height);
	scopeContext.beginPath();
	for (let i=0;i<waveform.length;i++){
		const x=i;
// era /2
		const y=(0.5 + mudaudio*(waveform[i]/.5)) * scopeCanvas.height;
		if (i==0){
			scopeContext.moveTo(x,y);
		} else {
			scopeContext.lineTo(x,y);
		}
	}
	scopeContext.strokeStyle = '#0f9';
	scopeContext.lineWidth = 2;
	scopeContext.stroke();
}

//# sourceURL=pen.js

</script>


<script>

//alert("111");
        
	var audioCtx = new AudioContext();
	var canvas=document.getElementById("soundCanv");
	var canvasCtx=canvas.getContext("2d");
        var myAudio=document.querySelector('audio');
	var analyserZ = audioCtx.createAnalyser(); 
	var source=audioCtx.createMediaElementSource(myAudio);
	source.connect(analyserZ);
	analyserZ.connect(audioCtx.destination);
	analyserZ.fftSize=1024;
	var bufferLength=analyserZ.frequencyBinCount;
	var dataArray=new Uint8Array(bufferLength);

function draw() {
	canvasCtx.clearRect(0, 0,canvas.width, canvas.height);
	analyserZ.getByteFrequencyData(dataArray);
	var barWidth = (canvas.width / bufferLength) * 1.0;
	var barHeight;
	var x=0;
	for(var i = 0; i < bufferLength; i++) {
		barHeight = dataArray[i]/.75;
//		canvasCtx.fillStyle = 'rgb(' + (barHeight+100) + ', 120 , ' + (255-barHeight+100) + ' )';
		canvasCtx.fillStyle='hsla(' + barHeight + ',100%,50%,0.5)';
		canvasCtx.fillRect(x*2.25,canvas.height-barHeight/1.4,barWidth,barHeight);
		x += barWidth + .5;
	}
	window.requestAnimationFrame(draw);    
};

window.requestAnimationFrame(draw);
draw();


function sele(){
//alert(tv);
	player.pause();
	player.currentTime = 0;
	song.pause();
	start_button.style.backgroundColor='#960';
	start_button.innerHTML='Click to Start Audio ... maybe necessary to Start Audio again!';
	song.src=document.getElementById("sel").value;
	player.src=document.getElementById("sel").value;
// alert(document.getElementById("sel").value);
}

function mudavol(){
	let vemvol=document.getElementById("slider").value;
	document.getElementById("valvol").innerHTML="Volume " + parseInt(100*vemvol) + "%";
	song.volume=document.getElementById("slider").value;
	if(vemvol<0.3){
		mudaudio=1.4-vemvol;
	} else {
		mudaudio=1-(0.7*vemvol);
	}
}


player.volume=0.01;

</script>


<script>
document.getElementById("slider").value=0.2;
document.getElementById("valvol").innerHTML="Volume " +"20%";
document.getElementById("sel").value="../lazz/audio/unstress_you_red.mp3";
sele();

</script>

</body>
</html>

<!--
-->