<?php
//start the session
session_start();
?>


<!--script that will redirect the user to another page-->
<script src="../../src/js/submit_form.js"></script>

<?php
$_SESSION['admin_loggedin'] = $_SESSION['worker_loggedin'] = $_SESSION['customer_loggedin'] = false;

//unset the sessions and destroy
$_SESSION = array();
session_destroy();
?>

<!--redirect to the login page-->
<script>redirect_page("/login/login.php")</script>

