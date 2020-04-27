<?php 
     
     
     require "./header.php";
  
    $title = "Register";
    $file = "register.php";
    $description = "Register page for our website";
    $date = "Oct 4, 2018";
    $banner = "User Registration";

    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "GET"){
    	 $login = "";
    	 $password = "";
    	 $confirm_password = "";
    	 $first_name = "";
    	 $last_name = "";
    	 $email = "";
    	 
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){

     $login = trim($_POST['user_id']) ; 
     $password = trim($_POST['passwd']) ; 
     $confirm_password = trim($_POST['conf_passwd']);
     $first_name = trim($_POST['first_name']);
     $last_name = trim($_POST['last_name']);
     $email = trim($_POST['email_address']);
     $user_type = $_POST['user_type'];
     $salutation = $_POST['salutation'];
     $street_address1 = trim($_POST['street_address1']);
     $street_address2 = trim($_POST['street_address2']);
     $city = trim($_POST['city']);
     $province = $_POST['formprovince'];
     $postal_code = trim($_POST['postal_code']);
     $primary_phone_number = trim($_POST['primary_phone_number']);
     $secondary_phone_number = trim($_POST['secondary_phone_number']);
     $preferred_contact_method = $_POST['formPreferredContactMethod'];


     $conn = db_connect(); 

     $sql = "SELECT * FROM  users WHERE user_id = '".$login."'"; 

     $results = pg_query($conn, $sql); 

     if(!isset($login)||$login==""){
    		$error.= "You did not enter a user id.";
    }else if(strlen($login) > 20){
    	    $error.= "A user id must be less than  20 characters,".$login. "is too long.<br />";
    	    $login = "";
    }else if(pg_num_rows($results))
     	{ $error .="User id found in the database.<br />";
         $login = "";}

     if(!isset($first_name)||$first_name==""){
    		$error.= "You did not enter your first name.<br />";
     }else if(is_numeric($first_name)){
    		$error .= "Your first name MUST not be a number, you entered: " . $first_name ."<br />";
    		$first_name = "";
    }else if(strlen($first_name) > MAX_NAME){
    	    $error.= "Your first name needs to be less than 128 characters: ". $first_name ." is too long.<br />";
    	    $first_name = "";}

     if(!isset($last_name)||$last_name==""){
    		$error.= "You did not enter your last name.<br />";
     }else if(is_numeric($last_name)){
    		$error .= "Your last name MUST not be a number, you entered: " . $last_name ."<br />";
    		$last_name = "";
    }else if(strlen($last_name) > MAX_NAME){
    	    $error.= "Your last name needs to be less than 128 characters: ". $last_name ." is too long.<br />";
    	    $last_name = "";}

      if(strcmp($password,$confirm_password) <> 0){
      	    $error.="The password and confirm password were not the same.<br />";
      }else if(strlen($password) == 0){ 
            $error .= "You did not enter a password.<br />"; 
      }else if(strlen($password) < MIN_PASS){
    	    $error.= "Your password must be at least 8 characters.<br />";
    	    $password = "";
    	    $confirm_password = "";
      }

     if(strlen($email) == 0){ 
            $error .= "You did not enter an email address."; 
     }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $error .= "<em>". $email . "</em> is not a valid email address."; 
            $email = "";
        }
    if(!isset($street_address1)||$street_address1==""){
        $error.= "You did not enter your street address.<br />";
    }
    else if(strlen($street_address1) > MAX_NAME){
        $error.= "Your street address needs to be less than 128 characters: ". $street_address1 ." is too long.<br />";
        $street_address1 = "";
    }
    if(strlen($street_address2) > MAX_NAME){
        $error.= "Your street address needs to be less than 128 characters: ". $street_address2 ." is too long.<br />";
        $street_address2 = "";
    }
    if(!isset($city)||$city==""){
            $error.= "You did not enter your city.<br />";
     }else if(is_numeric($city)){
            $error .= "Your city MUST not be a number, you entered: " . $city ."<br />";
            $city = "";
    }else if(strlen($city) > MAX_CITY){
            $error.= "Your city needs to be less than 64 characters: ". $city ." is too long.<br />";
            $city = "";
        }
        if(!isset($postal_code)||$postal_code==""){
            $error.= "You did not enter your postal code.<br />";
     }else if(strstr($postal_code, POSTAL_CODE_LETTERS)){
            $error .= "Your city <u>MUST</u> contain POSTAL_CODE_LETTERS <br />";
            $postal_code = "";
    }else if(strlen($postal_code) > POSTAL_CODE_LENGTH){
            $error.= "Your postal code needs to be less than 64 characters: ". $postal_code ." is too long.<br />";
            $postal_code = "";
        }
        if(!isset($primary_phone_number)||$primary_phone_number==""){
            $error.= "You did not enter your primary phone number.<br />";
     }else if(!is_numeric($primary_phone_number)){
            $error .= "Your primary phone number <u>MUST</u> contain numbers <br />";
            $primary_phone_number = "";
    }else if(strlen($primary_phone_number) > MAX_PHONE_LENGTH){
            $error.= "Your primary phone number needs to be less than 15 characters: ". $primary_phone_number ." is too long.<br />";
            $primary_phone_number = "";
        }
     
        
     if(!isset($user_type)){
        $error = "You need to select a user type.<br />";
     }
     if(formProvince==""){
        $error = "You need to select a province.<br />";
     }
     if(formPreferredContactMethod==""){
        $error = "You need to select a preferred contact method.<br />";
     }

       if(strlen($error) == 0){

       	$today = date("Y-m-d",time());

        $insert_user = pg_execute($conn, "user_insert", array($login, $password, $user_type, $email, $today, $today));
     
        $insert_person = pg_execute($conn, "person_insert", array($login, $salutation, $first_name, $last_name, $street_address1, $city, $province, $postal_code, $primary_phone_number, $preferred_contact_method));

       	header("Location:login.php"); 

       }	
   }
//}
?>

<h2>User Registration</h2>
 <hr/>

 <h3><?php echo $error; ?></h3>

<h2>Please register in our system</h2>
<p>Please enter your personal information<br/></p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
	<table border="0">
	<tr>
		<td><strong>Login ID</strong></td>
		<td><input type="text" name="user_id" value="<?php echo $login; ?>" size="20" /></td>
	</tr>
	<tr>
		<td><strong>Password</strong></td>
		<td><input type="password" name="passwd" value="<?php echo $password; ?>" size="20" /></td>
	</tr>
	<tr>
		<td><strong>Confirm Password</strong></td>
		<td><input type="password" name="conf_passwd" value="<?php echo $confirm_password; ?>" size="20" /></td>
	</tr>
	<tr>
		<td><strong>First Name</strong></td>
		<td><input type="text" name="first_name" value="<?php echo $first_name; ?>" size="20" /></td>
	</tr>
	<tr>
		<td><strong>Last Name</strong></td>
		<td><input type="text" name="last_name"  value="<?php echo $last_name; ?>" size="20" /></td>
	</tr>
	<tr>
		<td><strong>Email Address</strong></td>
		<td><input type="text" name="email_address" value="<?php echo $email; ?>" size="20" /></td>
	</tr>
    <tr>
        <td><strong>Street Address 1</strong></td>
        <td><input type="text" name="street_address1" value="<?php echo $street_address1; ?>" size="20" /></td>
    </tr>
    <tr>
        <td><strong>Street Address 2</strong></td>
        <td><input type="text" name="street_address2" value="<?php echo $street_address2; ?>" size="20" /></td>
    </tr>
    <tr>
        <td><strong>City</strong></td>
        <td><input type="text" name="city" value="<?php echo $city; ?>" size="20" /></td>
    </tr>
    <tr>
        <td><strong>Postal Code</strong></td>
        <td><input type="text" name="postal_code" value="<?php echo $postal_code; ?>" size="20" /></td>
    </tr>
    <tr>
        <td><strong>Primary Phone Number</strong></td>
        <td><input type="text" name="primary_phone_number" value="<?php echo $primary_phone_number; ?>" size="20" /></td>
    </tr>
    <tr>
        <td><strong>Secondary Phone Number</strong></td>
        <td><input type="text" name="secondary_phone_number" value="<?php echo $secondary_phone_number; ?>" size="20" /></td>
    </tr>
    <tr>
        <td><strong>User Type</strong></td>
        <td><input type="radio" name="user_type"
        <?php if (isset($user_type) && $user_type=="admin") echo "checked";?>
        value="admin">Admin</td>
        <td><input type="radio" name="user_type"
        <?php if (isset($user_type) && $user_type=="agent") echo "checked";?>
        value="agent">Agent</td>
        <td><input type="radio" name="user_type"
        <?php if (isset($user_type) && $user_type=="client") echo "checked";?>
        value="client">Client</td>
    </tr>
    <tr>
        <td><strong>Salutation</strong></td>
        <td><input type="radio" name="salutation"
        <?php if (isset($salutation) && $salutation=="mr.") echo "checked";?>
        value="mr.">Mr.</td>
        <td><input type="radio" name="salutation"
        <?php if (isset($salutation) && $salutation=="mrs.") echo "checked";?>
        value="mrs.">Mrs.</td>
        <td><input type="radio" name="salutation"
        <?php if (isset($salutation) && $salutation=="ms.") echo "checked";?>
        value="ms.">Ms.</td>
    </tr>
    

        <tr>
            <td><strong>Province</strong></td>
            <td><select name="formProvince">
            <option value="">Select...</option>
            <option value="o">ON</option>
            <option value="q">QB</option>
            <option value="n">NS</option>
            <option value="w">NB</option>
            <option value="p">PE</option>
            <option value="f">NF</option>
            <option value="a">AB</option>
            <option value="b">BC</option>
            <option value="m">MB</option>
            <option value="s">SK</option>
            </select></td>
        </tr>
        <tr>
            <td><strong>Preferred Contact Method</strong></td>
            <td><select name="formPreferredContactMethod">
            <option value="">Select...</option>
            <option value="e">Email</option>
            <option value="p">Phone</option>
            <option value="l">Letter</option>
            </select></td>
        </tr>

    </table>
	<table border="0" cellspacing="15" >
<tr>
	<td><input type="submit" value = "Register" /></td><td><input type="reset" value = "Clear" /></td>
</tr></table>
</form>
<hr/>

<?php include("./footer.php");?> 