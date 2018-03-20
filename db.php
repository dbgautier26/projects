<?php

//connection to mysql using login credentials
	$username = "1417923";
	$password = "Benjamin";
	$database = "db1417923";
	$hostname = "localhost"; 
	mysqli_connect($hostname, $username, $password, $database);
	
	if (mysqli_connect_errno()){
		
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  
	}
  
//select database
	$con = 	mysqli_connect($hostname, $username, $password, $database);

	mysqli_select_db($con, $database) or die('MySQL Error.');
		
?>