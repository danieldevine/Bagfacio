<?php
/**
 * Makes an image with an inspiring quote and shares it to our fb feed.
 *
 */
include_once 'inc/components/loaders/loader.php';

$dm = new dataMuse("rel_jja=dumb&max=600");


$quote = "Alls I need is \n" . $dm->randomWord() . ", " . $dm->randomWord() . " & \n " . $dm->randomWord() . "\n and I'm just fine. ";

function loadQuoteJpg($imgname, $quote)
{
    /* Attempt to open */
    $im = @imagecreatefromjpeg($imgname);
    $tc  = imagecolorallocate($im, 0, 0, 0);
    imagestring($im, 1, 5, 5, $quote, $tc);

    // Create some colors
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 128, 128, 128);
    $black = imagecolorallocate($im, 0, 0, 0);
    $bag = imagecolorallocate($im, 220, 181, 140);
    imagefilledrectangle($im, 0, 0, 600, 30, $bag);

    imagefilledrectangle($im, 0, 600, 600, 550, $bag);


    // Replace path by your own font path
    $font = $_SERVER["DOCUMENT_ROOT"] .'/assets/fonts/pacifico.ttf';

    // Add some shadow to the text
    imagettftext($im, 40, 0, 24, 124, $black, $font, $quote);

    // Add the text
    imagettftext($im, 40, 0, 20, 120, $white, $font, $quote);

    // tag the fecker
    imagettftext($im, 12, 0, 250, 580, $black, $font, 'Bagfacio Inspires');

    return $im;
}

header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/spiritual', $quote);

imagepng($img, 'radical.png' );
imagedestroy($img);

$image = 'https://bagfacio.coderjerk.com/radical.png';

$data = [
  'message' => '#bagfacioinspires #inspiring #bagfacio',
  'url' => $image,
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
