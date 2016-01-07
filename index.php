<?php
$end="";
if($end=="")
{
echo '
		<div id="login">
		<form method="POST" action="login.php">
		<h4>Location?</h4>
		Username <input type="text" name="u" value=""> <br>
		<input type="submit" value="Submit">
		</form>
		</div>
		<br>
		';

$basicURL = "http://maps.googleapis.com/maps/api/geocode/json?address=";
$end = urlencode($_POST['u']);
}
if($end)
{
	$finalURL=$basicURL . $end;
	$homepage = file_get_contents($finalURL);
	$data = json_decode($homepage);
	echo $homepage;

	#echo $data['status'];
	$end="";
}
?>
