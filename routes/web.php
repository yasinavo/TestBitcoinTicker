<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('welcome');
   
});


Route::get('about', function(){
return view('pages.about');   
});




/* Route file
 * 
 */

Route::get('about', 'PagesController@about');
    
Route::get('customer','CustomerController@clientList');

Route::get('rate','HomeController@index'); // Exchanges - all

Route::get('ticket_one','HomeController@basicTicker');// Test tickers - Bitstamp API