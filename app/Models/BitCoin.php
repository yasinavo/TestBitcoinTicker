<?php
/**
 * Created by PhpStorm.
 * User: Kasutaja
 * Date: 3/4/2017
 * Time: 6:21 PM
 */

namespace App\Models;




use App\RequestClients\BitClient;
use App\RequestClients\Exchanges;

class BitCoin
{

    function __construct()
    {
        //$this->clientRate = new BitClient();
        $this->clientRate = new Exchanges();
    }

    public function minPrice(){

        //return $this->clientRate->btcRate("https://btc-e.com/api/2/btc_usd/ticker");

        //return $this->clientRate->bitStamp("https://www.bitstamp.net/api/ticker/");

       // return $this->clientRate->multiRequest();   // Multi request


        return $this->clientRate->getPrice(); // Get prices from exchanges

    }

}