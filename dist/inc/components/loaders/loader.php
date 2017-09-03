<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("$root/config/fb.php");
require_once("$root/config/twitter.php");
require_once("$root/vendor/autoload.php");
require_once("$root/inc/classes/dataMuse.php");
require_once("$root/inc/classes/LoremPixel.php");
require_once("$root/inc/functions/loadQuoteJpg.php");


//build the auth for Facebook
$fb = new Facebook\Facebook([
 'app_id'                => $appID,
 'app_secret'            => $appSecret,
 'default_graph_version' => 'v2.8',
]);
?>
