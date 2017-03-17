<?php
/**
 * Makes an image with an inspiring quote and shares it to our fb feed.
 *
 */
include_once $_SERVER["DOCUMENT_ROOT"] . '/inc/components/loaders/loader.php';

$dm = new dataMuse("rel_jja=dumb&max=600");

/**
 * An array of neat captions to choose from
 * @var array
 */
$quote = array(
    "Alls I need is \n" . $dm->randomWord() . ", " . $dm->randomWord() . " & \n " . $dm->randomWord() . "\n and I'm just fine. ",
    "Grateful for every \n" . $dm->randomWord() . " that life gives me. \n Even the " . $dm->randomWord(). " ones \n #" . $dm->randomWord(),
    "Don't worry about  \n" . $dm->randomWord()  .", There's \na " . $dm->randomWord() . " waiting \n for you just \n around the corner.\n " . "#" . $dm->randomWord(),
    "When life gives you \n" . $dm->randomWord() . "\n Make " . $dm->randomWord() . "ade.",
    "For every " . $dm->randomWord() . "\n There's an equal \n and opposite \n" . $dm->randomWord() . "\n - Albert Einstine",

);

shuffle($quote);


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
    $funt = $_SERVER["DOCUMENT_ROOT"] .'/assets/fonts/amatic.ttf';

    // Add some shadow to the text
    imagettftext($im, 40, 0, 24, 124, $black, $funt, $quote);

    // Add the text
    imagettftext($im, 40, 0, 20, 120, $white, $funt, $quote);

    // tag the fecker
    imagettftext($im, 12, 0, 250, 580, $black, $font, 'Bagfacio Inspires');

    return $im;
}

header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/spiritual', $quote[0]);

imagepng($img);
imagedestroy($img);
