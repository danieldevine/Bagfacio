<?php

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
