/*******************************************************
 * Selects which tab to open in the user control panel *
 *******************************************************/


function openTab(clickedTab){
  $(document).ready(function(){
    //close all tabs
    $(".a_option_link").removeClass("opened_tab");
    $(".a_option_link").removeClass("center_opened_tab");
    $(".a_option_link").addClass("closed_tab");
  
    //open the clicked tab
    $("#" + clickedTab).removeClass("closed_tab");
    $("#" + clickedTab).addClass("opened_tab");
    
    //add the left border to the tab if the tab is not the left most tab
    if (clickedTab != "orders"){
      $("#" + clickedTab).addClass("center_opened_tab");
    }
  
  });
  
}
