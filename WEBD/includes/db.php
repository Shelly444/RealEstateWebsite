<?php
/*
Group 09
October 1 2018
WEBD3201
*/
	function db_connect()
	{
		$conn = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD);
		return $conn;
	}

	
	$conn = db_connect();

	$result = pg_prepare($conn, "user_login", "\nSELECT * FROM users WHERE user_id = $1 AND password = $2");

	$sql2 = pg_prepare($conn, "last_access", "\nUPDATE users SET last_access = $1 WHERE user_id = $2");
	
	
	$insert_user = pg_prepare($conn, "user_insert", "\nINSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access) VALUES($1, $2, $3, $4, $5, $6)");
	
	$insert_person = pg_prepare($conn, "person_insert", "INSERT INTO persons(user_id, salutation, first_name, last_name, street_address_1, street_address_2, city, province, postal_code, primary_phone_number, secondary_phone_number, fax_number, preferred_contact_method) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)");

	$insert_listing = pg_prepare($conn, "listing_insert", "\nINSERT INTO listings(
	user_id,
	listing_status,
	price,
	headline,
	description,
	postal_code,
	city,
	building_types,
	property_options,
	bedrooms,
	bathrooms,
	year_built,
	lot_size,
	square_feet,
	heating_fuel,
    garages,
    floors) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17)");
	
	$search_listings = pg_prepare($conn, "search_listings", "SELECT * FROM listings WHERE price = $1 AND city = $2 AND building_types = $3 AND property_options = $4 AND bedrooms = $5 AND bathrooms = $6 AND year_built = $7 AND lot_size = $8 AND square_feet = $9 AND heating_fuel = $10 AND garages = $11 AND floors = $12");
	$listing_info = pg_prepare($conn, "listing_info", "\nSELECT * FROM listings WHERE listing_id = $1");
	
function build_preview($id)
{
	global $conn;
	$result = pg_execute($conn, "listing_info", array($id));
	$output = "";
	if(pg_num_rows($result))
	{
		$listing = pg_fetch_assoc($result, 0);
		
		$output = "<div style = \"front-size: 15pt; border-style: groove;\">";
	$output .= $listing['headline']. "<br/>City: " . get_property("city", $listing["city"])." <br/><br/><br/><br/><br/><br/>This the display of an item, though I could be so much more (i.e.
		 everything to do with a listing: " .$id."<br/><br/><br/><br/><br/><br/>";
		 $output .= "</div>";
	}
	return $output;
}
function builddropdown($table_name, $preselected = "")
{
	global $conn;
	$output = "<select class='custom-select d-block w-100' name=".$table_name." >";
	$sql = "SELECT * FROM ".$table_name;
	$result = pg_query($conn, $sql);

	for ($i=0; $i < pg_num_rows($result); $i++) { 
		$property = pg_fetch_result($result, $i, "property");
		$value = pg_fetch_result($result, $i, "value");
		$selected = ($value == $preselected)?" selected=\"selected\" ":"";
		$output .= "<option value = '".$value."'".$selected.">".$property."</option>";
	}
	
	$output .= "</select>";
	return $output;
}


function build_radio($table, $prechecked = "")
{
	global $conn;
	$sql = "SELECT * FROM ".$table;
	$result = pg_query($conn, $sql);
	$output = "";
	for ($i=0; $i < pg_num_rows($result); $i++) {
		$property = pg_fetch_result($result, $i, "property");
		$value = pg_fetch_result($result, $i, "value");
		$checked = ( $value == $prechecked)?" checked=\"checked\" ":"";
		$output .= "<input type='radio' name='".$table_name."' value='".$value."' ".$checked." />".$property."<br/>";
	}
	
	return $output;
	
}
function build_checkbox($table, $prechecked = 0)
{
	global $conn;
	$sql = "SELECT * FROM ".$table;
	$result = pg_query($conn, $sql);
	$output = "";
	for ($i=0; $i < pg_num_rows($result); $i++) {
		$property = pg_fetch_result($result, $i, "property");
		$value = pg_fetch_result($result, $i, "value");
		$checked = (is_bit_set($i,$prechecked))?" checked=\"checked\" ":"";
		$output .= "<input type='checkbox' name='".$table."[]' value='".$value."' ".$checked." />  ".$property."<br/>";
	}
	
	return $output;
}

function get_property($table_name, $value)
{
	global $conn;
	$sql = "SELECT property FROM ".$table_name." WHERE value = '" .$value. "'";
    $result = pg_query($conn, $sql);
    $records = pg_num_rows($result);
    $property = pg_fetch_result($result, 0, "property");
	return $property;
}

$password_change = pg_prepare($conn, "password_change", "UPDATE users SET password = $1 WHERE user_id =$2");

//$user_login = pg_prepare($conn, "user_login", "SELECT FROM users WHERE user_id = $1 AND password =$2");


function password_check ($password, $user_id)
{
	global $conn;
	return pg_num_rows(pg_execute($conn. "user_login", array($user_id, $password) ))>0?true:false;
}

function query_builder($table, $value)
{
	$sql = "";
	$or_clause = " OR ";
	
	if($value > 0)
	  {
		$sql .= " AND (";
		for($i = 0; $value > pow(2, $i); $i++)
		{
			$sql .= (is_bit_set($i, $value))? $table . " = " . pow(2, $i) . $or_clause:"";
		}
		$sql = substr($sql, 0, strlen($sql) - strlen($or_clause));
		$sql .= ")";
	  }
}

	
function listing_exists($id)
{
	global $conn;
	return pg_num_rows(pg_execute($conn, "listing_info", array($id)))>0?true:false;
}
$user_type_display = pg_prepare($conn, "user_type_display", "SELECT * FROM users WHERE user_type = $1");

$user_type_update = pg_prepare($conn, "user_type_update", "UPDATE users SET user_type = $1 WHERE user_id = $2");

//Sorts listing by agent
$listing_by_agent = pg_prepare($conn, "listing_by_agent","SELECT listing_id FROM listings WHERE user_id = $1 AND listing_status = $2 ORDER BY listing_id DESC");

///////////////////////////////////////////////////////////////////////////////////////////////////////////
//Start of favourite prepare statements

$fav_insert = pg_prepare($conn, "fav_insert", "INSERT INTO favourites(user_id, listing_id) VALUES ($1, $2)");

$fav_exist = pg_prepare($conn, "fav_exist", "SELECT * FROM favourites WHERE user_id = $1 AND listing_id = $2");

$fav_remove = pg_prepare($conn, "fav_remove", "DELETE FROM favourites WHERE user_id = $1 AND listing_id = $2");

$fav_by_client = pg_prepare($conn, "fav_per_client", "SELECT * FROM favourites WHERE user_id = $1");

//End of favourite prepare statements
///////////////////////////////////////////////////////////////////////////////////////////////////////////

function fav_exist($user_id, $listing_id)
{
	global $conn;
	return pg_num_rows(pg_execute($conn, "fav_exist", array($user_id, $listing_id)))>0?true:false;
}

?>
