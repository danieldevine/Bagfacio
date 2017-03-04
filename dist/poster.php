<?php

require_once("config/fb.php");
require_once("vendor/autoload.php");
require_once("inc/classes/dataMuse.php");

$fb = new Facebook\Facebook([
 'app_id'                => $appID,
 'app_secret'            => $appSecret,
 'default_graph_version' => 'v2.8',
]);

$dm    = new dataMuse("ml=fun&max=600");
$randomWord = $dm->randomWord();

$captions =array(
    "well this " . $randomWord . " is the best ever",
    "I'm not convinced that this ". $randomWord ." is a good example.",
    "Do you remember this " . $randomWord . "?",
    "I hate this " . $randomWord . " so very, very much.",
    "2018 is the Chinese year of the ". $randomWord
);
shuffle($captions);


$fbImg     = 'https://loremflickr.com/476/249/'.$randomWord.'?random=1';
$fbCaption = $captions[0];


$photoData = [
 'caption' => $fbCaption,
 'url'     => $fbImg
];

try {
 $response = $fb->post('/me/photos', $photoData, $pageAccessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 echo 'Graph returned an error: '.$e->getMessage();
 exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 echo 'Facebook SDK returned an error: '.$e->getMessage();
 exit;
}
$graphNode = $response->getGraphNode();
