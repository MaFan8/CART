<?php
require('openDB.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["onload"])) {

  try {

    // $sql_select='SELECT * FROM Collection';
    // $sql_select='SELECT * FROM Collection ORDER BY RANDOM() LIMIT 1';
    $sql_select='SELECT pieceID, entryID, artist, title, work, file FROM Collection ORDER BY RANDOM() LIMIT 1';

    // the result set
    $result = $file_db->query($sql_select);
    if (!$result) die("Cannot execute query.");
    // var_dump($result);

    // get a row...
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    var_dump($row["entryID"]);
    // echo(json_encode($row));
    }//end while

  } //end try

    catch(PDOException $e) {
      // Print PDOException message
      echo $e->getMessage();

    }
     exit;

} // GET


?>
