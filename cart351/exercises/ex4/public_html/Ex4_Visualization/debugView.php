<?php
require('dbScripts/openDB.php');
require('helperArrays.php');
try {

$myStr="SELECT * FROM dataStuff";
$myStrTwo="SELECT day,weather, COUNT(*) FROM dataStuff GROUP BY day";
$myStrThree="SELECT * FROM dataStuff WHERE after_mood IN ('happy','neutral','calm','serene','well')";
$myStrFour="SELECT * FROM dataStuff GROUP BY eID";

$result = $file_db->query($myStrFour);

if (!$result) die("Cannot execute query.");
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
  var_dump($row);

foreach ($row as $key=>$entry)
{

 echo "<p>".$key." :: ".$entry."</p>";
}

}//end while


}

catch(PDOException $e) {
  // Print PDOException message
  echo $e->getMessage();

}
exit;
  ?>
