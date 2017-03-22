<?php
/**
 * Makes an image with an inspiring quote and posts it to our twitter feed.
 *
 */

$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * This will be the theme of the text part.
 * should be an adjective
 * @var string
 */
$theme = 'poor';

$dm = new dataMuse("rel_jja=".$theme."&max=600");

/**
 * bring in an array of inspirational quotes
 */
include $root . '/inc/data/quotes.php';

/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/spiritual', $quote[0]);

imagepng($img, 'twurt.png' );
imagedestroy($img);

/**
 * Post the generated image to Twitter
 *
 */
$image = 'https://bagfacio.coderjerk.com/twurt.png';

/**
 * bring in an array of inspirational quotes
 */
include $root . '/inc/data/status.php';

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);

$media = $connection->upload('media/upload', ['media' => $image]);
$parameters = [
    'status' => $status[0],
    'media_ids' => implode(',', [$media->media_id_string])
];
$result = $connection->post('statuses/update', $parameters);
