<script>
var clock = new THREE.Clock();
var scene, renderer, camera;
var controls, keyboard = new KeyboardState();

var toycar;

// state variable of toycar
var pos = new THREE.Vector3(0,0,0);
var angle = 0;
var speed = 5;

init();
animate();

function init()
{
	var width = window.innerWidth;
	var height = window.innerHeight;

	renderer = new THREE.WebGLRenderer({antialias: true});
	renderer.setSize (width, height);
	document.body.appendChild (renderer.domElement);

	scene = new THREE.Scene();

	camera = new THREE.PerspectiveCamera (45, width/height, 1, 10000);
	camera.position.y = 160;
	camera.position.z = 400;
	camera.lookAt (new THREE.Vector3(0,0,0));

	var loader = new THREE.OBJMTLLoader();
	loader.load ('models/toycar.obj', 'models/toycar.mtl',
	   function (object) {
		 toycar = object;
		 scene.add( toycar );
	   } );

	// add control here (after the camera is defined)
	//controls = new THREE.OrbitControls (camera, render.domElement);
	var gridXZ = new THREE.GridHelper(100, 10);
	gridXZ.setColors( new THREE.Color(0xff0000), new THREE.Color(0xffffff) );
	scene.add(gridXZ);

	var pointLight = new THREE.PointLight (0xffffff);
	pointLight.position.set (0,300,200);
	scene.add (pointLight);

	var ambientLight = new THREE.AmbientLight (0x111111);
	scene.add(ambientLight);
}

function animate()
{
	var dt = clock.getDelta();

	var dir = new THREE.Vector3(1,0,0);
	dir.multiplyScalar (dt*speed);	//dir *= dt*speed;
	dir.applyAxisAngle (new THREE.Vector3(0,1,0), angle);
	pos.add (dir); 	//pos = pos + dir;

	if (toycar != undefined) {
		toycar.scale.set (0.2,0.2,0.2);
		toycar.position.set (pos.x, pos.y, pos.z);
		toycar.rotation.y = (angle+Math.PI/2);

		var relativeCameraOffset = new THREE.Vector3 (0,150,-250);

		var cameraOffset = relativeCameraOffset.applyMatrix4( toycar.matrixWorld );

		camera.position.x = cameraOffset.x;
		camera.position.y = cameraOffset.y;
		camera.position.z = cameraOffset.z;
		camera.lookAt( toycar.position );
	}

	requestAnimationFrame ( animate );
	update();
	render();
}

function myclamp(x,lo,hi)
{
	if (x < lo) return lo;
	if (x > hi) return hi;
	return x;
}

function update()
{
