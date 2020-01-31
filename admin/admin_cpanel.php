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
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Welcome <?php echo " " . $_SESSION['admin_firstname']; ?></title>
  <meta name="description" content="Admin's Control Panel for Orders, Invoices, Appointments and Accounts">
  <meta name="author" content="JAMH Group">

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
  
  <!--script that will display message for any action user has done-->
  <script src="../src/js/display_notification.js"></script>
  

</head>
<body>
<?php
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
  
  
  //open the selected tab
  if ($_SESSION['admin_section'] == "waccounts"){
?>

    <script> openTab("<?php echo 'waccounts'; ?>", "a_option_link");</script>

<?php
  } else if ($_SESSION['admin_section'] == "profiles"){
?>
    <script> openTab("<?php echo 'profiles'; ?>", "a_option_link");</script>
    
<?php
  } else if ($_SESSION['admin_section'] == "caccounts"){
?>

    <script> openTab("<?php echo 'caccounts';?>", "a_option_link");</script>
    
<?php
  } else if ($_SESSION['admin_section'] == "invoices"){
?>

    <script> openTab("<?php echo 'invoices';?>", "a_option_link");</script>
    
<?php
  } else if ($_SESSION['admin_section'] == "appointments"){
?>

    <script> openTab("<?php echo 'appointments';?>", "a_option_link");</script>
    
<?php

  } else {
?>

    <script> openTab("<?php echo 'orders';?>", "a_option_link");</script>
    
<?php
  }
  
  
  $notification_job = "";
  $notification_action = "";
  
  //comment for the notification if the user has inserted or editted a file
  if ($_SESSION['order_done'] != ""){
    $notification_job = "Order";
    
  } else if ($_SESSION['invoice_done'] != ""){
    $notification_job = "Invoice";
    
  } else if ($_SESSION['appointment_done'] != ""){
    $notification_job = "Appointment";
    
  } else if ($_SESSION['account_done'] != ""){
    $notification_job = "Account";
  
  } else if ($_SESSION['profile_done'] != ""){
    $notification_job = "Profile";
  
  }
  
  
  
  if ($_SESSION['order_done'] == "insert" || $_SESSION['invoice_done'] == "insert" || $_SESSION['appointment_done'] == "insert" || $_SESSION['account_done'] == "insert" || $_SESSION['profile_done'] == "insert"){
  
    $notification_action = "Inserted";
    
  } else if ($_SESSION['order_done'] == "edit" || $_SESSION['invoice_done'] == "edit" || $_SESSION['appointment_done'] == "edit" || $_SESSION['account_done'] == "edit" || $_SESSION['profile_done'] == "edit"){
  
    $notification_action = "Editted";
    
  } else if ($_SESSION['order_done'] == "delete"){
  
    $notification_action = "Deleted";
    
  }
?>


<div class="notification_box">
  <span class="email_notification">
    <i class='fas fa-check-circle sent_icon'></i>
    <?php echo "Your " . $notification_job . " has been Successfully " . $notification_action; ?>
  </span>
</div>


<div class="error_box">
  <span class="error_notification">
  <i class='fas fa-exclamation-triangle error_icon'></i>
  <?php echo $_SESSION['error_notification'];?>
  </span>
</div>


<?php
//display any notifications if the user has editted or inserted data
if ($_SESSION['order_done'] != "" || $_SESSION['invoice_done'] != "" || $_SESSION['appointment_done'] != "" || $_SESSION['account_done'] != "" || $_SESSION['profile_done'] != ""){
?>

<script>
show_notification("notification_box");
</script>

<?php
  $_SESSION['order_done'] = "";
  $_SESSION['invoice_done'] = "";
  $_SESSION['appointment_done'] = "";
  $_SESSION['account_done'] = "";
  $_SESSION['profile_done'] = "";
}

//display notification for error if there is any
if ($_SESSION['error_notification'] != ""){
?>

<script>
show_notification("error_box");
</script>

<?php
  $_SESSION['error_notification'] = "";
}
?>

<div class="admin_cpanelPage">
  <div class="background_admin_cpanel">
    <div class="admin_cpanel_links">
    
      <a href="#" class="a_option_link closed_tab" id = "orders" onclick="loadFile('orders/check_orders.php'); openTab('orders', 'a_option_link');">Check Orders</a>
      <a href="#" class="a_option_link closed_tab" id = "invoices" onclick="loadFile('invoices/check_invoices.php'); openTab('invoices', 'a_option_link');">Check Invoices</a>
      <a href="#" class="a_option_link closed_tab" id = "caccounts" onclick="loadFile('accounts/customer_acc.php'); openTab('caccounts', 'a_option_link');">Check Customer Accounts</a>
      <a href="#" class="a_option_link closed_tab" id = "profiles" onclick="loadFile('profiles/check_profiles.php'); openTab('profiles', 'a_option_link');">Check Profiles</a>
      <a href="#" class="a_option_link closed_tab" id = "waccounts" onclick="loadFile('accounts/worker_acc.php'); openTab('waccounts', 'a_option_link');">Check Worker Accounts</a>
      <a href="#" class="a_option_link closed_tab" id = "appointments" onclick="loadFile('appointments/appointments.php'); openTab('appointments', 'a_option_link');">Appointments</a>
      
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
        } else if ($_SESSION['admin_section'] == 'appointments'){
        ?>
    
          <script> loadFile('appointments/appointments.php'); </script>
      
      
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
