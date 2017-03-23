<?php

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

        return $this->clientRate->getPrice(); // Get prices from listed exchanges

    }

}