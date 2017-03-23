<?php


namespace App\RequestClients;


class BitClient
{
    // This is a test script
    // Parallel request to API
    public function multiRequest()
    {
        // URLs we want to retrieve
        $urls = array(
            'https://www.bitstamp.net/api/ticker/',
            'https://btc-e.com/api/2/btc_usd/ticker'
        );

// initialize the multihandler
        $mh = curl_multi_init();

        $channels = array();
        foreach ($urls as $key => $url) {
            // initiate individual channel
            $channels[$key] = curl_init();
            curl_setopt_array($channels[$key], array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true
            ));

            // add channel to multihandler
            curl_multi_add_handle($mh, $channels[$key]);
        }

// execute - if there is an active connection then keep looping
        $active = null;
        do {
            $status = curl_multi_exec($mh, $active);
        }
        while ($active && $status == CURLM_OK);

// echo the content, remove the handlers, then close them
        foreach ($channels as $chan) {
            echo '<pre>';
            echo curl_multi_getcontent($chan);

            curl_multi_remove_handle($mh, $chan);
            curl_close($chan);
        }
        //x`exit();

// close the multihandler
        curl_multi_close($mh);


    }


}