<?php
/*****************************************************************************
** allows connection from the website to the database using PHPMyAdmin      **
******************************************************************************/

//name of the MySQL server that is being used
$servername = "**************";

//username to PHPMyAdmin
$username = "***************";

//password to PHPMyAdmin
$password = "**************";

//name of the database that is being used in the server
$db = "*****************";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed ");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn->set_charset("utf8mb4");

//echo "Connected successfully<br>";
?>
