<?php

include_once('twitteroauth-master/autoload.php');

use Abraham\TwitterOAuth\TwitterOAuth;

die('Wrong Account was set');


$consumerKey = '******************************';
$consumerSecret = '********************************';
$accessToken = '******************************************';
$accessTokenSecret = '**********************************************';

$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$oppar = file_get_contents('oppar.json');
$opparEntries = json_decode($oppar);


//print_r((array) $opparEntries);
$oppar1 = (array) $opparEntries;
$oppardata = $oppar1['data'];

$first_value = reset($oppardata); // First Element's Value
$first_key = key($oppardata); // First Element's Key

$oppardata3 = (array) $first_value;

//echo $oppardata3[array_rand($oppardata3)];
$alleReime = array();

foreach ($oppardata3 as $entry) {
	$entryArray = (array) $entry;

	if ((strlen($entryArray['m']) > 4) && (strlen($entryArray['m']) < 280) && ($entryArray['m']) != '+randquote') {
		//echo '<p>';
		$entry = str_replace('. ', '.\n', $entryArray['m']);
		//echo($entry);
		$alleReime[] = $entry;
		//echo '</p>';
	}
	
}

$countReime = count($alleReime);
//print_r($countReime);
$randomNumber = rand(0, 594);
$randomReim = $alleReime[$randomNumber];


//print_r($alleReime);


$statues = $connection->post("statuses/update", ["status" => $randomReim]);