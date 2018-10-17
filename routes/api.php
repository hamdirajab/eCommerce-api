<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Buyers
Route::resource('/buyers','Buyer\BuyerController',['only'=>['index','show']]);

// Sellers
Route::resource('/sellers','Seller\SellerController',['only' => ['index','show']]);

// Prodects
Route::resource('/prodects','Prodect\ProdectController',['only' => ['index','show']]);

// Categorys
Route::resource('/categorys','Category\CategoryController',['except'=>['create','edit']]);

// Transactions
Route::resource('/transactions','Transaction\TransactionController',['only'=>['index','show']]);

// Transactions Categorys
Route::resource('/transactions.categorys','Transaction\TransactionCategoryController',['only'=>['index']]);

// Users
Route::resource('/users','User\UserController',['except'=>['create','edit']]);

