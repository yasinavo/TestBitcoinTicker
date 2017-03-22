<?PHP
//Executes a CURL request to bitcoin ticket APIs, gets the JSON reply
//Todo: API JSON error detection, more sites

$bitcoin_sites = array(
    array(
        'name' => 'Mt.Gox [Dead]',
        'coins' => array(
            array(
                'coin' => 'BTC',
                'api_url' => 'https://data.mtgox.com/api/2/BTCUSD/money/ticker',
                'json_index' => array('data', 'last', 'value'),
                'json_reply' => '',
                'last_price' => '',
                'price_unit' => '$',
                'curl' => null,
            ),
        ),
    ),
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
            array(
                'coin' => 'LTC',
                'api_url' => 'https://btc-e.com/api/2/ltc_usd/ticker',
                'json_index' => array('ticker', 'last'),
                'json_reply' => '',
                'last_price' => '',
                'price_unit' => '$',
                'curl' => null,
            ),
            array(
                'coin' => 'NMC',
                'api_url' => 'https://btc-e.com/api/2/nmc_usd/ticker',
                'json_index' => array('ticker', 'last'),
                'json_reply' => '',
                'last_price' => '',
                'price_unit' => '$',
                'curl' => null,
            ),
            array(
                'coin' => 'FTC',
                'api_url' => 'https://btc-e.com/api/2/ftc_btc/ticker',
                'json_index' => array('ticker', 'last'),
                'json_reply' => '',
                'last_price' => '',
                'price_unit' => 'B',
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
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($multi_curl) != -1) {
        do {
            $mrc = curl_multi_exec($multi_curl, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}
$output_string = 'Last Prices:';
foreach ($bitcoin_sites as &$site) {
    $output_string .= ' '.$site['name'].' ';
    foreach ($site['coins'] as &$coin) {
        $coin['json_reply'] = curl_multi_getcontent($coin['curl']);
        curl_multi_remove_handle($multi_curl, $coin['curl']);
        $coin['last_price'] = json_decode($coin['json_reply'], true); //Return as array
        //Since each site stores their last price differently, we implement a workaround:
        //We store the json hierarchy to our target data,
        //in order, then iterate through them one level at a time
        foreach($coin['json_index'] as $subarray) {
            $coin['last_price'] = $coin['last_price'][$subarray];
        }
        if ($coin['price_unit'] == '$') {
            $coin['last_price'] = number_format($coin['last_price'], 2);
        }
        $output_string .= '['.$coin['coin'].'] ';
        //If price is 0 or null, an error or timeout probably occured
        if ($coin['last_price'] == 0) {
            $output_string .= 'Err. ';
        } else {
            $output_string .= $coin['price_unit'].$coin['last_price'].' ';
        }
    }
    $output_string .= '|';
}
$output_string = rtrim($output_string, '|'); //remove trailing pipe
curl_multi_close($multi_curl);
//Add ?anything to the url to get the debug view
if(!empty($_GET)) {
    foreach ($bitcoin_sites as &$site) {
        foreach ($site['coins'] as &$coin) {
            $coin['curl_debug'] = curl_getinfo($coin['curl']); //Dump the curl handlers
            echo var_dump($coin['curl_debug']);
        }
    }
} else {
    echo $output_string;
}
?>