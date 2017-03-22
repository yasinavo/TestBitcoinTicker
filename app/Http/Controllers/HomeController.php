<?php

namespace App\Http\Controllers;

use App\Rates;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    //$c1 = new \App\Models\Customer($clients[0][0],$clients[0][1],$clients[1][2]);

    //return view('customer.index',['client'=>$c1]);

    public function index(){

        $c1 = new \App\Models\BitCoin();

//        echo '<pre>';
//        print_r($c1->minPrice());
//        exit();
        $rates = Rates::all();
        print_r($rates);exit;
        return view('ticker.index',['rates'=>$c1->minPrice()]);
    }




    // Test tickers - Bitstamp API

    public function basicTicker(){

        $c2 = new \App\Models\BitCoin();
//        $rates = $c2->minPrice();
        print_r($c2->minPrice());
        exit();
        return view('ticker.basicticker')->with($rates);
    }

}
