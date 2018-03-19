<!DOCTYPE html>
<HTML>
<HEAD>
<META name="viewport" content="width=device-width, initial-scale=1, userscalable=yes, max-width=100%">
<link rel="stylesheet" type="text/css" href="client.css">
<TITLE> </TITLE>
</HEAD>
<BODY>
<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<?php

//check if parameters are passed correctly
if(isset($_GET['cur1'])&& isset($_GET['cur2'])&& isset($_GET['amount'])) {
 
//Set our variables
$currency_given = strtolower($_GET['cur1']);
$currency_wanted = strtolower($_GET['cur2']);
$amount = $_GET['amount'];

//check if amount is a positive interger greater than zero
if(ctype_digit($amount) && ($amount>0)){

//Make a call to our API
$format = array("json", "xml");
$random =array_rand($format,1);
if($format[$random[0]] == 'json'){
$url="/ccAPI.php?format=json";
//data will be rendered in json then decoded and appropriate information assigned to variables
$response=file_get_contents($url);
$obj=json_decode($response);
foreach($obj->posts as $convert){
$currency_name = $convert->post->currency_name;
$rate_value = $convert->post->exchange_rate;
$date = $convert->post->date_saved;

//check if original currency is EURO
if($currency_given=='EUR'){
echo "<center><b>Your Converted Amount is:</b><br></center>";
	
//Get converted amount
$total= $amount * $rate_value;
echo "<center> your amount is ".$total. ' ' .$currency_wanted."</center>";
}

else{
echo "<center><b>Your Converted Amount is:</b><br></center>";
	
//Get converted amount
$total= $amount / $rate_value;
echo "<center> your amount is ".$total. ' ' .$currency_wanted."</center>";
	
}
}
}
elseif($format[$random[0]] == 'xml'){
$url="/ccAPI.php?format=xml";
$XML=simplexml_load_file($url); 
             
  foreach($XML->rates->rate as $cube){ 	
	$currency_name = $cube->currency_name;
	$rate_value = $cube->exchange_rate;	
	$date = $cube->date_saved;

//check if original currency is EURO
if($currency_given=='EUR'){
echo "<center><b>Your Converted Amount is:</b><br></center>";
	
//Get converted amount
$total= $amount * $rate_value;
echo "<center> your amount is ".$total. ' ' .$currency_wanted."</center>";
}

else{
echo "<center><b>Your Converted Amount is:</b><br></center>";
	
//Get converted amount
$total= $amount / $rate_value;
echo "<center> your amount is ".$total. ' ' .$currency_wanted."</center>";
	
}
}
//throw error if format is not properly set
else{
	echo 'wrong format';
}
}
//throw error if amount is not properly entered
else{
	echo 'enter a proper amount';
}
}

//throw error if variables are not set
else{
	echo 'oops, something went wrong'; 
}
?>
</BODY>
</HTML>