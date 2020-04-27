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

  
  
 //Password validation
 if(!isset($new_Password) || $new_Password == "") {
	 $error .= "please enter a new password<br/>";
     $new_password = "";
 }
 else i(strlen($new_password) < MIN_PASS){
	 $error .= "please enter a new password longer that" . MIN_PASS "<br/>";
	 $new_password = "";
 }
 else if(strcmp($current_Password, $new_password)){
	  $error .= "The new and old password cannot be same. <br/>";
	$confirm_password = "";
	$new_password = "";
 }
 if(!isset($current_assword) || $current_password == "") {
           $error .= "did not enter a password<br/>";
           $current_Password = "";
        }
else if(!password_check($current_password, $password)){
	$error .= "The password is not valid <br />";
	$confirm_password;
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