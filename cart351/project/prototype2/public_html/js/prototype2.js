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
      menu.css('display', 'flex');
    };
  }); // END keydown function

  let menu = $('#menu');
  let contribute = $('#contribute');
  let play = $('#play');
  let exhibit = $('#exhibit');
  let showEntry = $('#entry');
  let form = $('#modalForm');
  let spanX = $(".close");

  // when <contribute> is clicked, open form
  contribute.click(function() {
    form.show();
    menu.toggle();
  });
  // when <play> is clicked, toggle
  play.click(function() {
    menu.toggle();
  });
  // when <exhitib> is clicked, open random input in collection
  exhibit.click(function() {
    showEntry.css('display', 'flex');
    menu.toggle();
  });

  // when (x) is clicked, exit form
  spanX.on('click', function() {
    form.hide();
  });

  // when contribute button is clicked, append form beside original entry
  $(".btnAdd").on('click', function() {
    form.css('position', 'static');
    showEntry.append(form.show());
  });


  // when outside of form clicked, exit form
  $('body').bind('click', function(e) {
    if ($(e.target).hasClass("modal")) {
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
      processData: false, //prevents from converting into a query string
      contentType: false, // want multi-form data
      cache: false,
      timeout: 600000,
      success: function(response) {
        //reponse is a STRING (not a JavaScript object -> so we need to convert)
        console.log("we had success!");
        console.log(response);

        //reset the form + close
        $('#contributeFrm')[0].reset();
        $('#modalForm').toggle();
      },

      error: function() {
        console.log("error occurred");

      }
    }); // END AJAX
  }); // END SUBMIT

  // Get entries from database to display
  $.get("../retrieveSubmission.php", {
    "onload": "row"
  }, function(response) {
    let jsResult = JSON.parse(response);
    console.log(jsResult);

    // let entryID = jsResult['entryID'];
    //
    // $.each(jsResult, function(index, val) {
    //   console.log(id);
    // });
    // for (let i=0; i<jsResult.length;i++) {
    //   console.log(pieceID);
    //
    //   });


    // displayOriginalEntry(jsResult);

  }); // END GET

  function displayOriginalEntry(jsResult) {
    let keyID = jsResult['pieceID'];
    let keyName = jsResult['artist'];
    let keyTitle = jsResult['title'];
    let keyWork = jsResult['work'];
    let keyFile = jsResult['file'];

    let id = $('<p>');
    let title = $('<p>');
    let name = $('<p>');
    let text = $('<p>');

    if (keyTitle === "" || keyWork === "") {
      $(id).addClass("idNum").append("entry #" + keyID);
      $(title).addClass("entryTitle").css('color', 'grey').append("- - - - - -");
    } else {
      $(id).addClass("idNum").append("entry #" + keyID);
      $(title).addClass("entryTitle").append(keyTitle);
      $(name).addClass("entryName").append("by_  " + keyName);
      $(text).addClass("entryText").append(keyWork);
    }
    $(id).appendTo("#original");
    $(title).appendTo("#original");
    $(name).appendTo("#original");
    $(text).appendTo("#original");

    let img = $("<img>");
    if (keyFile != "images/") {
      $(img).addClass("entryFile").attr('src', keyFile);
      $(img).appendTo("#original");
    }


  } // END function displayOriginalEntry






}); // END Ready
