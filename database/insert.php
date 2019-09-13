<?php
/****************************************
** Insert user data into the database  **
*****************************************/

//connect to the database
include 'connectdb.php';

//customer's firstname
$customer_firstname = $_POST['customer_firstname'];

//customer's lastname
$customer_lastname = $_POST['customer_lastname'];

//customer's password
$customer_password = $_POST['customer_password'];

//customer's email
$customer_email = $_POST['customer_email'];


//insert the data into the customer_account table in the database
$sql = "INSERT INTO Customer_Accounts (First_Name, Last_Name, Password, Email)
VALUES ('$customer_firstname', '$customer_lastname', '$customer_password', '$customer_email')";


//check if the data can be inserted to the database
if ($conn->query($sql) === TRUE) {
    echo "inserted succesfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
