class ComplexArray{
	constructor(other,arrayType=Float32Array){
		if(other instanceof ComplexArray){
			this.ArrayType=other.ArrayType;
			this.real=new this.ArrayType(other.real);
			this.imag=new this.ArrayType(other.imag);
		} else{
			this.ArrayType=arrayType;
			this.real=new this.ArrayType(other);
			this.imag=new this.ArrayType(this.real.length);
		}
		this.length=this.real.length;
	}
	toString(){
		const components=[];
		this.forEach((value,i) =>{
			components.push(`(${value.real.toFixed(2)},${value.imag.toFixed(2)})`);
		});
		return `[${components.join(',')}]`;
	}
	forEach(iterator){
		const n=this.length;
		const value=Object.seal(Object.defineProperties({},{
			real:{writable: true },imag:{writable: true },
		}));
		for(let i=0;i<n;i++){value.real=this.real[i];value.imag=this.imag[i];iterator(value,i,n);}
	}
	map(mapper){
		this.forEach((value,i,n) =>{
			mapper(value,i,n);
			this.real[i]=value.real;
			this.imag[i]=value.imag;
		});
		return this;
	}
	conjugate(){return new ComplexArray(this).map((value) =>{value.imag *= -1; });}
	magnitude(){
		const mags=new this.ArrayType(this.length);
		this.forEach((value,i) =>{
			mags[i]=Math.sqrt(value.real*value.real+value.imag*value.imag);
		});
		return mags;
	}
	FFT(){return fft(this,false);}
	InvFFT(){return fft(this,true);}
	frequencyMap(filterer){return this.FFT().map(filterer).InvFFT();}
}

function fft(input,inverse){
	const n=input.length;
	if(n & (n-1)){
		return FFT_Recursive(input,inverse);
	} else{
		return FFT_2_Iterative(input,inverse);
	}
}

function FFT_Recursive(input,inverse){
	const n=input.length;
	if(n === 1){return input;}
	const output=new ComplexArray(n,input.ArrayType);
	const p=LowestOddFactor(n);
	const m=n/p;
	const normalisation=1/Math.sqrt(p);
	let recursive_result=new ComplexArray(m,input.ArrayType);
	for(let j=0;j<p;j++){
		for(let i=0; i<m; i++){
			recursive_result.real[i]=input.real[i*p+j];
			recursive_result.imag[i]=input.imag[i*p+j];
		}
		if(m>1){recursive_result=fft(recursive_result,inverse);}
		const del_f_r=Math.cos(2*Math.PI*j/n);
		const del_f_i=(inverse ? -1 : 1)*Math.sin(2*Math.PI*j/n);
		let f_r=1;
		let f_i=0;
		for(let i=0; i<n; i++){
			const _real=recursive_result.real[i % m];
			const _imag=recursive_result.imag[i % m];
			output.real[i] += f_r*_real-f_i*_imag;
			output.imag[i] += f_r*_imag+f_i*_real;
			[f_r,f_i]=[f_r*del_f_r-f_i*del_f_i,f_r*del_f_i+f_i*del_f_r];
		}
	}
	for(let i=0; i<n; i++){
		input.real[i]=normalisation*output.real[i];
		input.imag[i]=normalisation*output.imag[i];
	}
	return input;
}

function FFT_2_Iterative(input,inverse){
	const n=input.length;
	const output=BitReverseComplexArray(input);
	const output_r=output.real;
	const output_i=output.imag;
	let width=1;
	while (width<n){
		const del_f_r=Math.cos(Math.PI/width);
		const del_f_i=(inverse ? -1 : 1)*Math.sin(Math.PI/width);
		for(let i=0; i<n/(2*width); i++){
			let f_r=1;
			let f_i=0;
			for(let j=0; j<width; j++){
				const l_index=2*i*width+j;
				const r_index=l_index+width;
				const left_r=output_r[l_index];
				const left_i=output_i[l_index];
				const right_r=f_r*output_r[r_index]-f_i*output_i[r_index];
				const right_i=f_i*output_r[r_index]+f_r*output_i[r_index];
				output_r[l_index]=Math.SQRT1_2*(left_r+right_r);
				output_i[l_index]=Math.SQRT1_2*(left_i+right_i);
				output_r[r_index]=Math.SQRT1_2*(left_r-right_r);
				output_i[r_index]=Math.SQRT1_2*(left_i-right_i);
				[f_r,f_i]=[f_r*del_f_r-f_i*del_f_i,f_r*del_f_i+f_i*del_f_r];
			}
		}
		width <<= 1;
	}
	return output;
}

function BitReverseIndex(index,n){
	let bitreversed_index=0;
	while (n>1){
		bitreversed_index <<= 1;
		bitreversed_index += index & 1;
		index >>= 1;
		n >>= 1;
	}
	return bitreversed_index;
}

function BitReverseComplexArray(array){
	const n=array.length;
	const flips=new Set();
	for(let i=0;i<n;i++){
		const r_i=BitReverseIndex(i,n);
		if(flips.has(i)) continue;
		[array.real[i],array.real[r_i]]=[array.real[r_i],array.real[i]];
		[array.imag[i],array.imag[r_i]]=[array.imag[r_i],array.imag[i]];
		flips.add(r_i);
	}
	return array;
}

function LowestOddFactor(n){
	const sqrt_n=Math.sqrt(n);
	let factor=3;
	while(factor<=sqrt_n){if(n % factor === 0) return factor;factor += 2;}
	return n;
}

function drawToCanvas(element_id,data){				//for original
	const element=document.getElementById(element_id);
	const width=element.clientWidth;
	const height=element.clientHeight;
	const n=data.length;
	const canvas=document.createElement('canvas');
	canvas.width=width;
	canvas.height=height;
	element.appendChild(canvas);
	const context=canvas.getContext('2d');
	context.strokeStyle='#000';
	context.beginPath();
	data.forEach((c_value,i) =>{context.lineTo(i*width/n,height/3*(1.5-c_value.real));});
	context.stroke();
}

function replaceToCanvas(element_id,data){
	const element=document.getElementById(element_id);
	const width=element.clientWidth;
	const height=element.clientHeight;
	const n=data.length;
	const canvas=document.createElement('canvas');
	canvas.id="can";
	canvas.width=width;
	canvas.height=height;
	element.removeChild(element.childNodes[0]);
	element.appendChild(canvas);
	const context=canvas.getContext('2d');
	context.globalCompositeOperation='destination-under';
	context.fillStyle="#033";
	context.fillRect(0,0,canvas.width,canvas.height);
	context.strokeStyle='#fff';
	context.beginPath();
	if(quant==128){data.forEach((c_value,i) =>{context.lineTo(i*width/n,(height/4*(1.0-c_value.real)/2+8));});}
	if(quant== 64){data.forEach((c_value,i) =>{context.lineTo(i*width/n,(height/2*(1.5-c_value.real)/3+16));});}
	context.stroke();
}

draw_plot=(samplearr) =>{
	const data=new ComplexArray(quant).map((value,i) =>{value.real=samplearr[i]; });
	replaceToCanvas('original',data);
	data.FFT();
	replaceToCanvas('fft',data);
	const real=new Float32Array(quant);
	const imag=new Float32Array(quant);
	data.forEach((value,i) =>{
		real[i]=value.real;
		imag[i]=value.imag;
	});
	let v=30;
	pianono(real,imag);
}

window.onload=function(){
	const data=new ComplexArray(quant).map((value,i,n) =>{value.real=0;});
	drawToCanvas('original',data);
	data.FFT();
	drawToCanvas('fft',data);
}

var c=document.getElementById("canv");
var ctx=c.getContext("2d");
c.width=600;
class Square{
	constructor(x,y,wh,ctxt){
		this.xpos=x;
		this.ypos=y;
		this.size=wh;
		this.ctx=ctxt;
		this.selected=false;
		this.pointerx=0;
		this.pointery=0;
		this.left_line=null;
		this.right_line=null;
	}
	draw(){
		this.ctx.beginPath();
								this.ctx.strokeStyle="#0ff";
		this.ctx.rect(this.xpos+4,this.ypos+4,this.size/2,this.size/2);// era sem o 2
		this.ctx.stroke();
	}
	get_center_x(samples=quant){
		let cw=ctx.canvas.width;
		let sqcenterx=this.xpos+this.size/2;
		let datax=Math.round(sqcenterx/(cw/samples));
		return datax;
	}
	get_center_y(samples=quant){
		let ch=ctx.canvas.height;
		let sqcentery=this.ypos+this.size/2;
		let datay=(ch/2-sqcentery)/(samples/2);
		return datay;
	}
	pointer_in(ptrx,ptry){
		if(ptrx>=this.xpos && ptrx <= this.xpos+this.size && ptry>=this.ypos && ptry <= this.ypos+this.size){
			return true;
		}else{
			return false;
		}
	}
	assign_left_line(line){line.ctx=this.ctx;this.left_line=line;this.update_left_line();}
	update_left_line(){this.left_line.xend=this.xpos+(this.size/2);this.left_line.yend=this.ypos+(this.size/2);}
	assign_right_line(line){line.ctx=this.ctx;this.right_line=line;this.update_right_line();}
	update_right_line(){this.right_line.xpos=this.xpos+(this.size/2);this.right_line.ypos=this.ypos+(this.size/2);}
	select_square(ptrx,ptry){this.selected=true;this.pointerx=ptrx-this.xpos;this.pointery=ptry-this.ypos;}
	drag_square(ptrx,ptry){this.xpos=ptrx-this.pointerx;this.ypos=ptry-this.pointery;if(this.left_line != null){this.update_left_line();}
	if(this.right_line != null){
		this.update_right_line();}
	}
}

class Line{
	constructor(x,y,ye,xe,ctxt){
		this.xpos=x;
		this.ypos=y;
		this.xend=xe;
		this.yend=ye;
		this.ctx=ctxt;
	}
	draw(){
		this.ctx.beginPath();
								this.ctx.strokeStyle="#ff0";
		this.ctx.moveTo(this.xpos,this.ypos);
		this.ctx.lineTo(this.xend,this.yend);
		this.ctx.stroke();
	}
}

let squares=[];
let lines=[];
let points=24
if(tipo=="sen"){
	for(let i=0;i<points;i++){
		squares.push(new Square((i*c.width/(points-1))-10,(c.height/2)-10+50*Math.sin(2*Math.PI*(i/(points-1))),20,ctx));
	}
}
if(tipo=="qua"){
	for(let i=0;i<points+1;i++){
		if(i>=points/2){
			squares.push(new Square((i*c.width/(points-1))-10,(c.height/2)-0+60,20,ctx));
		}else{
			squares.push(new Square((i*c.width/(points-1))-10,(c.height/2)-0-70,20,ctx));
		}
	}
}
if(tipo=="tri"){
	let step=0;//triangle
	for(let i=0;i<points;i++){
		if(i>=points/2){
			step++;squares.push(new Square((i*c.width/(points-1))-10,(c.height/2)+70+step*12,20,ctx));
		}else{
			step--;squares.push(new Square((i*c.width/(points-1))-10,(c.height/2)+80+step*13,20,ctx));
		}
	}
}	
if(tipo=="rra"){
	for(let i=0;i<points;i++){
		squares.push(new Square((i*c.width/(points-1))-10,(c.height/2)+65-6*i,20,ctx));
	}
}
	for(let i=0;i<points;i++){lines.push(new Line());}
	squares[0].assign_right_line(lines[0]);
	for(let i=1;i<points;i++){squares[i].assign_left_line(lines[i-1]);squares[i].assign_right_line(lines[i]);}
	squares[squares.length-1].assign_left_line(lines[lines.length-1]);
	squares.forEach(function(sq){sq.draw();});
	lines.forEach(function(ln){ln.draw();});
	let rect=ctx.canvas.getBoundingClientRect();
	c.addEventListener('mousedown',e =>{
		let x=e.clientX-rect.left;
		let y=e.clientY-rect.top;
		squares.forEach(function(square){if(square.pointer_in(x,y)){square.select_square(x,y);}
	});
});

c.addEventListener('mousemove',e =>{
	var output="";
	let x=e.clientX-rect.left;
	let y=e.clientY-rect.top;
	ctx.clearRect(0,0,c.width,c.height);
	squares.forEach(
		function(square){if(square.selected){square.drag_square(x,y);}}
	);
	squares.forEach(function(sq){sq.draw();});
	lines.forEach(function(ln){ln.draw();});
});

window.addEventListener('mouseup',e =>{
	let samplearr=new Array(quant);
	samplearr.fill("x");
	squares.forEach(
		function(sq){sq.selected=false;samplearr[sq.get_center_x()]=sq.get_center_y();}
	);
	let lastindex=0;
	for(let i=0;i<samplearr.length;i++){
		if(samplearr[i] != "x"){
			let difference=samplearr[i]-samplearr[lastindex];
			let chunk=difference/(i-lastindex);
			for(let j=i-1;samplearr[j] == "x";j --){samplearr[j]=samplearr[j+1]-chunk;}
			lastindex=i;
		}
	}
	draw_plot(samplearr);
})

var tones={
	context:new (window.AudioContext || window.webkitAudioContext)(),
	wave:null,
	playFrequency: function(freq){
		var osc=this.context.createOscillator();
		osc.frequency.setValueAtTime(freq,this.context.currentTime);
		osc.type=this.type;
		if(!(this.wave === null)){osc.setPeriodicWave(this.wave);}
		osc.start(this.context.currentTime + 0.1);
	},
	play: function(freqOrNote,octave){
//alert(freqOrNote);
		if(typeof freqOrNote === "number"){
			this.playFrequency(freqOrNote);
		} else if(typeof freqOrNote === "string"){
			if(octave == null){octave=4;}
			this.playFrequency(this.map[octave][freqOrNote.toLowerCase()]);
			freqval=this.map[octave][freqOrNote.toLowerCase()];
		}
		foi=0;
	},
	getTimeMS: function(){
	return this.context.currentTime*1000;
	},
	map:[{"c":0},{"c":0},{"c":130.813,"c#":138.591},{"c":261.626,"c#":277.183}]};
	window.tones=tones;
	pianono=(real,imag) =>{
	arrayreal=real;
	arrayimag=imag;
	var xreal=[];
	var ximag=[];
	for(z=0;z<200;z++){
		if(real[z]){xreal[z]=parseInt(real[z]*1000)/1000;ximag[z]=parseInt(imag[z]*1000)/1000;}
	}
	//console.log("xreal"+xreal);
	window.parent.document.getElementById("spr").innerText=xreal;
	//console.log("ximag"+ximag);
	window.parent.document.getElementById("spi").innerText=ximag;

	if(clickou==0){
		clickou=1;
		for(let z=0;z<quant;z++){
			dreal.innerText=dreal.innerText+"["+z+"] "+(real[z].toString()).substring(0,6)+ "\n";
			dimag.innerText=dimag.innerText+"["+z+"] "+(imag[z].toString()).substring(0,6)+ "\n";
		}
	}
}


function click1(){clickou=0;console.clear();}
function click2(){foi=0;dreal.innerText="real\n";dimag.innerText="imag\n";console.clear();}

function draw(){	
	if(myOscilloscope){myOscilloscope.draw(cope.myContext);}
	requestAnimationFrame(draw);
}

function setupCanvases(){
	//oscilo
	cope=document.createElement('canvas');
	cope.style.borderWidth="1px";
	cope.style.borderColor="#fc0 #000 #000 #fc0";
	cope.style.position="absolute";
	cope.style.top="150px";
	cope.style.left="9px";
	cope.width=256;		cope.height=128; 
	cope.id="scope";
	cope.myContext=cope.getContext('2d');
	document.body.appendChild(cope);
}

function init(){
	if(foi==0){setupCanvases();setupAudio(cope);draw();foi=1;}
}

function start(time){this.osc.start(time+0.0);}
function stop(time){this.osc.stop(time);}

function setupAudio(obj){
	window.AudioContext=window.AudioContext || window.webkitAudioContext;
	aCx=new AudioContext();
	analyser=aCx.createAnalyser();
	analyser.fftSize=2048;//2048
	myOscilloscope=new Oscilloscope(analyser,512,256);
	var customWave=aCx.createPeriodicWave(arrayreal,arrayimag);
	var output=aCx.createGain();
	var delay=aCx.createDelay();
        var osc=aCx.createOscillator();
        osc.setPeriodicWave(customWave);
        osc.frequency.setValueAtTime(freqval,aCx.currentTime); // freqval
	osc.connect(output);
	delay.connect(output);
	output.gain.value=0.5;
	osc,frequency=(20,0.5);// 0.5
	output.connect(aCx.destination);
	output.connect(analyser);
	osc.connect(output);
	osc.start(aCx.currentTime+0.0);
	osc.stop(aCx.currentTime+0.5);
}

//Oscilloscope

function Oscilloscope(analyser,width,height) {
	this.analyser=analyser;
	this.data=new Uint8Array(analyser.frequencyBinCount);
	this.width=width;
	this.height=height;
}

Oscilloscope.prototype.draw=function (context) {
	var data=this.data;
	var quarterHeight=this.height/2;
	var scaling=this.height/256;
	this.analyser.getByteTimeDomainData(data);
	context.lineWidth=1;
	context.fillStyle="#033";
	context.fillRect(0,0,this.width,this.height);
	context.strokeStyle="#ff0";
	context.beginPath();
	for (var i=0, j=0; (j<this.width)&&(i<data.length);i++,j++){context.lineTo(j,(128-(data[i]/2)*scaling));}
	context.stroke();
}
