
<link rel="stylesheet" type="text/css" href="http://www.portcreditautobodyshop.tk/navigation_bar/navigation_bar_styles.css">

<!--Google Titillium font-->
<link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">


<!--JQuery library-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--script for sticky element-->
<script src="http://www.portcreditautobodyshop.tk/navigation_bar/js/sticky.js"></script>

<!--script for loading another page-->
<script src="http://www.portcreditautobodyshop.tk/src/js/load_file.js"></script>

<!--script for the dropdown menu of the user profile-->
<script src="http://www.portcreditautobodyshop.tk/navigation_bar/js/profile_dropdown.js"></script>

<!--script for hovering on tablets or phone-->
<script src="http://www.portcreditautobodyshop.tk/src/js/can_touch.js"></script>

<!--font awesome icons-->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!--Google Icons-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <div class="title_bar" id="stickyTitleX">
      <div class ="title">
        <span class="title-heading title_front">Port Credit</span>
        <span class="title-heading title_back">Auto Repair Shop</span>
      </div> 

      <div class="site_information">
        <div class ="phone">
          <span class="phone-heading title_details">(905) 278-3382 </span> 
        </div>
      </div>

      <div class="site_information">
        <div class ="address">
          <span class="address-heading title_details"> 70 Mineola Rd E, Mississauga, ON L5G 2E5 </span>
        </div>
      </div>
      
      <?php
      //display the profile section if the user is logged in
      if ($_SESSION['customer_loggedin'] || $_SESSION['worker_loggedin'] || $_SESSION['admin_loggedin']){
          include '/srv/disk13/3148213/www/portcreditautobodyshop.tk/navigation_bar/user_profile.php';
      }
      ?>
    </div>
    
    


    <div class="filler_nav filler_hide">
    </div>

    <div class="nav" id="stickyNavX">

      <a  class= "left_nav_link" href="/index.php">
        <div class="nav_link_underline"></div>
        Home
        <div class="nav_link_underline"></div>
      </a>

    
      <a class = "nav_link" href="/create_account/signup.php">
        <div class="nav_link_underline"></div>
        Sign-Up
        <div class="nav_link_underline"></div>
      </a>


      <a class= "nav_link "href="/login/login.php">
        <div class="nav_link_underline"></div>
        
        <?php
        //if the user is loggedin go to the dashboard
        if ($_SESSION['admin_loggedin'] || $_SESSION['worker_loggedin'] || $_SESSION['customer_loggedin']){
          echo "Dashboard";
        } else {
          echo "Sign In";
        }
        
        ?>
        <div class="nav_link_underline"></div>
      </a>

    </div>
    <div class="logout"></div>

  


