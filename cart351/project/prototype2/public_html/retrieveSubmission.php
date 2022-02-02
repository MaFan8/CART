<?php
require('openDB.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["onload"])) {

  try {

    // $sql_select='SELECT * FROM Collection';
    // $sql_select='SELECT * FROM Collection ORDER BY RANDOM() LIMIT 1';
    $sql_select='SELECT pieceID, artist, title, work, file FROM Collection ORDER BY RANDOM() LIMIT 1';

    // the result set
    $result = $file_db->query($sql_select);
    if (!$result) die("Cannot execute query.");
    // var_dump($result);

    // // get a row...
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // var_dump($row);

    // case 1
      foreach ($row as $key=>$entry)
      {
        // echo strval($entry);

        // if the column name is not 'image'
         if($key!="file")
         {
           // echo the key and entry
             echo "<br>".$key." :: ".$entry."</br>";
         }
      }
      // put image in last
        echo "</div>";
        // access by key
        $imagePath = $row["file"];
        echo "<img src = $imagePath \>";
        echo "</div>";

    // // case 2
    //   if ($key!="file") {
    //
    //   $entryPath = $row['pieceID'];
    //   $entryArtist = $row['artist'];
    //   $entryTitle = $row['title'];
    //   $entryWork = $row['work'];
    //   $entryFile = $row['file'];
    //
    //   echo ($entryPath);
    //   echo "<br>title: $entryTitle</br>";
    //   echo "<br>by: $entryArtist</br>";
    //   echo "<br>work: $entryWork</br>";
    //   echo "<br>$entryFile</br>";
    // }

    }//end while

    // // case 3
    // $res = array();
    // $i=0;
    // // // get a row...
    // while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    //   $res[$i] = $row;
    //   $i++;
    //   var_dump ($res);
    // }




  } //end try

    catch(PDOException $e) {
      // Print PDOException message
      echo $e->getMessage();

    }
     exit;

} // GET


?>
