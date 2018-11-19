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
});
