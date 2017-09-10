<?php
/**
 * Tweetimage
 *
 * Makes an image with an inspiring quote and message
 * and posts it to our twitter feed.
 *
 * PHP Version 7.1
 *
 * @category Bagfacio
 * @package  Bagfacio
 * @author   Dan Devine <jerk@coderjerk.com>
 * @license  WTFPL http://www.wtfpl.net/txt/copying/
 * @link     https://bagfacio.coderjerk.com
 * @since    1.0.0
 */

$root     = $_SERVER["DOCUMENT_ROOT"];
$site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

require_once $root . '/inc/components/loaders/loader.php';
require_once $root . '/vendor/abraham/twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * This will be the 'theme' of the text part.
 * should be an adjective
 *
 * @var string
 */
$theme = 'rich';

/**
 * Get some random words, using our theme,
 * in a randomly sorted array
 *
 * @var array
 */
$dm = new DataMuse("rel_jja=".$theme."&max=600");

/**
 * Bring in an array of inspirational quotes
 */
require $root . '/inc/data/quotes.php';

/**
 * Get a random image from lorempixel.com
 */
$pixelImage = new LoremPixel('600', '600', 'bagfacio');
$pixelImage = $pixelImage->getLoremPixel();

/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$img = loadQuoteJpg($pixelImage, $quote[0]);
imagepng($img, 'twurt.png');
imagedestroy($img);
$image = $site_url.'/twurt.png';

/**
 * Bring in an array of stauseseseseses
 */
require $root . '/inc/data/status.php';

/**
 * Connect to Twitter
 */
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);

/**
 * Get all followers, save as array of screen names.
 *
 * @var array
 */
$followers = array();
$ids = $connection->get('followers/ids');

/**
 * Chunked array of ids
 *
 * @var array
 */
$ids_arrays = array_chunk($ids->ids, 100);

/**
 * Loop through ids and
 * add screen names to array.
 */
foreach ($ids_arrays as $implode) {
    $results = $connection->get('users/lookup', array('user_id' => implode(',', $implode)));
    foreach ($results as $profile) {
        $followers[] =  $profile->screen_name;
    }
}

/**
 * Shuffle the deck.
 */
shuffle($followers);

/**
 * Create text portion with random status and random follower shoutouts.
 *
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
 * Post to Twitter
 */
$result = $connection->post('statuses/update', $parameters);
