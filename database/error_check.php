<?php
/****************************************************************
** check for any errors when manipulating data in the database **
** when using mysqli prepare statements                        **
*****************************************************************/

//function to check if data selected can be inserted to the database

function insertData($stmt){

  //check if the data can be inserted to the database
  if ($stmt->execute() == false) {
    echo 'Query failed: ' . $GLOBALS['conn']->error;
  }
}

?>
