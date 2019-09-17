<?php
/*********************************************************************************************************
** fixes the user's input by stripping slashes, allowing html code input or displaying an error message **
** if a missing field or incorrect input occurs                                                         **
**********************************************************************************************************/

//function that creates an error message if the post variable of the input is empty after submitting the form
//@param post_name name of the variable in the post superglobal that is being checked
//@param name name of the value that is going to appear in the error message
//@param variable_name name of the global variable being used
//@param error_variable_name corresponding error message that will display
function createErrMsg($post_name, $name, $variable_name, $error_variable_name){
  if (empty($_POST["$post_name"])){
    $GLOBALS["$error_variable_name"] = $name . " is missing";

    //store input into a session
    $_SESSION["$variable_name"] = $_POST["$post_name"];
  } else {
    $GLOBALS["$variable_name"] = fix_input($_POST["$post_name"], $post_name);

    //store input into a session
    $_SESSION["$variable_name"] = $_POST["$post_name"];
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

?>
