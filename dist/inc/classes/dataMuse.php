<?php
/**
 * creates a word object
 * using the Datamuse API
 */
class dataMuse
{
    public $dmQuery = "ml=awesome&max=50";

    function __construct($dmQuery)
    {
        $this->dmQuery = $dmQuery;
    }

    function randomWord()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.datamuse.com/words?'. $this->dmQuery);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($resp, true);
        shuffle($result);

            foreach($result as $res ) {
                return  $res['word'];
                break;
            }

    }
}

?>
