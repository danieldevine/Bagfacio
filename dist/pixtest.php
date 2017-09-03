<?php

$root     = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';




$pixelImage = new LoremPixel( 600, 600, $root );
$thisImage = $pixelImage->getLoremPixel();

echo $thisImage;