<?php 
	require('./includes/constants.php');
	require('./includes/functions.php');
	require('./includes/db.php');
  ob_start();	//output buffer
  session_start(); //starts a session
  
  $message = "";
  
  if(isset($_SESSION['message'])){
	  $message = $_SESSION['message'];
  unset($_SESSION['message']);
  }
	  

 ?>
 	<!--
		Name: Hector Mariscal, Bo Zheng, Michelle Kirkwood
		Group: 09
		File: index.php
		Date: Oct 4, 2018
		Description: This is the header file for group 09's real estate website.This site's css pages take inspiration from the website https://www.free-css.com
	-->
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link  href= "./css/ydhstylesheet.css" rel="stylesheet" type= "text/css" /> 
	<link  href= "./css/webd3201" rel="stylesheet" type= "text/css" />
	<title>Your Dream Homeindex</title>

</head>
<body>


<!-- Header Starts -->
<div class="navbar-wrapper">

        <div class="navbar-inverse">
          <div class="container">
            <div class="navbar-header">


              <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>
          </div>


            <!-- Nav Starts -->
            <a href="index.php"><img src="images/logo.png" alt="Realestate"/></a>
              <ul class="nav navbar-nav navbar-right">
               <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="agents.php">Agents</a></li>         
                <li><a href="listing-search.php">Listings</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="register.php">Register</a></li>
              </ul>
            
            <!-- #Nav Ends -->
    </div>
    </div>
    
<!-- #Header Starts -->





<div class="container">

<!-- Header Starts -->
<div class="header">
<h3>Link to pages</h3>

              <ul class="pull-right">
              <li><a href="index.php">Index</a></li>
                <li><a href="welcome.php">welcome</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>         
                <li><a href="admin.php">admin</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="change-password.php">Change-password</a></li>
                <li><a href="listing-create.php">Listing Create</a></li>
                <li><a href="listing-search.php">Listing-search</a></li>
                <li><a href="listing-search-results.php">Listing-Search-Results</a></li>
				<li><a href="listing-select-city.php">listing select city</a></li>
				<li><a href="listing-images.php">Listing images</a></li>
				<li><a href="listing-update.php">listing update</a></li>
				<li><a href="password-request.php">Password request</a></li>
              </ul>
</div>
</div>