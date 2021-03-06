let clock = new THREE.Clock();
let scene, camera, renderer, cube, sphere;
let meshFloor;

let keyboard = {};
let viewer = {
  height: 2.5,
  speed: 0.2,
  turnSpeed: Math.PI * 0.02,
  angle: 0,
  pos: new THREE.Vector3(0, 0, 0)
};
let player;
let USE_WIREFRAME = true;

init();
animate();

function init() {

  let width = window.innerWidth;
  let height = window.innerHeight;

  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);

  camera.position.y = 160;
  camera.position.z = 500;

  camera.position.set(0, viewer.height, -8);
  camera.lookAt(new THREE.Vector3(0, 0, 0));

  renderer = new THREE.WebGLRenderer({
    antialias: true
  });
  renderer.setSize(width, height);
  document.body.appendChild(renderer.domElement)

  // create floor
  // meshFloor = new THREE.Mesh(
  //   new THREE.PlaneGeometry(10, 10, 10, 10),
  //   new THREE.MeshBasicMaterial({
  //     color: 0xb6c1db,
  //     wireframe: USE_WIREFRAME,
  //     transparent: true,
  //     opacity: 0.25
  //   })
  // );
  // meshFloor.rotation.x -= Math.PI / 2; // Rotate the floor 85 degrees
  // scene.add(meshFloor);

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
    new THREE.SphereGeometry(.5, 10, 8),
    new THREE.MeshBasicMaterial({
      color: 0x07374a,
    })
  );
  sphere.position.set(2, 1, -4);
  scene.add(sphere);

  renderer = new THREE.WebGLRenderer({
    antialias: true
  });
  renderer.setSize(width, height);
  document.body.appendChild(renderer.domElement);

  // udate canvas when resizing window
  // window.addEventListener('resize', function() {
  //   // let width = window.innerWidth;
  //   // let height = window.innerHeight;
  //   renderer.setSize(width, height);
  //   camera.aspect = width / height;
  //   camera.updateProjectionMatrix();
  // });


  let gridXZ = new THREE.GridHelper(100, 10);
  // gridXZ.setRGB( new THREE.Color("rgb(143,143,143)"), new THREE.Color("rgb(128,128,128)"));
  scene.add(gridXZ);

  let pointLight = new THREE.PointLight(0x0000ff);
  pointLight.position.set(0, 300, 200);
  scene.add(pointLight);

  let ambientLight = new THREE.AmbientLight(0x808080);
  scene.add(ambientLight);
} // END INIT


// ANIMATE
function animate() {

  delta = clock.getDelta();

  let dir = new THREE.Vector3(1, 0, 0);
  dir.multiplyScalar(delta * cube.speed); //dir *= dt*speed;
  dir.applyAxisAngle(new THREE.Vector3(0, 1, 0), viewer.angle);
  viewer.pos.add(dir); //pos = pos + dir;

  if (player != undefined) {
    player.scale.set(0.2, 0.2, 0.2);
    player.position.set(viewer.pos.x, viewer.pos.y, viewer.pos.z);
    player.rotation.y = (viewer.angle + Math.PI / 2);

    let relativeCameraOffset = new THREE.Vector3(0, 150, -250);

    let cameraOffset = relativeCameraOffset.applyMatrix4(player.matrixWorld);

    camera.position.x = cameraOffset.x;
    camera.position.y = cameraOffset.y;
    camera.position.z = cameraOffset.z;
    camera.lookAt(player.position);
  }

  requestAnimationFrame(animate);
  // update();
  render();
}

function myclamp(x, lo, hi) {
  if (x < lo) return lo;
  if (x > hi) return hi;
  return x;
}

function requestAnimationFrame(animate) {
  document.addEventListener("keydown", onDocumentKeyDown, false);
  let xSpeed = 0.0005;
  let ySpeed = 0.0005;

  function onDocumentKeyDown(event) {
    let keyCode = event.which;
    if (keyCode == 38) {
      // viewer.angle += 0.01;
          cube.position.z += ySpeed;

    } else if (keyCode == 40) {
      viewer.angle -= 0.01;
    } else if (keyCode == 39) {
      viewer.speed += 0.5;
    } else if (keyCode == 37) {
      viewer.speed -= 0.5;
    } else if (keyCode == 8) {
      viewer.pos.set(0, 0, 0);
    }
    viewer.speed = myclamp(viewer.speed, 0.0, 20.0);
  }
}

function render() {
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

// window.onload = init;
