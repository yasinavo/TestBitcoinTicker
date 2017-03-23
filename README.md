## Bitcoin Ticker - Laravel

This is a Bitcoin price ticker built to work with different Bitcoin markets. 
Included exchanges:
    <li>BitStamp</li>
    <li>BTC-e</li>
    <li>cex</li>
    <li>itbit</li>
Get the ticker data from crypto exchanges and EUR/USD currency exchange rate and store them to mysql database.  
    

Used techs:
PHP, Laravel 5.4, mysql, homestead, Vagrant, composer


## Running

To run the ticker,

 <li>Create cron job</li>

Laravel's command scheduler allows you to fluently and expressively define your command schedule within Laravel itself. When using the scheduler, only a single Cron entry is needed on your server. Your task schedule is defined in the app/Console/Kernel.php file's schedule method.

https://laravel.com/docs/5.4/scheduling

Add the following Cron entry to your server. (Change path/to/ according to your project path)

        * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

This Cron will call the Laravel command scheduler every minute. When the schedule:run command is executed, Laravel will evaluate your scheduled tasks and runs the tasks that are due.

Sample code: app/Console/Kernel.php

    protected function schedule(Schedule $schedule)
    {
         $schedule->command('getprice')
             ->everyTenMinutes(); // Run cron job in every ten minutes.
    }
    
  
Custom Commands are stored in the app/Console/Commands

 <li>Migrate Database </li>
 https://laravel.com/docs/5.4/migrations
 
 <li>Edit .env file as needed </li>
 
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=homestead
        DB_USERNAME=homestead
        DB_PASSWORD=secret


 <li>Run  </li>


<br/>

Change the DB details in the .env file and also in the /config/database.php

Go to the directory where the project is

Enter the command composer install

Enter the command php artisan migrate

run the project on the browser: TestBitcoinTicker/public/rate/


## TODO

## High Priority
* Handle unavailable, broken feeds and corrupted data
* Create tests
* Response - when new price available
* Show BTC/EUR rete (API structure would change)
* Show number of feed/ active feeds
* Check scalability


## Features
* cron job to automatically get feed data and update DB according to a set schedule

## Files with codes

    app
        Console
            Commands
                GetPrice.php
            Kernal.php
            
        Http
            Controllers
                PagesController.php
        RequestClients
            Currency.php
            Exchanges.php
        Rates.php
