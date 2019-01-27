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
/*
    $url = request()->url();

    $queryParams = request()->query();

    ksort($queryParams);

    $queryString = http_build_query($queryParams);

    $fulUrl = "{$url}?{$queryString}";
    return $fulUrl;*/
//    $reqall =  request()->all();
//    $reqqur =  request()->query();
//    $namei =   request()->input('hamdi');
//    $nameq =   request()->query('hamdi');
//
//    return [$reqall , $reqqur , $namei , $nameq];
    return view('Welcome');
})->middleware('guest');

// Auth::routes();

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');

// use vue component to get Token by personal Agent Type
Route::get('/home/my-clients', 'HomeController@getClients')->name('personal-clients');
Route::get('/home/authorized-clients', 'HomeController@getAuthorizedClients')->name('authorized-clients');
Route::get('/home/my-tokens', 'HomeController@getTokens')->name('personal-tokens');




















