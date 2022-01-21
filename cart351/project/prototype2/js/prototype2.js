$(document).ready(function(){

  let canvas = document.querySelector("canvas");

  window.addEventListener("resize", function() {
    canvas.setAttribute("width", window.innerWidth);
    canvas.setAttribute("height", window.innerHeight);
  });

}); // end ready function




$(document).keydown(function(e) {
  let kiwi = $(".kiwi");
  let circle = $(".circle");


  switch(e.which) {
    case 37:    //left arrow key
        kiwi.finish().animate({
            left: "-=50"
        });
        break;
    case 38:    //up arrow key
        kiwi.finish().animate({
            top: "-=50"
        });
        break;
    case 39:    //right arrow key
        kiwi.finish().animate({
            left: "+=50"
        });
        break;
    case 40:    //bottom arrow key
        kiwi.finish().animate({
            top: "+=50"
        });
        break;
    }

    // get kiwi + circle posiitons
    let kiwiX = kiwi.offset().left;
    let kiwiY = kiwi.offset().top;
    let kiwiW = kiwi.outerWidth(true);
    let kiwiH = kiwi.outerHeight(true);
    let kiwiYPos = kiwiY + kiwiH;
    let kiwiXPos = kiwiX + kiwiW;

    let cirX = circle.offset().left;
    let cirY = circle.offset().top;
    let cirW = circle.outerWidth(true);
    let cirH = circle.outerHeight(true);
    let circleYPos = cirY + cirH;
    let circleXPos = cirX + cirW;

    // check collision
    if (kiwiYPos < cirY || kiwiY > circleYPos || kiwiXPos < cirX || kiwiX > circleXPos) {
    console.log("touched")
    };
}); // end keydown function

// function collision(kiwi,circle) {
//   let kiwiX = kiwi.offset().left;
//   let kiwiY = kiwi.offset().top;
//   let kiwiW = kiwi.outerWidth(true);
//   let kiwiH = kiwi.outerHeight(true);
//   let kiwiYPos = kiwiY + kiwiH;
//   let kiwiXPos = kiwiX + kiwiW;
//
//   let cirX = circle.offset().left;
//   let cirY = circle.offset().top;
//   let cirW = circle.outerWidth(true);
//   let cirH = circle.outerHeight(true);
//   let circleYPos = cirY + cirH;
//   let circleXPos = cirX + cirW;
//
//   if (kiwiYPos < cirY || kiwiY > circleYPos || kiwiXPos < cirX || kiwiX > circleXPos) {
//   console.lot("touched")
// };
// }
