<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // var_dump($_POST);// ouput arrays
  // echo($_POST["email"]);



  // need to process
   // $entryID = $_POST['entryID'];

   $artist = $_POST['name'];
   $email = $_POST['email'];
   $title = $_POST['title'];
   $workText = $_POST['workText'];

   if($_FILES)
    {
     $fname = $_FILES['filename']['name'];
     move_uploaded_file($_FILES['filename']['tmp_name'], "images/".$fname);
      //echo "done";
      //package the data and echo back...
      /* make  a new generic php object (note:: php also supports objects -
     but we are NOT doing that in this class - you can if you want ;)  )*/

     // open database
     require('openDB.php');

     try {
       // $entryID = uniqid([ string $prefix = "" [, bool $more_entropy = FALSE ]] );
       
       // clean data first
       $entryID_es =$file_db->quote($entryID);

       $artist_es =$file_db->quote($artist);
       $email_es =$file_db->quote($email);
       $title_es = $file_db->quote($title);
       $workText_es =$file_db->quote($workText);
       $imageWithPath= "images/".$fname;

       // build insert into statment
       $queryInsert ="INSERT INTO Collection(artist, email, title, work, file)VALUES ($artist_es, $email_es, $title_es,$workText_es, '$imageWithPath')";

       // function generate_uniqueID($entryID =8) {
       //   return substr(str_shuffle("0123456789"), 0, $entryID);
       // }



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
