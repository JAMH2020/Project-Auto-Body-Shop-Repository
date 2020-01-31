<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

$_SESSION['worker_section'] = "appointments";

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;




//opens the tab of the current section the user is on
if ($_SESSION['worker_appointments'] == "mappointments"){
?>

<script>openTab("mappointments", "a_appointment_link");</script>

<?php
//opens the tab of the current section the user is on
} else {
?>

<script>openTab("aappointments", "a_appointment_link");</script>

<?php
}
?>

 <a href="#"  class="a_appointment_link secondary_closed_tab" id="aappointments" onclick='appointmentLoad("worker_aappointments.php"); openTab("aappointments", "a_appointment_link")'>Accepted Appointments</a>
 <a href="#"  class="a_appointment_link secondary_closed_tab" id="mappointments" onclick='appointmentLoad("worker_mappointments.php"); openTab("mappointments", "a_appointment_link")'>Met Appointments</a>
 
 
 <div class="appointment_window">
   <?php
   //sessions to choose which section to load at default run of page
   if ($_SESSION['worker_appointments'] == "mappointments"){
    ?>

     <script> appointmentLoad('worker_mappointments.php'); </script>

   <?php
   //sessions to choose which section to load at default run of page
    } else {
    ?>
    
     <script> appointmentLoad('worker_aappointments.php'); </script>

    <?php
    } 
    ?>
 </div>
