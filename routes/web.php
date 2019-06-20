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
// route map all scooters 
Route::get('map', 'ScooterController@map');
Route::get('map/send', 'ScooterController@send');

//routes to the scanned QR-code page
Route::get('scooter/{scooter}', 'ScooterController@show');

//logout
Route::get('/logout', 'LogoutController@logout')->name('logout');

Route::post('/charge', 'PaymentController@handle');

//handles the webhook from stripe.com
Route::post('/stripe/webhook', 'StripeWebhookController@handle');
Route::post('/stripe/verify_cc', 'StripeCreditcardVerifyController@handle');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('scooter/{scooter}/register', 'UserRegisterController@index');
Route::post('scooter/{scooter}/register', 'UserRegisterController@store');

Route::get('scooter/{scooter}/login', 'UserLoginController@index');
Route::post('scooter/{scooter}/login', 'UserLoginController@login');

Route::get('scooter/{scooter}/verify/{user}', 'VerifyUserController@verify')->middleware('auth');
Route::post('/scooter/{scooter}/user/{user}/cc_verify', 'VerifyUserCreditcardController@verify')->middleware('auth');

Route::get('scooter/{scooter}/user/{user}', 'UserController@dashboard')->name('dashboard')->middleware('auth');


//API
Route::get('/verify/{user}', 'VerifyUserController@handle');
Route::get('/verify/cc/{user}', 'VerifyCreditcardController@handle');


Auth::routes();
