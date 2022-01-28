<?php
 require('openDB.php');

 try{
   // Create Table
   $theQuery = "CREATE TABLE Collection (pieceID INTEGER PRIMARY KEY NOT NULL, artist TEXT, email TEXT, title TEXT, work TEXT)";
   // INTEGER PRIMARY KEY NOT NULL = pieceID has to be unique
   $file_db ->exec($theQuery); //'exec' when we are changing database
   // file_db = database object -> execute the table
   echo ("Collection table created successfully<br>");
   $file_db = null; // simulating closing database
   }
   catch(PDOException $e) {
       // Print PDOException message
       echo $e->getMessage();
     }

?>
