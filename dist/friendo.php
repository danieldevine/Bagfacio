<?php
/**
 * friendly friendo images
 * strictly for friendos.
 */

$root       = $_SERVER["DOCUMENT_ROOT"];
$site_url   = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;

$name       = 'flickr';
$theme      = 'fun';
$image      = new LoremFlickr(600, 600, $name, $theme);
$image      = $image->getLoremFlickr();



include 'inc/data/colors.php';

$faveColour = $colors[0];

$dm = new dataMuse("rel_syn=food&max=600");
$wordOne = $dm->randomWord();
$wordTwo = $dm->randomWord();

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);

/**
 * Get all followers, save as array of screen names.
 * @var array
 */
$followers = array();
$ids = $connection->get('followers/ids');

/**
 * chunked array of ids
 * @var array
 */
$ids_arrays = array_chunk($ids->ids, 100);

/**
 * loop through ids and
 * add screen names to array.
 */
foreach($ids_arrays as $implode) {
  $results = $connection->get('users/lookup', array('user_id' => implode(',', $implode)));
  foreach($results as $profile) {
    $followers[] =  $profile->screen_name;
  }
}

/**
 * shuffle the deck.
 */
shuffle($followers);

$friendo = "Friendo Profile for @" . $followers[0] . " \n" .
"Best Friendo: @" . $followers[1] . "\n" .
"Nemesis: " . $followers[2] . "\n" .
"Fave Colour: " . $faveColour . "\n" .
"Fave Food: " . $wordOne . "\n" .
"Hates: " . $wordTwo . "\n";

header('Content-Type: image/jpeg');

$img        = loadQuoteAlt($image, $friendo);
imagepng($img, 'flarp.png' );
imagedestroy($img);
$image      = $site_url.'/flarp.png';

$message    = "Hi there @".$followers[0]." This is your Friendo Profile. ". "You should follow @" . $followers[3] . ", @" . $followers[4] .  " and @coderjerk";

$media      = $connection->upload('media/upload', ['media' => $image]);
$parameters = [
    'status' => $message,
    'media_ids' => implode(',', [$media->media_id_string])
];
$result     = $connection->post('statuses/update', $parameters);
