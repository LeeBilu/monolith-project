<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$con = mysqli_connect($host,$username,$password, $dbname);
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysql_connect_error();
  }
?>