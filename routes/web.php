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
// Admin Login
// Route::get('/admin_12345', 'AdminController@home')->name('admin');
// Route::post('/admin_12345/login', 'AdminController@login');
Route::get('/admin', 'AdminController@test')->name('admin')->middleware('is_admin');
Route::get('/admin/scooters', 'ScooterController@index')->middleware('is_admin');


Route::get('/', function () {
    return view('index');
});

Route::get('/account', 'AccountController@index');

Route::get('/creditcard', 'CreditcardController@show')->middleware('auth');
Route::post('/creditcard', 'CreditcardController@addCard')->middleware('auth');

Route::get('/login', 'UserLoginController@index');
Route::post('/login', 'UserLoginController@login');

Route::post('/verifysmslogin', 'VerifySMSController@verifysmslogin')->middleware('auth');

Route::get('/retryverifysms', 'VerifySMSController@retryverifysms')->middleware('auth');
Route::post('/retryverifysms', 'VerifySMSController@retryverifysmscheck')->middleware('auth'); 

//routes to the scanned QR-code page
Route::get('scooter/{scooter}', 'UserScooterController@show'); 

Route::get('/logout', 'LogoutController@logout')->name('logout');

//TRIP API
Route::get('/scooter/{scooter}/starttrip', 'TripController@start_trip')->name('start_trip');
Route::get('/scooter/{scooter}/stoptrip/{trip}', 'TripController@stop_trip')->name('stop_trip');

// route map all scooters 
Route::get('map', 'MapController@map');
Route::post('map/retrieve', 'MapController@retrieve');

//logout
Route::get('/logout', 'LogoutController@logout')->name('logout');

Route::post('/charge', 'PaymentController@handle');

//handles the webhook from stripe.com
Route::post('/stripe/webhook', 'StripeWebhookController@handle');
Route::post('/stripe/verify_cc', 'StripeCreditcardVerifyController@handle');

Route::get('/home', 'HomeController@index')->name('home');

//API
Route::get('/verify/{user}', 'VerifyUserController@handle')->middleware('auth');
Route::get('/verify/cc/{user}', 'VerifyCreditcardController@handle');


// Route::get('scooter/{scooter}/register', 'UserRegisterController@index');
// Route::post('scooter/{scooter}/register', 'UserRegisterController@store');


// Route::post('scooter/{scooter}/login', 'UserLoginController@login');

// Route::get('scooter/{scooter}/verify/{user}', 'VerifyUserController@verify')->middleware('auth');


// Route::get('scooter/{scooter}/user/{user}', 'UserController@dashboard')->name('dashboard')->middleware('auth');


//API
// Route::get('/verify/{user}', 'VerifyUserController@handle')->middleware('auth');
// Route::get('/verify/cc/{user}', 'VerifyCreditcardController@handle');



// Authentication Routes...
  
  // Password Reset Routes...
  Route::post('password/email', [
    'as' => 'password.email',
    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
  ]);
  Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
  ]);
  Route::post('password/reset', [
    'as' => 'password.update',
    'uses' => 'Auth\ResetPasswordController@reset'
  ]);
  Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
  ]);
  
  // Registration Routes...
  Route::get('register', [
    'as' => 'register',
    'uses' => 'UserRegisterController@index'
  ]);
  Route::post('register', [
    'as' => '',
    'uses' => 'UserRegisterController@store'
  ]);

// Auth::routes();

