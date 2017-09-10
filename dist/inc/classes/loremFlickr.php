<?php
/**
 * use the LoremFlickr site
 * to get a random iimage
 * using cUrl, cos http requests are timing out on the
 * live server for some reason
 */

/**
 *
 * @var mixed
 */
class LoremFlickr
{

    function __construct( $height, $width, $name, $theme )
    {
        $this->height   = $height;
        $this->width    = $width;
        $this->name     = $name;
        $this->theme    = $theme;
    }

    function getLoremFlickr()
    {
        $ch = curl_init('http://www.loremflickr.com/'.$this->height.'/'.$this->width.'/'.$this->theme);
        $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/images/'.$this->name.'.jpg', 'wb');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return $_SERVER["DOCUMENT_ROOT"].'/images/'.$this->name.'.jpg';
    }
}