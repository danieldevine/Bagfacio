<?php
/**
 * Makes an image with an inspiring quote and shares it to our fb feed.
 *
 */

$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';

/**
 * This will be the theme of the text part.
 * make it a noun for best register_default_headers
 * @var string
 */
$theme = 'dumb';

$dm = new dataMuse("rel_jja=".$theme."&max=600");

/**
 * bring in an array of inspirational quotes
 */
include $root . '/inc/data/quotes.php';


header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/spiritual', $quote[0]);

imagepng($img);
imagedestroy($img);
