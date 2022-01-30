// Ready function
$(document).ready(function() {

  let canvas = document.querySelector("canvas");

  window.addEventListener("resize", function() {
    canvas.setAttribute("width", window.innerWidth);
    canvas.setAttribute("height", window.innerHeight);
  });

// Keydown function
$(document).keydown(function(e) {
  let kiwi = $(".kiwi");
  let circle = $(".circle");
  let menu = $('#menu');
  let form = $('#modalForm');

  // Switch
  switch (e.which) {
    case 37: //left arrow key
      kiwi.finish().animate({
        left: "-=30"
      });
      break;
    case 38: //up arrow key
      kiwi.finish().animate({
        top: "-=30"
      });
      break;
    case 39: //right arrow key
      kiwi.finish().animate({
        left: "+=30"
      });
      break;
    case 40: //bottom arrow key
      kiwi.finish().animate({
        top: "+=30"
      });
      break;
  } // END switch

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
  if (kiwiXPos > (cirX - cirW / 2) && kiwiX < circleXPos && (kiwiY + kiwiH) > cirY && kiwiY < (cirY + cirH / 2)) {
    menu.css('display','flex');
  };
}); // END keydown function

  

  // when (x) is clicked, exit form
  let spanX = $(".close");

  spanX.on('click', function() {
    form.hide();
  });


// when outside of form clicked, exit form
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        form.hide();
    }
});

  $("#contributeFrm").submit(function(event) {
    // posting manually, PREVENT THE DEFAULT
    event.preventDefault();
    console.log("button clicked");

    let form = $('#contributeFrm')[0];
    let data = new FormData(form);

    // use AJAX method and post to server
    $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "../contributeForm.php",
            data: data,
            processData: false,//prevents from converting into a query string
            contentType: false, // want multi-form data
            cache: false,
            timeout: 600000,
            success: function (response) {
            //reponse is a STRING (not a JavaScript object -> so we need to convert)
            console.log("we had success!");
            console.log(response);

            //reset the form
            $('#contributeFrm')[0].hide();
           },

           error:function(){
          console.log("error occurred");

        }
    }); // END AJAX
  }); // END SUBMIT

  // validate and process form here
   function displayResponse(theResult){
     let container = $('<div>').addClass("outer");
     let title = $('<h3>');
     $(title).text("Results from user");
     $(title).appendTo(container);
     let contentContainer = $('<div>').addClass("content");
     for (let property in theResult) {
       console.log(property);
       if(property ==="filename"){
         let img = $("<img>");
         $(img).attr('src','images/'+theResult[property]);

         $(img).appendTo(contentContainer);
       }
       else{
         let para = $('<p>');
         $(para).text(property+"::" +theResult[property]);
           $(para).appendTo(contentContainer);
       }

     }
     $(contentContainer).appendTo(container);
     $(container).appendTo("#result");
   }

}); // END Ready
