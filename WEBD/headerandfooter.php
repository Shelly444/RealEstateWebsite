<?php 
  ob_start();  //output buffer
  session_start(); //starts a session
  require('./includes/constants.php');
  require('./includes/functions.php');
  require('./includes/db.php');
  

 ?>
  <!--
    Name: Hector Mariscal, Bo Zheng, Michelle Kirkwood
    Group: 09
    File: header.php
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
  <title>Your Dream Home</title>

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
            <!-- Nav Starts -->
            <a href="index.php"><img src="images/logo.png" alt="Realestate"/></a>
              <ul class="nav navbar-nav navbar-right">
               <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="agents.php">Agents</a></li>         
                <li><a href="listing.php">Listing</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="register.php">Register</a></li>
              </ul>
    </div>
  </div>
</div>

<div class="container">

<!-- Header Starts -->
<div class="header">
<h3>Link to static pages</h3>

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
        <li><a href="randomusergenerator.php">Random Users</a></li>
              </ul>
</div>
</div>
  <!--
    Name: Hector Mariscal, Bo Zheng, Michelle Kirkwood
    Group: 09
    File: footer.php
    Date: Oct 04, 2018
    Description: This is the footer file for group 09's real estate website.This site's css pages take inspiration from the website https://www.free-css.com
  -->
<!-- end of main page content -->
      
<div class="footer">

<div class="container">
<!-- start of footer -->

<div class="row">
      <div class="col-lg-3 col-sm-3">
        <h4>Information</h4>
        <ul class="row">
      <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.php">About</a></li>
      <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents.php">Agents</a></li>         
      <li class="col-lg-12 col-sm-12 col-xs-3"><a href="listing.php">Listing</a></li>
      <li class="col-lg-12 col-sm-12 col-xs-3"><a href="dashboard.php">Dashboard</a></li>
      <li class="col-lg-12 col-sm-12 col-xs-3"><a href="admin.php">Admin</a></li>
      </ul>
      </div>
        
      <div class="col-lg-3 col-sm-3">
          <h4>Follow us</h4>
            <a href="www.facebook.com"><img src="images/facebook.png" alt="facebook"/></a>
            <a href="www.twitter.com"><img src="images/twitter.png" alt="twitter"/></a>
            <a href="www.linkedin.com"><img src="images/linkedin.png" alt="linkedin"/></a>
            <a href="www.instagram.com"><img src="images/instagram.png" alt="instagram"/></a>
      </div>

      <div class="col-lg-3 col-sm-3">
          <h4>Contact us</h4>
          <p><b>Your Dream Home Inc.</b><br />
<span class="glyphicon glyphicon-map-marker"></span> 2000 Simcoe St N, Canada, Ontario<br />
<span class="glyphicon glyphicon-envelope"></span> yourdreamhome@gmail.com<br />
<span class="glyphicon glyphicon-earphone"></span> (999) 999-9999</p>
<?php echo display_copyright() ?>
      </div>
      
      <a href="http://validator.w3.org/check?uri=referer">
          <img  style="width:88px;
                height:31px;"
              src="http://www.w3.org/Icons/valid-xhtml10" 
              alt="Valid XHTML 1.0 Strict" />
        </a>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img  style="width:88px;
                  height:31px;"
                      src="http://jigsaw.w3.org/css-validator/images/vcss"
                alt="Valid CSS!" />
          </a>
        

    <!-- end of footer -->
</div>
</div>
</div>
</body>
</html>
