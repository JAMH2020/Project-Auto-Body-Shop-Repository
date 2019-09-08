<?php
/*************************************************************************
** allows connection from the website to the database using PHPMyAdmin  **
**************************************************************************/

//name of the MySQL server that is being used
$servername = "********";

//username to PHPMyAdmin
$username = "********";

//password to PHPMyAdmin
$password = "********";

//name of the database that is being used in the server
$db = "******";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";
?>
