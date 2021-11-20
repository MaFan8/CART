let scene, camera, renderer, cube, sphere;
let meshFloor;

let keyboard = {};
let player = {
  height: 2,
  speed: 0.2,
  turnSpeed: Math.PI * 0.02
};
let USE_WIREFRAME = true;

function init() {
  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(90, window.innerWidth / window.innerHeight, 0.1, 1000);

  // create floor
  meshFloor = new THREE.Mesh(
    new THREE.PlaneGeometry(10, 10, 10, 10),
    new THREE.MeshBasicMaterial({
      color: 0xb6c1db,
      wireframe: USE_WIREFRAME,
      transparent: true,
      opacity: 0.25
    })
  );
  meshFloor.rotation.x -= Math.PI / 2; // Rotate the floor 85 degrees
  scene.add(meshFloor);

  // create materials
  cube = new THREE.Mesh(
    new THREE.BoxGeometry(1, 1, 1),
    new THREE.MeshBasicMaterial({
      color: 0xff4444,
      wireframe: USE_WIREFRAME
    })
  );
  cube.position.y += 0.5; // Move the mesh up 1 meter
  scene.add(cube);

  sphere = new THREE.Mesh(
    new THREE.SphereGeometry( .5, 10, 8),
    new THREE.MeshBasicMaterial({
      color: 0x07374a,
    })
  );
  sphere.position.set(2,1,-4);
  scene.add(sphere);

  camera.position.set(0, player.height, -8);
  camera.lookAt(new THREE.Vector3(0, player.height, 0));

  renderer = new THREE.WebGLRenderer({
    antialias: true
  });
  renderer.setSize(window.innerWidth, window.innerHeight);
  document.body.appendChild(renderer.domElement);

  // udate canvas when resizing window
  window.addEventListener('resize', function() {
    let width = window.innerWidth;
    let height = window.innerHeight;
    renderer.setSize(width, height);
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
  });

  animate();
}

function animate() {
  requestAnimationFrame(animate);

  // mesh.rotation.x += 0.01;
  // mesh.rotation.y += 0.02;

  // // Keyboard movement inputs
  // if(keyboard[87]){ // W key
  // 	camera.position.x -= Math.sin(camera.rotation.y) * player.speed;
  // 	camera.position.z -= -Math.cos(camera.rotation.y) * player.speed;
  // }
  // if(keyboard[83]){ // S key
  // 	camera.position.x += Math.sin(camera.rotation.y) * player.speed;
  // 	camera.position.z += -Math.cos(camera.rotation.y) * player.speed;
  // }
  // if(keyboard[65]){ // A key
  // 	// Redirect motion by 90 degrees
  // 	camera.position.x += Math.sin(camera.rotation.y + Math.PI/2) * player.speed;
  // 	camera.position.z += -Math.cos(camera.rotation.y + Math.PI/2) * player.speed;
  // }
  // if(keyboard[68]){ // D key
  // 	camera.position.x += Math.sin(camera.rotation.y - Math.PI/2) * player.speed;
  // 	camera.position.z += -Math.cos(camera.rotation.y - Math.PI/2) * player.speed;
  // }
  //
  // // Keyboard turn inputs
  // if(keyboard[37]){ // left arrow key
  // 	camera.rotation.y -= player.turnSpeed;
  // }
  // if(keyboard[39]){ // right arrow key
  // 	camera.rotation.y += player.turnSpeed;
  // }

  let xSpeed = 0.0005;
  let ySpeed = 0.0005;

  document.addEventListener("keydown", onDocumentKeyDown, false);

  function onDocumentKeyDown(event) {
    var keyCode = event.which;
    if (keyCode == 38) {
      cube.position.z += ySpeed;
    } else if (keyCode == 40) {
      cube.position.z -= ySpeed;
    } else if (keyCode == 39) {
      cube.position.x -= xSpeed;
    } else if (keyCode == 37) {
      cube.position.x += xSpeed;
    } else if (keyCode == 8) {
      cube.position.set(0, 0, 0);
    }
  };


  renderer.render(scene, camera);
}

function keyDown(event) {
  keyboard[event.keyCode] = true;
}

function keyUp(event) {
  keyboard[event.keyCode] = false;
}

window.addEventListener('keydown', keyDown);
window.addEventListener('keyup', keyUp);

window.onload = init;
