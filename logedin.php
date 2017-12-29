<?php
	include("auth.php"); //include auth.php file on all secure pages
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Logged In</title>

	</head>
	<body>
		<div class="form">
		<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		<p>successfully logged in.</p>
		<a href="logout.php">Logout</a>

		</div>
	</body>
</html>
