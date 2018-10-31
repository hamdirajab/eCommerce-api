<?php

namespace App\Http\Controllers\Prodect;

use App\Prodect;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProdectBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prodect $prodect)
    {
        
        $buyers = $prodect->transactions()
                          ->with('buyer')
                          ->get()
                          ->pluck('buyer')
                          ->unique('id')
                          ->values();

        
        return $this->showAll($buyers);
    }
}
