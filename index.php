<?php
$end=urlencode($_GET["address"]);
#if($end=="")
#{
#echo '
#		<form method="POST">
#		<h4>Location?</h4>
#		Username <input type="text" name="u" value=""> <br>
#		<input type="submit" value="Submit">
#		</form>
#		<br>
#		';

$basicURL = "http://maps.googleapis.com/maps/api/geocode/json?address=";
#$end = urlencode($_POST['u']);
#}
if($end)
{
	header('Content-Type: text/plain');
	$finalURL=$basicURL . $end;
	$homepage = file_get_contents($finalURL);
	$data = json_decode($homepage);
	echo $homepage;
	$end="";
}
?>
