<?php    
/**
 * use the LoremPixel site
 * to get a random iimage 
 * using cUrl, cos http requests are timing out on the 
 * live server for some reason
 */
class LoremPixel
{

    function __construct( $height, $width, $path ) {

        $this->height   = $height;
        $this->width    = $width;
        $this->path     = $path;

    }

    function getLoremPixel() {
        $ch = curl_init('http://www.lorempixel.com/'.$this->height.'/'.$this->width.'/');
        $fp = fopen($this->path.'/images/twurt.jpg', 'wb');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}
