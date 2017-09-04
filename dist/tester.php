<?php

$root     = $_SERVER["DOCUMENT_ROOT"];
$site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;

$name  = 'flickr';
$theme = 'fun';
$image = new LoremFlickr(600, 600, $name, $theme);
$image = $image->getLoremFlickr();


/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$friendo =  " @testmoron " . "+ \n @testmooroooon2";


$img = loadQuoteAlt($image, $friendo);
imagepng($img, 'flarp.png' );
imagedestroy($img);
$image = $site_url.'/flarp.png';



