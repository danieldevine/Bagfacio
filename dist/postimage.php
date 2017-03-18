<?php
/**
 * Makes an image with an inspiring quote and shares it to our fb feed.
 *
 */

$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';

/**
 * This will be the theme of the text part.
 * make it a noun for best results.
 * @var string
 */
$theme = 'dumb';

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

imagepng($img, 'radical.png' );
imagedestroy($img);

/**
 * Post the generated image to Facebook
 * via the Graph API.
 *
 */
$image = 'https://bagfacio.coderjerk.com/radical.png';

/**
 * TODO: This isn't working - can't edit privacy
 *
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
