/*************************************************************
 * displays the notification for user doing a certain action *
 *************************************************************/
 
 function show_notification(notificationClass){
   $(document).ready(function(){
     
     //display the notification, then hide it
     $("." + notificationClass).slideDown("slow");
     $("." + notificationClass).delay(5000).slideUp("slow");
     
   });
 }
