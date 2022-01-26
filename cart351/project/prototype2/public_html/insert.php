<?php
 // require('openDB.php');

// MANUALLY INSERTING DATA
// $queryArray = array(
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Sarah', 'Hippos','2002-06-12','Montreal','Description for the arts')",
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Harold', 'Untitled', '2012-10-21','New York','Description for the arts')",
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Stephen', 'Scotland','1999-07-18','Edinborough','Description for the arts')",
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Martha', 'Tigers','2017-08-21','Paris','Description for the arts')",
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Sarah', 'WIndow','2005-06-13','Toronto','Description for the arts')",
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Sarah', 'Untitled', '2003-03-19','Halifax','Description for the arts')",
//      "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Stephen', 'Zoo','2000-05-06','London','Description for the arts')"
//    );
//
//    try {
//      // go through each entry in the array and execute the INSERT query statement....
//    for($i =0; $i< count($queryArray); $i++)
//    {
//       $file_db->exec($queryArray[$i]);
//
//    }
//    // if we reach this point then all the data has been inserted successfully.
//   echo ("INSERTION OF ENTRY into Collection Table successful <br>");
//    }
//
//    catch(PDOException $e) {
//       // Print PDOException message
//        echo $e->getMessage();
//      }



// FORM

//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
// need to process
 $artist = $_POST['a_name'];
 $title = $_POST['a_title'];
 $loc = $_POST['a_geo_loc'];
 $description = $_POST['a_descript'];
 $creationDate = $_POST['a_date'];
 if($_FILES)
  {
    //echo "file name: ".$_FILES['filename']['name'] . "<br />";
    //echo "path to file uploaded: ".$_FILES['filename']['tmp_name']. "<br />";
   $fname = $_FILES['filename']['name'];
   move_uploaded_file($_FILES['filename']['tmp_name'], "images/".$fname);
    //echo "done";
    //package the data and echo back...
    /* make  a new generic php object (note:: php also supports objects -
   but we are NOT doing that in this class - you can if you want ;)  )*/

   // ** still within POST method, open database
   require('openDB.php');

   try{
     // CLEAN DATA BEFORE INSERTING useing 'quote'
  /*The data from the text box is potentially unsafe; 'tainted'. Use the quote() - puts quotes around things..
     It escapes a string for use as a query parameter.
     This is common practice to avoid malicious sql injection attacks.
     PDO::quote() places quotes around the input string (if required)
     and escapes special characters within the input string, using a quoting style appropriate to the underlying driver. */

     $artist_es =$file_db->quote($artist);
     $title_es = $file_db->quote($title);
     $loc_es =$file_db->quote($loc);
     $description_es =$file_db->quote($description);
     $creationDate_es =$file_db->quote($creationDate);
     // the file name with correct path
     // $imageWithPath= "images/".$fname;
     $rnNum = rand(5,100);

     // build insert into statment
     $queryInsert ="INSERT INTO Collection(artist, title, creationDate, geoLoc, descript,ran_num)VALUES ($artist_es,$title_es,$loc_es,$description_es,$creationDate_es,'$rnNum')";
     // $queryInsert ="INSERT INTO Collection(artist, title, creationDate, geoLoc, descript,ran_num)VALUES ($artist_es,$title_es,$loc_es,$description_es,$creationDate_es,'$imageWithPath','$rnNum')";
     $file_db->exec($queryInsert);
     $file_db = null;
     echo("done");
     exit;
   }
   catch(PDOException $e) {
       // Print PDOException message
       echo $e->getMessage();
     }

    exit;

  }//FILES
}//POST
?>

<html>
<head>
<title>Sample Insert into Gallery Form USING JQUERY AND AJAX </title>
<!-- get JQUERY -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--set some style properties::: -->
<link rel="stylesheet" type="text/css" href="css/galleryStyle.css">
</head>
<body>
  <!-- NEW for the result -->
<div id = "result"></div>

<div class= "formContainer">
<!--form done using more current tags... -->
<form id="insertGallery" action="" enctype ="multipart/form-data">
<!-- group the related elements in a form -->
<h3> SUBMIT AN ART WORK :::</h3>
<fieldset>
<p><label>Artist:</label><input type="text" size="24" maxlength = "40" name = "a_name" required></p>
<p><label>Title:</label><input type = "text" size="24" maxlength = "40"  name = "a_title" required></p>
<p><label>Geographic Location:</label><input type = "text" size="24" maxlength = "40" name = "a_geo_loc" required></p>
<p><label>Creation Date (DD-MM-YYYY):</label><input type="date" name="a_date" required></p>
<p><label>Description:</label><textarea type = "text" rows="4" cols="50" name = "a_descript" required></textarea></p>
<p><label>Upload Image:</label> <input type ="file" name = 'filename' size=10 required/></p>
<p class = "sub"><input type = "submit" name = "submit" value = "submit my info" id ="buttonS" /></p>
 </fieldset>
</form>
</div>
<script>
$(document).ready (function(){
    $("#insertGallery").submit(function(event) {
       //stop submit the form, we will post it manually. PREVENT THE DEFAULT behaviour ...
      event.preventDefault();
     console.log("button clicked");
     let form = $('#insertGallery')[0];
     let data = new FormData(form);

     // use AJAX method to post to server
     $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "insert.php",
            data: data,
            processData: false,//prevents from converting into a query string
            contentType: false, // want multi-form data
            cache: false,
            timeout: 600000,
            success: function (response) {
            //reponse is a STRING (not a JavaScript object -> so we need to convert)
            console.log("we had success!");
            console.log(response);

            //use the JSON .parse function to convert the JSON string into a Javascript object
            // let parsedJSON = JSON.parse(response);
            // console.log(parsedJSON);
            // displayResponse(parsedJSON);

            //reset the form
            $('#insertGallery')[0].reset();
           },
           error:function(){
          console.log("error occurred");

        }
      });
   });

   // validate and process form here
    function displayResponse(theResult){
      let container = $('<div>').addClass("outer");
      let title = $('<h3>');
      $(title).text("Results from user");
      $(title).appendTo(container);
      let contentContainer = $('<div>').addClass("content");
      for (let property in theResult) {
        console.log(property);
        if(property ==="fileName"){
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
});
</script>
</body>
</html>
