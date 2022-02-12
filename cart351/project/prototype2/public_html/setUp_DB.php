<?php
 require('openDB.php');

 try{
   // Create Table
   $theQuery = "CREATE TABLE Collection (
     entryID int NOT NULL,
     Timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
     artist TEXT,
     email TEXT,
     title TEXT,
     work TEXT,
     file TEXT,
     pieceID INTEGER PRIMARY KEY NOT NULL
   )";

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
