<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//clear saved session variable from other pages
include "../src/clear_sessions.php";

clear_order();
clear_invoice();
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

</head>
<body>
<?php
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>

<div class="admin_cpanelPage">
  <a href="#" onclick="loadFile('orders/check_orders.php')">Check Orders</a>
  <a href="#" onclick="loadFile('invoices/check_invoices.php')">Check Invoices</a>
  <a href="#" onclick="loadFile('accounts/customer_acc.php')">Check Customer Accounts</a>
  <a href="#" onclick="loadFile('profiles/check_profiles.php')">Check Profiles</a>
  <a href="#" onclick="loadFile('accounts/worker_acc.php')">Check Worker Accounts</a>
  
  <div class="content_window">
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
    } else {
    ?>
    
      <script> loadFile('orders/check_orders.php'); </script>
      
    <?php
    }
    ?>
  </div>

</div>
<?php
//include the footer
include '../footer/footer.php';
?>



</body>
</html>
