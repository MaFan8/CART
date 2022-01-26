<?php
echo phpinfo();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Project Prototype2</title>

  <link rel="stylesheet" type="text/css" href="css/prototype2.css">
  <!-- scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="js/prototype2.js"></script>


</head>

<body>

  <canvas id="canvas" width="300" height="300"></canvas>
  <img class="kiwi" src="http://s.cdpn.io/3/kiwi.svg" />
  <svg class="circle" xmlns="http://www.w3.org/2000/svg">
    <circle cx="50" cy="50" r="50" />
  </svg>



  <div class="container">
      <!-- The Modal -->
      <div id="modalForm" class="modal">
          <div class="modal-content animate-top">
              <div class="modal-header">
                  <h5 class="modal-title">Contribution</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>

              <form id="contributeFrm">
              <div class="modal-body">
                  <!-- Form submission status -->
                  <div class="response"></div>

                  <!-- Contact form -->
                  <div class="form-group">
                      <label>Artist:</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name or alias." required="">
                  </div>
                  <div class="form-group">
                      <label>Email:</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="To update you on any breakthroughs." required="">
                  </div>
                  <div class="form-group">
                      <label>Your Work:</label>
                      <textarea name="message" id="message" class="form-control" placeholder="Show me your work!" rows="6"></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <!-- Submit button -->
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
          </div>
      </div>
  </div>






</body>

</html>