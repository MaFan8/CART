<?php
require('openDB.php');

if ($SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["onload"])) {

  try {
    $sql_select='SELECT * FROM Collection';
    // $sql_select='SELECT row FROM Collection ORDER BY RAND() LIMIT 1';

    // var_dump($_GET)["onload"];
    // echo($_POST["row"]);
    // // the result set
    $result = $file_db->query($sql_select);
    if (!$result) die("Cannot execute query.");


    // // get a rows
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<div id='article'>";
    } // end while



  } //end try
    catch(PDOException $e) {
      // Print PDOException message
      echo $e->getMessage();

    }
     exit;

} // GET


?>
