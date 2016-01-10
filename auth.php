<?php
$consumer_key="6MOgL9Rkkt27A5l9HRfBHjpdN";
$consumer_secret="ZwrViGS9tRdVAt5CAooBQOaO8iGZrE1LQGmMWmwLp2j4jOD7TL";

$ckey=$consumer_key.":".$consumer_secret;

$encoded=base64_encode($ckey);


$url ='https://api.twitter.com/oauth2/token';

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Authorization: Basic '.$encoded.';Content-type: application/x-www-form-urlencoded',
        'content' => 'grant_type=client_credentials'
    )
);

$context = stream_context_create($opts);

$result = file_get_contents($url, false, $context);
$data = json_decode($result,true);

$s=$data["access_token"];

echo $s."\n";


$o="Authorization: Bearer ".base64_encode($s);

$url ='https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=twitterapi&count=2';

$opts = array('http' =>
    array(
        'method'  => 'GET',
        'header'  => $o,
        'content' => 'grant_type=client_credentials'
    )
);

$context = stream_context_create($opts);

$result = file_get_contents($url, false,$context);
echo $result;
$data = json_decode($result,true);

?>
