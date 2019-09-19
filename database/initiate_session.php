<?php
/**************************************************************************
** function used to initiate a new session if if has not already existed **
***************************************************************************/

//initiate a session if it has not been created yet
function save_session($session_name){
  if (!isset($_SESSION["$session_name"])) {
    $_SESSION["$session_name"] = "";
  }
}
?>
