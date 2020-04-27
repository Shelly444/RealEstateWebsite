<?php

  require "./header.php";

   $title = "listing-create";
    $file = "listing-create.php";
    $description = "listing create page for our website";
    $date = "Oct 4, 2018";
    $banner = "Create listing by agent user";

  if(!isset($_SESSION['user']))
  {
    redirect('./login.php');
  }
  elseif($_SESSION['user']['user_type'] != AGENT)
  {
    redirect('./login.php');
  }
    


    if($_SERVER["REQUEST_METHOD"] == "GET"){

     $listing_status = ""; 
     $property_options = ""; 
     $city = "";
     $price = ""; 
     $headline = "" ; 
     $description = "";
     $postal_code = "";
     //$images = ""; 
     $bedrooms = ""; 
     $bathrooms = "";
     $year_built = "";
     $lot_size = ""; 
     $square_feet = "" ; 
     $heating_fuel = "";
     $garages = "";
     $floors = "";
	 $building_types = "";
	 
	 $error = "";
		 

    	 
    }else if($_SERVER["REQUEST_METHOD"] == "POST"){
		
	 $user_id = $_SESSION['user'];

     $listing_status = trim($_POST['listing_status']) ; 
     $property_options = (isset($_POST['property_options']))?sum_check_box($_POST['property_options']): 0 ; 
     $city = trim($_POST['city']);
     $price = trim($_POST['price']); 
     $headline = trim($_POST['headline']) ; 
     $description = trim($_POST['description']);
     $postal_code = trim($_POST['postal_code']);
     //$images = trim($_POST['images']); 
     $bedrooms = trim($_POST['bedrooms']); 
     $bathrooms = trim($_POST['bathrooms']);
     $year_built = trim($_POST['year_built']);
     $lot_size = trim($_POST['lot_size']); 
     $square_feet = trim($_POST['square_feet']) ; 
     $heating_fuel = trim($_POST['heating_fuel']);
     $garages = trim($_POST['garages']);
     $floors = trim($_POST['floors']);
	 $building_types = trim($_POST['building_types']);
	 $error = "";
    
     $conn = db_connect(); 

     //$sql = "SELECT * FROM  users WHERE id = '".$login."'"; 

     //$results = pg_query($conn, $sql); 
	 
//Validation ------------------------------------------------------------------------------------

if(!isset($listing_status)||$listing_status==""){
        $error.= "You did not enter a status.";
    }else if(strlen($listing_status) > 1){
          $error.= "A status must be 1 character,".$listing_status. "is too long.<br />";
          $listing_status = "";
    }

     if(!isset($property_options)||$property_options==0){
        $error.= "You did not enter your property options.<br />";
     }

     if(!isset($city)||$city==""){
        $error.= "You did not enter your city.<br />";
     }

      if(!isset($price)||$price==""){
        $error.= "You did not enter your price.<br />";
     }else if(!is_numeric($price)){
        $error .= "Your price MUST be a number, you entered: " . $city ."<br />";
        $city = "";}
        
    if(!isset($headline)||$headline==""){
        $error.= "You did not enter your headline.<br />";
    }
    else if(strlen($headline) > 100){
        $error.= "Your headline needs to be less than 100 characters: ". $headline ." is too long.<br />";
        $headline = "";
    }
    if(!isset($description)||$description==""){
        $error.= "You did not enter your description.<br />";
    }
    else if(strlen($description) > 1000){
        $error.= "Your description needs to be less than 1000 characters: ". $description ." is too long.<br />";
        $description = "";
    }
    if(!isset($postal_code)||$postal_code==""){
            $error.= "You did not enter your postal code.<br />";
     }else if(is_valid_postal_code($postal_code)){
        $error .= "Your postal code ".$postal_code." is not valid. <br/>";
		$postal_code = "";
	 }
    // if(!isset($images)||$images==""){
        // $error.= "You did not enter your image.<br />";
     // }else if(!is_integer($images)){
        // $error .= "Your image MUST be a integer, you entered: " . $images ."<br />";
        // $images = "";}

        if(!isset($bedrooms)||$bedrooms==""){
        $error.= "You did not enter your bedrooms.<br />";
     }

        if(!isset($bathrooms)||$bathrooms==""){
        $error.= "You did not enter your bathrooms.<br />";
     }   

     if(!isset($heating_fuel)||$heating_fuel==""){
        $error.= "You did not enter your heating fuel.<br />";
     }

     if(!isset($year_built)||$year_built==""){
        $error.= "You did not enter the year the house was built.<br />";
      }//else if(!is_integer($year_built)){
        // $error .= "The year built must be a whole number, you entered: " . $year_built ."<br />";
        // $year_built = "";}

        if(!isset($lot_size)||$lot_size==""){
        $error.= "You did not enter your lot size.<br />";
      }//else if(!is_integer($lot_size)){
        // $error .= "Your lot size MUST be a integer, you entered: " . $lot_size ."<br />";
        // $lot_size = "";}

        if(!isset($square_feet)||$square_feet==""){
        $error.= "You did not enter your square feet.<br />";
      }//else if(!is_integer($square_feet)){
        // $error .= "Your square feet MUST be a integer, you entered: " . $square_feet ."<br />";
        // $square_feet = "";}
//Validation Ends------------------------------------------------------------------------------------

       // if($error == ""){
		 $user_id = $_SESSION['user']['user_id'];   
		 $listing_array = Array($user_id, $listing_status, $price, $headline, $description, $postal_code, $city, $building_types, $property_options, $bedrooms, $bathrooms, $year_built, $lot_size, $square_feet, $heating_fuel, $garages, $floors);
		 pg_execute($conn, "listing_insert", $listing_array) ;

		 $_SESSION['message'] = "SUCCESSFULLY CREATED LISTING!";
		dump($listing_array);
       	redirect('./dashboard.php');

      // }
}
 
  ?>

 <ul>
  <li><a href="logout.php">Log out</a></li>
  <li><a href="listing_update.php">Update Your Information</a></li>
  <li><a href="change-password.php">Change Password</a></li>
</ul>

<form  name="input" method="post" action=" <?php echo $_SERVER["PHP_SELF"] ?>"  >
	<h3 align="center">Listing Creation</h3>
	<p align="left">This page is used to create new listings for agent users.</p>
<table border="0" width="80%" cellpadding="1px">
	<tr>
		<td><strong>Building Type</strong></td>
		<td>
	<?php echo buildDropDown('building_types'); ?>     
		</td>
	</tr>
	<tr>
		<td><strong>Property Options</strong></td>
		<td>
		<?php echo build_checkbox('property_options'); ?>     
		</td>
	</tr>
	
	<tr>
		<td><strong>City</label></strong></td>
		<td><br/><?php echo buildDropDown('city'); ?></td>  
	</tr>
	
	<!--
	<tr>
		<td><strong>City</strong></td>
		<td>
		<?php echo build_checkbox('city'); ?>     
		</td>
	</tr>
		-->
	<tr>
		<td><strong>Listing Status</strong></td>
		<td><?php echo buildDropDown('listing_status'); ?> </td>
	</tr>

	<!--
	<tr>
		<td><strong>Preferred Contact Method</strong></td>
		<td><?php //echo buildDropDown('preferred_contact_method'); ?> </td>
	</tr>
	-->

	<tr>
		<td><strong>Heating Fuel</strong></td>
	<td><?php echo buildDropDown('heating_fuel'); ?> </td>
	</tr>
	<tr>
	  <td><strong>Bedrooms</strong></td>
	<td><?php echo buildDropDown('bedrooms'); ?> </td>
	</tr>
	<tr>
	  <td><strong>Bathrooms</strong></td>
	<td><?php echo buildDropDown('bathrooms'); ?> </td>
	</tr>
	<tr>
	  <td><strong>Price</strong></td>
	  <td><input type="text" name="price" value="" /></td>
	</tr>
	<tr>
	  <td><strong>Postal Code</strong></td>
	  <td><input type="text" name="postal_code" placeholder="L1Y 6Y8"value="" /></td>
	</tr>
	<tr>
	  <td><strong>Year Built</strong></td>
	  <td><input type="text" name="year_built" value="" /></td>
	</tr>
	<tr>
	  <td><strong>Lot Size</strong></td>
	  <td><input type="text" name="lot_size" value="" /></td>
	</tr>
	<tr>
	  <td><strong>Square Feet</strong></td>
	  <td><input type="text" name="square_feet" value="" /></td>
	</tr>
	<tr>
	  <td><strong>Garages</strong></td>
	<td><?php echo buildDropDown('garages'); ?> </td>
	</tr>
	<tr>
	  <td><strong>Floors</strong></td>
	<td><?php echo buildDropDown('floors'); ?> </td>
	</tr>
	<tr>
		<td><strong>Headline</strong></td>
		<td><input type="text" name="headline" size="63" maxlength="63" value="" /></td>
	</tr>
	<tr>
		<td><strong>Description</strong></td>
		<td><textarea rows="10"  name="description" cols="60"></textarea></td>
	</tr>
</table>
<table border="0" cellspacing="15" >
<tr>
	<td><input type="submit" value="Create Listing" /></td>
	<td><input type="reset" value = "Clear" /></td>
</tr>

<tr><?php echo $error;?></tr>

</table>
</form>

  <?php include("./footer.php");?> 