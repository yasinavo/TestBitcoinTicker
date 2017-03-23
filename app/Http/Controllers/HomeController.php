<?php

namespace App\Http\Controllers;

use App\Rates;
use App\RequestClients\Currency;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){

//        echo '<pre>';
//        print_r($c1->minPrice());
//        print_r($c2->getCurrency());
//        exit();
        $rates = Rates::all()->first();

        return view('ticker.index',['rate'=>$rates->last_price,'curr'=>$rates->currency]);
    }



}
