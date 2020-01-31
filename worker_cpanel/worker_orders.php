<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

$_SESSION['worker_section'] = "orders";


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>



<h2 class='order_title'>MY ORDERS</h2>

<div class="order_link">
  <a href="orders/intake_repair_form.php" class='order'>Create Order</a>
  <div class="create_order_underline"></div>
</div>

<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/select_orders.php';
?>

