<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in
include_once "../login/login_check.php";

//clear saved session variable from other pages
include "../src/clear_sessions.php";

clear_order();
clear_invoice();
clear_appointments();


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;

//session to identify if the user is viewing a form
$_SESSION['viewForm'] = false;

//session to identify if the admin is making an order based off an appointment
$_SESSION['oldOrder'] = false;

//get rid of session where admin is creating a customer account
$_SESSION['admin_create_caccount'] = 0;


?>

<html>
<head>
  <!--style sheet for the worker control panel-->
  <link rel="stylesheet" type="text/css" href="css/admin_cpanel_styles.css">
  
  <!--script to load a certain section-->
  <script src="../src/js/load_file.js"></script>
  
  <!--script use to redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  
   <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../database/findRow.js"></script>
  
  <!--script ussed to open a tab for a certain section-->
  <script src="../src/js/open_tab.js"></script>
  
  <!--script used to remember a session when user clicks on a link-->
  <script src="../database/findRow.js"></script>
  
  

</head>
<body>
<?php
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
  
  
  //open the selected tab
  if ($_SESSION['admin_section'] == "waccounts"){
?>

    <script> openTab("<?php echo 'waccounts'; ?>");</script>

<?php
  } else if ($_SESSION['admin_section'] == "profiles"){
?>
    <script> openTab("<?php echo 'profiles'; ?>");</script>
    
<?php
  } else if ($_SESSION['admin_section'] == "caccounts"){
?>

    <script> openTab("<?php echo 'caccounts';?>");</script>
    
<?php
  } else if ($_SESSION['admin_section'] == "invoices"){
?>

    <script> openTab("<?php echo 'invoices';?>");</script>
    
<?php
  } else if ($_SESSION['admin_section'] == "aappointments"){
?>
    <script> openTab("<?php echo 'aappointments'; ?>");</script>
        

<?php
  } else if ($_SESSION['admin_section'] == "rappointmnets"){
?>
    <script> openTab("<?php echo 'rappoinments'; ?>");</script>
    
  
<?php
  } else if ($_SESSION['admin_section'] == "iappointments"){
?>
    <script> openTab("<?php echo 'iappointments'; ?>");</script>
    
    
<?php
  } else if ($_SESSION['admin_section'] == "mappointments"){
?>
    <script> openTab("<?php echo 'mappointments'; ?>");</script>


<?php
  } else {
?>

    <script> openTab("<?php echo 'orders';?>");</script>
    
<?php
  }
?>



<div class="admin_cpanelPage">
  <div class="background_admin_cpanel">
    <div class="admin_cpanel_links">
    
      <a href="#" class="a_option_link closed_tab" id = "orders" onclick="loadFile('orders/check_orders.php'); openTab('orders');">Check Orders</a>
      <a href="#" class="a_option_link closed_tab" id = "invoices" onclick="loadFile('invoices/check_invoices.php'); openTab('invoices');">Check Invoices</a>
      <a href="#" class="a_option_link closed_tab" id = "caccounts" onclick="loadFile('accounts/customer_acc.php'); openTab('caccounts');">Check Customer Accounts</a>
      <a href="#" class="a_option_link closed_tab" id = "profiles" onclick="loadFile('profiles/check_profiles.php'); openTab('profiles');">Check Profiles</a>
      <a href="#" class="a_option_link closed_tab" id = "waccounts" onclick="loadFile('accounts/worker_acc.php'); openTab('waccounts');">Check Worker Accounts</a>
      <a href="#" class="a_option_link closed_tab" id = "aappointments" onclick="loadFile('appointments/a_appointments.php'); openTab('aappointments');">Accepted Appointments</a>
      <a href="#" class="a_option_link closed_tab" id = "rappointmnets" onclick="loadFile('appointments/r_appointments.php'); openTab('rappointmnets');">Rejected Appointments</a>
      <a href="#" class="a_option_link closed_tab" id = "iappointments" onclick="loadFile('appointments/i_appointments.php'); openTab('iappointments');">Incoming Appointments</a>
      <a href="#" class="a_option_link closed_tab" id = "mappointments" onclick="loadFile('appointments/m_appointments.php'); openTab('mappointments');">Met Appointments</a>
      
    </div>
  </div>
  
  <div class="content_window">
    <div class="vertical_align_content">
      <div class="horizontal_align_content">
        <?php
        //sessions to choose which section to load to the control panel
        if ($_SESSION['admin_section'] == "waccounts"){
        ?>
    
          <script> loadFile('accounts/worker_acc.php'); </script>
      
        <?php
        } else if ($_SESSION['admin_section'] == "profiles"){
        ?>
    
          <script> loadFile('profiles/check_profiles.php'); </script>
      
        <?php
        } else if ($_SESSION['admin_section'] == 'caccounts'){
        ?>
    
          <script> loadFile('accounts/customer_acc.php'); </script>
      
        <?php
        } else if ($_SESSION['admin_section'] == 'invoices'){
        ?>
    
          <script> loadFile('invoices/check_invoices.php'); </script>
      
        <?php
        } else if ($_SESSION['admin_section'] == 'aappointments'){
        ?>
    
          <script> loadFile('appointments/a_appointments.php'); </script>
      
      
        <?php
        } else if ($_SESSION['admin_section'] == 'rappointmnets'){
        ?>
    
          <script> loadFile('appointments/r_appointments.php'); </script>
      
      
        <?php
        } else if ($_SESSION['admin_section'] == 'iappointments'){
        ?>
    
          <script> loadFile('appointments/i_appointments.php'); </script>
         
        <?php
        } else if ($_SESSION['admin_section'] == 'mappointments'){
        ?>
    
          <script> loadFile('appointments/m_appointments.php'); </script>
      
        <?php
        } else {
        ?>
    
          <script> loadFile('orders/check_orders.php'); </script>
      
        <?php
        }
        ?>
      </div>
    </div>
  </div>

</div>
<?php
//include the footer
include '../footer/footer.php';
?>



</body>
</html>
