<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../../login/login_check.php";
?>

<!DOCTYPE html>
<html>
<head>
  <!--styles for the invoice page-->
  <link rel="stylesheet" type="text/css" href="invoice_styles.css">
  
  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  </head>
<body>


<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../../database/initiate_session.php";
//work order number
$order_no = "";
save_session('order_no');

//customer firstname
$customer_firstname = "";
save_session('customer_firstname');

//customer lastname
$customer_lastname = "";
save_session('customer_lastname');

//customer phone number
$customer_phone_number = "";
save_session('customer_phone');

//customer address
$customer_address = "";
save_session('customer_address');

//customer email
$customer_email = "";
save_session('customer_email');

//customer invoice number
$invoice_no = "";
save_session('invoice_no');

//date invoice was created
$invoice_date = $_SESSION['invoice_date'] = date("Y-m-d H:i:s");

//car model year
$car_year = "";
save_session('car_year');

//car year make
$car_make = "";
save_session('car_make');

//car model
$car_model =  "";
save_session('car_model');

//car VIN number
$vin_no = "";
save_session('vin_no');

//car license plate
$license_plate = "";
save_session('license_plate');

//intake odometer reading
$intake_odometer_reading =  "";
save_session('odometer_intake');

//outtake odometer reading
$odometer_return =  "";
save_session('odometer_return');

//description of job done
$done_description = "";
save_session('done_description');

//date of authorization of work
$plan_date = "";
save_session('plan_date');

//date of completion
$completion_date = "";
save_session('completion_date');

  
//vehicle return date
$return_date =  "";
save_session('return_date');

  
//parts removed or not
$removal_choice =  "";
save_session('removal_choice');



//cost of parts per unit
$parts_per_unit =  "";
save_session('parts_per_unit');

//labour cost per unit
$labour_per_unit =  "";
save_session('labour_per_unit');

//shop supplies per unit
$supplies_per_unit =  "";
save_session('supplies_per_unit');
  
//recycing/disposal fee per unit
$disposal_per_unit =  "";
save_session('disposal_per_unit');
  
  
  
//total cost of parts
$parts_total =  "";
save_session('parts_total');
  
//total cost of labour
$labour_total =  "";
save_session('labour_total');
  
//total shops supplies cost
$supplies_total =  "";
save_session('supplies_total');
  
//total recycling and or disposal fees
$disposal_total =  "";
save_session('disposal_total');
  
//estimated total costs
$estimate_total_cost =  "";
save_session('estimate_total_cost');
  
//Total cost of EVERYTHING
$total_cost =  "";
save_session('total_cost');
  
  
  
//errors for any missing fields in the repair intake form
$order_noERR = $customer_firstnameERR = $customer_lastnameERR = $customer_phoneERR = $customer_addressERR = $customer_emailERR = 
$invoice_noERR  = $car_yearERR = $car_makeERR = $car_modelERR = $vin_noERR = $license_plateERR = 
$odometer_intakeERR = $odometer_returnERR = $done_descriptionERR = $plan_dateERR = $completion_dateERR = $return_dateERR = 
$removal_choiceERR = $parts_per_unitERR = $labour_per_unitERR = $supplies_per_unitERR = $disposal_per_unitERR=$parts_totalERR = $labour_totalERR
= $supplies_totalERR = $disposal_totalERR = $estimate_total_costERR = $total_costERR  = "";



//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";



//returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
  
    //odometer reading when returned
    createErrMsg("submit_invoice", "return reading", "odometer_return", "odometer_returnERR");
    check_number($_SESSION['odometer_return'] , "return reading", "odometer_returnERR");
    
    //error if odometer return is less than odometer intake
    if ($_SESSION['odometer_return'] < $_SESSION['odometer_intake'] && is_numeric($_SESSION['odometer_return'])){
      $odometer_returnERR = "return reading must be greater or equal to the odometer reading on intake";
    }
  
  
    //description of work done
    createErrMsg("submit_invoice", "description", "done_description", "done_descriptionERR");
  
  
    //completion date of work
    createErrMsg("submit_invoice", "completion date", "completion_date", "completion_dateERR");
    system_date_limit($_SESSION['completion_date'], "completion date", "completion_dateERR" ,$_SESSION['plan_date'], "today");
  
    //date when vehicle was returned
    createErrMsg("submit_invoice", "date of return", "return_date", "return_dateERR");
    system_date_limit($_SESSION['return_date'], "date of return", "return_dateERR" ,$_SESSION['plan_date'], "today");
  
  
    //cost of parts per unit
    createErrMsg("submit_invoice", "cost of parts/unit", "parts_per_unit", "parts_per_unitERR");
    check_number($_SESSION['parts_per_unit'] , "cost of parts/unit", "parts_per_unitERR");
  
    //cost of labour per unit
    createErrMsg("submit_invoice", "cost of labour/unit", "labour_per_unit", "labour_per_unitERR");
    check_number($_SESSION['labour_per_unit'] , "cost of labour/unit", "labour_per_unitERR");
  
    //cost of shop supplies per unit
    createErrMsg("submit_invoice", "cost of supplies/unit", "supplies_per_unit", "supplies_per_unitERR");
    check_number($_SESSION['supplies_per_unit'] , "cost of supplies/unit", "supplies_per_unitERR");
  
    //cost of recycling/disposal per unit
    createErrMsg("submit_invoice", "cost of disposal/unit", "disposal_per_unit", "disposal_per_unitERR");
    check_number($_SESSION['disposal_per_unit'] , "cost of disposal/unit", "disposal_per_unitERR");
    
    //cost of parts
    createErrMsg("submit_invoice", "cost of parts", "parts_total", "parts_totalERR");
    check_number($_SESSION['parts_total'] , "cost of parts", "parts_totalERR");
  
    //cost of labour
    createErrMsg("submit_invoice", "cost of labout", "labour_total", "labour_totalERR");
    check_number($_SESSION['labour_total'] , "cost of labour", "labour_totalERR");
  
    //cost of supplies
    createErrMsg("submit_invoice", "supplies cost", "supplies_total", "supplies_totalERR");
    check_number($_SESSION['supplies_total'] , "cost of supplies", "supplies_totalERR");
  
    //items recycled or disposed of fees
    createErrMsg("submit_invoice", "fees of disposal or recycling", "disposal_total", "disposal_totalERR");
    check_number($_SESSION['disposal_total'] , "cost of disposal", "disposal_totalERR");
  
  }

}



//check if there are any missing or incorrect fields
$error_intake_input;
if ($order_noERR != "" or $customer_firstnameERR != "" or $customer_lastnameERR != "" or $customer_phoneERR != "" or $customer_addressERR != "" or $customer_emailERR != "" or $invoice_noERR != "" 
or $car_yearERR != "" or $car_makeERR != "" or $car_modelERR != "" or $vin_noERR != "" or $license_plateERR != "" or $odometer_intakeERR != "" or $odometer_returnERR != "" or $done_descriptionERR != ""  
or $plan_dateERR != "" or $completion_dateERR != "" or $return_dateERR != "" or $parts_per_unitERR != "" or $labour_per_unitERR != "" or $supplies_per_unitERR != "" or $disposal_per_unitERR != "" or $removal_choiceERR != ""
or $parts_totalERR  != "" or $labour_totalERR != "" or $supplies_totalERR != "" or $disposal_totalERR != "" or $estimate_total_costERR != "" or  $total_costERR != ""){
  
  $error_invoice_input = true;
  
} else {
  $error_invoice_input = false;
}


  //reformat all the dates into the correct format
  //authorization of work date
  if (!empty($_SESSION['plan_date'])){
    $plan_date_format = reformat_date($_SESSION['plan_date']);
  }

  //date the work was completed
  if (!empty($_SESSION['completion_date'])){
    $completion_date_format = reformat_date($_SESSION['completion_date']);
  }

  //date the car was returned
  if (!empty($_SESSION['return_date'])){
    $return_date_format = reformat_date($_SESSION['return_date']);
  }
  
  
  
  
  
  //autogenerate an invoice number if the user is making a new invoice
  if (!$_SESSION['editForm']){
    include_once "../../database/select/find_invoice_id.php";
    
    $_SESSION['invoice_no'] = generate_invoice_no($conn);
  }
  
  


//ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_invoice_input  or !isset($_POST['submit_invoice'])){
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>


<script>
function add_estimate(session, value1, value2, value3, value4){
  $("#totalCost").load("../../src/sum_price.php?session=" + session + "&p1=" + value1 + "&p2=" + value2 + "&p3=" + value3 + "&p4=" + value4);
}

</script>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<h1 class="invoice_title">Automotive Final invoice</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<h3 class="subtitle">Customer information</h3>
<span class="description_title">Work Order #:</span>
<span class="description_value"><?php echo $_SESSION['order_no'];?></span> <br>


<span class="description_title">Name(Print):</span>
<span class="description_value"><?php echo $_SESSION['customer_firstname'];?></span>

<span class="description_value"><?php echo $_SESSION['customer_lastname'];?></span>


<span class="description_title">Phone:</span>
<span class="description_value"><?php echo $_SESSION['customer_phone'];?></span><br>



<span class="description_title">Address:</span>
<span class="description_value"><?php echo $_SESSION['customer_address'];?></span><br>

<span class="description_title">Email:</span>
<span class="description_value"><?php echo $_SESSION['customer_email'];?></span><br>

<span class="description_title">invoice #:</span>
<span class="description_value"><?php echo $_SESSION['invoice_no'];?></span>

<span class="description_title">Date of Invoice:</span>
<span class="description_value"> <?php echo date("D j/M/Y")?> </span> <br>




<h3 class="subtitle">Automobile repaired</h3>

<table>
  <tr>
    <td>
      <span class="description_title">Year:</span>
      <span class="description_value"><?php echo $_SESSION['car_year'];?></span><br>
    </td>
    
    <td> 
      <span class="description_title">VIN #:</span>
      <span class="description_value"><?php echo $_SESSION['vin_no'];?></span><br>
    </td>
  
  </tr>
  
  <tr>
    <td>
      <span class="description_title">Make:</span>
      <span class="description_value"><?php echo $_SESSION['car_make'];?></span>
    </td>
    
    <td>
      <span class="description_title">License Plate</span>
      <span class="description_value"><?php echo $_SESSION['license_plate'];?></span>
    </td>
  </tr>
  
  <tr>
    <td>
      <span class="description_title">Model:</span>
      <span class="description_value"><?php echo $_SESSION['car_model'];?></span>
    </td>
    
    <td>
      <span class="description_title">Odometer reading on intake:</span>
      <span class="description_value"><?php echo $_SESSION['odometer_intake'];?></span> <br>
    </td>
  </tr>
  
  <tr>
    <td>
    </td>
    <td>
      <span class="description_title">Odometer reading on return:</span>
      
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="odometer_return" placeholder="Odometer on Return" value="<?php echo $_SESSION['odometer_return'];?>"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['odometer_return'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $odometer_returnERR;?></span>
    </td>
  </tr>
  
</table> <br>

<p class="description_title">Detailed description of work performed, parts (including whether each part is a new part provided by the original equipment manufacturer, a new part not provided by the original equipment manufacturer, a used part or a reconditioned part) shop materials, environmental related, fees, disposal/recycling fees, etc.:
</p>

<span class="error_message"><?php echo $done_descriptionERR;?></span> <br>

<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>

<textarea name="done_description" class="description_comment" placeholder="Description..." rows="10" columns="50"><?php echo $_SESSION['done_description'];?></textarea><br>

<?php
} else {
?>

<span class="description_value"><?php echo $_SESSION['done_description'];?></span><br><br>

<?php
}
?>

<span class="description_title">Date of authorization of work:</span>
<span class="description_value"><?php echo $plan_date_format;?></span>

<span class="description_title">Date of completion of work:</span>

<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>

<input type="date" name="completion_date" value="<?php echo $completion_date_format;?>">

<?php
  } else {
?>

<span class="description_value"><?php echo $completion_date_format;?></span>

<?php
  }
?>

<span class="error_message"><?php echo $completion_dateERR;?></span> <br>

<span class="description_title">Date vehicle was returned:</span>

<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>

<input type="date" name="return_date" placeholder="Date of return" value="<?php echo $return_date_format;?>"> <br>

<?php
  } else {
?>

<span class="description_value"><?php echo $return_date_format;?></span><br>

<?php
  }
?>


<span class="error_message"><?php echo $return_dateERR;?></span> <br>

<span class="description_title">Any parts removed in the course of work on or repairs to the automobile shall be (select one): </span>
<?php
//display the selected option based off the session variable
if ($_SESSION['removal_choice'] == "A"){
?>

  <span class="description_value">(A) return to the undersigned</span>

<?php
} else {
?>

  <span class="description_value">(B) disposed of by the School</span>

<?php
}
?>
 
<h3 class="subtitle">TOTAL COST</h3> 
 
<table>
  <tr>
    <th></th>
    <th class="description_title">Price Per Unit</th>
    <th class="description_title">Line Total</th>
  </tr>
  
  <tr>
    <td class="description_title">PARTS:</td>
    
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="parts_per_unit" placeholder="$ -Parts/Unit" value="<?php echo $_SESSION['parts_per_unit'];?>"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['parts_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $parts_per_unitERR;?></span>
    </td>
    
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="parts_total" placeholder="$ -Parts Total" value="<?php echo $_SESSION['parts_total'];?>" id="sum1" onkeyup="add_estimate('<?php echo 'total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['parts_total'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $parts_totalERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td class="description_title">LABOUR:</td>
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>

      <input type="text" name="labour_per_unit" placeholder="$ -Labour/Unit" value="<?php echo $_SESSION['labour_per_unit'];?>"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['labour_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $labour_per_unitERR;?></span>
    </td>
    
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="labour_total" placeholder="$ -Labour Total" value="<?php echo $_SESSION['labour_total'];?>" id="sum2" onkeyup="add_estimate('<?php echo 'total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['labour_total'];?></span><br>
      
<?php
  }
?>

      <span class="error_message"><?php echo $labour_totalERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td class="description_title">SHOP SUPPLIES:</td>
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="supplies_per_unit" placeholder="$ -Supplies/Unit" value="<?php echo $_SESSION['supplies_per_unit'];?>"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['supplies_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $supplies_per_unitERR;?></span>
    </td>
    
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="supplies_total" placeholder="$ -Supplies Total" value="<?php echo $_SESSION['supplies_total'];?>" id="sum3" onkeyup="add_estimate('<?php echo 'total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['supplies_total'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $supplies_totalERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td class="description_title">RECYCLING/ DISPOSAL FEE:</td>
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="disposal_per_unit" placeholder="$ -Disposal/Unit" value="<?php echo $_SESSION['disposal_per_unit'];?>"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['disposal_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $disposal_per_unitERR;?></span>
    </td>
    
    <td>
    
<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="disposal_total" placeholder="$ -Disposal Total" value="<?php echo $_SESSION['disposal_total'];?>" id="sum4" onkeyup="add_estimate('<?php echo 'total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"><br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['disposal_total'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $disposal_totalERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td class="description_title">ESTIMATED OR AUTHORIZED COST:</td>
    <td></td>
    <td>
      <span class="description_value"><?php echo $_SESSION['estimate_total_cost'];?></span>
    </td>
  </tr>
  
  <tr>
    <td class="description_title">TOTAL COST:</td>
    <td></td>
    <td>
      <span class="description_value" id="totalCost"><?php echo $_SESSION['total_cost'];?></span><br>
      <span class="error_message"><?php echo $total_costERR;?></span>
    </td>
  </tr>

</table> <br>
  

<?php
  //if the user is not viewing the invoice
  if (!$_SESSION['viewForm']){
?>
<input type="submit" name="submit_invoice" value="Submit">

<?php
  } else {
?>

<input type="submit" name="submit_invoice" value="Next">

<?php
  }
?>

</form>
<?php
//back button redirects to worker control panel if worker is logged in
if ($_SESSION['worker_loggedin']){

  //if the worker is editting the invoice
  if ($_SESSION['editForm']){
  
    $_SESSION['worker_section'] = "invoices";
  } else {
    $_SESSION['worker_section'] = "orders";
  }
?>

<a href="../worker_cpanel.php">Back</a>


<?php
//back button redirects to the admin check orders page if admin is logged in
} else if($_SESSION['admin_loggedin']){

  //if the admin is editting an invoice
  if ($_SESSION['editForm'] == true){
  
    $_SESSION['admin_section'] = "invoices";
?>

<a href="../../admin/admin_cpanel.php">Back</a>

<?php
  //if the admin is creating a new invoice
  } else {
    $_SESSION['admin_section'] = "orders";
?>

<a href="../../admin/admin_cpanel.php">Back</a>

<?php
   $conn = new mysqli($servername, $username, $password,$db);
   $check= "SELECT * FROM * WHERE  order_no= '$_POST[order_no]'";
   $rs = mysqli_query($conn,$check);
   $data = mysqli_fetch_array($rs, MYSQLI_NUM);
   if($data[0] > 1) {
    echo "Error, order number already exists<br/>";
   }

   else
   {
     if (mysqli_query($con))
     {
        echo "<br/>";
     }
     else
     {
        echo "Error, order number already exists<br/>";
     }
}
?>
  
<?php
   $conn = new mysqli($servername, $username, $password,$db);
   $check= "SELECT * FROM * WHERE  invoice_no= '$_POST[invoice_no]'";
   $rs = mysqli_query($conn,$check);
   $data = mysqli_fetch_array($rs, MYSQLI_NUM);
   if($data[0] > 1) {
    echo "Error, invoice number already exists<br/>";
   }
    
    else
   {
     if (mysqli_query($con))
     {
        echo "<br/>";
     }
     else
     {
        echo "Error, invoice number already exists<br/>";
     }
}
?>
  
<?php  
  }
  
//back button redirects customer to the check invoices page if the customer is logged in
} else if ($_SESSION['customer_loggedin']){

  $_SESSION['customer_section'] = "invoices";
?>

<a href="../../customer/customer_cpanel.php">Back</a>


<?php
}


//include the footer
include '../../footer/footer.php';

} else {
?>
  <script>redirect_page("invoicept2.php");</script>
  
<?php
}
?>

</body>
</html>
