/*******************************************************
 * Selects which tab to open in the user control panel *
 *******************************************************/


function openTab(clickedTab, selectClass){
  $(document).ready(function(){
  
    //if the tabs are the first layer tabs
    if (selectClass == "a_option_link"){
      //close all tabs
      $("." + selectClass).removeClass("opened_tab");
      $("." + selectClass).removeClass("center_opened_tab");
      $("." + selectClass).addClass("closed_tab");
  
      //open the clicked tab
      $("#" + clickedTab).removeClass("closed_tab");
      $("#" + clickedTab).addClass("opened_tab");
    
      //add the left border to the tab if the tab is not the left most tab
      if (clickedTab != "orders" && clickedTab != "appointments"){
        $("#" + clickedTab).addClass("center_opened_tab");
      }
      
    //if the tabs are the second layered tabs
    } else {
      //close all tabs
      $("." + selectClass).removeClass("secondary_opened_tab");
      $("." + selectClass).removeClass("secondary_center_opened_tab");
      $("." + selectClass).addClass("secondary_closed_tab");
  
      //open the clicked tab
      $("#" + clickedTab).removeClass("secondary_closed_tab");
      $("#" + clickedTab).addClass("secondary_opened_tab");
    
      //add the left border to the tab if the tab is not the left most tab
      if (clickedTab != "ogorders"){
        $("#" + clickedTab).addClass("secondary_center_opened_tab");
      }
    }
  
  });
  
}
