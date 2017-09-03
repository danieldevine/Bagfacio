<?php
/**
 * posts a link and message to your feed complete with stale opinions.
 * Feel free to alter these depending on your age group/demographic as these are fat white man in his late thirties centric.
 */
include_once 'inc/components/loaders/loader.php';

$root = $_SERVER["DOCUMENT_ROOT"];

//use our dataMuse class to set a theme using ml(means like)
//plenty of other configurations available -- see here: www.datamuse.com/api/
$dm = new dataMuse("ml=sadness&max=600");
$wordOne = $dm->randomWord();
$wordTwo = $dm->randomWord();

$fbLink = "https://en.wikipedia.org/wiki/".$wordOne;

//get a message
include $root . '/inc/data/message.php';

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
