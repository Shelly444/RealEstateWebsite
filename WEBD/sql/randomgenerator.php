<?php
/*
Group 09
October 28 2018
WEBD3201
Reference: Hudson Atwell for the canada array that i modified.
*/
//include('./header.php');
include('../includes/names.php');
include('../includes/constants.php');
include('../includes/functions.php');
include('../includes/db.php');
include('../includes/cities.php');

//Array of randomizable objects
$salutations = Array("Mr.", "Mrs.","Mr.", "Ms.", "Mr.", "Mrs.");

$user_types = Array("s", "a", "a", "a", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "p", "p", "d", "d");	
							
$contact_method = Array("e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e","p", "p", "p", "p", "p", "l", "l");

$email_providers = Array("gmail.com", "yahoo.com", "hotmail.ca", "rogers.com", "dcmail.ca", "hotmail.com", "uoit.ca");

$street_names = Array("Simcoe", "Grandview", "Center", "Bloor", "Finch", "Jane", "Cochrane", "Apple", "Dunder Mifflin", "Konoha", "Pallet", "Bananas", "Deku", "Black Bull");

$street_types = Array("St.", "Blvd.", "Cres.", "Drive", "Ave.", "Rd.");

$direction = Array(" ", " ", " ", "E", "W", "S", "N","E", "W", "S", "N"," ", " ", " ");

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
									
for ($i = 1; $i <= RECORDS; $i++)
{
	//First and Last name generation
	$salutation = get_random($salutations);	//generates a random salutation
	$first_name = ($salutation == "Mr.")?
		get_random($male_names):	//if salutation is Mr then generate male names else generate female names
		get_random($female_names);
	$first_name = ucwords(strtolower($first_name));	//formats the name to be first letter capital and the rest lowercase
	$last_name = (get_random($last_names));
	$last_name = ucwords(strtolower($last_name));
	
	//User_Id generation
	$user_id = strtolower($last_name);
	$user_id = substr($user_id, 0, (MAX_LOGIN_LENGTH-1)) . strtolower(substr($first_name,0,1));
	
	//password hash generation
	$password = hash(HASH_ALGO, "password");
	
	//User-Type generation
	$user_type = get_random($user_types);
	
	//Email address generation
	$email_address = strtolower(substr($first_name,0,1)) . strtolower($last_name) . "@" . get_random($email_providers);
	
	//Enroll date generation
	$enrol_year = 2010 + randomize(8)+1;
	$calender = cal_info(CAL_GREGORIAN);
	$enrol_month = randomize(12)+1;
	$enrol_month_name = $calender['months'][$enrol_month];
	$enrol_day = randomize(28)+1;
	$enrol_date = date('Y-m-d', strtotime($enrol_day . " " . $enrol_month_name . " " . $enrol_year));
	
	//Last access date generation
	$last_access = date('Y-m-d', time());
		
	//User array
	$user_array = Array($user_id, $password, $user_type, $email_address, $enrol_date, $last_access);
		
	//If there is a duplicate	
	//*****************************************************************************************************
	
	
	//*****************************************************************************************************
	$street_address = randomize(2000) + 1 . " " . get_random($street_names) . " " . get_random($street_types) . " " . get_random($direction);
	
	$city = get_random($CANADA);	//500+ cities in canada.php array
	
	$province = get_random($provinces);
	
	$postal_code = make_postal_code((is_array($postal_code_prefix[$province]))?
		get_random($postal_code_prefix[$province]):
		$postal_code_prefix[$province]);
		
	$phone_number = create_phone_number();
	
	$preferred_contact_method = get_random($contact_method);
	
	//person array
	//$person_array = Array($user_id, $salutation, $first_name, $last_name, $street_address, " ", $city, $province, $postal_code, $phone_number, " ", " ", $preferred_contact_method);
	$person_array = Array($user_id, $salutation, htmlspecialchars($first_name), htmlspecialchars($last_name), $street_address, $city, $province, $postal_code, $phone_number, $preferred_contact_method);
	
	 //dump($person_array);
	// dump($user_array);
	
	//Insert users to database
	pg_execute($conn, "user_insert", $user_array);
	pg_execute($conn, "person_insert", $person_array);
}	
							
?>
<?php //include ('./footer.php'); ?>