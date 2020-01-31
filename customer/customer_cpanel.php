<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../login/login_check.php";

//reset session to check if the user is editting 
$_SESSION['editForm'] = false;

//session to identify if the user is viewing a form
$_SESSION['viewForm'] = false;

//clear saved session variable from other pages
include "../src/clear_sessions.php";

clear_order();
clear_invoice();
clear_appointments();
?>

<!-- control panel for the worker -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Welcome</title>
  
  <!--style sheet for the customer control panel-->
  <link rel="stylesheet" type="text/css" href="customer_cpanel_styles.css">
  
  
  <!--JQuery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--script use to redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../database/findRow.js"></script>
  
  <!--script to load a certain section-->
  <script src="../src/js/load_file.js"></script>
  
  <!--script to change tabs-->
  <script src="../src/js/open_tab.js"></script>  
  
</head>

<body>

<?php
//include the navigation bar
include '../navigation_bar/navigation_bar.php';
?>

<div class="customer_cpanel_window">
  <div class="background_customer_cpanel">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["customer_firstname"] . " " . $_SESSION["customer_lastname"]); ?></b>. Welcome to our site.</h1>
    
    <a href="appointments/appointment.php">Book an appointment</a>
    
    
    <div class="customer_cpanel_links">
      <a href="#"  class="a_option_link closed_tab" id="ogorders" onclick='loadFile("customer_ogorders.php"); openTab("ogorders");'>Accepted Appointments</a>
      <a href="#"  class="a_option_link closed_tab" id="porders" onclick='loadFile("customer_porders.php"); openTab("porders");'>Planned Appointments</a>
      <a href="#"  class="a_option_link closed_tab" id="rorders" onclick='loadFile("customer_rorders.php"); openTab("rorders")'>Rejected Appointments</a>
      <a href="#"  class="a_option_link closed_tab" id="corders" onclick='loadFile("customer_corders.php"); openTab("corders")'>Completed Orders</a>
      <a href="#"  class="a_option_link closed_tab" id="invoices" onclick='loadFile("customer_invoices.php"); openTab("invoices")'>Invoices</a>     
    </div>
  </div>
  
  <?php
  //opens the tab of the current section the user is on
  if ($_SESSION['customer_section'] == "invoices"){
  ?>

  <script>openTab("<?php echo 'invoices';?>");</script>

  <?php
  } else if ($_SESSION['customer_section'] == "corders"){
  ?>

  <script>openTab("<?php echo 'corders';?>");</script>

  <?php
  } else if ($_SESSION['customer_section'] == "rorders"){
  ?>

  <script>openTab("<?php echo 'rorders';?>");</script>

  <?php
  } else if ($_SESSION['customer_section'] == "porders"){
  ?>

  <script>openTab("<?php echo 'porders';?>");</script>

  <?php
  } else {
  ?>

  <script>openTab("<?php echo 'ogorders';?>");</script>

  <?php
  }
  ?>
  
  <div class="content_window">
    <div class="vertical_align_content">
      <div class="horizontal_align_content">
      
      <?php
      //default loading of the file when user comes on to the page
      if ($_SESSION['customer_section'] == "invoices"){
      ?>
      
      <script>loadFile("customer_invoices.php");</script>
      
      <?php
      } else if ($_SESSION['customer_section'] == "corders"){
      ?>
      
      <script>loadFile("customer_corders.php");</script>
      
      <?php
      } else if ($_SESSION['customer_section'] == "rorders"){
      ?>
      
      <script>loadFile("customer_rorders.php");</script>
      
      <?php
      } else if ($_SESSION['customer_section'] == "porders"){
      ?>
      
      <script>loadFile("customer_porders.php");</script>
      
      <?php
      } else {
      ?>
      
      <script>loadFile("customer_ogorders.php");</script>
      
      <?php
      }
      ?>
      
      
      </div>
    </div>
  </div>

</div>

<?php
//include the footer
include '../footer/footer.php';
?>


</body>
</html>
