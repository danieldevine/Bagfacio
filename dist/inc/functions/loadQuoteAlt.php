<?php

function loadQuoteAlt($imgname, $quote)
{
    /* Attempt to open */
    $im = @imagecreatefromjpeg($imgname);
    $tc  = imagecolorallocate($im, 0, 0, 0);
    imagestring($im, 1, 5, 5, $quote, $tc);

    imagealphablending($im, true);

    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 128, 128, 128);
    $black = imagecolorallocate($im, 0, 0, 0);
    $bag = imagecolorallocate($im, 74, 179, 244);
    $transparent = imagecolorallocatealpha($im, 74, 179, 244, 45);

    imagefilledrectangle($im, 0, 0, 600, 30, $bag);
    imagefilledrectangle($im, 0, 600, 600, 550, $bag);
    imagefilledrectangle($im, 0, 600, 600, 0, $transparent);

    $font = $_SERVER["DOCUMENT_ROOT"] .'/assets/fonts/pacifico.ttf';
    $funt = $_SERVER["DOCUMENT_ROOT"] .'/assets/fonts/jollylodger.ttf';

    // Add some shadow to the text
    imagettftext($im, 40, 0, 48, 154, $black, $funt, $quote);

    // Add the text
    // image, font size, rotation, left, top
    imagettftext($im, 40, 0, 50, 150, $white, $funt, $quote);

    // tag the fecker
    imagettftext($im, 12, 0, 230, 580, $black, $font, 'Bagfacio Best Friendos');

    return $im;
}
