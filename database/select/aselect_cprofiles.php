<?php
/***********************************************
** shows all the customer profiles available  **
************************************************/

//include file to connect to the database
include '../../database/connectdb.php';

//include file to check errors in sql statements
include '../../database/error_check.php';


//prepare and bind sql statement
$stmt_a_cprofiles = $conn->prepare("SELECT Customer_Profile.Profile_Id, Customer_Accounts.First_name, Customer_Accounts.Last_name, Customer_Profile.Phone_No, Customer_Profile.Address, Customer_Profile.Email, Customer_Profile.Car_Year, Customer_Profile.Car_Make, Customer_Profile.Car_Model, Customer_Profile.Vin_No, Customer_Profile.License_Plate 
                                    FROM Customer_Profile
                                    LEFT JOIN Customer_Accounts ON Customer_Profile.Email=Customer_Accounts.Email
                                    WHERE Customer_Profile.Email=Customer_Accounts.Email");


//execute the statement
$stmt_a_cprofiles->execute();


//store the result
$stmt_a_cprofiles->store_result();


//bind the results
$stmt_a_cprofiles->bind_result($profile_idRow,$customer_firstnameRow ,$customer_lastnameRow,$customer_phoneRow, $customer_addressRow, $customer_emailRow, $car_yearRow, $car_makeRow, $car_modelRow, $vin_noRow, $license_plateRow);

//print out the accounts that are available
if ($stmt_a_cprofiles->num_rows > 0){

  //prints out a table
  echo "<table class='table'>";
    echo "<tr>";

      echo "<th>Customer Profile Id</th>";
      echo "<th>Name</th>";
      echo "<th>Phone Number</th>";
      echo "<th>Address</th>";
      echo "<th>Email</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>Vin Number</th>";
      echo "<th>License Plate</th>";
      echo "<th></th>";
    echo "</tr>";

  while($stmt_a_cprofiles->fetch()){

     echo "<tr>";
      echo "<td>" . $profile_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . "</td>";
      echo "<td>" . $customer_phoneRow . "</td>";
      echo "<td>" . $customer_addressRow . "</td>";
      echo "<td>" . $customer_emailRow . "</td>";
      echo "<td>" . $car_yearRow . "</td>";
      echo "<td>" . $car_makeRow . "</td>";
      echo "<td>" . $car_modelRow . "</td>";
      echo "<td>" . $vin_noRow . "</td>";
      echo "<td>" . $license_plateRow . "</td>";
?>

            <td>
              <a href='#' onclick='findCAccountRow("<?php echo $profile_idRow?>", "../../database/select/find_row/find_row_cprofiles.php", "change/change_profile.php"); return false;'>Edit</a>
            </td>

<?php
    echo "</tr>";
   }
   echo "</table>";
   
} else {
  echo "<h3 class='conclusion'>" . "There are no orders available" . "</h3>";
}


//close the statement
$stmt_a_cprofiles->close();
