      <div class="profile_menu">
        <div class="profile_button">
        
          <?php 
          //if the admin is logged in
          if ($_SESSION['admin_loggedin']){
            echo $_SESSION['admin_firstname'];
            
          //if the worker is logged in
          } else if($_SESSION['worker_loggedin']){
            echo $_SESSION['worker_firstname'];
           
          //if the customer is logged in
          } else if ($_SESSION['customer_loggedin']){
            echo $_SESSION['customer_firstname'];
          }
          ?>
          
          <i class='fas fa-caret-down profile_arrow'></i>
          <div class="nav_link_underline"></div>
        </div>
        <div class="profile_dropdown profile_dropdown_hide">
          <a class= "profile_link top_profile_link" href="#" onclick="logout();">
            Sign-Out
            <div class="nav_link_underline"></div>
          </a>
      
          <a class= "profile_link bottom_profile_link" href="#">
            User Profile
            <div class="nav_link_underline"></div>
          </a>
        </div>
      </div>
