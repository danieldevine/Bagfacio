<?php
/**
 * returns an array of followers
 *
 */

$root = $_SERVER["DOCUMENT_ROOT"];

include_once $root . '/inc/components/loaders/loader.php';
require_once("$root/vendor/abraham/twitteroauth/autoload.php");

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
