<?php

require_once("config/fb.php");
require_once("vendor/autoload.php");
require_once("inc/classes/dataMuse.php");

$fb = new Facebook\Facebook([
 'app_id'                => $appID,
 'app_secret'            => $appSecret,
 'default_graph_version' => 'v2.8',
]);

$dm = new dataMuse("ml=society&max=400");

$fbLink = "https://en.wikipedia.org/wiki/".$dm->randomWord();
$fbMessage = "Hi Friends, we should all think more about " . $dm->randomWord() . ' and what it means to us. Particularly in the context of ' . $dm->randomWord() .'. Like and Share and Like if you agree';
$fbImg = 'https://loremflickr.com/476/249/politics?random=1';

$linkData = [
 'link'    => $fbLink,
 'message' => $fbMessage,
 'picture' => $fbImg
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
