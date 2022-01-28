<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // var_dump($_POST);// ouput arrays
  // echo($_POST["email"]);

  // need to process
   $artist = $_POST['name'];
   $email = $_POST['email'];
   $title = $_POST['title'];
   // $loc = $_POST['a_geo_loc'];
   $workText = $_POST['workText'];

   if($_FILES)
    {
      // echo "file name: ".$_FILES['filename']['name'] . "<br />";
      // echo "path to file uploaded: ".$_FILES['filename']['tmp_name']. "<br />";
     $fname = $_FILES['filename']['name'];
     move_uploaded_file($_FILES['filename']['tmp_name'], "images/".$fname);
      //echo "done";
      //package the data and echo back...
      /* make  a new generic php object (note:: php also supports objects -
     but we are NOT doing that in this class - you can if you want ;)  )*/

     // open database
     require('openDB.php');

     try {

       // clean data first
       $artist_es =$file_db->quote($artist);
       $email_es =$file_db->quote($email);
       $title_es = $file_db->quote($title);
       $workText_es =$file_db->quote($workText);
       $imageWithPath= "images/".$fname;
       // $fname_es =$file_db->quote($file);

       // build insert into statment
       $queryInsert ="INSERT INTO Collection(artist, email, title, work, file)VALUES ($artist_es, $email_es, $title_es,$workText_es, '$imageWithPath')";
       // $queryInsert ="INSERT INTO Collection(artist, title, creationDate, geoLoc, descript,ran_num)VALUES ($artist_es,$title_es,$loc_es,$description_es,$creationDate_es,'$rnNum')";

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
    } // END FILES
  }//POST

 ?>
