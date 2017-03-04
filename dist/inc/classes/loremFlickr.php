<?php

/**
 * creates an image object
 * using loremflickr
 * not used at the moment
 * TODO: get this working a little nicer.
 */
class loremFlickr
{
    public $flickrQuery = "cheese";


    function __construct($flickrQuery)
    {
        $this->flickrQuery = $flickrQuery;
    }

    function randomImage()
    {
        header("Content-Type: image/jpeg");

        $url = 'https://loremflickr.com/476/249/'.$this->flickrQuery.'?random=1';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
        $img = curl_exec($curl);
        $rescode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl) ;

        $outName = str_replace( ' ', '', $this->flickrQuery );

        $input  = $img;
        $output = $outName.'.jpg';


        file_put_contents($output, file_get_contents($input));

    }
}


 ?>
