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

/** 
*  Buyers 
*/
Route::resource('/buyers','Buyer\BuyerController',['only'=>['index','show']]);
Route::resource('/buyers.sellers','Buyer\BuyerSellerController',['only'=>['index']]);
Route::resource('/buyers.prodects','Buyer\BuyerProdectController',['only'=>['index']]);
Route::resource('/buyers.categorys','Buyer\BuyerCategoryController',['only'=>['index']]);
Route::resource('/buyers.transactions','Buyer\BuyerTransactionController',['only'=>['index']]);

/** 
*  Sellers
*/
Route::resource('/sellers','Seller\SellerController',['only' => ['index','show']]);

/** 
*  Prodects
*/
Route::resource('/prodects','Prodect\ProdectController',['only' => ['index','show']]);

/** 
*  Categorys
*/
Route::resource('/categorys','Category\CategoryController',['except'=>['create','edit']]);
Route::resource('/categorys.buyers','Category\CategoryBuyerController',['only' => ['index']]);
Route::resource('/categorys.sellers','Category\CategorySellerController',['only' => ['index']]);
Route::resource('/categorys.prodects','Category\CategoryProdectController',['only' => ['index']]);
Route::resource('/categorys.transactions','Category\CategoryTransactionController',['only' => ['index']]);

/** 
*  Transactions 
*/
Route::resource('/transactions','Transaction\TransactionController',['only'=>['index','show']]);
Route::resource('/transactions.sellers','Transaction\TransactionSellerController',['only'=>['index']]);
Route::resource('/transactions.categorys','Transaction\TransactionCategoryController',['only'=>['index']]);

/** 
*  Users
*/
Route::resource('/users','User\UserController',['except'=>['create','edit']]);

