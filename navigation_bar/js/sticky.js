$(document).ready(function(){
  
  //get the current Y offset of the navigation bar
  var stickyNavbar = $(".nav").offset().top;
  
  //function for sticking the navigation bar vertically
  var stickyNav = function(){
  
    //current Y position of the screen
    var scrollY = $(window).scrollTop();
  
    //stick the title bar and the navigation bar if the horizontal scroll is greater than
    if (scrollY > stickyNavbar){
      $(".nav").addClass("stickyY");
    
    } else {
      $(".nav").removeClass("stickyY");
    }
 
  };
  
  
  stickyNav();
  
  //run the function everytime you scroll
  $(window).scroll(function(){
    stickyNav();
  });
  
});
