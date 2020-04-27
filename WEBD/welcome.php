

<?php
    $title = "Welcome page";
    $file = "welcome.php";
    $description = "Welcome page for logged in clients";
    $date = "Oct 01, 2018";
    $banner = "Welcome page";
    require "./header.php";
	global $conn;

/*     if(!isset($_SESSION['user']))
  {
    redirect('./login.php');
  }
  elseif($_SESSION['user']['user_type'] != CLIENT)
  {
    redirect('./login.php');
  } */
 
  $userId = $_SESSION['user']['user_id'];
  $result = pg_execute($conn, "fav_per_client",array($userId));
  $records = pg_num_rows($result);
  $output = "";
  if($records>0){
    $matches = pg_fetch_all($result);
    $total_pages = ceil((count($matches))/LISTINGS_PER_PAGE);
  }else{
    $total_pages =  0;
  }
  

  $current_page = ((isset($_GET['page']) && trim($_GET['page']) != "" && is_numeric(trim($_GET['page'])) && $_GET['page']) > 0)?ceil($_GET['page']): 1;

  if ($current_page > $total_pages) {
          $current_page = $total_pages;
      }
?>

            <h1>Welcome  Page</h1>
                <p>
                 Dear client, <?php echo $_SESSION['user']['user_id']?> welcome to Dream Home!</p>
                <p>
                Your information is below: </p>
        
        
             
            <h2>Information</h2>
                <ul >
                    <li>User ID: <?php echo $_SESSION['user']['user_id']?></li>
                    <li>Name: <?php echo $_SESSION['person']['first_name']?> <?php echo $_SESSION['person']['last_name']?></li>
                    <li>Address: <?php echo $_SESSION['person']['street_address_1']?>, <?php echo $_SESSION['person']['city']?></li>
                    <li>Postal Code: <?php echo $_SESSION['person']['postal_code']?> </li>
                    <li>Email: <?php echo $_SESSION['user']['email_address']?></li>
                    <li>Last Access Time: <?php echo $_SESSION['user']['last_access']?></li>
                    <li>Your Enrol Date: <?php echo $_SESSION['user']['enrol_date']?></li>
                    
                </ul>

 <ul>
  <li><a href="listing-search.php">Search listing</a></li>
  <li><a href="logout.php">Log out</a></li>
  <li><a href="register.php">Update Your Information</a></li>
  <li><a href="change-password.php">Change Password</a></li>
</ul>

          <?php 
                if ($total_pages > 1) {
                # code...
                
                $nav = paginate("welcome.php", $current_page, $total_pages);

                echo "<br/><br/><br/>".$nav;

                for ($i = ($current_page - 1)*LISTINGS_PER_PAGE; 
                    $i < ($current_page * LISTINGS_PER_PAGE) && ($i < count($matches)); 
                    $i++) { 
                    # code...
                    echo display_preview($matches[$i]['listing_id']);
                    }
                echo $nav;
            }
            else if($total_pages == 1){
            for ($i = ($current_page - 1)*LISTINGS_PER_PAGE; $i < ($current_page * LISTINGS_PER_PAGE) && ($i < count($matches)); $i++) { 
				$listing_id = $matches[$i]['listing_id'];
				$result = pg_execute($conn, "listing_info", array($listing_id));
				$listing = pg_fetch_assoc($result, 0);
				$price = $listing['price'];
				$bedrooms = get_property("bedrooms", $listing['bedrooms'] );
				$bathrooms = get_property("bathrooms", $listing['bathrooms'] );
			echo display_preview($listing_id, $price, $bedrooms, $bathrooms);
                    }
            }

              ?>

           
<?php include("./footer.php");?>  