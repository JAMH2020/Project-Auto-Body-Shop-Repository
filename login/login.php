<?php
//start the session if it has not been started yet
if (session_start() === null){
 session_start();
 session_regenerate_id(true);
}
?>

<!DOCTYPE html>

<html lang="en">

<head>  
  <meta charset="UTF-8">
  <title>Login</title>
  <!--script that will redirect user to the menu once they loggin in successfully-->
  <script src="../src/js/submit_form.js"></script>
  <!--script to show password -->
  <script src="../create_account/js/showpassword.js"></script>
  
  <!--style sheet for the login page-->
  <link href="login_styles.css" rel="stylesheet" type="text/css" />
  
  <!--<meta content="width=1200" name="viewport">
<meta content="height =900" name="viewport">-->
  
  
  
  
  <style type="text/css">
    body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
  </style>

</head>

<body>


<?php
//include file to send error message if field is empty or incorrect
include "../database/fixinput.php";


// Check if customer is currently logged in, if yes, redirects
if(isset($_SESSION["customer_loggedin"]) && $_SESSION["customer_loggedin"] === true){
?>

  <script>redirect_page("../customer/customer_cpanel.php")</script>

<?php
    exit();
    
// check if the worker is currently loggin in, if yes, redirect to worker control panel
} else if(isset($_SESSION["worker_loggedin"]) && $_SESSION["worker_loggedin"] === true){
?>

  <script>redirect_page("../worker_cpanel/worker_cpanel.php")</script>

<?php
    exit();
    
// check if the admin is currently loggin in, if yes, redirect to admin control panel
} else if(isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true){
?>

  <script>redirect_page("../admin/admin_cpanel.php")</script>


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
        
          <span class="error_message"><?php echo $loginERR; ?></span>

      
          <font class="login" size="10">Login</font>

         <div class="adjustments">

        <span class="instruction">Please fill in your credentials to login.</span>

         

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">



            <center><div class="form-group">
                <label class="login_headings">Username</label>

                <input type="text" name="login_username" class="form-control" placeholder="Username" value="<?php echo $login_username; ?>"> <br>

                <span class="error_message"><?php echo $username_err; ?></span>
            </div>  </center>  


            <center><div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                <label class="login_headings">Password</label>

                <input type="password" name="login_password" class="form-control"  id="password" placeholder="Password"><br>

                <span class="error_message"><?php echo $password_err; ?></span>

              </div>
              
              <label class="checkbox_container">
                <input type="checkbox" class="checkbox_hidden" onclick="showPassword()">
                <div class="checkmark"></div>
              <span>Show Password</span> 
             </label><br>
             
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
     
     <?php
    //include the footer
    include '../footer/footer.php';
    ?>

</body>

</html>
