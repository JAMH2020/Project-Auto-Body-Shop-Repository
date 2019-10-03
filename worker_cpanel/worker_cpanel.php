<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!-- control panel for the worker -->

<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
//include the navigation bar
include "../navigation_bar/navigation_bar.php";
?>

<a href="intake_repair_form.php" class='order'>Create Order</a>

<h2 class='title'>MY ORDERS</h2>


<?php
//include file for selecting orders
include '../database/select/select_orders.php';
?>



</body>
