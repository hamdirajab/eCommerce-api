<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        
        $sellers = $buyer->transactions()->with('prodect.seller')->get()
                         ->pluck('prodect.seller')
                         ->unique('id') // for repeted
                         ->values();    // after remove the repet it well stel the empty object so just get that have value

        return $this->showAll($sellers);

    }
}
