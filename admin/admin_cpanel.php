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

<a href="#">Check Orders</a>
<a href="#">Check Invoices</a>
<a href="#">Check Customer Accounts</a>
<a href="#">Check Customer Profiles</a>
<a href="#">Check Worker Accounts</a>




</body>
</html>
