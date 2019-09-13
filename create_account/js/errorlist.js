/*******************************************************************************
** Function that creates new bullet points to list an error message for every **
** missing field                                                              **
********************************************************************************/

function listErrors(errorMessage){
  //creates a bullet point
  var point = document.createElement("li");

  //error message to be put insdie the list tag
  var message = document.createTextNode(errorMessage);
 
  //find the id for the error list
  var list = document.getElementById("errorList");

  //put the message into the list
  point.appendChild(message);
  list.appendChild(point);
}
