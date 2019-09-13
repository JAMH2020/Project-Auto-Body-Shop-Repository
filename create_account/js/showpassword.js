/*****************************************************************************
** Script that toggles the input type from "password" to "text" in order to **
** hide or show the user's password                                         **
******************************************************************************/

function showPassword(){
  //get the password input
  var password = document.getElementById("password");

  //toggles between showing and hiding password when pressing the checkbox
  if (password.type == "password"){
    password.type = "text";
  } else {
    password.type = "password";
  }
}
