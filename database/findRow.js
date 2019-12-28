/****************************************************************
** post the value of the primary key of a certain row in order **
** for the database to be able to retrieve the specific data   **
*****************************************************************/

//posts the id of a certain row in order to retrieve its data using sql without refreshing the page
function findCAccountRow(id, url, redirect){
  
  //post the customer id number
  $.post(url, {rowId: id}, 
  
    function(data, status){
      $("#rowText").html(data);
    }
  );
  
  
  //redirect to page to modify inputs
  //redirect_page(redirect);
}


//pass variable to know user is editting values in a form page instead of inserting data
function editPage(url, redirect, editValue){

  //post the value to know to edit page
  $.post(url, {editForm: editValue},
  
    function(data, status){
      $("#editCheck").html(data);
    }
  );

}
