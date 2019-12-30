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
  
  <!--script ussed to open a tab for a certain section-->
  <script src="../src/js/open_tab.js"></script>

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
