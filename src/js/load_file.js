/*****************************************************
 *  function to use AJAX to load PHP for the section *
 *****************************************************/
 
 
function loadFile(url){
  $(".content_window").load(url);
}

function logout(){
  $(".logout").load('/login/logout.php')
}