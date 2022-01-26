<?php
 require('openDB.php');

 try{
$theQuery = "CREATE TABLE Collection (pieceID INTEGER PRIMARY KEY NOT NULL, artist TEXT, title TEXT,geoLoc TEXT, creationDate TEXT,descript ,image TEXT)";
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
