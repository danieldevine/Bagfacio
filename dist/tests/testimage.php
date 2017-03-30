<?php
/**
 * tweetimage.php
 *
 * @since v0.0.6
 * Makes an image with an inspiring quote and message
 * and posts it to our twitter feed.
 *
 */
$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';


/**
 * This will be the 'theme' of the text part.
 * should be an adjective
 * @var string
 */
$theme = 'old';

$dm = new dataMuse("rel_jja=".$theme."&max=600");

/**
 * bring in an array of inspirational quotes
 */
include $root . '/inc/data/quotes.php';

/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/stupid', $quote[0]);

imagepng($img, 'tweetimage.png' );
imagedestroy($img);
