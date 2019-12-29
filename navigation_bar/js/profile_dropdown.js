/*******************************************
 * Displays dropdown menu for the profile  *
 *******************************************/

//toggle the dropdown menu when the user presses the profile menu button
$(document).ready(function(){
  //hides the dropdown if the user clicks anywhere else in in the window
  $(document).mouseup(function(){
    $(".profile_dropdown").toggle(500);
  });

});


//hides the dropdown when user clicks outside the button
$(document).on("click", function(event){

  var $trigger = $(".profile_dropdown");

  if($trigger !== event.target && !$trigger.has(event.target).length){
    $(".proifle_dropdown").hide("fast");
  }            

});
