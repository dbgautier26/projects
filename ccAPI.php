<?php
//set access permissions
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

//check if format set
if(isset($_GET['format'])) {

//Set our variables
$format = strtolower($_GET['format']);

//connection to mysql using login credentials and selection of database
$conn = mysqli_connect('localhost', '1417923', 'Benjamin', 'db1417923');

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
else{
echo 'no format set' ;
}
?>