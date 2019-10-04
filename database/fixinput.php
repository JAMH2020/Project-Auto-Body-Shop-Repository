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
 
  $_POST["$post_name"] = $data;

  return $data;
}




//function that is used to reformat dates into YYYY-MM-DD format to set value for date inputs
function reformat_date($timestamp){

  $date_format = date("Y-m-d",$timestamp);
  return $date_format;
}

