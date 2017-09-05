<?php
$root       = $_SERVER["DOCUMENT_ROOT"];
$site_url   = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$name       = 'flickr';
$theme      = 'fun';
$image      = new LoremFlickr(600, 600, $name, $theme);
$image      = $image->getLoremFlickr();

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
$followers  = new Followers($connection);
$followers  = $followers->getFollowers();

include 'inc/data/colors.php';

$faveColour = $colours[0];


header('Content-Type: image/jpeg');
$friendo    = " @" .$followers[0]. " + \n" . "@".$followers[1];
$img        = loadQuoteAlt($image, $friendo);
imagepng($img, 'flarp.png' );
imagedestroy($img);
$image      = $site_url.'/flarp.png';

$message    = "Hi there @".$followers[0]." : Your twitter wife is  @" . $followers[1] . ". You should follow @" . $followers[2] . ", @" . $followers[3] .  " and @coderjerk";

$media      = $connection->upload('media/upload', ['media' => $image]);
$parameters = [
    'status' => $message,
    'media_ids' => implode(',', [$media->media_id_string])
];
$result     = $connection->post('statuses/update', $parameters);
