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
<a href="intake_repair_form.php">Create Order</a>

<h2>My Orders</h2>

<?php
//include file for selecting orders
include '../database/select/select_orders.php';
?>



</body>
</html>