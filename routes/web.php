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

//routes to the scanned QR-code page
Route::get('scooter/{scooter}', 'ScooterController@show');

Route::post('/charge', 'PaymentController@handle');

//handles the webhook from stripe.com
Route::post('/stripe/webhook', 'StripeWebhookController@handle');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('scooter/{scooter}/register', 'UserRegisterController@index');
Route::post('scooter/{scooter}/register', 'UserRegisterController@store');

Auth::routes();
