<?php
//Refresh page after every 300seconds(5 minutes) to get updated rates
  
  header("Refresh:300");
  
//Get rates from xml file

  $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml"); 
             
  foreach($XML->Cube->Cube as $drate){ 
  
  foreach($drate->Cube as $rate){ 

	//connection to mysql using login credentials and selection of database
		require("db.php");
	
	//insert values to database
		foreach ($drate["time"] as $value){
		$query = $pdo->prepare('INSERT into Rates  "id, '.$rate["currency"].', '.$rate["rate"].', '.$value.'"');
		$query->execute();
		$result = $query->fetchAll();
		}
	}

}	
?>