<?php
    require "header.php";
    global $conn;

    $user = isset($_SESSION['user'])?$_SESSION['user']:"";

    if($user == "" || $user['user_type'] != AGENT)
    {
    	$_SESSION['message'] = "You are not logged in as an agent";
    	redirect('./login.php');
    }


    if(!isset($_GET['listing_id']) || !is_numeric($_GET['listing_id']) || !listing_exists($_GET['listing_id']))
    {
        $_SESSION['message'] = "This listing does not exist";
        redirect('./dashboard.php');
    }else{
        $listing_id = $_GET['listing_id'];
    }

    $result = pg_execute($conn, "listing_info", array($listing_id));
    $listing = pg_fetch_assoc($result, 0);
    if($listing['user_id'] != $user['user_id'])
    {
        redirect('./login.php');
    }
    $status = isset($_GET['status'])?trim($_GET['status']):"";
    //$valid_status = check_status($status);

	require "footer.php";