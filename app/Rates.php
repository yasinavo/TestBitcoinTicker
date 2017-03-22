<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    //
    public function updatePrice($excahnge,$price){
        if( $this::all()->count() > 0 ){

            $rate = $this::all()->first();
            $rate->exchange = $excahnge;
            $rate->last_price = $price;
            $rate->save();
        }else{
            $this->exchange = $excahnge;
            $this->last_price = $price;
            $this->save();
        }

    }
}
