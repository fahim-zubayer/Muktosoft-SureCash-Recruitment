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
$SPAN=$_GET['time_span'];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$id.'&count=20';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$data= $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$da=json_decode($data,true);

$day=array(""=>0);
$hr=array(""=>0);
$M=array();

$M['Sun']='0'; $M['Mon']='1'; $M['Tue']='2'; $M['Wed']='3'; $M['Thu']='4'; $M['Fri']='5'; $M['Sat']='6';

$da="";
$dcnt=0;

$ha="";
$hcnt=0;

for($x=0;$x<count($da);$x++)
{
	$st=$da[$x]["created_at"];
	$d=$st[0].$st[1].$st[2];
	$d=$M[$d];
	
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
	
	if($day[$d]>$dcnt)
	{
		$dcnt=$day[$d];
		$da=$d;
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
	
	if($hr[$t]>$hcnt)
	{
		$hcnt=$hr[$t];
		$ha=$t;
	}
	
	echo $st."<br>";
	echo $d." ".$t."<br>";
	
	echo "-------<br>";
}

arsort($hr);
arsort($day);

if($SPAN=='hour')
{
	/*$s=json_encode($hr);
	$k="";
	for($a=0;$a<8;$a++) $k=$k.$s[$a];
	$k=$k.'}';
	print $k;*/
	print(json_encode(array($ha=>$hcnt)));
}
else
{
	print(json_encode(array($da=>$dcnt)));
}

?>
