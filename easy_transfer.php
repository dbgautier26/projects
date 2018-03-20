<!DOCTYPE html>
<HTML>
<HEAD>
<META name="viewport" content="width=device-width, initial-scale=1, userscalable=yes, max-width=100%">
<link rel="stylesheet" type="text/css" href="client.css">
<TITLE> </TITLE>
</HEAD>
<BODY>
<?php//retrieve information about exchange rates
	require 'data.php';
?>

<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<div align="center">
<H1 style="text-align:center;font-size:large;font-color:aqua">
<STRONG>Welcome to Easy Transfer</STRONG>
</H1>
<form action="currency_converter.php " method="post">
<div id="box">
<h2><center>Currency Converter</center></h2>
<table>
 <tr>
 <td>
 Enter Amount:<input type="number" name="amount"><br>
 </td>
 </tr>
 <tr>
 <td>
 <br><center>From:
<?php

//connection to mysql using login credentials and selection of database
	$conn = mysqli_connect('localhost', '1417923', 'Benjamin', 'db1417923');
	
// Run your query
$query = "SELECT currency_name FROM Rates"; 
$result = mysqli_query($conn, $query);

echo "<select id='cur1' name='cur1'>"; 

// Loop through the query results, outputing the options one by one
	while ($row = mysqli_fetch_array($result)) {
	echo "<option value='" . $row['currency_name'] . "'>" . $row['currency_name'] . "</option>";
	}
	
echo "</select>"
?>
</td>
</tr>
<tr>
 <td>
 <br><center>To:<?php

//connection to mysql using login credentials and selection of database
	$conn = mysqli_connect('localhost', '1417923', 'Benjamin', 'db1417923');
	
// Run your query
$query = "SELECT currency_name FROM Rates"; 
$result = mysqli_query($conn, $query);

echo "<select id='cur2' name='cur2'>"; 

// Loop through the query results, outputing the options one by one
	while ($row = mysqli_fetch_array($result)) {
	echo "<option value='" . $row['currency_name'] . "'>" . $row['currency_name'] . "</option>";
	}
	
echo "</select>"
?>
</td>
</tr>
<tr>
<td><center><br>
<input type='submit' name='submit' value="Covert Now"></center>
</td>
</tr>
</table>
</form>
<P>
<STRONG>THANK YOU</STRONG><BR>
</P>
</div>
</BODY>
</HTML>