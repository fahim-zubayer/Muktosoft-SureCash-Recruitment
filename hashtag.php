<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "4736135894-gwQ2zxxCHIp2az1fdWCHi5AfIr7f9UzdwG7cpFB",
    'oauth_access_token_secret' => "r5Y8TpiYRXw9TJmNQyyWDVKhX2KjFRys0Z76H76fpxooe",
    'consumer_key' => "6MOgL9Rkkt27A5l9HRfBHjpdN",
    'consumer_secret' => "ZwrViGS9tRdVAt5CAooBQOaO8iGZrE1LQGmMWmwLp2j4jOD7TL"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/

$id=$_GET['twitter_id'];
$cnt=$_GET['n'];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$id.'&count=200';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$data= $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$da=json_decode($data,true);

$ans=array();

for($x=0;$x<count($da);$x++)
{
	$cn=count($da[$x]["entities"]["hashtags"]);
	if($cn==0) continue;

	for($a=0;$a<count($da[$x]["entities"]["hashtags"]);$a++)
	{
		$tag=$da[$x]["entities"]["hashtags"][$a]["text"];
		
		//echo $tag."<br>";
		
		if(!isset($ans[$tag]))
		{
			$ans[$tag]=1;
		}
		else
		{
			$c=$ans[$tag];
			$c++;
			$ans[$tag]=$c;
		}
		
	}
	//echo "-------<br>";
}

arsort($ans);

$ans=array_slice($ans,0,$cnt);

$an=json_encode($ans);

print($an);
