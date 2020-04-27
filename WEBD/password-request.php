<?php

 require "./header.php";

 session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$conn = db_connect();

	$uid = FALSE;

	if(!empty($_POST['email'])){

		$sql = 'SELECT user_id FROM users WHERE email = "'.pg_escape_string($conn,$_POST['email']).'"';
		$results = pg_prepare($conn, "my_query", $sql); 
        $results = pg_execute($conn, "my_query");


		if(pg_num_rows($results) == 1){

			$row = pg_fetch_array($results);
			$uid = $row["user_id"];

			redirect('./login.php');

			
			
		}else{
			echo "The submitted email address does not match those on file.";
		}

	}else{
		echo "You forgot to enter your email address!";
	}


if($uid){

	$code = substr(md5(uniqid(rand(),true)), 0, 8);
	$ph = hash($code);

	$sql = "UPDATE users SET password='$ph' WHERE user_id = $uid LIMIT 1"; 
    $results = pg_prepare($conn, "my_query", $sql); 
    $results = pg_execute($conn, "my_query");

    if(pg_affected_rows($conn) == 1){

    	$body = "Your password has been temporarily changed to '$code'. Please
    	log in using this password and this email address. Then you may change 
    	your password.";

    	mail($_POST['email'],'Your temporary password', $body, 'From: admin@dreamhome.com');

    	echo 'Your password has been changed. You will receive the new, temporary password
    	at the email address with which you registered. Once you have logged in with this password
    	,you may change it by clicking on the "<a href="user-password.php">change Password</a>" link.';

    }else {

    	echo "Your password could not be changed due to a system error.";
    }
 
}else{

	echo "Please try again.";
}



}

?>



<h1>Request For New Password</h1>
<p>Enter your email address below and your password will be reset.</p>
<form action="password-request.php" method="post">
	<fieldset>
		<p><strong>Email Address:</strong><input type="email" name="email" size="20"
			maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
	</fieldset>
    <div align="center"><input type="submit" name="submit" value="Reset My Password"></div>
</form>


<?php include("./footer.php");?> 