<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only(['index']);
        $this->middleware('can:view,buyer'/* can obj of buyer or App/Buyer*/)->only('index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        
        $categorys = $buyer->transactions()->with('prodect.categories')->get()
                           ->pluck('prodect.categories') // this is many to many relation
                           ->collapse()   // to convert the collection of collection to one collection b
                           ->unique('id')
                           ->values();

        return $this->showAll($categorys);

    }
}
