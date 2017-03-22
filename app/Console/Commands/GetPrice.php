<?php

namespace App\Console\Commands;

use App\Rates;
use App\RequestClients\Exchanges;
use Illuminate\Console\Command;

class GetPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get last price';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prices = Exchanges::getPrice();
        $munPrice = min($prices);
        $rate =  new Rates();
        $rate->updatePrice('min',$munPrice);


    }
}
