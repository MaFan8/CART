

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

  <!-- Menu Popup -->
  <section id="menu">
    <article id="contribute" class="animate-left">
      <h2 class="selectTitle">i'll bite!</h2>
      <li>shell out your work or idea</li>
      <li style="font-size:14px">pursue a creative interpretation</li>
      <li style="font-size:13px">concieve an art baby</li>
      <li style="font-size:12px">propose a collaboration</li>
      <li style="font-size:11px">perform a riff</li>
      <li style="font-size:10px">invent 'Beam me up' machine</li>
      <li style="font-size:8px">write a short story on the life and times of duck tape</li>
      <li style="font-size:6px">present a failed project</li>
    </article>
    <article id="play" class="animate-bottom">
      <h2 class="selectTitle">off I POP!!</h2>
      <p><br>leave me alone!</p>
      <p> I want to go back.</p>
    </article>
    <article id="exhibit" class="animate-right">
      <h2 class="selectTitle">show me something...</h2>
      <p><br><br><br>what's out there?</p>
    </article>
  </section>

  <!-- Form popup -->
  <section class="container">
      <!-- The Modal -->
      <div id="modalForm" class="modal">
          <div class="modal-content animate-top">
              <header class="modal-header">
                  <h5 class="modal-title">Contribution</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </header>

              <form id="contributeFrm">
              <div class="modal-body">
                  <!-- Form submission status -->
                  <div class="response"></div>

                  <!-- Contact form -->
                  <p class="form-group">
                      <label>Artist:</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name or alias." required="">
                  </p>

                  <p class="form-group">
                      <label>Email:</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="To update you." required="">
                  </p>

                  <p class="form-group">
                      <label>Title:</label>
                      <input type="text" name="title" id="title" class="form-control" placeholder="Name of your work.">
                  </p>

                  <p class="form-group">
                      <label>Your Work:</label>
                      <textarea name="workText" id="workText" class="form-control" placeholder="Show me your work!" rows="6"></textarea>
                  </p>

                  <p class="form-group">
                      <label>Upload Visual/Audio File:</label>
                      <input type="file" name="filename" id="file" class="form-control" size=10/>
                  </p>
              </div>

              <footer class="modal-footer">
                  <!-- Submit button -->
                  <button type="submit" class="btn btn-primary">Submit</button>
              </footer>
              </form>
          </div>
      </div>
  </section>

  <!-- Entry Popup -->
  <section id="entry">
    <article id="original">
      <!-- <header class="entryNum">entry</header> -->
    </article>

  </section>


</body>

</html>
