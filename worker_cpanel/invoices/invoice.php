<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  
  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  </head>
<body>


<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../../database/initiate_session.php";
//work order number
$work_order_number = "";
save_session('work_order_number');

//customer firstname
$customer_firstname = "";
save_session('customer_firstname');

//customer lastname
$customer_lastname = "";
save_session('customer_lastname');

//customer phone number
$customer_phone_number = "";
save_session('customer_phone_number');

//customer address
$customer_address = "";
save_session('customer_address');

//customer email
$customer_email = "";
save_session('customer_email');

//customer invoice number
$customer_invoice_number = "";
save_session('customer_invoice_number');

//date invoice was created
$invoice_date = $_SESSION['invoice_date'] = date("Y-m-d H:i:s");

//car model year
$car_model_year = "";
save_session('car_model_year');

//car year make
$car_make = "";
save_session('car_make');

//car model
$car_model =  "";
save_session('car_model');

//car VIN number
$VIN = "";
save_session('VIN');

//car license plate
$car_license_plate = "";
save_session('car_license_plate');

//intake odometer reading
$intake_odometer_reading =  "";
save_session('intake_odometer_reading');

//outtake odometer reading
$return_odometer_reading =  "";
save_session('return_odometer_reading');

//description of job done
$done_description = "";
save_session('done_description');

//date of authorization of work
$authorization_date = "";
save_session('authorization_date');

//date of completion
$completion_date = "";
save_session('completion_date');

  
//vehicle return date
$return_date =  "";
save_session('return_date');

  
//parts removed or not
$removed_part_returned =  "";
save_session('removed_part_returned');



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
$parts_costs =  "";
save_session('parts_costs_');
  
//total cost of labour
$labour_costs =  "";
save_session('labour_costs');
  
//total shops supplies cost
$supplies_cost =  "";
save_session('supplies_costs');
  
//total recycling and or disposal fees
$redi_fees =  "";
save_session('redi_fees');
  
//estimated total costs
$estimated_costs =  "";
save_session('estimated_costs');
  
//Total cost of EVERYTHING
$total_cost =  "";
save_session('total_cost');
  
  
  
//errors for any missing fields in the repair intake form
$work_order_numberERR = $customer_firstnameERR = $customer_lastnameERR = $customer_phone_numberERR = $customer_addressERR = $customer_emailERR = 
$invoice_numberERR  = $car_model_yearERR = $car_makeERR = $car_modelERR = $VINERR = $car_license_plateERR = 
$intake_odometer_readingERR = $return_odometer_readingERR = $done_descriptionERR = $authorization_dateERR = $completion_dateERR = $return_dateERR = 
$removed_part_returnedERR = $parts_per_unitERR = $labour_per_unitERR = $supplies_per_unitERR = $disposal_per_unitERR=$parts_costsERR = $labour_costsERR
= $supplies_costERR = $redi_feesERR = $estimated_costsERR = $total_costERR  = "";



//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";



//returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  //customer work order number
  createErrMsg("submit_invoice", "order number", "work_order_number", "work_order_numberERR");
 
  //customer firstname
  createErrMsg("submit_invoice", "customer firstname", "customer_firstname", "customer_firstnameERR");
  
  //customer lastname
  createErrMsg("submit_invoice", "customer lastname", "customer_lastname", "customer_lastnameERR");
 
  //customer phone number
  createErrMsg("submit_invoice", "customer phone ", "customer_phone_number", "customer_phone_numberERR");
 
  //customer address
  createErrMsg("submit_invoice", "customer address", "customer_address", "customer_addressERR");
  
  //customer invoice number
  createErrMsg("submit_invoice", "invoice number", "invoice_number", "invoice_numberERR");
  
  //car model year
  createErrMsg("submit_intvoice", "car model year", "car_model_year", "car_model_yearERR");
 
  //car year make
  createErrMsg("submit_invoice", "car make ", "car_make", "car_makeERR");
 
  //car model
  createErrMsg("submit_invoice", "car model", "car_model", "car_modelERR");
 
  //car VIN number
  createErrMsg("submit_invoice", "odometer reading", "VIN", "VINERR");
  
   //car license plate
  createErrMsg("submit_invoice", "license plate", "car_license_plate", "car_license_plateERR");
  
  //intake odometer reading
  createErrMsg("submit_invoice", "intake odometer", "intake_odometer_reading", "intake_odometer_readingERR");
  
  //odometer reading when returned
  createErrMsg("submit_invoice", "return reading", "return_odometer_reading", "return_odometer_reading ERR");
  
  //description of work done
  createErrMsg("submit_invoice", "description", "done_description", "done_descriptionERR");
  
  //authorization date of work
  createErrMsg("submit_invoice", "authorization date", "authorization_date", "authorization_dateERR");
  
  //completion date of work
  createErrMsg("submit_invoice", "completion date", "completion_date", "completion_dateERR");
  
  //date when vehicle was returned
  createErrMsg("submit_invoice", "date of return", "return_date", "return_dateERR");
  
  //returned parts returned or not
  createErrMsg("submit_invoice", "removed parts returned or not", "removed_part_returned", "removed_part_returnedERR");
  
  //cost of parts per unit
  createErrMsg("submit_invoice", "cost of parts/unit", "parts_per_unit", "parts_per_unitERR");
  
  //cost of labour per unit
  createErrMsg("submit_invoice", "cost of labour/unit", "labour_per_unit", "labour_per_unitERR");
  
  //cost of shop supplies per unit
  createErrMsg("submit_invoice", "cost of supplies/unit", "supplies_per_unit", "supplies_per_unitERR");
  
  //cost of recycling/disposal per unit
  createErrMsg("submit_invoice", "cost of disposal/unit", "disposal_per_unit", "disposal_per_unitERR");
    
  //cost of parts
  createErrMsg("submit_invoice", "cost of parts", "parts_costs", "parts_costsERR");
  
  //cost of labour
  createErrMsg("submit_invoice", "cost of labout", "labour_costs", "labour_costsERR");
  
  //cost of supplies
  createErrMsg("submit_invoice", "supplies cost", "supplies_cost", "supplies_costERR");
  
  //items recycled or disposed of fees
  createErrMsg("submit_invoice", "fees of disposal or recycling", "redi_fees", "redi_feesERR");
  
  //total estimated cost
  createErrMsg("submit_invoice", "estimated costs", "estimated_costs", "estimated_costsERR");
  
  //total cost of repair
  createErrMsg("submit_invoice", "repair cost", "total_cost", "total_costERR");
  
}
  //check if there are any missing or incorrect fields
$error_intake_input;
if ($work_order_numberERR != "" or $customer_firstnameERR != "" or $customer_lastnameERR != "" or $customer_phone_numberERR != "" or $customer_addressERR != "" or $customer_emailERR != "" or $invoice_numberERR != "" 
or $car_model_yearERR != "" or $car_makeERR != "" or $car_modelERR != "" or $VINERR != "" or $car_license_plateERR != "" or $intake_odometer_readingERR != "" or $return_odometer_readingERR != "" or $done_descriptionERR != ""  
or $authorization_dateERR != "" or $completion_dateERR != "" or $return_dateERR != "" or $parts_per_unitERR != "" or $labour_per_unitERR != "" or $supplies_per_unitERR != "" or $disposal_per_unitERR != "" or $removed_part_returnedERR != ""
or $parts_costsERR  != "" or $labour_costsERR != "" or $supplies_costERR != "" or $redi_feesERR != "" or $estimated_costsERR != "" or  $total_costERR != ""){
  
  $error_invoice_input = true;
} else {
  $error_invoice_input = false;
}


//ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_intake_input  or !isset($_POST['submit_invoice'])){
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<h1>Automotive Final invoice</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<h3>Customer information</h3>
<span>Work Order #:</span>
<input type="text" name="work_order_number" placeholder="Work Order No." value="<?php echo $_SESSION['work_order_number'];?>"> <br>
<span><?php echo $work_order_numberERR;?></span> <br>


<span>Name(Print):</span>
<input type="text" name="customer_firstname" placeholder="Customer Firstname" value="<?php echo $_SESSION['customer_firstname'];?>">

<input type="text" name="customer_lastname" placeholder="Customer Lastname" value="<?php echo $_SESSION['customer_lastname'];?>">


<span>Phone:</span>
<input type="text" name="customer_phone_number" placeholder="Phone number" value="<?php echo $_SESSION['customer_phone_number'];?>"> <br>
<span><?php echo $customer_firstnameERR;?></span>
<span><?php echo $customer_lastnameERR;?></span>
<span><?php echo $customer_phone_numberERR;?></span> <br>


<span>Address:</span>
<input type="text" name="customer_address" placeholder="Customer Address" value="<?php echo $_SESSION['customer_address'];?>"> <br>
<span><?php echo $customer_addressERR;?></span> <br>

<span>Email:</span>
<input type="text" name="customer_email" placeholder="Email of customer." value="<?php echo $_SESSION['customer_email'];?>"><br>
<span><?php echo $customer_emailERR;?></span> <br>

<span>invoice #:</span>
<input type="text" name="invoice_number" placeholder="Invoice number" value="<?php echo $_SESSION['invoice_number'];?>">

<span>Date of Invoice:</span>
<span> <?php echo date("D j/M/Y")?> </span> <br>
<span><?php echo $invoice_numberERR;?></span>




<h3>Automobile repaired</h3>

<table>
  <tr>
    <td>
      <span>Car year:</span>
      <input type="text" name="car_model_year" placeholder="car year model" value="<?php echo $_SESSION['car_model_year'];?>"> <br>
      <span><?php echo $car_model_yearERR;?></span>
    </td>
    
    <td> 
      <span>VIN #:</span>
      <input type="text" name="VIN" placeholder="VIN" value="<?php echo $_SESSION['VIN'];?>"><br>
      <span><?php echo $VINERR;?></span> <br>
    </td>
  
  </tr>
  
  <tr>
    <td>
      <span>Make:</span>
      <input type="text" name="car_make" placeholder="Make" value="<?php echo $_SESSION['car_make'];?>"> <br>
      <span><?php echo $car_makeERR;?></span>
    </td>
    
    <td>
      <span>License Plate</span>
      <input type="text" name="car_license_plate" placeholder="License plate" value="<?php echo $_SESSION['car_license_plate'];?>"> <br>
      <span><?php echo $car_license_plateERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td>
      <span>Model:</span>
      <input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>"> <br>
      <span><?php echo $car_modelERR;?></span>
    </td>
    
    <td>
      <span>Odometer reading on intake:</span>
      <input type="text" name="intake_odometer_reading" placeholder="Odometer on Intake" value="<?php echo $_SESSION['intake_odometer_reading'];?>"> <br>
      <span><?php echo $intake_odometer_readingERR;?></span> <br>
    </td>
  </tr>
  
  <tr>
    <td>
    </td>
    <td>
      <span>Odometer reading on return:</span>
      <input type="text" name="return_odometer_reading" placeholder="Odometer on Return" value="<?php echo $_SESSION['return_odometer_reading'];?>"><br>
      <span><?php echo $return_odometer_readingERR;?></span>
    </td>
  </tr>
  
</table> <br>

<p>Detailed description of work performed, parts (including whether each part is a new part provided by the original equipment manufacturer, a new part not provided by the original equipment manufacturer, a used part or a reconditioned part) shop materials, environmental related, fees, disposal/recycling fees, etc.:
</p>

<span><?php echo $done_descriptionERR;?></span> <br>
<textarea name="done_description" placeholder="Description..." rows="10" columns="50" value="<?php echo $_SESSION['done_description'];?>"></textarea><br>

<span>Date of authorization of work:</span>
<input type="date" name="authorization_date" value="<?php echo $_SESSION['authorization_date'];?>">

<span>Date of completion of work:</span>
<input type="date" name="completion_date" value="<?php echo $_SESSION['completion_date'];?>"><br>
<span><?php echo $authorization_dateERR;?></span>
<span><?php echo $completion_dateERR;?></span>

<span>Date vehicle was returned:</span>
<input type="date" name="return_date" placeholder="Date of return" value="<?php echo $_SESSION['return_date'];?>"> <br>
<span><?php echo $return_dateERR;?></span> <br>

<span>Any parts removed in the course of work on or repairs to the automobile shall be (select one): </span>
<select name="removed_part_returned" value="<?php echo $_SESSION['removed_part_returned'];?>">
  <option value="A">(A) return to the undersigned</option>
  <option value="B">(B) disposed of by the School</option>
</select>
 
<table>
  <tr>
    <th>TOTAL COST</th>
    <th>Price Per Unit</th>
    <th>Line Total</th>
  </tr>
  
  <tr>
    <td>PARTS:</td>
    
    <td>
      <input type="text" name="parts_per_unit" placeholder="$ -Parts/Unit" value="<?php echo $_SESSION['parts_per_unit'];?>"><br>
      <span><?php echo $parts_per_unitERR;?></span>
    </td>
    
    <td>
      <input type="text" name="parts_costs" placeholder="$ -Parts Total" value="<?php echo $_SESSION['parts_costs'];?>"><br>
      <span><?php echo $parts_costsERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td>LABOUR:</td>
    <td>
      <input type="text" name="labour_per_unit" placeholder="$ -Labour/Unit" value="<?php echo $_SESSION['labour_per_unit'];?>"><br>
      <span><?php echo $labour_per_unitERR;?></span>
    </td>
    
    <td>
      <input type="text" name="labour_costs" placeholder="$ -Labour Total" value="<?php echo $_SESSION['labour_costs'];?>"><br>
      <span><?php echo $labour_costsERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td>SHOP SUPPLIES:</td>
    <td>
      <input type="text" name="supplies_per_unit" placeholder="$ -Supplies/Unit" value="<?php echo $_SESSION['supplies_per_unit'];?>"><br>
      <span><?php echo $supplies_per_unitERR;?></span>
    </td>
    
    <td>
      <input type="text" name="supplies_cost" placeholder="$ -Supplies Total" value="<?php echo $_SESSION['supplies_cost'];?>"><br>
      <span><?php echo $supplies_costERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td>RECYCLING/ DISPOSAL FEE:</td>
    <td>
      <input type="text" name="disposal_per_unit" placeholder="$ -Disposal/Unit" value="<?php echo $_SESSION['disposal_per_unit'];?>"><br>
      <span><?php echo $disposal_per_unitERR;?></span>
    </td>
    
    <td>
      <input type="text" name="redi_fees" placeholder="$ -Disposal Total" value="<?php echo $_SESSION['redi_fees'];?>"><br>
      <span><?php echo $redi_feesERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td>ESTIMATED OR AUTHORIZED COST:</td>
    <td></td>
    <td>
      <input type="text" name="estimated_costs" placeholder="$ -Estimated Total" value="<?php echo $_SESSION['estimated_costs'];?>"><br>
      <span><?php echo $estimated_costsERR;?></span>
    </td>
  </tr>
  
  <tr>
    <td>TOTAL COST:</td>
    <td></td>
    <td>
      <input type="text" name="total_cost" placeholder="$ -Total" value="<?php echo $_SESSION['total_cost'];?>"><br>
      <span><?php echo $total_costERR;?></span>
    </td>
  </tr>

</table> <br>
  

<input type="submit" name="submit_invoice" value="Submit">

</form>

<a href="../worker_cpanel.php">Back</a>

<?php
} else {
  echo "done";
  //insert the user sign up data into the accounts table in the database
  include "../../database/insert/insert_invoice.php";
}
?>

</body>
</html>
