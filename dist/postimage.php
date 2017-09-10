<?php
/**
 * Makes an image with an inspiring quote
 * and shares it to our fb feed.
 *
 *  * PHP Version 7.1
 *
 * @category Postimage
 * @package  Bagfacio
 * @author   Dan Devine <jerk@coderjerk.com>
 * @license  WTFPL http://www.wtfpl.net/txt/copying/
 * @link     https://bagfacio.coderjerk.com
 * @since    1.0.0
 */

$root = $_SERVER["DOCUMENT_ROOT"];

require_once $root . '/inc/components/loaders/loader.php';

/**
 * This will be the 'theme' of the text part.
 * should be an adjective
 *
 * @var string
 */
$theme = 'heartbroken';

$dm = new DataMuse("ml=".$theme."&max=600");

/**
 * Bring in an array of inspirational quotes
 */
require $root . '/inc/data/quotes.php';

/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/' . $theme, $quote[0]);
imagepng($img, 'radical.png');
imagedestroy($img);

/**
 * Post the generated image to Facebook
 * via the Graph API
 */
$image = 'https://bagfacio.coderjerk.com/radical.png';

/**
 * TODO: This isn't working - can't edit privacy
 */
$privacy = array(
      'value' => 'EVERYONE'
    );

$data = [
  'message' => '#bagfacioinspires #inspiring #bagfacio',
  'url' => $image,
  'privacy' => $privacy
];

try {
    $response = $fb->post('/me/photos', $data, $pageAccessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '.$e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '.$e->getMessage();
    exit;
}
$graphNode = $response->getGraphNode();
