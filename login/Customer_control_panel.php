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

<a href="intake_repair_form.php">Create Order</a>

<h2>My Orders</h2>

</body
</html>