<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../../login/login_check.php";
?>

<!-- Waiver form for the intake of the vehicle -->
<!DOCTYPE html>
<html>
<head>
  <!--stylesheet of waiver form-->
  <link rel="stylesheet" type="text/css" href="css/waiver_styles.css">

  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
 
</head>
<body>

<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../../database/initiate_session.php";

//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";



//first name and last name of the customer
$customer_firstname = $customer_lastname = "";
save_session("customer_firstname");
save_session("customer_lastname");

//address of the customer
$customer_address = "";
save_session("customer_address");

//email address
$customer_email = "";
save_session("customer_email");

//phone number of the customer
$customer_phone = "";
save_session("customer_phone");

//date the form was signed
//if user is editting the page
if ($_SESSION['editForm']){
  //reformat date to YYYY-MM-DD format
  $waiver_date_format = reformat_date($_SESSION['order_date']);
  
  //create new date
  $waiver_date = date_create($waiver_date_format);

  $_SESSION['waiver_date'] = $waiver_date;
  
//if the user is inserting data
} else {

  $waiver_date = $_SESSION['waiver_date'] = date("Y-m-d H:i:s");
}

//customer initial
$customer_initial = "";
save_session("customer_initial");


//how much the cost should not exceed
$exceed_cost = "";
save_session("exceed_cost");


//variables for any missing or incorrect fields
$customer_firstnameERR = $customer_lastnameERR = $customer_addressERR = $customer_emailERR = $customer_phoneERR = $customer_initialERR = $exceed_costERR = "";



//returns an error message if a field is missing or there is an incorrect input
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['waiver_submit'])){
  
  //if the user is not making an order from an appointment or viewing the form
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
    //firstname
    createErrMsg("waiver_submit", "first name", "customer_firstname", "customer_firstnameERR");

    //lastname
    createErrMsg("waiver_submit", "last name", "customer_lastname", "customer_lastnameERR");
    
    //email
    createErrMsg("waiver_submit", "email", "customer_email", "customer_emailERR");
  
    //if the user is editting the form, check if the email editted exists
    if ($_SESSION['editForm']){
      $customer_email_exist = customer_exist($_SESSION['customer_email'], "none");
    
      if (!$customer_email_exist){
        $customer_emailERR = "This email does not exist";
      }
    }
  }
  
  
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
    //address
    createErrMsg("waiver_submit", "address", "customer_address", "customer_addressERR");

    //phone
    createErrMsg("waiver_submit", "phone number", "customer_phone", "customer_phoneERR");

    //initials
    createErrMsg("waiver_submit", "initial", "customer_initial", "customer_initialERR");
    initial_check($_SESSION['customer_initial'], $_SESSION['customer_firstname'], $_SESSION['customer_lastname'], "initial", "customer_firstnameERR", "customer_lastnameERR", "customer_initialERR");


    //exceed amount
    createErrMsg("waiver_submit", "amount", "exceed_cost", "exceed_costERR");
    check_number($_SESSION['exceed_cost'], "amount" ,"exceed_costERR");
    
  }
  

}


//check if there are any error inputs
$error_waiver1_input;

if ($customer_firstnameERR != "" or $customer_lastnameERR != "" or $customer_addressERR != "" or $customer_emailERR != "" or $customer_phoneERR != "" or $customer_initialERR != "" or $exceed_costERR != ""){
  $error_waiver1_input = true;
} else {
  $error_waiver1_input = false;
}



//ask the user to input the required fields if there are missing or incorrect fields or they have not submitted the form yet
if ($error_waiver1_input or !isset($_POST['waiver_submit'])){


  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>


<font class="Title" size="10">WAIVER AND RELEASE OF LIABILITY</font>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

  <ul class="rule_list"> 
    <li>
      <p>I agree to release and hold the Peel District School Board (the “Board”), its trustees, officers, agents,
volunteers, students and insurers and their respective heirs, executors, personal representatives, 
successors and assigns (the “Indemnified Parties”) harmless and to indemnify them from and 
against all actions, damages, claims and demands which may be brought against the Indemnified 
Parties by or on behalf of the undersigned or any third party in respect of or arising out of the 
vehicle being in the possession of the Board, or out of any accidents which may result in injury or 
death of person or damage to or loss of property belonging to any person if such action depends in 
any way
      </p>
    </li>


    <li>
      <p>I agree to pay for all labour, parts, materials, supplies, environmental fees, disposal and recycling 
fees of all kinds, required to perform the work described above. Final payment is due when the
work is completed.
      </p>
    </li>



    <li>
      <p>I understand that if my automobile is not claimed by me within THIRTY (30) days after notice of 
completion of work, whether or not I have actually received notice, the automobile and all property 
therein or thereon will be deemed abandoned and disposed of as considered appropriate in the sole 
discretion of the Board with the entire proceeds from such disposal belonging to the Board as 
beneficial owner and not as a trustee for its own use absolutel
      </p>
    </li>


    <li>
      <p>I agree that any notice may be adequately given by prepaid post to the address below. I agree that
the onus of keeping up to date at all times as to the progress of and cost of the repairs to the
automobile rests solely with me.
      </p>
    </li>
    <li>
      <span>I may decline the estimated amount above and instead authorize the Board to perform the work
outlined at a cost not to exceed </span>


<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="exceed_cost" placeholder="$-Amount" value="<?php echo $_SESSION['exceed_cost'];?>">  
      
<?php
  } else {
?>

      <span class="description_title"><?php echo $_SESSION['exceed_cost'];?></span>
      
<?php
  }
?>


      <span> by   initialing here: </span>

<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="customer_initial" placeholder="Initial" value="<?php echo $_SESSION['customer_initial'];?>"> 
      
<?php
  } else {
?>

      <span class="description_title"><?php echo $_SESSION['customer_initial'];?></span>
      
<?php
  }
?>
    </li>
  </ul> <br>
  
  <span class="error_message"><?php echo $exceed_costERR;?></span> <br>
  <span class="error_message"><?php echo $customer_initialERR;?></span> <br>



<div class="box">

  <center>
   <table>

    <tr>
      <td>
        <center class="space">
        
          <span class="description_title">Name(Print):</span>
         
<?php
  //if the user is not making an order from an appointment or viewing the form
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>
          <input type="text" name="customer_firstname" placeholder="Firstname" value="<?php echo $_SESSION['customer_firstname'];?>"> 
          <input type="text" name="customer_lastname" placeholder="Lastname" value="<?php echo $_SESSION['customer_lastname'];?>"> <br>
          
<?php
  } else {
?>

          <span class="description_value"><?php echo $_SESSION['customer_firstname'];?></span>
          <span class="description_value"><?php echo $_SESSION['customer_lastname'];?></span> <br>

<?php
  }
?>
          
          <span class="error_message"><?php echo $customer_firstnameERR;?></span> <br>
          <span class="error_message"><?php echo $customer_lastnameERR;?></span>
          
         </center>
      </td>



      <td>
        <center class="spacep" ><span class="description_title">Phone:</span>
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
         <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required name="customer_phone" placeholder="Phone No." value="<?php echo $_SESSION['customer_phone'];?>"> <br>
         <span class="description_title">Format:</span>
         <span class="description_value">123-456-7890</span><br>
<?php
  } else {
?>
         <span class="description_value"><?php echo $_SESSION['customer_phone'];?></span> <br>
         
<?php
  }
?>
         <span class="error_message"><?php echo $customer_phoneERR;?></span></center>
      </td>
    </tr>



    <tr>
      <td>
        <center class="spaceA description_title"><span>Address:</span>
        
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
        <input type="text" name="customer_address" placeholder="Address" value="<?php echo $_SESSION['customer_address'];?>"> <br>
        
<?php
  } else {
?>

        <span class="description_value"><?php echo $_SESSION['customer_address'];?></span><br>
        
<?php
  }
?>
        <span class="error_message"><?php echo $customer_addressERR;?></span></center>
      </td>
    </tr>


    <tr>
      <td>
        <center><span class="description_title">Email:</span>
        
<?php
 //if the user is not making an order from an appointment
 if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>
        <input type="email" name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> <br>
        
<?php
  } else {
?>

        <span class="description_value"><?php echo $_SESSION['customer_email'];?></span> <br>
        
<?php
  }
?>
        <span class="error_message"><?php echo $customer_emailERR;?></span></center>
      </td>
    </tr>


    <tr>
      <td>
      </td>

      <td>
        <center class="date">
          <span class="description_title">Date:</span>
<?php
// if the user is editting the form
if ($_SESSION['editForm']){
?>
        <span class="description_value"> <?php echo date_format($waiver_date, "D j/M/Y"); ?></span>
 
<?php
} else {
?>

        <span class="description_value"> <?php echo date("D j/M/Y"); ?></span>
        
<?php
}
?>

       </center>
      </td>
    </tr>

  </table>
 </center>
</div>


<?php
  //if the user is not viewing the page
  if (!$_SESSION['viewForm']){
?>

<input type="submit" name="waiver_submit" class="button" value="Submit">

<?php
} else {
?>

<input type="submit" name="waiver_submit" class="button" value="Next">

<?php
}
?>

<center>
  <h3>[Please proceed to the 
AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT 
on next page]</h3>
</center>


</form>

<a href="intake_repair_form.php" class="back">Back</a>


<?php
//include the footer
include '../../footer/footer.php';

} else {
?>

<script>redirect_page("waiverpt2.php");</script>

<?php
}
?>

</body>
</html>
