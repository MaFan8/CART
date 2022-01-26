

<!DOCTYPE html>
<head>
<title> Output from the Grafitti Gallery Database </title>
<link rel='stylesheet' type='text/css' href='css/galleryStyle.css'>
</head>
<body>
<?php
// get the contents from the db and output. ..
try {
 require('openDB.php');

 // retrieving results examples: (**ALWAYS READ FROM RIGHT TO LEFT**)
 // $sql_select='SELECT * FROM Collection'; // from whole table
 // $sql_select='SELECT * FROM Collection WHERE pieceID = 1'; // from spec. ID
 // $sql_2="SELECT * FROM Collection WHERE creationDate >=Date('2002-01-01')";
 // $sql_2="SELECT * FROM Collection WHERE creationDate >=Date('2002-01-01') AND artist = 'Sarah'"; // AND
 // $sql_2="SELECT * FROM Collection WHERE geoLoc = 'Montreal' OR geoLoc = 'London'";
 // $sql_2="SELECT * FROM Collection WHERE (creationDate >=Date('2003-01-01') AND artist = 'Sarah')OR(creationDate <=Date('2000-01-01') AND artist = 'Stephen')";

  // $sql_selectA = "SELECT pieceID, title, creationDate FROM Collection";
  // $sql_selectA = "SELECT artist FROM Collection";
  // $sql_selectA = "SELECT DISTINCT artist FROM Collection"; // only unique artist names
  // $sql_selectA = "SELECT creationDate, artist FROM Collection WHERE artist = 'Harold' OR artist = 'Sarah'"; // only date + artist where its sarah/harold
  // $sql_selectA = "SELECT creationDate, artist FROM Collection WHERE artist = 'Harold' OR artist = 'Sarah' ORDER BY creationDate"; // ORDER BY

  // $sql_countA = "SELECT COUNT(*) FROM Collection";
  // $sql_countA = "SELECT COUNT(*) FROM Collection WHERE creationDate >=Date('2000-01-01')"; // combine WHERE with counting
  // $sql_countA = "SELECT artist, COUNT(*) FROM Collection GROUP BY artist"; // count GROUP BY artists
  // $sql_countA = "SELECT geoLoc, COUNT(*) FROM Collection GROUP BY geoLoc";
  // $sql_countA = "SELECT artist, geoLoc, COUNT(*) FROM Collection GROUP BY artist,geoLoc"; // give number where artist and location are the same
  $sql_countA = "SELECT artist, COUNT(*) FROM Collection WHERE artist ='Sarah' OR artist ='Harold' GROUP BY artist"; // **Read WHERE before GROUP BY**


 // the result set
 $result = $file_db->query($sql_countA);
 if (!$result) die("Cannot execute query.");

 // // fetch first row ONLY...
 //  $row = $result->fetch(PDO::FETCH_ASSOC);
 //  // '$result' = table, 'FETCH_ASSOC' = include field names
 //  var_dump($row);

 echo "<h3> Query Results:::</h3>";
 echo"<div id='back'>";
// get a row...
  // while i still have info in results set...unpack
  while($row = $result->fetch(PDO::FETCH_ASSOC))
{
   echo "<div class ='outer'>";
   echo "<div class ='content'>";
   // go through each column in this row
   // retrieve key entry pairs in array
   foreach ($row as $key=>$entry)
   {
     //if the column name is not 'image'
      if($key!="image")
      {
        // echo the key and entry
          echo "<p>".$key." :: ".$entry."</p>";
      }
   }

  // put image in last
    echo "</div>";
    // access by key
    // $imagePath = $row["image"];
    // echo "<img src = $imagePath \>";
    echo "</div>";
}//end while
echo"</div>";

}
catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }

?>
</body>
</html>
