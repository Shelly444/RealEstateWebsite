<?php
/*
Hector Mariscal, Michelle Kirkwood
October 2018
WEBD3201
*/
	$title = "User Login";
	$file = "login.php";
	$description = "";
	$date = "October 1, 2018";
	$banner = "User Login";
	include('./header.php');
	$message = "";
	$error = "";
?>


<?php	
//$message = $_SESSION['message'];

if($_SERVER["REQUEST_METHOD"] == "GET"){
	//default mode when the page loads the first time
	//can be used to make decisions and initialize variables
	$login = (isset($_COOKIE['user_login'])) ? $COOKIE['user_login']: "";
	$password = "";
	$user_type = "";
	$last_access = "";
}else if($_SERVER["REQUEST_METHOD"] == "POST"){
	//the page got here from submitting the form, let's try to process
	$login = trim($_POST["inputted_login"]); //the name of the input box on the form, white-space removed
	$password = trim($_POST["inputted_password"]);
	$result = pg_execute($conn, "user_login", array($login, hash(HASH_ALGO, $password)));
	$persons_sql = "SELECT * FROM  persons WHERE user_id = '".$login."'";
	$result2 = pg_query($conn, $persons_sql);
	$records = pg_num_rows($result);
	$records2 = pg_num_rows($result2);
	if ($records <= 0)
	{
		$error = "You were not found in our database. Please try again!";
        $login = "";
        $password = "";
	}
	else
	{
		    if(isset($_SESSION['user']))
            {
                unset($_SESSION['user']);
            }
			$user = pg_fetch_assoc($result, 0);
            $_SESSION['user'] = $user;
            $person = pg_fetch_assoc($result2, 0);
            $_SESSION['person'] = $person;
            $error = "";
            setcookie("inputted_login", $user['inputted_login'], time()+ COOKIE_LIFESPAN);
			
			if(lastAccessUpdate($login) == 0)
            {
                $sql = "UPDATE users SET last_access = '". date("Y-m-d", time()) . "' WHERE user_id = '" . $login."' ";
                $result = pg_query($conn, $sql);
            }
            $last_access = $_SESSION['user']['last_access'];
			
			if($_SESSION['user']['user_type'] == CLIENT)
            {
                redirect('./welcome.php');
            }
            else if($_SESSION['user']['user_type'] == AGENT)
            {
               
                redirect('./dashboard.php');
            }	
            else if($_SESSION['user']['user_type'] == ADMIN)
            {
               
                redirect('./admin.php');
            }	
			else if($_SESSION['user']['user_type'] == PENDING)
            {
                $error = "You haven't been approved yet!";
            }
            else if($_SESSION['user']['user_type'] == DISABLED)
            {
                $error = "Your account has been disabled!";
            }
	}
					
}


?>
				<h3>Please log in</h3>
				<p>Enter your login ID and password to connect to this system</p><br/>
<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
	<table width="350" cellpadding="0" cellspacing="0" border="0" style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>
				Login ID
			</td>
			<td>
				<input type="text" name="inputted_login" value="<?php echo $login; ?>" size="25" />
			</td>
		</tr>
		<tr>
			<td>
				Password
			</td>
			<td>
				<input type="password" name="inputted_password" size="25" />
			</td>
		</tr>
		<tr>
			<td>
				<br/><input type="submit" value="Log In" />
				<input type="reset"/>
			</td>
		</tr>
		
	</table>
</form>
<p>Please wait after pressing <b>Log in</b> while we retrieve your records from our database.</p>
<h4><i>(This may take a few moments)</i></h4>
<hr/>

<?php echo $message;?><br/>
<h3><?php echo $error; ?></h3><br/>

<?php include ('./footer.php'); ?>
