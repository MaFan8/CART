
<!DOCTYPE html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type='text/css' href='css/viewResults.css'>
</head>

<body>

  <?php
  try {
    require('openDB.php');


    $sql_select='SELECT * FROM Collection';

    // the result set
    $result = $file_db->query($sql_select);
    if (!$result) die("Cannot execute query.");
    var_dump($result);

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
         if($key!="file")
         {
           // echo the key and entry
             echo "<p>".$key." :: ".$entry."</p>";
         }
      }

     // put image in last
       echo "</div>";
       // access by key
       $imagePath = $row["file"];
       echo "<img src = $imagePath \>";
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
