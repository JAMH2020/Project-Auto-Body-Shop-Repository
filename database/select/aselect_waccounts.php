<?php
/*********************************************
** shows all the worker accounts available  **
**********************************************/

function list_waccounts(){
  //include file to connect to the database
  include_once '../../database/connectdb.php';

  //include file to check errors in sql statements
  include_once '../../database/error_check.php';


  //prepare and bind sql statement
  $stmt_a_waccounts = $conn->prepare("SELECT * FROM Worker_Accounts");

  //execute the statement
  $stmt_a_waccounts->execute();

  //store the result
  $stmt_a_waccounts->store_result();

  //bind the results
  $stmt_a_waccounts->bind_result($worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $worker_passwordRow, $worker_emailRow);


  //print out the accounts that are available
  if ($stmt_a_waccounts->num_rows > 0){

    //prints out a table
    echo "<table class='table'>";
      echo "<tr>";
      
        echo "<th>Worker Id</th>";
        echo "<th>Name</th>";
        echo "<th>Password</th>";
        echo "<th>Email</th>";
        echo "<th></th>";
      
      echo "</tr>";

    while($stmt_a_waccounts->fetch()){
      echo "<tr>";
        echo "<td>" . $worker_idRow . "</td>";
        echo "<td>" . $worker_firstnameRow . " " . $worker_lastnameRow . "</td>";
        echo "<td>" . $worker_passwordRow . "</td>";
        echo "<td>" . $worker_emailRow . "</td>";
?>

              <td>
                <a href='#' onclick='findCAccountRow("<?php echo $worker_idRow?>", "../../database/select/find_row/find_row_waccounts.php", "change/change_account.php"); return false;'>Edit</a>
              </td>

<?php     
      echo "</tr>";
    }
  
    echo "</table>";
  
  } else {
    echo "<h3 class='conclusion'>" . "There are no accounts available" . "</h3>";
  }


  //close the statement
  $stmt_a_waccounts->close();
}





function get_waccounts_id($conn){
  //include file to connect to the database
  include_once '../../database/connectdb.php';

  //include file to check errors in sql statements
  include_once '../../database/error_check.php';
  
  
  
  //prepare and bind sql statement
  $stmt_a_waccounts = $conn->prepare("SELECT Worker_Id FROM Worker_Accounts WHERE Email = ?");
  $stmt_a_waccounts->bind_param("s", $worker_email);
  
  //worker email
  $worker_email = $_SESSION['worker_email'];
  

  //execute the statement
  $stmt_a_waccounts->execute();

  //store the result
  $stmt_a_waccounts->store_result();

  //bind the results
  $stmt_a_waccounts->bind_result($worker_idRow);
  
  
  //print out the accounts that are available
  if ($stmt_a_waccounts->num_rows > 0){
  
    while($stmt_a_waccounts->fetch()){
  
      //save the session for the changed id
      $worker_id = $worker_idRow;
    }
    
  } else {
    echo "<h1>NO EMAIL FOUND</h1>";
  }
  
  
  //close the statement
  $stmt_a_waccounts->close();
  
  
  //return value
  return $worker_id;
}
?>
