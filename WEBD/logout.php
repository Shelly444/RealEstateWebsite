<?php 
     
     require "./header.php";

     unset($_SESSION);
     session_destroy();
     session_name(SESSION_NAME);
     session_start("");
     $_SESSION['message'] = "You have successfully logged out.";

     redirect("./login.php");
     ob_flush();

?>