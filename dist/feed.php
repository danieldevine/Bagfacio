<?php
/**
 * feed.php
 *
 * @since v0.0.7
 * Makes an image with an inspiring quote and message
 * and posts it to our twitter feed.
 *
 */
$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;
