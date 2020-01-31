<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//remember which tab section the user was on
$_SESSION['customer_section'] == "appointments";


//opens the tab of the current section the user is on
if ($_SESSION['customer_appointments'] == "rorders"){
?>

  <script>openTab("<?php echo 'rorders';?>");</script>

<?php
} else if ($_SESSION['customer_appointments'] == "porders"){
?>

  <script>openTab("<?php echo 'porders';?>");</script>

<?php
} else {
?>

  <script>openTab("<?php echo 'ogorders';?>");</script>

<?php
}
?>


<a href="#"  class="a_appointment_link secondary_closed_tab" id="ogorders" onclick='appointmentLoad("customer_ogorders.php"); openTab("ogorders", "a_appointment_link");'>Accepted Appointments</a>
<a href="#"  class="a_appointment_link secondary_closed_tab" id="porders" onclick='appointmentLoad("customer_porders.php"); openTab("porders", "a_appointment_link");'>Planned Appointments</a>
<a href="#"  class="a_appointment_link secondary_closed_tab" id="rorders" onclick='appointmentLoad("customer_rorders.php"); openTab("rorders", "a_appointment_link")'>Rejected Appointments</a>


<div class="appointment_window">
   <?php
   //default loading of the file when user comes on to the page
   if ($_SESSION['customer_appointments'] == "rorders"){
   ?>

      <script>appointmentLoad("customer_rorders.php");</script>

   <?php
   } else if ($_SESSION['customer_appointments'] == "porders"){
   ?>
   
      <script>appointmentLoad("customer_porders.php");</script>

   <?php
   } else {
    ?>

      <script>appointmentLoad("customer_ogorders.php");</script>

   <?php
    }
   ?>

</div>
