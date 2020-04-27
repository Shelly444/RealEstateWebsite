<?php

  require "./header.php";

  if(!isset($_SESSION['user']))
  {
  	redirect('./login.php');
  }
  elseif($_SESSION['user']['user_type'] != AGENT)
  {
  	redirect('./login.php');
  }
    $output = "";
    $userId = $_SESSION['user']['user_id'];
    $status = (isset($_GET['status']) && trim($_GET['status']) != "" )?$_GET['status']: OPEN;
    $result = pg_execute($conn, "listing_by_agent",array($userId, $status));
    $matches = pg_fetch_all($result);
    

    $total_pages = ceil((count($matches))/LISTINGS_PER_PAGE);

    $current_page = ((isset($_GET['page']) && trim($_GET['page']) != "" && is_numeric(trim(
    $_GET['page'])) && $_GET['page']) > 0)?
                      ceil($_GET['page'])
                      : 1;

    if ($current_page > $total_pages) {
        $current_page = $total_pages;
    }
 
  ?>

  <h1>Dashboard For Agent</h1>
			<p>Welcome! , <?php echo $_SESSION['user']['user_id']?> you have logged in!</p> 
			<p><?php echo $message;?></p>
		
              <?php 
                if ($total_pages > 1) {

                $navigate = paginate("dashboard.php", $current_page, $total_pages);

                echo "<br/><br/>".$navigate."<br/><br/>";

                echo "<table>"."\n\t<tr>"."\n\t\t<th>Listings ID</th>"."\n\t\t<th>Edit</th>"."\n\t\t<th>Delete</th>"."\n\t</tr>";

                for ($i = ($current_page - 1)*LISTINGS_PER_PAGE; $i < ($current_page * LISTINGS_PER_PAGE) && ($i < count($matches)); $i++) {
                    echo "\n\t<tr>"."\n\t\t<td>" . $matches[$i]['listing_id'] . "</td>"."\n\t\t\t<td><a href=\"listing_update.php?listing_id=".$matches[$i]['listing_id']."\">\t\t\tEdit</a></td>"."\n\t\t<td><a href=\"listing-update-status.php?listing_id=".$matches[$i]['listing_id']."&status=closed\">Closed</a></td>"."\n\t</tr>";
                    }
                echo "\n</table>";
                echo "<br/><br/>".$navigate;
                }
                else if($total_pages == 1){
                  echo "<table>"."\n\t<tr>"."\n\t\t<th>Listings ID</th>"."\n\t\t<th>Edit</th>"."\n\t\t<th>Delete</th>"."\n\t</tr>";
                     for ($i = ($current_page - 1)*LISTINGS_PER_PAGE; $i < ($current_page * LISTINGS_PER_PAGE) && ($i < count($matches)); $i++) { 
                        echo "\n\t<tr>"."\n\t\t<td>" . $matches[$i]['listing_id'] . "</td>"."\n\t\t<td><a href=\"listing-update.php?listing_id=".$matches[$i]['listing_id']."\">Edit</a></td>"."\n\t\t<td><a href=\"listing-update-status.php?listing_id=".$matches[$i]['listing_id']."&status=closed\">Closed</a></td>"."\n\t</tr>";
                        }
                  echo "\n</table>";
                }

              ?>
 <ul>
  <li><a href="listing-create.php">Create a listing</a></li>
  <li><a href="logout.php">Log out</a></li>
  <li><a href="register.php">Update Your Information</a></li>
  <li><a href="password-change.php">Change Password</a></li>
</ul>

  <?php include("./footer.php");?> 