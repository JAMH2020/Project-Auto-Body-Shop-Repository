<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../../login/login_check.php";
?>

<!-- 2nd part of the invoice form-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Invoice Pg2 - Agreement</title>
  <meta name="description" content="Second Page of the Invoice Form">
  <meta name="author" content="JAMH Group">
  
  <!--styles for the invoice pages-->
  <link rel="stylesheet" type="text/css" href="invoice_styles.css">

  
  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script that will ask for user confirmation before submitting form-->
  <script src="../../src/js/form_confirmation.js"></script>
  
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




//if the admin is logged in
if($_SESSION['admin_loggedin']){

  //teacher's email
  $worker_email = "";
  save_session('worker_email');
  
  
  
  //error for any missing field in the teahcer's email
  $worker_emailERR = "";
}



//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";



//returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){  
  
  
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
  
    //if the admin is logged in teacher email is required
    if($_SESSION['admin_loggedin']){
      createErrMsg("submit_invoicept2", "email", "worker_email", "worker_emailERR");
      $worker_email_exist = worker_exist($_SESSION['worker_email'], "none");
    
      //if the worker email does not exists, send an error message
      if (!$worker_email_exist){
        $worker_emailERR = "email does not exist";
      }
    
      //teacher firstname
      createErrMsg("submit_invoicept2", "firstname", "worker_firstname", "worker_firstnameERR");
  
      //teacher lastname
      createErrMsg("submit_invoicept2", "lastname", "worker_lastname", "worker_lastnameERR");
    }
  }
}



//check if there are any missing or incorrect fields
if ($worker_firstnameERR != "" or $worker_lastnameERR != ""){
  
  $error_invoicept2_input = true;
  
} else {
  $error_invoicept2_input = false;
}



//check teacher email if admin is logged on
if($_SESSION['admin_loggedin']){
  if($worker_emailERR != ""){
    $error_invoicept2_input = true;
  }
}


//ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_invoicept2_input  or !isset($_POST['submit_invoicept2'])){
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<form name="invoiceForm" onsubmit="return confirmForm('invoiceForm', 'submit_invoicept2', 'invoice')" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">
<p class="information_text">If this Invoice is not paid, and/or if the automobile is not claimed within THIRTY (30) days after notice of completion of work, it and all property therein or thereon will be deemed abandoned and disposed of as considered appropriate in the sole discretion of the Board. 
WARRANTY </p> <br>

<h3 class="information_text">WARRANTY</h3>
<p class="information_text">Notwithstanding the STUDENT AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT, for each new or reconditioned part or the labour required to install it:</p>

<ol type="i" class="information_text">
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

<h3 class="information_text">CONSUMER PROTECTION ACT, 2002</h3>
<p class="information_text">The Consumer Protection Act, 2002 (Ontario) provides you with rights in relation to having a motor vehicle repaired. Among other things, you have a right to a written estimate. A repairer may not charge an amount that is more than ten (10) per cent above that estimate. If you waived your right to an estimate, the repairer must have your authorization of the maximum amount that you will pay for the repairs. The repairer may not charge more than the maximum amount you authorized. In either case, the repairer may not charge for any work you did not authorize.
</p> <br>

<p class="information_text">If you have concerns about the work or repairs performed by the repairer or about your rights or duties under the Consumer Protection Act, 2002, (Ontario) you should contact the Ministry of Consumer and Business Services.
</p> <br>


<h3 class="information_text">PEEL DISTRICT SCHOOL BOARD</h3> <br>
<span class="description_title">Teacher’s Name: </span>


<?php
//if admin is logged on
if($_SESSION['admin_loggedin']){
?>
<input type="text" class="form_control" name="worker_firstname" placeholder="firstname" value="<?php echo $_SESSION['worker_firstname'];?>">

<input type="text" class="form_control" name="worker_lastname" placeholder="lastname" value="<?php echo $_SESSION['worker_lastname'];?>"> 

<input type="email" class="form_control" name="worker_email" placeholder="email" value="<?php echo $_SESSION['worker_email'];?>"> 

<?php
} else {
?>

<span class="description_value"><?php echo $_SESSION['worker_firstname'];?></span>
<span class="description_value"><?php echo $_SESSION['worker_lastname'];?></span>

<?php
}
?>

<br>

<span class="error_message"><?php echo $worker_firstnameERR;?></span>
<span class="error_message"><?php echo $worker_lastnameERR;?></span> 


<?php
//if admin is logged on
if($_SESSION['admin_loggedin']){
?>

<span class="error_message"><?php echo $worker_emailERR;?></span>

<?php
}
?>


<br>

<p class="information_text">I have authority to bind the Board. E. & O. Excepted </p>


<h3 class="information_text">ACKNOWLEDGEMENT</h3>
<p class="information_text">The foregoing is acknowledged and accepted by the undersigned.
</p>

<span class="information_text">Signature of Registered Owner: </span>
<button type="button" class="submit">Sign Here</button> <br>


<span class="information_text">Name (Print): </span>
<span class="description_value"> <?php echo $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname']; ?> </span> <br>


<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>

<div class="button_align">
  <input type="submit" class="submit" name="submit_invoicept2" value="Submit" class="information_text"> <br>
</div>

<?php
  }
?>

</form>

<div class="back_align">
  <a href="invoice.php" class="back">Back</a>
</div>

<?php
//include the footer
include '../../footer/footer.php';

} else {

 //if the user is editting the form
 if ($_SESSION['editForm']){
   include "../../database/update/update_invoices.php";
   
   
   
 //if the user is inserting the form
 } else {
 
   //create the message and subject for sending the email to the customer
   $subject = "Order Invoice #" . $_SESSION['invoice_no'];
    
   //message
   $email_message = "<style>
                       .heading{
                         color:rgb(0, 102, 153);
                         font-weight: bold;
                         padding: 12px;
                       }
                       
                       .description_title{
                         font-weight: bold;
                         padding: 3px 8px;
                       }
                       
                       .description_value{
                         padding: 3px;
                       }
                     </style>
                     <strong>The invoice for your order is completed. Please visit </strong> <a href='http://www.portcreditautobodyshop.tk'>www.portcreditautobodyshop.tk</a> <strong> or see below to look at your invoice:</strong><br><br>
                     <h1 class='heading'>Automotive Final invoice</h1>
                     <h3 class='heading'>Customer information</h3>
                     <span class='description_title'>Work Order #:</span><span class='description_value'>" . $_SESSION['order_no'] ."</span><br>
                     <span class='description_title'>Name(Print):</span><span class='description_value'>" . $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname'] . "</span>
                     <span class='description_title'>Phone:</span><span class='desciption_value'>" . $_SESSION['customer_phone'] ."</span><br>
                     <span class='description_title'>Address:</span><span class='description_value'>" . $_SESSION['customer_address'] . "</span><br>
                     <span class='description_title'>Email:</span><span class='description_value'>" . $_SESSION['customer_email'] ."</span> <br>
                     <span class='description_title'>invoice #:</span><span class='description_value'>" . $_SESSION['invoice_no'] . "</span>
                     <span class='description_title'>Date of Invoice:</span><span class='description_value'>" . date("D j/M/Y") . "</span>
                     
                     <h3 class='heading'>Automobile repaired</h3>
                     <table>
                       <tr>
                         <td>
                           <span class='description_title'>Year:</span><span class='description_value'>" . $_SESSION['car_year'] . "</span>
                          </td>
                          <td> 
                            <span class='description_title'>VIN #:</span><span>" . $_SESSION['vin_no'] ."</span> <br>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span class='description_title'>Make:</span><span class='description_value'>" . $_SESSION['car_make'] ."</span>
                          </td>
                          <td>
                            <span class='description_title'>License Plate</span><span class='description_value'>" . $_SESSION['license_plate'] . "</span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span class='description_title'>Model:</span><span class='description_value'>" . $_SESSION['car_model'] ."</span>
                          </td>
                          <td>
                            <span class='description_title'>Odometer reading on intake:</span><span class='description_value'>" . $_SESSION['odometer_intake'] ."</span><br>
                          </td>
                        </tr>
                        <tr>
                          <td>
                          </td>
                          <td>
                            <span class='description_title'>Odometer reading on return:</span><span class='description_value'>" . $_SESSION['odometer_return'] ."</span>
                          </td>
                        </tr>
                      </table> <br>
                      <p class='description_title'>Detailed description of work performed, parts (including whether each part is a new part provided by the original equipment manufacturer, a new part not provided by the original equipment manufacturer, a used part or a reconditioned part) shop materials, environmental related, fees, disposal/recycling fees, etc.:
                      </p><br>
                      <span class='description_value'>" . $_SESSION['done_description'] ."</span><br><br                    
                      <span class='description_title'>Date of authorization of work:</span><span class='description_value'>" . $_SESSION['plan_date'] ."</span>
                      <span class='description_title'>Date of completion of work:</span><span class='description_value'>" . $_SESSION['completion_date'] ."</span><br>
                      <span class='description_title'>Date vehicle was returned:</span><span class='description_value'>" . $_SESSION['return_date'] ."</span><br>                     
                      <span class='description_title'>Any parts removed in the course of work on or repairs to the automobile shall be (A:return to the undersigned, B:disposed of by the School) </span><span class='description_value'>" . $_SESSION['removal_choice'] ."</span>
                      <h3 class='heading'>TOTAL COST</h3>
                      <table>
                        <tr>
                          <th></th>
                          <th class='description_title'>Price Per Unit</th>
                          <th class='description_title'>Line Total</th>
                        </tr>
                        <tr>
                          <td class='description_title'>PARTS:</td>
                          <td>
                            <span class='description_value'>". $_SESSION['parts_per_unit'] ."</span>
                          </td>
                          <td class='description_value'>" . $_SESSION['parts_total'] . "</span>
                          </td>
                        </tr>
                        <tr>
                          <td class='description_title'>LABOUR:</td>
                          <td>
                            <span class='description_value'>" . $_SESSION['labour_per_unit'] ."</span>
                          </td>
                          <td>
                            <span class='description_value'>" . $_SESSION['labour_total'] . "</span>
                          </td>
                        </tr>
                        <tr>
                          <td class='description_title'>SHOP SUPPLIES:</td>
                          <td>
                            <span class='description_value'>" . $_SESSION['supplies_per_unit'] ."</span>
                          </td>
                          <td>
                            <span class='description_value'>" . $_SESSION['supplies_total'] . "</span>
                          </td>
                        </tr>
                        <tr>
                          <td class='description_title'>RECYCLING/ DISPOSAL FEE:</td>
                          <td>
                            <span class='description_value'>" . $_SESSION['disposal_per_unit'] ."</span>
                          </td>
                          <td>
                            <span class='description_value'>" . $_SESSION['disposal_total'] . "</span>
                          </td>
                        </tr>
                        <tr>
                          <td class='description_title'>ESTIMATED OR AUTHORIZED COST:</td>
                          <td></td>
                          <td>
                            <span class='description_value'>" . $_SESSION['estimate_total_cost'] . "</span>
                          </td>
                        </tr>
                        <tr>
                          <td class='description_title'>TOTAL COST:</td>
                          <td></td>
                          <td>
                            <span class='description_value'>" . $_SESSION['total_cost'] . "</span>
                          </td>
                        </tr>
                      </table> <br> <br> <br> <br>
                      
                      <p>If this Invoice is not paid, and/or if the automobile is not claimed within THIRTY (30) days after notice of completion of work, it and all property therein or thereon will be deemed abandoned and disposed of as considered appropriate in the sole discretion of the Board.</p>
                      <h3 class='heading'>WARRANTY</h3>
                      <p>Notwithstanding the STUDENT AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT, for each new or reconditioned part or the labour required to install it:</p>
                      <ol type='i'>
                        <li>
                          <p>the Board warrants the part and/or labour for a minimum of 90 days or 5,000 kilometers, whichever comes first,</p>
                        </li>
                        <li>
                          <p>the warranty set out in subparagraph i. is provided under the Consumer Protection Act, 2002 (Ontario) and may not be waived by the consumer, and </p>
                        </li>
                        <li>
                          <p>the warranty set out in subparagraph i. does not apply to, </p>
                            <ol type='A'>
                              <li>
                                <p> fluids, filters, lights, tires or batteries, or </p>
                              </li>
                              <li>
                                <p>a part that was not warranted by the manufacturer of the vehicle when the vehicle was sold as new.</p>
                              </li>
                            </ol>
                         </li>
                        </ol>
                        <h3 class='heading'>CONSUMER PROTECTION ACT, 2002</h3>
                        <p>The Consumer Protection Act, 2002 (Ontario) provides you with rights in relation to having a motor vehicle repaired. Among other things, you have a right to a written estimate. A repairer may not charge an amount that is more than ten (10) per cent above that estimate. If you waived your right to an estimate, the repairer must have your authorization of the maximum amount that you will pay for the repairs. The repairer may not charge more than the maximum amount you authorized. In either case, the repairer may not charge for any work you did not authorize.</p> <br>
                        <p>If you have concerns about the work or repairs performed by the repairer or about your rights or duties under the Consumer Protection Act, 2002, (Ontario) you should contact the Ministry of Consumer and Business Services.</p> <br>                       
                        <h3 class='heading'>PEEL DISTRICT SCHOOL BOARD</h3> <br>
                        <span class='description_title'>Teacher’s Name: <span><span class='description_value'>" . $_SESSION['worker_firstname'] . " " . $_SESSION['worker_lastname'] . "</span> <br>
                        <h3 class='heading'>ACKNOWLEDGEMENT</h3>
                        <p>The foregoing is acknowledged and accepted by the undersigned.</p>                                               
                        <span class='description_title'>Name (Print): </span><span>" . $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname'] . "</span>";


   include "../../database/update/update_order_status.php";
   include "../../database/insert/insert_invoice.php";
   
   
   //send a message to the site to give a notification that someon made an appointment
   include "../../database/sendmail.php";
    
   send_mail($temp_email, $subject, $email_message);
 }
 
 
 
 //notification display for the control panel
 if ($_SESSION['editForm']){
   $_SESSION['invoice_done'] = "edit";
 } else {
   $_SESSION['invoice_done'] = "insert";
 }
 
   
 //if the worker is logged int
 if($_SESSION['worker_loggedin']){
 
   //redirect page to worker check invoices page if they are editting the invoices
   if ($_SESSION['editForm']){ 
     $_SESSION['worker_section'] = "invoices";
   } else {
     $_SESSION['worker_section'] = "orders";
   }
?>

   <script>redirect_page("../worker_cpanel.php");</script>

<?php 
  } else if($_SESSION['admin_loggedin']){
    
    //redirect page to the admin check invoices page if they are editting the invoices
    if ($_SESSION['editForm']){
      $_SESSION['admin_section'] = "invoices";
      
    //redirect page to the admin check orders page if they are creating an invoice
    } else {
      $_SESSION['admin_section'] = "orders";
    }
?>
    <script>redirect_page("../../admin/admin_cpanel.php");</script>
    
<?php
  }
}
?>

</body>
</html>
