<?php

  require "./header.php";
  global $conn;

  $error = "";
  
if($_SERVER['REQUEST_METHOD'] == "GET"){
    	
  $current_password = "";
  $new_password = "";
  $confirm_password = "";
    	
    	 
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
  
  $current_password = trim($_POST['password']);
  $new_password = trim($_POST['newpassword']);
  $confirm_password = trim($_POST['confirmpassword']);

  
  //password validation
  if(!isset)
  
  
  try {
  	
  	if ($new_passwd != $new_passwd2) {
  		throw new Exception('Passwords entered were not the same. Not changed.');
  	}
  	if ((strlen($new_passwd) > MAXIMUM_PASSWORD_LENGTH) || (strlen($new_passwd) < MINIMUM_PASSWORD_LENGTH)){

  		throw new Exception('New password must be between 6 and 15 characters. Try again.');
  	}
	
	pg_execute($conn, "password_change",$new_passwd, $_SESSION['user']['user_id']);
	redirect('./dashboard.php');

  	//change_password($_SESSION['valid_user'], $password, $new_passwd);

  	echo 'Password changed.';
  }

  catch (Exception $e) {
  	echo $e->getMessage();

  }

 }
  
?>





<form  method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>"  >
<table border="0">
<tr>
	<td><strong>Password</strong></td>
	<td><input type="password" name="password" value="<?php echo $current_password; ?>" size="20" /></td>
</tr>
<tr>
	<td><strong>New Password</strong></td>
	<td><input type="password" name="newpassword" value="<?php echo $new_password; ?>" size="20" /></td>
</tr>
<tr>
	<td><strong>Retype Your New Password</strong></td>
	<td><input type="password" name="confirmpassword" value="<?php echo $confirm_password; ?>" size="20" /></td>
</tr>
</table>
<table border="0" cellspacing="15" >
<tr>
	
	<td><input type="reset" value = "Reset" /></td>
</tr>
</table>
</form>


 <?php include("./footer.php");?> 