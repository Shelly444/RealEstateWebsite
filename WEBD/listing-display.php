<?php
/*
Hector Mariscal, Michelle Kirkwood
2018-12-09
WEBD3201 - Listing display
*/

  require "./header.php";
	global $conn;
  
  $result = pg_execute($conn, "listing_info", array($listing_id));
  $listing = pg_fetch_assoc($result, 0);
  $_SESSION['listing'] = $listing;
  
  ?>




<a href="listing-search-results">Back To Results</a>

<div style="font-size:12px;color:#000000;">MLS#1356511</div>
			<div id="ImageContainer" style="float:left;margin-right:10px;">      
        <div class="image_holder">
					<a name="1356511" href="./listing-display.php">
					<IMG SRC="./images/sample1.png" id="FloatingImage" class="listing_lg">	      
					</a>
				</div>
			</div>
			<div>
				<table style="table-layout:fixed; position:relative; font-size:12px">
					<tr>
					  <td valign="top" class="status_Active">
                            <?php echo $_SESSION['listings']['listing_status']; ?>          </td>
          </tr>
			<tr><td valign="top" style="font-size:16px"><b><?php echo money_format('%.2n', $_SESSION['listings']['price']); ?></b></td></tr>
  			<tr>
  			  <td>
			  			    
	  		  			    <?php echo $_SESSION['listings']['city']; ?> <?php echo $_SESSION['listings']['postal_code']; ?>
          </td>
        </tr>
		<tr><td style="line-height:4px;font-size:4px;">&nbsp;</td></tr>
		<tr><td valign="top"><?php echo $_SESSION['listings']['building_types']; ?></td></tr>
          		<tr><td valign="top" style="color:#333333;"><?php echo $_SESSION['listings']['bedrooms']; ?> Br &nbsp;&nbsp; <?php echo $_SESSION['listings']['bathrooms']; ?> Ba &nbsp;&nbsp; <?php echo $_SESSION['listings']['square_feet']; ?> sqft.</td></tr>
          					<tr><td style="color:#333333;"><?php echo $_SESSION['listings']['lot_size']; ?>sqft lot size.</td></tr>
					
					<tr><td style="line-height:4px;font-size:4px;">&nbsp;</td></tr>
								
				</table>
			</div>
		</div>	
<table border="1" width="60%">
					<caption>Information</caption>
					<tr>
						<th>Fields</th>
						<th>Description</th>
					</tr>
					<tr>
						<td>Bedroom</td>
						<td><?php echo $_SESSION['listings']['bedrooms']; ?></td>
					</tr>
					<tr>
						<td>Bathroom</td>
						<td><?php echo $_SESSION['listings']['bathrooms']; ?></td>
					</tr>
					<tr>
						<td>Area</td>
						<td><?php echo $_SESSION['listings']['square_feet']; ?> sqft.</td>
					</tr>
					
					<tr>
						<td>Year built</td>
						<td><?php echo $_SESSION['listings']['year_built']; ?></td>
					</tr>
					<tr>
						<td>Heating type</td>
						<td><?php echo $_SESSION['listings']['heating_fuel']; ?></td>
					</tr>
										<tr>
						<td>Garages</td>
						<td><?php echo $_SESSION['listings']['garages']; ?></td>
					</tr>
										<tr>
						<td>Number of floors</td>
						<td><?php echo $_SESSION['listings']['floors']; ?></td>
					</tr>
					
				</table>
                <?php
                    if(fav_exist($user_id, $_SESSION['listing']['listing_id'])){
                        echo "<input type=\"submit\" value=\"Remove Favorites\" formaction=\"remove_fav.php\"/>";
                    }else{
                        echo " <input type=\"submit\" value=\"Add to favorites\" formaction=\"add_fav.php\"/>";
                    }
                ?>
                    
  


 <?php include("./footer.php");?> 