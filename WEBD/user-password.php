<?php
   //This page allows a logged-in user to change their password.
    require "./header.php";

    //If no user_id session variable exists, redirect the user:
    if (!isset($_SESSION['user_id'])){
    	
    	$url = BASE_URL.'index.php';
    	ob_end_clean();//Delete the buffer

    	header("Location:$url");
    	exit(); //Quit the script.
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	require(MYSQL);

    	//Check for a new password and match against the confirmed password:
    	$p = FALSE;
    	if ((strlen($_POST['password1']) > MAXIMUM_PASSWORD_LENGTH) || (strlen($_POST['password1']) < MINIMUM_PASSWORD_LENGTH)){
    		if ($_POST['password1'] == $_POST['password2']){
    			$p = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    		} else {
    			echo '<p class="error">Your password did not match the confirmed password</p>';
    		}
    	} else {
          echo '<p class="error">Please enter a valid password!</p>';
    	}

    	if ($p) { //If everything is OK.

    		//Make the query:

    		$sql = "UPDATE users SET pass='$p' WHERE user_id={$_SESSION['user_id']} LIMIT 1";

    		$results = pg_query($conn, $sql);
    		if(pg_fetch_array($result) == 1){

    			echo '<h3>Your password has been changed.</h3>';
    			if($_SESSION['user']['user_type'] == CLIENT)
            {
                $_SESSION['message'] = "You've logged in as a client!";
                redirect('./welcome.php');
            }
            else if($_SESSION['user']['user_type'] == AGENT)
            {
                $_SESSION['message'] = "You've logged in as an agent!";
                redirect('./dashboard.php');
            }	
            else if($_SESSION['user']['user_type'] == ADMIN)
            {
                $_SESSION['message'] = "You've logged in as an Administrator!";
                redirect('./admin.php');
            }	
            
    		} else {
    			echo '<p class="error">Your password was not changed. Make sure your new password is different than 
    			the current password. Contact the system administrator if you think an error occurred.</p>';
    		}

    	} else {
    		echo '<p class="error">Please try again.</p>';
    	}
    	mysql_close($conn); //Close the database connection.
    }

 ?>

 <h1>Change Your Password</h1>
 <form action="user-password.php" method="post">
 	<fieldset>
 		<p><strong>New Password:</strong> <input type="password" name="password1" size="20">
 			<small>At least 6 charactors long.</small></p>
 		<p><strong>Confirm New Password:</strong> <input type="password" name="password2" size="20"></p>
 	</fieldset>
 	<div align="center"><input type="submit" name="submit" value="Change My Password"></div>
 </form>

  <?php include("./footer.php");?>