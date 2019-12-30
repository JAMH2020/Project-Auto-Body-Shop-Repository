/*******************************************
 * Displays dropdown menu for the profile  *
 *******************************************/

$(document).mouseup(function (e) { 
  if ($(e.target).closest(".profile_button").length === 0) { 
    $(".profile_dropdown").hide(500); 
  } else {
    $(".profile_dropdown").toggle(500); 
  }
}); 
