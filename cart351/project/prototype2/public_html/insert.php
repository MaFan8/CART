<?php
 require('openDB.php');

$queryArray = array(
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Sarah', 'Hippos','2002-06-12','Montreal','Description for the arts')",
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Harold', 'Untitled', '2012-10-21','New York','Description for the arts')",
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Stephen', 'Scotland','1999-07-18','Edinborough','Description for the arts')",
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Martha', 'Tigers','2017-08-21','Paris','Description for the arts')",
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Sarah', 'WIndow','2005-06-13','Toronto','Description for the arts')",
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Sarah', 'Untitled', '2003-03-19','Halifax','Description for the arts')",
     "INSERT INTO Collection (artist, title, creationDate, geoLoc, descript) VALUES ('Stephen', 'Zoo','2000-05-06','London','Description for the arts')"
   );

   try {
     // go through each entry in the array and execute the INSERT query statement....
   for($i =0; $i< count($queryArray); $i++)
   {
      $file_db->exec($queryArray[$i]);

   }
   // if we reach this point then all the data has been inserted successfully.
  echo ("INSERTION OF ENTRY into Collection Table successful <br>");
   }

   catch(PDOException $e) {
      // Print PDOException message
       echo $e->getMessage();
     }

      ?>
