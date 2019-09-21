<?php
if (session_start() === null){
  session_start();
}
?>

<!-- Waiver form for the intake of the vehicle -->

<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../database/initiate_session.php";


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
$waiver_date = $_SESSION['waiver_date'] = date("Y-m-d H:i:s");

//customer initial
$customer_initial = "";
save_session("customer_initial");


//how much the cost should not exceed
$exceed_cost = "";
save_session("exceed_cost");


//variables for any missing or incorrect fields
$customer_firstnameERR = $customer_lastnameERR = $customer_addressERR = $customer_emailERR = $customer_phoneERR = $customer_initialERR = $exceed_costERR = "";



//include file that will fix the user inputs that are entered
include_once "../database/fixinput.php";



//returns an error message if a field is missing or there is an incorrect input
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['waiver_submit'])){

  //firstname
  createErrMsg("waiver_submit", "first name", "customer_firstname", "customer_firstnameERR");

  //lastname
  createErrMsg("waiver_submit", "last name", "customer_lastname", "customer_lastnameERR");

  //address
  createErrMsg("waiver_submit", "address", "customer_address", "customer_addressERR");

  //email
  createErrMsg("waiver_submit", "email", "customer_email", "customer_emailERR");

  //phone
  createErrMsg("waiver_submit", "phone number", "customer_phone", "customer_phoneERR");

  //initials
  createErrMsg("waiver_submit", "initial", "customer_initial", "customer_initialERR");


  //exceed amount
  createErrMsg("waiver_submit", "amount", "exceed_cost", "exceed_costERR");

}


//check if there are any error inputs
$error_waiver1_input;

if ($customer_firstnameERR != "" or $customer_lastnameERR != "" or $customer_addressERR != "" or $customer_emailERR != "" or $customer_phoneERR != "" or $customer_initialERR != "" or $exceed_costERR != ""){
  $error_waiver1_input = true;
} else {
  $error_waiver1_input = false;
}



//ask the user to input the required fields if there are missing or incorrect fields or they have not submitted the form yet
if ($error_waiver1_input or isset($_POST['submit_intake']) and !isset($_POST['waiver_submit']) or !isset($_POST['waiver_submit']) and !isset($_POST['waiver2_submit'])){
?>

<h1>WAIVER AND RELEASE OF LIABILITY</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">


  <ul>
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

      <input type="text" name="exceed_cost" placeholder="$-Amount" value="<?php echo $_SESSION['exceed_cost'];?>">   

      <span> by   initialing here: </span>

      <input type="text" name="customer_initial" placeholder="Initial" value="<?php echo $_SESSION['customer_initial'];?>"> 
    </li>
  </ul> <br>

  <span><?php echo $exceed_costERR;?></span> <br>
  <span><?php echo $customer_initialERR;?></span> <br>


  <table>
    <tr>
      <td>
        <span>Name(Print):</span>
        <input type="text" name="customer_firstname" placeholder="Firstname" value="<?php echo $_SESSION['customer_firstname'];?>"> 
        <input type="text" name="customer_lastname" placeholder="Lastname" value="<?php echo $_SESSION['customer_lastname'];?>"> <br>
        <span><?php echo $customer_firstnameERR;?></span> <br>
        <span><?php echo $customer_lastnameERR;?></span>
      </td>

      <td>
        <span>Phone:</span>
         <input type="text" name="customer_phone" placeholder="Phone No." value="<?php echo $_SESSION['customer_phone'];?>"> <br>
         <span><?php echo $customer_phoneERR;?></span>
      </td>
    </tr>

    <tr>
      <td>
        <span>Address:</span>
        <input type="text" name="customer_address" placeholder="Address" value="<?php echo $_SESSION['customer_address'];?>"> <br>
        <span><?php echo $customer_addressERR;?></span>
      </td>
    </tr>

    <tr>
      <td>
        <span>Email:</span>
        <input type="text" name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> <br>
        <span><?php echo $customer_emailERR;?></span>
      </td>
    </tr>

    <tr>
      <td>
      </td>

      <td>
        <span>Date:</span>
        <span> <?php echo date("D j/M/Y")?></span>
      </td>
    </tr>
  </table>

<input type="submit" name="waiver_submit" value="Submit"> <br>

  <h3>[Please proceed to the 
AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT 
on next page]</h3>

</form>

<a href="intake_repair_form.php">Back</a>

<?php
} else {
  include "waiverpt2.php";
}
?>
