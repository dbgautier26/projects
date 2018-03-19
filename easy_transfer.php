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

<div align="center">
<H1 style="text-align:center;font-size:large;font-color:aqua">
<STRONG>Welcome to Easy Transfer</STRONG>
</H1>
<form align="center" action="currency_converter.php " method="post">
<div id="box">
<h2><center>Currency Converter</center></h2>
<table>
 <tr>
 <td>
 Enter Amount:<input type="text" name="amount"><br>
 </td>
 </tr>
 <tr>
 <td>
 <br><center>From:<select name='cur1'>
<?php
//retrieve information about exchange rates
require ("data.php");

//connection to mysql using login credentials and selection of database
	require("db.php");
	
// Assume $db is a PDO object
// Run your query
$query = $db->query("SELECT Rates.currency_name FROM rates"); 
?>
<select name="select your currency">; 

<?php
// Loop through the query results, outputing the options one by one
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
  <option value="'.$row.'">
  <?php
  echo $row;
  ?>
  </option>
<?php
}
?>
</select>
</td>
</tr>
<tr>
 <td>
 <br><center>To:<select name='cur2'>
 <select>
 <?php
// Assume $db is a PDO object
// Run your query
$query = $db->query("SELECT Rates.currency_name FROM Rates"); 
?>
<select name="select your currency">; 

<?php
// Loop through the query results, outputing the options one by one
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
  <option value="'.$row.'">
  <?php
  echo $row;
  ?>
  </option>
<?php
}
?>
 </select>
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