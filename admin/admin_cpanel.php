<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<html>
<head>
</head>
<body>
<?php
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>

<a href="orders/check_orders.php">Check Orders</a>
<a href="#">Check Invoices</a>
<a href="accounts/customer_acc.php">Check Customer Accounts</a>
<a href="profiles/check_profiles.php">Check Profiles</a>
<a href="accounts/worker_acc.php">Check Worker Accounts</a>




</body>
</html>
