<?php

  require "./header.php";

  if(!isset($_SESSION['user']))
  {
  	redirect('./login.php');
  }
  elseif($_SESSION['user']['user_type'] != ADMIN)
  {
  	redirect('./login.php');
  }
  ?>

  <h1>Admistration</h1>
			<p>Dear Administrator, <?php echo $_SESSION['user']['user_id']?> you have logged in!</p> 
		
				<table border="1" width="60%">
					<caption>Information</caption>
					<tr>
						<th>Fields</th>
						<th>Description</th>
					</tr>
					<tr>
						<td>detail of agents</td>
						<td>10</td>
					</tr>
					<tr>
						<td>detail of pending agents</td>
						<td>3</td>
					</tr>
					<tr>
						<td>detail of listings</td>
						<td>100</td>
					</tr>
					
					<tr>
						<td>detail of Clients</td>
						<td>200</td>
					</tr>
					<tr>
						<td>detail of disabled users</td>
						<td>3</td>
					</tr>
					
				</table>

 <ul>
  <li><a href="logout.php">Log out</a></li>
  <li><a href="register.php">Update Your Information</a></li>
  <li><a href="change-password.php">Change Password</a></li>
</ul>

  <?php include("./footer.php");?> 