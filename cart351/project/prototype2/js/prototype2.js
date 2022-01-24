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
  let form = $('#modalForm');


  switch(e.which) {
    case 37:    //left arrow key
        kiwi.finish().animate({
            left: "-=30"
        });
        break;
    case 38:    //up arrow key
        kiwi.finish().animate({
            top: "-=30"
        });
        break;
    case 39:    //right arrow key
        kiwi.finish().animate({
            left: "+=30"
        });
        break;
    case 40:    //bottom arrow key
        kiwi.finish().animate({
            top: "+=30"
        });
        break;
    }

    // get kiwi + circle posiitons
    let kiwiX = kiwi.offset().left;
    let kiwiY = kiwi.offset().top;
    let kiwiW = kiwi.outerWidth(true);
    let kiwiH = kiwi.outerHeight(true);
    // let kiwiYPos = kiwiY + kiwiH;
    let kiwiXPos = kiwiX + kiwiW;

    let cirX = circle.offset().left;
    let cirY = circle.offset().top;
    let cirW = circle.outerWidth(true);
    let cirH = circle.outerHeight(true);
    // let circleYPos = cirY + cirH;
    let circleXPos = cirX + cirW;

    // console.log(cirY);
    // console.log("kiwi");

    // check collision
    if (kiwiXPos > (cirX-cirW/2) && kiwiX < circleXPos && (kiwiY+kiwiH) > cirY && kiwiY < (cirY+cirH/2)) {
    form.show();
    };
}); // end keydown function

// when (x) is clicked, exit form
let form = $('#modalForm');
let spanX = $(".exit");
$(document).ready(function() {
  spanX.on('click', function(){
    form.hide();
  });
});

// // when outside of form clicked, exit form
// $('body').bind('click', function(e){
//     if($(e.target).hasClass("modal")){
//         form.hide();
//     }
// });
