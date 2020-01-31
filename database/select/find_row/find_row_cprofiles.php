<?php
/*****************************************************************
** find values of a specific row in the customer accounts table **
******************************************************************/

//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//include file to connect to the database
include_once '../../connectdb.php';

//include file to check errors in sql statements
include_once '../../error_check.php';


//prepare and bind sql statement
$stmt_find_cprofiles = $conn->prepare("SELECT Customer_Profile.Profile_Id, Customer_Accounts.First_name, Customer_Accounts.Last_name, Customer_Profile.Phone_No, Customer_Profile.Address, Customer_Profile.Email, Customer_Profile.Car_Year, Customer_Profile.Car_Make, Customer_Profile.Car_Model, Customer_Profile.Vin_No, Customer_Profile.License_Plate 
                                      FROM Customer_Profile
                                      LEFT JOIN Customer_Accounts ON Customer_Profile.Email=Customer_Accounts.Email
                                      WHERE Customer_Profile.Email=Customer_Accounts.Email AND Customer_Profile.Profile_Id=?");
$stmt_find_cprofiles->bind_param("i",$profile_find_id);

//get the customer id using AJAX
$profile_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_cprofiles->execute();

//store the result
$stmt_find_cprofiles->store_result();

//bind the results
$stmt_find_cprofiles->bind_result($profile_idRow, $customer_firstnameRow, $customer_lastnameRow, $phoneRow, $customer_addressRow, $customer_emailRow, $car_yearRow, $car_makeRow, $car_modelRow, $vin_noRow, $license_plateRow);




//store the values of the row into sessions
if ($stmt_find_cprofiles->num_rows > 0){

  while($stmt_find_cprofiles->fetch()){
    //store the values into sessions
    //profile id
    $_SESSION['profile_id'] = $profile_idRow;
    
    //firstname
    $_SESSION['customer_firstname'] = $customer_firstnameRow;
    
    //lastname
    $_SESSION['customer_lastname'] = $customer_lastnameRow;
 
    //customer phone number
    $_SESSION['customer_phone'] = $phoneRow;
    
    //customer address
    $_SESSION['customer_address'] = $customer_addressRow;
    
    //customer email
    $_SESSION['customer_email'] = $customer_emailRow;
    
    //car year
    $_SESSION['car_year'] = $car_yearRow;
    
    //car make
    $_SESSION['car_make'] = $car_makeRow;
    
    //car model
    $_SESSION['car_model'] = $car_modelRow;
    
    //vin number
    $_SESSION['vin_no'] = $vin_noRow;
    
    //license plate number
    $_SESSION['license_plate'] = $license_plateRow;
  
   }
} else {
  echo "<p>nothing</p>";
}

/*
echo "<p>c_id:" .  $_POST['profile_id'] . "</p>";
echo "<p>c_firstame:" .  $_SESSION['customer_firstname'] . "</p>";
echo "<p>c_lastname:" .  $_SESSION['customer_lastname'] . "</p>";
echo "<p>c_phone:" .  $_SESSION['customer_phone'] . "</p>";
echo "<p>c_address:" . $_SESSION['customer_address'] . "</p>";
echo "<p>c_email:" .  $_SESSION['customer_email'] . "</p>";
echo "<p>c_car make:" .  $_SESSION['car_year'] . "</p>";
echo "<p>c_car make:" .  $_SESSION['car_make'] . "</p>";
echo "<p>c_car model:" .  $_SESSION['car_model'] . "</p>";
echo "<p>c_vin no:" .  $_SESSION['vin_no'] . "</p>";
echo "<p>c_license plate:" .  $_SESSION['license_plate'] . "</p>";
*/


//close the statement
$stmt_find_cprofiles->close();
?>

<!--redirect page to the edit profile page-->
<script>redirect_page('profiles/change/change_profile.php'); </script>
