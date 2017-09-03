<?php

$root     = $_SERVER["DOCUMENT_ROOT"];
$site_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once $root . '/inc/components/loaders/loader.php';




$pixelImage = new LoremPixel( 600, 600, $site_url );
$thisImage = $pixelImage->getLoremPixel();

echo $thisImage;