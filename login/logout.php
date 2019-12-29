<?php
//start the session
if (session_start() === null){
  session_start();
}

//unset the sessions and destroy
$_SESSION = array();
session_destroy();
?>

<!--script that will redirect the user to another page-->
<script src="../../src/js/submit_form.js"></script>

  
<script>redirect_page("login.php")</script>
