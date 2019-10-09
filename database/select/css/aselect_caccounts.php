<?php
/***********************************************
** shows all the customer accounts available  **
************************************************/
//include file to connect to the database
include_once '../../database/connectdb.php';
//include file to check errors in sql statements
include_once '../../database/error_check.php';
//prepare and bind sql statement
$stmt_a_caccounts = $conn->prepare("SELECT * FROM Customer_Accounts ORDER BY Last_Name");
//execute the statement
$stmt_a_caccounts->execute();
//store the result
$stmt_a_caccounts->store_result();
//bind the results
$stmt_a_caccounts->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);
//$path = "../../database/select/find_row/find_row_caccounts.php";
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
      echo "<td> <input type='checkbox' name='customer_idArr[]' value=" . $customer_idRow .">" . $customer_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . "</td>";
      echo "<td>" . $customer_passwordRow . "</td>";
      echo "<td>" . $customer_emailRow . "</td>";
      
?>
            <td>
              <a href='#' onclick='findCAccountRow("<?php echo $customer_idRow?>", "../../database/select/find_row/find_row_caccounts.php", "change/change_account.php"); return false;'>Edit</a>
            </td>
<?php
     
    echo "</tr>";
   }
   
   echo "</table>";
   
} else {
  echo "<h3 class='conclusion'>" . "There Are No Accounts Available" . "</h3>";
}
//close the statement
$stmt_a_caccounts->close();
?>
