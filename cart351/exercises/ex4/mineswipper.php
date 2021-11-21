

<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["getAjaxOnLoad"]))
{
  // echo("here");
  // // get the data
  //  exit;
   $outArr =[];
   $theFile = fopen("files/cells.txt", "r") or die("Unable to open file!");

   while(!feof($theFile)) {
     //create an object to send back
      $str = fgets($theFile);
      $outArr[]=$str;
   }

   $myJSONObj = json_encode($outArr);
   echo $myJSONObj;
   fclose($theFile);
   exit;
 }

 //check if there has been something posted to the server to be processed
 if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $theFile = fopen("files/cells.txt", "a") or die("Unable to open file!");

   echo(json_encode($_POST['lengthOfVals']));
   $length = intval($_POST['lengthOfVals']);
   for ($i=0;$i<$length; $i++){
     fwrite($theFile,$_POST['e'.$i]."\n");
   }
   // fwrite($theFile, '{"END":"'.$_POST['lengthOfVals'].'"}'."\n");
   fclose($theFile);
   echo("done");
   exit;
 }


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MineSwipper</title>

  <!-- get JQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- SCRIPTS -->
  <link rel="stylesheet" href="css/main.css">

  <div class="intro">
  <h1>MineSwipper</h1>
  <img id="bomb_icon" src="images/bomb-solid.svg" alt="bomb">
  <h5>Plant this bomb.</h3>
</div>

  </head>
  <body>
    <div id="grid"></div>

    <!-- jQuery -->
    <script>
      $(document).ready(function() {
        console.log("doc loaded");

        $.ajax({
          url: "mineswipper.php",
          type: "get", // send with 'get' method
          data: {getAjaxOnLoad: "fread"},
          success: function(response) {
            //Do Something
            console.log("responded" +response);
            let ids = [];
            let revealedCells='';

            // get data
            let parsedJSON = JSON.parse(response);

            //double parse ... because double encoded ...
            for (let i = 0; i<parsedJSON.length; i++){
              let ps = JSON.parse(parsedJSON[i]);
              revealedCells = '#' + ps.id;
              //   if(revealedCells!=''){
              //     $('revealedCells').removeClass('hidden').addClass('revealed');
              //   }
              //   console.log(revealedCells);
              // } // end parsing file from server


            createGrid(ids);

          }

        }); // END ajax


      // run once when loaded
      function createGrid(ids) {
        // VARIABLES
        const NUM_ROWS =12;
        const NUM_COLS = 12;
        let $grid = $('#grid');
        let revealed = [];

        $grid.empty();

        for (let i = 0; i < NUM_ROWS; i++) {
          let $row = $('<div>').addClass('row');
          for(let j = 0; j < NUM_COLS; j++) {

            let $col = $('<div>').addClass('col hidden').attr('id', i*NUM_COLS+j);
            if (Math.random() < 0.05) {
              $col.addClass('bomb');
            } // add bombs
            $row.append($col);
          }
          $grid.append($row);
        }

        // // drag + drop bomb
        // $('#bomb_icon').draggable();
        // $grid.droppable({
        //   if (!$(this).hasClass('.bomb')) {
        //     over: function(event) {
        //       $(this).css('background', 'black');
        //     }
        //
        //    }
        //
        // });


        // click function
        $grid.on('click', '.col.hidden', function(){

          let $cell = $(this);

          if ($cell.hasClass('bomb')) {
            gameOver(false);
          } else {
            let id = event.target.id;
            // reveal cell
            $(event.target).removeClass('hidden').addClass('revealed');

            //put ids into revealed array
            revealed.push({'id':id});
            console.log(revealed);
            // post data
            postCell();
            // // show all bombs
            // let isGameOver = $('.col.hidden').length === $('.col.bomb').length
            // if (isGameOver) gameOver(true);
          }
        }); // END click function

        function postCell() {
          let formData = new FormData();

          for(let i =0; i< revealed.length; i++){
            formData.append(`e${i}`, JSON.stringify(revealed[i]));
          }
            formData.append('lengthOfVals',JSON.stringify(revealed.length));


            $.ajax({
              type: "POST",
              url: "mineswipper.php",
              processData: false,//prevents from converting into a query string
              contentType: "application/json; charset=utf-8",
              data: formData,
              contentType: false, //contentType is the type of data you're  sending,i.e.application/json; charset=utf-8
              cache: false,
              timeout: 600000,
              success: function (response) {
                //response is a STRING (not a JavaScript object -> so we need to convert)
                console.log("we had success!");
                revealed = [];
              },
              error:function(){
                console.log("error occurred");
              }
            });
        }// END postCell

      } // END createGrid

      // RESTART
      function restart() {
        createGrid(ids);
      } // END RESTART

      // GAMEOVER
      function gameOver(isWin) {
        let message = null;
        let icon = null;
        if (!isWin) {
          message = "YOU'RE DEAD!";
          icon = 'fa fa-bomb';
        }

        $('.col.bomb').append($('<i>').addClass(icon));

        setTimeout(function() {
          alert(message);
          restart();
        }, 500);
      } // END gameOver
    }); // END onload


    </script>
  </body>
</html>
