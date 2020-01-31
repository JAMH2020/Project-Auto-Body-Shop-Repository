/********************************************************
 * Asks the user if they are sure of submitting a form  *
 ********************************************************/
 
 function confirmForm(formName, submitName, formType) {
  var x = document.forms[formName][submitName].value;
  if (x) {
    var confirmation = confirm("Are you sure you want to submit the " + formType);
    
    if (confirmation){
      return true;
    } else {
      return false;
    }
  }
}
