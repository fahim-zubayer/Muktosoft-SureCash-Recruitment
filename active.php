<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');


$settings = array(
    'oauth_access_token' => "4736135894-gwQ2zxxCHIp2az1fdWCHi5AfIr7f9UzdwG7cpFB",
    'oauth_access_token_secret' => "r5Y8TpiYRXw9TJmNQyyWDVKhX2KjFRys0Z76H76fpxooe",
    'consumer_key' => "6MOgL9Rkkt27A5l9HRfBHjpdN",
    'consumer_secret' => "ZwrViGS9tRdVAt5CAooBQOaO8iGZrE1LQGmMWmwLp2j4jOD7TL"
);


$id=$_GET['twitter_id'];
$cnt=$_GET['time_span'];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$id.'&count=20';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$data= $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$da=json_decode($data,true);

$day=array();
$hr=array();

for($x=0;$x<count($da);$x++)
{
	$st=$da[$x]["created_at"];
	$d=$st[0].$st[1].$st[2];
	
	if(!isset($day[$d]))
		{
			$day[$d]=1;
		}
		else
		{
			$c=$day[$d];
			$c++;
			$day[$d]=$c;
		}
	
	$t=$st[11].$st[12];
	
	if(!isset($hr[$t]))
		{
			$hr[$t]=1;
		}
		else
		{
			$c=$hr[$t];
			$c++;
			$hr[$t]=$c;
		}
	echo $st."<br>";
	echo $d." ".$t."<br>";
	
	echo "-------<br>";
}
/*
arsort($ans);

$ans=array_slice($ans,0,$cnt);

$an=json_encode($ans);

print($an);
*/

?>
