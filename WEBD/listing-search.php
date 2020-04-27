
<?php
  require "./header.php";
  global $conn;

   if(!isset($_SESSION['user']))
  {
    redirect('./login.php');
  }
  $error = "";
  $results = "";
  //$city = 25;
  
;
$city=isset($_COOKIE['city'])?trim($_COOKIE['city']):0;
$city=isset($_SESSION['city'])?trim($_SESSION['city']):$city; 
$city=isset($_GET['city'])?trim($_GET['city']):$city;
$city = (isset($_POST['city']))?sum_check_box($_POST['city']):$city;

if($city == 0)
{
    $_SESSION['message'] = "Please select a city";
    redirect('./listing-select-city.php');
}else{
    setcookie('city', $city, time() + COOKIE_LIFESPAN);
    $_SESSION['city'] = $city;
    if(isset($_POST['city']))
    {
        //	redirect('./listing-search.php');
    }
}
  

if($_SERVER['REQUEST_METHOD'] == "GET"){
	$city = isset($_COOKIE['city'])?($_COOKIE['city']):0;
	$listing_status = isset($_COOKIE['listing_status'])?$_COOKIE['listing_status']:0;
	$property_options = isset($_COOKIE['property_options'])?$_COOKIE['property_options']:0;
	$min_price = isset($_COOKIE['min_price'])?$_COOKIE['min_price']:0;
    $max_price = isset($_COOKIE['max_price'])?$_COOKIE['max_price']:0;
	$bedrooms = isset($_COOKIE['bedrooms'])?$_COOKIE['bedrooms']:0;
	$bathrooms = isset($_COOKIE['bathrooms'])?$_COOKIE['bathrooms']:0;
	$bathrooms = isset($_COOKIE['bathrooms'])?$_COOKIE['bathrooms']:0;
	$bathrooms = isset($_COOKIE['bathrooms'])?$_COOKIE['bathrooms']:0;
	$bathrooms = isset($_COOKIE['bathrooms'])?$_COOKIE['bathrooms']:0;
    //$images = ""; 
    $heating_fuel = isset($_COOKIE['heating_fuel'])?$_COOKIE['heating_fuel']:""; 
    $garages = isset($_COOKIE['garages'])?$_COOKIE['garages']:""; 
    $floors = isset($_COOKIE['floors'])?$_COOKIE['floors']:""; 
    $building_types = isset($_COOKIE['building_types'])?$_COOKIE['building_types']:""; 
}
else if($_SERVER['REQUEST_METHOD'] == "POST"){
	//dump($_POST);
	//sums the city value and sets into cookie
	$city = (isset($_POST['city']))?sum_check_box($_POST['city']):0;
	if($city > 0 ) setcookie("city", $city, time()+COOKIE_LIFESPAN);
	
	//sums the property options value and sets into cookie
	$property_options = (isset($_POST['property_options']))?sum_check_box($_POST['property_options']):0;
    if($property_options > 0 ) setcookie("property_options", $property_options, time()+COOKIE_LIFESPAN);
	
	$building_types = (isset($_POST['building_types']))?sum_check_box($_POST['building_types']):0;
    if($building_types > 0 ) setcookie("building_types", $building_types, time()+COOKIE_LIFESPAN);
	
	$floors = (isset($_POST['floors']))?sum_check_box($_POST['floors']):0;
    if($floors > 0 ) setcookie("floors", $floors, time()+COOKIE_LIFESPAN);
    
	//sums the min price value and sets into cookie
	$min_price = trim($_POST['minimum_price']);
	if($min_price > 0 ) setcookie("min_price", $min_price, time()+COOKIE_LIFESPAN);
	
	//sums the max price value and sets into cookie
	$max_price = trim($_POST['maximum_price']);
    if($max_price > 0 ) setcookie("max_price", $max_price, time()+COOKIE_LIFESPAN);
	
	//sums the bedroom value and sets into cookie
    $bedrooms = isset($_POST['bedrooms'])?sum_check_box($_POST['bedrooms']):0;
	if($bedrooms > 0)setcookie("bedrooms", $bedrooms, time() + COOKIE_LIFESPAN);
	
	//sums the bathroom value and sets into cookie
	$bathrooms = isset($_POST['bathrooms'])?sum_check_box($_POST['bathrooms']):0;
	if($bathrooms > 0)setcookie("bathrooms", $bathrooms, time() + COOKIE_LIFESPAN);
	
	//sums the bathroom value and sets into cookie
	$heating_fuel = isset($_POST['heating_fuel'])?sum_check_box($_POST['heating_fuel']):0;
	if($heating_fuel > 0)setcookie("heating_fuel", $heating_fuel, time() + COOKIE_LIFESPAN);
	 
      $conn = db_connect(); 
      /*$listings_search = Array($price, $city, $property_options, $bedrooms, $bathrooms, $year_built, $lot_size, $square_feet, $heating_fuel, $garages, $floors, $building_types);
      $results = pg_execute($conn, "search_listings", $listings_search);*/
	  $sql = "SELECT listing_id FROM listings WHERE 1 = 1 ";
	  $or_clause = " OR ";
	  if($bedrooms > 0)
	  {
		$sql .= " AND (";
		for($i = 0; $bedrooms > pow(2, $i); $i++)
		{
			$sql .= (is_bit_set($i, $bedrooms))? "bedrooms = " . pow(2, $i) . $or_clause:"";
		}
		$sql = substr($sql, 0, strlen($sql) - strlen($or_clause));
		$sql .= ")";
	  }
	  $sql .= "AND listings.listing_status = 'o' ORDER BY listings.listing_id DESC LIMIT 200";	
	  query_builder('city', $city);
	  query_builder('property_options', $property_options);
	  query_builder('bathrooms', $bathrooms);
	  //query_builder('building_types', $building_types);
	  //query_builder('floors', $floors);
	  //query_builder('garages', $garages);
	  //query_builder('heating_fuel', $heating_fuel);	  
	  
	  echo $sql;

	  $results = pg_query($conn, $sql);
	  
	  $records = pg_num_rows($results);
	  $listing_ids = $records > 0 ? pg_fetch_all($results):" No listing ids retrieved";
	  dump($listing_ids);
	  $page =1;
      if($records == 0)
      {
        $error = "There were no search results found please widen your criteria.";
      }
      else if($records == 1)
      {
		
		$listing_id = pg_fetch_result($results,0, "listing_id");
		$_SESSION['message'] = "This is your only match, based on your search criteria";
        //redirect('./listing-display.php?listing_id='.$listing_id);
      }else if($records > 1)
      {
		$listing_results = pg_fetch_all($results);
		$_SESSION['listing_results'] = $listing_results; 
        //redirect('./listing-search-results.php?page=' . $page);
	  }
	 } 
  ?>



<h3><?php echo $error; ?></h3>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
<table align="center" width="50%" border="0" cellspacing="0" cellpadding="0">

	<tr>
      
            <td>Search Property Listings</td>
          </tr>
	
      
        <tr>
        
          <td>Property Options</td>
          <td><?php echo build_checkbox('property_options');?></td>
            
        </tr>
  				<!--
  				<tr>
  					<td>Location:</td>
  					<td><br /><?php //echo build_checkbox('city');?>
                        

                    </td>
  				</tr>
				-->
  				
        <tr>
		
          <td>Minimum Price:</td>
          <td><br/><select name="minimum_price">
<option value="">No minimum</option>
<option value="75000">$75,000</option>
<option value="100000">$100,000</option>
<option value="125000">$125,000</option>
<option value="150000">$150,000</option>
<option value="200000">$200,000</option>
<option value="250000">$250,000</option>
<option value="300000">$300,000</option>
<option value="400000">$400,000</option>
<option value="500000">$500,000</option>
<option value="750000">$750,000</option>
<option value="800000">$800,000</option>
<option value="900000">$900,000</option>
<option value="1000000">$1,000,000</option>
</select></td>
</tr>
        <tr>
          <td>Maximum Price:</td>
          <td><select name="maximum_price">
<option value="">No maximum</option>
<option value="150000">$150,000</option>
<option value="200000">$200,000</option>
<option value="250000">$250,000</option>
<option value="300000">$300,000</option>
<option value="400000">$400,000</option>
<option value="500000">$500,000</option>
<option value="750000">$750,000</option>
<option value="800000">$800,000</option>
<option value="900000">$900,000</option>
<option value="1000000">$1,000,000</option>
<option value="2000000">$2,000,000</option>
<option value="3000000">$3,000,000</option>
</select></td>
</tr>
          
        
        <tr>
          <td>Bedrooms:</td>
         <td>
          	<br /><?php echo build_checkbox('bedrooms', $bedrooms);?>
         </td>
        </tr>
        <tr>
          <td>Bathrooms:</td>
          <td>
			<br /><?php echo build_checkbox('bathrooms', $bathrooms);?>
         </td>
        </tr>
       <!-- <tr>
          <td>Building Types:</td>
				<td><br /><?php //echo build_checkbox('building_types', $building_types);?></td>
              </tr>
		-->
          
             <!--<tr>
              <td>Floors:</td>
			  <td><br /><?php //echo build_checkbox('floors', $floors);?></td>
              </tr>
			  -->
			  <!--
			  <tr>
                <td>Garages:</td>
				<td><br /><?php //echo build_checkbox('garages', $garages);?></td>

              </tr>
              <tr>
                <td>Heating Fuel:</td>
                <td><br /><?php //echo build_checkbox('heating_fuel', $heating_fuel);?></td>
				
              </tr>
			  -->
          
      <tr>
        <td>
      <input type="submit" value="search"/><input type="submit" value="Clear"/>
    </td>
  </tr>
    </table>
    </form>


<?php include("./footer.php");?> 