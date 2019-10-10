<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!-- 2nd part of the invoice form-->
<!DOCTYPE html>
<html>
<head>
  <!--styles for the invoice pages-->
  <link rel="stylesheet" type="text/css" href="invoice_styles.css">

  
  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  </head>
<body>


<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../../database/initiate_session.php";

//teacher's name
$worker_firstname = "";
save_session('worker_firstname');

//teacher's name
$worker_lastname = "";
save_session('worker_lastname');
  
    
//errors for any missing fields in the invoice form
$worker_firstnameERR = $worker_lastnameERR = "";



//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";



//returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  //teacher firstname
  createErrMsg("submit_invoicept2", "firstname", "worker_firstname", "worker_firstnameERR");
  
  //teacher lastname
  createErrMsg("submit_invoicept2", "lastname", "worker_lastname", "worker_lastnameERR");
}



//check if there are any missing or incorrect fields
if ($worker_firstnameERR != "" or $worker_lastnameERR != ""){
  
  $error_invoicept2_input = true;
  
} else {
  $error_invoicept2_input = false;
}


//ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_invoicept2_input  or !isset($_POST['submit_invoicept2'])){
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">
<p>If this Invoice is not paid, and/or if the automobile is not claimed within THIRTY (30) days after notice of completion of work, it and all property therein or thereon will be deemed abandoned and disposed of as considered appropriate in the sole discretion of the Board. 
WARRANTY </p> <br>

<h3>WARRANTY</h3>
<p>Notwithstanding the STUDENT AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT, for each new or reconditioned part or the labour required to install it:</p>

<ol type="i">
  <li>
     <p>the Board warrants the part and/or labour for a minimum of 90 days or 5,000 kilometers, whichever comes first,</p>
  </li>
  
  <li>
    <p>the warranty set out in subparagraph i. is provided under the Consumer Protection Act, 2002 (Ontario) and may not be waived by the consumer, and </p>
  </li>
  
  <li>
    <p>the warranty set out in subparagraph i. does not apply to, </p>
    
    <ol type="A">
      <li>
        <p> fluids, filters, lights, tires or batteries, or </p>
      </li>
      
      <li>
        <p>a part that was not warranted by the manufacturer of the vehicle when the vehicle was sold as new.</p>
      </li>
    </ol>
    
  </li>
  
</ol>

<h3>CONSUMER PROTECTION ACT, 2002</h3>
<p>The Consumer Protection Act, 2002 (Ontario) provides you with rights in relation to having a motor vehicle repaired. Among other things, you have a right to a written estimate. A repairer may not charge an amount that is more than ten (10) per cent above that estimate. If you waived your right to an estimate, the repairer must have your authorization of the maximum amount that you will pay for the repairs. The repairer may not charge more than the maximum amount you authorized. In either case, the repairer may not charge for any work you did not authorize.
</p> <br>

<p>If you have concerns about the work or repairs performed by the repairer or about your rights or duties under the Consumer Protection Act, 2002, (Ontario) you should contact the Ministry of Consumer and Business Services.
</p> <br>


<h3>PEEL DISTRICT SCHOOL BOARD</h3> <br>
<span>Teacher’s Name: <span>
<input type="text" name="worker_firstname" placeholder="firstname" value="<?php echo $_SESSION['worker_firstname'];?>">

<input type="text" name="worker_lastname" placeholder="lastname" value="<?php echo $_SESSION['worker_lastname'];?>"> <br>

<span><?php echo $worker_firstnameERR;?></span>
<span><?php echo $worker_lastnameERR;?></span> <br>

<p>I have authority to bind the Board. E. & O. Excepted </p>


<h3>ACKNOWLEDGEMENT</h3>
<p>The foregoing is acknowledged and accepted by the undersigned.
</p>

<span>Signature of Registered Owner: </span>
<button type="button">Sign Here</button> <br>


<span>Name (Print): </span>
<span> <?php echo $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname']; ?> </span> <br>

<input type="submit" name="submit_invoicept2" value="Submit"> <br>

</form>

<a href="invoice.php">Back</a>

<?php
//include the footer
include '../../footer/footer.php';

} else {

 echo "done";
 
 
 //insert the data into the database
 include "../../database/insert/insert_invoice.php";
   
 //if the worker is logged int
 if($_SESSION['worker_loggedin']){
 
   //redirect page to worker control panel if worker is logged int
?>

   <script>redirect_page("../worker_cpanel.php");</script>

<?php 
  } else if($_SESSION['admin_loggedin']){
    //redirect page to the admin check order page if the admini is logged in
?>
    <script>redirect_page("../../admin/orders/check_orders.php");</script>
    
<?php
  }
}
?>

</body>
</html>
