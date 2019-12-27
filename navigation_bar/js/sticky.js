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
      
      //put a filler space for the navigation bar
      $(".filler_nav").removeClass("filler_hide");
      $(".filler_nav").addClass("filler_show");
    
    } else {
      $(".nav").removeClass("stickyY");
      
      //hide filler space for the navigation bar
      $(".filler_nav").removeClass("filler_show");
      $(".filler_nav").addClass("filler_hide");
    }
 
  };
  
  
  stickyNav();
  
  //run the function everytime you scroll
  $(window).scroll(function(){
    stickyNav();
  });
  
});
