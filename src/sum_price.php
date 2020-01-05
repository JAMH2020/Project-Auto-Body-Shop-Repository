<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//request the input typed values
$session = $_REQUEST["session"];
$p1 = $_REQUEST["p1"];
$p2 = $_REQUEST["p2"];
$p3 = $_REQUEST["p3"];
$p4 = $_REQUEST["p4"];


//if the esimate total cost does not exist yet
if ($_SESSION["$session"] == "" || !isset($_SESSION["$session"])){
  $_SESSION["$session"] = 0;
}


//add the values to the total
if (isset($p1)){
  if (!is_numeric($p1)){
    $p1 = 0;
  }
} 

if (isset($p2)){
  if (!is_numeric($p2)){
    $p2 = 0;
  }
} 


if (isset($p3)){
  if (!is_numeric($p3)){
    $p3 = 0;
  }
} 

if (isset($p4)){
  if (!is_numeric($p4)){
    $p4 = 0;
  }
} 


//add all the values up
$_SESSION["$session"] = $p1 + $p2 + $p3 + $p4;


echo $_SESSION["$session"]; 

?>
