<?php
//start the session to remember the session variables
session_start();
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Contact Us!</title>
  <meta name="description" content="Contact us Using Email">
  <meta name="author" content="JAMH Group">
  
  <!--style sheet for the email form-->
  <link rel="stylesheet" type="text/css" href="email_styles.css">


  <!--script that will display message that user has sent mail-->
  <script src="../src/js/display_notification.js"></script>
 
</head>
<body>
<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../database/initiate_session.php";



//email address
$asker_email = "";
save_session("asker_email");


//question or comment of the user
$asker_comment = "";
save_session("asker_comment");


//errors for any missing fields in the repair intake form
$asker_emailERR = $asker_commentERR = "";


//if the user is loggedin, use their email address
if ($_SESSION["admin_loggedin"]){
  $_SESSION["asker_email"] = $_SESSION["admin_email"];
  
} else if ($_SESSION["worker_loggedin"]){

  $_SESSION["asker_email"] = $_SESSION["worker_email"];
  
} else if ($_SESSION["customer_loggedin"]){

  $_SESSION["asker_email"] = $_SESSION["customer_email"];

}



//include file that will fix the user inputs that are entered
include_once "../database/fixinput.php";


//returns an error message if a field is missing

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  //email address
  createErrMsg("submit_comment", "email address", "asker_email", "asker_emailERR");

  //question or comment
  createErrMsg("submit_comment", "comment", "asker_comment", "asker_commentERR");
  
}



//check if there are any missing or incorrect fields
$error_comment_input;

if ($asker_emailERR != "" or $asker_commentERR != ""){
 
 $error_comment_input = true;
 
} else {
  $error_comment_input = false;
}



//include the navigation bar
include "../navigation_bar/navigation_bar.php";
?>

<div class="notification_box">
  <span class="email_notification">
    <i class='fas fa-check-circle sent_icon'></i>
    Your Comment Has Been Successfully Sent!
  </span>
</div>

<div class="contacts_title_box">
  <h1 class="contacts_title">Contact us!</h1>
</div>


<div class="background">
  <div class="background_cover">
    <div class="box">
      <div class="comment_description_center">
        <span class="comment_description">If you have any questions or concerns, please feel free to comment down below</span>
      </div>
      
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">
      
        <div class="form_group">
          <span class="description_title">Email:</span>
          <input type="email" name="asker_email"  class="form_control" placeholder="Email" value="<?php echo $_SESSION['asker_email'];?>"> <br>
          <span class="error_message"><?php echo $asker_emailERR;?></span> <br>
        </div>
  
        <div class="form_group">
          <span class="description_title">Comment:</span> <br>
          <span class="error_message"><?php echo $asker_commentERR;?></span> <br>
          <textarea name="asker_comment" class="description_comment form_control" placeholder="Comment..." rows="8" cols="50"></textarea><br>
        </div>
        
        <div class="comment_description_center">
          <input class="button send"type="submit" name="submit_comment" value="Submit"><br>
        </div>
      
      </form>
    
    </div>
  </div>
</div>


<?php
  //include the footer
  include '../footer/footer.php';

//send message only when the required fields are filled and the user presses the submit button
if (!$error_comment_input  && isset($_POST['submit_comment'])){

    //temporary variables for the message before its session gets erased
    $temp_email = $_SESSION['asker_email'];
    $temp_description = $_SESSION['asker_comment'];
    
    
    //send a message to the site to give a notification that someon made an appointment
    include "../database/sendmail.php";
    
    
    
    //get only the name part of the asker's email
    $asker_name = "";
    
    for ($i = strlen($temp_email) - 1; $i >= 0; $i--){
      
      //find the last "@" symbol in the email and get name before the symbol
      if ($temp_email[$i] == '@'){
        $asker_name = substr($temp_email, 0, $i);
        break;
      }
    }
    
    
    //subject
    $subject = "Comment from " . $asker_name;
    
    //message
    $email_message = "<strong style='font-size:20px; color:rgb(0, 102, 153); padding:5px 10px 20px 10px'>" . $asker_name . " from <span style='color: red'>" . $temp_email . "</span> comments:</strong> <br> 
                      <span style='padding:15px 35px; font-style: italic;'>" . $temp_description ."</span>";
                      
    
  
    
    send_mail("JAMH@portcreditautobodyshop.tk", $subject, $email_message);
    
    //clear message
    $_SESSION['asker_comment'] = "";
    
    echo $email_message;
    
//display the notification that an email has been sent
?>

<script>
show_notification("notification_box");
</script>

    
<?php
}
?>


</body>
</html>
