<?php
/**
 * tweetimage.php
 *
 * @since v0.0.6
 * Makes an image with an inspiring quote and message
 * and posts it to our twitter feed.
 *
 */
$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * This will be the 'theme' of the text part.
 * should be an adjective
 * @var string
 */
$theme = 'magic';

$dm = new dataMuse("rel_jja=".$theme."&max=600");

/**
 * bring in an array of inspirational quotes
 */
include $root . '/inc/data/quotes.php';

/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/magic', $quote[0]);

imagepng($img, 'twurt.png' );
imagedestroy($img);

$image = 'https://bagfacio.coderjerk.com/twurt.png';

/**
 * bring in an array of stauseseses
 */
include $root . '/inc/data/status.php';

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
 * loop through ids and add screen names to array.
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
 * Create text portion with random status and random follower shoutouts.
 * @var string
 */
$message = $status[0] . " @" . $followers[0] . " @" . $followers[1] . " @" . $followers[2]. " @" . $followers[3] . " @" . $followers[4];

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
