<?php
require('openDB.php');

try
{
  // *** ALTER table state
  $ran_num = rand(5,100); // generating random # btw 5-100
    //echo($ran_num);
    // add a new column + default value where we use the php variable
    $sql_alter = "ALTER TABLE Collection ADD COLUMN ran_num INTEGER NOT NULL DEFAULT '$ran_num'";
    // ADD COLUMN - name, defult value of <'$ran_num'> ** SINGLE QUOTES!!

    $file_db ->exec($sql_alter);
    // exec = changin, query = asking
    echo ("ALTERATION OF entry in Collection successful");


 }
  catch(PDOException $e) {
     // Print PDOException message
      echo $e->getMessage();
    }
?>
