<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

$_SESSION['worker_section'] = "invoices";


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>



<h2 class='invoice_title'>MY INVOICES</h2>

<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/select_invoices.php';
?>
