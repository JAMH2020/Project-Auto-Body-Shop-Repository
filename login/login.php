<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>  
  <meta charset="UTF-8">
  <title>Login</title>
  <!--script that will redirect user to the menu once they loggin in successfully-->
  <script src="../src/js/submit_form.js"></script>
  <!--style sheet for the login page-->
  <link href="login_styles.css" rel="stylesheet" type="text/css" />
  
  
  <style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
  </style>

</head>

<body>


<?php
//include file to send error message if field is empty or incorrect
include "../database/fixinput.php";


// Check if user is currently logged in, if yes, redirects
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
?>

  <script>redirect_page("../worker_cpanel/worker_cpanel.php")</script>

<?php
    exit();
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

//include the navigation bar
include "../navigation_bar/navigation_bar.php";
?>

 
    <div class="background">
     <div class="background_cover">
        <div class="wrapper">

      
          <font class="login" size="10">Login</font>

         <div class="adjustments">

        <span class="instruction">Please fill in your credentials to login.</span>

         

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">



            <center><div class="form-group">
                <label class="login_headings">Username</label>

                <input type="text" name="login_username" class="form-control" value="<?php echo $login_username; ?>">

                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  </center>  


            <center><div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                <label class="login_headings">Password</label>

                <input type="text" name="login_password" class="form-control" placeholder="Password">

                <span class="help-block"><?php echo $password_err; ?></span>

              </div>
            </center>

            <center><div class="form-group" >
                <input type="submit" name="login" class="login_btn" value="Login">
            </div></center>

            <span class="instruction">Don't have an account? </span>
            
            <a class="join_link" href="../create_account/signup.php">Sign up now
                <div class="link_underline"></div>
            </a>
       
        </form>

       </div>
     </div>  

</body>

</html>
