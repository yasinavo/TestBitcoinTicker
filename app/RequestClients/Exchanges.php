<?php

namespace App\RequestClients;


class Exchanges
{
//Executes a CURL request to bitcoin ticket APIs, gets the JSON reply and return.

    public static function getPrice()
    {
        $bitcoin_sites = array(

            array(
                'name' => 'BitStamp',
                'coins' => array(
                    array(
                        'coin' => 'BTC',
                        'api_url' => 'https://www.bitstamp.net/api/ticker/',
                        'json_index' => array('last'),
                        'json_reply' => '',
                        'last_price' => '',
                        'price_unit' => '$',
                        'curl' => null,
                    ),
                ),
            ),

            array(
                'name' => 'BTC-e',
                'coins' => array(
                    array(
                        'coin' => 'BTC',
                        'api_url' => 'https://btc-e.com/api/2/btc_usd/ticker',
                        'json_index' => array('ticker', 'last'),
                        'json_reply' => '',
                        'last_price' => '',
                        'price_unit' => '$',
                        'curl' => null,
                    ),

                ),
            ),

//            array(
//                'name' => 'LakeBTC',
//                'coins' => array(
//                    array(
//                        'coin' => 'BTC',
//                        'api_url' => 'https://www.lakebtc.com/api_v1/ticker', // API Changed
//                        'json_index' => array('USD','last'),
//                        'json_reply' => '',
//                        'last_price' => '',
//                        'price_unit' => '$',
//                        'curl' => null,
//                    ),
//
//                ),
//            ),
//

            array(
                'name' => 'cex.io',
                'coins' => array(
                    array(
                        'coin' => 'BTC',
                        'api_url' => 'https://cex.io/api/ticker/BTC/USD',
                        'json_index' => array('last'),
                        'json_reply' => '',
                        'last_price' => '',
                        'price_unit' => '$',
                        'curl' => null,
                    ),

                ),
            ),


            array(
                'name' => 'itbit',
                'coins' => array(
                    array(
                        'coin' => 'BTC',
                        'api_url' => 'https://api.itbit.com/v1/markets/XBTUSD/ticker',
                        'json_index' => array('lastPrice'),
                        'json_reply' => '',
                        'last_price' => '',
                        'price_unit' => '$',
                        'curl' => null,
                    ),

                ),
            ),

        );

        $multi_curl = curl_multi_init();
        foreach ($bitcoin_sites as &$site) {
            foreach ($site['coins'] as &$coin) {
                $coin['curl'] = curl_init();
                curl_setopt($coin['curl'], CURLOPT_RETURNTRANSFER, true);
                curl_setopt($coin['curl'], CURLOPT_HEADER, 0);
                curl_setopt($coin['curl'], CURLOPT_TIMEOUT, 10); //Seconds
                curl_setopt($coin['curl'], CURLOPT_URL, $coin['api_url']);
                curl_multi_add_handle($multi_curl, $coin['curl']);
            }
        }
        //Execute each curl concurrently for speed
        do {
            $mrc = curl_multi_exec($multi_curl, $active);
        } while ($active && $mrc == CURLM_OK);


        $output_string = 'Last Prices:';
        foreach ($bitcoin_sites as &$site) {
            $output_string .= ' ' . $site['name'] . ' ';
            foreach ($site['coins'] as &$coin) {
                $coin['json_reply'] = curl_multi_getcontent($coin['curl']);
                curl_multi_remove_handle($multi_curl, $coin['curl']);
                $coin['last_price'] = json_decode($coin['json_reply'], true);

                foreach ($coin['json_index'] as $subarray) {
                    $coin['last_price'] = $coin['last_price'][$subarray]; // Look for last price. Each API stores last price in different format.
                }

                //If price is 0 or null, an error or timeout probably occured
                if ($coin['last_price'] == 0) {
                    $output_string .= 'Err. ';
                } else {
                    $lastPrices[] = number_format($coin['last_price'], 2, '.','');
                }
            }

        }

        curl_multi_close($multi_curl);



        return  $lastPrices;

    }


}
