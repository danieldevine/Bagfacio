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
 * connect to Twitter
 */
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

/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$friendo =  " @" .$followers[0]. "\n" . "+ \n".$followers[1];


$img = loadQuoteAlt($image, $friendo);
imagepng($img, 'flarp.png' );
imagedestroy($img);
$image = $site_url.'/flarp.png';


/**
 * Create text portion with random status and random follower shoutouts.
 * @var string
 */
$message =  "Hi there @".$followers[0]." : Your perfect friendo match is  @" . $followers[1] . ". You should follow @" . $followers[2] . ", @" . $followers[3] .  " and @coderjerk";

/**
 * Upload the status and image prior to posting.
 */
$media = $connection->upload('media/upload', ['media' => $image]);
$parameters = [
    'status' => $message,
    'media_ids' => implode(',', [$media->media_id_string])
];
/**
 * post to Twitter
 */
$result = $connection->post('statuses/update', $parameters);