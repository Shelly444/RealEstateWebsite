<?php
//Group 09
//October 28 2018
//WEBD3201
//Random listing generation
require("../includes/constants.php");
require("../includes/functions.php"); 
require("../includes/db.php");
require("../includes/names.php");
//require("./randomgenerator.php");




$listing_statuses = Array("o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","s","s","s","s","s","s","s","s","s","c","c","c","c","h","h");
$property_options = Array("1","2","4","8","16");
$bedrooms = Array("1","2","4","8","16", "32", "64");
$bathrooms = Array("1","2","4","8","16");
$heating_fuels = Array("1","2","4","8");
$year_builts  = Array("1","2","4","8","32","64","128","256");
$lot_sizes = "";
$square_feets = "";
$floors = Array("1","2","4");
$garages = Array("1","2","4","8");
$cities = Array("1", "2", "4", "8", "16", "32", "64");
$building_types  = Array("1","2","4","8","32","64","128","256");
$provinces = Array("ON", "ON", "ON", "ON", "ON", "ON", "ON", "ON", "ON", "ON", "ON", "QC", "QC", "QC", "QC", "QC", "QC", "QC", "QC", "BC", "BC", "BC", "BC", "BC", "AB", "AB", "AB", "AB", "MB", "MB", "SK", "SK", "PE", "NS", "NL", "NB");
$postal_code_prefix = Array ("ON" => Array("K", "L", "M", "N", "P"),
							"QC" => Array("C", "B", "J"),
							"BC" => "Y",
							"AB" => "Y",
							"MB" => "K",
							"SK" => "S",
							"NS" => "D",
							"NB" => "E",
							"NL" => "A",
							"PE" => "C",
							);


$random_agent = pg_fetch_all(pg_query($conn, "SELECT user_id FROM users WHERE user_type = 'a'"));

for($i = 1; $i < RECORDS; $i++)
{
	 $province = get_random($provinces);
	 $user_records = get_random($random_agent);
	 $user_id = $user_records['user_id'];
	 $listing_status = get_random($listing_statuses);
	 $listing_price = (randomize(1000000)+100000);
	 $headline = "RANDOM HEADLINE";
	 $description = "RANDOM HEADLINE";
	 $image = "";
	 $city = get_random($cities);	//only in Durham region
	 $property_option = get_random($property_options);
	 $building_type = get_random($building_types);
	 $bedroom = get_random($bedrooms);
	 $bathroom = get_random($bathrooms);
	 $heating_fuel = get_random($heating_fuels);
	 $year_built = get_random($year_builts);
	 $lot_size = (randomize(1000)+1000);
	 $square_feet = (randomize(3000)+1000);
	 $floor = get_random($floors);
	 $garage = get_random($garages);
	 $postal_code = make_postal_code((is_array($postal_code_prefix[$province]))?
		get_random($postal_code_prefix[$province]):
		$postal_code_prefix[$province]);
		
		$listing_array = Array($user_id, $listing_status, $listing_price, $headline, $description, $postal_code, $city, $building_type, $property_option, $bedroom, $bathroom, $year_built, $lot_size, $square_feet, $heating_fuel, $garage, $floor);
		
		//dump($listing_array);

	
	 pg_execute($conn, "listing_insert", $listing_array);
	 
}


?>