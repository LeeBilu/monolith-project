<!DOCTYPE html>
<html>
	<head>

		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</head>
	<body>
		<?php
			require('db.php');

			// If form submitted, insert values into the database.
			if (isset($_POST['email'])){
				$email = stripslashes($_REQUEST['email']); // removes backslashes
				$email = mysqli_real_escape_string($con,$email); //escapes special characters in a string
				
				//Checking is user existing in the database or not
				$query = "SELECT * FROM `users` WHERE email='$email'";
				$result = mysqli_query($con,$query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
				if($rows==1){
					$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$newpass = '';
					$max = strlen($keyspace) - 1;
					for ($i = 0; $i < 6; ++$i) {
						$newpass .= $keyspace[rand(0, $max)];
					}
					//Send a mail with the new random password.
					$subject = "Reset password";
					$txt = "Your new password is: $newpass";
					$headers = "From: bilu30@gmail.com";
					$sql = "UPDATE `users` SET password='".md5($newpass)."' WHERE email='$email'";
					mysqli_query($con, $sql) or die(mysql_error());
					if(mail($email,$subject,$txt,$headers)){
						echo "<div class='form'><h3>The new password sent</h3><br/>Click here to <a href='login.php'>Login</a></div>";
					} else {
						echo "<div class='form'><h3>There was a problem.</h3><br/>Click here to <a href='forgotpassword.php'>Try again</a></div>";
					}
				}else{
						echo "<div class='form'><h3>Email is incorrect.</h3><br/>Click here to <a href='forgotpassword.php'>try again</a></div>";
				}
			}else{
		?>
		<div class="container">
			<h1>Forgot Password</h1>
			</br>
			<form action="" method="post" name="reset" class="form-inline">
				<div class="form-group">
					<label for="email">Email:</label>
					</br>
					<input type="email" name="email" placeholder="Email" class="form-control" required />
				</div>
				</br>
				</br>
				<input name="submit" type="submit" value="Reset Password" class="form-control"  />
			</form>
			<p>Click here to <a href='login.php'>Login</a></p>
		</div>
		<?php } ?>
	</body>
</html>
