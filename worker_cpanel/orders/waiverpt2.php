<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../../login/login_check.php";
?>


<!-- second part of the waiver form -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Orders Pg3 - Liability Agreement</title>
  <meta name="description" content="Third Page of the Orders Form">
  <meta name="author" content="JAMH Group">
  
  <!--style sheet for the second waiver form-->
  <link rel="stylesheet" type="text/css" href="css/waiverpt2_styles.css">

  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script that will ask for user confirmation before submitting form-->
  <script src="../../src/js/form_confirmation.js"></script>
</head>
<body>

<?php
//if the user has not pressed the submit button yet
if (!isset($_POST['waiver2_submit'])){

  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>

<font class="Title">Automotive Repair Waiver</font>


<center><form name="orderForm" onsubmit="return confirmForm('orderForm', 'waiver2_submit', 'order')" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">
<span class="description_title">Work Order #:</span> 
<span class="description_value"> <?php echo $_SESSION['order_no']; ?></span><br><br><br></center>

<center><h3 class="subtitle">AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT </h3>
<h4>*Schools must retain form for 3 years*</h4>
</center>

<center>
  <table class="table_text">
    <tr>
     <center> <th>WARNING:</th></center>

        <td>BY SIGNING THIS AGREEMENT YOU GIVE UP YOUR RIGHT TO BRING A COURT ACTION TO RECOVER
COMPENSATION FOR ANY INJURY OR DEATH TO YOU OR OTHERS AND FOR DAMAGE TO YOUR 
PROPERTY ARISING DIRECTLY, INDIRECTLY OR CONSEQUENTIALLY FROM OR RELATED TO YOUR CHOICE
TO HAVE UNTRAINED STUDENTS WORK ON YOUR AUTOMOBILE</td>
    </tr>
  </table>
</center>


<center><h4 class="information_text">PRELIMINARY UNDERSTANDING</h4></center>

<ol>
  <li>
    <p>The undersigned acknowledges and agrees that while the undersigned’s automobile and all property located in or 
on the automobile is located at the School, whether indoors or outside, that the undersigned assumes all risk
of loss or damage to the automobile and the said property and further agree that:</p>

    <ol type="a">
      <li>
        <p>The undersigned is aware that untrained students will perform work on our automobile and that
allowing untrained students to do so has inherent risks and hazards, which the undersigned voluntarily
assumes; and</p>
      </li>

      <li>
        <p>The undersigned has full knowledge of the nature and extent of the risks associated with allowing 
untrained students to work on the undersigned’s automobile, the particulars of which include but are 
not limited to:</p>

        <ul>
          <li>
            <p>damage to or destruction of the automobile or any of its component parts, which damage or 
destruction will not be repaired except at my full cost and expens</p>
          </li>

          <li>
            <p>return of the automobile in an unsafe and un-road worthy condition</p>
          </li>

          <li>
            <p>death or personal injury to the undersigned or others from operation of the automobile following 
work being done on it by untrained students; and</p>
          </li>

        </ul>
      </li>

      
      <li>
        <p>The undersigned agrees that there may be unforeseen and unforeseeable risks associated with the 
undersigned’s choice to have untrained students work on the undersigned’s automobile and those risks 
although not foreseen or foreseeable are accepted, it being understood that the intent of this waiver 
and release is to cover any and all eventualities whether foreseeable or not.</p>
      </li>


    </ol>
  </li>



  <li>
    <p>Despite the above-mentioned risks and hazards, the undersigned freely and voluntarily assume such risks and 
hazards inherent in allowing untrained students to work on the undersigned’ automobile at the School</p>
  </li>
</ol><br><br><br>


<p class="description_value"> <?php echo $_SESSION['customer_initial']; ?></p>
<p class="description_title">(initial)</p> <br>

<center><h4 class="subtitle">RELEASE AND WAIVER OF LIABILITY</h4></center>


<ol>
  <li>
    <p>In consideration of the work to be done on the undersigned’s automobile, which will be done by untrained students 
of the Board
, whether the work occurs during school hours, after school hours, or at any other time, the undersigned, 
as the owner(s) of the automobile described on the attached Repair Work Order Form agree to release, indemnify 
and save harmless the Indemnified Parties
 and each of them against and from all actions damages, claims and 
demands which may be brought against the above named persons by or on behalf of the undersigned or any third 
party in respect of or arising out of any accidents which may result in injury or the death of person or damage to or loss
of property belonging to any person if such  action depends in any way, in whole or in part on work having been done 
on the 
automobile by students of the School.</p>
  </li>


  <li>
    <span>The undersigned 
acknowledges that 
the undersigned, 
having read and understood all of the contents of this 
Agreement, having taken specific note of the warning stated above, and intend to be legally bound to the contents of 
this Agreement in so signing it on 
this</span>

    <span> <?php echo date("j");?></span>

    <span>day of</span>
    <span> <?php echo date("F");?>,</span>
    
    <span> <?php echo date("Y");?></span>
  </li>

  <li>
    <p>This Agreement is complimentary to and in addition to the Repair Work Order Form to which it is attached.</p>
  </li>
</ol> <br>

<span class="Sig">Signature of Registered Owner:</span>
<button type="button" class="submit">Sign Here</button> <br>

<center><span class="Name description_title">Name(print):</span>
<span class="description_value"> <?php echo $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname']; ?></span>


<?php
//if the user is not viewing the form
if (!$_SESSION['viewForm']){
?>

<div class="button_align">
  <input type="submit"  class="submit" name="waiver2_submit" value="Submit">
</div>

<?php
} 
?>



</form>

<div class="back_align">
  <a href="waiver.php" class="back">Back</a>
</div>
</center>

<?php
//include the footer
include '../../footer/footer.php';

} else {
  
  //if user is editting the form
  if ($_SESSION['editForm']){
    
    //save the status customer email and order number
    $temp_status = $_SESSION['status'];
    $temp_email = $_SESSION['customer_email'];
    $temp_order_no = $_SESSION['order_no'];
     
    include "../../database/update/update_orders.php";
    
    
    //if the order is completed
    if ($temp_status == "complete"){
      //send a message to the site to give a notification that someon made an appointment
      include "../../database/sendmail.php";
    
    
      //subject
      $subject = "Completed Order #" . $temp_order_no;
    
      //message
      $email_message = "<strong>Your order has been completed. You can come pick up your vehicle.</strong>";
    
    
      send_mail($temp_email, $subject, $email_message);
    }

   
  //if user is inserting data
  } else {
    include "../../database/insert/insert_intake.php";
   
  }
  
  
  
  
  //notification to display when returning to the control panel
  if ($_SESSION['editForm']){
    $_SESSION['order_done'] = "edit";
  } else {
    $_SESSION['order_done'] = "insert";
  }
  
  
  
  //if the admin or worker is creating an order based an appointment, edit the status of the appointment
  if ($_SESSION['oldOrder']){
    $_SESSION['status'] = "met";
    include "../../database/update/update_appointments.php";
  }
  
  //if the user is the admin
  if ($_SESSION['admin_loggedin']){
    $_SESSION['admin_section'] = "orders";
?>
  <script> redirect_page("../../admin/admin_cpanel.php");</script>
  
<?php
  } else {
  //redirect to the orders section of the worker control panel
  $_SESSION['worker_section'] = "orders";
?>

  <script> redirect_page("../worker_cpanel.php");</script>
  
<?php
  }
}
?>
