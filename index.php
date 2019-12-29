<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Port Credit Auto Repair Shop</title>
    <meta name="description" content="Port Credit Secondary School's Auto Body Repair Shop">

    <meta name="keywords" content="Port Credit Secondary School, auto repair, auto body, oil change, car repair,">

    <meta name="author" content="JAMH Group">
    
    <link href="homepage_styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  
  <?php
  include 'navigation_bar/navigation_bar.php';
  //include 'database/sendmail.php';
  
  //session to identify users other than the admin is creating a new accoun
  $_SESSION['admin_create_caccount'] = 0;
  ?>

    <div class="bg"> 
      <div class="colour_cover">
        <div class="slogan_frame">
          <span class="slogan">Welcome To The Home Page</span> 
         </div>
         <svg class="service_wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path xmlns="http://www.w3.org/2000/svg" fill="#ffffff" fill-opacity="1" d="M 0 256 L 48 250.7 C 96 245 192 235 288 218.7 C 384 203 480 181 576 149.3 C 672 117 768 75 864 48 C 960 21 1056 11 1152 10.7 C 1248 11 1344 21 1392 26.7 L 1440 32 L 1440 320 L 1392 320 C 1344 320 1248 320 1152 320 C 1056 320 960 320 864 320 C 768 320 672 320 576 320 C 480 320 384 320 288 320 C 192 320 96 320 48 320 L 0 320 Z" />
        </svg>
      </div>
    </div>   


    <div class="services">
      <span class= "service_title">Services Offered</span> 

      <div class="service_items">
        <div class="service_choice">
          <div class="service_image repair_image">
            <div class="service_cover">
              <div class="service_heading">
                <span>Repair</span>
              </div>
            </div>
          </div>
        </div>

        <div class="service_choice">
          <div class="service_image oil_image">
            <div class="service_cover">
              <div class="service_heading">
                <span>Oil Change</span>
              </div>
            </div>
          </div>
        </div>

        <div class="service_choice">
          <div class="service_image consultation_image">
            <div class="service_cover">
              <div class="service_heading">
                <span>Consultation</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

 
    <div class="introduction">
      <div class="introduction_text">
        <p class="intro_title">INTRODUCTION</p> 
        <span class="Intro_Para" > Welcome to Port Credit Secondary School's Auto Shop Webpage. Port Credit Was Founded In 1920, And Its Auto Shop Is Turning 100 Years Old In 2020. It Is Our Great Pleasure To Fix Your Car Since It is Not Only A Benifit For Our Beloved Customers, But As Well As The Children Who Are Seaking To Learn All About Fixing Cars. Our Auto Shop Is Equipped With The Most Up-Todate Equipment. The Students Are Trained By A Teacher Who Is Experienced Within The Auto Field. We Garentee That You Will Not Be Disapointed.</span> 
      </div>

      <div class="introduction_image">
      </div>
    </div>
    
    <?php
    //include the footer
    include 'footer/footer.php';
    ?>
  
  
  
  </body>
</html>
