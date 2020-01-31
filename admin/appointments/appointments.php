<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}


$_SESSION['admin_section'] = "appointments";


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;

  //open the selected tab
  if ($_SESSION['admin_appointments'] == "iappointments"){
?>

    <script> openTab("<?php echo 'iappointments'; ?>", "a_appointment_link");</script>

<?php
  } else if ($_SESSION['admin_appointments'] == "rappointments"){
?>
    <script> openTab("<?php echo 'rappointments'; ?>", "a_appointment_link");</script>
    
<?php
  } else if ($_SESSION['admin_appointments'] == "mappointments"){
?>

    <script> openTab("<?php echo 'mappointments'; ?>", "a_appointment_link");</script>
    
<?php
  } else {
?>

    <script> openTab("<?php echo 'aappointments'; ?>", "a_appointment_link");</script>
    
<?php
  }
?>


  <!--the admin control panel section where they can check the customer profiles in the system-->
  <!--stylesheet for the invoices table-->
  
  <a href="#" class="a_appointment_link secondary_closed_tab" id = "aappointments" onclick="appointmentLoad('appointments/a_appointments.php'); openTab('aappointments', 'a_appointment_link');">Accepted Appointments</a>
  <a href="#" class="a_appointment_link secondary_closed_tab" id = "rappointments" onclick="appointmentLoad('appointments/r_appointments.php'); openTab('rappointments', 'a_appointment_link');">Rejected Appointments</a>
  <a href="#" class="a_appointment_link secondary_closed_tab" id = "iappointments" onclick="appointmentLoad('appointments/i_appointments.php'); openTab('iappointments', 'a_appointment_link');">Incoming Appointments</a>
  <a href="#" class="a_appointment_link secondary_closed_tab" id = "mappointments" onclick="appointmentLoad('appointments/m_appointments.php'); openTab('mappointments', 'a_appointment_link');">Met Appointments</a>
  
  
  <div class="appointment_window">
    <div class="vertical_align_content">
      <div class="horizontal_align_content">
    <?php
      //sessions to choose which section to load to the control panel
      if ($_SESSION['admin_appointments'] == "iappointments"){
    ?>
          <script> appointmentLoad('appointments/i_appointments.php'); </script>
          
    <?php
      } else if ($_SESSION['admin_appointments'] == "rappointments"){
    ?>

          <script> appointmentLoad('appointments/r_appointments.php'); </script>

    <?php
      } else if ($_SESSION['admin_appointments'] == "mappointments"){
    ?>

          <script> appointmentLoad('appointments/m_appointments.php'); </script>
    
    <?php
    } else {
    ?>

          <script> appointmentLoad('appointments/a_appointments.php'); </script>
    
    <?php
    }
    ?>
    
      </div>
    </div>
  </div>
