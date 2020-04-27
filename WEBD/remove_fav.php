<?php
/*
Hector Mariscal
2018-12-09
WEBD3201 - Listing display
*/

  require "./header.php";
    global $conn;
    
    if(!isset($_GET['listing_id']) || !is_numeric($_GET['listing_id']) || !listing_exists($_GET['listing_id']))
    {
        $_SESSION['message'] = "Listing id was missing !!!!!!";
        redirect('./listing_search.php');
    }else{
        $listing_id = $_GET['listing_id'];     
    }
    $user_id= $_SESSION['user']['user_id'];

    if(pg_execute($conn,"fav_remove",array($user_id,$listing_id)))
    {
        redirect(("./listing_display.php?listing_id=".$listing_id));
    }

    ?>