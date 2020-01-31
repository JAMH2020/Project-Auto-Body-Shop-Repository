<?php
/*********************************************************************************************************
** fixes the user's input by stripping slashes, allowing html code input or displaying an error message **
** if a missing field or incorrect input occurs                                                         **
**********************************************************************************************************/

//function that creates an error message if the session and post variable of the input is empty after submitting the form
//@param post_name name of the variable in the post superglobal that is being checked
//@param name name of the value that is going to appear in the error message
//@param variable_name name of the global variable being used
//@param error_variable_name corresponding error message that will display
function createErrMsg($intake_name, $name, $variable_name, $error_variable_name){

  //if the post of the variable is not set and the submit button has been pressed
  if ($_POST["$variable_name"] == "" and isset($_POST["$intake_name"])) {
      
 
    $GLOBALS["$error_variable_name"] = $name . " is missing";

    //store input into a session
    $_SESSION["$variable_name"] = $_POST["$variable_name"];
    
 
  } else if (empty($_POST["$variable_name"]) and !isset($_POST["$intake_name"])){
  
    //remembers the session if the user goes back to a previous page
    if (!empty($_SESSION["$variable_name"])){
      //store post value as the remembered session value
      $_POST["$variable_name"] = $_SESSION["$variable_name"];
    
    }
  
  
  } else {
    $GLOBALS["$variable_name"] = fix_input($_POST["$variable_name"], $post_name);

    //store input into a session
    $_SESSION["$variable_name"] = $_POST["$variable_name"];
    
  }
}


//function that cancels escape codes and allows for html code input
function fix_input($data, $post_name){
	
  $data = htmlspecialchars($data);

  for ($i = 0; $i < strlen($data); $i++){
    if ($data[$i] == "\\"){
      $data = substr_replace($data, "\\", $i, 0);
      $i++;
    }

  }
  
  //trims whitespace at the beggining of the string
  $data = ltrim($data);
  
  //trims whitespace at the end of the string
  $data = rtrim($data);
 
  $_POST["$post_name"] = $data;

  return $data;
}




//function that is used to reformat dates into YYYY-MM-DD format to set value for date inputs
function reformat_date($timestamp){
  
  //initiate the date to be formatted
  $date_format = "";
  
  //get the year of the date
  $year = substr_replace($timestamp, "", 4, 15);
  
  
  //get the montrh of the date
  //remove the first part of the string
  $month = substr_replace($timestamp, "", 0, 5);
  
  //remove the end part of the string
  $month = substr_replace($month, "", 2, 12);
  
  
  //get the day of the date
  //remove the first part of the string
  $day = substr_replace($timestamp, "", 0, 8);
  
  //remove the last part of the string
  $day = substr_replace($day, "", 2, 9);
  
  
  
  //combine the values to get the date format
  $date_format = $year . "-" . $month . "-" . $day;
  
  
  
  return $date_format;
}





//function to check whether a worker email exists
function worker_exist($worker_email, $exception){

  //include file to connect to the database
  include_once '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/connectdb.php';

  //include file to check errors in sql statements
  include_once '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/error_check.php';
  
  $statement = "SELECT Email FROM Worker_Accounts WHERE Email = '" . $worker_email . "'";
  
   //prepare and bind sql statement
  $stmt_worker_email = $conn->prepare($statement);

  //execute the statement
  $stmt_worker_email->execute();

  //store the result
  $stmt_worker_email->store_result();

  //bind the results
  $stmt_worker_email->bind_result($worker_emailRow);
  
  
  //flag to tell whether a worker variable exists
  $worker_email_exist = 0;

  //print out the accounts that are available
  if ($stmt_worker_email->num_rows > 0){
    while($stmt_worker_email->fetch()){
    
      //if the found worker email is not the user's own email
      if ($exception != "none"){
        if ($worker_emailRow != $exception){
          $worker_email_exist = 1;
        }
        
      } else {
        $worker_email_exist = 1;
      }
    }
  }
  
  //close the statement
  $stmt_worker_email->close();
  
  return $worker_email_exist;
}


//function to check whether a customer email exist
function customer_exist($customer_email, $exception){

  //include file to connect to the database
  include_once '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/connectdb.php';

  //include file to check errors in sql statements
  include_once '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/error_check.php';
  
  
  $statement = "SELECT Email FROM Customer_Accounts WHERE Email = '" . $customer_email . "'";
  
   //prepare and bind sql statement
  $stmt_customer_email = $conn->prepare($statement);

  //execute the statement
  $stmt_customer_email->execute();

  //store the result
  $stmt_customer_email->store_result();

  //bind the results
  $stmt_customer_email->bind_result($customer_emailRow);
  
  
  //flag to tell whether a worker variable exists
  $customer_email_exist = 0;

  //print out the accounts that are available
  if ($stmt_customer_email->num_rows > 0){
    while($stmt_customer_email->fetch()){
    
      //if the customer email found is not the customer's own email
      if ($exception != "none"){
        if ($customer_emailRow != $exception){
          $customer_email_exist = 1;
        }
        
      } else {
        $customer_email_exist = 1;
      }
    
    }
  }
  
  //close the statement
  $stmt_customer_email->close();
  
  return $customer_email_exist;
}





//function to check whether a pricing is valid
function check_number($session , $name, $error_variable_name){
  
  //check if the variable has not been already confirmed empty
  if ($GLOBALS["$error_variable_name"] == ""){
    //check if the input is a number that is greater or equal to zero
    if (is_numeric($session)){
      if ($session < 0){
        $GLOBALS["$error_variable_name"] = $name . " is not a number greater or equal to 0";
      } 
      
    } else {
      $GLOBALS["$error_variable_name"] = $name . " is not a number greater or equal to 0";
    }
  }
}





//function to limits the amount of characters put into an input
function limit_length($session, $length, $absolute, $name ,$error_variable_name){
  
  //check if the variable has not been already confirmed empty
  if ($GLOBALS["$error_variable_name"] == ""){
  
    //check if the input has to be exactly a certain length
    if ($absolute){
      if (strlen($session) != $length){
        $GLOBALS["$error_variable_name"] = $name . " is not exactly " . $length . " characters long";
      }
    
    //if the input only has a limit length
    } else {
      if (strlen($session) > $length){
        $GLOBALS["$error_variable_name"] = $name . " is longer than " . $length . " characters";
      }
    }
  
  }
}





//function to limit the year of the car input
function year_limit($session, $min_year, $max_year, $name, $error_variable_name){
  
  //check if the variable has not been already confirmed empty
  if ($GLOBALS["$error_variable_name"] == ""){
    
    //check if the date is an integer value
    if (filter_var($session, FILTER_VALIDATE_INT)) {
      
      //if the year is not in between the min and max year
      if ($session < $min_year || $session > $max_year){
        $GLOBALS["$error_variable_name"] = "Please enter the " . $name . " in between " . $min_year . " and " . $max_year;
      }

      
    } else {
      $GLOBALS["$error_variable_name"] = "Please enter " . $name . " as an integer format";
    }
  }
}






//function to fix the date of an input to not be older than the system date
function system_date_limit($session, $name, $error_variable_name ,$system_date, $future_date){

  //check if the variable has not been already confirmed empty
  if ($GLOBALS["$error_variable_name"] == ""){
    
    //get the old date limit
    if ($system_date == "today"){
      //get the system date in string format
      $date = new DateTime();
    
      //current year
      $current_year = $date->format("Y");
    
      //current month
      $current_month = $date->format("m");
    
      //current day
      $current_day = $date->format("d");
      
    } else {
      
      //get the year, month, day of the limit date
      $current_year = substr($system_date, 0, 4);
      
      $current_month = substr($system_date, 5, 2);
      
      $current_day = substr($system_date, 8, 2);
    }
    
    
    
    //get the future date limit
    if ($future_date == "today"){
      //get the system date in string format
      $date = new DateTime();
    
      //current year
      $future_year = $date->format("Y");
    
      //current month
      $future_month = $date->format("m");
    
      //current day
      $future_day = $date->format("d");
      
    } else {
      
      //get the year, month, day of the limit date
      $future_year = substr($system_date, 0, 4);
      
      $future_month = substr($system_date, 5, 2);
      
      $future_day = substr($system_date, 8, 2);
    }
    
    
    //input year
    $input_year = substr($session, 0 ,4);
    
    //input month
    $input_month = substr($session, 5 ,2);
    
    //input day
    $input_day = substr($session, 8 ,4);
    
    //check if the input date is not older than the system date
    //check if the year is the same
    
    
    //variable to check if input is older than the limit day
    $older = 0;
    
    //variable to check if input is newer than the limit day
    $newer = 0;
    
    
    //check if the date is older
    if ($system_date != "none"){
      //check if the year is the same
      if ($input_year == $current_year){
    
        //check if the month is the same
        if ($input_month == $current_month){
      
          //check if the input day is less than the current day
          if($input_day < $current_day){
            $older = 1;
          
          }
          
        } else if ($input_month < $current_month){
          $older = 1;
        } 
      
      //if the input year is less than the current year
      } else if ($input_year < $current_year){
        $older = 1;
      } 
    }
    
    
    
    //check if the date is newer
    if ($future_date != "none"){
      //check if the year is the same
      if ($input_year == $future_year){
    
        //check if the month is the same
        if ($input_month == $future_month){
        
          //check if the day is bigger than the future date limit
          if ($input_day > $future_day){
            $newer = 1;
          }
      
        } else if ($input_month > $future_month){
          $newer = 1;
        }
      } else if ($input_year > $future_year){
        $newer = 1;
      }
    }
    
    
    
    if ($older){
      if ($system_date == "today"){
        $GLOBALS["$error_variable_name"] = "Please enter the " . $name . " that is not older than today";
      } else {
        $GLOBALS["$error_variable_name"] = "Please enter the " . $name . " that is not older than " . $system_date;
      }
    }
    
    
    if ($newer){
      if ($future_date == "today"){
        $GLOBALS["$error_variable_name"] = "Please enter the " . $name . " that is not newer than today";
      } 
    }
  }
}








//check if the entered initial corresponds with the name entered
function initial_check($initial, $firstname, $lastname, $display_name, $firstnameERR, $lastnameERR, $error_variable_name){

  //check if the variable has not been already confirmed empty
  if ($GLOBALS["$error_variable_name"] == "" && $GLOBALS["$firstnameERR"] == "" && $GLOBALS["$lastnameERR"] == ""){
    
    //length of the initial
    $initial_length = strlen($initial);
    
    //strip any dots in the initial
    for ($i = 0; $i < $initial_length; $i++){
      if ($initial[$i] == "."){
        $initial = substr_replace($initial, "", $i, 1);
        $i--;

      }

    }
    
    
    //convert the initials and the name to all capitals
    $initial = strtoupper($initial);
    
    $firstname = strtoupper($firstname);
    
    $lastname = strtoupper($lastname);
    
    //get the first letters from the firstname and lastname and the initial
    $firstname = substr($firstname,0,1);
    $lastname = substr($lastname,0,1);
    
    $initial_firstname = substr($initial,0,1);
    $initial_lastname = substr($initial,1,1);
    
    //compare if the initial matches the first letters of the firstname and lastname
    if ($firstname != $initial_firstname || $lastname != $initial_lastname){
      $GLOBALS["$error_variable_name"] = $display_name . " does not match the firstname and lastname";
    }
    
    
    
  }
}






//function to check if the password entered is in the correct format
function password_check($password, $name, $error_variable_name){
  
  if ($GLOBALS["$error_variable_name"] == ""){
    //trim the password of whitespaces at the ends
    $password = trim($password);
  
    //check the length of the password
    $length = strlen($password);
    
    //variable to check if password contains a 
    $special_character = 0;
    
    //convert the password to lowercase
    $password = strtolower($password);
    
    //if the length is less than 8 characters
    if ($length < 8){
      $GLOBALS["$error_variable_name"] = $name . " needs to be at least 8 characters long";
    } else {
      
      for ($i = 0; $i < $length; $i++){
      
        //check if the password contains at least one character that is not an alphabet
        if (!preg_match("/^[a-z]$/", $password[$i])) {
          $special_character = 1;
          break;
        }
      }
      
      
      if (!$special_character){
        $GLOBALS["$error_variable_name"] = $name . " must contain at least 1 special charater";
      }
    }
  }
  
}
