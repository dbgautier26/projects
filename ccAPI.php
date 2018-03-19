<?php

if(isset($_GET['currency'])&& isset($_GET['amount'])) {
 
 //Set our variables
$currency_given = strtolower($_GET['cur1']);
$amount = strtolower($_GET['amount']);  

//connection to mysql using login credentials and selection of database
		
	require("db.php");

//Run our query
$result = mysqli_query("SELECT * FROM Rates WHERE currency_name='$currency_given' and date_saved='NOW() - INTERVAL 5 MINUTE'") or die('MySQL Error.');
 
//Preapre our output
if($format == 'json') {
 
$rate = array();
while($rate = mysqli_fetch_array($result, MYSQL_ASSOC)) {
$rates[] = array('post'=>$rate);
}
 
$output = json_encode(array('posts' => $rates));
 
} 

elseif($format == 'xml') {
 
header('Content-type: text/xml');
$output  = "<?xml version=\"1.0\"?>\n";
$output .= "<rates>\n";
 
for($i = 0 ; $i < mysqli_num_rows($result) ; $i++){
$row = mysqli_fetch_assoc($result);
$output .= "<rate> \n";
$output .= "<currency_name>" . $row['currency_name'] . "</currency_name> \n";
$output .= "<exchange_rate>" . $row['exchange_rate'] . "</exchange_rate> \n";
$output .= "<date_saved>" . $row['date_saved'] . "</date_saved> \n";
$output .= "</rate> \n";
}
 
$output .= "</rates>";
 
}

 else {
die('Improper response format.');
}
 
//Render the output.
echo $output;

}

?>