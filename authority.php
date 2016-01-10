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
$tweet=$_GET['tweet'];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$id.'&count=200';
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
	$ar=preg_split("[\s]",$st);

	for($a=0;$a<count($ar);$a++)
	{
		array_push($word_list,$ar[$a]);
	}
	//echo $st;
	//echo "-------<br>";
}


$ar=preg_split("[\s]",$tweet);
$prob=1;

for($a=0;$a<count($ar);$a++)
{
	if(!in_array($ar[$a],$word_list))
	{
		$prob=$prob*(1.00/rand(2,6));
	}
}

$ar=array("twitter_id"=>$id, "tweet"=>$tweet, "probability"=>$prob);

print(json_encode($ar));

?>
