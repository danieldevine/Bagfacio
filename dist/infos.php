<?php 

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $actual_link;

echo "<br />";

$site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

echo $site_url;

echo "<br />";

/**
 * Test if datMuse is working
 * @var [type]
 */
$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';

$theme = 'sad';

$dm = new dataMuse("rel_jja=".$theme."&max=600");

try{
   echo $dm->randomWord();
}catch ( Exception $e ){
echo $e->getMessage();
}



/**
 * Begin our generated image.
 */
header('Content-Type: image/jpeg');

$img = loadQuoteJpg('http://loremflickr.com/600/600/' . $theme, $dm->randomWord());

imagepng($img, 'twurt.png' );
imagedestroy($img);

$image = $site_url.'/twurt.png';
