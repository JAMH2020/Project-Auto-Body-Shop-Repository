<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<h2 class='order_title'>MY ORDERS</h2>

<a href="orders/intake_repair_form.php" class='order'>Create Order</a>

<div class="create_order_underline"></div>
<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/select_orders.php';
?>
