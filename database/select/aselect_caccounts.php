<?php
/***********************************************
** shows all the customer accounts available  **
************************************************/

//list the customer's accounts
function list_caccounts(){
  //include file to connect to the database
  include_once '../../database/connectdb.php';

  //include file to check errors in sql statements
  include_once '../../database/error_check.php';


  //prepare and bind sql statement
  $stmt_a_caccounts = $conn->prepare("SELECT * FROM Customer_Accounts WHERE Password != '-' ORDER BY Last_Name");

  //execute the statement
  $stmt_a_caccounts->execute();

  //store the result
  $stmt_a_caccounts->store_result();

  //bind the results
  $stmt_a_caccounts->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);

  //print out the accounts that are available
  if ($stmt_a_caccounts->num_rows > 0){

    //prints out a table
    echo "<table class='table'>";
      echo "<tr>";
      
        echo "<th>Customer Id</th>";
        echo "<th>Name</th>";
        echo "<th>Password</th>";
        echo "<th>Email</th>";
        echo "<th></th>";
      
      echo "</tr>";

    while($stmt_a_caccounts->fetch()){
     echo "<tr>";
        echo "<td>" . $customer_idRow . "</td>";
        echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . "</td>";
        echo "<td>" . $customer_passwordRow . "</td>";
        echo "<td>" . $customer_emailRow . "</td>";
      
?>
              <td>
                <a href='#' onclick='findCAccountRow("<?php echo $customer_idRow?>", "../../database/select/find_row/find_row_caccounts.php", "accounts/change/change_account.php"); return false;'>Edit</a>
              </td>
<?php
     
      echo "</tr>";
     }
   
     echo "</table>";
   
  } else {
    echo "<h3 class='conclusion'>" . "There are no accounts available" . "</h3>";
  }



  //close the statement
  $stmt_a_caccounts->close();

}






// get the customer's id using their email
function get_caccounts_id($conn){

  //include file to connect to the database
  include_once '../../database/connectdb.php';

  //include file to check errors in sql statements
  include_once '../../database/error_check.php';


  //prepare and bind sql statement
  $stmt_a_caccounts = $conn->prepare("SELECT Customer_Id FROM Customer_Accounts WHERE Email = ?");
  $stmt_a_caccounts->bind_param("s", $customer_email);
  
  
  //customer_email
  $customer_email = $_SESSION['customer_email'];
  

  //execute the statement
  $stmt_a_caccounts->execute();

  //store the result
  $stmt_a_caccounts->store_result();

  //bind the results
  $stmt_a_caccounts->bind_result($customer_idRow);

  if ($stmt_a_caccounts->num_rows > 0){
  
    while($stmt_a_caccounts->fetch()){
    
      //get the customer id
      $customer_id = $customer_idRow;
      echo "customer_id: " . $customer_id;
    
    }
  } 
  
  
  
  
  //return the customer id
  return $customer_id;
}
?>
