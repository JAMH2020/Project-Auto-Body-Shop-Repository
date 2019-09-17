<?php
/****************************************
** Insert user data into the database  **
*****************************************/

//function to check if data selected can be inserted to the database
function insertData($sql_sequence){
  //check if the data can be inserted to the database
  if ($GLOBALS['conn']->query($sql_sequence) === TRUE) {
    echo "inserted succesfully";
  } else {
    echo "Error: " . $sql_sequence . "<br>" . $GLOBALS['conn']->error;
  }
}



//connect to the database
include 'connectdb.php';

//if the user pressed the sign up button from the sign-up page
if(isset($_POST['sign_up'])){
  //customer's firstname
  $customer_firstname = $_POST['customer_firstname'];

  //customer's lastname
  $customer_lastname = $_POST['customer_lastname'];

  //customer's password
  $customer_password = $_POST['customer_password'];

  //customer's email
  $customer_email = $_POST['customer_email'];


  //insert the data into the customer_account table in the database
  $sql = "INSERT INTO Accounts (First_Name, Last_Name, Password, Email)
  VALUES ('$customer_firstname', '$customer_lastname', '$customer_password', '$customer_email')";

 
  //try catch to insert data into the database
  insertData($sql);


//if the user pressed the submit button in the intake repair form
} else if(isset($_POST['submit_intake'])){
  //school name
  $school_name = $_POST['school_name'];
 
  //school address
  $school_address = $_POST['school_address'];

  //client's car repair information
  //year of car
  $car_year = $_POST['car_year'];

  //brand of the vehicle and the model
  $car_make = $_POST['car_make'];
 
  //model of the vehicle
  $car_model = $_POST['car_model'];

  //client's VIN number
  $vin_no = $_POST['vin_no'];

  //license plate number
  $license_plate = $_POST['license_plate'];

  //odometer reading at intake
  $odometer_intake = $_POST['odometer_intake'];

  //description of the work that is going to be done
  $plan_description = $_POST['plan_description'];

  //date work is going to be performed
  $plan_date = $_POST['plan_date'];




  //Estimate costings of repair
  //price of parts per unit
  $estimate_parts_per_unit = $_POST['estimate_parts_per_unit'];

  //total price of parts
  $estimate_parts_total = $_POST['estimate_parts_total'];

  //price of labour per unit
  $estimate_labour_per_unit = $_POST['estimate_labour_per_unit'];

  //total price of labour
  $estimate_labour_total = $_POST['estimate_labour_total'];

  //price of shop supplies per unit
  $estimate_supplies_per_unit = $_POST['estimate_supplies_per_unit'];  

  //total prcie of shop supplies
 $estimate_supplies_total = $_POST['estimate_supplies_total'];

  //price of recycling/disposal fee per unit
  $estimate_disposal_per_unit = $_POST['estimate_disposal_per_unit'];

  //total of recycling/disposal fee
  $estimate_disposal_total = $_POST['estimate_disposal_total'];

  //total cost
  $estimtate_total_cost = $_POST['estimate_total_cost'];

  //date the estimate costings were declared
  $estimate_date = $_POST['estimate_date'];  

  //expiry date of estimate costings were declared
  $estimate_expiry_date = $_POST['estimate_expiry_date'];

  //removal choice of parts during the work process (A: returned to undersigned ______ or B: disposed of bye the school ______)
  $removal_choice = $_POST['removal_choice'];

  //fill-in of the blank for the removal choice
  $removal_fillin = $_POST['removal_fillin'];



  //date when data is inserted
  $date = date("Y-m-d H:i:s");


   //insert the data into the order table in the database
  $sql_order = "INSERT INTO Orders (Order_No, Date, Password, Email)
  VALUES ('$customer_firstname', '$customer_lastname', '$customer_password', '$customer_email')";
 
}

?>
