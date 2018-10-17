<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerProdectController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        
        $prodects = $buyer->transactions()->with('prodect')
                    ->get()
                    ->pluck('prodect');

        return $this->showAll($prodects);

    }
}