<?php
require('openDB.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["onload"])) {

  try {

    // $sql_select='SELECT * FROM Collection';
    // $sql_select='SELECT * FROM Collection ORDER BY RANDOM() LIMIT 1';
    // $sql_select='SELECT pieceID, entryID, artist, title, work, file FROM Collection ORDER BY RANDOM() LIMIT 1';

    // select a random row with entryID
    $uniqueEntryQuery = 'SELECT DISTINCT entryID FROM Collection ORDER BY RANDOM() LIMIT 1';

    // the result set
    $resEntry = $file_db->query($uniqueEntryQuery);
    if (!$resEntry) die("Cannot execute query.");
    // var_dump($resEntry);

    $row = $resEntry->fetch(PDO::FETCH_ASSOC);
    $chosenEntryId = $row['entryID'];
    // echo($chosenEntryId);
    //select where entryID is the same
    $entriesWithId = "SELECT pieceID, artist, title, work, file FROM Collection WHERE entryID = '$chosenEntryId'";

    $resTwo = $file_db->query($entriesWithId);
    if (!$resTwo) die("Cannot execute query.");

   // get a row...
     // while i still have info in results set...unpack
     while($row = $resTwo->fetch(PDO::FETCH_ASSOC)) {
       // var_dump($row);
       echo(json_encode($row));

  }


  } //end try

    catch(PDOException $e) {
      // Print PDOException message
      echo $e->getMessage();

    }
     exit;

} // GET


?>
