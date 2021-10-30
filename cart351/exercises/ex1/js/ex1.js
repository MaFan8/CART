/**
References
Franks laboratory: https://www.youtube.com/watch?v=0v4_Dw0K8pw&list=PLYElE_rzEw_siuo-kkHh5h7Sk--6IPYNh&index=5
-July 16, 2021
*/

window.onload = function() {
  // get the canvas
  let canvas = document.getElementById("testCanvas");
  //a
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  //get the context
  let context = canvas.getContext("2d");


let ballArray = [];
const NUM_BALL = 10;

class Ball {
  constructor(x, y) {
    // this.x = x;
    // this.y = y;
    this.x = (Math.random() *canvas.width);
    this.y = (Math.random() *canvas.height);
    this.speedX = (Math.random() * 4) - 2; // random btw -2 & +2
    this.speedY = (Math.random() * 4) - 2; //  object come out in all directions
    this.maxSize = (Math.random() * 7) + 5;
    this.size = (Math.random() * 1) + 2;
    this.velSize = (Math.random() * 0.5) + 0.02; // random size change
    this.angleX = (Math.random() * 5);
    this.velAngleX = (Math.random() * 0.5) - 0.2; // random angle change
    this.angleY = (Math.random() * 5);
    this.velAngleY = (Math.random() * 0.5) - 0.2; // random angle change

    // this.fillColor = 'rgba(255,255,255,1)';
    this.fillColor = `rgba(
    ${Math.floor(Math.random()*200)},
    ${Math.floor(Math.random()*150)},
    ${Math.floor(Math.random()*150)},
    ${Math.floor(Math.random()*50)}
  )`;

    this.localCanvasContext = context;
  }

  update() {
    this.x += this.speedX + Math.cos(this.angleX); // +values moves to right, -values to left
    this.y += this.speedY + Math.cos(this.angleY); // +values moves down, -values mores up
    this.size += this.velSize;
    this.angleX += this.velAngleX;
    this.angleY += this.velAngleY;

    // new object as long as size is less than maxSize
    if (this.size < this.maxSize) {
      this.localCanvasContext.beginPath();
      this.localCanvasContext.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      this.localCanvasContext.fillStyle = this.fillColor;
      this.localCanvasContext.fill();
      this.localCanvasContext.stroke = this.fillColor;
      // remind what 'this' is refering to
      requestAnimationFrame(this.update.bind(this));
      this.localCanvasContext.closePath();
    }
  }

}

// detect when mouse is moving
window.addEventListener('mousemove', function(event) {
  let ball = new Ball(event.x, event.y);
  ball.update();
});

// redrwas black canvas at click
window.addEventListener('click', function() {
  context.clearRect(0,0,canvas.width,canvas.height);
});


// for (let i=0, i<NUM_BALL; i++) {
//   ballArray.push (new Ball ((Math.random()* canvas.width), (Math.random()* 20)+5, context));
// }


// resize event that resents objects
window.addEventListener('resize', function() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
});

}
