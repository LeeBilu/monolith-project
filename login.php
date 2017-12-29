
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Login</title>

	</head>
	<body>
		<?php
			require('db.php');
			session_start();
			// If form submitted, try to insert values into the database.
			if (isset($_POST['email'])){
			
				$email = stripslashes($_REQUEST['email']); // removes backslashes
				$email = mysqli_real_escape_string($con,$email); //escapes special characters in a string
				$password = stripslashes($_REQUEST['password']); // removes backslashes
				$password = mysqli_real_escape_string($con,$password); //escapes special characters in a string
				
				//Checking if user existing in the database or not
				$query = "SELECT * FROM `users` WHERE email='$email' and password='".md5($password)."'";
				$result = mysqli_query($con,$query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
				$arr =  mysqli_fetch_array($result);
				
				if($rows==1){
					$_SESSION['username'] = $arr['username'];
					header("Location: logedin.php"); // Redirect user to index.php
					}else{
						echo "<div class='form'><h3>Email/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
						}
			}else{
		?>

		<div class="container">
			<h1>Login</h1>
		  
			<form class="form-inline" action="" method="post" name="login">
				<div class="form-group">
					<label for="email">Email:</label>
					</br>
					<input type="email" name="email" placeholder="Email" class="form-control" required />
				</div>
				</br>
				</br>
				<div class="form-group">
					<label for="pwd">Password:</label>
					</br>
					<input type="password" class="form-control" id="pwd" placeholder="Password" name="password" required/>
				</div>
				</br>
				</br>
				<button type="submit" class="btn btn-default">Login</button>
				</br>
				</br>
			</form>
			<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
			<p>Forgot Password? <a href='forgotpassword.php'>Reset Here</a></p>
			</div>

		<?php } ?>


	</body>
</html>
