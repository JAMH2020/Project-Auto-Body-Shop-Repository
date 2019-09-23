<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}


 

//include file to send error message if field is empty or incorrect
include "../database/fixinput.php";


// Check if user is currently logged in, if yes, redirects
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../worker_cpanel/worker_cpanel.php");
    exit;
}

 

// Define variables and initialize with empty values
//username
$login_username = $login_password = "";

//password
$username_err = $password_err = "";

 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

     // Check if username is empty
    createErrMsg("login", "username", "login_username", "username_err");
    
    // Check if password is empty
    createErrMsg("login", "password", "login_password", "password_err");

    

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
    
       //include file to check if the user name password is correct
       include "../database/select/select_login.php";
    }
}      
?>

<!DOCTYPE html>

<html lang="en">

<head>  
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  
  <style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
  </style>

</head>

<body>

    <div class="wrapper">

        <h2>Login</h2>

        <p>Please fill in your credentials to login.</p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="login_username" class="form-control" value="<?php echo $login_username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="text" name="login_password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>

            </div>

            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="Login">
            </div>

            <p>Don't have an account? <a href="../create_account/signup.php">Sign up now</a>.</p>

        </form>

    </div>    

</body>

</html>

