<?php
/*
Hector Mariscal, Michelle Kirkwood
2018-04-18
WEBD2201
*/
	
function display_copyright()
{
	$name="Hector  Mariscal, Michelle Kirwood - Group 09";
	$footerStrip='&copy;'. date('Y').' ' . $name;
		
	return $footerStrip;
}
	
	
	/* Return a random integer to seed the random number generator
 * Uses the microseconds portion of the built-in microtime()
 * function.
 */
function seed()
{
	mt_rand();
} 

function randomize($number)
{
	$random = (mt_rand()%$number);	//creates a random number between 0  and $number minus 1
	return $random;
}

function get_random($array)
{
	$array = is_string($array)?str_split($array):$array;
	$random = randomize(sizeof($array));
	return $array[$random];
}


function dump($arg)
{
	echo "<pre>";
	echo (is_array($arg))? print_r($arg): $arg;
	echo "</pre>";
}

function redirect($page)
{
	header("Location: ". $page);
	ob_flush();
}

function lastAccessUpdate($user_id)
{
    $query = "SELECT last_access = '".date("Y-m-d", time())."' FROM users WHERE user_id = '".$user_id."'";
    $result = pg_query($conn, $query);
    $records = pg_num_rows($result);
    
    return $records;
}

function is_existing_id($id)
{
	return pg_num_rows(pg_execute($conn, "user_id_check", array($id)))?true:false;
}

function display_phone_number($phoneNumber) 
{

     if(!is_numeric($phoneNumber)){
    		$error .= "Your phone number <u>MUST</u>  be a number, you entered: " . $phoneNumber ."<br />";
    		$phoneNumber = "";
    }else if(strlen($phoneNumber) < MINIMUM_CHARACTER_LENGTH){
    	    $error.= "Your phone number  needs to be more than 10 characters: ". $phoneNumber ." is too short.<br />";
    	    $phoneNumber = "";}

    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > MINIMUM_CHARACTER_LENGTH) {
        
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);
        $extension = substr($phoneNumber, 10, strlen($phoneNumber)-10);

        $phoneNumber = ' ('.$areaCode.') '.$nextThree.'-'.$lastFour.'ext.'.$extension;
    }
    else if(strlen($phoneNumber) == MINIMUM_CHARACTER_LENGTH) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    

    return $phoneNumber;
}

// Function to validate a Canadian Postal Code, returns true or false

function is_valid_postal_code($postalCode) 
{
	if(preg_match(
		"/^[ABCEFGHJKLMNPRSTVXY]{1}[0-9]{1}[ABCEFGHJKLMNPRSTVXY]{1}[0-9]{1}[ABCEFGHJKLMNPRSTVXY]{1}[0-9]{1}$/i", $postalCode))
		return true;
	else
		return false;
}

function make_postal_code($prefix = " ")
{
	$postal_code = strtoupper(trim($prefix));
	$i = strlen($postal_code);
	
	while($i < POSTAL_CODE_LENGTH)
	{
		$postal_code .= (strlen($postal_code) % 2 == 0)?
		get_random(POSTAL_CODE_LETTERS):
		
		mt_rand()%10;
		$i++;
	}
	return $postal_code;
}


function create_phone_number()
{
	$phone_number_range = MAX_AREA_CODE - MIN_AREA_CODE + 1;
	$phone_number = (mt_rand()% $phone_number_range + MIN_AREA_CODE) . (mt_rand()% $phone_number_range + MIN_AREA_CODE) . str_pad(mt_rand()%10000, 4, "0", STR_PAD_LEFT);
	return $phone_number;
}

function is_bit_set($power, $decimal) {
	if((pow(2,$power)) & ($decimal)) 
		return 1;
	else
		return 0;
} 

function sum_check_box($array)
{
	$num_checks = count($array); 
	$sum = 0;
	for ($i = 0; $i < $num_checks; $i++)
	{
	  $sum += $array[$i]; 
	}
	return $sum;
}




function paginate($file, $curr_page = 1,$tot_pages = 1)
{
	$nav = "<div style = \"front-size: 15pt;\">";
	if ($curr_page > 1) {
		
		$nav .= "&nbsp;&nbsp;<a href=\"".$file."?page=".($curr_page -1)." \">"."&lt;</a>";
	}
	for ($i=1 ; $i < $tot_pages ; $i++ ) { 
		
		if ($i == $curr_page) {
		
			$nav .= "&nbsp;&nbsp;$i";
		}else{
			$nav .= "&nbsp;&nbsp;<a href=\"".$file."?page=$i \">$i;</a>";
		}
	}
	if ($curr_page < $tot_pages) {
	
		$nav .= "&nbsp;&nbsp;<a href=\"".$file."?page=".($curr_page +1)." \">"."&gt;</a>";
	}
	$nav .= "</div>";
}
	
?> 