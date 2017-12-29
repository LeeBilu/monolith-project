
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>Registration</title>

	</head>
	<body>
		<?php
			require('db.php');
			// If form submitted, insert values into the database.
			if (isset($_REQUEST['username'])){
				$username = stripslashes($_REQUEST['username']); // removes backslashes
				$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
				$email = stripslashes($_REQUEST['email']); // removes backslashes
				$email = mysqli_real_escape_string($con,$email);//escapes special characters in a string
				$password = stripslashes($_REQUEST['password']); // removes backslashes
				$password = mysqli_real_escape_string($con,$password);//escapes special characters in a string
				$emailensure = stripslashes($_REQUEST['emailensure']); // removes backslashes
				$emailensure = mysqli_real_escape_string($con,$emailensure); //escapes special characters in a string
				$passwordensure = stripslashes($_REQUEST['passwordensure']); // removes backslashes
				$passwordensure = mysqli_real_escape_string($con,$passwordensure); //escapes special characters in a string
				date_default_timezone_set('Asia/Jerusalem');
				//check if both the passwords are the same.
				if(strcmp($passwordensure, $password)){
					echo "<div class='form'><h3>The Password is incorrect</h3><br/>Click here to <a href='registration.php'>Try again</a></div>";
				//check if both the emails are the same.
				} else if(strcmp($emailensure, $email)){
					echo "<div class='form'><h3>The Email is incorrect</h3><br/>Click here to <a href='registration.php'>Try again</a></div>";
				//add the user to the database.
				} else{
					$trn_date = date("Y-m-d H:i:s");
					$sql = "SELECT * FROM `users` WHERE email='$email'";
					$results = mysqli_query($con,$sql);
					$rows = mysqli_num_rows($results);
					if($rows  == 0){
						$query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
						$result = mysqli_query($con,$query);
						if($result){
							echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
						}
					} else {
					echo "<div class='form'><h3>Email is already used.</h3><br/>Click here to <a href='registration.php'>register again</a></div>";
					} 
				}
			}else{
		?>
		<div class="container">
			<h1>Registration</h1>
			<form name="registration" action="" method="post" class="form-inline">
				<div class="form-group">
					<label for="username">Username:</label>
					</br>
					<input type="text" name="username" placeholder="Username" class="form-control" required />
				</div>
				</br>
				</br>
				<div class="form-group">
					<label for="email">Email:</label>
					</br>
					<input type="email" name="email" placeholder="Email" class="form-control" required />
				</div>
				</br>
				</br>
				<div class="form-group">
					<label for="email">Enter Email again:</label>
					</br>
					<input type="email" name="emailensure" placeholder="Email" class="form-control" required />
				</div>
				</br>
				</br>
				<div class="form-group">
					<label for="password">Password:</label>
					</br>
					<input type="password" name="password" placeholder="Password" class="form-control" required />
				</div>
				</br>
				</br>
				<div class="form-group">
					<label for="password">Enter Password again:</label>
					</br>
					<input type="password" name="passwordensure" placeholder="Password" class="form-control" required />
				</div>
				</br>
				</br>
				<input type="submit" name="submit" value="Register" class="btn btn-default"/>
			</form>
			<p>Click here to <a href='login.php'>Login</a></p>
			<p>Forgot Password? <a href='forgotpassword.php'>Reset Here</a></p>
		</div>
		<?php } ?>
	</body>
</html>
