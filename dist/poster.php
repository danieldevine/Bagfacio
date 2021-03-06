<?php
/**
 * Posts a photo with a caption to our Facebook feed.
 *
 * PHP Version 7.1
 *
 * @category Poster
 * @package  Bagfacio
 * @author   Dan Devine <jerk@coderjerk.com>
 * @license  WTFPL http://www.wtfpl.net/txt/copying/
 * @link     https://bagfacio.coderjerk.com
 * @since    1.0.0
 */

require_once 'inc/components/loaders/loader.php';

$dm         = new DataMuse("ml=sad&max=600");
$randomWord = $dm->randomWord();

/**
 * An array of neat captions to choose from
 *
 * @var array
 */
$captions =array(
    "well this " . $randomWord . " is the best ever",
    "I'm not convinced that this ". $randomWord ." is a good example.",
    "Do you remember this " . $randomWord . "?",
    "I hate this " . $randomWord . " so very, very much.",
    "2018 is the Chinese year of the ". $randomWord
);
//shuffle int orandom order
shuffle($captions);

/**
 * Get a random image from lorem flickr
 * http://loremflickr.com/
 *
 * @var string
 */
$fbImg     = 'https://loremflickr.com/476/249/'.$randomWord.'?random=1';
$fbCaption = $captions[0];
$photoData = [
 'caption' => $fbCaption,
 'url'     => $fbImg
];

try {
    $response = $fb->post('/me/photos', $photoData, $pageAccessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '.$e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '.$e->getMessage();
    exit;
}
$graphNode = $response->getGraphNode();
