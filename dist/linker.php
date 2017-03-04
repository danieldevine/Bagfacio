<?php

require_once("config/fb.php");
require_once("vendor/autoload.php");
require_once("inc/classes/dataMuse.php");

$fb = new Facebook\Facebook([
 'app_id'                => $appID,
 'app_secret'            => $appSecret,
 'default_graph_version' => 'v2.8',
]);

$dm = new dataMuse("ml=food&max=600");
$wordOne = $dm->randomWord();
$wordTwo = $dm->randomWord();

$fbLink = "https://en.wikipedia.org/wiki/".$wordOne;
$fbMessage = array (
     "These days, we should all think more about " . $wordOne() . ' and what it means to us. Particularly in the context of ' . $wordTwo .'. Like and Share and Like if you agree',
     "I'm not sure how to feel about ". $wordTwo . "these days. Maybe we should be talking about ". $wordTwo . " instead? Just sayin'",
     "Do you remember when " . $wordOne . "really meant ". $wordOne . "?? Now it means ". $wordTwo . " more often than not. See evidence below: ",
     "When we were young, all we cared about was ". $wordOne . ". Now we're older and all we can amnage is " . $wordTwo .". :) :) :("

);

shuffle($fbMessage);

$linkData = [
 'link'    => $fbLink,
 'message' => $fbMessage[0],
];

try {
 $response = $fb->post('/me/feed', $linkData, $pageAccessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 echo 'Graph returned an error: '.$e->getMessage();
 exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 echo 'Facebook SDK returned an error: '.$e->getMessage();
 exit;
}
$graphNode = $response->getGraphNode();
