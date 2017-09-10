<?php
/**
 * DataMuse.php
 *
 *  PHP Version 7.1
 *
 * @category DataMuse
 * @package  Bagfacio
 * @author   Dan Devine <jerk@coderjerk.com>
 * @license  WTFPL http://www.wtfpl.net/txt/copying/
 * @link     https://bagfacio.coderjerk.com
 * @since    1.0.0
 */

/**
 * Creates a word object using the Datamuse API
 *
 *  PHP Version 7.1
 *
 * @category DataMuse
 * @package  Bagfacio
 * @author   Dan Devine <jerk@coderjerk.com>
 * @license  WTFPL http://www.wtfpl.net/txt/copying/
 * @link     https://bagfacio.coderjerk.com
 * @since    1.0.0
 */
class DataMuse
{
    public $dmQuery = "ml=awesome&max=50";

    /**
     * __construct
     *
     * @param string $dmQuery query string
     *
     * @return string
     */
    function __construct($dmQuery)
    {
        $this->dmQuery = $dmQuery;
    }

    /**
     * Get a random word
     *
     * @return string
     */
    function randomWord()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.datamuse.com/words?'. $this->dmQuery);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($resp, true);
        shuffle($result);

        foreach ($result as $res ) {
            return  $res['word'];
            break;
        }
    }
}
