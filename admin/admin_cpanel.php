<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<html>
<head>
  <!--style sheet for the worker control panel-->
  <link rel="stylesheet" type="text/css" href="css/admin_cpanel_styles.css">

</head>
<body>
<?php
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>

<div class="admin_cpanelPage">
  <a href="orders/check_orders.php">Check Orders</a>
  <a href="invoices/check_invoices.php">Check Invoices</a>
  <a href="accounts/customer_acc.php">Check Customer Accounts</a>
  <a href="profiles/check_profiles.php">Check Profiles</a>
  <a href="accounts/worker_acc.php">Check Worker Accounts</a>

</div>
<?php
//include the footer
include '../footer/footer.php';
?>



</body>
</html>
