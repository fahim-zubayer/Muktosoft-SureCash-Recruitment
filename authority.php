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
$SPAN=$_GET['tweet'];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$id.'&count=5';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$data= $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$da=json_decode($data,true);

$word_list=array();

for($x=0;$x<count($da);$x++)
{
	$st=$da[$x]["text"];
	$word_list=array_merge($word_list,preg_split(" ",$st));
	echo $st;
	echo "-------<br>";
}


?>
