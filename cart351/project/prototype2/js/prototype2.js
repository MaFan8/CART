$(document).ready(function(){

  let canvas = document.querySelector("canvas");

  window.addEventListener("resize", function() {
    canvas.setAttribute("width", window.innerWidth);
    canvas.setAttribute("height", window.innerHeight);
  });

}); // end ready function


$(document).keydown(function(e) {
  switch(e.which) {
    case 37:    //left arrow key
        $(".kiwi").finish().animate({
            left: "-=50"
        });
        break;
    case 38:    //up arrow key
        $(".kiwi").finish().animate({
            top: "-=50"
        });
        break;
    case 39:    //right arrow key
        $(".kiwi").finish().animate({
            left: "+=50"
        });
        break;
    case 40:    //bottom arrow key
        $(".kiwi").finish().animate({
            top: "+=50"
        });
        break;
    }

}); // end keydown function

function getPositions(kiwi) {
  let $kiwi = $(kiwi);
  let pos = $kiwi.position();
  let width = $kiwi.width();
  let height = $kiwi.height();
  return [ [ pos.left, pos.left + width ], [ pos.top, pos.top + height ] ];
  console.log(pos);
}

function comparePositions(kiwi, circle) {
  let x1 = kiwi[0] < circle[0] ? kiwi : circle;
  let x2 = kiwi[0] < circle[0] ? circle : kiwi;
  return x1[1] > x2[0] || x1[0] === x2[0] ? true : false;
}

function checkCollisions(){
  let kiwi = $(".kiwi")[0];
  let pos = getPositions(kiwi);

  let pos2 = getPositions(this);
  let horizontalMatch = comparePositions(pos[0], pos2[0]);
  let verticalMatch = comparePositions(pos[1], pos2[1]);
  let match = horizontalMatch && verticalMatch;
  if (match) {
  console.log("touch")
};
}
