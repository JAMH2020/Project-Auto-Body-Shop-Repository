<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>


<!-- second part of the waiver form -->
<!DOCTYPE html>
<html>
<head>
  <!--style sheet for the second waiver form-->
  <link rel="stylesheet" type="text/css" href="css/waiverpt2_styles.css">

  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
</head>
<body>

<?php
//if the user has not pressed the submit button yet
if (!isset($_POST['waiver2_submit'])){

  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>

<font class="Title" size="10">Automotive Repair Waiver</font>


<center><form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">
<span>Work Order #:</span> 
<span> <?php echo $_SESSION['order_no']; ?></span><br></center>

<center><h3>AUTOMOTIVE SERVICES RELEASE AND WAIVER OF LIABILITY AGREEMENT </h3>
<h4>*Schools must retain form for 3 years*</h4>
</center>
<table>
  <tr>
   <center> <th>WARNING:</th></center>

    <center><td>BY SIGNING THIS AGREEMENT YOU GIVE UP YOUR RIGHT TO BRING A COURT ACTION TO RECOVER
COMPENSATION FOR ANY INJURY OR DEATH TO YOU OR OTHERS AND FOR DAMAGE TO YOUR 
PROPERTY ARISING DIRECTLY, INDIRECTLY OR CONSEQUENTIALLY FROM OR RELATED TO YOUR CHOICE
TO HAVE UNTRAINED STUDENTS WORK ON YOUR AUTOMOBILE</td>
  </tr>
</table></center>


<center><h4>PRELIMINARY UNDERSTANDING</h4></center>

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
</ol>


<p> <?php echo $_SESSION['customer_initial']; ?></p>
<p>(initial)</p> <br>

<center><h4>RELEASE AND WAIVER OF LIABILITY</h4></center>


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
<button type="button" class="button">Sign Here</button> <br>

<center><span class="Name">Name(print):</span>
<span> <?php echo $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname']; ?></span>

<button type="submit"  name="waiver2_submit" class="button">Submit</button>

</form>

<a href="waiver.php" class="back">Back</a>
</center>

<?php
//include the footer
include '../../footer/footer.php';

} else {
  echo "intake and waiver complete";
  
  //if user is editting the form
  if ($_SESSION['editForm']){
    include "../../database/update/update_orders.php";
    
   
  //if user is inserting data
  } else {
    include "../../database/insert/insert_intake.php";

  }
  
  //if the user is the admin
  if ($_SESSION['admin_loggedin']){
?>
  <script> redirect_page("../../admin/orders/check_orders.php");</script>
  
<?php
  } else {
?>

  <script> redirect_page("../worker_cpanel.php");</script>
  
<?php
  }
}
?>
