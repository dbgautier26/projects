<?php
//Refresh page after every 300seconds(5 minutes) to get updated rates and currencies
  
  header("Refresh:300");
	
//connection to mysql using login credentials and selection of database
	$conn = mysqli_connect('localhost', '1417923', 'Benjamin', 'db1417923');
		
//Get rates from xml file
  $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml"); 

	foreach($XML->Cube->Cube as $drate){ 
 	
		foreach($drate->Cube as $rate){ 
  
		//escape and redefine our variables
			$rate_currency = mysqli_escape_string($conn, $rate["currency"]);
			$rate_rate = mysqli_escape_string($conn, $rate["rate"]);
			$rate_date = mysqli_escape_string($conn,$drate["time"]);
		
		// Check connection
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			else{
			//insert values to database
				$query = "INSERT INTO `Rates` (currency_name, exchange_rate, date_saved) VALUES ('$rate_currency', '$rate_rate', NOW())";		
				$result = mysqli_query($conn, $query);
		
				if (false===$result){
				printf("error: %s\n", mysqli_error($conn));
				} 
				else {
				}		
			}
		}
	}	
?>