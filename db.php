<?php

//connection to mysql using login credentials
	$username = "1417923";
	$password = "Benjamin";
	$database = "db1417923";
	$hostname = "localhost"; 
	mysqli_connect($hostname, $username, $password) or die('MySQL Error.');
	
//select database
		
	mysqli_select_db("$database") or die('MySQL Error.');
		
?>