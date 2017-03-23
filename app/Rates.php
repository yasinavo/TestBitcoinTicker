<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    //Save or update the data row using new price values.

    public function updatePrice($exchange,$price,$currency){
        if( $this::all()->count() > 0 ){

            $rate = $this::all()->first();
            $rate->exchange = $exchange;
            $rate->last_price = $price;
            $rate->currency = $currency;
            $rate->save();
        }else{
            $this->exchange = $exchange;
            $this->last_price = $price;
            $this->currency = $currency;
            $this->save();
        }

    }


}
